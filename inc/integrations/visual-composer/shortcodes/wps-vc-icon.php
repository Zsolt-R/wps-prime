<?php
/*
* WPS Custom video options setup
*/

function wps_vc_icon_deprecated_shortcode()
{
    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => __('Icon family', 'wps-fontawesome'),
            'param_name' => 'icon_family',
            'admin_label' => true,
            'value' => array(
                            __('Solid', 'wps-fontawesome') => 'solid',
                            __('Regular', 'wps-fontawesome') => 'regular',
                            __('Light', 'wps-fontawesome') => 'light',
                            __('Duotone', 'wps-fontawesome') => 'duotone',
                            __('Brands', 'wps-fontawesome') => 'brands',
                            ),
            'std' => 'regular',
            'description' => __('Fontawesome 5 types', 'wps-fontawesome'),
                        ),

        array(
                'type' => 'textfield',
                'heading' => __('Icon Class', 'wps-fontawesome'),
                'param_name' => 'icon_class',
                'admin_label' => true,
                'value' => '',
                'description' => __('Set a custom icon css class name ex. fab 500px', 'wps-fontawesome'),
        ),
        array(
                'type' => 'dropdown',
                'heading' => __('Icon size', 'wps-fontawesome'),
                'param_name' => 'size',
                'admin_label' => true,
                'value' => wps_ico_size(),
                'description' => __('Set icon size', 'wps-fontawesome'),
        ),
        array(
                'type' => 'dropdown',
                'heading' => __('Icon color', 'wps-fontawesome'),
                'param_name' => 'color',
                'admin_label' => true,
                'value' => wps_ico_colors(),
                'std' => '',
                'description' => __('Set icon color', 'wps-fontawesome'),
        ),
        array(
                'type' => 'textfield',
                'heading' => __('Class', 'wps-fontawesome'),
                'param_name' => 'class',
                'admin_label' => true,
                'value' => '',
                'description' => __('Add custom CSS class.', 'wps-fontawesome'),
        ),
        array(
                'type' => 'textfield',
                'heading' => __('Icon Wrap Class', 'wps-fontawesome'),
                'param_name' => 'wrap_class',
                'admin_label' => true,
                'value' => '',
                'description' => __('Add custom CSS class to the icon wrapper element.', 'wps-fontawesome'),
                ),
        array(
                'type' => 'textfield',
                'heading' => __('Link', 'wps-fontawesome'),
                'param_name' => 'link',
                'admin_label' => true,
                'value' => '',
                'group' => esc_html__('Link', 'wps-fontawesome'),
                'description' => __('Link address ex: http://yourlink.com/yourpage', 'wps-fontawesome'),
                ),
        array(
                'type' => 'dropdown',
                'heading' => __('Link target', 'wps-fontawesome'),
                'param_name' => 'target',
                'value' => array(
                                __('Default', 'wps-fontawesome') => '',
                                __('New tab', 'wps-fontawesome') => '_blank',
                                ),
                'group' => esc_html__('Link', 'wps-fontawesome'),
                'description' => __('<small>Link target specifies where to open the linked document.</small> <br/> _blank (Opens the linked document in a new tab)', 'wps-fontawesome'),
                            ),
        array(
                'type' => 'checkbox',
                'heading' => __('Center', 'wps-fontawesome'),
                'param_name' => 'center',
                'admin_label' => true,
                'value' => '',
                'description' => __('Center Icon.', 'wps-fontawesome'),
                            ),

        array(
            'type' => 'dropdown',
            'heading' => __('Display type', 'wps-fontawesome'),
            'param_name' => 'html_tag',
            'admin_label' => true,
            'value' => array(
                            __('Block', 'wps-fontawesome') => 'div',
                            __('Inline', 'wps-fontawesome') => 'span',
                            ),
            'std' => 'div',
            'description' => __('Set the html tag that wraps the icon. Div for block, Span for inline', 'wps-fontawesome'),
                        ),
        // Only for VC UI functionality
        array(
                'type' => 'checkbox',
                'heading' => __('Set Margin', 'wps-fontawesome'),
                'param_name' => 'set_margin',
                'admin_label' => false,
            ),
        /////////////////////////////////

        array(
                'type' => 'wps_margin',
                'heading' => __('Margin Settings', 'wps-fontawesome'),
                'param_name' => 'margin',
                'admin_label' => true,
                'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            ),
        array(
                'type' => 'textfield',
                'heading' => 'Animation data CSS class',
                'param_name' => 'anim_data',
                'admin_label' => true,
                'value' => '',
                'group' => esc_html__('Animation', 'wps-fontawesome'),
                'description' => __('Add custom animation data (css class) to element. ex. animated bounce | https://github.com/daneden/animate.css', 'wps-fontawesome'),
            ),
        );
    // Title
    vc_map(
        array(
            'name' => __('Icon', 'wps-prime'),
            'description' => __('Eye catching icons from libraries', 'wps-prime'),
            'base' => 'wps_ico',
            'category' => __('Content', 'wps-prime'),
            'params' => $attributes,
            'icon' => 'icon-wpb-vc_icon',
            'js_view' => 'VcIconElementView_Backend',
            'deprecated' => true,
            'content_element' => false,
        )
    );
}
