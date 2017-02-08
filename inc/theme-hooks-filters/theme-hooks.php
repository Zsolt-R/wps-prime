<?php
/**
 *
 *   Theme HOOKS
 *
 *   @package wps_prime
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
 *
 *  MAIN SIDEBAR Hooks layout
 *
 *
 *
 *  - wps_after_content
 *
 *  FOOTER Hooks layout
 *
 *   - wps_before_footer
 *   - wps_after_footer
 */

/**
 * WP HOOK to add after the opening body tag <body>
 */
function wps_body_start() {
	do_action( 'wps_body_start' );
}

/**
* Master Header Start Hook	
*/
function wps_mast_head_start() {
	do_action( 'wps_mast_head_start' );
}

/**
* Master Header End Hook	
*/
function wps_mast_head_end() {
	do_action( 'wps_mast_head_end' );
}

/**
* Before Header Hook	
*/
function wps_before_header() {
	do_action( 'wps_before_header' );
}

/**
* After Header Hook	
*/
function wps_after_header() {
	do_action( 'wps_after_header' );
}


/**
 * WP HOOK to add in the head before the main nav <div class="header-content">
 */
function wps_theme_header() {
	do_action( 'wps_theme_header' );
}

/**
 * Theme header layout media object element
 */
function wps_theme_header_left() {
	do_action( 'wps_theme_header_left' );
}

/**
 * Theme header layout media object element
 */
function wps_theme_header_right() {
	do_action( 'wps_theme_header_right' );
}

/**
 * WP HOOK to add before the content starts
 * </header><!-- #masthead -->
 *   <?php wps_before_content();?>
 *  <div id="content" class="site-content">
 */
function wps_before_content() {
	do_action( 'wps_before_content' );
}


/**
 * WP HOOK on top of id="content"
 *      <div id="content" class="site-content">
 *              <?php wps_content_start(); ?>   
 */
function wps_content_start() {
	do_action( 'wps_content_start' );
}

/**
 * WP HOOK on end of id="content"
 *         </div><!-- layout -->
 *            <?php wps_content_end(); ?>
 *      </div><!-- wrapper --> ...
 */
function wps_content_end() {
	do_action( 'wps_content_end' );
}

/**
 * WP HOOK on the end o the main content and sidebar
 * just before the footer starts
 *  </div><!-- #content -->
 *	<?php wps_after_content(); ?>
 */
function wps_after_content() {
	do_action( 'wps_after_content' );
}

/**
 * WP HOOK before the footer </footer>
 *  </div><!-- #content -->
 *
 *      <?php wps_before_footer(); ?>
 *  <footer ...
 */
function wps_before_footer() {
	do_action( 'wps_before_footer' );
}

/**
 * WP HOOK after end of footer </footer>
 *        </footer><!-- #colophon -->
 *      <?php wps_after_footer(); ?>
 *  </div><!-- #page -->
 */
function wps_after_footer() {
	do_action( 'wps_after_footer' );
}