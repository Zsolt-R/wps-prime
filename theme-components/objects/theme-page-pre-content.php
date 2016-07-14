<?php
/**
 * Global Content
 *
 * @package wps_prime
 */
if(!function_exists('theme_page_pre_content')){

	function theme_page_pre_content(){
	  if(is_page()){
	    $content = get_post_meta(get_the_ID(),'page_pre_content',true);
	    if('' !== $content){
	       echo '<section class="site-pre-content">'. do_shortcode( $content ) .'</section>';
	     }
	   }
	}
	
}