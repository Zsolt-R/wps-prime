<?php
/**
 * Custom Image Sizes
 *
 * @package wps_prime
 */

// Medium image to fit most of the devices.
add_image_size( 'wps_prime_medium', 360, 200, true );

// Full image size used in full width sliders.
add_image_size( 'wps_prime_full', 1052, 350, array( 'center', 'center' ) );

// Show at insertion.
add_filter( 'image_size_names_choose', 'wps_custom_image_sizes_choose' );

/**
 * Add image sizes to content insert image size list
 *
 * @param array $sizes Image sizes array.
 * @return array
 */
function wps_custom_image_sizes_choose( $sizes ) {
	$custom_sizes = array(

		'wps_prime_medium' => 'WPS Medium',
		'wps_prime_full' => 'WPS Full',
	);
	return array_merge( $sizes, $custom_sizes );
}
