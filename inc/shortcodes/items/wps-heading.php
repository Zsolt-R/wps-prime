<?php
/**
 * 6 Heading.
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_heading_shortcode($atts, $content = null)
{
    $options = shortcode_atts(
        array(
                'text' => false,
                'size' => '',
                'color' => '',
                'weight' => '',
                'html_tag' => '',
                'margin' => '',
                'padding' => '',
                'link' => false,        //deprecated
                'post_id' => false,     //deprecated
                'target' => false,      //deprecated
                'description' => false, //deprecated             
                'class' => '',
                'text_align' => '',
                'id' => '',
                'anim_data' => '',
                'url' => '',
                'onclick' => '',
        ), $atts
    );

    $output = '';

    $class_list = wps_getExtraClass(
        array(
        $options['size'],
        $options['color'],
        $options['weight'],
        $options['margin'],
        $options['padding'],
        $options['class'],
        $options['text_align'],
        )
    );

    $classes = $class_list ? ' class="'.$class_list.'"' : '';
    $id = $options['id'] ? ' id="'.$options['id'].'"' : '';

    $html_tag = $options['html_tag'] ? $options['html_tag'] : 'h3';   

    $item_link = $item_descr = $item_target = $link = '';

    $has_link = false;

    // Post ID overwrites custom link
    // deprecated
    // TODO remove in time
    if ($options['link'] && !$options['post_id']) {
        $item_link = $options['link'];
    } elseif ($options['post_id']) {
        $item_link = get_permalink($options['post_id']) ? get_permalink($options['post_id']) : '#';
    }

    $item_descr = $options['description'] ? ' title="'.$options['description'].'"' : '';
    $item_target = $options['target'] ? ' target="'.$options['target'].'"' : '';

    if($item_link && !$options['url']){
        $has_link = true;
        $link = 'href="'.$item_link.'"'.$item_descr.$item_target;
    }
    // end TODO

    $on_click = $options['onclick'] ? ' onclick="'.$options['onclick'].'"' : '';

    if ($options['url']) {
        $link_list = wps_generate_url_param_list($options['url']);
        if($link_list){
            $has_link = true;
            $link = $link_list;
        }
    } 
    
    $link_open = $has_link ? '<a '.$link.$on_click.'>' : '';
    $link_close = $has_link ? '</a>' : '';

    $output .= $options['text'] ? '<'.$html_tag.$classes.$id.'>'.$link_open.$options['text'].$link_close.'</'.$html_tag.'>' : '';

    $anim = $options['anim_data'] ? ' data-animate="'.$options['anim_data'].'"' : '';

    return '<div class="c-heading"'.$anim.'>'.$output.'</div>';
}
