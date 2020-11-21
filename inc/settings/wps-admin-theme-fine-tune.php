<?php
/**
 *  WPS THEME FINE TUNE
 *
 *  1  Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
 *  2  Remove Comment Form Allowed Tags
 *  3  Customize Comment Form Place Holder Input Text Fields & Labels http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
 *  4  Customize Comment Form Text Area & Label http://wpsites.net/web-design/customize-comment-field-text-area-label/
 *  5  Removes empty paragraph tags (<p></p>) and line break tags (<br>) from shortcodes caused by WordPress's wpautop function.
 *  6  Add a pingback url auto-discovery header for singularly identifiable articles.
 *  7  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *	8  Adds custom classes to the array of body classes.
 *	9  Sets the authordata global when viewing an author archive.
 *	10 Disable WP default dashicons.
 *	11 Disable WP default emoji.
 *  12 We will need the following filter function to disable TinyMCE emojicons
 *  13 Disable Comment form URL
 *  14 Allow shortcode in text widget
 *  15 Allow shortcode in widget title
 *	16 Allow shortcode in menu titles
 *  17 Custom WP gallery styles | Disable WP default gallery style and use our own see: _components.galleries.scss 
 *  18 Allow svg upload
 *
 * @package wps_prime_2
 *
 */


/**
 * 1 Remove wp version param from any enqueued scripts/styles
 *
 * @param string $src Scripts and scripts.
 * @return string
 *
 */
if ( get_option( 'wps_remove_assets_version_numbers' ) ) {
add_filter( 'script_loader_src', 'wps_prime_remove_wp_ver_css_js', 15, 1 );
add_filter( 'style_loader_src', 'wps_prime_remove_wp_ver_css_js', 15, 1 );
}

function wps_prime_remove_wp_ver_css_js( $src ) {
	$parts = explode( '?ver', $src );
	return $parts[0];
}

//  completely remove your WordPress version number from both your head file and RSS feeds
add_filter('the_generator', 'wp_remove_version');
remove_action('wp_head', 'wp_generator');

function wp_remove_version() {  return '';  }

/**
 * 2  Remove Comment Form Allowed Tags
 *
 * @param array $defaults All the parameters of allowed form tags.
 * @return array
 *
 */
add_filter( 'comment_form_defaults', 'wps_remove_comment_form_allowed_tags' );

function wps_remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}


/**
 * 3  Customize Comment Form Place Holder Input Text Fields & Labels
 *
 * @param array $fields All the parameters of the comment form fields.
 * @return array
 */
add_filter( 'comment_form_default_fields','wps_modify_comment_form_fields' );

if(!function_exists('wps_modify_comment_form_fields')){

	function wps_modify_comment_form_fields( $fields ) {

		// Setup Variables.
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields['author'] = '<p class="comment-form-author"><label for="author" class="comment-form__label">' . _x( 'Name', 'comment form author name' ,'wps-prime' ) . '</label> ' .

		( $req ? '<span class="required">*</span>' : '' ) .

		'<input id="author" class="comment-form__field" name="author" type="text" placeholder="' . __( 'Real name, please, no keyword spamming!', 'wps-prime' ) . '" value="' .

		esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields['email'] = '<p class="comment-form-email"><label for="email" class="comment-form__label">' . __( 'E-mail', 'wps-prime' ) . '</label> ' .

		( $req ? '<span class="required">*</span>' : '' ) .

		'<input id="email" class="comment-form__field" name="email" type="text" placeholder="' . __( 'add e-mail address', 'wps-prime' ) . '" value="' .

		esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields['url'] = '<p class="comment-form-url"><label for="url" class="comment-form__label">' . __( 'Domain', 'wps-prime' ) . '</label><input id="url" class="comment-form__field" name="url" type="text" placeholder="Please Link To Your Own Domain" value="' .

		esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
	
		/**
		 * Use unset to disable the url field in the commment form
		 * if ( isset( $fields['url'] ) ) { unset( $fields['url'] ); }
		 */
	
		return $fields;
	}
}


/**
 * 4  Customize Comment Form Text Area & Label
 *
 * @param array $args All the comment form html elements.
 * @return array
 */
add_filter( 'comment_form_defaults', 'wps_customize_comment_form_text_area' );

if(!function_exists('wps_customize_comment_form_text_area')){

	function wps_customize_comment_form_text_area( $args ) {
		$args['comment_field'] = '<p class="comment-form-comment"><label for="comment" class="comment-form__label">' . _x( 'Comment', '', 'wps-prime' ) . '</label><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . _x( 'Your Feedback Is Appreciated', '', 'wps-prime' ) . '"cols="45" rows="5" aria-required="true"></textarea></p>';
		return $args;
	}
	
}

/**
 * 5
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */

add_filter( 'the_content', 'wps_remove_empty_tags_around_shortcodes' );

function wps_remove_empty_tags_around_shortcodes( $content ) {
	$tags = array(
		'<p>[' => '[',
		']</p>' => ']',
		']<br>' => ']',
		']<br />' => ']',
	);

	$content = strtr( $content, $tags );
	return $content;
}



/**
 * 6
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'wps_prime_pingback_header' );

function wps_prime_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}


/**
 * 7
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 *
 */

function wps_prime_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


/**
 * 8
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 *
 */
add_filter( 'body_class', 'wps_prime_body_classes' );

function wps_prime_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}


/**
 * 9
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function wps_prime_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'wps_prime_setup_author' );

/**
 * 10
 * Disable WP default dashicons
 * disabled only for logged out users
 */
if ( get_option( 'wps_front_dashicons_use' ) ) {
	add_action( 'wp_enqueue_scripts','wps_prime_disable_wp_styles' );
}

function wps_prime_disable_wp_styles() {
	if ( ! is_user_logged_in() && ! in_array( $_SERVER['PHP_SELF'], array( '/wp-login.php', '/wp-register.php' ) ) ) {
		wp_deregister_style( 'dashicons' );
		wp_deregister_style( 'editor' );
	}
}

/**
 * 11
 * Disable WP default emoji
 */
if ( get_option( 'wps_front_emoji_use' ) ) {
	add_action( 'init','wps_disable_wp_emojicons' );
}

function wps_disable_wp_emojicons() {

	// all actions related to emojis
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'wps_disable_emojicons_tinymce' );

	// remove the DNS prefetch by returning false on filter emoji_svg_url 
	add_filter( 'wp_resource_hints', 'wps_disable_emojis_remove_dns_prefetch', 10, 2 );
}

/**
 * 12
 * We will need the following filter function to disable TinyMCE emojicons
 * Setting controlled by option 11
 */

function wps_disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * 12.1
 * Remove emoji CDN hostname from DNS prefetching hints.
 */
function wps_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}


/**
 * 13
 *	Disable Comment form URL
 */

if ( get_option( 'wps_disable_comment_url' ) ) {
	add_filter('comment_form_default_fields','wps_unset_url_field_in_comment');
}

function wps_unset_url_field_in_comment( $fields ){
	if ( isset( $fields['url'] ) ) { unset( $fields['url'] ); }
	return $fields;
}


/**
 * 14
 * Allow shortcode in text widget 
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * 15
 * Allow shortcode in widget title
 */
add_filter('widget_title',  'wps_shortcode_in_widget_title');
function wps_shortcode_in_widget_title($title){
    return do_shortcode(htmlspecialchars_decode($title));
}


/**
 * 16
 * Allow shortcode in menu titles
 */
add_filter('wp_nav_menu', 'do_shortcode'); 


/**
 * 17
 * Custom WP-Gallery CSS 
 */
/* Disable WP default gallery style and use our own see: _components.galleries.scss */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * 18
 * Allow svg upload
 */
add_filter('upload_mimes', 'wps_custom_upload_mimes');

function wps_custom_upload_mimes ( $existing_mimes=array() ) {

  // add the file extension to the array

  $existing_mimes['svg'] = 'mime/type';

        // call the modified list of extensions

  return $existing_mimes;

}

/*
* WordPress has trouble with the width and height attributes for SVGs. 
* The width and height attributes can be removed for SVGs using this code adapted from trac ticket #26256
*/

/**
 * Removes the width and height attributes of <img> tags for SVG
 * 
 * Without this filter, the width and height are set to "1" since
 * WordPress core can't seem to figure out an SVG file's dimensions.
 * 
 * For SVG:s, returns an array with file url, width and height set 
 * to null, and false for 'is_intermediate'.
 * 
 * @wp-hook image_downsize
 * @param mixed $out Value to be filtered
 * @param int $id Attachment ID for image.
 * @return bool|array False if not in admin or not SVG. Array otherwise.
 */
function wps_fix_svg_size_attributes( $out, $id ) {
    $image_url  = wp_get_attachment_url( $id );
    $file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

    if ( is_admin() || 'svg' !== $file_ext ) {
        return false;
    }

    return array( $image_url, null, null, false );
}
add_filter( 'image_downsize', 'wps_fix_svg_size_attributes', 10, 2 ); 


// Apparently custom nav menu walkers are not supported though they were supposed to be.
add_filter( 'wp_nav_menu_args', function( $args ) {
    if ( isset( $args['walker'] ) && is_string( $args['walker'] ) && class_exists( $args['walker'] ) ) {
        $args['walker'] = new $args['walker'];
    }
    return $args;
}, 1001 ); // 1001 because \WP_Customize_Nav_Menus::filter_wp_nav_menu_args() runs at 1000.

/**
 * 19 Disable jquery migrate
 */

if ( get_option( 'wps_front_jquery_migrate_use' ) ) {
	add_action( 'wp_default_scripts','wps_remove_jquery_migrate' );
}

function wps_remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

