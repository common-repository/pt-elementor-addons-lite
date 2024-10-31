<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\TestimonialsSlider;



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



use \Elementor\Scheme_Typography;



use \Elementor\Scheme_Color;



use \Elementor\Core\Schemes\Color;



use \Elementor\Group_Control_Box_Shadow;



use \Elementor\Group_Control_Text_Shadow;



use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;



use \Elementor\Widget_Base as Widget_Base;



use \Pt_Addons_Elementor\Classes\Bootstrap;







class Testimonials_Slider extends Widget_Base {



	/**



	 * Define our get name settings.



	 */



    public function get_name() {



        return 'pt-slider-testimonial';



    }



	/**



	 * Define our get title settings.



	 */



    public function get_title() {



        return __('Testimonials Slider', 'elementor');



    }



	/**



	 * Define our get icon settings.



	 */



    public function get_icon() {



        return 'eicon-testimonial';



    }



	/**



	 * Define our get categories settings.



	 */



    public function get_categories() {



        return [ 'pt-addons-elementor' ];



    }



	

    protected function enqueue() {





		// Styles

		wp_register_style( 'controlslider', plugins_url( '/assets/front-end/css/testimonials-slider/index.css', __FILE__ ) );

		wp_enqueue_style( 'controlslider' );

        wp_register_style( 'controlslider_ft', plugins_url( '/assets/front-end/css/testimonials-slider/index.css', __FILE__ ) );

		wp_enqueue_style( 'controlslider_ft' );

        

		// Script

	}



	/**



	 * Define our _register_controls settings.



	 */



    protected function _register_controls() {







        $this->start_controls_section(



            'section_testimonials_slider',



            [



                'label' => __('Testimonials Slider', 'elementor'),



            ]



        );

                      /*New model repeater code goes here star and end shyam */

                      $repeater = new \Elementor\Repeater();



                      $repeater->add_control(

                        'client_name', [  

                            'label' => esc_html__('Name', 'elementor'),

                            'type' => \Elementor\Controls_Manager::TEXT,

                            'default' => esc_html__('The client or customer name for the testimonial', 'elementor'),  

                        ]);



    

                        $repeater->add_control(

                            'credentials', [  

                                'label' => esc_html__('Sub Headline', 'elementor'),

                                'type' => \Elementor\Controls_Manager::TEXT,

                                'default' => esc_html__('The details of the client/customer like Designation name, position held, company URL etc. HTML accepted.', 'elementor'),  

                            ]);

                     

    

                            $repeater->add_control(

                                'client_image',

                                [

                                    'label' => esc_html__( 'Choose Image', 'elementor' ),

                                    'type' => \Elementor\Controls_Manager::MEDIA,

                                    'label_block' => true,

                                    'default' => [

                                        'url' => \Elementor\Utils::get_placeholder_image_src(),

                                    ],

                                ]

                            );

                    

                            $repeater->add_control(

                                'testimonial_text', [

                                    'label' => esc_html__( 'Testimonials description', 'plugin-name' ),

                                    'type' => \Elementor\Controls_Manager::WYSIWYG,

                                    'default' => esc_html__( 'What your client/customer had to say' , 'elementor' ),

                                    'show_label' => false,

                                ]

                            );

    

    

                        // [

    

                        //     'name' => 'testimonial_text',

    

                        //     'label' => __('Testimonials description', 'elementor'),

    

                        //     'type' => Controls_Manager::WYSIWYG,

    

                        //     'description' => __('What your client/customer had to say', 'elementor'),

    

                        //     'show_label' => false,

    

                        // ],

    

    

                          /*New model repeater code goes here star and end */



        $this->add_control(



            'testimonials',



            [



                'label' => esc_html__('Testimonials', 'elementor'),



                'type' => \Elementor\Controls_Manager::REPEATER,



                'fields' => $repeater->get_controls(),

                'default' => [



                    [



                        'client_name' => esc_html__('John Doe #1', 'elementor'),



                        'credentials' => esc_html__('Param Themes', 'elementor'),



                        'testimonial_text' => esc_html__('Testimonial Description That Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'elementor'),



                    ],



                    [



                        'client_name' => esc_html__('John Doe #2', 'elementor'),



                        'credentials' => esc_html__('Param Themes', 'elementor'),



                        'testimonial_text' => esc_html__('Testimonial Description That Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'elementor'),



                    ],



                    [



                        'client_name' => esc_html__('John Doe #3', 'elementor'),



                        'credentials' => esc_html__('Param Themes', 'elementor'),



                        'testimonial_text' => esc_html__('Testimonial Description That Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'elementor'),



                    ],

                   

                ],

                'title_field' => '{{{ client_name }}}',

            ],

        );

              

        $this->end_controls_section();







        $this->start_controls_section(



            'section_settings',



            [



                'label' => __('Slider Settings', 'elementor'),



            ]



        );







        $this->add_control(



            'slide_animation',



            [



                'label' => __( 'Animation', 'elementor' ),



                'type' => Controls_Manager::SELECT,



                'default' => 'slide',



                'options' => [



                    'slide' => __( 'Slide', 'elementor' ),



                    'fade' => __( 'Fade', 'elementor' ),



                ],



            ]



        );







        $this->add_control(



            'slide_direction',



            [



                'label' => __( 'Direction', 'elementor' ),



                'type' => Controls_Manager::SELECT,



                'default' => 'horizontal',



                'options' => [



                    'horizontal' => __( 'Horizontal', 'elementor' ),



                    'vertical' => __( 'Vertical', 'elementor' ),



                ],



            ]



        );







        $this->add_control(



            'slideshow_speed',



            [



                'label' => __( 'Slideshow Speed', 'elementor' ),



                'type' => Controls_Manager::NUMBER,



                'default' => 4000,



            ]



        );











        $this->add_control(



            'animation_speed',



            [



                'label' => __( 'Animation Speed', 'elementor' ),



                'type' => Controls_Manager::NUMBER,



                'default' => 500,



            ]



        );







        $this->add_control(



            'pause_on_hover',



            [



                'type' => Controls_Manager::SWITCHER,



                'label_off' => __('No', 'elementor'),



                'label_on' => __('Yes', 'elementor'),



                'return_value' => 'yes',



                'separator' => 'before',



                'default' => 'yes',



                'label' => __('Pause on Hover?', 'elementor'),



                'description' => __('Should the slider pause on mouse hover over the slider.', 'elementor'),



            ]



        );







        $this->add_control(



            'pause_on_action',



            [



                'type' => Controls_Manager::SWITCHER,



                'label_off' => __('No', 'elementor'),



                'label_on' => __('Yes', 'elementor'),



                'return_value' => 'yes',



                'default' => 'no',



                'label' => __('Pause slider on action?', 'elementor'),



                'description' => __('Should the slideshow pause once user initiates an action using navigation/direction controls.', 'elementor'),



            ]



        );







        $this->add_control(



            'direction_nav',



            [



                'type' => Controls_Manager::SWITCHER,



                'label_off' => __('No', 'elementor'),



                'label_on' => __('Yes', 'elementor'),



                'return_value' => 'yes',



                'separator' => 'before',



                'default' => 'yes',



                'label' => __('Direction Navigation?', 'elementor'),



                'description' => __('Should the slider have direction navigation?', 'elementor'),



            ]



        );











        $this->add_control(



            'control_nav',



            [



                'type' => Controls_Manager::SWITCHER,



                'label_off' => __('No', 'elementor'),



                'label_on' => __('Yes', 'elementor'),



                'return_value' => 'yes',



                'default' => 'yes',



                'label' => __('Navigation Controls?', 'elementor'),



                'description' => __('Should the slider have navigation controls?', 'elementor'),



            ]



        );



		



		$this->add_control(



			'pt_testimonial_user_display_block',



			[



				'label' => esc_html__( 'Display Name & Designation Block?', 'elementor' ),



				'type' => Controls_Manager::SWITCHER,



				'label_on' => __( 'Show', 'elementor' ),



				'label_off' => __( 'Hide', 'elementor' ),



				'return_value' => 'yes',



				'default' => 'yes',



				'description' => __('Should the slider have Display Name & Designation Block?', 'elementor'),



			]



		);







        $this->end_controls_section();



		



		$this->start_controls_section(



            'section_testimonials_general',



            [



                'label' => __( 'General', 'elementor' ),



                'tab' => Controls_Manager::TAB_STYLE,



                'show_label' => false,



            ]



        );



		



		$this->add_responsive_control(



			'pt_testimonial_alignment',



			[



				'label' => __( 'Set Alignment', 'elementor' ),



				'type' => Controls_Manager::CHOOSE,



				'default' => 'center',



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



				]



			]



		);



		



		$this->add_control(



			'pt_testimonial_background',



			[



				'label' => esc_html__( 'Background Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-testimonial' => 'background-color: {{VALUE}};',



				],



			]



		);



        

		$this->add_control(



			'pt_testimonial_background',



			[



				'label' => esc_html__( 'Background Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-testimonial' => 'background-color: {{VALUE}};',



				],



			]



		);



		$this->add_control(



			'pt_testimonial_content_background',



			[



				'label' => esc_html__( 'Content Background Color', 'elementor' ),



				'type' => Controls_Manager::COLOR,



				'default' => '',



				'selectors' => [



					'{{WRAPPER}} .pt-testimonial-text' => 'background-color: {{VALUE}};',



				],



			]



		);



		



		$this->end_controls_section();



		



        $this->start_controls_section(



            'section_testimonials_thumbnail',



            [



                'label' => __( 'Author Thumbnail', 'elementor' ),



                'tab' => Controls_Manager::TAB_STYLE,



                'show_label' => false,



            ]



        );







        $this->add_control(



            'thumbnail_border_radius',



            [



                'label' => __('Author Thumbnail Border Radius', 'elementor'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => [ 'px', '%' ],



                'selectors' => [



                    '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );







        $this->add_control(



            'thumbnail_size',



            [



                'label' => __('Author Thumbnail Size', 'elementor'),



                'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 100,



					'unit' => 'px',



				],



                'size_units' => [ '%', 'px' ],



                'range' => [



                    '%' => [



                        'min' => 10,



                        'max' => 150,



                    ],



                    'px' => [



                        'min' => 50,



                        'max' => 300,



                    ],



                ],



                'selectors' => [



                    '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-image-wrapper img' => 'max-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(
			'pt_image_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'Elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                'default'=>'pulse',
			]
		);




		

		



		$this->add_control(



			'pt_thumbnail_location',



			[



				'label' => esc_html__( 'Thumbnail Location', 'elementor' ),



				'type' => Controls_Manager::SELECT,



				'default' => 'above-description',



				'options' => [



					'above-description' => __( 'Above Description', 'elementor' ),



					'below-description' => __( 'Below Description', 'elementor' ),



				],



			]



		);







        $this->end_controls_section();







        $this->start_controls_section(



            'section_testimonials_text',



            [



                'label' => __('Author Testimonial', 'elementor'),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );







        $this->add_control(



            'text_color',



            [



                'label' => __( 'Color', 'elementor' ),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-text' => 'color: {{VALUE}};',



                ],



            ]



        );







        $this->add_group_control(



            Group_Control_Typography::get_type(),



            [



                'name' => 'text_typography',



                'selector' => '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-text',



            ]



        );







        $this->end_controls_section();







        $this->start_controls_section(



            'section_testimonials_author_name',



            [



                'label' => __( 'Author Name', 'elementor' ),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );











        $this->add_control(



            'title_tag',



            [



                'label' => __( 'Title HTML Tag', 'elementor' ),



                'type' => Controls_Manager::SELECT,



                'options' => [



                    'h1' => __( 'H1', 'elementor' ),



                    'h2' => __( 'H2', 'elementor' ),



                    'h3' => __( 'H3', 'elementor' ),



                    'h4' => __( 'H4', 'elementor' ),



                    'h5' => __( 'H5', 'elementor' ),



                    'h6' => __( 'H6', 'elementor' ),



                    'div' => __( 'div', 'elementor' ),



                ],



                'default' => 'h5',



            ]



        );







        $this->add_control(



            'title_color',



            [



                'label' => __( 'Color', 'elementor' ),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-text .pt-author-name' => 'color: {{VALUE}};',



                ],



            ]



        );







        $this->add_group_control(



            Group_Control_Typography::get_type(),



            [



                'name' => 'title_typography',



                'selector' => '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-text .pt-author-name',



            ]



        );







        $this->end_controls_section();







        $this->start_controls_section(



            'section_testimonials_author_designation',



            [



                'label' => __('Author Designation', 'elementor'),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );







        $this->add_control(



            'designation_color',



            [



                'label' => __( 'Color', 'elementor' ),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-text' => 'color: {{VALUE}};',



                ],



            ]



        );







        $this->add_group_control(



            Group_Control_Typography::get_type(),



            [



                'name' => 'designation_typography',



                'selector' => '{{WRAPPER}} .pt-testimonials-slider .pt-testimonial-user .pt-text',



            ]



        );











        $this->end_controls_section();







    }



	/**



	 * Define our Content Render settings.



	 */



    protected function render() {







        $settings = $this->get_settings_for_display();



		$testalign = $this->get_settings( 'pt_testimonial_alignment' );



		$testimagelocation = $this->get_settings( 'pt_thumbnail_location' );

/**      **********************       Slider image animation        ************************************** */
        
        $elementClass = 'pt-image-wrapper';
		if ( $settings['pt_image_hover_animation'] ) {
			$elementClass .= 'elementor-animation-'. $settings['pt_image_hover_animation'];
		}
		$this->add_render_attribute( 'wrapper', 'class',$elementClass);
		
/**      **********************       Slider image animation        ************************************** */


        $slider_options = [



            'slide_animation' => $settings['slide_animation'],



            'slide_direction' => $settings['slide_direction'],



            'slideshow_speed' => absint( $settings['slideshow_speed'] ),



            'animation_speed' => absint( $settings['animation_speed'] ),



            'control_nav' => ( 'yes' === $settings['control_nav'] ),



            'direction_nav' => ( 'yes' === $settings['direction_nav'] ),



            'pause_on_hover' => ( 'yes' === $settings['pause_on_hover'] ),



            'pause_on_action' => ( 'yes' === $settings['pause_on_action'] )



        ];



        ?>







        <div class="pt-testimonials-slider pt-flexslider pt-container"  data-settings='<?php echo wp_json_encode($slider_options); ?>'>







            <div class="pt-slides">







                <?php foreach ($settings['testimonials'] as $testimonial) : ?>







                <div class="pt-slide pt-testimonial-wrapper">







                    <div class="pt-testimonial pt-align-<?php echo $testalign; ?>">







                        <div class="pt-testimonial-user" style="display: table;">



						



						<?php if('above-description' === $testimagelocation) : ?>







                            <div class="pt-image-wrapper" <?php echo $this->get_render_attribute_string( 'wrapper' );?>>


                             


                                <?php $client_image = $testimonial['client_image']; ?> 


                            
                          



								



                                <?php if (!empty($client_image)): ?>



								<?php if ( '' === $client_image['id'] ) {



									$testimonial_image_url = $client_image['url'];



								} else {



									 $testimonial_image_url = Group_Control_Image_Size::get_attachment_image_src( $client_image['id'], 'thumbnail', $testimonial );



								} ?>



								



								<img src="<?php echo esc_url( $testimonial_image_url ); ?>" alt="<?php echo esc_attr( $settings['client_name'] ); ?>" class="elementor-animation-<?php echo esc_attr( $settings['pt_image_hover_animation'] ); echo $this->get_render_attribute_string( 'pt_image_hover_animation' ); ?> pt-image full">







                                <?php endif; ?>







                            </div>



							



							<?php endif; ?>



							



							<div class="pt-testimonial-text <?php echo $testimagelocation; ?>">







                            <?php echo $this->parse_text_editor($testimonial['testimonial_text']); ?>



							



							<?php if('below-description' === $testimagelocation) : ?>







                            <div class="pt-image-wrapper">     







                                <?php $client_image = $testimonial['client_image']; ?>



								



                                <?php if (!empty($client_image)): ?>



								<?php if ( '' === $client_image['id'] ) {



									$testimonial_image_url = $client_image['url'];



								} else {



									 $testimonial_image_url = Group_Control_Image_Size::get_attachment_image_src( $client_image['id'], 'thumbnail', $testimonial );



								} ?>
	



						<img src="<?php echo esc_url( $testimonial_image_url ); ?>" alt="<?php echo esc_attr( $settings['client_name'] ); ?>" class="elementor-animation-<?php echo esc_attr( $settings['pt_image_hover_animation'] ); echo $this->get_render_attribute_string( 'pt_image_hover_animation' ); ?> pt-image full">






                                <?php endif; ?>







                            </div>



							



							<?php endif; ?>



							



							<?php if ( 'yes' === $settings['pt_testimonial_user_display_block'] ) : ?>



							



								<div class="pt-text">





                            

	

									<<?php echo $settings['title_tag']; ?> class="pt-author-name"><?php echo esc_html($testimonial['client_name']) ?></<?php echo $settings['title_tag']; ?>>







								<div class="pt-author-credentials"><?php echo wp_kses_post($testimonial['credentials']); ?></div>







								</div>



								



							<?php endif; ?>







							</div>







                    </div>







                </div>







            </div>







            <?php endforeach; ?>







        </div>







        </div>







        <?php



    }







}



