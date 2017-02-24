<?php
/**
 * Theme Shortcodes
 *
 * @package wps_prime
 */

/**
 *  WPS SHORTCODES
 *
 * 1  Row Wrapper Markup - [wps_row class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 * 2  Row Item Markup - [wps_col class="lap-and-up..."] ...content... [/wps_col]
 * 3  Full Width Slider - [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 * 4  Custom Buttons - [wps_button class="c-button--small,c-button--large,c-button--primary,c-button--secondary,c-button--tertiary" link="http://www...." label="button label"]
 * 5  Image [wps_image]
 * 6  Heading
 * 7  Icons - [wps_ico]fa fa-home[/wps_ico]
 * 8  Main Phone number - [wps_main_phone_nr class="" link="true"]
 * 9  Main Email address - [wps_main_email class="" link="true"]
 * 10 List styles [wps_list class="c-list--style-one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list]
 * 11 Media Box [wps_mediabox]...content...[/wps_mediabox]
 * 12 Highlight [wps_hglt class="" html_tag=""]...content...[/wps_hglt]
 * 13 Divider [wps_divider]
 * 14 Accordion [wps_accordion]
 * 15 Accordion item [wps_accordion_item]
 * 16 WPS Anything slider [wps_all_slider]
 * 17 WPS Anything slider slide [wps_all_slider_item]
 * 18 WPS Tabby [wps_tab_shortcode]
 * 19 WPS Tabby Item [wps_tab_item_shortcode]
 * 20 WPS social links [wps_social_links]
 */

/* 1 Row Wrapper Markup */
add_shortcode('wps_row', 'wps_row_shortcode');

/* 2 Row Item Markup */
add_shortcode('wps_col', 'wps_col_shortcode');

/* 3 Full Width Slider */
add_shortcode('wps_slider', 'wps_fw_slider_shortcode');

/* 4 Custom Buttons */
add_shortcode('wps_button', 'wps_buttons_shortcode');

/* 5 Heading */
add_shortcode('wps_heading', 'wps_heading_shortcode');

/* 6 Image */
add_shortcode('wps_image', 'wps_image_shortcode');

/* 7 Shortcode for icons */
add_shortcode('wps_ico', 'wps_ico_shortcode');

/* 8 Get theme option phone nr */
add_shortcode('wps_main_phone_nr', 'wps_main_phone_nr_shortcode');

/* 9 Get theme option email */
add_shortcode('wps_main_email', 'wps_main_email_shortcode');

/* 10 Creates a custom bulleted list */
add_shortcode('wps_list', 'wps_styled_list_shortcode');

/* 11 Generate a complex Media Box */
add_shortcode('wps_mediabox', 'wps_media_box_shortcode');

/* 12 Content highlight Markup */
add_shortcode('wps_hglt', 'wps_content_highlight_shortcode');

/* 13 Content divider */
add_shortcode('wps_divider', 'wps_content_divider_shortcode');

/* 14 Accordion */
/* 15 Accordion item */
/* see wps_acc_shortcode.php */

/* 16 WPS Anything slider */
add_shortcode('wps_all_slider', 'wps_slider_shortcode');

/* 17 WPS Anything slider slide */
add_shortcode('wps_all_slider_item', 'wps_slider_item_shortcode');

/* 18 WPS Tabby */
add_shortcode('wps_tab', 'wps_tab_shortcode');

/* 19 WPS Tabby Item */
add_shortcode('wps_tab_item', 'wps_tab_item_shortcode');

/* 20 WPS social links */
add_shortcode('wps_social_links', 'wps_social_links_shortcode');

/**
 * 1 Row Item Markup
 * ex. [wps_row class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_row_shortcode( $atts, $content = null ) 
{
    $options = shortcode_atts(
        array(            
                'class' => '',
                'wrapper' => false,
                'wrapper_class' => '',
                'holder_img' => '',
                'holder_class' => '',
                'holder_id' =>'',
                'holder_img_size' => 'full',
                'background' => '',
                'use_parallax' => false,
                'holder_margin' => '',
                'holder_padding' => '',
                'holder_img_pos' => '',
                'holder_bg_fx' =>'',
                'row_v_align' => '',
                'row_h_align' => '',
                'row_adjust' => '',
                'grid_col_full_height' => '',
                'grid_col_equal_height' => '',
                'row_align' => '',
                'v_bg' => '',    
                'v_youtube' => '',
                'v_hosted' => '',
                'v_placeholder' => '',
                'video_bg' => '',
                'hosted_video' => '',
                'tube_video' => ''
        ), $atts 
    );

    $v_bg = $v_youtube = $v_hosted = $v_placeholder = $video_bg = $hosted_video = $tube_video = $wrapper = $css_class = $background = '';

    $holder_start = $holder_end = '';
    $wrapper_start = $wrapper_end = '';
    $output = '';
            
    $css_classes = array();

    $has_tube_bg = ( ! empty($options['v_bg']) && ! empty($options['v_youtube']) && wps_extract_youtube_id($options['v_youtube']) );
    $has_hosted_bg = ( ! empty($options['v_bg']) && ! empty($options['v_hosted']) );

    if ($has_tube_bg && wps_extract_youtube_id($options['v_youtube'])) {

        $parallax_image = $options['v_youtube'];
        $css_classes[] = 'vc_video-bg-container';        
        $tube_video = '<span class="wps-ytube-video" data-video-bg-id="' . wps_extract_youtube_id($options['v_youtube']) . '"></span>';
                
    }    

    if($has_hosted_bg ) {
        $hosted_video = '<div class="wps-bg-video-wrapper"><video playsinline autoplay muted loop ';
        $hosted_video .= wp_get_attachment_url($options['v_placeholder']) ? 'poster="'.wp_get_attachment_url($options['v_placeholder']).'" ' : '';
        $hosted_video .= 'class="wps-bg-video">';
        $hosted_video .= '<source src="'.wp_get_attachment_url($options['v_hosted']).'" type="video/mp4"></video></div>';        
    }

    if($has_tube_bg || $has_hosted_bg ) {
        $video_bg = $has_tube_bg ?  $tube_video : $hosted_video;
        wp_enqueue_script('wps_vc_video_bg');
    }

    // Layout Classes
    $class  = wps_getExtraClass(
        array(
                 $options['class'],
                 $options['row_v_align'],
                 $options['row_h_align'],
                 $options['row_align'],
                 $options['row_adjust'],
                 $options['grid_col_equal_height'] ? wps_getExtraClass('grid--equalHeight') : '',
                 $options['grid_col_full_height'] ? wps_getExtraClass('grid--full-height') : ''
                      )
    );            

    // Holder Classes
    $class_h  = wps_getExtraClass(
        array(
                    $options['video_bg'] ? wps_getExtraClass('o-holder--video') : '',
                    $options['holder_class'],                    
                    $options['holder_img_pos'],
                    $options['holder_bg_fx'],
                    $options['holder_margin'],
                    $options['holder_padding']    
                ) 
    );

    // Wrapper Classes
    $class_w  = wps_getExtraClass(array( 'o-wrapper', $options['wrapper_class'] ));

    // Holder ID
    $row_id = $options['holder_id'] ? ' id="'. $options['holder_id'] .'" ' : '';

    if ($options['holder_img'] && !$has_hosted_bg) {

        $image = wp_get_attachment_image_src($options['holder_img'], $options['holder_img_size'], false);
        $background = $image[0] ? " style='background-image:url({$image[0]});'" : '';

        if ($options['use_parallax'] ) {    
            wp_enqueue_script('wps_parallax'); // Registered in functions
            $background = " data-parallax=\"scroll\" data-image-src=\"{$image[0]}\"";
            $class_h .= wps_getExtraClass('parallax-window');
        }
    }

    if ($background || $class_h || $row_id || $video_bg) {
        $holder_start = '<div '.$row_id.'class="o-holder'.$class_h.'"'.$background.'>'.$video_bg;
        $holder_end = '</div>';
    }
        
    if ('false' !== $options['wrapper'] && $options['wrapper'] ) {
        $wrapper_start = '<div class="'.$class_w.'">';
        $wrapper_end = '</div>';
    }

    $css_classes = array(
                    'grid-1',
                    $class,    
                    );

    $css_class = preg_replace('/\s+/', ' ', implode(' ', array_filter(array_unique($css_classes))));

    $output .= $holder_start;
    $output .= $wrapper_start;
    $output .= '<div class="' . esc_attr(trim($css_class)) . '">';
    $output .= wps_remove_wpautop($content, true);
    $output .= '</div>';
    $output .= $wrapper_end;
    $output .= $holder_end;

    return $output;
}

/**
 * 2 Row Wrapper Markup
 * ex: [wps_col class="lap-and-up..."] ...content... [/wps_col]
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_col_shortcode( $atts, $content = null ) 
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'width' => '',
        'inner'=>true,
        'inner_class'=>'',
        'row_width' => '',
        'margin'=>'',
        'padding'=>'',
        'margin_inner'=>'',
        'padding_inner'=>'',
        'inner_img' => '',
        'inner_img_size' => 'full',
        'inner_img_pos' =>'',
        'inner_bg_fx' =>'',
        'align_content_inner' =>''
        ), $atts 
    );

    $inner_start = $inner_end ='';
    $style = '';


    $class  = wps_getExtraClass(
        array(        
              $options['class'],
              $options['width'],
              $options['margin'],
              $options['padding']
              )
    );

    $inner_class  = wps_getExtraClass(
        array(
                    $options['inner_class'],
                    $options['margin_inner'],
                    $options['padding_inner'],
                    $options['inner_img_pos'],
                    $options['inner_bg_fx'],
                    $options['align_content_inner']
                    )
    );

    
    $row_width = wps_getExtraClass($options['row_width'], true); // flush space between classes

    if ($options['inner_img'] ) {
         $image = wp_get_attachment_image_src($options['inner_img'], $options['inner_img_size'], false);
         $style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
    }
    
    /* Just fill the inner_class argument to activate, and deactivate by setting inner 
    *  to false this way you can deactivate the inner element 
    *  whithout deleting the inner_class argument
    */
    if ($inner_class !== '' ||  $style !== '' ) {

        $inner_start = "<div class=\"col_inner{$inner_class}\"{$style}>";
        $inner_end = "</div>";
    }

    $output = '<div class="col '. $class .''. $row_width .'">'.$inner_start .'' . wps_remove_wpautop(do_shortcode($content), true). ''.$inner_end.'</div>';

    return  $output;
}

/**
 * 3 Full width slider
 * ex: [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 *
 * @param  array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_fw_slider_shortcode( $atts ) 
{
    $options = shortcode_atts(
        array(
        'images' => '',
        'links' => '',
        'min' => '22.51em',
        'size' => 'wps_prime_full',
        'size_mobile' => 'wps_prime_medium',
        'scrollbar' => false,
        'pagination' => false
        ), $atts 
    );

    $constructor = 'Add image id\'s to shortcode to use slider ex. images="1,2,3,4..."';

    $image_list_constructor = '';
    $constructor = '';
    $arrays = array();

    wp_enqueue_script('slider_core');

    // Start ID Check.
    // Check for Images.
    if ($options['images'] ) {
        $images_id_array = explode(',', $options['images']);
        $arrays = $images_id_array;
    }

    // Check for Links.
    if ($options['links'] ) {
        $page_id_array = explode(',', $options['links']);
        if (count($images_id_array) === count($page_id_array) ) {
            $arrays = array_combine($images_id_array, $page_id_array);
        }
    }

    // If only image id's are avaliable.
    if ($options['images'] && ! $options['links'] ) {

        foreach ( $arrays as $image_id ) {

            $image_large = wp_get_attachment_image_src($image_id, $options['size']);
            $image_small = wp_get_attachment_image_src($image_id, $options['size_mobile']);

            // Check if image id is valid.
            if ('' !== $image_large ) {
                $slide_content = '<picture><source media="(min-width:'. $options['min'] .')" srcset="'. $image_large[0] .'"><img src="'. $image_small[0] .'" class="aligncenter"/></picture>';
            }

            $image_list_constructor .= '<div class="swiper-slide">'. $slide_content .'</div>';

        }

        // If image Id's and Link id's.
    } elseif ($options['images'] && $options['links'] ) {

        // Check to have equal number of image id's and link id's.
        if (count($images_id_array) === count($page_id_array) ) {

            foreach ( $arrays as $image_id => $page_links_id ) {

                $image_large = wp_get_attachment_image_src($image_id, $options['size']);
                $image_small = wp_get_attachment_image_src($image_id, $options['size_mobile']);

                // Setup Default slide content.
                $slide_content = current_user_can('moderate_comments') ? 'Image ID- "'. $image_id.'" not valid' : '';

                // Check if image id is valid.
                if ('' !== $image_large ) {
                     $slide_content = '<picture><source media="(min-width:'. $options['min'] .')" srcset="'. $image_large[0] .'"><img src="'. $image_small[0] .'" class="aligncenter"/></picture>';
                }

                $image_list_constructor .= '<div class="swiper-slide"><a href="'. get_permalink($page_links_id)  .'">'. $slide_content .'</a></div>';

            }
        } else {
            $image_list_constructor .= '<div class="swiper-slide">should have an equal number of elements check image ID\'s and Link Id\'s</div>';

        }
    }
    if ($options['images'] ) {

        $constructor .= '<div class="swiper"><div class="swiper-container">';
        $constructor .= '<div class="swiper-wrapper">'. $image_list_constructor .'</div>';
        $constructor .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<div class="swiper-pagination u-hide"></div>';
        $constructor .= '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';
        $constructor .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar u-hide"></div>';
        $constructor .= '</div></div>';
        
    }

    return $constructor;
}

/**
 * 4 Custom Buttons
 * ex:  [wps_button class="c-button--small,c-button--large,c-button--primary,c-button--secondary,c-button--tertiary" link="http://www...." label="button label"]
 *
 * @param  array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_buttons_shortcode( $atts ) 
{
    $options = shortcode_atts(
        array(
        'class'   => '',
        'label'   => 'Please add label',
        'link'    => '',
        'target'  => '',
        'align'   => '',
        'margin'  => '',
        'padding' =>'',
        'aspect'  => '',
        'size'       => '',
        'ghost'      => '',
        'color'   => '',
        'onclick' => '',        
        'ico_class' => '',
        'icon_fontawesome' => '',         // default value to backend editor | param used by VC
        'icon_typicons' => '',            // default value to backend editor | param used by VC
        'icon_linecons' => '',            // default value to backend editor | param used by VC
        'icon_woothemesecom' => '',        // default value to backend editor | param used by VC
        'ico_type'=>'',
        'ico_position' => 'end'
        ), $atts 
    );

    $styleClass  = wps_getExtraClass(
        array(         
                   $options['class'], 
                   $options['align'], 
                   $options['margin'], 
                   $options['padding'], 
                   $options['color'], 
                   $options['ghost'] ? ' c-button--ghost' : '',
                   $options['size'], 
                   $options['aspect'] 
                   )
    );


    $btnInfotext = $options['label'] ? $options['label'] : '';
    $btnLink = $options['link'] ? $options['link'] : '#';
    $btnTarget = $options['target'] ? ' target="'.$options['target'].'"' : '';
    $btnOnClick = $options['onclick'] ? ' onclick="'.$options['onclick'].'"' : '';

    $type = $options['ico_type'] ? $options['ico_type'] : 'fontawesome'; // Set as default iconfont

    // Enque frontend icon font family
    wps_icon_element_fonts_enqueue($type);

    // Set icon position css class
    $btnPosClass = 'end' !== $options['ico_position'] ? 'c-button__ico--start' : 'c-button__ico--end';

    $ico_type_class = wps_getExtraClass(
        array(
            'c-button__ico',
            $btnPosClass,
            $options["icon_{$type}"]
            )
        );

    $btnIcon = $options["icon_{$type}"] ? '<i class="'.$ico_type_class.'"></i>' : '';
    
    // Set icon position defaults
    $btnEnd = $btnIcon;
    $btnStart = '';    

    if( 'end' !== $options['ico_position']){
        $btnEnd = '';
        $btnStart = $btnIcon;        
    }

    $output = '<a class="c-button'. $styleClass .'" href="'.$btnLink.'"'.$btnTarget.$btnOnClick.'>'.$btnStart. $btnInfotext .$btnEnd.'</a>';

    return $output;

}

/**
 * 5 Image
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_image_shortcode( $atts, $content = null ) 
{
    $options = shortcode_atts(
        array(
                'image_id'   => false,
                'image_size' => 'full',
                'align'  => 'alignone',
                'margin'=>'',
                'padding'=>'',
                'link'   => false,
                'target' => false,
                'class'         => ''
        ), $atts 
    );

    $output = '';

    $image_class = wps_getExtraClass(
        array( 
                    $options['padding'],
                    $options['margin'],
                    $options['align'],
                    $options['class'],
                    ) 
    );    

    $image = wp_get_attachment_image($options['image_id'], $options['image_size'], "", array( "class" => $image_class ));

    $target = $options['target'] ? 'target="'.$options['target'].'"' : '';

    if($options['link'] ) {
        $output = sprintf('<a href="%1$s"%2$s>%3$s</a>', $options['link'], $target, $image);
    }else{
        $output = $image;
    };

    return '<div class="c-image">'.$output.'</div>';
}

/**
 * 6 Heading
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_heading_shortcode( $atts, $content = null ) 
{

    $options = shortcode_atts(
        array(
                'text'     => false,
                'size'     => '',
                'color'    => '',
                'weight'   => '',
                'html_tag' => '',
                'margin'   =>'',
                'padding'  =>'',
                'link'     => false,
                'target'   => false,
                'class'       => '',
                'text_align' =>'',
                'id'       => ''
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
        $options['text_align']
        ) 
    );    

    $classes = $class_list ? ' class="'.$class_list.'"' : '';
    $id = $options['id'] ? ' id="'.$options['id'].'"' : '';

    $html_tag = $options['html_tag'] ? $options['html_tag'] : 'h3';    

    $target = $options['target'] ? ' target="'.$options['target'].'"':'';

    $link_open  = $options['link'] ? '<a href="'.$options['link'].'"'.$target.'>':'';
    $link_close = $options['link'] ? '</a>':'';

    $output .= $options['text'] ? '<'.$html_tag.$classes.$id.'>'.$link_open.$options['text'].$link_close.'</'.$html_tag.'>' : '';


    return '<div class="c-heading">'.$output.'</div>';
}

/**
 * 7 Shortcode for icons
 * ex: [wps_ico]fa fa-home[/wps_ico]
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_ico_shortcode( $atts, $content = null ) 
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'center'=> false,
        'icon_fontawesome' => '',         // default value to backend editor | param used by VC
        'icon_typicons' => '',            // default value to backend editor | param used by VC
        'icon_linecons' => '',            // default value to backend editor | param used by VC
        'icon_woothemesecom' => '',        // default value to backend editor | param used by VC
        'size'=>'',
        'color' =>'',
        'type' =>'',
        'margin'=>'',
        'html_tag' => '',
        'link' => '',
        'target'=>''
        ), $atts 
    );

    $type = '';
    $output = '';

    $content = $content ? ' '.$content : '';

    $type = $options['type'] ? $options['type'] : 'fontawesome'; // Set as default iconfont


    $ico_class = wps_getExtraClass(
        array(
        $options['class'] ? $options['class'] : '',
        $options['color'] ? $options['color'] : '',
        $options["icon_{$type}"] ? $options["icon_{$type}"] : '',
        $options['size'] ? $options['size'] : '',
        $options['margin'] ? $options['margin'] : '',
        )
    );

    $center = $options['center'] ? ' ico-wrap--center' : '';

    $tag = $options['html_tag'] ? $options['html_tag'] : 'div'; // Prevent empty.
    
    $icoTarget = $options['target'] ? ' target="'.$options['target'].'"' : '';

    // Enque frontend icon font family
    wps_icon_element_fonts_enqueue($type);

    $linkStart = $options['link'] !== '' ? '<a href="'.$options['link'].'"'.$icoTarget.'>' : '';
    $linkEnd   = $options['link'] !== '' ? '</a>' : '';

    // If the wrapper is block element add the link inside 
    // Prevent the link going beyond the actual icon by wrapping it's block-level holder
    if('div' === $tag) {
        $output = '<'.$tag.' class="ico-wrap'.esc_attr($center).'">'.$linkStart.'<i class="ico'. esc_attr($content) . esc_attr($ico_class) .'"></i>'.$linkEnd.'</'.$tag.'>';
    }else{
        $output = $linkStart.'<'.$tag.' class="ico-wrap'.esc_attr($center).'"><i class="ico'. esc_attr($content) . esc_attr($ico_class) .'"></i></'.$tag.'>'.$linkEnd;
    }    

    return $output;
}

/**
 * 8 Main Phone number
 * ex: [wps_main_phone_nr]
 */
function wps_main_phone_nr_shortcode($atts) 
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'link' => false,
        'secondary' => false
        ), $atts 
    );

    $phone_numbers = array(
    wps_get_theme_option('phone_nr'),
    wps_get_theme_option('phone_nr_second')
    );

    $phone_nr = $options['secondary'] ? $phone_numbers[1] : $phone_numbers[0];

    $phone = $phone_nr ? $phone_nr : 'No phone number set';

    $output = '';

    $element_class = $options['class'] ? ' '.'class="'. $options['class'] .'"' : '';
    $output = $options['link'] ? '<a href="tel:'.$phone.'"'.$element_class.'>'.$phone.'</a>' : $phone;

    return $output;
}

/**
 * 9 Main Email address
 * ex: [wps_main_email]
 */
function wps_main_email_shortcode($atts) 
{
    $options = shortcode_atts(
        array(
        'class' => '',
        'link' => false,
        'secondary' => false
        ), $atts 
    );

    $emails = array(
    wps_get_theme_option('email_address'),
    wps_get_theme_option('email_address_secondary')
    );

    $email = $options['secondary'] ? $emails[1] : $emails[0];


    $email = $email ? $email : 'No email set';

    $output = '';

    $element_class = $options['class'] ? ' '.'class="'. $options['class'] .'"' : '';
    $output = $options['link'] ? '<a href="mailto:'.$email.'"'.$element_class.'>'.$email.'</a>' : $email;

    return $output;
}

/**
 * 10 Styled List
 * ex: [wps_list class="c-list-style--one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list]
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_styled_list_shortcode( $atts, $content = null ) 
{
    $options = shortcode_atts(
        array(        
        'style' => '',
        'color' => '',
        'deco' => '',
        'class' => ''
        ), $atts 
    );

    $list_style = '';

    $list_styles = wps_getExtraClass(
        array(
        'c-list',
        $options['style'],
        $options['color'],
        $options['deco'],
        $options['class'],
        )
    );

    wps_icon_element_fonts_enqueue('fontawesome');

    $sc_content = wpb_js_remove_wpautop($content,true);

    $output = '<div class="'. $list_styles .'">'. do_shortcode($sc_content) .'</div>';

    return $output;

}

/**
 * 11 Media Box
 * ex: [wps_mediabox image_id="1038" image_class="aligncenter img--round img--border" image_size="thumbnail" ico_class="fa fa-envelope fa-4x" class="bg--color-one p- txt--color-invert" type="flag" type_class="flag--responsive" title="Contact our experts today!" title_class="txt--bold mb-"]...content...[/wps_mediabox]
 *
 * @param  array $atts    an associative array of attributes, or an empty string if no attributes are given.
 * @param  str   $content the enclosed content.
 * @return string
 */
function wps_media_box_shortcode( $atts, $content = null ) 
{

    $args = shortcode_atts(
        array(
        'image_id' => '',
        'image_class' => '',
        'image_size' => 'full',
        'image_link' => '',
        'ico_class' => '',
        'icon_fontawesome' => '',         // default value to backend editor | param used by VC
        'icon_typicons' => '',            // default value to backend editor | param used by VC
        'icon_linecons' => '',            // default value to backend editor | param used by VC
        'icon_woothemesecom' => '',        // default value to backend editor | param used by VC
        'ico_type'=>'',
        'icon_align' => '',
        'icon_size' => '',
        'icon_color' => '',
        'type' => '',
        'type_class' => '',
        'type_spacing' => false,
        'type_reverse' => '',
        'type_img_class' => '',
        'not_responsive' => false,        
        'txt_color' => '',    
        'margin' => '',
        'class' => ''

        ), $atts
    );

    $output = '';
    $type = 'fontawesome'; // default
    $image_args = array();

    $content = do_shortcode($content);

    $class = '';

    if('' !== $args['ico_type']) {
        $type = $args['ico_type'];
    }

    // Enqueue frontend icon font family
    if('' !== $type) {
        wps_icon_element_fonts_enqueue($type);
    }

    // Mediabox class.
    $class = wps_getExtraClass(
        array(
        $args['class'],
        $args['txt_color'],
        $args['margin']
        )
    );

    // Symbol image/ico.
    if ($args['image_class'] !== '' ) {
        $image_args['class'] = $args['image_class'];
    }

    $ico_type = $args['ico_type'] ? $args['ico_type'] : 'fontawesome'; // Set as default iconfont

    $ico_type_class = wps_getExtraClass($args["icon_{$ico_type}"]);

    $ico_class_custom = wps_getExtraClass(
        array(
                $args['ico_class'],
                $args['icon_size'],
                $args['icon_color']
                )
    );


    $ico = $ico_class_custom || $ico_type_class ? "<div class=\"ico-wrap ico-wrap--center\"><i class=\"ico{$ico_class_custom}{$ico_type_class}\"></i></div>" : '';


    $image = $args['image_id'] !== '' ? wp_get_attachment_image($args['image_id'], $args['image_size'], false, $image_args) :'';

    $symbol = $image ? $image : $ico;

    // Type.
    $type_class = wps_getExtraClass(
        array(
        $args['type'],
        $args['type_class'],
        $args['not_responsive'] ? '': $args['type'].'--responsive',
        $args['type_reverse'] ? $args['type'].'--reverse' : '',
        $args['type_spacing'] ? $args['type'].$args['type_spacing'] : '',
        )
    );

    $type_spacing = $args['type_spacing'] ? wps_getExtraClass(array('c-mediabox'.$args['type_spacing'])) : '';


    //Img link
    $img_link_start = $args['image_link'] ? '<a href="'. $args['image_link'] .'">' : '';
    $img_link_end = $args['image_link'] ? '</a>' : '';

    $content = do_shortcode($content);

    if ($args['type'] !== '' ) {

        $output = "<div class=\"c-mediabox{$class}\"><div class=\"{$type_class}\"><div class=\"{$args['type']}__img\">{$img_link_start}{$symbol}{$img_link_end}</div><div class=\"{$args['type']}__body\">{$content}</div></div></div>";
    } else {

        $output = "<div class=\"c-mediabox{$class}{$type_spacing}\"><div class=\"c-mediabox__symbol\">{$img_link_start}{$symbol}{$img_link_end}</div>{$content}</div>";
    }

    $sc_content = wpb_js_remove_wpautop($output,true);


    return $sc_content;
}

/**
 * 12 Content Highlight
 */
function wps_content_highlight_shortcode( $atts, $content = null ) 
{

    $args = shortcode_atts(
        array(
        'class' => '',
        'html_tag' => 'div',
        ), $atts
    );

    $class = wps_getExtraClass($args['class']);
    $tag = $args['html_tag'] ? $args['html_tag'] : 'div'; // Prevent empty.
    $content = do_shortcode($content);

    $output = "<{$tag} class=\"c-highlight{$class}\">{$content}</{$tag}>";

    return $output;

}

/**
 * 13 Content Divider
 */
function wps_content_divider_shortcode( $atts ) 
{

    $args = shortcode_atts(
        array(
        'style' => '',
        'class' => '',
        'padding' => '',
        'margin' => ''
        ), $atts
    );

    $class = wps_getExtraClass(
        array(
                'c-divider',
                $args['class'],
                $args['style'],
                $args['padding'],
                $args['margin']
                )
    );

    $output = "<hr class=\"{$class}\"/>";

    return $output;
}

/* 14 15 */
require_once 'shortcode_classes/wps_acc_shortcode.php';

/**
 *    16 WPS Anything slider
 */
function wps_slider_shortcode($atts,$content = null)
{
    $options = shortcode_atts(
        array( 
        'scrollbar' => false,
        'pagination' => false,
        'class' => ''
        ), $atts 
    );

    $output = '';

    $inner = '';

    wp_enqueue_script('slider_core');

    $class =  wps_getExtraClass($options['class']);

    $output .= '<div class="swiper'. $class .'"><div class="wps-anything-swiper-container"><div class="swiper-wrapper">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    $output .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<div class="swiper-pagination u-hide"></div>';
    $output .= '<div class="wps-anything-swiper-button-prev"></div><div class="wps-anything-swiper-button-next"></div>';
    $output .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar u-hide"></div>';
    $output .= '</div></div>';

    return $output;
}

/**
 *    17 WPS Anything slider
 */
function wps_slider_item_shortcode($atts,$content = null)
{
    $options = shortcode_atts(
        array( 
        'class' => '',
        'content_class' => '',
        'slide_img' => '',
        'img_size' => 'full',
        'img_size_small' => 'wps_prime_medium'
        ), $atts
    );

    $output = '';
    $style = '';
    $inner = '';
    $class = wps_getExtraClass($options['class']);
    $content_class = wps_getExtraClass($options['content_class']);

    if ($options['slide_img'] ) {
         $image = wp_get_attachment_image_src($options['slide_img'], $options['img_size'], false);
         $style = $image[0] ? " style='background-image:url({$image[0]});background-size:cover;'" : '';
    }
    
    $output = '<div class="swiper-slide'. $class .'"'.$style.'><div class="swiper__content'. $content_class .'">'. do_shortcode($content) .'</div></div>';
    return $output;
}


// ==============================================
// Trigger the script if it has not already been triggered on the page
// ==============================================

function wps_tabbytrigger() 
{

    static $tabbytriggered = false; // static so only sets the value the first time it is run

    if ($tabbytriggered == false) {
        echo "\n" . "<script>jQuery(document).ready(function($) { RESPONSIVEUI.responsiveTabs(); })</script>" .  "\n";

        $tabbytriggered = true;
    }
}

/**
*    18 WPS Tab (Tabby)
*/
function wps_tab_shortcode($atts,$content = null)
{
    $output = '';

    /* Tabby Script */
    wp_enqueue_script('wps_tabby'); // Registered in functions
    add_action('wp_footer', 'wps_tabbytrigger', 20);

    $output .= '<div class="c-responsive-tabs">'. do_shortcode($content) .'</div>';

    return $output;

}

/**
*    19 WPS Tab Item (Tabby inner)
 *
*     @todo check $class variable, do we need it???
*/
function wps_tab_item_shortcode($atts,$content = null)
{

    $options = shortcode_atts(
        array(
        "title" => '',
        "open" => '',
        'ico_class' => '',
        'icon_fontawesome' => '',         // default value to backend editor | param used by VC
        'icon_typicons' => '',            // default value to backend editor | param used by VC
        'icon_linecons' => '',            // default value to backend editor | param used by VC
        'icon_woothemesecom' => '',        // default value to backend editor | param used by VC
        'ico_type'=>''
        ), $atts
    );


    $tabtarget = sanitize_title_with_dashes(remove_accents(wp_kses_decode_entities($options['title'])));

    //initialise urltarget
    $urltarget = '';

    //grab the value of the 'target' url parameter if there is one
    if (isset($_REQUEST['target']) ) {
        $urltarget = sanitize_title_with_dashes($_REQUEST['target']);
    }

    //	Set Tab Panel Class - add active class if the open attribute is set or the target url parameter matches the dashed version of the tab title
    $tabcontentclass = "tabcontent";

    if (isset($class) ) {
        $tabcontentclass .= " " . $class . "-content";
    }

    if (( $options['open'] ) || ( isset($urltarget) && ( $urltarget == $tabtarget ) ) ) {
        $tabcontentclass .= " c-responsive-tabs__panel--active";
    }

    $ico_type =  $options['ico_type'] ? $options['ico_type'] : 'fontawesome'; // Set as default iconfont

    // Enqueue frontend icon font family
    if($options["icon_{$ico_type}"] ) {
        
        wps_icon_element_fonts_enqueue($ico_type);
    }    
    
    $ico_type_class = wps_getExtraClass($options["icon_{$ico_type}"]);
    $ico_class_custom = wps_getExtraClass($options['ico_class']);
    $addtabicon = $ico_class_custom || $ico_type_class ? "<i class=\"ico{$ico_class_custom}{$ico_type_class}\"></i> " : '';

    $output = '';

    $title = $options['title'] ? $options['title'] : 'Please Add Title';

    $output .='<h2 class="tabtitle">' . $addtabicon . $title . '</h2>' . "\n" . '<div class="' . $tabcontentclass . '">' . "\n";
    $output .= do_shortcode($content);
    $output .= '</div>';
    
    return $output;

}


/**
*    20 Social Links 
*/
function wps_social_links_shortcode($atts)
{

     $options = shortcode_atts(
        array(
        'list' => false,
        'ico_class' => '',
        'link_class' => '',
        'label_class' => '',
        'target' => '',
        'list_class' => ''
        ), $atts
    );

    $output = $listStart = $listEnd = $listItemStart = $listItemEnd = '';

    wps_icon_element_fonts_enqueue('fontawesome');

    $hidelabel = $options['list'] ? '' : 'u-hide';

    $classLink = wps_getExtraClass( array( 'c-social-list__link',$options['link_class'] ) );
    $classIco = wps_getExtraClass( array( 'c-social-list__ico', $options['ico_class'] ) );
    $classList = wps_getExtraClass( array( 'c-social-list',$options['list_class'] ) );
    $classLabel = wps_getExtraClass( array( 'c-social-list__label',$options['label_class'],$hidelabel ) );

    $target = $options['target'] ? ' target="_blank"' : '';

    $facebook = wps_get_theme_option( 'wps_social_link_facebook' );
    $gplus = wps_get_theme_option( 'wps_social_link_gplus' );
    $twitter = wps_get_theme_option( 'wps_social_link_twitter' );
    $linkedIn = wps_get_theme_option( 'wps_social_link_linkedin' );
    $youtube = wps_get_theme_option( 'wps_social_link_youtube' );

   

    if($options['list']){
        $listStart = '<ul class="'.$classList.'">';
        $listEnd   = '</ul>';
        $listItemStart = '<li class="c-social-list__item">';
        $listItemEnd = '</li>';
    }
    

    if($facebook){
       $output .= $listItemStart.'<a href="'.$facebook.'"'.$target.' class="'.$classLink.'"><i class="fa fa-facebook'.$classIco.'"></i><span class="'.$classLabel.'">Facebook</span></a>'.$listItemEnd;
    }

    if($gplus){
       $output .= $listItemStart.'<a href="'.$gplus.'"'.$target.' class="'.$classLink.'"><i class="fa fa-google-plus'.$classIco.'"></i><span class="'.$classLabel.'">Google +</span></a>'.$listItemEnd;
    }

    if($twitter){
       $output .= $listItemStart.'<a href="'.$twitter.'"'.$target.' class="'.$classLink.'"><i class="fa fa-twitter'.$classIco.'"></i><span class="'.$classLabel.'">Twitter</span></a>'.$listItemEnd;        
    }

    if($linkedIn){
       $output .= $listItemStart.'<a href="'.$linkedIn.'"'.$target.' class="'.$classLink.'"><i class="fa fa-linkedin'.$classIco.'"></i><span class="'.$classLabel.'">LinkedIn</span></a>'.$listItemEnd;
    }

    if($youtube){
       $output .= $listItemStart.'<a href="'.$youtube.'"'.$target.' class="'.$classLink.'"><i class="fa fa-youtube'.$classIco.'"></i><span class="'.$classLabel.'">Youtube</span></a>'.$listItemEnd;        
    } 


    $output = $listStart.$output.$listEnd;

    return $output;
}