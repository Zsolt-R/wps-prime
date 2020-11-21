<?php

// Print checkbox in Quick Edit

add_action( 'quick_edit_custom_box', 'wps_quick_edit_page_margin', 10, 2 );

function wps_quick_edit_page_margin( $column_name, $post_type ) {
    ?>    
        
        <?php 
        switch ( $column_name ) {
        case 'title_visibility':
                ?>
                <fieldset class="inline-edit-margin">
               <div class="inline-edit-col column-<?php echo $column_name; ?>">
                <label class="alignleft"><input type="checkbox" name="page_title_visibility" class="page_title_visibility"/><span class="checkbox-title">Hide Title</span></label>
                </div>
               </fieldset>
                <?php
        break;
        case 'margin_top':
             ?>
             <fieldset class="inline-edit-margin">
            <div class="inline-edit-col column-<?php echo $column_name; ?>">
             <label class="alignleft"><input type="checkbox" name="page_margin_top_reset" class="page_margin_top_reset" /><span class="checkbox-title">Reset page top margin</span></label>
             </div>
            </fieldset>
             <?php             
        break;
        case 'margin_bottom':
             ?>
             <fieldset class="inline-edit-margin">
            <div class="inline-edit-col column-<?php echo $column_name; ?>">
             <label class="alignleft"><input type="checkbox" name="page_margin_bottom_reset" class="page_margin_bottom_reset"/><span class="checkbox-title">Reset page bottom margin</span></label>
             </div>
            </fieldset>
             <?php
        break;
        }
        ?>       
     
    <?php
}


add_action( 'admin_footer', 'wps_page_quick_edit_javascript' );
function wps_page_quick_edit_javascript() {
    $current_screen = get_current_screen();
 
    if ( $current_screen->id != 'edit-page' || $current_screen->post_type != 'page' )
    return;

    wp_enqueue_script( 'jquery' );
?>
    <script type="text/javascript">
    function page_custom_settings( data ) {    
        inlineEditPost.revert();   
        jQuery( '.page_title_visibility' ).attr( 'checked', 'hide' == data.titleVisibility ? true : false );   
        jQuery( '.page_margin_top_reset' ).attr( 'checked', 'reset' == data.topMargin ? true : false );
        jQuery( '.page_margin_bottom_reset' ).attr( 'checked', 'reset' == data.bottomMargin ? true : false );        
    }
    </script>
<?php
}



function wps_page_quickedit_set_data( $actions, $post ) {
    $data = json_encode([
        'topMargin' => get_post_meta( $post->ID, 'page_margin_top_reset', true ),
        'bottomMargin' => get_post_meta( $post->ID, 'page_margin_bottom_reset', true ),
        'titleVisibility' => get_post_meta( $post->ID, 'page_title_visibility', true )
    ]);  
    
    if ( isset( $actions['inline hide-if-no-js'] ) ) {
        $actions['inline hide-if-no-js']    = '<a href="#" class="editinline" title="';
        $actions['inline hide-if-no-js']    .= esc_attr( 'Edit this item inline' ) . '"';
        $actions['inline hide-if-no-js']    .= 'onclick=page_custom_settings('.$data.') >';
        $actions['inline hide-if-no-js']    .= 'Quick Edit';
        $actions['inline hide-if-no-js']    .= '</a>';
    }
    

    return $actions;
}
add_filter('page_row_actions', 'wps_page_quickedit_set_data', 10, 2);