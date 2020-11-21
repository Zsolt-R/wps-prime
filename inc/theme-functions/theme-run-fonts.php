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
function wps_add_theme_fonts() {

	if ( get_theme_mod( 'wps_custom_font_family_status' ) ) {
		return false;
	}

	$fonts_api = new WpsGetThemeFonts();

	$font_main = get_theme_mod( 'wps_main_font_family' ); // Get selected font family option.

	/* If no font is set return */
	if ( ! $font_main ) {
		return;
	} else {

		$fonts = $fonts_api->get_theme_fonts_link();
		$count = 0;
		foreach ( $fonts as $link ) {
			wp_register_style( 'wps_theme_main_font_' . $count, $link );
			wp_enqueue_style( 'wps_theme_main_font_' . $count );
			$count++;
		}

		wp_add_inline_style( 'wps_theme_main_font_0', $fonts_api->get_theme_font_style() );
	}
}
add_action( 'wp_enqueue_scripts', 'wps_add_theme_fonts', 99 ); // Add last in style chain.


function wps_filter_handler( $classes ) {

	if ( get_theme_mod( 'wps_custom_font_family_status' ) ) {
		return $classes;
	}

	// Custom Navigation font
	if ( get_theme_mod( 'wps_nav_custom_font' ) ) {
		$classes[] = 'u-font-two';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'wps_filter_handler', 10, 4 );
