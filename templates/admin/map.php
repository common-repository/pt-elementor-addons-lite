<?php
	/** Get key */

	$mapkey = trim( get_site_option( 'pt_map_key' ) );
	/** Update key */

if ( ! empty( $_POST['pt_map_key'] ) ) {
	$key = $_POST['pt_map_key'];
	 update_option( 'pt_map_key', $key, true );
	?>
			 <script type="text/javascript">
				  window.location.href = "<?php echo admin_url( '/admin.php?page=pt-settings' ); ?>";
			</script>
		 <?php
}
?>
<div id="api-keys" class="pt-settings-tab pt-extensions-list">
	<div class="row">
		<div class="col-half">
		<div class="pt-admin-block-wrapper">
				<div class="pt-admin-block pt-admin-block-docs">
				<header class="pt-admin-block-header">
			 <form method="post" id="pp-settings-form" action="<?php echo admin_url( '/admin.php?page=pt-settings' ); ?>">
				  <div class="pad">
					  <h3 class="text-center">Google Maps Key<h3>
					   <p style="font-size: 14px;"><b><?php echo sprintf( __( 'Enter your <a href="%s" target="_blank">Google Maps key</a>', 'pt-elementor' ), 'https://developers.google.com/maps/documentation/javascript/get-api-key' ); ?></b></p>

						<table class="form-table">
							<tbody>
								<tr valign="top">
									<th scope="row" valign="top">
										<?php esc_html_e( 'Map Key', 'pt-elementor' ); ?>
									</th>
									<td>
										<input id="pt_map_key" name="pt_map_key" type="text" class="regular-text" value="<?php esc_attr_e( $mapkey ); ?>" />
									</td>
								</tr>
							</tbody>
						</table>
						<div class="pt-save-btn-wrap">
					<?php submit_button('Save Changes', 'button-primary btn-gradient'); ?>
					 </div>
				</div>
			</form>
			 </header>
		</div>
	</div>

		</div>
	</div>
</div>
