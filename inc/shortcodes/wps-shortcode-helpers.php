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


/**
 * @param $class
 *
 * @return string
 */
function wps_getExtraClass( $class, $flush = false ) {
	$output = $flush = '';
	$space = $flush ? '':' ';

	// Check is we get an array
	if(is_array($class)){
		foreach($class as $css_class){
			 // Check if we have a valid value and field is not empty
			 if ( '' !== $css_class ) { $output .= $space . str_replace( '.', '', $css_class ); }
		}
	}else{	
		// Check if we have a valid value and field is not empty
		 if ( '' !== $class ) {	$output = $space . str_replace( '.', '', $class ); }
		}
	return $output;
}

// Wrap video iframe in extra field used by responsive video js
add_filter( 'embed_oembed_html', 'tdd_oembed_filter', 99, 4 ) ;
function tdd_oembed_filter($html, $url, $attr, $post_ID) {
return  '<figure class="videoWrapper">'.$html.'</figure>';
}

/**
 * Extract video ID from youtube url
 *
 * @param string $url Youtube url
 *
 * @return string
 */
function wps_extract_youtube_id( $url ) {
	parse_str( parse_url( $url, PHP_URL_QUERY ), $vars );

	if ( ! isset( $vars['v'] ) ) {
		return '';
	}

	return $vars['v'];
}

function wps_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) { 
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}
	
	// Don’t auto-p wrap shortcodes that stand alone
	// ref: https://developer.wordpress.org/reference/functions/shortcode_unautop/
	return do_shortcode( shortcode_unautop( $content ) );
}