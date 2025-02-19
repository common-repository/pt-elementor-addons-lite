<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\InfoList;



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







class Info_List extends Widget_Base {



	/**



	 * Define our get_name settings.



	 */



	public function get_name() {



		return 'pt-info-list';



	}



	/**



	 * Define our get_title settings.



	 */



	public function get_title() {



		return __( 'Info List', 'elementor' );



	}



	/**



	 * Define our get_icon settings.



	 */



	public function get_icon() {



		return 'eicon-radio';



	}



	/**



	 * Define our get_categories settings.



	 */



	public function get_categories() {



		return [ 'pt-addons-elementor' ];



	}



	/**



	 * Define our _register_controls settings.



	 */



	protected function _register_controls() {



		/**



		 * Info List.



		 */



		$this->start_controls_section(



			'info_list_items',



			[



				'label' => esc_html__( 'Info List', 'elementor' ),



			]



		);



		$this->add_control(



			'pt_layout_type',



			[



				'label' => __( 'Select Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'iconleft',



				'options' => [



					'iconleft' => __( 'Icon to the left', 'elementor' ),



					'iconright' => __( 'Icon to the right', 'elementor' ),



					'icontop' => __( 'Icon at top', 'elementor' ),



				],



			]



		);





/*** Repeater control updated here  */

$repeater = new \Elementor\Repeater();



$repeater->add_control(

	'pt_title', [

		'label' => esc_html__( 'Title', 'elementor' ),

		'type' => \Elementor\Controls_Manager::TEXT,

		'default' => esc_html__( 'John Doe' , 'elementor' ),

		'label_block' => true,

	]

);

$repeater->add_control(

	'pt_description', [

		'label' => esc_html__( 'Description', 'elementor' ),

		'type' => \Elementor\Controls_Manager::TEXTAREA,

		'default' => esc_html__( 'Default description.' , 'elementor' ),

		'label_block' => true,

	]

);

	

$repeater->add_control(

	'pt_media_type',

	[

		'label' => esc_html__( 'Image/Icon', 'elementor' ),

		'type' => \Elementor\Controls_Manager::SELECT,

		

		'default' => 'icon',



		'options' => [



			'icon' => __( 'Icon', 'elementor' ),



			'image' => __( 'Image', 'elementor' ),



		],

	]

);

$repeater->add_control(

	'image',

	[

		'label' => esc_html__( 'Choose Image', 'elementor' ),

		'type' => \Elementor\Controls_Manager::MEDIA,

		'default' => [

			'url' => \Elementor\Utils::get_placeholder_image_src(),

		],

		'condition' => [



			'pt_media_type' => [ 'image' ],



		],



	]

);



$repeater->add_control(

	'front_image_size',

	[

		'label' => esc_html__( 'Image Size', 'elementor' ),

		'type' => \Elementor\Controls_Manager::SLIDER,

		'size_units' => [ 'px', '%' ],

		'default' => [



			'size' => 150,



			'unit' => 'px',



		],



		'range' => [



			'px' => [



				'min' => 50,



				'max' => 150,



			],



		],



		'selectors' => [



			'{{WRAPPER}} .info-list-image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',



		],



		'condition' => [



			'pt_media_type' => [ 'image' ],



		],



	]);

	$repeater->add_control(

		'icon',

		[

			'label' => esc_html__( 'Social Icons', 'elementor' ),

			'type' => \Elementor\Controls_Manager::ICON,

			'default' => 'fa fa-star',

		'condition' => [

			'pt_media_type' => [ 'icon' ],

		]

	]);



	$repeater->add_control(

		'apply_link_to',

		[

			'label' => esc_html__( 'Apply Link To', 'elementor' ),

			'type' => \Elementor\Controls_Manager::SELECT,

			'default' => 'none',



		'options' => [



			'none' => __( 'None', 'elementor' ),



			'title' => __( 'Title', 'elementor' ),



			'icon' => __( 'Icon', 'elementor' ),



			'image' => __( 'Image', 'elementor' ),



		],



		]

	);



	$repeater->add_control(

		'pt_link',

		[

			'label' => esc_html__( 'Link', 'elementor' ),

			'type' => \Elementor\Controls_Manager::URL,

			'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),

			'default' => [

				'url' => '',

				'is_external' => true,

				'nofollow' => true,

				'custom_attributes' => '',

			],

			'label_block' => true,

			'condition' => [



				'apply_link_to!' => [ 'none' ],

	

			],

	

		]);



	

		$this->add_control(



			'info_list_section',



			[



				'label' => __( 'Info List', 'elementor' ),



				'type' => \Elementor\Controls_Manager::REPEATER,

				'fields' => $repeater->get_controls(),

				'default' => [



					[

						'pt_title' => 'John Doe',



					],



				],

				'title_field' => '{{pt_title}}',



			]



		);



		$this->end_controls_section();

/*** Repeater control updated here  */

		/**



		 * Title Style Section.



		 */



		$this->start_controls_section(



			'section_title_style',



			[



				'label' => __( 'Title and Description', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



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



					'{{WRAPPER}} .pt_info_list_description' => 'color: {{VALUE}};',



				],



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



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'typography',



				'scheme' => Typography::TYPOGRAPHY_1,



				'selector' => '{{WRAPPER}} .heading-title',



			]



		);







		$this->add_group_control(



			Group_Control_Text_Shadow::get_type(),



			[



				'name' => 'text_shadow',



				'selector' => '{{WRAPPER}} .heading-title',



			]



		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'Des_content_typography',
				'label'=>'Typography Of Description.',
				'selector' => '{{WRAPPER}} .pt_info_list_description',
				'description'=>'Typography Of Description.',
			]
		);



		$this->end_controls_section();



		/**



		 * ICon Style Section.



		 */



		$this->start_controls_section(



			'section_style_icon',



			[



				'label' => __( 'Icon', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->add_control(



			'icon_view',



			[



				'label' => __( 'View', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'default' => __( 'Default', 'elementor' ),



					'stacked' => __( 'Stacked', 'elementor' ),



					'framed' => __( 'Framed', 'elementor' ),



				],



				'default' => 'stacked',



				'prefix_class' => 'elementor-view-',



			]



		);



		$this->add_control(



			'icon_shape',



			[



				'label' => __( 'Shape', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'circle' => __( 'Circle', 'elementor' ),



					'square' => __( 'Square', 'elementor' ),



				],



				'default' => 'circle',



				'condition' => [



					'icon_view!' => 'default',



				],



				'prefix_class' => 'elementor-shape-',



			]



		);



		$this->add_control(



			'primary_color',



			[



				'label' => __( 'Primary Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}}.elementor-view-stacked .pt-main-icon .pt-icon .elementor-icon' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-framed .pt-main-icon .pt-icon .elementor-icon, {WRAPPER}}.elementor-view-default .pt-main-icon .pt-icon .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',



				],



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



			]



		);



		$this->add_control(



			'secondary_color',



			[



				'label' => __( 'Secondary Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}}.elementor-view-framed .pt-main-icon .pt-icon .elementor-icon' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-stacked .pt-main-icon .pt-icon .elementor-icon' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'size',



			[



				'label' => __( 'Size', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 45,



					'unit' => 'px',



				],



				'range' => [



					'px' => [



						'min' => 6,



						'max' => 100,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-main-icon .pt-icon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',



				],



			]



		);



		$this->add_control(



			'icon_padding',



			[



				'label' => __( 'Icon Padding', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'selectors' => [



					'{{WRAPPER}} .pt-main-icon .pt-icon .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',



				],



				'range' => [



					'em' => [



						'min' => 0,



						'max' => 5,



					],



				],



			]



		);



		$this->add_control(



			'rotate',



			[



				'label' => __( 'Rotate', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 0,



					'unit' => 'deg',



				],



				'selectors' => [



					'{{WRAPPER}} .pt-main-icon .pt-icon .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',



				],



			]



		);



		$this->add_responsive_control(



			'icon_align',



			[



				'label' => __( 'Icon Alignment', 'elementor' ),



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



				'default' => 'center',



				'selectors' => [



					'{{WRAPPER}} .pt-main-icon' => 'text-align: {{VALUE}};',



				],



			]



		);



		$this->end_controls_section();



		/**



		 * ICon Hover Section.



		 */



		$this->start_controls_section(



			'section_hover',



			[



				'label' => __( 'Icon Hover', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);



		$this->add_control(



			'hover_primary_color',



			[



				'label' => __( 'Primary Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}}.elementor-view-stacked .pt-main-icon .pt-icon .elementor-icon:hover' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-framed .pt-main-icon .pt-icon .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .pt-main-icon .pt-icon .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'hover_secondary_color',



			[



				'label' => __( 'Secondary Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}}.elementor-view-framed .pt-main-icon .pt-icon .elementor-icon:hover' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-stacked .pt-main-icon .pt-icon .elementor-icon:hover' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'icon_hover_animation',



			[



				'label' => __( 'Animation', 'elementor' ),



				'type' => Controls_Manager::HOVER_ANIMATION,



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



					'{{WRAPPER}} .pt-image .info-list-image-wrapper img' => 'opacity: {{SIZE}};',



				],



			]



		);



		$this->add_control(



			'image_hover_animation',



			[



				'label' => __( 'Animation', 'elementor' ),



				'type' => Controls_Manager::HOVER_ANIMATION,



			]



		);



		$this->add_group_control(



			Group_Control_Border::get_type(),



			[



				'name' => 'image_border',



				'label' => __( 'Image Border', 'elementor' ),



				'selector' => '{{WRAPPER}} .pt-image .info-list-image-wrapper img',



			]



		);



		$this->add_responsive_control(



			'image_border_radius',



			[



				'label' => __( 'Border Radius', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-image .info-list-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Box_Shadow::get_type(),



			[



				'name' => 'image_box_shadow',



				'exclude' => [



					'box_shadow_position',



				],



				'selector' => '{{WRAPPER}} .pt-image .info-list-image-wrapper img',



			]



		);



		$this->add_responsive_control(



			'image_align',



			[



				'label' => __( 'Image Alignment', 'elementor' ),



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



				'default' => 'center',



				'selectors' => [



					'{{WRAPPER}} .pt-image' => 'text-align: {{VALUE}};',



				],



			]



		);



		$this->end_controls_section();



	}



	/**



	 * Define our Content Display settings.



	 */



	protected function render() {



		$settings = $this->get_settings();



		$pt_layout_type = ! empty( $settings['pt_layout_type'] ) ? $settings['pt_layout_type'] : '';



		/**



		 * Image.



		 */



		$this->add_render_attribute( 'wrapper', 'class', 'info-list-image-wrapper' );



		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );



		foreach ( $settings['info_list_section'] as $item ) :



			$pt_title = ! empty( $item['pt_title'] ) ? $item['pt_title'] : '';



			$pt_description = ! empty( $item['pt_description'] ) ? $item['pt_description'] : '';



			$image_url = ! empty( $item['image']['url'] ) ? $item['image']['url'] : '';



			$apply_link_to = ! empty( $item['apply_link_to'] ) ? $item['apply_link_to'] : '';



			$pt_media_type = ! empty( $item['pt_media_type'] ) ? $item['pt_media_type'] : '';



			/**



			 * Apply to link.



			 */



			if ( ! empty( $item['pt_link']['url'] ) ) {



				$this->add_render_attribute( 'url', 'href', $item['pt_link']['url'] );







				if ( $item['pt_link']['is_external'] ) {



					$this->add_render_attribute( 'url', 'target', '_blank' );



				}



				if ( ! empty( $item['pt_link']['nofollow'] ) ) {



					$this->add_render_attribute( 'url', 'rel', 'nofollow' );



				}



			}



			/**



			 * ICON hover animatoin effect.



			 */



			if ( ! empty( $settings['icon_hover_animation'] ) ) {



				$this->add_render_attribute( 'icon', 'class', 'elementor-animation-' . $settings['icon_hover_animation'] );



			}



			$icon_tag = 'div';



			if ( ! empty( $item['pt_link']['url'] ) ) {



				$this->add_render_attribute( 'icon-wrapper', 'href', $item['pt_link']['url'] );



				$icon_tag = 'a';



				if ( ! empty( $item['pt_link']['is_external'] ) ) {



					$this->add_render_attribute( 'icon-wrapper', 'target', '_blank' );



				}



				if ( $item['pt_link']['nofollow'] ) {



					$this->add_render_attribute( 'icon-wrapper', 'rel', 'nofollow' );



				}



			}



			if ( ! empty( $item['icon'] ) ) {



				$this->add_render_attribute( 'icon', 'class', $item['icon'] );



			}



			/**



			 * Image hover animatoin effect.



			 */



			if ( ! empty( $settings['image_hover_animation'] ) ) {



				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['image_hover_animation'] );



			}



		?>



		<div class="info_list_item">



			<div class="<?php echo $pt_layout_type; ?> info_list_icon_or_image" style="width:<?php echo $settings['size'];?>">



				<?php



				if ( 'icon' === $pt_media_type ) {



				?>



				<div class="pt-main-icon">			



					<span class="pt-icon" <?php echo $this->get_render_attribute_string( 'icon-wrapper' ); ?>>



						<?php



						if ( 'none' !== $apply_link_to && 'icon' === $apply_link_to ) {



						?>



						<<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'url' ); ?>>



						<div class="elementor-icon">



							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>



						</div>



						</<?php echo $icon_tag; ?>>



						<?php



						} else {



						?>



						<div class="elementor-icon">



							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>



						</div>



						<?php



						}



						?>



					</span>				



				</div>



				<?php



				} else {



				?>				



				<div class="pt-image">



					<span <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>					



						<?php



						if ( 'none' !== $apply_link_to && 'image' === $apply_link_to ) {



						?>



						<a <?php echo $this->get_render_attribute_string( 'url' ); ?>>



							<img <?php echo $this->get_render_attribute_string( 'image' ); ?> src="<?php echo $image_url; ?>" /></a>



						<?php



						} else {



						?>



							<img <?php echo $this->get_render_attribute_string( 'image' ); ?> src="<?php echo $image_url; ?>" />



						<?php



						}



						?>



					</span>



				</div>



				<?php



				}



				?>



			</div>		



			<div class="<?php echo $pt_layout_type; ?> info_list_content">



				<div class="pt-title">



					<?php



					if ( 'none' !== $apply_link_to && 'title' === $apply_link_to ) {



					?>



					<a <?php echo $this->get_render_attribute_string( 'url' ); ?>>



						<<?php echo $settings['header_size'] . " class=' heading-title title-color '" ?>>



							<?php echo $pt_title; ?>



						</<?php echo $settings['header_size']; ?>>



					</a>



					<?php



					} else {



					?>



						<<?php echo $settings['header_size']." class='heading-title title-color'"; ?>>



							<?php echo $pt_title; ?>



						</<?php echo $settings['header_size']; ?>>



					<?php



					}



					?>



				</div>				



				<div class="pt_info_list_description">



					<p>



						<?php echo $pt_description; ?>



					</p>



				</div>



			</div>



			<div class="<?php echo $pt_layout_type; ?> icon_list_connector" style="border-color:#333333;"></div>



		</div>



		<?php



		endforeach;



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







