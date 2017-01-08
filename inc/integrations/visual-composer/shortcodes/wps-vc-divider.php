<?php

function wps_vc_divider_shortcode() {

    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => 'Divider style',
            'param_name' => 'style',
            'value' => array(
                            __('Line','wps-prime')   => '',
                            __('Dots','wps-prime')      => 'c-divider--dotted',
                            __('Dashes','wps-prime')     => 'c-divider--dashed'
                            ),
            'description' => __('Line | Dots  | Dashes <hr> <hr class="c-divider--dotted"> <hr class="c-divider--dashed">', 'wps-prime')
        ),

        array(
            'type' => 'textfield',
            'heading' => 'Custom Class',
            'admin_label' => true,
            'param_name' => 'class',
            'value' => '',
            'group' => __( 'Advanced', 'wps-prime' ),
            'description' => __('custom element class', 'wps-prime')
            )
        );

        // Add margins and paddings
        $attributes = array_merge($attributes,wps_vc_spacing_params());

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