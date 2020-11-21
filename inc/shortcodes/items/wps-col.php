<?php

/**
 * 2 Row Wrapper Markup
 * ex: [wps_col class="lap-and-up..."] ...content... [/wps_col].
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_col_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(
		array(
			'class'               => '',
			'width'               => '',
			'inner'               => true,
			'inner_class'         => '',
			'row_width'           => '',
			'margin'              => '',
			'padding'             => '',
			'margin_inner'        => '',
			'padding_inner'       => '',
			'inner_img'           => '',
			'inner_img_size'      => 'full',
			'inner_img_pos'       => '',
			'inner_bg_fx'         => '',
			'align_content_inner' => '',
		),
		$atts
	);

	$inner_start = $inner_end = '';
	$style       = '';

	$class = wps_getExtraClass(
		array(
			$options['class'],
			$options['width'],
			$options['margin'],
			$options['padding'],
		)
	);

	$inner_class = wps_getExtraClass(
		array(
			$options['inner_class'],
			$options['margin_inner'],
			$options['padding_inner'],
			$options['inner_img_pos'],
			$options['inner_bg_fx'],
			$options['align_content_inner'],
		)
	);

	$row_width = wps_getExtraClass( $options['row_width'], true ); // flush space between classes

	if ( $options['inner_img'] ) {
		$image = wp_get_attachment_image_src( $options['inner_img'], $options['inner_img_size'], false );
		$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}

	/*
	 Just fill the inner_class argument to activate, and deactivate by setting inner
	*  to false this way you can deactivate the inner element
	*  whithout deleting the inner_class argument
	*/
	if ( $inner_class !== '' || $style !== '' ) {
		$inner_start = "<div class=\"col_inner{$inner_class}\"{$style}>";
		$inner_end   = '</div>';
	}

	$output = '<div class="col' . $class . '' . $row_width . '">' . $inner_start . wps_remove_wpautop( $content, true ) . '' . $inner_end . '</div>';

	return $output;
}
