<?php

function wps_vc_mediabox_shortcode() {

// Add custom parameters
    $attributes = array(
        array(
            'type' => 'attach_image',
            'heading' => 'Attach Image',
            'admin_label' => true,
            'param_name' => 'image_id',
            'value' => '',
            'group' => __( 'Image', 'wps-prime' ),
            'description' => __('Set an image', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Image link',
            'admin_label' => true,
            'param_name' => 'image_link',            
            'value' => '',
            'group' => __( 'Image', 'wps-prime' ),
            'description' => __('Add custom link', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Image size',
            'param_name' => 'image_size',
            'value' => wps_image_sizes(),
            'std'=>'full',
            'group' => __( 'Image', 'wps-prime' ),
            'description' => __('Set custom image size ( Default: ‘full’)', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Image custom CSS class',
            'admin_label' => true,
            'param_name' => 'image_class',            
            'value' => '',
            'group' => __( 'Image', 'wps-prime' ),
            'description' => __('Add custom class', 'wps-prime')
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
            'heading' => 'Icon size',
            'param_name' => 'icon_size',
            'admin_label' => true, 
            'group' => __( 'Icon', 'wps-prime' ),
            'value' => wps_ico_size(),
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Icon custom CSS class',
            'admin_label' => true,
            'param_name' => 'ico_class',
            'value' => '',
            'group' => __( 'Icon', 'wps-prime' ),
            'description' => __('Set an icon class', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Media Type',
            'admin_label' => true,
            'param_name' => 'type',
            'value' => array(
                __('Default') =>false,
                __('Flag')    =>'o-flag',
                __('Media')   =>'o-media'
                ),
            'group' => __( 'Media settings', 'wps-prime' ),
            'description' => __('Set media type', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Media Spacing',
            'admin_label' => true,
            'param_name' => 'type_spacing',
            'value' => array(
                __('Default') =>false,
                __('Tiny')    =>'--tiny',
                __('Small')   =>'--small',
                __('Normal')  =>'--normal',
                __('Large')   =>'--large',
                __('Huge')    =>'--huge',
                __('None')    =>'--flush',
                ),
            'group' => __( 'Media settings', 'wps-prime' ),
            'description' => __('Set elements spacing. By default the Media|Flag media type has a \'normal\' spacing. If you use the default media type there is no spacing between elements.', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Text Color",
            'param_name' => 'txt_color',
            'admin_label' => true,
            'value' =>  wps_txt_color(),
            'std' => '',
            'group' => __( 'Colors', 'wps-prime' ),
            'description' => __('Color applies to icon color also (if icon color is NOT set)', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => 'Icon color',
            'param_name' => 'icon_color',
            'admin_label' => true, 
            'value' => wps_ico_colors(),
            'std'=>'',
            'group' => __( 'Colors', 'wps-prime' ),
            'description' => __('Set icon color', 'wps-prime')
            ),
        array(
            'type' => 'checkbox',
            'heading' => "Media order reverse",
            'param_name' => 'type_reverse',
            'admin_label' => true,
            'group' => __( 'Media settings', 'wps-prime' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => "Not Responsive",
            'param_name' => 'not_responsive',
            'admin_label' => true,
            'group' => __( 'Media settings', 'wps-prime' ),
        ),        
        array(
            'type' => 'textarea_html',
            'heading' => __( 'Content', 'wps-prime' ),
            'holder' => 'div',
            'group' => __( 'Content', 'wps-prime' ),            
            'param_name' => 'content',
        ),
                // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin',
            'admin_label' => false,
            'group' => __( 'Margin', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin',
            'admin_label' => true,
            'group' => __( 'Margin', 'wps-prime' ),
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Mediabox wrapper class',
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'group' => __( 'Advanced', 'wps-prime' ),
            'description' => __('Add custom CSS class to mediabox wrapper.', 'wps-prime')
            ),
        array(
            'type' => 'textfield',
            'heading' => 'Media type extra class',
            'param_name' => 'type_class',
            'admin_label' => true,
            'value' => '',
            'group' => __( 'Advanced', 'wps-prime' ),
            'description' => __('Add custom CSS class to media object.', 'wps-prime')
            ),
    );

    // Title
    vc_map(
        array(
            'name' => __( 'Mediabox' ),
            'base' => 'wps_mediabox',
            'description' => 'Image text combination that can rearange itself on responsive devices',
            'category' => __( 'Content' ),
            'icon' => 'icon-wpb-toggle-small-expand',
            'params' => $attributes 
        )
    );
}