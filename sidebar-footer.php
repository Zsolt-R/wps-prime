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
<div class="layout">
    <div class="layout__item lap-2/4 desk-1/4">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-1' ); ?>
        </div>
    </div>
    <div class="layout__item lap-2/4 desk-1/4">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
        </div>
    </div>
    <div class="layout__item lap-2/4 desk-1/4">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
        </div>
    </div>
    <div class="layout__item lap-2/4 desk-1/4">
        <div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-footer-4' ); ?>
        </div>
    </div>
</div>
