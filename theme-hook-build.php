<?php
/*
*
*   HOOK OBJECTS TO THEME
*   used to add custom theme-parts via hooks
*/

/* BODY Hooks
*  - body_start
*    ....
*  - wp_footer
* 
*  HEADER Hooks layout
*
*   - theme_header
*       - layout_header__img
*       - layout_header__body
*
*  MAIN CONTENT Hooks layout
*
*   - before_content
*   - content_start
*   - content_end
* 
*  MAIN SIDEBAR Hooks layout
*
*
*  FOOTER Hooks layout
*
*   - footer_start
*   - footer_end
*/

$options = get_option('wps_prime_settings');

/*************************loc
        BODY
***************************/
// Add tracking Code to body
// add_action('body_start','add_tracking_code');


/*************************
        HEADER
**************************/

/* Hook Header Layout to theme header */
add_action( 'theme_header', 'layout_header',1 );


/* Hook theme Objects to Header Layouts
*  - Add site logo
*  - Add navigation
*/
/* Logo */
add_action( 'layout_header__img', 'theme_site_logo',10 );   

/* Hook Menu To layout_header__body
*  Modified by filter and removed on custom page template
*  See: add_filter('body_start','conditional_remove_site_nav');
*/
//DEFAULTS

add_action( 'layout_header__body', 'theme_site_navigation',10);



/* Add filter to remove the site-menu
 * filter must be executed before the nav hooks to template
 * Filter Hooked to body_start just before the layout_header__body fires
 *
 * Remove action if page template is 'templates/template-cleanpage.php'
 * add_filter('body_start','test') -> remove_action('layout_header__body','theme_site_navigation');
 * 
 * add_action( 'layout_header__body', 'theme_site_navigation');
 * 
 *
 */

add_filter('body_start','conditional_remove_site_nav');

function conditional_remove_site_nav(){

    global $post;   
    
    //Confitional Check
    if(!is_404() && ($post != null)){
            
        //Get current template
        $template = get_page_template_slug( $post->ID );
        
        // DEV Test
        //var_dump($template);
        //Check for template
        if( $template == 'templates/template-cleanpage.php' ){
           
            remove_action('layout_header__body','theme_site_navigation',1);
            remove_action('theme_header','theme_site_navigation',99);
            remove_action('theme_header','theme_site_navigation',0);
        }
    }

}

/*************************
        MAIN CONTENT
**************************/


/*************************
        MAIN SIDEBAR
**************************/

/*************************
        FOOTER
**************************/

/* Footer Parts */
add_action( 'footer_end','footer_micro', 69 );


?>
