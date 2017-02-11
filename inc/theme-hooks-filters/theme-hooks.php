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
 * WP HOOK to add after the opening body tag <body>
 */
function wps_body_start() {
	do_action( 'wps_body_start' );
}

/**
* Before Header Hook	
*/
function wps_before_header() {
	do_action( 'wps_before_header' );
}

/**
* Master Header Start Hook	
*/
function wps_mast_head_start() {
	do_action( 'wps_mast_head_start' );
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
* Master Header End Hook	
*/
function wps_mast_head_end() {
	do_action( 'wps_mast_head_end' );
}

/**
* After Header Hook	
*/
function wps_after_header() {
	do_action( 'wps_after_header' );
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
 * WP HOOK at the start (inside) of the main sidebar. Before the widgets
 * <aside id="secondary" <?php echo wps_main_sidebar_class(); ?> role="complementary">
 *	<?php wps_sidebar_start(); ?>
 */
function wps_sidebar_start() {
	do_action( 'wps_sidebar_start' );
}

/**
 * WP HOOK at the end (inside) of the main sidebar. After the widgets
 * 	<?php wps_sidebar_end(); ?>
 * </aside><!-- #secondary -->
 */
function wps_sidebar_end() {
	do_action( 'wps_sidebar_end' );
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
 * WP HOOK at footer start (inside)</footer>
 *   <footer id="colophon" <?php echo wps_site_footer_class(); ?> role="contentinfo">
 *   	<?php wps_footer_start(); ?>
 */
function wps_footer_start() {
	do_action( 'wps_footer_start' );
}

/**
 * WP HOOK at footer end (inside)</footer>
 *     	<?php wps_footer_end(); ?>
 *  </footer><!-- #colophon -->
 */
function wps_footer_end() {
	do_action( 'wps_footer_end' );
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

/**
 * WP HOOK after top entry meta 
 *	</div><!-- .entry-meta -->
 *	<?php  wps_single_entry_header(); // hook ?>
 */
function wps_single_entry_header() {
	do_action( 'wps_single_entry_header' );
}

/**
 * WP HOOK after top entry meta 
 *	<footer class="entry-footer">
 *		<?php wps_prime_entry_footer(); ?>
 *		<?php wps_single_entry_footer(); //hook ?>
 *	</footer><!-- .entry-footer -->
 */
function wps_single_entry_footer() {
	do_action( 'wps_single_entry_footer' );
}

/*
 * Hook list for debugging
 */

function wps_get_hook_list(){

	$hooks = array(
	    'wps_body_start',
	    'wps_before_header',
	    'wps_mast_head_start',
	    'wps_theme_header',
	    'wps_theme_header_left',
	    'wps_theme_header_right',
	    'wps_mast_head_end',
	    'wps_after_header',
	    'wps_before_content',
	    'wps_content_start',
	    'wps_content_end',
	    'wps_after_content',
	    'wps_sidebar_start',
	    'wps_sidebar_end',
	    'wps_before_footer',
	    'wps_footer_start',
	    'wps_footer_end',
	    'wps_after_footer',
	    'wps_single_entry_header',
	    'wps_single_entry_footer',
	    );

	return $hooks;
}