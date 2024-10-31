<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\OffCanvas;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Widget_Base;
use \Pt_Addons_Elementor\Classes\Bootstrap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * content Widget
 */
class Off_Canvas extends Widget_Base {

	use \Pt_Addons_Elementor\Includes\Triat\Helper;

    /**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pt-off-canvas';
    }

    /**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Off Canvas', 'pt-addons-elementor' );
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
        return 'eicon-sidebar';
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

        /*--------------------------------------*/
        ##  CONTENT TAB    ##
        /*--------------------------------------*/

        /**
         * Content Tab: Offcanvas
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_content_offcanvas',
            [
                'label' => __('Offcanvas Content', 'elementor'),
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label' => __('Content Type', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'sidebar' => __('Sidebar', 'elementor'),
                    'custom' => __('Custom Content', 'elementor'),
                    'section' => __('Saved Section', 'elementor'),
                    'widget' => __('Saved Widget', 'elementor'),
                    'template' => __('Saved Page Template', 'elementor'),
                ],
                'default' => 'custom',
            ]
        );

        $registered_sidebars = $this->get_registered_sidebars();
        $this->add_control(
            'sidebar',
            [
                'label' => __('Choose Sidebar', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => array_shift($registered_sidebars),
                'options' => $registered_sidebars,
                'condition' => [
                    'content_type' => 'sidebar',
                ],
            ]
        );

        $this->add_control(
            'saved_widget',
            [
                'label' => __('Choose Widget', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_page_template_options('widget'),
                'default' => '-1',
                'condition' => [
                    'content_type' => 'widget',
                ],
            ]
        );

        $this->add_control(
            'saved_section',
            [
                'label' => __('Choose Section', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_page_template_options('section'),
                'default' => '-1',
                'condition' => [
                    'content_type' => 'section',
                ],
            ]
        );

        $this->add_control(
            'templates',
            [
                'label' => __('Choose Template', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_page_template_options('page'),
                'default' => '-1',
                'condition' => [
                    'content_type' => 'template',
                ],
            ]
        );

//***************************repeater control  */
$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'title', [
        'label' => esc_html__( 'Title', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'List Title' , 'elementor' ),
        'label_block' => true,
    ]
);
      
		$repeater->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Description Content' , 'elementor' ),
				'show_label' => false,
			]
		);
    

//***************************repeater control  */       
 $this->add_control(
            'custom_content',
            [
                'label' => '',
                'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

                'default' => [
                    [
                        'title' => __('Text 1', 'elementor'),
                        'description' => __('Text description Type Here', 'elementor'),
                    ],
                    [
                        'title' => __('Text 2', 'elementor'),
                        'description' => __('Text description Type Here', 'elementor'),
                    ],
                ],
                
                'title_field' => '{{{ title }}}',
                'condition' => [
                    'content_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section(); #section_content_offcanvas

        /**
         * Content Tab: Toggle Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_button_settings',
            [
                'label' => __('Toggle Button', 'elementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'elementor'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Click Here', 'elementor'),
            ]
        );

        $this->add_control(
            'button_icon_new',
            [
                'label' => __('Button Icon', 'elementor'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => __('Before', 'elementor'),
                    'after' => __('After', 'elementor'),
                ],
                'prefix_class' => 'pt-offcanvas-icon-',
                'condition' => [
                    'button_icon!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '5',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.pt-offcanvas-icon-before .pt-offcanvas-toggle-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}.pt-offcanvas-icon-after .pt-offcanvas-toggle-icon' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'button_icon!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Settings
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_settings',
            [
                'label' => __('Settings', 'elementor'),
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __('Direction', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle' => false,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'content_transition',
            [
                'label' => __('Content Transition', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slide', 'elementor'),
                    'reveal' => __('Reveal', 'elementor'),
                    'push' => __('Push', 'elementor'),
                    'slide-along' => __('Slide Along', 'elementor'),
                ],
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'close_button',
            [
                'label' => __('Show Close Button', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'esc_close',
            [
                'label' => __('Esc to Close', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'body_click_close',
            [
                'label' => __('Click anywhere to Close', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'elementor'),
                'label_off' => __('No', 'elementor'),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        /*-----------------------------------------------------------------------------------*/
        /*    STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Offcanvas Bar
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_offcanvas_bar_style',
            [
                'label' => __('Offcanvas Bar', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'offcanvas_bar_bg',
                'label' => __('Background', 'elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '.pt-offcanvas-content-{{ID}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'offcanvas_bar_border',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '.pt-offcanvas-content-{{ID}}',
            ]
        );

        $this->add_control(
            'offcanvas_bar_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'offcanvas_bar_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'offcanvas_bar_box_shadow',
                'selector' => '.pt-offcanvas-content-{{ID}}',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Content
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_popup_content_style',
            [
                'label' => __('Content', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'widget_heading',
            [
                'label' => __('Box', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'widgets_bg_color',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-custom-widget, .pt-offcanvas-content-{{ID}} .widget' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'widgets_border',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '.pt-offcanvas-content-{{ID}} .pt-offcanvas-custom-widget, .pt-offcanvas-content-{{ID}} .widget',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'widgets_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-custom-widget, .pt-offcanvas-content-{{ID}} .widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_responsive_control(
            'widgets_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '20',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-custom-widget, .pt-offcanvas-content-{{ID}} .widget' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_responsive_control(
            'widgets_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-custom-widget, .pt-offcanvas-content-{{ID}} .widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'text_heading',
            [
                'label' => __('Text', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body, .pt-offcanvas-content-{{ID}} .pt-offcanvas-body *:not(.fa):not(.eicon)' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body, .pt-offcanvas-content-{{ID}} .pt-offcanvas-body *:not(.fa):not(.eicon)',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'links_heading',
            [
                'label' => __('Links', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_links_style');

        $this->start_controls_tab(
            'tab_links_normal',
            [
                'label' => __('Normal', 'elementor'),
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'content_links_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body a' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'links_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body a',
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_links_hover',
            [
                'label' => __('Hover', 'elementor'),
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->add_control(
            'content_links_color_hover',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-body a:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'content_type' => ['sidebar', 'custom'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Icon
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'trigger' => 'on-click',
                    'trigger_type!' => 'button',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-trigger-icon' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'trigger' => 'on-click',
                    'trigger_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '28',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pt-trigger-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'trigger' => 'on-click',
                    'trigger_type' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_image_width',
            [
                'label' => __('Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pt-trigger-image' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'trigger' => 'on-click',
                    'trigger_type' => 'image',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Toggle Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_toggle_button_style',
            [
                'label' => __('Toggle Button', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Alignment', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
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
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_size',
            [
                'label' => __('Size', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'md',
                'options' => [
                    'xs' => __('Extra Small', 'elementor'),
                    'sm' => __('Small', 'elementor'),
                    'md' => __('Medium', 'elementor'),
                    'lg' => __('Large', 'elementor'),
                    'xl' => __('Extra Large', 'elementor'),
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'elementor'),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#2489b7',
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_normal',
                'label' => __('Border', 'elementor'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .pt-offcanvas-toggle',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'elementor'),
                'scheme' => Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .pt-offcanvas-toggle',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .pt-offcanvas-toggle',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'elementor'),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __('Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __('Text Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __('Border Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-offcanvas-toggle:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_animation',
            [
                'label' => __('Animation', 'elementor'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow_hover',
                'selector' => '{{WRAPPER}} .pt-offcanvas-toggle:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Close Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_close_button_style',
            [
                'label' => __('Close Button', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'close_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'close_button_icon_new',
            [
                'label' => __('Button Icon', 'elementor'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'close_button_icon',
                'default' => [
                    'value' => 'fas fa-times',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'close_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'close_button_text_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-close-{{ID}}' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'close_button' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_button_size',
            [
                'label' => __('Size', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '28',
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}} .pt-offcanvas-close-{{ID}}' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'close_button' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Overlay
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_overlay_style',
            [
                'label' => __('Overlay', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_bg_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}}-open .pt-offcanvas-container:after' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label' => __('Opacity', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '.pt-offcanvas-content-{{ID}}-open .pt-offcanvas-container:after' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render close button for offcanvas output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render_close_button()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['close_button'] != 'yes') {
            return;
        }

        $this->add_render_attribute(
            'close-button', 'class',
            [
                'pt-offcanvas-close',
                'pt-offcanvas-close-' . esc_attr($this->get_id()),
            ]
        );

        $this->add_render_attribute('close-button', 'role', 'button');
        ?>
        <div class="pt-offcanvas-header">
            <div <?php echo $this->get_render_attribute_string('close-button'); ?>>
                <?php if (isset($settings['__fa4_migrated']['close_button_icon_new']) || empty($settings['close_button_icon'])) {?>
                    <span class="<?php echo esc_attr($settings['close_button_icon_new']['value']); ?>"></span>
                <?php } else { ?>
                    <span class="<?php echo esc_attr($settings['close_button_icon']); ?>"></span>
                <?php } ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render sidebars for output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render_sidebar()
    {
        $settings = $this->get_settings_for_display();
        $sidebar = $settings['sidebar'];

        if (empty($sidebar)) {
            return;
        }

        dynamic_sidebar($sidebar);
    }

    /**
     * Render custom template or saved template output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render_custom_content()
    {
        $settings = $this->get_settings_for_display();

        if (count($settings['custom_content'])) {
            foreach ($settings['custom_content'] as $key => $item) {
                ?>
                <div class="pt-offcanvas-custom-widget">
                    <h3 class="pt-offcanvas-widget-title"><?php echo $item['title']; ?></h3>
                    <div class="pt-offcanvas-widget-content">
                        <?php echo $item['description']; ?>
                    </div>
                </div>
                <?php
}
        }

    }

    /**
     * Render offcanvas content widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $setting_attr = [
            'content_id' => esc_attr($this->get_id()),
            'direction' => esc_attr($settings['direction']),
            'transition' => esc_attr($settings['content_transition']),
            'esc_close' => esc_attr($settings['esc_close']),
            'body_click_close' => esc_attr($settings['body_click_close']),
        ];

        $this->add_render_attribute(
            'content-wrap',
            [
                'class' => 'pt-offcanvas-content-wrap',
                'data-settings' => htmlspecialchars(json_encode($setting_attr)),
            ]
        );

        $this->add_render_attribute(
            'content',
            [
                'class' => [
                    'pt-offcanvas-content',
                    'pt-offcanvas-content-' . esc_attr($this->get_id()),
                    'pt-offcanvas-' . $setting_attr['transition'],
                    'elementor-element-' . $this->get_id(),
                    'pt-offcanvas-content-' . $setting_attr['direction'],
                ],
            ]
        );

        $this->add_render_attribute(
            'toggle-button',
            [
                'class' => [
                    'pt-offcanvas-toggle',
                    'pt-offcanvas-toogle-' . esc_attr($this->get_id()),
                    'elementor-button',
                    'elementor-size-' . esc_attr($settings['button_size']),
                ],
            ]
        );

        if ($settings['button_animation']) {
            $this->add_render_attribute('toggle-button', 'class', 'elementor-animation-' . esc_attr($settings['button_animation']));
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('content-wrap'); ?>>

            <?php if ($settings['button_text'] != '' || $settings['button_text'] != ''): ?>
            <div class="pt-offcanvas-toggle-wrap">
                <div <?php echo $this->get_render_attribute_string('toggle-button'); ?>>
                    <?php if (isset($settings['__fa4_migrated']['button_icon_new']) || empty($settings['button_icon'])) {?>
                        <span class="pt-offcanvas-toggle-icon <?php echo esc_attr($settings['button_icon_new']['value']); ?>"></span>
                    <?php } else { ?>
                        <span class="pt-offcanvas-toggle-icon <?php echo esc_attr($settings['button_icon']); ?>"></span>
                    <?php } ?>
                    <span class="pt-toggle-text">
                        <?php echo $settings['button_text']; ?>
                    </span>
                </div>
            </div>
            <?php endif; // end of if( $settings['button_text'] != '' || $settings['button_text'] != '' ) ?>

            <div <?php echo $this->get_render_attribute_string('content'); ?>>
                <?php $this->render_close_button();?>
                <div class="pt-offcanvas-body">
                    <?php
if ('sidebar' == $settings['content_type']) {

            $this->render_sidebar();

        } else if ('custom' == $settings['content_type']) {

            $this->render_custom_content();

        } else if ('section' == $settings['content_type'] && !empty($settings['saved_section'])) {

            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['saved_section']);

        } elseif ('template' == $settings['content_type'] && !empty($settings['templates'])) {

            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['templates']);

        } elseif ('widget' == $settings['content_type'] && !empty($settings['saved_widget'])) {

            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($settings['saved_widget']);

        }
        ?>
                </div><!-- /.pt-offcanvas-body -->
            </div>
        </div>
		
		
		
        <?php

    }

    protected function content_template()
    {}

}