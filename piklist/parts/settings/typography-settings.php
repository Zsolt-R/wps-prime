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
$fonts = new WpsGetThemeFonts;

piklist('field', array(
	'type' => 'select',
	'field' => 'main_font_family',
	'label' => 'Body Font',
	'description' => 'Choose from the drop-down.',
	'help' => 'Choose what font family to use as the main Body font.',
	'attributes' => array(
	'class' => 'text',
	),
	'choices' => $fonts->get_fonts_name(),
));

piklist('field', array(
	'type' => 'checkbox',
	'field' => 'font_family_subset',
	'value' => '', // Sets default to Option 2.
	'label' => 'Load fonts subset',
	'description' => 'Will load Latin and Latin-ext font subset (where avaliable). <span class="dashicons dashicons-warning"></span> This option has performance impact.',
	'attributes' => array(
	  'class' => 'text',
	),
	'choices' => array(
	  'load_subset' => 'Load font subset',
	),
));

piklist('field', array(
	'type' => 'radio',
	'field' => 'second_font_family_status',
	'value' => 'disabled', // Sets default to Option 2.
	'label' => 'Heading Font',
	'description' => 'Set different font family for headings. <span class="dashicons dashicons-warning"></span> This option has performance impact',
	'attributes' => array(
	  'class' => 'text',
	),
	'choices' => array(
	  'disabled' => 'Disable',
	  'enabled' => 'Enable',
	),
));


piklist('field', array(
	'type' => 'select',
	'field' => 'secondary_font_family',
	'label' => 'Heading Font',
	'description' => 'Choose from the drop-down.',
	'help' => 'Choose what font family to use as the main Heading font.',
	'conditions' => array(
	  		array(
	  		  'field' => 'second_font_family_status',
	  		  'value' => 'enabled',
	  		),
	),
	'attributes' => array(
			'class' => 'text',
		),
	'choices' => $fonts->get_fonts_name(),
));
