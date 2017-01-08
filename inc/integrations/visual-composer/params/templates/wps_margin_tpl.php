<?php
/**
* VC custom parameter display in the component options editor
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="wps_vc_margin" data-margin="true">
	<input name="<?php echo esc_attr( $settings['param_name'] ) ?>" class="wpb_vc_param_value <?php echo esc_attr( $settings['param_name'] ) ?>
	<?php echo esc_attr( $settings['type'] ) ?> '_field" type="hidden" value="<?php echo esc_attr( $value ) ?>"/>
	<table class="vc_table">
		<tr>
			<th>
				<?php _e( 'Margin Location', 'js_composer' ) ?>
			</th>
			<th>
				<?php _e( 'Margin Size', 'js_composer' ) ?>
			</th>
		</tr>
		<?php foreach ( $sizes as $key => $size ) :  ?>
			<tr>
				<td>
					<span title="<?php echo $size ?>"><?php echo $size ?></span>
				</td>
				<td>
					<?php echo $param->sizeControl( $key ) ?>
				</td>				
			</tr>
		<?php endforeach ?>
	</table>
</div>
<script type="text/javascript">
	window.WpsVcI8nMarginParam = <?php echo json_encode(array(
			'inherit' => __( 'Inherit: ', 'js_composer' ),
			'inherit_default' => __( 'Inherit from default', 'js_composer' ),
		)) ?>;
</script>
