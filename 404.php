<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WPS_Prime_2
 */

get_header(); ?>

	<div id="primary" <?php echo wps_main_content_class(); ?>>
		<main id="main" class="site-main" role="main">
	
        <?php if( get_option('wps_404_custom_page') ): ?>
        	<?php get_template_part( 'template-parts/content', 'custom-404' ); ?>           

        <?php else: ?>

			<?php get_template_part( 'template-parts/content', 'default-404' ); ?>            

        <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
