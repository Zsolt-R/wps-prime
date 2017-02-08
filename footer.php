<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPS_Prime_2
 */

?>
	<?php content_end();?>
	</div><!-- #content -->

    <?php after_content(); ?>

	<?php before_footer(); ?>

    <footer id="colophon" <?php echo site_footer_class(); ?> role="contentinfo">
    
    	<div class="o-wrapper">
    		<?php get_sidebar( 'footer' );?>
    	</div><!-- wrapper -->

	</footer><!-- #colophon -->

	<?php after_footer(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>