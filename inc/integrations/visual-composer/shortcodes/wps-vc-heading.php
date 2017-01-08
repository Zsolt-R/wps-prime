<?php

 function wps_vc_heading_shortcode() {

    // Add custom parameters
    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Heading text',
            'admin_label' => true,
            'param_name' => 'text',
            'value' => '',
            'description' => ''
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Size',
            'admin_label' => true,
            'param_name' => 'size',
            'value' => array( 
                    __('Normal','wps-prime')      => 'u-text-normal',
                    __('Large','wps-prime')       => 'u-text-large',
                    __('Huge','wps-prime')        => 'u-text-huge',
                    __('Size of H1','wps-prime')  => 'u-h1',
                    __('Size of H2','wps-prime')  => 'u-h2',
                    __('Size of H3','wps-prime')  => 'u-h3',
                    __('Size of H4','wps-prime')  => 'u-h4',
                    __('Size of H5','wps-prime')  => 'u-h5',
                    __('Size of H6','wps-prime')  => 'u-h6',

                    ),
            'description' => ''
        ),                  
        array(
            'type' => 'textfield',
            'heading' => 'Link',
            'admin_label' => true,
            'param_name' => 'link',
            'value' => '',
            'group' => __( 'Link', 'wps-prime' ),
            'description' => __('link address – ex: http://yourlink.com/yourpage', 'wps-prime')
        ), 
        array(
            'type' => 'dropdown',
            'heading' => 'Link target',
            'param_name' => 'target',
            'value' => array(
                            __('Default','wps-prime')   => '',
                            __('New tab')               => '_blank'
                            ),
            'group' => __( 'Link', 'wps-prime' ),
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new tab)', 'wps-prime')
        ),       
        array(
            'type' => 'dropdown',
            'heading' => 'Color',
            'admin_label' => true,
            'param_name' => 'color',
            'value' => wps_txt_color(),
            'description' => '',
            'group' => __( 'Advanced', 'wps-prime' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Font Weight',
            'admin_label' => true,
            'param_name' => 'weight',
            'value' => array( 
                    __('Default','wps-prime')    => '',
                    __('Thin','wps-prime')       => 'u-text-thin',
                    __('Thinner','wps-prime')    => 'u-text-thinner',
                    __('Bold','wps-prime')       => 'u-text-bold',
                    __('Bolder','wps-prime')     => 'u-text-bolder',
                    __('Normal','wps-prime')     => 'u-text-normal',
                    ),
            'description' => __( 'This setting depends on the current loaded fonts font-weight availability', 'wps-prime' ),
            'group' => __( 'Advanced', 'wps-prime' )
        ),   
        array(
            'type' => 'dropdown',
            'heading' => 'Html Tag',
            'admin_label' => true,
            'param_name' => 'html_tag',
            'value' => array( 
                    __('Default','wps-prime')    => '',
                    __('H1','wps-prime')        => 'h1',
                    __('H2','wps-prime')        => 'h2',
                    __('H4','wps-prime')        => 'h4',
                    __('H5','wps-prime')        => 'h5',
                    __('H6','wps-prime')        => 'h6',
                    ),
            'description' => 'Default: h3',
            'group' => __( 'Advanced', 'wps-prime' )
        ), 
        array(
            'type' => 'dropdown',
            'heading' => 'Text align',
            'admin_label' => true,
            'param_name' => 'text_align',
            'value' => array( 
                    __('Default','wps-prime')    => '',
                    __('Center','wps-prime')     => 'u-text-center',
                    __('Right','wps-prime')      => 'u-text-right',
                    __('Left','wps-prime')       => 'u-text-left'
                    )
        ), 
        array(
            'type' => 'textfield',
            'heading' => 'Custom CSS class',
            'admin_label' => true,
            'param_name' => 'class',            
            'value' => '',
            'description' => __('Add custom class', 'wps-prime'),
            'group' => __( 'Advanced', 'wps-prime' )
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Custom ID',
            'admin_label' => true,
            'param_name' => 'id',            
            'value' => '',
            'description' => __('Add custom css id', 'wps-prime'),
            'group' => __( 'Advanced', 'wps-prime' )
        )
    );

    // Add margins and paddings
    $attributes = array_merge($attributes,wps_vc_spacing_params());

    $settings = array(

            'name' => __( 'Heading' ),
            'base' => 'wps_heading',
            'category' => __( 'Content' ),
            'icon' => 'icon-wpb-ui-custom_heading',
            'params' => $attributes      
        );

    vc_map( $settings );    
}