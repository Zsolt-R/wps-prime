<?php
/**
 * Theme reveal wps hooks on front end.
 *
 *
 * @package WPS_Prime_2
 */


function wps_debug_hook(){
  echo '<span style="position:absolute;z-index:999999;font-size:10px;background-color:#ff0000;color:#fff;padding:5px 10px;">'.current_filter().'</span>';
}

function wps_display_hooks_location(){ 

  if(!get_option('wps_display_wps_hooks'))
  return;

  $hooks = wps_get_hook_list();
  
  if(!$hooks)return;

  foreach ($hooks as $hook){
    add_action($hook,'wps_debug_hook');
  }
}
// If checked in theme options display hooks
add_action('wp_head','wps_display_hooks_location');