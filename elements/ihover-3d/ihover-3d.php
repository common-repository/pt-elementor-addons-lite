<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\Ihover3d;
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
class Ihover_3d extends Widget_Base {
	/**
	 * Define our get_name settings.
	 */
	public function get_name() {
		return 'pt-i-hover-3d';
	}
	/**
	 * Define our get_title settings.
	 */
	public function get_title() {
		return __( '3D iHover', 'elementor' );
	}
	/**
	 * Define our get_icon settings.
	 */
	public function get_icon() {
		return 'eicon-parallax';
	}
	/**
	 * Define our get_categories settings.
	 */
	public function get_categories() {
		return [ 'pt-addons-elementor' ];
	}
	/**
	 * Define our get Script settings.
	 */
	/*public function get_script_depends() {
		return [
			'jquery',
			'anime-min',
			'3d-ihover-main',
			'pt-pro-custom',
		];
	} */
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
			'pt_layout',
			[
				'label' => __( 'Select Type', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'vega',
				'options' => [
					'vega' => __( 'Style 1', 'elementor' ),
					'castor' => __( 'Style 2', 'elementor' ),
					'hamal' => __( 'Style 3', 'elementor' ),
					'polaris' => __( 'Style 4', 'elementor' ),
					'alphard' => __( 'Style 5', 'elementor' ),
					'altair' => __( 'Style 6', 'elementor' ),
					'rigel' => __( 'Style 7', 'elementor' ),
					'canopus' => __( 'Style 8', 'elementor' ),
					'pollux' => __( 'Style 9', 'elementor' ),
					'deneb' => __( 'Style 10', 'elementor' ),
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
					'{{WRAPPER}} .pt-3d-ih-content .stack__figure img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Image Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-3d-ih-content .stack__figure img',
			]
		);
// 		$this->add_responsive_control(
// 			'image_border_radius',
// 			[
// 				'label' => __( 'Border Radius', 'elementor' ),
// 				'type' => Controls_Manager::DIMENSIONS,
// 				'size_units' => [ 'px', '%' ],
// 				'selectors' => [
// 					'{{WRAPPER}} .pt-3d-ih-content .stack__figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
// 				],
// 			]
// 		);
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
				'scheme' => [
					'type' => Color::get_type(),
					'value' => Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title-color,{{WRAPPER}} .title-color a' => 'color: {{VALUE}};',
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
	}
	/**
	 * Define our Content Display settings.
	 */
	protected function render() {
		$settings = $this->get_settings();
		$pt_layout = ! empty( $settings['pt_layout'] ) ? $settings['pt_layout'] : '';
		$pt_layout_type = ! empty( $settings['pt_layout_type'] ) ? $settings['pt_layout_type'] : '';
		$pt_title = ! empty( $settings['pt_title'] ) ? $settings['pt_title'] : '';
		$pt_description = ! empty( $settings['pt_description'] ) ? $settings['pt_description'] : '';
		$image = ! empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		$pt_title_align = ! empty( $settings['pt_title_align'] ) ? $settings['pt_title_align'] : '';
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
	
		<div class="pt-3d-ih-content grid grid--effect-<?php echo $pt_layout; ?>">
			<a href="#" class="grid__item grid__item--c1">
				<div class="stack">
					<div class="stack__deco"></div>
					<div class="stack__deco"></div>
					<div class="stack__deco"></div>
					<div class="stack__deco"></div>
					<div class="stack__figure">
						<img src="<?php echo $image; ?>" alt="Image" />
					</div>
				</div>
				<div class="grid__item-caption" >
					<div class ="column column--left column--right" style="text-align:<?php echo $pt_title_align; ?>">
						<div style="" class="pt-ih-heading-block">
							<div class="pt-title pt-ih-heading"><?php echo $title_html; ?></div>
						</div>
						<div class="pt-ih-description-block">
							<div class="pt-description pt-ih-description"><?php echo $pt_description; ?></div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<script>
		
			(function($) {
	
				var isElEditMode = false;
				var Widgetpt3dihoverHandler = function($) {
		
			[].slice.call(document.querySelectorAll('.grid--effect-vega > .grid__item')).forEach(function(stackEl) {				
				new VegaFx(stackEl);
			});
			try{
				[].slice.call(document.querySelectorAll('.grid--effect-castor > .grid__item')).forEach(function(stackEl) {
					if (typeof Object.keys(stackEl) !== 'undefined') {
	
						new CastorFx(stackEl);
					}
					
				});

			}catch(e){

			}
			
			[].slice.call(document.querySelectorAll('.grid--effect-hamal > .grid__item')).forEach(function(stackEl) {
				new HamalFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-polaris > .grid__item')).forEach(function(stackEl) {
				new PolarisFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-alphard > .grid__item')).forEach(function(stackEl) {
				new AlphardFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-altair > .grid__item')).forEach(function(stackEl) {
				new AltairFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-rigel > .grid__item')).forEach(function(stackEl) {
				new RigelFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-canopus > .grid__item')).forEach(function(stackEl) {
				new CanopusFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-pollux > .grid__item')).forEach(function(stackEl) {
				new PolluxFx(stackEl);
			});
			[].slice.call(document.querySelectorAll('.grid--effect-deneb > .grid__item')).forEach(function(stackEl) {
				new DenebFx(stackEl);
			});
			
				};
				
			$( window ).on( 'elementor/frontend/init', function () {

			if ( elementorFrontend.isEditMode() ) {
				isElEditMode = true;
			}

			

			elementorFrontend.hooks.addAction( 'frontend/element_ready/pt-i-hover-3d.default', Widgetpt3dihoverHandler );


			if( isElEditMode ) {

				elementor.channels.data.on( 'element:after:duplicate element:after:remove', function( e, arg ) {
					$( '.elementor-widget-pt-i-hover-3d' ).each( function() {
						Widgetpt3dihoverHandler( $( this ), $ );
					} );
				} );
			}

		});
				
				
}(jQuery));

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
?>
<style>
	.pt-3d-ih-content .grid__item {
    	width: 80%;
	}
	</style>