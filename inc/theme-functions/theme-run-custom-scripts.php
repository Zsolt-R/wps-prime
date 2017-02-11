<?php
/**
 * Front End Scripts
 *
 * @since  1.4.4
 * @package wps_prime
 */

add_action('wp_footer','wps_footer_scripts');
add_action('wp_head','wps_header_scripts');
add_action('wp_head','wps_header_styles',999);

if(!function_exists('wps_footer_scripts')){

	function wps_footer_scripts(){
		$script = wps_get_theme_option( 'footer_scripts' ); 

		// bail out early
		if( !isset($script) || $script == '' ){
			return;
		}

		echo $script;  
	}
}


if(!function_exists('wps_header_scripts')){
	

	function wps_header_scripts(){
		//var_dump(get_option( 'wps_prime_settings' ));
		$script = wps_get_theme_option( 'header_scripts' ); 

		// bail out early
		if(!isset($script) || $script == '' ){
			return;
		}	

		echo $script;
	}
}

if(!function_exists('wps_header_styles')){

	function wps_header_styles(){
		$style = wps_get_theme_option( 'custom_css_style' ); 

		// bail out early
		if(!isset($style) || $style == '' ){
			return;
		}
		echo '<style type="text/css">'.$style.'</style>';
	}
}