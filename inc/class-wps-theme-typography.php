<?php
/**
 *	Class to generate typography options
 *
 * @package wps_prime
 */

/**
 *  Class to generate a list of fonts (add/remove)
 *  We need the list to be accessible globally (Singleton approach)
 *
 * @example $myfont = wps_generateThemeFonts::getInstance();
 * @example $myfont->assFont('Open Sans', 'sans-serif;font-weight: 300', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,800&subset=latin,latin-ext');
 * @example  $myfontChild =wps_generateThemeFonts::getInstance();
 * @example $myfontChild ->removeFont('Open Sans');
 */

class wps_generateThemeFonts{

	private $fontList = array();	

	private static $instance;

	private function __construct(){	}

	/**
	* Use a static method and a static property to mediate object instantiation
	* The $instance property is private and static, so it cannot be accessed from outside the class. The
	* getInstance() method has access though. Because getInstance() is public and static, it can be called via
	* the class from anywhere in a script.
	*/
	public static function getInstance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new wps_generateThemeFonts();
		}
		return self::$instance;
	}

	/**
	 * Create font definition array
	 * @param string $fontName Then name of the font-family ex.'Raleway';
	 * @param string $fontStyle CSS default definition for selected font ex. 'sans-serif;font-weight: 300';
	 * @param string $fontLink Link to font ex. 'http://fonts.googleapis.com/css?family=Raleway:200,300,400,600,900&subset=latin,latin-ext';
	 *
	 * @return array
	 */
	public function addFont($fontName,$fontStyle,$fontLink){

		$font = array($fontName,$fontStyle,$fontLink);

		$this->fontList[] = $font;

		return $this->fontList;
	}

	/**
	* Funtion to remove a font from font definition array using font name
	* Run a foreach to search for font familiy name in a multi-array
	* If found unset the single font definition array from the multi-array
	* 
	* @param string $fontName Font family name ex. 'Raleway'
	* @example $myfont = themeFonts::getInstance(); $myfont->removeFont('Raleway');
	*/

	public function removeFont($fontName){

		$fonts = $this->fontList;
		
		foreach ($fonts as $key=>$singlefont){
		  if( in_array( $fontName, $singlefont ) ){
		  		unset($fonts[$key]);
		  }
		}
		/**
		* After remove array elements the array index start from 1 or 2 etc...
		* We have to reset the new array to start index from 0
		* 'array_values' - return all the values from the array and indexes
		*/
		$newfontList = array_values($fonts);

		$this->fontList = $newfontList;
	}

	public function returnFontList(){
		return $this->fontList;
	}

}
/**
 * Call theme font list
 *
 * @example $theme_fonts = new wps_themeFonts;
 * @example $list_fonts = $theme_fonts->getFonts();
 * @example $list_fonts = $theme_fonts->getFontsName();
 *
 */
class wps_themeFonts{	
	/**
	* Need to implement the following check before this class executes
	* @todo 'return !empty($this->fontList) ? $this->fontList : array('no fonts defined');' 
	*/

	private $fontList;

	public function __construct(){
		$this->fontList = wps_generateThemeFonts::getInstance()->returnFontList();
	}

	/**
	* Return a multidimensional array of fonts avaliable
	*/
	public function getFonts(){
		 return $this->fontList;
	}

	/**
	* Return a simple array of fonts names avaliable
	*/
	public function getFontsName(){

	 	foreach ($this->fontList as $key => $font ){
		 	/*
		 	 * $font[0] = Font Name
			 * $font[1] = font css style
			 * $font[2] = font http:// link
			 */
		 	$this->fontList[$key] = $font[0];
		 }
		return $this->fontList;
	}	
}