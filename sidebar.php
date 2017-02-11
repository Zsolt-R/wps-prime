<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WPS_Prime_2
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" <?php echo wps_main_sidebar_class(); ?> role="complementary">
	<?php wps_sidebar_start(); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php wps_sidebar_end(); ?>
</aside><!-- #secondary -->