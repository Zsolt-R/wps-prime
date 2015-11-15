<?php
/**
 *  Typography settings
 *
 * @package wps_prime
 * @todo Streamline using oophp keeping current structure
 */

/**
 * Here you can define default font definitions
 * Returns a multidimensional array holding typography font definitions
 * Used in function to generate font links that are added to the head
 * This definition list must reflect the options-set from the theme typography option selector
 * Can override in child theme
 */
if ( ! function_exists( 'base_typo' ) ) {

	/**
	 *	Typografy font definition list function
	 */
	function base_typo() {

		/**
		 * Typography definition list
		 *
		 * 'base_font_1' => 'Open Sans',
		 * 'base_font_2' => 'Raleway',
		 * 'base_font_3' => 'Merriweather',
		 * 'base_font_4' => 'Lato',
		 * 'base_font_5' => 'Roboto',
		 * 'base_font_6' => 'Source Sans Pro',
		 * 'base_font_7' => 'PT Sans'
		 *
		 * Definition format
		 *
		 * - Font Name
		 * - font css style
		 * - font http:// link
		 */
		$fonts = array(

			'base_font_1' => array(
							'Open Sans',
							'sans-serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800&subset=latin,latin-ext',
							),

			'base_font_2' => array(
							'Raleway',
							'sans-serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900&subset=latin,latin-ext',
							),

			'base_font_3' => array(
							'Merriweather',
							'serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Merriweather:300,400,700,900&subset=latin,latin-ext',
							),

			'base_font_4' => array(
							'Lato',
							'sans-serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&subset=latin,latin-ext',
							),

			'base_font_5' => array(
							'Roboto',
							'sans-serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900&subset=latin,latin-ext',
							),

			'base_font_6' => array(
							'Source Sans Pro',
							'sans-serif;font-weight: 300',
							'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&subset=latin,latin-ext',
							),

			'base_font_7' => array(
							'PT Sans',
							'sans-serif;font-weight: 400',
							'http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext',
							),
			);

		return $fonts;

	}
}

/**
 * Function that creates <link> and <style> font definitions to added to theme head
 * Calls the settings from theme options panel and maps with the multidimensional array served by base_typo();
 * Creates inline style for font adjustments
 *
 * @todo Stylesheets must be registered/enqueued via wp_enqueue_style
 */
function add_theme_fonts() {

	/**
	 * Setup defaults
	 */
	$font_main = wps_get_theme_option( 'main_font_family' ) ? wps_get_theme_option( 'main_font_family' ) : '';
	$theme_fonts = base_typo();

	foreach ( $theme_fonts as $font => $screen ) {

		if ( $font_main === $font ) {

			/**
			* Follow definition format
			* $screen[0] = Font Name
			* $screen[1] = font css style
			* $screen[2] = font http:// link
			*/

			echo '<link href="'. esc_url_raw( $screen[2] ) .'" rel="stylesheet" type="text/css"/>';
			echo '<style>html{font-family:\''. esc_attr( $screen[0] ) . '\',' .  esc_attr( $screen[1] ) .';}</style>';
		}
	}
}
add_action( 'wp_head', 'add_theme_fonts' );
