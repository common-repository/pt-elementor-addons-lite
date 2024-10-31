<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\InteractiveBannerPro;



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







class Interactive_Banner_Pro extends Widget_Base {



	/**



	 * Define our get name settings.



	 */



	public function get_name() {



		return 'pt-interactive_banner_pro';



	}



	/**



	 * Define our get title settings.



	 */



	public function get_title() {



		return __( 'Interactive Banner Pro', 'elementor' );



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



			'interactive_banner_pro_title',



			[



				'label' => __( 'Title', 'elementor' ),



				'type' => Controls_Manager::TEXT,



				'placeholder' => __( 'Enter text', 'elementor' ),



				'default' => __( 'Interactive Banner Title', 'elementor' ),



			]



		);



		$this->add_control(



			'title_html_tag',



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



				],



				'default' => 'h3',



			]



		);



		$this->add_control(



			'interactive_banner_pro_title_position',



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



					'{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-title' => 'text-align: {{VALUE}};',



				],



				'toggle' => false,



			]



		);



		$this->add_control(



			'interactive_banner_pro_title_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '#ffffff',



				'selectors' => [



					'{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-title' => 'color: {{VALUE}};',



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



				'name' => 'interactive_banner_pro_title_typography',



				'selector' => '{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-title',



				'scheme' => Typography::TYPOGRAPHY_1,



			]



		);



		$this->add_control(



			'interactive_banner_pro_style',



			[



				'label' => __( 'Banner Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'style1' => __( 'Style 1', 'elementor' ),



					'style2' => __('Style 2', 'elementor'),



					'style3' => __('Style 3', 'elementor'),



					'style4' => __('Style 4', 'elementor'),



					'style5' => __('Style 5', 'elementor'),



					'style6' => __('Style 6', 'elementor'),



					'style7' => __('Style 7', 'elementor'),



					'style8' => __('Style 8', 'elementor'),



					'style9' => __('Style 9', 'elementor'),



					'style10' => __('Style 10', 'elementor'),



					'style11' => __('Style 11', 'elementor'),



					'style12' => __('Style 12', 'elementor'),



					'style13' => __('Style 13', 'elementor'),



					'style14' => __('Style 14', 'elementor'),



					'style15' => __('Style 15', 'elementor'),



				],



				'default' => 'style1',



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



			]



		);







		$this->add_group_control(



			Group_Control_Image_Size::get_type(),



			[



				'name' => 'image',



				'label' => __( 'Image Size', 'elementor' ),



				'default' => 'medium',



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



		



		$this->end_controls_section();



		$this->start_controls_section(



			'section_style_content',



			[



				'label' => __( 'Hover', 'elementor' ),



			]



		);



		$this->add_control(



			'interactive_banner_pro_description',



			[



				'label' => __( 'Description', 'elementor' ),



				'type' => Controls_Manager::WYSIWYG,



				'default' => __( 'I am text block. Click edit button to change this text. ', 'elementor' ),



			]



		);



		$this->add_responsive_control(



			'interactive_banner_pro_text_align',



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



					'{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-content' => 'text-align: {{VALUE}};',



				],



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



			'interactive_banner_pro_hover_title_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-ib2-hover .pt-new-ib-title' => 'color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_2,



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'interactive_banner_pro_title_hover_typography',



				'selector' => '{{WRAPPER}} .pt-ib2-hover .pt-new-ib-title',



				'scheme' => Typography::TYPOGRAPHY_2,



			]



		);



		$this->add_control(



			'interactive_banner_pro_description',



			[



				'label' => __( 'Description', 'elementor' ),



				'type' => Controls_Manager::HEADING,



				'separator' => 'before',



			]



		);



		// $this->add_control(



		// 	'interactive_banner_pro_hover_description_color',



		// 	[



		// 		'label' => __( 'Color', 'elementor' ),



		// 		'type' => Controls_Manager::COLOR,



		// 		'default' => '#fff',



		// 		'selectors' => [



		// 			'{{WRAPPER}} .pt-ib2-hover .pt-new-ib-content p,{{WRAPPER}} .pt-ib2-hover .pt-new-ib-content' => 'color: {{VALUE}};',



		// 		],



		// 		'scheme' => [



		// 			'type' => Color::get_type(),



		// 			'value' => Color::COLOR_3,



		// 		],



		// 	]



		// );



		$this->add_control(



			'interactive_banner_pro_description_color',



			[



				'label' => __( 'Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '#fff',



				'selectors' => [



					'{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-content p,{{WRAPPER}} .pt-new-ib-desc .pt-new-ib-content' => 'color: {{VALUE}};',



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



				'name' => 'interactive_banner_prodescription_typography',



				'selector' => '{{WRAPPER}} .pt-ib2-hover .pt-new-ib-content,.pt-new-ib-desc',



				'scheme' => Typography::TYPOGRAPHY_3,



			]



		);



		$this->add_control(



			'interactive_banner_pro_description_link_color',



			[



				'label' => __( 'Description Link Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-ib2-hover .pt-new-ib-content a' => 'color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_3,



				],



			]



		);



		$this->end_controls_section();



		



		$this->start_controls_section(



			'interactive_banner_pro_bg_styles',



			[



				'label' => esc_html__( 'Image Style', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		



		$this->add_control(



			'interactive_banner_pro_box_height',



			[



				'label' => __( 'Card Box Height', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 300,



				],



				'range' => [



					'px' => [



						'min' => 250,



						'max' => 450,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-new-ib' => 'height: {{SIZE}}{{UNIT}};',



				],



			]



		);



		



		$this->add_control(



			'interactive_banner_pro_overlay_color',



			[



				'label' => esc_html__( 'Image Overlay Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-module-content.pt-ib2-outter:after' => 'background: {{VALUE}};',



				],



			]



		);



		



		$this->add_control(



			'interactive_banner_pro_hover_overlay_color',



			[



				'label' => esc_html__( 'Image Hover Overlay Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-new-ib:before' => 'background-color: {{VALUE}};',



				],



			]



		);



		



		$this->end_controls_section();



		



		$this->start_controls_section(



			'interactive_banner_pro_desc_styles',



			[



				'label' => esc_html__( 'Description', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		



		$this->end_controls_section();



		



	}



	/**



	 * Define our Content Render settings.



	 */



   



	protected function render() {



		$settings = $this->get_settings();



		$pt_hover_desc  = ! empty( $settings['interactive_banner_pro_description'] ) ? $settings['interactive_banner_pro_description'] : '';



		if ( empty( $settings['image']['url'] ) ) {



			return;



		}



		$this->add_render_attribute( 'hoverlink', 'class', 'link' );



		if ( ! empty( $settings['link']['url'] ) ) {



			$this->add_render_attribute( 'hoverlink', 'href', $settings['link']['url'] );







			if ( ! empty( $settings['link']['is_external'] ) ) {



				$this->add_render_attribute( 'hoverlink', 'target', '_blank' );



			}



		}



		?>



		<div class="pt-module-content pt-ib2-outter pt-new-ib pt-ib-effect-<?php echo $settings [ 'interactive_banner_pro_style' ]; ?>  <?php echo ( $settings['interactive_banner_pro_box_height'] != '' ) ? 'pt-ib2-min-height' : ''; ?> " >



			<?php



			echo Group_Control_Image_Size::get_attachment_image_html( $settings );



			?>



			<div class="pt-new-ib-desc">



			<?php



			if( $settings['interactive_banner_pro_title'] != '' ) {



			?>



			<<?php echo $settings['title_html_tag']. ' class="pt-new-ib-title pt-simplify"' ?>>



				<?php echo $settings['interactive_banner_pro_title']; ?>



			</<?php echo $settings['title_html_tag']; ?>>



			<?php



			}



			?>



				<div class="pt-new-ib-content pt-text-editor pt-simplify"><?php echo $pt_hover_desc; ?></div>



			</div>



			<?php



			if( $settings['link'] != '' ) {



			?>



			<a class="pt-new-ib-link" <?php echo $this->get_render_attribute_string( 'hoverlink' ); ?>></a>



			<?php



			}



			?>



		</div>



		<script>



		(function ( $, window, undefined ) {



			$(window).on( 'load', function(a){



				jQuery('.pt-ib2-outter').each(function(index, value){







					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {



						$(this).click(function(){



							event.stopPropagation();



							var node = jQuery(this).closest( '.elementor-widget-pt_interactive_banner_pro' ).attr( 'data-id' );



							if( jQuery('.elementor-element-' + node + ' .pt-ib2-outter').hasClass( 'pt-ib2-hover' ) ){



								jQuery('.elementor-element-' + node + ' .pt-ib2-outter').removeClass('pt-ib2-hover');



							} else {



								jQuery('.elementor-element-' + node + ' .pt-ib2-outter').addClass('pt-ib2-hover');



							}



						});



					}



				});



			});







			if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )



				var is_touch_device = false;



			else



				var is_touch_device = true;



			if(!is_touch_device){



				jQuery('.pt-ib2-outter').hover(function(event){



					event.stopPropagation();



					jQuery(this).addClass('pt-ib2-hover');



				},function(event){



					event.stopPropagation();



					jQuery(this).removeClass('pt-ib2-hover');



				});



			}







		}(jQuery, window));



		</script>



		<?php



	}



	/**



	 * Define our Content template settings.



	 */



	protected function _content_template() {







	}



}