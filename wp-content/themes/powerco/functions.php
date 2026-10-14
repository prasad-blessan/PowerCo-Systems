<?php
/**
 * PowerCo theme setup.
 */

function powerco_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
	register_nav_menus( array(
		'primary' => 'Primary Menu',
		'footer'  => 'Footer Menu',
	) );
}
add_action( 'after_setup_theme', 'powerco_setup' );

function powerco_assets() {
	wp_enqueue_style( 'powerco-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic|Titillium+Web:600&display=swap', array(), null );
	wp_enqueue_style( 'powerco-style', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_script( 'powerco-main', get_template_directory_uri() . '/assets/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'powerco_assets' );

/**
 * Editable company details (Appearance > Customize > Company Info).
 */
function powerco_defaults() {
	return array(
		'tagline_small' => 'Power Systems',
		'phone_toll'    => '(800) 555-0100',
		'phone_main'    => '+1 (555) 555-0123',
		'email'         => 'info@example.com',
		'address'       => '123 Industrial Way, Anytown, ST 00000',
		'hero_title'    => 'XXX Empowering a Sustainable Future with Reliable Custom Electrical Solutions',
		'hero_text'     => 'Engineered power distribution products for ports, terminals, industry and entertainment.',
		'linkedin'      => '#',
		'youtube'       => '#',
	);
}

function powerco_opt( $key ) {
	$d = powerco_defaults();
	return get_theme_mod( $key, $d[ $key ] ?? '' );
}

function powerco_customize( $wp_customize ) {
	$wp_customize->add_section( 'powerco_info', array( 'title' => 'Company Info', 'priority' => 30 ) );
	$labels = array(
		'tagline_small' => 'Logo sub-text',
		'phone_toll'    => 'Toll-free phone',
		'phone_main'    => 'Main phone',
		'email'         => 'Email',
		'address'       => 'Address',
		'hero_title'    => 'Hero title',
		'hero_text'     => 'Hero text',
		'linkedin'      => 'LinkedIn URL',
		'youtube'       => 'YouTube URL',
	);
	foreach ( powerco_defaults() as $key => $default ) {
		$wp_customize->add_setting( $key, array( 'default' => $default, 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $key, array( 'label' => $labels[ $key ], 'section' => 'powerco_info', 'type' => 'text' ) );
	}
}
add_action( 'customize_register', 'powerco_customize' );

/**
 * Simple line icons (Feather-style).
 */
function powerco_icon( $name, $size = 34 ) {
	$paths = array(
		'container' => '<rect x="2" y="6" width="20" height="12" rx="1"/><path d="M6 6v12M10 6v12M14 6v12M18 6v12"/>',
		'ship'      => '<path d="M2 20c2 1 4 1 6 0s4-1 6 0 4 1 6 0"/><path d="M4 17l-1-5h18l-1 5"/><path d="M12 12V4M8 8h8"/>',
		'battery'   => '<rect x="2" y="7" width="18" height="10" rx="2"/><path d="M22 11v2M10 9l-2 3h4l-2 3"/>',
		'music'     => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
		'truck'     => '<rect x="1" y="4" width="14" height="12"/><path d="M15 9h4l3 3v4h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/>',
		'crane'     => '<path d="M4 22V4h16M4 8h12M16 4v8"/><path d="M14 12h4v3h-4z"/><path d="M2 22h8"/>',
		'anchor'    => '<circle cx="12" cy="5" r="3"/><path d="M12 8v14M5 12H2a10 10 0 0 0 20 0h-3"/>',
		'rail'      => '<rect x="5" y="3" width="14" height="13" rx="2"/><path d="M5 10h14M8 19l-2 3M16 19l2 3"/><circle cx="9" cy="13" r="1"/><circle cx="15" cy="13" r="1"/>',
		'plug'      => '<path d="M9 2v6M15 2v6M6 8h12v4a6 6 0 0 1-12 0z"/><path d="M12 18v4"/>',
		'panel'     => '<rect x="3" y="2" width="18" height="20" rx="1"/><path d="M7 6h10M7 10h10"/><circle cx="8" cy="16" r="1.5"/><circle cx="16" cy="16" r="1.5"/>',
		'pin'       => '<path d="M12 22s-7-6.5-7-12a7 7 0 0 1 14 0c0 5.5-7 12-7 12z"/><circle cx="12" cy="10" r="2.5"/>',
		'phone'     => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
		'mail'      => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/>',
		'bolt'      => '<path d="M13 2L3 14h9l-1 8 10-12h-9z"/>',
		'linkedin'  => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/>',
		'youtube'   => '<path d="M22.5 6.4a2.8 2.8 0 0 0-2-2C18.9 4 12 4 12 4s-6.9 0-8.5.4a2.8 2.8 0 0 0-2 2A29 29 0 0 0 1 12a29 29 0 0 0 .5 5.6 2.8 2.8 0 0 0 2 2c1.6.4 8.5.4 8.5.4s6.9 0 8.5-.4a2.8 2.8 0 0 0 2-2A29 29 0 0 0 23 12a29 29 0 0 0-.5-5.6z"/><path d="M10 15l5-3-5-3z"/>',
		'rss'       => '<path d="M4 11a9 9 0 0 1 9 9M4 4a16 16 0 0 1 16 16"/><circle cx="5" cy="19" r="1"/>',
		'search'    => '<circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>',
	);
	$p = $paths[ $name ] ?? $paths['bolt'];
	return '<svg width="' . (int) $size . '" height="' . (int) $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}

/**
 * Product tiles shown on the homepage: slug => [title, icon].
 */
function powerco_products() {
	return array(
		'intermodal-reefer'     => array( 'Intermodal / Reefer', 'container' ),
		'ship-to-shore-power'   => array( 'Shore Power', 'ship' ),
		'emergency-power'       => array( 'Emergency Power', 'battery' ),
		'entertainment-power'   => array( 'Entertainment Power', 'music' ),
		'etru-shore-power'      => array( 'Refrigerated Truck-Trailer Shore Power', 'truck' ),
		'ertg-disconnect'       => array( 'ERTG', 'crane' ),
		'shipyard-power'        => array( 'Shipyard Power', 'anchor' ),
		'wayside-power-cabinets'=> array( 'Wayside Power', 'rail' ),
		'industrial-portable'   => array( 'Industrial / Portable Power', 'plug' ),
		'custom-control-panels' => array( 'Custom Control Panels', 'panel' ),
	);
}

function powerco_page_url( $slug ) {
	$page = get_page_by_path( $slug ) ?: get_page_by_path( 'products/' . $slug );
	return $page ? get_permalink( $page ) : home_url( '/' );
}

/**
 * Fallback menu when none is assigned.
 */
function powerco_fallback_menu() {
	echo '<ul>';
	wp_list_pages( array( 'title_li' => '', 'depth' => 2 ) );
	echo '</ul>';
}

/**
 * Breadcrumbs for inner pages.
 */
function powerco_breadcrumbs() {
	echo '<div class="breadcrumbs"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';
	if ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $id ) {
			echo ' / <a href="' . esc_url( get_permalink( $id ) ) . '">' . esc_html( get_the_title( $id ) ) . '</a>';
		}
	}
	echo ' / ' . esc_html( wp_strip_all_tags( get_the_title() ) ) . '</div>';
}
