<?php
/**
 * Theme Settings
 *
 * Title: Theme Performance Tweaks
 * Setting: wps_prime_settings
 * Tab: Performance & Tweaks
 *
 * @package wps_prime
 */

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'wps_front_emoji_use',
	'value' => '',
	'label' => 'WordPress default emoji',
	'description' => 'Disable unused empji scripts from loading on front end',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
		'disable' => 'Disable',
	),
));

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'wps_front_dashicons_use',
	'value' => '',
	'label' => ' WordPress default dashicons',
	'description' => 'Disable unused dashicon scripts from loading on front end',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
		'disable' => 'Disable',
	),
));

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'wps_disable_comment_url',
	'value' => '',
	'label' => 'Comment form URL field',
	'description' => 'Disable the url field in the comment form section',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
		'disable' => 'Disable',
	),
));
