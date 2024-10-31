<?php
/**
 * class-pt-elements-info-box2.php
 *
 * @author    paramthemes <paramthemes@gmail.com>
 * @copyright 2018 Param Themes
 * @license   Param Theme
 * @package   Elementor
 * @see       https://www.paramthemes.com
 */
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Widget_PT_Info_Box extends Widget_Base {

	public function get_name() {
		return 'pt-info-box2';
	}

	public function get_title() {
		return esc_html__( 'Info Box 2', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-archive';
	}

   public function get_categories() {
		return [ 'pt-elementor-addons' ];
	}

	protected function _register_controls() {

  		/**
  		 * Infobox Image Settings
  		 */
  		$this->start_controls_section(
  			'eael_section_infobox_content_settings',
  			[
  				'label' => esc_html__( 'Infobox Image', 'elementor' )
  			]
  		);

  		$this->add_control(
		  'pt_infobox_img_type',
		  	[
		   	'label'       	=> esc_html__( 'Infobox Type', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'img-on-top',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'img-on-top'  	=> esc_html__( 'Image/Icon On Top', 'elementor' ),
		     		'img-on-left' 	=> esc_html__( 'Image/Icon On Left', 'elementor' ),
		     		'img-on-right' 	=> esc_html__( 'Image/Icon On Right', 'elementor' ),
		     	],
		  	]
		);
		
		$this->add_control(
			'infobox2_shape',
			[
				'label' => __( 'Shape', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'elementor' ),
					'square' => __( 'Square', 'elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);


		$this->add_responsive_control(
			'pt_infobox_img_or_icon',
			[
				'label' => esc_html__( 'Image or Icon', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'img' => [
						'title' => esc_html__( 'Image', 'elementor' ),
						'icon' => 'eicon-image',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'elementor' ),
						'icon' => 'eicon-info-circle',
					],
				],
				'default' => 'icon',
			]
		);
		/**
		 * Condition: 'pt_infobox_img_or_icon' => 'img'
		 */
		$this->add_control(
			'pt_infobox_image',
			[
				'label' => esc_html__( 'Infobox Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'pt_infobox_img_or_icon' => 'img'
				]
			]
		);


		/**
		 * Condition: 'pt_infobox_img_or_icon' => 'icon'
		 */
		$this->add_control(
			'pt_infobox_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-building-o',
				'condition' => [
					'pt_infobox_img_or_icon' => 'icon'
				]
			]
		);

		$this->add_control(
			'pt_show_infobox_clickable',
			[
				'label' => __( 'Infobox Clickable', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'pt_show_infobox_clickable_link',
			[
				'label' => esc_html__( 'Infobox Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'default' => [
        			'url' => 'http://',
        			'is_external' => '',
     			],
     			'show_external' => true,
     			'condition' => [
     				'pt_show_infobox_clickable' => 'yes'
     			]
			]
		);

		$this->end_controls_section();

		/**
		 * Infobox Content
		 */
		$this->start_controls_section(
			'pt_infobox_content',
			[
				'label' => esc_html__( 'Infobox Content', 'elementor' ),
			]
		);
		$this->add_control(
			'pt_infobox_title',
			[
				'label' => esc_html__( 'Infobox Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'This is an icon box', 'elementor' )
			]
		);
		$this->add_control(
			'pt_infobox_text',
			[
				'label' => esc_html__( 'Infobox Text', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( 'Write a short description, that will describe the title or something informational and useful.', 'elementor' )
			]
		);
		$this->add_control(
			'pt_show_infobox_content',
			[
				'label' => __( 'Show Content', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'return_value' => 'yes',
			]
		);
		$this->add_responsive_control(
			'pt_infobox_content_alignment',
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
				'prefix_class' => 'pt-infobox2-content-align-',
				'condition' => [
					'pt_infobox_img_type' => 'img-on-top'
				]
			]
		);
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_infobox_style_settings',
			[
				'label' => esc_html__( 'Info Box Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_infobox_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#cecece',
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pt_infobox_container_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-infobox2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
				'default' => [
	 					'{{WRAPPER}} .pt-infobox2' => 'padding: {{TOP}}{{20}} {{RIGHT}}{{20}} {{BOTTOM}}{{20}} {{LEFT}}{{20}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'pt_infobox_container_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-infobox2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'pt_infobox_border',
					'label' => esc_html__( 'Border', 'elementor' ),
					'selector' => '{{WRAPPER}} .pt-infobox2',
				]
		);

		$this->add_control(
			'pt_infobox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_infobox_shadow',
				'selector' => '{{WRAPPER}} .pt-infobox2',
			]
		);

		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Image)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_infobox_imgae_style_settings',
			[
				'label' => esc_html__( 'Image Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'pt_infobox_img_or_icon' => 'img'
		     	]
			]
		);

		$this->add_control(
		  'pt_infobox_img_shape',
		  	[
		   	'label'     	=> esc_html__( 'Image Shape', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'square',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'square'  	=> esc_html__( 'Square', 'elementor' ),
		     		'circle' 	=> esc_html__( 'Circle', 'elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'elementor' ),
		     	],
		     	'prefix_class' => 'pt-infobox2-shape-',
		     	'condition' => [
		     		'pt_infobox_img_or_icon' => 'img'
		     	]
		  	]
		);

		$this->add_control(
			'pt_infobox_image_resizer',
			[
				'label' => esc_html__( 'Image Resizer', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2 .infobox-icon img' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .pt-infobox2.icon-on-left .infobox-icon' => 'width: {{SIZE}}px;',
					'{{WRAPPER}} .pt-infobox2.icon-on-right .infobox-icon' => 'width: {{SIZE}}px;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'pt_infobox_image[url]!' => '',
				],
				'condition' => [
					'pt_infobox_img_or_icon' => 'img',
				]
			]
		);

		$this->add_responsive_control(
			'pt_infobox_img_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-infobox2 .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Icon Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_infobox_icon_style_settings',
			[
				'label' => esc_html__( 'Icon Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
		     		'pt_infobox_img_or_icon' => 'icon'
		     	]
			]
		);

		$this->add_control(
    		'pt_infobox_icon_size',
    		[
        		'label' => __( 'Icon Size', 'elementor' ),
       		'type' => Controls_Manager::SLIDER,
        		'default' => [
            	'size' => 40,
        		],
        		'range' => [
            	'px' => [
                	'min' => 20,
                	'max' => 100,
                	'step' => 1,
            	]
        		],
        		'selectors' => [
            	'{{WRAPPER}} .pt-infobox2 .infobox-icon i' => 'font-size: {{SIZE}}px;',
        		],
    		]
		);


		$this->add_control(
    		'pt_infobox_icon_bg_size',
    		[
        		'label' => __( 'Icon Background Size', 'elementor' ),
       			'type' => Controls_Manager::SLIDER,
        		'default' => [
            		'size' => 90,
        		],
        		'range' => [
            		'px' => [
                		'min' => 0,
                		'max' => 300,
                		'step' => 1,
            		]
        		],
        		'selectors' => [
            		'{{WRAPPER}} .pt-infobox2 .infobox-icon .infobox-icon-wrap' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
        		],
        		'condition' => [
					'pt_infobox_icon_bg_shape!' => 'none',
					'pt_infobox_img_type!' => ['img-on-left', 'img-on-right'],
				]
    		]
		);

		$this->add_responsive_control(
			'pt_infobox_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-infobox2 .infobox-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_control(
			'pt_infobox_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2 .infobox-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt-infobox2.icon-beside-title .infobox-content .title figure i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		  'pt_infobox_icon_bg_shape',
		  	[
		   	'label'     	=> esc_html__( 'Background Shape', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'none',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'none'  	=> esc_html__( 'None', 'elementor' ),
		     		'circle' 	=> esc_html__( 'Circle', 'elementor' ),
		     		'radius' 	=> esc_html__( 'Radius', 'elementor' ),
		     		'square' 	=> esc_html__( 'Square', 'elementor' ),
		     	],
		     	'prefix_class' => 'pt-infobox2-icon-bg-shape-',
		     	'condition' => [
					'pt_infobox_img_type!' => ['img-on-left', 'img-on-right'],
				]
		  	]
		);

		$this->add_control(
			'pt_infobox_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f4f4f4',
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2 .infobox-icon .infobox-icon-wrap' => 'background: {{VALUE}};',
				],
				'condition' => [
					'pt_infobox_img_type!' => ['img-on-left', 'img-on-right'],
					'pt_infobox_icon_bg_shape!' => 'none',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Info Box Title Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_infobox_title_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_infobox_title_heading',
			[
				'label' => esc_html__( 'Title Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'pt_infobox_title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2 .infobox-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'pt_infobox_title_typography',
				'selector' => '{{WRAPPER}} .pt-infobox2 .infobox-content .title',
			]
		);

		$this->add_responsive_control(
			'pt_infobox_title_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-infobox2 .infobox-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_control(
			'pt_infobox_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'pt_infobox_content_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .pt-infobox2 .infobox-content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'pt_infobox_content_typography',
				'selector' => '{{WRAPPER}} .pt-infobox2 .infobox-content p',
			]
		);

		$this->end_controls_section();

	}


	protected function render( ) {

   		$settings = $this->get_settings();
      	$infobox_image = $this->get_settings( 'pt_infobox_image' );
	  	$infobox_image_url = Group_Control_Image_Size::get_attachment_image_src( $infobox_image['id'], 'thumbnail', $settings );
	  	if( empty( $infobox_image_url ) ) : $infobox_image_url = $infobox_image['url']; else: $infobox_image_url = $infobox_image_url; endif;

	  	$target = $settings['pt_show_infobox_clickable_link']['is_external'] ? 'target="_blank"' : '';
	  	$nofollow = $settings['pt_show_infobox_clickable_link']['nofollow'] ? 'rel="nofollow"' : '';

	?>
		<?php if( 'img-on-top' == $settings['pt_infobox_img_type'] ) : ?>
		<div class="pt-infobox2">
			<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['pt_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
			<div class="infobox-icon">
				<?php if( 'img' == $settings['pt_infobox_img_or_icon'] ) : ?>
					<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
				<?php endif; ?>
				<?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : ?>
				<div class="infobox-icon-wrap">
					<i class="<?php echo esc_attr( $settings['pt_infobox_icon'] ); ?>"></i>
				</div>
				<?php endif; ?>
			</div>
			<div class="infobox-content">
				<h4 class="title"><?php echo $settings['pt_infobox_title']; ?></h4>
				<?php if( 'yes' == $settings['pt_show_infobox_content'] ) : ?>
					<?php if ( ! empty( $settings['pt_infobox_text'] ) ) : ?>
					<p><?php echo $settings['pt_infobox_text']; ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?></a><?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if( 'img-on-left' == $settings['pt_infobox_img_type'] ) : ?>
		<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['pt_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
		<div class="pt-infobox2 icon-on-left">
			<div class="infobox-icon <?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : echo esc_attr( 'pt-icon-only', 'elementor' ); endif; ?>">
				<?php if( 'img' == $settings['pt_infobox_img_or_icon'] ) : ?>
				<figure>
					<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
				</figure>
				<?php endif; ?>
				<?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : ?>
				<div class="infobox-icon-wrap">
					<i class="<?php echo esc_attr( $settings['pt_infobox_icon'] ); ?>"></i>
				</div>
				<?php endif; ?>
			</div>
			<div class="infobox-content <?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : echo esc_attr( 'pt-icon-only', 'elementor' ); endif; ?>">
				<h4 class="title"><?php echo $settings['pt_infobox_title']; ?></h4>
				<?php if( 'yes' == $settings['pt_show_infobox_content'] ) : ?>
					<?php if ( ! empty( $settings['pt_infobox_text'] ) ) : ?>
					<p><?php echo $settings['pt_infobox_text']; ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?></a><?php endif; ?>
		<?php endif; ?>
		<?php if( 'img-on-right' == $settings['pt_infobox_img_type'] ) : ?>
		<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?><a href="<?php echo esc_url( $settings['pt_show_infobox_clickable_link']['url'] ) ?>" <?php echo $target; ?> <?php echo $nofollow; ?>> <?php endif;?>
		<div class="pt-infobox2 icon-on-right">
			<div class="infobox-icon <?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : echo esc_attr( 'pt-icon-only', 'elementor' ); endif; ?>">
				<?php if( 'img' == $settings['pt_infobox_img_or_icon'] ) : ?>
				<figure>
					<img src="<?php echo esc_url( $infobox_image_url ); ?>" alt="Icon Image">
				</figure>
				<?php endif; ?>
				<?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : ?>
				<div class="infobox-icon-wrap">
					<i class="<?php echo esc_attr( $settings['pt_infobox_icon'] ); ?>"></i>
				</div>
				<?php endif; ?>
			</div>
			<div class="infobox-content <?php if( 'icon' == $settings['pt_infobox_img_or_icon'] ) : echo esc_attr( 'pt-icon-only', 'elementor' ); endif; ?>">
				<h4 class="title"><?php echo $settings['pt_infobox_title']; ?></h4>
				<?php if( 'yes' == $settings['pt_show_infobox_content'] ) : ?>
					<?php if ( ! empty( $settings['pt_infobox_text'] ) ) : ?>
					<p><?php echo $settings['pt_infobox_text']; ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php if( 'yes' == $settings['pt_show_infobox_clickable'] ) : ?></a><?php endif; ?>
		<?php endif; ?>
	<?php
	}

	protected function content_template() {
		?>
		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_PT_Info_Box() );