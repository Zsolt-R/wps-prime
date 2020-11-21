<?php


// ==============================================
// Trigger the script if it has not already been triggered on the page
// ==============================================

function wps_tabbytrigger()
{
    static $tabbytriggered = false; // static so only sets the value the first time it is run

    if ($tabbytriggered == false) {
        echo "\n".'<script>jQuery(document).ready(function($) { RESPONSIVEUI.responsiveTabs(); })</script>'."\n";

        $tabbytriggered = true;
    }
}

/**
 *    18 WPS Tab (Tabby).
 */
function wps_tab_shortcode($atts, $content = null)
{
    $output = '';

    /* Tabby Script */
    wp_enqueue_script('wps_tabby'); // Registered in functions
    add_action('wp_footer', 'wps_tabbytrigger', 20);

    $output .= '<div class="c-responsive-tabs">'.do_shortcode($content).'</div>';

    return $output;
}

/**
 *    19 WPS Tab Item (Tabby inner).
 *
 *     @todo check $class variable, do we need it???
 */
function wps_tab_item_shortcode($atts, $content = null)
{
    $options = shortcode_atts(
        array(
        'title' => '',
        'open' => '',
        'icon_family' => '',
        'icon_class' => '',
        ), $atts
    );

    /**
     * Deprecated
     * these arguments are kept for backward compatibility.
     */
    // TODO remove in time
    $deprecated = shortcode_atts(
        array(
            'ico_class' => '',
            'icon_fontawesome' => '',        // this argument is kept for backward compatibility
            'icon_fontawesome_modern' => '', // this argument is kept for backward compatibility
            'icon_fontawesome_modern_regular' => '',
            'icon_fontawesome_modern_light' => '',
            'icon_fontawesome_modern_solid' => '',
            'icon_fontawesome_modern_brands' => '',
            'ico_type' => '',
        ), $atts);

    $iconClass = wps_getExtraClass(array(
        !empty($deprecated['ico_class']) ? $deprecated['ico_class'] : false, // TODO remove in time
        !empty($options['icon_class']) ? $options['icon_class'] : false,
    ), true);

    // TODO remove in time
    // Check the regular, sometimes it can be decalred only as icon_fontawesome
    $regularIcon = $deprecated['icon_fontawesome'] ? $deprecated['icon_fontawesome'] : '';

    // TODO remove in time
    // If we have a regular icon declared switch to this argument
    if ($deprecated['icon_fontawesome_modern_regular']) {
        $regularIcon = $deprecated['icon_fontawesome_modern_regular'];
    }

    $iconArgs = array(
            // TODO remove in time
            //Start backward compatibility
            'regular' => $regularIcon,
            'light' => $deprecated['icon_fontawesome_modern_light'],
            'solid' => $deprecated['icon_fontawesome_modern_solid'],
            'brands' => $deprecated['icon_fontawesome_modern_brands'],
            // End backward compatibility

            'icon_class' => $iconClass,
            'icon_family' => $options['icon_family'],
            'nowrap' => true,
    );

    $icon = wps_run_icon($iconArgs);

    $tabtarget = sanitize_title_with_dashes(remove_accents(wp_kses_decode_entities($options['title'])));

    //initialise urltarget
    $urltarget = '';

    //grab the value of the 'target' url parameter if there is one
    if (isset($_REQUEST['target'])) {
        $urltarget = sanitize_title_with_dashes($_REQUEST['target']);
    }

    //	Set Tab Panel Class - add active class if the open attribute is set or the target url parameter matches the dashed version of the tab title
    $tabcontentclass = 'tabcontent';

    if (isset($class)) {
        $tabcontentclass .= ' '.$class.'-content';
    }

    if (($options['open']) || (isset($urltarget) && ($urltarget == $tabtarget))) {
        $tabcontentclass .= ' c-responsive-tabs__panel--active';
    }

    $output = '';

    $title = $options['title'] ? $options['title'] : 'Please Add Title';

    $output .= '<h2 class="tabtitle">'.$icon.$title.'</h2>'."\n".'<div class="'.$tabcontentclass.'">'."\n";
    $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}