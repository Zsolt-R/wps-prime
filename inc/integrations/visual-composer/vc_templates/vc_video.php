<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $el_class
 * @var $css
 * @var $el_width
 * @var $el_aspect
 * @var $align
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Video
 */
$title = $link = $el_class = $css = $el_width = $el_aspect = $align = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $link ) {
	return null;
}
$el_class = $this->getExtraClass( $el_class );

$video_w = 500;
$video_h = $video_w / 1.61; //1.61 golden ratio

/** @var WP_Embed $wp_embed */
global $wp_embed;
$embed = '';

if ( is_object( $wp_embed ) ) {
	$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $link . '[/embed]' );
}
$el_classes = array(
	$el_class,
);
$css_class = implode( ' ', $el_classes );
$output = $css_class != '' ? '<div class="' . esc_attr( $css_class ) . '">' . $embed . '</div>' : $embed;
echo $output;