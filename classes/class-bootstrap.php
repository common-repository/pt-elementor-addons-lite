<?php
/**
 * PTAEL Boostrap.
 *
 * @package PTAEL
 */

namespace Pt_Addons_Elementor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Boostrap Class.
 *
 * @package PTAEL
 */
class Bootstrap {

	use \Pt_Addons_Elementor\Includes\Triat\Library;
	use \Pt_Addons_Elementor\Includes\Triat\Shared;
	use \Pt_Addons_Elementor\Includes\Triat\Core;
	use \Pt_Addons_Elementor\Includes\Triat\Helper;
	use \Pt_Addons_Elementor\Includes\Triat\Generator;
	use \Pt_Addons_Elementor\Includes\Triat\Enqueue;
	use \Pt_Addons_Elementor\Includes\Triat\Admin;
	use \Pt_Addons_Elementor\Includes\Triat\Elements;
	// instance container.
	private static $instance = null;
	// registered elements container.
	public $registered_elements;
	// registered extensions container.
	public $registered_extensions;
	// transient elements container.
	public $transient_elements;
	// transient elements container.
	public $transient_extensions;
	// identify whether pro is enabled.
	public $pro_enabled;
	// localize objects.action.
	public $localize_objects;
	/**
	 * Singleton instance
	 *
	 * @since v1.0.0
	 */
	public static function instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * Constructor of plugin class
	 *
	 * @since v1.0.0
	 */
	private function __construct() {
		// before init hook.
		do_action( 'pt/before_init' );
		// Placeholder image replacement
		add_filter( 'elementor/utils/get_placeholder_image_src', array( $this, 'set_placeholder_image' ) );
		// search for pro version.
		// $this->pro_enabled = apply_filters( 'pt/pro_enabled', false );
		// elements classmap.
		$this->registered_elements = apply_filters(
			'pt/registered_elements',
			[

				'flipbox'                   => [
					'class'      => '\Pt_Addons_Elementor\Elements\FlipBox\Flip_Box',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/flip-box/index.css',
						],
					],
				],
				'team'                      => [
					'class'      => '\Pt_Addons_Elementor\Elements\Team\Team',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/team/index.min.css',

						],
					],

				],
				'call-action'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\CallToAction\Call_Action',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/call-action/index.min.css',

						],
					],

				],
				'advanced_button'           => [
					'class'      => '\Pt_Addons_Elementor\Elements\DualButton\Dual_Button',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',

						],
					],

				],
				'infobox'                   => [
					'class'      => '\Pt_Addons_Elementor\Elements\InfoBox\Info_Box',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/info-box/index.min.css',

						],
					],

				],
				'testimonials'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\Testimonial\Testimonial',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/testimonial/index.min.css',

						],
					],

				],
				'team-members'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\TeamMembers\Team_Members',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/team-members/index.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',

						],
					],

				],
				'tooltip'                   => [
					'class'      => '\Pt_Addons_Elementor\Elements\Tooltip\Tooltip',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/tooltips/index.min.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/font-awesome.min.css',

						],
					],

				],
				'dual-color-header'         => [
					'class'      => '\Pt_Addons_Elementor\Elements\DualColorHeading\Dual_Color_Header',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/dual-color-heading/index.min.css',

						],
					],

				],
				'adv-accordion'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\AdvanceAccordion\Advance_Accordion',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/adv-accordion/index.min.css',

						],
					],

				],
				'advance-tab'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\AdvanceTab\Advance_Tab',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/adv-tabs/index.min.css',

						],
					],

				],

				'blog-post-grid'            => [
					'class'      => '\Pt_Addons_Elementor\Elements\BlogPostGrid\Blog_Post_Grid',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/blog-postgrid/index.css',

						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/general/isotope.pkgd.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/general/masonry.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/blog-postgrid/index.js',

						],
					],

				],
				'pricing-table'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\PricingTable\Pricing_Table',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/price-table/index.min.css',

						],

					],

				],
				'clients-list'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\ListClient\ClientsList',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/icomoon.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/clients-list/slick.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/clients-list/index.js',

						],

					],

				],
				'pie-charts'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\PieCharts\Pie_Charts',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/pie-charts/bar-widgets.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/pie-charts/jquery.stats.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/pie-charts/index.js',

						],

					],

				],
				'services'                  => [
					'class'      => '\Pt_Addons_Elementor\Elements\Services\Services',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/services/index.min.css',

						],

					],

				],
				'stats-bars'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\StatsBar\Stats_Bar',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/stats-bar/index.min.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/stats-bar/bar-widgets.js',

						],

					],

				],
				'interactive_banner'        => [
					'class'      => '\Pt_Addons_Elementor\Elements\InteractiveBanner\Interactive_Banner',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/interactive-banner/index.css',

						],

					],

				],
				'addon-dual-header'         => [
					'class'      => '\Pt_Addons_Elementor\Elements\DualHeading\Dual_Header',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/dual-header/index.min.css',

						],

					],

				],
				'map'                       => [
					'class'      => '\Pt_Addons_Elementor\Elements\GoogleMap\Map',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/google-map/index.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/google-map/pt-map.js',

						],

					],

				],
				'data-table'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\DataTable\Data_Table',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/data-table/index.min.css',

						],

					],

				],
				'image-accordian'           => [
					'class'      => '\Pt_Addons_Elementor\Elements\ImageAccordion\Image_Accordion',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',

						],
						'js'  => [
						// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/off-canvas/index.js',

						],

					],

				],
				'product-grid'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\ProductGrid\Product_Grid',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/product-grid/index.min.css',

						],

					],

				],
				'filter-gallery'            => [
					'class'      => '\Pt_Addons_Elementor\Elements\FilterGallery\Filter_Gallery',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/mixitup.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/masonry.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/jquery.mobile.custom.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/jquery.masonry.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/jquery.magnific-popup.min.js',
						],
					],

				],
				'post-carousel'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\PostCarousel\Post_Carousel',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-carousel/index.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/icomoon.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-carousel/slick.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-carousel/index.js',

						],

					],

				],
				'post-timeline'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\PostTimeline\Post_Timeline',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/index.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/pt-timelines.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/timeline.min.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/timeline-horizontal.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/timeline-reset.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/post-timeline/style1.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/icomoon.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-timeline/imagesloaded.pkgd.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-timeline/masonry.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-timeline/main.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-timeline/timeline.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/post-timeline/pt-custom.js',

						],

					],

				],
				'contact-form'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\ContactForm7\Contact_Form',
					'condition'  => [
						'function_exists',
						'wpcf7',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/contact-form/index.css',
						],
					],
				],
				'we-forms'                  => [
					'class'      => '\Pt_Addons_Elementor\Elements\WeForms\We_Forms',
					'condition'  => [
						'function_exists',
						'WeForms',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/we-forms/index.css',
						],
					],
				],
				'wp-forms'                  => [
					'class'      => '\Pt_Addons_Elementor\Elements\WpForms\Wp_Forms',
					'condition'  => [
						'class_exists',
						'\WPForms\WPForms',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/wp-forms/index.css',
						],
					],
				],
				'gravity-form'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\GravityForm\Gravity_Form',
					'condition'  => [
						'class_exists',
						'GFForms',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/gravity-form/index.css',
						],
					],
				],
				'caldera-forms'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\CalderaForms\Caldera_Forms',
					'condition'  => [
						'class_exists',
						'Caldera_Forms',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/caldera_forms/index.css',
						],
					],
				],
				'ninja-form'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\NinjaForm\Ninja_Form',
					'condition'  => [
						'function_exists',
						'Ninja_Forms',
					],
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/ninja-form/index.css',
						],
					],
				],
				'fluentform'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\FluentForm\FluentForm',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/fluentform/index.min.css',
						],
					],
				],

				// new Pro Elements

				'slider-testimonial'        => [
					'class'      => '\Pt_Addons_Elementor\Elements\TestimonialsSlider\Testimonials_Slider',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/testimonials-slider/index.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/testimonials-slider/flexslider.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/icomoon.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/testimonial-slider/pt-pro-custom.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/testimonial-slider/jquery.flexslider.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/pt.min.js',

						],
					],
				],
				'hover-cards'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\HoverCards\Hover_Cards',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/hover-cards/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'i-hover'                   => [
					'class'      => '\Pt_Addons_Elementor\Elements\Ihover\Ihover',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/ihover/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'i-hover-3d'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\Ihover3d\Ihover_3d',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/3d-ihover/index.css',
						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/3d-ihover/anime.min.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/3d-ihover/3d-ihover-main.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/pt.min.js',
						],
					],
				],
				'heading'                   => [
					'class'      => '\Pt_Addons_Elementor\Elements\Heading\Heading',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/heading/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'smart-box'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\SmartBox\Smart_Box',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/smart-box/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'advance-animated-headline' => [
					'class'      => '\Pt_Addons_Elementor\Elements\TexttypeEffect\Texttype_Effect',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/texttype/index.css',
						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/texttype-effect/index.js',
						],
					],
				],
				'advance-infobox'           => [
					'class'      => '\Pt_Addons_Elementor\Elements\AdvanceInfobox\Advance_Infobox',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/info-box2/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'advance-button'            => [
					'class'      => '\Pt_Addons_Elementor\Elements\AdvanceButton\Advance_Button',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/advance-button/index.css',
						],
					],
				],
				'post-grid'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\PostGrid\Post_Grid',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/postgrid/index.css',
						],
						'js'  => [
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'model-box'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\Modelbox\Modelbox',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/modelbox/index.css',
							// PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/pt.css',
						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/modal/index.js',
						],
					],
				],
				'news-ticker'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\NewsTicker\News_Ticker',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/news-ticker/index.css',

						],
						'js'  => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/news-ticker/wptu-ticker.js',

						],
					],
				],
				'info-list'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\InfoList\Info_List',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/info-list/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'smart-banner'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\SmartBanner\Smart_Banner',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/smart-banner/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'animated-books'            => [
					'class'      => '\Pt_Addons_Elementor\Elements\AnimatedBooks\Animated_Books',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/animated-books/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'business-hours'            => [
					'class'      => '\Pt_Addons_Elementor\Elements\BusinessHours\Business_Hours',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/business-hours/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'info-circle'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\InfoCircle\Info_Circle',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/info-circle/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				/*
				 'call-to-action' => [
				'class' => '\Pt_Addons_Elementor\Elements\CallToActionPro\Call_To_Action_Pro',
				'dependency' => [
					'css' => [

						PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/call-to-action-pro/index.css',
					],

				],
				], */
				'creative-link'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\CreativeLink\Creative_Link',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/creative-link/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'logo-grid'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\LogoGrid\Logo_Grid',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/logo-grid/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'separator'                 => [
					'class'      => '\Pt_Addons_Elementor\Elements\Separator\Separator',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/separator/index.css',
						],
						'js'  => [
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.event.move.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/vendor/img-comparison/jquery.twentytwenty.min.js',
							// PT_PRO_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-comparison/index.min.js',
						],
					],
				],
				'advance-menu'              => [
					'class'      => '\Pt_Addons_Elementor\Elements\AdvanceMenu\Advance_Menu',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/advance-menu/index.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/advance-menu/index.js',

						],
					],
				],
				'content-switcher'          => [
					'class'      => '\Pt_Addons_Elementor\Elements\ContentSwitcher\Content_Switcher',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/content-switcher/index.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/content-switcher/index.js',

						],
					],
				],
				'count-down'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\CountDown\Count_Down',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/count-down/index.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/count-down/index.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/count-down/countdown.js',

						],
					],
				],
				'flip-carousel'             => [
					'class'      => '\Pt_Addons_Elementor\Elements\FlipCarousel\Flip_Carousel',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/flip-carousel/jquery.flipster.min.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/flip-carousel/jquery.flipster.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/flip-carousel/index.js',

						],
					],
				],
				'img-compare'               => [
					'class'      => '\Pt_Addons_Elementor\Elements\ImgCompare\Img_Compare',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/img-compare/index.css',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/img-compare/twentytwenty.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-compare/jquery.event.move.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-compare/jquery.twentytwenty.js',
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/img-compare/index.js',

						],
					],
				],
				'off-canvas'                => [
					'class'      => '\Pt_Addons_Elementor\Elements\OffCanvas\Off_Canvas',
					'dependency' => [
						'css' => [

							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/off-canvas/index.css',
						],
						'js'  => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/off-canvas/index.js',

						],
					],
				],
				'interactive_banner_pro'    => [
					'class'      => '\Pt_Addons_Elementor\Elements\InteractiveBannerPro\Interactive_Banner_Pro',
					'dependency' => [
						'css' => [
							PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/interactive-banner-pro/index.css',

						],

					],

				],

			]
		);
		// extensions classmap
		$this->registered_extensions = apply_filters( 'pt/registered_extensions', [] );
		// initialize transient container
		$this->transient_elements   = [];
		$this->transient_extensions = [];
		// start plugin tracking
		// if ( ! $this->pro_enabled ) {
		// $this->start_plugin_tracking();
		// }
		// post args
		$this->post_args = apply_filters( 'pt/post_args', $this->post_args );
		// register extensions
		$this->register_extensions();
		// register scripts hooks
		$this->register_common_scripts();
		// register hooks
		$this->register_hooks();

	}
	public static function set_placeholder_image() {
		return ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
	}
	protected function register_common_scripts() {
		add_action( 'wp_head', array( $this, 'generate_frontend_common_scripts' ) );
		// add_action('wp_enqueue_scripts',array( $this, 'my_plugin_assets'));
	}
	/*
	public function my_plugin_assets() {

		$key = get_site_option( 'pt_map_key' );
		if ( ! empty( $key ) ) {
			wp_register_script ( 'my_plugin_assets', 'https://maps.googleapis.com/maps/api/js?key=' . $key );
			wp_enqueue_script( 'my_plugin_assets');
		} else {
			wp_register_script( 'my_plugin_assets', 'https://maps.googleapis.com/maps/api/js?key=' );
			wp_enqueue_script( 'my_plugin_assets');
		}

	} */
	public function generate_frontend_common_scripts() {
		wp_enqueue_script( 'magnific-popup', PT_PLUGIN_URL . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/jquery.magnific-popup.min.js', 10 );
		wp_enqueue_script( 'mixitup', PT_PLUGIN_URL . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/mixitup.min.js', 10 );
		wp_enqueue_script( 'masonry', PT_PLUGIN_URL . DIRECTORY_SEPARATOR . 'assets/front-end/js/filter-gallery/masonry.min.js', 10 );
		// $key = get_site_option( 'pt_map_key' );
		// if ( ! empty( $key ) ) {
		// wp_enqueue_script( 'map-key', 'https://maps.googleapis.com/maps/api/js?key=' . $key );
		// } else {
		// wp_enqueue_script( 'map-key-new', 'https://maps.googleapis.com/maps/api/js?key=' );
		// }
	}
	protected function register_hooks() {
		error_reporting( 0 );
		// Generator
		add_action( 'elementor/frontend/before_render', array( $this, 'collect_transient_elements' ) );
		add_action( 'wp_footer', array( $this, 'generate_frontend_scripts' ) );
		$key = get_site_option( 'pt_map_key' );
		if ( ! empty( $key ) ) {
			wp_enqueue_script( 'enqueue_scripts', 'https://maps.googleapis.com/maps/api/js?key=' . $key );
		} else {
			wp_enqueue_script( 'enqueue_scripts', 'https://maps.googleapis.com/maps/api/js?key=' );
		}

		// Enqueue
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		// Ajax
		add_action( 'wp_ajax_load_more', array( $this, 'pt_load_more_ajax' ) );
		add_action( 'wp_ajax_nopriv_load_more', array( $this, 'pt_load_more_ajax' ) );
		// Elements
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_categories' ) );
		add_action( 'elementor/controls/controls_registered', array( $this, 'register_controls_group' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_elements' ) );
		// Admin
		if ( is_admin() ) {
			// Admin
			if ( ! $this->pro_enabled ) {
				$this->admin_notice();
			}
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'wp_ajax_pt_save_settings_with_ajax', array( $this, 'save_settings' ) );
			add_action( 'wp_ajax_pt_clear_cache_files_with_ajax', array( $this, 'clear_cache_files' ) );
			// Core
			add_filter( 'plugin_action_links_' . PT_PLUGIN_BASENAME, array( $this, 'insert_plugin_links' ) );
			add_filter( 'plugin_row_meta', array( $this, 'insert_plugin_row_meta' ), 10, 2 );
			add_action( 'admin_init', array( $this, 'redirect_on_activation' ) );
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', array( $this, 'elementor_not_loaded' ) );
			}
		}
	}
}
