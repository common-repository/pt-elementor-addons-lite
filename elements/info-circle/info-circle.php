<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\InfoCircle;
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
class Info_Circle extends Widget_Base {
	/**
	 * Define our get name settings.
	 */
	public function get_name() {
		return 'pt-info-circle';
	}
	/**
	 * Define our get title settings.
	 */
	public function get_title() {
		return __( 'Info Circle', 'elementor' );
	}
	/**
	 * Define our get icon settings.
	 */
	public function get_icon() {
		return 'eicon-pojome';
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
		$repeater = new \Elementor\Repeater();
		$repeater->start_controls_tabs( 'form_fields_tabs' );
		$repeater->start_controls_tab( 'form_fields_content_tab', [
			'label' => __( 'General', 'elementor-pro' ),
		] );
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Info Circle Item', 'elementor' ),
			]
		);
		$repeater->add_control(
			'item_description',
			[
				'label' => __( 'Description', 'elementor' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),
				'description' => __( 'Description - This is the content which will be displayed inside the circle', 'elementor' ),
			]
		);
		$repeater->add_control(
			'call_to_action',
			[
				'label' => __( 'Call To Action - CTA', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
				'show_label' => true,
			]
		);
		$repeater->add_control(
			'information_circle_style',
			[
				'label' => __( 'Information Circle Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'label' => __( 'Box Background', 'elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '',
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab( 'form_fields_advanced_tab', [
			'label' => __( 'Image / Icon', 'elementor' ),
		]);
		$repeater->add_control(
			'circle_type',
			[
				'label' => __( 'Round Type', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'icon' => __( 'Icon', 'elementor' ),
					'image' => __( 'Image', 'elementor' ),
				],
				'default' => 'image',
			]
		);
		$repeater->add_control(
			'icon_design',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'image_design',
			[
				'label' => __( 'Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'circle_type' => 'image',
				],
			]
		);
		$repeater->add_control(
			'info_icon_size',
			[
				'label' => __( 'Icon Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-icon-content .pt-icon-wrap .pt-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'icon_colors',
			[
				'label' => __( 'Icon Colors', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'info_icon_color',
			[
				'label' => __( 'Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-icon-content .pt-icon-wrap .pt-icon i' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pt-icon-wrap .pt-icon i' => 'background: {{VALUE}};',
				],
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'active_icon_colors',
			[
				'label' => __( 'Active Icon Colors', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'active_icon_color',
			[
				'label' => __( 'Active Icon Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-icon-content.active .pt-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'active_icon_bg_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-icon-content.active .pt-icon-wrap .pt-icon i' => 'background: {{VALUE}};',
				],
				'condition' => [
					'circle_type' => 'icon',
				],
			]
		);
		$repeater->add_responsive_control(
			'pt_main_image_width',
			[
				'label' => esc_html__( 'Image Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pt-image-content img' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'circle_type' => 'image',
				],
			]
		);
		
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pt_thumbnail_image_border',
				'label' => esc_html__( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-image-content img,.pt-icon-wrap .pt-icon i',
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border Radius',
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-image-content img,.pt-icon-wrap .pt-icon i',
			]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_section(
			'section_form_fields',
			[
				'label' => __( 'Info Circle Items', 'elementor' ),
			]
		);
		$this->add_control(
			'add_circle_item',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Info Circle Item', 'elementor' ),
						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'pt_section_info_circle_height',
			[
				'label' => esc_html__( 'Info Circle Height', 'elementor' ),
			]
		);
		$this->add_responsive_control(
			'pt_main_circle_height',
			[
				'label' => esc_html__( 'Main Circle Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 768,
					'unit' => 'px',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 1000,
					],
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-wrap' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'pt_main_image_width',
			[
				'label' => esc_html__( 'Image Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'description'=>'Recommendation size image 80 To 100',
				'default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pt-image-content img' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],
// 				'condition' => [
// 					'circle_type' => 'image',
// 				],
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'section-general-autoplay-style',
			[
				'label' => __( 'General', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'elementor' ),
				'label_off' => __( 'No', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'autoplay_interval',
			[
				'label' => __( 'Autoplay Interval', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '10', 'elementor' ),
				'placeholder' => __( '15 sec(s)', 'elementor' ),
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Animation of Thumbnails when Page Loads', 'elementor' ),
				'type' => Controls_Manager::ANIMATION,
			]
		);
		$this->add_control(
			'active_hover_animation',
			[
				'label' => __( 'Animation of Active Thumbnail', 'elementor' ),
				'type' => Controls_Manager::ANIMATION,
				'default' => 'none',
				'selector' => '{{WRAPPER}} .pt-info-circle-icon-content.active .pt-image-content img, .pt-info-circle-icon-content.active .pt-icon-wrap .pt-icon i',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'pt_section_thumbnail_image_styles',
			[
				'label' => esc_html__( 'Thumbnail Styles', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'pt_thumbnail_image_rounded',
			[
				'label' => __( 'Rounded Image?', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'thumbnail-avatar-rounded',
				'label_on' => __( 'Show', 'elementor' ),
				'label_off' => __( 'Hide', 'elementor' ),
				'return_value' => 'thumbnail-avatar-rounded',
			]
		);
		$this->add_control(
			'pt_thumbnail_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .pt-thumbnail-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'pt_thumbnail_image_rounded' => 'thumbnail-avatar-not-rounded',
				],
			]
		);
		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label' => __( 'Custom Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pt-image-crop-circle .pt-image-content img, {{WRAPPER}} .pt-icon-wrap .pt-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_connector',
			[
				'label' => __( 'Connector', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'connector_border',
				'label' => __( 'Image Border', 'elementor' ),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .pt-info-circle-wrap::before',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_info_circle_bg',
			[
				'label' => __( 'Info Circle Style', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'info_circle_box_background',
				'label' => __( 'Box Background', 'elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pt-info-circle-out',
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
			'title_size',
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
			'hover_title_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-title' => 'color: {{VALUE}};',
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
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pt-info-circle-title',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);
		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'hover_description_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-desc' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .pt-info-circle-desc',
				'scheme' => Typography::TYPOGRAPHY_3,
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
					'{{WRAPPER}} .pt-info-circle-cta .pt-infoc-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .pt-info-circle-cta .pt-infoc-link',
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
				'default' => '#d8d8d8',
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-content .pt-info-circle-cta .pt-infoc-link' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .pt-info-circle-cta .pt-infoc-link',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pt-info-circle-cta .pt-infoc-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pt-info-circle-cta .pt-infoc-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'ac_link',
			[
				'label' => __( 'Action Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'elementor' ),
				'show_label' => true,
			]
		);
		
		$this->end_controls_section();
	}
	/**
	 * Define our Content Render settings.
	 */
	protected function render() {
		$settings = $this->get_settings();
		$circle_item_count = 0;
		$settings['first_thumb_pos'] = 0;
		$total_circle = count( $settings['add_circle_item'] );
		$angle_init = trim( $settings['first_thumb_pos'] ) > 0 ? $settings['first_thumb_pos'] : 0;
		$angle_gap   = 360 / $total_circle;
		$pt_action_text = ! empty( $settings['action_text'] ) ? $settings['action_text'] : '';
		?>
		<script>
		
		(function( $ ){
			PTInfoCircle = function()
			{
				this.node_IC	= '<?php echo $this->get_id(); ?>';
				this.autoplay	= '<?php echo $settings['autoplay']; ?>';
				this.interval_time	= <?php echo $settings['autoplay_interval']; ?>;
				this.initial_animation = '<?php echo $settings['hover_animation']; ?>';
				this._initInfoCircle();
			};
			PTInfoCircle.prototype = {
				infoCircle : '',
				_initInfoCircle : function() {
					this.infoCircle = $('.elementor-element-'+this.node_IC).find('.pt-info-circle-wrap');
					if(this.autoplay == 'yes') {
						this._setInfoCircleAutoPlay();
					}
					if ( this.initial_animation != 'none' ) {						
						this._setInitialAnimation();
					}
					this._disableActiveAnimation();
				},
				
				/**
				 * Set Initial Animation to Thumbnail Image/Icon
				 */
				_setInitialAnimation : function() {
					var initial_animation = this.initial_animation,
					
					infoCircle = this.infoCircle;
					this.infoCircle.find('.pt-info-circle-small > div').addClass( 'animated ' + initial_animation );
					setTimeout(function(){
						infoCircle.find('.pt-info-circle-small > div').attr('class','');
					}, 1500);
				},
				
				/**
				 * Disable Animation on mouseleave when Autopaly is disabled 
				 */
				_disableActiveAnimation : function() {
					var infoCircle = this.infoCircle;
					infoCircle.on( 'mouseleave', '.pt-info-circle-small', function() {
						$(this).children('div').attr('class','');
					});
				},
				
				/**
				 * Start Autoplay
				 */
				_setInfoCircleAutoPlay : function () {
						var infoCircle = this.infoCircle,
							interval_time = this.interval_time;
						var _interval = setInterval(function() {
							autoPlaySelector( 1, infoCircle );
						}, interval_time * 1000 );
						infoCircle.on('mouseenter click', '.pt-info-circle-small .pt-icon-wrap, .pt-info-circle-small .pt-image-infoC, .pt-info-circle-in', function() {
							clearInterval( _interval );
						}).on( 'mouseleave', '.pt-info-circle-small .pt-icon-wrap, .pt-info-circle-small .pt-image-infoC, .pt-info-circle-in', function() {
							_interval = setInterval(function() {
								autoPlaySelector( 1, infoCircle );
							}, interval_time * 1000 );
						});
					
				}
			}
			function autoPlaySelector( autoplay, infoCircle ) {
				if( autoplay ) {
				
					var removefrom = infoCircle.find('.pt-info-circle-icon-content.active'),
						addto = removefrom.next('.pt-info-circle-icon-content');
					if(addto.length == 0) {
						addto = infoCircle.find('.pt-info-circle-icon-content').first();;
					}
					updateActiveInfoCircle( removefrom, addto );
				}
			}
			/* Function to Update active class */
			function updateActiveInfoCircle( removefrom, addto ) {
				
				
				removefrom.find('.pt-info-circle-in').fadeOut(300);
				addto.find('.pt-info-circle-in').fadeIn(300);
				removefrom.removeClass('active');
				addto.addClass('active');
				/* Add/Remove Active Animation Classes */
				removefrom.find('.pt-info-circle-small > div').attr('class','');
				addto.find('.pt-info-circle-small > div').attr('class','');
				var ThumbActiveAnimation = addto.closest('.pt-info-circle-wrap').data('active-animation');
				if( ThumbActiveAnimation != 'no' ) {
					addto.find('.pt-info-circle-small > div').addClass( 'animated ' + ThumbActiveAnimation );
				}
			}
			
			/* Implement Height on Initially */
			$(document).ready(function(){
				
				/* On Hover trigger */
				$('.pt-info-circle-wrap.on-hover').on('mouseenter', '.pt-info-circle-small .pt-icon-wrap, .pt-info-circle-small .pt-image-infoC', function() {
					var current_parent = $(this).closest('.pt-info-circle-icon-content'),
						removeActiveFrom = current_parent.siblings('.pt-info-circle-icon-content');
					updateActiveInfoCircle(removeActiveFrom , current_parent );
				});
			
			});
		})(jQuery);
		
		jQuery(document).ready(function() {
			new PTInfoCircle({
				id: '<?php echo $this->get_id(); ?>',
				autoplay: '<?php echo $settings['autoplay']; ?>',
				interval: '<?php echo ( trim( $settings['autoplay_interval'] ) !== '' ) && ( $settings['autoplay_interval'] > 0 ) ? $settings['autoplay_interval'] : '10'; ?>',
				initial_animation: '<?php echo $settings['hover_animation']; ?>',
			});
		});
		</script>
		<div class="pt-module-content pt-info-circle-wrap on-hover" <?php echo ( 'yes' === $settings['autoplay']) ? 'data-interval-time="' . $settings['autoplay_interval'] . '"' : ''; ?> data-active-animation="<?php echo $settings['active_hover_animation']; ?>">
		<div class="pt-info-circle pt-info-circle-out"></div>
		<?php
		foreach ( $settings['add_circle_item'] as $item ) {
			$circle_item_count++;
			$angle = ( $angle_init - 90 ) * M_PI / 180;
				$x = 50 + ( 40 * cos( $angle ) );
				$y = 50 + ( 40 * sin( $angle ) );
			$circle_type = $item['circle_type'];
			$thumbnail_icon = $item['icon_design'];
			$thumbnail_image = $item['image_design'];
			if ( '' === $thumbnail_image['id'] ) {
				$thumbnail_image_url = $item['image_design']['url'];
			} else {
				 $thumbnail_image_url = Group_Control_Image_Size::get_attachment_image_src( $thumbnail_image['id'], 'thumbnail', $item );
			}
			$thumbnail_classes = $this->get_settings( 'pt_thumbnail_image_rounded' );
			$this->add_render_attribute( 'hoverlink', 'class', 'link' );
			if ( ! empty( $item['link']['url'] ) ) {
				$this->add_render_attribute( 'hoverlink', 'href', $item['link']['url'] );
				if ( ! empty( $item['link']['is_external'] ) ) {
					$this->add_render_attribute( 'hoverlink', 'target', '_blank' );
				}
			}
			/* inner wise css */
				$boxbgbg = $item['box_background_background'];
				$bbgco = $item['box_background_color'];
				$bbgcou = $item['box_background_color_stop']['unit'];
				$bbgcos = $item['box_background_color_stop']['size'];
				$bbgcob = $item['box_background_color_b'];
				$bbgcobstop = $item['box_background_color_b_stop']['size'];
				$bbgcobstops = $item['box_background_color_b_stop']['unit'];
				$bbggrty = $item['box_background_gradient_type'];
				$bbggran = $item['box_background_gradient_angle']['size'];
				$bbggranu = $item['box_background_gradient_angle']['unit'];
				$bbggrpo = $item['box_background_gradient_position'];
				$bbgimage = $item['box_background_image']['url'];
				$bbgpo = $item['box_background_position'];
				$bbgat = $item['box_background_attachment'];
				$bbgre = $item['box_background_repeat'];
				$bbgsi = $item['box_background_size'];
				$bbgvlink = $item['box_background_video_link'];
				$bbgvfail = $item['box_background_video_fallback']['url'];
			?>
			<div class="pt-info-circle-icon-content pt-ic-<?php echo $circle_item_count; ?> <?php echo ( 1 === $circle_item_count ) ? 'active' : ''; ?>">
				<a  href="<?php /* echo $this->get_render_attribute_string( 'hoverlink' ); */ echo $item['link']['url'];  ?>" id="cur_img_url"   data-title="<?php echo $item['title']; ?>" data-ich_description="<?php echo $item['item_description']; ?>" > <!-- Link on Icon -->
					<div class="pt-info-circle pt-info-circle-small pt-circle-<?php echo $circle_item_count; ?> " data-circle-id="<?php echo $circle_item_count; ?>" style="left:<?php echo $x; ?>%;top: <?php echo $y; ?>%;">
						<div class="pt-module-content pt-imgicon-wrap">	
						<?php if ( 'image' === $circle_type ) : ?>
						<div class="pt-image pt-image-crop-circle">
							<div class="pt-image-content">
							<img src="<?php echo esc_url( $thumbnail_image_url ); ?>" alt="" class="pt-photo-img elementor-animation-<?php echo esc_attr( $settings['hover_animation'] ); ?> <?php echo $thumbnail_classes; ?>">
							</div>
						</div>
						<?php endif; ?>
						<?php if ( 'icon' === $circle_type ) : ?>
						<span class="pt-icon-wrap">
							<span class="pt-icon">
								<i class="<?php echo $thumbnail_icon; ?> <?php echo $thumbnail_classes; ?> elementor-animation-<?php echo esc_attr( $settings['hover_animation'] ); ?>"></i>
							</span>
						</span>
						<?php endif; ?>
						</div>
					</div>
				</a>				
				<div class="pt-info-circle pt-info-circle-in pt-info-circle-in-<?php echo $circle_item_count; ?>"
				<?php
				if ( 'classic' === $boxbgbg ) {
				?> style="background-color: <?php echo $bbgco ?>; background-image: url('<?php echo $bbgimage; ?>'); background-position: <?php echo $bbgpo ?>; background-repeat: <?php echo $bbgre ?>; background-size: <?php echo $bbgsi; ?>; background-attachment: <?php echo $bbgat ?>; <?php if ( 1 === $circle_item_count ) { ?> display:block; <?php } ?>"<?php } ?><?php if ( 'gradient' === $boxbgbg ) { ?> style="background-image: linear-gradient(<?php echo $bbggran ?><?php echo $bbggranu ?>, <?php echo $bbgco ?> <?php echo $bbgcos ?><?php echo $bbgcou ?>, <?php echo $bbgcob ?> <?php echo $bbgcobstop ?><?php echo $bbgcobstops ?>);<?php if ( 1 === $circle_item_count ) { ?> display:block; <?php } ?>"<?php } ?>>
						<div class="pt-info-circle-content">
							<?php echo '<' . $settings['title_size'] . ' class="pt-info-circle-title">'; ?>
							<?php echo $item['title']; ?>
							<?php echo '</' . $settings['title_size'] . '>'; ?>
							<div class="pt-info-circle-desc pt-text-editor"><?php echo $item['item_description']; ?></div>
							<div class="pt-info-circle-cta pt-info-circle-cta-text">
							<?php
							if ( '' !== $pt_action_text ) {
							?>
								<a class="pt-infoc-link"  href="<?php echo $settings['ac_link']['url']; ?>">
									<?php echo $pt_action_text; ?>
								</a>
							<?php } ?>	
							</div>
						</div>
				</div>
			</div>	
			<?php
			$angle_init += $angle_gap;
		}
		?>
		</div>
		<script>
					jQuery(document).ready(function($){
						$(".pt-info-circle-icon-content > #cur_img_url").mouseover(function() {
					var url = $(this).attr('href');
						$('.pt-infoc-link').attr("href",url);
							var ic_title = $(this).attr("data-title");
							var ic_description = $(this).attr("data-ich_description");
							
							$('.pt-info-circle-title').html(ic_title);
							$('.pt-info-circle-desc').html(ic_description);
							console.log(title);
						});
					});
					</script>
				

<?php
	  }
	
	
	/**
	 * Define our Content template settings.
	 */
	protected function _content_template() {
	}
}