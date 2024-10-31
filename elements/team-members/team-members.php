<?php
namespace Elementor;
namespace Pt_Addons_Elementor\Elements\TeamMembers;
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
class Team_Members extends Widget_Base
{
    use \Pt_Addons_Elementor\Includes\Triat\Helper;
    public function get_name()
    {
        return 'Pt-team-members';
    }
    public function get_title()
    {
        return esc_html__('Team Members', 'pt-addons-elementor');
    }
    public function get_icon()
    {
        return 'eicon-person';
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
            'section_team',
            [
                'label' => __('Team', 'elementor'),
            ]
        );
    

        $this->add_control(
            'style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Choose Team Style', 'elementor'),
                'default' => 'style1',
                'options' => [
                    'style1' => __('Style 1', 'elementor'),
                    'style2' => __('Style 2', 'elementor'),
					'style3' => __('Style 3', 'elementor'),
					'style4' => __('Style 4', 'elementor'),
                ],
                'prefix_class' => 'pt-team-members-',
            ]
        );
        $this->add_control(
            'per_line',
            [
                'label' => __('Columns per row', 'elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
                'condition' => [
                    'style' => 'style1',
                ],
            ]
        );
      
/** Repeater control new formate code inserted here   */
$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'member_name', [
        'label' => esc_html__( 'Member Name', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Member 1' , 'elementor' ),
        'label_block' => true,
    ]
);
$repeater->add_control(
    'member_position', [
        'label' => esc_html__( 'Position', 'elementor' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => esc_html__( 'Team Leader' , 'elementor' ),
        'label_block' => true,
    ]
);

$repeater->add_control(
    'member_image', [

        'label' => esc_html__( 'Team Member Image', 'elementor' ),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' =>"https://v2websolutions.com/wp-content/uploads/2021/09/CTA-Home-page-New.png",
        ],
    ]
);
		
$repeater->add_control(
    'member_details', [
        'label' => esc_html__( 'Content', 'plugin-name' ),
        'type' => \Elementor\Controls_Manager::WYSIWYG,
        'default' => esc_html__('I am member details. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor'),
        'show_label' => false,
    ]
);




   $repeater->add_control(
        'link',
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
        ]
    );

    $repeater->add_control(
        'social_new-pt',
        [
            'label' => esc_html__( 'Icon', 'elementor'),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'social',
            'default' => [
                'value' => 'fab fa-twitter',
                'library' => 'fa-brands',
            ],
            'label_block' => true,
        ]
    );
    $repeater->add_control(
        'link-2',
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
        ]
    );

    $repeater->add_control(
        'social-pt2',
        [
            'label' => esc_html__( 'Icon', 'elementor'),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'social',
            'default' => [
                'value' => 'fab fa-instagram',
                'library' => 'fa-brands',
            ],
            'label_block' => true,
        ]
    );

    $repeater->add_control(
        'link-3',
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
        ]
    );
        $repeater->add_control(
        'social-pt3',
        [
            'label' => esc_html__( 'Icon', 'elementor'),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'social',
            'default' => [
                'value' => 'fab fa-instagram',
                'library' => 'fa-brands',
            ],
            'label_block' => true,
        ]
    );
  /** Repeater control new formate code inserted here   */      
        $this->add_control(
            
            'team_members',
            [
                'label' => __('Team Members', 'elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'separator' => 'before',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => __('Team Member #1', 'elementor'),
                        'member_position' => __('CEO', 'elementor'),
                        'member_details' => __('I am member details. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor'),
                        'social' => 'fa fa-facebook',
                        'social_new-pt'=>'twitter',
                    ],
                    [
                        'member_name' => __('Team Member #2', 'elementor'),
                        'member_position' => __('Lead Developer', 'elementor'),
                        'member_details' => __('I am member details. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor'),
                        'social' => 'fa fa-facebook',
                        'social_new-pt'=>'twitter',

                    ],
                    [
                        'member_name' => __('Team Member #2', 'elementor'),
                        'member_position' => __('Lead Developer', 'elementor'),
                        'member_details' => __('I am member details. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor'),
                        'social' => 'fa fa-facebook',
                        'social_new-pt'=>'twitter',
                                                
                    ],
              
                ],
                
                'title_field' => '{{{ member_name }}}',
            ]
        );
        $this->end_controls_section();







//repeater code end here 
/** social media section using repeater here  */


/** social media section using repeater here  */
        $this->start_controls_section(
            'section_team_profiles_style',
            [
                'label' => __('General', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            ]
        );
	
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .pt-team-member-wrapper.pt-fourcol',
				'condition' => [
                    'style' => ['style3'],
					'style' => ['style4'],
                ],
			]
		);
	
        $this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pt-team-member-wrapper.pt-fourcol' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    'style' => ['style3'],
					'style' => ['style4'],
                ],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .pt-team-member-wrapper.pt-fourcol',
				'condition' => [
                    'style' => ['style3'],
					'style' => ['style4'],
                ],
			]
		);
        $this->add_responsive_control(
            'team_member_spacing',
            [
                'label' => __('Team Member Spacing', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'isLinked' => false,
                'condition' => [
                    'style' => ['style2'],
                ],
            ]
        );
        $this->add_responsive_control(
            'thumbnail_hover_brightness',
            [
                'label' => __('Thumbnail Hover Brightness (%)', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                ],
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 1,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .pt-image-wrapper:hover' => '-webkit-filter: brightness({{SIZE}}%);-moz-filter: brightness({{SIZE}}%);-ms-filter: brightness({{SIZE}}%); filter: brightness({{SIZE}}%);',
                ],
            ]
        );
        $this->add_control(
            'thumbnail_border_radius',
            [
                'label' => __('Thumbnail Border Radius', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_team_member_title',
            [
                'label' => __('Member Title', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __('H1', 'elementor'),
                    'h2' => __('H2', 'elementor'),
                    'h3' => __('H3', 'elementor'),
                    'h4' => __('H4', 'elementor'),
                    'h5' => __('H5', 'elementor'),
                    'h6' => __('H6', 'elementor'),
                    'div' => __('div', 'elementor'),
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt-team-member .pt-team-member-text .pt-title' => 'color: {{VALUE}}'
				],
			]
		);

        // $this->add_control(
        //     'title_color',
        //     [
        //         'label' => __('Color', 'elementor'),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .pt-team-member .pt-team-member-text .pt-title ' => 'color: {{VALUE}};',
        //         ],
        //     ]
        // );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .pt-team-members .pt-team-member .pt-team-member-text .pt-title',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_team_member_position',
            [
                'label' => __('Member Position', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'position_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-team-member-text .pt-team-member-position' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .pt-team-members .pt-team-member .pt-team-member-text .pt-team-member-position',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_team_member_details',
            [
                'label' => __('Member Details', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __('Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-team-member-details' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .pt-team-members .pt-team-member .pt-team-member-details',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_social_icon_styling',
            [
                'label' => __('Social Icons', 'elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'social_icon_size',
            [
                'label' => __('Icon size in pixels', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 128,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_control(
            'social_icon_spacing',
            [
                'label' => __('Spacing', 'elementor'),
                'description' => __('Space between icons.', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 0,
                    'right' => 15,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'isLinked' => false
            ]
        );
        $this->add_control(
            'social_icon_color',
            [
                'label' => __('Icon Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item i' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
			'icon_primary_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item i' => 'background-color: {{VALUE}};',
				],
				'condition' => [
                    'style' => ['style3'],
					'style' => ['style4'],
                ],
			]
		);
		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    'style' => ['style3'],
					'style' => ['style4'],
                ],
			]
		);
        $this->add_control(
            'social_icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt-team-members .pt-team-member .pt-social-list .pt-social-list-item i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
	}
	/**
	 * Define our Render Display settings.
	 */
	protected function render( ) {
		
   	
		 $settings = $this->get_settings();
        ?>
        <?php $column_style = ''; ?>
        <?php $container_style = 'pt-container'; ?>
        <?php if ($settings['style'] == 'style1'): ?>
            <?php $column_style = $this->pt_get_column_class(intval($settings['per_line'])); ?>
            <?php $container_style = 'pt-grid-container'; ?>
        <?php endif; ?>
		<?php if ($settings['style'] == 'style3' || $settings['style'] == 'style4' ): ?>
            <?php $column_style = $this->pt_get_column_class(intval($settings['per_line'])); ?>
            <?php $container_style = 'pt-grid-container'; ?>
        <?php endif; ?>
        <div class="pt-team-members pt-<?php echo $settings['style']; ?> <?php echo $container_style; ?>">
            <?php foreach ($settings['team_members'] as $team_member): ?>
				<?php if ($settings['style'] == 'style3' || $settings['style'] == 'style4'){ ?>
                <div class="pt-team-member-wrapper <?php echo $column_style; ?>" style="padding:20px;">
				<?php }else { ?>
				<div class="pt-team-member-wrapper <?php echo $column_style; ?>">
				<?php } ?>
                    <div class="pt-team-member">
					
						 <?php if ($settings['style'] == 'style4'): ?>
						 <div style="text-align:center">
                         <?php echo "<{$settings['title_tag']} class='pt-title'>".$team_member['member_name']."</".$settings['title_tag'].">"; ?>
							<div class="pt-team-member-position">
                                <?php echo do_shortcode($team_member['member_position']) ?>
                            </div>
							</div>
						 
						  <?php endif; ?>
						 
                        <div class="pt-image-wrapper">
                            <?php $member_image = $team_member['member_image']; ?>
                            <?php if (!empty($member_image)): ?>
                                <?php echo wp_get_attachment_image($member_image['id'], 'full', false, array('class' => 'pt-image full')); ?>
                            <?php endif; ?>
							 <?php if ($settings['style'] == 'style1'): ?>
                                <?php $this->social_profile($team_member) ?>
                                      
                      
                             
                            <?php endif; ?>
                        </div>
                        <div class="pt-team-member-text">
							<?php if ($settings['style'] == 'style4'){ ?>
							
							<?php }else { ?>
                           
							<?php echo "<{$settings['title_tag']} class='pt-title'>".$team_member['member_name']."</".$settings['title_tag'].">"; ?>
                     

                            <div class="pt-team-member-position">
                                <?php echo do_shortcode($team_member['member_position']) ?>
                            </div>
							<?php } ?>
                            <div class="pt-team-member-details">
                                <?php echo do_shortcode($team_member['member_details']) ?>
                            </div>
                            <?php if ($settings['style'] == 'style2'): ?>

                                <?php $this->social_profile($team_member) ?>

                            <?php endif; ?>
							 <?php if ($settings['style'] == 'style3'): ?>

                                <?php $this->social_profile($team_member) ?>

                            <?php endif; ?>
							 <?php if ($settings['style'] == 'style4'): ?>
								<div style="text-align:center;margin: 0 auto;">

                                <?php $this->social_profile($team_member) ?>

								</div>
                            <?php endif; ?>
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
    
    private function social_profile($team_member) {
        ?>
        <div class="pt-social-wrap">
            <div class="pt-social-list">
                <?php
				
				$settings = $this->get_settings();
			
					?>
					<div class="pt-social-list-item ">
                    <a  href="<?php echo  $team_member['link']['url']; ?>" <?php if($team_member['link']['is_external'] == true)echo "target='_blank'"; if( $team_member['link']['nofollow']==true)echo 'rel="nofollow"'; ?> >
						      
                                <?php \Elementor\Icons_Manager::render_icon( $team_member['social_new-pt'], [ 'aria-hidden' => 'true' ] ); ?>
					            </a>

            				
					</div>
                    <div class="pt-social-list-item ">
                    <a  href="<?php echo  $team_member['link-2']['url']; ?>" <?php if($team_member['link-2']['is_external'] == true)echo "target='_blank'"; if( $team_member['link-2']['nofollow']==true)echo 'rel="nofollow"'; ?>  >
						      
                                <?php \Elementor\Icons_Manager::render_icon( $team_member['social-pt2'], [ 'aria-hidden' => 'true' ] ); ?>
					            </a>

            				
					</div>
                    <div class="pt-social-list-item ">
                    <a  href="<?php echo  $team_member['link-3']['url']; ?>" <?php if($team_member['link-3']['is_external'] == true)echo "target='_blank'"; if( $team_member['link-3']['nofollow']==true)echo 'rel="nofollow"'; ?>  >
						      
                                <?php \Elementor\Icons_Manager::render_icon( $team_member['social-pt3'], [ 'aria-hidden' => 'true' ] ); ?>
					            </a>

            				
					</div>
			
            </div>
        </div>
        <?php
    }
   
}