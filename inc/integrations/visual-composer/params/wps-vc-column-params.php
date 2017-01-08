<?php
/**
* VC custom parameter for columns width setup
* Parameters follow the css architecture grid classes
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @property mixed data
 */
class WPS_Vc_Column_Offset {
	/**
	 * @var array
	 */
	protected $settings = array();
	/**
	 * @var string
	 */
	protected $value = '';
	/**
	 * @var array
	 */
	protected $size_types = array(
		//"desk"        =>  "Desktop screen and (min-width: 64em)",
		//"portable"    =>  "Portable screen and (max-width: 63.9375em)",
		//"lap-and-up"  =>  "Laptop and up screen and (min-width: 45em)",
		//"lap"         =>  "Laptop screen and (min-width: 45em) and (max-width: 63.9375em)",

		"_desktop-"    =>  "Desktop screen",
		"_lap-and-up-" =>  "Laptop and up screen",	
		"_lap-"        =>  "Laptop screen ",
		"_portable-"   =>  "Portable screen",
		"_palm-"       =>  "Mobile"	

	);
	/**
	 * @var array
	 */
	protected $column_width_list = array();

	/**
	 * @param $settings
	 * @param $value
	 */
	public function __construct( $settings, $value ) {
		$this->settings = $settings;
		$this->value = $value;

		$this->column_width_list = array(
			__( '1 column - 1/12', 'wps-prime' ) => '1',
			__( '2 columns - 1/6', 'wps-prime' ) => '2',
			__( '3 columns - 1/4', 'wps-prime' ) => '3',
			__( '4 columns - 1/3', 'wps-prime' ) => '4',
			__( '5 columns - 5/12', 'wps-prime' ) => '5',
			__( '6 columns - 1/2', 'wps-prime' ) => '6',
			__( '7 columns - 7/12', 'wps-prime' ) => '7',
			__( '8 columns - 2/3', 'wps-prime' ) => '8',
			__( '9 columns - 3/4', 'wps-prime' ) => '9',
			__( '10 columns - 5/6', 'wps-prime' ) => '10',
			__( '11 columns - 11/12', 'wps-prime' ) => '11',
			__( '12 columns - 1/1', 'wps-prime' ) => '12',
		);
	}

	/**
	 * @return string
	 */
	public function render() {
		ob_start();
		wps_vc_offset_include_template( array(
			'settings' => $this->settings,
			'value' => $this->value,
			'data' => $this->valueData(),
			'sizes' => $this->size_types,
			'param' => $this,
		) );

		return ob_get_clean();
	}

	/**
	 * @return array|mixed
	 */
	public function valueData() {
		if ( ! isset( $this->data ) ) {
			$this->data = preg_split( '/\s+/', $this->value );
		}

		return $this->data;
	}

	/**
	 * @param $size
	 *
	 * @return string
	 */
	public function sizeControl( $size ) {
	//	if ( '_sm-' === $size ) {
	//		return '<span class="vc_description">' . __( 'Default value from width attribute', 'wps-prime' ) . '</span>';
	//	}
		$empty_label = '_lap-and-up-' === $size ? __( 'Default value from width attribute', 'wps-prime' ) : __( 'Inherit from smaller', 'wps-prime' );
		$output = '<select name="wps_vc_col_' . $size . '_size" class="wps_vc_column_offset_field" data-type="size-' . $size . '">' . '<option value="" style="color: #ccc;">' . $empty_label . '</option>';
		foreach ( $this->column_width_list as $label => $index ) {
			$value = $size . $index ; //'u-'. $index .'/12'. $size;
			$output .= '<option value="' . $value . '"' . ( in_array( $value, $this->data ) ? ' selected="true"' : '' ) . '>' . $label . '</option>';
		}
		$output .= '</select>';

		return $output;
	}
}

/**
 * @param $settings
 * @param $value
 *
 * @return string
 */
function wps_vc_column_offset_form_field( $settings, $value ) {
	$column_offset = new WPS_Vc_Column_Offset( $settings, $value );

	return $column_offset->render();
}

/**
 *
 */
function wps_vc_load_column_offset_param() {
	vc_add_shortcode_param( 'wps_column_offset', 'wps_vc_column_offset_form_field', get_template_directory_uri() . '/inc/integrations/visual-composer/js/wps_width.js' );
}
//vc_add_shortcode_param( 'wps_column_offset', 'wps_vc_column_offset_form_field' );
add_action( 'vc_load_default_params', 'wps_vc_load_column_offset_param' );