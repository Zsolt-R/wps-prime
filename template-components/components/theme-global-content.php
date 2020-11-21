<?php
/**
 * Global Content
 *
 * @package wps_prime
 */


function wps_theme_global_content_end_area() {
	$area = get_option( 'wps_global_content_end_area' );
	if ( ! $area ) {
		return;
	}
	echo '<section class="site-global-content-end">' . do_shortcode( $area ) . '</section>';
}

function wps_theme_global_content_start_area() {
	$area = get_option( 'wps_global_content_start_area' );
	if ( ! $area ) {
		return;
	}
	echo '<section class="site-global-content-start">' . do_shortcode( $area ) . '</section>';
}

function wps_theme_global_after_header_area() {
	$area = get_option( 'wps_global_after_header_area' );
	if ( ! $area ) {
		return;
	}
	echo '<section class="site-global-after-header">' . do_shortcode( $area ) . '</section>';
}

function wps_theme_global_main_content_start_area() {
	$area = get_option( 'wps_global_main_content_start_area' );
	if ( ! $area ) {
		return;
	}
	echo '<section class="site-global-main-content-start">' . do_shortcode( $area ) . '</section>';
}
