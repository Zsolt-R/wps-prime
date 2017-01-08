<?php
/**
 * Theme Header Parts.
 *
 * Contains the parts whitch are added to the theme header area
 *
 * @package wps_prime
 */

/**
 * Site header Layout
 */
if ( ! function_exists( 'layout_header' ) ) :
	function layout_header() {
	
		/**
		 * If hook doesn't has action hide the html
		 */
		if ( has_action( 'theme_header_left' ) === true ) {
	
			echo '<div'. header_layout_left_class() .'>';
				theme_header_left();
			echo '</div>';
		}
	
		if ( has_action( 'theme_header_right' ) === true ) {
	
			echo '<div'. header_layout_right_class() .'>';
				theme_header_right();
			echo '</div>';
		}
	}
endif;