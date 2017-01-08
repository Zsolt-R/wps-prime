<?php
/**
* Helper functions that ease population of component options
* Functions that return arrays with prepopulated data
* @since 1.4.4
*/


/**
 * Returns array of image sizes
 *
 */
function wps_image_sizes() {
	global $_wp_additional_image_sizes;

    $sizes = array();
    $output = array();

    $get_sizes = get_intermediate_image_sizes();
	array_unshift( $get_sizes, 'full' );
	$get_sizes = array_combine( $get_sizes, $get_sizes );

    foreach ( $get_sizes as $_size ) {

        if ( in_array( $_size, array('full','thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
        }
    }

     foreach ($sizes as $image_size => $image_size_data){

       	$crop = $height = $width = ''; 

       	// Create image size name
       	$img_size_name = str_replace("_"," ",ucwords($image_size));

       	// If image size is not full
       	if($image_size_data['height'] != false && $image_size_data['width'] != false){

       		$height = $image_size_data['height'] === '0' ? 'auto' : $image_size_data['height'];
       		$width = $image_size_data['width'] === '0' ? 'auto' : $image_size_data['width'];

       		$img_size_name .= ' ('. $width .' x '. $height.')';
    }

// Croop info
//
//         if(is_array($image_size_data['crop'])){
//            $crop = 'true '.$image_size_data['crop'][0].'-'.$image_size_data['crop'][0];
//         }else{
//            $crop = $image_size_data['crop'] ? 'true auto' : 'false';
//         }
    	$output[$img_size_name] =  $image_size; 
    }
    return $output;
}

/**
 * Returns array of predefined css classes
 *
 * @since 1.4.4
 */
if(!function_exists('wps_ico_colors')){
	function wps_ico_colors() {
		$color_list = array(
	                    __('Color default','wps-prime') => '',
	                    __('Color 1','wps-prime') => 'ico--color-one',
	                    __('Color 2','wps-prime') => 'ico--color-two',
	                    __('Color 3','wps-prime') => 'ico--color-three',
	                    __('Color 4','wps-prime') => 'ico--color-four',
	                    __('Color 5','wps-prime') => 'ico--color-five',
	                    __('Color 6','wps-prime') => 'ico--color-six',
	                    __('Color White','wps-prime') => 'ico--color-white'
	                );
		return $color_list;
	}
}
/**
 * Returns array of predefined css classes
 *
 * @since 1.4.4
 */
if(!function_exists('wps_ico_size')){
	function wps_ico_size() {
		$size_list = array(
						__('Default','wps-prime') => '',
	                    __('Small','wps-prime') => 'ico--sm',
	                    __('Normal','wps-prime') => 'ico--m',
	                    __('Large','wps-prime') => 'ico--l',
	                    __('Extra Large','wps-prime') => 'ico--xl',
	                    __('Huge','wps-prime') => 'ico--xxl',

	                );
		return $size_list;
	}
}
/**
*	Background effects
* 	@since 1.4.5
*/
if(!function_exists('wps_bg_fx')){
	function wps_bg_fx(){
		$fx_list = array(
	                    __('None','wps-prime') 					=> '',
	                    __('Background One','wps-prime')  		=> 'u-background-color-one',
	                    __('Background Two','wps-prime')  		=> 'u-background-color-two',
	                    __('Background Three','wps-prime')		=> 'u-background-color-three',
	                    __('Background Four','wps-prime') 		=> 'u-background-color-four',
	                    __('Background Five','wps-prime') 		=> 'u-background-color-five',
	                    __('Background Six','wps-prime')  		=> 'u-background-color-six',
	                    __('Background Body','wps-prime') 		=> 'u-background-body',
	                    __('Background Light','wps-prime') 		=> 'u-background-light',
	                    __('Background Dark','wps-prime')  		=> 'u-background-dark',
	                    __('Background Opaq Light','wps-prime') => 'u-background-opaq-light',
	                    __('Background Opaq Dark','wps-prime') 	=> 'u-background-opaq-dark',

	                );

		return $fx_list;
	}
}
/**
*	Text effects
* 	@since 1.4.5
*/
if(!function_exists('wps_txt_color')){
	function wps_txt_color(){
		$txt_color_list = array(
	                    __('Default','wps-prime') 			=> '',
	                    __('Color White','wps-prime') 		=> 'u-text-color-invert',
	                    __('Color Light','wps-prime') 		=> 'u-text-color-light',
	                    __('Color Primary','wps-prime') 	=> 'u-text-color-primary',
	                    __('Color Secondary','wps-prime') 	=> 'u-text-color-secondary',
	                    __('Color Tertiary','wps-prime') 	=> 'u-text-color-tertiary'
	                );

		return $txt_color_list;
	}
}
/**
*	Text aligns
* 	@since 1.4.5
*/
if(!function_exists('wps_txt_align')){
	function wps_txt_align(){
		$txt_color_list = array(
	                    __('Default','wps-prime') 	=> '',
	                    __('Right','wps-prime') 	=> 'u-text-right',
	                    __('Center','wps-prime') 	=> 'u-text-center',
	                );
		return $txt_color_list;
	}
}
/**
 * Returns array of predefined css classes
 *
 * @since 1.4.4
 */
if(!function_exists('wps_ico_sizes')){
	function wps_ico_sizes() {
		$size_list = array(
						 __('Default','wps-prime') 	   => '',
	                     __('Small','wps-prime')       => 'ico--sm',
	                     __('Normal','wps-prime')      => 'ico--m',
	                     __('Large','wps-prime')       => 'ico--l',
	                     __('Extra Large','wps-prime') => 'ico--xl',
	                     __('Huge','wps-prime')        => 'ico--xxl'
	                );
		return $size_list;
	}
}

/**
 * Returns array of predefined css classes
 *
 * @since 1.4.4
 */
if(!function_exists('wps_bg_positions')){
	function wps_bg_positions() {
		$position_list = array(
	                __('None','wps-prime')				=> '',
                    __('Bg Center (cover)','wps-prime') => 'u-background-center',
	                );
		return $position_list;
	}
}
/**
 * Layout Adjust
 *
 * @since 1.4.4
 */
if(!function_exists('wps_row_adjust')){
	function wps_row_adjust() {
		$position_list = array(
	                __('Default','wps-prime')				=> '',
                    __('Column Space Flush','wps-prime') 	=> 'grid--noGutter',
                    __('Column Space Tiny','wps-prime') 	=> 'grid--tinyGutter',
                    __('Column Space Small','wps-prime') 	=> 'grid--smallGutter',
                    __('Column Space Large','wps-prime') 	=> 'grid--largeGutter',
                    __('Column Space Huge','wps-prime') 	=> 'grid--hugeGutter',
	                );
		return $position_list;
	}
}

/**
 * Layout Horizontal Align
 *
 * @since 1.4.4
 */
if(!function_exists('wps_row_horizontal_align')){
	function wps_row_horizontal_align() {
		$position_list = array(
	                __('Default','wps-prime')			=> '',
                    __('Align Right','wps-prime') 		=> 'grid--right',
                    __('Align Center','wps-prime') 		=> 'grid--center',
	                );
		return $position_list;
	}
}

/**
 * Layout Verical Align
 *
 * @since 1.4.4
 */
if(!function_exists('wps_row_vertical_align')){
	function wps_row_vertical_align() {
		$position_list = array(
	                __('Default','wps-prime')	  => '',
                    __('Align Top','wps-prime') 	  => 'grid--top',
                    __('Align Middle','wps-prime') 	  => 'grid--middle',
                    __('Align Bottom','wps-prime') 	  => 'grid--bottom',
	                );
		return $position_list;
	}
}

/**
 * Button Color
 *
 * @since 1.4.4
 */
if(!function_exists('wps_btn_color')){
	function wps_btn_color() {
		$output = array(
	            __('Default','wps-prime')			=> '',
                __('Color Primary','wps-prime') 	=> 'c-button--primary',
                __('Color Secondary','wps-prime') 	=> 'c-button--secondary',
                __('Color Tertiary','wps-prime') 	=> 'c-button--tertiary',
                __('Color Positive','wps-prime') 	=> 'c-button--positive',
                __('Color Negative','wps-prime') 	=> 'c-button--negative',
                __('Color Neutral','wps-prime') 	=> 'c-button--neutral',
                __('Color Light','wps-prime') 	    => 'c-button--light',
                __('Color White','wps-prime') 	    => 'c-button--white'
	            );
		return $output;
	}
}

/**
 * Button size
 *
 * @since 1.4.4
 */
if(!function_exists('wps_btn_size')){
	function wps_btn_size() {
		$output = array(
	                __('Default','wps-prime')			=> '',
                    __('Small','wps-prime') 			=> 'c-button--small',
                    __('Large','wps-prime') 		    => 'c-button--large',
	                );
		return $output;
	}
}

/**
 * Button Aspect
 *
 * @since 1.4.4
 */
if(!function_exists('wps_btn_aspect')){
	function wps_btn_aspect() {
		$output = array(
					__('Default','wps-prime')			=> '',
                    __('Full Width','wps-prime') 		=> 'c-button--full',
                    __('Pill','wps-prime')				=>' c-button--pill'
	                );
		return $output;
	}
}

/**
 * Button Position
 *
 * @since 1.4.4
 */
if(!function_exists('wps_btn_pos')){
	function wps_btn_pos() {
		$output = array(
                __('Default','wps-prime')	=> '',
                __('Center','wps-prime')	=>'c-button--center',
                __('Right','wps-prime')		=>'c-button--right'
                );
		return $output;
	}
}


/**
* Find file, check if is child theme, file is in child theme
* @since 1.4.4
*/
function get_wps_file_location($file = '', $default = ''){

  $location = get_template_directory_uri().$default.'/'.$file;    
  if(is_child_theme()){  	
    if(file_exists(get_stylesheet_directory().'/'.$file)){
       $location = get_stylesheet_directory_uri().'/'.$file;
    }

  }
  return $location;
}

/**
 * Include template from templates dir.
 *
 * @since 1.4.4
 *
 * @param $template
 * @param array $variables - passed variables to the template.
 *
 * @param bool $once
 *
 * @return mixed
 */
function wps_vc_offset_include_template( $variables = array(), $once = false ) {
	is_array( $variables ) && extract( $variables );
	if ( $once ) {
		return require_once get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_offset_tpl.php';
	} else {
		return require get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_offset_tpl.php';
	}
}

function wps_vc_margin_include_template( $variables = array(), $once = false ) {
	is_array( $variables ) && extract( $variables );
	if ( $once ) {
		return require_once get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_margin_tpl.php';
	} else {
		return require get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_margin_tpl.php';
	}
}

function wps_vc_padding_include_template( $variables = array(), $once = false ) {
	is_array( $variables ) && extract( $variables );
	if ( $once ) {
		return require_once get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_padding_tpl.php';
	} else {
		return require get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_padding_tpl.php';
	}
}




/* Convert vc_col-sm-3 to 1/4
---------------------------------------------------------- */
/**
 * @param $width
 *
 * @since 1.4.4
 * @return string
 */
function wps_wpb_translateColumnWidthToFractional( $width ) {
	switch ( $width ) {
		case 'vc_col-sm-2' :
			$w = '1/6';
			break;
		case 'vc_col-sm-3' :
			$w = '1/4';
			break;
		case 'vc_col-sm-4' :
			$w = '1/3';
			break;
		case 'vc_col-sm-6' :
			$w = '1/2';
			break;
		case 'vc_col-sm-8' :
			$w = '2/3';
			break;
		case 'vc_col-sm-9' :
			$w = '3/4';
			break;
		case 'vc_col-sm-12' :
			$w = '1/1';
			break;

		default :
			$w = is_string( $width ) ? $width : '1/1';
	}

	return $w;
}

function wps_vc_spacing_params(){

	$params = array(

		// Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Margin",
            'param_name' => 'set_margin',
            'admin_label' => false,
            'weight' => 99,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////////

        array(
            'type' => 'wps_margin',
            'heading' => "Margin Settings",
            'param_name' => 'margin',
            'admin_label' => true,
            'weight' => 99,
            'dependency' => array('element' => 'set_margin', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),

        // Only for VC UI functionality
        array(
            'type' => 'checkbox',
            'heading' => "Set Padding",
            'param_name' => 'set_padding',
            'admin_label' => false,
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        ),
        /////////////////////////////

        array(
            'type' => 'wps_padding',
            'heading' => "Padding Settings",
            'param_name' => 'padding',
            'admin_label' => true,
            'dependency' => array('element' => 'set_padding', 'value' => 'true'),
            'group' => esc_html__( 'Margins/paddings', 'wps-prime' ),
        )
        );


	return $params;
}