<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\Heading;



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







class Heading extends Widget_Base {



	/**



	 * Define our get_name settings.



	 */



	public function get_name() {



		return 'pt-heading';



	}



	/**



	 * Define our get_title settings.



	 */



	public function get_title() {



		return __( 'Heading', 'elementor' );



	}



	/**



	 * Define our get_icon settings.



	 */



	public function get_icon() {



		return 'eicon-animated-headline';



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



		 * Title and Description Section.



		 */



		$this->start_controls_section(



			'section_my_custom',



			[



				'label' => esc_html__( 'Title', 'elementor' ),



			]



		);



		$this->add_control(



			'pt_layout_type',



			[



				'label' => __( 'Separator Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'normal',



				'options' => [



					'normal' => __( 'Normal', 'elementor' ),



					'line' => __( 'Line', 'elementor' ),



					'linevertical' => __( 'Vertical Line', 'elementor' ),



					'linewithicon' => __( 'Line with Icon', 'elementor' ),



					'linewithimage' => __( 'Line with Image', 'elementor' ),



					'linewithtext' => __( 'Line with Text', 'elementor' ),



					'icon' => __( 'Only Icon', 'elementor' ),



					'image' => __( 'Only Image', 'elementor' ),



				],



			]



		);



       



		$this->add_control(



			'pt_titile_position',



			[



				'label' => __( 'Display Title', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'before',



				'options' => [



					'before' => __( 'Before', 'elementor' ),



					'after' => __( 'After', 'elementor' ),



				],



				'condition' => [



					'pt_layout_type!' => [ 'normal' ],



				],



			]



		);



		/**



		 * View when Select style Line.



		 */



		$this->add_control(



			'line_style',



			[



				'label' => __( 'Line Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'solid' => __( 'Solid', 'elementor' ),



					'double' => __( 'Double', 'elementor' ),



					'dotted' => __( 'Dotted', 'elementor' ),



					'dashed' => __( 'Dashed', 'elementor' ),



				],



				'default' => 'solid',



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-top-style: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type!' => [ 'normal', 'icon', 'image', 'linevertical' ],



				],



			]



		);



		$this->add_control(



			'line_weight',



			[



				'label' => __( 'Line Weight', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 1,



				],



				'range' => [



					'px' => [



						'min' => 1,



						'max' => 10,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type!' => [ 'normal', 'icon', 'image' ,'linevertical'],



				],



			]



		);



		$this->add_control(



			'line_color',



			[



				'label' => __( 'Line Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_3,



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-top-color: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type!' => [ 'normal', 'icon', 'image' ,'linevertical' ],



				],



			]



		);



		$this->add_responsive_control(



			'line_width',



			[



				'label' => __( 'Line Width', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'size_units' => [ '%', 'px' ],



				'range' => [



					'px' => [



						'max' => 100,



					],



				],



				'default' => [



					'size' => 20,



					'unit' => '%',



				],



				'tablet_default' => [



					'unit' => '%',



				],



				'mobile_default' => [



					'unit' => '%',



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'width: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type!' => [ 'normal', 'icon', 'image' ,'linevertical' ],



				],



			]



		);



		$this->add_responsive_control(



			'line_align',



			[



				'label' => __( 'Line Alignment', 'elementor' ),



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



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-heading-line' => 'text-align: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type' => 'line',



				],



			]



		);



		$this->add_responsive_control(



			'line_gap',



			[



				'label' => __( 'Line Gap', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 0,



				],



				'range' => [



					'px' => [



						'min' => 2,



						'max' => 50,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-line' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type' => 'line',



				],



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



        /**



		 * View when Select style Line With vertical line



		 */



        $this->add_control(



			'pt_vertical_line_style',



			[



				'label' => __( 'Line Style', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'options' => [



					'solid' => __( 'Solid', 'elementor' ),



					'double' => __( 'Double', 'elementor' ),



					'dotted' => __( 'Dotted', 'elementor' ),



					'dashed' => __( 'Dashed', 'elementor' ),



				],



				'default' => 'solid',



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-left-style: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type' => ['linevertical' ],



				],



			]



		);



        $this->add_control(



			'pt_vertical_line_weight',



			[



				'label' => __( 'Line Weight', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 1,



				],



				'range' => [



					'px' => [



						'min' => 1,



						'max' => 20,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-left-width: {{SIZE}}{{UNIT}};border-top-width: 0;',



				],



				'condition' => [



					'pt_layout_type' => ['linevertical'],



				],



			]



		);



		$this->add_control(



			'pt_vertical_line_color',



			[



				'label' => __( 'Line Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_3,



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'border-left-color: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type' => ['linevertical' ],



				],



			]



		);



        $this->add_responsive_control(



			'pt_vertical_line_height',



			[



				'label' => __( 'Height', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'size_units' => [ 'px' ],



				'range' => [



					'px' => [



						'max' => 100,



					],



				],



				'default' => [



					'size' => 20,



					'unit' => 'px',



				],



				'tablet_default' => [



					'unit' => 'px',



				],



				'mobile_default' => [



					'unit' => 'px',



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-separator' => 'width: auto ; height: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type' => [ 'linevertical' ],



				],



			]



		);



		$this->add_responsive_control(



			'pt_vertical_line_align',



			[



				'label' => __( 'Line Alignment', 'elementor' ),



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



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-heading-line' => 'text-align: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type' => 'linevertical',



				],



			]



		);



		$this->add_responsive_control(



			'pt_vertical_line_gap',



			[



				'label' => __( 'Line Gap', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 0,



				],



				'range' => [



					'px' => [



						'min' => 2,



						'max' => 50,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-line' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type' => 'linevertical',



				],



			]



		);



		/**



		 * View when Select style Line With Icon.



		 */



		$this->add_control(



			'icon',



			[



				'label' => __( 'Icon', 'elementor' ),



				'type' => Controls_Manager::ICON,



				'label_block' => true,



				'default' => 'fa fa-star',



				'condition' => [



					'pt_layout_type' => [ 'linewithicon', 'icon' ],



				],



			]



		);



		$this->add_control(



			'link',



			[



				'label' => __( 'Link', 'elementor' ),



				'type' => Controls_Manager::URL,



				'placeholder' => 'http://your-link.com',



				'condition' => [



					'pt_layout_type' => [ 'linewithicon', 'icon' ],



				],



			]



		);



		/**



		 * View when Select style Line With Image.



		 */



		$this->add_control(



			'image',



			[



				'label' => __( 'Choose Image', 'elementor' ),



				'type' => Controls_Manager::MEDIA,



				'default' => [



					'url' => Utils::get_placeholder_image_src(),



				],



				'condition' => [



					'pt_layout_type' => [ 'linewithimage', 'image' ],



				],



			]



		);



		$this->add_control(



			'front_image_size',



			[



				'label' => __( 'Image Size', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 80,



					'unit' => 'px',



				],



				'range' => [



					'px' => [



						'min' => 50,



						'max' => 700,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-heading .heading-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}};',



				],



				'condition' => [



					'pt_layout_type' => [ 'linewithimage', 'image' ],



				],



			]



		);



		$this->add_control(



			'link_to',



			[



				'label' => __( 'Link to', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'none',



				'options' => [



					'none' => __( 'None', 'elementor' ),



					'file' => __( 'Media File', 'elementor' ),



					'custom' => __( 'Custom URL', 'elementor' ),



				],



				'condition' => [



					'pt_layout_type' => [ 'linewithimage', 'image' ],



				],



			]



		);



		$this->add_control(



			'pt_image_link',



			[



				'label' => __( 'Link to', 'elementor' ),



				'type' => Controls_Manager::URL,



				'placeholder' => __( 'http://your-link.com', 'elementor' ),



				'condition' => [



					'link_to' => 'custom',



					'pt_layout_type' => 'linewithimage',



				],



				'show_label' => false,



			]



		);



		/**



		 * After Separator Style.



		 */



		$this->add_control(



			'pt_line_with_text',



			[



				'label'       => __( 'Text', 'elementor' ),



				'type'        => Controls_Manager::TEXT,



				'default'     => __( 'Text', 'elementor' ),



				'placeholder' => __( 'Type your text here', 'elementor' ),



				'condition' => [



					'pt_layout_type' => 'linewithtext',



				],



			]



		);



		$this->add_control(



			'text_color',



			[



				'label' => __( 'Text Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .heading-text-wrapper' => 'color: {{VALUE}};',



				],



				'condition' => [



					'pt_layout_type' => 'linewithtext',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'typography2',



				'scheme' => Typography::TYPOGRAPHY_1,



				'selector' => '{{WRAPPER}} .heading-text-wrapper',



				'condition' => [



					'pt_layout_type' => 'linewithtext',



				],



			]



		);



		/**



		 * View when Select style Line With Text.



		 */



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



			'pt_description',



			[



				'label' => 'Description',



				'type' => Controls_Manager::TEXTAREA,



				'default' => __( ' ', 'elementor' ),



			]



		);



		$this->add_responsive_control(



			'pt_title_align',



			[



				'label' => __( 'Set Alignment', 'elementor' ),



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



			]



		);



		$this->end_controls_section();



		/**



		 * Title Section.



		 */



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



				'default' => '#757171',



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



		$this->add_control(



			'title_link_color',



			[



				'label' => __( 'Text Link Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} .heading-title a' => 'color: {{VALUE}};',



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



		$this->add_control(



			'title_link_color',



			[



				'label' => __( 'Text Link Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} .heading-title a' => 'color: {{VALUE}};',



				],



			]



		);



		$this->end_controls_section();



		// description

		$this->start_controls_section(



			'section_description_style',



			[



				'label' => __( 'Description', 'elementor' ),



				'tab' => Controls_Manager::TAB_STYLE,



			]



		);

		

		$this->add_control(



			'pt-description',



			[



				'label' => __( 'Description Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'scheme' => [



					'type' => Color::get_type(),



					'value' => Color::COLOR_1,



				],



				'selectors' => [



					'{{WRAPPER}} .pt-description ' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_group_control(



			Group_Control_Typography::get_type(),



			[



				'name' => 'descriptiontypography',



				'scheme' => Typography::TYPOGRAPHY_1,



				'selector' => '{{WRAPPER}} .pt-description',



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



					'{{WRAPPER}} .pt-heading-section .heading-icon-wrapper img' => 'opacity: {{SIZE}};',



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



		$this->add_group_control(



			Group_Control_Border::get_type(),



			[



				'name' => 'image_border',



				'label' => __( 'Image Border', 'elementor' ),



				'selector' => '{{WRAPPER}} .pt-heading-section .heading-icon-wrapper img',



			]



		);



		$this->add_responsive_control(



			'image_border_radius',



			[



				'label' => __( 'Border Radius', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-heading-section .heading-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



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



				'selector' => '{{WRAPPER}} .pt-heading-section .heading-icon-wrapper img',



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



				'default' => 'default',



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



					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',



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



					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'size',



			[



				'label' => __( 'Size', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'range' => [



					'px' => [



						'min' => 6,



						'max' => 300,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',



				],



			]



		);



		$this->add_control(



			'icon_padding',



			[



				'label' => __( 'Icon Padding', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'selectors' => [



					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',



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



					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',



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



					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',



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



					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',



					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',



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



	}



	/**



	 * Define our Content Display settings.



	 */



	protected function render() {



		$settings = $this->get_settings();



		$pt_layout_type = ! empty( $settings['pt_layout_type'] ) ? $settings['pt_layout_type'] : '';



		$pt_title = ! empty( $settings['pt_title'] ) ? $settings['pt_title'] : '';



		$pt_description = ! empty( $settings['pt_description'] ) ? $settings['pt_description'] : '';



		$pt_line_with_text = ! empty( $settings['pt_line_with_text'] ) ? $settings['pt_line_with_text'] : '';



		$pt_title_align = ! empty( $settings['pt_title_align'] ) ? $settings['pt_title_align'] : '';



		$pt_titile_position = ! empty( $settings['pt_titile_position'] ) ? $settings['pt_titile_position'] : '';



		/**



		 * Title: h1 to h6.



		 */



		$title = $settings['pt_title'];



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



		 * Icon Start.



		 */



		$this->add_render_attribute( 'wrapper', 'class', 'heading-icon-wrapper' );



		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );



		/**



		 * Image hover animatoin effect.



		 */



		if ( ! empty( $settings['hover_animation'] ) ) {



			$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );



		}



		/**



		 * ICON hover animatoin effect.



		 */



		if ( ! empty( $settings['icon_hover_animation'] ) ) {



			$this->add_render_attribute( 'icon', 'class', 'elementor-animation-' . $settings['icon_hover_animation'] );



		}



		$icon_tag = 'div';



		if ( ! empty( $settings['link']['url'] ) ) {



			$this->add_render_attribute( 'icon-wrapper', 'href', $settings['link']['url'] );



			$icon_tag = 'a';



			if ( ! empty( $settings['link']['is_external'] ) ) {



				$this->add_render_attribute( 'icon-wrapper', 'target', '_blank' );



			}



			if ( $settings['link']['nofollow'] ) {



				$this->add_render_attribute( 'icon-wrapper', 'rel', 'nofollow' );



			}



		}



		if ( ! empty( $settings['icon'] ) ) {



			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );



		}



		?>



		<div class="pt-heading-section pt-heading-<?php echo $pt_layout_type; ?> to-center" style="text-align:<?php echo $pt_title_align; ?>">



			<?php



			if ( 'normal' === $pt_layout_type ) {



			?>



				<div class="pt-title"><?php echo $title_html; ?></div>



			<?php



			}



			?>



			<div class="pt-heading">



				<?php



				if ( 'line' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-heading-line pt-separator-">



						<div class="pt-heading-separator pt-heading-separator"></div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				}elseif ( 'linevertical' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-heading-line pt-separator-">



						<div class="pt-heading-separator pt-heading-separator"></div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				} elseif ( 'linewithimage' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-module-content pt-separator-parent">



						<div class="pt-separator-wrap pt-separator-<?php echo $pt_title_align; ?>">



							<div class="pt-heading-separator pt-side-left">



								<span></span>



							</div>



							<span class="pt-icon">



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



								<span <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



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



								</span>



							</span>



							<div class="pt-heading-separator pt-side-right">



								<span></span>



							</div>



						</div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				} elseif ( 'linewithicon' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-module-content pt-separator-parent">



						<div class="pt-separator-wrap pt-separator-<?php echo $pt_title_align; ?>">



							<div class="pt-heading-separator pt-side-left">



								<span></span>



							</div>



							<span class="pt-icon" <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



								<<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>



									<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>



								</<?php echo $icon_tag; ?>>



							</span>



							<div class="pt-heading-separator pt-side-right">



								<span></span>



							</div>



						</div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				} elseif ( 'linewithtext' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-heading-text">



						<div class="pt-module-content pt-separator-parent">



							<div class="pt-separator-wrap pt-separator-<?php echo $pt_title_align; ?>">



								<div class="pt-heading-separator pt-side-left">



									<span></span>



								</div>



								<span class="pt-icon">



									<span class="heading-text-wrapper">



										<?php echo $pt_line_with_text; ?>



									</span>



								</span>



								<div class="pt-heading-separator pt-side-right">



									<span></span>



								</div>



							</div>



						</div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				} elseif ( 'icon' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-heading-text">					



						<div class="pt-module-content pt-separator-parent">



							<div class="pt-separator-wrap pt-separator-<?php echo $pt_title_align; ?>">							



								<span class="pt-icon" <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



								<<?php echo $icon_tag . ' ' . $this->get_render_attribute_string( 'icon-wrapper' ); ?>>



									<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>



								</<?php echo $icon_tag; ?>>



							</span>						



							</div>



						</div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				} elseif ( 'image' === $pt_layout_type ) {



					if ( 'before' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



					?>



					<div class="pt-module-content pt-separator-parent">



						<div class="pt-separator-wrap pt-separator-<?php echo $pt_title_align; ?>">						



							<span class="pt-icon">



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



							<span <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>



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



							</span>



							</span>



						</div>



					</div>



					<?php



					if ( 'after' === $pt_titile_position ) {



					?>



						<div class="pt-title"><?php echo $title_html; ?></div>



					<?php



					}



				}



				?>



				<div class="pt-description"><?php echo $pt_description; ?></div>



			</div>



		</div>



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



