<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wps_prime
 */

get_header(); ?>

	<div id="primary" <?php echo main_class(); ?> data-ui-components="content-area">
        <main id="main" class="site-main" role="main">

            <section class="error-404 not-found">
                <header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wps-prime' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
				<?php if ( current_user_can( 'moderate_comments' ) ) :?>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wps-prime' ); ?></p>
                    
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
                    
				<?php endif; ?>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>
