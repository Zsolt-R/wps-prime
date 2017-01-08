<?php
/**
* VC custom parameter to apply margin css classes used in components options
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @property mixed data
 */
class WPS_Vc_Margin {
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
		"u-margin-top"  =>  "Margin top",
		"u-margin-right"  =>  "Margin right",
		"u-margin-bottom"  =>  "Margin bottom",
		"u-margin-left"  =>  "Margin left",
		"u-margin-vertical"  =>  "Margin vertical (top bottom)",
		"u-margin-horizontal"  =>  "Margin horizontal (left right)",
		"u-margin"   =>  "Margin General"
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
			__( 'Reset', 'wps-prime' ) => '-none',
			__( 'Tiny', 'wps-prime' ) => '-tiny',
			__( 'Small', 'wps-prime' ) => '-small',
			__( 'Normal', 'wps-prime' ) => '',
			__( 'Large', 'wps-prime' ) => '-large',
			__( 'Larger', 'wps-prime' ) => '-huge',
		);
	}

	/**
	 * @return string
	 */
	public function render() {
		ob_start();
		wps_vc_margin_include_template( array(
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
		if ( 'lap-and-up' === $size ) {
			return '<span class="vc_description">' . __( 'Default value from width attribute', 'wps-prime' ) . '</span>';
		}
		$empty_label = '' === $size ? '' : __( 'None', 'wps-prime' );
		$output = '<select name="wps_vc_col_' . $size . '_size" class="wps_vc_margin_field" data-type="size-' . $size . '">' . '<option value="" style="color: #ccc;">' . $empty_label . '</option>';
		foreach ( $this->column_width_list as $label => $index ) {
			$value = $size . $index;
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
function wps_vc_margin_form_field( $settings, $value ) {
	$margin = new WPS_Vc_Margin( $settings, $value );

	return $margin->render();
}

/**
 *
 */
function wps_vc_load_margin_param() {
	vc_add_shortcode_param( 'wps_margin', 'wps_vc_margin_form_field', get_template_directory_uri() . '/inc/integrations/visual-composer/js/wps_margin.js' );
}

add_action( 'vc_load_default_params', 'wps_vc_load_margin_param' );