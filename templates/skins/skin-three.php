<?php
namespace Pt_Addons_Elementor\Templates\Skins;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

use \Elementor\Skin_Base;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;

class Skin_Three extends Skin_Base
{
    public function get_id()
    {
        return 'skin-three';
    }

    public function get_title()
    {
        return __('Skin Three', 'pt-addons-elementor');
    }

    protected function _register_controls_actions()
    {
        add_action('elementor/element/pt-advance-menu/pt_advanced_menu_section_general/before_section_end', [$this, 'section_general']);
        add_action('elementor/element/pt-advance-menu/pt_advanced_menu_section_style_menu/before_section_end', [$this, 'section_style_menu']);
        add_action('elementor/element/pt-advance-menu/pt_advanced_menu_section_style_dropdown/before_section_end', [$this, 'section_style_dropdown']);
        add_action('elementor/element/pt-advance-menu/pt_advanced_menu_section_style_top_level_item/before_section_end', [$this, 'section_style_top_level_item']);
        add_action('elementor/element/pt-advance-menu/pt_advanced_menu_section_style_dropdown_item/before_section_end', [$this, 'section_style_dropdown_item']);
    }

    public function section_general(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'pt_advanced_menu_layout',
            [
                'label' => esc_html__('Layout', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'horizontal' => __('Horizontal', 'elementor'),
                    'vertical' => __('Vertical', 'elementor'),
                ],
                'default' => 'horizontal',
                'separator' => 'before',
            ]
        );
    }

    public function section_style_menu(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'pt_advanced_menu_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu-container' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu-container .pt-advanced-menu.pt-advanced-menu-horizontal' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pt_advanced_menu_border',
                'label' => __('Border', 'elementor'),
                'selector' => '{{WRAPPER}} .pt-advanced-menu-container, {{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-horizontal.pt-advanced-menu-responsive',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'unit' => 'px',
                            'top' => '2',
                            'right' => '0',
                            'bottom' => '1',
                            'left' => '0',
                            'isLinked' => false
                        ],
                    ],
                    'color' => [
                        'default' => '#080808',
                    ],
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pt_advanced_menu_box_shadow',
                'label' => __('Shadow', 'elementor'),
                'selector' => '{{WRAPPER}} .pt-advanced-menu-container',
            ]
        );
    }

    public function section_style_dropdown(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->add_control(
            'pt_advanced_menu_dropdown_animation',
            [
                'label' => __('Animation', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'pt-advanced-menu-dropdown-animate-fade' => __('Fade', 'elementor'),
                    'pt-advanced-menu-dropdown-animate-to-top' => __('To Top', 'elementor'),
                    'pt-advanced-menu-dropdown-animate-zoom-in' => __('ZoomIn', 'elementor'),
                    'pt-advanced-menu-dropdown-animate-zoom-out' => __('ZoomOut', 'elementor'),
                ],
                'default' => 'pt-advanced-menu-dropdown-animate-to-top',
                'condition' => [
                    'skin_three_pt_advanced_menu_layout' => ['horizontal'],
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pt_advanced_menu_dropdown_border',
                'label' => __('Border', 'elementor'),
                'selector' => '{{WRAPPER}} .pt-advanced-menu li ul',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_responsive_control(
            'pt_advanced_menu_dropdown_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'pt_advanced_menu_dropdown_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'pt_advanced_menu_dropdown_box_shadow',
                'label' => __('Shadow', 'elementor'),
                'selector' => '{{WRAPPER}} .pt-advanced-menu li ul',
            ]
        );

    }

    public function section_style_top_level_item()
    {
        $this->start_controls_tabs('pt_advanced_menu_top_level_item');

        $this->start_controls_tab(
            'pt_advanced_menu_top_level_item_default',
            [
                'label' => __('Default', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_alignment',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'pt-advanced-menu-align-left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'pt-advanced-menu-align-center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'pt-advanced-menu-align-right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'pt-advanced-menu-align-center',
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pt_advanced_menu_item_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pt-advanced-menu li > a, .pt-advanced-menu-container .pt-advanced-menu-toggle-text',
                'fields_options' => [
                    'font_family' => [
                        'default' => 'Montserrat',
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '13',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '400',
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '60',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_color',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#080808',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu-toggle-text' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_divider_color',
            [
                'label' => __('Divider Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-horizontal:not(.pt-advanced-menu-responsive) > li > a' => 'border-right: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu-align-center .pt-advanced-menu.pt-advanced-menu-horizontal:not(.pt-advanced-menu-responsive) > li:first-child > a' => 'border-left: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu-align-right .pt-advanced-menu.pt-advanced-menu-horizontal:not(.pt-advanced-menu-responsive) > li:first-child > a' => 'border-left: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-horizontal.pt-advanced-menu-responsive > li:not(:last-child) > a' => 'border-bottom: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-vertical > li:not(:last-child) > a' => 'border-bottom: 1px solid {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_padding',
            [
                'label' => __('Item Padding', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-horizontal li ul li a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Dropdown Indicator', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator',
            [
                'label' => __('Icon', 'elementor'),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
                    'fa-solid' => [
                        'fas fa-angle-down',
                    ]
                ],
                'default' => [
					'value' => 'fas fa-angle-down',
					'library' => 'fa-solid',
				],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Important Note', 'elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_border',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pt_advanced_menu_top_level_item_hover',
            [
                'label' => __('Hover', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_color_hover',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li.current-menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_background_hover',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li:hover > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li.current-menu-item > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li.current-menu-ancestor > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Dropdown Indicator', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Important Note', 'elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_color_hover',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_background_hover',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_item_indicator_border_hover',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    public function section_style_dropdown_item(Widget_Base $widget)
    {
        $this->parent = $widget;

        $this->start_controls_tabs('pt_advanced_menu_dropdown_item');

        $this->start_controls_tab(
            'pt_advanced_menu_dropdown_item_default',
            [
                'label' => __('Default', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_alignment',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'pt-advanced-menu-dropdown-align-left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'pt-advanced-menu-dropdown-align-center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'pt-advanced-menu-dropdown-align-right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'pt-advanced-menu-dropdown-align-left',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pt_advanced_menu_dropdown_item_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .pt-advanced-menu li ul li > a',
                'fields_options' => [
                    'font_family' => [
                        'default' => 'Montserrat',
                    ],
                    'font_size' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '13',
                        ],
                    ],
                    'font_weight' => [
                        'default' => '300',
                    ],
                    'line_height' => [
                        'default' => [
                            'unit' => 'px',
                            'size' => '50',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_color',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255,255,255,0)',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li > a' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_divider_color',
            [
                'label' => __('Divider Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-horizontal li ul li > a' => 'border-bottom: 1px solid {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu.pt-advanced-menu-vertical li ul li > a' => 'border-bottom: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Dropdown Indicator', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator',
            [
                'label' => __('Icon', 'elementor'),
                'type' => Controls_Manager::ICONS,
                'recommended' => [
                    'fa-solid' => [
                        'fas fa-angle-down',
                    ]
                ],
                'default' => [
					'value' => 'fas fa-angle-down',
					'library' => 'fa-solid',
				],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Important Note', 'elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_background',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_border',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pt_advanced_menu_dropdown_item_hover',
            [
                'label' => __('Hover', 'elementor'),
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_color_hover',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li:hover > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li.current-menu-item > a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li.current-menu-ancestor > a' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_background_hover',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.2)',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li:hover > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li.current-menu-item > a' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li.current-menu-ancestor > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Dropdown Indicator', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            base64_encode(mt_rand()),
            [
                'label' => __('Important Note', 'elementor'),
                'show_label' => false,
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('<div style="font-size: 11px;font-style:italic;line-height:1.4;color:#a4afb7;">Following options are only available in the <span style="color:#d30c5c"><strong>Small</strong></span> screens for <span style="color:#d30c5c"><strong>Horizontal</strong></span> Layout, and all screens for <span style="color:#d30c5c"><strong>Vertical</strong></span> Layout</div>', 'elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_color_hover',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open:before' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_background_hover',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#297ca0',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pt_advanced_menu_dropdown_item_indicator_border_hover',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator:hover' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .pt-advanced-menu li ul li .pt-advanced-menu-indicator.pt-advanced-menu-indicator-open' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
    }

    public function render()
    {
        $settings = $this->parent->get_settings();
        $menu_classes = ['pt-advanced-menu', $settings['skin_three_pt_advanced_menu_dropdown_animation'], 'pt-advanced-menu-indicator'];
        $container_classes = ['pt-advanced-menu-container', $settings['skin_three_pt_advanced_menu_item_alignment'], $settings['skin_three_pt_advanced_menu_dropdown_item_alignment']];

        if ($settings['skin_three_pt_advanced_menu_layout'] == 'horizontal') {
            $menu_classes[] = 'pt-advanced-menu-horizontal';
        } else {
            $menu_classes[] = 'pt-advanced-menu-vertical';
        }

        if (isset($settings['skin_three_pt_advanced_menu_item_dropdown_indicator']) && $settings['skin_three_pt_advanced_menu_item_dropdown_indicator'] == 'yes') {
            $menu_classes[] = 'pt-advanced-menu-indicator';
        }

        $this->parent->add_render_attribute('pt-advanced-menu', [
            'class' => implode(' ', array_filter($container_classes)),
            'data-indicator-class' => $settings['skin_three_pt_advanced_menu_item_indicator'],
            'data-dropdown-indicator-class' => $settings['skin_three_pt_advanced_menu_dropdown_item_indicator'],
        ]);

        if ($settings['pt_advanced_menu_menu']) {
            $args = [
                'menu' => $settings['pt_advanced_menu_menu'],
                'menu_class' => implode(' ', array_filter($menu_classes)),
                'container' => false,
                'echo' => false,
            ];

            echo '<div ' . $this->parent->get_render_attribute_string('pt-advanced-menu') . '>' . wp_nav_menu($args) . '</div>';
        }
    }
}
