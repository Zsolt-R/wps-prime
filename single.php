<?php
/**
 * The template for displaying all single posts.
 *
 * @package wps_prime
 *
 * wps_prime_main_layout() // Defined in layouts/layouts.php
 */

get_header(); ?>

	<div id="primary" <?php main_class(); ?> data-ui-components="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php wps_prime_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>