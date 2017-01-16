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
 *  - body_start
 *    ....
 *  - wp_footer
 *
 *  HEADER Hooks layout
 *
 *  - before_header
 *  - mast_head_start
 *   	- theme_header
 *   	  - header-left
 *   	  - header-right
 *	- mast_head_start
 *  - after_header
 *  - before_content
 *
 *  MAIN CONTENT Hooks layout
 *
 *   - content_start
 *   - content_end
 *
 *  MAIN SIDEBAR Hooks layout
 *
 *
 *
 *  - after_content
 *
 *  FOOTER Hooks layout
 *
 *   - before_footer
 *   - after_footer
 */

/**
 * Hook Header Layout to theme header
 */
add_action( 'theme_header', 'layout_header' );

/**
 * Hook logo To theme_header_left
 */
add_action( 'theme_header_left', 'theme_site_logo' );

/**
 * Hook Menu To theme_header_right
 * Modified by filter and removed on custom page template
 * See: add_filter('body_start','conditional_remove_site_nav');
 */
add_action( 'theme_header_right', 'main_site_mobile_nav_toggler' );
add_action( 'theme_header_right', 'main_site_nav' );
add_action( 'after_header', 'main_site_nav_mobile' );

/**
 * Page pre content 
 */
add_action('before_content','theme_page_pre_content' );

/**
 * Add Global Content Object 
 */
add_action( 'before_footer', 'theme_global_content_area' );

/**
 *  Footer Parts
 */
add_action( 'after_footer','footer_micro' );