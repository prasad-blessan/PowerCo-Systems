<?php
/**
 * Polylang: make every language usable on the site as soon as it is added.
 *
 * - Adding a language (Languages > Languages) copies each default-language page into it
 *   (linked as translations, same parent pages) and copies the Primary and Footer menus.
 * - Languages > Set up languages does the same for all languages at once
 *   (existing languages, or a site where Polylang was set up before this theme version).
 *
 * Copies start with the default-language text; translate them in Pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Copies pages and menus into one language. Existing translations are left alone.
 *
 * @return array{pages:int, menus:int} Number of pages and menus created.
 */
function powerco_setup_language( $slug ) {
	$created = array( 'pages' => 0, 'menus' => 0 );
	$default = pll_default_language();
	if ( ! $slug || $slug === $default ) {
		return $created;
	}

	// Default-language pages, parents before children.
	$pages = array_filter( get_posts( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'numberposts' => -1,
		'lang'        => '',
	) ), function ( $page ) use ( $default ) {
		return pll_get_post_language( $page->ID ) === $default;
	} );
	usort( $pages, function ( $a, $b ) {
		return count( get_post_ancestors( $a ) ) <=> count( get_post_ancestors( $b ) ) ?: $a->menu_order <=> $b->menu_order;
	} );

	foreach ( $pages as $page ) {
		if ( pll_get_post( $page->ID, $slug ) ) {
			continue;
		}
		$parent = $page->post_parent ? pll_get_post( $page->post_parent, $slug ) : 0;
		$copy   = wp_insert_post( array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $page->post_title,
			'post_name'    => $page->post_name . '-' . $slug,
			'post_content' => $page->post_content,
			'post_parent'  => $parent ?: 0,
			'menu_order'   => $page->menu_order,
		) );
		if ( ! $copy || is_wp_error( $copy ) ) {
			continue;
		}
		pll_set_post_language( $copy, $slug );
		$translations          = pll_get_post_translations( $page->ID );
		$translations[ $slug ] = $copy;
		pll_save_post_translations( $translations );
		$created['pages']++;
	}

	// Menus: copy each default-language menu location into this language.
	$nav_menus = powerco_pll_option( 'nav_menus' );
	$theme     = get_stylesheet();
	foreach ( array( 'primary', 'footer' ) as $location ) {
		$source = $nav_menus[ $theme ][ $location ][ $default ] ?? 0;
		if ( ! $source || ! empty( $nav_menus[ $theme ][ $location ][ $slug ] ) ) {
			continue;
		}
		$menu = powerco_copy_menu( $source, $slug );
		if ( $menu ) {
			$nav_menus[ $theme ][ $location ][ $slug ] = $menu;
			$created['menus']++;
		}
	}
	powerco_pll_option( 'nav_menus', $nav_menus );

	delete_transient( 'pll_languages_list' );
	return $created;
}

/**
 * Copies a menu, pointing page items at their translation in $slug.
 *
 * @return int New menu ID, or 0.
 */
function powerco_copy_menu( $menu_id, $slug ) {
	$source = wp_get_nav_menu_object( $menu_id );
	if ( ! $source ) {
		return 0;
	}
	$name     = $source->name . ' (' . strtoupper( $slug ) . ')';
	$existing = wp_get_nav_menu_object( $name );
	if ( $existing ) {
		return $existing->term_id;
	}
	$menu = wp_create_nav_menu( $name );
	if ( is_wp_error( $menu ) ) {
		return 0;
	}
	$map = array();
	foreach ( wp_get_nav_menu_items( $source->term_id ) as $item ) {
		$args = array(
			'menu-item-title'     => 'page' === $item->object ? '' : $item->title,
			'menu-item-url'       => $item->url,
			'menu-item-object-id' => $item->object_id,
			'menu-item-object'    => $item->object,
			'menu-item-type'      => $item->type,
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $map[ (int) $item->menu_item_parent ] ?? 0,
			'menu-item-position'  => $item->menu_order,
		);
		if ( 'page' === $item->object ) {
			$target = pll_get_post( (int) $item->object_id, $slug );
			if ( ! $target ) {
				continue;
			}
			$args['menu-item-object-id'] = $target;
		}
		$map[ $item->ID ] = wp_update_nav_menu_item( $menu, 0, $args );
	}
	return $menu;
}

/**
 * Reads (one argument) or writes (two arguments) a Polylang option.
 * Goes through Polylang's own options object when present, so its end-of-request save keeps the change.
 */
function powerco_pll_option( $key, $value = null ) {
	$pll = function_exists( 'PLL' ) ? PLL() : null;
	if ( $pll && isset( $pll->options ) && is_object( $pll->options ) && method_exists( $pll->options, 'set' ) ) {
		if ( null === $value ) {
			return $pll->options->get( $key );
		}
		$pll->options->set( $key, $value );
		return $value;
	}
	$options = get_option( 'polylang', array() );
	if ( null === $value ) {
		return $options[ $key ] ?? null;
	}
	$options[ $key ] = $value;
	update_option( 'polylang', $options );
	return $value;
}

// New language added in Languages > Languages.
add_action( 'pll_add_language', function ( $args ) {
	if ( function_exists( 'pll_default_language' ) && ! empty( $args['slug'] ) ) {
		powerco_setup_language( $args['slug'] );
	}
} );

// Languages > Set up languages: one button for all languages.
add_action( 'admin_menu', function () {
	if ( ! function_exists( 'pll_languages_list' ) ) {
		return;
	}
	add_submenu_page( 'mlang', __( 'Set up languages', 'powerco' ), __( 'Set up languages', 'powerco' ), 'manage_options', 'powerco-languages', 'powerco_languages_page' );
}, 100 );

function powerco_languages_page() {
	$result = null;
	if ( isset( $_POST['powerco_setup_languages'] ) && check_admin_referer( 'powerco_setup_languages' ) ) {
		$result = array( 'pages' => 0, 'menus' => 0 );
		foreach ( pll_languages_list() as $slug ) {
			$done             = powerco_setup_language( $slug );
			$result['pages'] += $done['pages'];
			$result['menus'] += $done['menus'];
		}
		flush_rewrite_rules();
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Set up languages', 'powerco' ); ?></h1>
		<?php if ( $result ) : ?>
			<div class="notice notice-success"><p>
				<?php
				/* translators: 1: pages created, 2: menus created */
				printf( esc_html__( 'Done: %1$d pages and %2$d menus created.', 'powerco' ), (int) $result['pages'], (int) $result['menus'] );
				?>
			</p></div>
		<?php endif; ?>
		<p><?php esc_html_e( 'For every language, copies any page that has no translation yet and the Primary and Footer menus. Existing translations are not changed.', 'powerco' ); ?></p>
		<p><?php esc_html_e( 'Copies start with the default-language text. Translate them in Pages (the language columns), and the theme texts in Languages > Translations.', 'powerco' ); ?></p>
		<form method="post">
			<?php wp_nonce_field( 'powerco_setup_languages' ); ?>
			<?php submit_button( __( 'Set up all languages', 'powerco' ), 'primary', 'powerco_setup_languages' ); ?>
		</form>
	</div>
	<?php
}
