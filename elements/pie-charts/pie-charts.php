<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\PieCharts;
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
class Pie_Charts extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'Pt-pie-charts';
    }
    public function get_title()
    {
        return esc_html__('Pie Charts', 'pt-addons-elementor');
    }
    public function get_icon()
    {
        return 'eicon-counter-circle';
    }
    public function get_categories()
    {
        return ['pt-addons-elementor'];
    }
	
/**
	 * Define our register_controls settings.
	 */
	protected function _register_controls() {
		$this->start_controls_section(
            'section_piecharts',
            [
                'label' => __('Piecharts', 'elementor'),
            ]
        );
        $this->add_control(
            'per_line',
            [
                'label' => __('Piecharts per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 4,
            ]
        );
/**repeater controle update here  */
$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'stats_title', [
        'label' => esc_html__( 'Stats Title', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'description' => __('The title for the piechart', 'elementor'),
        'label_block' => true,
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
        'description' => __('The percentage value for the stats.', 'livemesh-el-addons'),
    ]
);
        $this->add_control(
            'piecharts',
            [
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
                        'stats_title' => __('WordPress Development', 'elementor'),
                        'percentage_value' => 90,
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

/**repeater controle update here  */


        $this->start_controls_section(
            'section_styling',
            [
                'label' => __('Piechart Styling', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'bar_color',
            [
                'label' => __('Bar color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
            ]
        );
        $this->add_control(
            'track_color',
            [
                'label' => __('Track color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#dddddd',
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
                    '{{WRAPPER}} .pt-piechart .pt-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stats_title_typography',
                'selector' => '{{WRAPPER}} .pt-piechart .pt-label',
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
            'stats_percentage_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-piechart .pt-percentage span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stats_percentage_typography',
                'selector' => '{{WRAPPER}} .pt-piechart .pt-percentage span',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_stats_percentage_symbol',
            [
                'label' => __('Stats Percentage Symbol', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'stats_percentage_symbol_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-piechart .pt-percentage sup' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stats_percentage_symbol_typography',
                'selector' => '{{WRAPPER}} .pt-piechart .pt-percentage sup',
            ]
        );
	
	
	}
	/**
	 * Define our Rendor Display settings.
	 */
	protected function render() {
		$settings = $this->get_settings();
        ?>
        <?php $column_style = $this->pt_get_column_class(intval($settings['per_line'])); ?>
        <?php
        $bar_color = ' data-bar-color="' . esc_attr($settings['bar_color']) . '"';
        $track_color = ' data-track-color="' . esc_attr($settings['track_color']) . '"';
        ?>
        <div class="pt-piecharts pt-grid-container">
            <?php foreach ($settings['piecharts'] as $piechart): ?>
                <div class="pt-piechart <?php echo $column_style; ?>">
                    <div class="pt-percentage" <?php echo $bar_color; ?> <?php echo $track_color; ?>
                         data-percent="<?php echo round($piechart['percentage_value']); ?>">
                        <span><?php echo round($piechart['percentage_value']); ?><sup>%</sup></span>
                    </div>
                    <div class="pt-label"><?php echo esc_html($piechart['stats_title']); ?></div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <div class="pt-clear"></div>
		 <script src="<?php echo PT_PLUGIN_URL. 'assets/front-end/js/pie-charts/bar-widgets.js'; ?>"></script>
		 <script src="<?php echo PT_PLUGIN_URL. 'assets/front-end/js/pie-charts/jquery.stats.js'; ?>"></script>
		 <script src="<?php echo PT_PLUGIN_URL. 'assets/front-end/js/pie-charts/index.js'; ?>"></script>
        <?php
	}
	/**
	 * Define our Content template settings.
	 */
	
}