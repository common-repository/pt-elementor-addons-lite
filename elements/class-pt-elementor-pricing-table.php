<?php
/**
 * class-pt-elementor-pricing-table.php
 *
 * @author    Param Themes <paramthemes@gmail.com>
 * @copyright 2018 Param Themes
 * @license   Param Theme
 * @package   Elementor
 * @see       https://www.paramthemes.com
 */
 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Pt_Elementor_Pricing_Tables extends Widget_Base {

	public function get_name() {
		return 'pt-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Tables', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

   public function get_categories() {
		return [ 'pt-elementor-addons' ];
	}

	protected function _register_controls() {
		
		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'pt_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Settings', 'elementor' )
  			]
  		);

  		$this->add_control(
		  'pt_pricing_table_style',
		  	[
		   	'label'       	=> esc_html__( 'Pricing Style', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'style-1'  	=> esc_html__( 'Default', 'elementor' ),
		     		'style-2' 	=> esc_html__( 'Pricing Style 2', 'elementor' ),
		     		'style-3' 	=> esc_html__( 'Pricing Style 3', 'elementor' ),
		     	],
		  	]
		);
		
		$this->add_control(
			'pt_pricing_table_style_pro_alert',
			[
				'label' => esc_html__( 'Only available in pro version!', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'pt_pricing_table_style' => [],
				]
			]
		);
		
		$this->end_controls_section();
		
		
		/**
		  * Price Table Content Settings
		*/
	  $this->start_controls_section(
		'pt_section_img_accordion_settings',
		[
		  'label' => esc_html__( 'Price Table Settings', 'elementor' )
		]
	  );
		  
	  $this->add_control(
        'pt_price_accordions',
        [
          'type' => Controls_Manager::REPEATER,
          'seperator' => 'before',
          'default' => [
			[ 'pt_pricing_table_price' => '99' ],
			[ 'pt_pricing_table_price' => '100' ],
			[ 'pt_pricing_table_price' => '101' ],
          ],
          'fields' => [
			/*setting start*/
			[
              'name' => 'pt_pricing_table_title',
              'label' => esc_html__( 'Title', 'elementor' ),
			  'type' => Controls_Manager::TEXT,
			  'label_block' => false,
			   'default' => esc_html__( 'Startup', 'elementor' )
            ],
			
			[
				'name' => 'pt_pricing_table_sub_title',
				'label' => esc_html__( 'Sub Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'A tagline here.', 'elementor' )
			],
			
			[
				'name' => 'pt_pricing_table_style_2_icon',
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
			],
			/*setting end*/
		    
			/* start price */
			[
				'name' => 'pt_pricing_table_price',
				'label' => esc_html__( 'Price', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '99', 'elementor' )
			],
			
			[
				'name' => 'pt_pricing_table_price_cur',
				'label' => esc_html__( 'Price Currency', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( '$', 'elementor' ),
			],
			
		  	[
			'name' => 'pt_pricing_table_price_cur_placement',
		   	'label'       	=> esc_html__( 'Currency Placement', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'left',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'left'  	=> esc_html__( 'Left', 'elementor' ),
		     		'left-sup'  => esc_html__( 'Left (Sup)', 'elementor' ),
		     		'right'  	=> esc_html__( 'Right', 'elementor' ),
		     		'right-sup' => esc_html__( 'Right (Sup)', 'elementor' ),
		     	],
		  	],
			
			[
				'name' => 'pt_pricing_table_price_period',
				'label' => esc_html__( 'Price Period (per)', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'month', 'elementor' )
			],
			/* end price */
			
			/*feature start*/
			[
              'name' => 'pt_pricing_table_content',
              'label' => esc_html__( 'Content', 'elementor' ),
              'type' => Controls_Manager::TEXTAREA,
              'label_block' => true,
              'default' => esc_html__( 'Accordion content goes here!', 'elementor' )
            ],
			/*feature end */
			
			/*start button footer */
			[
				'name' => 'pt_pricing_table_button_icon',
				'label' => esc_html__( 'Button Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
			],
			
			
			[
				'name' => 'pt_pricing_table_button_icon_alignment',
				'label' => esc_html__( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'elementor' ),
					'right' => esc_html__( 'After', 'elementor' ),
				],
				'condition' => [
					'pt_pricing_table_button_icon!' => '',
				],
			],
			
			[
				'name' => 'pt_pricing_table_btn',
				'label' => esc_html__( 'Button Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Choose Plan', 'elementor' ),
			],
			
			[
				'name' => 'pt_pricing_table_btn_link',
				'label' => esc_html__( 'Button Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => '#',
        			'is_external' => '',
     			],
     			'show_external' => true,
			],
			/*end button footer */
			
			
			
			/*start feture robon start */
			[
				'name' => 'pt_pricing_table_featured',
				'label' => esc_html__( 'Featured?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
			],
			
			[
				'name' => 'pt_pricing_table_featured_styles',
				'label' => esc_html__( 'Ribbon Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ribbon-1',
				'options' => [
					'ribbon-1' => esc_html__( 'Style 1', 'elementor' ),
					'ribbon-2' => esc_html__( 'Style 2', 'elementor' ),
					'ribbon-3' => esc_html__( 'Style 3', 'elementor' ),
				],
				'condition' => [
					'pt_pricing_table_featured' => 'yes',
				],
			],
			
			[
				'name' => 'pt_pricing_table_featured_tag_text',
				'label' => esc_html__( 'Featured Tag Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => esc_html__( 'Featured', 'elementor' ),
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.featured:before' => 'content: "{{VALUE}}";',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.featured:before' => 'content: "{{VALUE}}";',
				],
				'condition' => [
					'pt_pricing_table_featured_styles' => [ 'ribbon-2', 'ribbon-3' ],
					'pt_pricing_table_featured' => 'yes'
				]
			],
			
			/*end feture robon start */
          ],
          'title_field' => '{{pt_pricing_table_title}}',
        ]
      );
	  
	  $this->end_controls_section();
	  
  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'pt_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Settings', 'elementor' )
  			]
  		);

  		$this->add_control(
		  'pt_pricing_table_style',
		  	[
		   	'label'       	=> esc_html__( 'Pricing Style', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'style-1',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'style-1'  	=> esc_html__( 'Default', 'elementor' ),
		     		'style-2' 	=> esc_html__( 'Pricing Style 2', 'elementor' ),
		     		'style-3' 	=> esc_html__( 'Pricing Style 3', 'elementor' ),
		     		'style-4' 	=> esc_html__( 'Pricing Style 4', 'elementor' ),
		     	],
		  	]
		);

		$this->add_control(
			'pt_pricing_table_style_pro_alert',
			[
				'label' => esc_html__( 'Only available in pro version!', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'pt_pricing_table_style' => ['style-3', 'style-4'],
				]
			]
		);
  		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_pricing_table_style_settings',
			[
				'label' => esc_html__( 'Pricing Table Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_pricing_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing .pt-pricing-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_container_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-pricing .pt-pricing-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_container_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-pricing .pt-pricing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pt_pricing_table_border',
				'label' => esc_html__( 'Border Type', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-pricing .pt-pricing-item',
			]
		);

		$this->add_control(
			'pt_pricing_table_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing .pt-pricing-item' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_pricing_table_shadow',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing .pt-pricing-item',
				],
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'elementor' ),
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
				'default' => 'center',
				'prefix_class' => 'pt-pricing-content-align-',
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_content_button_alignment',
			[
				'label' => esc_html__( 'Button Alignment', 'elementor' ),
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
				'default' => 'center',
				'prefix_class' => 'pt-pricing-button-align-',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_pricing_table_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'pt_pricing_table_title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .header .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item:hover .header:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => ['style-2']
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_title3_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .header .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item:hover .header:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => ['style-3']
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_style_2_title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#007fc0',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .header' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item .header' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style!' => ['style-3']
				]
			]
		);


		$this->add_control(
			'pt_pricing_table_style_3_title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#19000e',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item .header' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => ['style-3']
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_style_1_title_line_color',
			[
				'label' => esc_html__( 'Line Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#dbdbdb',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item .header:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => ['style-1']
				]
			]
		);

		


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'pt_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .header .title',
			]
		);

		$this->add_control(
			'pt_pricing_table_subtitle_heading',
			[
				'label' => esc_html__( 'Subtitle Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'pt_pricing_table_style!' => 'style-1'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_subtitle_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .header .subtitle' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style!' => 'style-1'
				]
			]
		);


		$this->add_control(
			'pt_pricing_table_subtitle3_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .header .subtitle' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => 'style-3'
				]
			]
		);



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'pt_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .header .subtitle',
				'condition' => [
					'pt_pricing_table_style!' => 'style-1'
				]
			]

		);

		$this->add_control(
			'pt_pricing_table_price_tag_heading',
			[
				'label' => esc_html__( 'Price Tag Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'pt_pricing_table_pricing_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .price-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'pt_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .price-tag',
			]
		);

		$this->add_control(
			'pt_pricing_table_price_currency_heading',
			[
				'label' => esc_html__( 'Price Currency Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'pt_pricing_table_pricing_curr_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#007fc0',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .price-tag .price-currency' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style!' => 'style-3'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table3_pricing_curr_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#19000e',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .price-tag .price-currency' => 'color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_style' => 'style-3'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'pt_pricing_table_price_cur_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .price-currency',
			]
		);

		$this->add_control(
			'pt_pricing_table_pricing_period_heading',
			[
				'label' => esc_html__( 'Pricing Period Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'pt_pricing_table_pricing_period_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .price-period' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'pt_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .price-period',
			]
		);

		$this->add_control(
			'pt_pricing_table_price_list_heading',
			[
				'label' => esc_html__( 'Feature List Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'pt_pricing_table_list_item_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing-item .body ul li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
            'name' => 'pt_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .pt-pricing-item .body ul li',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_pricing_table_style_3_featured_tag_settings',
			[
				'label' => esc_html__( 'Ribbon Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pt_pricing_table_style_1_featured_bar_color',
			[
				'label' => esc_html__( 'Line Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#007fc0',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-1:before' => 'background: {{VALUE}};',
				],
/* 				'condition' => [
					'pt_pricing_table_featured' => 'yes',
					'pt_pricing_table_featured_styles' => 'ribbon-1'
				], */
			]
		);
		
		$this->add_control(
			'pt_pricing_table_style_1_featured_bar_height',
			[
				'label' => esc_html__( 'Line Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-1:before' => 'height: {{SIZE}}px;',
				],
				/* 'condition' => [
					'pt_pricing_table_featured' => 'yes',
					'pt_pricing_table_featured_styles' => 'ribbon-1'
				], */
			]
		);

		$this->add_control(
			'pt_pricing_table_featured_tag_font_size',
			[
				'label' => esc_html__( 'Font Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10
				],
				'range' => [
					'px' => [
						'max' => 18,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-2:before' => 'font-size: {{SIZE}}px;',

					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-3:before' => 'font-size: {{SIZE}}px;',

				],
				/* 'condition' => [
					'pt_pricing_table_featured' => 'yes',
					'pt_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3']
				], */
			]
		);

		$this->add_control(
			'pt_pricing_table_featured_tag_text_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-2:before' => 'color: {{VALUE}};',

					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-3:before' => 'color: {{VALUE}};',
				],
				/* 'condition' => [
					'pt_pricing_table_featured' => 'yes',
					'pt_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3']
				], */
			]
		);

		$this->add_control(
			'pt_pricing_table_featured_tag_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-1 .pt-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',

					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-2:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .pt-pricing.style-4 .pt-pricing-item.ribbon-3:before' => 'background: {{VALUE}};',
				],
				/* 'condition' => [
					'pt_pricing_table_featured' => 'yes',
					'pt_pricing_table_featured_styles' => ['ribbon-2', 'ribbon-3']
				], */
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Icon Style)
		 * Condition: 'pt_pricing_table_style' => 'style-2'
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_pricing_table_icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pt_pricing_table_style' => 'style-2',
					'pt_pricing_table_style' => 'style-3'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_bg_show',
			[
				'label' => __( 'Show Background', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'return_value' => 'yes',
			]
		);

		/*style 3*/
		

		/**
		 * Condition: 'pt_pricing_table_icon_bg_show' => 'yes'
		 */
		$this->add_control(
			'pt_pricing_table_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes',
					'pt_pricing_table_style' => 'style-2'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table3_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#19000e',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes',
					'pt_pricing_table_style' => 'style-3'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#19000e',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes'
				]
			]
		);



		$this->add_control(
			'pt_pricing_table_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes'
				]
			]
		);

	
		/**
		 * Condition: 'pt_pricing_table_icon_bg_show' => 'yes'
		 */
		$this->add_control(
			'pt_pricing_table_icon_bg_hover_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item:hover .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes'
				],
				'separator'=> 'after',
			]
		);


		$this->add_control(
			'pt_pricing_table3_icon_bg_hover_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#8b8689',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-3 .pt-pricing-item:hover .pt-pricing-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_bg_show' => 'yes',
					'pt_pricing_table_style' => 'style-3'
				],
				'separator'=> 'after',
			]
		);

		


		$this->add_control(
			'pt_pricing_table_icon_settings',
			[
				'label' => esc_html__( 'Icon Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon i' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_area_width',
			[
				'label' => esc_html__( 'Icon Area Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon' => 'width: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_area_height',
			[
				'label' => esc_html__( 'Icon Area Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon' => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_line_height',
			[
				'label' => esc_html__( 'Icon Alignment', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80
				],
				'range' => [
					'px' => [
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon i' => 'line-height: {{SIZE}}px;',
				],
			]
		);



		$this->add_control(
			'pt_pricing_table_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item:hover .pt-pricing-icon .icon i' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'pt_pricing_table_icon_border',
					'label' => esc_html__( 'Border', 'elementor' ),
					'selector' => '{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon',
				]
		);

		$this->add_control(
			'pt_pricing_table_icon_border_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item:hover .pt-pricing-icon .icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'pt_pricing_table_icon_border_border!' => ''
				]
			]
		);

		$this->add_control(
			'pt_pricing_table_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-pricing.style-2 .pt-pricing-item .pt-pricing-icon .icon' => 'border-radius: {{SIZE}}%;',
				],
			]
		);

		$this->end_controls_section();

		
		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'pt_pricing_table_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
	         'name' => 'pt_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .pt-pricing .pt-pricing-button',
			]
		);

		$this->start_controls_tabs( 'pt_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'pt_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', 'elementor' ) ] );

			$this->add_control(
				'pt_pricing_table_btn_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'pt_pricing_table_btn_normal_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#007fc0',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'background: {{VALUE}};',
					],
					'condition' => [
						'pt_pricing_table_style!' => 'style-3'
					]
				]
			);

			$this->add_control(
				'pt_pricing_table3_btn_normal_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#19000e',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'background: {{VALUE}};',
					],
					'condition' => [
						'pt_pricing_table_style' => 'style-3'
					]
				]
			);
			


			$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'pt_pricing_table_btn_border',
					'label' => esc_html__( 'Border', 'elementor' ),
					'selector' => '{{WRAPPER}} .pt-pricing .pt-pricing-button',
				]
			);

			$this->add_control(
				'pt_pricing_table_btn_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'elementor' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button' => 'border-radius: {{SIZE}}px;',
					],
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'pt_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'elementor' ) ] );

			$this->add_control(
				'pt_pricing_table_btn_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#f9f9f9',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'pt_pricing_table_btn_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#03b048',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button:hover' => 'background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'pt_pricing_table3_btn_hover_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#8b8689',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button:hover' => 'background: {{VALUE}};',
					],
					'condition' => [
						'pt_pricing_table_style' => 'style-3'
					]
				]
			);

			$this->add_control(
				'pt_pricing_table_btn_hover_border_color',
				[
					'label' => esc_html__( 'Border Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .pt-pricing .pt-pricing-button:hover' => 'border-color: {{VALUE}};',
					],
				]

			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_cta_button_shadow',
				'selector' => '{{WRAPPER}} .pt-pricing .pt-pricing-button',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();
		

	}


	protected function render( ) {

   	$settings = $this->get_settings();
      $pricing_table_image = $this->get_settings( 'pt_pricing_table_image' );
	  	$pricing_table_image_url = Group_Control_Image_Size::get_attachment_image_src( $pricing_table_image['id'], 'thumbnail', $settings );
		$target = $settings['pt_pricing_table_btn_link']['is_external'] ? 'target="_blank"' : '';
		$nofollow = $settings['pt_pricing_table_btn_link']['nofollow'] ? 'rel="nofollow"' : '';
		
		/*if( 'yes' === $settings['pt_pricing_table_featured'] ) : $featured_class = 'featured '.$settings['pt_pricing_table_featured_styles']; else : $featured_class = ''; endif;*/
		/*print_r($settings['pt_pricing_table_style']);
		die();*/
	?>
	<?php if( 'style-1' === $settings['pt_pricing_table_style'] ) : ?>
	<div class="flex-container">
	 <?php 
		if( !empty($settings['pt_price_accordions']) ) :
		 foreach( $settings['pt_price_accordions'] as $data ) : 
		 ?>
		 <?php 
			if( 'yes' === $data['pt_pricing_table_featured'] ) : 
				if($data['pt_pricing_table_featured_styles'] != "ribbon-1"){
					$featured_class = 'featured '.$data['pt_pricing_table_featured_styles'];
				}else{
					$featured_class = $data['pt_pricing_table_featured_styles'];
				}
			else : 
				$featured_class = '';
			endif;
		 ?>
		 
	 <div class="pt-pricing style-1">
	    <div class="pt-pricing-item <?php echo esc_attr( $featured_class ); ?>">
	        <div class="header">
	            <h2 class="title"><?php echo $data['pt_pricing_table_title']; ?></h2>
	        </div>
	        <div class="pt-pricing-tag">
	            <span class="price-tag">
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left' ) : ?>
						<span class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span> 
					<?php endif; ?>
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left-sup' ) : ?>
					<sup class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
					</sup> 
					<?php endif; ?>
					<?php echo $data['pt_pricing_table_price'] ?>
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right' ) : ?>
					<span class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
					</span>
					<?php endif; ?>
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right-sup' ) : ?>
						<sup class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</sup>
					<?php endif; ?>
				</span> 
				<span class="price-period">
				<?php echo $data['pt_pricing_table_period_separator']; ?>
				<?php echo $data['pt_pricing_table_price_period']; ?>
				</span>
	        </div>
	        <div class="body">
	            <ul>
					<li>
						<?php echo $data['pt_pricing_table_content']; ?>
					</li>
	            </ul>
	        </div>
	        <div class="footer">
		    	<a href="<?php echo esc_url( $data['pt_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pt-pricing-button">
		    		<?php if( 'left' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
						<?php echo $data['pt_pricing_table_btn']; ?>
					<?php elseif( 'right' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<?php echo $data['pt_pricing_table_btn']; ?>
		        		<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
		        	<?php endif; ?>
		    	</a>
		    </div>
	    </div>
	  </div>
	  <?php endforeach; ?>
	  <?php endif; ?>
	</div>
	<?php elseif( 'style-2' === $settings['pt_pricing_table_style'] ) : ?>
	<div class="flex-container">
	 <?php 
		if( !empty($settings['pt_price_accordions']) ) :
		 foreach( $settings['pt_price_accordions'] as $data ) : 
		 ?>
		  <?php 
			if( 'yes' === $data['pt_pricing_table_featured'] ) : 
				if($data['pt_pricing_table_featured_styles'] != "ribbon-1"){
					$featured_class = 'featured '.$data['pt_pricing_table_featured_styles'];
				}else{
					$featured_class = $data['pt_pricing_table_featured_styles'];
				}
			else : 
				$featured_class = ''; 
			endif;
		 ?>
	<div class="pt-pricing style-2">
	    <div class="pt-pricing-item <?php echo esc_attr( $featured_class ); ?>">
	        <div class="pt-pricing-icon">
	            <span class="icon" style="background:<?php if('yes' != $settings['pt_pricing_table_icon_bg_show']) : echo 'none'; endif;  ?>;">
				<i class="<?php echo esc_attr( $data['pt_pricing_table_style_2_icon'] ); ?>"></i>
				</span>
	        </div>
	        <div class="header">
	            <h2 class="title"><?php echo $data['pt_pricing_table_title']; ?></h2>
	            <span class="subtitle"><?php echo $data['pt_pricing_table_sub_title']; ?></span>
	        </div>
	        <div class="pt-pricing-tag">
	            <span class="price-tag">
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left' ) : ?>
						<span class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span>
					<?php endif; ?>
					
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left-sup' ) : ?>
					<sup class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
					</sup> 
					<?php endif; ?> 
					
					<?php echo $data['pt_pricing_table_price'] ?> 
					
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right' ) : ?>
						<span class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span>
					<?php endif; ?>
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right-sup' ) : ?>
						<sup class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</sup>
					<?php endif; ?>
				</span> 
				<span class="price-period">
					<?php echo $data['pt_pricing_table_period_separator']; ?> 
					<?php echo $data['pt_pricing_table_price_period']; ?>
				</span>
	        </div>
	        <div class="body">
	            <ul>
					<li>
						<?php echo $data['pt_pricing_table_content']; ?>
					</li>
	            </ul>
	        </div>
	        <div class="footer">
		    	<a href="<?php echo esc_url( $data['pt_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pt-pricing-button">
		    		<?php if( 'left' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
						<?php echo $data['pt_pricing_table_btn']; ?>
					<?php elseif( 'right' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<?php echo $data['pt_pricing_table_btn']; ?>
		        		<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
		        	<?php endif; ?>
		    	</a>
		    </div>
	    </div>
	</div>
	<?php endforeach; ?>
	  <?php endif; ?>
	</div>
	<?php elseif( 'style-3' === $settings['pt_pricing_table_style'] ) : ?>
	<div class="flex-container">
	 <?php 
		if( !empty($settings['pt_price_accordions']) ) :
		 foreach( $settings['pt_price_accordions'] as $data ) : 
		 ?>
		  <?php 
			if( 'yes' === $data['pt_pricing_table_featured'] ) : 
				if($data['pt_pricing_table_featured_styles'] != "ribbon-1"){
					$featured_class = 'featured '.$data['pt_pricing_table_featured_styles'];
				}else{
					$featured_class = $data['pt_pricing_table_featured_styles'];
				}
			else : 
				$featured_class = ''; 
			endif;
		 ?>
	<div class="pt-pricing style-3">
	    <div class="pt-pricing-item <?php echo esc_attr( $featured_class ); ?>">
	        
	        <div class="header">
	            <h2 class="title"><?php echo $data['pt_pricing_table_title']; ?></h2>
	            <span class="subtitle"><?php echo $data['pt_pricing_table_sub_title']; ?></span>
	        </div>

	        <div class="pt-pricing-icon">
	            <span class="icon" style="background:<?php if('yes' != $settings['pt_pricing_table_icon_bg_show']) : echo 'none'; endif;  ?>;">
				<i class="<?php echo esc_attr( $data['pt_pricing_table_style_2_icon'] ); ?>"></i>
				</span>
	        </div>
	        <div class="pt-pricing-tag">
	            <span class="price-tag">
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left' ) : ?>
						<span class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span>
					<?php endif; ?>
					
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left-sup' ) : ?>
					<sup class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
					</sup> 
					<?php endif; ?> 
					
					<?php echo $data['pt_pricing_table_price'] ?> 
					
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right' ) : ?>
						<span class="price-currency">
						<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span>
					<?php endif; ?>
					<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right-sup' ) : ?>
						<sup class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</sup>
					<?php endif; ?>
				</span> 
				<span class="price-period">
					<?php echo $data['pt_pricing_table_period_separator']; ?> 
					<?php echo $data['pt_pricing_table_price_period']; ?>
				</span>
	        </div>
	        <div class="body">
	            <ul>
					<li>
						<?php echo $data['pt_pricing_table_content']; ?>
					</li>
	            </ul>
	        </div>
	        <div class="footer">
		    	<a href="<?php echo esc_url( $data['pt_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pt-pricing-button">
		    		<?php if( 'left' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
						<?php echo $data['pt_pricing_table_btn']; ?>
					<?php elseif( 'right' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
						<?php echo $data['pt_pricing_table_btn']; ?>
		        		<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
		        	<?php endif; ?>
		    	</a>
		    </div>
	    </div>
	</div>
	<?php endforeach; ?>
	  <?php endif; ?>
	</div>
	<?php elseif( 'style-4' === $settings['pt_pricing_table_style'] ) : 
	?>
		<div class="flex-container">
		 <?php 
			if( !empty($settings['pt_price_accordions']) ) :
			 foreach( $settings['pt_price_accordions'] as $data ) : 
			 ?>
			 <?php 
				if( 'yes' === $data['pt_pricing_table_featured'] ) : 
					if($data['pt_pricing_table_featured_styles'] != "ribbon-1"){
						$featured_class = 'featured '.$data['pt_pricing_table_featured_styles'];
					}else{
						$featured_class = $data['pt_pricing_table_featured_styles'];
					}
				else : 
					$featured_class = '';
				endif;
			 ?>
			 
		 <div class="pt-pricing style-4">
			<div class="pt-pricing-item <?php echo esc_attr( $featured_class ); ?>">
				<div class="header">
					<h2 class="title"><?php echo $data['pt_pricing_table_title']; ?></h2>
				</div>
				<div class="pt-pricing-tag">
					<span class="price-tag">
						<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left' ) : ?>
							<span class="price-currency">
								<?php echo $data['pt_pricing_table_price_cur']; ?>
							</span> 
						<?php endif; ?>
						<?php if( $data['pt_pricing_table_price_cur_placement'] == 'left-sup' ) : ?>
						<sup class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</sup> 
						<?php endif; ?>
						<?php echo $data['pt_pricing_table_price'] ?>
						<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right' ) : ?>
						<span class="price-currency">
							<?php echo $data['pt_pricing_table_price_cur']; ?>
						</span>
						<?php endif; ?>
						<?php if( $data['pt_pricing_table_price_cur_placement'] == 'right-sup' ) : ?>
							<sup class="price-currency">
								<?php echo $data['pt_pricing_table_price_cur']; ?>
							</sup>
						<?php endif; ?>
					</span> 
					<span class="price-period">
					<?php echo $data['pt_pricing_table_period_separator']; ?>
					<?php echo $data['pt_pricing_table_price_period']; ?>
					</span>
				</div>
				<div class="body">
					<ul>
						<li>
							<?php echo $data['pt_pricing_table_content']; ?>
						</li>
					</ul>
				</div>
				<div class="footer">
					<a href="<?php echo esc_url( $data['pt_pricing_table_btn_link']['url'] ); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="pt-pricing-button">
						<?php if( 'left' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
							<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-left"></i>
							<?php echo $data['pt_pricing_table_btn']; ?>
						<?php elseif( 'right' == $data['pt_pricing_table_button_icon_alignment'] ) : ?>
							<?php echo $data['pt_pricing_table_btn']; ?>
							<i class="<?php echo esc_attr( $data['pt_pricing_table_button_icon'] ); ?> fa-icon-right"></i>
						<?php endif; ?>
					</a>
				</div>
			</div>
		  </div>
		  <?php endforeach; ?>
		  <?php endif; ?>
		</div>
	<?php endif; ?>
	<?php
	}

	protected function content_template() { 
		?>
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Pt_Elementor_Pricing_Tables() );