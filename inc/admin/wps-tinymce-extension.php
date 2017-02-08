<?php
function wps_mce_custom_buttons($buttons) {

    array_unshift($buttons, 'styleselect');
    return $buttons;

}
add_filter('mce_buttons_2', 'wps_mce_custom_buttons');


if(!function_exists('wps_custom_editor_formats')){

	// Callback function to filter the MCE settings
	function wps_custom_editor_formats( $init_array ) {  
		// Define the style_formats array
		$style_formats = array(  
			// Each array child is a format with it's own settings
			
			array(
	            'title' => 'Font Size',
	                'items' => array(
	                	    array(  
								'title' => 'Text Small',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',  
								'classes' => 'u-text-small',							
							),
	        			 	array(  
								'title' => 'Text Large',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',   
								'classes' => 'u-text-large',								
							),
							array(  
								'title' => 'Text Huge',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',   
								'classes' => 'u-text-huge',   		
							),
							array(  
								'title' => 'Text H1',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h1',	
								
							),
	        			 	array(  
								'title' => 'Text H2',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h2',								
							),
							array(  
								'title' => 'Text H3',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h3',			
							),
							array(  
								'title' => 'Text H4',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h4',	
								
							),
	        			 	array(  
								'title' => 'Text H5',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h5',								
							),
							array(  
								'title' => 'Text H6',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-h6',			
							),
	                	)
	        ),
	        
	        array(
	            'title' => 'Text Align',
	                'items' => array(
	        			 	array(  
								'title' => 'Center',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-text-center',	
								
							),
							array(  
								'title' => 'Right',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-text-right',			
							),
							array(  
								'title' => 'Left',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-text-left',			
							),
	                	)
	        ),		
			array(
	            'title' => 'Text Colors',
	                'items' => array(
	                array(
	                    'title' => 'Color Primary',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                     
	                    'classes' => 'u-text-color-primary'
	                ),
	                array(
	                    'title' => 'Color Secondary',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                  
	                    'classes' => 'u-text-color-secondary'
	                ),
	                array(
	                    'title'=> 'Color Tertiary',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-color-tertiary'
	                ),
	                array(
	                    'title'=> 'Color White',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-color-invert'
	                ),
	                array(
	                    'title'=> 'Color Light',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-color-light'
	                ),
	            )
	        ),
	        array(
	            'title' => 'Font Weight',
	                'items' => array(
	                array(
	                    'title'=> 'Normal',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-normal'
	                ),
	                array(
	                    'title'=> 'Thinner',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-thinner'
	                ),
	                array(
	                    'title'=> 'Thin',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-text-thin'
	                ),
	                array(
	                    'title' => 'Bold',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                  
	                    'classes' => 'u-text-bold'
	                ),
	                array(
	                    'title' => 'Bolder',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                     
	                    'classes' => 'u-text-bolder'
	                )  
	            )
	        ),
			array(
	            'title' => 'Font Family',
	                'items' => array(
	                array(
	                    'title'=> 'Body font',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                   
	                    'classes'  => 'u-font-one'
	                ),	               
	                array(
	                    'title' => 'Heading font',
	                    'selector' => 'span, p, h1, h2, h3, h4, h5, h6',                     
	                    'classes' => 'u-font-two'
	                )  
	            )
	        ),
	        array(
	            'title' => 'Margins',
	                'items' => array(
	        			 	array(  
								'title' => 'Margin Bottom none',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-margin-bottom-none',	
								
							),
							array(  
								'title' => 'Margin Bottom half',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-margin-bottom-small',	
								
							),
							array(  
								'title' => 'Margin Bottom double',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-margin-bottom-large',			
							),
							array(  
								'title' => 'Margin Bottom triple',  
								'selector' => 'span, p, h1, h2, h3, h4, h5, h6',    
								'classes' => 'u-margin-bottom-huge',			
							),
	                	)
	        )
		);  
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	  
	} 
}
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'wps_custom_editor_formats' ); 