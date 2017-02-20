<?php
/*
* WPS Custom inner column component  options setup
*/

function wps_vc_column_inner_shortcode(){

    vc_remove_param('vc_column_inner','css');
    vc_remove_param('vc_column_inner','offset');
    vc_remove_param('vc_column_inner','el_class');
    // vc_remove_param('vc_column__inner','full_height');
    // vc_remove_param('vc_column__inner','equal_height');
    // vc_remove_param('vc_column__inner','columns_placement');
    // vc_remove_param('vc_column__inner','content_placement');
    // vc_remove_param('vc_column__inner','video_bg');
    // vc_remove_param('vc_column__inner','parallax');
    // vc_remove_param('vc_column__inner','el_id');    
    // vc_remove_param('vc_column__inner','video_bg_url');
    // vc_remove_param('vc_column__inner','video_bg_parallax');
    // vc_remove_param('vc_column__inner','parallax_image');
    // vc_remove_param('vc_column__inner','parallax_speed_bg');
    // vc_remove_param('vc_column__inner','parallax_speed_video');

    //Get VC gallery shortcode config
    //$shortcode_vc_gallery_tmp = WPBMap::getShortCode('vc_column');

 
    //Loop over config to find the condition we want to change
    //foreach($shortcode_vc_gallery_tmp['params'] as $key => $param)
    //{
    //    
    //} 
 
    //VC doesn't like even the thought of you changing the shortcode base, and errors out, so we unset it.
    //unset($shortcode_vc_gallery_tmp['base']);
 
    //Update the actual parameter
    //vc_map_update('vc_column', $shortcode_vc_gallery_tmp);

    $attributes = array(

        array(
            'type' => 'wps_column_offset',
            'heading' => __( 'Responsiveness', 'wps-prime' ),
            'param_name' => 'row_width',
            'group' => __( 'Responsive Options', 'wps-prime' ),
            'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'wps-prime' ),
        ),

        array(
            'type' => 'textfield',
            'heading' => "Column item class",
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Column item', 'wps-prime' ),
            'description' => __('Add optional CSS classes to the col element', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => "Column item inner element class",
            'param_name' => 'inner_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Add optional CSS classes to the col_inner element', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Vertical align elements",
            'param_name' => 'align_content_inner',
            'admin_label' => true,
            'value' =>  wps_col_inner_element_vertical_align(),
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Vertical align all the elements in the column', 'wps-prime')
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin',
            'admin_label' => false,
            'group' => esc_html__( 'Column item', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            'group' => esc_html__( 'Column item', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Padding",
            'param_name' => 'set_padding',
            'admin_label' => false,
            'group' => esc_html__( 'Column item', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => "Padding Settings",
            'param_name' => 'padding',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding', 'value' => 'true'),
            'group' => esc_html__( 'Column item', 'wps-prime' ),
        ),
        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin_inner',
            'admin_label' => false,
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin_inner',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin_inner', 'value' => 'true'),
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Padding",
            'param_name' => 'set_padding_inner',
            'admin_label' => false,
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => "Padding Settings",
            'param_name' => 'padding_inner',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding_inner', 'value' => 'true'),
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => "Background effects",
            'param_name' => 'inner_bg_fx',
            'admin_label' => true,
            'value' => wps_bg_fx(),
            'std' => '',
            'group' => __( 'Inner Bg / Image', 'wps-prime' ),
            'description' => __('Background Effects', 'wps-prime')
        ),
        array(
            'type' => 'attach_image',
            'heading' => "Bg Image",
            'admin_label' => true,
            'param_name' => 'inner_img',
            'value' => '',
            'group' => esc_html__( 'Inner Bg / Image', 'wps-prime' ),
            'description' => __('Add image to be used as a background. Limit to 1 image', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Background image size",
            'param_name' => 'inner_img_size',
            'admin_label' => true,
            'value' => wps_image_sizes(),
            'std' => 'full',
            'group' => esc_html__( 'Inner Bg / Image', 'wps-prime' ),
            'description' => __('Select background image size (image will be stretched)', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Background image behavior",
            'param_name' => 'inner_img_behave',
            'admin_label' => true,
            'value' => wps_bg_behavior(),
            'std' => '',
            'group' => __( 'Inner Bg / Image', 'wps-prime' ),
            'description' => __('Background image behavior settings', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Background position",
            'param_name' => 'inner_img_pos',
            'admin_label' => true,
            'value' => wps_bg_positions(),
            'std' => '',
            'group' => __( 'Inner Bg / Image', 'wps-prime' ),
            'description' => __('Background Image Position', 'wps-prime')
        ),
    );

    vc_add_params('vc_column_inner',$attributes);

    vc_map_update('vc_column_inner', array('html_template' => locate_template('vc_templates/vc_column_inner.php')) );
}