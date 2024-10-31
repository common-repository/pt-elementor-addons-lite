<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\ContentSwitcher;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Frontend;
use \Elementor\Control_Media as Control_Media;
use \Pt_Addons_Elementor\Classes\Bootstrap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * content Widget
 */
class Content_Switcher extends Widget_Base {

	use \Pt_Addons_Elementor\Includes\Triat\Helper;

    /**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pt-content-switcher';
    }

    /**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Content Switcher', 'pt-addons-elementor' );
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
	
	public function get_keywords()
    {
         return [
            'toggle',
            'pt toggle',
            'pt content toggle',
            'content toggle',
            'content switcher',
            'switcher',
            'pt switcher',
            'pt',
            'pt-addons-elementor'
        ];
    }

	

	public function get_style_depends() {

		wp_register_style( 'swich_css',PT_PLUGIN_URL.'assets/front-end/css/content-switcher/index.css');

		return [
			'swich_css',
		];

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

    protected function _register_controls() {
		
		$this->start_controls_section(
			'rbs_section_content_1',
			array(
				'label' => __( 'Content 1', 'pt' ),
			)
		);

		// Rbs section 1 heading text.
		$this->add_control(
			'rbs_section_heading_1',
			array(
				'label'   => __( 'Heading', 'pt' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Heading 1', 'pt' ),
			)
		);

		// Rbs content section 1.
		$this->add_control(
			'rbs_select_section_1',
			array(
				'label'   => __( 'Section', 'pt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => $this->get_content_type(),
			)
		);

		// Rbs content section 1 - content.
		$this->add_control(
			'section_content_1',
			array(
				'label'      => __( 'Description', 'pt' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'This is your first content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pt' ),
				'rows'       => 10,
				'show_label' => false,
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'rbs_select_section_1' => 'content',
				),
			)
		);

		// Rbs content section 1 - saved rows.
		$this->add_control(
			'section_saved_rows_1',
			array(
				'label'     => __( 'Select Section', 'pt' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'section' ),
				'default'   => '-1',
				'condition' => array(
					'rbs_select_section_1' => 'saved_rows',
				),
			)
		);

		// Rbs content section 1 - saved pages.
		$this->add_control(
			'section_saved_pages_1',
			array(
				'label'     => __( 'Select Page', 'pt' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'page' ),
				'default'   => '-1',
				'condition' => array(
					'rbs_select_section_1' => 'saved_page_templates',
				),
			)
		);

		// Rbs heading section ends.
		$this->end_controls_section();

		// Rbs content sections starts.
		$this->start_controls_section(
			'rbs_sections_content_2',
			array(
				'label' => __( 'Content 2', 'pt' ),
			)
		);

		// Rbs section 2 heading text.
		$this->add_control(
			'rbs_section_heading_2',
			array(
				'label'   => __( 'Heading', 'pt' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Heading 2', 'pt' ),
			)
		);

		// Rbs content section 2.
		$this->add_control(
			'rbs_select_section_2',
			array(
				'label'   => __( 'Section', 'pt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => $this->get_content_type(),
			)
		);

		// Rbs content section 2 - content.
		$this->add_control(
			'section_content_2',
			array(
				'label'      => __( 'Description', 'pt' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => __( 'This is your second content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.​ Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'pt' ),
				'rows'       => 10,
				'show_label' => false,
				'dynamic'    => array(
					'active' => true,
				),
				'condition'  => array(
					'rbs_select_section_2' => 'content',
				),
			)
		);

		// Rbs content section 2 - saved rows.
		$this->add_control(
			'section_saved_rows_2',
			array(
				'label'     => __( 'Select Section', 'pt' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'section' ),
				'default'   => '-1',
				'condition' => array(
					'rbs_select_section_2' => 'saved_rows',
				),
			)
		);

		// Rbs content section 2 - saved pages.
		$this->add_control(
			'section_saved_pages_2',
			array(
				'label'     => __( 'Select Page', 'pt' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_saved_data( 'page' ),
				'default'   => '-1',
				'condition' => array(
					'rbs_select_section_2' => 'saved_page_templates',
				),
			)
		);

		// Rbs heading section ends.
		$this->end_controls_section();

		// Switch style starts.
		$this->start_controls_section(
			'rbs_switch_style',
			array(
				'label' => __( 'Switcher', 'pt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Rbs default switch mode.
		$this->add_control(
			'rbs_default_switch',
			array(
				'label'        => __( 'Default Display', 'pt' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'off',
				'return_value' => 'on',
				'options'      => array(
					'off' => 'Content 1',
					'on'  => 'Content 2',
				),
				'separator'    => 'before',
			)
		);

		// Rbs select switch.
		$this->add_control(
			'rbs_select_switch',
			array(
				'label'   => __( 'Switch Style', 'pt' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'round_1',
				'options' => $this->get_switch_type(),
			)
		);

		// Switch - Off color.
		$this->add_control(
			'rbs_switch_color_off',
			array(
				'label'     => __( 'Color 1', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_4,
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-slider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-toggle input[type="checkbox"] + label:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-toggle input[type="checkbox"] + label:after' => 'border: 0.3em solid {{VALUE}};',
					'{{WRAPPER}} .pt-label-box-active .pt-label-box-switch' => 'background: {{VALUE}};',

				),
			)
		);

		// Switch - On color.
		$this->add_control(
			'rbs_switch_color_on',
			array(
				'label'     => __( 'Color 2', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				),

				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-switch:checked + .pt-rbs-slider' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-rbs-switch:focus + .pt-rbs-slider'     => '-webkit-box-shadow: 0 0 1px {{VALUE}};box-shadow: 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .pt-toggle input[type="checkbox"]:checked + label:before'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-toggle input[type="checkbox"]:checked + label:after'     => '-webkit-transform: translateX(2.5em);-ms-transform: translateX(2.5em);transform: translateX(2.5em);border: 0.3em solid {{VALUE}};',
					'{{WRAPPER}} .pt-label-box-inactive .pt-label-box-switch' => 'background: {{VALUE}};',
				),
			)
		);

		// Switch - Controller Color.
		$this->add_control(
			'rbs_switch_controller',
			array(
				'label'     => __( 'Controller Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_4,
				),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-slider:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-toggle input[type="checkbox"] + label:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} span.pt-label-box-switch' => 'color: {{VALUE}};',
				),
			)
		);

		// Switch size.
		/* $this->add_responsive_control(
			'rds_switch_size',
			array(
				'label'     => __( 'Switch Size', 'pt' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 15,
				),
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 35,
						'step' => 1,
					),
				),
				'selectors' => array(
					// General.
					'{{WRAPPER}} .pt-main-btn' => 'font-size: {{SIZE}}px;',
				),
			)
		); */

		// Switch style ends.
		$this->end_controls_section();

		// Section heading style starts.
		$this->start_controls_section(
			'section_style_heading',
			array(
				'label' => __( 'Headings', 'pt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Heading 1 - heading.
		$this->add_control(
			'section_heading_1_style',
			array(
				'label'     => __( 'Heading 1', 'pt' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// Heading 1 - color.
		$this->add_control(
			'section_heading_1_color',
			array(
				'label'     => __( 'Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-head-1' => 'color: {{VALUE}};',
				),
				'separator' => 'none',
			)
		);

		// Heading 1 - typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_heading_1_typo',
				'selector' => '{{WRAPPER}} .pt-rbs-head-1',
				'scheme'   => Typography::TYPOGRAPHY_1,
			)
		);

		// Heading 2 - heading.
		$this->add_control(
			'section_heading_2_style',
			array(
				'label'     => __( 'Heading 2', 'pt' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// Heading 2 - color.
		$this->add_control(
			'section_heading_2_color',
			array(
				'label'     => __( 'Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-head-2' => 'color: {{VALUE}};',
				),
				'separator' => 'none',
			)
		);

		// Heading 2 - typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'section_heading_2_typo',
				'selector' => '{{WRAPPER}} .pt-rbs-head-2',
				'scheme'   => Typography::TYPOGRAPHY_1,
			)
		);

		$this->add_control(
			'rbs_header_size',
			array(
				'label'     => __( 'HTML Tag', 'pt' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default'   => 'h5',
				'separator' => 'before',
			)
		);

		// heading alignment content Alignment.
		$this->add_responsive_control(
			'rds_heading_alignment',
			array(
				'label'     => __( 'Alignment', 'pt' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'pt' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'pt' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'pt' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-toggle' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .pt-ct-desktop-stack--yes .pt-rbs-toggle' => 'align-items: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_layout',
			array(
				'label'        => __( 'Layout', 'pt' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Stack', 'pt' ),
				'label_off'    => __( 'Inline', 'pt' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'heading_stack_on',
			array(
				'label'        => __( 'Stack on', 'pt' ),
				'description'  => __( 'Choose on what breakpoint the heading will stack.', 'pt' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'mobile',
				'options'      => array(
					'none'   => __( 'None', 'pt' ),
					'tablet' => __( 'Tablet (1023px >)', 'pt' ),
					'mobile' => __( 'Mobile (767px >)', 'pt' ),
				),
				'condition'    => array(
					'heading_layout!' => 'yes',
				),
				'prefix_class' => 'pt-ct-stack--',
			)
		);

		$this->add_control(
			'rbs_advance_setting',
			array(
				'label'     => __( 'Advanced', 'pt' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'pt' ),
				'label_on'  => __( 'ON', 'pt' ),
				'default'   => 'no',
				'return'    => 'yes',
			)
		);

		// Heading background color.
		$this->add_control(
			'section_heading_bg_color',
			array(
				'label'     => __( 'Background Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-toggle' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'rbs_advance_setting' => 'yes',
				),
			)
		);

		// Heading - Border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'heading_border',
				'label'     => __( 'Border', 'pt' ),
				'selector'  => '{{WRAPPER}} .pt-rbs-toggle',
				'condition' => array(
					'rbs_advance_setting' => 'yes',
				),
			)
		);

		$this->add_control(
			'heading_border_radius',
			array(
				'label'      => __( 'Border Radius', 'pt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-rbs-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rbs_advance_setting' => 'yes',
				),
			)
		);

		// Overall Heading - padding.
		$this->add_responsive_control(
			'rbs_heading_padding',
			array(
				'label'      => __( 'Padding', 'pt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-rbs-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rbs_advance_setting' => 'yes',
				),
			)
		);

		// Section heading style ends.
		$this->end_controls_section();

		// Content style starts.
		$this->start_controls_section(
			'rbs_content_style',
			array(
				'label' => __( 'Content', 'pt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Content 1 - heading.
		$this->add_control(
			'section_content_1_style',
			array(
				'label'     => __( 'Content 1', 'pt' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'rbs_select_section_1' => 'content',
				),
			)
		);

		// Content 1 Color.
		$this->add_control(
			'section_content_1_color',
			array(
				'label'     => __( 'Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				),
				'condition' => array(
					'rbs_select_section_1' => 'content',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-content-1.pt-rbs-section-1' => 'color: {{VALUE}};',
				),
			)
		);

		// Content 1 Typo.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'section_content_1_typo',
				'selector'  => '{{WRAPPER}} .pt-rbs-content-1.pt-rbs-section-1',
				'scheme'    => Typography::TYPOGRAPHY_3,
				'condition' => array(
					'rbs_select_section_1' => 'content',
				),
				'separator' => 'after',
			)
		);

		// Content 2 - heading.
		$this->add_control(
			'section_content_2_style',
			array(
				'label'     => __( 'Content 2', 'pt' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'rbs_select_section_2' => 'content',
				),
			)
		);

		// Content 2 Color.
		$this->add_control(
			'section_content_2_color',
			array(
				'label'     => __( 'Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_3,
				),
				'condition' => array(
					'rbs_select_section_2' => 'content',
				),
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-content-2.pt-rbs-section-2' => 'color: {{VALUE}};',
				),
			)
		);

		// Content 2 Typo.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'section_content_2_typo',
				'selector'  => '{{WRAPPER}} .pt-rbs-content-2.pt-rbs-section-2',
				'scheme'    => Typography::TYPOGRAPHY_3,
				'condition' => array(
					'rbs_select_section_2' => 'content',
				),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'rbs_content_advance_setting',
			array(
				'label'     => __( 'Advanced', 'pt' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'OFF', 'pt' ),
				'label_on'  => __( 'ON', 'pt' ),
				'default'   => 'no',
				'return'    => 'yes',
			)
		);

		// Content background color.
		$this->add_control(
			'rbs_content_bg_color',
			array(
				'label'     => __( 'Background Color', 'pt' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt-rbs-toggle-sections'     => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'rbs_content_advance_setting' => 'yes',
				),
			)
		);

		// Content - Border.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'content_border',
				'label'     => __( 'Border', 'pt' ),
				'selector'  => '{{WRAPPER}} .pt-rbs-toggle-sections',
				'condition' => array(
					'rbs_content_advance_setting' => 'yes',
				),
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'pt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-rbs-toggle-sections' => 'overflow: hidden;border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rbs_content_advance_setting' => 'yes',
				),
			)
		);

		// Content padding.
		$this->add_responsive_control(
			'rbs_content_padding',
			array(
				'label'      => __( 'Padding', 'pt' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt-rbs-toggle-sections' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'rbs_content_advance_setting' => 'yes',
				),
			)
		);

		// Content style ends.
		$this->end_controls_section();

		// Spacing style starts.
		$this->start_controls_section(
			'rbs_switch_spacing',
			array(
				'label' => __( 'Spacing', 'pt' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Spacing Headings and toggle button.
		$this->add_responsive_control(
			'rds_button_headings_spacing',
			array(
				'label'     => __( 'Button & Headings', 'pt' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'%' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'   => array(
					'size' => 5,
				),
				'selectors' => array(
					// General.
					'{{WRAPPER}} .pt-ct-desktop-stack--no .pt-sec-1'         => 'margin-right: {{SIZE}}%;',
					'{{WRAPPER}} .pt-ct-desktop-stack--no .pt-sec-2'         => 'margin-left: {{SIZE}}%;',

					'.rtl {{WRAPPER}} .pt-ct-desktop-stack--no .pt-sec-1'         => 'margin-left: {{SIZE}}%; margin-right: 0%;',
					'.rtl {{WRAPPER}} .pt-ct-desktop-stack--no .pt-sec-2'         => 'margin-right: {{SIZE}}%; margin-left: 0%',

					'{{WRAPPER}} .pt-ct-desktop-stack--yes .pt-sec-1'         => 'margin-bottom: {{SIZE}}%;',
					'{{WRAPPER}} .pt-ct-desktop-stack--yes .pt-sec-2'         => 'margin-top: {{SIZE}}%;',

					'(tablet){{WRAPPER}}.pt-ct-stack--tablet .pt-ct-desktop-stack--no .pt-sec-1'         => 'margin-bottom: {{SIZE}}%;margin-right: 0px;',
					'(tablet){{WRAPPER}}.pt-ct-stack--tablet .pt-ct-desktop-stack--no .pt-sec-2'         => 'margin-top: {{SIZE}}%;margin-left: 0px;',

					'(tablet){{WRAPPER}}.pt-ct-stack--tablet .pt-ct-desktop-stack--no .pt-rbs-toggle'         => 'flex-direction: column;',

					'(mobile){{WRAPPER}}.pt-ct-stack--mobile .pt-ct-desktop-stack--no .pt-sec-1'         => 'margin-bottom: {{SIZE}}%;margin-right: 0px;',
					'(mobile){{WRAPPER}}.pt-ct-stack--mobile .pt-ct-desktop-stack--no .pt-sec-2'         => 'margin-top: {{SIZE}}%;margin-left: 0px;',

					'(mobile){{WRAPPER}}.pt-ct-stack--mobile .pt-ct-desktop-stack--no .pt-rbs-toggle'         => 'flex-direction: column;',
				),
			)
		);

		// Spacing Headings and content.
		$this->add_responsive_control(
			'rds_headings_content_spacing',
			array(
				'label'     => __( 'Content & Headings', 'pt' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					// General.
					'{{WRAPPER}} .pt-rbs-toggle' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);

		// Spacing style ends.
		$this->end_controls_section();
		//$this->register_helpful_information();
	}

	/**
	 * Render button widget classes names.
	 *
	 * @since 0.0.1
	 * @param array  $settings The settings array.
	 * @param int    $node_id The node id.
	 * @param string $section Section one or two.
	 * @return string Concatenated string of classes
	 * @access public
	 */
	public function get_modal_content( $settings, $node_id, $section ) {

		$normal_content_1 = $this->get_settings_for_display( 'section_content_1' );
		$normal_content_2 = $this->get_settings_for_display( 'section_content_2' );
		$content_type     = $settings[ $section ];
		if ( 'rbs_select_section_1' === $section ) {
			switch ( $content_type ) {
				case 'content':
					global $wp_embed;
					return '<div>' . wpautop( $wp_embed->autoembed( $normal_content_1 ) ) . '</div>';
				break;
				case 'saved_rows':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_rows_1'] );
				break;
				case 'saved_page_templates':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_pages_1'] );
				break;
				default:
					return;
				break;
			}
		} else {
			switch ( $content_type ) {
				case 'content':
					global $wp_embed;
					return '<div>' . wpautop( $wp_embed->autoembed( $normal_content_2 ) ) . '</div>';
				break;
				case 'saved_rows':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_rows_2'] );
				break;
				case 'saved_page_templates':
					return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $settings['section_saved_pages_2'] );
				break;
				default:
					return;
				break;
			}
		}
	}

	/**
	 *  Get Saved Widgets
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_saved_data( $type = 'page' ) {

		$saved_widgets = $this->get_post_template( $type );
		$options[-1]   = __( 'Select', 'pt' );
		if ( count( $saved_widgets ) ) {
			foreach ( $saved_widgets as $saved_row ) {
				$options[ $saved_row['id'] ] = $saved_row['name'];
			}
		} else {
			$options['no_template'] = __( 'It seems that, you have not saved any template yet.', 'pt' );
		}
		return $options;
	}

	/**
	 *  Get Templates based on category
	 *
	 *  @param string $type Type.
	 *  @since 0.0.1
	 *  @return string
	 */
	public function get_post_template( $type = 'page' ) {
		$posts = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'posts_per_page' => '-1',
				'tax_query'      => array(
					array(
						'taxonomy' => 'elementor_library_type',
						'field'    => 'slug',
						'terms'    => $type,
					),
				),
			)
		);

		$templates = array();

		foreach ( $posts as $post ) {

			$templates[] = array(
				'id'   => $post->ID,
				'name' => $post->post_title,
			);
		}

		return $templates;
	}

	/**
	 * Registers all controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	
	/**
	 * Helpful Information.
	 *
	 * @since 1.1.0
	 * @access protected
	 */
	

	/**
	 * Render content type list.
	 *
	 * @since 0.0.1
	 * @return array Array of content type
	 * @access public
	 */
	public function get_content_type() {

		$content_type = array(
			'content'              => __( 'Content', 'pt' ),
			'saved_rows'           => __( 'Saved Section', 'pt' ),
			'saved_page_templates' => __( 'Saved Page', 'pt' ),
		);

		return $content_type;
	}

	/**
	 * Render content type list.
	 *
	 * @since 0.0.1
	 * @return array Array of content type
	 * @access public
	 */
	public function get_switch_type() {

		$switch_type = array(
			'round_1'   => __( 'Round 1', 'pt' ),
			'round_2'   => __( 'Round 2', 'pt' ),
			'rectangle' => __( 'Rectangle', 'pt' ),
			'label_box' => __( 'Label Box', 'pt' ),
		);

		return $switch_type;
	}

	/**
	 * Render Radio Button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {

		$settings  = $this->get_settings();
		$node_id   = $this->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();
		if ( 'yes' === $settings['heading_layout'] ) {
				$this->add_render_attribute(
					'rbs_wrapper',
					'class',
					array(
						'pt-ct-desktop-stack--yes',
						'pt-rbs-wrapper',
					)
				);
			} else {
				$this->add_render_attribute(
					'rbs_wrapper',
					'class',
					array(
						'pt-ct-desktop-stack--no',
						'pt-rbs-wrapper',
					)
				);
			}
			// Toggle Headings.
			$this->add_render_attribute( 'rbs_toggle', 'class', 'pt-rbs-toggle' );
			// Toggle Headings inner.
			$this->add_render_attribute( 'sec_1', 'class', 'pt-sec-1' );
			$this->add_render_attribute( 'sec_2', 'class', 'pt-sec-2' );
			// Inline Editing Heading 1.
			$this->add_inline_editing_attributes( 'rbs_section_heading_1', 'basic' );
			$this->add_render_attribute( 'rbs_section_heading_1', 'class', 'pt-rbs-head-1' );
			// Inline Editing Heading 2.
			$this->add_inline_editing_attributes( 'rbs_section_heading_2', 'basic' );
			$this->add_render_attribute( 'rbs_section_heading_2', 'class', 'pt-rbs-head-2' );
			$this->add_render_attribute( 'main_btn', 'class', 'pt-main-btn' );
			$this->add_render_attribute( 'main_btn', 'data-switch-type', $settings['rbs_select_switch'] );
			// Toggle Sections.
			$this->add_render_attribute( 'rbs_toggle_sections', 'class', 'pt-rbs-toggle-sections' );
			if ( 'content' === $settings['rbs_select_section_1'] ) {
				$this->add_render_attribute( 'rbs_section_1', 'class', 'pt-rbs-content-1' );
			}
			if ( 'content' === $settings['rbs_select_section_2'] ) {
				$this->add_render_attribute( 'rbs_section_2', 'class', 'pt-rbs-content-2' );
			}
			if ( 'on' === $settings['rbs_default_switch'] ) {
				$this->add_render_attribute( 'rbs_section_1', 'style', 'display: none;' );
			} else {
				$this->add_render_attribute( 'rbs_section_2', 'style', 'display: none;' );
			}
			$this->add_render_attribute( 'rbs_section_1', 'class', 'pt-rbs-section-1' );
			$this->add_render_attribute( 'rbs_section_2', 'class', 'pt-rbs-section-2' );
			// Toggle Switch - Round 1.
			$this->add_render_attribute( 'rbs_switch_label', 'class', 'pt-rbs-switch-label' );
			$this->add_render_attribute(
				'rbs_switch_round_1',
				'class',
				array(
					'pt-rbs-switch',
					'pt-switch-round-1',
					'elementor-clickable',
				)
			);
			$this->add_render_attribute( 'rbs_switch_round_1', 'type', 'checkbox' );
			$this->add_render_attribute(
				'rbs_span_round_1',
				'class',
				array(
					'pt-rbs-slider',
					'pt-rbs-round',
					'elementor-clickable',
				)
			);
			// Toggle Switch - Round 2.
			$this->add_render_attribute( 'rbs_div_round_2', 'class', 'pt-toggle' );
			$this->add_render_attribute(
				'rbs_input_round_2',
				'class',
				array(
					'pt-switch-round-2',
					'elementor-clickable',
				)
			);
			$this->add_render_attribute( 'rbs_input_round_2', 'type', 'checkbox' );
			$this->add_render_attribute( 'rbs_input_round_2', 'name', 'group1' );
			$this->add_render_attribute( 'rbs_input_round_2', 'id', 'toggle_' . $node_id );
			$this->add_render_attribute( 'rbs_label_round_2', 'for', 'toggle_' . $node_id );
			$this->add_render_attribute( 'rbs_label_round_2', 'class', 'elementor-clickable' );
			// Toggle Switch - Rectangle.
			$this->add_render_attribute( 'rbs_label_rect', 'class', 'pt-rbs-switch-label' );
			$this->add_render_attribute(
				'rbs_input_rect',
				'class',
				array(
					'pt-rbs-switch',
					'pt-switch-rectangle',
					'elementor-clickable',
				)
			);
			$this->add_render_attribute( 'rbs_input_rect', 'type', 'checkbox' );
			$this->add_render_attribute( 'rbs_span_rect', 'class', 'pt-rbs-slider' );
			$this->add_render_attribute( 'rbs_span_rect', 'class', 'elementor-clickable' );
			// Toggle Switch - Label Box.
			$this->add_render_attribute(
				'rbs_div_label_box',
				'class',
				array(
					'pt-label-box',
					'elementor-clickable',
				)
			);
			$this->add_render_attribute( 'rbs_input_label_box', 'type', 'checkbox' );
			$this->add_render_attribute( 'rbs_input_label_box', 'name', 'pt-label-box' );
			$this->add_render_attribute(
				'rbs_input_label_box',
				'class',
				array(
					'pt-label-box-checkbox',
					'pt-switch-label-box',
					'elementor-clickable',
				)
			);
			$this->add_render_attribute( 'rbs_input_label_box', 'id', 'myonoffswitch_' . $node_id );
			$this->add_render_attribute( 'rbs_label_label_box', 'class', 'pt-label-box-label' );
			$this->add_render_attribute( 'rbs_label_label_box', 'for', 'myonoffswitch_' . $node_id );
			$this->add_render_attribute( 'rbs_span_inner_label_box', 'class', 'pt-label-box-inner' );
			$this->add_render_attribute( 'rbs_span_inactive_label_box', 'class', 'pt-label-box-inactive' );
			$this->add_render_attribute( 'rbs_span_label_box', 'class', 'pt-label-box-switch' );
			$this->add_render_attribute( 'rbs_span_active_label_box', 'class', 'pt-label-box-active' );
			?>

			<div <?php echo $this->get_render_attribute_string( 'rbs_wrapper' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'rbs_toggle' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'sec_1' ); ?>>
						<<?php echo $settings['rbs_header_size']; ?> <?php echo $this->get_render_attribute_string( 'rbs_section_heading_1' ); ?> data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'rbs_section_heading_1' ); ?></<?php echo $settings['rbs_header_size']; ?>>
					</div>
					<div <?php echo $this->get_render_attribute_string( 'main_btn' ); ?>>

						<?php $switch_html = ''; ?>
						<?php $is_checked = ( 'on' === $settings['rbs_default_switch'] ) ? 'checked' : ''; ?>
						<?php
						switch ( $settings['rbs_select_switch'] ) {
							case 'round_1':
								$switch_html = '<label ' . $this->get_render_attribute_string( 'rbs_switch_label' ) . '><input ' . $this->get_render_attribute_string( 'rbs_switch_round_1' ) . ' ' . $is_checked . '><span ' . $this->get_render_attribute_string( 'rbs_span_round_1' ) . '></span></label>';
								break;

							case 'round_2':
								$switch_html = '<div ' . $this->get_render_attribute_string( 'rbs_div_round_2' ) . '><input ' . $this->get_render_attribute_string( 'rbs_input_round_2' ) . ' ' . $is_checked . '><label ' . $this->get_render_attribute_string( 'rbs_label_round_2' ) . '></label></div>';
						
								
								break;

							case 'rectangle':
								$switch_html = '<label ' . $this->get_render_attribute_string( 'rbs_label_rect' ) . '><input ' . $this->get_render_attribute_string( 'rbs_input_rect' ) . ' ' . $is_checked . '><span ' . $this->get_render_attribute_string( 'rbs_span_rect' ) . '></span></label>';
								break;

							case 'label_box':
								$on_label    = __( 'ON', 'pt' );
								$off_label   = __( 'OFF', 'pt' );
								$on          = apply_filters( 'pt_toggle_on_label', $on_label, $settings );
								$off         = apply_filters( 'pt_toggle_off_label', $off_label, $settings );
								$switch_html = '<div ' . $this->get_render_attribute_string( 'rbs_div_label_box' ) . '><input ' . $this->get_render_attribute_string( 'rbs_input_label_box' ) . ' ' . $is_checked . '><label ' . $this->get_render_attribute_string( 'rbs_label_label_box' ) . '"><span ' . $this->get_render_attribute_string( 'rbs_span_inner_label_box' ) . '><span ' . $this->get_render_attribute_string( 'rbs_span_inactive_label_box' ) . '><span ' . $this->get_render_attribute_string( 'rbs_span_label_box' ) . '>' . $off . '</span></span><span ' . $this->get_render_attribute_string( 'rbs_span_active_label_box' ) . '><span ' . $this->get_render_attribute_string( 'rbs_span_label_box' ) . '>' . $on . '</span></span></span></label></div>';
								break;

							default:
								break;
						}
						?>

						<!-- Display Switch -->
						<?php echo $switch_html; ?>

					</div>
					<div <?php echo $this->get_render_attribute_string( 'sec_2' ); ?>>
						<<?php echo $settings['rbs_header_size']; ?> <?php echo $this->get_render_attribute_string( 'rbs_section_heading_2' ); ?> data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'rbs_section_heading_2' ); ?></<?php echo $settings['rbs_header_size']; ?>>
					</div>
				</div>
				<div <?php echo $this->get_render_attribute_string( 'rbs_toggle_sections' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'rbs_section_1' ); ?>>
						<?php echo do_shortcode( $this->get_modal_content( $settings, $node_id, 'rbs_select_section_1' ) ); ?>
					</div>
					<div <?php echo $this->get_render_attribute_string( 'rbs_section_2' ); ?>>
						<?php echo do_shortcode( $this->get_modal_content( $settings, $node_id, 'rbs_select_section_2' ) ); ?>
					</div>
						
					
				</div>
			</div>
			<?php 
	}

	/**
	 * Render Timeline output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	
}