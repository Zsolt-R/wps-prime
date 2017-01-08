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
		load_plugin_textdomain('wps_prime', false, WPS_THEME_DIR . '/languages/');

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
			), $atts );

			// Setup Defaults
			$style = '';
			$output = '';

			// Stack Classes
			$class = $options['class'] ? ' '.$options['class'] : '';
			$class_w = $options['wrapper_class'] ? ' '.$options['wrapper_class'] : '';
			$class_h = $options['holder_class'] ? ' '.$options['holder_class'] : '';

			// Check for background Image and setup inline style
			if ( $options['holder_img'] ) {
				$image = wp_get_attachment_image_src( $options['holder_img'],$options['holder_img_size'],false );
				$style = $image[0] ? " style='background-image:url({$image[0]});'" : '';
			}

			// Prepare Output
			$output = sprintf('%1$s%2$s<div class="grid-1%3$s">%4$s</div>%5$s%6$s',
				$style || $options['holder_class'] ? "<div class=\"holder{$class_h}{$style}\">" : '', 					//  %1$s
				'false' !== $options['wrapper'] && $options['wrapper'] ? "<div class=\"o-wrapper{$class_w}\">" : '',		//  %2$s
				$class,																									//  %3$s
				do_shortcode( $content ),																				//  %4$s	
				'false' !== $options['wrapper'] && $options['wrapper'] ? "</div>" : '',									//  %5$s
				$style || $options['holder_class'] ? "</div>" : ''														//  %6$s
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
			'padding_inner'=>''
		), $atts );
	

		// Stack Classes
		$class = $options['class'] ?  ' '.$options['class'] : '';
		$class .= $options['width'] ?  ' '.$options['width'] : '';
		$class .= $options['margin'] ?  ' '.$options['margin'] : '';
		$class .= $options['padding'] ?  ' '.$options['padding'] : '';	
	
		$inner_class = $options['inner_class'] ?  ' '.$options['inner_class'] : '';
		$inner_class .= $options['margin_inner'] ?  ' '.$options['margin_inner'] : '';
		$inner_class .= $options['padding_inner'] ?  ' '.$options['padding_inner'] : '';
	
	
		/* Just fill the inner_class argument to activate, and deactivate by setting inner 
		*  to false this way you can deactivate the inner element 
		*  whithout deleting the inner_class argument
		*/
	
		// Prepare Output
		$output = sprintf('<div class="row__item%1$s%2$s">%3$s%4$s%5$s</div>',
				$class, 																								      // %1$s
				$options['row_width'] ?  ' '.$options['row_width'] : '',											      // %2$s
				true === $options['inner'] && '' !== $inner_class ? "<div class=\"row__item_inner{$inner_class}\">" : '',  // %3$s
				do_shortcode( $content ),																					  // %4$s	
				true === $options['inner'] && '' !== $inner_class ? "</div>" : '' 											  // %5$s
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

$Wps_Vc_Fallback_Shortcodes = new Wps_Vc_Fallback_Shortcodes;

endif;