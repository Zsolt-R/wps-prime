<?php
/**
 * Theme Settings
 *
 * Title: Blog Settings
 * Setting: wps_prime_settings
 * Tab: Blog Settings
 * Flow: WPS Settings Workflow
 *
 * @package wps_prime
 */

piklist('field', array(
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'archive_article_display_mode',
	'value' => 'show_excerpt',
	'label' => 'Archive article display mode',
	'description' => 'Set article display type on archive pages (Blog / Archives)',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
	'show_full' => 'Full',
	'show_excerpt' => 'Excerpt',
	),
));

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'archive_article_feat_img',
	'value' => '',
	'label' => 'Archive article featured image',
	'description' => 'Set article featured image display on archive pages ( Blog / Archives) - default - \'none\'',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
	'show' => 'Show',
	),
));

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'article_meta_visibility',
	'value' => '',
	'label' => 'Article meta visibility settings',
	'description' => 'Set Article meta data visibility (ex. Posted on... / Posted in ...) show/hide. Default\'show\'',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
	'hide' => 'Hide',
	),
));

piklist('field', array(
	'type' => 'checkbox',
	'scope' => 'post_meta',
	'field' => 'u_time_visibility',
	'value' => '',
	'label' => 'Updated article timestamp visibility',
	'description' => 'Show article updated time. Default - \'hide\'',
	'attributes' => array(
	'class' => 'text',
	),'choices' => array(
	'show' => 'Show',
	),
));