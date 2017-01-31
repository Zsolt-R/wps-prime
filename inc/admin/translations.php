<?php
/**
 * Theme Shortcodes Admin Buttons translation
 *
 * @package wps_prime
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; }

if ( ! class_exists( '_WP_Editors' ) ) {
	require( ABSPATH . WPINC . '/class-wp-editor.php' ); }

/**
 * Translation function
 */
function wps_button_translation() {
	$strings = array(
		'button_label' => __( 'WPS Shortcode Helper', 'wps-prime' ),
		'msg' => __( 'Hello World!!!!', 'wps-prime' ),
	);

	$locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.wps_button", ' . wp_json_encode( $strings ) . ");\n";

	return $translated;
}

$strings = wps_button_translation();
