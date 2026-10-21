<footer class="site-footer">
	<div class="container footer-top">
		<div>
			<h4><?php bloginfo( 'name' ); ?></h4>
			<p><?php echo esc_html( powerco_opt( 'address' ) ); ?><br>
			<?php esc_html_e( 'Toll free:', 'powerco' ); ?> <?php echo esc_html( powerco_opt( 'phone_toll' ) ); ?><br>
			<?php esc_html_e( 'Phone:', 'powerco' ); ?> <?php echo esc_html( powerco_opt( 'phone_main' ) ); ?><br>
			<a href="mailto:<?php echo esc_attr( powerco_opt( 'email' ) ); ?>"><?php echo esc_html( powerco_opt( 'email' ) ); ?></a></p>
			<div class="social">
				<a href="<?php echo esc_url( powerco_opt( 'linkedin' ) ); ?>" aria-label="LinkedIn"><?php echo powerco_icon( 'linkedin', 18 ); ?></a>
				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" aria-label="RSS"><?php echo powerco_icon( 'rss', 18 ); ?></a>
				<a href="<?php echo esc_url( powerco_opt( 'youtube' ) ); ?>" aria-label="YouTube"><?php echo powerco_icon( 'youtube', 18 ); ?></a>
			</div>
			<span class="badge"><?php esc_html_e( 'MADE IN USA', 'powerco' ); ?></span>
		</div>
		<div>
			<h4><?php esc_html_e( 'Products', 'powerco' ); ?></h4>
			<ul>
				<?php foreach ( array_slice( powerco_products(), 0, 6, true ) as $slug => $p ) : ?>
					<li><a href="<?php echo esc_url( powerco_page_url( $slug ) ); ?>"><?php echo esc_html( $p[0] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<h4><?php esc_html_e( 'Have a question?', 'powerco' ); ?></h4>
			<p><?php esc_html_e( 'Our team is ready to help you find the right solution.', 'powerco' ); ?></p>
			<a class="btn" href="<?php echo esc_url( powerco_page_url( 'request-more-information' ) ); ?>"><?php esc_html_e( 'Request Info', 'powerco' ); ?></a>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => false,
				'items_wrap'     => '<ul style="margin-top:16px">%3$s</ul>',
			) );
			?>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<span><?php esc_html_e( 'Copyright', 'powerco' ); ?> &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> | <?php bloginfo( 'name' ); ?></span>
			<span><a href="<?php echo esc_url( powerco_page_url( 'privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'powerco' ); ?></a> | <a href="<?php echo esc_url( powerco_page_url( 'terms-of-use' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'powerco' ); ?></a></span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
