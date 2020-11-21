<?php

function wps_vc_button_shortcode() {
	// Add custom parameters
	$attributes = array();

	// Deprecated
	// TODO remove in time
	// $attributes[] = array(
	// 'type' => 'textfield',
	// 'heading' => __('Button link', 'wps-prime'),
	// 'admin_label' => true,
	// 'param_name' => 'link',
	// 'value' => '',
	// 'description' => __('link address ex: http://yourlink.com/yourpage', 'wps-prime'),
	// );
	// $attributes[] = array(
	// 'type' => 'textfield',
	// 'heading' => __('Button link by Post Id', 'wps-prime'),
	// 'admin_label' => true,
	// 'param_name' => 'post_id',
	// 'value' => '',
	// 'description' => __('Post ID will override custom link. Add any post/page/custom post type/media id ex: 123 ', 'wps-prime'),
	// );

	$attributes[] = array(
		'type'        => 'vc_link',
		'heading'     => __( 'Url', 'wps-prime' ),
		'param_name'  => 'url',
		'admin_label' => true,
		'value'       => '',
		'description' => __( 'Set link', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Button label', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'label',
		'value'       => 'Please add label',
		'description' => __( 'button text ex: Click me', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Button Color', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'color',
		'value'       => wps_btn_color(),
		'description' => __( 'Set button color', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Button Size', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'size',
		'value'       => wps_btn_size(),
		'description' => __( 'Set button size', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'checkbox',
		'heading'     => __( 'Button Ghost', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'ghost',
		'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
		'description' => __( 'Make this a ghost button', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'checkbox',
		'heading'     => 'Has shadow',
		'param_name'  => 'shadow',
		'admin_label' => true,
		'value'       => '',
		'description' => __( 'Button has shadow', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Button Aspect', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'aspect',
		'value'       => wps_btn_aspect(),
		'description' => __( 'Set button aspect', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'Button align', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'align',
		'value'       => wps_btn_pos(),
		'description' => __( 'The Button will move to a new line', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Custom CSS class', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'class',
		'value'       => '',
		'description' => __( '<small>Add custom classes defined in the theme stylesheet. Combine classes to get different looking buttons. ex. btn--custom-css</small>', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Custom onclick action', 'wps-prime' ),
		'admin_label' => true,
		'param_name'  => 'onclick',
		'value'       => '',
		'description' => __( '<small>Add custom onclick functionality</small><br><small>ex. event.preventDefault(); console.log(event.target);</small>', 'wps-prime' ),
	);

	// Check if icon plugin exist
	if ( defined( 'WPS_FA_PLUGIN' ) ) {
		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => __( 'Icon family', 'wps-fontawesome' ),
			'param_name'  => 'icon_family',
			'admin_label' => true,
			'value'       => array(
				__( 'Solid', 'wps-fontawesome' )   => 'solid',
				__( 'Regular', 'wps-fontawesome' ) => 'regular',
				__( 'Light', 'wps-fontawesome' )   => 'light',
				__( 'Duotone', 'wps-fontawesome' ) => 'duotone',
				__( 'Brands', 'wps-fontawesome' )  => 'brands',
			),
			'std'         => 'regular',
			'description' => __( 'Fontawesome 5 types', 'wps-fontawesome' ),
			'group'       => __( 'Icon', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Icon Class', 'wps-fontawesome' ),
			'param_name'  => 'icon_class',
			'admin_label' => true,
			'value'       => '',
			'description' => __( 'Set a custom icon css class name ex. fab 500px', 'wps-fontawesome' ),
			'group'       => __( 'Icon', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => 'Icon position',
			'param_name'  => 'ico_position',
			'admin_label' => true,
			'group'       => __( 'Icon', 'wps-prime' ),
			'value'       => array(
				__( 'Default (end)', 'wps-prime' ) => '',
				__( 'Start', 'wps-prime' )         => 'start',
			),
		);
	}
	// End check if icon plugin exist

	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => 'Animation data CSS class',
		'param_name'  => 'anim_data',
		'admin_label' => true,
		'value'       => '',
		'group'       => esc_html__( 'Animation', 'wps-prime' ),
		'description' => __( 'Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-prime' ),
	);

	// Add margins and paddings
	$attributes = array_merge( $attributes, wps_vc_spacing_params() );

	// Title
	vc_map(
		array(
			'name'     => __( 'Button', 'wps-prime' ),
			'base'     => 'wps_button',
			'category' => __( 'Content', 'wps-prime' ),
			'icon'     => 'icon-wpb-ui-button',
			'params'   => $attributes,
		)
	);
}
