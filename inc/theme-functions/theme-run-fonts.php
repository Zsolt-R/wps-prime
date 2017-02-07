<?php
/**
 * Register and add theme fonts to header
 *
 * @package wps_prime
 */

/**
 * Function that creates <link> and <style> font definitions to added to theme head
 * Calls the settings from theme options panel and maps with the multidimensional array served by base_typo();
 * Creates inline style for main font
 */
function add_theme_fonts() {
	$fonts = new WpsGetThemeFonts;

	$font_main = wps_get_theme_option( 'main_font_family' ); // Get selected font family option.

	/* If no font is set return */
	if ( ! isset( $font_main ) ) {
		return;
	} else {

		wp_register_style( 'theme_main_font',  $fonts->get_theme_fonts_link() );
		wp_enqueue_style( 'theme_main_font' );

		wp_add_inline_style( 'theme_main_font',  $fonts->get_theme_font_style() );
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_fonts', 99 ); // Add last in style chain.


function filter_handler( $classes ){ 	

	// Custom Navigation font	
	if ( wps_get_theme_option( 'nav_custom_font' ) ) $classes[] = 'u-font-two';
	
	return $classes;
}
add_filter( 'nav_menu_css_class', 'filter_handler', 10, 4 ); 