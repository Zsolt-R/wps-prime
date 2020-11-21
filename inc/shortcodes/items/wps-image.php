<?php

/**
 * 5 Image.
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_image_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(
		array(
			'image_id'    => false,
			'image_size'  => 'full',
			'align'       => 'alignone',
			'margin'      => '',
			'padding'     => '',
			'link'        => false,    // deprecated
			'target'      => false,  // deprecated
			'class'       => '',
			'outer_class' => '',
			'anim_data'   => '',
			'url'         => '',
			'onclick'     => '',
		),
		$atts
	);

	$output    = '';
	$item_link = $item_target = $link = '';
	$has_link  = false;

	$anim = $options['anim_data'] ? ' data-animate="' . $options['anim_data'] . '"' : '';

	$holder_class = wps_getExtraClass(
		array(
			'c-image',
			$options['outer_class'],
		),
		true
	);
	if ( $options['image_id'] !== '' ) {
		$image_src   = wp_get_attachment_image_src( $options['image_id'], $options['image_size'], false );
		$image_alt   = get_post_meta( $options['image_id'], '_wp_attachment_image_alt', true );
		$image_title = get_the_title( $options['image_id'] );

		if ( $image_src ) {
			$image_class = wps_getExtraClass(
				array(
					'attachment_image',
					$image_src[1] > 400 ? 'attachment_image--large' : 'attachment_image--small',
					$options['padding'],
					$options['margin'],
					$options['align'],
					$options['class'],
				),
				true
			);

			$image = '<img class="' . $image_class . '" src="' . $image_src[0] . '" width="' . $image_src[1] . '" height="' . $image_src[2] . '" title="' . $image_title . '" alt="' . $image_alt . '">';
		}
	}

	$on_click = $options['onclick'] ? ' onclick="' . $options['onclick'] . '"' : '';

	// deprecated
	// TODO remove in time
	if ( $options['link'] && ! $options['url'] ) {
		$item_link   = $options['link'] ? ' href="' . $options['link'] . '"' : '';
		$item_target = $options['target'] ? ' target="' . $options['target'] . '"' : '';

		$has_link = true;
		$link     = $item_link . $item_target;
	}
	// end TODO

	$on_click = $options['onclick'] ? ' onclick="' . $options['onclick'] . '"' : '';

	if ( $options['url'] ) {
		$link_list = wps_generate_url_param_list( $options['url'] );
		if ( $link_list ) {
			$has_link = true;
			$link     = $link_list;
		}
	}

	if ( $has_link ) {
		$output = sprintf(
			'<a %1$s%2$s>%3$s</a>',
			$link,
			$on_click,
			$image
		);
	} else {
		$output = $image;
	}

	return '<div class="' . $holder_class . '"' . $anim . '>' . $output . '</div>';
}
