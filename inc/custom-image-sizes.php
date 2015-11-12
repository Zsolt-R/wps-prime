<?php
/*
*
*   Custom Image Sizes
*
* 
*/

// Medium image to fitt most of the devices
add_image_size( 'wps_prime_medium', 360, 200, true );

// Full image size used in full width sliders
add_image_size( 'wps_prime_full', 1052, 350, array( 'center', 'center' ) );

// Show at insertion
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );

function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
    
        'wps_prime_medium' => 'wps_prime Medium',
        'wps_prime_full' => 'wps_prime Full'
    );
    return array_merge( $sizes, $custom_sizes );
}

// DEV 
/*
function get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}
var_dump(get_intermediate_image_sizes());
*/