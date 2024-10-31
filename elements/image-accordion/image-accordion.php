<?php

namespace Elementor;

namespace Pt_Addons_Elementor\Elements\ImageAccordion;

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

use \Elementor\Group_Control_Image_Size as Group_Control_Image_Size;

use \Elementor\Widget_Base as Widget_Base;

use \Pt_Addons_Elementor\Classes\Bootstrap;

class Image_Accordion extends Widget_Base

{

    use \Pt_Addons_Elementor\Includes\Triat\Helper;

    public function get_name()

    {

        return 'Pt-image-accordian';

    }

    public function get_title()

    {

        return esc_html__('Image Accordion', 'pt-addons-elementor');

    }

    public function get_icon()

    {

        return 'eicon-call-to-action';

    }

    public function get_categories()

    {

        return ['pt-addons-elementor'];

    }

	

	/**

	 * Define our _register_controls settings.

	 */

	protected function _register_controls() {

		/**

      * Image accordion Content Settings

      */

      $this->start_controls_section(

        'pt_section_img_accordion_settings',

        [

          'label' => esc_html__( 'Image Accordion Settings', 'elementor' )

        ]

      );

      $this->add_control(

        'pt_img_accordion_type',

          [

          'label'         => esc_html__( 'Accordion Style', 'elementor' ),

            'type'      => Controls_Manager::SELECT,

            'default'     => 'on-hover',

            'label_block'   => false,

            'options'     => [

              'on-hover'   => esc_html__( 'On Hover', 'elementor' ),

              'on-click'   => esc_html__( 'On Click', 'elementor' ),

            ],

          ]

      );

      //**Repeater contropl fields updated */



      $repeater = new \Elementor\Repeater();

      

		$repeater->add_control(

			'pt_accordion_bg',

			[

				'label' => esc_html__( 'Background Image', 'elementor' ),

				'type' => \Elementor\Controls_Manager::MEDIA,

        'label_block' => true,

				'default' => [

					'url' => \Elementor\Utils::get_placeholder_image_src(),

				],

			]);



    $repeater->add_control(

			'pt_accordion_tittle', [

				'label' => esc_html__( 'Title', 'elementor' ),

				'type' => \Elementor\Controls_Manager::TEXT,

				'default' => esc_html__( 'Accordion item title' , 'elementor' ),

				'label_block' => true,

			]

		);

    $repeater->add_control(

			'pt_accordion_content', [

				'label' => esc_html__( 'Content', 'elementor' ),

				'type' => \Elementor\Controls_Manager::WYSIWYG,

				'default' => esc_html__( 'Accordion content goes here!' , 'elementor' ),

				'label_block' => true,

			]

		);




    $repeater->add_control(

			'pt_accordion_title_link',

			[

				'label' => esc_html__( 'Title Link', 'elementor' ),

				'type' => \Elementor\Controls_Manager::URL,

				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),

        'label_block' => true,

        'default' => [

              'url' => '#',

              'is_external' => '',

          ],

          'show_external' => true,

			]

		);

        

      $this->add_control(

        'pt_img_accordions',

        [

          'type' => \Elementor\Controls_Manager::REPEATER,

				'fields' => $repeater->get_controls(),

          'seperator' => 'before',

          'default' => [

            [ 'pt_accordion_bg' => Utils::get_placeholder_image_src() ],

            [ 'pt_accordion_bg' => Utils::get_placeholder_image_src() ],

            [ 'pt_accordion_bg' => Utils::get_placeholder_image_src() ],

            [ 'pt_accordion_bg' => Utils::get_placeholder_image_src() ],

          ],

         

          'title_field' => '{{pt_accordion_tittle}}',

        ]

      );

      $this->end_controls_section();

      /**

       * -------------------------------------------

       * Tab Style (Image accordion)

       * -------------------------------------------

       */

      $this->start_controls_section(

        'pt_section_img_accordion_style_settings',

        [

          'label' => esc_html__( 'Image Accordion Style', 'elementor' ),

          'tab' => Controls_Manager::TAB_STYLE

        ]

      );

      $this->add_control(

        'pt_accordion_height',

        [

          'label' => esc_html__( 'Height', 'elementor' ),

          'type' => Controls_Manager::TEXT,

          'default' => '400',

          'description' => 'Unit in px',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion ' => 'height: {{VALUE}}px;',

          ],

        ]

      );

      $this->add_control(

        'pt_accordion_bg_color',

        [

          'label' => esc_html__( 'Background Color', 'elementor' ),

          'type' => Controls_Manager::COLOR,

          'default' => '',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion' => 'background-color: {{VALUE}};',

          ],

        ]

      );

      $this->add_responsive_control(

        'pt_accordion_container_padding',

        [

          'label' => esc_html__( 'Padding', 'elementor' ),

          'type' => Controls_Manager::DIMENSIONS,

          'size_units' => [ 'px', 'em', '%' ],

          'selectors' => [

              '{{WRAPPER}} .pt-img-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

          ],

        ]

      );

      $this->add_responsive_control(

        'pt_accordion_container_margin',

        [

          'label' => esc_html__( 'Margin', 'elementor' ),

          'type' => Controls_Manager::DIMENSIONS,

          'size_units' => [ 'px', 'em', '%' ],

          'selectors' => [

              '{{WRAPPER}} .pt-img-accordion' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

          ],

        ]

      );

      $this->add_group_control(

        Group_Control_Border::get_type(),

        [

          'name' => 'pt_accordion_border',

          'label' => esc_html__( 'Border', 'elementor' ),

          'selector' => '{{WRAPPER}} .pt-img-accordion',

        ]

      );

      $this->add_control(

        'pt_accordion_border_radius',

        [

          'label' => esc_html__( 'Border Radius', 'elementor' ),

          'type' => Controls_Manager::SLIDER,

          'default' => [

            'size' => 4,

          ],

          'range' => [

            'px' => [

              'max' => 500,

            ],

          ],

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion' => 'border-radius: {{SIZE}}px;',

          ],

        ]

      );

      $this->add_group_control(

        Group_Control_Box_Shadow::get_type(),

        [

          'name' => 'pt_accordion_shadow',

          'selector' => '{{WRAPPER}} .pt-img-accordion',

        ]

      );

      $this->add_control(

        'pt_accordion_img_overlay_color',

        [

          'label' => esc_html__( 'Overlay Color', 'elementor' ),

          'type' => Controls_Manager::COLOR,

          'default' => 'rgba(0, 0, 0, .3)',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion a:after' => 'background-color: {{VALUE}};',

          ],

        ]

      );

      $this->add_control(

        'pt_accordion_img_hover_color',

        [

          'label' => esc_html__( 'Hover Color', 'elementor' ),

          'type' => Controls_Manager::COLOR,

          'default' => 'rgba(0, 0, 0, .5)',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion a:hover .overlay' => 'background-color: {{VALUE}};',

          ],

        ]

      );

      $this->end_controls_section();

      /**

       * -------------------------------------------

       * Tab Style (Image accordion Content Style)

       * -------------------------------------------

       */

      $this->start_controls_section(

        'pt_section_img_accordion_typography_settings',

        [

          'label' => esc_html__( 'Color &amp; Typography', 'elementor' ),

          'tab' => Controls_Manager::TAB_STYLE

        ]

      );

      $this->add_control(

        'pt_accordion_title_text',

        [

          'label' => esc_html__( 'Title', 'elementor' ),

          'type' => Controls_Manager::HEADING,

          'separator' => 'before'

        ]

      );

      $this->add_control(

        'pt_accordion_title_color',

        [

          'label' => esc_html__( 'Color', 'elementor' ),

          'type' => Controls_Manager::COLOR,

          'default' => '#fff',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion .overlay h2' => 'color: {{VALUE}};',

          ],

        ]

      );

      $this->add_group_control(

        Group_Control_Typography::get_type(),

        [

          'name' => 'pt_accordion_title_typography',

          'selector' => '{{WRAPPER}} .pt-img-accordion .overlay h2',

        ]

      );

      $this->add_control(

        'pt_accordion_content_text',

        [

          'label' => esc_html__( 'Content', 'elementor' ),

          'type' => Controls_Manager::HEADING,

          'separator' => 'before'

        ]

      );

      $this->add_control(

        'pt_accordion_content_color',

        [

          'label' => esc_html__( 'Color', 'elementor' ),

          'type' => Controls_Manager::COLOR,

          'default' => '#fff',

          'selectors' => [

            '{{WRAPPER}} .pt-img-accordion .overlay p' => 'color: {{VALUE}};',

          ],

        ]

      );

      $this->add_group_control(

        Group_Control_Typography::get_type(),

        [

          'name' => 'pt_accordion_content_typography',

          'selector' => '{{WRAPPER}} .pt-img-accordion .overlay p',

        ]

      );

      $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

      if( !empty($settings['pt_img_accordions']) ) :

      ?>

      <div class="pt-img-accordion" id="pt-img-accordion-<?php echo $this->get_id(); ?>" style="overflow:hidden;">

        <?php foreach( $settings['pt_img_accordions'] as $img_accordion ) :

            $pt_accordion_link = $img_accordion['pt_accordion_title_link']['url'];

            $target = $img_accordion['pt_accordion_title_link']['is_external'] ? 'target="_blank"' : '';

            $nofollow = $img_accordion['pt_accordion_title_link']['nofollow'] ? 'rel="nofollow"' : '';

        ?>

          <a href="<?php echo esc_url($pt_accordion_link); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> style="background-image: url(<?php echo esc_url($img_accordion['pt_accordion_bg']['url']); ?>);">

            <div class="overlay">

              <div class="overlay-inner">

                <h2><?php echo $img_accordion['pt_accordion_tittle']; ?></h2>

                <p><?php echo $img_accordion['pt_accordion_content']; ?></p>

              </div>

            </div>

          </a>

        <?php endforeach; ?>

      </div>

		

 

		<?php if( 'on-hover' === $settings['pt_img_accordion_type'] ) : ?>

	<style>

		#pt-img-accordion-<?php echo $this->get_id(); ?> a:hover {

            flex: 3;

          }

          #pt-img-accordion-<?php echo $this->get_id(); ?> a:hover .overlay-inner * {

            opacity: 1;

            visibility: visible;

            transform: none;

            transition: all .3s .3s;

          }

	</style>

	

	<?php elseif( 'on-click' === $settings['pt_img_accordion_type'] ) : ?>

	<style>

		#pt-img-accordion-<?php echo $this->get_id(); ?> .active-tab {

            flex: 3;

          }

          #pt-img-accordion-<?php echo $this->get_id(); ?> .active-tab .overlay-inner * {

            opacity: 1;

            visibility: visible;

            transform: none;

            transition: all .3s .3s;

          } 

	</style>

	<?php endif; ?>

	<?php

	?>	

		

<script>

jQuery(document).ready(function(){

    jQuery('.pt-img-accordion a').click(function(event){

        event.preventDefault();

        //remove all pre-existing active classes

        jQuery('.pt-img-accordion a').removeClass('active-tab');

        //add the active class to the link we clicked

        jQuery(this).addClass('active-tab');

    });

	

});

</script>

      <?php endif; ?>

      <?php

	}

	

}