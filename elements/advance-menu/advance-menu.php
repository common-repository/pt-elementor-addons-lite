<?php
namespace Elementor;

namespace Pt_Addons_Elementor\Elements\AdvanceMenu;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

use \Pt_Addons_Elementor\Templates\Skins\Skin_Default;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Five;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Four;
use \Pt_Addons_Elementor\Templates\Skins\Skin_One;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Seven;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Six;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Three;
use \Pt_Addons_Elementor\Templates\Skins\Skin_Two;
use \Pt_Addons_Elementor\Classes\Bootstrap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * content Widget
 */
class Advance_Menu extends Widget_Base {

	use \Pt_Addons_Elementor\Includes\Triat\Helper;

	/**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'pt-advance-menu';
	}

	/**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Advance Menu', 'pt-addons-elementor' );
	}

	/**
	 * Retrieve the list of categories the content widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'pt-addons-elementor' ];
	}

	/**
	 * Retrieve content widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-dual-button';
	}

	protected function _register_skins() {
		$this->add_skin( new Skin_Default( $this ) );
		$this->add_skin( new Skin_One( $this ) );
		$this->add_skin( new Skin_Two( $this ) );
		$this->add_skin( new Skin_Three( $this ) );
		$this->add_skin( new Skin_Four( $this ) );
		$this->add_skin( new Skin_Five( $this ) );
		$this->add_skin( new Skin_Six( $this ) );
		$this->add_skin( new Skin_Seven( $this ) );
	}

	/**
	 * Register content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */

	protected function _register_controls() {
		/**
		 * Content: General
		 */
		$this->start_controls_section(
			'pt_advanced_menu_section_general',
			[
				'label' => esc_html__( 'General', 'elementor' ),
			]
		);

		$this->add_control(
			'pt_advanced_menu_menu',
			[
				'label'       => esc_html__( 'Select Menu', 'elementor' ),
				'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menu screen</a> to manage your menus.', 'elementor' ), admin_url( 'nav-menus.php' ) ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => $this->pt_get_menus(),
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();

		/**
		 * Style: Main Menu
		 */
		$this->start_controls_section(
			'pt_advanced_menu_section_style_menu',
			[
				'label' => __( 'Main Menu', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

		/**
		 * Style: Dropdown Menu
		 */
		$this->start_controls_section(
			'pt_advanced_menu_section_style_dropdown',
			[
				'label' => __( 'Dropdown Menu', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

		/**
		 * Style: Top Level Items
		 */

		$this->start_controls_section(
			'pt_advanced_menu_section_style_top_level_item',
			[
				'label' => __( 'Top Level Item', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

		/**
		 * Style: Main Menu (Hover)
		 */

		$this->start_controls_section(
			'pt_advanced_menu_section_style_dropdown_item',
			[
				'label' => __( 'Dropdown Item', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

	}

}
