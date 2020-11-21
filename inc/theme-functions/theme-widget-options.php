<?php
/**
 *  Widget Options
 *
 *  @package wps_prime
 */

/* Get option from settings */
if ( get_option( 'wps_theme_widget_class' ) ) {

    //Add input fields(priority 5, 3 parameters)
    add_action('in_widget_form', 'wps_in_widget_form',5,3);
    
    //Callback function for options update (priorität 5, 3 parameters)
    add_filter('widget_update_callback', 'wps_in_widget_form_update',5,3);

    //add class names (default priority, one parameter)
    add_filter('dynamic_sidebar_params', 'wps_dynamic_sidebar_params');

}

/**
* Widget options
* Ref: http://wordpress.stackexchange.com/questions/134539/how-to-add-custom-fields-to-settings-in-widget-options-for-all-registered-widget
*/
function wps_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','widget_class' => '') );
    if ( !isset($instance['widget_class']) )
        $instance['widget_class'] = null;
    ?>
    <p>
    <label for="<?php echo $t->get_field_id('widget_class'); ?>"><?php _e('Custom Widget CSS Class','wps-prime'); ?></label>
    <input type="text" name="<?php echo $t->get_field_name('widget_class'); ?>" id="<?php echo $t->get_field_id('widget_class'); ?>" value="<?php echo $instance['widget_class'];?>" class="widefat"/>
    </p>
    <?php
    $retrun = null;
    return array($t,$return,$instance);
}

function wps_in_widget_form_update($instance, $new_instance, $old_instance){
    $instance['widget_class'] = strip_tags($new_instance['widget_class']);
    return $instance;
}

function wps_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];

    if (isset($widget_opt[$widget_num]['widget_class'])){
  
            $widget_custom_class = $widget_opt[$widget_num]['widget_class'];
            $params[0]['before_widget'] = preg_replace('/class="/', 'class="'.$widget_custom_class.' ',  $params[0]['before_widget'], 1);
    }
    return $params;
}