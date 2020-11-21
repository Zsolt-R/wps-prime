<?php

/**
 * 3 Full width slider
 * ex: [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"].
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given
 *
 * @return string
 */
function wps_fw_slider_shortcode($atts)
{
    $options = shortcode_atts(
        array(
        'images' => '',
        'links' => '',
        'min' => '22.51em',
        'size' => 'wps_prime_full',
        'size_mobile' => 'wps_prime_medium',
        'scrollbar' => false,
        'pagination' => false,
        ), $atts
    );

    $constructor = 'Add image id\'s to shortcode to use slider ex. images="1,2,3,4..."';

    $image_list_constructor = '';
    $constructor = '';
    $arrays = array();

    wp_enqueue_style('slider_style_core');
    wp_enqueue_script('slider_core');

    // Start ID Check.
    // Check for Images.
    if ($options['images']) {
        $images_id_array = explode(',', $options['images']);
        $arrays = $images_id_array;
    }

    // Check for Links.
    if ($options['links']) {
        $page_id_array = explode(',', $options['links']);
        if (count($images_id_array) === count($page_id_array)) {
            $arrays = array_combine($images_id_array, $page_id_array);
        }
    }

    // If only image id's are avaliable.
    if ($options['images'] && !$options['links']) {
        foreach ($arrays as $image_id) {
            $image_large = wp_get_attachment_image_src($image_id, $options['size']);
            $image_small = wp_get_attachment_image_src($image_id, $options['size_mobile']);

            // Check if image id is valid.
            if ('' !== $image_large) {
                $slide_content = '<picture><source media="(min-width:'.$options['min'].')" srcset="'.$image_large[0].'"><img src="'.$image_small[0].'" class="aligncenter"/></picture>';
            }

            $image_list_constructor .= '<div class="swiper-slide">'.$slide_content.'</div>';
        }

        // If image Id's and Link id's.
    } elseif ($options['images'] && $options['links']) {
        // Check to have equal number of image id's and link id's.
        if (count($images_id_array) === count($page_id_array)) {
            foreach ($arrays as $image_id => $page_links_id) {
                $image_large = wp_get_attachment_image_src($image_id, $options['size']);
                $image_small = wp_get_attachment_image_src($image_id, $options['size_mobile']);

                // Setup Default slide content.
                $slide_content = current_user_can('moderate_comments') ? 'Image ID- "'.$image_id.'" not valid' : '';

                // Check if image id is valid.
                if ('' !== $image_large) {
                    $slide_content = '<picture><source media="(min-width:'.$options['min'].')" srcset="'.$image_large[0].'"><img src="'.$image_small[0].'" class="aligncenter"/></picture>';
                }

                $image_list_constructor .= '<div class="swiper-slide"><a href="'.get_permalink($page_links_id).'">'.$slide_content.'</a></div>';
            }
        } else {
            $image_list_constructor .= '<div class="swiper-slide">should have an equal number of elements check image ID\'s and Link Id\'s</div>';
        }
    }
    if ($options['images']) {
        $constructor .= '<div class="swiper"><div class="swiper-container">';
        $constructor .= '<div class="swiper-wrapper">'.$image_list_constructor.'</div>';
        $constructor .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<div class="swiper-pagination u-hide"></div>';
        $constructor .= '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';
        $constructor .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar u-hide"></div>';
        $constructor .= '</div></div>';
    }

    return $constructor;
}