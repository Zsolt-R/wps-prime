<?php
/**
* Page margin settings
*/


add_action('admin_init', 'page_margin_custom_meta_box_settings');
 
function page_margin_custom_meta_box_settings(){
    add_meta_box('wps_page_margins_settings', __('Page margins adjust', 'wps-prime') , 'page_margin_settings', 'page' , 'side');
    }
 
function page_margin_settings($post){

    // The nonce field is used to validate that the contents of the form request came from the current site and not somewhere else
    // https://codex.wordpress.org/Function_Reference/wp_nonce_field
    wp_nonce_field( 'set_page_margins_nonce', 'page_margins' ); // nonce // nonce_action

    $checkboxMeta = get_post_meta( $post->ID );  

       
        
    echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_margin_top">Reset page top margin.</label></p>';    
    echo '<input type="checkbox" name="page_margin_top_reset" id="page_margin_top" value="reset"  '. (isset (  $checkboxMeta['page_margin_top_reset'] ) ? checked(  $checkboxMeta['page_margin_top_reset'][0], 'reset' , false ) : '') .'> Reset top';
    echo '<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="page_margin_bottom">Reset page bottom margin.</label></p>';    
    echo '<input type="checkbox" name="page_margin_bottom_reset" id="page_margin_bottom" value="reset"  '. (isset (  $checkboxMeta['page_margin_bottom_reset'] ) ? checked(  $checkboxMeta['page_margin_bottom_reset'][0], 'reset' , false ) : '') .'> Reset bottom';


    }


add_action('save_post', 'page_margin_settings_save_postdata');
function page_margin_settings_save_postdata($post_id){
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

    // Verify that a nonce is correct and unexpired with the respect to a specified action. nonce / nonce_action
    //https://codex.wordpress.org/Function_Reference/wp_verify_nonce
    if ( ( isset ( $_POST['set_page_margins_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['set_page_margins_nonce'], 'page_margins' ) ) ) 
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


    if ( isset($_POST['page_margin_bottom_reset'])){
        update_post_meta( $post_id , 'page_margin_bottom_reset', 'reset');
        }else{
        update_post_meta( $post_id , 'page_margin_bottom_reset', 'show');  
        }

    if ( isset($_POST['page_margin_top_reset'])){
        update_post_meta( $post_id , 'page_margin_top_reset', 'reset');
        }else{
        update_post_meta( $post_id , 'page_margin_top_reset', 'show');  
        }
    }