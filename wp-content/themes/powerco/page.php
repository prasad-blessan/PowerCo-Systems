<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="page-banner">
		<div class="container">
			<h1><?php the_title(); ?></h1>
			<?php powerco_breadcrumbs(); ?>
		</div>
	</section>

	<div class="container entry">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php
		$children = get_pages( array( 'parent' => get_the_ID(), 'sort_column' => 'menu_order' ) );
		if ( $children ) :
			?>
			<div class="tiles child-pages">
				<?php foreach ( $children as $child ) : ?>
					<a class="tile" href="<?php echo esc_url( get_permalink( $child ) ); ?>">
						<div class="tile-icon"><?php echo powerco_icon( 'bolt' ); ?></div>
						<h3><?php echo esc_html( $child->post_title ); ?></h3>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>
