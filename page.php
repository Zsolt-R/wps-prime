<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * wps_prime_main_layout() // Defined in layouts/layouts.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package wps_prime
 */

get_header(); ?>

	<div id="primary" <?php echo main_class(); ?> data-ui-components="content-area">
        <main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template!
				if ( comments_open() || '0' !== get_comments_number() ) :
					comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
