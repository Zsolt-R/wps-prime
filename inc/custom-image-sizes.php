<?php
/**
 * Custom Image Sizes
 *
 * @package wps_prime
 */

// Medium image to fitt most of the devices.
add_image_size( 'wps_prime_medium', 360, 200, true );

// Full image size used in full width sliders.
add_image_size( 'wps_prime_full', 1052, 350, array( 'center', 'center' ) );

// Show at insertion.
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );

/**
 * Add image sizes to content insert image size list
 * @param array $sizes Image sizes array.
 * @return array
 */
function custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(

		'wps_prime_medium' => 'wps_prime Medium',
		'wps_prime_full' => 'wps_prime Full',
	);
	return array_merge( $sizes, $custom_sizes );
}
