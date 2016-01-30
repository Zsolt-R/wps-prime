<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wps_prime
 *
 * wps_prime_main_layout() // Defined in layouts/layouts.php
 */

get_header(); ?>

	<section id="primary" <?php echo main_class(); ?> data-ui-components="content-area">
        <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                <?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
            </header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php wps_prime_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
