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
	<?php wps_content_end();?>
	</div><!-- #content -->

    <?php wps_after_content(); ?>

	<?php wps_before_footer(); ?>

    <footer id="colophon" <?php echo wps_site_footer_class(); ?> role="contentinfo">
    	<?php wps_footer_start(); ?>
    
    	<div class="o-wrapper">
    		<?php get_sidebar( 'footer' );?>
    	</div><!-- wrapper -->

    	<?php wps_footer_end(); ?>
	</footer><!-- #colophon -->

	<?php wps_after_footer(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>