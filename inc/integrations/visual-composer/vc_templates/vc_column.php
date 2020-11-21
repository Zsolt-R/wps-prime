<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $inner_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $row_width
 * @var $content - shortcode content
 * @var $margin
 * @var $padding
 * @var $margin_inner
 * @var $padding_inner
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$class     = $el_id = $width = $css = $offset = $row_width = $style = $anim_data = '';
$inner_img = $inner_img_size = $inner_img_behave = $inner_img_pos = $inner_bg_fx = $align_content_inner = '';

// Margins Paddings
$margin = $padding = '';

$output  = '';
$inner_s = $inner_e = $aligner_s = $aligner_e = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$anim = $anim_data ? ' data-animate="' . $anim_data . '"' : '';

// If laptop screen width IS SET switch the default _lap-and-up to _desktop to avoid grid classes override
if ( $row_width !== '' && strpos( $row_width, '_lap' ) !== false ) {
	$width = '_desktop-' . wps_wpb_translateColumnWidthToSpan( $width );
} else {
	$width = '_lap-and-up-' . wps_wpb_translateColumnWidthToSpan( $width );
}


$css_classes = array(
	'col',
	$class,
	$width,
	$row_width,
	$margin,
	$padding,
);


$inner_class = wps_getExtraClass(
	array(
		$inner_class,
		$margin_inner,
		$padding_inner,
		$inner_img_behave,
		$inner_img_pos,
		$inner_bg_fx,
		$align_content_inner,
	)
);

if ( $inner_img ) {
			$image = wp_get_attachment_image_src( $inner_img, $inner_img_size, false );
	if ( $image ) {
		$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}
}

if ( $inner_class !== '' || $style !== '' || $anim !== '' ) {
	$inner_s = "<div class=\"col_inner{$inner_class}\"{$style}{$anim}>";
	$inner_e = '</div>';
}

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = $el_id ? 'id="' . $el_id . '" ' : '';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $inner_s;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_e;
$output .= '</div>';

echo $output;
