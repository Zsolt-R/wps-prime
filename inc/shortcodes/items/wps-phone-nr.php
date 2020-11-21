<?php

/**
 * 8 Main Phone number
 * ex: [wps_main_phone_nr].
 */
function wps_main_phone_nr_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'class'     => '',
			'link'      => false,
			'secondary' => false,
		),
		$atts
	);

	$phone_numbers = array(
		get_option( 'wps_phone_nr' ),
		get_option( 'wps_phone_nr_second' ),
	);

	$phone_nr = $options['secondary'] ? $phone_numbers[1] : $phone_numbers[0];

	// Cleanup phone nr
	$phone = $phone_nr ? $phone_nr : 'No phone number set';
	$phone_formatted = preg_replace( '/\s+/', '', $phone );

	$output = '';

	$element_class = $options['class'] ? ' ' . 'class="' . $options['class'] . '"' : '';
	$output        = $options['link'] ? '<a class="wps-phone-link" href="tel:' . $phone_formatted . '"' . $element_class . '>' . $phone . '</a>' : $phone;

	return $output;
}
