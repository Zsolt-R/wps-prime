<?php
/**
 * Defer or async this WordPress javascript snippet to load lastly for faster page load times
 *
 * @see http://www.growingwiththeweb.com/2014/02/async-vs-defer-attributes.html
 *
 * @link http://stackoverflow.com/questions/18944027/how-do-i-defer-or-async-this-wordpress-javascript-snippet-to-load-lastly-for-fas
 */

/**
 * Async
 *
 * @param string $url Link to script.
 * @return mixed|string
 */
function add_async_forscript( $url ) {

	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url; } else if ( is_admin() ) {
		return str_replace( '#asyncload', '', $url ); } else {
			return str_replace( '#asyncload', '', $url )."' async='async"; }
}
add_filter( 'clean_url', 'add_async_forscript', 11, 1 );

/**
 * Defer
 *
 * @param string $url Link to script.
 * @return mixed|string
 */
function add_defer_forscript( $url ) {

	if ( strpos( $url, '#deferload' ) === false ) {
		return $url; } else if ( is_admin() ) {
		return str_replace( '#deferload', '', $url ); } else {
			return str_replace( '#deferload', '', $url )."' defer='defer"; }
}
add_filter( 'clean_url','add_defer_forscript', 11, 1 );
