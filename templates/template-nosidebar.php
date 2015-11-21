<?php
/**
 * Template Name: No Sidebar
 *
 * @package wps_prime
 */

get_header(); ?>
<div id="primary" <?php main_class(); ?> data-ui-components="content-area">
        <main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php
					/**
				     * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'page' );
				?>

            <?php endwhile; ?>

            <?php wps_prime_paging_nav(); ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php get_footer();?>
