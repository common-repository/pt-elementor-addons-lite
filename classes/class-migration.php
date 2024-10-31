<?php
namespace Pt_Addons_Elementor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
class Migration {

	use \Pt_Addons_Elementor\Includes\Triat\Core;
	use \Pt_Addons_Elementor\Includes\Triat\Library;
	/**
	 * Plugin activation hook
	 *
	 * @since v1.0.0
	 */
	public function plugin_activation_hook() {
		// remove old cache files.
		$this->empty_dir( PT_ASSET_PATH );
		// save default values
		$this->set_default_values();
		// Redirect to options page.
		set_transient( 'pt_do_activation_redirect', true, 60 );
	}

	/**
	 * Plugin deactivation hook
	 *
	 * @since v1.0.0
	 */
	public function plugin_deactivation_hook() {
		$this->empty_dir( PT_ASSET_PATH );
	}

	/**
	 * Plugin upgrade hook
	 *
	 * @since v1.0.0
	 */
	public function plugin_upgrade_hook( $upgrader_object, $options ) {
		if ( $options['action'] == 'update' && $options['type'] == 'plugin' ) {
			if ( isset( $options['plugins'][ PT_PLUGIN_BASENAME ] ) ) {
				// remove old cache files
				$this->empty_dir( PT_ASSET_PATH );
			}
		}
	}
	/**
	 * Plugin migrator
	 *
	 * @since v1.0.0
	 */
	public function migrator() {
		// set current version to db.
		if ( get_option( 'pt_version' ) == false ) {
			update_option( 'pt_version', PT_PLUGIN_VERSION );
		}
	}
}
