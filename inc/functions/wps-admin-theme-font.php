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
	$fonts = new wps_themeFonts;
	$theme_fonts = $fonts->getFonts(); // Get registered fonts.
	$font_main = wps_get_theme_option( 'main_font_family' ); // Get selected font family option.

	/* If no font is set return */
	if ( ! isset( $font_main ) ) {
		return;
	} else {

		/**
		* Follow definition format
		* font[0] = Font Name
		* font[1] = font css style
		* font[2] = font http:// link
		*/
		wp_register_style( 'theme_main_font', esc_url_raw( $theme_fonts[ $font_main ][2] ) );
		wp_enqueue_style( 'theme_main_font' );

		wp_add_inline_style( 'theme_main_font','html{font-family:\''. esc_attr( $theme_fonts[ $font_main ][0] ) . '\',' .  esc_attr( $theme_fonts[ $font_main ][1] ) .';}' );
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_fonts' );
