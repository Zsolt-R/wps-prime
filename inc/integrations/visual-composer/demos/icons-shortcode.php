<?php

function wps_to_vc_wps_ico_shortcode() {

    $attributes = array(

        array(
            'type' => 'dropdown',
                'heading' => __( 'Icon library', 'wps-prime' ),
                'value' => array(
                    __( 'Font Awesome', 'wps-prime' ) => 'fontawesome',
                    __( 'Open Iconic', 'wps-prime' ) => 'openiconic',
                    __( 'Typicons', 'wps-prime' ) => 'typicons',
                    __( 'Entypo', 'wps-prime' ) => 'entypo',
                    __( 'Linecons', 'wps-prime' ) => 'linecons',
                    __( 'Mono Social', 'wps-prime' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'type',
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
                'param_name' => 'icon_monosocial',
                'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'monosocial',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'monosocial',
                ),
                'description' => __( 'Select icon from library.', 'wps-prime' ),
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




-----------------------


function wps_to_vc_wps_ico_shortcode() {

    $attributes = array(

            array(
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'wps-prime' ),
                'param_name' => 'ico_class',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'admin_label' => true,
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => __( 'Select icon from library.', 'wps-prime' ),
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