<?php get_header(); ?>

<section class="hero">
	<div class="container">
		<h1><?php echo esc_html( powerco_opt( 'hero_title' ) ); ?></h1>
		<p><?php echo esc_html( powerco_opt( 'hero_text' ) ); ?></p>
		<a class="btn" href="<?php echo esc_url( powerco_page_url( 'products' ) ); ?>">Our Products</a>
		<a class="btn btn-outline" href="<?php echo esc_url( powerco_page_url( 'request-more-information' ) ); ?>">Request a Quote</a>
	</div>
</section>

<section class="section section-alt">
	<div class="container">
		<div class="section-title"><h2>Our Products</h2></div>
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
		<div class="section-title"><h2>What Our Customers Say</h2></div>
		<div class="testimonials" data-slider>
			<?php
			$quotes = array(
				array( 'The equipment arrived on schedule and has run flawlessly since installation.', 'Operations Manager, Container Terminal' ),
				array( 'Their engineering team worked with us to design exactly what our facility needed.', 'Facilities Director, Manufacturing Plant' ),
				array( 'Outstanding quality and responsive support every step of the way.', 'Project Engineer, Port Authority' ),
				array( 'Reliable power for every show, in every venue, every time.', 'Production Manager, Live Events' ),
				array( 'A true partner — knowledgeable, flexible and easy to work with.', 'Procurement Lead, Shipyard' ),
				array( 'Their shore power solution helped us cut emissions at berth significantly.', 'Environmental Manager, Marine Terminal' ),
				array( 'Custom panels built right the first time. We will be back.', 'Electrical Contractor' ),
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
			<h2>OWN IT!</h2>
			<div class="big-stat">100%</div>
			<p><strong>Employee owned.</strong> Every team member has a stake in the quality of what we build and the service we deliver.</p>
			<a class="btn" href="<?php echo esc_url( powerco_page_url( 'about' ) ); ?>">About Us</a>
		</div>
		<div>
			<h3 style="color:#fff">Our Core Values</h3>
			<ul class="values">
				<li>Integrity</li>
				<li>Quality</li>
				<li>Innovation</li>
				<li>Customer Focus</li>
				<li>Teamwork</li>
				<li>Sustainability</li>
			</ul>
		</div>
	</div>
</section>

<section class="careers-banner">
	<div class="container">
		<h2>Join Our Team</h2>
		<p>Build a career powering a more sustainable future.</p>
		<a class="btn btn-outline" href="<?php echo esc_url( powerco_page_url( 'careers' ) ); ?>">View Careers</a>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-title"><h2>Contact Us</h2></div>
		<div class="contact-grid">
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'pin' ); ?></div>
				<h3>Address</h3>
				<p><?php echo esc_html( powerco_opt( 'address' ) ); ?></p>
			</div>
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'phone' ); ?></div>
				<h3>Phone</h3>
				<p>Toll free: <?php echo esc_html( powerco_opt( 'phone_toll' ) ); ?><br><?php echo esc_html( powerco_opt( 'phone_main' ) ); ?></p>
			</div>
			<div>
				<div class="tile-icon"><?php echo powerco_icon( 'mail' ); ?></div>
				<h3>Email</h3>
				<p><a href="mailto:<?php echo esc_attr( powerco_opt( 'email' ) ); ?>"><?php echo esc_html( powerco_opt( 'email' ) ); ?></a></p>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
