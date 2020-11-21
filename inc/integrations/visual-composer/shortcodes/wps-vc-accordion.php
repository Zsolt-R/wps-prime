<?php

/**
 *   Accordion Shortcode.
 */
function wps_vc_accordion_shortcode() {
	 $attributes = array(
		 array(
			 'type'        => 'checkbox',
			 'heading'     => 'Autoclose',
			 'admin_label' => true,
			 'param_name'  => 'autoclose',
			 'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			 'description' => __( 'Sets whether accordion items close automatically when you open the next item.', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'checkbox',
			 'heading'     => 'Openfirst',
			 'admin_label' => true,
			 'param_name'  => 'openfirst',
			 'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			 'description' => __( 'Sets whether the first accordion item is open by default. This setting will be overridden if openall is set to true.', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'checkbox',
			 'heading'     => 'Open All',
			 'admin_label' => true,
			 'param_name'  => 'openall',
			 'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			 'description' => __( 'Sets whether all accordion items are open by default. It is recommended that this setting be used with clicktoclose', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'checkbox',
			 'heading'     => 'Click to close',
			 'admin_label' => true,
			 'param_name'  => 'clicktoclose',
			 'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			 'description' => __( 'Sets whether clicking an open title closes it', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'checkbox',
			 'heading'     => 'Scroll',
			 'admin_label' => true,
			 'param_name'  => 'scroll',
			 'value'       => array( __( 'Yes', 'wps-prime' ) => 'yes' ),
			 'description' => __( 'Sets whether to scroll to the title when it is clicked open. This is useful if you have a lot of content within your accordion items.', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'textfield',
			 'heading'     => 'Custom CSS class',
			 'param_name'  => 'class',
			 'admin_label' => true,
			 'value'       => '',
			 'group'       => esc_html__( 'Advanced', 'wps-prime' ),
			 'description' => __( 'Sets a custom CSS class for the accordion group or individual accordion items.', 'wps-prime' ),
		 ),
		 array(
			 'type'        => 'textfield',
			 'heading'     => 'Animation data CSS class',
			 'param_name'  => 'anim_data',
			 'admin_label' => true,
			 'value'       => '',
			 'group'       => esc_html__( 'Animation', 'wps-prime' ),
			 'description' => __( 'Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-prime' ),
		 ),
	 );
	 // Register "container" content element. It will hold all your inner (child) content elements
	 vc_map(
		array(
			'name'                    => __( 'WPS Accordion', 'wps-prime' ),
			'base'                    => 'wps_accordion',
			'description'             => '',
			'as_parent'               => array( 'only' => 'wps_accordion_item' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			'content_element'         => true,
			'show_settings_on_create' => false,
			'is_container'            => true,
			'params'                  => $attributes,
			'icon'                    => 'icon-wpb-ui-accordion',
			'js_view'                 => 'VcColumnView',
		)
	);
}

/*
	Accordion Inner Element
*/
function wps_vc_accordion_item_shortcode() {
	// Add custom parameters
	$attributes = array();

	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => 'Title',
		'param_name'  => 'title',
		'admin_label' => true,
		'value'       => '',
		'description' => __( 'Add custom CSS class.', 'wps-prime' ),
	);

		$attributes[] = array(
			'type'       => 'textarea_html',
			'holder'     => 'div',
			'heading'    => __( 'Content', 'wps-prime' ),
			'param_name' => 'content',
			'value'      => __( '<p>Click edit button to change the content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'wps-prime' ),
		);

		$attributes[] = array(
			'type'        => 'dropdown',
			'heading'     => 'Html Tag',
			'param_name'  => 'tag',
			'value'       => array(
				__( 'Heading 2', 'wps-prime' ) => 'h2',
				__( 'Heading 3', 'wps-prime' ) => 'h3',
				__( 'Heading 4', 'wps-prime' ) => 'h4',
				__( 'Heading 5', 'wps-prime' ) => 'h5',
			),
			'std'         => 'h3',
			'group'       => esc_html__( 'Advanced', 'wps-prime' ),
			'description' => __( 'Set the title wrapper tag', 'wps-prime' ),
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
				'group'       => esc_html__( 'Advanced', 'wps-prime' ),
				'description' => __( 'Fontawesome 5 types', 'wps-fontawesome' ),
			);

			$attributes[] = array(
				'type'        => 'textfield',
				'heading'     => __( 'Icon Class', 'wps-fontawesome' ),
				'param_name'  => 'icon_class',
				'admin_label' => true,
				'value'       => '',
				'description' => __( 'Set a custom icon css class name ex. fab 500px', 'wps-fontawesome' ),
				'group'       => esc_html__( 'Advanced', 'wps-prime' ),
			);
		}
		// End check if icon plugin exist

		vc_map(
			array(
				'name'            => __( 'WPS Accordion item', 'wps-prime' ),
				'base'            => 'wps_accordion_item',
				'content_element' => true,
				'as_child'        => array( 'only' => 'wps_accordion' ), // Use only|except attributes to limit parent (separate multiple values with comma)
				'icon'            => 'vc_icon-vc-gitem-image',
				'params'          => $attributes,
			)
		);
}

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_wps_accordion extends WPBakeryShortCodesContainer {

	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_wps_accordion_item extends WPBakeryShortCode {

	}
}
