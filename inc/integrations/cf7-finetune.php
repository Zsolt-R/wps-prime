<?php
/**
 * Deregister Contact Form 7 scripts and styles
 *
 * @package WPS_Prime_2
 */

/**
 * Disable styles
 */
function wps_disable_contact7_styles() 
{
    wp_dequeue_style('contact-form-7');
    wp_dequeue_style('contact-form-7-rtl');
}

/**
 * Change preloader image
 */
function wps_custom_wpcf7_ajax_loader() 
{
    return  WPS_IMAGE_DIR_URI .'/ajax-loader.gif';    
}

/**
 * Allow other shortcodes in Contact Form 7
 *
 * @param  obj $form Contact form object.
 * @return obj
 */
function wps_wpcf7_form_elements( $form ) 
{
    $form = do_shortcode($form);
    return $form;
}

/**
 * If Contact Form 7 plugin Exists, do the tweaks
 */
if (function_exists('wpcf7_contact_form') ) {

    // Deregister Contact From 7 default Styles.
    add_action('wp_enqueue_scripts', 'wps_disable_contact7_styles');
    add_filter('wpcf7_ajax_loader', 'wps_custom_wpcf7_ajax_loader');
    add_filter('wpcf7_form_elements', 'wps_wpcf7_form_elements');

}