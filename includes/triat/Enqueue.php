<?php
namespace Pt_Addons_Elementor\Includes\Triat;
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
trait Enqueue
{
    public function enqueue_scripts()
    {
        // Gravity forms Compatibility
        if (class_exists('GFCommon')) {
            foreach ($this->pt_select_gravity_form() as $form_id => $form_name) {
                if ($form_id != '0') {
                    gravity_form_enqueue_scripts($form_id);
                }
            }
        }
        // WPforms compatibility
        if (function_exists('wpforms')) {
            wpforms()->frontend->assets_css();
        }
        // Caldera forms compatibility
        if (class_exists('Caldera_Forms')) {
            add_filter('caldera_forms_force_enqueue_styles_early', '__return_true');
        }
        // My Assets
        if ($this->is_preview_mode()) {
            // generate fallback scripts
            if (!$this->has_cache_files()) {
                $this->generate_scripts($this->get_settings());
            }
            // enqueue scripts
            if ($this->has_cache_files()) {
                $css_file = PT_ASSET_URL . '/pt.min.css';
                $js_file = PT_ASSET_URL . '/pt.min.js';
            } else {
                $css_file = PT_PLUGIN_URL . '/assets/front-end/css/pt.min.css';
                $js_file = PT_PLUGIN_URL . '/assets/front-end/js/pt.min.js';
            }
            wp_enqueue_style(
                'pt-editor-css',
                $this->safe_protocol(PT_PLUGIN_URL . '/assets/admin/css/editor.css'),
                false,
                PT_PLUGIN_VERSION
            );
            wp_enqueue_style(
                'pt-backend',
                $this->safe_protocol($css_file),
                false,
                PT_PLUGIN_VERSION
            );
            wp_enqueue_script(
                'pt-backend',
                $this->safe_protocol($js_file),
                ['jquery'],
                PT_PLUGIN_VERSION,
                true
            );
            // hook extended assets
            do_action('pt/after_enqueue_scripts', $this->has_cache_files());
            // localize script
            $this->localize_objects = apply_filters('pt/localize_objects', [
                'ajaxurl' => admin_url('admin-ajax.php'),
            ]);
            wp_localize_script('pt-backend', 'localize', $this->localize_objects);
        } else {
            if (is_singular() || is_archive()) {
                $queried_object = get_queried_object_id();
                $post_type = (is_singular() ? 'post' : 'term');
                $elements = (array) get_metadata($post_type, $queried_object, 'pt_transient_elements', true);
                if (empty($elements)) {
                    return;
                }
                $this->enqueue_protocols($post_type, $queried_object);
            }
        }
    }
    // rules how css will be enqueued on front-end
    protected function enqueue_protocols($post_type, $queried_object)
    {
        if ($this->has_cache_files($post_type, $queried_object)) {
            $css_file = PT_ASSET_URL . '/pt-' . $post_type . '-' . $queried_object . '.min.css';
            $js_file = PT_ASSET_URL . '/pt-' . $post_type . '-' . $queried_object . '.min.js';
        } else {
            $css_file = PT_PLUGIN_URL . '/assets/front-end/css/pt.min.css';
            $js_file = PT_PLUGIN_URL . '/assets/front-end/js/pt.min.js';
        }
        wp_enqueue_style(
            'pt-front-end',
            $this->safe_protocol($css_file),
            false,
            PT_PLUGIN_VERSION
        );
        wp_enqueue_script(
            'pt-front-end',
            $this->safe_protocol($js_file),
            ['jquery'],
            PT_PLUGIN_VERSION,
            true
        );
        // hook extended assets
        do_action('pt/after_enqueue_scripts', $this->has_cache_files($post_type, $queried_object));
        // localize script
        $this->localize_objects = apply_filters('pt/localize_objects', [
            'ajaxurl' => admin_url('admin-ajax.php'),
        ]);
        wp_localize_script('pt-front-end', 'localize', $this->localize_objects);
    }
}