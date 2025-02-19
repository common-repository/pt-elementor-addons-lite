<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\Ihover;

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

class Ihover extends Widget_Base {

	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'pt-i-hover';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'iHover', 'elementor' );

	}

	/**

	 * Define our get_icon settings.

	 */

	public function get_icon() {

		return 'eicon-alert';

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

		 * Image Section.

		 */

		$this->start_controls_section(

			'iHover_section',

			[

				'label' => esc_html__( 'Image', 'elementor' ),

			]

		);

		$this->add_control(

			'pt_layout_type',

			[

				'label' => __( 'Select Style', 'elementor' ),

				'type' => Controls_Manager::SELECT,

				'default' => '1',

				'options' => [

					'1' => __( 'Style 1', 'elementor' ),

					'2' => __( 'Style 2', 'elementor' ),

					'3' => __( 'Style 3', 'elementor' ),

					'4' => __( 'Style 4', 'elementor' ),

					'5' => __( 'Style 5', 'elementor' ),

					'6' => __( 'Style 6', 'elementor' ),

					'7' => __( 'Style 7', 'elementor' ),

					'8' => __( 'Style 8', 'elementor' ),

					'9' => __( 'Style 9', 'elementor' ),

					'10' => __( 'Style 10', 'elementor' ),

					'11' => __( 'Style 11', 'elementor' ),

					'12' => __( 'Style 12', 'elementor' ),

					'13' => __( 'Style 13', 'elementor' ),

					'14' => __( 'Style 14', 'elementor' ),

					'15' => __( 'Style 15', 'elementor' ),

					'16' => __( 'Style 16', 'elementor' ),

					'17' => __( 'Style 17', 'elementor' ),

					'18' => __( 'Style 18', 'elementor' ),

					'19' => __( 'Style 19', 'elementor' ),

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

			]

		);

	// $this->add_control(
	// 			'ihover_image_size',
	// 			[
	// 				'label' => esc_html__( 'Image Dimension', 'elementor' ),
	// 				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
	// 				'description' => esc_html__( 'Here You can Set You Image size like - "100%","100px","100vh" etc. ', 'elementor' ),
	// 				'default' => [
	// 					'width' => '100%',
	// 					'height' => '100%',
	// 				],
	// 			]
	// 		);


			$this->add_control(
				'Ihover_img_width',
				[
					'label' => esc_html__( 'Width', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 100,
					],
					'selectors' => [
						'{{WRAPPER}} .pt-ihover-section .ihover-box-image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'Ihover_img_height',
				[
					'label' => esc_html__( 'Height', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 500,
					],
					'selectors' => [
						'{{WRAPPER}} .pt-ihover-section .ihover-box-image-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		/**

		 * Title, Description and Image Section.

		 */

		$this->start_controls_section(

			'title_description_section',

			[

				'label' => esc_html__( 'Title and Description', 'elementor' ),

			]

		);

		$this->add_responsive_control(

			'Box_align',

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

				'selectors' => [

					'{{WRAPPER}} .pt-ih-content' => 'text-align: {{VALUE}};',

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

			'pt_description',

			[

				'label'   => __( 'Description', 'your-plugin' ),

				'type'    => Controls_Manager::WYSIWYG,

				'default' => __( 'Default description', 'elementor' ),

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

					'{{WRAPPER}} .pt-ihover-section .ihover-box-image-wrapper img' => 'opacity: {{SIZE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'image_border',

				'label' => __( 'Image Border', 'elementor' ),

				'selector' => '{{WRAPPER}} .pt-ihover-section .ihover-box-image-wrapper img',

			]

		);

		$this->add_responsive_control(

			'image_border_radius',

			[

				'label' => __( 'Border Radius', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-ihover-section .ihover-box-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();

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

			'content_color',

			[

				'label' => __( 'Content Text Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '#757171',

				'scheme' => [

					'type' => Color::get_type(),

					'value' => Color::COLOR_1,

				],

				'selectors' => [

					'{{WRAPPER}} .pt-description' => 'color: {{VALUE}};',

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

				'name' => 'typography_description',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-description',

			]

		);

		$this->add_group_control(

			Group_Control_Text_Shadow::get_type(),

			[

				'name' => 'text_shadow_description',

				'selector' => '{{WRAPPER}} .pt-description',

			]

		);

		$this->end_controls_section();

		/**

		 * Background Style

		 */

		$this->start_controls_section(

			'background_style',

			[

				'label' => __( 'Content Background', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name' => 'box_background',

				'selector' => '{{WRAPPER}} .pt-ih-info-back',

			]

		);

		$this->end_controls_tab();

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

		 * Image.

		 */

		$this->add_render_attribute( 'wrapper', 'class', 'ihover-box-image-wrapper' );

		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

		/**

		 * Image hover animatoin effect.

		 */

		if ( ! empty( $settings['hover_animation'] ) ) {

			$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );

		}

		?>

		<div class="pt-ihover-section">

			<div class="pt-ih-list-item">

				<?php

				if ( '6' === $pt_layout_type ) {

				?>

					<div class="pt-ih-item pt-ih-effect<?php echo $pt_layout_type; ?> pt-ih-scale_up pt-ih-square">

				<?php

				} elseif ( '8' === $pt_layout_type || '18' === $pt_layout_type ) {

				?>

					<div class="pt-ih-item pt-ih-effect<?php echo $pt_layout_type; ?> pt-ih-right_to_left pt-ih-square">

				<?php

				} elseif ( '16' === $pt_layout_type ) {

				?>

					<div class="pt-ih-item pt-ih-effect<?php echo $pt_layout_type; ?> pt-ih-left_to_right pt-ih-square">

				<?php

				} else {

				?>

					<div class="pt-ih-item pt-ih-effect<?php echo $pt_layout_type; ?> pt-ih-top_to_bottom pt-ih-square">

				<?php

				}

				?>

					<div class="pt-ih-image-block">

						<div class="pt-ih-wrapper"></div>					

						<div class="pt-image pt-ih-image" style="height:auto;width:100%;">

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

							<a>

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

					</div>

					<?php

					if ( '8' === $pt_layout_type ) {

					?>

					<div class="pt-info-container">

						<div class="pt-ih-info">

							<div class="pt-ih-info-back">

								<div class="pt-ih-content pt-ih-hover-content-<?php echo $settings['Box_align']; ?>">

									<div style="" class="pt-ih-heading-block">

										<div class="pt-title pt-ih-heading"><?php echo $title_html; ?></div>

									</div>

									<div class="pt-ih-divider-block">

										<span class="pt-ih-line"></span>

									</div>

									<div class="pt-ih-description-block">										

										<div class="pt-description pt-ih-description pt-text-editor"><p><?php echo $pt_description; ?></p></div>

									</div>

								</div>

							</div>

						</div>

					</div>

					<?php

					} else {

					?>

					<div class="pt-ih-info">

						<div class="pt-ih-info-back">

							<div class="pt-ih-content pt-ih-hover-content-<?php echo $settings['Box_align']; ?>">

								<div style="" class="pt-ih-heading-block">									

									<div class="pt-title pt-ih-heading"><?php echo $title_html; ?></div>

								</div>

								<div class="pt-ih-divider-block">

									<span class="pt-ih-line"></span>

								</div>

								<div class="pt-ih-description-block">									

									<div class="pt-description pt-ih-description pt-text-editor"><?php echo $pt_description; ?></div>

								</div>

							</div>

						</div>

					</div>

					<?php

					}

					?>

				</div>

			</div>

		</div>

		

		<script>

		jQuery( document ).ready(function() {			

		   jQuery('.pt-ih-item').hover(function(event){

			//event.stopPropagation();

				jQuery(this).addClass('pt-ih-hover');

			},function(event){

				event.stopPropagation();

				jQuery(this).removeClass('pt-ih-hover');

			});

		});

		</script>

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