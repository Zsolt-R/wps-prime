<?php
/**
 * Footer Sidebars.
 *
 * @package wps_prime
 */

?>

<?php
if ( ! (is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) ) {
	return;
}
?>
<div class="grid-1">
    <div class="col _lap-6 _desktop-3">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
        </div>
    </div>
    <div class="col _lap-6 _desktop-3">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
        </div>
    </div>
    <div class="col _lap-6 _desktop-3">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
        </div>
    </div>
    <div class="col _lap-6 _desktop-3">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
        </div>
    </div>
</div>
