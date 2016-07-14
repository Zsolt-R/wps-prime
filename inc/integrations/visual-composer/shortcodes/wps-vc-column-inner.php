<?php


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
            'param_name' => 'layout_width',
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
            'description' => __('Add optional CSS classes to the layout__item element', 'wps-prime')
        ),
        array(
            'type' => 'attach_image',
            'heading' => "Bg Image",
            'admin_label' => true,
            'param_name' => 'inner_img',
            'value' => '',
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Add image to be used as a background. Limit to 1 image', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Background image size",
            'param_name' => 'inner_img_size',
            'admin_label' => true,
            'value' => wps_image_sizes(),
            'std' => 'full',
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Select background image size (image will be stretched)', 'wps-prime')
        ),

        array(
            'type' => 'textfield',
            'heading' => "Column item inner element class",
            'param_name' => 'inner_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Add optional CSS classes to the layout__item_inner element', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => "Inner element turn off",
            'param_name' => 'inner',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Inner element', 'wps-prime' ),
            'description' => __('Turn off the inner element (by default true if inner_class is specified )', 'wps-prime')
        ),

        //'js_view' => 'VcColumnView',
    );

    vc_add_params('vc_column_inner',$attributes);

    vc_map_update('vc_column_inner', array('html_template' => locate_template('vc_templates/vc_column_inner.php')) );
}