<?php
/**
* Theme Settings
*
* Title: Content Settings
* Setting: wps_prime_settings
* Tab: Content
*/

piklist('field', array(
 'type' => 'editor',
 'field' => 'global_content_end_area',
 'label' => 'Site global content', 
 'description' => 'Area visible on all the site pages. ( default location before the footer )',
 'help' => 'Default location at the bottom of the page just before the footer. Shortcode enabled',
 'options' => array (
     'media_buttons' => true,
     'teeny' => true,
     'media_buttons' => true,
     'tabindex' => '',
     'editor_css' => '',
     'editor_class' => '',
     'teeny' => false,
     'dfw' => false,
     'tinymce' => true,
     'quicktags' => true
    )
));