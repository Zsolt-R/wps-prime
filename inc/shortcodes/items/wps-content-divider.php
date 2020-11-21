<?php
/**
 * 13 Content Divider.
 */
function wps_content_divider_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'style'         => '',
			'class'         => '',
			'text_class'    => '',
			'padding'       => '',
			'margin'        => '',
			'text'          => '',
			'text_position' => '',
			'text_size'     => '',
			'anim_data'     => '',
		),
		$atts
	);

	$class = wps_getExtraClass(
		array(
			'c-divider',
			$options['class'],
			$options['style'],
			$options['padding'],
			$options['margin'],
		)
	);

	$anim = $options['anim_data'] ? ' data-animate="' . $options['anim_data'] . '"' : '';

	$hasTextClass = '';
	$text         = '';

	if ( $options['text'] ) {
		$textSize     = $options['text_size'] ? ' ' . $options['text_size'] : '';
		$textPos      = $options['text_position'] ? ' u-text-' . $options['text_position'] : '';
		$textClass    = $options['text_class'] ? ' ' . $options['text_class'] : '';
		$text         = '<h4 class="c-divider-text' . $textClass . $textSize . '">' . $options['text'] . '</h4>';
		$hasTextClass = ' c-divider-has-text' . $textPos;
	}

	return "<div class=\"{$class}{$hasTextClass}\"{$anim}>{$text}</div>";
}
