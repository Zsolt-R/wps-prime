<?php
/**
 *
 *   Theme HOOKS
 *
 *   @package wps_prime
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
 * WP HOOK to add after the opening body tag <body>
 */
function body_start() {
	do_action( 'body_start' );
}

/**
* Master Header Start Hook	
*/
function mast_head_start() {
	do_action( 'mast_head_start' );
}

/**
* Master Header End Hook	
*/
function mast_head_end() {
	do_action( 'mast_head_end' );
}

/**
* Before Header Hook	
*/
function before_header() {
	do_action( 'before_header' );
}

/**
* After Header Hook	
*/
function after_header() {
	do_action( 'after_header' );
}


/**
 * WP HOOK to add in the head before the main nav <div class="header-content">
 */
function theme_header() {
	do_action( 'theme_header' );
}

/**
 * Theme header layout media object element
 */
function theme_header_left() {
	do_action( 'theme_header_left' );
}

/**
 * Theme header layout media object element
 */
function theme_header_right() {
	do_action( 'theme_header_right' );
}

/**
 * WP HOOK to add before the content starts
 * </header><!-- #masthead -->
 *   <?php before_content();?>
 *  <div id="content" class="site-content">
 */
function before_content() {
	do_action( 'before_content' );
}


/**
 * WP HOOK on top of id="content"
 *      <div id="content" class="site-content">
 *          <div class="wrapper">
 *              <?php content_start(); ?>
 *          <div class="layout">....
 */
function content_start() {
	do_action( 'content_start' );
}

/**
 * WP HOOK on media object in content.php
 *         <div class="entry-content ...
 *              <div class="media__img ...
 */
function entry_content_media_img() {
	do_action( 'entry_content_media_img' );
}

/**
 * WP HOOK on media object in content.php
 *         <div class="entry-content ...
 *              <div class="media__body ...
 */
function entry_content_media_body() {
	do_action( 'entry_content_media_body' );
}

/**
 * WP HOOK on end of id="content"
 *         </div><!-- layout -->
 *            <?php content_end(); ?>
 *      </div><!-- wrapper --> ...
 */
function content_end() {
	do_action( 'content_end' );
}

/**
 * WP HOOK on the end o the main content and sidebar
 * just before the footer starts
 *        </div><!-- wrapper -->
 *  </div><!-- #content -->
 *	<?php after_content(); ?>
 */
function after_content() {
	do_action( 'after_content' );
}

/**
 * WP HOOK before the footer </footer>
 *        </div><!-- wrapper -->
 *  </div><!-- #content -->
 *
 *      <?php before_footer(); ?>
 *  <footer ...
 */
function before_footer() {
	do_action( 'before_footer' );
}

/**
 * WP HOOK after end of footer </footer>
 *        </footer><!-- #colophon -->
 *      <?php after_footer(); ?>
 *  </div><!-- #page -->
 */
function after_footer() {
	do_action( 'after_footer' );
}