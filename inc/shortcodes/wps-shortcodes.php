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
 * 16 WPS Anything slider [wps_slider]
 * 17 WPS Anything slider slide [wps_slider_item]
 */

/* 1 Row Wrapper Markup */
add_shortcode( 'wps_row', 'wps_row_shortcode' );

/* 2 Row Item Markup */
add_shortcode( 'wps_col','wps_col_shortcode' );

/* 3 Full Width Slider */
add_shortcode( 'wps_slider', 'wps_fw_slider_shortcode' );

/* 4 Custom Buttons */
add_shortcode( 'wps_button', 'wps_buttons_shortcode' );

/* 5 Heading */
add_shortcode( 'wps_heading', 'wps_heading_shortcode' );

/* 6 Image */
add_shortcode( 'wps_image', 'wps_image_shortcode' );

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

/* 18 WPS Tabby */
add_shortcode('wps_tab','wps_tab_shortcode');

/* 19 WPS Tabby Item */
add_shortcode('wps_tab_item','wps_tab_item_shortcode');

/**
 * 1 Row Item Markup
 * ex. [wps_row class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_row_shortcode( $atts, $content = null ) {
			$options = shortcode_atts(array(			
				'class' => '',
				'wrapper_class' => '',
				'holder_class' => '',
				'wrapper' => false,
				'holder_img' => '',
				'holder_img_size' => 'full',
				'holder_img_pos' =>'',
				'holder_bg_fx' =>'',
				'row_align' =>''
			), $atts );

			// Setup Defaults
			$style = '';
			$output = '';

			// Stack Classes
			$class  = wps_getExtraClass( array(
					  $options['class'],
					  $options['row_align']
					  )
					);
			
			$class_w  = wps_getExtraClass($options['wrapper_class']);

			$class_h  = wps_getExtraClass( array(
				$options['holder_class'],
				$options['holder_img_pos'],
				$options['holder_bg_fx']
				) 
			);


			// Check for background Image and setup inline style
			if ( $options['holder_img'] ) {
				$image = wp_get_attachment_image_src( $options['holder_img'],$options['holder_img_size'],false );
				$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
			}

			// Prepare Output
			$output = sprintf('%1$s%2$s<div class="grid-1%3$s">%4$s</div>%5$s%6$s',
				$style || $class_h ? "<div class=\"holder{$class_h}\"{$style}>" : '', 									//  %1$s
				'false' !== $options['wrapper'] && $options['wrapper'] ? "<div class=\"o-wrapper{$class_w}\">" : '',		//  %2$s
				$class,																									//  %3$s
				do_shortcode( $content ),																				//  %4$s	
				'false' !== $options['wrapper'] && $options['wrapper'] ? "</div>" : '',									//  %5$s
				$style || $class_h ? "</div>" : ''																		//  %6$s
			);

			return $output;
}

/**
 * 2 Row Wrapper Markup
 * ex: [wps_col class="lap-and-up..."] ...content... [/wps_col]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_col_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(
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
	), $atts );

	$inner_start = $inner_end ='';
	$style = '';


	$class  = wps_getExtraClass( array(		
			  $options['class'],
			  $options['width'],
			  $options['margin'],
			  $options['padding']
			  )
			);

	$inner_class  = wps_getExtraClass( array(
					$options['inner_class'],
					$options['margin_inner'],
					$options['padding_inner'],
					$options['inner_img_pos'],
					$options['inner_bg_fx'],
					$options['align_content_inner']
					)
				);

	
	$row_width = wps_getExtraClass($options['row_width'],true); // flush space between classes

	if ( $options['inner_img'] ) {
			$image = wp_get_attachment_image_src( $options['inner_img'],$options['inner_img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}
	
	/* Just fill the inner_class argument to activate, and deactivate by setting inner 
	*  to false this way you can deactivate the inner element 
	*  whithout deleting the inner_class argument
	*/
	if ( $inner_class !== '' ||  $style !== '' ) {

		$inner_start = "<div class=\"col col_inner{$inner_class}\"{$style}>";
		$inner_end = "</div>";
	}

	$output = '<div class="col '. $class .''. $row_width .'">'.$inner_start .'' . do_shortcode( $content ) . ''.$inner_end.'</div>';

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
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_buttons_shortcode( $atts ) {
	$options = shortcode_atts( array(
		'class'   => '',
		'label'   => 'Please add label',
		'link'    => '',
		'target'  => '',
		'align'   => '',
		'margin'  => '',
		'padding' =>'',
		'aspect'  => '',
		'size' 	  => '',
		'ghost'	  => '',
		'color'   => ''
	), $atts );

	$styleClass  = wps_getExtraClass( array( 		
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

	$output = '<a class="c-button'. $styleClass .'" href="'.$btnLink.'"'.$btnTarget.'>'. $btnInfotext .'</a>';

	return $output;

}

/**
 * 5 Image
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_image_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(	array(
				'image_id'   => false,
				'image_size' => 'full',
				'align'  => 'alignone',
				'margin'=>'',
				'padding'=>'',
				'link'   => false,
				'target' => false,
				'class'		 => ''
			), $atts );

	$output = '';

	$image_class = wps_getExtraClass( array( 
					$options['padding'],
					$options['margin'],
					$options['align'],
					$options['class'],
					) 
				);	

	$image = wp_get_attachment_image( $options['image_id'], $options['image_size'], "", array( "class" => $image_class ));

	$target = $options['target'] ? 'target="'.$options['target'].'"' : '';

	if( $options['link'] ){
		$output = sprintf('<a href="%1$s"%2$s>%3$s</a>', $options['link'], $target, $image);
	}else{
		$output = $image;
	};

	return '<div class="c-image">'.$output.'</div>';
}

/**
 * 6 Heading
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_heading_shortcode( $atts, $content = null ) {

	$options = shortcode_atts(	array(
				'text'     => false,
				'size'     => '',
				'color'    => '',
				'weight'   => '',
				'html_tag' => '',
				'margin'   =>'',
				'padding'  =>'',
				'link'     => false,
				'target'   => false,
				'class'	   => '',
				'text_align' =>'',
				'id'	   => ''
			), $atts );

	$output = '';	

	$class_list = wps_getExtraClass( array(
		$options['size'],
		$options['color'],
		$options['weight'],
		$options['margin'],
		$options['padding'],
		$options['class'],
		$options['text_align']
	 ) );	$classes = $class_list ? ' class="'.$class_list.'"' : '';
	$id = $options['id'] ? ' id="'.$options['id'].'"' : '';

	$html_tag = $options['html_tag'] ? $options['html_tag'] : 'h3';	

	$target = $options['target'] ? ' target="'.$options['target'].'"':'';

	$link_open  = $options['link'] ? '<a href="'.$options['link'].'"'.$target.'>':'';
	$link_close = $options['link'] ? '</a>':'';

	$output .= $options['text'] ? '<'.$html_tag.$classes.$id.'>'.$link_open.$options['text'].$link_close.'</'.$html_tag.'>' : '';


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

	$class = wps_getExtraClass($options['class']);
	$color = wps_getExtraClass($options['color']);
	$content = $content ? ' '.$content : '';

	$type = $options['type'] ? $options['type'] : 'fontawesome'; // Set as default iconfont

	$ico_class = $options["icon_{$type}"] ? ' '.$options["icon_{$type}"] : '';


	$size = wps_getExtraClass($options['size']);

	$wrapper_s = $options['center'] ? '<div class="ico-wrap-center">' : '';
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
function wps_main_phone_nr_shortcode($atts) {
	$options = shortcode_atts( array(
		'class' => '',
		'link' => false,
		'secondary' => false
	), $atts );

	$phone_numbers = array(
		wps_get_theme_option( 'phone_nr' ),
		wps_get_theme_option( 'phone_nr_second' )
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
 * ex: [wps_email]
 */
function wps_main_email_shortcode($atts) {
	$options = shortcode_atts( array(
		'class' => '',
		'link' => false,
		'secondary' => false
	), $atts );

	$emails = array(
		wps_get_theme_option( 'email_address' ),
		wps_get_theme_option( 'email_address_secondary' )
		);

	$email = $options['secondary'] ? $emails[0] : $emails[1];


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
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_styled_list_shortcode( $atts, $content = null ) {
	$options = shortcode_atts( array(		
		'style' => '',
		'color' => '',
		'deco' => '',
		'class' => ''
	), $atts );

	$list_style = '';

	$list_styles = wps_getExtraClass( array(
		'c-list',
		$options['style'],
		$options['color'],
		$options['deco'],
		$options['class'],
		)
	);

	$options['style'] ? wps_icon_element_fonts_enqueue( 'fontawesome' ) : '';

	$output = '<div class="'. $list_styles .'">'. do_shortcode( $content ) .'</div>';

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
			'image_size' => 'full',
			'image_link' => '',
			'ico_class' => '',
			'icon_fontawesome' => '', 		// default value to backend editor | param used by VC
			'icon_typicons' => '',			// default value to backend editor | param used by VC
			'icon_linecons' => '',			// default value to backend editor | param used by VC
			'icon_woothemesecom' => '',		// default value to backend editor | param used by VC
			'ico_type'=>'',
			'type' => '',
			'type_class' => '',
			'type_spacing' => false,
			'type_reverse' => '',
			'type_img_class' => '',
			'not_responsive' => false,
			'class' => '',

		),$atts);

		$output = '';
		$image_args = array();

		$content = do_shortcode( $content );

		$class = '';

		// Enqueue frontend icon font family
		if($args['ico_type'] !== ''){
			wps_icon_element_fonts_enqueue( $args['ico_type'] );
		}

		// Mediabox class.
		$class = wps_getExtraClass($args['class']);

		// Symbol image/ico.
		if ( $args['image_class'] !== '' ) {
			$image_args['class'] = $args['image_class'];
		}

		$ico_type = $args['ico_type'] ? $args['ico_type'] : 'fontawesome'; // Set as default iconfont

		$ico_type_class = wps_getExtraClass($args["icon_{$ico_type}"]);

		$ico_class_custom = wps_getExtraClass($args['ico_class']);


		$ico = $ico_class_custom || $ico_type_class ? "<i class=\"ico {$ico_class_custom}{$ico_type_class}\"></i>" : '';


		$image = $args['image_id'] !== '' ? wp_get_attachment_image( $args['image_id'],$args['image_size'],false,$image_args ) :'';

		$symbol = $image ? $image : $ico;
		// Type.
		$type_class = wps_getExtraClass( array(
			$args['type'],
			$args['type_class'],
			$args['not_responsive'] ? '': $args['type'].'--responsive',
			$args['type_reverse'] ? $args['type'].'--reverse' : '',
			$args['type_spacing'] ? $args['type'].$args['type_spacing'] : '',
			)
		);


		//Img link
		$img_link_start = $args['image_link'] ? '<a href="'. $args['image_link'] .'">' : '';
		$img_link_end = $args['image_link'] ? '</a>' : '';

		if ( $args['type'] !== '' ) {

			 $output = "<div class=\"c-mediabox{$class}\"><div class=\"{$type_class}\"><div class=\"{$args['type']}__img\">{$img_link_start}{$symbol}{$img_link_end}</div><div class=\"{$args['type']}__body\">{$content}</div></div></div>";
		} else {

			 $output = "<div class=\"c-mediabox{$class}\">{$img_link_start}{$symbol}{$img_link_end}{$content}</div>";
		}

		return $output;
}

/**
 * 12 Content Highlight
 */
function wps_content_highlight_shortcode( $atts, $content = null ) {

	$args = shortcode_atts(array(
		'class' => '',
		'html_tag' => 'div',
	),$atts);

	$class = wps_getExtraClass($args['class']);
	$tag = $args['html_tag'] ? $args['html_tag'] : 'div'; // Prevent empty.
	$content = do_shortcode( $content );

	$output = "<{$tag} class=\"c-highlight{$class}\">{$content}</{$tag}>";

	return $output;

}

/**
 * 13 Content Divider
 */
function wps_content_divider_shortcode( $atts ) {

	$args = shortcode_atts(array(
		'style' => '',
		'class' => '',
	),$atts);

		$class = wps_getExtraClass( array(
				'c-divider',
				$args['class'],
				$args['style']
				)
		);

		$output = "<hr class=\"{$class}\"/>";

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
	$class = wps_getExtraClass($options['class']);
	$content_class = wps_getExtraClass($options['content_class']);

	if ( $options['slide_img'] ) {
			$image = wp_get_attachment_image_src( $options['slide_img'],$options['img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});background-size:cover;'" : '';
	}
	
	$output = '<div class="swiper-slide'. $class .'"'.$style.'><div class="swiper__content'. $content_class .'">'. do_shortcode($content) .'</div></div>';
	return $output;
}


// ==============================================
// Trigger the script if it has not already been triggered on the page
// ==============================================

function wps_tabbytrigger() {

	static $tabbytriggered = FALSE; // static so only sets the value the first time it is run

	if ($tabbytriggered == FALSE) {
		echo "\n" . "<script>jQuery(document).ready(function($) { RESPONSIVEUI.responsiveTabs(); })</script>" .  "\n";

		$tabbytriggered = TRUE;
	}
}

/**
*	18 WPS Tab (Tabby)
*/
function wps_tab_shortcode($atts,$content = null){
	$output = '';

	/* Tabby Script */
	wp_enqueue_script('wps_tabby'); // Registered in functions
	add_action('wp_footer', 'wps_tabbytrigger', 20);

	$output .= '<div class="c-responsive-tabs">'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
*	19 WPS Tab Item (Tabby inner)
* 	@todo check $class variable, do we need it???
*/
function wps_tab_item_shortcode($atts,$content = null){

	$options = shortcode_atts(array(
		"title" => '',
		"open" => '',
		'ico_class' => '',
		'icon_fontawesome' => '', 		// default value to backend editor | param used by VC
		'icon_typicons' => '',			// default value to backend editor | param used by VC
		'icon_linecons' => '',			// default value to backend editor | param used by VC
		'icon_woothemesecom' => '',		// default value to backend editor | param used by VC
		'ico_type'=>''
	), $atts);


	$tabtarget = sanitize_title_with_dashes( remove_accents( wp_kses_decode_entities( $options['title'] ) ) );

	//initialise urltarget
	$urltarget = '';

	//grab the value of the 'target' url parameter if there is one
	if ( isset ( $_REQUEST['target'] ) ) {
		$urltarget = sanitize_title_with_dashes( $_REQUEST['target'] );
	}

	//	Set Tab Panel Class - add active class if the open attribute is set or the target url parameter matches the dashed version of the tab title
	$tabcontentclass = "tabcontent";

	if ( isset( $class ) ) {
		$tabcontentclass .= " " . $class . "-content";
	}

	if ( ( $options['open'] ) || ( isset( $urltarget ) && ( $urltarget == $tabtarget ) ) ) {
		$tabcontentclass .= " c-responsive-tabs__panel--active";
	}

	$ico_type =  $options['ico_type'] ? $options['ico_type'] : 'fontawesome'; // Set as default iconfont

	// Enqueue frontend icon font family
	if(  $options["icon_{$ico_type}"] ){
		
		wps_icon_element_fonts_enqueue(  $ico_type );
	}	
	
	$ico_type_class = wps_getExtraClass( $options["icon_{$ico_type}"] );
	$ico_class_custom = wps_getExtraClass( $options['ico_class'] );
	$addtabicon = $ico_class_custom || $ico_type_class ? "<i class=\"ico{$ico_class_custom}{$ico_type_class}\"></i> " : '';

	$output = '';

	$title = $options['title'] ? $options['title'] : 'Please Add Title';

	$output .='<h2 class="tabtitle">' . $addtabicon . $title . '</h2>' . "\n" . '<div class="' . $tabcontentclass . '">' . "\n";
	$output .= do_shortcode($content);
	$output .= '</div>';
	
	return $output;

}