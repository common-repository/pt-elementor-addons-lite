<?php
/**
 * Class Pt Elementor Post Timeline.php
 *
 * @author    Param Themes <paramthemes@gmail.com>
 * @copyright 2018 Param Themes
 * @license   Param Theme
 * @package   Elementor
 * @see       https://www.paramthemes.com
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	/**
	 * Define our Pt Elementor Post Timeline settings.
	 */
class Pt_Elementor_Post_Timeline extends Widget_Base {

	/**
	 * Define our get name settings.
	 */
	public function get_name() {
		return 'pt-post-timeline';
	}
	/**
	 * Define our get title settings.
	 */
	public function get_title() {
		return __( 'Post Timeline', 'elementor' );
	}
	/**
	 * Define our get icon settings.
	 */
	public function get_icon() {
		return 'eicon-post-list';
	}
	/**
	 * Define our get categories settings.
	 */
	public function get_categories() {
		return [ 'pt-elementor-addons' ];
	}
	/**
	 * Define our register_controls settings.
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
            'section_team',
            [
                'label' => __('Timeline Type', 'elementor'),
            ]
        );

        $this->add_control(

            'pt_timeline_type', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Choose Timeline Type', 'elementor'),
                'default' => 'vertical',
                'options' => [
                    'horizontal' => __('Horizontal', 'elementor'),
                    'vertical' => __('Vertical', 'elementor'),
					'horizontal_d' => __('Horizontal-Date', 'elementor'),
                ],
                'prefix_class' => 'pt-team-members-',
            ]
        );
		$this->end_controls_section();

		$this->start_controls_section(
			'pt_section_post_timeline_filters',
			[
				'label' => __( 'Post Settings', 'elementor' ),
			]
		);

		$this->add_control(
			'pt_post_type',
			[
				'label' => __( 'Post Type', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => pt_get_post_types(),
				'default' => 'post',

			]
		);

		$this->add_control(
			'pt_category',
			[
				'label' => __( 'Categories', 'elementor' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => pt_post_type_categories(),
				'condition' => [
					'pt_post_type' => 'post',
				],
			]
		);

		$this->add_control(
			'num_posts',
			[
				'label' => __( 'Number of Posts', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
			]
		);

		$this->add_control(
			'post_offset',
			[
				'label' => __( 'Post Offset', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => pt_get_post_orderby_options(),
				'default' => 'date',

			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'asc' => 'Ascending',
					'desc' => 'Descending',
				],
				'default' => 'desc',

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'pt_section_post_timeline_layout',
			[
				'label' => __( 'Layout Settings', 'elementor' ),
			]
		);

		$this->add_control(
			'pt_show_image',
			[
				'label' => __( 'Show Image', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'elementor' ),
						'icon' => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'elementor' ),
						'icon' => 'eicon-ban',
					],
				],
				'default' => '1',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'exclude' => [ 'custom' ],
				'default' => 'large',
				'condition' => [
					'pt_show_image' => '1',
				],
			]
		);

		$this->add_control(
			'pt_show_title',
			[
				'label' => __( 'Show Title', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'elementor' ),
						'icon' => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'elementor' ),
						'icon' => 'eicon-ban',
					],
				],
				'default' => '1',
			]
		);

		$this->add_control(
			'pt_show_excerpt',
			[
				'label' => __( 'Show excerpt', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'elementor' ),
						'icon' => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'elementor' ),
						'icon' => 'eicon-ban',
					],
				],
				'default' => '1',
			]
		);
		
		$this->add_control(
			'pt_show_date',
			[
				'label' => __( 'Show Date', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => __( 'Yes', 'elementor' ),
						'icon' => 'fa fa-check',
					],
					'0' => [
						'title' => __( 'No', 'elementor' ),
						'icon' => 'eicon-ban',
					],
				],
				'default' => '1',
			]
		);

		$this->add_control(
			'pt_excerpt_length',
			[
				'label' => __( 'Excerpt Words', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '10',
				'condition' => [
					'pt_show_excerpt' => '1',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pt_section_post_timeline_style',
			[
				'label' => __( 'Timeline Style', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pt_timeline_bullet_color',
			[
				'label' => __( 'Timeline Bullet Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#de5034',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-bullet' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_timeline_bullet_border_color',
			[
				'label' => __( 'Timeline Bullet Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-bullet' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_timeline_vertical_line_color',
			[
				'label' => __( 'Timeline Vertical Line Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(83, 85, 86, .2)',
				'selectors' => [
					'{{WRAPPER}} .timeline-line' => 'border-right: 1px solid {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_timeline_border_color',
			[
				'label' => __( 'Arrow Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-inner' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .left-column .pt-timeline-post-inner::after' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .right-column .pt-timeline-post-inner::after' => 'border-right-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pt_timeline_inner_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d0d0d0',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-inner' => 'border: 1px solid {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'pt_timeline_date_background_color',
			[
				'label' => __( 'Post Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-inner , .timeline__content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .pt-timeline-post time::before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pt_timeline_date_color',
			[
				'label' => __( 'Date Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .time' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'pt_section_typography',
			[
				'label' => __( 'Typography', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pt_timeline_title_style',
			[
				'label' => __( 'Title Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pt_timeline_title_color',
			[
				'label' => __( 'Title Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-title h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pt_timeline_title_alignment',
			[
				'label' => __( 'Title Alignment', 'elementor' ),
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
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-title h2' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pt_timeline_title_typography',
				'label' => __( 'Typography', 'elementor' ),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pt-timeline-post-title h2',
			]
		);

		$this->add_control(
			'pt_timeline_excerpt_style',
			[
				'label' => __( 'Excerpt Style', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pt_timeline_excerpt_color',
			[
				'label' => __( 'Excerpt Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-excerpt p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pt_timeline_excerpt_alignment',
			[
				'label' => __( 'Excerpt Alignment', 'elementor' ),
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
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-timeline-post-excerpt p' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pt_timeline_excerpt_typography',
				'label' => __( 'excerpt Typography', 'elementor' ),
				'scheme' => Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .pt-timeline-post-excerpt p',
			]
		);
		$this->end_controls_section();

	}
	/**
	 * Define our Render Display settings.
	 */
	protected function render() {
		$settings = $this->get_settings();
		$post_args = pt_get_post_settings( $settings );
		$posts = pt_get_post_data( $post_args );
		?>
		<?php if($settings['pt_timeline_type'] == 'vertical'){ ?>
		<div id="pt-post-timeline-<?php echo esc_attr( $this->get_id() ); ?>" class="pt-post-timeline">
		<div class="timeline-line"></div>
		 <div class="pt-front-post-timeline" id="timeline">
			<?php
			if ( count( $posts ) ) {
				global $post;
			?>
				<?php
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					
					?>
				  <article class="pt-timeline-post pt-timeline-column">
				 <div class="pt-timeline-bullet"></div>
				 <div class="pt-timeline-post-inner">
				 <?php if ( $settings['pt_show_date'] ) { ?>
					<div class="time"><?php echo get_the_date(); ?></div>
				<?php } ?>
			
			   <a class="pt-timeline-post-link" href="<?php echo  esc_html( get_permalink() ); ?>" title="<?php the_title(); ?>">
				<div class="pt-timeline-post-image">
				<?php			?>
				<?php $imagecheck = 1; ?>
				<?php if ( $imagecheck == $settings['pt_show_image'] ) { 
				if(get_post_thumbnail_id() != '') {
				?>
					<img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), $settings['image_size'] ); ?>">
				<?php } } ?>
				</div>
			   </a>
				<?php if ( $settings['pt_show_title'] ) { ?>
					<div class="pt-timeline-post-title">
						<h2><?php the_title(); ?></h2>
					</div>
				<?php } ?>
				
				<?php if ( $settings['pt_show_excerpt'] ) { ?>
					<div class="pt-timeline-post-excerpt">
						<p><?php echo esc_html( pt_get_excerpt_by_id( get_the_ID(), $settings['pt_excerpt_length'] ) ); ?></p>
					</div>
				<?php } ?>
				 </div>
			   </article>
				<?php
				}
				wp_reset_postdata();
			?>
			<?php
			}
			?>
		 </div>
		</div>
		<?php } 
		if($settings['pt_timeline_type'] == 'horizontal') { ?>
		<div class="timeline" data-mode="horizontal" data-horizontal-start-position="bottom">
    <div class="timeline__wrap">
        <div class="timeline__items">
            
			<?php
			if ( count( $posts ) ) {
				global $post;
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					
					?>
					<div class="timeline__item">
                <div class="timeline__content">
					
				<?php if ( $settings['pt_show_date'] ) { ?>
						<div class="time"><?php echo get_the_date(); ?></div>
				<?php } ?>
				  
			   <a class="pt-timeline-post-link" href="<?php echo  esc_html( get_permalink() ); ?>" title="<?php the_title(); ?>">
				<div class="pt-timeline-post-image">
				<?php			?>
				<?php $imagecheck = 1; ?>
				<?php if ( $imagecheck == $settings['pt_show_image'] ) { 
				if(get_post_thumbnail_id() != '') {
				?>
					<img src="<?php echo wp_get_attachment_image_url( get_post_thumbnail_id(), $settings['image_size'] ); ?>">
				<?php } } ?>
				</div>
			   </a>
				<?php if ( $settings['pt_show_title'] ) { ?>
					<div class="pt-timeline-post-title">
						<h2><?php the_title(); ?></h2>
					</div>
				<?php } ?>
				
				<?php if ( $settings['pt_show_excerpt'] ) { ?>
					<div class="pt-timeline-post-excerpt">
						<p><?php echo esc_html( pt_get_excerpt_by_id( get_the_ID(), $settings['pt_excerpt_length'] ) ); ?></p>
					</div>
				<?php } ?>

			   </div>
                </div>
				<?php
				}
				wp_reset_postdata();
			?>
			<?php
			}
			?>
            
        </div>
    </div>
</div>
		<?php } ?>
		<?php if($settings['pt_timeline_type'] == 'horizontal_d') { ?>
		<section class="cd-horizontal-timeline">
	<div class="timeline">
		<div class="events-wrapper">
			<div class="events">
				<ol>
				
				<?php
			if ( count( $posts ) ) {
				global $post;
				$j=0;
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					
					?>
	
					<?php if ($j == 0){ ?>
					<li><a href="#0" data-date="<?php echo get_the_date("d/m/Y"); ?>" class="selected"><?php echo get_the_date(); ?></a></li>
					<?php } else { ?>
					<li><a href="#0" data-date="<?php echo get_the_date("d/m/Y"); ?>"><?php echo get_the_date(); ?></a></li>
					<?php } ?>
					<?php 
					$j++;
				}
			}	
					?>
				</ol>

				<span class="filling-line" aria-hidden="true"></span>
			</div> <!-- .events -->
		</div> <!-- .events-wrapper -->
			
		<ul class="cd-timeline-navigation">
			<li><a href="#0" class="prev inactive">Prev</a></li>
			<li><a href="#0" class="next">Next</a></li>
		</ul> <!-- .cd-timeline-navigation -->
	</div> <!-- .timeline -->

	<div class="events-content">
		<ol>
			<?php
			if ( count( $posts ) ) {
				global $post;
				$k=0;
				foreach ( $posts as $post ) {
					setup_postdata( $post );
					
					?>
			<?php if ($k == 0){ ?>
			<li class="selected" data-date="<?php echo get_the_date("d/m/Y"); ?>">
				<h2><?php the_title(); ?></h2>
				<em><?php echo get_the_date(); ?></em>
				<p>	
					<?php echo esc_html( pt_get_excerpt_by_id( get_the_ID(), $settings['pt_excerpt_length'] ) ); ?>
				</p>
			</li>
			<?php } else { ?>
			<li data-date="<?php echo get_the_date("d/m/Y"); ?>">
				<h2><?php the_title(); ?></h2>
				<em><?php echo get_the_date(); ?></em>
				<p>	
					<?php echo esc_html( pt_get_excerpt_by_id( get_the_ID(), $settings['pt_excerpt_length'] ) ); ?>
				</p>
			</li>
<?php 
		}
					$k++;
				}
			}
					
					?>
			
		</ol>
	</div> <!-- .events-content -->
</section>
		
		
		<?php } ?>
		<script>
		jQuery(function($){
			timeline(document.querySelectorAll('.timeline'));
		});
		</script>
		<script>
		jQuery(function($){
			var $grid = $('#timeline');
			$grid.imagesLoaded( function() {
			$grid.masonry({
			itemSelector: '.pt-timeline-column',
			percentPosition: true,
			columnWidth: 20,
			gutter: 25,
			isAnimated : false
	   });
		$(".pt-timeline-column").each( function() {
			 var position = $(this).position();
			 if( position.left == 0) {
			  $(this).addClass('left-column');
			 } else {
			  $(this).addClass('right-column');
			 }
			});
			});
		});
		</script>
		<?php
	}
	/**
	 * Define our Content template settings.
	 */
	protected function content_template() {
		?>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Pt_Elementor_Post_Timeline() );
