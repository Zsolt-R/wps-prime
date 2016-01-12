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
 *   - theme_header
 *       - layout_header__img
 *       - layout_header__body
 *
 *  MAIN CONTENT Hooks layout
 *
 *   - before_content
 *   - content_start
 *   - content_end
 *
 *  MAIN SIDEBAR Hooks layout
 *
 *
 *  FOOTER Hooks layout
 *
 *   - footer_start
 *   - footer_end
 */

/**
 * WP HOOK to add in the head before the main nav <div class="header-content">
 */
function theme_header() {
	do_action( 'theme_header' );
}

/**
 * Theme header layout media object element
 */
function layout_header__img() {
	do_action( 'layout_header__img' );
}

/**
 * Theme header layout media object element
 */
function layout_header__body() {
	do_action( 'layout_header__body' );
}

/**
 * WP HOOK to add after the opening body tag <body>
 */
function body_start() {
	do_action( 'body_start' );
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
 * WP HOOK after end of footer </footer>
 *        </div><!-- wrapper -->
 *  </div><!-- #content -->
 *
 *      <?php footer_start(); ?>
 *  <footer ...
 */
function footer_start() {
	do_action( 'footer_start' );
}

/**
 * WP HOOK after end of footer </footer>
 *        </footer><!-- #colophon -->
 *      <?php footer_end(); ?>
 *  </div><!-- #page -->
 */
function footer_end() {
	do_action( 'footer_end' );
}
