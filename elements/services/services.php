<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\Services;
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
class Services extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'pt-services';
    }
    public function get_title()
    {
        return esc_html__('Services', 'pt-addons-elementor');
    }
    public function get_icon()
    {
        return 'eicon-skill-bar';
    }
    public function get_categories()
    {
        return ['pt-addons-elementor'];
    }
	
	/**
	 * Define our _register_controls settings.
	 */
	protected function _register_controls() {
        $this->start_controls_section(
            'section_services',
            [
                'label' => __('Services', 'elementor'),
            ]
        );
        $this->add_control(
            'style',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __('Choose Style', 'elementor'),
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1', 'elementor'),
                    'style2' => __('Style 2', 'elementor'),
                    'style3' => __('Style 3', 'elementor'),
                ],
                'prefix_class' => 'pt-services-',
            ]
        );
        $this->add_control(
            'per_line',
            [
                'label' => __('Columns per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );

        /** Repeater control updated here by-shyam  */

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'service_title', [
				'label' => esc_html__( 'Service Title', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'My service title' , 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'icon_type',
			[
				'label' => esc_html__( 'Icon Type', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
                'options' => [
                    'none' => __('None', 'elementor'),
                    'icon' => __('Icon', 'elementor'),
                    'icon_image' => __('Icon Image', 'elementor'),
                ],
			]
		);

        $repeater->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Service Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'label_block' => true,
                'condition' => [
                    'icon_type' => 'icon_image',
                ],
                'dynamic' => [
                    'active' => true,
                ],
			]
		);

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Service Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
                'default' => '',
                'condition' => [
                    'icon_type' => 'icon',
                ],
			]
		);
        $repeater->add_control(
			'service_excerpt', [
				'label' => esc_html__( 'Service description', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Service description goes here', 'elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
			]
		);
            
    

        $this->add_control(
            'services',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => __('Web Design', 'elementor'),
                        'icon_type' => 'icon',
                        'icon' => 'fa fa-undo',
                        'service_excerpt' => 'Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Donec venenatis vulputate lorem. In hac habitasse aliquam.',
                    ],
					[
                        'service_title' => __('Web Development', 'elementor'),
                        'icon_type' => 'icon',
                        'icon' => 'fa fa-toggle-off',
                        'service_excerpt' => 'Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Etiam ut purus mattis mauris sodales.',
                    ],
                    [
                        'service_title' => __('SEO Services', 'elementor'),
                        'icon_type' => 'icon',
                        'icon' => 'fa fa-laptop',
                        'service_excerpt' => 'Suspendisse nisl elit, rhoncus eget, elementum ac, condimentum eget, diam. Phasellus nec sem in justo pellentesque facilisis platea dictumst.',
                    ],
                    
                ],
                
                'title_field' => '{{{ service_title }}}',
            ]
        );
        $this->end_controls_section();

 
        /** Repeater control updated here by-shyam  */
        $this->start_controls_section(
            'section_service_title',
            [
                'label' => __('Service Title', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __( 'H1', 'elementor' ),
                    'h2' => __( 'H2', 'elementor' ),
                    'h3' => __( 'H3', 'elementor' ),
                    'h4' => __( 'H4', 'elementor' ),
                    'h5' => __( 'H5', 'elementor' ),
                    'h6' => __( 'H6', 'elementor' ),
                    'div' => __( 'div', 'elementor' ),
                ],
                'default' => 'h3',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-services .pt-service .pt-service-text .pt-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .pt-services .pt-service .pt-service-text .pt-title',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_service_text',
            [
                'label' => __('Service Text', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-services .pt-service .pt-service-text .pt-service-details' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .pt-services .pt-service .pt-service-text .pt-service-details',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_service_icon',
            [
                'label' => __('Service Icons', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon or Icon Image size in pixels', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-services .pt-service .pt-image-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pt-services .pt-service .pt-icon-wrapper span' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Custom Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-services .pt-service .pt-icon-wrapper span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_color',
            [
                'label' => __('Icon Hover Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-services .pt-service .pt-icon-wrapper span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <?php $column_style = $this->pt_get_column_class(intval($settings['per_line'])); ?>
        <div class="pt-services pt-<?php echo $settings['style']; ?> pt-grid-container">
            <?php foreach ($settings['services'] as $service): ?>
                <div class="pt-service-wrapper <?php echo $column_style; ?>">
                    <div class="pt-service">
                        <?php if ($service['icon_type'] == 'icon_image') : ?>
                            <?php $icon_image = $service['icon_image']; ?>
                            <?php if (!empty($icon_image)): ?>
                                <div class="pt-image-wrapper">
                                    <?php echo wp_get_attachment_image($icon_image['id'], 'full', false, array('class' => 'pt-image full')); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($service['icon_type'] == 'icon') : ?>
                            <div class="pt-icon-wrapper">
                                <span class="<?php echo esc_attr($service['icon']); ?>"></span>
                            </div>
                        <?php endif; ?>
                        <div class="pt-service-text">
                            <<?php echo $settings['title_tag']; ?> class="pt-title"><?php echo esc_html($service['service_title']) ?></<?php echo $settings['title_tag']; ?>>
                            <div class="pt-service-details"><?php echo do_shortcode(wp_kses_post($service['service_excerpt'])); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <div class="pt-clear"></div>
        <?php
    }
    protected function content_template() {
    }
}