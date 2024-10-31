<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\PostGrid;

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



class Post_Grid extends Widget_Base
{



	use \Pt_Addons_Elementor\Includes\Triat\Helper;



	/**

	 * Define our get name settings.

	 */

	public function get_name()
	{

		return 'pt-post-grid';
	}

	/**

	 * Define our get title settings.

	 */

	public function get_title()
	{

		return __('Post Grid', 'elementor');
	}

	/**

	 * Define our get icon settings.

	 */

	public function get_icon()
	{

		return 'eicon-posts-grid';
	}

	/**

	 * Define our get categories settings.

	 */

	public function get_categories()
	{

		return ['pt-addons-elementor'];
	}

	/**

	 * Define our get script settings.

	 */

	public function get_script_depends()
	{

		return [

			'jquery',

			'masonry',

			'pt-pro-custom',

		];
	}

	/**

	 * Define our _register_controls settings.

	 */

	protected function _register_controls()
	{

		$this->start_controls_section(

			'pt_section_post_grid_filters',

			[

				'label' => __('Post Settings', 'elementor'),

			]

		);

		$this->add_control(

			'pt_post_type',

			[

				'label' => __('Post Type', 'elementor'),

				'type' => Controls_Manager::SELECT,

				'options' =>  $this->pt_get_post_types_pro(),

				'default' => 'post',

			]

		);

		$this->add_control(

			'pt_category',

			[

				'label' => __('Categories', 'elementor'),

				'type' => Controls_Manager::SELECT2,

				'label_block' => true,

				'multiple' => true,

				'options' =>  $this->pt_post_type_categories_pro(),

				'condition' => [

					'pt_post_type' => 'post',

				],

			]

		);

		$this->add_control(

			'num_posts',

			[

				'label' => __('Number of Posts', 'elementor'),

				'type' => Controls_Manager::NUMBER,

				'default' => '8',

			]

		);

		$this->add_control(

			'post_offset',

			[

				'label' => __('Post Offset', 'elementor'),

				'type' => Controls_Manager::NUMBER,

				'default' => '0',

			]

		);

		$this->add_control(

			'orderby',

			[

				'label' => __('Order By', 'elementor'),

				'type' => Controls_Manager::SELECT,

				'options' =>  $this->pt_get_post_orderby_options_pro(),

				'default' => 'date',

			]

		);

		$this->add_control(

			'order',

			[

				'label' => __('Order', 'elementor'),

				'type' => Controls_Manager::SELECT,

				'options' => [

					'asc' => 'Ascending',

					'desc' => 'Descending',

				],

				'default' => 'desc',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_section_post_custom_field',

			[

				'label' => __('Custom Fields', 'elementor'),

			]

		);

		$this->add_control(

			'pt_acf_title',

			[

				'label' => esc_html__('Post Title', 'elementor'),

				'type' => Controls_Manager::TEXT,

				'label_block' => true,

				'placeholder' => __('Please Enter ACF Key', 'plugin-domain')

			]

		);

		$this->add_control(

			'pt_acf_image',

			[

				'label' => esc_html__('Post Image', 'elementor'),

				'type' => Controls_Manager::TEXT,

				'label_block' => true,

				'placeholder' => __('Please Enter ACF Key', 'plugin-domain')

			]

		);

		$this->add_control(

			'pt_acf_desc',

			[

				'label' => esc_html__('Post Description', 'elementor'),

				'type' => Controls_Manager::TEXT,

				'label_block' => true,

				'placeholder' => __('Please Enter ACF Key', 'plugin-domain')

			]

		);



		$this->end_controls_section();

		$this->start_controls_section(

			'pt_section_post_grid_layout',

			[

				'label' => __('Layout Settings', 'elementor'),

			]

		);

		$this->add_control(

			'pt_post_grid_columns',

			[

				'label' => esc_html__('Number of Columns', 'elementor'),

				'type' => Controls_Manager::SELECT,

				'default' => 'pt-col-3',

				'options' => [

					'pt-col-1' => esc_html__('Single Column', 'elementor'),

					'pt-col-2' => esc_html__('Two Columns',   'elementor'),

					'pt-col-3' => esc_html__('Three Columns', 'elementor'),

					'pt-col-4' => esc_html__('Four Columns',  'elementor'),

					'pt-col-5' => esc_html__('Five Columns',  'elementor'),

					'pt-col-6' => esc_html__('Six Columns',   'elementor'),

				],

			]

		);

		$this->add_control(

			'pt_show_image',

			[

				'label' => __('Show Image', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'1' => [

						'title' => __('Yes', 'elementor'),

						'icon' => 'fa fa-check',

					],

					'0' => [

						'title' => __('No', 'elementor'),

						'icon' => 'eicon-ban',

					],

				],

				'default' => '1',

			]

		);

		$this->add_group_control(

			Group_Control_Image_Size::get_type(),

			[

				'name' => 'image',

				'exclude' => ['custom'],

				'default' => 'medium',

				'condition' => [

					'pt_show_image' => '1',

				],

			]

		);

		$this->add_control(

			'pt_show_title',

			[

				'label' => __('Show Title', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'1' => [

						'title' => __('Yes', 'elementor'),

						'icon' => 'fa fa-check',

					],

					'0' => [

						'title' => __('No', 'elementor'),

						'icon' => 'eicon-ban',

					],

				],

				'default' => '1',

			]

		);

		$this->add_control(

			'pt_show_excerpt',

			[

				'label' => __('Show excerpt', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'1' => [

						'title' => __('Yes', 'elementor'),

						'icon' => 'fa fa-check',

					],

					'0' => [

						'title' => __('No', 'elementor'),

						'icon' => 'eicon-ban',

					],

				],

				'default' => '1',

			]

		);

		$this->add_control(

			'pt_excerpt_length',

			[

				'label' => __('Excerpt Words', 'elementor'),

				'type' => Controls_Manager::NUMBER,

				'default' => '15',

				'condition' => [

					'pt_show_excerpt' => '1',

				],

			]

		);

		$this->add_control(

			'pt_show_meta',

			[

				'label' => __('Show Meta', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'1' => [

						'title' => __('Yes', 'elementor'),

						'icon' => 'fa fa-check',

					],

					'0' => [

						'title' => __('No', 'elementor'),

						'icon' => 'eicon-ban',

					],

				],

				'default' => '1',

			]

		);

		$this->add_control(

			'pt_post_grid_meta_position',

			[

				'label' => esc_html__('Meta Position', 'elementor'),

				'type' => Controls_Manager::SELECT,

				'default' => 'meta-entry-footer',

				'options' => [

					'meta-entry-header' => esc_html__('Below Title', 'elementor'),

					'meta-entry-footer' => esc_html__('Below Description', 'elementor'),

				],

				'condition' => [

					'pt_show_meta' => '1',

				],

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'thumbnail_animation',

			[

				'label' => __('Image Style', 'elementor'),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'hover_animation',

			[

				'label' => __('Thumbnail Animation', 'elementor'),

				'type' => Controls_Manager::HOVER_ANIMATION,

				'default' => 'shrink',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_section_post_grid_style',

			[

				'label' => __('Post Grid Style', 'elementor'),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name' => 'pt_post_grid_bg_color',

				'label' => __('Box Background', 'elementor'),

				'types' => ['classic', 'gradient'],

				'selector' => '{{WRAPPER}} .pt-grid-post-holder',

			]

		);

		$this->add_responsive_control(

			'pt_post_grid_spacing',

			[

				'label' => esc_html__('Spacing Between Items', 'elementor'),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%', 'em'],

				'selectors' => [

					'{{WRAPPER}} .pt-grid-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'pt_post_grid_border',

				'label' => esc_html__('Border', 'elementor'),

				'selector' => '{{WRAPPER}} .pt-grid-post-holder',

			]

		);

		$this->add_control(

			'pt_post_grid_border_radius',

			[

				'label' => esc_html__('Border Radius', 'elementor'),

				'type' => Controls_Manager::DIMENSIONS,

				'selectors' => [

					'{{WRAPPER}} .pt-grid-post-holder' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Box_Shadow::get_type(),

			[

				'name' => 'pt_post_grid_box_shadow',

				'selector' => '{{WRAPPER}} .pt-grid-post-holder',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_section_typography',

			[

				'label' => __('Color & Typography', 'elementor'),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'pt_post_grid_title_style',

			[

				'label' => __('Title Style', 'elementor'),

				'type' => Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);

		$this->add_control(

			'pt_post_grid_title_color',

			[

				'label' => __('Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt-entry-title, {{WRAPPER}} .pt-entry-title a' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'pt_post_grid_title_hover_color',

			[

				'label' => __('Hover Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'default' => '#23527c',

				'selectors' => [

					'{{WRAPPER}} .pt-entry-title:hover, {{WRAPPER}} .pt-entry-title a:hover' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_responsive_control(

			'pt_post_grid_title_alignment',

			[

				'label' => __('Title Alignment', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'left' => [

						'title' => __('Left', 'elementor'),

						'icon' => 'eicon-text-align-left',

					],

					'center' => [

						'title' => __('Center', 'elementor'),

						'icon' => 'eicon-text-align-center',

					],

					'right' => [

						'title' => __('Right', 'elementor'),

						'icon' => 'eicon-text-align-right',

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-entry-title' => 'text-align: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'pt_post_grid_title_typography',

				'label' => __('Typography', 'elementor'),

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-entry-title',

			]

		);

		$this->add_control(

			'pt_post_grid_excerpt_style',

			[

				'label' => __('Excerpt Style', 'elementor'),

				'type' => Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);

		$this->add_control(

			'pt_post_grid_excerpt_color',

			[

				'label' => __('Excerpt Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt-grid-post-excerpt p' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_responsive_control(

			'pt_post_grid_excerpt_alignment',

			[

				'label' => __('Excerpt Alignment', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'left' => [

						'title' => __('Left', 'elementor'),

						'icon' => 'eicon-text-align-left',

					],

					'center' => [

						'title' => __('Center', 'elementor'),

						'icon' => 'eicon-text-align-center',

					],

					'right' => [

						'title' => __('Right', 'elementor'),

						'icon' => 'eicon-text-align-right',

					],

					'justify' => [

						'title' => __('Justified', 'elementor'),

						'icon' => 'eicon-text-align-justify',

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-grid-post-excerpt p' => 'text-align: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'pt_post_grid_excerpt_typography',

				'label' => __('excerpt Typography', 'elementor'),

				'scheme' => Typography::TYPOGRAPHY_3,

				'selector' => '{{WRAPPER}} .pt-grid-post-excerpt p',

			]

		);

		$this->add_control(

			'pt_post_grid_meta_style',

			[

				'label' => __('Meta Style', 'elementor'),

				'type' => Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);

		$this->add_control(

			'pt_post_grid_meta_color',

			[

				'label' => __('Meta Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt-entry-meta, .pt-entry-meta a' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_responsive_control(

			'pt_post_grid_meta_alignment',

			[

				'label' => __('Meta Alignment', 'elementor'),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'flex-start' => [

						'title' => __('Left', 'elementor'),

						'icon' => 'eicon-text-align-left',

					],

					'center' => [

						'title' => __('Center', 'elementor'),

						'icon' => 'eicon-text-align-center',

					],

					'flex-end' => [

						'title' => __('Right', 'elementor'),

						'icon' => 'eicon-text-align-right',

					],

					'stretch' => [

						'title' => __('Justified', 'elementor'),

						'icon' => 'eicon-text-align-justify',

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-entry-footer' => 'justify-content: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'pt_post_grid_meta_typography',

				'label' => __('Meta Typography', 'elementor'),

				'scheme' => Typography::TYPOGRAPHY_3,

				'selector' => '{{WRAPPER}} .pt-entry-meta > div , .pt-entry-meta span',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'section-action-button-style',

			[

				'label' => __('Action Button', 'elementor'),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'pt_excerpt_readmore',

			[

				'label' => __('Button Text', 'elementor'),

				'type' => Controls_Manager::TEXT,

				'placeholder' => __('Read More', 'elementor'),

				'default' => __('Read More', 'elementor'),

			]

		);

		$this->add_control(

			'button_text_color',

			[

				'label' => __('Text Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'default' => '#FFF',

				'selectors' => [

					'{{WRAPPER}} .pt-post-grid-cta .pt-post-grid-link' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'typography',

				'label' => __('Typography', 'elementor'),

				'scheme' => Typography::TYPOGRAPHY_4,

				'selector' => '{{WRAPPER}} .pt-post-grid-cta .pt-post-grid-link',

			]

		);

		$this->add_control(

			'background_color',

			[

				'label' => __('Background Color', 'elementor'),

				'type' => Controls_Manager::COLOR,

				'scheme' => [

					'type' => Color::get_type(),

					'value' => Color::COLOR_4,

				],

				'default' => '#1e73be',

				'selectors' => [

					'{{WRAPPER}} .pt-entry-content .pt-post-grid-cta .pt-post-grid-link' => 'background-color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'border',

				'label' => __('Border', 'elementor'),

				'placeholder' => '1px',

				'default' => '1px',

				'selector' => '{{WRAPPER}} .pt-post-grid-cta .pt-post-grid-link',

			]

		);

		$this->add_control(

			'border_radius',

			[

				'label' => __('Border Radius', 'elementor'),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', '%'],

				'selectors' => [

					'{{WRAPPER}} .pt-post-grid-cta .pt-post-grid-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_control(

			'text_padding',

			[

				'label' => __('Text Padding', 'elementor'),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => ['px', 'em', '%'],

				'selectors' => [

					'{{WRAPPER}} .pt-post-grid-cta .pt-post-grid-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();
	}

	/**

	 * Render function declare

	 */

	protected function render()
	{

		$settings = $this->get_settings();

		$post_args =  $this->pt_get_post_settings_pro($settings);

		$posts =  $this->pt_get_post_data_pro($post_args);

		if (!empty($settings['hover_animation'])) {

			$this->add_render_attribute('imagehover', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}

?>

<div id="pt-post-grid-<?php echo esc_attr($this->get_id()); ?>" class="pt-post-grid <?php echo esc_attr($settings['pt_post_grid_columns']); ?>">

<div class="pt-post-grid">

	<?php
if (count($posts))
{

global $post;

foreach ($posts as $post)
{

setup_postdata($post);

?>

			<div class="pt-grid-post pt-post-grid-column">

				<div class="pt-grid-post-holder">

					<div class="pt-grid-post-holder-inner">

						<?php if ($thumbnail_exists = has_post_thumbnail()):

?>

							<div class="pt-entry-media">

								<div class="pt-entry-thumbnail">

									<!--<div class="pt-entry-overlay">

									<a href="<?php echo get_permalink(); ?>"></a>

									</div>-->

									<?php

if (1 == $settings['pt_show_image'])
{

	if ($settings['pt_acf_image'])
	{

		$img_acf = $settings['pt_acf_image'];

		$image_acf = get_field($img_acf);

?>



											<img src="<?php echo esc_url($image_acf['url']); ?>" <?php echo $this->get_render_attribute_string('imagehover'); ?>>

										<?php
	}

	else
	{ ?>

											<img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id() , $settings['image_size']); ?>" <?php echo $this->get_render_attribute_string('imagehover'); ?>>
								<?php
	}
}

?>
								</div>

							</div>

							<?php
endif; ?>

				<div class="pt-entry-wrapper">

					<header class="pt-entry-header">

						<?php if ($settings['pt_show_title'])
{

if ($settings['pt_acf_title'])
{

	$title_acf = $settings['pt_acf_title'];

?>

								<h2 class="pt-entry-title"><a class="pt-grid-post-link" href="" title="<?php the_field($title_acf); ?>"><?php the_field($title_acf); ?></a></h2>

							<?php
}
else
{ ?>



								<h2 class="pt-entry-title"><a class="pt-grid-post-link" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

						<?php
}
}

?>

						<?php if ($settings['pt_show_meta'] && 'meta-entry-header' === $settings['pt_post_grid_meta_position'])
{ ?>

							<div class="pt-entry-meta">

								<span class="pt-posted-by"><i class="fa fa-user" aria-hidden="true"></i><?php the_author_posts_link(); ?></span>

								<span class="pt-posted-on"><i class="fa fa-calendar"></i><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></span>

								<span class="pt-posted-use"><i class="fa fa-folder-open-o"></i><?php the_category(' , '); ?></span>

							</div>

						<?php
} ?>

					</header>



					<?php if ($settings['pt_show_excerpt'])
{

if ($settings['pt_acf_desc'])
{

	$desc_acf = $settings['pt_acf_desc'];

?>

							<div class="pt-entry-content">

								<div class="pt-grid-post-excerpt">

									<p><?php the_field($desc_acf); ?></p>

								</div>

							</div>



						<?php
}
else
{ ?>

							<div class="pt-entry-content">

								<div class="pt-grid-post-excerpt">

									<p><?php //echo esc_html($this->pt_get_excerpt_by_id_pro(get_the_ID() , $settings['pt_excerpt_length'])); 
									
									echo substr(get_the_excerpt(get_the_ID()),0,$settings['pt_excerpt_length']);
									?>
									</p>

								</div>

								<div class="pt-post-grid-cta">

									<a class="pt-post-grid-link" href="<?php echo get_permalink(); ?>">

										<?php echo $settings['pt_excerpt_readmore']; ?>

									</a>

								</div>

							</div>

					<?php
}
}

?>

				</div>

				<?php if ($settings['pt_show_meta'] && 'meta-entry-footer' === $settings['pt_post_grid_meta_position'])
{ ?>

					<div class="pt-entry-footer">

						<div class="pt-author-avatar">

							<a href="<?php echo get_author_posts_url(get_the_author_meta('ID') , get_the_author_meta('user_nicename')); ?>"><?php echo get_avatar(get_the_author_meta('ID') , 96); ?>
							</a>

						</div>

						<div class="pt-entry-meta">

							<div class="pt-posted-by"><?php the_author_posts_link(); ?></div>

							<div class="pt-posted-on"><time datetime="<?php echo get_the_date(); ?>"><?php echo get_the_date(); ?></time></div>

							<div class="pt-posted-use"><?php the_category(' , '); ?></div>

						</div>

					</div>

				<?php
}

?>

					</div>

				</div>

			</div>

	<?php
}

wp_reset_postdata();
}

?>

</div>

</div>


		<script>
			jQuery(window).load(function() {

				jQuery('.pt-post-grid').masonry({

					itemSelector: '.pt-grid-post',

					percentPosition: true,

					columnWidth: '.pt-post-grid-column'

				});

			});
		</script>

<?php

	}
}
