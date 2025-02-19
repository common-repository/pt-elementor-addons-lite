<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\FlipCarousel;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Core\Schemes\Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;
use \Pt_Addons_Elementor\Classes\Bootstrap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * content Widget
 */
class Flip_Carousel extends Widget_Base {

	use \Pt_Addons_Elementor\Includes\Triat\Helper;

    /**
	 * Retrieve content widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pt-flip-carousel';
    }

    /**
	 * Retrieve content widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Flip Carousel 3D', 'pt-addons-elementor' );
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
        return 'eicon-carousel';
    }

    /**
	 * Register content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {

		/**
  		 * Flip Carousel Settings
  		 */
  		$this->start_controls_section(
  			'pt_section_flip_carousel_settings',
  			[
  				'label' => esc_html__( 'Filp Carousel Settings', 'elementor' )
  			]
  		);

  		$this->add_control(
		  'pt_flip_carousel_type',
		  	[
		   	'label'       	=> esc_html__( 'Carousel Type', 'elementor' ),
		     	'type' 			=> Controls_Manager::SELECT,
		     	'default' 		=> 'coverflow',
		     	'label_block' 	=> false,
		     	'options' 		=> [
		     		'coverflow' => esc_html__( 'Cover-Flow', 'elementor' ),
		     		'carousel'  => esc_html__( 'Carousel', 'elementor' ),
		     		'flat'  	=> esc_html__( 'Flat', 'elementor' ),
		     		'wheel'  	=> esc_html__( 'Wheel', 'elementor' ),
		     	],
		  	]
		);

		$this->add_control(
			'pt_flip_carousel_fade_in',
			[
				'label' => esc_html__( 'Fade In (ms)', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 400,
			]
		);

		$this->add_control(
		  'pt_flip_carousel_start_from',
		  	[
				'label' => __( 'Item Starts From Center?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		/**
		 * Condition: 'pt_flip_carousel_start_from' => 'true'
		 */
		$this->add_control(
			'pt_flip_carousel_starting_number',
			[
				'label' => esc_html__( 'Enter Starts Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 1,
				'condition' => [
					'pt_flip_carousel_start_from!' => 'true'
				]
			]
		);

		$this->add_control(
		  'pt_flip_carousel_loop',
		  	[
				'label' => __( 'Loop', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'pt_flip_carousel_autoplay',
		  	[
				'label' => __( 'Autoplay', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		/**
		 * Condition: 'pt_flip_carousel_autoplay' => 'true'
		 */
		$this->add_control(
			'pt_flip_carousel_autoplay_time',
			[
				'label' => esc_html__( 'Autoplay Timeout (ms)', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => 2000,
				'condition' => [
					'pt_flip_carousel_autoplay' => 'true'
				]
			]
		);

		$this->add_control(
		  'pt_flip_carousel_pause_on_hover',
		  	[
				'label' => __( 'Pause On Hover', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'pt_flip_carousel_click',
		  	[
				'label' => __( 'On Click Play?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'pt_flip_carousel_scrollwheel',
		  	[
				'label' => __( 'On Scroll Wheel Play?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'pt_flip_carousel_touch',
		 	[
				'label' => __( 'On Touch Play?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
		  'pt_flip_carousel_button',
		  	[
				'label' => __( 'Carousel Navigator', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		$this->add_control(
			'pt_flip_carousel_spacing',
			[
				'label' => esc_html__( 'Slide Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => -0.6
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 1,
						'step' => 0.1
					],
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Filp Carousel Slides
		 */
		$this->start_controls_section(
			'pt_fli_carousel_slides',
			[
				'label' => esc_html__( 'Flip Carousel Slides', 'elementor' ),
			]
		);
//*** repeater code updated here  */
$repeater = new \Elementor\Repeater();

$repeater->add_control(
	'pt_flip_carousel_slide',
	[
		'label' => esc_html__( 'Slide', 'elementor' ),
		'type' => \Elementor\Controls_Manager::MEDIA,
		'default' => [
			'url' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg',
		],
	]
);

$repeater->add_control(
	'pt_flip_carousel_slide_text', [
		'label' => esc_html__( 'Slide Text', 'elementor' ),
		'description'=>esc_html__('Please use image size w-325 and h-525.'),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => esc_html__( 'Slide Text' , 'elementor' ),
		'label_block' => true,
	]
	);
	$repeater->add_control(
		'pt_flip_carousel_enable_slide_link',
		[
			'label' => esc_html__( 'Enable Slide Link', 'elementor' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'false',
		'label_on' => esc_html__( 'Yes', 'elementor' ),
		'label_off' => esc_html__( 'No', 'elementor' ),
		'return_value' => 'true',
		]
	);
	
	$repeater->add_control(
		'pt_flip_carousel_slide_link',
		[
			'label' => esc_html__( 'Slide Link', 'elementor' ),
			'type' => \Elementor\Controls_Manager::URL,
			'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
			'default' => [
				'url' => '#',
				'is_external' => '',
			 ],
			 'show_external' => true,
			 'condition' => [
				 'pt_flip_carousel_enable_slide_link' => 'true'
			 ]
		]);
	
		$this->add_control(
			'pt_flip_carousel_slides',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'seperator' => 'before',
				'default' => [
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
					[ 'pt_flip_carousel_slide' => PT_PLUGIN_URL . 'assets/front-end/img/slide.jpeg' ],
				],
				
				'title_field' => '{{pt_flip_carousel_slide_text}}',
			]
		);

		$this->end_controls_section();
//*** repeater code updated here  */
		/**
		 * -------------------------------------------
		 * Tab Style (Flip Carousel Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_flip_carousel_style_settings',
			[
				'label' => esc_html__( 'Flip Carousel Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_flip_carousel_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-flip-carousel' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pt_flip_carousel_container_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-flip-carousel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_responsive_control(
			'pt_flip_carousel_container_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-flip-carousel' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pt_flip_carousel_border',
				'label' => esc_html__( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-flip-carousel',
			]
		);

		$this->add_control(
			'pt_flip_carousel_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-flip-carousel' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_flip_carousel_shadow',
				'selector' => '{{WRAPPER}} .pt-flip-carousel',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Carousel Navigator Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_filp_carousel_custom_nav_settings',
			[
				'label' => esc_html__( 'Navigator Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
		  'pt_flip_carousel_custom_nav',
		  	[
				'label' => __( 'Navigator', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

		/**
		 * Condition: 'pt_flip_carousel_custom_nav' => 'true'
		 */
		$this->add_control(
			'pt_flip_carousel_custom_nav_prev_new',
			[
				'label' => esc_html__( 'Previous Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'pt_flip_carousel_custom_nav_prev',
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
				'condition' => [
					'pt_flip_carousel_custom_nav' => 'true'
				]
			]
		);

		/**
		 * Condition: 'pt_flip_carousel_custom_nav' => 'true'
		 */
		$this->add_control(
			'pt_flip_carousel_custom_nav_next_new',
			[
				'label' => esc_html__( 'Next Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'pt_flip_carousel_custom_nav_next',
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'pt_flip_carousel_custom_nav' => 'true'
				]
			]
		);

		$this->add_responsive_control(
			'pt_flip_carousel_custom_nav_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .flip-custom-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);

		$this->add_control(
			'pt_flip_carousel_custom_nav_size',
			[
				'label' => esc_html__( 'Icon Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '30'
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-custom-nav' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_flip_carousel_custom_nav_bg_size',
			[
				'label' => esc_html__( 'Background Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .flip-custom-nav' => 'width: {{SIZE}}px; height: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_flip_carousel_custom_nav_border_radius',
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
					'{{WRAPPER}} .flip-custom-nav' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pt_flip_carousel_custom_nav_color',
			[
				'label' => esc_html__( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#42418e',
				'selectors' => [
					'{{WRAPPER}} .flip-custom-nav' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_flip_carousel_custom_nav_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .flip-custom-nav' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pt_flip_carousel_custom_nav_border',
				'label' => esc_html__( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .flip-custom-nav',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_flip_carousel_custom_navl_shadow',
				'selector' => '{{WRAPPER}} .flip-custom-nav',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flip Carousel Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_filp_carousel_content_style_settings',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'pt_flip_carousel_content_heading',
			[
				'label' => esc_html__( 'Content Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'pt_filp_carousel_content_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#4d4d4d',
				'selectors' => [
					'{{WRAPPER}} .flip-carousel-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'pt_flip_carousel_content_typography',
				'selector' => '{{WRAPPER}} .flip-carousel-text',
			]
		);

		$this->end_controls_section();



	}


	protected function render( ) {

   	$settings = $this->get_settings();
    $flipbox_image = $this->get_settings( 'pt_flipbox_image' );
	$flipbox_image_url = Group_Control_Image_Size::get_attachment_image_src( $flipbox_image['id'], 'thumbnail', $settings );
	$nav_prev = ((isset($settings['__fa4_migrated']['pt_flip_carousel_custom_nav_prev_new']) || empty($settings['pt_flip_carousel_custom_nav_prev'])) ? $settings['pt_flip_carousel_custom_nav_prev_new']['value'] : $settings['pt_flip_carousel_custom_nav_prev']);
	$nav_next = ((isset($settings['__fa4_migrated']['pt_flip_carousel_custom_nav_next_new']) || empty($settings['pt_flip_carousel_custom_nav_next'])) ? $settings['pt_flip_carousel_custom_nav_next_new']['value'] : $settings['pt_flip_carousel_custom_nav_next']);

	// Loop Value
	if( 'true' == $settings['pt_flip_carousel_loop'] ) : $pt_loop = 'true'; else: $pt_loop = 'false'; endif;
	// Autoplay Value
	if( 'true' == $settings['pt_flip_carousel_autoplay'] ) : $pt_autoplay = $settings['pt_flip_carousel_autoplay_time']; else: $pt_autoplay = 'false'; endif;
	// Pause On Hover Value
	if( 'true' == $settings['pt_flip_carousel_pause_on_hover'] ) : $pt_pause_hover = 'true'; else: $pt_pause_hover = 'false'; endif;
	// Click Value
	if( 'true' == $settings['pt_flip_carousel_click'] ) : $pt_click = 'true'; else: $pt_click = 'false'; endif;
	// Scroll Wheel Value
	if( 'true' == $settings['pt_flip_carousel_scrollwheel'] ) : $pt_wheel = 'true'; else: $pt_wheel = 'false'; endif;
	// Touch Play Value
	if( 'true' == $settings['pt_flip_carousel_touch'] ) : $pt_touch = 'true'; else: $pt_touch = 'false'; endif;
	// Navigator Value
	if( 'true' == $settings['pt_flip_carousel_button'] ) : $pt_buttons = 'true'; else: $pt_buttons = 'false'; endif;
	if( 'true' == $settings['pt_flip_carousel_custom_nav'] ) : $pt_custom_buttons = 'custom';else: $pt_custom_buttons = ''; endif;
	// Start Value
	if( 'true' == $settings['pt_flip_carousel_start_from'] ) : $pt_start = 'center'; else: $pt_start = (int) $settings['pt_flip_carousel_starting_number']; endif;

	?>
	<div class="pt-flip-carousel flip-carousel-<?php echo esc_attr( $this->get_id() ); ?>" data-style="<?php echo esc_attr( $settings['pt_flip_carousel_type'] ); ?>" data-start="<?php echo $pt_start; ?>" data-fadein="<?php echo esc_attr( (int) $settings['pt_flip_carousel_fade_in'] ); ?>" data-loop="<?php echo $pt_loop; ?>" data-autoplay="<?php echo $pt_autoplay; ?>" data-pauseonhover="<?php echo $pt_pause_hover; ?>" data-spacing="<?php echo esc_attr( $settings['pt_flip_carousel_spacing']['size'] ); ?>" data-click="<?php echo $pt_click; ?>" data-scrollwheel="<?php echo $pt_wheel; ?>" data-touch="<?php echo $pt_touch; ?>" data-buttons="<?php echo $pt_custom_buttons; ?>" data-buttonprev="<?php echo $nav_prev; ?>" data-buttonnext="<?php echo $nav_next; ?>">
	    <ul class="flip-items">
			<?php
				foreach( $settings['pt_flip_carousel_slides'] as $slides ) :
					$image_alt_text  = get_post_meta($slides['pt_flip_carousel_slide']['id'], '_wp_attachment_image_alt', true);
			?>
		        <li>
		        	<?php if( 'true' == $slides['pt_flip_carousel_enable_slide_link'] ) :
		        		$pt_slide_link = $slides['pt_flip_carousel_slide_link']['url'];
		        		$target          = $slides['pt_flip_carousel_slide_link']['is_external'] ? 'target="_blank"' : '';
		        		$nofollow        = $slides['pt_flip_carousel_slide_link']['nofollow'] ? 'rel="nofollow"' : '';
		        		?>
						<a href="<?php echo esc_url($pt_slide_link); ?>" <?php echo $target; ?> <?php echo $nofollow; ?>>
							<img src="<?php echo $slides['pt_flip_carousel_slide']['url'] ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
						</a>
		            	<?php if( $slides['pt_flip_carousel_slide_text'] !='' ) : ?>
		            		<p class="flip-carousel-text"><?php echo esc_html__( $slides['pt_flip_carousel_slide_text'] ); ?></p>
		        		<?php endif; ?>
		        	<?php else: ?>
						<img src="<?php echo $slides['pt_flip_carousel_slide']['url'] ?>" alt="<?php echo esc_attr($image_alt_text); ?>">
		            	<?php if( $slides['pt_flip_carousel_slide_text'] !='' ) : ?>
		            		<p class="flip-carousel-text"><?php echo esc_html__( $slides['pt_flip_carousel_slide_text'] ); ?></p>
		        		<?php endif; ?>
		        	<?php endif; ?>

		        </li>
	    	<?php endforeach; ?>
	    </ul>
	</div>
	<?php
	}
}