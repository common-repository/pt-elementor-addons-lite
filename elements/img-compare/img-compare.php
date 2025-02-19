<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\ImgCompare;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Pt_Addons_Elementor\Classes\Bootstrap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * content Widget
 */
class Img_Compare extends Widget_Base {

	//use \Pt_Addons_Elementor\Includes\Triat\Helper;

    /**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pt-img-compare';
    }

    /**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Image Comparison', 'pt-addons-elementor' );
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
        return 'eicon-image-before-after';
    }

    /**
	 * Register content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls()
    {

        // Content Controls
        $this->start_controls_section(
            'pt_image_comparison_images',
            [
                'label' => esc_html__('Images', 'elementor'),
            ]
        );

        $this->add_control(
            'before_image_label',
            [
                'label' => __('Label Before', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Before',
                'title' => __('Input before image label', 'elementor'),
            ]
        );

        $this->add_control(
            'before_image',
            [
                'label' => __('Choose Before Image', 'elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'before_image_alt',
            [
                'label' => __('Before Image ALT Tag', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => __('Enter alter tag for the image', 'elementor'),
                'title' => __('Input image alter tag here', 'elementor'),
            ]
        );

        $this->add_control(
            'after_image_label',
            [
                'label' => __('Label After', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'After',
                'title' => __('Input after image label', 'elementor'),
            ]
        );
        $this->add_control(
            'after_image',
            [
                'label' => __('Choose After Image', 'elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'after_image_alt',
            [
                'label' => __('After Image ALT Tag', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'placeholder' => __('Enter alter tag for the image', 'elementor'),
                'title' => __('Input image alter tag here', 'elementor'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pt_image_comparison_settings',
            [
                'label' => esc_html__('Settings', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_image_comp_offset',
            [
                'label' => esc_html__('Original Image Visibility', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => ['%' => ['min' => 10, 'max' => 90]],
                'default' => ['size' => 70, 'unit' => '%'],
            ]
        );

        $this->add_control(
            'pt_image_comp_orientation',
            [
                'label' => esc_html__('Orientation', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => __('Horizontal', 'elementor'),
                    'vertical' => __('Vertical', 'elementor'),
                ],
                'default' => 'horizontal',
            ]
        );

        $this->add_control(
            'pt_image_comp_overlay',
            [
                'label' => esc_html__('Wants Overlay ?', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', 'elementor'),
                'label_off' => __('no', 'elementor'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pt_image_comp_move',
            [
                'label' => esc_html__('Move Slider On Hover', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', 'elementor'),
                'label_off' => __('no', 'elementor'),
                'default' => 'no',
            ]
        );

        $this->add_control(
            'pt_image_comp_click',
            [
                'label' => esc_html__('Move Slider On Click', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', 'elementor'),
                'label_off' => __('no', 'elementor'),
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pt_image_comparison_styles',
            [
                'label' => esc_html__('Image Container Styles', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pt_image_container_width',
            [
                'label' => esc_html__('Set max width for the container?', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('yes', 'elementor'),
                'label_off' => __('no', 'elementor'),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'pt_image_container_width_value',
            [
                'label' => __('Container Max Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 80,
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-img-comp-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pt_image_container_width' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pt_img_comp_border',
                'selector' => '{{WRAPPER}} .pt-img-comp-container',
            ]
        );

        $this->add_control(
            'pt_img_comp_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-img-comp-container' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Handle
         */
        $this->start_controls_section(
            'section_handle_style',
            [
                'label' => __('Handle', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_handle_style');

        $this->start_controls_tab(
            'tab_handle_normal',
            [
                'label' => __('Normal', 'elementor'),
            ]
        );

        $this->add_control(
            'handle_icon_color',
            [
                'label' => __('Icon Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'handle_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .twentytwenty-handle',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'handle_border',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .twentytwenty-handle',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'handle_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'handle_box_shadow',
                'selector' => '{{WRAPPER}} .twentytwenty-handle',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_handle_hover',
            [
                'label' => __('Hover', 'elementor'),
            ]
        );

        $this->add_control(
            'handle_icon_color_hover',
            [
                'label' => __('Icon Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'handle_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .twentytwenty-handle:hover',
            ]
        );

        $this->add_control(
            'handle_border_color_hover',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-handle:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Divider
         */
        $this->start_controls_section(
            'section_divider_style',
            [
                'label' => __('Divider', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_width',
            [
                'label' => __('Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Label
         */
        $this->start_controls_section(
            'section_label_style',
            [
                'label' => __('Label', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_horizontal_position',
            [
                'label' => __('Position', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'top',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'pt-ic-label-horizontal-',
                'condition' => [
                    'orientation' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'label_vertical_position',
            [
                'label' => __('Position', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'pt-ic-label-vertical-',
                'condition' => [
                    'orientation' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_align',
            [
                'label' => __('Align', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.pt-ic-label-horizontal-top .twentytwenty-horizontal .twentytwenty-before-label:before,
                    {{WRAPPER}}.pt-ic-label-horizontal-top .twentytwenty-horizontal .twentytwenty-after-label:before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-before-label:before' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-after-label:before' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.pt-ic-label-horizontal-bottom .twentytwenty-horizontal .twentytwenty-before-label:before,
                    {{WRAPPER}}.pt-ic-label-horizontal-bottom .twentytwenty-horizontal .twentytwenty-after-label:before' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before' => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.pt-ic-label-vertical-left .twentytwenty-vertical .twentytwenty-before-label:before,
                    {{WRAPPER}}.pt-ic-label-vertical-left .twentytwenty-vertical .twentytwenty-after-label:before' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.pt-ic-label-vertical-right .twentytwenty-vertical .twentytwenty-before-label:before,
                    {{WRAPPER}}.pt-ic-label-vertical-right .twentytwenty-vertical .twentytwenty-after-label:before' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_label_style');

        $this->start_controls_tab(
            'tab_label_before',
            [
                'label' => __('Before', 'elementor'),
            ]
        );

        $this->add_control(
            'label_text_color_before',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_bg_color_before',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-before-label:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'label_border',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .twentytwenty-before-label:before',
            ]
        );

        $this->add_control(
            'label_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-before-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_label_after',
            [
                'label' => __('After', 'elementor'),
            ]
        );

        $this->add_control(
            'label_text_color_after',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'label_bg_color_after',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-after-label:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'label_border_after',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .twentytwenty-after-label:before',
            ]
        );

        $this->add_control(
            'label_border_radius_after',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-after-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'label_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .twentytwenty-before-label:before, {{WRAPPER}} .twentytwenty-after-label:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        /**
         * Getting the options from user.
         */
        $settings = $this->get_settings();
        $before_image = $this->get_settings('before_image');
        $after_image = $this->get_settings('after_image');

        $this->add_render_attribute(
            'wrapper',
            [
                'id'                => 'pt-image-comparison-' . esc_attr($this->get_id()),
                'class'             => ['pt-img-comp-container'],
                'data-offset'       => ($settings['pt_image_comp_offset']['size'] / 100),
                'data-orientation'  => $settings['pt_image_comp_orientation'],
                'data-before_label' => $settings['before_image_label'],
                'data-after_label'  => $settings['after_image_label'],
                'data-overlay'      => $settings['pt_image_comp_overlay'],
                'data-onhover'      => $settings['pt_image_comp_move'],
                'data-onclick'      => $settings['pt_image_comp_click'],
            ]
        );

        echo '<div ' . $this->get_render_attribute_string('wrapper') . '>
			<img class="pt-before-img" alt="' . esc_attr($settings['before_image_alt']) . '" src="' . esc_url($before_image['url']) . '">
			<img class="pt-after-img" alt="' . esc_attr($settings['after_image_alt']) . '" src="' . esc_url($after_image['url']) . '">
        </div>';
    }
}