<?php
/**
 * Theme Shortcodes INIT
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
add_action( 'admin_head', 'gavickpro_add_my_tc_button' );

function gavickpro_add_my_tc_button() {
	global $typenow;

	// Check user permissions.
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	// Verify the post type.
	if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
		return; }
	// check if WYSIWYG is enabled.
	if ( get_user_option( 'rich_editing' ) === 'true' ) {
		add_filter( 'mce_external_plugins', 'wps_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'wps_register_tc_button' );
	}
}

/** Allow us to use any character class of dashicons-*.
 *  For those of you who are curious – we had to specify the mce-i-icon class,
 *  because the value of the icon is automatically appended to the mce-i- prefix
 */
function gavickpro_tc_css() {
	wp_enqueue_style( 'gavickpro-tc', plugins_url( '/css/style.css', __FILE__ ) );
}

add_action( 'admin_enqueue_scripts', 'gavickpro_tc_css' );

/**
 * Multilingual support in plugins for TinyMCE
 */
function gk_add_my_tc2_button_lang( $locales ) {
	$locales['gavickpro_tc_button'] = plugin_dir_path( __FILE__ ) . 'translations.php';
	return $locales;
}

add_filter( 'mce_external_languages', 'gk_add_my_tc2_button_lang' );


/* Specify the path to the script with our plugin for TinyMCE: */
function wps_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['wps_shortcode_buttons'] = plugins_url( '/js/mce-wps-shortcode-buttons.js', __FILE__ );
	return $plugin_array;
}

/**
 * Add buttons in the editor – in this case we will add one button:
 */
function wps_register_tc_button( $buttons ) {
	array_push( $buttons, 'wps_shortcode_buttons' );
	return $buttons;
}

/* Get shortcode list */
require_once( plugin_dir_path( __FILE__ ) .'wps-shortcodes.php' );
