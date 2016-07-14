<?php


function wps_vc_row_inner_shortcode(){

    // Remove Default Parameters
    vc_remove_param('vc_row_inner','full_width');
    vc_remove_param('vc_row_inner','gap');
    vc_remove_param('vc_row_inner','css');
    vc_remove_param('vc_row_inner','full_height');
    vc_remove_param('vc_row_inner','equal_height');
    vc_remove_param('vc_row_inner','columns_placement');
    vc_remove_param('vc_row_inner','content_placement');
    vc_remove_param('vc_row_inner','video_bg');
    vc_remove_param('vc_row_inner','parallax');
    vc_remove_param('vc_row_inner','el_id');
    vc_remove_param('vc_row_inner','el_class');
    vc_remove_param('vc_row_inner','video_bg_url');
    vc_remove_param('vc_row_inner','video_bg_parallax');
    vc_remove_param('vc_row_inner','parallax_image');
    vc_remove_param('vc_row_inner','parallax_speed_bg');
    vc_remove_param('vc_row_inner','parallax_speed_video');

    // Add custom parameters
    $attributes = array(
        
        array(
            'type' => 'textfield',
            'heading' => "Row Class (L:class)",
            'admin_label' => true,
            'param_name' => 'class',
            'value' => '',
            'group' => esc_html__( 'Row Layout', 'wps-prime' ),
            'description' => __('Add optional CSS classes to the layout element, classes can contain the column control classes defined in the theme css architecture', 'wps-prime')
        ),

        array(
            'type' => 'checkbox',
            'heading' => "Add Wrapper",
            'param_name' => 'wrapper',
            'value' => '',
            'group' => esc_html__( 'Row Wrapper', 'wps-prime' ),
            'description' => __('Add wrapper container around the layout, this is useful if you want to contain elements wne you are using the full width template. Options true/false(default false)', 'wps-prime')
        ),

        array(
            'type' => 'textfield',
            'heading' => "Add Row Wrapper class (W L W)",
            'admin_label' => true,
            'param_name' => 'wrapper_class',
            'value' => '',
            'group' => esc_html__( 'Row Wrapper', 'wps-prime' ),
            'description' => __('Add optional CSS class to the wrapper (if activated). Optional classes can contain background color extra paddings or any CSS rule that would apply to the wrapper. This setting requires a good knowledge of the css architecture used in the theme', 'wps-prime')
        ),


        
        array(
            'type' => 'textfield',
            'heading' => "Row Holder Class (H:class L H)",
            'admin_label' => true,
            'param_name' => 'holder_class',
            'value' => '',
            'group' => esc_html__( 'Row Holder Class / Bg Image', 'wps-prime' ),
            'description' => __('Add custom class to be applied on the layout outer holder element. Ex: add (predefined) class that centers the background image', 'wps-prime')
        ),

        array(
            'type' => 'attach_image',
            'heading' => "Row Holder image (H L H)",
            'admin_label' => true,
            'param_name' => 'holder_img',
            'value' => '',
            'group' => esc_html__( 'Row Layout Holder Class / Bg Image', 'wps-prime' ),
            'description' => __('Add image to be used as a background for the current layout. Limit to 1 image', 'wps-prime')
        ),

        array(
            'type' => 'dropdown',
            'heading' => "Row Holder background image size (H:bg-image-size L H)",
            'param_name' => 'holder_img_size',
            'value' => wps_image_sizes(),
            'std' => 'full',
            'group' => esc_html__( 'Row Holder Class / Bg Image', 'wps-prime' ),
            'description' => __('Add image to be used as a background for the current layout. Limit to 1 image', 'wps-prime')
        )
    );

    vc_add_params('vc_row_inner',$attributes);
    vc_map_update('vc_row_inner', array('html_template' => locate_template('vc_templates/vc_row_inner.php')) );
}