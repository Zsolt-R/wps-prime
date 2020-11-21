<?php

/**
 * 10 Styled List
 * ex: [wps_list class="c-list-style--one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list].
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_styled_list_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(
		array(
			'style'        => '',
			'color'        => '',
			'txt_color'    => '',
			'deco'         => '',
			'class'        => '',
			'icon_family'  => 'light',
			'icon_class'   => '',
			'anim_data'    => '',
			'margin'       => '',
			'padding'      => '',
			'list_spacing' => '',
		),
		$atts
	);

	$list_style = '';

	$anim = $options['anim_data'] ? ' data-animate="' . $options['anim_data'] . '"' : '';

	$list_margin = '';

	if ( ! empty( $options['list_spacing'] ) ) {
		if ( $options['list_spacing'] === 'normal' ) {
			$list_margin = 'c-list--margin';
		} else {
			$list_margin = 'c-list--margin-' . $options['list_spacing'];
		}
	}

	$list_styles = wps_getExtraClass(
		array(
			'c-list',
			$options['txt_color'],
			$options['style'],
			$options['color'],
			$options['deco'],
			$options['class'],
			$options['margin'],
			$options['padding'],
			$list_margin,
		),
		true
	);

	if ( class_exists( 'Vc_Manager' ) ) {
		$sc_content = wpb_js_remove_wpautop( $content, true );
	} else {
		$sc_content = $content;
	}

	// Add icon
	if ( ! empty( $options['icon_class'] ) ) {
		$iconClass = wps_getExtraClass(
			array(
				'c-list__icon',
			),
			true
		);

		$iconArgs = array(
			'class'       => $iconClass,
			'icon_family' => $options['icon_family'],
			'icon_class'  => $options['icon_class'],
			'nowrap'      => true,
		);

		$icon = wps_run_icon( $iconArgs );

		$sc_content = str_replace( '<li>', '<li>' . $icon, $sc_content );
	}

	$output = '<div class="' . $list_styles . '"' . $anim . '>' . do_shortcode( $sc_content ) . '</div>';

	return $output;
}
