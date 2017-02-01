<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package wps_prime
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function wps_prime_jetpack_setup() 
{
    // Add theme support for Infinite Scroll.
    add_theme_support(
        'infinite-scroll', array(
        'container' => 'main',
        'render'    => 'wps_prime_infinite_scroll_render',
        'footer'    => 'page',
        ) 
    );

    // Add theme support for Responsive Videos.
    add_theme_support('jetpack-responsive-videos');
} // end function wps_prime_jetpack_setup
add_action('after_setup_theme', 'wps_prime_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function wps_prime_infinite_scroll_render() 
{
    while ( have_posts() ) {
        the_post();
        if (is_search() ) :
            get_template_part('template-parts/content', 'search');
        else :
            get_template_part('template-parts/content', get_post_format());
        endif;
    }
} // end function wps_prime_infinite_scroll_render
