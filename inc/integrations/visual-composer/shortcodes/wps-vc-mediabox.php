<?php

function wps_vc_mediabox_shortcode() {
	// Add custom parameters
	$attributes = array();

	$attributes[] = array(
		'type'       => 'textarea_html',
		'heading'    => __( 'Content', 'wps-prime' ),
		'holder'     => 'div',
		'group'      => __( 'Content', 'wps-prime' ),
		'param_name' => 'content',
	);

	$attributes[] = array(
		'type'        => 'attach_image',
		'heading'     => 'Attach Image',
		'admin_label' => true,
		'param_name'  => 'image_id',
		'value'       => '',
		'group'       => __( 'Image', 'wps-prime' ),
		'description' => __( 'Set an image', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => 'Image link',
		'admin_label' => true,
		'param_name'  => 'image_link',
		'value'       => '',
		'group'       => __( 'Image', 'wps-prime' ),
		'description' => __( 'Add custom link', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'dropdown',
		'heading'     => 'Image size',
		'param_name'  => 'image_size',
		'value'       => wps_image_sizes(),
		'std'         => 'full',
		'group'       => __( 'Image', 'wps-prime' ),
		'description' => __( 'Set custom image size ( Default: full)', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => 'Image custom CSS class',
		'admin_label' => true,
		'param_name'  => 'image_class',
		'value'       => '',
		'group'       => __( 'Image', 'wps-prime' ),
		'description' => __( 'Add custom class', 'wps-prime' ),
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
				'heading'     => 'Icon size',
				'param_name'  => 'icon_size',
				'admin_label' => true,
				'group'       => __( 'Icon', 'wps-prime' ),
				'value'       => wps_ico_size(),
			);
			$attributes[] = array(
				'type'        => 'dropdown',
				'heading'     => 'Icon color',
				'param_name'  => 'icon_color',
				'admin_label' => true,
				'value'       => wps_ico_colors(),
				'std'         => '',
				'group'       => __( 'Icon', 'wps-prime' ),
			);
			$attributes[] = array(
				'type'        => 'textfield',
				'heading'     => __( 'Icon custom CSS class', 'wps-prime' ),
				'admin_label' => true,
				'param_name'  => 'icon_custom_class',
				'value'       => '',
				'group'       => __( 'Icon', 'wps-prime' ),
				'description' => __( 'Add a custom class to the icon', 'wps-prime' ),
			);
	}
		// End check if icon plugin exist

		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => __( 'Media Type', 'wps-prime' ),
			'admin_label' => true,
			'param_name'  => 'type',
			'value'       => array(
				__( 'Default', 'wps-prime' ) => false,
				__( 'Flag', 'wps-prime' )    => 'o-flag',
				__( 'Media', 'wps-prime' )   => 'o-media',
			),
			'group'       => __( 'Media settings', 'wps-prime' ),
			'description' => __( 'Set media type', 'wps-prime' ),
		);
		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => 'Media Spacing',
			'admin_label' => true,
			'param_name'  => 'type_spacing',
			'value'       => array(
				__( 'Default', 'wps-prime' ) => false,
				__( 'Tiny', 'wps-prime' )    => '--tiny',
				__( 'Small', 'wps-prime' )   => '--small',
				__( 'Normal', 'wps-prime' )  => '--normal',
				__( 'Large', 'wps-prime' )   => '--large',
				__( 'Huge', 'wps-prime' )    => '--huge',
				__( 'None', 'wps-prime' )    => '--flush',
			),
			'group'       => __( 'Media settings', 'wps-prime' ),
			'description' => __( 'Set elements spacing. By default the Media|Flag media type has a \'normal\' spacing. If you use the default media type there is no spacing between elements.', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'checkbox',
			'heading'     => 'Media order reverse',
			'param_name'  => 'type_reverse',
			'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			'admin_label' => true,
			'group'       => __( 'Media settings', 'wps-prime' ),
		);
		$attributes[] = array(
			'type'        => 'checkbox',
			'heading'     => 'Image full height',
			'param_name'  => 'image_full_height',
			'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			'admin_label' => true,
			'description' => __( 'Set the image full height of the content', 'wps-prime' ),
			'group'       => __( 'Media settings', 'wps-prime' ),
		);
		$attributes[] = array(
			'type'        => 'checkbox',
			'heading'     => 'Not Responsive',
			'param_name'  => 'not_responsive',
			'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			'admin_label' => true,
			'group'       => __( 'Media settings', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => 'Text Color',
			'param_name'  => 'txt_color',
			'admin_label' => true,
			'value'       => wps_txt_color(),
			'std'         => '',
			'group'       => __( 'Content', 'wps-prime' ),
			'description' => __( 'Color applies to icon color also (if icon color is NOT set)', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'textfield',
			'heading'     => 'Mediabox wrapper class',
			'param_name'  => 'class',
			'admin_label' => true,
			'value'       => '',
			'group'       => __( 'Media settings', 'wps-prime' ),
			'description' => __( 'Add custom CSS class to mediabox wrapper.', 'wps-prime' ),
		);
		$attributes[] = array(
			'type'        => 'textfield',
			'heading'     => 'Media type extra class',
			'param_name'  => 'type_class',
			'admin_label' => true,
			'value'       => '',
			'group'       => __( 'Media settings', 'wps-prime' ),
			'description' => __( 'Add custom CSS class to media object.', 'wps-prime' ),
		);
		// Only for VC UI functionality
		$attributes[] = array(
			'type'        => 'checkbox',
			'heading'     => 'Set Margin',
			'param_name'  => 'set_margin',
			'admin_label' => false,
			'group'       => __( 'Margin', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'wps_margin',
			'heading'     => 'Margin Settings',
			'param_name'  => 'margin',
			'admin_label' => true,
			'group'       => __( 'Margin', 'wps-prime' ),
			'dependency'  => array(
				'element' => 'set_margin',
				'value'   => 'true',
			),
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
				'name'        => __( 'Mediabox', 'wps-prime' ),
				'base'        => 'wps_mediabox',
				'description' => 'Image text combination that can rearange itself on responsive devices',
				'category'    => __( 'Content', 'wps-prime' ),
				'icon'        => 'icon-wpb-toggle-small-expand',
				'params'      => $attributes,
			)
		);
}
