<?php
/**
 *  Typography sessings
 *
 * @package wps_prime
 *
 */

/////////////////////////////
//  Refactor Later to OOP
/////////////////////////////

//Custom Font
if( ! function_exists('base_typo') ){
    function base_typo(){
    
              //  'base_font_1' => 'Open Sans',
              //  'base_font_2' => 'Raleway',
              //  'base_font_3' => 'Merriweather',
              //  'base_font_4' => 'Lato',
              //  'base_font_5' => 'Roboto',
              //  'base_font_6' => 'Source Sans Pro',  
              //  'base_font_7' => 'PT Sans'    

                $fonts = array(

                    'base_font_1' => array( 
                                    'Open Sans',
                                    'sans-serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800&subset=latin,latin-ext'
                                    ),

                    'base_font_2' => array( 
                                    'Raleway',
                                    'sans-serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900&subset=latin,latin-ext'
                                    ),

                    'base_font_3' => array( 
                                    'Merriweather',
                                    'serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Merriweather:300,400,700,900&subset=latin,latin-ext'
                                    ),

                    'base_font_4' => array( 
                                    'Lato',
                                    'sans-serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&subset=latin,latin-ext'
                                    ),

                    'base_font_5' => array( 
                                    'Roboto',
                                    'sans-serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext'
                                    ),

                    'base_font_6' => array( 
                                    'Source Sans Pro',
                                    'sans-serif;font-weight: 300',
                                    'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&subset=latin,latin-ext'
                                    ),

                    'base_font_7' => array( 
                                    'PT Sans', 
                                    'sans-serif;font-weight: 400',
                                    'http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext'
                                    )
                    );

        return $fonts; 
    
    }
}

function add_theme_fonts(){

                
    
                $font_main = wps_get_theme_option('main_font_family') ? wps_get_theme_option('main_font_family') : '';
    
                
                $font_family_style_main = '';
                $font_link_main = '';

                $theme_fonts = base_typo();
    
                $reset = 0;
                $count = $reset;

                foreach ($theme_fonts as $font=>$screen){

                                        // $screen[0] = Font Name
                                        // $screen[1] = font css style
                                        // $screen[2] = font http:// link
                    
                                         if($font_main == $font){
            
                                             $font_link_main = '<link href="'. $screen[2] .'" rel="stylesheet" type="text/css"/>';
                                             $font_family_style_main = 'html{font-family:\''. $screen[0] . '\',' .  $screen[1] .';}';
                                  }
                                          
                    $count++;                       
            }
            $count = $reset;
    
    
            echo $font_link_main .'<style>'. $font_family_style_main .'</style>';
    
}
add_action( 'wp_head', 'add_theme_fonts' );