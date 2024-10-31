<?php
namespace Pt_Addons_Elementor\Includes\Triat;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

trait Core {
	/**
	 * Extending plugin links
	 *
	 * @since v1.0.0
	 */
	public function insert_plugin_links( $links ) {
		// settings
		$links[] = sprintf( '<a href="admin.php?page=pt-settings">' . __( 'Settings' ) . '</a>' );
		// get premium
		if ( ! $this->pro_enabled ) {
			$links[] = sprintf( '<a href="http://www.paramthemes.com" target="_blank" style="color: #39b54a; font-weight: bold;">' . __( 'Get Premium' ) . '</a>' );
		}
		return $links;
	}
	/**
	 * Extending plugin row meta
	 *
	 * @since v1.0.0
	 */
	public function insert_plugin_row_meta( $links, $file ) {
		if ( PT_PLUGIN_BASENAME == $file ) {
		}
		return $links;
	}
	/**
	 * Redirect to options page
	 *
	 * @since v1.0.0
	 */
	public function redirect_on_activation() {
		if ( get_transient( 'pt_do_activation_redirect' ) ) {
			delete_transient( 'pt_do_activation_redirect' );
			if ( ! isset( $_GET['activate-multi'] ) ) {
				wp_redirect( 'admin.php?page=pt-settings' );
			}
		}
	}
	/**
	 * Check if elementor plugin is activated
	 *
	 * @since v1.0.0
	 */
	public function elementor_not_loaded() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		$elementor = 'elementor/elementor.php';
		if ( $this->is_plugin_installed( $elementor ) ) {
			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
			$message        = __( '<strong>PT Addons for Elementor</strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.', 'pt-addons-elementor' );
			$button_text    = __( 'Activate Elementor', 'pt-addons-elementor' );
		} else {
			$activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$message        = sprintf( __( '<strong>PT Addons for Elementor</strong> requires <strong>Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.', 'pt-addons-elementor' ), '<strong>', '</strong>' );
			$button_text    = __( 'Install Elementor', 'pt-addons-elementor' );
		}
		$button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
		printf( '<div class="error"><p>%1$s</p>%2$s</div>', __( $message ), $button );
	}

	public function set_default_values() {
		$defaults = array_fill_keys(
			[
				'team',
				'call-action',
				'flipbox',
				'advanced_button',
				'infobox',
				'testimonials',
				'team-members',
				'adv-accordion',
				'advance-tab',
				'tooltip',
				'dual-color-header',
				'blog-post-grid',
				'post-carousel',
				'data-table',
				'map',
				'product-grid',
				'post-timeline',
				'pricing-table',
				'clients-list',
				'pie-charts',
				'services',
				'stats-bars',
				'interactive_banner',
				'image-accordian',
				'filter-gallery',
				'addon-dual-header',
				/*'contact-form',
				'we-forms',
				'wp-forms',
				'gravity-form',
				'caldera-forms',
				'ninja-form',*/
				//new
				'slider-testimonial',
				'hover-cards',
				'i-hover',
				'i-hover-3d',
				'heading',
				'smart-box',
				'advance-animated-headline',
				'advance-infobox',
				'advance-button',
				'post-grid',
				'model-box',
				'news-ticker',
				'info-list',
				'smart-banner',
				'business-hours',
				'call-to-action',
				'creative-link',
				'interactive-banner-pro',
				'content-switcher',
				'count-down',
				'flip-carousel',
			],
			1
		);
		$values   = get_option( 'pt_save_settings' );
		return update_option( 'pt_save_settings', wp_parse_args( $values, $defaults ) );
	}
}
