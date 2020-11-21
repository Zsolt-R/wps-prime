<?php
/**
 * Theme Helper functions.
 */

// retrieves the attachment ID from the file URL
function wps_get_image_id( $image_url ) {
	$attachment = attachment_url_to_postid( $image_url );

	return $attachment;
}

/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features
 */

/**
 * Helper function to check if we are in the child theme.
 */
function is_child() {
	// Gets a WP_Theme object for the current theme.
	$current_theme = wp_get_theme();

	// For limitation of empty() write in var.
	$parent = $current_theme->parent();
	if ( ! empty( $parent ) ) {
		return true;
	}

	return false;
}

/**
 * Get site info.
 */
function get_development_data() {
	$current_theme   = '';
	$parent_theme    = '';
	$wp_data         = '';
	$plugin_location = WP_PLUGIN_DIR . '/converter-modules/modules-init.php';  // Get Plugin Directory
	$theme           = wp_get_theme();
	$is_child        = is_child( $theme );

	$short_data = '<span style="font-size:22px;font-weight:300;">Overview</span><br><br>';

	// Site Data.
	$short_data .= '<strong>Site Title</strong>: ' . get_bloginfo( 'name' ) . '<br>';
	$short_data .= '<strong>Tagline</strong>: ' . get_bloginfo( 'description' ) . '<br>';
	$short_data .= '<strong>SiteUrl</strong>: ' . site_url() . '<br>';
	$short_data .= '<strong>Stylesheet Directory</strong>: ' . get_stylesheet_directory_uri() . '<br>';
	$short_data .= '<strong>Template directory</strong>: ' . get_template_directory_uri() . '<br>';
	$short_data .= '<hr/>';
	$short_data .= '<strong>WordPress</strong>: ' . get_bloginfo( 'version' ) . '<br>';
	$short_data .= '<strong>Active theme</strong>: ' . $theme->get( 'Name' ) . ' v.<strong>' . $theme->get( 'Version' ) . '</strong><br><br>';

	// Current theme data.
	// Overview Part.
	$current_theme .= '<span style="font-size:22px;font-weight:300;">Current Theme Data</span><br><br>';
	$current_theme .= '<strong>Theme name:</strong> ' . $theme->get( 'Name' ) . '<br>';
	$current_theme .= '<strong>Theme URI:</strong> ' . $theme->get( 'ThemeURI' ) . '<br>';
	$current_theme .= '<strong>Text Domain:</strong> ' . $theme->get( 'TextDomain' ) . '<br>';
	$current_theme .= '<strong>Description:</strong> ' . $theme->get( 'Description' ) . '<br>';
	$current_theme .= '<strong>Author:</strong> ' . $theme->get( 'Author' ) . '<br>';
	$current_theme .= '<strong>AuthorURI:</strong> ' . $theme->get( 'AuthorURI' ) . '<br>';
	$current_theme .= '<strong>Theme Version:</strong> ' . $theme->get( 'Version' ) . '<br><br>';

	// Parent theme Data.
	if ( $is_child ) {
		$parent_t = $theme->parent();

		// Overview Part.
		$short_data .= '<strong>Parent Theme</strong>: ' . $parent_t->get( 'Name' ) . ' v.<strong>' . $parent_t->get( 'Version' ) . '</strong><br>';

		$parent_theme .= '<span style="font-size:22px;font-weight:300;">Parent Theme Data</span><br><br>';

		$parent_theme .= '<strong>Theme name:</strong> ' . $parent_t->get( 'Name' ) . '<br>';
		$parent_theme .= '<strong>Theme URI:</strong> ' . $parent_t->get( 'ThemeURI' ) . '<br>';
		$parent_theme .= '<strong>Text Domain:</strong> ' . $parent_t->get( 'TextDomain' ) . '<br>';
		$parent_theme .= '<strong>Description:</strong> ' . $parent_t->get( 'Description' ) . '<br>';
		$parent_theme .= '<strong>Author:</strong> ' . $parent_t->get( 'Author' ) . '<br>';
		$parent_theme .= '<strong>AuthorURI:</strong> ' . $parent_t->get( 'AuthorURI' ) . '<br>';
		$parent_theme .= '<strong>Theme Version:</strong> ' . $parent_t->get( 'Version' ) . '<br><br>';
	}

	// Get WordPress data.
	$wp_data .= '<span style="font-size:22px;font-weight:300;">WordPress Data</span><br>';

	$wp_data .= '<strong>Site Title</strong>' . get_bloginfo( 'name' ) . '<br>';

	return $short_data . '<br/><hr/>' . $current_theme . $parent_theme;
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 *
 * @uses   get_intermediate_image_sizes()
 *
 * @return array $sizes data for all currently-registered image sizes
 */
function get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes  = array();
	$output = '';

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	foreach ( $sizes as $image_size => $image_size_data ) {
		$crop = '';

		if ( is_array( $image_size_data['crop'] ) ) {
			$crop = 'true ' . $image_size_data['crop'][0] . '-' . $image_size_data['crop'][0];
		} else {
			$crop = $image_size_data['crop'] ? 'true auto' : 'false';
		}

		$output .= '<strong>' . $image_size . '</strong><br>' . $image_size_data['width'] . 'x' . $image_size_data['height'] . '<br>Croop: ' . $crop . '<hr/>';
	}

	return $output;
}

/**
 * @param $width
 *
 * @since 1.4.4
 *
 * @return bool|string
 */
function wps_wpb_translateColumnWidthToSpan( $width ) {
	 preg_match( '/(\d+)\/(\d+)/', $width, $matches );

	if ( ! empty( $matches ) ) {
		$part_x = (int) $matches[1];
		$part_y = (int) $matches[2];
		if ( $part_x > 0 && $part_y > 0 ) {

			// if is % based width="1/5" AKA 20%
			if ( $part_y === 5 ) {
				return $width;
			} else {
				$value = ceil( $part_x / $part_y * 12 );
				if ( $value > 0 && $value <= 12 ) {
					$width = $value; // 'lap-and-up-' . $value .'/12';
				}
			}
		}
	}

	return $width;
}

/**
 * Pharse string that is passed via wp built in url modal
 *
 * @return array
 */
function wps_parse_link_string( $value = false ) {
	// Bail out early
	if ( function_exists( 'vc_build_link' ) && $value ) {
		return vc_build_link( $value );
	}

	$result = array(
		'url'    => '',
		'title'  => '',
		'target' => '',
		'rel'    => '',
	);
	if ( $value ) {
		$params_pairs = explode( '|', $value );
		if ( ! empty( $params_pairs ) ) {
			foreach ( $params_pairs as $pair ) {
				$param = preg_split( '/\:/', $pair );
				if ( ! empty( $param[0] ) && isset( $param[1] ) ) {
					$result[ $param[0] ] = rawurldecode( $param[1] );
				}
			}
		}
	}
	return $result;
}

function wps_generate_link( $value ) {
	$link_array = wps_parse_link_string( $value );

	/**
	 * WPML helper / url converter
	 * get the post id and generate url from a post id
	 * if you duplicate a page in wpml in another language the get_permalink()
	 * will give us the link to the correspondent page in the selected language
	 */
	// TODO implement the wpml lang switch based on theme option to avoid extra check
	if ( function_exists( 'icl_object_id' ) ) {

		$params         = '';
		$url_to_process = $link_array['url'];

		// check if link has custom parameters
		$parameters = parse_url( $link_array['url'], PHP_URL_QUERY );

		if ( $parameters ) {
			$split_url      = strtok( $link_array['url'], '?' );
			$params         = '?' . $parameters;
			$url_to_process = $split_url;
		}

		$post_id = url_to_postid( $url_to_process );

		// Check if is custom link
		if ( $post_id !== 0 ) {
			$link_array['url'] = get_permalink( $post_id ) . $params;
		}
	}
	return $link_array;
}


function wps_generate_url_param_list( $url ) {
	$param_list = '';

	$link = wps_generate_link( $url );
	if ( ! $link['url'] ) {
		return false;
	}

	$param_list .= $link['url'] ? ' href="' . $link['url'] . '"' : '';

	$param_list .= $link['target'] ? ' target="' . $link['target'] . '"' : '';
	$param_list .= $link['title'] ? ' title="' . $link['title'] . '"' : '';
	$param_list .= $link['rel'] ? ' rel="' . $link['rel'] . '"' : '';

	return $param_list;
}
