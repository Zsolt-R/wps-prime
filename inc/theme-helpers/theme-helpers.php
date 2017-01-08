<?php
/**
 * Theme Helper functions
 *
 * @package WPS_Prime_2
 */

/**
 * Get theme options helper function
 *
 * @param string $option_name this keeps the name o the option called via wps_get_theme_option() function.
 * @return null
 */
function wps_get_theme_option( $option_name = null ) {

	$theme_options = get_option( 'wps_prime_settings' );
	$result = null;    

	if ( ! is_string( $option_name ) ) {

		return $result;

	} else {

		// Check if option is set!
		$result = isset( $theme_options[ $option_name ] ) ? $theme_options[ $option_name ] : null;

		// If there is only one option in the option-array
		// Extract the single option
		if(is_array($result) && count($result) === 1){
			$result = $result[0];
		}

	}
	return $result;
}

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 */


/**
 * Function to check if a particular file exists
 *
 * @link ref. http://stackoverflow.com/questions/7684771/how-check-if-file-exists-from-web-address-url-in-php
 * @param string $url file location.
 * @return bool
 */
function wps_file_exist( $file ) {

    $status = file_exists($file);

    return $status;
}


/**
* Helper function to check if we are in the child theme
*/
function is_child() {

	// Gets a WP_Theme object for the current theme.
	$current_theme = wp_get_theme();

    // For limitation of empty() write in var.
    $parent = $current_theme->parent();
    if ( ! empty( $parent ) ) {
        return TRUE;
    }
    return FALSE;
}

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
    $short_data .= '<ul>';
    $short_data .= '<li><strong>Site Title</strong>: '.get_bloginfo( 'name' ) .'</li>';  
    $short_data .= '<li><strong>Tagline</strong>: '.get_bloginfo( 'description' ) .'</li>';
    $short_data .= '<li><strong>SiteUrl</strong>: '.get_bloginfo('wpurl') .'</li>';
    $short_data .= '<li><strong>Stylesheet Directory</strong>: '.get_stylesheet_directory_uri() .'</li>';
    $short_data .= '<li><strong>Template directory</strong>: '.get_template_directory_uri() .'</li>';
    $short_data .= '<li><hr/></li>';
    $short_data .= '<li><strong>WordPress</strong>: '.get_bloginfo( 'version' ) .'</li>'; 
    $short_data .= '<li><strong>Active theme</strong>: '. $theme->get( 'Name' ) .' v.<strong>'.$theme->get( 'Version' ).'</strong></li>';
    $short_data .= '</ul>';

    // Current theme data.
    //Overview Part.
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

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function get_image_sizes() {
    global $_wp_additional_image_sizes;

    $sizes = array();
    $output = '';

    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
            );
        }
    }


     foreach ($sizes as $image_size => $image_size_data){


         $crop = '';  

         if(is_array($image_size_data['crop'])){
            $crop = 'true '.$image_size_data['crop'][0].'-'.$image_size_data['crop'][0];
         }else{
            $crop = $image_size_data['crop'] ? 'true auto' : 'false';
         }

     $output .= '<tr><td>'. $image_size .'</td><td> '. $image_size_data['width'] .'x'. $image_size_data['height'] .'</td><td>Croop: '. $crop .'</td></tr> '; 
    }

    return '<table>'. $output . '</table>';
}

/**
 * @param $width
 *
 * @since 1.4.4
 * @return bool|string
 */
function wps_wpb_translateColumnWidthToSpan( $width ) {
    preg_match( '/(\d+)\/(\d+)/', $width, $matches );

    if ( ! empty( $matches ) ) {
        $part_x = (int) $matches[1];
        $part_y = (int) $matches[2];
        if ( $part_x > 0 && $part_y > 0 ) {
            $value = ceil( $part_x / $part_y * 12 );
            if ( $value > 0 && $value <= 12 ) {
                $width = $value; // 'lap-and-up-' . $value .'/12';
            }
        }
    }

    return $width;
}

function wps_debug_options(){
    var_dump(get_option( 'wps_prime_settings' ));
}