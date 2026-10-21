<?php
/**
 * One-time setup: Spanish (es) translations for every page, Spanish menus and
 * Spanish Customizer texts, linked to the English versions with Polylang.
 * Safe to run again: pages and menus that already exist are skipped.
 *
 * Requires Polylang active with English (en) and Spanish (es) languages.
 * Usage: C:\xampp\php\php.exe setup\polylang-es.php C:\xampp\htdocs\wordpress-web
 */
$_SERVER['HTTP_HOST']   = 'localhost';
$_SERVER['REQUEST_URI'] = '/';
define( 'WP_USE_THEMES', false );
require rtrim( $argv[1], '/\\' ) . '/wp-load.php';

if ( ! function_exists( 'pll_save_post_translations' ) || ! in_array( 'es', pll_languages_list(), true ) ) {
	exit( "Polylang with English and Spanish languages is required.\n" );
}

function es_feat( $title ) {
	return "<h2>Descripción general</h2><p>Descripción de ejemplo para {$title}. Describa aquí la línea de productos, las capacidades y las certificaciones.</p>"
		. '<h2>Características principales</h2><ul><li>Diseño robusto y probado en campo</li><li>Fabricado según las normas aplicables de la industria</li><li>Configuraciones a medida disponibles</li><li>Diseñado y ensamblado en EE. UU.</li></ul>'
		. '<h2>Aplicaciones</h2><p>Enumere las aplicaciones e industrias típicas.</p>'
		. '<p><a class="btn" href="{{request}}">Solicitar cotización</a></p>';
}

$form = '<form onsubmit="alert(\'Formulario de demostración: conecte un plugin de formularios para enviar mensajes.\');return false;">'
	. '<input type="text" placeholder="Nombre" required><input type="text" placeholder="Empresa"><input type="email" placeholder="Correo electrónico" required>'
	. '<input type="tel" placeholder="Teléfono"><select><option>Producto de interés</option><option>Intermodal / Refrigerados</option><option>Energía en puerto</option><option>Energía de emergencia</option><option>Otro</option></select>'
	. '<textarea rows="5" placeholder="Mensaje"></textarea><button class="btn" type="submit">Enviar</button></form>';

// English slug => [Spanish title, Spanish slug, Spanish content]
$pages = array(
	'home'                     => array( 'Inicio', 'inicio', '' ),
	'products'                 => array( 'Productos', 'productos', '<p>Explore nuestra línea completa de productos de distribución eléctrica. Seleccione una categoría a continuación.</p>' ),
	'intermodal-reefer'        => array( 'Intermodal / Refrigerados', 'intermodal-refrigerados', es_feat( 'energía intermodal / refrigerados' ) ),
	'emergency-power'          => array( 'Energía de emergencia', 'energia-de-emergencia', es_feat( 'energía de emergencia' ) ),
	'ship-to-shore-power'      => array( 'Energía de barco a tierra', 'energia-barco-a-tierra', es_feat( 'energía de barco a tierra' ) ),
	'etru-shore-power'         => array( 'Energía en puerto eTRU', 'energia-en-puerto-etru', es_feat( 'energía en puerto eTRU' ) ),
	'entertainment-power'      => array( 'Energía para entretenimiento', 'energia-entretenimiento', es_feat( 'energía para entretenimiento' ) ),
	'wayside-power-cabinets'   => array( 'Gabinetes de energía ferroviaria', 'gabinetes-energia-ferroviaria', es_feat( 'gabinetes de energía ferroviaria' ) ),
	'ertg-disconnect'          => array( 'Desconexión ERTG', 'desconexion-ertg', es_feat( 'desconexión ERTG' ) ),
	'shipyard-power'           => array( 'Soluciones de distribución para astilleros', 'distribucion-astilleros', es_feat( 'distribución eléctrica para astilleros' ) ),
	'industrial-portable'      => array( 'Energía industrial / portátil', 'energia-industrial-portatil', es_feat( 'energía industrial / portátil' ) ),
	'custom-control-panels'    => array( 'Paneles de control a medida', 'paneles-de-control', es_feat( 'paneles de control a medida' ) ),
	'catalog'                  => array( 'Catálogo', 'catalogo', '<p>Espacio para el catálogo de productos en línea. Enlace o inserte aquí su catálogo.</p>' ),
	'custom-solutions'         => array( 'Soluciones a medida', 'soluciones-a-medida', '<p>¿Necesita algo único? Nuestro equipo de ingeniería diseña soluciones eléctricas según sus especificaciones.</p><h2>Nuestro proceso</h2><ol><li>Consulta y requisitos</li><li>Ingeniería y diseño</li><li>Fabricación y pruebas</li><li>Entrega y soporte</li></ol>' ),
	'videos'                   => array( 'Videos', 'videos-es', '<p>Espacio para videos de productos y de la empresa. Pegue aquí enlaces de YouTube para insertarlos.</p>' ),
	'company'                  => array( 'Empresa', 'empresa', '<p>Conozca más sobre quiénes somos.</p>' ),
	'about'                    => array( 'Sobre nosotros', 'sobre-nosotros', '<h2>Quiénes somos</h2><p>Contenido de ejemplo. Reemplace este texto con la historia, capacidades y mercados de la empresa.</p><h2>100% propiedad de los empleados</h2><p>Texto de ejemplo sobre la cultura de propiedad y los valores fundamentales.</p>' ),
	'press-releases'           => array( 'Comunicados de prensa / Artículos', 'comunicados-de-prensa', '<p>Espacio para noticias, comunicados de prensa y artículos publicados.</p>' ),
	'webinars'                 => array( 'Seminarios web', 'seminarios-web', '<p>Espacio para seminarios web próximos y bajo demanda.</p>' ),
	'blog'                     => array( 'Blog', 'blog-es', '' ),
	'contact'                  => array( 'Contacto', 'contacto', '<p>Póngase en contacto con nuestro equipo.</p>' ),
	'contact-information'      => array( 'Información de contacto', 'informacion-de-contacto', '<p><strong>Dirección:</strong> 123 Industrial Way, Anytown, ST 00000<br><strong>Línea gratuita:</strong> (800) 555-0100<br><strong>Teléfono:</strong> +1 (555) 555-0123<br><strong>Correo electrónico:</strong> info@example.com</p>' ),
	'how-to-buy'               => array( 'Cómo comprar', 'como-comprar', '<p>Explique aquí el proceso de pedido, los distribuidores y los representantes de ventas por región.</p>' ),
	'request-more-information' => array( 'Solicitar más información', 'solicitar-informacion', '<p>Complete el formulario y un especialista se pondrá en contacto con usted.</p>' . $form ),
	'careers'                  => array( 'Empleo', 'empleo', '<h2>Únase a nuestro equipo</h2><p>Espacio para vacantes, beneficios y cultura de la empresa.</p>' ),
	'privacy-policy'           => array( 'Política de privacidad', 'politica-de-privacidad', '<p>Política de privacidad de ejemplo.</p>' ),
	'terms-of-use'             => array( 'Términos de uso', 'terminos-de-uso', '<p>Términos de uso de ejemplo.</p>' ),
);

function en_page( $slug ) {
	$found = get_posts( array( 'post_type' => 'page', 'name' => $slug, 'numberposts' => 1, 'post_status' => 'any', 'lang' => '' ) );
	return $found ? $found[0] : null;
}

// Pass 1: create or reuse the Spanish page for each English page (parents come first in the list).
$es_ids = array();
foreach ( $pages as $slug => $p ) {
	$en = en_page( $slug );
	if ( ! $en ) {
		echo "skip (no English page): $slug\n";
		continue;
	}
	pll_set_post_language( $en->ID, 'en' );
	$es_id = pll_get_post( $en->ID, 'es' );
	if ( $es_id ) {
		// Already translated: only fix the auto-created Spanish homepage's title/slug.
		if ( 'home' === $slug ) {
			wp_update_post( array( 'ID' => $es_id, 'post_title' => $p[0], 'post_name' => $p[1] ) );
		}
		echo "exists: $slug -> $es_id\n";
	} else {
		$parent_es = $en->post_parent ? pll_get_post( $en->post_parent, 'es' ) : 0;
		$es_id     = wp_insert_post( array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $p[0],
			'post_name'    => $p[1],
			'post_content' => $p[2],
			'post_parent'  => $parent_es ?: 0,
			'menu_order'   => $en->menu_order,
		) );
		pll_set_post_language( $es_id, 'es' );
		pll_save_post_translations( array( 'en' => $en->ID, 'es' => $es_id ) );
		echo "created: $slug -> $es_id\n";
	}
	$es_ids[ $slug ] = $es_id;
}

// Pass 2: point in-content quote buttons at the Spanish request page.
if ( isset( $es_ids['request-more-information'] ) ) {
	$request = get_permalink( $es_ids['request-more-information'] );
	foreach ( $es_ids as $id ) {
		$post = get_post( $id );
		if ( false !== strpos( $post->post_content, '{{request}}' ) ) {
			wp_update_post( array( 'ID' => $id, 'post_content' => str_replace( '{{request}}', $request, $post->post_content ) ) );
		}
	}
}

// Spanish menus mirroring the English ones.
function mirror_menu( $en_name, $es_name ) {
	$en = wp_get_nav_menu_object( $en_name );
	if ( ! $en ) {
		return 0;
	}
	$es = wp_get_nav_menu_object( $es_name );
	if ( $es ) {
		echo "menu exists: $es_name\n";
		return $es->term_id;
	}
	$es_id = wp_create_nav_menu( $es_name );
	$map   = array();
	foreach ( wp_get_nav_menu_items( $en->term_id ) as $item ) {
		$target = 'page' === $item->object ? pll_get_post( (int) $item->object_id, 'es' ) : 0;
		if ( ! $target ) {
			continue;
		}
		$map[ $item->ID ] = wp_update_nav_menu_item( $es_id, 0, array(
			'menu-item-object-id' => $target,
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $map[ (int) $item->menu_item_parent ] ?? 0,
			'menu-item-position'  => $item->menu_order,
		) );
	}
	echo "menu created: $es_name (" . count( $map ) . " items)\n";
	return $es_id;
}
$primary_es = mirror_menu( 'Primary', 'Primary ES' );
$footer_es  = mirror_menu( 'Footer', 'Footer ES' );

$opts  = get_option( 'polylang' );
$theme = get_stylesheet();
$opts['nav_menus'][ $theme ]['primary']['en'] = wp_get_nav_menu_object( 'Primary' )->term_id;
$opts['nav_menus'][ $theme ]['footer']['en']  = wp_get_nav_menu_object( 'Footer' )->term_id;
$opts['nav_menus'][ $theme ]['primary']['es'] = $primary_es;
$opts['nav_menus'][ $theme ]['footer']['es']  = $footer_es;
$opts['redirect_lang']                         = 1;
update_option( 'polylang', $opts );

// Spanish Customizer texts (Languages > Translations).
$defaults = powerco_defaults();
$hero     = get_theme_mod( 'hero_title', $defaults['hero_title'] );
$strings  = array(
	get_theme_mod( 'tagline_small', $defaults['tagline_small'] ) => 'Sistemas de energía',
	$hero => str_replace(
		'Empowering a Sustainable Future with Reliable Custom Electrical Solutions',
		'Impulsando un futuro sostenible con soluciones eléctricas confiables y a medida',
		$hero
	),
	get_theme_mod( 'hero_text', $defaults['hero_text'] ) => 'Productos de distribución eléctrica para puertos, terminales, industria y entretenimiento.',
);
$lang = PLL()->model->get_language( 'es' );
$mo   = new PLL_MO();
$mo->import_from_db( $lang );
foreach ( $strings as $en => $es ) {
	$mo->add_entry( $mo->make_entry( $en, $es ) );
}
$mo->export_to_db( $lang );

delete_transient( 'pll_languages_list' );
flush_rewrite_rules( true );
echo "Spanish pages: " . count( $es_ids ) . "\nDone\n";
