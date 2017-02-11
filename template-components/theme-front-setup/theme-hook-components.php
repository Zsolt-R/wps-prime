<?php
/**
 *
 *   HOOK OBJECTS TO THEME
 *   used to add custom theme-parts via hooks
 *
 * @package wps_prime
 */

/**
 *  BODY Hooks
 *  - wps_body_start
 *    ....
 *  - wps_wp_footer
 *
 *  HEADER Hooks layout
 *
 *  - wps_before_header
 *  - wps_mast_head_start
 *   	- wps_theme_header
 *   	  - wps_header-left
 *   	  - wps_header-right
 *	- wps_mast_head_start
 *
 *  INTERMEDIATE Hooks after header before content
 *
 *  - wps_after_header
 *  - wps_before_content
 *
 *  MAIN CONTENT Hooks layout
 *
 *   - wps_content_start
 *   - wps_content_end
 *   - wps_single_entry_header
 *   - wps_single_entry_footer
 *   - wps_after_content
 *
 *  MAIN SIDEBAR Hooks layout
 * 
 *   - wps_sidebar_start
 *   - wps_sidebar_end
 *
 *  FOOTER Hooks layout
 *
 *   - wps_before_footer
 *   - wps_footer_start
 *   - wps_footer_end
 *   - wps_after_footer
 */

/**
 * Hook Header Layout to theme header
 */
add_action( 'wps_theme_header', 'wps_layout_header' );

/**
 * Hook logo To theme_header_left
 */
add_action( 'wps_theme_header_left', 'wps_theme_site_logo' );

/**
 * Hook Menu To theme_header_right
 * Modified by filter and removed on custom page template
 * See: add_filter('body_start','conditional_remove_site_nav');
 */
add_action( 'wps_theme_header_right', 'wps_main_site_mobile_nav_toggler' );
add_action( 'wps_theme_header_right', 'wps_main_site_nav' );
add_action( 'wps_after_header', 'wps_main_site_nav_mobile' );

/**
 * Page pre content 
 */
add_action('wps_before_content','wps_theme_page_pre_content' );

/**
 * Add Global Content Object 
 */
add_action( 'wps_before_footer', 'wps_theme_global_content_area' );

/**
 *  Footer Parts
 */
add_action( 'wps_after_footer','wps_footer_micro' );