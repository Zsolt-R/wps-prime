<?php

/**
 * Returns array of image sizes
 *
 * @since 1.0.0
 */
function wps_image_sizes() {
	$sizes = array(
		//esc_html__( 'Custom Size', 'total' ) => 'wps_custom',
	);
	$get_sizes = get_intermediate_image_sizes();
	array_unshift( $get_sizes, 'full' );
	$get_sizes = array_combine( $get_sizes, $get_sizes );
	$sizes     = array_merge( $sizes, $get_sizes );
	return $sizes;
}

/**
 * Returns array of predefined css classes
 *
 * @since 1.0.0
 */
function wps_ico_colors() {
	$color_list = array(
                    'Color default' => '',
                    'Color 1' => 'ico--color-one',
                    'Color 2' => 'ico--color-two',
                    'Color 3' => 'ico--color-three',
                    'Color 4' => 'ico--color-four',
                    'Color 5' => 'ico--color-five',
                    'Color 6' => 'ico--color-six'
                );
	return $color_list;
}


/**
 * Returns array of predefined css classes
 *
 * @since 1.0.0
 */
function wps_ico_sizes() {
	$size_list = array(
					'Default' 	  => '',
                    'Small'       => 'ico--sm',
                    'Normal'      => 'ico--m',
                    'Large'       => 'ico--l',
                    'Extra Large' => 'ico--xl',
                    'Huge'        => 'ico--xxl'
                );
	return $size_list;
}

function wps_vc_template( ) {
	return get_template_directory() . '/inc/integrations/visual-composer/params/templates/wps_offset_tpl.php';	
}


/**
* Find file, check if is child theme, file is in child theme
*/
function get_wps_file_location($file = ''){

  $location = get_template_directory_uri().'/'.$file;  
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
 * @since 4.3
 *
 * @param $template
 * @param array $variables - passed variables to the template.
 *
 * @param bool $once
 *
 * @return mixed
 */
function wps_vc_include_template( $variables = array(), $once = false ) {
	is_array( $variables ) && extract( $variables );
	if ( $once ) {
		return require_once wps_vc_template();
	} else {
		return require wps_vc_template();
	}
}




/* Convert vc_col-sm-3 to 1/4
---------------------------------------------------------- */
/**
 * @param $width
 *
 * @since 4.2
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

/**
 * @param $width
 *
 * @since 4.2
 * @return bool|string
 */
function wps_wpb_translateColumnWidthToSpan( $width ) {
	preg_match( '/(\d+)\/(\d+)/', $width, $matches );

	if ( ! empty( $matches ) ) {
		$part_x = (int) $matches[1];
		$part_y = (int) $matches[2];
		if ( $part_x > 0 && $part_y > 0 ) {
			$value = ceil( $part_x / $part_y * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width = 'lap-and-up-' . $value .'/12';
			}
		}
	}

	return $width;
}