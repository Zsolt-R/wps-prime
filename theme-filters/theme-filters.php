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

if(! function_exists('main_nav_classes') ){
    function main_nav_classes( $classes = array() ){
    
        $classes[] = 'site-nav';

        $classes = esc_attr( implode( ' ', apply_filters( 'nav_class', array_filter( $classes ) ) ) );
    
        return $classes;
    
    }
}