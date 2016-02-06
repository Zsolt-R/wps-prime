<?php
/**
 * Theme Site Filters.
 *
 * Contains the main site filter functions
 * Used to add dynamic classes to main-navigation sidebar and main content via filter functions
 *
 * @package wps_prime
 * @return string
 */

/**
 * Theme main navigation css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array|string $class CSS Classes for element.
 * @return string
 */
function main_nav_class( $class = '' ) {

	$classes = join( ' ', get_css_class( $class , 'main_nav_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Content layout css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array|string $class CSS Classes for element.
 * @return string
 */
function main_class( $class = '' ) {

	$classes = join( ' ', get_css_class( $class, 'main_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Sidebar layout css class function
 * Separates classes with a single space, collates classes for element
 *
 * @param array $class CSS Classes for element.
 */
function sidebar_class( $class = '' ) {

	$classes = join( ' ', get_css_class( $class, 'sidebar_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Header layout left side classes
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function header_layout_left_class( $class = '' ) {

	$classes = join( ' ', get_css_class( $class, 'header_layout_left_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Header layout right side classes
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function header_layout_right_class( $class = '' ) {

	$classes = join( ' ', get_css_class( $class, 'header_layout_right_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Site content class
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function site_content_class( $class = '' ) {
	$classes = join( ' ', get_css_class( $class, 'site_content_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Site footer class
 * Separates classes with a single space, collates classes for element
 * uses return and not echo because it is being called in an echo statement
 * and would result in double echo
 *
 * @param array $class CSS Classes for element.
 * @return string
 */
function site_footer_class( $class = '' ) {
	$classes = join( ' ', get_css_class( $class, 'site_footer_class' ) );

	return 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Create class array to be used as css classes for frontent components
 *
 * @param array  $class CSS Classes for element.
 * @param string $filter_name Filter function name.
 * @return array
 */
function get_css_class( $class = '', $filter_name = '' ) {

	$classes = array();

	if ( ! empty( $class ) && ! empty( $filter_function ) ) {
		if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class ); }
				$classes = array_merge( $classes, $class );
	} else {

			// Ensure that we always coerce class to being an array!
			$class = array();
	}

		 $classes = array_map( 'esc_attr', $classes );

		 /**
		  * Filter the list of CSS body classes for the current post or page.
		  *
		  * @since 2.8.0
		  *
		  * @param array  $classes An array of body classes.
		  * @param string $class   A comma-separated list of additional classes added to the body.
		  */
		 $classes = apply_filters( $filter_name , $classes, $class );

		 return array_unique( $classes );
}
