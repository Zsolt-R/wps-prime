<?php
/**
 * Theme Site Filters.
 *
 * Contains the main site filter functions
 *
 * @package wps_prime
 */ 

//Main Nav classes Filter function
//use filter functions to add custom classes to main nav wrapper
function main_nav_class( $class = '' ){   
    // Separates classes with a single space, collates classes for main element
    return 'class="' . join( ' ', get_main_nav_class( $class = '' ) ) . '"';

}

function get_main_nav_class( $class = '' ) {

    $classes = array();

     if ( ! empty( $class ) ) {
                 if ( !is_array( $class ) )
                         $class = preg_split( '#\s+#', $class );
                 $classes = array_merge( $classes, $class );
         } else {
                 // Ensure that we always coerce class to being an array.
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
 * Theme Layout Class Functions
 * Used to add dynamic classes to sidebar and main content true filter functions
 */

/* Classes Hooks */
function main_class( $class = '' ){   
    // Separates classes with a single space, collates classes for main element
    echo 'class="' . join( ' ', get_main_class( $class = '' ) ) . '"';

}

function sidebar_class( $class = '' ){   
    // Separates classes with a single space, collates classes for main element
    echo 'class="' . join( ' ', get_sidebar_class( $class = '' ) ) . '"';

}

function get_main_class( $class = '' ) {

    $classes = array();


     if ( ! empty( $class ) ) {
                 if ( !is_array( $class ) )
                         $class = preg_split( '#\s+#', $class );
                 $classes = array_merge( $classes, $class );
         } else {
                 // Ensure that we always coerce class to being an array.
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

function get_sidebar_class( $class = '' ) {

    $classes = array();


     if ( ! empty( $class ) ) {
                 if ( !is_array( $class ) )
                         $class = preg_split( '#\s+#', $class );
                 $classes = array_merge( $classes, $class );
         } else {
                 // Ensure that we always coerce class to being an array.
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