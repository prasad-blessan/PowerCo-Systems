<?php
// Usage: php setup.php <path-to-wordpress>
$_SERVER['HTTP_HOST']   = 'localhost';
$_SERVER['REQUEST_URI'] = '/';
define( 'WP_USE_THEMES', false );
require rtrim( $argv[1], '/\\' ) . '/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

switch_theme( 'powerco' );
update_option( 'blogname', 'PowerCo Systems' );
update_option( 'blogdescription', 'Reliable Custom Electrical Solutions' );
update_option( 'permalink_structure', '/%postname%/' );

$lorem = '<p>Placeholder content. Replace this text with a description of this offering, its key features, typical applications and specifications.</p>';
function pc_feat( $title ) {
	return "<h2>Overview</h2><p>Placeholder overview for {$title}. Describe the product line, ratings and certifications here.</p>"
		. "<h2>Key Features</h2><ul><li>Rugged, field-proven design</li><li>Built to applicable industry standards</li><li>Custom configurations available</li><li>Engineered and assembled in the USA</li></ul>"
		. "<h2>Applications</h2><p>List typical applications and industries served.</p>"
		. '<p><a class="btn" href="' . home_url( '/request-more-information/' ) . '">Request a Quote</a></p>';
}

$form = '<form onsubmit="alert(\'Demo form — connect a form plugin (e.g. Contact Form 7 / WPForms) to send submissions.\');return false;">'
	. '<input type="text" placeholder="Name" required><input type="text" placeholder="Company"><input type="email" placeholder="Email" required>'
	. '<input type="tel" placeholder="Phone"><select><option>Product of interest</option><option>Intermodal / Reefer</option><option>Shore Power</option><option>Emergency Power</option><option>Other</option></select>'
	. '<textarea rows="5" placeholder="Message"></textarea><button class="btn" type="submit">Submit</button></form>';

// title, slug, parent slug (or null), content
$pages = array(
	array( 'Home', 'home', null, '' ),
	array( 'Products', 'products', null, '<p>Explore our full line of power distribution products. Select a category below.</p>' ),
	array( 'Intermodal / Reefer', 'intermodal-reefer', 'products', pc_feat( 'Intermodal / Reefer power' ) ),
	array( 'Emergency Power', 'emergency-power', 'products', pc_feat( 'Emergency Power' ) ),
	array( 'Ship-to-Shore Power', 'ship-to-shore-power', 'products', pc_feat( 'Ship-to-Shore Power' ) ),
	array( 'eTRU Shore Power', 'etru-shore-power', 'products', pc_feat( 'eTRU Shore Power' ) ),
	array( 'Entertainment Power', 'entertainment-power', 'products', pc_feat( 'Entertainment Power' ) ),
	array( 'Wayside Power Cabinets', 'wayside-power-cabinets', 'products', pc_feat( 'Wayside Power Cabinets' ) ),
	array( 'ERTG Disconnect', 'ertg-disconnect', 'products', pc_feat( 'ERTG Disconnect' ) ),
	array( 'Shipyard Power Distribution Solutions', 'shipyard-power', 'products', pc_feat( 'Shipyard Power Distribution' ) ),
	array( 'Industrial / Portable Power', 'industrial-portable', 'products', pc_feat( 'Industrial / Portable Power' ) ),
	array( 'Custom Control Panels', 'custom-control-panels', 'products', pc_feat( 'Custom Control Panels' ) ),
	array( 'Catalog', 'catalog', null, '<p>Placeholder for the online product catalog. Link or embed your catalog here.</p>' ),
	array( 'Custom Solutions', 'custom-solutions', null, '<p>Need something unique? Our engineering team designs custom power solutions to your specifications.</p><h2>Our Process</h2><ol><li>Consultation &amp; requirements</li><li>Engineering &amp; design</li><li>Manufacturing &amp; testing</li><li>Delivery &amp; support</li></ol>' ),
	array( 'Videos', 'videos', null, '<p>Placeholder for product and company videos. Paste YouTube links here to embed them.</p>' ),
	array( 'Company', 'company', null, '<p>Learn more about who we are.</p>' ),
	array( 'About', 'about', 'company', '<h2>Who We Are</h2>' . $lorem . '<h2>100% Employee Owned</h2><p>Placeholder text about ownership culture and core values.</p>' ),
	array( 'Press Releases / Articles', 'press-releases', 'company', '<p>Placeholder for news, press releases and published articles.</p>' ),
	array( 'Webinars', 'webinars', 'company', '<p>Placeholder for upcoming and on-demand webinars.</p>' ),
	array( 'Blog', 'blog', null, '' ),
	array( 'Contact', 'contact', null, '<p>Get in touch with our team.</p>' ),
	array( 'Contact Information', 'contact-information', 'contact', '<p><strong>Address:</strong> 123 Industrial Way, Anytown, ST 00000<br><strong>Toll free:</strong> (800) 555-0100<br><strong>Phone:</strong> +1 (555) 555-0123<br><strong>Email:</strong> info@example.com</p>' ),
	array( 'How to Buy', 'how-to-buy', 'contact', '<p>Placeholder: explain ordering, distributors and sales representatives by region.</p>' ),
	array( 'Request More Information', 'request-more-information', 'contact', '<p>Fill out the form and a specialist will contact you.</p>' . $form ),
	array( 'Careers', 'careers', null, '<h2>Join Our Team</h2><p>Placeholder for open positions, benefits and company culture.</p>' ),
	array( 'Privacy Policy', 'privacy-policy', null, '<p>Placeholder privacy policy.</p>' ),
	array( 'Terms of Use', 'terms-of-use', null, '<p>Placeholder terms of use.</p>' ),
);

$ids = array();
foreach ( $pages as $order => $p ) {
	$ids[ $p[1] ] = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $p[0],
		'post_name'    => $p[1],
		'post_content' => $p[3],
		'post_parent'  => $p[2] ? $ids[ $p[2] ] : 0,
		'menu_order'   => $order,
	) );
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $ids['home'] );
update_option( 'page_for_posts', $ids['blog'] );
update_option( 'wp_page_for_privacy_policy', $ids['privacy-policy'] );

// Sample blog post
wp_insert_post( array(
	'post_status'  => 'publish',
	'post_title'   => 'Welcome to Our New Website',
	'post_content' => '<p>Placeholder blog post. Replace with company news and insights.</p>',
) );

// Primary menu
$menu_id = wp_create_nav_menu( 'Primary' );
$menu_items = array();
$add = function ( $slug, $parent = 0, $title = '' ) use ( $menu_id, $ids, &$menu_items ) {
	$menu_items[ $slug ] = wp_update_nav_menu_item( $menu_id, 0, array(
		'menu-item-object-id' => $ids[ $slug ],
		'menu-item-object'    => 'page',
		'menu-item-type'      => 'post_type',
		'menu-item-status'    => 'publish',
		'menu-item-parent-id' => $parent,
		'menu-item-title'     => $title,
	) );
	return $menu_items[ $slug ];
};
$add( 'home' );
$prod = $add( 'products' );
foreach ( array( 'intermodal-reefer', 'emergency-power', 'ship-to-shore-power', 'etru-shore-power', 'entertainment-power', 'wayside-power-cabinets', 'ertg-disconnect', 'shipyard-power', 'industrial-portable', 'custom-control-panels' ) as $s ) {
	$add( $s, $prod );
}
$add( 'catalog' );
$add( 'custom-solutions' );
$add( 'videos' );
$co = $add( 'company' );
foreach ( array( 'about', 'press-releases', 'webinars' ) as $s ) {
	$add( $s, $co );
}
$add( 'blog' );
$ct = $add( 'contact' );
foreach ( array( 'contact-information', 'how-to-buy', 'request-more-information' ) as $s ) {
	$add( $s, $ct );
}
$add( 'careers' );

// Footer menu
$footer_id = wp_create_nav_menu( 'Footer' );
foreach ( array( 'about', 'how-to-buy', 'careers', 'contact-information' ) as $s ) {
	wp_update_nav_menu_item( $footer_id, 0, array(
		'menu-item-object-id' => $ids[ $s ],
		'menu-item-object'    => 'page',
		'menu-item-type'      => 'post_type',
		'menu-item-status'    => 'publish',
	) );
}

set_theme_mod( 'nav_menu_locations', array( 'primary' => $menu_id, 'footer' => $footer_id ) );
flush_rewrite_rules( true );

echo 'Pages: ' . count( $ids ) . "\nTheme: " . get_stylesheet() . "\nDone\n";
