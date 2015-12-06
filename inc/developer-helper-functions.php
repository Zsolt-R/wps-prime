<?php
/**
 * Developer helper functions
 * not to be used on live sites
 * not indexed to run in template
 *
 * @package wps_prime
 */

/**
 * Get all registered image sizes
 * var_dump(get_intermediate_image_sizes());
 * @param string $size Image size slug.
 */
function get_image_sizes( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info.
		foreach ( $get_intermediate_image_sizes as $_size ) {

			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

					$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
					$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
					$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

					$sizes[ $_size ] = array(
							'width' => $_wp_additional_image_sizes[ $_size ]['width'],
							'height' => $_wp_additional_image_sizes[ $_size ]['height'],
							'crop' => $_wp_additional_image_sizes[ $_size ]['crop'],
					);

			}
		}

		// Get only 1 size if found!
		if ( $size ) {

			if ( isset( $sizes[ $size ] ) ) {
					return $sizes[ $size ];
			} else {
					return false;
			}
		}

		return $sizes;
}

/**
 *	Function to reveal hook positions
 */

function revealhooks(){
	echo '<div style="letter-spacing:normal;"><code>'. current_filter() .'</code></div>';
}

add_action( 'theme_header', 'revealhooks',10 );

add_action( 'body_start', 'revealhooks',10 );

add_action( 'wp_footer', 'revealhooks',10 );

add_action( 'layout_header__img', 'revealhooks',10 );

add_action( 'layout_header__body', 'revealhooks',10 );

add_action( 'before_content', 'revealhooks',10 );

add_action( 'content_start', 'revealhooks',10 );

add_action( 'content_end', 'revealhooks',10 );

add_action( 'footer_start', 'revealhooks',10 );

add_action( 'footer_end', 'revealhooks',10 );

add_action( 'entry_content_media_img', 'revealhooks',10 );

add_action( 'entry_content_media_body', 'revealhooks',10 );