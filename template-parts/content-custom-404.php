<?php
/**
 * Template part for displaying single posts.
 *
 * @package wps_prime
 */

$pageID = wps_get_theme_option('404_custom_page');
$title_vis = true;
?>

<?php if( 'page' === get_post_type( $pageID ) ): // Safety check 

	/* Query the 404 page selected from the theme options panel */
	$new_query = new WP_Query(array('page_id' => $pageID)); 

	if ( $new_query->have_posts() ) : 
	
	while ( $new_query->have_posts() ) : $new_query->the_post();		
	
	$show_title = get_post_meta(get_the_ID(),'page_title_visibility',true);
	
	if(isset($show_title)){
		$title_vis = $show_title == 'hide' ? $title_vis = false : true;
	}
	
	?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php if($title_vis){ ?>
	
	    <header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	    </header><!-- .entry-header -->
	    <?php }?>
	
	    <div class="entry-content">
			<?php the_content(); ?>
	
			
	    </div><!-- .entry-content -->
	
	</article><!-- #post-## -->
	
	<?php endwhile; // End of the loop. 
	wp_reset_postdata();  // Restore global post data stomped by the_post().
	?>

	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.','wps-prime' ); ?></p>
	<?php endif; ?>


<?php else: ?>

	<?php get_template_part( 'template-parts/content', 'default-404' ); ?>

<?php endif; ?>