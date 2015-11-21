<?php
/**
 * Theme Site Filters.
 *
 * Contains the main site filter functions
 * Used to add dynamic classes to main-navigation sidebar and main content via filter functions
 *
 * @package wps_prime
 */

/**
 * Theme main navigation css class function
 * Separates classes with a single space, collates classes for element
 * @param array $class CSS Classes for element.
 * @return string
 */
function main_nav_class( $class = '' ) {

	$classes = get_main_nav_class( $class );

	echo 'class="' . join( ' ', $classes ) . '"';
}

/**
 * Theme Main Content layout css class function
 * Separates classes with a single space, collates classes for element
 * @param array $class CSS Classes for element.
 */
function main_class( $class = '' ) {

	$classes = join( ' ', get_main_class( $class ) );

	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Theme Main Sidebar layout css class function
 * Separates classes with a single space, collates classes for element
 * @param array $class CSS Classes for element.
 */
function sidebar_class( $class = '' ) {

	$classes = join( ' ', get_sidebar_class( $class ) );

	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Create class array to be used as css classes on main navigation
 * @param array $class CSS Classes for element.
 * @return array
 */
function get_main_nav_class( $class = '' ) {

	$classes = array();

	if ( ! empty( $class ) ) {
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
		 $classes = apply_filters( 'main_nav_class', $classes, $class );

		 return array_unique( $classes );
}


/**
 * Create class array to be used as css classes for main content area
 * @param array $class CSS Classes for element.
 * @return array
 */
function get_main_class( $class = '' ) {

	$classes = array();

	if ( ! empty( $class ) ) {
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
		 $classes = apply_filters( 'main_class', $classes, $class );

		 return array_unique( $classes );
}

/**
 * Create class array to be used as css classes for main sidebar
 * @param array $class CSS Classes for element.
 * @return array
 */
function get_sidebar_class( $class = '' ) {

	$classes = array();

	if ( ! empty( $class ) ) {
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
		 $classes = apply_filters( 'sidebar_class', $classes, $class );

		 return array_unique( $classes );
}
