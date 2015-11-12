<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wps_prime
 */
?>
		<?php content_end();?>
	</div><!-- #content -->

		<?php footer_start(); ?>

	<footer id="colophon" class="site-footer band band--tint" role="contentinfo">		
		<div class="wrapper">
		<?php get_sidebar('footer');?>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
	
		<?php footer_end(); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
