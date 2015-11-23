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
 */
function remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

/**
 * 3  Customize Comment Form Place Holder Input Text Fields & Labels
 *
 * @param array $fields All the parameters of the comment form fields.
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
 * @param array $args All the comment form html elements.
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
 * @param string $content Holds the content that need to be filtered.
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
