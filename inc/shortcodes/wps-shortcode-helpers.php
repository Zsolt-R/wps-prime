<?php
/**
 * Theme Shortcodes Helpers.
 */

/**
 * @param $class
 *
 * @return string
 */
function wps_getExtraClass($class, $flush = false)
{
    $output = '';
    $space = $flush ? '' : ' ';

    // Check is we get an array
    if (is_array($class)) {
        $isFirst = 0;

        foreach ($class as $css_class) {
            ++$isFirst;

            // if we have multiple values flush only the first space
            if (1 === $isFirst && $flush) {
                $space = '';
            } else {
                $space = ' ';
            }

            // Check if we have a valid value and field is not empty
            if (!empty($css_class)) {
                $output .= $space.$css_class;
            }
        }
    } else {
        // Check if we have a valid value and field is not empty
        if (!empty($class)) {
            $output = $space.$class;
        }
    }

    return $output;
}

// Wrap video iframe in extra field used by responsive video js
add_filter('embed_oembed_html', 'tdd_oembed_filter', 99, 4);
function tdd_oembed_filter($html, $url, $attr, $post_ID)
{
    return  '<figure class="videoWrapper">'.$html.'</figure>';
}

/**
 * Extract video ID from youtube url.
 *
 * @param string $url Youtube url
 *
 * @return string
 */
function wps_extract_youtube_id($url)
{
    parse_str(parse_url($url, PHP_URL_QUERY), $vars);

    if (!isset($vars['v'])) {
        return '';
    }

    return $vars['v'];
}

function wps_remove_wpautop($content, $autop = false)
{
    if ($autop) {
        $content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");
    }

    // Don’t auto-p wrap shortcodes that stand alone
    // ref: https://developer.wordpress.org/reference/functions/shortcode_unautop/
    return do_shortcode(shortcode_unautop($content));
}
