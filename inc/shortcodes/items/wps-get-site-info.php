<?php

function wps_get_site_info_shortcode( $atts ) {

	$options = shortcode_atts(
		array(
			'field'  => 'name',
			'return' => true,
		),
		$atts,
		'wps_get_site_info'
	);

	$site_info = get_bloginfo( $options['field'] );

	if ( 'false' === $options['return'] ) {
		echo $site_info;
	} else {
		return $site_info;
	}
}
