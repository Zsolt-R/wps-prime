<?php
/**
 *  Favicon
 *
 * @package wps_prime
 */

add_action( 'wp_head','wps_get_favicon' );
add_action( 'admin_head','wps_get_favicon' );
add_action( 'admin_init','wps_update_favicon');

/**
 * Set favicon link in transient
 */
function wps_set_favicon() {

	// Check if ico exist.
	$icon_path = get_stylesheet_directory() .'/favicon.ico';	

	$file_status = wps_file_exist( $icon_path );

	$icon_url =  esc_url( get_stylesheet_directory_uri().'/favicon.ico' );



	// Check if favico exist in the theme root.
	if( $file_status ){
		 set_transient( 'site_favicon',$icon_url, YEAR_IN_SECONDS ); // store for a year	
	}	
}

/*
 * Update favicon transient
 */
function wps_update_favicon(){

	$reset = isset($_GET["settings-updated"]) ? false : true;

	if($reset){

		// Delete transient.
		delete_transient( 'site_favicon' );	
	
		// Store favico link in transient.
		return wps_set_favicon();
	}
}

/**
 *	Retrieve function for favicon.
 */
function wps_get_favicon(){

	$favicon = get_transient('site_favicon');
	
	// If no transient set don't display the favicon.
	if ( false === $favicon) {
		return;
	} else {
		echo '<link rel="shortcut icon" href="'. esc_url( $favicon ) .'" />';
	}
}
