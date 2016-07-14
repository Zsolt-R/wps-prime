<?php
/**
 * Theme Shortcodes Helpers
 *
 * @package wps_prime
 */

/**
 * Enqueue icon element font
 * @todo move to separate folder
 * @since 1.4
 *
 * @param $font
 */
function wps_icon_element_fonts_enqueue( $font ) {

	// Registered in functions.php
	switch ( $font ) {
		case 'fontawesome':
			wp_enqueue_style( 'wps_prime-font-awesome' );
			break;
		case 'typicons':
			wp_enqueue_style( 'wps_prime-typicons' );
			break;
		case 'linecons':
			wp_enqueue_style( 'wps_prime-linecons' );
			break;	
		case 'woothemesecom':
			wp_enqueue_style( 'wps_prime-woo-ecom' );
			break;		
		default:
			do_action( 'wps_enqueue_font_icon_element', $font ); // hook to custom do enqueue style
	}
}
// Frontend embed
add_action('wps_enqueue_font_icon_element','wps_icon_element_fonts_enqueue');