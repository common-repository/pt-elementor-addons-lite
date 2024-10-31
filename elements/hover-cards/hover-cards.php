<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\HoverCards;



// If this file is called directly, abort.



if (!defined('ABSPATH')) {



    exit;



}



use \Elementor\Utils;



use \Elementor\Frontend;



use \Elementor\Controls_Manager as Controls_Manager;



use \Elementor\Group_Control_Background;



use \Elementor\Group_Control_Border;



use \Elementor\Group_Control_Typography;



use \Elementor\Core\Schemes\Typography;



use \Elementor\Core\Schemes\Color;



use \Elementor\Group_Control_Box_Shadow;



use \Elementor\Group_Control_Text_Shadow;



use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;



use \Elementor\Widget_Base as Widget_Base;



use \Pt_Addons_Elementor\Classes\Bootstrap;







class Hover_Cards extends Widget_Base {



	/**



	 * Define our get name settings.



	 */



	public function get_name() {



		return 'pt-hover-cards';



	}



	/**



	 * Define our get title settings.



	 */



	public function get_title() {



		return __( 'Hover Cards', 'elementor' );



	}



	/**



	 * Define our get icon settings.



	 */



	public function get_icon() {



		return 'eicon-gallery-grid wks-pt-pe';



	}



	/**



	 * Define our get categories settings.



	 */



	public function get_categories() {



		return [ 'pt-addons-elementor' ];



	}



	/**



	 * Define our _register_controls settings.



	 */



	protected function _register_controls() {



		$this->start_controls_section(



			'section_general',



			[



				'label' => __( 'General', 'elementor' ),



			]



		);



		$this->add_control(



			'hover_card_title',



			[



				'label' => __( 'Title', 'elementor' ),



				'type' => Controls_Manager::TEXT,



				'placeholder' => __( 'Enter text', 'elementor' ),



				'default' => __( 'Text Title', 'elementor' ),



			]



		);



		$this->add_control(



			'title_html_tag',



			[



				'label' => __( 'HTML Tag', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [


					'span' => __( 'span', 'elementor' ),
					'h1' => __( 'H1', 'elementor' ),



					'h2' => __( 'H2', 'elementor' ),



					'h3' => __( 'H3', 'elementor' ),



					'h4' => __( 'H4', 'elementor' ),



					'h5' => __( 'H5', 'elementor' ),



					'h6' => __( 'H6', 'elementor' ),



				],



				'default' => 'h3',



			]



		);



		$this->add_control(



			'card_title_position',



			[



				'label' => __( 'Title Position', 'elementor' ),



				'type' => Controls_Manager::CHOOSE,



				'default' => 'top',



				'options' => [



					'left' => [



						'title' => __( 'Left', 'elementor' ),



						'icon' => 'eicon-text-align-left',



					],



					'center' => [



						'title' => __( 'center', 'elementor' ),



						'icon' => 'eicon-text-align-center',



					],



					'right' => [



						'title' => __( 'Right', 'elementor' ),



						'icon' => 'eicon-text-align-right',



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-hover-card .pt-hover-card-title' => 'text-align: {{VALUE}};',



				],



				'toggle' => false,



			]



		);



		$this->add_control(



			'card_title_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '#ffffff',



				'selectors' => [



					'{{WRAPPER}} div.pt-hover-card-title > * ' => 'color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),

			[

				'name' => 'card_title_typography',



				'selector' => '{{WRAPPER}}  div.pt-hover-card-title > * ',



				'scheme' => Typography::TYPOGRAPHY_1,



			]



		);



		$this->add_control(



			'hover_cards_style',



			[



				'label' => __( 'Hover Card Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'powerpack-style' => __( 'default', 'elementor' ),



					'style-1' => __( 'Style 1', 'elementor' ),



					'style-2' => __( 'Style 2', 'elementor' ),



					'style-3' => __( 'Style 3', 'elementor' ),



					'style-4' => __( 'Style 4', 'elementor' ),



					'style-5' => __( 'Style 5', 'elementor' ),



				],



				'default' => 'powerpack-style',



			]



		);



		$this->add_group_control(



			Group_Control_Background::get_type(),



			[



				'name' => 'box_background',



				'label' => __( 'Box Background', 'elementor' ),



				'types' => [ 'classic', 'gradient' ],



				'selector' => '{{WRAPPER}} .hover-card-bg',



			]



		);



		$this->add_control(



			'link',



			[



				'label' => __( 'Link', 'elementor' ),



				'type' => Controls_Manager::URL,



				'placeholder' => __( 'http://your-link.com', 'elementor' ),



				'show_label' => true,



			]



		);



		$this->add_control(



			'hover_card_box_height',



			[



				'label' => __( 'Card Box Height', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 300,



				],



				'range' => [



					'px' => [



						'min' => 250,



						'max' => 720,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-hover-card-container' => 'height: {{SIZE}}{{UNIT}};',



				],



			]



		);



		$this->end_controls_section();



		$this->start_controls_section(



			'section_style_content',



			[



				'label' => __( 'Hover', 'elementor' ),



			]



		);



		$this->add_control(



			'hover_card_description',



			[



				'label' => __( 'Description', 'elementor' ),



				'type' => Controls_Manager::WYSIWYG,



				'default' => __( 'I am text block. Click edit button to change this text. ', 'elementor' ),



			]



		);



		

		$this->add_control(



			'heading_title',



			[



				'label' => __( 'Title', 'elementor' ),



				'type' => Controls_Manager::HEADING,



				'separator' => 'before',



			]



		);



		$this->add_control(



			'hover_card_title_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .card-inner-wrap:hover .pt-hover-card-title>*' => 'color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_2,



				],



			]



		);



		$this->add_responsive_control(



			'hover_card_text_align',



			[



				'label' => __( 'Alignment', 'elementor' ),



				'type' => Controls_Manager::CHOOSE,



				'options' => [



					'left' => [



						'title' => __( 'Left', 'elementor' ),



						'icon' => 'eicon-text-align-left',



					],



					'center' => [



						'title' => __( 'Center', 'elementor' ),



						'icon' => 'eicon-text-align-center',



					],



					'right' => [



						'title' => __( 'Right', 'elementor' ),



						'icon' => 'eicon-text-align-right',



					],



				],



				'selectors' => [



					'{{WRAPPER}} .card-inner-wrap:hover .pt-hover-card-title'  => 'text-align: {{VALUE}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'hover_title_typography',



				'selector' => '{{WRAPPER}} .card-inner-wrap:hover .pt-hover-card-title>*',



				'scheme' => Typography::TYPOGRAPHY_2,



			]



		);



		$this->add_control(



			'hover_description',



			[



				'label' => __( 'Description', 'elementor' ),



				'type' => Controls_Manager::HEADING,



				'separator' => 'before',



			]



		);

		$this->add_responsive_control(



			'hover_card_description_align',



			[



				'label' => __( 'Alignment', 'elementor' ),



				'type' => Controls_Manager::CHOOSE,



				'options' => [



					'left' => [



						'title' => __( 'Left', 'elementor' ),



						'icon' => 'eicon-text-align-left',



					],



					'center' => [



						'title' => __( 'Center', 'elementor' ),



						'icon' => 'eicon-text-align-center',



					],



					'right' => [



						'title' => __( 'Right', 'elementor' ),



						'icon' => 'eicon-text-align-right',



					],



					'justify' => [



						'title' => __( 'Justified', 'elementor' ),



						'icon' => 'eicon-text-align-justify',



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-hover-card-description' => 'text-align: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'hover_description_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '#fff',



				'selectors' => [



					'{{WRAPPER}} .pt-hover-card-description' => 'color: {{VALUE}} !important;',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_3,



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'description_typography',



				'selector' => '{{WRAPPER}} .pt-hover-card-description>*',



				'scheme' => Typography::TYPOGRAPHY_3,



			]



		);



		$this->add_control(



			'hover_description_link_color',



			[



				'label' => __( 'Description Link Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-more-link:hover' => 'color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_3,



				],



			]



		);



		$this->end_controls_section();



		$this->start_controls_section(



			'section-action-button-style',



			[



				'label' => __( 'Action Button', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->add_control(



			'action_text',



			[



				'label' => __( 'Button Text', 'elementor' ),



				'type' => Controls_Manager::TEXT,



				'placeholder' => __( 'Read More', 'elementor' ),



				'default' => __( 'Read More', 'elementor' ),



			]



		);



		$this->add_control(



			'button_text_color',



			[



				'label' => __( 'Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '#fff',



				'selectors' => [



					'{{WRAPPER}} .pt-more-link' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'typography',



				'label' => __( 'Typography', 'elementor' ),



				'scheme' => Typography::TYPOGRAPHY_4,



				'selector' => '{{WRAPPER}} .pt-more-link',



			]



		);



		$this->add_control(



			'background_color',



			[



				'label' => __( 'Background Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_4,



				],



				'default' => '#93C64F',



				'selectors' => [



					'{{WRAPPER}} .pt-more-link' => 'background-color: {{VALUE}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Border::get_type(),



			[



				'name' => 'border',



				'label' => __( 'Border', 'elementor' ),



				'placeholder' => '1px',



				'default' => '1px',



				'selector' => '{{WRAPPER}} .pt-more-link',



			]



		);



		$this->add_control(



			'border_radius',



			[



				'label' => __( 'Border Radius', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-more-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



		$this->add_control(



			'text_padding',



			[



				'label' => __( 'Text Padding', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', 'em', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-more-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



		$this->end_controls_section();



	}



	/**



	 * Define our Content Render settings.



	 */



	protected function render() {



		$settings = $this->get_settings();



		$pt_hover_desc  = ! empty( $settings['hover_card_description'] ) ? $settings['hover_card_description'] : '';



		$this->add_render_attribute( 'hoverlink', 'class', 'link' );



		if ( ! empty( $settings['link']['url'] ) ) {



			$this->add_render_attribute( 'hoverlink', 'href', $settings['link']['url'] );







			if ( ! empty( $settings['link']['is_external'] ) ) {



				$this->add_render_attribute( 'hoverlink', 'target', '_blank' );



			}



		}



		?>



		<div class="pt-hover-card-container hover-card-bg <?php echo $settings [ 'hover_cards_style' ]; ?>">



		<?php if ( 'style-5' == $settings [ 'hover_cards_style' ] || 'style-1' == $settings [ 'hover_cards_style' ] || 'style-2' === $settings [ 'hover_cards_style' ] ) { ?>



		<div class="pt-hover-card">



				<div class="pt-hover-card-border"></div>



					<div class="pt-hover-card-inner">



						<div class="card-inner-wrap">



							<div class="pt-hover-card-title">



								<<?php echo $settings['title_html_tag']; ?>>



									<?php echo $settings['hover_card_title']; ?>



								</<?php echo $settings['title_html_tag']; ?>>



							</div>



							<div class="pt-hover-card-description">



								<?php echo $pt_hover_desc; ?>



							</div>



							<div class="pt-more-link-button">



								<a class="pt-more-link" <?php echo $this->get_render_attribute_string( 'hoverlink' ); ?>>



									<?php echo $settings['action_text']; ?>



								</a>



							</div>



						</div>



					</div>



			</div>



			



		<?php } ?>



		



		<?php if ( 'powerpack-style' === $settings['hover_cards_style'] || 'style-3' === $settings['hover_cards_style'] || 'style-4' === $settings['hover_cards_style'] ) { ?>



			<a class="pt-more-link-container" <?php echo $this->get_render_attribute_string( 'hoverlink' ); ?>>



				<div class="pt-hover-card">



					<div class="pt-hover-card-border"></div>



					<div class="pt-hover-card-inner">



						<div class="card-inner-wrap">



								<div class="pt-card-image">



									<span class="icon pt-icon icon-bicyclepp"></span>



								</div>



								<div class="pt-hover-card-title">



									<<?php echo $settings['title_html_tag']; ?>>



										<?php echo $settings['hover_card_title']; ?>



									</<?php echo $settings['title_html_tag']; ?>>



								</div>



							<div class="pt-hover-card-description">



								<?php echo $pt_hover_desc; ?>



							</div>



						</div>



					</div>



				</div>



			</a>



			



		<?php } ?>



		</div>



		<?php



	}



	/**



	 * Define our Content template settings.



	 */



	protected function _content_template() {







	}



}











