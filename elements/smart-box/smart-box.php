<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\SmartBox;

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



class Smart_Box extends Widget_Base {

	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'pt-smart-box';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'Smart Box', 'elementor' );

	}

	/**

	 * Define our get_icon settings.

	 */

	public function get_icon() {

		return 'eicon-thumbnails-right';

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

			'smart_box_section',

			[

				'label' => esc_html__( 'Smart Box', 'elementor' ),

			]

		);

		$this->add_control(

			'pt_layout_type',

			[

				'label' => __( 'Smartbox Style', 'elementor' ),

				'type' => Controls_Manager::SELECT,

				'default' => 'default',

				'options' => [

					'default' => __( 'Default', 'elementor' ),

					'style1' => __( 'Style 1', 'elementor' ),

					'style2' => __( 'Style 2', 'elementor' ),

					'style3' => __( 'Style 3', 'elementor' ),

					'style4' => __( 'Style 4', 'elementor' ),

					'style5' => __( 'Style 5', 'elementor' ),

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

		$this->add_responsive_control(

			'title_align',

			[

				'label' => __( 'Title Alignment', 'elementor' ),

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

					'{{WRAPPER}} .heading-title' => 'text-align: {{VALUE}};',

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

				'condition' => [

					'pt_layout_type!' => [ 'default' ],

				],

			]

		);

		$this->add_control(

			'front_image_size',

			[

				'label' => __( 'Image Size', 'elementor' ),

				'type' => Controls_Manager::SLIDER,

				'default' => [

					'size' => 150,

					'unit' => 'px',

				],

				'range' => [

					'px' => [

						'min' => 50,

						'max' => 700,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-smart-box-section .smart-box-image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',

				],

				'condition' => [

					'pt_layout_type!' => [ 'default' ],

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

					'pt_layout_type!' => [ 'default' ],

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

					'pt_layout_type!' => [ 'default' ],

				],

				'show_label' => false,

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

		$this->add_responsive_control(

			'content_align',

			[

				'label' => __( 'Content Alignment', 'elementor' ),

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

					'{{WRAPPER}} .pt-smart-box-section' => 'text-align: {{VALUE}};',

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

				'label' => __( 'Title', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'title_color',

			[

				'label' => __( 'Title Text Color', 'elementor' ),

				'default' => '#757171',

				'type' => Controls_Manager::COLOR,

				'scheme' => [

					'type' => Color::get_type(),

					'value' => Color::COLOR_1,

				],

				'selectors' => [

					'{{WRAPPER}} .title-color' => 'color: {{VALUE}};',
					'{{WRAPPER}} .title-color a' => 'color: {{VALUE}};',
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

				'default' => '#757171',

				'type' => Controls_Manager::COLOR,

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

				'name' => 'typographydescription',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-description',

			]

		);



		$this->add_group_control(

			Group_Control_Text_Shadow::get_type(),

			[

				'name' => 'text_shadow_desc',

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

				'condition' => [

					'pt_layout_type!' => [ 'default' ],

				],

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

					'{{WRAPPER}} .pt-smart-box-section .smart-box-image-wrapper img' => 'opacity: {{SIZE}};',

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

				'selector' => '{{WRAPPER}} .pt-smart-box-section .smart-box-image-wrapper img',

			]

		);

		$this->add_responsive_control(

			'image_border_radius',

			[

				'label' => __( 'Border Radius', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-smart-box-section .smart-box-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();

		/**

		 * Background Style

		 */

		$this->start_controls_section(

			'background_style',

			[

				'label' => __( 'Background', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->start_controls_tabs( 'tabs_background' );

		$this->start_controls_tab(

			'text_background_normal',

			[

				'label' => __( 'Normal', 'elementor' ),

			]

		);

		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name' => 'text_background',

				'selector' => '{{WRAPPER}} .pt-smart-box-section',

			]

		);

		$this->end_controls_tab();

		$this->start_controls_tab(

			'text_background_hover_tab',

			[

				'label' => __( 'Hover', 'elementor' ),

			]

		);

		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name' => 'text_background_hover',

				'selector' => '{{WRAPPER}}:hover .pt-smart-box-section',

			]

		);

		$this->add_control(

			'text_background_hover_transition',

			[

				'label' => __( 'Transition Duration', 'elementor' ),

				'type' => Controls_Manager::SLIDER,

				'default' => [

					'size' => 0.3,

				],

				'range' => [

					'px' => [

						'max' => 3,

						'step' => 0.1,

					],

				],

				'render_type' => 'ui',

			]

		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**

		 * Box Shadow Style

		 */

		$this->start_controls_section(

			'box_shadow_section',

			[

				'label' => __( 'Box Shadow', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name' => 'box_shadow',

				'selector' => '{{WRAPPER}} .pt-smart-box-section',

			]

		);

		$this->add_responsive_control(

			'box_radius',

			[

				'label' => __( 'Box Radius', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-smart-box-section' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

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

		$this->add_render_attribute( 'wrapper', 'class', 'smart-box-image-wrapper' );

		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

		/**

		 * Image hover animatoin effect.

		 */

		if ( ! empty( $settings['hover_animation'] ) ) {

			$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );

		}

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

		<div class="pt-smart-box-section pt-smart-box-<?php echo $pt_layout_type; ?> to-center" style="text-align:<?php echo $pt_title_align; ?>">

			<div class="smart-box-detail-<?php echo $pt_layout_type; ?>">

				<?php

				if ( 'default' === $pt_layout_type || 'style3' === $pt_layout_type ) {

				?>

					<div class="pt-title"><?php echo $title_html; ?></div>

					<?php

					if ( 'style3' === $pt_layout_type ) {

					?>

					<div class="pt-image">						

						<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

							<?php

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

							?>

						</div>

					</div>

					<?php

					}

					?>

					<div class="pt-description"><?php echo $pt_description; ?></div>

				<?php

				} elseif ( 'style1' === $pt_layout_type || 'style2' === $pt_layout_type ) {

				?>

				<div class="smart-box-detail-<?php echo $pt_layout_type; ?>">

					<div class="pt-title"><?php echo $title_html; ?></div>					

					<div class="pt-image">						

						<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

							<?php							

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

							?>

						</div>

					</div>

					<div class="pt-description"><?php echo $pt_description; ?></div>

				</div>

				<?php }elseif ( 'style4' === $pt_layout_type  ){ ?>

					<div class="style4">

							<div class="style4-text4">

								<div class="pt-title"><?php echo $title_html; ?></div>			

								<div class="pt-description"><?php echo $pt_description; ?></div>

							</div>



							<div class="_style4">

								<div class="pt-image">

									<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

										<?php if ( $link ) : ?>

											<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>

												<?php endif;

													echo Group_Control_Image_Size::get_attachment_image_html( $settings );

												if ( $link ) : ?>

											</a>

										<?php endif; ?>

									</div>

								</div>

							</div>

					</div>

				<?php }elseif ( 'style5' === $pt_layout_type  ){ ?>

					<div class="style5">

							<div class="style5-text5">

								<div class="pt-title"><?php echo $title_html; ?></div>			

								<div class="pt-description"><?php echo $pt_description; ?></div>

							</div>



							<div class="_style5">

								<div class="pt-image">

									<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

										<?php if ( $link ) : ?>

											<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>

												<?php endif;

													echo Group_Control_Image_Size::get_attachment_image_html( $settings );

												if ( $link ) : ?>

											</a>

										<?php endif; ?>

									</div>

								</div>

							</div>

					</div>

				<?php }  ?>



				

			

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





