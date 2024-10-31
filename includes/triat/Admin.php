<?php

namespace Pt_Addons_Elementor\Includes\Triat;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
/**  Exit if accessed directly */
use Pt_Addons_Elementor\Classes\PT_Notice;
trait Admin {
	/**
	 * Create an admin menu.
	 *
	 * @since v1.0.0
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'PT Elementor', 'PT Elementor' ),
			__( 'PT Elementor', 'pt-addons-elementor' ),
			'manage_options',
			'pt-settings',
			[ $this, 'pt_admin_settings_page' ],
			$this->safe_protocol( PT_PLUGIN_URL . '/assets/admin/images/pt-logo.png' ),
			'58.6'
		);
	}

	/**
	 * Loading all pt scripts admin_enqueue_scripts
	 *
	 * @param  mixed $hook
	 *
	 * @return void
	 * @since v1.0.0
	 */
	public function admin_enqueue_scripts( $hook ) {
		wp_enqueue_style( 'pt_addons_elementor-notice-css', PT_PLUGIN_URL . '/assets/admin/css/notice.css', false, PT_PLUGIN_VERSION );
		if ( isset( $hook ) && $hook == 'toplevel_page_pt-settings' ) {
			wp_enqueue_style( 'pt_addons_elementor-admin-css', PT_PLUGIN_URL . '/assets/admin/css/admin.css', false, PT_PLUGIN_VERSION );
			if ( $this->pro_enabled ) {
				wp_enqueue_style( 'pt_pro-admin-css', PT_PRO_PLUGIN_URL . '/assets/admin/css/admin.css', false, PT_PRO_PLUGIN_VERSION );
			}
			wp_enqueue_style( 'sweetalert2-css', PT_PLUGIN_URL . '/assets/admin/vendor/sweetalert2/css/sweetalert2.min.css', false, PT_PLUGIN_VERSION );
			wp_enqueue_script( 'sweetalert2-js', PT_PLUGIN_URL . '/assets/admin/vendor/sweetalert2/js/sweetalert2.min.js', array( 'jquery', 'sweetalert2-core-js' ), PT_PLUGIN_VERSION, true );
			wp_enqueue_script( 'sweetalert2-core-js', PT_PLUGIN_URL . '/assets/admin/vendor/sweetalert2/js/core.js', array( 'jquery' ), PT_PLUGIN_VERSION, true );
			wp_enqueue_script( 'pt_addons_elementor-admin-js', PT_PLUGIN_URL . '/assets/admin/js/admin.js', array( 'jquery' ), PT_PLUGIN_VERSION, true );
			wp_localize_script(
				'pt_addons_elementor-admin-js',
				'localize',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce'   => wp_create_nonce( 'pt-addons-elementor' ),
				)
			);
		}
	}
	/**
	 * Create settings page.
	 *
	 * @since v1.0.0
	 */
	public function pt_admin_settings_page() {
		$flag = false;
		if ( isset( $_GET['messages'] ) && ! empty( $_GET['messages'] ) ) {
			$flag = true;
		}
		?>
		<div class="pt-settings-wrap">
			  <form action="" method="POST" id="pt-settings" name="pt-settings">
				  <div class="pt-header-bar">
					<div class="pt-header-left">
						<div class="pt-admin-logo-inline">
							<img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/pt-logo.png'; ?>" alt="pt-addons-for-elementor">
						</div>
						<h2 class="title"><?php echo __( 'PT Addons For Elementor Settings', 'pt-addons-elementor' ); ?></h2>
					</div>
					<div class="pt-header-right">
					<button type="submit" class="button pt-btn btn-gradient pt-primary js-pt-settings-save"><?php echo __( 'Save settings', 'pt-addons-elementor' ); ?></button>
					</div>
				</div>
				<div class="pt-settings-tabs">
					<ul class="pt-tabs">
						  <li><a href="#general" class="<?php echo ( ( $flag ) ? '' : 'active' ); ?>"><img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/settings.svg'; ?>" alt="pt-addons-general-settings"><span><?php echo __( 'General', 'pt-addons-elementor' ); ?></span></a></li>
						  <li><a href="#elements"><img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/rule-of-thirds.svg'; ?>" alt="pt-addons-elements"><span><?php echo __( 'Elements', 'pt-addons-elementor' ); ?></span></a></li>
						 <li><a href="#api-keys"><img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/keys.svg'; ?>" alt="pt-addons-extensions"><span><?php echo __( 'Map Api Key', 'pt-addons-elementor' ); ?></span></a></li>
						<li><a href="#caches"><img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/paintbrush.svg'; ?>" alt="pt-addons-tools"><span><?php echo __( 'Cache', 'pt-addons-elementor' ); ?></span></a></li>
						<?php if ( $this->pro_enabled ) { ?>
							<li><a href="#license" class="<?php echo ( ( $flag ) ? 'active' : '' ); ?>" ><img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/paintbrush.svg'; ?>" alt="pt-addons-tools"><span><?php echo __( 'License', 'pt-addons-elementor' ); ?></span></a></li>
						<?php } ?>
					</ul>
					<?php
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/general.php';
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/elements.php';
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/tools.php';
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/map.php';
					if ( ! $this->pro_enabled ) {
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/go-pro.php';
					}
					if ( $this->pro_enabled ) {
						include_once PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates/admin/license.php';
					}
					?>
				</div>
			</form>
		</div>
		<?php
	}
	/**
	 * Saving data with ajax request
	 *
	 * @param
	 * @return  array
	 * @since v1.0.0
	 */
	public function save_settings() {
		check_ajax_referer( 'pt-addons-elementor', 'security' );
		if ( ! isset( $_POST['fields'] ) ) {
			return;
		}
		parse_str( $_POST['fields'], $settings );
		// update new settings
		$updated = update_option(
			'pt_save_settings',
			array_merge(
				array_fill_keys( $this->get_registered_elements(), 0 ),
				array_map(
					function ( $value ) {
						return 1;
					},
					$settings
				)
			)
		);
		// Saving Google Map Api Key
		update_option( 'pt_save_google_map_api', @$settings['google-map-api'] );
		// Saving Mailchimp Api Key
		update_option( 'pt_save_mailchimp_api', @$settings['mailchimp-api'] );
		// Build assets files
		$this->generate_scripts( array_keys( $settings ) );
		wp_send_json( $updated );
	}
	public function admin_notice() {
		$notice                        = new PT_Notice( PT_PLUGIN_BASENAME, PT_PLUGIN_VERSION );
		$notice->finish_time['update'] = 'May 28, 2019';
		$scheme                        = ( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ) ) ? '&' : '?';
		$url                           = $_SERVER['REQUEST_URI'] . $scheme;
		$notice->links                 = [
			'review' => array(
				'later'            => array(
					'link'       => 'https://paramthemes.com',
					'target'     => '_blank',
					'label'      => __( 'Ok, you deserve it!', 'pt-addons-elementor' ),
					'icon_class' => 'dashicons dashicons-external',
				),
				'allready'         => array(
					'link'       => $url,
					'label'      => __( 'I already did', 'pt-addons-elementor' ),
					'icon_class' => 'dashicons dashicons-smiley',
					'data_args'  => [
						'dismiss' => true,
					],
				),
				'maybe_later'      => array(
					'link'       => $url,
					'label'      => __( 'Maybe Later', 'pt-addons-elementor' ),
					'icon_class' => 'dashicons dashicons-calendar-alt',
					'data_args'  => [
						'later' => true,
					],
				),
				'support'          => array(
					'link'       => 'https://paramthemes.com/support',
					'label'      => __( 'I need help', 'pt-addons-elementor' ),
					'icon_class' => 'dashicons dashicons-sos',
				),
				'never_show_again' => array(
					'link'       => $url,
					'label'      => __( 'Never show again', 'pt-addons-elementor' ),
					'icon_class' => 'dashicons dashicons-dismiss',
					'data_args'  => [
						'dismiss' => true,
					],
				),
			),
		];
		/**
		 * This is review message and thumbnail.
		 */
		$notice->message( 'review', '<p>' . __( 'We hope you\'re enjoying PT Addons for Elementor! Could you please do us a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'pt-addons-elementor' ) . '</p>' );
		$notice->thumbnail( 'review', plugins_url( 'assets/admin/images/icon-ea-logo.svg', PT_PLUGIN_BASENAME ) );
		 /**
		 * This is update message and thumbnail.
		 */
		$notice->message( 'update', '<p>' . __( "Get 20% Discount & Turbo-Charge Your <strong>Elementor</strong> Page Building With <strong>PT Addons PRO</strong>. Use Coupon Code <span class='coupon-code'>SpeedUp</span> on checkout. <a class='ea-notice-cta' target='_blank' href='https://paramthemes.com/plugins/pt-addons-elementor#pricing'>Redeem Now</a>", 'pt-addons-elementor' ) . '<button class="notice-dismiss" data-notice="update"></button></p>' );
		$notice->thumbnail( 'update', plugins_url( 'assets/admin/images/icon-bolt.svg', PT_PLUGIN_BASENAME ) );
		/**
		 * Current Notice End Time.
		 * Notice will dismiss in 3 days if user does nothing.
		 */
		$notice->cne_time = '3 Day';
		/**
		 * Current Notice Maybe Later Time.
		 * Notice will show again in 7 days
		 */
		$notice->maybe_later_time = '7 Day';
		$notice->text_domain      = 'pt-addons-elementor';
		$notice->options_args     = array(
			'notice_will_show' => [
				'update' => $notice->timestamp,
				'opt_in' => $notice->makeTime( $notice->timestamp, '1 Day' ),
				'review' => $notice->makeTime( $notice->timestamp, '4 Day' ), // after 4 days
			],
		);
		$notice->init();
	}
}
