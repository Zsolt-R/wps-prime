<?php
/**
 *  Favicon
 *
 * @package wps_prime
 */

add_action( 'wp_head','add_fav_ico' );
add_action( 'admin_head','add_fav_ico' );

/**
 * Create favicon html link
 */
function add_fav_ico() {

	$file = get_stylesheet_directory_uri() .'/favicon.ico';

	/**
	* Function to check if a file exists defined in inc/extras.php
	* wps_url_exist($url); returns true or false
	*/
	if ( false === wps_url_exist( $file ) ) {
		return;
	} else {
		echo '<link rel="shortcut icon" href="'. esc_url( $file ) .'" />';

	}

}
