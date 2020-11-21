<?php

/**
 *   Tab Shortcode.
 */
function wps_vc_tab_shortcode() {
	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map(
		array(
			'name'                    => __( 'WPS Tab', 'wps-prime' ),
			'base'                    => 'wps_tab',
			'description'             => '',
			'as_parent'               => array( 'only' => 'wps_tab_item' ), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			'content_element'         => true,
			'show_settings_on_create' => false,
			'is_container'            => true,
			'params'                  => array(),
			'icon'                    => 'icon-wpb-ui-tab-content',
			'js_view'                 => 'VcColumnView',
		)
	);
}

/*
 * Tab Item
*/
function wps_vc_tab_item_shortcode() {
	$attributes   = array();
	$attributes[] = array(
		'type'        => 'textfield',
		'heading'     => 'Tab Title',
		'param_name'  => 'title',
		'admin_label' => true,
		'value'       => '',
		'description' => __( 'Add title To tab', 'wps-prime' ),
	);
	$attributes[] = array(
		'type'        => 'checkbox',
		'heading'     => 'Open',
		'param_name'  => 'open',
		'admin_label' => true,
		'value'       => false,
		'description' => __( 'If you use the \'open\' shortcode parameter in one of your tab shortcodes, ensure that you only add it to single tab as having more than one tab open within a tab group is not supported.', 'wps-prime' ),
	);

	$attributes[] = array(
		'type'       => 'textarea_html',
		'heading'    => __( 'Content', 'wps-prime' ),
		'holder'     => 'div',
		'param_name' => 'content',
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
			'group'       => esc_html__( 'Icon', 'wps-prime' ),
			'description' => __( 'Fontawesome 5 types', 'wps-fontawesome' ),
		);

		$attributes[] = array(
			'type'        => 'textfield',
			'heading'     => __( 'Icon Class', 'wps-fontawesome' ),
			'param_name'  => 'icon_class',
			'admin_label' => true,
			'value'       => '',
			'description' => __( 'Set a custom icon css class name ex. fab 500px', 'wps-fontawesome' ),
			'group'       => esc_html__( 'Icon', 'wps-prime' ),
		);
	}
	// End check if icon plugin exist

	vc_map(
		array(
			'name'            => __( 'WPS Tab item', 'wps-prime' ),
			'base'            => 'wps_tab_item',
			'content_element' => true,
			'as_child'        => array( 'only' => 'wps_tab' ), // Use only|except attributes to limit parent (separate multiple values with comma)
			'icon'            => 'vc_icon-vc-gitem-image',
			'params'          => $attributes,
		)
	);
}

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_wps_tab extends WPBakeryShortCodesContainer {

	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_wps_tab_item extends WPBakeryShortCode {

	}
}
