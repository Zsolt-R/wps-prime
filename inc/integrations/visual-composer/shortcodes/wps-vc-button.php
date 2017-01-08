<?php

function wps_vc_button_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Button link',
            'admin_label' => true,
            'param_name' => 'link',
            'value' => '',
            'description' => __('link address – ex: http://yourlink.com/yourpage', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Button label',
            'admin_label' => true,
            'param_name' => 'label',
            'value' => 'Please add label',
            'description' => __('button text – ex: Click me', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Button Color',
            'admin_label' => true,
            'param_name' => 'color',
            'value' => wps_btn_color(),
            'description' => __('Set button color', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Button Size',
            'admin_label' => true,
            'param_name' => 'size',
            'value' => wps_btn_size(),
            'description' => __('Set button size', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Button Ghost',
            'admin_label' => true,
            'param_name' => 'ghost',
            'description' => __('Make this a ghost button', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Button Aspect',
            'admin_label' => true,
            'param_name' => 'aspect',
            'value' => wps_btn_aspect(),
            'description' => __('Set button aspect', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Button align',
            'admin_label' => true,
            'param_name' => 'align',
            'value' => wps_btn_pos(),
            'description' => __('The Button will move to a new line', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Custom CSS class',
            'admin_label' => true,
            'param_name' => 'class',            
            'value' => '',
            'description' => __('<small>Add custom classes defined in the theme stylesheet. Combine classes to get different looking buttons. ex. btn--custom-css</small>', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Link target',
            'param_name' => 'target',
            'value' => array(
                            __('Default','wps-prime')   => '',
                            __('New tab')               => '_blank'
                            ),
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/><small> _blank (Opens the linked document in a new window or tab</small>)', 'wps-prime')
        ),
                // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Padding",
            'param_name' => 'set_padding',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => "Padding Settings",
            'param_name' => 'padding',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
    );

    // Title
    vc_map(
        array(
            'name' => __( 'Button' ),
            'base' => 'wps_button',
            'category' => __( 'Content' ),
            'icon' => 'icon-wpb-ui-button',
            'params' => $attributes

        )
    );
}