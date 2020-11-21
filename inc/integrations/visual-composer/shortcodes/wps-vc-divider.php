<?php

function wps_vc_divider_shortcode() {

    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Divider style','wps-prime'),
            'param_name' => 'style',
            'value' => array(
                            __('Line','wps-prime')   => '',
                            __('Dots','wps-prime')      => 'c-divider--dotted',
                            __('Dashes','wps-prime')     => 'c-divider--dashed'
                            ),
            'description' => __('Line | Dots | Dashes', 'wps-prime')
        ),

        array(
            'type' => 'textfield',
            'heading' => __('Custom Class','wps-prime'),
            'admin_label' => true,
            'param_name' => 'class',
            'value' => '',
            'group' => __( 'Advanced', 'wps-prime' ),
            'description' => __('custom element class', 'wps-prime')
        ),
        
        array(
            'type' => 'textfield',
            'heading' => __('Text','wps-prime'),
            'admin_label' => true,
            'param_name' => 'text',
            'value' => '',
            'group' => __( 'Text', 'wps-prime' ),
            'description' => __('Divider text', 'wps-prime')
        ),

        array(
            'type' => 'dropdown',
            'heading' => __('Text Position','wps-prime'),
            'admin_label' => true,
            'param_name' => 'text_position',
            'value' => array(
                __('Left','wps-prime')   => 'left',
                __('Center','wps-prime') => 'center',
                __('Right','wps-prime')  => 'right'
                ),
            'group' => __( 'Text', 'wps-prime' ),
            'description' => __('Divider text position (default left)', 'wps-prime')
            ),

        array(
                'type' => 'dropdown',
                'heading' => 'Size',
                'admin_label' => true,
                'param_name' => 'text_size',
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
                        'std' => 'u-h4',
                        'group' => __( 'Text', 'wps-prime' ),
                        'description' => __('Divider text size default (h4)', 'wps-prime')
            ),    

        array(
            'type' => 'textfield',
            'heading' => __('Custom Text Class','wps-prime'),
            'admin_label' => true,
            'param_name' => 'text_class',
            'value' => '',
            'group' => __( 'Text', 'wps-prime' ),
            'description' => __('custom text CSS class', 'wps-prime')
        ),

        array(
                'type' => 'textfield',
                'heading' => 'Animation data CSS class',
                'param_name' => 'anim_data',
                'admin_label' => true,
                'value' => '',
                'group' => __( 'Animation', 'wps-prime' ),
                'description' => __('Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-prime')
            ),
        );

        // Add margins and paddings
        $attributes = array_merge($attributes,wps_vc_spacing_params());

     // Title
    vc_map(
        array(
            'name' => __( 'Content Divider', 'wps-prime' ),
            'description'=> __('Creates a horizontal line, use to separate content','wps-prime'),
            'base' => 'wps_divider',
            'category' => __( 'Content', 'wps-prime' ),
            'params' => $attributes,
            'icon' => 'icon-wpb-ui-separator'
        )
    );
}