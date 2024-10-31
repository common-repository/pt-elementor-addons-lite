<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\CreativeLink;

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



class Creative_Link extends Widget_Base {

	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'pt-creative-link';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'Creative Link', 'elementor' );

	}

	/**

	 * Define our get_icon settings.

	 */

	public function get_icon() {

		return 'eicon-slider-full-screen';

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

		$this->start_controls_section(

			'section-action-link',

			[

				'label' => __( 'Link Button', 'elementor' ),

			]

		);

		$this->add_control(

			'link_text',

			[

				'label' => __( 'Link Text', 'elementor' ),

				'type' => Controls_Manager::TEXT,

				'placeholder' => __( 'Pt Elementor Addon', 'elementor' ),

				'default' => __( 'Pt Elementor Addon!', 'elementor' ),

			]

		);

		$this->add_responsive_control(

			'link_text_align',

			[

				'label' => __( 'Text Alignment', 'elementor' ),

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

					'{{WRAPPER}} .pt-creative-link' => 'text-align: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'link',

			[

				'label' => __( 'Link to', 'elementor' ),

				'type' => Controls_Manager::URL,

				'placeholder' => __( 'http://your-link.com', 'elementor' ),

			]

		);

		$this->add_control(

			'link_style',

			[

				'label' => __( 'Link Style', 'elementor' ),

				'type' => Controls_Manager::SELECT,

				'options' => [

					'style1' => __( 'Style 1', 'elementor' ),

					'style2' => __( 'Style 2', 'elementor' ),

					'style3' => __( 'Style 3', 'elementor' ),

					'style4' => __( 'Style 4', 'elementor' ),

					'style5' => __( 'Style 5', 'elementor' ),

					'style6' => __( 'Style 6', 'elementor' ),

					'style7' => __( 'Style 7', 'elementor' ),

					'style8' => __( 'Style 8', 'elementor' ),

					'style9' => __( 'Style 9', 'elementor' ),

					'style10' => __( 'Style 10', 'elementor' ),

					'style11' => __( 'Style 11', 'elementor' ),

					'style12' => __( 'Style 12', 'elementor' ),

					'style13' => __( 'Style 13', 'elementor' ),

					'style14' => __( 'Style 14', 'elementor' ),

					'style15' => __( 'Style 15', 'elementor' ),

					'style16' => __( 'Style 16', 'elementor' ),

					'style17' => __( 'Style 17', 'elementor' ),

				],

				'default' => 'style1',

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'link_text_typography',

				'label' => __( 'Link Typography', 'elementor' ),

				'scheme' => Typography::TYPOGRAPHY_4,

				'selector' => '{{WRAPPER}} .pt-creative-link .pt-text-link',

			]

		);

		$this->add_control(

			'link_text_color',

			[

				'label' => __( 'Link Text Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt-creative-link .pt-text-link, {{WRAPPER}} .pt-cl-style9 span a, {{WRAPPER}} .pt-cl-style11 a::before, {{WRAPPER}} .pt-cl-style15 span a, {{WRAPPER}} .pt-cl-style16 span a, {{WRAPPER}} .pt-cl-style17 a' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'link_text_hover_color',

			[

				'label' => __( 'Link Text Hover Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '#7a7a7a',

				'selectors' => [

					'{{WRAPPER}} .pt-creative-link .pt-text-link:hover, {{WRAPPER}} .pt-cl-style9 a::before, {{WRAPPER}} .pt-cl-style12 a::before, {{WRAPPER}} .pt-cl-style16 a span::before, {{WRAPPER}} .pt-cl-style17 a:hover, {{WRAPPER}} .pt-cl-style17 a:focus' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'link_text_bg_color',

			[

				'label' => __( 'Background Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style2 a span, {{WRAPPER}} .pt-cl-style9 a span, {{WRAPPER}} .pt-cl-style15 a span, {{WRAPPER}} .pt-cl-style15 a span::before, {{WRAPPER}} .pt-cl-style15 a:hover span, {{WRAPPER}} .pt-cl-style15 a:focus span, {{WRAPPER}} .pt-cl-style16 a span' => 'background: {{VALUE}};',

				],

				'condition' => [

					'link_style' => [ 'style2', 'style9', 'style15', 'style16' ],

				],

			]

		);

		$this->add_control(

			'link_text_bg_hover_color',

			[

				'label' => __( 'Background Hover Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style2 a:hover span, {{WRAPPER}} .pt-cl-style9 a::before, {{WRAPPER}} .pt-cl-style15 a:hover span::before, {{WRAPPER}} .pt-cl-style15 a:focus span::before, {{WRAPPER}} .pt-cl-style16 a span::before' => 'background: {{VALUE}};',

				],

				'condition' => [

					'link_style' => [ 'style2', 'style9', 'style15', 'style16' ],

				],

			]

		);

		$this->add_control(

			'link_text_border_height',

			[

				'label' => __( 'Border Height', 'elementor' ),

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

				'selectors' =>

				[

					'{{WRAPPER}} .pt-cl-style3 a::after, {{WRAPPER}} .pt-cl-style4 a::after, {{WRAPPER}} .pt-cl-style6 a::before, {{WRAPPER}} .pt-cl-style6 a::after, {{WRAPPER}} .pt-cl-style7 a::before, {{WRAPPER}} .pt-cl-style7 a::after, {{WRAPPER}} .pt-cl-style13 a::after, {{WRAPPER}} .pt-cl-style14 a::after, {{WRAPPER}} .pt-cl-style14 a::before, {{WRAPPER}} .pt-cl-style17 a::before, {{WRAPPER}} .pt-cl-style17 a::after' => 'height: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .pt-creative-link.pt-cl-style6 a:after' => 'width: {{SIZE}}{{UNIT}};',

				],

				'condition' => [

					'link_style' => [ 'style3', 'style4', 'style6', 'style7', 'style13', 'style14', 'style17' ],

				],

			]

		);

		$this->add_control(

			'link_text_bg_border_style_color',

			[

				'label' => __( 'Border Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '#000000',

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style3 a::after, {{WRAPPER}} .pt-cl-style4 a::after, {{WRAPPER}} .pt-cl-style6 a::before, {{WRAPPER}} .pt-cl-style6 a::after, {{WRAPPER}} .pt-cl-style7 a::before, {{WRAPPER}} .pt-cl-style7 a::after, {{WRAPPER}} .pt-cl-style13 a::after, {{WRAPPER}} .pt-cl-style14 a::after, {{WRAPPER}} .pt-cl-style14 a::before, {{WRAPPER}} .pt-cl-style17 a::before, {{WRAPPER}} .pt-cl-style17 a::after' => 'background: {{VALUE}};',

				],

				'condition' => [

					'link_style' => [ 'style3', 'style4', 'style6', 'style7', 'style13', 'style14', 'style17' ],

				],

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'border',

				'label' => __( 'Border Style', 'elementor' ),

				'placeholder' => '1px',

				'default' => '1px',

				'selector' =>

					'{{WRAPPER}} .pt-cl-style8 a::before,

					{{WRAPPER}} .pt-cl-style8 a::after,

					{{WRAPPER}} .pt-cl-style10 a::before,

					{{WRAPPER}} .pt-cl-style10 a::after',

				'condition' => [

					'link_style' => [ 'style8', 'style10' ],

				],

			]

		);

		$this->add_control(

			'button_hover_border_color',

			[

				'label' => __( 'Border Hover Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'condition' => [

					'link_style' => 'style8',

				],

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style8 a::after' => 'border-color: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'link_text_box_width',

			[

				'label' => __( 'Box Width', 'elementor' ),

				'type' => Controls_Manager::SLIDER,

				'default' => [

					'size' => 200,

				],

				'range' => [

					'px' => [

						'min' => 200,

						'max' => 800,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style15, {{WRAPPER}} .pt-cl-style15 a span' => 'width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .pt-cl-style15 a span' => '-webkit-transform-origin : 50% 50% -{{SIZE}}/2 {{UNIT}};',

					'{{WRAPPER}} .pt-cl-style15 a span' => '-moz-transform-origin : 50% 50% -{{SIZE}}/2 {{UNIT}};',

					'{{WRAPPER}} .pt-cl-style15 a span' => 'transform-origin: 50% 50% -{{SIZE}}/2 {{UNIT}};',

				],

				'condition' => [

					'link_style' => [ 'style15' ],

				],

			]

		);

		$this->add_control(

			'box_shadow_border_color',

			[

				'label' => __( 'Box Shadow Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '#000000',

				'condition' => [

					'link_style' => 'style16',

				],

				'selectors' => [

					'{{WRAPPER}} .pt-cl-style16 a span' => 'box-shadow: inset 0 3px {{VALUE}};',

				],

			]

		);

		$this->end_controls_section();

	}

	/**

	 * Define our Render settings.

	 */

	protected function render() {

		$settings = $this->get_settings();

		$this->add_render_attribute( 'textlink', 'class', 'pt-text-link' );

		if ( ! empty( $settings['link']['url'] ) ) {

			$this->add_render_attribute( 'textlink', 'href', $settings['link']['url'] );

			if ( ! empty( $settings['link']['is_external'] ) ) {

				$this->add_render_attribute( 'textlink', 'target', '_blank' );

			}

		}

		?>

		<div class="pt-module-content pt-cl-wrap pt-link">

			<div class="pt-creative-link pt-cl-<?php echo $settings['link_style']; ?>">

				<?php

				if ( ! empty( $settings['link_text'] ) ) {

				?>

					<a <?php echo $this->get_render_attribute_string( 'textlink' ); ?> data-hover="<?php echo $settings['link_text']; ?>">

		<?php if ( 'style2' === $settings['link_style'] || 'style5' === $settings['link_style'] || 'style9' === $settings['link_style'] || 'style10' === $settings['link_style'] || 'style14' === $settings['link_style'] || 'style15' === $settings['link_style'] || 'style16' === $settings['link_style'] ) : ?>

			<span data-hover="<?php echo $settings['link_text']; ?>"><?php echo $settings['link_text']; ?></span> 

			<?php endif; ?>

			<?php if ( 'style1' === $settings['link_style'] || 'style3' === $settings['link_style'] || 'style4' === $settings['link_style'] || 'style6' === $settings['link_style'] || 'style7' === $settings['link_style'] || 'style8' === $settings['link_style'] || 'style11' === $settings['link_style'] || 'style12' === $settings['link_style'] || 'style13' === $settings['link_style'] || 'style17' === $settings['link_style'] ) : ?>

				<?php echo $settings['link_text']; ?>

			<?php endif; ?>

					</a>

			<?php } ?>

			</div>

		</div>

		<?php

	}

	/**

	 * Define our Content Display settings.

	 */

	

}
?>
<style>
	.pt-module-content.pt-link {
		display: block;
	}
</style>