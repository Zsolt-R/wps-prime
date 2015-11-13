<?php
/**
 *
 *  WP Fine Tune
 *  Here we store the Wp helper functions
 *   
 *  Version: 1.0.1
 *  
 *  Author: Zsolt Revay
 */

/*************************************
*   WPS THEME FINETUNES
*
*
*  1  Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
*  2  Remove Comment Form Allowed Tags
*  3  Customize Comment Form Place Holder Input Text Fields & Labels http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
*  4  Customize Comment Form Text Area & Label http://wpsites.net/web-design/customize-comment-field-text-area-label/
*  5  Removes empty paragraph tags (<p></p>) and line break tags (<br>) from shortcodes caused by WordPress's wpautop function.
*   
*************************************/

/* 1 */ // Remove wp version param from any enqueued scripts 

add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 10, 2 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 10, 2 );

function vc_remove_wp_ver_css_js( $src ) {
  if( strpos( $src, '?rev=' ) ) 
    $src = remove_query_arg( 'rev', $src );
  if( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

/* 2 */ // Remove Comment Form Allowed Tags

add_filter( 'comment_form_defaults', 'remove_comment_form_allowed_tags' );

function remove_comment_form_allowed_tags( $defaults ) {
 
    $defaults['comment_notes_after'] = '';
    return $defaults;
 
}


/* 3 */ // Customize Comment Form Place Holder Input Text Fields & Labels

function modify_comment_form_fields($fields){

    //Setup Variables
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] = '<p class="comment-form-author">' . '<label for="author" class="comment-form__label">' . __( 'Name', 'converter_module' ) . '</label> ' . 

    ( $req ? '<span class="required">*</span>' : '' ) .
                    
    '<input id="author" class="comment-form__field" name="author" type="text" placeholder="' . _x( 'Real name, please, no keyword spamming!', 'converter_module' ) . '" value="' . 
                    
    esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
                    
    $fields['email'] = '<p class="comment-form-email"><label for="email" class="comment-form__label">' . __( 'E-mail', 'converter_module' ) . '</label> ' .
    
    ( $req ? '<span class="required">*</span>' : '' ) .
    
    '<input id="email" class="comment-form__field" name="email" type="text" placeholder="' . _x( 'add e-mail address', 'converter_module' ) . '" value="' . 
    
    esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    

    // Comment out url from comment form field

    //$fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Domain', 'wpsites.net' ) . '</label>' .
    //
    //'<input id="url" name="url" type="text" placeholder="Please Link To Your Own Domain" value="' . 
    //
    //esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

    if(isset($fields['url']))
    unset($fields['url']);

    
    return $fields;
}
 
add_filter('comment_form_default_fields','modify_comment_form_fields');


/* 4 */ // Customize Comment Form Text Area & Label

add_filter('comment_form_defaults', 'customize_comment_form_text_area');

function customize_comment_form_text_area($arg) {

    $arg['comment_field'] = '<p class="comment-form-comment"><label for="comment" class="comment-form__label">' . _x( 'Comment', 'converter_module' ) . '</label><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . _x( 'Your Feedback Is Appreciated', 'converter_module' ) . '"cols="45" rows="5" aria-required="true"></textarea></p>';
    return $arg;

} 


/* 5 */
/*
 * Removes empty paragraph tags (<p></p>) and line break tags (<br>)
 * from shortcodes caused by WordPress's wpautop function.
 * https://www.twirlingumbrellas.com/wordpress/remove-empty-paragraph-tags-around-shortcodes/
 */

add_filter('the_content', 'remove_empty_tags_around_shortcodes');

function remove_empty_tags_around_shortcodes($content) {
    $tags = array(
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br>' => ']',
        ']<br />' => ']'
    );
 
    $content = strtr($content, $tags);
    return $content;
}
 

?>