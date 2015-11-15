<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package wps_prime
 */

$article_display_mode = wps_get_theme_option( 'archive_article_display_mode' );
$ft_img_display = wps_get_theme_option( 'archive_article_feat_img' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
			<?php wps_prime_posted_on(); ?>
        </div><!-- .entry-meta -->
		<?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php
		if ( ! $article_display_mode || ('show_full' === $article_display_mode) ) {

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wps-prime' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

		} else {
			?> <div class="media media--responsive"><div class="media__img"> 
					<?php entry_content_media_img(); ?>
					<?php
					if ( $ft_img_display ) { echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'aligncenter' ) );	}
					?>
					</div><div class="media__body"> 
					<?php entry_content_media_body(); ?>
				<?php

				the_excerpt();

			?> </div>
			</div> <?php
		} // End content display mode
		?>
        
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' .esc_html__( 'Pages:', 'wps-prime' ),
				'after'  => '</div>',
			) );
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php wps_prime_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
