<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\AnimatedBooks;

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

use \Elementor\Core\Kits\Documents\Tabs\Global_Colors;

use \Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use \Elementor\Widget_Base as Widget_Base;

use \Pt_Addons_Elementor\Classes\Bootstrap;

class Animated_Books extends Widget_Base {

	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'pt-animated-books';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'Animated Books', 'elementor' );

	}

	/**

	 * Define our get_icon settings.

	 */

	public function get_icon() {

		return 'eicon-menu-card';

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

		 * Animated Book.

		 */

		$this->start_controls_section(

			'book_list_items',

			[

				'label' => esc_html__( 'Animated Books', 'elementor' ),

			]

		);

		$this->add_control(

			'pt_layout_type',

			[

				'label' => __( 'Select Style', 'elementor' ),

				'type' => Controls_Manager::SELECT,

				'default' => 'style1',

				'options' => [

					'style1' => __( 'Style 1', 'elementor' ),

					'style2' => __( 'Style 2', 'elementor' ),

				],

			]

		);

/** adding repeater as new code formet  */

$repeater = new \Elementor\Repeater();

$repeater->add_control(

	'pt_title', [

		'label' => esc_html__( 'Title', 'elementor' ),

		'type' => \Elementor\Controls_Manager::TEXT,

		'default' => esc_html__( 'Concepts in Biology' , 'elementor' ),

		'label_block' => true,

	]

);

$repeater->add_control(

	'pt_author', [

		'label' => esc_html__( 'Author', 'elementor' ),

		'type' => \Elementor\Controls_Manager::TEXT,

		'default' => esc_html__( 'Andrea' , 'elementor' ),

		'label_block' => true,

	]

);

$repeater->add_control(

	'pt_description', [

		'label' => esc_html__( 'Description', 'elementor' ),

		'type' => \Elementor\Controls_Manager::TEXTAREA,

		'default' => esc_html__( 'Default description' , 'elementor' ),

		'label_block' => true,

	]

);

$repeater->add_control(

	'pt_media_type',

	[

		'label' => esc_html__( 'Book Cover', 'elementor' ),

		'type' => \Elementor\Controls_Manager::SELECT,

		'default' => 'color',

		'options' => [

			'color' => __( 'Color', 'elementor' ),

			'image' => __( 'Image', 'elementor' ),

		],

	]

);		

		$repeater->add_control(

			'primary_color',

			[

				'label' => esc_html__( 'Book Color', 'elementor' ),

				'type' => \Elementor\Controls_Manager::COLOR,

				'default' => '#FC9292',

				'selectors' => [

					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',

					//'{{WRAPPER}} .hardcover_back ' => 'background-color: {{VALUE}} !important;',

				],

				'scheme' => [

					'type' => Color::get_type(),

					//'value' => Color::COLOR_1,

				],

				'condition' => [

					'pt_media_type' => [ 'color' ],
					

				],

			]

		);

// 		$repeater->add_control(

// 			'secondary_color',

// 			[

// 				'label' => esc_html__( 'Book Back Color', 'elementor' ),

// 				'type' => \Elementor\Controls_Manager::COLOR,

// 				'default' => '#16538c',

// 				'selectors' => [

// 					//'{{WRAPPER}} .hardcover_back' => 'background-color: {{VALUE}} !important;',
// 					'{{WRAPPER}} .hardcover_back' => 'background-color: {{VALUE}} !important;',
// 					//'{{WRAPPER}} .paperback_back' => 'background-color: {{VALUE}} !important;',

// 				],

// 				'scheme' => [

// 					'type' => Color::get_type(),

// 					//'value' => Color::COLOR_1,

// 				],

// 				'condition' => [

// 					'pt_media_type' => [ 'color' ],

// 				],

// 			]

// 		);



	// [

	// 	'name' => 'primary_color',

	// 	'label' => __( 'Book Color', 'elementor' ),

	// 	'type' => Controls_Manager::COLOR,

	// 	'default' => '#16538c',

	// 	'selectors' => [

	// 		'{{WRAPPER}} .hardcover_front li .coverDesign' => 'background-color: {{VALUE}};',

	// 		'{{WRAPPER}} .paperback_front li .coverDesign' => 'background-color: {{VALUE}};',

	// 	],

	// 	'scheme' => [

	// 		'type' => Color::get_type(),

	// 		'value' => Color::COLOR_1,

	// 	],

	// 	'condition' => [

	// 		'pt_media_type' => [ 'color' ],

	// 	],

	// ],





	$repeater->add_control(

		'pt_book_title', [

			'label' => esc_html__( 'Book Title', 'elementor' ),

			'type' => \Elementor\Controls_Manager::TEXT,

			'default' => esc_html__( 'HTML Course' , 'elementor' ),

			'condition' => [

				'pt_media_type' => [ 'color' ],

			],

			'label_block' => true,

		]

	);

	///********************************** */ Boook Sub title **///////

	$repeater->add_control(

		'pt_book_sub_title', [

			'label' => esc_html__( 'Book Sub Title', 'elementor' ),

			'type' => \Elementor\Controls_Manager::TEXT,

			'default' => esc_html__( 'Web Design' , 'elementor' ),

			'condition' => [

				'pt_media_type' => [ 'color' ],

			],

			

		]

	);



	$repeater->add_control(

		'front_image',

		[

			'label' => esc_html__( 'Front Cover Image', 'elementor' ),

			'type' => \Elementor\Controls_Manager::MEDIA,

			'default' => [

				'url' => \Elementor\Utils::get_placeholder_image_src(),

			],

			'condition' => [

				'pt_media_type' => [ 'image' ],

			],

		]

	);

	$repeater->add_control(

		'back_image',

		[

			'label' => esc_html__( 'Back Cover Image', 'elementor' ),

			'type' => \Elementor\Controls_Manager::MEDIA,

			'default' => [

				'url' => Utils::get_placeholder_image_src(),

			],

			'condition' => [

				'pt_media_type' => [ 'image' ],

			],

		]

	);

	$repeater->add_control(

		'pt_book_ribbon', [

			'label' => esc_html__( 'Book Ribbon', 'elementor' ),

			'type' => \Elementor\Controls_Manager::TEXT,

			'default' => esc_html__( 'New' , 'elementor' ),

			'label_block' => true,

		]

	);



	$repeater->add_control(

		'pt_book_link_title', [

			'label' => esc_html__( 'Book Link Title', 'elementor' ),

			'type' => \Elementor\Controls_Manager::TEXT,

			'default' => esc_html__( 'Download' , 'elementor' ),

			'label_block' => true,

		]

	);

	$repeater->add_control(

		'pt_book_link',

		[

			'label' => esc_html__( 'Book Link', 'elementor' ),

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

	

	

/** adding repeater as new code formet  */



		$this->add_control(

			'animated_book_list_section',

			[

				'label' => __( 'Animated Book', 'elementor' ),

				'type' => \Elementor\Controls_Manager::REPEATER,

				'fields' => $repeater->get_controls(),

				'default' => [

					[

						'pt_author' => 'John Fox',

					],

				],



				'title_field' => '{{pt_author}}',

			]

		);

		$this->end_controls_section();

		/**

		 * Title and Description Style Section.

		 */

		$this->start_controls_section(

			'section_title_style',

			[

				'label' => __( 'Book Title and Description', 'elementor' ),

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

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt_main_book_title' => 'color: {{VALUE}};',

				],

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

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt_description' => 'color: {{VALUE}};',

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

				'default' => '#000',

				'selectors' => [

					'{{WRAPPER}} .pt_main_book_title' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'typography',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt_main_book_title',

			]

		);

		$this->add_group_control(

			Group_Control_Text_Shadow::get_type(),

			[

				'name' => 'text_shadow',

				'selector' => '{{WRAPPER}} .pt_main_book_title',

			]

		);

		$this->end_controls_section();

		/**

		 * Author Style Section.

		 */

		$this->start_controls_section(

			'author_title_style',

			[

				'label' => __( 'Author Title', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'author_title_color',

			[

				'label' => __( 'Title Text Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'scheme' => [

					'type' => Color::get_type(),

					'value' => Color::COLOR_1,

				],

				'selectors' => [

					'{{WRAPPER}} .pt_author_title' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'author_typography',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt_author_title',

			]

		);

		$this->add_group_control(

			Group_Control_Text_Shadow::get_type(),

			[

				'name' => 'author_text_shadow',

				'selector' => '{{WRAPPER}} .pt_author_title',

			]

		);

		$this->end_controls_section();

	}

	/**

	 * Define our Content Display settings.

	 */

	// protected function render() {

	protected function render($instance = []){

		$settings = $this->get_settings();

		$pt_layout_type = ! empty( $settings['pt_layout_type'] ) ? $settings['pt_layout_type'] : '';

		$this->add_render_attribute( 'wrapper', 'class', 'info-list-image-wrapper' );

		$this->add_render_attribute( 'icon-wrapper', 'class', 'elementor-icon' );

		foreach ( $settings['animated_book_list_section'] as $item ) :

			$pt_title = ! empty( $item['pt_title'] ) ? $item['pt_title'] : '';

			$pt_author = ! empty( $item['pt_author'] ) ? $item['pt_author'] : '';

			$pt_description = ! empty( $item['pt_description'] ) ? $item['pt_description'] : '';

			$pt_book_color  = ! empty( $item['pt_book_color'] ) ? $item['pt_book_color'] : '';

			$pt_book_ribbon  = ! empty( $item['pt_book_ribbon'] ) ? $item['pt_book_ribbon'] : '';

			$pt_book_title  = ! empty( $item['pt_book_title'] ) ? $item['pt_book_title'] : '';

			$pt_book_sub_title  = ! empty( $item['pt_book_sub_title'] ) ? $item['pt_book_sub_title'] : '';

			$front_image  = ! empty( $item['front_image']['url'] ) ? $item['front_image']['url'] : '';

			$back_image  = ! empty( $item['back_image']['url'] ) ? $item['back_image']['url'] : '';

			$pt_book_link_title  = ! empty( $item['pt_book_link_title'] ) ? $item['pt_book_link_title'] : '';

			$pt_book_link  = ! empty( $item['pt_book_link']['url'] ) ? $item['pt_book_link']['url'] : '';

			$pt_media_type = ! empty( $item['pt_media_type'] ) ? $item['pt_media_type'] : '';

			/**

			 * Apply to link.

			 */

			if ( ! empty( $item['pt_link']['url'] ) ) {

				$this->add_render_attribute( 'url', 'href', $item['pt_link']['url'] );

				if ( $item['pt_link']['is_external'] ) {

					$this->add_render_attribute( 'url', 'target', '_blank' );

				}

				if ( ! empty( $item['pt_link']['nofollow'] ) ) {

					$this->add_render_attribute( 'url', 'rel', 'nofollow' );

				}

			}

			/**

			 * Image hover animatoin effect.

			 */

			if ( ! empty( $settings['image_hover_animation'] ) ) {

				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['image_hover_animation'] );

			}

		

						if ( 'style1' === $pt_layout_type ) {

						?>

						<div class="animation_book_item container">

			<div class="component">

				<ul class="align">

					<li>

							<figure class='book'>

							<ul class='hardcover_front'>

								<?php

								if ( 'image' === $pt_media_type ) {

								?>

								<li>

									<span class="ribbon"> <?php echo $pt_book_ribbon; ?></span>

									<img src="<?php echo $front_image; ?>" alt="" width="100%" height="100%">

								</li>

								<?php

								}

								if ( 'color' === $pt_media_type ) {

								?>

								<li>

									<div class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> coverDesign">

										<?php

										if ( '' != $pt_book_ribbon ) {

										?>

										<span class="ribbon"><?php echo $pt_book_ribbon; ?></span>

										<?php

										}

										?>

										<h1><?php echo $pt_book_title; ?></h1>

										<p><?php echo $pt_book_sub_title; ?></p>

									</div>

								</li>

								<?php

								}

								?>

								<li></li>

							</ul>

							<ul class='page'>

								<li></li>

								<li>

									<a class="btn" href="<?php echo $pt_book_link; ?>"><?php echo $pt_book_link_title; ?></a>

								</li>

								<li></li>

								<li></li>

								<li></li>

							</ul>

							<ul class='elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> hardcover_back '>

								<?php

								if ( 'image' === $pt_media_type ) {

								?>

								<li>

									<img src="<?php echo $back_image; ?>" alt="" width="100%" height="100%">

								</li>

								<?php

								}

								?>

								<li></li>

							</ul>

							<ul class='book_spine'>

								<li></li>

								<li></li>

							</ul>

							<figcaption>

								<h2 class="pt_main_book_title"><?php echo $pt_title; ?></h2>

								<span class="pt_author_title"><?php echo $pt_author; ?></span>

								<p class="pt_description"><?php echo $pt_description; ?></p>

							</figcaption>

						</figure>

						</li>

				</ul>

			</div>

		</div>

							<?php

}

if ( 'style2' === $pt_layout_type ) {

							?>

		<div class="animation_book_item container">

			<div class="component">

				<ul class="align">

					<li>

							<figure class='book2'>

							<ul class='paperback_front'>

								<?php

								if ( 'color' === $pt_media_type ) {

								?>

								<li>

									<div class="coverDesign elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">										

										<?php

										if ( '' != $pt_book_ribbon ) {

										?>

										<span class="ribbon"><?php echo $pt_book_ribbon; ?></span>

										<?php

										}

										?>

										<h1><?php echo $pt_book_title; ?></h1>

										<p><?php echo $pt_book_sub_title; ?></p>

									</div>

								</li>

								<?php

								}

								if ( 'image' === $pt_media_type ) {

								?>

								<li>

									<span class="ribbon"> <?php echo $pt_book_ribbon; ?></span>

									<img src="<?php echo $front_image; ?>" alt="" width="100%" height="100%">

								</li>

								<?php

								}

								?>

								<li></li>

							</ul>

							<ul class='ruled_paper'>

								<li></li>

								<li>

									<a class="btn" href="<?php echo $pt_book_link; ?>"><?php echo $pt_book_link_title; ?></a>

								</li>

								<li></li>

								<li></li>

								<li></li>

							</ul>

							<ul class='paperback_back'>

								<?php

								if ( 'image' === $pt_media_type ) {

								?>

								<li>

									<img src="<?php echo $back_image; ?>" alt="" width="100%" height="100%">

								</li>

								<?php

								}

								?>

								<li></li>

							</ul>

							<figcaption>

								<h2 class="pt_main_book_title"><?php echo $pt_title; ?></h2>

								<span class="pt_author_title"><?php echo $pt_author; ?></span>

								<p class="pt_description"><?php echo $pt_description; ?></p>

							</figcaption>

						</figure>

						</li>

				</ul>

			</div>

		</div>

							

							<?php

}

							

		endforeach;

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