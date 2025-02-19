<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\SmartBanner;



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







class Smart_Banner extends Widget_Base {







	/**



	 * Define our get_name settings.



	 */



	public function get_name() {



		return 'pt-smart-banner';



	}



	/**



	 * Define our get_title settings.



	 */



	public function get_title() {



		return __( 'Smart banner', 'elementor' );



	}



	/**



	 * Define our get_icon settings.



	 */



	public function get_icon() {



		return 'eicon-person';



	}



	/**



	 * Define our get_categories settings.



	 */



	public function get_categories() {



		return [ 'pt-addons-elementor' ];



	}



	/**



	 * Define button size.



	 */



	public static function get_button_sizes() {



		return [



			'xs' => __( 'Extra Small', 'elementor' ),



			'sm' => __( 'Small', 'elementor' ),



			'md' => __( 'Medium', 'elementor' ),



			'lg' => __( 'Large', 'elementor' ),



			'xl' => __( 'Extra Large', 'elementor' ),



		];



	}



	/**



	 * Define our _register_controls settings.



	 */



	protected function _register_controls() {



		$this->start_controls_section(



			'pt_smart_banner_content',



			[



				'label' => esc_html__( 'Smart Banner', 'elementor' ),



			]



		);



		$this->add_control(



			'pt_layout_type',



			[



				'label' => __( 'Smartbanner Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'style1',



				'options' => [



					'style1' => __( 'Style 1', 'elementor' ),



					'style2' => __( 'Style 2', 'elementor' ),



					//'style3' => __( 'Style 3', 'elementor' ),



				],



			]



		);



		$this->add_control(



			'pt_title',



			[



				'label'       => __( 'Title', 'elementor' ),



				'type'        => Controls_Manager::TEXTAREA,



				'default'     => __( 'Type your title text here', 'elementor' ),



				'placeholder' => __( 'Type your title text here', 'elementor' ),



			]



		);



		$this->add_control(



			'header_size',



			[



				'label' => __( 'HTML Tag', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'h1' => __( 'H1', 'elementor' ),



					'h2' => __( 'H2', 'elementor' ),



					'h3' => __( 'H3', 'elementor' ),



					'h4' => __( 'H4', 'elementor' ),



					'h5' => __( 'H5', 'elementor' ),



					'h6' => __( 'H6', 'elementor' ),



					'div' => __( 'div', 'elementor' ),



					'span' => __( 'span', 'elementor' ),



					'p' => __( 'p', 'elementor' ),



				],



				'default' => 'h2',



			]



		);



		$this->add_control(



			'pt_title_link',



			[



				'label' => __( 'Title Link', 'elementor' ),



				'type' => Controls_Manager::URL,



				'placeholder' => 'http://your-link.com',



				'default' => [



					'url' => '',



				],



			]



		);



		$this->add_control(



			'image',



			[



				'label' => __( 'Choose Image', 'elementor' ),



				'type' => Controls_Manager::MEDIA,



				'default' => [



					'url' => Utils::get_placeholder_image_src(),



				],



				'condition' => [



					'pt_layout_type!' => [ 'style3' ],



				],



			]



		);



		$this->add_control(



			'front_image_size',



			[



				'label' => __( 'Image Size', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 400,



					'unit' => 'px',



				],



				'range' => [



					'px' => [



						'min' => 50,



						'max' => 700,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-smart-banner-section .smart-banner-image-wrapper img' => 'width: {{SIZE}}{{UNIT}} !important;',



				],



				// 'condition' => [



				// 	'pt_layout_type!' => [ 'style3' ],



				// ],



			]



		);



		$this->add_control(



			'pt_description',



			[



				'label'   => __( 'Description', 'your-plugin' ),



				'type'    => Controls_Manager::WYSIWYG,



				'default' => __( 'Default description', 'elementor' ),



			]



		);



		$this->end_controls_section();



		$this->start_controls_section(



			'section_button',



			[



				'label' => __( 'Button', 'elementor' ),



			]



		);



		$this->add_control(



			'button_type',



			[



				'label' => __( 'Type', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => '',



				'options' => [



					'' => __( 'Default', 'elementor' ),



					'info' => __( 'Info', 'elementor' ),



					'success' => __( 'Success', 'elementor' ),



					'warning' => __( 'Warning', 'elementor' ),



					'danger' => __( 'Danger', 'elementor' ),



				],



				'prefix_class' => 'elementor-button-',



			]



		);



		$this->add_control(



			'text',



			[



				'label' => __( 'Text', 'elementor' ),



				'type' => Controls_Manager::TEXT,



				'default' => __( 'Click me', 'elementor' ),



				'placeholder' => __( 'Click me', 'elementor' ),



			]



		);



		$this->add_control(



			'link',



			[



				'label' => __( 'Link', 'elementor' ),



				'type' => Controls_Manager::URL,



				'placeholder' => 'http://your-link.com',



				'default' => [



					'url' => '#',



				],



			]



		);



		$this->add_control(



			'size',



			[



				'label' => __( 'Size', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'sm',



				'options' => self::get_button_sizes(),



			]



		);



		$this->add_control(



			'icon',



			[



				'label' => __( 'Icon', 'elementor' ),



				'type' => Controls_Manager::ICON,



				'label_block' => true,



				'default' => '',



			]



		);



		$this->add_control(



			'view',



			[



				'label' => __( 'View', 'elementor' ),



				'type' => Controls_Manager::HIDDEN,



				'default' => 'traditional',



			]



		);



		$this->end_controls_section();



		$this->start_controls_section(



			'section_title_style',



			[



				'label' => __( 'Title', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->add_control(



			'title_color',



			[



				'label' => __( 'Title Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} .title-color' => 'color: {{VALUE}};',



				],



			]



		);
		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'typography',



				'scheme' => Typography::TYPOGRAPHY_1,



				'selector' => '{{WRAPPER}} .heading-title',



			]



		);



		$this->add_control(



			'content_color',



			[



				'label' => __( 'Content Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} p' => 'color: {{VALUE}};',



				],



			]



		);

		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'Content_typography',



				'scheme' => Typography::TYPOGRAPHY_1,
				'label'=>'Content Typography',


				'selector' => '{{WRAPPER}} .pt-description p',



			]



		);


		$this->add_control(



			'title_color',



			[



				'label' => __( 'Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} .heading-title' => 'color: {{VALUE}};',



				],



			]



		);


		


		$this->add_responsive_control(



			'button_align',



			[



				'label' => __( 'Alignment', 'elementor' ),



				'type' => Controls_Manager::CHOOSE,



				'options' => [



					'left'    => [



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



					'{{WRAPPER}} .smart-banner-detail-style3' => 'text-align: {{VALUE}};',



				],



				'condition' => [



					'smart-banner-detail-style1!' => [ 'style1' ],



					'smart-banner-detail-style2!' => [ 'style2' ],



				],



				'default' => 'center',



			]



		);






		$this->end_controls_section();



		/**



		 * Image Style Section.



		 */



		$this->start_controls_section(



			'section_style_image',



			[



				'label' => __( 'Image', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



				'condition' => [



					'pt_layout_type!' => [ 'style1' ],



				],



			]



		);



		$this->add_control(



			'opacity',



			[



				'label' => __( 'Opacity (%)', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 1,



				],



				'range' => [



					'px' => [



						'max' => 1,



						'min' => 0.10,



						'step' => 0.01,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-smart-banner-section .smart-banner-image-wrapper img' => 'opacity: {{SIZE}};',



				],



			]



		);



		$this->add_control(



			'hover_animation',



			[



				'label' => __( 'Animation', 'elementor' ),



				'default' => 'grow',



				'type' => Controls_Manager::HOVER_ANIMATION,



			]



		);



		$this->end_controls_section();



		$this->start_controls_section(



			'background_style',



			[



				'label' => __( 'Background', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->start_controls_tabs( 'tabs_background' );



		$this->start_controls_tab(



			'text_background_normal',



			[



				'label' => __( 'Normal', 'elementor' ),



			]



		);



		$this->add_group_control(



			Group_Control_Background::get_type(),



			[



				'name' => 'text_background',



				'selector' => '{{WRAPPER}} .pt-smart-banner-section',



			]



		);



		$this->end_controls_tab();



		$this->start_controls_tab(



			'text_background_hover_tab',



			[



				'label' => __( 'Hover', 'elementor' ),



			]



		);



		$this->add_group_control(



			Group_Control_Background::get_type(),



			[



				'name' => 'text_background_hover',



				'selector' => '{{WRAPPER}}:hover .pt-smart-banner-section',



			]



		);



		$this->add_control(



			'text_background_hover_transition',



			[



				'label' => __( 'Transition Duration', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 0.3,



				],



				'range' => [



					'px' => [



						'max' => 3,



						'step' => 0.1,



					],



				],



				'render_type' => 'ui',



			]



		);



		$this->end_controls_tab();



		$this->end_controls_tabs();



		$this->end_controls_section();



		$this->start_controls_section(



			'section_style',



			[



				'label' => __( 'Button', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'typography',



				'label' => __( 'Typography', 'elementor' ),



				'scheme' => Typography::TYPOGRAPHY_4,



				'selector' => '{{WRAPPER}} a.elementor-button',



			]



		);



		$this->start_controls_tabs( 'tabs_button_style' );



		$this->start_controls_tab(



			'tab_button_normal',



			[



				'label' => __( 'Normal', 'elementor' ),



			]



		);



		$this->add_control(



			'button_text_color',



			[



				'label' => __( 'Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} a.elementor-button' => 'color: {{VALUE}};',



				],



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



				'selectors' => [



					'{{WRAPPER}} a.elementor-button' => 'background-color: {{VALUE}};',



				],



			]



		);



		$this->end_controls_tab();



		$this->start_controls_tab(



			'tab_button_hover',



			[



				'label' => __( 'Hover', 'elementor' ),



			]



		);



		$this->add_control(



			'hover_color',



			[



				'label' => __( 'Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'selectors' => [



					'{{WRAPPER}} a.elementor-button:hover' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'button_background_hover_color',



			[



				'label' => __( 'Background Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'selectors' => [



					'{{WRAPPER}} a.elementor-button:hover' => 'background-color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'button_hover_border_color',



			[



				'label' => __( 'Border Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'condition' => [



					'border_border!' => '',



				],



				'selectors' => [



					'{{WRAPPER}} a.elementor-button:hover' => 'border-color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'hover_animation',



			[



				'label' => __( 'Animation', 'elementor' ),



				'type' => Controls_Manager::HOVER_ANIMATION,



			]



		);



		$this->end_controls_tab();



		$this->end_controls_tabs();



		$this->add_group_control(



			Group_Control_Border::get_type(),



			[



				'name' => 'border',



				'label' => __( 'Border', 'elementor' ),



				'placeholder' => '1px',



				'default' => '1px',



				'selector' => '{{WRAPPER}} .elementor-button',



			]



		);



		$this->add_control(



			'border_radius',



			[



				'label' => __( 'Border Radius', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', '%' ],



				'selectors' => [



					'{{WRAPPER}} a.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Box_Shadow::get_type(),



			[



				'name' => 'button_box_shadow',



				'selector' => '{{WRAPPER}} .elementor-button',



			]



		);



		$this->add_control(



			'text_padding',



			[



				'label' => __( 'Text Padding', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', 'em', '%' ],



				'selectors' => [



					'{{WRAPPER}} a.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



				'separator' => 'before',



			]



		);



		$this->end_controls_section();



	}



	  /**



	   * Render function declare



	   */



	protected function render() {



		$settings = $this->get_settings();



		$pt_layout_type = ! empty( $settings['pt_layout_type'] ) ? $settings['pt_layout_type'] : '';



		$pt_title = ! empty( $settings['pt_title'] ) ? $settings['pt_title'] : '';



		$pt_description = ! empty( $settings['pt_description'] ) ? $settings['pt_description'] : '';



		/**



		 * Title: h1 to h6.



		 */



		$title = $settings['pt_title'];



		$title1 = $settings['pt_description'];



		if ( ! empty( $settings['pt_title_link']['url'] ) ) {



			$this->add_render_attribute( 'url', 'href', $settings['pt_title_link']['url'] );







			if ( $settings['pt_title_link']['is_external'] ) {



				$this->add_render_attribute( 'url', 'target', '_blank' );



			}



			if ( ! empty( $settings['pt_title_link']['nofollow'] ) ) {



				$this->add_render_attribute( 'url', 'rel', 'nofollow' );



			}



			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );



		}



		$title_html = sprintf( '<%1$s %2$s class="heading-title title-color">%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );



		/**



		 * Image.



		 */



		$this->add_render_attribute( 'wrapper', 'class', 'smart-banner-image-wrapper' );



		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );



		/**



		 * Image hover animatoin effect.



		 */



		if ( ! empty( $settings['hover_animation'] ) ) {



			$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );



		}



		$this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );



		if ( ! empty( $settings['link']['url'] ) ) {



			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );



			$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );







			if ( ! empty( $settings['link']['is_external'] ) ) {



				$this->add_render_attribute( 'button', 'target', '_blank' );



			}



		}



		$this->add_render_attribute( 'button', 'class', 'elementor-button' );



		if ( ! empty( $settings['size'] ) ) {



			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );



		}



		if ( $settings['hover_animation'] ) {



			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );



		}



		$this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );



		$this->add_render_attribute( 'icon-align', 'class', 'elementor-align-icon-' . $settings['icon_align'] );



		$this->add_render_attribute( 'icon-align', 'class', 'elementor-button-icon' );



		if ( 'style3' === $pt_layout_type ) {



		?>



		<div class="pt-smart-banner-section3-contaniner">



		<div class="pt-smart-banner-section pt-smart-banner-<?php echo $pt_layout_type; ?> to-center" style="text-align:<?php echo $pt_title_align; ?>"></div>



		<div class="pt-smart-banner-section3">



		<?php



		} else {



		?>



		<div class="pt-smart-banner-section pt-smart-banner-<?php echo $pt_layout_type; ?> to-center" style="text-align:<?php echo $pt_title_align; ?>">



		<?php



		}



		?>



			<div class="smart-banner-detail-<?php echo $pt_layout_type; ?>">



				<?php



				if ( 'style1' === $pt_layout_type ||  'style2' === $pt_layout_type ) {



				?>



					<div class="pt-title"><?php echo $title_html; ?>



						<div class="pt-description"><p style="color:<?php echo $settings['content_color']; ?>"><?php echo  $settings['pt_description']; ?></p></div>



						<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



								<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>



									<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>



										<?php if ( ! empty( $settings['icon'] ) ) : ?>



											<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>



												<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>



											</span>



										<?php endif; ?>



										<span class="elementor-button-text"><?php echo $settings['text']; ?></span>



									</span>



								</a>



						</div>	



					</div>



					<?php



					if ( 'style1' === $pt_layout_type || 'style2' === $pt_layout_type ) {



					?>



					<div class="pt-image">



						<?php



						if ( empty( $settings['image']['url'] ) ) {



							return;



						}



						$link = $this->get_link_url( $settings );



						if ( $link ) {



							$this->add_render_attribute( 'link', 'href', $link['url'] );



							if ( ! empty( $link['is_external'] ) ) {



								$this->add_render_attribute( 'link', 'target', '_blank' );



							}



							if ( ! empty( $link['nofollow'] ) ) {



								$this->add_render_attribute( 'link', 'rel', 'nofollow' );



							}



						}



						?>



						<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



							<?php



							if ( $has_caption ) :



							?>



							<figure class="wp-caption">



							<?php



							endif;



							if ( $link ) :



							?>



							<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>



							<?php



							endif;



							echo Group_Control_Image_Size::get_attachment_image_html( $settings );



							if ( $link ) :



							?>



							</a>



							<?php



							endif;



							if ( $has_caption ) :



							?>



							</figure>



							<?php endif; ?>



						</div>



					</div>



					<?php



					}



				} 



		 if ( 'style3' === $pt_layout_type ) {



				?>



				<div class="smart-banner-detail-<?php echo $pt_layout_type; ?>">



					<div class="pt-title"><?php echo $title_html; ?>



					<div class="pt-description"><p style="color:<?php echo $settings['content_color']; ?>"><?php echo  $settings['pt_description']; ?></p></div>



					<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



					<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>



					<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>



					<?php if ( ! empty( $settings['icon'] ) ) : ?>



						<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>



							<i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>



						</span>



					<?php endif; ?>



					<span class="elementor-button-text"><?php echo $settings['text']; ?></span>



					</span>



					</a>



					</div>



				



					</div>



					<?php if ( 'style3' === $pt_layout_type ) { ?>	



				</div>



				<?php



}



				}



				?>



			</div>



		</div>



		<?php



		if ( 'style3' === $pt_layout_type ) {



		?>



		</div>



		<?php



		}



		?>



		<?php



	}



	/**



	 * Define our get_link_url settings.



	 *



	 * @param int $instance string.



	 */



	private function get_link_url( $instance ) {



		if ( 'none' === $instance['link_to'] ) {



			return false;



		}



		if ( 'custom' === $instance['link_to'] ) {



			if ( empty( $instance['pt_image_link']['url'] ) ) {



				return false;



			}



			return $instance['pt_image_link'];



		}



		return [



			'url' => $instance['image']['url'],



		];



	}



}







