<?php

function wps_vc_image_shortcode() {

	// Add custom parameters
	$attributes = array();

	   $attributes[] = array(
		   'type'        => 'attach_image',
		   'heading'     => 'Select Image',
		   'admin_label' => true,
		   'param_name'  => 'image_id',
		   'value'       => '',
		   'description' => __( 'Set an image', 'wps-prime' ),
	   );

	   $attributes[] = array(
		   'type'        => 'dropdown',
		   'heading'     => 'Image size',
		   'param_name'  => 'image_size',
		   'value'       => wps_image_sizes(),
		   'std'         => 'full',
		   'description' => __( 'Set custom image size ( Default: full)', 'wps-prime' ),
	   );

	   $attributes[] = array(
		   'type'        => 'dropdown',
		   'heading'     => 'Alignment',
		   'admin_label' => true,
		   'param_name'  => 'align',
		   'value'       => array(
			   __( 'None', 'wps-prime' )   => '',
			   __( 'Right', 'wps-prime' )  => 'alignright',
			   __( 'Center', 'wps-prime' ) => 'aligncenter',
		   ),
		   'description' => '',
	   );

	   $attributes[] = array(
		   'type'        => 'textfield',
		   'heading'     => 'Animation data CSS class',
		   'param_name'  => 'anim_data',
		   'admin_label' => true,
		   'value'       => '',
		   'group'       => esc_html__( 'Animation', 'wps-prime' ),
		   'description' => __( 'Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-prime' ),
	   );

	   $attributes[] = array(
		   'type'        => 'vc_link',
		   'heading'     => __( 'Url', 'wps-prime' ),
		   'param_name'  => 'url',
		   'admin_label' => true,
		   'group'       => esc_html__( 'Link', 'wps-prime' ),
		   'description' => __( 'Set link', 'wps-prime' ),
	   );

	   $attributes[] = array(
		   'type'        => 'textfield',
		   'heading'     => __( 'Custom onclick action', 'wps-prime' ),
		   'admin_label' => true,
		   'param_name'  => 'onclick',
		   'group'       => esc_html__( 'Link', 'wps-prime' ),
		   'value'       => '',
		   'description' => __( '<small>Add custom onclick functionality</small><br><smal>ex. event.preventDefault(); console.log(event.target);</small>', 'wps-prime' ),
	   );

	   // Deprecated
	   // TODO remove in time
	   // $attributes[] = array(
	   // 'type' => 'textfield',
	   // 'heading' => 'Image link',
	   // 'admin_label' => true,
	   // 'param_name' => 'link',
	   // 'value' => '',
	   // 'group' => esc_html__( 'Link', 'wps-prime' ),
	   // 'description' => __('Link address ex: http://yourlink.com/yourpage', 'wps-prime')
	   // );

	   // $attributes[] = array(
	   // 'type' => 'dropdown',
	   // 'heading' => 'Link target',
	   // 'param_name' => 'target',
	   // 'value' => array(
	   // __('Default','wps-prime')  => '',
	   // __('New tab', 'wps-prime') => '_blank'
	   // ),
	   // 'group' => esc_html__( 'Link', 'wps-prime' ),
	   // 'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new tab)', 'wps-prime')
	   // );

	   $attributes[] = array(
		   'type'        => 'textfield',
		   'heading'     => __( 'Custom outer CSS class', 'wps-prime' ),
		   'admin_label' => true,
		   'param_name'  => 'outer_class',
		   'value'       => '',
		   'description' => __( 'Add custom outer class', 'wps-prime' ),
	   );

	   $attributes[] = array(
		   'type'        => 'textfield',
		   'heading'     => __( 'Custom CSS class', 'wps-prime' ),
		   'admin_label' => true,
		   'param_name'  => 'class',
		   'value'       => '',
		   'description' => __( 'Add custom class', 'wps-prime' ),
	   );

	   // Add margins and paddings
	   $attributes = array_merge( $attributes, wps_vc_spacing_params() );

    vc_map(
		array(
			'name'     => __( 'Image', 'wps-prime' ),
			'base'     => 'wps_image',
			'category' => __( 'Content', 'wps-prime' ),
			'icon'     => 'icon-wpb-single-image',
			'params'   => $attributes,
		)
	);
}
