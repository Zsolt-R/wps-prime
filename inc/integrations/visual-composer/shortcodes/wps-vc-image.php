<?php

 function wps_vc_image_shortcode() {

    // Add custom parameters
    $attributes = array(
        array(
            'type' => 'attach_image',
            'heading' => 'Select Image',
            'admin_label' => true,
            'param_name' => 'image_id',
            'value' => '',
            'description' => __('Set an image', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Image size',
            'param_name' => 'image_size',
            'value' => wps_image_sizes(),
            'std'=>'full',
            'description' => __('Set custom image size ( Default: full)', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Alignment',
            'admin_label' => true,
            'param_name' => 'align',
            'value' => array( 
                    __('None','wps-prime')        => '',
                    __('Right','wps-prime')       => 'alignright',
                    __('Center','wps-prime')      => 'aligncenter'
                    ),
            'description' => ''
        ),        
        array(
            'type' => 'textfield',
            'heading' => 'Image link',
            'admin_label' => true,
            'param_name' => 'link',
            'value' => '',
            'group' => esc_html__( 'Link', 'wps-prime' ),
            'description' => __('Link address ex: http://yourlink.com/yourpage', 'wps-prime')
        ), 
        array(
            'type' => 'dropdown',
            'heading' => 'Link target',
            'param_name' => 'target',
            'value' => array(
                            __('Default','wps-prime')  => '',
                            __('New tab', 'wps-prime') => '_blank'
                            ),
            'group' => esc_html__( 'Link', 'wps-prime' ),
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new tab)', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Custom CSS class', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'class',            
            'value' => '',
            'description' => __('Add custom class', 'wps-prime')
        ),
        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => __('Set Margin', 'wps-prime'),
            'param_name' => 'set_margin',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => __('Margin Settings', 'wps-prime'),
            'param_name' => 'margin',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => __('Set Padding', 'wps-prime'),
            'param_name' => 'set_padding',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => __('Padding Settings', 'wps-prime'),
            'param_name' => 'padding',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
    );

    $settings = array(

            'name' => __( 'Image' , 'wps-prime'),
            'base' => 'wps_image',
            'category' => __( 'Content', 'wps-prime'),
            'icon' => 'icon-wpb-single-image',
            'params' => $attributes      
        );

    vc_map( $settings );    
}