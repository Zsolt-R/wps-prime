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

if ( ! function_exists( 'wps_theme_site_logo' ) ) {
function wps_theme_site_logo() {

	$output = '';
	$logo_img = wps_get_theme_option( 'company_logo' );

	/**
		 * Logo HTML wrapper
		 */
	$output .= '<div class="site-branding">';

	if ( !$logo_img ) {

			if ( is_front_page() && is_home() ){
			$html_tag = 'h1';
			}else{
				$html_tag = 'p';
			}

			$output .= '<'.$html_tag.' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'.$html_tag.'>';

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ){
					$output .= '<p class="site-description">'. $description.'</p>'; /* WPCS: xss ok. */
			}

		} else {	
				$output .= '<a title="'. get_bloginfo( 'name' ) .'" href="'. esc_url( home_url( '/' ) )  .'">';
				$output .= '<img src="'. $logo_img .'" alt="'. get_bloginfo( 'name' ) .'" class="brand-logo"/>';
				$output .= '</a>';
		}

		$output .= '</div><!-- .site-branding -->';

		echo $output;/* WPCS: xss ok. */
	}
}