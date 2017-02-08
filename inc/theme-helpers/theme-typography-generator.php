<?php
/**
 *	Class to generate typography options
 *
 * @package wps_prime_2
 */

/**
 *  Class to generate a list of fonts (add/remove)
 *  We need the list to be accessible globally (Singleton approach)
 *
 * @example $myfont = WpsGenerateThemeFonts::get_instance();
 * @example $myfont->add_font('Open Sans', 'sans-serif', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800','font-weight: 300','font-weight: 600');
 * @example $myfontChild = WpsGenerateThemeFonts::get_instance();
 * @example $myfontChild ->remove_font('Open Sans');
 */
class WpsGenerateThemeFonts{

	private $fontList = array();

	private static $instance;

	private function __construct(){	}

	/**
	 * Use a static method and a static property to mediate object instantiation
	 * The $instance property is private and static, so it cannot be accessed from outside the class. The
	 * get_instance() method has access though. Because get_instance() is public and static, it can be called via
	 * the class from anywhere in a script.
	 */
	public static function get_instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new WpsGenerateThemeFonts();
		}
		return self::$instance;
	}

	/**
	 * Create font definition array
	 *
	 * @param string $fontName Then name of the font-family ex.'Raleway';
	 * @param string $fontStyle CSS default definition for selected font ex. 'sans-serif';
	 * @param string $fontLink Link to font ex. 'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900&subset=latin,latin-ext';
	 * @param string $fontWeightBody body-font-weight';
	 * @param string $fontWeightHeading heading-font-weight';
	 */
	public function add_font( $fontName, $fontStyle, $fontLink, $fontWeightBody = 'font-weight:300', $fontWeightHeading = 'font-weight:600' ) {

		$font = array( $fontName, $fontStyle, $fontLink, $fontWeightBody, $fontWeightHeading );

		$this->fontList[] = $font;

		return $this->fontList;
	}

	/**
	 * Funtion to remove a font from font definition array using font name
	 * Run a foreach to search for font familiy name in a multi-array
	 * If found unset the single font definition array from the multi-array
	 *
	 * @param string $fontName Font family name ex. 'Raleway'
	 * @example $myfont = WpsGenerateThemeFonts::get_instance(); $myfont->remove_font('Raleway');
	 */
	public function remove_font( $fontName ) {

		$fonts = $this->fontList;

		foreach ( $fonts as $key => $singlefont ) {
			if ( in_array( $fontName, $singlefont ) ) {
		  		unset( $fonts[ $key ] );
			}
		}
		/**
		* After remove array elements the array index start from 1 or 2 etc...
		* We have to reset the new array to start index from 0
		* 'array_values' - return all the values from the array and indexes
		*/
		$newfontList = array_values( $fonts );

		$this->fontList = $newfontList;
	}

	public function return_font_list() {
		return $this->fontList;
	}
}
/**
 * Call theme font list
 *
 * @example $theme_fonts = new WpsGetThemeFonts;
 * @example $list_fonts = $theme_fonts->get_fonts();
 * @example $list_fonts = $theme_fonts->get_fonts_name();
 */
class WpsGetThemeFonts{
	/**
	 * Need to implement the following check before this class executes
	 *
	 * @todo 'return !empty($this->fontList) ? $this->fontList : array('no fonts defined');'
	 */

	private $fontList;
	private $fontNameList;
	private $font_link;

	public function __construct() {
		$this->fontList = WpsGenerateThemeFonts::get_instance()->return_font_list();
	}

	/**
	 * Return a multidimensional array of fonts avaliable
	 */
	public function get_fonts() {
		 return $this->fontList;
	}

	/**
	 * Return a simple array of fonts names avaliable
	 */
	public function get_fonts_name() {

	 	foreach ( $this->fontList as $key => $font ) {
		 	/*
		 	 * $font[0] = Font Name
			 * $font[1] = font css style
			 * $font[2] = font http:// link
			 */
		 	$this->fontNameList[ $key ] = $font[0];
		}
		return $this->fontNameList;
	}


	public function get_theme_fonts_link() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main = wps_get_theme_option( 'main_font_family' );

		$subset = wps_get_theme_option( 'font_family_subset' ) ? '&subset=latin,latin-ext' : '';

		$font_second = '';
		$font_second_prep = '';

		$this->font_link = $theme_fonts[ $font_main ][2];

		if ( wps_get_theme_option( 'second_font_family_status' ) ) {
			$font_second = wps_get_theme_option( 'secondary_font_family' ); // Get selected font family option.
			$font_second_prep = str_replace( 'https://fonts.googleapis.com/css?family=','|',$theme_fonts[ $font_second ][2] );

		}

		if ( $font_main !== $font_second ) {

			$this->font_link = $theme_fonts[ $font_main ][2].$font_second_prep;
		}

		return $this->font_link.$subset;
	}

	public function get_theme_font_style() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main   = wps_get_theme_option( 'main_font_family' );
		$font_second = wps_get_theme_option( 'secondary_font_family' );

		$font_second_status = wps_get_theme_option( 'second_font_family_status' ) ? true : false;

		$select_b = 'html,body,.u-font-body';
		$select_h = 'h1,h2,h3,h4,h5,h6,.u-font-heading';
		$font_one =	'.u-font-one';
		$font_two = '.u-font-two';

		$style = '';

		// If no secondary font.
		if ( ! $font_second_status ) {
			$style = $select_b.','.$select_h.'{font-family:\''. esc_attr( $theme_fonts[ $font_main ][0] ) . '\';'. $theme_fonts[ $font_main ][3] .';}';

			// If font weight is not the same add heading font weight.
			$style .= $theme_fonts[ $font_main ][3] !== $theme_fonts[ $font_main ][4] ? $select_h.'{'.$theme_fonts[ $font_main ][4].';}' : '';
		}

		// If there is secondary font and it is the same as the body font, concatenate the body and heading selectors.
		if ( $font_second_status && $font_second === $font_main ) {

			$style = $select_b.','.$select_h.'{font-family:\''. esc_attr( $theme_fonts[ $font_main ][0] ) . '\';'. $theme_fonts[ $font_main ][3] .';}';

			// If font weight is not the same add heading font weight.
			$style .= $theme_fonts[ $font_main ][3] !== $theme_fonts[ $font_main ][4] ? $select_h.'{'.$theme_fonts[ $font_main ][4].';}' : '';
		}

		// If there is secondary font and it is NOT the same as the body font.
		if ( $font_second_status && $font_second !== $font_main ) {

			$style = $select_b.'{font-family:\''. esc_attr( $theme_fonts[ $font_main ][0] ) . '\';'. $theme_fonts[ $font_main ][3] .';}';

			$style .= $select_h.'{font-family:\''. esc_attr( $theme_fonts[ $font_second ][0] ) . '\';'. $theme_fonts[ $font_second ][4] .';}';

			//Font Family selectors without font weight
			$style .= $font_one.'{font-family:\''. esc_attr( $theme_fonts[ $font_main ][0] ) . '\';}';
			$style .= $font_two.'{font-family:\''. esc_attr( $theme_fonts[ $font_second ][0] ) . '\';}';
		}

		return $style;
	}
}

// Wrapper function to init font administration
function wps_fonts_setup(){
	return WpsGenerateThemeFonts::get_instance();
}