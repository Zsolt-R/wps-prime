<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $wrapper
 * @var $wrapper_class
 * @var $class
 * @var $holder_img
 * @var $holder_class
 * @var $holder_img_size
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$class = $wrapper = $wrapper_class = $holder_img = $holder_class = $holder_img_size = $style = '';
$holder_start = $holder_end = '';
$wrapper_start = $wrapper_end = '';
$output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



	$class = $class ? ' '.$class : '';
	$class_w = $wrapper_class ? ' '.$wrapper_class : '';
	$class_h = $holder_class ? ' '.$holder_class : '';

	if ( $holder_img ) {
			$image = wp_get_attachment_image_src( $holder_img,$holder_img_size,false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}

	if ( $style || $holder_class ) {

		$holder_start = '<div class="holder'.$class_h.'"'.$style.'>';
		$holder_end = '</div>';
	}

	if ( 'false' !== $wrapper && $wrapper ) {

		$wrapper_start = '<div class="wrapper'.$class_w.'">';
		$wrapper_end = '</div>';
	}


$css_classes = array(
    //'vc_row',
    //'vc_row-fluid',
    'layout',
    $class    
);



$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';



$output .= $holder_start;
$output .= $wrapper_start;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $wrapper_end;
$output .= $holder_end;
echo $output;