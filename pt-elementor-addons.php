<?php
/**
 * Plugin Name: PT Addons for Elementor
 * Description: With PT Addons for Elementor, Create Awesome Website Designs quickly using a collection of cool widgets with unlimited customization options.
 * Plugin URI:  https://www.v2websolutions.com
 * Version:  2.3
 * Requires at least: 5.2  * Requires PHP: 7.2
 * @package PT Elementor Addons
 * Author:      V2 Web Solutions
 * Author URI:  http://www.v2websolutions.com/
 * Text Domain: pt-elementor-addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Defining plugin constants.
 *
 * @since v1.0.0
 */
define( 'PT_PLUGIN_FILE', __FILE__ );
define( 'PT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'PT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PT_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'PT_PLUGIN_VERSION', '1.0' );
define( 'PT_ASSET_PATH', wp_upload_dir()['basedir'] . DIRECTORY_SEPARATOR . 'pt-addons-elementor' );
define( 'PT_ASSET_URL', wp_upload_dir()['baseurl'] . '/pt-addons-elementor' );

/**
 * Including composer autoloader globally.
 *
 * @since v1.0.0
 */

require_once PT_PLUGIN_PATH . 'autoload.php';

/**
 * Initialize the plugin tracker
 *
 * @return void
 */

function appsero_init_tracker_pt_elementor_addons_lite() {

	if ( ! class_exists( 'Appsero\Client' ) ) {
		require_once __DIR__ . '/appsero/src/Client.php';
	}

	$client = new Appsero\Client( '6326e698-5580-4b5c-8334-fc55876dba6c', 'PT Elementor Addons Lite', __FILE__ );

	// Active insights
	$client->insights()->init();

	// Active automatic updater
	$client->updater();

}

appsero_init_tracker_pt_elementor_addons_lite();

/**
 * Run plugin after all others plugins
 *
 * @since v1.0.0
 */

add_action(
	'plugins_loaded',
	function () {
		\Pt_Addons_Elementor\Classes\Bootstrap::instance();
	}
);

/**
 * Plugin migrator
 *
 * @since v1.0.0
 */
add_action(
	'wp_loaded',
	function () {
		$migration = new \Pt_Addons_Elementor\Classes\Migration();
		$migration->migrator();
	}
);

/**
 * Activation hook
 *
 * @since v1.0.0
 */
register_activation_hook(
	__FILE__,
	function () {
		$migration = new \Pt_Addons_Elementor\Classes\Migration();
		$migration->plugin_activation_hook();
	}
);

/**
 * Deactivation hook
 *
 * @since v1.0.0
 */
register_deactivation_hook(
	__FILE__,
	function () {
		$migration = new \Pt_Addons_Elementor\Classes\Migration();
		$migration->plugin_deactivation_hook();
	}
);

/**
 * Upgrade hook
 *
 * @since v1.0.0
 */
add_action(
	'upgrader_process_complete',
	function( $upgrader_object, $options ) {
		$migration = new \Pt_Addons_Elementor\Classes\Migration();
		$migration->plugin_upgrade_hook( $upgrader_object, $options );
	},
	10,
	2
);


function my_plugin_editor_styles() {

	wp_register_style( 'info-circle-style-1', plugins_url( 'assets/front-end/css/info-circle/index.css ', __FILE__ ) );
// 	wp_register_style( 'editor-style-2', plugins_url( 'assets/css/editor-style-2.css', __FILE__ ), [ 'external-framework' ] );
// 	wp_register_style( 'external-framework', plugins_url( 'assets/css/libs/external-framework.css', __FILE__ ) );

	wp_enqueue_style( 'info-circle-style-1' );


}
add_action( 'elementor/editor/before_enqueue_styles', 'my_plugin_editor_styles' );
