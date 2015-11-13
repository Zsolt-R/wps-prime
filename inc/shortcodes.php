<?php
/**
 *
 *  Shortcodes
 *  Module
 *   
 *  Version: 1.0
 *  
 *  Author: Zsolt Revay
 */

/*************************************
*   WPS SHORTCODES
*
*
*  1  Layout Wrapper Markup - [layout class="lap-and-up..." wrapper="false"]
*  2  Layout Item Markup - [item class="lap-and-up..."] ...content... [/item]
*  3  Full Width Slider - [slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="converter_full"]
*  4  Custom Buttons - [cc_button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]
*  5  Media / Flag Object - media/flag(OOCSS Markup Items) - [object type="media/flag"] ... [/object]
*  6  Media / Flag Object inners -media/flag __img, __body (OOCSS Markup Items) - [object_item type="media__img/flag__img,media__img/media__body"]...[/object_item]
*  7  Shortcode for icons - [ico]fa fa-home[/ico]
*  8  Developr Data for icons - [dev_data]
*
*************************************/


// Helper Function
function is_child( $theme_data ) {
    // For limitation of empty() write in var
    $parent = $theme_data->parent();
    if ( ! empty( $parent ) ) {
        return TRUE;
    }
    return FALSE;
}

// End Helper Function

/* 1 */ // Remove wp version param from any enqueued scripts 
add_shortcode( 'layout','cc_custom_layout' );    //Backward compatibility   

/* 2 */ // Remove wp version param from any enqueued scripts   
add_shortcode( 'item','cc_custom_layout_inner_block' ); //Backward compatibility


/* 3 */ //Full Width Slider
add_shortcode( 'slider','cc_fw_slider' ); //Backward compatibility

/* 4 */ // Custom Buttons
add_shortcode('cc_button', 'cc_custom_buttons');

/* 5 */ // Custom Buttons
add_shortcode('object', 'cc_custom_css_objects');

/* 6 */ // Custom Buttons
add_shortcode('object_item', 'cc_custom_css_objects_item');

/* 7 */ // Shortcode for icons
add_shortcode( 'ico', 'ico_shortcode' );

/* 8 */ // Shortcode for dev Data
add_shortcode( 'dev_data', 'get_development_data' );

/////////////////////////////////
// LAYOUT SHORTCODES
////////////////////////////////////

/* 1 */ // Layout Item Markup
// ex. [layout class="lap-and-up..." wrapper="false"]
function cc_custom_layout( $atts, $content = null ){ 
    extract( shortcode_atts( array(
        'class' => '',
        'wrapper'=> false
    ), $atts ) );
    $class = $class ? ' '.$class : '';

    $layout = '<div class="layout'. $class .'">' . do_shortcode($content) . '</div>';

    $output = $wrapper ? '<div class="wrapper">'. $layout .'</div>' : $layout;

    return  $output;
}

/* 2 */ // Layout Wrapper Markup
// ex: [item class="lap-and-up..."] ...content... [/item]
function cc_custom_layout_inner_block( $atts, $content = null ){ 
    extract( shortcode_atts( array(
        'class' => '',       
    ), $atts ) ); 
    $class = $class ?  ' '.$class : '';   

    return '<div class="layout__item'. $class .'">' . do_shortcode($content) . '</div>';
}



/////////////////////////////////
// SLIDER
////////////////////////////////////


/* 3 */ // Full width slider 
// ex: [slider images="1,2,3...(image id's)" links="56,78,99...(page/post id's)" size="converter_full"]
function cc_fw_slider($atts){
    extract( shortcode_atts( array(
        'images' => '',
        'links' =>'',        
        'min' => '22.51em',
        'size' => 'converter_full',
        'size_mobile' => 'converter_medium'
    ), $atts ) );

    $constructor = 'Add image id\'s to shortcode to use slider ex. images="1,2,3,4..."';

    $image_list_constructor = '';
    $arrays = array();

    


    //Start ID Check

    //Check for Images
    if($images){  
        $images_id_array = explode(',', $images);
        $arrays = $images_id_array;
    }

    //Check for Links
    if($links){    
        $page_id_array = explode(',', $links);
        if( count($images_id_array) == count($page_id_array) ){
            $arrays = array_combine($images_id_array,$page_id_array);
        }
    }
      
    // If only image id's are avaliable    
    if($images && !$links){

        foreach($arrays as $image_id){

            $image_large = wp_get_attachment_image_src( $image_id , $size );
            $image_small = wp_get_attachment_image_src( $image_id , $size_mobile );

            //Check if image id is valid
            if($image_large != '' ){
                $slide_content =  '<picture><source media="(min-width:'. $min .')" srcset="'. $image_large[0] .'"><img src="'. $image_small[0] .'" class="aligncenter"/></picture>'; 
            }
            

            $image_list_constructor .= '<div class="swiper-slide">'. $slide_content .'</div>';
          
        }

    
    // If image Id's and Link id's
    }elseif($images && $links){

        
        // Check to have equal number of imageId's and linkId's
        if( count($images_id_array) == count($page_id_array) ){

             foreach($arrays as $image_id=>$page_links_id){

                $image_large = wp_get_attachment_image_src( $image_id , $size );
                $image_small = wp_get_attachment_image_src( $image_id , 'converter_medium' );

                //Setup Default slide content

                $slide_content = current_user_can('moderate_comments') ? 'Image ID- "'. $image_id.'" not valid' : '';


                //Check if image id is valid
                if($image_large != '' ){
                        $slide_content =  '<img src="'. $image_large[0] .'" srcset="'. $image_small[0] .' '.$image_small[1].'w, '. $image_large[0] .' 720w">'; 
                    }
            
                $image_list_constructor .= '<div class="swiper-slide"><a href="'. get_permalink($page_links_id)  .'">'. $slide_content .'</a></div>';
                
            } 
        }else{
            $image_list_constructor .= '<div class="swiper-slide">should have an equal number of elements check image ID\'s and Link Id\'s</div>';

        }   

    }

        if($images){

             $constructor = '<div class="swiper">        
                <div class="swiper-container">
                    <div class="swiper-wrapper">'. $image_list_constructor .'</div>                    
                
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div><div class="swiper-button-next"></div>
                        <!-- Add Scrollbar -->
                 <div class="swiper-scrollbar"></div>
             </div><!--swiper-container-->
            </div>';
        }

        return $constructor;
}

/////////////////////////////////
// Buttons
////////////////////////////////////


/* 4 */ // Custom Buttons
//ex:  [cc_button class="btn--small,btn--large,btn--primary,btn--secondary,btn--tertiary" link="http://www...." label="button label"]

function cc_custom_buttons($atts){
    extract( shortcode_atts( array(
        'class' => '',    
        'label' => 'Please add label',
        'link'  => ''   
    ), $atts ) ); 

    $styleClass = $class ? ' '.$class : '';
    $btnLabel = $label ? ' '.$label : '';
    $btnLink = $link ? $link : '#';

    $output = '<a class="btn'. $styleClass .'"" href="'.$btnLink.'">'. $btnLabel .'</a>';

    return $output;

}

/* 5 */ // Media / Flag Object (OOCSS Markup Items)
//ex:  [object type="media/flag"] ... [/object]

function cc_custom_css_objects($atts, $content = null){
    extract( shortcode_atts( array(
        'type' => ''
    ), $atts ) ); 

    $class = $type;

    $output = '<div class="'. $class .'">'. do_shortcode($content) .'</div>';

    return $output;

}

/* 6 */ // Media / Flag Object inners - __img, __body (OOCSS Markup Items) 
//ex: [object_item type="media__img/flag__img,media__img/media__body"]...[/object_item]

function cc_custom_css_objects_item($atts, $content = null){
    extract( shortcode_atts( array(
        'type' => ''
    ), $atts ) ); 

    $class = $type;

    $output = '<div class="'. $class .'">'. do_shortcode($content) .'</div>';

    return $output;

}

/* 7 */ // Shortcode for icons
//ex: [ico]fa fa-home[/ico] 

function ico_shortcode( $atts, $content ) {
    $atts = shortcode_atts(
        array(
            'class' => ''
        ), $atts );

    $class = $atts['class'] ? ''.$atts['class'] : $atts['class'];

    return '<i class="ico '. $content . ''. $class .'"></i>';
}

/* 8 */ // Get development data
//ex: [dev_data] 

function get_development_data(){

    $current_theme = '';
    $parent_theme = '';
    $wp_data ='';
    $converter_plugin = 'Converter Plugin not found';
    $plugin_location = WP_PLUGIN_DIR.'/converter-modules/modules-init.php';  //Get Plugin Directory
    $theme = wp_get_theme();
    $is_child = is_child( $theme );

    $short_data = '<h3>Overview</h3>';

    //Wp Data 
    
    $short_data .= '<strong>Site Title</strong>: '.get_bloginfo( 'name' ) .'<br/>';  
    $short_data .= '<strong>Tagline</strong>: '.get_bloginfo( 'description' ) .'<br/>';
    $short_data .= '<strong>SiteUrl</strong>: '.get_bloginfo('wpurl') .'<br/>';
    $short_data .= '<strong>Stylesheet Directory</strong>: '.get_stylesheet_directory_uri() .'<br/>';
    $short_data .= '<strong>Template directory</strong>: '.get_template_directory_uri() .'<br/>';
    $short_data .= '<hr/>';
    $short_data .= '<strong>WordPress</strong>: '.get_bloginfo( 'version' ) .'<br/>';


    //////////////////////    
    //Current theme data
    //////////////////////

    //Overview Part
    $short_data .= '<strong>C Theme</strong>: '. $theme->get( 'Name' ) .' v.<strong>'.$theme->get( 'Version' ).'</strong><br/>';

    $current_theme .= '<h3>Current Theme Data</h3>';
    $current_theme .= '<ul>';
    $current_theme .= '<li><strong>Theme name:</strong> '.$theme->get( 'Name' ).'</li>';
    $current_theme .= '<li><strong>Theme URI:</strong> '.$theme->get( 'ThemeURI' ).'</li>';
    $current_theme .= '<li><strong>Text Domain:</strong> '.$theme->get( 'TextDomain' ).'</li>';
    $current_theme .= '<li><strong>Description:</strong> '.$theme->get( 'Description' ).'</li>';
    $current_theme .= '<li><strong>Theme author:</strong> '.$theme->get( 'Author' ).'</li>'; 
    $current_theme .= '<li><strong>AuthorURI:</strong> '.$theme->get( 'AuthorURI' ).'</li>';
    $current_theme .= '<li><strong>The version of the theme:</strong> '.$theme->get( 'Version' ).'</li>'; 
    $current_theme .= '<li><strong>(Optional — used in a child theme) The folder name of the parent theme:</strong> '.$theme->get( 'Template' ).'</li>'; 
    $current_theme .= '<li><strong>If the theme is published:</strong> '.$theme->get( 'Status' ).'</li>';   
    $current_theme .= '</ul>';


    ///////////////////////
    //Parent theme Data
    //////////////////////

    if ( $is_child ) {

        $parent_t = $theme->parent();

        //Overview Part
        $short_data .= '<strong>C Parent</strong>: '. $parent_t->get( 'Name' ) .' v.<strong>'.$parent_t->get( 'Version' ).'</strong><br/>';

        $parent_theme .= '<h3>Parent Theme Data</h3>';
        $parent_theme .= '<ul>';
        $parent_theme .= '<li><strong>Theme name:</strong> '.$parent_t->get( 'Name' ).'</li>';
        $parent_theme .= '<li><strong>Theme name:</strong> '.$parent_t->get( 'Name' ).'</li>';
        $parent_theme .= '<li><strong>Theme URI:</strong> '.$parent_t->get( 'ThemeURI' ).'</li>';
        $parent_theme .= '<li><strong>Text Domain:</strong> '.$parent_t->get( 'TextDomain' ).'</li>';
        $parent_theme .= '<li><strong>Description:</strong> '.$parent_t->get( 'Description' ).'</li>';
        $parent_theme .= '<li><strong>Theme author:</strong> '.$parent_t->get( 'Author' ).'</li>'; 
        $parent_theme .= '<li><strong>AuthorURI:</strong> '.$parent_t->get( 'AuthorURI' ).'</li>';
        $parent_theme .= '<li><strong>The version of the theme:</strong> '.$parent_t->get( 'Version' ).'</li>'; 
        $parent_theme .= '<li><strong>(Optional — used in a child theme) The folder name of the parent theme:</strong> '.$parent_t->get( 'Template' ).'</li>'; 
        $parent_theme .= '<li><strong>If the theme is published:</strong> '.$parent_t->get( 'Status' ).'</li>';   
        $parent_theme .= '</ul>';       
    }

    //////////////////////
    //Plugin Data
    /////////////////////

    if (file_exists($plugin_location)) {

    $plugin = get_plugin_data($plugin_location);

    //Overview Part
    $short_data .= '<strong>C Plugin</strong>: '. $plugin['Name'] .' v.<strong>'.$plugin['Version'].'</strong><br/>';
   

    $converter_plugin = '<h3>Plugin Data</h3>';
    $converter_plugin .= '<ul>';

    foreach($plugin as $key=>$value){

        $converter_plugin .= '<li><strong>'.$key.':</strong> '.$value.'</li>';
    }  

    $converter_plugin .= '</ul>';
    }

    $wp_data .= '<h3>Wordpress Data</h3>';
    $wp_data .= '<ul>';
    $wp_data .= '<li><strong>Site Title</strong>'. get_bloginfo( 'name' ) .'</li>';
    $wp_data .= '</ul>';
    
    return $short_data.'<br/><hr/>'.$current_theme.$parent_theme.$converter_plugin;
}