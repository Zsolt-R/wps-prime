<?php
/**
 * Theme Shortcodes
 *
 * @package wps_prime
 */

/**
 *  WPS SHORTCODES
 *
 * 1  Layout Wrapper Markup - [wps_layout class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 * 2  Layout Item Markup - [wps_item class="lap-and-up..."] ...content... [/wps_item]
 * 3  Full Width Slider - [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 * 4  Custom Buttons - [wps_button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
 * 5  Media / Flag Object - media/flag(OOCSS Markup Items) - [wps_object type="media/flag"] ... [/wps_object]
 * 6  Media / Flag Object inners -media/flag __img, __body (OOCSS Markup Items) - [wps_object_item type="media__img/flag__img,media__img/media__body"]...[/wps_object_item]
 * 7  Shortcode for icons - [wps_ico]fa fa-home[/wps_ico]
 * 8  Main Phone number - [main_phone_nr]
 * 9  Main Email address - [main_email]
 * 10 List styles [wps_list class="list--style-one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list]
 * 11 Media Box [wps_mediabox]...content...[/wps_mediabox]
 * 12 Highlight [wps_hglt class="" html_tag=""]...content...[/wps_hglt]
 * 13 Divider [wps_divider]
 * 14 Accordion [wps_accordion]
 * 15 Accordion item [wps_accordion_item]
 * 16 WPS Anything slider [wps_slider]
 * 17 WPS Anything slider slide [wps_slider_item]
 */

/* 1 Layout Wrapper Markup */
add_shortcode( 'wps_layout', 'wps_layout_shortcode' );

/* 2 Layout Item Markup */
add_shortcode( 'wps_item','wps_layout_inner_block_shortcode' );

/* 3 Full Width Slider */
add_shortcode( 'wps_slider', 'wps_fw_slider_shortcode' );

/* 4 Custom Buttons */
add_shortcode( 'wps_button', 'wps_buttons_shortcode' );

/* 5 Media / Flag Object */
add_shortcode( 'wps_object', 'wps_css_objects_shortcode' );

/* 6 Media / Flag Object inners */
add_shortcode( 'wps_object_item' , 'wps_css_objects_item_shortcode' );

/* 7 Shortcode for icons */
add_shortcode( 'wps_ico', 'wps_ico_shortcode' );

/* 8 Get theme option phone nr */
add_shortcode( 'wps_main_phone_nr', 'wps_main_phone_nr_shortcode' );

/* 9 Get theme option email */
add_shortcode( 'wps_main_email', 'wps_main_email_shortcode' );

/* 10 Creates a custom bulleted list */
add_shortcode( 'wps_list', 'wps_styled_list_shortcode' );

/* 11 Generate a complex Media Box */
add_shortcode( 'wps_mediabox', 'wps_media_box_shortcode' );

/* 12 Content highlight Markup */
add_shortcode( 'wps_hglt', 'wps_content_highlight_shortcode' );

/* 13 Content divider */
add_shortcode( 'wps_divider', 'wps_content_divider_shortcode' );

/* 14 Accordion */
/* 15 Accordion item */
/* see wps_acc_shortcode.php */

/* 16 WPS Anything slider */
add_shortcode('wps_all_slider','wps_slider_shortcode');

/* 17 WPS Anything slider slide */
add_shortcode('wps_all_slider_item','wps_slider_item_shortcode');

/**
 * 1 Layout Item Markup
 * ex. [wps_layout class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_layout_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'class' => '',
		'wrapper_class' => '',
		'holder_class' => '',
		'wrapper' => false,
		'holder_img' => '',
		'holder_img_size' => 'full',
	), $atts );

	$holder_start = '';
	$holder_end = '';
	$style = '';

	$class = $options['class'] ? ' '.$options['class'] : '';
	$class_w = $options['wrapper_class'] ? ' '.$options['wrapper_class'] : '';
	$class_h = $options['holder_class'] ? ' '.$options['holder_class'] : '';

	if ( $options['holder_img'] ) {
			$image = wp_get_attachment_image_src( $options['holder_img'],$options['holder_img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}

	if ( $style || $options['holder_class'] ) {

		$holder_start = '<div class="holder'.$class_h.'"'.$style.'>';
		$holder_end = '</div>';
	}

		$layout = '<div class="layout'. $class .'">' . do_shortcode( $content ) . '</div>';

		// Check for string value false (confront with string 'false').
		$output = 'false' !== $options['wrapper'] && $options['wrapper'] ? '<div class="wrapper'. $class_w .'">'. $layout .'</div>' : $layout;

		return  $holder_start.$output.$holder_end;
}

/**
 * 2 Layout Wrapper Markup
 * ex: [wps_item class="lap-and-up..."] ...content... [/wps_item]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_layout_inner_block_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'class' => '',
		'inner'=>true,
		'inner_class'=>''
	), $atts );

	$inner_start = '';
	$inner_end = '';

	$class = $options['class'] ?  ' '.$options['class'] : '';
	$inner_class = $options['inner_class'] ?  ' '.$options['inner_class'] : '';
	
	/* Just fill the inner_class argument to activate, and deactivate by setting inner 
	*  to false this way you can deactivate the inner element 
	*  whithout deleting the inner_class argument
	*/
	if ( true === $options['inner'] && $options['inner_class'] ) {

		$inner_start = '<div class="layout__item_inner'.$inner_class.'">';
		$inner_end = '</div>';
	}

	$output = '<div class="layout__item'. $class .'">'.$inner_start .'' . do_shortcode( $content ) . ''.$inner_end.'</div>';

	return  $output;
}

/**
 * 3 Full width slider
 * ex: [wps_slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_fw_slider_shortcode( $atts ) {
	$options = shortcode_atts( array(
		'images' => '',
		'links' => '',
		'min' => '22.51em',
		'size' => 'wps_prime_full',
		'size_mobile' => 'wps_prime_medium',
		'scrollbar' => false,
		'pagination' => false
	), $atts );

	$constructor = 'Add image id\'s to shortcode to use slider ex. images="1,2,3,4..."';

	$image_list_constructor = '';
	$constructor = '';
	$arrays = array();

	// Start ID Check.
	// Check for Images.
	if ( $options['images'] ) {
		$images_id_array = explode( ',', $options['images'] );
		$arrays = $images_id_array;
	}

	// Check for Links.
	if ( $options['links'] ) {
		$page_id_array = explode( ',', $options['links'] );
		if ( count( $images_id_array ) === count( $page_id_array ) ) {
			$arrays = array_combine( $images_id_array,$page_id_array );
		}
	}

	// If only image id's are avaliable.
	if ( $options['images'] && ! $options['links'] ) {

		foreach ( $arrays as $image_id ) {

			$image_large = wp_get_attachment_image_src( $image_id , $options['size'] );
			$image_small = wp_get_attachment_image_src( $image_id , $options['size_mobile'] );

			// Check if image id is valid.
			if ( '' !== $image_large ) {
				$slide_content = '<picture><source media="(min-width:'. $options['min'] .')" srcset="'. $image_large[0] .'"><img src="'. $image_small[0] .'" class="aligncenter"/></picture>';
			}

			$image_list_constructor .= '<div class="swiper-slide">'. $slide_content .'</div>';

		}

		// If image Id's and Link id's.
	} elseif ( $options['images'] && $options['links'] ) {

		// Check to have equal number of image id's and link id's.
		if ( count( $images_id_array ) === count( $page_id_array ) ) {

			foreach ( $arrays as $image_id => $page_links_id ) {

				$image_large = wp_get_attachment_image_src( $image_id , $options['size'] );
				$image_small = wp_get_attachment_image_src( $image_id , $options['size_mobile'] );

				// Setup Default slide content.
				$slide_content = current_user_can( 'moderate_comments' ) ? 'Image ID- "'. $image_id.'" not valid' : '';

				// Check if image id is valid.
				if ( '' !== $image_large ) {
						$slide_content = '<picture><source media="(min-width:'. $options['min'] .')" srcset="'. $image_large[0] .'"><img src="'. $image_small[0] .'" class="aligncenter"/></picture>';
				}

				$image_list_constructor .= '<div class="swiper-slide"><a href="'. get_permalink( $page_links_id )  .'">'. $slide_content .'</a></div>';

			}
		} else {
			$image_list_constructor .= '<div class="swiper-slide">should have an equal number of elements check image ID\'s and Link Id\'s</div>';

		}
	}
	if ( $options['images'] ) {

		$constructor .= '<div class="swiper"><div class="swiper-container">';
		$constructor .= '<div class="swiper-wrapper">'. $image_list_constructor .'</div>';
		$constructor .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<!--<div class="swiper-pagination"></div>-->';
        $constructor .= '<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>';
		$constructor .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar hide"></div>';
        $constructor .= '</div></div>';
        
	}

		return $constructor;
}

/**
 * 4 Custom Buttons
 * ex:  [wps_button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_buttons_shortcode( $atts ) {
	$options = shortcode_atts( array(
		'class' => '',
		'label' => 'Please add label',
		'link'  => '',
		'target'=> '',
		'align' => ''
	), $atts );

	$styleClass = $options['class'] ? ' '.$options['class'] : '';
	$styleClass .= $options['align'] ? ' '.$options['align'] : '';
	$btnInfotext = $options['label'] ? $options['label'] : '';
	$btnLink = $options['link'] ? $options['link'] : '#';
	$btnTarget = $options['target'] ? ' target="'.$options['target'].'"' : '';

	$output = '<a class="btn'. $styleClass .'" href="'.$btnLink.'"'.$btnTarget.'>'. $btnInfotext .'</a>';

	return $output;

}

/**
 * 5 Media / Flag Object (OOCSS Markup Items)
 * ex:  [wps_object type="media/flag"] ... [/wps_object]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_css_objects_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'type' => '',
	), $atts );

	$class = $options['type'];

	$output = '<div class="'. $class .'">'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
 * 6 Media / Flag Object inners - __img, __body (OOCSS Markup Items)
 * ex: [wps_object_item type="media__img/flag__img,media__img/media__body"]...[/wps_object_item]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_css_objects_item_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'type' => '',
	), $atts );

	$class = $options['type'];

	$output = '<div class="'. $class .'">'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
 * 7 Shortcode for icons
 * ex: [wps_ico]fa fa-home[/wps_ico]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_ico_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(array(
		'class' => '',
		'center'=> false,
		'icon_fontawesome' => '', 		// default value to backend editor | param used by VC
		'icon_typicons' => '',			// default value to backend editor | param used by VC
		'icon_linecons' => '',			// default value to backend editor | param used by VC
		'icon_woothemesecom' => '',		// default value to backend editor | param used by VC
		'size'=>'',
		'color' =>'',
		'type' =>''
	), $atts );

	$ico_class = $class = $size = $type = '';
	$output = '';

	$class = $options['class'] ? ' '.$options['class'] : '';
	$color = $options['color'] ? ' '.$options['color'] : '';
	$content = $content ? ' '.$content : '';

	$type = $options['type'] ? $options['type'] : 'fontawesome'; // Set as default iconfont

	$ico_class = $options["icon_{$type}"] ? ' '.$options["icon_{$type}"] : '';


	$size = $options['size'] ? ' '.$options['size'] : '';

	$wrapper_s = $options['center'] ? '<div class="txt--center">' : '';
	$wrapper_e = $options['center'] ? '</div>' : '';


	// Enque frontend icon font family
	wps_icon_element_fonts_enqueue( $type );

	$output = $wrapper_s.'<i class="ico'. esc_attr($content) . esc_attr($class) . esc_attr($color) . esc_attr($ico_class) . esc_attr($size) .'"></i>'.$wrapper_e;
	return $output;
}

/**
 * 8 Main Phone number
 * ex: [wps_phone_nr]
 */
function wps_main_phone_nr_shortcode() {

	$phone_nr = wps_get_theme_option( 'company_phone_nr' ) ? wps_get_theme_option( 'company_phone_nr' ) : 'No phone number set';
	return $phone_nr;
}

/**
 * 9 Main Email address
 * ex: [wps_email]
 */
function wps_main_email_shortcode() {

	$email = wps_get_theme_option( 'company_contact_email_address' ) ? wps_get_theme_option( 'company_contact_email_address' ) : 'No email set';

	return $email;
}

/**
 * 10 Styled List
 * ex: [wps_list class="list-style--one custom--class"]<ul><li>List item</li> .... </ul>[/wps_list]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_styled_list_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'class' => '',
	), $atts );

	$list_style = '';

	$list_style = $options['class'] ? ' '.'class="list--style '. $options['class'] .'"' : '';

	$output = '<div'. $list_style .'>'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
 * 11 Media Box
 * ex: [wps_mediabox image_id="1038" image_class="aligncenter img--round img--border" image_size="thumbnail" ico_class="fa fa-envelope fa-4x" class="bg--color-one p- txt--color-invert" type="flag" type_class="flag--responsive" title="Contact our experts today!" divider="true" divider_class="mb-" title_class="txt--bold mb-"]...content...[/wps_mediabox]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_media_box_shortcode( $atts, $content = null ) {

		$args = shortcode_atts(array(
			'image_id' => '',
			'image_class' => '',
			'image_size' => 'medium',
			'image_link' => '',
			'ico_class' => '',
			'icon_fontawesome' => '', 		// default value to backend editor | param used by VC
			'icon_typicons' => '',			// default value to backend editor | param used by VC
			'icon_linecons' => '',			// default value to backend editor | param used by VC
			'icon_woothemesecom' => '',		// default value to backend editor | param used by VC
			'ico_type'=>'',
			'type' => '',
			'type_class' => '',
			'type_body_class' => '',
			'type_img_class' => '',
			'title' => '',
			'title_class' => '',
			'class' => '',
			'divider' => false,
			'divider_class' => '',
		),$atts);

		$output = '';
		$image_args = array();

		$content = do_shortcode( $content );

		$class = '';



		// Enque frontend icon font family
		if($args['ico_type'] !== ''){
			wps_icon_element_fonts_enqueue( $args['ico_type'] );
		}

		// Mediabox class.
		$class = $args['class'] ?  ' '.$args['class'] : '';

		// Divider.
		$divider_class = $args['divider_class'] ?  ' '.$args['divider_class'] : '';
		$divider = $args['divider'] ? "<hr class=\"divider{$divider_class}\"/>" : '';

		// Symbol image/ico.
		if ( $args['image_class'] !== '' ) {
			$image_args['class'] = $args['image_class'];
		}

		$ico = $args['ico_class'] !== '' ? "<i class=\"{$args['ico_class']}\"></i>" :'';

		$image = $args['image_id'] !== '' ?wp_get_attachment_image( $args['image_id'],$args['image_size'],false,$image_args ) :'';

		$symbol = $image ? $image : $ico;

		// Title.
		$title_class = $args['title_class'] !== '' ?  ' '.$args['title_class'] : '';
		$title = $args['title'] !== '' ? "<h2 class=\"mediabox__title{$title_class}\"/>{$args['title']}</h2>" : '';

		// Type.
		$type_class = $args['type_class'] !== '' ?  ' '.$args['type_class'] : '';
		$type_body_class = $args['type_body_class'] !== '' ?  ' '.$args['type_body_class'] : '';
		$type_img_class = $args['type_img_class'] !== '' ?  ' '.$args['type_img_class'] : '';

		//Img link
		$img_link_start = $args['image_link'] ? '<a href="'. $args['image_link'] .'">' : '';
		$img_link_end = $args['image_link'] ? '</a>' : '';

		if ( $args['type'] !== '' ) {

			 $output = "<div class=\"mediabox{$class}\">{$title}{$divider}<div class=\"{$args['type']}{$type_class}\"><div class=\"{$args['type']}__img{$type_img_class}\">{$img_link_start}{$symbol}{$img_link_end}</div><div class=\"{$args['type']}__body{$type_body_class}\">{$content}</div></div></div>";
		} else {

			 $output = "<div class=\"mediabox{$class}\">{$img_link_start}{$symbol}{$img_link_end}{$title}{$divider}{$content}</div>";
		}

		return $output;
}

/**
 * 12 Content Highlight
 */
function wps_content_highlight_shortcode( $atts, $content = null ) {

	$args = shortcode_atts(array(
		'class' => '',
		'html_tag' => 'span',
	),$atts);

	$class = $args['class'] ? ' '.$args['class'] : '';
	$tag = $args['html_tag'] ? $args['html_tag'] : 'span'; // Prevent empty.
	$content = do_shortcode( $content );

	$output = "<{$tag} class=\"highlight{$class}\">{$content}</{$tag}>";

	return $output;

}

/**
 * 13 Content Divider
 */
function wps_content_divider_shortcode( $atts ) {

	$args = shortcode_atts(array(
		'class' => '',
	),$atts);

		$class = $args['class'] ? ' '.$args['class'] : '';

		$output = "<hr class=\"divider{$class}\"/>";

	return $output;
}

/* 14 15 */
require_once('shortcode_classes/wps_acc_shortcode.php');

/**
 *	16 WPS Anything slider
 */
function wps_slider_shortcode($atts,$content = null){
	$options = shortcode_atts( array( 
		'scrollbar' => false,
		'pagination' => false,
		'class' => ''
		), $atts, 'wps_slider' );

	$output = '';

	$inner = '';

	$class = $options['class'] ? ' '.$options['class'] : '';

	$output .= '<div class="swiper'. $class .'"><div class="wps-anything-swiper-container"><div class="swiper-wrapper">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	
	$output .= $options['pagination'] ? '<div class="swiper-pagination"></div>' : '<!--<div class="swiper-pagination"></div>-->';
	$output .= '<div class="wps-anything-swiper-button-prev"></div><div class="wps-anything-swiper-button-next"></div>';
	$output .= $options['scrollbar'] ? '<div class="swiper-scrollbar"></div>' : '<div class="swiper-scrollbar hide"></div>';
	$output .= '</div></div>';

	return $output;
}

/**
 *	17 WPS Anything slider
 */
function wps_slider_item_shortcode($atts,$content = null){
	$options = shortcode_atts( array( 
		'class' => '',
		'content_class' => '',
		'slide_img' => '',
		'img_size' => 'full',
		'img_size_small' => 'wps_prime_medium'
		), $atts , 'wps_slider_item');

	$output = '';
	$style = '';
	$inner = '';
	$class = $options['class'] ? ' '.$options['class'] : '';
	$content_class = $options['content_class'] ? ' '.$options['content_class'] : '';

	if ( $options['slide_img'] ) {
			$image = wp_get_attachment_image_src( $options['slide_img'],$options['img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});background-size:cover;'" : '';
	}
	
	$output = '<div class="swiper-slide'. $class .'"'.$style.'><div class="swiper__content'. $content_class .'">'. do_shortcode($content) .'</div></div>';
	return $output;
}