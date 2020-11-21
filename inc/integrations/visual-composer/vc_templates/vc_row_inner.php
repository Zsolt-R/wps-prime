<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $wrapper
 * @var $wrapper_class
 * @var $class
 * @var $holder_img
 * @var $holder_class
 * @var $holder_img_size
 * @var $margin
 * @var $padding
 * @var $holder_img_pos
 * @var $holder_bg_fx
 * @var $row_v_align
 * @var $row_h_align
 * @var $row_adjust
 * @var $grid_col_equal_height
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$class = $wrapper = $wrapper_class = $holder_img = $holder_class = $holder_id = $holder_img_size = $holder_img_behave = $holder_img_pos = $use_parallax = '';
$holder_margin = $holder_padding = $holder_img_pos = $holder_bg_fx = $row_v_align = $row_h_align = $row_adjust = $row_align = '';

$v_bg = $v_youtube = $v_hosted = $v_placeholder = $video_bg = $hosted_video = $tube_video = '';

$holder_start = $holder_end =  $imagepath = $background = '';
$wrapper_start = $wrapper_end = $anim_data = '';
$output = '';

$css_classes = array();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

	$anim = $anim_data ? ' data-animate="'.$anim_data.'"' :false;

	$has_tube_bg = ( ! empty( $v_bg ) && ! empty( $v_youtube) && wps_extract_youtube_id( $v_youtube ) );
	$has_hosted_bg = ( ! empty( $v_bg ) && ! empty( $v_hosted ) );

	if ( $has_tube_bg && wps_extract_youtube_id( $v_youtube )) {

				$parallax_image = $v_youtube;
				$css_classes[] = 'vc_video-bg-container';			
				$tube_video = '<span class="wps-ytube-video" data-video-bg-id="' . wps_extract_youtube_id( $v_youtube ) . '"></span>';
				
			}	

	if( $has_hosted_bg ){
		$hosted_video = '<div class="wps-bg-video-wrapper"><video playsinline autoplay muted loop ';
		$hosted_video .= wp_get_attachment_url($v_placeholder) ? 'poster="'.wp_get_attachment_url($v_placeholder).'" ' : '';
		$hosted_video .= 'class="wps-bg-video">';
		$hosted_video .= '<source src="'.wp_get_attachment_url( $v_hosted ).'" type="video/mp4"></video></div>';		
		}

	if( $has_tube_bg || $has_hosted_bg ){
		//$video_bg = $hosted_video ?  $hosted_video : $tube_video;
		$video_bg = $has_tube_bg ?  $tube_video : $hosted_video;
	}

	// Layout Classes
	// Layout Classes
	$class     = wps_getExtraClass( array(
				 $class,
				 $row_v_align,
				 $row_h_align,
				 $row_align,
				 $row_adjust,
				 $grid_col_equal_height ? wps_getExtraClass('grid--equalHeight') : '',
				 )
				);

	// Holder Classes
	$class_h  = wps_getExtraClass( array(
					$video_bg ? wps_getExtraClass('o-holder--video') : '',
					$holder_class,
					$holder_img_pos,
					$holder_img_behave,
					$holder_bg_fx,
					$holder_margin,
					$holder_padding					
					)
				);
	
	// Wrapper Classes
	$class_w  = wps_getExtraClass( array('o-wrapper', $wrapper_class) );

	// Holder ID
	$row_id = $holder_id ? ' id="'. $holder_id .'" ' : '';


	if ( $holder_img && !$has_hosted_bg) {
			$filetype = wp_check_filetype(wp_get_attachment_url($holder_img));

			if('svg' === $filetype['ext']){
				$imagepath = wp_get_attachment_url($holder_img);
			}else{
				$image = wp_get_attachment_image_src( $holder_img,$holder_img_size,false );
				$imagepath = $image[0];
			}

			$background = $imagepath ? " style='background-image:url({$imagepath});'" : '';
			if ( $use_parallax ){

				wp_enqueue_script('wps_parallax'); // Registered in functions
				$background = " data-parallax=\"scroll\" data-image-src=\"{$image[0]}\"";
				$class_h .= wps_getExtraClass('parallax-window');
			}
	}
	
		

	if ( $background || $class_h || $row_id || $video_bg || $anim) {
		$holder_start = '<div '.$row_id.'class="o-holder'.$class_h.'"'.$background.$anim.'>'.$video_bg;
		$holder_end = '</div>';
	}

	if ( 'false' !== $wrapper && $wrapper ) {
		$wrapper_start = '<div class="'.$class_w.'">';
		$wrapper_end = '</div>';
	}

$css_classes = array(
    //'vc_row',
    //'vc_row-fluid',
    'grid-1',
    $class,    
);


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';



$output .= $holder_start;
$output .= $wrapper_start;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content , true);
$output .= '</div>';
$output .= $wrapper_end;
$output .= $holder_end;
echo $output;