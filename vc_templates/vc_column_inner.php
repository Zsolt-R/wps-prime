<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $inner_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$class = $width = $css = $offset = $layout_width = '';
$output = '';
$inner_s = $inner_e = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wps_wpb_translateColumnWidthToSpan( $width );

$css_classes = array(
	'layout__item',
	$class,
	$width,
	$layout_width
);


if( $inner_class !== '' ){
	$inner_s = "<div class=\"layout__item_inner {$inner_class}\">";
	$inner_e = "</div>";
}


$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= $inner_s;
$output .= wpb_js_remove_wpautop( $content );
$output .= $inner_e;
$output .= '</div>';

echo $output;