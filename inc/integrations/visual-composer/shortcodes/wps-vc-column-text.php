<?php


function wps_vc_column_text_shortcode(){

    // Remove Default Parameters
    vc_remove_param('vc_column_text','css_animation');
	vc_remove_param('vc_column_text','css');

    vc_map_update('vc_column_text', array('html_template' => locate_template('vc_templates/vc_column_text.php')) );

}