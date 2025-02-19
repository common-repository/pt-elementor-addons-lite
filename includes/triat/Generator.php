<?php
namespace Pt_Addons_Elementor\Includes\Triat;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use \ReflectionClass;
trait Generator {

	/**
	 * Collect elements in a page or post
	 *
	 * @since v1.0.0
	 */
	public function collect_transient_elements( $widget ) {
		if ( $widget->get_name() === 'global' ) {
			$reflection = new ReflectionClass( get_class( $widget ) );
			$protected  = $reflection->getProperty( 'template_data' );
			$protected->setAccessible( true );
			if ( $global_data = $protected->getValue( $widget ) ) {
				$this->transient_elements = array_merge( $this->transient_elements, $this->collect_recursive_elements( $global_data['content'] ) );
			}
		} else {
			$this->transient_elements[] = $widget->get_name();
		}
	}

	/**
	 * Collect recursive elements
	 *
	 * @param  mixed $elements
	 *
	 * @return void
	 */
	public function collect_recursive_elements( $elements ) {
		$collections = [];
		array_walk_recursive(
			$elements,
			function( $val, $key ) use ( &$collections ) {
				if ( $key == 'widgetType' ) {
					$collections[] = $val;
				}
			}
		);
		return $collections;
	}
	/**
	 * Combine files into one
	 *
	 * @since v1.0.0
	 */
	public function combine_files( $paths = array(), $file = 'pt.min.css' ) {
		$output = '';
		if ( ! empty( $paths ) ) {
			foreach ( $paths as $path ) {
				$output .= file_get_contents( $this->safe_path( $path ) );
			}
		}
		return file_put_contents( $this->safe_path( PT_ASSET_PATH . DIRECTORY_SEPARATOR . $file ), $output );
	}

	/**
	 * Collect dependencies for modules
	 *
	 * @param  array $elements
	 * @param  mixed $type
	 *
	 * @return $paths
	 */
	public function generate_dependency( array $elements, $type ) {
		$paths = [];
		foreach ( $elements as $element ) {
			if ( isset( $this->registered_elements[ $element ] ) ) {
				if ( ! empty( $this->registered_elements[ $element ]['dependency'][ $type ] ) ) {
					foreach ( $this->registered_elements[ $element ]['dependency'][ $type ] as $path ) {
						$paths[] = $path;
					}
				}
			} elseif ( isset( $this->registered_extensions[ $element ] ) ) {
				if ( ! empty( $this->registered_extensions[ $element ]['dependency'][ $type ] ) ) {
					foreach ( $this->registered_extensions[ $element ]['dependency'][ $type ] as $path ) {
						$paths[] = $path;
					}
				}
			}
		}
		//echo'<pre>';
		//print_r($elements);
		//print_r($this->registered_elements);
		
		
		return array_unique( $paths );
	}
	/**
	 * Generate scripts and minify.
	 *
	 * @since v1.0.0
	 */
	public function generate_scripts( $elements, $file_name = null ) {
		if ( empty( $elements ) ) {
			return;
		}
		// if folder not exists, create new folder
		if ( ! file_exists( PT_ASSET_PATH ) ) {
			wp_mkdir_p( PT_ASSET_PATH );
		}
		// collect pt js
		$js_paths  = array(
			PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/js/general/index.min.js',
		);
		$css_paths = array(
			PT_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'assets/front-end/css/general/index.min.css',
		);
		// collect library scripts & styles
		$js_paths  = array_merge( $js_paths, $this->generate_dependency( $elements, 'js' ) );
		$css_paths = array_merge( $css_paths, $this->generate_dependency( $elements, 'css' ) );
		// combine files
		$this->combine_files( $css_paths, ( $file_name ? $file_name : 'pt' ) . '.min.css' );
		$this->combine_files( $js_paths, ( $file_name ? $file_name : 'pt' ) . '.min.js' );
	}
	/**
	 * Check if cache files exists
	 *
	 * @since v1.0.0
	 */
	public function has_cache_files( $post_type = null, $post_id = null ) {
		$css_path = PT_ASSET_PATH . DIRECTORY_SEPARATOR . ( $post_type ? 'pt-' . $post_type : 'pt' ) . ( $post_id ? '-' . $post_id : '' ) . '.min.css';
		$js_path  = PT_ASSET_PATH . DIRECTORY_SEPARATOR . ( $post_type ? 'pt-' . $post_type : 'pt' ) . ( $post_id ? '-' . $post_id : '' ) . '.min.js';
		if ( is_readable( $this->safe_path( $css_path ) ) && is_readable( $this->safe_path( $js_path ) ) ) {
			return true;
		}
		return false;
	}
	/**
	 * Generate single post scripts
	 *
	 * @since v1.0.0
	 */
	public function generate_frontend_scripts() {
		if ( $this->is_preview_mode() ) {
			return;
		}
		$replace  = [
			//'eicon-woocommerce'             => 'pt-product-grid',
		//	'pt-countdown'                  => 'pt-count-down',
		//	'pt-creative-button'            => 'pt-creative-btn',
		//	'pt-team-member'                => 'pt-team-members',
		//	'pt-testimonial'                => 'pt-testimonials',
		//	'pt-weform'                     => 'pt-weforms',
		//	'pt-cta-box'                    => 'pt-call-to-action',
			//'pt-dual-color-header'          => 'pt-dual-header',
			//'pt-pricing-table'              => 'pt-price-table',
			//'pt-filterable-gallery'         => 'pt-filter-gallery',
			//'pt-one-page-nav'               => 'pt-one-page-navigation',
			//'pt-interactive-card'           => 'pt-interactive-cards',
			//'pt-image-comparison'           => 'pt-img-comparison',
			//'pt-dynamic-filterable-gallery' => 'pt-dynamic-filter-gallery',
			//'pt-google-map'                 => 'pt-adv-google-map',
			//'pt-instafeed'                  => 'pt-instagram-gallery',
		];
		$elements = array_map(
			function ( $val ) use ( $replace ) {
				$val = str_replace( array_keys( $replace ), array_values( $replace ), $val );
				// echo 'aaaaaaa'.$val;

				if ( strpos( $val, 'pt-' ) !== false || strpos( $val, 'Pt-' ) !== false || strpos( $val, 'pt_' ) !== false ) {
					// echo 'xyz';
					return str_replace( [ 'pt-', 'Pt-', 'pt_' ], [ '' ], $val );

				} else {
					return null;
				}
				// return (strpos($val, 'pt-') !== false ? str_replace(['pt-'], [''], $val) : null);
			},
			$this->transient_elements
		);
		$extensions = apply_filters( 'pt/section/after_render', $this->transient_extensions );
		$elements   = array_filter( array_unique( array_merge( $elements, $extensions ) ) );
		if ( is_singular() || is_archive() ) {
			$queried_object = get_queried_object_id();
			$post_type      = ( is_singular() ? 'post' : 'term' );
			$old_elements   = (array) get_metadata( $post_type, $queried_object, 'pt_transient_elements', true );
			// sort two arr for compare
			sort( $elements );
			sort( $old_elements );
			if ( $old_elements != $elements ) {
				update_metadata( $post_type, $queried_object, 'pt_transient_elements', $elements );
				// if not empty elements, regenerate cache files
				if ( ! empty( $elements ) ) {
					$this->generate_scripts( $elements, 'pt-' . $post_type . '-' . $queried_object );
					// load generated files - fallback
					$this->enqueue_protocols( $queried_object, $post_type );
				}
			}
			// if no cache files, generate new
			if ( ! $this->has_cache_files( $post_type, $queried_object ) ) {
				$this->generate_scripts( $elements, 'pt-' . $post_type . '-' . $queried_object );
			}
			// if no elements, remove cache files
			if ( empty( $elements ) ) {
				$this->remove_files( $post_type, $queried_object );
			}
		}
	}
}
