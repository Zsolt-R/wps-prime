<?php
/*
* WPS Custom text component options setup
*/

function wps_vc_column_text_shortcode(){

    // Remove Default Parameters
    vc_remove_param('vc_column_text','css_animation');
	vc_remove_param('vc_column_text','css');


	$attributes = array(
		
	    // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/Paddings', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin',
            'admin_label' => true,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            'group' => esc_html__( 'Margins/Paddings', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Padding",
            'param_name' => 'set_padding',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/Paddings', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => "Padding Settings",
            'param_name' => 'padding',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding', 'value' => 'true'),
            'group' => esc_html__( 'Margins/Paddings', 'wps-prime' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Background effects",
            'param_name' => 'bg_fx',
            'admin_label' => true,
            'value' => wps_bg_fx(),
            'std' => '',
            'group' => __( 'Bg FX / Text FX & Align', 'wps-prime' ),
            'description' => __('Background Effect', 'wps-prime')
        ),
        array(
            'type' => 'dropdown',
            'heading' => "Text Color",
            'param_name' => 'txt_color',
            'admin_label' => true,
            'value' =>  wps_txt_color(),
            'std' => '',
            'group' => __( 'Bg FX / Text FX & Align', 'wps-prime' ),
            'description' => __('Text Color', 'wps-prime')
        ),    
        array(
            'type' => 'dropdown',
            'heading' => "Text align",
            'param_name' => 'txt_align',
            'admin_label' => true,
            'value' =>  wps_txt_align(),
            'std' => '',
            'group' => __( 'Bg FX / Text FX & Align', 'wps-prime' ),
            'description' => __('Align all the content in this block', 'wps-prime')
        ),
        array(
            'type' => 'textfield',
            'heading' => 'Animation data CSS class',
            'param_name' => 'anim_data',
            'admin_label' => true,
            'value' => '',
            'group' => esc_html__( 'Animation', 'wps-prime' ),
            'description' => __('Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-prime')
        ),  
        );
	vc_add_params('vc_column_text',$attributes);

    vc_map_update('vc_column_text', array('html_template' => locate_template('vc_templates/vc_column_text.php')) );

}