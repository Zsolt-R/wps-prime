<?php
/**
 * Theme Shortcodes
 *
 * @package wps_prime
 */

/**
 *  WPS SHORTCODES
 *
 * 1  Layout Wrapper Markup - [layout class="lap-and-up..." wrapper="false"]
 * 2  Layout Item Markup - [item class="lap-and-up..."] ...content... [/item]
 * 3  Full Width Slider - [slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="wps_prime_full"]
 * 4  Custom Buttons - [button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
 * 5  Media / Flag Object - media/flag(OOCSS Markup Items) - [object type="media/flag"] ... [/object]
 * 6  Media / Flag Object inners -media/flag __img, __body (OOCSS Markup Items) - [object_item type="media__img/flag__img,media__img/media__body"]...[/object_item]
 * 7  Shortcode for icons - [ico]fa fa-home[/ico]
 * 8  Main Phone number - [main_phone_nr]
 * 9  Main Email address - [main_email]
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

/**
 * 1 Layout Item Markup
 * ex. [layout class="lap-and-up..." wrapper="false"]
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given.
 * @param str   $content the enclosed content.
 * @return string
 */
function wps_layout( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'class' => '',
		'class_wrapper' => '',
		'wrapper' => false,
	), $atts );

	$class = $options['class'] ? ' '.$options['class'] : '';
	$class_w = $options['class_wrapper'] ? ' '.$options['class_wrapper'] : '';

	$layout = '<div class="layout'. $class .'">' . do_shortcode( $content ) . '</div>';

	// Check for string value false (confront with string 'false').
	$output = 'false' !== $options['wrapper'] && $options['wrapper'] ? '<div class="wrapper'. $class_w .'">'. $layout .'</div>' : $layout;

	return  $output;
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
	), $atts );
	$class = $options['class'] ?  ' '.$options['class'] : '';

	$output = '<div class="layout__item'. $class .'">' . do_shortcode( $content ) . '</div>';

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
	), $atts );

	$styleClass = $options['class'] ? ' '.$options['class'] : '';
	$btnInfotext = $options['label'] ? $options['label'] : '';
	$btnLink = $options['link'] ? $options['link'] : '#';

	$output = '<a class="btn'. $styleClass .'" href="'.$btnLink.'">'. $btnInfotext .'</a>';

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
