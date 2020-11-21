<?php

/**
 * 1 Row Item Markup
 * ex. [wps_row class="lap-and-up..." wrapper="false" wrapper_class="custom-class"].
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_row_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(
		array(
			'class'                 => '',
			'wrapper'               => false,
			'wrapper_size'          => '',
			'wrapper_class'         => '',
			'holder_img'            => '',
			'holder_class'          => '',
			'holder_id'             => '',
			'holder_img_size'       => 'full',
			'background'            => '',
			'use_parallax'          => false,
			'holder_margin'         => '',
			'holder_padding'        => '',
			'holder_img_pos'        => '',
			'holder_bg_fx'          => '',
			'row_v_align'           => '',
			'row_h_align'           => '',
			'row_adjust'            => '',
			'grid_col_full_height'  => '',
			'grid_col_equal_height' => '',
			'row_align'             => '',
			'v_bg'                  => '',
			'v_youtube'             => '',
			'v_hosted'              => '',
			'v_placeholder'         => '',
			'video_bg'              => '',
			'hosted_video'          => '',
			'tube_video'            => '',
		),
		$atts
	);

	$v_bg = $v_youtube = $v_hosted = $v_placeholder = $video_bg = $hosted_video = $tube_video = $wrapper = $css_class = $background = '';

	$holder_start  = $holder_end = '';
	$wrapper_start = $wrapper_end = '';
	$output        = '';

	$css_classes = array();

	$has_tube_bg   = ( ! empty( $options['v_bg'] ) && ! empty( $options['v_youtube'] ) && wps_extract_youtube_id( $options['v_youtube'] ) );
	$has_hosted_bg = ( ! empty( $options['v_bg'] ) && ! empty( $options['v_hosted'] ) );

	if ( $has_tube_bg && wps_extract_youtube_id( $options['v_youtube'] ) ) {
		$parallax_image = $options['v_youtube'];
		$css_classes[]  = 'vc_video-bg-container';
		$tube_video     = '<span class="wps-ytube-video" data-video-bg-id="' . wps_extract_youtube_id( $options['v_youtube'] ) . '"></span>';
	}

	if ( $has_hosted_bg ) {
		$hosted_video  = '<div class="wps-bg-video-wrapper"><video playsinline autoplay muted loop ';
		$hosted_video .= wp_get_attachment_url( $options['v_placeholder'] ) ? 'poster="' . wp_get_attachment_url( $options['v_placeholder'] ) . '" ' : '';
		$hosted_video .= 'class="wps-bg-video">';
		$hosted_video .= '<source src="' . wp_get_attachment_url( $options['v_hosted'] ) . '" type="video/mp4"></video></div>';
	}

	if ( $has_tube_bg || $has_hosted_bg ) {
		$video_bg = $has_tube_bg ? $tube_video : $hosted_video;
		wp_enqueue_script( 'wps_vc_video_bg' );
	}

	// Layout Classes
	$class = wps_getExtraClass(
		array(
			$options['class'],
			$options['row_v_align'],
			$options['row_h_align'],
			$options['row_align'],
			$options['row_adjust'],
			$options['grid_col_equal_height'] ? wps_getExtraClass( 'grid--equalHeight' ) : '',
			$options['grid_col_full_height'] ? wps_getExtraClass( 'grid--full-height' ) : '',
		)
	);

	// Holder Classes
	$class_h = wps_getExtraClass(
		array(
			$options['video_bg'] ? wps_getExtraClass( 'o-holder--video' ) : '',
			$options['holder_class'],
			$options['holder_img_pos'],
			$options['holder_bg_fx'],
			$options['holder_margin'],
			$options['holder_padding'],
		)
	);

	// Wrapper Classes
	$class_w = wps_getExtraClass( array( 'o-wrapper', $options['wrapper_size'], $options['wrapper_class'] ), true );

	// Holder ID
	$row_id = $options['holder_id'] ? ' id="' . $options['holder_id'] . '" ' : '';

	if ( $options['holder_img'] && ! $has_hosted_bg ) {
		$image      = wp_get_attachment_image_src( $options['holder_img'], $options['holder_img_size'], false );
		$background = $image[0] ? " style='background-image:url({$image[0]});'" : '';

		if ( $options['use_parallax'] ) {
			wp_enqueue_script( 'wps_parallax' ); // Registered in functions
			$background = " data-parallax=\"scroll\" data-image-src=\"{$image[0]}\"";
			$class_h   .= wps_getExtraClass( 'parallax-window' );
		}
	}

	if ( $background || $class_h || $row_id || $video_bg ) {
		$holder_start = '<div ' . $row_id . 'class="o-holder' . $class_h . '"' . $background . '>' . $video_bg;
		$holder_end   = '</div>';
	}

	if ( 'false' !== $options['wrapper'] && $options['wrapper'] ) {
		$wrapper_start = '<div class="' . $class_w . '">';
		$wrapper_end   = '</div>';
	}

	$css_classes = array(
		'grid-1',
		$class,
	);

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( array_unique( $css_classes ) ) ) );

	$output .= $holder_start;
	$output .= $wrapper_start;
	$output .= '<div class="' . esc_attr( trim( $css_class ) ) . '">';
	$output .= wps_remove_wpautop( $content, true );
	$output .= '</div>';
	$output .= $wrapper_end;
	$output .= $holder_end;

	return $output;
}
