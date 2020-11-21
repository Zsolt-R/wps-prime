<?php
/**
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wps_prime_file_and_ext_webp', 10, 4 );
function wps_prime_file_and_ext_webp( $types, $file, $filename, $mimes ) {
	if ( false !== strpos( $filename, '.webp' ) ) {
		$types['ext']  = 'webp';
		$types['type'] = 'image/webp';
	}

	return $types;
}

/**
 * Adds webp filetype to allowed mimes
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wps_prime_mime_types_webp' );
function wps_prime_mime_types_webp( $mimes ) {
	$mimes['webp'] = 'image/webp';

	return $mimes;
}
