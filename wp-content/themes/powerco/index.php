<?php get_header(); ?>

<section class="page-banner">
	<div class="container">
		<h1>
			<?php
			if ( is_search() ) {
				printf( 'Search results for &ldquo;%s&rdquo;', esc_html( get_search_query() ) );
			} elseif ( is_archive() ) {
				echo esc_html( wp_strip_all_tags( get_the_archive_title() ) );
			} elseif ( is_singular() ) {
				the_title();
			} else {
				echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ?: 'Blog' );
			}
			?>
		</h1>
	</div>
</section>

<div class="container entry">
	<div class="entry-content post-list">
		<?php if ( is_singular() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<p><small><?php echo esc_html( get_the_date() ); ?></small></p>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php elseif ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<small><?php echo esc_html( get_the_date() ); ?></small>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p>Nothing found.</p>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>
