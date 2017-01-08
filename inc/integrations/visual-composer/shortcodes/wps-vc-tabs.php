<?php


/**
*   Tab Shortcode
*/

function wps_vc_tab_shortcode() {
     $attributes = array(

        );
//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __('WPS Tab', 'wps-prime'),
    'base' => 'wps_tab',
    'description' => '',
    'as_parent' => array('only' => 'wps_tab_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => $attributes,
    'icon' => 'icon-wpb-ui-tab-content',        
    'js_view' => 'VcColumnView'
    ));
}

/*
 * Tab Item
*/
function wps_vc_tab_item_shortcode() {
    $attributes = array(

        array(
            'type' => 'textfield',
            'heading' => 'Tab Title',
            'param_name' => 'title',
            'admin_label' => true,
            'value' => '',
            //'group' => esc_html__( 'Advanced', 'wps-prime' ),
            'description' => __('Add title To tab', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Open',
            'param_name' => 'open',
            'admin_label' => true,
            'value' => false,
            'description' => __('If you use the \'open\' shortcode parameter in one of your tab shortcodes, ensure that you only add it to single tab as having more than one tab open within a tab group is not supported.', 'wps-prime')
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
                'group' => esc_html__( 'Icon', 'wps-prime' ),              
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
                'group' => esc_html__( 'Icon', 'wps-prime' ),  
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
                'group' => esc_html__( 'Icon', 'wps-prime' ),  
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
                'group' => esc_html__( 'Icon', 'wps-prime' ),  
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
                'group' => esc_html__( 'Icon', 'wps-prime' ),  
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),


            array(
                'type' => 'textfield',
                'heading' => 'Icon custom CSS Class',
                'admin_label' => true,
                'param_name' => 'ico_class',            
                'value' => '',
                'group' => esc_html__( 'Icon', 'wps-prime' ),
                'description' => __('Add custom class', 'wps-prime')
            ),
           array(
            'type' => 'textarea_html',
            'heading' => __( 'Content', 'wps-prime' ),
            'holder' => 'div',
            'group' => esc_html__( 'Content', 'wps-prime' ),            
            'param_name' => 'content',
        )
        );
    vc_map( array(
        'name' => __('WPS Tab item', 'wps-prime'),
        'base' => 'wps_tab_item',
        'content_element' => true,
        'is_container'=>true,
        'as_child' => array('only' => 'wps_tab'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'vc_icon-vc-gitem-image',
        'params' => $attributes

    ));
}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
     class WPBakeryShortCode_wps_tab extends WPBakeryShortCodesContainer {
     }
 }
 if ( class_exists( 'WPBakeryShortCode' ) ) {
     class WPBakeryShortCode_wps_tab_item extends WPBakeryShortCode {
     }
 }