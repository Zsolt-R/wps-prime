<?php
/**
 * Wrapper function to DRY up icon shortcode logic.
 * 1) Initial Check
 * 2) Setup icon family (regular, solid, duotone ...)
 * 3) Get the icon css class
 * 4) Check if we need a wrapper or not
 * 5) Setup extra schortcode arguments
 * 6) Build the shortcode.
 */
function wps_run_icon($args = array())
{
    $icon = '';
    $iconClass = '';

    /*
     * 1) Initial checks (Bail out early)
     */

    // Check if shortcode exist
    if (!shortcode_exists('wps_icon')) {
        return $icon;
    }

    // If we have no arguments
    if (empty($args)) {
        return $icon;
    }

    // Check if component is using any icon
    if (
        empty($args['regular']) &&
        empty($args['light']) &&
        empty($args['solid']) &&
        empty($args['brands']) &&
        empty($args['icon_class'])
        ) {
        return $icon;
    }

    /**
     * 2) Setup icon family.
     */

    // default
    $iconFamily = 'regular';

    if (!empty($args['icon_family'])) {
        $iconFamily = $args['icon_family'];
    } else {
        // Backward compatibility
        if (!empty($args['regular'])) {
            $iconFamily = 'regular';
        } elseif (!empty($args['light'])) {
            $iconFamily = 'light';
        } elseif (!empty($args['solid'])) {
            $iconFamily = 'solid';
        } elseif (!empty($args['brands'])) {
            $iconFamily = 'brands';
        }
        //End Backward compatibility
    }

    /**
     * 3) Get the icon css class.
     */

    // Check if we have icon class if not set values to empty
    // Backward compatibility
    $regular = !empty($args['regular']) ? $args['regular'] : '';
    $light = !empty($args['light']) ? $args['light'] : '';
    $solid = !empty($args['solid']) ? $args['solid'] : '';
    $brands = !empty($args['brands']) ? $args['brands'] : '';
    // End Backward compatibility

    // This will always win
    $faIcon = !empty($args['icon_class']) ? $args['icon_class'] : '';

    if (!empty($args['icon_class'])) {
        $iconClass = wps_getExtraClass(array($faIcon), true);
    } else {
        $iconClass = wps_getExtraClass(
            array(
                $regular,
                $light,
                $solid,
                $brands,
                $faIcon,
                ), true
        );
    }

    /**
     * 4) Check if we need a wrapper or not.
     */
    $nowrap = !empty($args['nowrap']) ? ' nowrap="'.$args['nowrap'].'"' : '';

    /**
     *  5) MAP extra icon arguments.
     */

    // Extra css classes
    $class = !empty($args['class']) ? $args['class'] : '';

    $cssClass = wps_getExtraClass(
        array(
            $class,
        )
    );

    // Size
    $size = !empty($args['size']) ? ' size="'.$args['size'].'"' : '';

    // Color
    $color = !empty($args['color']) ? ' color="'.$args['color'].'"' : '';

    // Margin
    $margin = !empty($args['margin']) ? ' margin="'.$args['margin'].'"' : '';

    // Html tag
    $htmlTag = !empty($args['html_tag']) ? ' html_tag="'.$args['html_tag'].'"' : '';

    // Html tag
    $link = !empty($args['link']) ? ' link="'.$args['link'].'"' : '';

    // Target
    $target = !empty($args['target']) ? ' target="'.$args['target'].'"' : '';

    // Animation Data
    $animData = !empty($args['anim_data']) ? ' anim_data="'.$args['anim_data'].'"' : '';

    // Center Icon
    $center = !empty($args['center']) ? ' center="'.$args['center'].'"' : '';

    // Wrap class
    $wrapClass = !empty($args['wrap_class']) ? ' wrap_class="'.$args['wrap_class'].'"' : '';

    /**
     * 6) Build the Icon Shortcode.
     */
    $icon = do_shortcode('[wps_icon 
    class="'.$cssClass.'" 
    icon_family="'.$iconFamily.'" 
    icon_class="'.$iconClass.'"
    '.$nowrap.'
    '.$size.'
    '.$color.'
    '.$margin.'
    '.$htmlTag.'
    '.$link.'
    '.$target.'
    '.$animData.'
    '.$center.'
    '.$wrapClass.'
    ]');

    return $icon;
}
