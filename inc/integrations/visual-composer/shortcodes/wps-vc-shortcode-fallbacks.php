<?php
/**
*	@TODO add vc_row_inner
*   @TODO add vc_column_inner
*/
add_shortcode( 'vc_row', 'wps_vc_row_shortcode_fallback' );
add_shortcode( 'vc_column','wps_vc_column_shortcode_fallback' );
add_shortcode( 'vc_column_text','wps_vc_column_text_shortcode_fallback' );


function wps_vc_row_shortcode_fallback( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'class' => '',
		'wrapper_class' => '',
		'holder_class' => '',
		'wrapper' => false,
		'holder_img' => '',
		'holder_img_size' => 'full',
	), $atts );

	$holder_start = $holder_end = $wrapper_start = $wrapper_end = '';
	$style = '';
	$output = '';	

	$class = $options['class'] ? ' '.$options['class'] : '';
	$class_w = $options['wrapper_class'] ? ' '.$options['wrapper_class'] : '';
	$class_h = $options['holder_class'] ? ' '.$options['holder_class'] : '';

	if ( $options['holder_img'] ) {
			$image = wp_get_attachment_image_src( $options['holder_img'],$options['holder_img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
	}

	if ( $style || $options['holder_class']  ) {

		$holder_start = '<div class="holder'.$class_h.'"'.$style.'>';
		$holder_end = '</div>';
	}

	if ( 'false' !== $options['wrapper'] && $options['wrapper'] ) {

		$wrapper_start = '<div class="wrapper'.$class_w.'">';
		$wrapper_end = '</div>';
	}

	$output .= $holder_start;
	$output .= $wrapper_start;
	$output .= '<div class="layout'. $class .'">';
	$output .= do_shortcode( $content );
	$output .= '</div>';
	$output .= $wrapper_end;
	$output .= $holder_end;
	
	return $output;
}


function wps_vc_column_shortcode_fallback( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'width' => '',
		'inner'=>true,
		'inner_class'=>'',
		'layout_width' => ''
	), $atts );

	$inner_start = $inner_end = '';

	$class = $options['width'] ?  ' '.$options['width'] : '';
	$inner_class = $options['inner_class'] ?  ' '.$options['inner_class'] : '';

	$layout_width = $options['layout_width'] ?  ' '.$options['layout_width'] : '';
	
	/* Just fill the inner_class argument to activate, and deactivate by setting inner 
	*  to false this way you can deactivate the inner element 
	*  whithout deleting the inner_class argument
	*/
	if ( true === $options['inner'] && $options['inner_class'] ) {

		$inner_start = '<div class="layout__item_inner'.$inner_class.'">';
		$inner_end = '</div>';
	}

	$output = '<div class="layout__item'. $class .''. $layout_width .'">'.$inner_start .'' . do_shortcode( $content ) . ''.$inner_end.'</div>';

	return  $output;
}

function wps_vc_column_text_shortcode_fallback( $atts, $content = null ) {
	$options = shortcode_atts( array(
		'el_class' => ''
	), $atts );

	$css_class = $options['el_class'] ?  $options['el_class'] : '';

	$output  = $css_class !== '' ? '<div class="' . esc_attr( $css_class ) . '">' : '';
	$output .= do_shortcode($content);
	$output .= $css_class !== '' ? '</div>' : '';

	return  $output;
}