<?php
namespace Pt_Addons_Elementor\Includes\Triat;
if ( ! defined( 'ABSPATH' ) ) {
	exit();
} // Exit if accessed directly
use Pt_Addons_Elementor\Classes\Group_Control_PT_Posts as Group_Control_PT_Posts;
trait Elements {
	/**
	 * Add elementor category
	 *
	 * @since v1.0.0
	 */
	public function register_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'pt-addons-elementor',
			[
				'title' => __( 'PT Elementor Addons', 'pt-addons-elementor' ),
				'icon'  => 'font',
			],
			1
		);
	}
	/**
	 * Add new elementor group control
	 *
	 * @since v1.0.0
	 */
	public function register_controls_group( $controls_manager ) {
		$controls_manager->add_group_control( 'ptposts', new Group_Control_PT_Posts() );
	}
	/**
	 * Register widgets
	 *
	 * @since v1.0.0
	 */
	public function register_elements( $widgets_manager ) {
		$active_elements = (array) $this->get_settings();
		
		if ( empty( $active_elements ) ) {
			return;
		}
		asort( $active_elements );
		foreach ( $active_elements as $active_element ) {
			if ( ! isset( $this->registered_elements[ $active_element ] ) ) {
				continue;
			}
			if ( isset( $this->registered_elements[ $active_element ]['condition'] ) ) {
				if ( $this->registered_elements[ $active_element ]['condition'][0]($this->registered_elements[ $active_element ]['condition'][1]) == false ) {
					continue;
				}
			}
			
			$widgets_manager->register_widget_type( new $this->registered_elements[ $active_element ]['class']() );
		}
	}
	/**
	 * Register extensions
	 *
	 * @since v1.0.0
	 */
	public function register_extensions() {
		$active_elements = $this->get_settings();
		if ( empty( $active_elements ) ) {
			return;
		}
		foreach ( $this->registered_extensions as $key => $extension ) {
			if ( ! in_array( $key, $active_elements ) ) {
				continue;
			}
			new $extension['class']();
		}
	}
}