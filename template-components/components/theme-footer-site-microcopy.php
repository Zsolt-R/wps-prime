<?php
/**
 * Theme Footer Micro Copy.
 *
 * Contains the parts whitch are added to the theme footer area
 *
 * @package wps_prime
 */

/**
 * Site footer closing data line
 */

if ( ! function_exists( 'wps_footer_micro' ) ) {

    /**
     * Site footer closing data line
     */
    function wps_footer_micro() {
    
        $date = wps_get_theme_option( 'company_launch_date' ) ? wps_get_theme_option( 'company_launch_date' ) : '';
    
        // If no option found set to Site Name!
        $name = wps_get_theme_option( 'company_name' ) ? wps_get_theme_option( 'company_name' ) : get_bloginfo( 'name' );
    
        $disclaimer = wps_get_theme_option('site_disclaimer') ? do_shortcode(wps_get_theme_option('site_disclaimer')).' -' :''; 
        ?>    
        <div class="page-micro">
            <div class="o-wrapper">
                <div class="page-micro__copy"><?php echo wp_kses_post( $disclaimer ); ?> <?php echo esc_html( $name ); ?> <?php echo esc_html( $date ); ?> - <?php echo esc_html( date( 'Y' ) ); ?></div>
            </div><!-- o-wrapper -->
        </div><!-- page-micro -->    
        <?php
    }
}
