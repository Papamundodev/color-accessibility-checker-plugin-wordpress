<?php
/**
 * Plugin Name: Color Accessibility Checker
 * Plugin URI: https://example.com/plugins/color-accessibility-checker/
 * Description: Add color accessibility checker functionalities ! only avalable with ACF PRO.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Joan Fernandez
 * Author URI: https://joanfernandez.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: color-accessibility-checker
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function color_accessibility_checker_enqueue_styles() {
    wp_enqueue_style('color-accessibility-checker-style', plugin_dir_url(__FILE__) . 'color-checker.css');
}

add_action('wp_enqueue_scripts', 'color_accessibility_checker_enqueue_styles');

function color_accessibility_checker_enqueue_scripts() {
    wp_enqueue_script('color-accessibility-checker-script', plugin_dir_url(__FILE__) . 'color-checker.js', array(), '1.0.0', true);
}   

add_action('wp_enqueue_scripts', 'color_accessibility_checker_enqueue_scripts');

function check_acf_pro() {
    // Check if the ACF PRO function exists and if it's the PRO version
    if (function_exists('acf_get_setting') && acf_get_setting('pro')) {
        return true;
    }
    
    // Alternative check for ACF PRO class
    if (class_exists('ACF') && defined('ACF_PRO')) {
        return true;
    }
    
    return false;
}

// Add an admin notice if ACF PRO is not installed
function acf_pro_missing_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php _e('Color Accessibility Checker requires ACF PRO to be installed and activated.', 'color-accessibility-checker'); ?></p>
    </div>
    <?php
}

// Check on plugin activation
function color_accessibility_checker_activation_check() {
    if (!check_acf_pro()) {
        // Deactivate the plugin
        deactivate_plugins(plugin_basename(__FILE__));
        // Add error message
        wp_die(__('Color Accessibility Checker requires ACF PRO to be installed and activated.', 'color-accessibility-checker'));
    }
}

// Hook into plugin activation
register_activation_hook(__FILE__, 'color_accessibility_checker_activation_check');

// Check during runtime and show admin notice if needed
function check_dependencies() {
    if (!check_acf_pro()) {
        add_action('admin_notices', 'acf_pro_missing_notice');
    }
}
add_action('admin_init', 'check_dependencies');

// Add ACF Options Page
function color_accessibility_checker_add_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => __('Color Accessibility Settings', 'color-accessibility-checker'),
            'menu_title'    => __('Color Accessibility', 'color-accessibility-checker'),
            'menu_slug'     => 'color-accessibility-settings',
            'capability'    => 'manage_options',
            'redirect'      => false,
            'icon_url'      => 'dashicons-art', // WordPress built-in icon
            'position'      => 30 // Position in the menu
        ));
    }
}
add_action('acf/init', 'color_accessibility_checker_add_options_page');

function color_accessibility_checker_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_6825a3e5664b8',
        'title' => 'Color checker',
        'fields' => array(
            array(
                'key' => 'field_instructions',
                'label' => 'How to use the Color Checker',
                'name' => 'instructions',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'message' => '<div class="instructions-box" style="background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                    <h4>Follow these steps to use the Color Accessibility Checker:</h4>
                    <ol>
                        <li>Create a new page in WordPress (Pages > Add New)</li>
                        <li>In the Page Attributes panel (right sidebar), select "Color Accessibility Checker" template</li>
                        <li>Publish the page</li>
                        <li>Come back to this Color Accessibility Settings page</li>
                        <li>Add your text colors below (these will be checked against all background colors)</li>
                        <li>Add your background colors</li>
                        <li>Visit your published page to see the contrast analysis for all color combinations</li>
                    </ol>
                    <p><strong>Note:</strong> Each text color will be tested against each background color to ensure optimal contrast and accessibility.</p>
                </div>',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_6825a3e58fcd5',
                'label' => 'The colors of the fonts and accents that you want to compare to the backgrounds colors',
                'name' => 'font-colors',
                'type' => 'repeater',
                'instructions' => 'Add all the text colors you want to test. These will be checked against each background color.',
                'required' => 0,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_6825a4158fcd7',
                        'label' => 'Color',
                        'name' => 'color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'default_value' => '',
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                    )
                )
            ),
            array(
                'key' => 'field_6825a55648635',
                'label' => 'Background colors',
                'name' => 'background_colors',
                'type' => 'repeater',
                'instructions' => 'Add all the background colors you want to test. Each color will be tested against all text colors.',
                'required' => 0,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_6825a56748636',
                        'label' => 'Background color',
                        'name' => 'background_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                        'default_value' => '',
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                    )
                )
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'color-accessibility-settings'
                )
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0
    ));
}
add_action('acf/init', 'color_accessibility_checker_register_acf_fields');

// Register the template
function color_accessibility_checker_add_template($templates) {
    $templates[plugin_dir_path(__FILE__) . 'template-color-checker.php'] = 'Color Accessibility Checker';
    return $templates;
}
add_filter('theme_page_templates', 'color_accessibility_checker_add_template');

// Make sure the template file is loaded from the plugin directory
function color_accessibility_checker_load_template($template) {
    if (is_page()) {
        $template_slug = get_page_template_slug();
        if (false !== strpos($template_slug, plugin_dir_path(__FILE__))) {
            $template = plugin_dir_path(__FILE__) . 'template-color-checker.php';
        }
    }
    return $template;
}
add_filter('template_include', 'color_accessibility_checker_load_template');