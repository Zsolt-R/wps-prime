<?php

function wps_vc_list_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => 'Bullet Style',
            'admin_label' => true,
            'param_name' => 'style',
            'value' => array(
                __('None','wps-prime') =>false,
                __('Style one','wps-prime')    =>'c-list--bullet-one',
                __('Style two','wps-prime')    =>'c-list--bullet-two',
                __('Style three','wps-prime')  =>'c-list--bullet-three',
                __('Style four','wps-prime')   =>'c-list--bullet-four',
                __('Style five','wps-prime')   =>'c-list--bullet-five',
                __('Style six','wps-prime')    =>'c-list--bullet-six',
                __('Style seven','wps-prime')  =>'c-list--bullet-seven',
                __('Style eight','wps-prime')  =>'c-list--bullet-eight',
                __('Style nine','wps-prime')   =>'c-list--bullet-nine',
                __('Style ten','wps-prime')    =>'c-list--bullet-ten',
                ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Bullet Color',
            'admin_label' => true,
            'param_name' => 'color',
            'value' => array(
                __('Default','wps-prime') =>false,
                __('Color one','wps-prime')    =>'c-list--color-one',
                __('Color two','wps-prime')    =>'c-list--color-two',
                __('Color three','wps-prime')  =>'c-list--color-three',
                __('Color four','wps-prime')   =>'c-list--color-four',
                __('Color five','wps-prime')   =>'c-list--color-five',
                __('Color six','wps-prime')    =>'c-list--color-six'
                ),
        ),  
        array(
            'type' => 'dropdown',
            'heading' => 'List items bottom border style',
            'admin_label' => true,
            'param_name' => 'deco',
            'value' => array(
                __('None','wps-prime')      =>false,
                __('Line','wps-prime')      =>'c-list--deco-lines',
                __('Dashed','wps-prime')    =>'c-list--deco-dashes',
                __('Dotted','wps-prime')    =>'c-list--deco-dots', 
                ),
        ),    
        array(
            'type' => 'textarea_html',
            'heading' => __( 'Content', 'wps-prime' ),
            'holder' => 'div',
            'group' => __( 'Content', 'wps-prime' ),            
            'param_name' => 'content',
            'description' => __('Only add lists as content. This component will only apply to lists ', 'wps-prime'),
            'value' => __( '<ul><li>List item</li><li>List item</li></ul>', 'wps-prime' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Extra Class',
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'group' => __( 'Advanced', 'wps-prime' ),
            'description' => __('Add custom CSS class to element.', 'wps-prime')
            ),  
    );

    // Title
    vc_map(
        array(
            'name' => __( 'Styled List' ),
            'base' => 'wps_list',
            'description' => 'Wrapper element for styling a list with predefined bullets|colors|lines.',
            'category' => __( 'Content' ),
            'icon' => 'icon-wpb-graph',
            'params' => $attributes 
        )
    );
}