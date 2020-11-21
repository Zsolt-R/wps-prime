<?php

/**
 *    16 WPS Anything slider.
 */
function wps_slider_shortcode($atts, $content = null)
{
    $options = shortcode_atts(
        array(
        'scrollbar' => false,
        'pagination' => false,
        'class' => '',
        ), $atts
    );

    $output = '';

    $inner = '';

    wp_enqueue_style('slider_style_core');
    wp_enqueue_script('slider_core');

    $class = wps_getExtraClass($options['class']);

    $output .= '<div class="swiper'.$class.'"><div class="wps-anything-swiper-container"><div class="swiper-wrapper">';
    $output .= do_shortcode($content);
    $output .= '</div>';

    $output .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<div class="swiper-pagination u-hide"></div>';
    $output .= '<div class="wps-anything-swiper-button-prev"></div><div class="wps-anything-swiper-button-next"></div>';
    $output .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar u-hide"></div>';
    $output .= '</div></div>';

    return $output;
}

/**
 *    17 WPS Anything slider.
 */
function wps_slider_item_shortcode($atts, $content = null)
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'content_class' => '',
        'slide_img' => '',
        'img_behave' => '',
        'img_pos' => '',
        'img_size' => 'full',
        'img_size_small' => 'wps_prime_medium',
        ), $atts
    );

    $output = '';
    $style = '';
    $inner = '';
    $class = wps_getExtraClass(
                array(
                $options['class'],
                $options['img_behave'],
                $options['img_pos'],
                )
            );
    $content_class = wps_getExtraClass($options['content_class']);

    if ($options['slide_img']) {
        $image = wp_get_attachment_image_src($options['slide_img'], $options['img_size'], false);
        $style = $image[0] ? " style='background-image:url({$image[0]});background-size:cover;'" : '';
    }

    $output = '<div class="swiper-slide'.$class.'"'.$style.'><div class="swiper__content'.$content_class.'">'.do_shortcode($content).'</div></div>';

    return $output;
}