<?php
/**
*   Slider Shortcodes
*/

function wps_vc_wps_slider_shortcode() {

    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => 'Scrollbar visibility',            
            'param_name' => 'scrollbar',            
            'value' => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
            'admin_label' => true,
            'description' => __('Show slider scrollbar ( Default is false )', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Pagination visibility', 
            'param_name' => 'pagination',
            'value' => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
            'admin_label' => true,
            'description' => __('Show slider pagination ( Default is false )', 'wps-prime')
        )
        );
//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __('WPS Anything slider', 'wps-prime'),
    'base' => 'wps_all_slider',
    'description' => 'A slider that run with any element in it\'s sides',
    'as_parent' => array('only' => 'wps_all_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    'content_element' => true,
    'show_settings_on_create' => false,
    'is_container' => true,
    'params' => $attributes,
    'icon' => 'icon-wpb-images-carousel',        
    'js_view' => 'VcColumnView'
    ));
}


function wps_vc_wps_slider_item_shortcode() {

    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Content class',
            'param_name' => 'content_class',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'attach_image',
            'heading' => 'Background image',
            'admin_label' => true,
            'param_name' => 'slide_img',
            'value' => '',
            'group' => esc_html__( 'Background image', 'wps-prime' ),
            'description' => __('Set an image background for the slide', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Background image size',
            'param_name' => 'img_size',
            'value' => wps_image_sizes(),
            'std'=>'full',
            'group' => esc_html__( 'Background image', 'wps-prime' ),
            'description' => __('Set custom background image size ( Default: ‘full’)', 'wps-prime')
        ),
        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => __( 'Slide Content', 'wps-prime' ),
            'param_name' => 'content',
            'value' => __( '<p>Click edit button to change the content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'wps-prime' ),
        ),
        );

        vc_map( array(
        'name' => __('WPS Anything slider slide', 'wps-prime'),
        'base' => 'wps_all_slider_item',
        'content_element' => true,
        'is_container'=>true,
        'as_child' => array('only' => 'wps_all_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        'icon' => 'vc_icon-vc-gitem-image',
        'params' => $attributes

    ));
}


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
     class WPBakeryShortCode_wps_all_slider extends WPBakeryShortCodesContainer {
     }
 }
 if ( class_exists( 'WPBakeryShortCode' ) ) {
     class WPBakeryShortCode_wps_all_slider_item extends WPBakeryShortCode {
     }
 }