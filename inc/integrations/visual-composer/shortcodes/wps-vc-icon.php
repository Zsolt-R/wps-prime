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
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'type' => 'fontawesome',
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
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
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
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
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
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
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
            'heading' => __('Icon size', 'wps-prime'),
            'param_name' => 'size',
            'admin_label' => true, 
            'value' => wps_ico_size(),
            'description' => __('Set icon size', 'wps-prime')
            ),
            array(
            'type' => 'dropdown',
            'heading' => __('Icon color', 'wps-prime'),
            'param_name' => 'color',
            'admin_label' => true, 
            'value' => wps_ico_colors(),
            'std'=>'',
            'description' => __('Set icon color', 'wps-prime')
            ),
            array(
            'type' => 'textfield',
            'heading' => __('Class', 'wps-prime'),
            'param_name' => 'class',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),  
             array(
            'type' => 'textfield',
            'heading' => __('Link', 'wps-prime'),
            'param_name' => 'link',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Link', 'wps-prime' ),
            'description' => __('Link address ex: http://yourlink.com/yourpage', 'wps-prime')
            ), 
            array(
            'type' => 'dropdown',
            'heading' => __('Link target', 'wps-prime'),
            'param_name' => 'target',
            'value' => array(
                            __('Default', 'wps-prime')   => '',
                            __('New tab', 'wps-prime')   => '_blank'
                            ),
            'group' => esc_html__( 'Link', 'wps-prime' ),
            'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new tab)', 'wps-prime')
            ),
            array(
            'type' => 'checkbox',
            'heading' => __('Center', 'wps-prime'),
            'param_name' => 'center',
            'admin_label' => true,
            'value' => '',
            'description' => __('Add custom CSS class.', 'wps-prime')
            ),
        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => __('Set Margin' , 'wps-prime'),
            'param_name' => 'set_margin',
            'admin_label' => false,
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => __('Margin Settings' , 'wps-prime'),
            'param_name' => 'margin',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
        ),
        );
     // Title
    vc_map(
        array(
            'name' => __( 'Icon' , 'wps-prime'),
            'description' => __( 'Eye catching icons from libraries','wps-prime' ),
            'base' => 'wps_ico',
            'category' => __( 'Content','wps-prime' ),
            'params' => $attributes,
            'icon' => 'icon-wpb-vc_icon',
            'js_view' => 'VcIconElementView_Backend',
        )

    );
}