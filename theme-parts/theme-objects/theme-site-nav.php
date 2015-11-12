<?php
/**
 * Theme Site Nav.
 *
 * Contains the main site Nav
 *
 * @package wps_prime
 */ 
if(!function_exists('theme_site_navigation')){

    function theme_site_navigation(){   

    $navigation = ''; // Default

    $navigation.=  '<nav id="site-navigation" class="'. main_nav_classes() .'" role="navigation" data-ui-component="site-main-navigation">';
    $navigation.=  '<button class="site-nav__toggler" data-ui-component="menu-toggle-button">'. __( 'Meniu', 'wps-prime' ) .'</button>';
    $navigation.=   wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'site-nav__list', 'walker' => new Theme_Menu_Object() ) );
    $navigation.=  '</nav><!-- #site-navigation -->';

    echo $navigation;

    }    
}
?>