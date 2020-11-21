<?php
/**
 * 11 Media Box
 * ex: [wps_mediabox image_id="1038" image_class="aligncenter img--round img--border" image_size="thumbnail" ico_class="fa fa-envelope fa-4x" class="bg--color-one p- txt--color-invert" type="flag" type_class="flag--responsive" title="Contact our experts today!" title_class="txt--bold mb-"]...content...[/wps_mediabox].
 *
 * @param array  $atts    an associative array of attributes, or an empty string if no attributes are given
 * @param string $content the enclosed content
 *
 * @return string
 */
function wps_media_box_shortcode( $atts, $content = null ) {
	$options = shortcode_atts(
		array(
			'image_id'          => '',
			'image_class'       => '',
			'image_size'        => 'full',
			'image_link'        => '',
			'image_full_height' => false,
			'icon_family'       => '',
			'icon_class'        => '',
			'icon_custom_class' => '',
			'icon_size'         => '',
			'icon_color'        => '',
			'type'              => '',
			'type_class'        => '',
			'type_spacing'      => false,
			'type_reverse'      => '',
			'type_img_class'    => '',
			'not_responsive'    => false,
			'txt_color'         => '',
			'margin'            => '',
			'class'             => '',
			'anim_data'         => '',
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
			'ico_type'                        => '',
			'icon_fontawesome'                => '',
			'icon_fontawesome_modern'         => '',
			'icon_fontawesome_modern_regular' => '',
			'icon_fontawesome_modern_light'   => '',
			'icon_fontawesome_modern_solid'   => '',
			'icon_fontawesome_modern_brands'  => '',
			'icon_typicons'                   => '',
			'icon_linecons'                   => '',
			'icon_woothemesecom'              => '',
		),
		$atts
	);

	// Extra icon class
	$iconCustomClass = wps_getExtraClass(
		array(
			! empty( $deprecated['ico_class'] ) ? $deprecated['ico_class'] : '',  // TODO remove in time
			! empty( $options['icon_custom_class'] ) ? $options['icon_custom_class'] : '',
		),
		true
	);

	$iconClass = wps_getExtraClass(
		array(
			! empty( $options['icon_class'] ) ? $options['icon_class'] : '',
		),
		true
	);

	// TODO remove in time
	// Check the regular, sometimes it can be decalred only as icon_fontawesome
	$regularIcon = $deprecated['icon_fontawesome'] ? $deprecated['icon_fontawesome'] : '';

	// TODO remove in time
	// If we have a regular icon declared switch to this argument
	if ( $deprecated['icon_fontawesome_modern_regular'] ) {
		$regularIcon = $deprecated['icon_fontawesome_modern_regular'];
	}

	$iconArgs = array(
		// TODO remove in time
		// Start backward compatibility
		'regular'     => $regularIcon,
		'light'       => $deprecated['icon_fontawesome_modern_light'],
		'solid'       => $deprecated['icon_fontawesome_modern_solid'],
		'brands'      => $deprecated['icon_fontawesome_modern_brands'],
		// End backward compatibility

		'class'       => $iconCustomClass,
		'icon_class'  => $iconClass,
		'size'        => $options['icon_size'],
		'color'       => $options['icon_color'],
		'icon_family' => $options['icon_family'],
		'wrap_class'  => 'ico-wrap--center',
	);

	$icon = wps_run_icon( $iconArgs );

	$output                    = '';
	$image                     = '';
	$mediabox_image_size_range = '';
	$image_full_height         = '';

	$content = do_shortcode( $content );

	$class = '';

	// Mediabox class.
	$class = wps_getExtraClass(
		array(
			$options['class'],
			$options['txt_color'],
			$options['margin'],
		)
	);

	$anim = $options['anim_data'] ? ' data-animate="' . $options['anim_data'] . '"' : '';

	if ( $options['image_id'] !== '' ) {

		 $type              = get_post_mime_type( $options['image_id'] );
		 $image_full_height = $options['image_full_height'] ? ' c-mediabox-has-full-height-image' : '';

		if ( 'image/svg+xml' === $type ) {
			$image = wp_get_attachment_image(
				$options['image_id'],
				$options['image_size'],
				false,
				array(
					'class' => $options['image_class'],
				)
			);
		} else {

			$image_src   = wp_get_attachment_image_src( $options['image_id'], $options['image_size'], false );
			$image_alt   = get_post_meta( $options['image_id'], '_wp_attachment_image_alt', true );
			$image_title = get_the_title( $options['image_id'] );

			if ( $image_src ) {

				// check the image size to add custom class that is used for correct styling
				$mediabox_image_size_range = $image_src[1] > 400 ? ' c-mediabox-image-large' : ' c-mediabox-image-small';
				$image_classes             = wps_getExtraClass(
					array(
						'attachment_image',
						$options['image_class'],
					),
					true
				);

				$image = '<img class="' . $image_classes . '" src="' . $image_src[0] . '" width="' . $image_src[1] . '" height="' . $image_src[2] . '" title="' . $image_title . '" alt="' . $image_alt . '">';
			}
		}
	}

	$symbol = $image ? $image : $icon;

	// Type.
	$type_class = wps_getExtraClass(
		array(
			$options['type'],
			$options['type_class'],
			$options['not_responsive'] ? $options['type'] . '--not-responsive' : $options['type'] . '--responsive',
			$options['type_reverse'] ? $options['type'] . '--reverse' : '',
			$options['type_spacing'] ? $options['type'] . $options['type_spacing'] : '',
		)
	);

	$type_spacing = $options['type_spacing'] ? wps_getExtraClass( array( 'c-mediabox' . $options['type_spacing'] ) ) : '';

	// Img link
	$img_link_start = $options['image_link'] ? '<a href="' . $options['image_link'] . '">' : '';
	$img_link_end   = $options['image_link'] ? '</a>' : '';

	$content = do_shortcode( $content );

	if ( class_exists( 'Vc_Manager' ) ) {
		$content = wpb_js_remove_wpautop( $content, true );
	}

	if ( $options['type'] !== '' ) {
		$output = "<div class=\"c-mediabox{$class}{$mediabox_image_size_range}{$image_full_height}\"{$anim}><div class=\"{$type_class}\"><div class=\"{$options['type']}__img\">{$img_link_start}{$symbol}{$img_link_end}</div><div class=\"{$options['type']}__body\">{$content}</div></div></div>";
	} else {
		$output = "<div class=\"c-mediabox{$class}{$type_spacing}{$mediabox_image_size_range}{$image_full_height}\"{$anim}><div class=\"c-mediabox__symbol\">{$img_link_start}{$symbol}{$img_link_end}</div>{$content}</div>";
	}

	return $output;
}
