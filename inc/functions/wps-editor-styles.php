<?php
/**
 * Add theme font to admin editor
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @package wps_prime
 */

/**
 *	Add custom stylesheets to wp editor
 */
function wps_editor_styles() {

	$style = false;

	// Check if style is avaliable in child theme or parent theme.
	if ( file_exists( get_stylesheet_directory().'/editor-style.css' ) ) {

		$style = get_stylesheet_directory_uri().'/editor-style.css';

	} elseif ( file_exists( get_template_directory().'/editor-style.css' ) ) {

		$style = get_template_directory_uri().'/editor-style.css';
	}
	if ( $style ) { add_editor_style( $style ); }
}
add_action( 'init','wps_editor_styles' );

