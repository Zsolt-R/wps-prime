<?php
/**
 * Theme Header Parts.
 *
 * Contains the parts whitch are added to the theme header area
 *
 * @package wps_prime
 */

//Site header Layout
function layout_header(){ ?>
<?php 

//if hook doesn't has action hide the html 
if(has_action('layout_header__img') == true){ 

	echo '<div class="layout__item lap-and-up-3/10">';
			layout_header__img(); 
	echo '</div>';

} 

if(has_action('layout_header__body') == true){
	
	echo '<div class="layout__item lap-and-up-7/10">';
			layout_header__body();
	echo '</div>';

	}  
}