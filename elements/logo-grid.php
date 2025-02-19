<?php



namespace Elementor;



namespace Pt_Addons_Elementor\Elements\LogoGrid;



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







class Logo_Grid extends Widget_Base {







	/**



	 * Define our get_name settings.



	 */



	public function get_name() {



		return 'pt-logo-grid';



	}



	/**



	 * Define our get_title settings.



	 */



	public function get_title() {



		return __( 'Logo Grid', 'elementor' );



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



	 * Define our _register_controls settings.



	 */



	protected function _register_controls() {



        /**



        * Logo grid



        **/



        $this->start_controls_section(



            'pt_logo_grid_section',



            [



                'label' => esc_html__('Add Logo' ,'elementor'), 



            ]



        );



        



        $this->add_responsive_control(



            'pt_logo_column',



            [



                'label' => __( 'Columns' , 'elementor' ),



                'type' => Controls_Manager::SELECT,



				'default' => '3',



				'options' => [



					'1' => '1',



					'2' => '2',



					'3' => '3',



					'4' => '4',



					'5' => '5',



					'6' => '6',



				],



				'frontend_available' => true,



            ]



        );

//*******************Repeater control updated here */





$repeater = new \Elementor\Repeater();





$repeater->add_control(

	'pt_add_logo',

	[

		'label' => esc_html__( 'Add Logo', 'elementor' ),

		'type' => \Elementor\Controls_Manager::MEDIA,

		'default' => [

			'url' => \Elementor\Utils::get_placeholder_image_src(),

		],

	]

);





$repeater->add_control(

	'pt_logo_url',

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

	]

);



	//*******************Repeater control updated here */	

        $this->add_control(



            'pt_logo_content',



            [



                'label'     =>'Logo',

				'type' => \Elementor\Controls_Manager::REPEATER,

				'fields' => $repeater->get_controls(),

                'default' => [
					['pt_add_logo'=>'\Elementor\Utils::get_placeholder_image_src()',
					'pt_logo_url'=>'www.example.com'
				],
				[
					'pt_add_logo'=>'\Elementor\Utils::get_placeholder_image_src()',
					'pt_logo_url'=>'www.example.com'
				],
				[
					'pt_add_logo'=>'\Elementor\Utils::get_placeholder_image_src()',
					'pt_logo_url'=>'www.example.com'
				]
				],



             ]



        );



        



        $this->end_controls_section();



        



        $this->start_controls_section(



            'pt_logo_option_section',



            [



                'label' => esc_html__('Logo Grid Options' ,'elementor'), 



            ]



        );



        



        /* Image Size */
        $this->add_group_control(



			Group_Control_Image_Size::get_type(),



			[



				'name' => 'pt_image_size',



				'label' => __( 'Image Size Updated', 'elementor' ),



				'default' => 'medium',



                'exclude' => [ 'custom' ],



                'prefix_class' => 'elementor-logo-grid-image_size-'



			]



		);



        



        $this->end_controls_section();



        



        $this->start_controls_section(



			'section_design_layout',



			[



				'label' => __( 'General Settings', 'elementor' ),



				'tab'   => Controls_Manager::TAB_STYLE,



			]



		);



        



        $this->add_responsive_control(



			'pt_logo_gap',



			[



				'label' => __( 'Logo Gap', 'elementor' ),



				'type' => Controls_Manager::SLIDER,



				'default' => [



					'size' => 10,



				],



				'range' => [



					'px' => [



						'min' => 0,



						'max' => 100,



					],



				],



				'selectors' => [



					'{{WRAPPER}} .pt-logo-grid' => 'margin: 0 - {{pt_logo_column.SIZE}}px',



					'(desktop){{WRAPPER}} .pt-logo-grid-item' => 'width: calc( ( 100% -  ({{pt_logo_column.SIZE}} - 1 ) * {{SIZE}}px ) / {{pt_logo_column.SIZE}} ); margin-bottom: {{SIZE}}px; margin-right: {{SIZE}}px;',



                    '(tablet){{WRAPPER}} .pt-logo-grid-item' => 'width: calc( ( 100% -  ({{pt_logo_column_tablet.SIZE}} - 1 ) * {{SIZE}}px ) / {{pt_logo_column_tablet.SIZE}} ); margin-bottom: {{SIZE}}px; margin-right: {{SIZE}}px;', 



                    '(mobile){{WRAPPER}} .pt-logo-grid-item' => 'width: calc( ( 100% -  ({{pt_logo_column_mobile.SIZE}} - 1 ) * {{SIZE}}px ) / {{pt_logo_column_mobile.SIZE}} ); margin-bottom: {{SIZE}}px; margin-right: {{SIZE}}px;',



				],



				'frontend_available' => true,



			]



		);



        



        $this->add_control(



			'pt_logo_background',



			[



				'label' => __( 'Background Color', 'elementor-pro' ),



				'type' => Controls_Manager::COLOR,



				'selectors' => [



					'{{WRAPPER}} .pt-logo-grid-item' => 'background-color: {{VALUE}};',



				],



			]



		);



        



        /* Logo Border */



        $this->add_group_control(



			Group_Control_Border::get_type(),



			[



				'name' => 'pt_logo_item_border',



				'label' => __( 'Logo Border', 'elementor' ),



				'selector' => '{{WRAPPER}} .pt-logo-grid-item img',



			]



		);



        



        /* Border Radius */



        $this->add_responsive_control(



			'pt_logo_border_radius',



			[



				'label' => __( 'Border Radius', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-logo-grid-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



        



        /* Border Radius */



		$this->add_group_control(



			Group_Control_Box_Shadow::get_type(),



			[



				'name' => 'pt_logo_box_shadow',



                'label' => __( 'Box Shadow', 'elementor' ),



				'exclude' => [



					'box_shadow_position',



				],



				'selector' => '{{WRAPPER}} .pt-logo-grid-item img',



			]



		);



        



        $this->add_responsive_control( 



			'pt_logo_box_padding',



			[



				'label' => __( 'Padding', 'elementor' ),



				'type' => Controls_Manager::DIMENSIONS,



				'size_units' => [ 'px', 'em', '%' ],



				'selectors' => [



					'{{WRAPPER}} .pt-logo-grid-item img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



				],



			]



		);



        



        $this->end_controls_section();



	}



       



    /* check and redirect url */



    public function pt_logo_url_addhttp($url) {



        



        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {



            



            $url = "http://" . $url;



            



        }



        



        return $url;



    }



    



    protected function render_thumbnail() {



		$settings = $this->get_settings();







		$settings['thumbnail_size'] = [



			'id' => get_post_thumbnail_id(),



		];







		$thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );



		?>



		<div class="elementor-portfolio-item__img elementor-post__thumbnail">



			<?php echo $thumbnail_html ?>



		</div>



		<?php



	}



    



	protected function render() {



        



        global $post;



        


 $settings = $this->get_settings_for_display();



        $pt_logo_link_external = '';



        



        $pt_logo_column_count_desktop = $settings['pt_logo_column'];



        $pt_logo_column_count_tablet  = $settings['pt_logo_column_tablet'];



        $pt_logo_column_count_mobile  = $settings['pt_logo_column_mobile'];



            



        $pt_image_size = $settings['pt_image_size'];


        ?>



        <div class="pt-logo-grid grid-desktop-<?php echo $pt_logo_column_count_desktop.' grid-tablet-'.$pt_logo_column_count_tablet.' grid-mobile-'.$pt_logo_column_count_mobile; ?>">



        <?php



        foreach ( $settings['pt_logo_content'] as $item ) :



        



            $pt_image_url = ! empty( $item['pt_add_logo']['url'] ) ? $item['pt_add_logo']['url'] : '';



            



            $logo_link_to = $item['pt_logo_url']['url'];



            



            if ( ! empty( $item['pt_logo_url']['is_external'] ) ) { 



                $pt_logo_link_external = 'target = "_blank"';



            }



            ?>



            <div class="pt-logo-grid-item" >



            <?php 



                if ( $logo_link_to !== ''  ) {



                    $logo_link_to = $this->pt_logo_url_addhttp($logo_link_to);



                ?>



                    <a href="<?php echo $logo_link_to; ?>" <?php echo $pt_logo_link_external; ?> >



                        <img <?php echo $this->get_render_attribute_string( 'image' ); ?> src="<?php echo $pt_image_url; ?>" class="pt-logo-grid-logo"/>



                    </a>



                <?php



                } else { ?>



                    <img <?php echo $this->get_render_attribute_string( 'image' ); ?> src="<?php echo $pt_image_url; ?>" class="pt-logo-grid-logo" />
				<div> 	
				<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'pt_image_size');?>
				</div>

                <?php



                }



                ?>



            </div>    



        <?php



        endforeach;



    ?>



    </div>



    <?php 



	}



}



