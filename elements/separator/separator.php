<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\Separator;

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



class Separator extends Widget_Base {



	/**

	 * Define our get_name settings.

	 */

	public function get_name() {

		return 'pt-separator';

	}

	/**

	 * Define our get_title settings.

	 */

	public function get_title() {

		return __( 'PT Separator', 'elementor' );

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

	protected function _register_controls() {



        /*-----------------------------------------------------------------------------------*/

        /*	CONTENT TAB

        /*-----------------------------------------------------------------------------------*/

        

        /**

         * Content Tab: Divider

         */

        $this->start_controls_section(

            'section_buton',

            [

                'label'                 => __( 'Separator', 'elementor' ),

            ]

        );

        

        $this->add_control(

			'divider_type',

			[

				'label'                 => esc_html__( 'Type', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

				'label_block'           => false,

				'options'               => [

					'plain'        => [

						'title'    => esc_html__( 'Plain', 'elementor' ),

						'icon'     => 'fa fa-ellipsis-h',

					],

					'text'         => [

						'title'    => esc_html__( 'Text', 'elementor' ),

						'icon'     => 'fa fa-file-text-o',

					],

					'icon'         => [

						'title'    => esc_html__( 'Icon', 'elementor' ),

						'icon'     => 'fa fa-certificate',

					],

					'image'        => [

						'title'    => esc_html__( 'Image', 'elementor' ),

						'icon'     => 'eicon-image',

					],

				],

				'default'               => 'plain',

			]

		);



        $this->add_control(

            'divider_direction',

            [

                'label'                 => __( 'Direction', 'elementor' ),

                'type'                  => Controls_Manager::SELECT,

                'default'               => 'horizontal',

                'options'               => [

                   'horizontal'     => __( 'Horizontal', 'elementor' ),

                   'vertical'       => __( 'Vertical', 'elementor' ),

                ],

				'condition'             => [

					'divider_type'    => 'plain',

				],

            ]

        );



        $this->add_control(

            'divider_text',

            [

                'label'                 => __( 'Text', 'elementor' ),

                'type'                  => Controls_Manager::TEXT,

                'default'               => __( 'Divider Text', 'elementor' ),

				'condition'             => [

					'divider_type'    => 'text',

				],

            ]

        );



		$this->add_control(

			'divider_icon_new',

			[

				'label'                 => __( 'Icon', 'elementor' ),

				'type'                  => Controls_Manager::ICONS,

				'fa4compatibility' 		=> 'divider_icon',

				'default' => [

					'value' => 'fas fa-circle',

					'library' => 'fa-solid',

				],

				'condition'             => [

					'divider_type'    => 'icon',

				],

			]

		);



        $this->add_control(

            'text_html_tag',

            [

                'label'                 => __( 'HTML Tag', 'elementor' ),

                'type'                  => Controls_Manager::SELECT,

                'default'               => 'span',

                'options'               => [

                    'h1'            => __( 'H1', 'elementor' ),

                    'h2'            => __( 'H2', 'elementor' ),

                    'h3'            => __( 'H3', 'elementor' ),

                    'h4'            => __( 'H4', 'elementor' ),

                    'h5'            => __( 'H5', 'elementor' ),

                    'h6'            => __( 'H6', 'elementor' ),

                    'div'           => __( 'div', 'elementor' ),

                    'span'          => __( 'span', 'elementor' ),

                    'p'             => __( 'p', 'elementor' ),

                ],

				'condition'             => [

					'divider_type'    => 'text',

				],

            ]

        );

        

        $this->add_control(

            'divider_image',

            [

                'label'                 => __( 'Image', 'elementor' ),

                'type'                  => Controls_Manager::MEDIA,

                'default'               => [

                    'url'           => Utils::get_placeholder_image_src(),

                ],

				'condition'             => [

					'divider_type'    => 'image',

				],

            ]

        );

        

        $this->add_responsive_control(

			'align',

			[

				'label'                 => __( 'Alignment', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

				'default'               => 'center',

				'options'               => [

					'left'          => [

						'title'     => __( 'Left', 'elementor' ),

						'icon'      => 'eicon-h-align-left',

					],

					'center'        => [

						'title'     => __( 'Center', 'elementor' ),

						'icon'      => 'eicon-h-align-center',

					],

					'right'         => [

						'title'     => __( 'Right', 'elementor' ),

						'icon'      => 'eicon-h-align-right',

					],

				],

				'selectors'             => [

					'{{WRAPPER}}'   => 'text-align: {{VALUE}};',

				],

			]

		);



        $this->end_controls_section();



        /*-----------------------------------------------------------------------------------*/

        /*	STYLE TAB

        /*-----------------------------------------------------------------------------------*/

        

        /**

         * Style Tab: Divider

         */

        $this->start_controls_section(

            'section_divider_style',

            [

                'label'                 => __( 'Separator', 'elementor' ),

                'tab'                   => Controls_Manager::TAB_STYLE,

            ]

        );

        

        

        $this->add_control(

			'divider_vertical_align',

			[

				'label'                 => __( 'Vertical Alignment', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

                'label_block'           => false,

				'default'               => 'middle',

				'options'               => [

					'top'          => [

						'title'    => __( 'Top', 'elementor' ),

						'icon'     => 'eicon-v-align-top',

					],

					'middle'       => [

						'title'    => __( 'Center', 'elementor' ),

						'icon'     => 'eicon-v-align-middle',

					],

					'bottom'       => [

						'title'    => __( 'Bottom', 'elementor' ),

						'icon'     => 'eicon-v-align-bottom',

					],

				],

				'selectors'             => [

					'{{WRAPPER}} .divider-text-wrap'   => 'align-items: {{VALUE}};',

				],

				'selectors_dictionary'  => [

					'top'          => 'flex-start',

					'middle'       => 'center',

					'bottom'       => 'flex-end',

				],

				'condition'             => [

					'divider_type!'   => 'plain',

				],

			]

		);



        $this->add_control(

            'divider_style',

            [

                'label'                 => __( 'Style', 'elementor' ),

                'type'                  => Controls_Manager::SELECT,

                'default'               => 'dashed',

                'options'               => [

                   'solid'          => __( 'Solid', 'elementor' ),

                   'dashed'         => __( 'Dashed', 'elementor' ),

                   'dotted'         => __( 'Dotted', 'elementor' ),

                   'double'         => __( 'Double', 'elementor' ),

                ],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider, {{WRAPPER}} .divider-border' => 'border-style: {{VALUE}};',

				],

            ]

        );

        

        $this->add_responsive_control(

			'horizontal_height',

			[

				'label'                 => __( 'Height', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px'       => [

						'min'  => 1,

						'max'  => 60,

					],

				],

				'default'               => [

					'size'     => 3,

					'unit'     => 'px',

				],

				'tablet_default'    => [

					'unit'     => 'px',

				],

				'mobile_default'    => [

					'unit'     => 'px',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider.horizontal' => 'border-bottom-width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .divider-border' => 'border-top-width: {{SIZE}}{{UNIT}};',

				],

				'condition'             => [

					'divider_direction'    => 'horizontal',

				],

			]

		);

        

        $this->add_responsive_control(

			'vertical_height',

			[

				'label'                 => __( 'Height', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px'           => [

						'min'      => 1,

						'max'      => 500,

					],

				],

				'default'               => [

					'size'         => 80,

					'unit'         => 'px',

				],

				'tablet_default'   => [

					'unit'         => 'px',

				],

				'mobile_default'   => [

					'unit'         => 'px',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider.vertical' => 'height: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .divider-border' => 'border-top-width: {{SIZE}}{{UNIT}};',

				],

				'condition'             => [

					'divider_direction'    => 'vertical',

				],

			]

		);

        

        $this->add_responsive_control(

			'horizontal_width',

			[

				'label'                 => __( 'Width', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px'           => [

						'min'      => 1,

						'max'      => 1200,

					],

				],

				'default'               => [

					'size'         => 300,

					'unit'         => 'px',

				],

				'tablet_default'   => [

					'unit'         => 'px',

				],

				'mobile_default'   => [

					'unit'         => 'px',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider.horizontal' => 'width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .divider-text-container' => 'width: {{SIZE}}{{UNIT}};',

				],

				'condition'             => [

					'divider_direction'    => 'horizontal',

				],

			]

		);

        

        $this->add_responsive_control(

			'vertical_width',

			[

				'label'                 => __( 'Width', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px'           => [

						'min'      => 1,

						'max'      => 100,

					],

				],

				'default'               => [

					'size'         => 3,

					'unit'         => 'px',

				],

				'tablet_default'   => [

					'unit'         => 'px',

				],

				'mobile_default'   => [

					'unit'         => 'px',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider.vertical' => 'border-left-width: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}} .divider-text-container' => 'width: {{SIZE}}{{UNIT}};',

				],

				'condition'             => [

					'divider_direction'    => 'vertical',

				],

			]

		);



        $this->add_control(

            'divider_border_color',

            [

                'label'                 => __( 'Seprator Color', 'elementor' ),

                'type'                  => Controls_Manager::COLOR,

                'default'               => '',

                'selectors'             => [

                    '{{WRAPPER}} .pt-divider, {{WRAPPER}} .divider-border' => 'border-color: {{VALUE}};',

                ],

				'condition'             => [

					'divider_type'    => 'plain',

				],

            ]

        );



        $this->start_controls_tabs( 'tabs_before_after_style' );



        $this->start_controls_tab(

            'tab_before_style',

            [

                'label'                 => __( 'Before', 'elementor' ),

				'condition'             => [

					'divider_type!'   => 'plain',

				],

            ]

        );



        $this->add_control(

            'divider_before_color',

            [

                'label'                 => __( 'Seprator Color', 'elementor' ),

                'type'                  => Controls_Manager::COLOR,

                'default'               => '',

				'condition'             => [

					'divider_type!'   => 'plain',

				],

                'selectors'             => [

                    '{{WRAPPER}} .divider-border-left .divider-border' => 'border-color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->start_controls_tab(

            'tab_after_style',

            [

                'label'                 => __( 'After', 'elementor' ),

				'condition'             => [

					'divider_type!'   => 'plain',

				],

            ]

        );



        $this->add_control(

            'divider_after_color',

            [

                'label'                 => __( 'Separator Color', 'elementor' ),

                'type'                  => Controls_Manager::COLOR,

                'default'               => '',

				'condition'             => [

					'divider_type!'   => 'plain',

				],

                'selectors'             => [

                    '{{WRAPPER}} .divider-border-right .divider-border' => 'border-color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->end_controls_tabs();



        $this->end_controls_section();



        /**

         * Style Tab: Text

         */

        $this->start_controls_section(

            'section_text_style',

            [

                'label'                 => __( 'Text', 'elementor' ),

                'tab'                   => Controls_Manager::TAB_STYLE,

				'condition'             => [

					'divider_type'    => 'text',

				],

            ]

        );

        

        $this->add_control(

			'text_position',

			[

				'label'                 => __( 'Position', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

				'options'               => [

					'left'         => [

						'title'    => __( 'Left', 'elementor' ),

						'icon'     => 'eicon-h-align-left',

					],

					'center'       => [

						'title'    => __( 'Center', 'elementor' ),

						'icon'     => 'eicon-h-align-center',

					],

					'right'        => [

						'title'    => __( 'Right', 'elementor' ),

						'icon'     => 'eicon-h-align-right',

					],

				],

				'default'               => 'center',

                'prefix_class'		    => 'pt-divider-'

			]

		);



        $this->add_control(

            'divider_text_color',

            [

                'label'                 => __( 'Color', 'elementor' ),

                'type'                  => Controls_Manager::COLOR,

                'default'               => '',

				'condition'             => [

					'divider_type'    => 'text',

				],

                'selectors'             => [

                    '{{WRAPPER}} .pt-divider-text' => 'color: {{VALUE}};',

                ],

            ]

        );

        

        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name'                  => 'typography',

                'label'                 => __( 'Typography', 'elementor' ),

                'scheme'                => Typography::TYPOGRAPHY_4,

                'selector'              => '{{WRAPPER}} .pt-divider-text',

				'condition'             => [

					'divider_type'    => 'text',

				],

            ]

        );



        $this->add_group_control(

            Group_Control_Text_Shadow::get_type(),

            [

                'name'                  => 'divider_text_shadow',

                'selector'              => '{{WRAPPER}} .pt-divider-text',

            ]

        );

        

        $this->add_responsive_control(

			'text_spacing',

			[

				'label'                 => __( 'Spacing', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 200,

					],

				],

				'condition'             => [

					'divider_type'    => 'text',

				],

				'selectors'             => [

					'{{WRAPPER}}.pt-divider-center .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-left .pt-divider-content' => 'margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-right .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}};',

				],

			]

		);

        

        $this->end_controls_section();



        /**

         * Style Tab: Icon

         */

        $this->start_controls_section(

            'section_icon_style',

            [

                'label'                 => __( 'Icon', 'elementor' ),

                'tab'                   => Controls_Manager::TAB_STYLE,

				'condition'             => [

					'divider_type'    => 'icon',

				],

            ]

        );

        

        $this->add_control(

			'icon_position',

			[

				'label'                 => __( 'Position', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

				'options'               => [

					'left'         => [

						'title'    => __( 'Left', 'elementor' ),

						'icon'     => 'eicon-h-align-left',

					],

					'center'       => [

						'title'    => __( 'Center', 'elementor' ),

						'icon'     => 'eicon-h-align-center',

					],

					'right'        => [

						'title'    => __( 'Right', 'elementor' ),

						'icon'     => 'eicon-h-align-right',

					],

				],

				'default'               => 'center',

                'prefix_class'		    => 'pt-divider-'

			]

		);



        $this->add_control(

            'divider_icon_color',

            [

                'label'                 => __( 'Color', 'elementor' ),

                'type'                  => Controls_Manager::COLOR,

                'default'               => '',

				'condition'             => [

					'divider_type'    => 'icon',

				],

                'selectors'             => [

                    '{{WRAPPER}} .pt-divider-icon' => 'color: {{VALUE}};',

                ],

            ]

        );

        

        $this->add_responsive_control(

			'icon_size',

			[

				'label'                 => __( 'Size', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 100,

					],

				],

				'default'               => [

					'size' => 16,

					'unit' => 'px',

				],

				'condition'             => [

					'divider_type'    => 'icon',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider-icon' => 'font-size: {{SIZE}}{{UNIT}};',

				],

			]

		);

        

        $this->add_responsive_control(

			'icon_rotation',

			[

				'label'                 => __( 'Icon Rotation', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 360,

					],

				],

				'default'               => [

					'unit' => 'px',

				],

				'tablet_default'    => [

					'unit' => 'px',

				],

				'mobile_default'    => [

					'unit' => 'px',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider-icon .fa' => 'transform: rotate( {{SIZE}}deg );',

				],

				'condition'             => [

					'divider_type'    => 'icon',

				],

			]

		);

        

        $this->add_responsive_control(

			'icon_spacing',

			[

				'label'                 => __( 'Spacing', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 200,

					],

				],

				'condition'             => [

					'divider_type'    => 'icon',

				],

				'selectors'             => [

					'{{WRAPPER}}.pt-divider-center .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-left .pt-divider-content' => 'margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-right .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}};',

				],

			]

		);

        

        $this->end_controls_section();



        /**

         * Style Tab: Image

         */

        $this->start_controls_section(

            'section_image_style',

            [

                'label'                 => __( 'Image', 'elementor' ),

                'tab'                   => Controls_Manager::TAB_STYLE,

				'condition'             => [

					'divider_type'    => 'image',

				],

            ]

        );

        

        $this->add_control(

			'image_position',

			[

				'label'                 => __( 'Position', 'elementor' ),

				'type'                  => Controls_Manager::CHOOSE,

				'options'               => [

					'left'      => [

						'title' => __( 'Left', 'elementor' ),

						'icon'  => 'eicon-h-align-left',

					],

					'center'    => [

						'title' => __( 'Center', 'elementor' ),

						'icon'  => 'eicon-h-align-center',

					],

					'right'     => [

						'title' => __( 'Right', 'elementor' ),

						'icon'  => 'eicon-h-align-right',

					],

				],

				'default'               => 'center',

                'prefix_class'		    => 'pt-divider-'

			]

		);

        

        $this->add_responsive_control(

			'image_width',

			[

				'label'                 => __( 'Width', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 1200,

					],

				],

				'default'               => [

					'size' => 80,

					'unit' => 'px',

				],

				'tablet_default'    => [

					'unit' => 'px',

				],

				'mobile_default'    => [

					'unit' => 'px',

				],

				'condition'             => [

					'divider_type'    => 'image',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider-image' => 'width: {{SIZE}}{{UNIT}};',

				],

			]

		);



		$this->add_control(

			'icon_border_radius',

			[

				'label'                 => __( 'Border Radius', 'elementor' ),

				'type'                  => Controls_Manager::DIMENSIONS,

				'size_units'            => [ 'px', '%' ],

				'condition'             => [

					'divider_type'    => 'image',

				],

				'selectors'             => [

					'{{WRAPPER}} .pt-divider-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

        

        $this->add_responsive_control(

			'image_spacing',

			[

				'label'                 => __( 'Spacing', 'elementor' ),

				'type'                  => Controls_Manager::SLIDER,

				'size_units'            => [ '%', 'px' ],

				'range'                 => [

					'px' => [

						'max' => 200,

					],

				],

				'condition'             => [

					'divider_type'    => 'image',

				],

				'selectors'             => [

					'{{WRAPPER}}.pt-divider-center .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-left .pt-divider-content' => 'margin-right: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.pt-divider-right .pt-divider-content' => 'margin-left: {{SIZE}}{{UNIT}};',

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

		$icon_migrated = isset($settings['__fa4_migrated']['divider_icon_new']);

		$icon_is_new = empty($settings['divider_icon']);



        $this->add_render_attribute( 'divider', 'class', 'pt-divider' );



        if ( $settings['divider_direction'] ) {

            $this->add_render_attribute( 'divider', 'class', $settings['divider_direction'] );

        }



        if ( $settings['divider_style'] ) {

            $this->add_render_attribute( 'divider', 'class', $settings['divider_style'] );

        }

        

        $this->add_render_attribute( 'divider-content', 'class', 'pt-divider-' . $settings['divider_type'] );

        

        $this->add_inline_editing_attributes( 'divider_text', 'none' );

        $this->add_render_attribute( 'divider_text', 'class', 'pt-divider-' . $settings['divider_type'] );

        

        ?>

        <div class="pt-divider-wrap">

            <?php

            if ( $settings['divider_type'] == 'plain' ) { ?>

                <div <?php echo $this->get_render_attribute_string( 'divider' ); ?>></div>

                <?php

            }

            else { ?>

                <div class="divider-text-container">

                    <div class="divider-text-wrap">

                        <span class="divider-border-wrap divider-border-left">

                            <span class="divider-border"></span>

                        </span>

                        <span class="pt-divider-content">

                            <?php if ( $settings['divider_type'] == 'text' && $settings['divider_text'] ) { ?>

                                <?php

                                    printf('<%1$s %2$s>%3$s</%1$s>', $settings['text_html_tag'], $this->get_render_attribute_string( 'divider_text' ), $settings['divider_text'] );

                                ?>

                            <?php } elseif ( $settings['divider_type'] == 'icon') { ?>

                                <span <?php echo $this->get_render_attribute_string( 'divider-content' ); ?>>

									<?php if ($icon_migrated || $icon_is_new) { ?>

										<span class="<?php echo esc_attr( $settings['divider_icon_new']['value'] ); ?>" aria-hidden="true"></span>

									<?php } else { ?>

										<span class="<?php echo esc_attr( $settings['divider_icon'] ); ?>" aria-hidden="true"></span>

									<?php } ?>

                                </span>

                            <?php } elseif ( $settings['divider_type'] == 'image' ) { ?>

                                <span <?php echo $this->get_render_attribute_string( 'divider-content' ); ?>>

                                    <?php

                                        if( isset($settings['divider_image']['url']) ) {?>

                                            <img src="<?php echo esc_url( $settings['divider_image']['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($settings['divider_image']['id'], '_wp_attachment_image_alt', true)); ?>">

                                    <?php } ?>

                                </span>

                            <?php } ?>

                        </span>

                        <span class="divider-border-wrap divider-border-right">

                            <span class="divider-border"></span>

                        </span>

                    </div>

                </div>

                <?php

            }

            ?>

        </div>    

        <?php

	}

	/**

	 * Render divider widget output in the editor.

	 */

    protected function _content_template() {

        ?>

        <div class="pt-divider-wrap">

            <# if ( settings.divider_type == 'plain' ) { #>

                <div class="pt-divider {{ settings.divider_direction }} {{ settings.divider_style }} "></div>

            <# } else { #>

                <div class="divider-text-container">

                    <div class="divider-text-wrap">

                        <span class="divider-border-wrap divider-border-left">

                            <span class="divider-border"></span>

                        </span>

                        <span class="pt-divider-content">

                            <# if ( settings.divider_type == 'text' && settings.divider_text != '' ) { #>

                                <{{ settings.text_html_tag }} class="pt-divider-{{ settings.divider_type }} elementor-inline-editing" data-elementor-setting-key="divider_text" data-elementor-inline-editing-toolbar="none">

                                    {{ settings.divider_text }}

                                </{{ settings.text_html_tag }}>

                            <# } else if ( settings.divider_type == 'icon' && settings.divider_icon != '' ) { #>

                                <span class="pt-divider-{{ settings.divider_type }}">

                                    <span class="{{ settings.divider_icon }}" aria-hidden="true"></span>

                                </span>

                            <# } else if ( settings.divider_type == 'image' ) { #>

                                <span class="pt-divider-{{ settings.divider_type }}">

                                    <img src="{{ settings.divider_image.url }}">

                                </span>

                            <# } #>

                        </span>

                        <span class="divider-border-wrap divider-border-right">

                            <span class="divider-border"></span>

                        </span>

                    </div>

                </div>

            <# } #>

        </div>

        <?php

    }



}

