<?php
/**
* VC custom parameter display in the component options editor
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="wps_vc_column-offset" data-column-offset="true">
	<?php if ( '1' === vc_settings()->get( 'not_responsive_css' ) ) :  ?>
		<div class="wpb_alert wpb_content_element vc_alert_rounded wpb_alert-warning">
			<div class="messagebox_text">
				<p><?php printf( __( 'Responsive design settings are currently disabled. You can enable them in Visual Composer <a href="%s">settings page</a> by unchecking "Disable responsive content elements".', 'wps-prime' ), admin_url( 'admin.php?page=vc-general' ) ) ?></p>
			</div>
		</div>
	<?php endif ?>
	<input name="<?php echo esc_attr( $settings['param_name'] ) ?>" class="wpb_vc_param_value <?php echo esc_attr( $settings['param_name'] ) ?>
	<?php echo esc_attr( $settings['type'] ) ?> '_field" type="hidden" value="<?php echo esc_attr( $value ) ?>"/>
	<table class="vc_table wps_vc_column-offset-table">
		<tr>
			<th>
				<?php _e( 'Device', 'wps-prime' ) ?>
			</th>
			<th>
				<?php _e( 'Width', 'wps-prime' ) ?>
			</th>
			<th>
				<?php _e( 'Hide on device?', 'wps-prime' ) ?>
			</th>
		</tr>
		<?php foreach ( $sizes as $key => $size ) :  ?>
			<tr class="vc_size-<?php echo $key ?>">
				<td class="wps_vc_screen-size wps_vc_screen-size-<?php echo $key ?>">
					<span class="wps_vc_icon" title="<?php echo $size ?>"></span>
				</td>
				<td>
					<?php echo $param->sizeControl( $key ) ?>
				</td>
				<td>
					<label>
						<input type="checkbox" name="<?php echo str_replace('_','u-',$key); ?>-hide" value="yes"<?php echo in_array( str_replace('_','u-',$key) . '-hide', $data ) ? ' checked="true"' : '' ?>
						       class="wps_vc_column_offset_field">
					</label>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>
<script type="text/javascript">
	window.WpsVcI8nColumnOffsetParam = <?php echo json_encode(array(
			'inherit' => __( 'Inherit: ', 'wps-prime' ),
			'inherit_default' => __( 'Inherit from default', 'wps-prime' ),
		)) ?>;
</script>
