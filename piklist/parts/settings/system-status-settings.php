<?php
/**
 * Theme Settings
 *
 * Title: System Status
 * Setting: wps_prime_settings
 * Tab: System Status
 *
 * @package wps_prime
 */

 /**
  * Get site info
  */
function get_development_data(){

    $current_theme = '';
    $parent_theme = '';
    $wp_data ='';
    $plugin_location = WP_PLUGIN_DIR.'/converter-modules/modules-init.php';  //Get Plugin Directory
    $theme = wp_get_theme();
    $is_child = is_child( $theme );

    $short_data = '<h3>Overview</h3>';

    // Site Data. 
    
    $short_data .= '<strong>Site Title</strong>: '.get_bloginfo( 'name' ) .'<br/>';  
    $short_data .= '<strong>Tagline</strong>: '.get_bloginfo( 'description' ) .'<br/>';
    $short_data .= '<strong>SiteUrl</strong>: '.get_bloginfo('wpurl') .'<br/>';
    $short_data .= '<strong>Stylesheet Directory</strong>: '.get_stylesheet_directory_uri() .'<br/>';
    $short_data .= '<strong>Template directory</strong>: '.get_template_directory_uri() .'<br/>';
    $short_data .= '<hr/>';
    $short_data .= '<strong>WordPress</strong>: '.get_bloginfo( 'version' ) .'<br/>';
  
    // Current theme data.

    //Overview Part.
    $short_data .= '<strong>Active theme</strong>: '. $theme->get( 'Name' ) .' v.<strong>'.$theme->get( 'Version' ).'</strong><br/>';

    $current_theme .= '<h3>Current Theme Data</h3>';
    $current_theme .= '<ul>';
    $current_theme .= '<li><strong>Theme name:</strong> '.$theme->get( 'Name' ).'</li>';
    $current_theme .= '<li><strong>Theme URI:</strong> '.$theme->get( 'ThemeURI' ).'</li>';
    $current_theme .= '<li><strong>Text Domain:</strong> '.$theme->get( 'TextDomain' ).'</li>';
    $current_theme .= '<li><strong>Description:</strong> '.$theme->get( 'Description' ).'</li>';
    $current_theme .= '<li><strong>Author:</strong> '.$theme->get( 'Author' ).'</li>'; 
    $current_theme .= '<li><strong>AuthorURI:</strong> '.$theme->get( 'AuthorURI' ).'</li>';
    $current_theme .= '<li><strong>Theme Version:</strong> '.$theme->get( 'Version' ).'</li>'; 
    $current_theme .= '</ul>';

    // Parent theme Data.
    if ( $is_child ) {

        $parent_t = $theme->parent();

        //Overview Part.
        $short_data .= '<strong>Parent Theme</strong>: '. $parent_t->get( 'Name' ) .' v.<strong>'.$parent_t->get( 'Version' ).'</strong><br/>';

        $parent_theme .= '<h3>Parent Theme Data</h3>';
        $parent_theme .= '<ul>';
        $parent_theme .= '<li><strong>Theme name:</strong> '.$parent_t->get( 'Name' ).'</li>';
        $parent_theme .= '<li><strong>Theme URI:</strong> '.$parent_t->get( 'ThemeURI' ).'</li>';
        $parent_theme .= '<li><strong>Text Domain:</strong> '.$parent_t->get( 'TextDomain' ).'</li>';
        $parent_theme .= '<li><strong>Description:</strong> '.$parent_t->get( 'Description' ).'</li>';
        $parent_theme .= '<li><strong>Author:</strong> '.$parent_t->get( 'Author' ).'</li>'; 
        $parent_theme .= '<li><strong>AuthorURI:</strong> '.$parent_t->get( 'AuthorURI' ).'</li>';
        $parent_theme .= '<li><strong>Theme Version:</strong> '.$parent_t->get( 'Version' ).'</li>'; 
        $parent_theme .= '</ul>';       
    }

	// Get wordpress data.   
    $wp_data .= '<h3>Wordpress Data</h3>';
    $wp_data .= '<ul>';
    $wp_data .= '<li><strong>Site Title</strong>'. get_bloginfo( 'name' ) .'</li>';
    $wp_data .= '</ul>';
    
    return $short_data.'<br/><hr/>'.$current_theme.$parent_theme;
}

// Check favicon existence.
$ico_path = get_stylesheet_directory() .'/favicon.ico';	
$favicon = false !== get_transient('site_favicon') ? get_transient('site_favicon') : '<span class="wp-ui-text-notification dashicons dashicons-warning"></span> No data';

$favicon_status = wps_file_exist( $ico_path ) ? '<span class="dashicons dashicons-yes wp-ui-text-highlight"></span>':'<span class="wp-ui-text-notification dashicons dashicons-warning"></span> Missing';

echo get_development_data();

echo 'Favicon in theme root: '.$favicon_status.' | transient: '. $favicon;

