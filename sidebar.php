<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package wps_prime
 *
 * wps_prime_sidebar_layout() // Defined in layouts/layouts.php
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" <?php sidebar_class(); ?> data-ui-components="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
