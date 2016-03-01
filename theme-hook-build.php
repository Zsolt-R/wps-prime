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
 *   - before_header
 *   - theme_header
 *       - layout_header__img
 *       - layout_header__body
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
add_action( 'theme_header', 'layout_header',1 );

/**
 * Hook logo To layout_header__img
 */
add_action( 'layout_header__img', 'theme_site_logo',10 );

/**
 * Hook Menu To layout_header__body
 * Modified by filter and removed on custom page template
 * See: add_filter('body_start','conditional_remove_site_nav');
 */
add_action( 'layout_header__body', 'theme_site_navigation',10 );

/**
 * Page pre content 
 */
add_action('before_content','theme_page_pre_content');

/**
 * Add Global Content Object 
 */
add_action( 'before_footer', 'theme_global_content_area' );

/**
 *  Footer Parts
 */
add_action( 'after_footer','footer_micro', 69 );
