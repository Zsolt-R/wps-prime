<?php
/**
  * Remove VC default elements
  */
// WPS VC helpers and custom parameters
require get_template_directory() . '/inc/integrations/visual-composer/wps-vc-helpers.php';
require get_template_directory() . '/inc/integrations/visual-composer/params/wps-vc-params.php';


//Deque VC default icons
add_action( 'vc_base_register_admin_css', 'remove_vc_styles', 99 );
function remove_vc_styles() {
    wp_deregister_style( 'vc_openiconic' );
    wp_deregister_style( 'vc_monosocialiconsfont' );
}


/* Reset Default Templates */
add_filter( 'vc_load_default_templates', 'my_custom_template_modify_array' ); // Hook in
function my_custom_template_modify_array( $data ) {
    return array(); // This will remove all default templates. Basically you should use native PHP functions to modify existing array and then return it.
}

/* Content */
// vc_remove_element("vc_column_text");
// vc_remove_element("vc_column_inner");
vc_remove_element("vc_custom_heading");
vc_remove_element("vc_empty_space");
vc_remove_element("vc_flickr");
vc_remove_element("vc_gallery");
vc_remove_element("vc_gmaps");
vc_remove_element("vc_icon");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_message");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_separator");
vc_remove_element("vc_single_image");
vc_remove_element("vc_text_separator");
vc_remove_element("vc_toggle");
vc_remove_element("vc_video");
vc_remove_element("vc_icon_element");
vc_remove_element("vc_btn");
vc_remove_element("vc_cta");

/* Structure */
vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_raw_js");
vc_remove_element("vc_raw_html");

/* Social */
vc_remove_element("vc_facebook");
vc_remove_element("vc_googleplus");
vc_remove_element("vc_pinterest");
vc_remove_element("vc_tweetmeme");

/* Grids */
vc_remove_element("vc_grids_common");
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_masonry_media_grid");
vc_remove_element("vc_media_grid");

/* TTA */
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_pageable");
vc_remove_element("vc_tta_section");
vc_remove_element("vc_tta_tabs");
vc_remove_element("vc_tta_tour");

/* Deprecated */
vc_remove_element("vc_tabs");
vc_remove_element("vc_tour");
vc_remove_element("vc_tab");
vc_remove_element("vc_accordion");
vc_remove_element("vc_accordion_tab");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");

/* WP */
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_text");


/* Disable frontend editor */
if(function_exists('vc_disable_frontend')){
  vc_disable_frontend();
}

// Deregister VC style and script from front end
if(!vc_is_inline()){
add_action( 'wp_enqueue_scripts', 'remove_vc_default_scripts', 20 );
}
function remove_vc_default_scripts() {  
    wp_deregister_style( 'js_composer_front' );
    wp_deregister_script( 'wpb_composer_front_js' );
}

// Include existing shortcodes
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-to-vc-shortcodes.php';

// Alter VC shortcodes
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-vc-row.php';
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-vc-row-inner.php';
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-vc-column.php';
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-vc-column-inner.php';
require get_template_directory() . '/inc/integrations/visual-composer/shortcodes/wps-vc-column-text.php';

// Register customized VC for WPS
add_action( 'vc_after_init', 'wps_vc_row_shortcode' );
add_action( 'vc_after_init', 'wps_vc_row_inner_shortcode' );
add_action( 'vc_after_init', 'wps_vc_column_shortcodes' );
add_action( 'vc_after_init', 'wps_vc_column_inner_shortcode' );
add_action( 'vc_after_init', 'wps_vc_column_text_shortcode' );

// WPS-VC custom style
function wps_vc_admin_style(){

  // Check if we are on a page and we edit that page
  if ( 'page' === get_post_type() && isset( $_GET['action'] ) ) {   
    if('edit' === $_GET['action']){

        wp_register_style( 'wps_vc_style', get_wps_file_location('wps-vc-style.css'), false, '1.0.0' );


        wp_register_style( 'wps_prime-woo-ecom-admin-child', get_template_directory_uri() .'/assets/fonts/iconfont/wps-woothemes-e-commerce-icons/fonts/woothemes_ecommerce.css' );
        wp_enqueue_style('wps_vc_style');
        wp_enqueue_style('wps_prime-woo-ecom-admin-child');
         
    }
  }
}
add_action('admin_enqueue_scripts','wps_vc_admin_style');