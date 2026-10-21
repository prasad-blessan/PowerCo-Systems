<?php get_header(); ?>

<section class="hero">
	<div class="container">
		<h1><?php echo esc_html( powerco_opt( 'hero_title' ) ); ?></h1>
		<p><?php echo esc_html( powerco_opt( 'hero_text' ) ); ?></p>
		<a class="btn" href="<?php echo esc_url( powerco_page_url( 'products' ) ); ?>"><?php esc_html_e( 'Our Products', 'powerco' ); ?></a>
		<a class="btn btn-outline" href="<?php echo esc_url( powerco_page_url( 'request-more-information' ) ); ?>"><?php esc_html_e( 'Request a Quote', 'powerco' ); ?></a>
	</div>
</section>

<section class="section section-alt">
	<div class="container">
		<div class="section-title"><h2><?php esc_html_e( 'Our Products', 'powerco' ); ?></h2></div>
		<div class="tiles">
			<?php foreach ( powerco_products() as $slug => $p ) : ?>
				<a class="tile" href="<?php echo esc_url( powerco_page_url( $slug ) ); ?>">
					<div class="tile-icon"><?php echo powerco_icon( $p[1] ); ?></div>
					<h3><?php echo esc_html( $p[0] ); ?></h3>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-title"><h2><?php esc_html_e( 'What Our Customers Say', 'powerco' ); ?></h2></div>
		<div class="testimonials" data-slider>
			<?php
			$quotes = array(
				array( __( 'The equipment arrived on schedule and has run flawlessly since installation.', 'powerco' ), __( 'Operations Manager, Container Terminal', 'powerco' ) ),
				array( __( 'Their engineering team worked with us to design exactly what our facility needed.', 'powerco' ), __( 'Facilities Director, Manufacturing Plant', 'powerco' ) ),
				array( __( 'Outstanding quality and responsive support every step of the way.', 'powerco' ), __( 'Project Engineer, Port Authority', 'powerco' ) ),
				array( __( 'Reliable power for every show, in every venue, every time.', 'powerco' ), __( 'Production Manager, Live Events', 'powerco' ) ),
				array( __( 'A true partner — knowledgeable, flexible and easy to work with.', 'powerco' ), __( 'Procurement Lead, Shipyard', 'powerco' ) ),
				array( __( 'Their shore power solution helped us cut emissions at berth significantly.', 'powerco' ), __( 'Environmental Manager, Marine Terminal', 'powerco' ) ),
				array( __( 'Custom panels built right the first time. We will be back.', 'powerco' ), __( 'Electrical Contractor', 'powerco' ) ),
			);
			foreach ( $quotes as $i => $q ) :
				?>
				<div class="testimonial<?php echo 0 === $i ? ' active' : ''; ?>">
					<blockquote>&ldquo;<?php echo esc_html( $q[0] ); ?>&rdquo;</blockquote>
					<cite>&mdash; <?php echo esc_html( $q[1] ); ?></cite>
				</div>
			<?php endforeach; ?>
			<div class="dots"></div>
		</div>
	</div>
</section>

<section class="section own-it">
	<div class="container grid">
		<div>
			<h2><?php esc_html_e( 'OWN IT!', 'powerco' ); ?></h2>
			<div class="big-stat">100%</div>
			<p><strong><?php esc_html_e( 'Employee owned.', 'powerco' ); ?></strong> <?php esc_html_e( 'Every team member has a stake in the quality of what we build and the service we deliver.', 'powerco' ); ?></p>
			<a class="btn" href="<?php echo esc_url( powerco_page_url( 'about' ) ); ?>"><?php esc_html_e( 'About Us', 'powerco' ); ?></a>
		</div>
		<div>
			<h3 style="color:#fff"><?php esc_html_e( 'Our Core Values', 'powerco' ); ?></h3>
			<ul class="values">
				<li><?php esc_html_e( 'Integrity', 'powerco' ); ?></li>
				<li><?php esc_html_e( 'Quality', 'powerco' ); ?></li>
				<li><?php esc_html_e( 'Innovation', 'powerco' ); ?></li>
				<li><?php esc_html_e( 'Customer Focus', 'powerco' ); ?></li>
				<li><?php esc_html_e( 'Teamwork', 'powerco' ); ?></li>
				<li><?php esc_html_e( 'Sustainability', 'powerco' ); ?></li>
			</ul>
		</div>
	</div>
</section>

<section class="careers-banner">
	<div class="container">
		<h2><?php esc_html_e( 'Join Our Team', 'powerco' ); ?></h2>
		<p><?php esc_html_e( 'Build a career powering a more sustainable future.', 'powerco' ); ?></p>
		<a class="btn btn-outline" href="<?php echo esc_url( powerco_page_url( 'careers' ) ); ?>"><?php esc_html_e( 'View Careers', 'powerco' ); ?></a>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-title"><h2><?php esc_html_e( 'Contact Us', 'powerco' ); ?></h2></div>
		<div class="contact-grid">
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'pin' ); ?></div>
				<h3><?php esc_html_e( 'Address', 'powerco' ); ?></h3>
				<p><?php echo esc_html( powerco_opt( 'address' ) ); ?></p>
			</div>
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'phone' ); ?></div>
				<h3><?php esc_html_e( 'Phone', 'powerco' ); ?></h3>
				<p><?php esc_html_e( 'Toll free:', 'powerco' ); ?> <?php echo esc_html( powerco_opt( 'phone_toll' ) ); ?><br><?php echo esc_html( powerco_opt( 'phone_main' ) ); ?></p>
			</div>
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'mail' ); ?></div>
				<h3><?php esc_html_e( 'Email', 'powerco' ); ?></h3>
				<p><a href="mailto:<?php echo esc_attr( powerco_opt( 'email' ) ); ?>"><?php echo esc_html( powerco_opt( 'email' ) ); ?></a></p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
