<?php
/*
* WPS Custom video options setup
*/

function wps_vc_icon_shortcode() {

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
            'value' => wps_ico_size(),
            ),
            array(
            'type' => 'dropdown',
            'heading' => 'Icon color',
            'param_name' => 'color',
            'admin_label' => true, 
            'value' => wps_ico_colors(),
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