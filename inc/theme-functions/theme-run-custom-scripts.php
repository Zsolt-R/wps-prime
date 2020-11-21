<?php
/**
 * Front End Scripts
 *
 * @since  1.4.4
 * @package wps_prime
 */


add_action('wp_head','wps_header_scripts');
add_action('wp_head','wps_header_styles',999);
add_action('wps_body_start','wps_body_start_scripts',0);
add_action('wp_footer','wps_footer_scripts',999);


if(!function_exists('wps_header_scripts')){
	

	function wps_header_scripts(){
		//var_dump(get_option( 'wps_prime_settings' ));
		$script = get_option( 'wps_header_scripts' ); 

		// bail out early
		if(!isset($script) || $script == '' ){
			return;
		}	

		echo $script;
	}
}

if(!function_exists('wps_header_styles')){

	function wps_header_styles(){
		$style = get_option( 'custom_css_style' ); 

		// bail out early
		if(!isset($style) || $style == '' ){
			return;
		}
		echo '<style type="text/css">'.$style.'</style>';
	}
}

if(!function_exists('wps_body_start_scripts')){

	function wps_body_start_scripts(){
		$script = get_option( 'wps_body_start_scripts' ); 

		// bail out early
		if( !isset($script) || $script == '' ){
			return;
		}

		echo $script;  
	}
}

if(!function_exists('wps_footer_scripts')){

	function wps_footer_scripts(){
		$script = get_option( 'wps_footer_scripts' ); 

		// bail out early
		if( !isset($script) || $script == '' ){
			return;
		}

		echo $script;  
	}
}