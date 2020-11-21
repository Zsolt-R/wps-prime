<?php
/**
 *  Class to generate typography options
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
class WpsGenerateThemeFonts {

	private $fontList = array();

	private static $instance;

	private function __construct(){ }

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
	public function add_font( $fontName, $fontStyle, $fontLink, $fontWeightBody = 'font-weight:300', $fontWeightHeading = 'font-weight:600', $variable = false ) {

		$font = array( $fontName, $fontStyle, $fontLink, $fontWeightBody, $fontWeightHeading, $variable );

		$font_id = strtolower( preg_replace( '/\s*/', '', $fontName ) );

		$this->fontList[ $font_id ] = $font;

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

		$this->fontList = $fonts;
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
class WpsGetThemeFonts {
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
		// Add empty element
		return $this->fontList;
	}

	/**
	 * Return a simple array of fonts names avaliable
	 */
	public function get_fonts_name() {

		foreach ( $this->fontList as $key => $font ) {
			/*
			  * $font[0] = Font Name / font family
			 * $font[1] = generic family ex. "serif", "sans-serif", "cursive" ...
			 * $font[2] = font http:// link
			 * $font[3] = default weight normal
			 * $font[4] = default weight bold
			 * $font[5] = variable font
			 */
			$this->fontNameList[ $key ] = $font[0] . ' (' . $font[1] . ')';
		}
		return $this->fontNameList;
	}

	public function get_theme_fonts_link() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main   = get_theme_mod( 'wps_main_font_family' );// Get selected font family option.
		$font_second = get_theme_mod( 'wps_secondary_font_family' ); // Get selected font family option.

		$subset = get_theme_mod( 'wps_font_family_subset' ) ? '&subset=latin,latin-ext' : '';

		// Prepare font
		$font_main_prep   = false;
		$font_second_prep = false;
		$display          = esc_attr( '&display=swap' );

		$font_main_prep = $theme_fonts[ $font_main ][2];

		// if no second font bail out early
		if ( ! get_theme_mod( 'wps_second_font_family_status' ) ) {
			return array( $font_main_prep );
		}

		/**
		 * Setup second font
		 */
		if ( $theme_fonts[ $font_second ][5] ) {
			// Check if main font is variable and prepare second font to be ready for concatenation
			// If the main font is not variable send the full url because we cannot concatenate api v1 with api v2
			if ( $theme_fonts[ $font_main ][5] ) {
				$font_second_prep = str_replace( 'https://fonts.googleapis.com/css2?family=', esc_attr( '&family=' ), $theme_fonts[ $font_second ][2] );
			} else {
				$font_second_prep = $theme_fonts[ $font_second ][2];
			}
		} else {
			if ( $theme_fonts[ $font_main ][5] ) {
				$font_second_prep = $theme_fonts[ $font_second ][2];
			} else {
				// First font is not variable prepare second font for api v1 type concatenation
				$font_second_prep = str_replace( 'https://fonts.googleapis.com/css?family=', '|', $theme_fonts[ $font_second ][2] );
			}
		}

		/**
		 * Prepare retun cases
		 */

		// If the same font is selected send it in one call
		if ( $font_main === $font_second ) {
			return array( $theme_fonts[ $font_main ][2] );
		}

		// Fonts are from the same api we can concatenate in one call
		// Fonts are NOT from the same api we send fonts url separately
		$output = array();

		if ( $theme_fonts[ $font_main ][5] === $theme_fonts[ $font_second ][5] ) {
			$font_string = sprintf(
				'%s%s%s%s',
				$font_main_prep,
				$font_second_prep,
				$theme_fonts[ $font_main ][5] ? '' : $subset, // Add subset if font api is v1
				$theme_fonts[ $font_main ][5] ? $display : '' // add font display to variable fonts
			);

			$output = array( $font_string );

		} else {
			// add font display to variable fonts
			$font_one = $theme_fonts[ $font_main ][5] ? $font_main_prep . $display : $font_main_prep;
			$font_two = $theme_fonts[ $font_second ][5] ? $font_second_prep . $display : $font_second_prep;

			 $output = array(
				 $font_one,
				 $font_two,
			 );

		}

		return $output;

	}

	public function get_theme_font_style() {

		$theme_fonts = $this->get_fonts(); // Get registered fonts.

		$font_main   = get_theme_mod( 'wps_main_font_family' );
		$font_second = get_theme_mod( 'wps_secondary_font_family' );

		$font_second_status = get_theme_mod( 'wps_second_font_family_status' ) ? true : false;

		$select_b = 'html,body,button,input,optgroup,select,textarea,.u-font-body';
		$select_h = 'h1,h2,h3,h4,h5,h6,.u-font-heading';
		$font_one = '.u-font-one';
		$font_two = '.u-font-two';

		$style           = '';
		$render_font_two = '';

		// If no secondary font.
		if ( ! $font_second_status ) {
			$style = $select_b . ',' . $select_h . '{font-family:\'' . esc_attr( $theme_fonts[ $font_main ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_main ][1] ) . ';' . $theme_fonts[ $font_main ][3] . ';}';

			// If font weight is not the same add heading font weight.
			$style .= $theme_fonts[ $font_main ][3] !== $theme_fonts[ $font_main ][4] ? $select_h . '{' . $theme_fonts[ $font_main ][4] . ';}' : '';
		}

		// If there is secondary font and it is the same as the body font, concatenate the body and heading selectors.
		if ( $font_second_status && $font_second === $font_main ) {

			$style = $select_b . ',' . $select_h . '{font-family:\'' . esc_attr( $theme_fonts[ $font_main ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_main ][1] ) . ';' . $theme_fonts[ $font_main ][3] . ';}';

			// If font weight is not the same add heading font weight.
			$style .= $theme_fonts[ $font_main ][3] !== $theme_fonts[ $font_main ][4] ? $select_h . '{' . $theme_fonts[ $font_main ][4] . ';}' : '';
		}

		// If there is secondary font and it is NOT the same as the body font.
		if ( $font_second_status && $font_second !== $font_main ) {

			$style = $select_b . '{font-family:\'' . esc_attr( $theme_fonts[ $font_main ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_main ][1] ) . ';' . $theme_fonts[ $font_main ][3] . ';}';

			$style .= $select_h . '{font-family:\'' . esc_attr( $theme_fonts[ $font_second ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_second ][1] ) . ';' . $theme_fonts[ $font_second ][4] . ';}';

			// Font Family selectors without font weight
			$style          .= $font_one . '{font-family:\'' . esc_attr( $theme_fonts[ $font_main ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_main ][1] ) . ';}';
			$style          .= $font_two . '{font-family:\'' . esc_attr( $theme_fonts[ $font_second ][0] ) . '\',' . esc_attr( $theme_fonts[ $font_second ][1] ) . ';}';
			$render_font_two = "--theme-font-two:'" . esc_attr( $theme_fonts[ $font_second ][0] ) . "';";
		}

		$style .= ":root{--theme-font-one:'" . esc_attr( $theme_fonts[ $font_main ][0] ) . "';" . $render_font_two . '}';

		return $style;
	}
}

// Wrapper function to init font administration
function wps_fonts_setup() {
	return WpsGenerateThemeFonts::get_instance();
}
