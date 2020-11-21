<?php

/**
 * 12 Content Highlight.
 */
function wps_content_highlight_shortcode($atts, $content = null)
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'html_tag' => 'div',
        ), $atts
    );

    $class = wps_getExtraClass($options['class']);
    $tag = $options['html_tag'] ? $options['html_tag'] : 'div'; // Prevent empty.
    $content = do_shortcode($content);

    $output = "<{$tag} class=\"c-highlight{$class}\">{$content}</{$tag}>";

    return $output;
}