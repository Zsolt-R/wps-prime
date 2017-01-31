<?php
/**
*	@since 1.4.5
*/

/**
*	Shortcodes row and column
*/
if (!class_exists('Wps_Vc_Fallback_Shortcodes')) :

	class Wps_Vc_Fallback_Shortcodes{


	/**
	 * Class constructor
	 * Sets up the plugin, including: textdomain, adding shortcodes, registering
	 * scripts and adding buttons.
	 */
	function __construct() {

		// Load text domain
		load_plugin_textdomain('wps-prime', false, WPS_THEME_DIR . '/languages/');

		add_shortcode('vc_row', array($this, 'wps_vc_row_shortcode_fallback'));		
		add_shortcode('vc_row_inner', array($this, 'wps_vc_row_inner_shortcode_fallback'));
		add_shortcode('vc_column', array($this, 'wps_vc_column_shortcode_fallback'));
		add_shortcode('vc_column_inner', array($this, 'wps_vc_column_inner_shortcode_fallback'));
		add_shortcode('vc_column_text',array($this,'wps_vc_column_text_shortcode_fallback'));

	}

	/**
	 * Row shortcode
	 */
	public function wps_vc_row_shortcode_fallback($atts, $content = null) {

			$options = shortcode_atts(array(			
				'class' => '',
				'wrapper_class' => '',
				'holder_class' => '',
				'wrapper' => false,
				'holder_img' => '',
				'holder_img_size' => 'full',
				'holder_img_pos' =>'',
				'holder_bg_fx' =>'',
				'row_h_align' =>'',
				'row_v_align' =>'',
				'row_adjust' => '',
				'video_bg' => false,
				'video_bg_url' =>'',
			), $atts );

			// Setup Defaults
			$style = $video_bg = $video_bg_url = '';
			$output = '';

			// Stack Classes
			$class = wps_getExtraClass( array( 
				$options['class'],
				$options['row_h_align'],
				$options['row_v_align'],
				$options['row_adjust']
				)
			);			

			$class_h = wps_getExtraClass( array( 
					   $options['holder_class'],
			    	   $options['holder_img_pos'],
			   		   $options['holder_bg_fx']
			   		   )
			);

			$class_w =  wps_getExtraClass( $options['wrapper_class'] );

			$css_classes = array();

			$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

			if ( $has_video_bg ) {

				$parallax_image = $video_bg_url;
				$css_classes[] = 'vc_video-bg-container';
				wp_enqueue_script( 'vc_youtube_iframe_api_js' );
			}

			if ( $video_bg ) {
				$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
			}

			$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( array_unique( $css_classes ) ) ) );

			// var_dump( esc_attr( trim( $css_class ) ));

			// Check for background Image and setup inline style
			if ( $options['holder_img'] ) {
				$image = wp_get_attachment_image_src( $options['holder_img'],$options['holder_img_size'],false );
				$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
			}

			// Prepare Output
			$output = sprintf('%1$s%2$s<div class="grid-1%3$s">%4$s</div>%5$s%6$s',
				$style || $class_h ? "<div class=\"holder{$class_h}".esc_attr( trim( $css_class ) )."\"{$style}>" : '', 					//  %1$s
				'false' !== $options['wrapper'] && $options['wrapper'] ? "<div class=\"o-wrapper{$class_w}\">" : '',		//  %2$s
				$class,																									//  %3$s
				do_shortcode( $content ),																				//  %4$s	
				'false' !== $options['wrapper'] && $options['wrapper'] ? "</div>" : '',									//  %5$s
				$style || $class_h ? "</div>" : ''														//  %6$s
			);

			return $output;
	}


	/**
	 * Inner Row shortcode
	 */
	public function wps_vc_row_inner_shortcode_fallback($atts, $content = null) {


		return $this->wps_vc_row_shortcode_fallback($atts, $content);
	}

	/**
	 * Column shortcode
	 */
	public function wps_vc_column_shortcode_fallback($atts, $content = null) {

		$options = shortcode_atts( array(
			'width' => '',
			'class' => '',
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
			'align_content_inner' => ''
		), $atts );
	
		$style = '';

		// Stack Classes
		$class = wps_getExtraClass( array(
			$options['class'] ?  ' '.$options['class'] : '',
			$options['width'] ?  ' _lap-and-up-'.wps_wpb_translateColumnWidthToSpan($options['width']) : '',
			$options['margin'] ?  ' '.$options['margin'] : '',
			$options['padding'] ?  ' '.$options['padding'] : ''
			)
		);
	
		$inner_class  = wps_getExtraClass( array(
			$options['inner_class'] ?  ' '.$options['inner_class'] : '',
			$options['margin_inner'] ?  ' '.$options['margin_inner'] : '',
			$options['padding_inner'] ?  ' '.$options['padding_inner'] : '',
			$options['inner_img_pos'],
			$options['inner_bg_fx'],
			$options['align_content_inner'],
			)
		);

	
		if ( $options['inner_img'] ) {
			$image = wp_get_attachment_image_src( $options['inner_img'],$options['inner_img_size'],false );
			$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
		}
	
		/* Just fill the inner_class argument to activate, and deactivate by setting inner 
		*  to false this way you can deactivate the inner element 
		*  whithout deleting the inner_class argument
		*/
	
		// Prepare Output
		$output = sprintf('<div class="col%1$s%2$s">%3$s%4$s%5$s</div>',
				$class, 																								      // %1$s
				$options['row_width'] ?  ' '.$options['row_width'] : '',											      // %2$s
				true === $options['inner'] && '' !== $inner_class || '' !== $style ? "<div class=\"inner{$inner_class}\"{$style}>" : '',  // %3$s
				do_shortcode( $content ),																					  // %4$s	
				true === $options['inner'] && '' !== $inner_class || '' !== $style ? "</div>" : '' 											  // %5$s
		);																													  

		return  $output;

	}

	/**
	 * Column inner shortcode
	 */
	public function wps_vc_column_inner_shortcode_fallback($atts, $content = null) {

		return $this->wps_vc_column_shortcode_fallback($atts, $content);
	}

	/**
	 * Column Text inner shortcode
	 */
	function wps_vc_column_text_shortcode_fallback( $atts, $content = null ) {
	
		$options = shortcode_atts( array(
			'el_class' => '',
			'margin'=>'',
			'padding'=>'',
			), $atts );

	// Stack Classes
	$css_class = $options['el_class'] ?  $options['el_class'] : '';
	$css_class .= $options['margin'] ?  ' '.$options['margin'] : '';
	$css_class .= $options['padding'] ?  ' '.$options['padding'] : '';

	// Prepare Output
	$output = sprintf('%1$s%2$s%3$s',
				$css_class !== '' ? "<div class=\"{$css_class}\">" : '',	// %1$s
				do_shortcode($content), 									// %2$s
				$css_class !== '' ? '</div>' : ''  							// %3$s
		);

	return  $output;
	}
}


// This Extend was correct
class Wps_Vc_Row_Inner_Shortcodes extends Wps_Vc_Fallback_Shortcodes{

	/**
	 * Class constructor
	 * Sets up the plugin, including: textdomain, adding shortcodes, registering
	 * scripts and adding buttons.
	 */
	function __construct() {

		add_shortcode('vc_row_inner', array($this, 'wps_vc_row_inner_shortcode_fallback'));

	}
		var $these_atts,$these_content;		


	public function wps_vc_row_inner_shortcode_fallback($atts, $content = null){

		$this->these_atts = $atts;
		$this->these_content = $content;

		return parent::wps_vc_row_shortcode_fallback($atts, $content);
	}	
	
}

$Wps_Vc_Fallback_Shortcodes = new Wps_Vc_Fallback_Shortcodes;
//$Wps_Vc_Row_Inner_Shortcodes = new Wps_Vc_Row_Inner_Shortcodes;
//$Wps_Vc_Row_Inner_Shortcodes = new Wps_Vc_Row_Inner_Shortcodes;


endif;

