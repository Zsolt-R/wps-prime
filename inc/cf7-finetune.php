<?php
/**
 * Deregister Contact Form 7 scripts and styles
 *
 * @package TecnoTheme
 */

/**
 * Disable scripts
 */
function disable_contact7_scripts() {
	wp_deregister_script( 'contact-form-7' );
}


/**
 * Disable styles
 */
function disable_contact7_styles() {
	wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'contact-form-7-rtl' );
}

/**
 * Change preloader image
 */
function my_wpcf7_ajax_loader() {
	return  get_template_directory_uri() . '/images/ajax-loader.gif';
}

/**
 * Allow other shortcodes in Contact Form 7
 * @param obj $form Contact form object.
 */
function wps_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );
	return $form;
}

/**
 * If Contact Form 7 plugin Exists, do the tweaks
 */
if ( function_exists( 'wpcf7_contact_form' ) ) {

	// Deregister Contact From 7 default Styles.
	add_action( 'wp_enqueue_scripts', 'disable_contact7_styles' );
	add_filter( 'wpcf7_ajax_loader', 'my_wpcf7_ajax_loader' );
	add_filter( 'wpcf7_form_elements', 'wps_wpcf7_form_elements' );

}
