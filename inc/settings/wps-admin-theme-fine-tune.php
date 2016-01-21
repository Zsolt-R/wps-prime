<?php
/**
 *  WPS THEME FINETUNES
 *
 * Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
 * Remove Comment Form Allowed Tags
 * Customize Comment Form Place Holder Input Text Fields & Labels http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
 * Customize Comment Form Text Area & Label http://wpsites.net/web-design/customize-comment-field-text-area-label/
 * Removes empty paragraph tags (<p></p>) and line break tags (<br>) from shortcodes caused by WordPress's wpautop function.
 * Allow shortcode in text widget
 * Allow shortcode in widget title
 * Disable WP dashicons (for logged out users)
 * Disable WP emoji and all sripts related
 * Sets the authordata global when viewing an author archive
 * Ad custom classes to the array of body classes | is_multi_author() group-blog ; ! is_singular() 'hfeed';
 *
 * @package wps_prime
 */

/* Remove wp version param from any enqueued styles */
add_filter( 'style_loader_src', 'wps_prime_remove_wp_ver_css_js', 10, 2 );

/* Remove wp version param from any enqueued scripts */
add_filter( 'script_loader_src', 'wps_prime_remove_wp_ver_css_js', 10, 2 );

/* Remove Comment Form Allowed Tags */
add_filter( 'comment_form_defaults', 'remove_comment_form_allowed_tags' );

/* Customize Comment Form Place Holder Input Text Fields & Labels */
add_filter( 'comment_form_default_fields','modify_comment_form_fields' );

/* Customize Comment Form Text Area & Label */
add_filter( 'comment_form_defaults', 'customize_comment_form_text_area' );

/* Removes empty paragraph tags (<p></p>) and line break tags (<br>) from shortcodes caused by WordPress's wpautop function. */
add_filter( 'the_content', 'remove_empty_tags_around_shortcodes' );

/* Allow shortcode in text widget */
add_filter( 'widget_text', 'do_shortcode' );

/* Allow shortcode in widget title */
add_filter( 'widget_title', 'do_shortcode' );

/* Get option from settings */
if( 'disable' === wps_get_theme_option('wps_front_dashicons_use') ){
	add_action('wp_enqueue_scripts','wps_prime_disable_wp_styles');
}

/* Get option from settings */
if( 'disable' === wps_get_theme_option('wps_front_emoji_use') ){
	add_action('init','disable_wp_emojicons');
}

/**
 *  1  Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
 *  2  Remove Comment Form Allowed Tags
 *  3  Customize Comment Form Place Holder Input Text Fields & Labels http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
 *  4  Customize Comment Form Text Area & Label http://wpsites.net/web-design/customize-comment-field-text-area-label/
 *  5  Removes empty paragraph tags (<p></p>) and line break tags (<br>) from shortcodes caused by WordPress's wpautop function.
 */

/**
 * 1 Remove wp version param from any enqueued scripts/scripts
 *
 * @param string $src Scripts and styles.
 * @return string
 */
function wps_prime_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, '?rev=' ) ) {
		$src = remove_query_arg( 'rev', $src ); }
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src ); }
	return $src;
}

/**
 * 2  Remove Comment Form Allowed Tags
 *
 * @param array $defaults All the parameters of allowed form tags.
 * @return array
 */
function remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

/**
 * 3  Customize Comment Form Place Holder Input Text Fields & Labels
 *
 * @param array $fields All the parameters of the comment form fields.
 * @return array
 */
function modify_comment_form_fields( $fields ) {

	// Setup Variables.
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields['author'] = '<p class="comment-form-author"><label for="author" class="comment-form__label">' . _x( 'Name', 'wps-prime' ) . '</label> ' .

	( $req ? '<span class="required">*</span>' : '' ) .

	'<input id="author" class="comment-form__field" name="author" type="text" placeholder="' . _x( 'Real name, please, no keyword spamming!', 'wps-prime' ) . '" value="' .

	esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['email'] = '<p class="comment-form-email"><label for="email" class="comment-form__label">' . __( 'E-mail', 'wps-prime' ) . '</label> ' .

	( $req ? '<span class="required">*</span>' : '' ) .

	'<input id="email" class="comment-form__field" name="email" type="text" placeholder="' . _x( 'add e-mail address', 'wps-prime' ) . '" value="' .

	esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

	$fields['url'] = '<p class="comment-form-url"><label for="url" class="comment-form__label">' . _x( 'Domain', 'wpsites.net' ) . '</label><input id="url" class="comment-form__field" name="url" type="text" placeholder="Please Link To Your Own Domain" value="' .

	esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	/**
	 * Use unset to disable the url field in the commment form
	 * if ( isset( $fields['url'] ) ) { unset( $fields['url'] ); }
	 */

	return $fields;
}


/**
 * 4  Customize Comment Form Text Area & Label
 *
 * @param array $args All the comment form html elements.
 * @return array
 */
function customize_comment_form_text_area( $args ) {

	$args['comment_field'] = '<p class="comment-form-comment"><label for="comment" class="comment-form__label">' . _x( 'Comment', 'wps-prime' ) . '</label><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . _x( 'Your Feedback Is Appreciated', 'wps-prime' ) . '"cols="45" rows="5" aria-required="true"></textarea></p>';
	return $args;

}

/**
 * 5
 * Removes empty paragraph tags (<p></p>) and line break tags (<br>)
 * from shortcodes caused by WordPress's wpautop function.
 * https://www.twirlingumbrellas.com/wordpress/remove-empty-paragraph-tags-around-shortcodes/
 *
 * @param string $content Holds the content that need to be filtered.
 * @return string
 */
function remove_empty_tags_around_shortcodes( $content ) {
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
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 */

/**
 * Function to check if a particular file exists
 *
 * @link ref. http://stackoverflow.com/questions/7684771/how-check-if-file-exists-from-web-address-url-in-php
 * @param string $url file location.
 * @return bool
 */
function wps_url_exist( $url ) {
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_NOBODY, true );
	curl_exec( $ch );
	$code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

	if ( 200 === $code ) {
		$status = true;
	} else {
		$status = false;
	}
	curl_close( $ch );
	return $status;
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function wps_prime_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
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
add_filter( 'body_class', 'wps_prime_body_classes' );

/**
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
 * Disable WP default dashicons
 * disabled only for logged out users
 */
function wps_prime_disable_wp_styles(){
	
	if ( !is_user_logged_in() && !in_array( $_SERVER['PHP_SELF'], array( '/wp-login.php', '/wp-register.php' )) ){
		wp_deregister_style('dashicons');
		wp_deregister_style('editor');
	}
}

/**
 * Disable WP default emoji
 */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

/**
 * We will need the following filter function to disable TinyMCE emojicons
 */
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
