<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\BusinessHours;

// If this file is called directly, abort.

if (!defined('ABSPATH')) {

    exit;

}

use \Elementor\Utils;

use \Elementor\Frontend;

use \Elementor\Controls_Manager as Controls_Manager;

use \Elementor\Group_Control_Background;

// use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Border;

use \Elementor\Group_Control_Typography;

use \Elementor\Core\Schemes\Typography;

use \Elementor\Core\Schemes\Color;

use \Elementor\Group_Control_Box_Shadow;

use \Elementor\Group_Control_Text_Shadow;

use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;

use \Elementor\Widget_Base as Widget_Base;

use \Pt_Addons_Elementor\Classes\Bootstrap;


class Business_Hours extends Widget_Base {



	/**

	 * Define our get name settings.

	 */

	public function get_name() {



		return 'pt-business-hours';



	}

	/**

	 * Define our get title settings.

	 */

	public function get_title() {



		return __( 'Business Hours', 'elementor' );



	}

	/**

	 * Define our get icon settings.

	 */

	public function get_icon() {



		return 'eicon-countdown';



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

	// -------------------------------------------------------
	

	public function get_script_depends() {

		wp_register_script( 'sweet_alert-2','https://cdn.jsdelivr.net/npm/sweetalert2@11');
			return [
			'sweet_alert-2',
		];

	}

	//** testing control if condition  */

	protected function _register_controls() {

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(

			'hours_title',

			[

				'label' => __( 'Day Name', 'elementor' ),

				'type' => Controls_Manager::TEXT,
			]

		);

		$repeater->add_control(

			'opening_hours',
		
			[
				'label' => esc_html__( 'Select Opening Time', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options'=>[
				
					'enableTime'=> true,
					'noCalendar'=>true,
					'dateFormat'=>"G:i K",
								
						],
				'default'=>'09:30 AM',
			]

			// [

			// 	'label' => __( 'Opening Hours', 'elementor' ),

			// 	'type' => Controls_Manager::TEXT,

			// 	'default' => __( '9:00 AM', 'elementor' ),

			// ]

		);

		$repeater->add_control(

			'closing_hours',

			[
				'label' => esc_html__( 'Select Closing Time', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'picker_options'=>[
				
						'enableTime'=> true,
						'noCalendar'=>true,
						'dateFormat'=>"G:i K",
							],
				'default'=>'06:30 PM',
			]
			// [

			// 	'label' => __( 'Closing Hours', 'elementor' ),

			// 	'type' => Controls_Manager::TEXT,

			// 	'default' => __( '6:00 PM', 'elementor' ),

			// ]

		);

		$this->start_controls_section(

			'section_form_fields',

			[

				'label' => __( 'Business Hours', 'elementor' ),

			]

		);

		$this->add_control(

			'business_day_hours',

			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'default' => [

					[

						'hours_title' => __( 'Monday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Tuesday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Wednesday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Thursday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Friday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Saturday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

					[

						'hours_title' => __( 'Sunday', 'elementor' ),

						'item_description' => __( 'I am item content. Click edit button to change this text.', 'elementor' ),

					],

				],

				'title_field' => '{{{ hours_title }}}',

			]

		);

		$this->end_controls_section();

		$this->start_controls_section(

			'section_business_hours_bg',

			[

				'label' => __( 'Business Hours Style', 'elementor' ),

				'tab'   => Controls_Manager::TAB_STYLE,

			]

		);

		$this->add_group_control(

			Group_Control_Background::get_type(),

			[

				'name' => 'business_hours_box_background',

				'label' => __( 'Box Background', 'elementor' ),

				'types' => [ 'classic', 'gradient' ],

				'selector' => '{{WRAPPER}} .pt-business-hours',

			]

		);

		$this->add_control(

			'main_padding',

			[

				'label' => __( 'Box Padding', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-business-hours' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_control(

			'item_padding',

			[

				'label' => __( 'Box Item Padding', 'elementor' ),

				'type' => Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .pt-business-hours-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);


        $this->add_group_control(

			Group_Control_Border::get_type(),

			[

				'name' => 'business_hours_item_border',

				'label' => __( 'Box Item Border', 'elementor' ),

				'selectors' => [
					'{{WRAPPER}} .pt-business-hours-row' => 'border: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

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

			'heading_title_color',

			[

				'label' => __( 'Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-business-day' => 'color: {{VALUE}};',

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

				'selector' => '{{WRAPPER}} .pt-business-day',

				'scheme' => Typography::TYPOGRAPHY_2,

			]

		);

		$this->add_control(

			'pt_opening_hours_style',

			[

				'label' => __( 'Opening Hours', 'elementor' ),

				'type' => Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);

		$this->add_control(

			'opening_color',

			[

				'label' => __( 'Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-opening-hours' => 'color: {{VALUE}};',

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

				'name' => 'opening_hours_typography',

				'selector' => '{{WRAPPER}} .pt-opening-hours',

				'scheme' => Typography::TYPOGRAPHY_3,

			]

		);

		$this->add_control(

			'pt_closing_hours_style',

			[

				'label' => __( 'Closing Hours', 'elementor' ),

				'type' => Controls_Manager::HEADING,

				'separator' => 'before',

			]

		);


		$this->add_control(

			'closing_color',

			[

				'label' => __( 'Color', 'elementor' ),

				'type' => Controls_Manager::COLOR,

				'default' => '',

				'selectors' => [

					'{{WRAPPER}} .pt-closing-hours' => 'color: {{VALUE}};',

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

				'name' => 'closing_hours_typography',

				'selector' => '{{WRAPPER}} .pt-closing-hours',

				'scheme' => Typography::TYPOGRAPHY_3,

			]

		);

		$this->end_controls_section();

	}

	
	// -----------------------------------------



	/**

	 * Define our Content Render settings.

	 */

	protected function render() {

		
		$settings = $this->get_settings_for_display();


		?>

		<div class="pt-business-hours">
		<span id="error"></span>
		<?php foreach( $settings['business_day_hours'] as $hours) { ?>

			<div class="pt-business-hours-row  <?php echo strtolower( $hours['hours_title'] ); ?> "> 

				<span class="pt-business-day"> <?php echo $hours['hours_title']; ?> </span>

				<span class="pt-business-timing"> 

					<span class="pt-opening-hours"> <?php echo $hours['opening_hours']; ?> </span><?php if($hours['opening_hours'] && $hours['closing_hours'] ) { ?> - <?php } ?><span class="pt-closing-hours"> <?php echo $hours['closing_hours']; ?> </span>
                    <?php if($hours['opening_hours']== $hours['closing_hours']) { echo '<script> document.getElementById("error").innerHTML="You can not select same opening and closing Time!";</script>';}
					
					?>
				</span>

			</div>

		<?php } ?>

		</div>

		<?php

		

	}


	/**

	 * Define our Content template settings.

	 */

	protected function _content_template() {



	}

}



