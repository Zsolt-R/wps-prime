<?php
if (! defined('ABSPATH') ) {
    die('-1');
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $margin
 * @var $padding
 * @var $bg_fx
 * @var $txt_color
 * @var $txt_align
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $margin = $padding ='';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$class_to_filter  = wps_getExtraClass(
    array( 
                    $el_class,
                    $margin,
                    $padding,
                    $bg_fx,
                    $txt_color,
                    $txt_align
                    ) 
);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);


$output = '<div class="c-text-block'.esc_attr($css_class).'">' .wpb_js_remove_wpautop($content, true).' </div>';

echo $output;