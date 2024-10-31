<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\DataTable;
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
class Data_Table extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'Pt-data-table';
    }
    public function get_title()
    {
        return esc_html__('Data Table', 'pt-addons-elementor');
    }
    public function get_icon()
    {
        return 'eicon-table';
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
  		 * Data Table Header
  		 */
  		$this->start_controls_section(
  			'pt_section_data_table_header',
  			[
  				'label' => esc_html__( 'Header', 'elementor' )
  			]
  		);
		
		$this->add_control(
		  'pt_section_data_table_enabled',
		  	[
				'label' => __( 'Enable Table Sorting', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'false',
				'label_on' => esc_html__( 'Yes', 'elementor' ),
				'label_off' => esc_html__( 'No', 'elementor' ),
				'return_value' => 'true',
		  	]
		);

	/** old repeater replaced by new code by shyam */
	$repeater = new \Elementor\Repeater();

		
	$repeater->add_control(
		'pt_data_table_header_col', [
			'label' => esc_html__( 'Column Name', 'elementor' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( 'Table Header' , 'elementor' ),
			'label_block' => false,
		]
	);
	$repeater->add_control(
		'pt_data_table_header_col_icon_enabled',
		[
			'label' => esc_html__( 'Enable Header Icon', 'elementor' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'Show', 'elementor' ),
			'label_off' => esc_html__( 'Hide', 'elementor' ),
			'return_value' => 'true',
			'default' => 'false',
		]
	);
	$repeater->add_control(
		'pt_data_table_header_col_icon',
		[
			'label' => esc_html__( 'Icons', 'elementor' ),
			'type' => \Elementor\Controls_Manager::ICON,
			'default' => '',
			'condition' => [
				'pt_data_table_header_col_icon_enabled' => 'true'
			]
		]
	);
	$repeater->add_control(
		'pt_data_table_header_col_img_enabled',
		[
			'label' => esc_html__( 'Enable Header Image', 'elementor' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'label_on' => esc_html__( 'yes', 'elementor' ),
			'label_off' => esc_html__( 'no', 'elementor' ),
			'default' => 'false',
			'return_value' => 'true',
		]
	);
	
	$repeater->add_control(
		'pt_data_table_header_col_img',
		[
			'label' => esc_html__( 'Choose Image', 'elementor' ),
			'type' => \Elementor\Controls_Manager::MEDIA,
			'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'pt_data_table_header_col_img_enabled' => 'true',
			],
		]
	);
	$repeater->add_control(
		'pt_data_table_header_col_img_size', [
			'label' => esc_html__( 'Image Size(px)', 'elementor' ),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => esc_html__( '25' , 'elementor' ),
			'label_block' => true,
			'condition' => [
				'pt_data_table_header_col_img_enabled' => 'true',
			]
		]
	);

		
	/** old repeater replaced by new code by shyam */	
		$this->add_control(
			'pt_data_table_header_cols_data',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'seperator' => 'before',
				'default' => [
					[ 'pt_data_table_header_col' => 'Table Header' ],
					[ 'pt_data_table_header_col' => 'Table Header' ],
					[ 'pt_data_table_header_col' => 'Table Header' ],
					[ 'pt_data_table_header_col' => 'Table Header' ],
				],
				
				'title_field' => '{{pt_data_table_header_col}}',
			]
		);
		$this->end_controls_section();
		
		/**
  		 * Data Table Content repeater content shyam
  		 */
		  $repeater = new \Elementor\Repeater();
		
		  $repeater->add_control(
			'pt_data_table_content_row_type',
			[
				'label' => esc_html__( 'Add Row/Col-', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'row',
				'options' => [
					'row'  => esc_html__( 'row', 'elementor' ),
					'col' => esc_html__( 'col', 'elementor' ),
				],
			]
		);
		$repeater->add_control(
			'pt_data_table_content_row_title',
			[
				'label' => esc_html__( 'Cell Text', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default Content', 'elementor' ),
				'condition' => [
					'pt_data_table_content_row_type' => 'col'
				],
			]
		);
		$repeater->add_control(
			'pt_data_table_content_row_title_link',
			[
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
				'condition' => [
					'pt_data_table_content_row_type' => 'col'
				],
			]
		);
		
		// 	[
		// 		'name' => 'pt_data_table_content_row_title_link',
		// 		'label' => esc_html__( 'Link', 'elementor' ),
		// 		'type' => Controls_Manager::URL,
		// 		'label_block' => true,
		// 		'default' => [
		// 			'url' => '',
		// 			'is_external' => '',
		// 		 ],
		// 		 'show_external' => true,
		// 		 'separator' => 'before',
		// 		 'condition' => [
		// 			'pt_data_table_content_row_type' => 'col'
		// 		]
		// 	]
		// ],



  		$this->start_controls_section(
  			'pt_section_data_table_cotnent',
  			[
  				'label' => esc_html__( 'Content', 'elementor' )
  			]
  		);
  		$this->add_control(
			'pt_data_table_content_rows',
			[
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'seperator' => 'before',
				'default' => [
					[ 'pt_data_table_content_row_type' => 'row' ],
					[ 'pt_data_table_content_row_type' => 'col' ],
					[ 'pt_data_table_content_row_type' => 'col' ],
					[ 'pt_data_table_content_row_type' => 'col' ],
					[ 'pt_data_table_content_row_type' => 'col' ],
				],
				
				'title_field' => '{{pt_data_table_content_row_type}}::{{pt_data_table_content_row_title}}',
			]
		);
  		$this->end_controls_section();
  		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_data_table_style_settings',
			[
				'label' => esc_html__( 'General Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'pt_data_table_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-data-table-wrap' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'pt_data_table_container_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-data-table-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'pt_data_table_container_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-data-table-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'pt_data_table_border',
					'label' => esc_html__( 'Border', 'elementor' ),
					'selector' => '{{WRAPPER}} .pt-data-table-wrap',
				]
		);
		$this->add_control(
			'pt_data_table_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-data-table-wrap' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		$this->add_responsive_control(
			'pt_data_table_th_padding',
			[
				'label' => esc_html__( 'Table Header Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-data-table thead tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_responsive_control(
			'pt_data_table_td_padding',
			[
				'label' => esc_html__( 'Table Data Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
	 					'{{WRAPPER}} .pt-data-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	 			],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pt_data_table_shadow',
				'selector' => '{{WRAPPER}} .pt-data-table-wrap',
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Header Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_data_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'pt_section_data_table_header_radius',
			[
				'label' => esc_html__( 'Header Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 7,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-data-table thead tr th:first-child' => 'border-radius: {{SIZE}}px 0px 0px 0px;',
					'{{WRAPPER}} .pt-data-table thead tr th:last-child' => 'border-radius: 0px {{SIZE}}px 0px 0px;',
				],
			]
		);
		$this->add_control(
			'pt_data_table_header_title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-data-table thead tr th' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting_asc:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} table.dataTable thead .sorting_desc:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_data_table_header_title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#007fc0',
				'selectors' => [
					'{{WRAPPER}} .pt-data-table thead tr th' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'pt_data_table_header_title_typography',
				'selector' => '{{WRAPPER}} .pt-data-table thead tr th',
			]
		);
		$this->add_responsive_control(
			'pt_data_table_header_title_alignment',
			[
				'label' => esc_html__( 'Title Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'pt-dt-th-align-',
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'pt_section_data_table_content_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'pt_data_table_content_color_odd',
			[
				'label' => esc_html__( 'Color ( Even Row )', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt-data-table tbody > tr:nth-child(2n) td' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_data_table_content_bg_odd_color',
			[
				'label' => esc_html__( 'Background Color (Even Row)', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .pt-data-table tbody > tr:nth-child(2n) td' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_data_table_content_color_even',
			[
				'label' => esc_html__( 'Color ( Odd Row )', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .pt-data-table tbody > tr:nth-child(2n+1) td' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_data_table_content_bg_even_color',
			[
				'label' => esc_html__( 'Background Color (Odd Row)', 'elementor' ),
				'type' => Controls_Manager::COLOR,
			
				'selectors' => [
					'{{WRAPPER}} .pt-data-table tbody > tr:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'pt_data_table_content_typography',
				'selector' => '{{WRAPPER}} .pt-data-table tbody tr td',
			]
		);
		$this->add_control(
			'pt_data_table_content_link_typo',
			[
				'label' => esc_html__( 'Link Color', 'elementor' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		/* Table Content Link */
		$this->start_controls_tabs( 'pt_data_table_link_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'pt_data_table_link_normal', [ 'label' => esc_html__( 'Normal', 'elementor' ) ] );
			$this->add_control(
				'pt_data_table_link_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#c15959',
					'selectors' => [
						'{{WRAPPER}} .pt-data-table-wrap table td a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab( 'pt_data_table_link_hover', [ 'label' => esc_html__( 'Hover', 'elementor' ) ] );
			$this->add_control(
				'pt_data_table_link_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#6d7882',
					'selectors' => [
						'{{WRAPPER}} .pt-data-table-wrap table td:hover' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->end_controls_tab();
			
		$this->end_controls_tabs();


		$this->add_responsive_control(
			'pt_data_table_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'pt-dt-td-align-',
			]
		);
	}
	protected function render( ) {
		$settings = $this->get_settings();
	  	$table_tr = [];
		$table_td = [];
	  	// Storing Data table content values
	  	foreach( $settings['pt_data_table_content_rows'] as $content_row ) {
	  		$row_id = rand(10, 1000);
	  		if( $content_row['pt_data_table_content_row_type'] == 'row' ) {
	  			$table_tr[] = [
	  				'id' => $row_id,
	  				'type' => $content_row['pt_data_table_content_row_type'],
	  			];
	  		}
	  		if( $content_row['pt_data_table_content_row_type'] == 'col' ) {
	  			$target = $content_row['pt_data_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
	  			$nofollow = $content_row['pt_data_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';
	  			$table_tr_keys = array_keys( $table_tr );
	  			$last_key = end( $table_tr_keys );
	  			$table_td[] = [
	  				'row_id' => $table_tr[$last_key]['id'],
	  				'type' => $content_row['pt_data_table_content_row_type'],
	  				'title' => $content_row['pt_data_table_content_row_title'],
	  				'link_url' => $content_row['pt_data_table_content_row_title_link']['url'],
	  				'link_target' => $target,
	  				'nofollow' => $nofollow
	  			];
	  		}
	  	}
	  	$table_th_count = count($settings['pt_data_table_header_cols_data']);
	  	?>
		<div class="pt-data-table-wrap">
			<table id="pt-data-table-<?php echo $this->get_id(); ?>" class="tablesorter pt-data-table">
			    <thead>
			        <tr class="table-header">
			        	<?php foreach( $settings['pt_data_table_header_cols_data'] as $header_title ) : ?>
			            <th class="sorting">
			            	<?php if( $header_title['pt_data_table_header_col_icon_enabled'] == 'true' ) : ?>
			            		<i class="data-header-icon <?php echo esc_attr( $header_title['pt_data_table_header_col_icon'] ); ?>"></i>
			            	<?php endif; ?>
			            	<?php if( $header_title['pt_data_table_header_col_img_enabled'] == 'true' ) : ?>
			            		<img src="<?php echo esc_url( $header_title['pt_data_table_header_col_img']['url'] ) ?>" class="pt-data-table-th-img" style="width:<?php echo $header_title['pt_data_table_header_col_img_size'] ?>px" alt="<?php echo esc_attr( $header_title['pt_data_table_header_col'] ); ?>">
			            	<?php endif; ?>
			            	<?php echo esc_html__( $header_title['pt_data_table_header_col'], 'elementor' ); ?>
			            </th>
			        	<?php endforeach; ?>
			        </tr>
			    </thead>
			  	<tbody>
					<?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
						<tr>
							<?php
								for( $j = 0; $j < count( $table_td ); $j++ ) {
									if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ) {
										?>
										<?php if( !empty( $table_td[$j]['link_url'] ) ) : ?>
											<td>
												<a href="<?php echo esc_attr( $table_td[$j]['link_url'] ); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo $table_td[$j]['title']; ?></a>
											</td>
										<?php else: ?>
											<td><?php echo $table_td[$j]['title']; ?></td>
										<?php endif; ?>
										<?php
									}
								}
							?>
						</tr>
			        <?php endfor; ?>
			    </tbody>
			</table>
		</div>
	  	<?php
   		
	}
}