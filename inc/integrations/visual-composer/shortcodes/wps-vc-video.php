<?php
/*
* WPS Custom video options setup
*/

function wps_vc_video_shortcode(){

    // Remove Default Parameters
    vc_remove_param('vc_video','align');    
    vc_remove_param('vc_video','css');  
    vc_remove_param('vc_video','title');  
    vc_remove_param('vc_video','el_aspect');
    vc_remove_param('vc_video','el_width');
    vc_remove_param('vc_video','css_animation');
    // Add custom parameters
    $attributes = array();

    vc_add_params('vc_video',$attributes);
    vc_map_update('vc_video', array('html_template' => locate_template('vc_templates/vc_video.php')) );
}