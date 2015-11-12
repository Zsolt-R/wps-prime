<?php
/**
 * wps_prime Theme Options
 *
 * @package wps_prime
 */


add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
  function piklist_theme_setting_pages($pages)
  {
     $pages[] = array(
      'page_title' => __('Theme Settings','piklist')
      ,'menu_title' => __('Theme Settings', 'piklist')
      ,'menu' => 'admin.php' //Under Appearance menu
      ,'capability' => 'manage_options'
      ,'menu_slug' => 'theme_settings'
      ,'setting' => 'wps_prime_settings'
      ,'menu_icon' => 'dashicons-desktop'
      ,'page_icon' => 'dashicons-desktop'
      ,'single_line' => true
      ,'default_tab' => 'Basic'
      ,'save_text' => 'Save Settings'
    );
 
    return $pages;
  }


// Get theme options function

function wps_get_theme_option($option_name = null){ 

  $theme_options = get_option('wps_prime_settings');
  $result = null;

  if(!is_string($option_name)){

    return;

  }else{

  // check if option is set
  $result = isset($theme_options[$option_name]) ? $theme_options[$option_name] : null;

  }
  return $result;

}