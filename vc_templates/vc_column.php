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
 * @var $layout_width
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */
$class = $width = $css = $offset = $layout_width = $inner_img = $inner_img_size = $style = '';
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


if ( $inner_img ) {
			$image = wp_get_attachment_image_src( $inner_img,$inner_img_size,false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}

if( $inner_class !== '' ||  $style !== ''){
	$inner_s = "<div class=\"layout__item_inner {$inner_class}\"{$style}>";
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