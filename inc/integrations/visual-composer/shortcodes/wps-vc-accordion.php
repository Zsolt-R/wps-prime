<?php

/**
*   Accordion Shortcode
*/

function wps_vc_accordion_shortcode() {

    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => 'Autoclose',
            'admin_label' => true,
            'param_name' => 'autoclose',            
            'value' => true,
            'description' => __('Sets whether accordion items close automatically when you open the next item.', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Openfirst',            
            'admin_label' => true,
            'param_name' => 'openfirst',
            'value' => '',
            'description' => __('Sets whether the first accordion item is open by default. This setting will be overridden if openall is set to true.', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Open All',            
            'admin_label' => true,
            'param_name' => 'openall',
            'value' => '',
            'description' => __('Sets whether all accordion items are open by default. It is recommended that this setting be used with clicktoclose', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Click to close',            
            'admin_label' => true,
            'param_name' => 'clicktoclose',
            'value' => '',
            'description' => __('Sets whether clicking an open title closes it', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Scroll',
            'admin_label' => true,
            'param_name' => 'scroll',            
            'value' => '',
            'description' => __('Sets whether to scroll to the title when it’s clicked open. This is useful if you have a lot of content within your accordion items.', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Custom CSS class',
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Advanced', 'wps-prime' ),
            'description' => __('Sets a custom CSS class for the accordion group or individual accordion items.', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Html Tag',
            'param_name' => 'tag',
            'value' => array(
                __('Heading 2','wps_prime') => 'h2',
                __('Heading 3','wps_prime') => 'h3',
                __('Heading 4','wps_prime') => 'h4',
                __('Heading 5','wps_prime') => 'h5',
                ),
            'std'=>'h3',
            'group' => esc_html__( 'Advanced', 'wps-prime' ),
            'description' => __('Set the title wrapper tag', 'wps-prime')
        ),
        
        );
//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __('WPS Accordion', 'wps-prime'),
    'base' => 'wps_accordion',
    'description' => '',
    'as_parent' => array('only' => 'wps_accordion_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => $attributes,
    'icon' => 'icon-wpb-ui-accordion',        
    'js_view' => 'VcColumnView'
    ));
}

/*
    Accordion Inner Element
*/
function wps_vc_accordion_item_shortcode() {

    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Title',
            'param_name' => 'title',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'dropdown',
            'heading' => 'Html Tag',
            'param_name' => 'tag',
            'value' => array(
                __('Heading 2','wps_prime') => 'h2',
                __('Heading 3','wps_prime') => 'h3',
                __('Heading 4','wps_prime') => 'h4',
                __('Heading 5','wps_prime') => 'h5',
                ),
            'std'=>'h3',
            'group' => esc_html__( 'Advanced', 'wps-prime' ),
            'description' => __('Set the title wrapper tag', 'wps-prime')
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
                'group' => esc_html__( 'Advanced', 'wps-prime' ),              
                'description' => __( 'Select icon library.', 'wps-prime' ),
            ),    
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'wps-prime' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'ico_type',
                    'value' => 'fontawesome',
                ),
                'group' => esc_html__( 'Advanced', 'wps-prime' ),  
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),       
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'wps-prime' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'ico_type',
                    'value' => 'typicons',
                ),
                'group' => esc_html__( 'Advanced', 'wps-prime' ),  
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'wps-prime' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'ico_type',
                    'value' => 'linecons',
                ),
                'group' => esc_html__( 'Advanced', 'wps-prime' ),  
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'wps-prime' ),
                'param_name' => 'icon_woothemesecom',
                'value' => 'woo-ecom-icon e-commerce000', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'woothemesecom',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'ico_type',
                    'value' => 'woothemesecom',
                ),
                'group' => esc_html__( 'Advanced', 'wps-prime' ),  
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),
        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => __( 'Content', 'wps-prime' ),
            'param_name' => 'content',
            'value' => __( '<p>Click edit button to change the content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'wps-prime' ),
        ),
        );

        vc_map( array(
        'name' => __('WPS Accordion item', 'wps-prime'),
        'base' => 'wps_accordion_item',
        'content_element' => true,
        'is_container'=>true,
        'as_child' => array('only' => 'wps_accordion'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'vc_icon-vc-gitem-image',
        'params' => $attributes        

    ));
}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
     class WPBakeryShortCode_wps_accordion extends WPBakeryShortCodesContainer {
     }
 }
 if ( class_exists( 'WPBakeryShortCode' ) ) {
     class WPBakeryShortCode_wps_accordion_item extends WPBakeryShortCode {
     }
 }