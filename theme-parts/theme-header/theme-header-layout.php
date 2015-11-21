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
function layout_header() {

	/**
 * If hook doesn't has action hide the html
 */
	if ( has_action( 'layout_header__img' ) === true ) {

		echo '<div '. header_layout_left_class() .'>';
			layout_header__img();
		echo '</div>';
	}

	if ( has_action( 'layout_header__body' ) === true ) {

		echo '<div '. header_layout_right_class() .'>';
			layout_header__body();
		echo '</div>';
	}
}
