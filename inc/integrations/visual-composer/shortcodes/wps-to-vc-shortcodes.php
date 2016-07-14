<?php

function wps_to_vc_wps_button_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Button style',
            'admin_label' => true,
            'param_name' => 'class',            
            'value' => '',
            'description' => __('<small>Add custom classes defined in the theme stylesheet. Combine classes to get different looking buttons.</small> <br/> btn--small | btn--large | btn--primary | btn--secondary | btn--tertiary | btn--positive | btn--negative | btn--neutral | btn--pill | btn--full | extra--css', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Button align',
            'admin_label' => true,
            'param_name' => 'align',
            'value' => array('Default'=>false,'Center'=>'btn--center','Right'=>'btn--right'),
            'description' => __('The Button will move to a new line', 'wps-prime')
        ),
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
            'type' => 'textfield',
            'heading' => 'Link target',
            'param_name' => 'target',
            'value' => '',
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new window or tab) | _self | _parent | _top' , 'wps-prime')
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
add_action( 'vc_before_init', 'wps_to_vc_wps_button_shortcode' );


function wps_to_vc_wps_content_divider_shortcode() {

    $attributes = array(

        array(
            'type' => 'textfield',
            'heading' => 'Divider Class',
            'admin_label' => true,
            'param_name' => 'class',
            'value' => '',
            'description' => __('ex. divider--style-dashed | divider--style-dotted', 'wps-prime')
            )
        );
     // Title
    vc_map(
        array(
            'name' => __( 'Content Divider' ),
            'description'=>'Creates a horizontal line, use to separate content',
            'base' => 'wps_divider',
            'category' => __( 'Content' ),
            'params' => $attributes,
            'icon' => 'icon-wpb-ui-separator'
        )
    );
}
add_action( 'vc_before_init', 'wps_to_vc_wps_content_divider_shortcode' );

function wps_to_vc_wps_ico_shortcode() {

    $attributes = array( 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'wps-prime' ),
                'param_name' => 'type',
                'value' => array(
                    __( 'Font Awesome', 'wps-prime' ) => 'fontawesome',
                    __( 'Typicons', 'wps-prime' ) => 'typicons',
                    __( 'Woo E Commerce', 'wps-prime' ) => 'woothemesecom',
                    __( 'Linecons', 'wps-prime' ) => 'linecons',
                ),
                'admin_label' => true,                
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
                    'element' => 'type',
                    'value' => 'fontawesome',
                ),
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
                    'element' => 'type',
                    'value' => 'typicons',
                ),
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
                    'element' => 'type',
                    'value' => 'linecons',
                ),
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
                    'element' => 'type',
                    'value' => 'woothemesecom',
                ),
                'description' => __( 'Select icon from library.', 'wps-prime' ),
            ),
            array(
            'type' => 'dropdown',
            'heading' => 'Icon size',
            'param_name' => 'size',
            'admin_label' => true, 
            'value' => array(
                    'Small'       => 'ico--sm',
                    'Normal'      => 'ico--m',
                    'Large'       => 'ico--l',
                    'Extra Large' => 'ico--xl',
                    'Huge'        => 'ico--xxl'
                ),
            ),
            array(
            'type' => 'dropdown',
            'heading' => 'Icon color',
            'param_name' => 'color',
            'admin_label' => true, 
            'value' => array(
                    'Color default' => '',
                    'Color 1' => 'ico--color-one',
                    'Color 2' => 'ico--color-two',
                    'Color 3' => 'ico--color-three',
                    'Color 4' => 'ico--color-four',
                    'Color 5' => 'ico--color-five',
                    'Color 6' => 'ico--color-six'
                ),
            'std'=>'',
            'description' => __('Set icon size', 'wps-prime')
            ),
            array(
            'type' => 'textfield',
            'heading' => 'Class',
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),  
            array(
            'type' => 'checkbox',
            'heading' => 'Center',
            'param_name' => 'center',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),       
        );
     // Title
    vc_map(
        array(
            'name' => __( 'Icon' ),
            'description' => __( 'Eye catching icons from libraries','wps-prime' ),
            'base' => 'wps_ico',
            'category' => __( 'Content','wps-prime' ),
            'params' => $attributes,
            'icon' => 'icon-wpb-vc_icon',
            'js_view' => 'VcIconElementView_Backend',
        )

    );
}
add_action( 'vc_before_init', 'wps_to_vc_wps_ico_shortcode' );


function wps_to_vc_wps_slider_shortcode() {

    $attributes = array(
        array(
            'type' => 'checkbox',
            'heading' => 'Scrollbar visibility',
            'admin_label' => true,
            'param_name' => 'scrollbar',            
            'value' => '',
            'description' => __('Show slider scrollbar ( Default is false )', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Pagination visibility',            
            'admin_label' => true,
            'param_name' => 'pagination',
            'value' => '',
            'description' => __('Show slider pagination ( Default is false )', 'wps-prime')
        )
        );
//Register "container" content element. It will hold all your inner (child) content elements
vc_map( array(
    'name' => __('WPS Anything slider', 'my-text-domain'),
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
add_action( 'vc_before_init', 'wps_to_vc_wps_slider_shortcode' );

function wps_to_vc_wps_slider_item_shortcode() {

    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Class',
            'param_name' => 'class',
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
            'value' => __( '<p>Add your custom content</p>', 'wps-prime' ),
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
add_action( 'vc_before_init', 'wps_to_vc_wps_slider_item_shortcode' );

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
 if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
     class WPBakeryShortCode_wps_all_slider extends WPBakeryShortCodesContainer {
     }
 }
 if ( class_exists( 'WPBakeryShortCode' ) ) {
     class WPBakeryShortCode_wps_all_slider_item extends WPBakeryShortCode {
     }
 }


function wps_to_vc_wps_mediabox_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'textfield',
            'heading' => 'Title',
            'param_name' => 'title',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Title', 'wps-prime' ),
            'description' => __('Add mediabox title.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Type Extra Class',
            'param_name' => 'title_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Title', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Mediabox Class',
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Classes', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'attach_image',
            'heading' => 'Attach Image',
            'admin_label' => true,
            'param_name' => 'image_id',
            'value' => '',
            'group' => esc_html__( 'Image/Icon', 'wps-prime' ),
            'description' => __('Set an image', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Icon Class',
            'admin_label' => true,
            'param_name' => 'ico_class',
            'value' => '',
            'group' => esc_html__( 'Image/Icon', 'wps-prime' ),
            'description' => __('Set an icon class', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Image Class',
            'admin_label' => true,
            'param_name' => 'image_class',            
            'value' => '',
            'group' => esc_html__( 'Image/Icon', 'wps-prime' ),
            'description' => __('Add custom class', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Image link',
            'admin_label' => true,
            'param_name' => 'image_link',            
            'value' => '',
            'group' => esc_html__( 'Image/Icon', 'wps-prime' ),
            'description' => __('Add custom link', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Image size',
            'param_name' => 'image_size',
            'value' => wps_image_sizes(),
            'std'=>'full',
            'group' => esc_html__( 'Image/Icon', 'wps-prime' ),
            'description' => __('Set custom image size ( Default: ‘full’)', 'wps-prime')
        ),
        array(
            'type' => 'checkbox',
            'heading' => 'Divider',
            'param_name' => 'divider',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Divider', 'wps-prime' ),
            'description' => __('Use Divider.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Divider Extra Class',
            'param_name' => 'divider_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Divider', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'dropdown',
            'heading' => 'Media Type',
            'admin_label' => true,
            'param_name' => 'type',
            'value' => array('Default'=>false,'Flag'=>'flag','Media'=>'media'),
            'group' => esc_html__( 'Media settings', 'wps-prime' ),
            'description' => __('Set media type', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Type Extra Class',
            'param_name' => 'type_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Media settings', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Type Body Class',
            'param_name' => 'type_body_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Media settings', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Type Image Class',
            'param_name' => 'type_img_class',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Media settings', 'wps-prime' ),
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        array(
            'type' => 'textarea_html',
            'heading' => __( 'Content', 'wps-prime' ),
            'holder' => 'div',
            'group' => esc_html__( 'Content', 'wps-prime' ),            
            'param_name' => 'content',
        )
           
    );

    // Title
    vc_map(
        array(
            'name' => __( 'Mediabox' ),
            'base' => 'wps_mediabox',
            'description' => 'Holds an image an text combination, you can add title and divider.',
            'category' => __( 'Content' ),
            'icon' => 'icon-wpb-toggle-small-expand',
            'params' => $attributes 
        )
    );
}
add_action( 'vc_before_init', 'wps_to_vc_wps_mediabox_shortcode' );