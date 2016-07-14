<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = ' '.$this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
//var_dump($css_class);
$output  = $css_class !== ' ' ? '<div class="'.esc_attr( $css_class ).'">' : '';
$output .= wpb_js_remove_wpautop($content);
$output .= $css_class !== ' ' ? '</div>' : '';
echo $output;