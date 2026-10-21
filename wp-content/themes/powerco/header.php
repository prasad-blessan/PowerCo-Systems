<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="topbar">
	<div class="container">
		<div><?php esc_html_e( 'Call us:', 'powerco' ); ?> <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', powerco_opt( 'phone_toll' ) ) ); ?>"><?php echo esc_html( powerco_opt( 'phone_toll' ) ); ?></a></div>
		<div class="topbar-actions">
			<a class="btn" href="<?php echo esc_url( powerco_page_url( 'request-more-information' ) ); ?>"><?php esc_html_e( 'Request a Quote', 'powerco' ); ?></a>
			<a class="btn btn-outline" href="<?php echo esc_url( powerco_page_url( 'careers' ) ); ?>"><?php esc_html_e( 'Careers', 'powerco' ); ?></a>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( powerco_home_url() ); ?>">
				<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'powerco' ); ?></label>
				<input type="search" id="s" name="s" placeholder="<?php esc_attr_e( 'Search…', 'powerco' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'powerco' ); ?>"><?php echo powerco_icon( 'search', 16 ); ?></button>
			</form>
			<?php powerco_language_switcher(); ?>
		</div>
	</div>
</div>

<header class="site-header">
	<div class="container">
		<a class="logo" href="<?php echo esc_url( powerco_home_url() ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'medium' ); ?>
			<?php else : ?>
				<span class="logo-mark"><?php echo powerco_icon( 'bolt', 24 ); ?></span>
				<span><?php bloginfo( 'name' ); ?><small><?php echo esc_html( powerco_opt( 'tagline_small' ) ); ?></small></span>
			<?php endif; ?>
		</a>
		<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'powerco' ); ?>" aria-expanded="false">&#9776;</button>
		<nav class="main-nav" aria-label="Primary">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => 'powerco_fallback_menu',
			) );
			?>
		</nav>
	</div>
</header>
