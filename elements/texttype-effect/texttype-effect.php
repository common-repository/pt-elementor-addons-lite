<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\TexttypeEffect;

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



class Texttype_Effect extends Widget_Base {



	use \Pt_Addons_Elementor\Includes\Triat\Helper;

	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'Pt-advance-animated-headline';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'Advance Animated Headline effect', 'elementor' );

	}

	/**

	 * Define our get_icon settings.

	 */

	public function get_icon() {

		return 'eicon-text-field';

	}

	/**

	 * Define our get Script settings.

	 */

	public function get_script_depends() {

		return [

			'jquery',

			'texttype-effect',

			'pt-pro-custom',

		];

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

    public function get_style_depends() {



		wp_register_style( 'widget-styleTyping','https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css');

		//wp_register_script( 'widget-script-2', PT_PLUGIN_URL. 'assets/front-end/js/count-down/index.js');

	



		return [

			'widget-styleTyping'

		];



	}









	protected function _register_controls() {

		$this->start_controls_section(

			'pt_texttype_effect_content',

			[

				'label' => esc_html__( 'Texttype Effect', 'elementor' ),

			]

		);

		$this->add_control(

			'pt_texttype_effect_prefix',

			[

				'label' => esc_html__( 'Prefix Text', 'elementor' ),

				'placeholder' => esc_html__( 'Place your prefix text', 'elementor' ),

				'type' => Controls_Manager::TEXTAREA,

				'default' => esc_html__( 'This is the ', 'elementor' ),

			]

		);



		$repeater = new \Elementor\Repeater();



		$repeater->add_control(

			'pt_texttype_effect_strings_text_field', [

				'label' => esc_html__( 'Texttype Effect String', 'elementor' ),

				'type' => \Elementor\Controls_Manager::TEXT,

				'label_block' => true,

			]

		);



	$this->add_control(

			'pt_texttype_effect_strings',

			[

				'label' => esc_html__( 'Texttype Effect Strings', 'elementor' ),

				'type' => \Elementor\Controls_Manager::REPEATER,

				'fields' => $repeater->get_controls(),

				'default' => [

					[

						'pt_texttype_effect_strings_text_field' => esc_html__( 'first string', 'elementor' ),

					],

					[

						'pt_texttype_effect_strings_text_field' => esc_html__( 'second string', 'elementor' ),

					],

					[

						'pt_texttype_effect_strings_text_field' => esc_html__( 'third string', 'elementor' ),

					],

				],

				

				'title_field' => '{{{ pt_texttype_effect_strings_text_field }}}',

			]

		);

		$this->add_control(

			'pt_texttype_effect_suffix',

			[

				'label' => esc_html__( 'Suffix Text', 'elementor' ),

				'placeholder' => esc_html__( 'Place your suffix text', 'elementor' ),

				'type' => Controls_Manager::TEXTAREA,

				'default' => esc_html__( ' of the sentence.', 'elementor' ),

			]

		);

		

		$this->end_controls_section();







		$this->start_controls_section(

			'pt_texttype_effect_settings',

			[

				'label' => esc_html__( 'Texttype Effect Settings', 'elementor' ),

			]

		);

		// $this->add_responsive_control(

		// 	'pt_texttype_effect_alignment',

		// 	[

		// 		'label' => esc_html__( 'Alignment', 'elementor' ),

		// 		'type' => Controls_Manager::CHOOSE,

		// 		'options' => [

		// 			'left' => [

		// 				'title' => esc_html__( 'Left', 'elementor' ),

		// 				'icon' => 'eicon-text-align-left',

		// 			],

		// 			'center' => [

		// 				'title' => esc_html__( 'Center', 'elementor' ),

		// 				'icon' => 'eicon-text-align-center',

		// 			],

		// 			'right' => [

		// 				'title' => esc_html__( 'Right', 'elementor' ),

		// 				'icon' => 'eicon-text-align-right',

		// 			],

		// 		],

		// 		'default' => 'center',

		// 		'selectors' => [

		// 			'{{WRAPPER}} .pt-texttype-effect-container' => 'text-align: {{VALUE}}',

		// 		],

		// 	]

		// );

		$this->add_control(

			'pt_texttype_effect_transition_type',

			[

				'label' => esc_html__( 'Animation Type', 'elementor' ),

				'type' => Controls_Manager::SELECT,

				'default' => 'typing',

				'options' => [

					'typing' => esc_html__( 'Typing', 'elementor' ),

					'fadeIn' => esc_html__( 'Fade', 'elementor' ),

					'fadeInUp' => esc_html__( 'Fade Up', 'elementor' ),

					'fadeInDown' => esc_html__( 'Fade Down', 'elementor' ),

					'fadeInLeft' => esc_html__( 'Fade Left', 'elementor' ),

					'fadeInRight' => esc_html__( 'Fade Right', 'elementor' ),

					'rotateInDownLeft' => esc_html__( 'rotateInDownLeft', 'elementor' ),

					'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'elementor' ),

					'zoomIn' => esc_html__( 'Zoom', 'elementor' ),

					'bounceIn' => esc_html__( 'Bounce', 'elementor' ),

					'swing' => esc_html__( 'Swing', 'elementor' ),

					'rollIn' => esc_html__( 'rollIn', 'elementor' ),

					'rotateIn' => esc_html__( 'rotateIn', 'elementor' ),

					'flipInX' => esc_html__( 'flipInX', 'elementor' ),

					'flipInY' => esc_html__( 'flipInY', 'elementor' ),

					

				],

			]

		);

		$this->add_control(

			'pt_texttype_effect_speed',

			[

				'label' => esc_html__( 'Typing Speed', 'elementor' ),

				'type' => Controls_Manager::NUMBER,

				'default' => '50',

				'condition' => [

					'pt_texttype_effect_transition_type' => 'typing',

				],

			]

		);

		$this->add_control(

			'pt_texttype_effect_delay',

			[

				'label' => esc_html__( 'Delay on Change', 'elementor' ),

				'type' => Controls_Manager::NUMBER,

				'default' => '2500',

			]

		);

		$this->add_control(

			'pt_texttype_effect_loop',

			[

				'label' => esc_html__( 'Loop the Typing', 'elementor' ),

				'type' => Controls_Manager::SWITCHER,

				'return_value' => 'yes',

				'default' => 'yes',

				'condition' => [

					'pt_texttype_effect_transition_type' => 'typing',

				],

			]

		);

		$this->add_control(

			'pt_texttype_effect_cursor',

			[

				'label' => esc_html__( 'Display Type Cursor', 'elementor' ),

				'type' => Controls_Manager::SWITCHER,

				'return_value' => 'yes',

				'default' => 'yes',

				'condition' => [

					'pt_texttype_effect_transition_type' => 'typing',

				],

			]

		);

		$this->end_controls_section();



		

		$this->start_controls_section(

			'pt_general_styles',

			[

				'label' => esc_html__( 'General Styles', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_responsive_control(

			'pt_texttype_effect_align',

			[

				'label' => __( 'Alignment', 'elementor' ),

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

					'{{WRAPPER}} .pt-texttype-effect-container' => 'text-align: {{VALUE}};',

				],

				

			]

		);

		$this->add_control(

			'pt_texttype_effect_align_tag',

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

					'span' => __( 'Span', 'elementor' ),	

				],

				'default' => 'span',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_texttype_effect_prefix_styles',

			[

				'label' => esc_html__( 'Prefix Text Styles', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'pt_texttype_effect_prefix_color',

			[

				'label' => esc_html__( 'Prefix Text Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-prefix' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'typography',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-texttype-effect-prefix',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_texttype_effect_strings_styles',

			[

				'label' => esc_html__( 'Texttype Effect Styles', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'pt_texttype_effect_strings_color',

			[

				'label' => esc_html__( 'Texttype Effect Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-strings' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'pt_texttype_effect_strings_typography',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-texttype-effect-strings, {{WRAPPER}} .typed-cursor',

			]

		);

		$this->add_control(

			'pt_texttype_effect_strings_background_color',

			[

				'label' => esc_html__( 'Background', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-strings' => 'background: {{VALUE}};',

				],

			]

		);

		$this->add_control(

			'pt_texttype_effect_cursor_color',

			[

				'label' => esc_html__( 'Typing Cursor Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .typed-cursor' => 'color: {{VALUE}};',

				],

				'condition' => [

					'pt_texttype_effect_cursor' => 'yes',

				],

			]

		);

		$this->add_responsive_control(

			'pt_texttype_effect_strings_padding',

			[

				'label' => esc_html__( 'Padding', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-strings' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_responsive_control(

			'pt_texttype_effect_strings_margin',

			[

				'label' => esc_html__( 'Margin', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-strings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'pt_texttype_effect_strings_border',

				'selector' => '{{WRAPPER}} .pt-texttype-effect-strings',

			]

		);

		$this->add_control(

			'eael_fancy_text_strings_border_radius',

			[

				'label' => esc_html__( 'Border Radius', 'elementor' ),

				'type' => Controls_Manager::SLIDER,

				'range' => [

					'px' => [

						'min' => 0,

						'max' => 100,

					],

				],

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-strings' => 'border-radius: {{SIZE}}{{UNIT}};',

				],

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'pt_texttype_effect_suffix_styles',

			[

				'label' => esc_html__( 'Suffix Text Styles', 'elementor' ),

				'tab' => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_control(

			'pt_texttype_effect_suffix_color',

			[

				'label' => esc_html__( 'Suffix Text Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'selectors' => [

					'{{WRAPPER}} .pt-texttype-effect-suffix' => 'color: {{VALUE}};',

				],

			]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'ending_typography',

				'scheme' => Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .pt-texttype-effect-suffix',

			]

		);

		$this->end_controls_section();

	}

	/**

	 * Define our Content Display settings.

	 */

	protected function render() {

		$settings = $this->get_settings();

	?>

	

	<div class="pt-texttype-effect-container">

			<?php

			if ( ! empty( $settings['pt_texttype_effect_prefix'] ) ) :

			?>

			<ul>

			<li><<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?> class="pt-texttype-effect-prefix"><?php echo wp_kses( ($settings['pt_texttype_effect_prefix'] ), true ); ?> </<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?>></li><?php endif; ?>			

			<?php if ( 'texttype' === $settings['pt_texttype_effect_transition_type'] ) : ?>

			<li><<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?> id="pt-texttype-effect-<?php echo esc_attr( $this->get_id() ); ?>" class="pt-texttype-effect-strings"></<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?>></li>

			<?php endif; ?>			

			<?php if ( 'texttype' !== $settings['pt_texttype_effect_transition_type'] ) : ?>

			<li><<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?> id="pt-texttype-effect-<?php echo esc_attr( $this->get_id() ); ?>" class="pt-texttype-effect-strings">

			<?php

			$pt_texttype_effect_strings_list = '';

			foreach ( $settings['pt_texttype_effect_strings'] as $item ) {

				$pt_texttype_effect_strings_list .= $item['pt_texttype_effect_strings_text_field'] . ', ';

			}

			echo rtrim( $pt_texttype_effect_strings_list, ', ' );

			?>

			</<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?>></li>

			<?php

			endif;

if ( ! empty( $settings['pt_texttype_effect_suffix'] ) ) :

			?>

			<li><<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?> class="pt-texttype-effect-suffix">

			<?php echo wp_kses( ($settings['pt_texttype_effect_suffix'] ), true ); ?> </<?php echo esc_html( $settings['pt_texttype_effect_align_tag'] ); ?>><?php endif; ?></li>

			</ul>

	</div>	

	<div class="clearfix"></div>	
	<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
	<!-- <script src="<?php //echo PT_PLUGIN_URL. 'assets/front-end/js/texttype-effect/index.js'; ?>"></script>  -->

	<?php if ( 'typing' === $settings['pt_texttype_effect_transition_type'] ) : ?>

	<script type="text/javascript">

	jQuery(document).ready(function($) {

		'use strict';

		$("#pt-texttype-effect-<?php echo esc_attr( $this->get_id() ); ?>").typed({

		strings: [

		<?php

		foreach ( $settings['pt_texttype_effect_strings'] as $item ) :

		?>

		<?php

		if ( ! empty( $item['pt_texttype_effect_strings_text_field'] ) ) :

		?>

		"<?php echo esc_attr( $item['pt_texttype_effect_strings_text_field'] ); ?>",<?php endif; ?><?php endforeach; ?>],

			typeSpeed: <?php echo esc_attr( $settings['pt_texttype_effect_speed'] ); ?>,

			backSpeed: 0,

			startDelay: 300,

			backDelay: <?php echo esc_attr( $settings['pt_texttype_effect_delay'] ); ?>,

			showCursor:

			<?php

			if ( ! empty( $settings['pt_texttype_effect_cursor'] ) ) :

			?>

			 true

			<?php

			else :

			?>

			false

			<?php

			endif;

			?>
,
			

			loop:

			<?php

			if ( ! empty( $settings['pt_texttype_effect_loop'] ) ) :

			?>

			true

			<?php

			else :

			?>

			false

			<?php

			endif;

			?>

			,

		});

	});

	</script>

	<?php endif; ?>	

	<?php if ( 'typing' !== $settings['pt_texttype_effect_transition_type'] ) : ?>

		<script type="text/javascript">

		jQuery(document).ready(function($) {

			'use strict';

			$("#pt-texttype-effect-<?php echo esc_attr( $this->get_id() ); ?>").Morphext({

				animation: "<?php echo esc_attr( $settings['pt_texttype_effect_transition_type'] ); ?>",

				separator: ",",

				speed: <?php echo esc_attr( $settings['pt_texttype_effect_delay'] ); ?>,

				complete: function () {

					// Overrides default empty function

				}

			});

		});

		</script>

	<?php

	endif;

	}

}



