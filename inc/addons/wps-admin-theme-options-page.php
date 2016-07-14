<?php
/**
 * WPS Prime - theme options
 *
 * @link https://piklist.com/user-guide/docs/settings-admin-page-parameters/
 * @package wps_prime
 */

add_filter( 'piklist_admin_pages', 'wps_theme_setting_pages' );

/**
 * Creates admin page // Under Appearance menu
 *
 * @param array $pages All pages from the piklist_admin_pages() function.
 * @return array
 */
function wps_theme_setting_pages( $pages ) {
	$pages[] = array(
	'page_title' => __( 'Theme Settings','piklist' ),
	'menu_title' => __( 'Theme Settings', 'piklist' ),
	'menu' => 'admin.php',
	'capability' => 'manage_options',
	'menu_slug' => 'wps_prime_settings',
	'setting' => 'wps_prime_settings',
	'menu_icon' => 'dashicons-desktop',
	'page_icon' => 'dashicons-desktop',
	'single_line' => false,
	'default_tab' => 'General Options',
	'save_text' => 'Save Settings',
	);

	return $pages;
}

/**
 * Get theme options helper function
 *
 * @param string $option_name this keeps the name o the option called via wps_get_theme_option() function.
 * @return null
 */
function wps_get_theme_option( $option_name = null ) {

	$theme_options = get_option( 'wps_prime_settings' );
	$result = null;

	if ( ! is_string( $option_name ) ) {

		return $result;

	} else {

		// Check if option is set!
		$result = isset( $theme_options[ $option_name ] ) ? $theme_options[ $option_name ] : null;

		// If there is only one option in the option-array
		// Extract the single option
		if(is_array($result) && count($result) === 1){
			$result = $result[0];
		}

	}
	return $result;
}
