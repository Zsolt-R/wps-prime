<?php
/**
 *	Typography Settings
 *
 *	Title: Typography Settings
 *	Setting: wps_prime_settings
 *	Tab: Typography
 *
 * 	@package wps_prime
 */

/**
 * Get typography settings from theme typography.php
 * Refactor Later
 */
$theme_fonts = base_typo();

$fontlist = array();

foreach ( $theme_fonts as $font => $screen ) {

	// $screen[0] = Font Name
	// $screen[1] = font css style
	// $screen[2] = font http:// link
	$fontlist[ $font ] = $screen[0];

}

// /var_dump($fontlist);
piklist('field', array(
	'type' => 'select',
	'field' => 'main_font_family',
	'label' => 'Main Font Family',
	'description' => 'Choose from the drop-down.',
	'help' => 'Choose what font family to use as the main body font.',
	'attributes' => array(
	'class' => 'text',
	),
	'choices' => $fontlist,
));
