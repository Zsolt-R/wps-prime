<?php
/**
 * Layout Template Classes setup.
 * Control Layout classes from one place
 * Setup theme layouts from here
 *
 * @package wps_prime
 */

/**
 * HTML Page Content Wrappers.
 */
add_action( 'content_start' , 'page_top',0 );
add_action( 'content_end' , 'page_end',0 );

/**
 * Header
 */
add_filter( 'wp_head', 'main_layout' );

/**
 * Main Content Area Classes
 */
add_filter( 'main_class', 'main_layout' );

/**
 * Sidebar Area Classes
 */
add_filter( 'sidebar_class', 'sidebar_layout' );

if ( ! function_exists( 'main_layout' ) ) {

	/**
	 * Setting for id="primary"
	 * @param array $classes Storred css classes.
	 */
	function main_layout( $classes ) {

		global $wp_query, $wpdb;

		// Element to be removed.
		$whitelist = array();

		// Add 'class-name' to the $classes array!
		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-7/10';
		$classes[] = 'content-area';

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-full.php' ) || is_page_template( 'templates/template-cleanpage.php' ) ) {
			$whitelist[] = 'lap-and-up-7/10';

		}

		// Remove Classes!
		$classes = array_diff( $classes, $whitelist );

		// Return the $classes array!
		return $classes;
	}
}

if ( ! function_exists( 'sidebar_layout' ) ) {

	/**
	 * Setting for id="secondary"
	 * @param array $classes Storred css classes.
	 */
	function sidebar_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-3/10';
		$classes[] = 'widget-area';

		// Return the $classes array.
		return $classes;
	}
}

/**
 * Page html Wrappers
 */
if ( ! function_exists( 'page_top' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function page_top() {
		echo'<div class="wrapper"><div class="layout">';
	}
}

if ( ! function_exists( 'page_end' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function page_end() {
		echo '</div></div>';
	}
}
