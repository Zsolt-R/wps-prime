<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package wps_prime
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function wps_prime_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'wps_prime_jetpack_setup' );
