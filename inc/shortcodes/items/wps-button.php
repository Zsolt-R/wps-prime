<?php
/**
 * Custom Buttons
 * ex:  [wps_button class="c-button--small,c-button--large,c-button--primary,c-button--secondary,c-button--tertiary" link="http://www...." label="button label"].
 *
 * @param array $atts an associative array of attributes, or an empty string if no attributes are given
 *
 * @return string
 */
function wps_buttons_shortcode( $atts ) {
	$options = shortcode_atts(
		array(
			'class'        => '',
			'label'        => 'Please add label',
			'link'         => '',       // TODO deprecated
			'post_id'      => false, // TODO deprecated
			'target'       => '',     // TODO deprecated
			'align'        => '',
			'shadow'       => false,
			'margin'       => '',
			'padding'      => '',
			'aspect'       => '',
			'size'         => '',
			'ghost'        => '',
			'color'        => '',
			'onclick'      => '',
			'icon_family'  => '',
			'icon_class'   => '',
			'ico_position' => 'end',
			'anim_data'    => '',
			'url'          => '',
		),
		$atts
	);

	/**
	 * Deprecated
	 * these arguments are kept for backward compatibility.
	 */
	// TODO remove in time
	$deprecated = shortcode_atts(
		array(
			'ico_class'                       => '',
			'icon_fontawesome_modern'         => '',
			'icon_fontawesome_modern_regular' => '',
			'icon_fontawesome_modern_light'   => '',
			'icon_fontawesome_modern_solid'   => '',
			'icon_fontawesome_modern_brands'  => '',
		),
		$atts
	);
	// end TODO

	$styleClass = wps_getExtraClass(
		array(
			'c-button',
			$options['class'],
			$options['align'],
			$options['margin'],
			$options['padding'],
			$options['color'],
			$options['ghost'] ? 'c-button--ghost' : '',
			$options['size'],
			$options['aspect'],
			$options['shadow'] ? 'c-button--has-shadow' : '',
		),
		true
	);

	$item_link = $item_descr = $item_target = '';

	$link     = ' href="#"';
	$has_link = false;

	// Extra icon class
	$class = wps_getExtraClass(
		array(
			'c-button__ico',
			// Set icon position css class
			$options['ico_position'] === 'end' ? 'c-button__ico--end' : 'c-button__ico--start',
		)
	);

	$iconArgs = array(

		// TODO remove in time
		'regular'     => $deprecated['icon_fontawesome_modern_regular'],
		'light'       => $deprecated['icon_fontawesome_modern_light'],
		'solid'       => $deprecated['icon_fontawesome_modern_solid'],
		'brands'      => $deprecated['icon_fontawesome_modern_brands'],
		// end TODO

		'class'       => $class,
		'icon_family' => $options['icon_family'],
		'icon_class'  => $options['icon_class'],
		'nowrap'      => true,
	);

	$btn_icon = wps_run_icon( $iconArgs );

	$anim      = $options['anim_data'] ? ' data-animate="' . $options['anim_data'] . '"' : '';
	$info_text = $options['label'] ? $options['label'] : '';
	$on_click  = $options['onclick'] ? ' onclick="' . $options['onclick'] . '"' : '';

	// Post ID overwrites custom link
	// deprecated
	// TODO remove in time
	if ( $options['link'] && ! $options['post_id'] ) {
		$item_link = $options['link'];
	} elseif ( $options['post_id'] ) {
		$item_link = get_permalink( $options['post_id'] ) ? get_permalink( $options['post_id'] ) : '#';
	}

	$item_target = $options['target'] ? ' target="' . $options['target'] . '"' : ''; // TODO remove in time / deprecated

	if ( $item_link && ! $options['url'] ) {
		$has_link = true;
		$link     = 'href="' . $item_link . '"' . $item_target;
	}
	// end TODO

	if ( $options['url'] ) {
		$link_list = wps_generate_url_param_list( $options['url'] );
		if ( $link_list ) {
			$has_link = true;
			$link     = $link_list;
		}
	}

	// Set icon position defaults
	$btnEnd   = $btn_icon;
	$btnStart = '';

	if ( 'end' !== $options['ico_position'] ) {
		$btnEnd   = '';
		$btnStart = $btn_icon;
	}

	$output = '<a class="' . $styleClass . '" ' . $link . $on_click . $anim . '>' . $btnStart . $info_text . $btnEnd . '</a>';

	if ( 'c-button--center' === $options['align'] ) {
		$output = '<div class="c-button-holder c-button-holder--center">' . $output . '</div>';
	}
	if ( 'c-button--right' === $options['align'] ) {
		$output = '<div class="c-button-holder c-button-holder--right">' . $output . '</div>';
	}

	return $output;
}
