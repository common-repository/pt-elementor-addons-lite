<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\StatsBar;
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
class Stats_Bar extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'Pt-stats-bars';
    }
    public function get_title()
    {
        return esc_html__('Stats Bars', 'pt-addons-elementor');
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
            'section_stats_bars',
            [
                'label' => __('Stats Bars', 'elementor'),
            ]
        );



/** Repeater control update with new elementor doc. */
$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'stats_title', [
        'label' => esc_html__( 'Stats Title', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'description' => __('The title for the stats bar', 'elementor'),
        'dynamic' => [
            'active' => true,
        ],
    ]
);
$repeater->add_control(
    'percentage_value',
    [
        'label' => esc_html__( 'Percentage Value', 'elementor' ),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'min' => 1,
        'max' => 100,
        'step' => 1,
        'default' => 30,
        'description' => __('The percentage value for the stats.', 'elementor'),
    ]
);
// $repeater->add_control(
//     'bar_color',
//     [
//         'label' => esc_html__( 'Bar Color', 'elementor' ),
//         'type' => \Elementor\Controls_Manager::COLOR,
//         'default' => '#666666',
//          'selectors' => [
//             '{{WRAPPER}} .pt-stats-bar-wrap .pt-stats-bar-content' => 'background-color: {{VALUE}};'
//          ],
//     ]
// );
	$repeater->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',
				],
			]
		);
		
//{{CURRENT_ITEM}} 
        $this->add_control(
            'stats_bars',
            [
                'label' => esc_html__( 'Status Bar', 'elementor' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stats_title' => __('Web Design', 'elementor'),
                        'percentage_value' => 87,
                    ],
                    [
                        'stats_title' => __('SEO Services', 'elementor'),
                        'percentage_value' => 76,
                    ],
                    [
                        'stats_title' => __('Brand Marketing', 'elementor'),
                        'percentage_value' => 40,
                    ],
                ],
               
                'title_field' => '{{{ stats_title }}}',
            ]
        );
        $this->end_controls_section();

/** Repeater control update with new elementor doc. */

        $this->start_controls_section(
            'section_stats_bar_styling',
            [
                'label' => __('Stats Bar', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'stats_bar_bg_color',
            [
                'label' => __('Stats Bar Background Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'stats_bar_spacing',
            [
                'label' => __('Stats Bar Spacing', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 18,
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 128,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'stats_bar_height',
            [
                'label' => __('Stats Bar Height', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 96,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-bg, {{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-content' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-bg' => 'margin-top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'stats_bar_border_radius',
            [
                'label' => __('Stats Bar Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-bg, {{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-bar-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_stats_title',
            [
                'label' => __('Stats Title', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'stats_title_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stats_title_typography',
                'selector' => '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-title',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_stats_percentage',
            [
                'label' => __('Stats Percentage', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'stats_percentage_spacing',
            [
                'label' => __('Spacing from Stats Title', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 5,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'isLinked' => false
            ]
        );
        $this->add_control(
            'stats_percentage_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-title span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stats_percentage_typography',
                'selector' => '{{WRAPPER}} .pt-stats-bars .pt-stats-bar .pt-stats-title span',
            ]
        );
        $this->end_controls_section();
	}
    protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
        <div class="pt-stats-bars">
            <?php foreach ($settings['stats_bars'] as $stats_bar) :
                $color_style = '';
                $color = $stats_bar['bar_color'];
                if ($color)
                    $color_style = ' style="background:' . esc_attr($color) . ';"';
                ?>
			
                <div class="pt-stats-bar">
                    <div class="pt-stats-title">
                        <?php echo esc_html($stats_bar['stats_title']) ?><span><?php echo esc_attr($stats_bar['percentage_value']); ?>%</span>
                    </div>
                    <div class="pt-stats-bar-wrap">
                        <div <?php echo $color_style; ?> class="pt-stats-bar-content elementor-repeater-item-<?php echo esc_attr( $stats_bar['_id'] ) ?>"
                            data-perc="<?php echo esc_attr($stats_bar['percentage_value']); ?>">
						</div>
                        <div class="pt-stats-bar-bg"></div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
		 <script src="<?php echo PT_PLUGIN_URL. 'assets/front-end/js/stats-bar/bar-widgets.js'; ?>"></script>
        <?php
	}
	protected function content_template() {
		
	}
}