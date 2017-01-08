<?php
/**
* Pre Title Visibility
*/


add_action('admin_init', 'page_title_custom_meta_box_settings');
 
function page_title_custom_meta_box_settings(){
    add_meta_box('wps_title_settings', __('Page title settings', 'wps_prime') , 'page_title_settings', 'page' , 'side');
    }
 
function page_title_settings($post){

    // The nonce field is used to validate that the contents of the form request came from the current site and not somewhere else
    // https://codex.wordpress.org/Function_Reference/wp_nonce_field
    wp_nonce_field( 'set_title_visibility_nonce', 'title_visibility' ); // Nonce // nonce_action

    $checkboxMeta = get_post_meta( $post->ID );

    echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_title_visibility">Page Title visibility setting.</label></p>';    
    echo '<input type="checkbox" name="page_title_visibility" id="page_title_visibility" value="hide" '. (isset (  $checkboxMeta['page_title_visibility'] ) ? checked(  $checkboxMeta['page_title_visibility'][0], 'hide' , false ) : '') .'> Hide title';
    
    }


add_action('save_post', 'page_title_settings_save_postdata');
function page_title_settings_save_postdata( $post_id ){
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

    // Verify that a nonce is correct and unexpired with the respect to a specified action. nonce / nonce_action
    //https://codex.wordpress.org/Function_Reference/wp_verify_nonce
    if ( ( isset ( $_POST['set_title_visibility_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['set_title_visibility_nonce'], 'title_visibility' ) ) )
            return;

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

    if ( isset($_POST['page_title_visibility'])){        
          update_post_meta( $post_id , 'page_title_visibility', 'hide');
        }else{
          update_post_meta( $post_id , 'page_title_visibility', 'show');  
        }
    }