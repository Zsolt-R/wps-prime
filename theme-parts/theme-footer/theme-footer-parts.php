<?php
/**
 * Theme Footer Parts.
 *
 * Contains the parts whitch are added to the theme header area
 *
 * @package wps_prime
 */

if ( ! function_exists( 'footer_micro' ) ) {

	/**
	 * Site footer closing data line
	 */
	function footer_micro() {

		$date = wps_get_theme_option( 'company_launch_date' ) ? wps_get_theme_option( 'company_launch_date' ) : '';

		// If no option found set to Site Name!
		$name = wps_get_theme_option( 'company_name' ) ? wps_get_theme_option( 'company_name' ) : get_bloginfo( 'name' );

	?>
    
    <div class="page-micro">
        <div class="wrapper">
            <div class="layout layout--center">
                <div class="layout__item">
    				<small class="page-micro__copy txt--center"><?php echo esc_html( $name ); ?> <?php echo esc_html( $date ); ?> - <?php echo esc_html( date( 'Y' ) ); ?></small>
                </div>
            </div>
        </div><!-- wrapper -->
    </div><!-- page-micro -->
    
    	<?php
	}
}
