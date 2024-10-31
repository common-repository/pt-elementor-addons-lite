<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\ListClient;
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
class ClientsList extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'Pt-clients-list';
    }
    public function get_title()
    {
        return esc_html__('Clients List', 'pt-addons-elementor');
    }
    public function get_icon()
    {
        return 'eicon-person';
    }
    public function get_categories()
    {
        return ['pt-addons-elementor'];
    }
	


    public function get_style_depends() {

		wp_register_style( 'pt-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_register_style( 'pt-slider-css','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css');
		wp_register_style( 'pt-slider-custom_css',PT_PLUGIN_URL. '/assets/front-end/css/clients-list/index.css');
	

		return [
            'pt-slider-custom_css',
			'pt-awesome',
			'pt-slider-css',
		];

	}

	/**
	 * Define our _register_controls settings.
	 */
	protected function _register_controls() {
        $this->start_controls_section(
            'section_clients',
            [
                'label' => __('Clients', 'elementor'),
            ]
        );
/** repeater controls code updated here by-shyam  */
$repeater = new \Elementor\Repeater();
$repeater->add_control(
    'client_name', [
        'label' => esc_html__( 'Client Name', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'description' => __('The name of the client/customer.', 'elementor'),
        'dynamic' => [
            'active' => true,
        ],
        'default' => esc_html__( 'Client Name', 'elementor' ),
        'label_block' => true,
    ]
);

$repeater->add_control(
    'client_link',
    [
        'label' => esc_html__( 'Client URL', 'elementor' ),
        'type' => \Elementor\Controls_Manager::URL,
        'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
        'description' => __('The website of the client/customer.', 'elementor'),
        'default' => [
            'url' => '',
            'is_external' => true,
            'nofollow' => true,
            'custom_attributes' => '',
        ],
        'dynamic' => [
            'active' => true,
        ],
        'label_block' => true,
    ]
);

$repeater->add_control(
    'client_image',
    [
        'label' => esc_html__( 'Client Logo/Image', 'elementor' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'description' => __('The logo image for the client/customer.', 'elementor'),
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
        'dynamic' => [
            'active' => true,
        ],
        'label_block' => true,
    ]
);

    
$this->add_control(
    'clients',
    [
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            [ 'client_image' => Utils::get_placeholder_image_src() ],        
        ],
        'title_field' => '{{{ client_name }}}',
    ]
);
$this->end_controls_section();


  /** repeater controls code updated here by-shyam  */      
        
        $this->start_controls_section(
            'section_styling',
            [
                'label' => __('Clients', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_client_image',
            [
                'label' => __( 'Client Images', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		
		$this->add_control(
			'column_gap',
			[
				'label' => esc_html__( 'Column Gap', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .slick-slide > div ' => 'margin:0px {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
        // $this->add_control(
        //     'client_border_color',
        //     [
        //         'label' => __( 'Client Border Color', 'elementor' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .pt-clients .pt-client' => 'border-color: {{VALUE}} !important;',
        //         ],
        //     ]
        // );
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Client Border ', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-clients .pt-client ',
			]
		);


        $this->add_control(
            'client_hover_bg_color',
            [
                'label' => __( 'Client Hover Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-clients .pt-client .pt-image-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'thumbnail_hover_opacity',
            [
                'label' => __( 'Thumbnail Hover Opacity (%)', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.7,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-clients .pt-client:hover .pt-image-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            'client_padding',
            [
                'label' => __('Client Padding', 'elementor'),
                'description' => __('Padding for the client images.', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .pt-clients .pt-client' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'heading_client_name',
            [
                'label' => __( 'Client Name', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'client_name_color',
            [
                'label' => __( 'Client Name Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-clients .pt-client .pt-client-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'client_name_hover_color',
            [
                'label' => __( 'Client Name Hover Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-clients .pt-client .pt-client-name:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_name_typography',
                'selector' => '{{WRAPPER}} .pt-clients .pt-client .pt-client-name',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label' => __('Carousel Settings', 'elementor'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );
        $this->add_control(
            'arrows',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'elementor'),
                'label_on' => __('Yes', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'label' => __('Prev/Next Arrows?', 'elementor'),
            ]
        );
        $this->add_control(
            'dots',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'elementor'),
                'label_on' => __('Yes', 'elementor'),
                'return_value' => 'yes',
                'default' => 'no',
                'label' => __('Show dot indicators for navigation?', 'elementor'),
            ]
        );
        $this->add_control(
            'pause_on_hover',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'elementor'),
                'label_on' => __('Yes', 'elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'label' => __('Pause on Hover?', 'elementor'),
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('No', 'elementor'),
                'label_on' => __('Yes', 'elementor'),
                'return_value' => 'yes',
                'default' => 'no',
                'label' => __('Autoplay?', 'elementor'),
                'description' => __('Should the carousel autoplay as in a slideshow.', 'elementor'),
            ]
        );
        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay speed in ms', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );
        $this->add_control(
            'animation_speed',
            [
                'label' => __('Autoplay animation speed in ms', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_responsive',
            [
                'label' => __('Responsive Options', 'elementor'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );
        $this->add_control(
            'heading_desktop',
            [
                'label' => __( 'Desktop', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'gutter',
            [
                'label' => __('Gutter', 'elementor'),
                'description' => __('Space between columns.', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .pt-posts-carousel .pt-posts-carousel-item' => 'padding: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_control(
            'display_columns',
            [
                'label' => __('Columns per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            'scroll_columns',
            [
                'label' => __('Columns to scroll', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );
        $this->add_control(
            'heading_tablet',
            [
                'label' => __( 'Tablet', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'tablet_gutter',
            [
                'label' => __('Gutter', 'elementor'),
                'description' => __('Space between columns.', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'selectors' => [
                    '(tablet-){{WRAPPER}} .pt-posts-carousel .pt-posts-carousel-item' => 'padding: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_control(
            'tablet_display_columns',
            [
                'label' => __('Columns per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'tablet_scroll_columns',
            [
                'label' => __('Columns to scroll', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 2,
            ]
        );
        $this->add_control(
            'tablet_width',
            [
                'label' => __('Tablet Resolution', 'elementor'),
                'description' => __('The resolution to treat as a tablet resolution.', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 800,
            ]
        );
        $this->add_control(
            'heading_mobile',
            [
                'label' => __( 'Mobile Phone', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'mobile_gutter',
            [
                'label' => __('Mobile Gutter', 'elementor'),
                'description' => __('Space between columns.', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'selectors' => [
                    '(mobile-){{WRAPPER}} .pt-posts-carousel .pt-posts-carousel-item' => 'padding: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_control(
            'mobile_display_columns',
            [
                'label' => __('Columns per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'mobile_scroll_columns',
            [
                'label' => __('Columns to scroll', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control(
            'mobile_width',
            [
                'label' => __('Mobile Resolution', 'elementor'),
                'description' => __('The resolution to treat as a mobile resolution.', 'livemesh-el-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 480,
            ]
        );
        $this->end_controls_section();
    }
     protected function render() {
        $settings = $this->get_settings_for_display(); 
        $carousel_settings = [
            'arrows' => ('yes' === $settings['arrows']),
            'dots' => ('yes' === $settings['dots']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'autoplay_speed' => absint($settings['autoplay_speed']),
            'animation_speed' => absint($settings['animation_speed']),
            'pause_on_hover' => ('yes' === $settings['pause_on_hover']),
        ];
        $responsive_settings = [
            'display_columns' => $settings['display_columns'],
            'scroll_columns' => $settings['scroll_columns'],
            'gutter' => $settings['gutter'],
            'tablet_width' => $settings['tablet_width'],
            'tablet_display_columns' => $settings['tablet_display_columns'],
            'tablet_scroll_columns' => $settings['tablet_scroll_columns'],
            'tablet_gutter' => $settings['tablet_gutter'],
            'mobile_width' => $settings['mobile_width'],
            'mobile_display_columns' => $settings['mobile_display_columns'],
            'mobile_scroll_columns' => $settings['mobile_scroll_columns'],
            'mobile_gutter' => $settings['mobile_gutter'],
        ];
        $carousel_settings = array_merge($carousel_settings, $responsive_settings);
        ?>
        <?php $num_of_columns = intval($settings['per_line']); ?>
        <?php $column_style = $this->pt_get_column_class($num_of_columns); ?>
          <?php
             if( !empty($settings['pt_img_accordions']) ) :
              ?>
              <div class="pt-img-accordion" id="pt-img-accordion-<?php echo $this->get_id(); ?>">
                <?php foreach( $settings['pt_img_accordions'] as $img_accordion ) :
                    $pt_accordion_link = $img_accordion['pt_accordion_title_link']['url'];
                    $target = $img_accordion['pt_accordion_title_link']['is_external'] ? 'target="_blank"' : '';
                    $nofollow = $img_accordion['pt_accordion_title_link']['nofollow'] ? 'rel="nofollow"' : '';
                ?>
                  <a href="<?php echo esc_url($pt_accordion_link); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> style="background-image: url(<?php echo esc_url($img_accordion['pt_accordion_bg']['url']); ?>);">
                  </a>
                  
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
         <div id="pt-posts-carousel-<?php echo uniqid(); ?>"
                 class="pt-container pt-clients"
                 data-settings='<?php echo wp_json_encode($carousel_settings); ?>'>
      
            <?php $i=444; ?>
            <?php foreach ($settings['clients'] as $client): ?>
             <div data-id="id-<?php echo $i; ?>" class="pt-posts-carousel-item">
               <div class="pt-client">
               <div class="pt-project-image">
               
                    <?php if (!empty($client['client_image'])): ?>
                    
                       <!--   <?php echo wp_get_attachment_image($client['client_image']['id'], 'full', false, array('class' => 'pt-image full', 'alt' => $client['client_name'])); ?>  -->
                       <img src="<?php echo esc_url($client['client_image']['url']); ?>" class="pt-image full" alt="<?php echo $client['client_name']; ?>" > 
                        
                    <?php endif; ?>
                    <?php if (!empty($client['client_link']) && !empty($client['client_link']['url'])): ?>
                        <?php $target = $client['client_link']['is_external'] ? 'target="_blank"' : ''; ?>
                        <div class="pt-client-name">
                            <a href="<?php echo esc_url($client['client_link']['url']); ?>"
                               title="<?php echo esc_html($client['client_name']); ?>"
                                <?php echo $target; ?>><?php echo wp_kses_post($client['client_name']); ?></a>
                        </div>
                    <?php else: ?>
                        <div class="pt-client-name"><?php echo wp_kses_post($client['client_name']); ?></div>
                    <?php endif; ?>
                    <div class="pt-image-overlay"></div>
              </div>
              </div>
                 </div>
                <?php
                $i++;
            endforeach;
            ?>
         </div> <!-- .pt-posts-carousel -->
        
        <?php
    }
    protected function content_template() {
    }
}