<?php
/**
* Pre Content Area
*/


add_action('admin_init', 'wps_wysiwyg_register_custom_meta_box');
 
function wps_wysiwyg_register_custom_meta_box(){
    add_meta_box('wps_page_settings', __('Page Pre Content', 'wps-prime') , 'wps_page_pre_content', 'page');
    }
 
function wps_page_pre_content($post){

    // The nonce field is used to validate that the contents of the form request came from the current site and not somewhere else
    // https://codex.wordpress.org/Function_Reference/wp_nonce_field
    wp_nonce_field( 'pre_content_nonce', 'pre_content' ); // Nonce // nonce_action

    echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label">Content before the main page content.</label></p>';
    $content = get_post_meta($post->ID, 'page_pre_content', true);
    wp_editor(htmlspecialchars_decode($content) , 'page_pre_content', array(
        "media_buttons" => true,
        'teeny' => false,
        'quicktags' => true,
        'drag_drop_upload' => true,
        'textarea_rows'=>6,
        'tinymce' => array(
          'resize' => false,
          'wp_autoresize_on' => true
        )
    ));
    }


add_action('save_post', 'wps_page_pre_content_save_postdata');
function wps_page_pre_content_save_postdata( $post_id ){
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

    // Verify that a nonce is correct and unexpired with the respect to a specified action. nonce / nonce_action
    //https://codex.wordpress.org/Function_Reference/wp_verify_nonce
    if ( ( isset ( $_POST['pre_content_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['pre_content_nonce'], 'pre_content' ) ) )
            return;

    $slug = "page"; //post-type check
    $cur_post = get_post($post_id);
    if($slug != $cur_post->post_type){
        return $post_id;
    }

    // Check if we are on a page and not other post type and user is allowed to edit these fields
    if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }    
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

    if ( isset($_POST['page_pre_content'])){
            update_post_meta($post_id , 'page_pre_content', $_POST['page_pre_content']);
        }
    }