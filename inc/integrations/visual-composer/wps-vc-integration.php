<?php
/**
 * Custom VC config file for WPS.
 *
 *  Require VC helper fuctions
 *  Require custom VC parameters
 *  Remove VC default icons
 *  Remove VC default elements
 *  Disable Front End Editor
 * Deregister VC default style and script from front end
 * Include wps-to-vc shortcode register file
 * Include VC modified shortcodes
 * Re-Register customized VC components
 * - custom-column
 * - custom row
 * - custom inner-column
 * - custom inner-row
 * - custom text component
 * - custom video component
 * Register custom backend VC style ( custom style VC components  )
 *
 * @since 1.4.4
 */

/**
 * change default template directory where Visual Composer looks for content elements template files.
 */
$dir = get_template_directory().'/inc/integrations/visual-composer/vc_templates';
vc_set_shortcodes_templates_dir($dir);

/**
 * Remove VC default elements.
 */

// WPS VC helpers and custom parameters
require get_template_directory().'/inc/integrations/visual-composer/wps-vc-helpers.php';
require get_template_directory().'/inc/integrations/visual-composer/params/wps-vc-column-params.php';
require get_template_directory().'/inc/integrations/visual-composer/params/wps-vc-margin-params.php';
require get_template_directory().'/inc/integrations/visual-composer/params/wps-vc-padding-params.php';

//Deque VC default icons
add_action('vc_base_register_admin_css', 'remove_vc_styles', 99);
function remove_vc_styles()
{
    wp_deregister_style('vc_openiconic');
    wp_deregister_style('vc_monosocialiconsfont');
    wp_deregister_style('font-awesome');
}

/* Content */
// vc_remove_element("vc_column_text");
// vc_remove_element("vc_column_inner");
vc_remove_element('vc_custom_heading');
vc_remove_element('vc_empty_space');
vc_remove_element('vc_flickr');
vc_remove_element('vc_gallery');
vc_remove_element('vc_gmaps');
vc_remove_element('vc_icon');
vc_remove_element('vc_images_carousel');
vc_remove_element('vc_line_chart');
vc_remove_element('vc_message');
vc_remove_element('vc_pie');
vc_remove_element('vc_posts_slider');
vc_remove_element('vc_progress_bar');
vc_remove_element('vc_round_chart');
vc_remove_element('vc_separator');
vc_remove_element('vc_single_image');
vc_remove_element('vc_text_separator');
vc_remove_element('vc_toggle');
//vc_remove_element("vc_video");
vc_remove_element('vc_icon_element');
vc_remove_element('vc_btn');
vc_remove_element('vc_cta');
vc_remove_element('vc_section');
vc_remove_element('vc_hoverbox');
vc_remove_element('vc_zigzag');

/* Structure */
vc_remove_element('vc_widget_sidebar');
vc_remove_element('vc_raw_js');
//vc_remove_element("vc_raw_html");

/* Social */
vc_remove_element('vc_facebook');
vc_remove_element('vc_googleplus');
vc_remove_element('vc_pinterest');
vc_remove_element('vc_tweetmeme');

/* Grids */
vc_remove_element('vc_grids_common');
vc_remove_element('vc_basic_grid');
vc_remove_element('vc_masonry_grid');
vc_remove_element('vc_masonry_media_grid');
vc_remove_element('vc_media_grid');

/* TTA */
vc_remove_element('vc_tta_accordion');
vc_remove_element('vc_tta_pageable');
vc_remove_element('vc_tta_section');
vc_remove_element('vc_tta_tabs');
vc_remove_element('vc_tta_tour');

/* Deprecated */
vc_remove_element('vc_tabs');
vc_remove_element('vc_tour');
vc_remove_element('vc_tab');
vc_remove_element('vc_accordion');
vc_remove_element('vc_accordion_tab');
vc_remove_element('vc_posts_grid');
vc_remove_element('vc_carousel');
vc_remove_element('vc_button');
vc_remove_element('vc_button2');
vc_remove_element('vc_cta_button');
vc_remove_element('vc_cta_button2');

/* WP */
vc_remove_element('vc_wp_archives');
vc_remove_element('vc_wp_categories');
vc_remove_element('vc_wp_calendar');
vc_remove_element('vc_wp_custommenu');
vc_remove_element('vc_wp_links');
vc_remove_element('vc_wp_meta');
vc_remove_element('vc_wp_pages');
vc_remove_element('vc_wp_posts');
vc_remove_element('vc_wp_recentcomments');
vc_remove_element('vc_wp_rss');
vc_remove_element('vc_wp_search');
vc_remove_element('vc_wp_tagcloud');
vc_remove_element('vc_wp_text');

/* Disable frontend editor */
if (function_exists('vc_disable_frontend')) {
    vc_disable_frontend();
}

// Deregister VC style and script from front end
if (!vc_is_inline()) {
    add_action('wp_enqueue_scripts', 'wps_vc_default_dequeue_styles');
}
function wps_vc_default_dequeue_styles()
{
    wp_deregister_style('js_composer_front');
}

if (!vc_is_inline()) {
    add_action('wp_print_scripts', 'wps_vc_default_dequeue_scripts');
}
function wps_vc_default_dequeue_scripts()
{
    wp_deregister_script('wpb_composer_front_js');
    wp_dequeue_script('wpb_composer_front_js');
}

// Alter Visual Composer shortcodes
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-row.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-row-inner.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-column.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-column-inner.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-column-text.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-video.php';

// Map/Integrate WPS defined shortcodes
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-image.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-heading.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-mediabox.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-list.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-button.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-divider.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-icon.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-accordion.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-tabs.php';
require get_template_directory().'/inc/integrations/visual-composer/shortcodes/wps-vc-sliders.php';

// Register customized VC for WPS
add_action('vc_after_init', 'wps_vc_row_shortcode');
add_action('vc_after_init', 'wps_vc_row_inner_shortcode');
add_action('vc_after_init', 'wps_vc_column_shortcodes');
add_action('vc_after_init', 'wps_vc_column_inner_shortcode');
add_action('vc_after_init', 'wps_vc_column_text_shortcode');
add_action('vc_after_init', 'wps_vc_image_shortcode');
add_action('vc_after_init', 'wps_vc_heading_shortcode');
add_action('vc_after_init', 'wps_vc_button_shortcode');
add_action('vc_after_init', 'wps_vc_icon_deprecated_shortcode');
add_action('vc_after_init', 'wps_vc_divider_shortcode');
add_action('vc_after_init', 'wps_vc_video_shortcode');
add_action('vc_after_init', 'wps_vc_accordion_shortcode');
add_action('vc_after_init', 'wps_vc_accordion_item_shortcode');
add_action('vc_after_init', 'wps_vc_tab_shortcode');
add_action('vc_after_init', 'wps_vc_tab_item_shortcode');
add_action('vc_after_init', 'wps_vc_wps_slider_shortcode');
add_action('vc_after_init', 'wps_vc_wps_slider_item_shortcode');
add_action('vc_after_init', 'wps_vc_list_shortcode');
add_action('vc_after_init', 'wps_vc_mediabox_shortcode');

// WPS-VC custom style
function wps_vc_admin_style()
{
    // Check if we are on a page and we edit that page
    if (get_post_meta(get_the_ID(), '_wpb_vc_js_status', true) && isset($_GET['action'])) {
        if ('edit' === $_GET['action']) {
            wp_register_style('wps_vc_style', get_wps_file_location('wps-vc-style.css', '/inc/integrations/visual-composer/css'), false, '1.0.0');
            wp_enqueue_style('wps_vc_style');
        }
    }
}
add_action('admin_enqueue_scripts', 'wps_vc_admin_style');
