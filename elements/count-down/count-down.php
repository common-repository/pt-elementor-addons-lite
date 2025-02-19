<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\CountDown;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
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
class Count_Down extends Widget_Base {

	use \Pt_Addons_Elementor\Includes\Triat\Helper;

    /**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pt-count-down';
    }

    /**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Count Down', 'pt-addons-elementor' );
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
        return 'eicon-countdown';
    }

    /**
	 * Register content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */


    public function get_script_depends() {

		wp_register_script( 'widget-script-1', PT_PLUGIN_URL.'assets/front-end/js/count-down/countdown.js',);
		wp_register_script( 'widget-script-2', PT_PLUGIN_URL. 'assets/front-end/js/count-down/index.js');
	

		return [
			'widget-script-1',
			'widget-script-2',
		];

	}




    protected function _register_controls() {

		
        $this->start_controls_section(
            'pt_section_countdown_settings_general',
            [
                'label' => esc_html__( 'Timer Settings', 'elementor' )
            ]
        );
      
      $this->add_control(
          'pt_countdown_due_time',
          [
              'label' => esc_html__( 'Countdown Due Date', 'elementor' ),
              'type' => Controls_Manager::DATE_TIME,
              'default' => date("Y-m-d", strtotime("+ 1 day")),
              'description' => esc_html__( 'Set the due date and time', 'elementor' ),
          ]
      );

      $this->add_control(
          'pt_countdown_label_view',
          [
              'label' => esc_html__( 'Label Position', 'elementor' ),
              'type' => Controls_Manager::SELECT,
              'default' => 'pt-countdown-label-block',
              'options' => [
                  'pt-countdown-label-block' => esc_html__( 'Block', 'elementor' ),
                  'pt-countdown-label-inline' => esc_html__( 'Inline', 'elementor' ),
              ],
          ]
      );

      $this->add_responsive_control(
          'pt_countdown_label_padding_left',
          [
              'label' => esc_html__( 'Left spacing for Labels', 'elementor' ),
              'type' => Controls_Manager::SLIDER,
              'description' => esc_html__( 'Use when you select inline labels', 'elementor' ),
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 100,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-label' => 'padding-left:{{SIZE}}px;',
              ],
              'condition' => [
                  'pt_countdown_label_view' => 'pt-countdown-label-inline',
              ],
          ]
      );


      $this->end_controls_section();


        $this->start_controls_section(
            'pt_section_countdown_settings_content',
            [
                'label' => esc_html__( 'Content Settings', 'elementor' )
            ]
        );

        $this->add_control(
        'pt_section_countdown_style',
            [
             'label'       	=> esc_html__( 'Countdown Style', 'elementor' ),
               'type' 			=> Controls_Manager::SELECT,
               'default' 		=> 'style-1',
               'label_block' 	=> false,
               'options' 		=> [
                   'style-1'  	=> esc_html__( 'Style 1', 'elementor' ),
                   'style-2' 	=> esc_html__( 'Style 2', 'elementor' ),
                   'style-3' 	=> esc_html__( 'Style 3', 'elementor' ),
               ],
            ]
      );


      $this->add_control(
          'pt_countdown_days',
          [
              'label' => esc_html__( 'Display Days', 'elementor' ),
              'type' => Controls_Manager::SWITCHER,
              'return_value' => 'yes',
              'default' => 'yes',
          ]
      );

      $this->add_control(
          'pt_countdown_days_label',
          [
              'label' => esc_html__( 'Custom Label for Days', 'elementor' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Days', 'elementor' ),
              'description' => esc_html__( 'Leave blank to hide', 'elementor' ),
              'condition' => [
                  'pt_countdown_days' => 'yes',
              ],
          ]
      );
      

      $this->add_control(
          'pt_countdown_hours',
          [
              'label' => esc_html__( 'Display Hours', 'elementor' ),
              'type' => Controls_Manager::SWITCHER,
              'return_value' => 'yes',
              'default' => 'yes',
          ]
      );

      $this->add_control(
          'pt_countdown_hours_label',
          [
              'label' => esc_html__( 'Custom Label for Hours', 'elementor' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Hours', 'elementor' ),
              'description' => esc_html__( 'Leave blank to hide', 'elementor' ),
              'condition' => [
                  'pt_countdown_hours' => 'yes',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_minutes',
          [
              'label' => esc_html__( 'Display Minutes', 'elementor' ),
              'type' => Controls_Manager::SWITCHER,
              'return_value' => 'yes',
              'default' => 'yes',
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_label',
          [
              'label' => esc_html__( 'Custom Label for Minutes', 'elementor' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Minutes', 'elementor' ),
              'description' => esc_html__( 'Leave blank to hide', 'elementor' ),
              'condition' => [
                  'pt_countdown_minutes' => 'yes',
              ],
          ]
      );
          
      $this->add_control(
          'pt_countdown_seconds',
          [
              'label' => esc_html__( 'Display Seconds', 'elementor' ),
              'type' => Controls_Manager::SWITCHER,
              'return_value' => 'yes',
              'default' => 'yes',
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_label',
          [
              'label' => esc_html__( 'Custom Label for Seconds', 'elementor' ),
              'type' => Controls_Manager::TEXT,
              'default' => esc_html__( 'Seconds', 'elementor' ),
              'description' => esc_html__( 'Leave blank to hide', 'elementor' ),
              'condition' => [
                  'pt_countdown_seconds' => 'yes',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_separator_heading',
          [
              'label' => __( 'Countdown Separator', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_separator',
          [
              'label' => esc_html__( 'Display Separator', 'elementor' ),
              'type' => Controls_Manager::SWITCHER,
              'return_value' => 'pt-countdown-show-separator',
              'default' => '',
          ]
      );

      $this->add_control(
          'pt_countdown_separator_color',
          [
              'label' => esc_html__( 'Separator Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'condition' => [
                  'pt_countdown_separator' => 'pt-countdown-show-separator',
              ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-digits::after' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'pt_countdown_separator_typography',
              'scheme' => Typography::TYPOGRAPHY_2,
              'selector' => '{{WRAPPER}} .pt-countdown-digits::after',
              'condition' => [
                  'pt_countdown_separator' => 'pt-countdown-show-separator',
              ],
          ]
      );


      $this->end_controls_section();
      

      $this->start_controls_section(
          'countdown_on_expire_settings',
          [
              'label' => esc_html__( 'Expire Action' , 'elementor' )
          ]
      );

      $this->add_control(
          'countdown_expire_type',
          [
              'label'			=> esc_html__('Expire Type', 'elementor'),
              'label_block'	=> false,
              'type'			=> Controls_Manager::SELECT,
              'description'   => esc_html__('Choose whether if you want to set a message or a redirect link', 'elementor'),
              'options'		=> [
                  'none'		=> esc_html__('None', 'elementor'),
                  'text'		=> esc_html__('Message', 'elementor'),
                  'url'		=> esc_html__('Redirection Link', 'elementor'),
                  'template'		=> esc_html__('Saved Templates', 'elementor')
              ],
              'default'		=> 'none'
          ]
      );

      $this->add_control(
          'countdown_expiry_text_title',
          [
              'label'			=> esc_html__('On Expiry Title', 'elementor'),
              'type'			=> Controls_Manager::TEXTAREA,
              'default'		=> esc_html__('Countdown is finished!','elementor'),
              'condition'		=> [
                  'countdown_expire_type' => 'text'
              ]
          ]
      );

      $this->add_control(
          'countdown_expiry_text',
          [
              'label'			=> esc_html__('On Expiry Content', 'elementor'),
              'type'			=> Controls_Manager::WYSIWYG,
              'default'		=> esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s','elementor'),
              'condition'		=> [
                  'countdown_expire_type' => 'text'
              ]
          ]
      );

      $this->add_control(
          'countdown_expiry_redirection',
          [
              'label'			=> esc_html__('Redirect To (URL)', 'elementor'),
              'type'			=> Controls_Manager::TEXT,
              'condition'		=> [
                  'countdown_expire_type' => 'url'
              ],
              'default'		=> '#'
          ]
      );

      $this->add_control(
          'countdown_expiry_templates',
          [
              'label'                 => __( 'Choose Template', 'elementor' ),
              'type'                  => Controls_Manager::SELECT,
              'options'               => $this->pt_get_page_templates(),
              'condition'             => [
                  'countdown_expire_type'      => 'template',
              ],
          ]
      );

      $this->end_controls_section();

      
      $this->start_controls_section(
          'pt_section_countdown_styles_general',
          [
              'label' => esc_html__( 'Countdown Styles', 'elementor' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );
      
      $this->add_control(
          'pt_countdown_background',
          [
              'label' => esc_html__( 'Box Background Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#458ec1',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div' => 'background: {{VALUE}};',
              ],
          ]
      );

      $this->add_responsive_control(
          'pt_countdown_spacing',
          [
              'label' => esc_html__( 'Space Between Boxes', 'elementor' ),
              'type' => Controls_Manager::SLIDER,
              'default' => [
                  'size' => 15,
              ],
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 100,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div' => 'margin-right:{{SIZE}}px; margin-left:{{SIZE}}px;',
                  '{{WRAPPER}} .pt-countdown-container' => 'margin-right: -{{SIZE}}px; margin-left: -{{SIZE}}px;',
              ],
              'condition' => [
                  'pt_section_countdown_style' => ['style-1', 'style-3']
              ]
          ]
      );
      
      $this->add_responsive_control(
          'pt_countdown_container_margin_bottom',
          [
              'label' => esc_html__( 'Space Below Container', 'elementor' ),
              'type' => Controls_Manager::SLIDER,
              'default' => [
                  'size' => 0,
              ],
              'range' => [
                  'px' => [
                      'min' => 0,
                      'max' => 100,
                  ],
              ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-container' => 'margin-bottom:{{SIZE}}px;',
              ],
          ]
      );
      
      $this->add_responsive_control(
          'pt_countdown_box_padding',
          [
              'label' => esc_html__( 'Padding', 'elementor' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', '%', 'em' ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Border::get_type(),
          [
              'name' => 'pt_countdown_box_border',
              'label' => esc_html__( 'Border', 'elementor' ),
              'selector' => '{{WRAPPER}} .pt-countdown-item > div',
          ]
      );

      $this->add_control(
          'pt_countdown_box_border_radius',
          [
              'label' => esc_html__( 'Border Radius', 'elementor' ),
              'type' => Controls_Manager::DIMENSIONS,
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Box_Shadow::get_type(),
          [
              'name' => 'pt_countdown_box_shadow',
              'selector' => '{{WRAPPER}} .pt-countdown-item > div',
          ]
      );

      $this->end_controls_section();
      
      
      $this->start_controls_section(
          'pt_section_countdown_styles_content',
          [
              'label' => esc_html__( 'Color &amp; Typography', 'elementor' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );

      $this->add_control(
          'pt_countdown_digits_heading',
          [
              'label' => __( 'Countdown Digits', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_digits_color',
          [
              'label' => esc_html__( 'Digits Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#150184',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-digits' => 'color: {{VALUE}};',
              ],
          ]
      );
      
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'pt_countdown_digit_typography',
              'scheme' => Typography::TYPOGRAPHY_2,
              'selector' => '{{WRAPPER}} .pt-countdown-digits',
          ]
      );

      $this->add_control(
          'pt_countdown_label_heading',
          [
              'label' => __( 'Countdown Labels', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_label_color',
          [
              'label' => esc_html__( 'Label Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#150184',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-label' => 'color: {{VALUE}};',
              ],
          ]
      );
      
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name' => 'pt_countdown_label_typography',
              'scheme' => Typography::TYPOGRAPHY_2,
              'selector' => '{{WRAPPER}} .pt-countdown-label',
          ]
      );		


      $this->end_controls_section();


      
      $this->start_controls_section(
          'pt_section_countdown_styles_individual',
          [
              'label' => esc_html__( 'Individual Box Styling', 'elementor' ),
              'tab' => Controls_Manager::TAB_STYLE
          ]
      );

      $this->add_control(
          'pt_countdown_days_label_heading',
          [
              'label' => __( 'Days', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_days_background_color',
          [
              'label' => esc_html__( 'Background Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-days' => 'background-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_days_digit_color',
          [
              'label' => esc_html__( 'Digit Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-days .pt-countdown-digits' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_days_label_color',
          [
              'label' => esc_html__( 'Label Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-days .pt-countdown-label' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_days_border_color',
          [
              'label' => esc_html__( 'Border Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-days' => 'border-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_hours_label_heading',
          [
              'label' => __( 'Hours', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_hours_background_color',
          [
              'label' => esc_html__( 'Background Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-hours' => 'background-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_hours_digit_color',
          [
              'label' => esc_html__( 'Digit Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-hours .pt-countdown-digits' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_hours_label_color',
          [
              'label' => esc_html__( 'Label Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-hours .pt-countdown-label' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_hours_border_color',
          [
              'label' => esc_html__( 'Border Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-hours' => 'border-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_label_heading',
          [
              'label' => __( 'Minutes', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_background_color',
          [
              'label' => esc_html__( 'Background Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-minutes' => 'background-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_digit_color',
          [
              'label' => esc_html__( 'Digit Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-minutes .pt-countdown-digits' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_label_color',
          [
              'label' => esc_html__( 'Label Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-minutes .pt-countdown-label' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_minutes_border_color',
          [
              'label' => esc_html__( 'Border Color', 'elementor' ),
              'type' => Controls_Manager::COLOR,
              'default' => '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-minutes' => 'border-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_label_heading',
          [
              'label' => __( 'Seconds', 'elementor' ),
              'type' => Controls_Manager::HEADING,
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_background_color',
          [
              'label'		=> esc_html__( 'Background Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default'	=> '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-seconds' => 'background-color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_digit_color',
          [
              'label'		=> esc_html__( 'Digit Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default'	=> '',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-seconds .pt-countdown-digits' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_label_color',
          [
              'label'		=> esc_html__( 'Label Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default'	=> '',
              'selectors'	=> [
                  '{{WRAPPER}} .pt-countdown-seconds .pt-countdown-label' => 'color: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'pt_countdown_seconds_border_color',
          [
              'label'		=> esc_html__( 'Border Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default' 	=> '',
              'selectors'	=> [
                  '{{WRAPPER}} .pt-countdown-item > div.pt-countdown-seconds' => 'border-color: {{VALUE}};',
              ],
          ]
      );


      $this->end_controls_section();

      
      $this->start_controls_section(
          'pt_section_countdown_expire_style',
          [
              'label'	=> esc_html__( 'Expire Message', 'elementor' ),
              'tab'	=> Controls_Manager::TAB_STYLE,
              'condition'	=> [
                  'countdown_expire_type'	=> 'text'
              ]
          ]
      );

      $this->add_responsive_control(
          'pt_countdown_expire_message_alignment',
          [
              'label' => esc_html__( 'Text Alignment', 'elementor' ),
              'type' => Controls_Manager::CHOOSE,
              'label_block' => true,
              'options' => [
                  'left' => [
                      'title' => esc_html__( 'Left', 'elementor' ),
                      'icon' => 'eicon-text-align-left',
                  ],
                  'center' => [
                      'title' => esc_html__( 'Center', 'elementor' ),
                      'icon' => 'eicon-text-align-center',
                  ],
                  'right' => [
                      'title' => esc_html__( 'Right', 'elementor' ),
                      'icon' => 'eicon-text-align-right',
                  ],
              ],
              'default' => 'left',
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-finish-message' => 'text-align: {{VALUE}};',
              ],
          ]
      );

      $this->add_control(
          'heading_pt_countdown_expire_title',
          [
              'label'		=> __( 'Title Style', 'elementor' ),
              'type'		=> Controls_Manager::HEADING,
              'separator'	=> 'before'
          ]
      );

      $this->add_control(
          'pt_countdown_expire_title_color',
          [
              'label'		=> esc_html__( 'Title Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default'	=> '',
              'selectors'	=> [
                  '{{WRAPPER}} .pt-countdown-finish-message .expiry-title' => 'color: {{VALUE}};',
              ],
              'condition'	=> [
                  'countdown_expire_type' => 'text',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name'			=> 'pt_countdown_expire_title_typography',
              'scheme'	=> Typography::TYPOGRAPHY_2,
              'selector'	=> '{{WRAPPER}} .pt-countdown-finish-message .expiry-title',
              'condition'	=> [
                  'countdown_expire_type' => 'text',
              ],
          ]
      );

      $this->add_responsive_control(
          'pt_expire_title_margin',
          [
              'label' => esc_html__( 'Margin', 'elementor' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', 'em' ],
              'selectors' => [
                  '{{WRAPPER}} .pt-countdown-finish-message .expiry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
              ],
          ]
      );

      $this->add_control(
          'heading_pt_countdown_expire_message',
          [
              'label'		=> __( 'Content Style', 'elementor' ),
              'type'		=> Controls_Manager::HEADING,
              'separator'	=> 'before'
          ]
      );

      $this->add_control(
          'pt_countdown_expire_message_color',
          [
              'label'		=> esc_html__( 'Text Color', 'elementor' ),
              'type'		=> Controls_Manager::COLOR,
              'default'	=> '',
              'selectors'	=> [
                  '{{WRAPPER}} .pt-countdown-finish-text' => 'color: {{VALUE}};',
              ],
              'condition'	=> [
                  'countdown_expire_type' => 'text',
              ],
          ]
      );

      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
           'name'			=> 'pt_countdown_expire_message_typography',
              'scheme'	=> Typography::TYPOGRAPHY_2,
              'selector'	=> '.pt-countdown-finish-text',
              'condition'	=> [
                  'countdown_expire_type' => 'text',
              ],
          ]
      );

      $this->add_responsive_control(
          'pt_countdown_expire_message_padding',
          [
              'label'			=> esc_html__( 'Padding', 'elementor' ),
              'type'			=> Controls_Manager::DIMENSIONS,
              'size_units'	=> [ 'px', '%', 'em' ],
              'separator'		=> 'before',
              'selectors'		=> [
                  '{{WRAPPER}} .pt-countdown-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              ],
              'condition' => [
                  'countdown_expire_type' => 'text',
              ],
          ]
      );

      $this->end_controls_section();
      

  }


  protected function render( ) {
      
    $settings = $this->get_settings();
      
      $get_due_date =  esc_attr($settings['pt_countdown_due_time']);
      $due_date = date("M d Y G:i:s", strtotime($get_due_date));
      if( 'style-1' === $settings['pt_section_countdown_style'] ) {
          $pt_countdown_style = 'style-1';
      }elseif( 'style-2' === $settings['pt_section_countdown_style'] ) {
          $pt_countdown_style = 'style-2';
      }elseif( 'style-3' === $settings['pt_section_countdown_style'] ) {
          $pt_countdown_style = 'style-3';
      }

      if( 'template' == $settings['countdown_expire_type'] ) {
          if ( !empty( $settings['countdown_expiry_templates'] ) ) {
              $pt_template_id = $settings['countdown_expiry_templates'];
              $pt_frontend = new Frontend;
              $template =  $pt_frontend->get_builder_content( $pt_template_id, true );
          }
      }
      
      $this->add_render_attribute( 'pt-countdown', 'class', 'pt-countdown-wrapper' );
      $this->add_render_attribute( 'pt-countdown', 'data-countdown-id', esc_attr($this->get_id()) );
      $this->add_render_attribute( 'pt-countdown', 'data-expire-type', $settings['countdown_expire_type'] );

      if ( $settings['countdown_expire_type'] == 'text' ) {
          if( ! empty($settings['countdown_expiry_text']) ) {
              $this->add_render_attribute( 'pt-countdown', 'data-expiry-text', wp_kses_post($settings['countdown_expiry_text']) );
          }
             
          if( ! empty($settings['countdown_expiry_text_title']) ) {
              $this->add_render_attribute('pt-countdown', 'data-expiry-title', wp_kses_post($settings['countdown_expiry_text_title']) );
          }
      }
      elseif ( $settings['countdown_expire_type'] == 'url' ) {
          $this->add_render_attribute( 'pt-countdown', 'data-redirect-url', $settings['countdown_expiry_redirection'] );
      }
      elseif ( $settings['countdown_expire_type'] == 'template' ) {
          $this->add_render_attribute( 'pt-countdown', 'data-template', esc_attr($template) );
      }
      else {
         //do nothing
      }

  ?>

  <div <?php echo $this->get_render_attribute_string( 'pt-countdown' ); ?>>
      <div class="pt-countdown-container <?php echo esc_attr($settings['pt_countdown_label_view'] ); ?> <?php echo esc_attr($settings['pt_countdown_separator'] ); ?>">
          <ul id="pt-countdown-<?php echo esc_attr($this->get_id()); ?>" class="pt-countdown-items <?php echo esc_attr( $pt_countdown_style ); ?>" data-date="<?php echo esc_attr($due_date) ; ?>">
              <?php if ( ! empty( $settings['pt_countdown_days'] ) ) : ?><li class="pt-countdown-item"><div class="pt-countdown-days"><span data-days class="pt-countdown-digits">00</span><?php if ( ! empty( $settings['pt_countdown_days_label'] ) ) : ?><span class="pt-countdown-label"><?php echo esc_attr($settings['pt_countdown_days_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
              <?php if ( ! empty( $settings['pt_countdown_hours'] ) ) : ?><li class="pt-countdown-item"><div class="pt-countdown-hours"><span data-hours class="pt-countdown-digits">00</span><?php if ( ! empty( $settings['pt_countdown_hours_label'] ) ) : ?><span class="pt-countdown-label"><?php echo esc_attr($settings['pt_countdown_hours_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
             <?php if ( ! empty( $settings['pt_countdown_minutes'] ) ) : ?><li class="pt-countdown-item"><div class="pt-countdown-minutes"><span data-minutes class="pt-countdown-digits">00</span><?php if ( ! empty( $settings['pt_countdown_minutes_label'] ) ) : ?><span class="pt-countdown-label"><?php echo esc_attr($settings['pt_countdown_minutes_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
             <?php if ( ! empty( $settings['pt_countdown_seconds'] ) ) : ?><li class="pt-countdown-item"><div class="pt-countdown-seconds"><span data-seconds class="pt-countdown-digits">00</span><?php if ( ! empty( $settings['pt_countdown_seconds_label'] ) ) : ?><span class="pt-countdown-label"><?php echo esc_attr($settings['pt_countdown_seconds_label'] ); ?></span><?php endif; ?></div></li><?php endif; ?>
          </ul>
          <div class="clearfix"></div>
      </div>
  </div>
  
  <?php
  
  }

 
}