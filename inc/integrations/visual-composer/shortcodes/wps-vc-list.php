<?php

function wps_vc_list_shortcode() {
	// Add custom parameters
	$attributes = array();

	$attributes[] = array(
		'type'        => 'textarea_html',
		'heading'     => __( 'Content', 'wps-prime' ),
		'holder'      => 'div',
		'group'       => __( 'Content', 'wps-prime' ),
		'param_name'  => 'content',
		'description' => __( 'Only add lists as content. This component will only apply to lists ', 'wps-prime' ),
		'value'       => __( '<ul><li>List item</li><li>List item</li></ul>', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => 'Text Color',
		'param_name'  => 'txt_color',
		'admin_label' => true,
		'value'       => wps_txt_color(),
		'std'         => '',
		'group'       => __( 'Settings', 'wps-prime' ),
		'description' => __( 'Text Color', 'wps-prime' ),
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
			'std'         => 'light',
			'group'       => __( 'Settings', 'wps-prime' ),
			'description' => __( 'Fontawesome 5 types', 'wps-fontawesome' ),
		);
		$attributes[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Icon Class', 'wps-prime' ),
			'admin_label' => true,
			'param_name'  => 'icon_class',
			'value'       => '',
			'group'       => __( 'Settings', 'wps-prime' ),
			'description' => __( 'Set a custom icon css class name ex. fab 500px', 'wps-prime' ),
		);
		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => __( 'Bullet Color', 'wps-prime' ),
			'admin_label' => true,
			'param_name'  => 'color',
			'group'       => __( 'Settings', 'wps-prime' ),
			'value'       => array(
				__( 'Default', 'wps-prime' )     => false,
				__( 'Color one', 'wps-prime' )   => 'c-list--color-one',
				__( 'Color two', 'wps-prime' )   => 'c-list--color-two',
				__( 'Color three', 'wps-prime' ) => 'c-list--color-three',
				__( 'Color four', 'wps-prime' )  => 'c-list--color-four',
				__( 'Color five', 'wps-prime' )  => 'c-list--color-five',
				__( 'Color six', 'wps-prime' )   => 'c-list--color-six',
			),
		);
	}
	// End check if icon plugin exist

	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => __( 'List spacing', 'wps-fontawesome' ),
		'param_name'  => 'list_spacing',
		'admin_label' => true,
		'value'       => array(
			__( 'Default', 'wps-prime' ) => '',
			__( 'Small', 'wps-prime' )   => 'small',
			__( 'Normal', 'wps-prime' )  => 'normal',
			__( 'Large', 'wps-prime' )   => 'large',
		),
		'std'         => '',
		'group'       => __( 'Settings', 'wps-prime' ),
		'description' => __( 'Set spacing between list items', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => 'List items bottom border style',
		'admin_label' => true,
		'param_name'  => 'deco',
		'group'       => __( 'Settings', 'wps-prime' ),
		'value'       => array(
			__( 'None', 'wps-prime' )   => false,
			__( 'Line', 'wps-prime' )   => 'c-list--deco-lines',
			__( 'Dashed', 'wps-prime' ) => 'c-list--deco-dashes',
			__( 'Dotted', 'wps-prime' ) => 'c-list--deco-dots',
		),
	);
	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => __( 'Extra Class', 'wps-prime' ),
		'param_name'  => 'class',
		'admin_label' => true,
		'value'       => '',
		'group'       => __( 'Advanced', 'wps-prime' ),
		'description' => __( 'Add custom CSS class to element.', 'wps-prime' ),
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

	// Title
	vc_map(
		array(
			'name'        => __( 'Styled List', 'wps-prime' ),
			'base'        => 'wps_list',
			'description' => __( 'Wrapper element for styling a list with predefined bullets|colors|lines.', 'wps-prime' ),
			'category'    => __( 'Content', 'wps-prime' ),
			'icon'        => 'icon-wpb-graph',
			'params'      => $attributes,
		)
	);
}
