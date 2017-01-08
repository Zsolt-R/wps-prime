<?php
/**
 * Woothemes e commerce icons from https://www.woothemes.com/2013/06/freepik-free-ecommerce-icons/
 *
 * @param $icons - taken from filter - vc_map param field settings['source'] provided icons (default empty array).
 * If array categorized it will auto-enable category dropdown
 *
 * @since 1.4
 * @return array - of icons for iconpicker, can be categorized, or not.
 * @ref https://wpbakery.atlassian.net/wiki/display/VC/Adding+Icons+to+vc_icon#suk=
 */
function wps_iconpicker_type_woothemesecom($icons){
	$i = 0;
	$iconlist = array();

	// Generate icon names as defined in css
	while($i  <= 249 ){

		$serial_number = str_pad($i, 3, '0', STR_PAD_LEFT);
		
		$iconlist[] = array( 'woo-ecom-icon e-commerce'.$serial_number => 'e-commerce'.$serial_number );

		$i++;
	}
	return array_merge( $icons, $iconlist );
}
// Register it in icon list editor of VC
add_filter( 'vc_iconpicker-type-woothemesecom', 'wps_iconpicker_type_woothemesecom' );