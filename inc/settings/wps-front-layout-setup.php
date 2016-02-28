<?php
/**
 * Layout Template Classes setup.
 * Control Layout classes from one place
 * Setup theme layouts from here
 *
 * @package wps_prime
 */

/**
 * HTML Page Content Wrappers.
 */
add_action( 'content_start' , 'page_top',0 );
add_action( 'content_end' , 'page_end',0 );

/**
 * Header
 */
add_filter( 'wp_head', 'main_layout' );

/**
 * Header Class
 */
add_filter( 'site_header_class', 'site_main_header' );

/**
 * Header layout left Classes
 */
add_filter( 'header_layout_left_class', 'header_layout_left' );

/**
 * Header layout right Classes
 */
add_filter( 'header_layout_right_class', 'header_layout_right' );

/**
*	Main Site Content class
*/
add_filter( 'site_content_class', 'site_content_layout' );

/**
 * Main Content Area Classes
 */
add_filter( 'main_class', 'main_layout' );

/**
 * Sidebar Area Classes
 */
add_filter( 'sidebar_class', 'sidebar_layout' );

/**
 * Theme Main nav default class
 */
add_filter( 'main_nav_class','theme_main_nav_class' );

/* Title Visibility */
add_filter('body_class','theme_page_title_visibility_body_class');


/**
 * Themefooter default class
 */
add_filter( 'site_footer_class','site_footer_layout' );

if ( ! function_exists( 'site_main_header' ) ) {

	/**
	 * Setting for theme header layout left area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function site_main_header( $classes ) {

		$classes[] = 'site-header';
		return $classes;
	}
}



if ( ! function_exists( 'header_layout_left' ) ) {

	/**
	 * Setting for theme header layout left area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function header_layout_left( $classes ) {

		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-3/10';
		return $classes;
	}
}

if ( ! function_exists( 'header_layout_right' ) ) {

	/**
	 * Setting for theme header layout right area
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function header_layout_right( $classes ) {

		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-7/10';
		return $classes;
	}
}


if ( ! function_exists( 'main_layout' ) ) {

	/**
	 * Setting for id="primary"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function main_layout( $classes ) {

		global $wp_query, $wpdb;

		// Element to be removed.
		$whitelist = array();

		// Add 'class-name' to the $classes array!
		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-7/10';
		$classes[] = 'content-area';

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-nosidebar.php' ) ) {
			$whitelist[] = 'lap-and-up-7/10';

		}
		if ( is_page_template( 'templates/template-fullwidth.php' ) ) {

			$whitelist[] = 'lap-and-up-7/10';
			$whitelist[] = 'layout__item';
		}

		// Remove Classes!
		$classes = array_diff( $classes, $whitelist );

		// Return the $classes array!
		return $classes;
	}
}

if ( ! function_exists( 'sidebar_layout' ) ) {

	/**
	 * Setting for id="secondary"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function sidebar_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'layout__item';
		$classes[] = 'lap-and-up-3/10';
		$classes[] = 'widget-area';

		// Return the $classes array.
		return $classes;
	}
}

if ( ! function_exists( 'site_content_layout' ) ) {

	/**
	 * Setting for id="content"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function site_content_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'site-content';

		// Return the $classes array.
		return $classes;
	}
}


if ( ! function_exists( 'site_footer_layout' ) ) {

	/**
	 * Setting for id="colophon"
	 *
	 * @param array $classes Storred css classes.
	 * @return array
	 */
	function site_footer_layout( $classes ) {

		// Add 'class-name' to the $classes array!
		$classes[] = 'site-footer';

		// Return the $classes array.
		return $classes;
	}
}


/**
 * Page html Wrappers
 */
if ( ! function_exists( 'page_top' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function page_top() {

		global $wp_query, $wpdb;

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-fullwidth.php' ) ) {
			return;
		} else {
			echo'<div class="wrapper"><div class="layout">';
		}
	}
}

if ( ! function_exists( 'page_end' ) ) {

	/**
	 * Add page wrapper html element
	 */
	function page_end() {

		global $wp_query, $wpdb;

		// Whitelist Elements to be removed upon condition!
		if ( is_page_template( 'templates/template-fullwidth.php' ) ) {
			return;
		} else {
			echo '</div></div>';
		}
	}
}

if ( ! function_exists( 'theme_main_nav_class' ) ) {

	/**
	 * Theme Main nav default class
	 *
	 * @param array $classes Holds the classes of the main navigation.
	 * @return array
	 */
	function theme_main_nav_class( $classes ) {
		$classes[] = 'site-nav';
		return $classes;
	}
}

if ( ! function_exists( 'theme_page_title_visibility_body_class' ) ) {

	/**
	 * Function to add body class based on page meta option "Show/Hide" Title
	 *
	 * @param array $classes Holds all the body classes in an array.
	 */
	function theme_page_title_visibility_body_class($classes){
		global $post;
				
		if(is_page()){
			$page_option = get_post_meta($post->ID,'page_title_visibility',true);
		
				if(isset($page_option)){
		
						$class = $page_option  == 'hide' ?  'hide-title' : '';
		
			$classes[] = $class;
			
			}	
		}
		return $classes;
	}
	
}
