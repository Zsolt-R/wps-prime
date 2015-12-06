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
 */
$fonts = new wps_themeFonts;

piklist('field', array(
	'type' => 'select',
	'field' => 'main_font_family',
	'label' => 'Main Font Family',
	'description' => 'Choose from the drop-down.',
	'help' => 'Choose what font family to use as the main body font.',
	'attributes' => array(
	'class' => 'text',
	),
	'choices' => $fonts->getFontsName(),
));
