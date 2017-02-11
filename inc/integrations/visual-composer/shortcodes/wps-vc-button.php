<?php

function wps_vc_button_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => __('Button link', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'link',
            'value' => '',
            'description' => __('link address ex: http://yourlink.com/yourpage', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Button label', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'label',
            'value' => 'Please add label',
            'description' => __('button text ex: Click me', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Button Color', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'color',
            'value' => wps_btn_color(),
            'description' => __('Set button color', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Button Size', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'size',
            'value' => wps_btn_size(),
            'description' => __('Set button size', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => __('Button Ghost', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'ghost',
            'value' => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
            'description' => __('Make this a ghost button', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Button Aspect', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'aspect',
            'value' => wps_btn_aspect(),
            'description' => __('Set button aspect', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Button align', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'align',
            'value' => wps_btn_pos(),
            'description' => __('The Button will move to a new line', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Custom CSS class', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'class',            
            'value' => '',
            'description' => __('<small>Add custom classes defined in the theme stylesheet. Combine classes to get different looking buttons. ex. btn--custom-css</small>', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Link target', 'wps-prime'),
            'param_name' => 'target',
            'value' => array(
                            __('Default','wps-prime')   => '',
                            __('New tab', 'wps-prime')  => '_blank'
                            ),
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/><small> _blank (Opens the linked document in a new window or tab</small>)', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Custom onclick action', 'wps-prime'),
            'admin_label' => true,
            'param_name' => 'onclick',            
            'value' => '',
            'description' => __('<small>Add custom onclick functionality</small>', 'wps-prime')
        ),

        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'wps-prime' ),
            'param_name' => 'ico_type',
            'value' => array(
                __( 'Font Awesome', 'wps-prime' ) => 'fontawesome',
                __( 'Typicons', 'wps-prime' ) => 'typicons',
                __( 'Woo E Commerce', 'wps-prime' ) => 'woothemesecom',
                __( 'Linecons', 'wps-prime' ) => 'linecons',
            ),
            'admin_label' => true,  
            'group' => __( 'Icon', 'wps-prime' ),              
            'description' => __( 'Select icon library.', 'wps-prime' ),
        ),    
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'wps-prime' ),
            'param_name' => 'icon_fontawesome',
            'value' => '', // default value to backend editor admin_label
            'settings' => array(
                //'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'fontawesome',
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'ico_type',
                'value' => 'fontawesome',
            ),
            'group' => __( 'Icon', 'wps-prime' ),  
            'description' => __( 'Select icon from library.', 'wps-prime' ),
        ),       
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'wps-prime' ),
            'param_name' => 'icon_typicons',
            'value' => '', // default value to backend editor admin_label
            'settings' => array(
                //'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'typicons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'ico_type',
                'value' => 'typicons',
            ),
            'group' => __( 'Icon', 'wps-prime' ),  
            'description' => __( 'Select icon from library.', 'wps-prime' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'wps-prime' ),
            'param_name' => 'icon_linecons',
            'value' => '', // default value to backend editor admin_label
            'settings' => array(
                //'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'linecons',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'ico_type',
                'value' => 'linecons',
            ),
            'group' => __( 'Icon', 'wps-prime' ),  
            'description' => __( 'Select icon from library.', 'wps-prime' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'wps-prime' ),
            'param_name' => 'icon_woothemesecom',
            'value' => '', // default value to backend editor admin_label
            'settings' => array(
                //'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'woothemesecom',
                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                'element' => 'ico_type',
                'value' => 'woothemesecom',
            ),
            'group' => __( 'Icon', 'wps-prime' ),  
            'description' => __( 'Select icon from library.', 'wps-prime' ),
        ),

        array(
        'type' => 'dropdown',
        'heading' => 'Icon position',
        'param_name' => 'ico_position',
        'admin_label' => true, 
        'group' => __( 'Icon', 'wps-prime' ),
        'value' => array(
            __('Default (end)','wps-prime') => '',
            __('Start','wps-prime') => 'start',
            )
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

    // Title
    vc_map(
        array(
            'name' => __( 'Button', 'wps-prime' ),
            'base' => 'wps_button',
            'category' => __( 'Content', 'wps-prime' ),
            'icon' => 'icon-wpb-ui-button',
            'params' => $attributes

        )
    );
}