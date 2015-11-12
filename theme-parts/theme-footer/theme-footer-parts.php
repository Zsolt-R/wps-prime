<?php
/**
 * Theme Footer Parts.
 *
 * Contains the parts whitch are added to the theme header area
 *
 * @package wps_prime
 */  

if(!function_exists('footer_micro')){
    function footer_micro(){
    

    $date = wps_get_theme_option('company_launch_date') ? wps_get_theme_option('company_launch_date') : '';
    //var_dump($date);
    // If no option found set to Site Name
    $name =   wps_get_theme_option('company_name') ? wps_get_theme_option('company_name') : get_bloginfo( 'name' );
    
    ?>
    
    <div class="page-micro">
    	<div class="wrapper">
    		<div class="layout layout--center">
    			<div class="layout__item">
    				<small class="page-micro__copy txt--center"><?php echo $name; ?> <?php echo $date; ?> - <?php echo date('Y'); ?></small>
    			</div>
    		</div>
    	</div><!-- wrapper -->
    </div><!-- page-micro -->
    
    	<?php
    	}
}
?>