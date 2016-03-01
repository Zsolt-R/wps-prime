<?php
/**
 * Theme Shortcodes
 *
 * @package wps_prime
 */

/**
 *  WPS SHORTCODES
 *
 * 1  Layout Wrapper Markup - [layout class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 * 2  Layout Item Markup - [item class="lap-and-up..."] ...content... [/item]
 * 3  Full Width Slider - [slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 * 4  Custom Buttons - [button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
 * 5  Media / Flag Object - media/flag(OOCSS Markup Items) - [object type="media/flag"] ... [/object]
 * 6  Media / Flag Object inners -media/flag __img, __body (OOCSS Markup Items) - [object_item type="media__img/flag__img,media__img/media__body"]...[/object_item]
 * 7  Shortcode for icons - [ico]fa fa-home[/ico]
 * 8  Main Phone number - [main_phone_nr]
 * 9  Main Email address - [main_email]
 * 10 List styles [s_list class="list--style-one custom--class"]<ul><li>List item</li> .... </ul>[/s_list]
 * 11 Media Box [mediabox]...content...[/mediabox]
 * 12 Highlight [hglt class="" html_tag=""]...content...[/hglt]
 * 13 Divider [divider]
 * 14 Divider [accordion]
 * 15 Divider [accprdion_item]
 */

/* 1 Layout Wrapper Markup */
add_shortcode( 'layout', 'wps_layout' );

/* 2 Layout Item Markup */
add_shortcode( 'item','wps_layout_inner_block' );

/* 3 Full Width Slider */
add_shortcode( 'slider', 'wps_fw_slider' );

/* 4 Custom Buttons */
add_shortcode( 'button', 'wps_buttons' );

/* 5 Media / Flag Object */
add_shortcode( 'object', 'wps_css_objects' );

/* 6 Media / Flag Object inners */
add_shortcode( 'object_item' , 'wps_css_objects_item' );

/* 7 Shortcode for icons */
add_shortcode( 'ico', 'wps_ico_shortcode' );

/* 8 Get theme option phone nr */
add_shortcode( 'main_phone_nr', 'wps_main_phone_nr' );

/* 9 Get theme option email */
add_shortcode( 'main_email', 'wps_main_email' );

/* 10 Creates a custom bulleted list */
add_shortcode( 's_list', 'wps_styled_list' );

/* 11 Generate a complex Media Box */
add_shortcode( 'mediabox', 'wps_media_box' );

/* 12 Content highlight Markup */
add_shortcode( 'hglt', 'wps_content_highlight' );

/* 13 Content divider */
add_shortcode( 'divider', 'wps_content_divider' );

/**
 * 1 Layout Item Markup
 * ex. [layout class="lap-and-up..." wrapper="false" wrapper_class="custom-class"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_layout( $atts, $content = null ) {
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
 * ex: [item class="lap-and-up..."] ...content... [/item]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_layout_inner_block( $atts, $content = null ) {
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
 * ex: [slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_fw_slider( $atts ) {
	$options = shortcode_atts( array(
		'images' => '',
		'links' => '',
		'min' => '22.51em',
		'size' => 'wps_prime_full',
		'size_mobile' => 'wps_prime_medium',
	), $atts );

	$constructor = 'Add image id\'s to shortcode to use slider ex. images="1,2,3,4..."';

	$image_list_constructor = '';
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

		 $constructor = '<div class="swiper">        
                <div class="swiper-container">
                    <div class="swiper-wrapper">'. $image_list_constructor .'</div>                    
                
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div><div class="swiper-button-next"></div>
                        <!-- Add Scrollbar -->
                 <div class="swiper-scrollbar"></div>
             </div><!--swiper-container-->
            </div>';
	}

		return $constructor;
}

/**
 * 4 Custom Buttons
 * ex:  [button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @return string
 */
function wps_buttons( $atts ) {
	$options = shortcode_atts( array(
		'class' => '',
		'label' => 'Please add label',
		'link'  => '',
		'target'=> ''
	), $atts );

	$styleClass = $options['class'] ? ' '.$options['class'] : '';
	$btnInfotext = $options['label'] ? $options['label'] : '';
	$btnLink = $options['link'] ? $options['link'] : '#';
	$btnTarget = $options['target'] ? ' target="'.$options['target'].'"' : '';

	$output = '<a class="btn'. $styleClass .'" href="'.$btnLink.'"'.$btnTarget.'>'. $btnInfotext .'</a>';

	return $output;

}

/**
 * 5 Media / Flag Object (OOCSS Markup Items)
 * ex:  [object type="media/flag"] ... [/object]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_css_objects( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'type' => '',
	), $atts );

	$class = $options['type'];

	$output = '<div class="'. $class .'">'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
 * 6 Media / Flag Object inners - __img, __body (OOCSS Markup Items)
 * ex: [object_item type="media__img/flag__img,media__img/media__body"]...[/object_item]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_css_objects_item( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'type' => '',
	), $atts );

	$class = $options['type'];

	$output = '<div class="'. $class .'">'. do_shortcode( $content ) .'</div>';

	return $output;

}

/**
 * 7 Shortcode for icons
 * ex: [ico]fa fa-home[/ico]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_ico_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(array(
		'class' => '',
	), $atts );

	$ico_class = $options['class'] ? ' '.$options['class'] : '';

	$output = '<i class="ico '. $content . ''. $ico_class .'"></i>';

	return $output;
}

/**
 * 8 Main Phone number
 * ex: [phone_nr]
 */
function wps_main_phone_nr() {

	$phone_nr = wps_get_theme_option( 'company_phone_nr' ) ? wps_get_theme_option( 'company_phone_nr' ) : 'No phone number set';

	return $phone_nr;

}

/**
 * 9 Main Email address
 * ex: [email]
 */
function wps_main_email() {

	$email = wps_get_theme_option( 'company_contact_email_address' ) ? wps_get_theme_option( 'company_contact_email_address' ) : 'No email set';

	return $email;
}

/**
 * 10 Styled List
 * ex: [s_list class="list-style--one custom--class"]<ul><li>List item</li> .... </ul>[/s_list]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_styled_list( $atts, $content = null ) {
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
 * ex: [mediabox image_id="1038" image_class="aligncenter img--round img--border" image_size="thumbnail" ico_class="fa fa-envelope fa-4x" class="bg--color-one p- txt--color-invert" type="flag" type_class="flag--responsive" title="Contact our experts today!" divider="true" divider_class="mb-" title_class="txt--bold mb-"]...content...[/mediabox]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_media_box( $atts, $content = null ) {

		$args = shortcode_atts(array(
			'image_id' => '',
			'image_class' => '',
			'image_size' => 'medium',
			'ico_class' => '',
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

		if ( $args['type'] !== '' ) {

			 $output = "<div class=\"mediabox{$class}\">{$title}{$divider}<div class=\"{$args['type']}{$type_class}\"><div class=\"{$args['type']}__img{$type_img_class}\">{$symbol}</div><div class=\"{$args['type']}__body{$type_body_class}\">{$content}</div></div></div>";
		} else {

			 $output = "<div class=\"mediabox{$class}\">{$symbol}{$title}{$divider}{$content}</div>";
		}

		return $output;
}

/**
 * 12 Content Highlight
 */
function wps_content_highlight( $atts, $content = null ) {

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
function wps_content_divider( $atts ) {

	$args = shortcode_atts(array(
		'class' => '',
	),$atts);

		$class = $args['class'] ? ' '.$args['class'] : '';

		$output = "<hr class=\"divider{$class}\"/>";

	return $output;
}

require_once('shortcode_classes/wps_acc_shortcode.php');