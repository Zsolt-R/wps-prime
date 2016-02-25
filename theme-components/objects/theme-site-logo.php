<?php
/**
 * Theme Site Logo.
 *
 * Contains the main site Logo
 *
 * @package wps_prime
 */

/**
 * Website logo function
 */
function theme_site_logo() {

	$get_image_id = wps_get_theme_option( 'company_logo' );

	$output = '';

	$default = 	'<a href="'. get_home_url() .'">'. get_bloginfo( 'name' ) .'</a><br/><small>'. get_bloginfo( 'description' ).'</small>';

		/**
			 * Logo HTML wrapper
			 */
		$output .= '<div data-ui-component="branding">';

	if ( wps_get_theme_option( 'logo_setting' ) === 'brand_title' ) {

		$output .= $default;

	} else {

		if ( $get_image_id ) {

			$image = wp_get_attachment_image_src( $get_image_id, 'full' );
			$logo = $image[0];

			$output .= '<a title="'. get_bloginfo( 'name' ) .'" href="'. get_home_url() .'">';
			$output .= '<img src="'. $logo .'" alt="'. get_bloginfo( 'name' ) .'" class="brand-logo"/>';
			$output .= '</a>';

		} else {

			$output .= $default;

		}
	}

	$output .= '</div>';

	$allowed_html  = array(
					    'a' => array(
					        'href' => array(),
					        'title' => array(),
					    ),
					    'h1' => array(),
					    'h2' => array(),
					    'span' => array(),
					    'small' => array(),
					    'br'=> array(),
					    'div' => array(),
					    'img' => array(
					    	'src' => array(),
					    	'alt' => array(),
					    	'class' => array(),
					    	),
					);

	echo wp_kses( $output,$allowed_html );
}
