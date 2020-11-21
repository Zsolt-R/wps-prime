<?php

// Add column to posts listing

add_filter( 'manage_pages_columns', 'wps_add_page_settings_columns' );
function wps_add_page_settings_columns( $columns ) {

    $columns['title_visibility'] = 'Title status';
    $columns['margin_top'] = 'Margin top';
    $columns['margin_bottom'] = 'Margin bottom';      
    return $columns;
}


// Echo contents of custom field in column

add_action( 'manage_pages_custom_column', 'wps_page_settings_columns_content', 10, 2 );
 function wps_page_settings_columns_content( $column_name, $post_id ) {

    if( $column_name == 'title_visibility' ) {
        $title_visibility = get_post_meta( $post_id, 'page_title_visibility', true );
        
        if($title_visibility == 'hide'){
            echo 'Hidden';
        }else{
            echo 'Visible';           
        }
    }

    if( $column_name == 'margin_top' ) {
        $margin_top = get_post_meta( $post_id, 'page_margin_top_reset', true );

        if($margin_top == 'show'){
            echo 'Yes';
        }else{
            echo 'No';
        }
        
    }

    if( $column_name == 'margin_bottom' ) {
        $margin_bottom = get_post_meta( $post_id, 'page_margin_bottom_reset', true );

        if($margin_bottom == 'show'){
            echo 'Yes';
        }else{
            echo 'No';
        }        
    }
    
}
