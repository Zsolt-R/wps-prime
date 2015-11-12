<?php
/**
 * Layout Template Classes setup.
 * Control Layout classes from one place
 * Setup theme layouts from here
 */


//  Header
//  Main

add_filter( 'wp_head', 'main_layout' );
add_filter( 'main_class', 'main_layout' );

//Sidebar
add_filter( 'sidebar_class', 'sidebar_layout' );

//Content
add_action( 'content_start' , 'page_top',0 );
add_action( 'content_end' , 'page_end',0 );


if(!function_exists('main_layout')){

    // id="primary"
    function main_layout($classes){
    
        global $wp_query, $wpdb;
    
        //Element to be removed
        $whitelist = array();
    
    
        // add 'class-name' to the $classes array
        $classes[] = 'layout__item';
        $classes[] = 'lap-and-up-7/10';
        $classes[] = 'content-area';
    
        // Whitelist Elements to be removed upon condition
        if(is_page_template('templates/template-full.php') || is_page_template('templates/template-cleanpage.php')){ 
            $whitelist[] = 'lap-and-up-7/10';
    
        }  
    
        //Remove Classes
        $classes = array_diff($classes, $whitelist);
    
        // return the $classes array
        return $classes;
    }
}

if(!function_exists('sidebar_layout')){
    
    // id="secondary"
    function sidebar_layout($classes){
    
        // add 'class-name' to the $classes array
        $classes[] = 'layout__item';
        $classes[] = 'lap-and-up-3/10';
        $classes[] = 'widget-area';
    
        // return the $classes array
        return $classes;
    }
}



if(!function_exists('page_top')){

    function page_top(){
        echo'<div class="wrapper"><div class="layout">';
    }

}
 
if(!function_exists('page_end')){ 

    function page_end(){
        echo '</div></div>';
    }

}

?>