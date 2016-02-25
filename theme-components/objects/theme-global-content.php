<?php
/**
 * Global Content
 *
 * @package wps_prime
 */
 

function theme_global_content_area(){
	$area = wps_get_theme_option('global_content_end_area');
    if($area){

    	if( '' !== $area){

    		echo '<section class="site-global-content">'. do_shortcode( $area ) .'</section>';

 		}

    }
}