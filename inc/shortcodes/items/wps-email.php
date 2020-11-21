<?php

/**
 * 9 Main Email address
 * ex: [wps_main_email].
 */
function wps_main_email_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'class'     => '',
			'link'      => false,
			'secondary' => false,
		),
		$atts
	);

	$emails = array(
		get_option( 'wps_email_address' ),
		get_option( 'wps_email_address_second' ),
	);

	$email = $options['secondary'] ? $emails[1] : $emails[0];

	$email = $email ? $email : 'No email set';

	$output = '';

	$element_class = $options['class'] ? ' ' . 'class="' . $options['class'] . '"' : '';
	$output        = $options['link'] ? '<a class="wps-email-link" href="mailto:' . $email . '"' . $element_class . '>' . $email . '</a>' : $email;

	return $output;
}
