<?php

namespace Pt_Addons_Elementor\Includes\Triat;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Utils as Utils;
trait Helper {

	/**
	 * For All Settings Key Need To Display
	 */
	function pt_get_post_data( $args ) {
		$defaults = array(
			'posts_per_page'   => 10,
			'offset'           => 0,
			'category'         => '',
			'category_name'    => '',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'author'           => '',
			'author_name'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true,
		);
		$atts     = wp_parse_args( $args, $defaults );
		$posts    = get_posts( $atts );
		return $posts;
	}
	public $post_args = [
		// content ticker
		'pt_ticker_type',
		'pt_ticker_custom_contents',
		// post grid
		'pt_post_grid_columns',
		// common
		'meta_position',
		'pt_show_meta',
		'image_size',
		'pt_show_image',
		'pt_show_title',
		'pt_show_excerpt',
		'pt_excerpt_length',
		'pt_show_read_more',
		'pt_read_more_text',
		'show_load_more',
		'show_load_more_text',
		// query_args
		'post_type',
		'post__in',
		'posts_per_page',
		'post_style',
		'tax_query',
		'post__not_in',
		'pt_post_authors',
		'ptposts_authors',
		'offset',
		'orderby',
		'order',
	];
	public function pt_get_column_class( $column_size = 3 ) {
		$style_class   = 'pt-threecol';
		$column_styles = array(
			1  => 'pt-twelvecol',
			2  => 'pt-sixcol',
			3  => 'pt-fourcol',
			4  => 'pt-threecol',
			5  => 'pt-onefifth',
			6  => 'pt-twocol',
			12 => 'pt-onecol',
		);
		if ( array_key_exists( $column_size, $column_styles ) && ! empty( $column_styles[ $column_size ] ) ) {
			$style_class = $column_styles[ $column_size ];
		}
		return $style_class;
	}
	/**
	 * Get all types of post.
	 *
	 * @return array
	 */
	public function pt_get_all_types_post() {
		$posts_args = array(
			'post_type'      => 'any',
			'post_style'     => 'all_types',
			'post_status'    => 'publish',
			'posts_per_page' => '-1',
		);
		$posts      = $this->pt_load_more_ajax( $posts_args );
		$post_list  = [];
		foreach ( $posts as $post ) {
			$post_list[ $post->ID ] = $post->post_title;
		}
		return $post_list;
	}
	/**
	 * Query Controls
	 */
	protected function pt_query_controls() {
		if ( 'pt-content-ticker' === $this->get_name() ) {
			$this->start_controls_section(
				'pt_section_content_ticker_filters',
				[
					'label'     => __( 'Dynamic Content Settings', 'pt-addons-elementor' ),
					'condition' => [
						'pt_ticker_type' => 'dynamic',
					],
				]
			);
		}
		if ( 'pt-content-timeline' === $this->get_name() ) {
			$this->start_controls_section(
				'pt_section_timeline__filters',
				[
					'label'     => __( 'Dynamic Content Settings', 'pt-addons-elementor' ),
					'condition' => [
						'pt_content_timeline_choose' => 'dynamic',
					],
				]
			);
		}
		if ( 'pt-content-timeline' !== $this->get_name() && 'pt-content-ticker' !== $this->get_name() ) {
			$this->start_controls_section(
				'pt_section_post__filters',
				[
					'label' => __( 'Query', 'pt-addons-elementor' ),
				]
			);
		}
		$this->add_group_control(
			'ptposts',
			[
				'name' => 'ptposts',
			]
		);
		$this->add_control(
			'post__not_in',
			[
				'label'       => __( 'Exclude', 'pt-addons-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->pt_get_all_types_post(),
				'label_block' => true,
				'post_type'   => '',
				'multiple'    => true,
				'condition'   => [
					'ptposts_post_type!' => 'by_id',
				],
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Posts Per Page', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			]
		);
		$this->add_control(
			'offset',
			[
				'label'   => __( 'Offset', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->pt_get_post_orderby_options(),
				'default' => 'date',
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'asc'  => 'Ascending',
					'desc' => 'Descending',
				],
				'default' => 'desc',
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Layout Controls For Post Block
	 */
	protected function pt_layout_controls() {
		$this->start_controls_section(
			'pt_section_post_timeline_layout',
			[
				'label' => __( 'Layout Settings', 'pt-addons-elementor' ),
			]
		);
		if ( 'pt-post-grid' === $this->get_name() ) {
			$this->add_control(
				'pt_post_grid_columns',
				[
					'label'   => esc_html__( 'Number of Columns', 'pt-addons-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'pt-col-4',
					'options' => [
						'pt-col-1' => esc_html__( 'Single Column', 'pt-addons-elementor' ),
						'pt-col-2' => esc_html__( 'Two Columns', 'pt-addons-elementor' ),
						'pt-col-3' => esc_html__( 'Three Columns', 'pt-addons-elementor' ),
						'pt-col-4' => esc_html__( 'Four Columns', 'pt-addons-elementor' ),
						'pt-col-5' => esc_html__( 'Five Columns', 'pt-addons-elementor' ),
						'pt-col-6' => esc_html__( 'Six Columns', 'pt-addons-elementor' ),
					],
				]
			);
		}
		if ( 'pt-post-block' === $this->get_name() ) {
			$this->add_control(
				'grid_style',
				[
					'label'   => esc_html__( 'Post Block Style Preset', 'pt-addons-elementor' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'post-block-style-default',
					'options' => [
						'post-block-style-default' => esc_html__( 'Default', 'pt-addons-elementor' ),
						'post-block-style-overlay' => esc_html__( 'Overlay', 'pt-addons-elementor' ),
					],
				]
			);
		}
		if ( 'pt-post-carousel' !== $this->get_name() ) {
			/**
			 * Show Read More
			 *
			 * @uses ContentTimeLine Elements - EAE
			 */
			if ( 'pt-content-timeline' === $this->get_name() ) {
				$this->add_control(
					'pt_show_read_more',
					[
						'label'     => __( 'Show Read More', 'pt-addons-elementor' ),
						'type'      => Controls_Manager::CHOOSE,
						'options'   => [
							'1' => [
								'title' => __( 'Yes', 'pt-addons-elementor' ),
								'icon'  => 'fa fa-check',
							],
							'0' => [
								'title' => __( 'No', 'pt-addons-elementor' ),
								'icon'  => 'fa fa-ban',
							],
						],
						'default'   => '1',
						'condition' => [
							'pt_content_timeline_choose' => 'dynamic',
						],
					]
				);
				$this->add_control(
					'pt_read_more_text',
					[
						'label'       => esc_html__( 'Label Text', 'pt-addons-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => false,
						'default'     => esc_html__( 'Read More', 'pt-addons-elementor' ),
						'condition'   => [
							'pt_content_timeline_choose' => 'dynamic',
							'pt_show_read_more'          => '1',
						],
					]
				);
			} else {
				$this->add_control(
					'show_load_more',
					[
						'label'   => __( 'Show Load More', 'pt-addons-elementor' ),
						'type'    => Controls_Manager::CHOOSE,
						'options' => [
							'1' => [
								'title' => __( 'Yes', 'pt-addons-elementor' ),
								'icon'  => 'fa fa-check',
							],
							'0' => [
								'title' => __( 'No', 'pt-addons-elementor' ),
								'icon'  => 'fa fa-ban',
							],
						],
						'default' => '0',
					]
				);
				$this->add_control(
					'show_load_more_text',
					[
						'label'       => esc_html__( 'Label Text', 'pt-addons-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'label_block' => false,
						'default'     => esc_html__( 'Load More', 'pt-addons-elementor' ),
						'condition'   => [
							'show_load_more' => '1',
						],
					]
				);
			}
		}
		if ( 'pt-content-timeline' !== $this->get_name() ) {
			$this->add_control(
				'pt_show_image',
				[
					'label'   => __( 'Show Image', 'pt-addons-elementor' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => __( 'Yes', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-check',
						],
						'0' => [
							'title' => __( 'No', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-ban',
						],
					],
					'default' => '1',
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'image',
					'exclude'   => [ 'custom' ],
					'default'   => 'medium',
					'condition' => [
						'pt_show_image' => '1',
					],
				]
			);
		}
		if ( 'pt-content-timeline' === $this->get_name() ) {
			$this->add_control(
				'pt_show_image_or_icon',
				[
					'label'     => __( 'Show Circle Image / Icon', 'pt-addons-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'img'    => [
							'title' => __( 'Image', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-picture-o',
						],
						'icon'   => [
							'title' => __( 'Icon', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-info',
						],
						'bullet' => [
							'title' => __( 'Bullet', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-circle',
						],
					],
					'default'   => 'icon',
					'condition' => [
						'pt_content_timeline_choose' => 'dynamic',
					],
				]
			);
			$this->add_control(
				'pt_icon_image',
				[
					'label'     => esc_html__( 'Icon Image', 'pt-addons-elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'pt_show_image_or_icon' => 'img',
					],
				]
			);
			$this->add_control(
				'pt_icon_image_size',
				[
					'label'     => esc_html__( 'Icon Image Size', 'pt-addons-elementor' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 24,
					],
					'range'     => [
						'px' => [
							'max' => 60,
						],
					],
					'condition' => [
						'pt_show_image_or_icon' => 'img',
					],
					'selectors' => [
						'{{WRAPPER}} .pt-content-timeline-img img' => 'width: {{SIZE}}px;',
					],
				]
			);
			$this->add_control(
				'pt_content_timeline_circle_icon',
				[
					'label'     => esc_html__( 'Icon', 'pt-addons-elementor' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-pencil',
					'condition' => [
						'pt_content_timeline_choose' => 'dynamic',
						'pt_show_image_or_icon'      => 'icon',
					],
				]
			);
		}
		$this->add_control(
			'pt_show_title',
			[
				'label'   => __( 'Show Title', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-ban',
					],
				],
				'default' => '1',
			]
		);
		$this->add_control(
			'pt_show_excerpt',
			[
				'label'   => __( 'Show excerpt', 'pt-addons-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-ban',
					],
				],
				'default' => '1',
			]
		);
		$this->add_control(
			'pt_excerpt_length',
			[
				'label'     => __( 'Excerpt Words', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'pt_show_excerpt' => '1',
				],
			]
		);
		if ( 'pt-post-grid' === $this->get_name() || 'pt-post-block' === $this->get_name() || 'pt-post-carousel' === $this->get_name() ) {
			$this->add_control(
				'pt_show_meta',
				[
					'label'   => __( 'Show Meta', 'pt-addons-elementor' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => __( 'Yes', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-check',
						],
						'0' => [
							'title' => __( 'No', 'pt-addons-elementor' ),
							'icon'  => 'fa fa-ban',
						],
					],
					'default' => '1',
				]
			);
			$this->add_control(
				'meta_position',
				[
					'label'     => esc_html__( 'Meta Position', 'pt-addons-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'meta-entry-footer',
					'options'   => [
						'meta-entry-header' => esc_html__( 'Entry Header', 'pt-addons-elementor' ),
						'meta-entry-footer' => esc_html__( 'Entry Footer', 'pt-addons-elementor' ),
					],
					'condition' => [
						'pt_show_meta' => '1',
					],
				]
			);
		}
		$this->end_controls_section();
	}
	 /**
	  * Get FluentForms List
	  *
	  * @return array
	  */
	public static function pt_select_fluent_forms() {
		$options = array();
		if ( defined( 'FLUENTFORM' ) ) {
			global $wpdb;

			$result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}fluentform_forms" );
			if ( $result ) {
				$options[0] = esc_html__( 'Select a Fluent Form', 'pt-addons-elementor' );
				foreach ( $result as $form ) {
					$options[ $form->id ] = $form->title;
				}
			} else {
				$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
			}
		}
		return $options;
	}
	/**
	 * Load More Button Style
	 */
	protected function pt_load_more_button_style() {
		$this->start_controls_section(
			'pt_section_load_more_btn',
			[
				'label'     => __( 'Load More Button Style', 'pt-addons-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_load_more' => '1',
				],
			]
		);
		$this->add_responsive_control(
			'pt_post_grid_load_more_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'pt-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pt_post_grid_load_more_btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'pt-addons-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-load-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pt_post_grid_load_more_btn_typography',
				'selector' => '{{WRAPPER}} .pt-load-more-button',
			]
		);
		$this->start_controls_tabs( 'pt_post_grid_load_more_btn_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'pt_post_grid_load_more_btn_normal', [ 'label' => esc_html__( 'Normal', 'pt-addons-elementor' ) ] );
		$this->add_control(
			'pt_post_grid_load_more_btn_normal_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_cta_btn_normal_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#29d8d8',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'pt_post_grid_load_more_btn_normal_border',
				'label'    => esc_html__( 'Border', 'pt-addons-elementor' ),
				'selector' => '{{WRAPPER}} .pt-load-more-button',
			]
		);
		$this->add_control(
			'pt_post_grid_load_more_btn_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'pt_post_grid_load_more_btn_shadow',
				'selector'  => '{{WRAPPER}} .pt-load-more-button',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		// Hover State Tab
		$this->start_controls_tab( 'pt_post_grid_load_more_btn_hover', [ 'label' => esc_html__( 'Hover', 'pt-addons-elementor' ) ] );
		$this->add_control(
			'pt_post_grid_load_more_btn_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_post_grid_load_more_btn_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#27bdbd',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_post_grid_load_more_btn_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'pt_post_grid_load_more_btn_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt-load-more-button:hover',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'pt_post_grid_loadmore_button_alignment',
			[
				'label'     => __( 'Button Alignment', 'pt-addons-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .pt-load-more-button-wrap' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Go Premium
	 */
	protected function pt_go_premium() {
		$this->start_controls_section(
			'pt_section_pro',
			[
				'label' => __( 'Go Premium for More Features', 'pt-addons-elementor' ),
			]
		);
		$this->add_control(
			'pt_control_get_pro',
			[
				'label'       => __( 'Unlock more possibilities', 'pt-addons-elementor' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => [
					'1' => [
						'title' => __( '', 'pt-addons-elementor' ),
						'icon'  => 'fa fa-unlock-alt',
					],
				],
				'default'     => '1',
				'description' => '<span class="pro-feature"> Get the  <a href="http://pt-addons.com/elementor/#pricing" target="_blank">Pro version</a> for more stunning elements and customization options.</span>',
			]
		);
		$this->end_controls_section();
	}
	public function pt_get_query_args( $control_id, $settings ) {
		$defaults   = [
			$control_id . '_post_type' => 'post',
			$control_id . '_posts_ids' => [],
			'orderby'                  => 'date',
			'order'                    => 'desc',
			'posts_per_page'           => 3,
			'offset'                   => 0,
		];
		$settings   = wp_parse_args( $settings, $defaults );
		$post_type  = $settings[ $control_id . '_post_type' ];
		$query_args = [
			'orderby'             => $settings['orderby'],
			'order'               => $settings['order'],
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish', // Hide drafts/private posts for admins
		];
		if ( 'by_id' === $post_type ) {
			$query_args['post_type'] = 'any';
			$query_args['post__in']  = $settings[ $control_id . '_posts_ids' ];
			if ( empty( $query_args['post__in'] ) ) {
				// If no selection - return an empty query
				$query_args['post__in'] = [ 0 ];
			}
		} else {
			$query_args['post_type']      = $post_type;
			$query_args['posts_per_page'] = $settings['posts_per_page'];
			$query_args['tax_query']      = [];
			$query_args['offset']         = $settings['offset'];
			$taxonomies                   = get_object_taxonomies( $post_type, 'objects' );
			foreach ( $taxonomies as $object ) {
				$setting_key = $control_id . '_' . $object->name . '_ids';
				if ( ! empty( $settings[ $setting_key ] ) ) {
					$query_args['tax_query'][] = [
						'taxonomy' => $object->name,
						'field'    => 'term_id',
						'terms'    => $settings[ $setting_key ],
					];
				}
			}
		}
		if ( ! empty( $settings[ $control_id . '_authors' ] ) ) {
			$query_args['author__in'] = $settings[ $control_id . '_authors' ];
		}
		$post__not_in = [];
		if ( ! empty( $settings['post__not_in'] ) ) {
			$post__not_in               = array_merge( $post__not_in, $settings['post__not_in'] );
			$query_args['post__not_in'] = $post__not_in;
		}
		if ( isset( $query_args['tax_query'] ) && count( $query_args['tax_query'] ) > 1 ) {
			$query_args['tax_query']['relation'] = 'OR';
		}
		return $query_args;
	}
	/**
	 * Get All POst Types
	 *
	 * @return array
	 */
	public function pt_get_post_types() {
		$pt_cpts         = get_post_types(
			array(
				'public'            => true,
				'show_in_nav_menus' => true,
			),
			'object'
		);
		$pt_exclude_cpts = array( 'elementor_library', 'attachment' );
		foreach ( $pt_exclude_cpts as $exclude_cpt ) {
			unset( $pt_cpts[ $exclude_cpt ] );
		}
		$post_types = array_merge( $pt_cpts );
		foreach ( $post_types as $type ) {
			$types[ $type->name ] = $type->label;
		}
		return $types;
	}
	/**
	 * Post Settings Parameter
	 *
	 * @param  array $settings
	 * @return array
	 */
	public function pt_get_post_settings( $settings ) {
		foreach ( $settings as $key => $value ) {
			if ( in_array( $key, $this->post_args ) ) {
				$post_args[ $key ] = $value;
			}
		}
		$post_args['post_style']  = isset( $post_args['post_style'] ) ? $post_args['post_style'] : 'grid';
		$post_args['is_pro']      = isset( $settings['is_pro'] ) ? $settings['is_pro'] : false;
		$post_args['post_status'] = 'publish';
		return $post_args;
	}
	/**
	 * Getting Excerpts By Post Id
	 *
	 * @param  int $post_id
	 * @param  int $excerpt_length
	 * @return string
	 */
	public function pt_get_excerpt_by_id( $post_id, $excerpt_length ) {
		$the_post    = get_post( $post_id ); // Gets post ID
		$the_excerpt = null;
		if ( $the_post ) {
			$the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
		}
		$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images
		$words       = explode( ' ', $the_excerpt, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			array_push( $words, '…' );
			$the_excerpt = implode( ' ', $words );
		endif;
		return $the_excerpt;
	}
	/**
	 * Get Post Thumbnail Size
	 *
	 * @return array
	 */
	public function pt_get_thumbnail_sizes() {
		$sizes = get_intermediate_image_sizes();
		foreach ( $sizes as $s ) {
			$ret[ $s ] = $s;
		}
		return $ret;
	}
	/**
	 * POst Orderby Options
	 *
	 * @return array
	 */
	public function pt_get_post_orderby_options() {
		$orderby = array(
			'ID'            => 'Post ID',
			'author'        => 'Post Author',
			'title'         => 'Title',
			'date'          => 'Date',
			'modified'      => 'Last Modified Date',
			'parent'        => 'Parent Id',
			'rand'          => 'Random',
			'comment_count' => 'Comment Count',
			'menu_order'    => 'Menu Order',
		);
		return $orderby;
	}
	/**
	 * Get Post Categories
	 *
	 * @return array
	 */
	public function pt_post_type_categories() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => true,
			)
		);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
		}
		return $options;
	}
	/**
	 * WooCommerce Product Query
	 *
	 * @return array
	 */
	public function pt_woocommerce_product_categories() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
			return $options;
		}
	}
	/**
	 * WooCommerce Get Product By Id
	 *
	 * @return array
	 */
	public function pt_woocommerce_product_get_product_by_id() {
		$postlist = get_posts(
			array(
				'post_type' => 'product',
				'showposts' => 9999,
			)
		);
		$options  = array();
		if ( ! empty( $postlist ) && ! is_wp_error( $postlist ) ) {
			foreach ( $postlist as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
			return $options;
		}
	}
	/**
	 * WooCommerce Get Product Category By Id
	 *
	 * @return array
	 */
	public function pt_woocommerce_product_categories_by_id() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
			return $options;
		}
	}
	/**
	 * Get Contact Form 7 [ if exists ]
	 */
	public function pt_select_contact_form() {
		$options = array();
		if ( function_exists( 'wpcf7' ) ) {
			$wpcf7_form_list = get_posts(
				array(
					'post_type' => 'wpcf7_contact_form',
					'showposts' => 999,
				)
			);
			$options[0]      = esc_html__( 'Select a Contact Form', 'pt-addons-elementor' );
			if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ) {
				foreach ( $wpcf7_form_list as $post ) {
					$options[ $post->ID ] = $post->post_title;
				}
			} else {
				$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
			}
		}
		return $options;
	}
	/**
	 * Get Gravity Form [ if exists ]
	 *
	 * @return array
	 */
	public function pt_select_gravity_form() {
		$options = array();
		if ( class_exists( 'GFCommon' ) ) {
			$gravity_forms = \RGFormsModel::get_forms( null, 'title' );
			if ( ! empty( $gravity_forms ) && ! is_wp_error( $gravity_forms ) ) {
				$options[0] = esc_html__( 'Select Gravity Form', 'pt-addons-elementor' );
				foreach ( $gravity_forms as $form ) {
					$options[ $form->id ] = $form->title;
				}
			} else {
				$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
			}
		}
		return $options;
	}
	/**
	 * Get WeForms Form List
	 *
	 * @return array
	 */
	public function pt_select_weform() {
		$wpuf_form_list = get_posts(
			array(
				'post_type' => 'wpuf_contact_form',
				'showposts' => 999,
			)
		);
		$options        = array();
		if ( ! empty( $wpuf_form_list ) && ! is_wp_error( $wpuf_form_list ) ) {
			$options[0] = esc_html__( 'Select weForm', 'pt-addons-elementor' );
			foreach ( $wpuf_form_list as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
		}
		return $options;
	}
	/**
	 * Get Ninja Form List
	 *
	 * @return array
	 */
	public function pt_select_ninja_form() {
		$options = array();
		if ( class_exists( 'Ninja_Forms' ) ) {
			$contact_forms = Ninja_Forms()->form()->get_forms();
			if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {
				$options[0] = esc_html__( 'Select Ninja Form', 'pt-addons-elementor' );
				foreach ( $contact_forms as $form ) {
					$options[ $form->get_id() ] = $form->get_setting( 'title' );
				}
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
		}
		return $options;
	}
	/**
	 * Get Caldera Form List
	 *
	 * @return array
	 */
	public function pt_select_caldera_form() {
		$options = array();
		if ( class_exists( 'Caldera_Forms' ) ) {
			$contact_forms = \Caldera_Forms_Forms::get_forms( true, true );
			if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {
				$options[0] = esc_html__( 'Select Caldera Form', 'pt-addons-elementor' );
				foreach ( $contact_forms as $form ) {
					$options[ $form['ID'] ] = $form['name'];
				}
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
		}
		return $options;
	}
	/**
	 * Get WPForms List
	 *
	 * @return array
	 */
	public function pt_select_wpforms_forms() {
		$options = array();
		if ( class_exists( '\WPForms\WPForms' ) ) {
			$args          = array(
				'post_type'      => 'wpforms',
				'posts_per_page' => -1,
			);
			$contact_forms = get_posts( $args );
			if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {
				$options[0] = esc_html__( 'Select a WPForm', 'pt-addons-elementor' );
				foreach ( $contact_forms as $post ) {
					$options[ $post->ID ] = $post->post_title;
				}
			}
		} else {
			$options[0] = esc_html__( 'Create a Form First', 'pt-addons-elementor' );
		}
		return $options;
	}
	/**
	 * Get all elementor page templates
	 *
	 * @return array
	 */
	public function pt_get_page_templates( $type = null ) {
		$args = [
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		];
		if ( $type ) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms'    => $type,
				],
			];
		}
		$page_templates = get_posts( $args );
		$options        = array();
		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}
	/**
	 * Get all Authors
	 *
	 * @return array
	 */
	public function pt_get_authors() {
		$options = array();
		$users   = get_users();
		if ( $users ) {
			foreach ( $users as $user ) {
				$options[ $user->ID ] = $user->display_name;
			}
		}
		return $options;
	}
	/**
	 * Get all Tags
	 *
	 * @return array
	 */
	public function pt_get_tags() {
		$options = array();
		$tags    = get_tags();
		foreach ( $tags as $tag ) {
			$options[ $tag->term_id ] = $tag->name;
		}
		return $options;
	}
	/**
	 * Get all Posts
	 *
	 * @return array
	 */
	public function pt_get_posts() {
		$post_list = get_posts(
			array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => -1,
			)
		);
		$posts     = array();
		if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
			foreach ( $post_list as $post ) {
				$posts[ $post->ID ] = $post->post_title;
			}
		}
		return $posts;
	}
	/**
	 * Get all Pages
	 *
	 * @return array
	 */
	public function pt_get_pages() {
		$page_list = get_posts(
			array(
				'post_type'      => 'page',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => -1,
			)
		);
		$pages     = array();
		if ( ! empty( $page_list ) && ! is_wp_error( $page_list ) ) {
			foreach ( $page_list as $page ) {
				$pages[ $page->ID ] = $page->post_title;
			}
		}
		return $pages;
	}
	/**
	 * This function is responsible for get the post data.
	 * It will return HTML markup with AJAX call and with normal call.
	 *
	 * @return string of an html markup with AJAX call.
	 * @return array of content and found posts count without AJAX call.
	 */
	public function pt_load_more_ajax() {
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'load_more' ) {
			$post_args = $this->pt_get_post_settings( $_POST );
			$post_args = array_merge( $this->pt_get_query_args( 'ptposts', $_POST ), $post_args, $_POST );
			if ( isset( $_POST['tax_query'] ) && count( $_POST['tax_query'] ) > 1 ) {
				$post_args['tax_query']['relation'] = 'OR';
			}
		} else {
			$args      = func_get_args();
			$post_args = $args[0];
		}
		$posts = new \WP_Query( $post_args );
		/**
		 * For returning all types of post as an array
		 *
		 * @return array;
		 */
		if ( isset( $post_args['post_style'] ) && $post_args['post_style'] == 'all_types' ) {
			return $posts->posts;
		}
		$return          = array();
		$return['count'] = $posts->found_posts;
		if ( isset( $post_args['post_style'] ) ) {
			if (
				$post_args['post_style'] == 'list'
				|| $post_args['post_style'] == 'dynamic_gallery'
				|| $post_args['post_style'] == 'content_timeline'
				|| $post_args['post_style'] == 'list'
				|| $post_args['post_style'] == 'block'
				|| $post_args['post_style'] == 'post_carousel'
			) {
				$post_args['is_pro'] = true;
			}
		}
		if ( isset( $post_args['post_style'] ) && $post_args['post_style'] == 'list' ) {
			$iterator = $feature_counter = 0;
			foreach ( $posts->posts as $post ) {
				if ( isset( $post_args['featured_posts'] ) && $post->ID != $post_args['featured_posts'] ) {
					$normal_posts[] = $post;
				}
			}
			$posts->posts = array_merge( empty( $post_args['featured_posts'] ) ? [] : [ $post_args['featured_posts'] ], $normal_posts );
		}
		ob_start();
		while ( $posts->have_posts() ) :
			$posts->the_post();
			$isPrinted = false;
			include $post_args['is_pro'] ? PT_PRO_PLUGIN_PATH : PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'includes/templates/content/' . @$post_args['post_style'] . '.php';
		endwhile;
		$return['content'] = ob_get_clean();
		wp_reset_postdata();
		wp_reset_query();
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'load_more' ) {
			if ( $_POST['post_style'] == 'list' ) {
				echo json_encode( $return );
				die();
			}
			echo $return['content'];
			die();
		} else {
			return $return;
		}
	}
	protected function render_feature_list( $settings, $obj ) {
		if ( empty( $settings['pt_pricing_table_items'] ) ) {
			return;
		}
		$counter = 0;
		?>
		<ul>
			<?php
			foreach ( $settings['pt_pricing_table_items'] as $item ) :
				if ( 'yes' !== $item['pt_pricing_table_icon_mood'] ) {
					$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'class', 'disable-item' );
				}
				if ( 'yes' === $item['pt_pricing_item_tooltip'] ) {
					$obj->add_render_attribute(
						'pricing_feature_item' . $counter,
						[
							'class' => 'tooltip',
							'title' => $item['pt_pricing_item_tooltip_content'],
							'id'    => $obj->get_id() . $counter,
						]
					);
				}
				if ( 'yes' == $item['pt_pricing_item_tooltip'] ) {
					if ( $item['pt_pricing_item_tooltip_side'] ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-side', $item['pt_pricing_item_tooltip_side'] );
					}
					if ( $item['pt_pricing_item_tooltip_trigger'] ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-trigger', $item['pt_pricing_item_tooltip_trigger'] );
					}
					if ( $item['pt_pricing_item_tooltip_animation'] ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-animation', $item['pt_pricing_item_tooltip_animation'] );
					}
					if ( ! empty( $item['pricing_item_tooltip_animation_duration'] ) ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-animation_duration', $item['pricing_item_tooltip_animation_duration'] );
					}
					if ( ! empty( $item['pt_pricing_table_toolip_arrow'] ) ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-arrow', $item['pt_pricing_table_toolip_arrow'] );
					}
					if ( ! empty( $item['pt_pricing_item_tooltip_theme'] ) ) {
						$obj->add_render_attribute( 'pricing_feature_item' . $counter, 'data-theme', $item['pt_pricing_item_tooltip_theme'] );
					}
				}
				?>
			<li <?php echo $obj->get_render_attribute_string( 'pricing_feature_item' . $counter ); ?>>
				<?php if ( 'show' === $settings['pt_pricing_table_icon_enabled'] ) : ?>
					<span class="li-icon" style="color:<?php echo esc_attr( $item['pt_pricing_table_list_icon_color'] ); ?>"><i class="<?php echo esc_attr( $item['pt_pricing_table_list_icon'] ); ?>"></i></span>
				<?php endif; ?>
				<?php echo $item['pt_pricing_table_item']; ?>
			</li>
				<?php
				$counter++;
endforeach;
			?>
		</ul>
		<?php
	}
	function pt_get_all_post_type_options() {
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		$options    = [ '' => '' ];
		foreach ( $post_types as $post_type ) {
			$options[ $post_type->name ] = $post_type->label;
		}
		return $options;
	}
	function pt_get_all_taxonomy_options() {
		global $wpdb;
		$results = array();
		foreach ( $wpdb->get_results(
			"
		SELECT terms.slug AS 'slug', terms.name AS 'label', termtaxonomy.taxonomy AS 'type'
		FROM $wpdb->terms AS terms
		JOIN $wpdb->term_taxonomy AS termtaxonomy ON terms.term_id = termtaxonomy.term_id
		LIMIT 100
	"
		) as $result ) {
			$results[ $result->type . ':' . $result->slug ] = $result->type . ':' . $result->label;
		}
		return $results;
	}
	function pt_get_taxonomies_map() {
		$map        = array();
		$taxonomies = get_taxonomies();
		foreach ( $taxonomies as $taxonomy ) {
			$map [ $taxonomy ] = $taxonomy;
		}
		return $map;
	}
	function pt_build_query_args( $settings ) {
		$query_args = [
			'orderby'             => $settings['orderby'],
			'order'               => $settings['order'],
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
		];
		if ( ! empty( $settings['post_in'] ) ) {
			$query_args['post_type'] = 'any';
			$query_args['post__in']  = explode( ',', $settings['post_in'] );
			$query_args['post__in']  = array_map( 'intval', $query_args['post__in'] );
		} else {
			if ( ! empty( $settings['post_types'] ) ) {
				$query_args['post_type'] = $settings['post_types'];
			}
			if ( ! empty( $settings['tax_query'] ) ) {
				$tax_queries                         = $settings['tax_query'];
				$query_args['tax_query']             = array();
				$query_args['tax_query']['relation'] = 'OR';
				foreach ( $tax_queries as $tq ) {
					list($tax, $term) = explode( ':', $tq );
					if ( empty( $tax ) || empty( $term ) ) {
						continue;
					}
					$query_args['tax_query'][] = array(
						'taxonomy' => $tax,
						'field'    => 'slug',
						'terms'    => $term,
					);
				}
			}
		}
		$query_args['posts_per_page'] = $settings['posts_per_page'];
		$query_args['paged']          = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
		return $query_args;
	}
	function pt_get_chosen_terms( $terms_query ) {
		$chosen_terms = array();
		$taxonomies   = array();
		if ( ! empty( $terms_query ) ) {
			foreach ( $terms_query as $term_query ) {
				list($taxonomy, $term_slug) = explode( ':', $term_query );
				if ( empty( $taxonomy ) || empty( $term_slug ) ) {
					continue;
				}
				$chosen_terms[] = get_term_by( 'slug', $term_slug, $taxonomy );
				if ( ! in_array( $taxonomy, $taxonomies ) ) {
					$taxonomies[] = $taxonomy;
				}
			}
		}
		// Remove duplicates
		$taxonomies = array_unique( $taxonomies );
		return array( $chosen_terms, $taxonomies );
	}
	function pt_get_taxonomy_terms_filter( $taxonomies, $chosen_terms = array() ) {
		$output = '';
		$terms  = array();
		if ( empty( $chosen_terms ) ) {
			foreach ( $taxonomies as $taxonomy ) {
				global $wp_version;
				if ( version_compare( $wp_version, '4.5', '>=' ) ) {
					$taxonomy_terms = get_terms( array( 'taxonomy' => $taxonomy ) );
				} else {
					$taxonomy_terms = get_terms( $taxonomy );
				}
				if ( ! empty( $taxonomy_terms ) && ! is_wp_error( $taxonomy_terms ) ) {
					$terms = array_merge( $terms, $taxonomy_terms );
				}
			}
		} else {
			$terms = $chosen_terms;
		}
		if ( ! empty( $terms ) ) {
			$output       .= '<div class="pt-taxonomy-filter">';
			$output       .= '<div class="pt-filter-item segment-0 pt-active"><a data-value="*" href="#">' . esc_html__( 'All', 'elementor' ) . '</a></div>';
			$segment_count = 1;
			foreach ( $terms as $term ) {
				$output .= '<div class="pt-filter-item segment-' . intval( $segment_count ) . '"><a href="#" data-value=".term-' . intval( $term->term_id ) . '" title="' . esc_html__( 'View all items filed under ', 'elementor' ) . esc_attr( $term->name ) . '">' . esc_html( $term->name ) . '</a></div>';
				$segment_count++;
			}
			$output .= '</div>';
		}
		return $output;
	}
	function pt_get_taxonomy_info( $taxonomies ) {
		$output     = '';
		$output    .= '<span class="pt-terms">';
		$term_count = 0;
		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( get_the_ID(), $taxonomy );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( $term_count != 0 ) {
						$output .= ', ';
					}
					$term_link = get_term_link( $term->slug, $taxonomy );
					if ( ! empty( $term_link ) && ! is_wp_error( $term_link ) ) {
						$output .= '<a href="' . $term_link . '">' . $term->name . '</a>';
					} else {
						$output .= $term->name;
					}
					$term_count = $term_count + 1;
				}
			}
		}
		$output .= '</span>';
		return $output;
	}
	function pt_entry_author() {
		$author = '<span class="author vcard">' . esc_html__( 'By ', 'elementor' ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author_meta( 'display_name' ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>';
		return $author;
	}
	function pt_entry_published( $format = null ) {
		if ( empty( $format ) ) {
			$format = get_option( 'date_format' );
		}
		$published = '<span class="published"><abbr title="' . sprintf( get_the_time( esc_html__( 'l, F, Y, g:i a', 'elementor' ) ) ) . '">' . sprintf( get_the_time( $format ) ) . '</abbr></span>';
		return $published;
		$link = '<span class="published">' . '<a href="' . get_day_link( get_the_time( esc_html__( 'Y', 'elementor' ) ), get_the_time( esc_html__( 'm', 'elementor' ) ), get_the_time( esc_html__( 'd', 'elementor' ) ) ) . '" title="' . sprintf( get_the_time( esc_html__( 'l, F, Y, g:i a', 'elementor' ) ) ) . '">' . '<span class="updated">' . get_the_time( $format ) . '</span>' . '</a></span>';
		return $link;
	}
	function pt_get_excerpt_by_id_lite( $post_id, $excerpt_length ) {
		$the_post    = get_post( $post_id );
		$the_excerpt = null;
		if ( $the_post ) {
			$the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
		}
		$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) );
		$words       = explode( ' ', $the_excerpt, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			$the_excerpt  = implode( ' ', $words );
			$the_excerpt .= '...';
		 endif;
		 return $the_excerpt;
	}
	
	
	/**
     * Get all product tags
     *
     * @return array
     */
    /*public function pt_get_woo_product_tags()
    {
        $options = array();
        $tags = get_terms('product_tag', array('hide_empty' => true));

        foreach ($tags as $tag) {
            $options[$tag->term_id] = $tag->name;
        }

        return $options;
    } */

    /**
     * Get all product attributes
     *
     * @return array
     */
    /*public function pt_get_woo_product_atts()
    {
        $options = array();
        $taxonomies = wc_get_attribute_taxonomies();

        foreach ($taxonomies as $tax) {
            $terms = get_terms('pa_' . $tax->attribute_name);

            if (!empty($terms)) {
                foreach ($terms as $term) {
                    $options[$term->term_id] = $tax->attribute_label . ': ' . $term->name;
                }
            }
        }

        return $options;
    }

    /**
     * Get all registered menus.
     *
     * @return array of menus.
     */
   public function pt_get_menus()
    {
        $menus = wp_get_nav_menus();
        $options = [];

        if (empty($menus)) {
            return $options;
        }

        foreach ($menus as $menu) {
            $options[$menu->term_id] = $menu->name;
        }

        return $options;
    } 

    public function get_page_template_options($type = '')
    {

        $page_templates = $this->pt_get_page_templates($type);

        $options[-1] = __('Select', 'pt-addons-elementor');

        if (count($page_templates)) {
            foreach ($page_templates as $id => $name) {
                $options[$id] = $name;
            }
        } else {
            $options['no_template'] = __('No saved templates found!', 'pt-addons-elementor');
        }

        return $options;
    } 
	

    // Get all WordPress registered widgets
   public function get_registered_sidebars()
    {
        global $wp_registered_sidebars;
        $options = [];

        if (!$wp_registered_sidebars) {
            $options[''] = __('No sidebars were found', 'pt-addons-elementor');
        } else {
            $options['---'] = __('Choose Sidebar', 'pt-addons-elementor');

            foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
                $options[$sidebar_id] = $sidebar['name'];
            }
        }
        return $options;
    } 

    /*public function pt_get_block_pass_protected_form($settings)
    {
        echo '<div class="pt-password-protected-content-fields">';
        echo '<form method="post">';
        echo '<input type="password" name="protection_password" class="pt-password" placeholder="' . $settings['protection_password_placeholder'] . '">';
        echo '<input type="submit" value="' . $settings['protection_password_submit_btn_txt'] . '" class="pt-submit">';
        echo '</form>';
        if (isset($_POST['protection_password']) && ($settings['protection_password'] !== $_POST['protection_password'])) {
            echo sprintf(__('<p class="protected-content-error-msg">Password does not match.</p>', 'pt-addons-elementor'));
        }
        echo '</div>';
    } */

    /**
     * @param Widget_Base $widget
     */
    /* public function add_exclude_controls()
    {
        $this->add_control(
            'post__not_in',
            [
                'label' => __('Exclude', 'pt-addons-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->pt_get_all_types_post(),
                'label_block' => true,
                'post_type' => '',
                'multiple' => true,
                'condition' => [
                    'ptposts_post_type!' => 'by_id',
                ],
            ]
        );
    } */

     function pt_get_post_types_pro() {
        $pt_cpts = get_post_types(
            array(
                'public' => true,
                'show_in_nav_menus' => true,
            )
        );
        $eael_exclude_cpts = array( 'elementor_library', 'attachment', 'product' );
    
        foreach ( $eael_exclude_cpts as $exclude_cpt ) {
            unset( $pt_cpts[ $exclude_cpt ] );
        }
    
            $post_types = array_merge( $pt_cpts );
        return $post_types;
    } 

     function pt_post_type_categories_pro() {
        $terms = get_terms(
            array(
                'taxonomy' => 'category',
                'hide_empty' => true,
            )
        );
    
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name;
            }
        }
    
            return $options;
    }

     function pt_get_post_orderby_options_pro() {
        $orderby = array(
            'ID' => 'Post Id',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );
    
        return $orderby;
    }

     function pt_get_post_settings_pro( $settings ) {
        $post_args['post_type'] = $settings['pt_post_type'];
    
        if ( 'post' === $settings['pt_post_type'] ) {
            $post_args['category'] = $settings['pt_category'];
        }
    
        $post_args['posts_per_page'] = $settings['num_posts'];
        $post_args['offset'] = $settings['post_offset'];
        $post_args['orderby'] = $settings['orderby'];
        $post_args['order'] = $settings['order'];
    
        return $post_args;
    }

    function pt_get_post_data_pro( $args ) {
        $defaults = array(
            'posts_per_page'   => 10,
            'offset'           => 0,
            'category'         => '',
            'category_name'    => '',
            'orderby'          => 'date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'post_type'        => 'post',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'       => '',
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true,
        );
    
        $atts = wp_parse_args( $args,$defaults );
    
        $posts = get_posts( $atts );
    
        return $posts;
    }

    function pt_get_excerpt_by_id_pro( $post_id, $excerpt_length ) {
        $the_post = get_post( $post_id );
    
        $the_excerpt = null;
        if ( $the_post ) {
            $the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
        }
    
        $the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) );
        $words = explode( ' ', $the_excerpt, $excerpt_length + 1 );
    
        if ( count( $words ) > $excerpt_length ) :
            array_pop( $words );
            $the_excerpt = implode( ' ', $words );
            $the_excerpt .= '...';
         endif;
    
         return $the_excerpt;
    }
}
