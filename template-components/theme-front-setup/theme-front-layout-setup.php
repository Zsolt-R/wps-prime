<?php
/**
 * Layout Template Classes setup.
 * Control Layout classes from one place
 * Setup theme layouts from here
 *
 * @package wps_prime
 */

/**
 * Header Class
 */
add_filter( 'wps_site_header_class', 'wps_site_main_header' );

if ( ! function_exists( 'wps_site_main_header' ) ) {

	/**
	 * Setting for theme header layout left area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_site_main_header( $classes ) {

		$classes[] = 'site-header';
		return $classes;
	}
}

/**
 * Header layout left Classes
 */
add_filter( 'wps_header_layout_left_class', 'wps_header_layout_left' );

if ( ! function_exists( 'wps_header_layout_left' ) ) {

	/**
	 * Setting for theme header layout left area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_header_layout_left( $classes ) {

		$classes[] = 'col';
		$classes[] = '_palm-8';
		$classes[] = '_lap-and-up-3';
		return $classes;
	}
}

/**
 * Header layout right Classes
 */
add_filter( 'wps_header_layout_right_class', 'wps_header_layout_right' );

if ( ! function_exists( 'wps_header_layout_right' ) ) {

	/**
	 * Setting for theme header layout right area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_header_layout_right( $classes ) {

		$classes[] = 'col';
		$classes[] = '_palm-4';
		$classes[] = '_lap-and-up-9';
		return $classes;
	}
}

/**
 * Main Content Area Classes
 */
add_filter( 'wps_main_content_class', 'wps_main_layout' );

if ( ! function_exists( 'wps_main_layout' ) ) {

	/**
	 * Setting for id="primary"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_main_layout( $classes ) {

		global $wp_query, $wpdb;

		// Element to be removed.
		$whitelist = array();

		// Add 'class-name' to the $classes array!
		$classes[] = 'col';
		$classes[] = '_lap-and-up-9';
		$classes[] = 'content-area';

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-nosidebar.php' ) || is_404() ) {
			$whitelist[] = '_lap-and-up-9';

		}
		if ( is_page_template( 'templates/template-fullwidth.php' ) || is_404() ) {

			$whitelist[] = '_lap-and-up-9';
			$whitelist[] = 'col';
		}

		// Remove Classes!
		$classes = array_diff( $classes, $whitelist );

		// Return the $classes array!
		return $classes;
	}
}

/**
 * Sidebar Area Classes
 */
add_filter( 'wps_main_sidebar_class', 'wps_sidebar_layout' );

if ( ! function_exists( 'wps_sidebar_layout' ) ) {

	/**
	 * Setting for id="secondary"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_sidebar_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'col';
		$classes[] = '_lap-and-up-3';
		$classes[] = 'widget-area';

		// Return the $classes array.
		return $classes;
	}
}

/**
*	Main Site Content class
*/
add_filter( 'wps_site_content_class', 'wps_site_content_layout' );

if ( ! function_exists( 'wps_site_content_layout' ) ) {

	/**
	 * Setting for id="content"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_site_content_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'site-content';

		// Return the $classes array.
		return $classes;
	}
}


/**
 * Theme footer default class
 */
add_filter( 'wps_site_footer_class','wps_site_footer_layout' );

if ( ! function_exists( 'wps_site_footer_layout' ) ) {

	/**
	 * Setting for id="colophon"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function wps_site_footer_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'site-footer';

		// Return the $classes array.
		return $classes;
	}
}


/**
 * Page html Wrappers
 */
/**
 * HTML Page Content Wrappers.
 */
add_action( 'wps_content_start' , 'wps_page_top',0 );

if ( ! function_exists( 'wps_page_top' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function wps_page_top() {

		global $wp_query, $wpdb;

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-fullwidth.php' ) || is_404() ) {
			return;
		} else {
			echo'<div class="o-wrapper"><div class="grid-1">';
		}
	}
}


/**
 * HTML Page Content Wrappers.
 */
add_action( 'wps_content_end' , 'wps_page_end',0 );

if ( ! function_exists( 'wps_page_end' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function wps_page_end() {

		global $wp_query, $wpdb;

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-fullwidth.php' ) || is_404() ) {
			return;
		} else {
			echo '</div></div>';
		}
	}
}


/**
 * Theme Main nav default class
 */
add_filter( 'wps_site_nav_class','wps_theme_main_nav_class' );

if ( ! function_exists( 'wps_theme_main_nav_class' ) ) {

	/**
	 * Theme Main nav default class
	 *
	 * @param array $classes Holds the classes of the main navigation.
	 * @return array
	 */
	function wps_theme_main_nav_class( $classes ) {
		$classes[] = 'site-nav';
		return $classes;
	}
}

/**
 * Theme Main mobile nav default class
 */
add_filter( 'wps_site_mobile_nav_class','wps_theme_main_mobile_nav_class' );

if ( ! function_exists( 'wps_theme_main_mobile_nav_class' ) ) {

	/**
	 * Theme Main nav default class
	 *
	 * @param array $classes Holds the classes of the main navigation.
	 * @return array
	 */
	function wps_theme_main_mobile_nav_class( $classes ) {
		$classes[] = 'site-nav-mobile';
		return $classes;
	}
}

/* Title Visibility */
add_filter('body_class','wps_theme_page_title_visibility_body_class');

if ( ! function_exists( 'wps_theme_page_title_visibility_body_class' ) ) {

	/**
	 * Function to add body class based on page meta option "Show/Hide" Title
	 *
	 * @param array $classes Holds all the body classes in an array.
	 */
	function wps_theme_page_title_visibility_body_class($classes){
		
				
		if(is_page()){
			$page_option = get_post_meta(get_the_ID(),'page_title_visibility',true);
		
				if(isset($page_option)){
		
						$class = $page_option  == 'hide' ?  'u-hide-title' : '';
		
			$classes[] = $class;
			
			}	
		}
		return $classes;
	}
	
}


/**
*	Add padding top Enable/Disable to main content area
*/

/* Add content margin setting */
add_filter('wps_site_content_class','wps_theme_page_margin_setup');
add_filter('wps_post_class','wps_theme_page_margin_setup');

if ( ! function_exists( 'wps_theme_page_margin_setup' ) ) {

	function wps_theme_page_margin_setup($classes){
						
		if(is_page()){
		
				$get_mt = get_post_meta(get_the_ID(),'page_margin_top_reset',true);
				$get_mb = get_post_meta(get_the_ID(),'page_margin_bottom_reset',true);
			
				if( 'reset' === $get_mt && 'reset' !== $get_mb){
					$classes[] = 'u-padding-top-none';
				}
		
				if( 'reset' === $get_mb && 'reset' !== $get_mt){
					$classes[] = 'u-padding-bottom-none';
				}
		
				if( 'reset' === $get_mt && 'reset' === $get_mb){
					$classes[] = 'u-padding-vertical-none';
				}
		}
	
		return $classes;
	}	
}

/**
*	Add spacing refference Enable/Disable to body
*	Body reference class for info purposes ( or you can hook into the class if needed )
*/

add_filter('body_class','wps_theme_page_spacing_body_classes');

if ( ! function_exists( 'wps_theme_page_spacing_body_classes' ) ) {

	function wps_theme_page_spacing_body_classes($classes){	
				
		if(is_page()){
		
				$get_mt = get_post_meta(get_the_ID(),'page_margin_top_reset',true);
				$get_mb = get_post_meta(get_the_ID(),'page_margin_bottom_reset',true);
			
				if( 'reset' === $get_mt && 'reset' !== $get_mb){
					$classes[] = 'reset-space-top';
				}
		
				if( 'reset' === $get_mb && 'reset' !== $get_mt){
					$classes[] = 'reset-space-bottom';
				}
		
				if( 'reset' === $get_mt && 'reset' === $get_mb){
					$classes[] = 'reset-space-vertical';
				}	
		}
	
		return $classes;
	}	
}