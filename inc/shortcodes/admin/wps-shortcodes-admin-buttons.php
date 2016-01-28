<?php
/**
 * Theme Shortcodes Admin Buttons
 * Add shortcodes to mce editor
 *
 * @package wps_prime
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * WordPress TinyMCE Editor Tips | How to Add Custom Buttons, Styles, Dropdowns & Pop-ups
 *
 * @link https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
 */

// Declaring a new TinyMCE button.
add_action( 'admin_head', 'wps_add_button' );

function wps_add_button() {
	global $typenow;
	// check user permissions
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// verify the post type
	if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
		return; }
	// check if WYSIWYG is enabled
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( 'mce_external_plugins', 'wps_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wps_register_tc_button' );
	}
}

/**
 *  Allow us to use any character class of dashicons-*.
 *  For those of you who are curious – we had to specify the mce-i-icon class,
 *  because the value of the icon is automatically appended to the mce-i- prefix
 */
function wps_tc_css() {
	wp_enqueue_style( 'wps-tc', WPS_THEME_URI. '/inc/shortcodes/admin/css/style.css' );
}

add_action( 'admin_enqueue_scripts', 'wps_tc_css' );

/* Multilingual support in plugins for TinyMCE */
function wps_add_button_lang( $locales ) {
	$locales['wps_tc_button'] = WPS_THEME_DIR . '/inc/shortcodes/admin/translations.php';
	return $locales;
}

add_filter( 'mce_external_languages', 'wps_add_button_lang' );


/* Specify the path to the script with our plugin for TinyMCE: */
function wps_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['wps_shortcode_buttons'] = WPS_THEME_URI. '/inc/shortcodes/admin/js/mce-wps-shortcode-buttons.js';
	return $plugin_array;
}

/* Add buttons in the editor – in this case we will add one button: */
function wps_register_tc_button( $buttons ) {
	array_push( $buttons, 'wps_shortcode_buttons' );
	return $buttons;
}
