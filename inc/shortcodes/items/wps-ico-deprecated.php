<?php 
/**
 * DEPRECATED
 * 7 Shortcode for icons
 * ex: [wps_ico].
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given
 *
 * @return string
 */
// TODO remove in time
function wps_ico_shortcode($atts)
{
    $options = shortcode_atts(
        array(
        'wrap_class' => '',
        'class' => '',
        'center' => false,
        'icon_fontawesome' => '',        // this argument is kept for backward compatibility
        'icon_fontawesome_modern' => '', // this argument is kept for backward compatibility
        'icon_fontawesome_modern_regular' => '',
        'icon_fontawesome_modern_light' => '',
        'icon_fontawesome_modern_solid' => '',
        'icon_fontawesome_modern_brands' => '',
        'icon_typicons' => '',
        'icon_linecons' => '',
        'icon_woothemesecom' => '',
        'size' => '',
        'color' => '',
        'type' => '',
        'margin' => '',
        'html_tag' => '',
        'link' => '',
        'target' => '',
        'anim_data' => '',
        ), $atts
    );

    $type = '';
    $output = '';

    /**
     * @todo remove in time
     * Deprecated
     */

    // Check the regular, sometimes it can be decalred only as icon_fontawesome
    $regularIcon = $options['icon_fontawesome'] ? $options['icon_fontawesome'] : '';

    // If we have a regular icon declared switch to this argument
    if ($options['icon_fontawesome_modern_regular']) {
        $regularIcon = $options['icon_fontawesome_modern_regular'];
    }

    //Build the argument list
    $iconArgs = array(
        //Start backward compatibility
        'regular' => $regularIcon,
        'light' => $options['icon_fontawesome_modern_light'],
        'solid' => $options['icon_fontawesome_modern_solid'],
        'brands' => $options['icon_fontawesome_modern_brands'],
        // End backward compatibility

        'wrap_class' => $options['wrap_class'],
        'icon_class' => $options['class'],
        'size' => $options['size'],
        'color' => $options['color'],
        'margin' => $options['margin'],
        'html_tag' => $options['html_tag'],
        'link' => $options['link'],
        'target' => $options['target'],
        'anim_data' => $options['anim_data'],
        'center' => $options['center'],
    );

    $output = wps_run_icon($iconArgs);

    return $output;
}