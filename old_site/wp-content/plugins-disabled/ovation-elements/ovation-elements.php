<?php
/**
 * Plugin Name:       Ovation Elements
 * Plugin URI:        https://www.ovationthemes.com/products/ovation-elements-pro
 * Description:       Transform your site with captivating sliders. Perfect for beginners and advanced users. Create and customize with our ultimate slider plugin.
 * Version:           1.2.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            pewilliams
 * Author URI:        https://www.ovationthemes.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ovation-elements
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('OVA_ELEMS_FILE', __FILE__);
define('OVA_ELEMS_BASE', plugin_basename(OVA_ELEMS_FILE));
define('OVA_ELEMS_DIR', plugin_dir_path(OVA_ELEMS_FILE));
define('OVA_ELEMS_URL', plugins_url('/', OVA_ELEMS_FILE));
define('OVA_ELEMS_LICENSE_ENDPOINT', 'https://license.ovationthemes.com/api/public/');
define('OVA_ELEMS_VER', '1.2.1');

// Include necessary files
include(plugin_dir_path(__FILE__) . 'includes/admin-settings.php');
include(plugin_dir_path(__FILE__) . 'includes/slider-shortcode.php');
include(plugin_dir_path(__FILE__) . 'ajax/ajax.php');

//enqueue script start
function ova_elems_admin_scripts($hook) {
    $is_premium_user = get_option('ovation_slider_is_premium', false);

    // Define all admin pages 
    $admin_pages = [
        'toplevel_page_ovation_elements',
        'ovation-elements_page_select-template',
        'admin_page_edit-slider-template-template1',
        'admin_page_edit-slider-template-template2',
        'admin_page_edit-slider-template-template3',
        'admin_page_edit-slider-template-template4',
        'admin_page_edit-slider-template-template5',
        'admin_page_edit-slider-template-template6',
        'admin_page_edit-slider-template-template7',
        'admin_page_edit-slider-template-template8',
        'admin_page_edit-slider-template-template9',
        'ot-elements_page_select-template',
        'edit.php?post_type=ova_elems'
    ];

    if (in_array($hook, $admin_pages) || ($hook === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'ova_elems')) {
        // Enqueue common styles and scripts for admin pages
        wp_enqueue_style('ova-elems-mod-bootstrap-css', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', [], OVA_ELEMS_VER);
        wp_enqueue_script('ova-elems-mod-bootstrap-js', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.bundle.min.js', ['jquery'], OVA_ELEMS_VER, true);
        wp_enqueue_style('ova-elems-admin-css-slider', plugin_dir_url(__FILE__) . 'assets/css/preview-slider.css', [], OVA_ELEMS_VER);
        wp_enqueue_media();
    }
    wp_enqueue_style('ova-elems-admin-css', plugin_dir_url(__FILE__) . 'assets/css/slider-admin.css', [], OVA_ELEMS_VER);

    // Define template-specific scripts
    $templates = [
        'admin_page_edit-slider-template-template1' => 'template-1-scripts',
        'admin_page_edit-slider-template-template2' => 'template-2-scripts',
        'admin_page_edit-slider-template-template3' => 'template-3-scripts',
        'admin_page_edit-slider-template-template4' => 'template-4-scripts',
        'admin_page_edit-slider-template-template5' => 'template-5-scripts',
        'admin_page_edit-slider-template-template6' => 'template-6-scripts',
        'admin_page_edit-slider-template-template7' => 'template-7-scripts',
        'admin_page_edit-slider-template-template8' => 'template-8-scripts',
        'admin_page_edit-slider-template-template9' => 'template-9-scripts',
    ];

    if (array_key_exists($hook, $templates)) {
        $script_handle = 'ova-elems-' . $templates[$hook];
        $script_path = plugin_dir_url(__FILE__) . 'assets/js/admin/' . $templates[$hook] . '.js';

        wp_enqueue_script($script_handle, $script_path, ['jquery'], OVA_ELEMS_VER, true);

        wp_localize_script($script_handle, 'sliderData', [
            'isPremiumUser' => $is_premium_user,
            'maxSlides' => 2,
        ]);

        // Localize script 
        if ($hook == 'admin_page_edit-slider-template-template1') {
            wp_localize_script($script_handle, 'wpVars', [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('upload_cropped_image_nonce'),
            ]);
        }

        if ($hook == 'admin_page_edit-slider-template-template2') {
            wp_localize_script($script_handle, 'OvimageData', [
                'plugin_url' => plugin_dir_url(__FILE__),
                'nonce' => wp_create_nonce('ova_elems_ajax_nonce'),
            ]);
        }

        if ($hook == 'admin_page_edit-slider-template-template4' || $hook == 'admin_page_edit-slider-template-template7') {
            wp_localize_script($script_handle, 'ova_elems_template_script', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('ova_elems_ajax_nonce'),
            ]);
        }

        if ($hook == 'admin_page_edit-slider-template-template6') {
            wp_enqueue_script('ova-elems-bootstrap-js', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.bundle.min.js', ['jquery'], OVA_ELEMS_VER, true);
        }
    }
}

add_action('admin_enqueue_scripts', 'ova_elems_admin_scripts');


//enqueue scripts end 
function ova_elems_admin_enqueue_scripts($hook_suffix) {
    if ($hook_suffix !== 'toplevel_page_ova-elems') {
        return;
    }

    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'ova_elems_admin_enqueue_scripts');


//for enque
function ova_elems_enqueue_scripts($hook) {

    // Enqueue Font Awesome 
    wp_enqueue_style('ova-elems-font-awesome', plugin_dir_url(__FILE__) . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
    wp_enqueue_style('ova-elems-modal-css', OVA_ELEMS_URL . 'assets/css/modal.css', array(), OVA_ELEMS_VER);

    wp_enqueue_script(
        'ova-elems-redirect-js',
        OVA_ELEMS_URL . 'assets/js/redirect.js',
        array('jquery'),
        OVA_ELEMS_VER,
        true
    );

    // Enqueue Bootstrap CSS
    wp_enqueue_script('jquery');
    if (isset($_GET['page']) && $_GET['page'] == 'ovation_elements') {

        wp_enqueue_style('ova-elems-bootstrap-css', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', [], OVA_ELEMS_VER);
        // Enqueue Bootstrap JS and its dependency Popper.js
        wp_enqueue_script('ova-elems-popper-js', plugin_dir_url(__FILE__) . 'assets/js/popper.min.js', ['jquery'], OVA_ELEMS_VER, true);
        wp_enqueue_script('ova-elems-dash-bootstrap-js', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.min.js', array('jquery', 'ova-elems-popper-js'), OVA_ELEMS_VER, true);
        wp_enqueue_script('ova-elems-admin-operations', plugin_dir_url(__FILE__) . 'assets/js/admin/ova-elems-admin.js', ['jquery'], OVA_ELEMS_VER, true);
    }
}
add_action('admin_enqueue_scripts', 'ova_elems_enqueue_scripts');

// Register activation hook
register_activation_hook(__FILE__, 'ova_elems_activate');

function ova_elems_activate() {
    // Activation code here
    ova_elems_post_type();
    flush_rewrite_rules();
}

// Register deactivation hook
register_deactivation_hook(__FILE__, 'ova_elems_deactivate');

function ova_elems_deactivate() {
    // Deactivation code here
    flush_rewrite_rules();
}

function ova_elems_enqueue_block_editor_assets(){

    wp_enqueue_style('ova-elems-modal-css', OVA_ELEMS_URL . 'assets/css/modal.css', array(), OVA_ELEMS_VER);

    wp_register_script(
        'ova-elems-modal-js',
        OVA_ELEMS_URL . 'assets/js/modal.js',
        array('jquery'),
        OVA_ELEMS_VER,
        true
    );

    $theme = wp_get_theme();
    $theme_author = $theme->get('Author');
    $theme_text_domain = $theme->get('TextDomain');

    $theme_directory = get_stylesheet_directory_uri();
    $screenshot_url = $theme_directory . '/screenshot.png';

    $demo_btn = strtoupper(str_replace("-", "_", $theme_text_domain)) . '_LIVE_DEMO';
    $buy_pro = strtoupper(str_replace("-", "_", $theme_text_domain)) . '_BUY_PRO';
    $free_doc = strtoupper(str_replace("-", "_", $theme_text_domain)) . '_FREE_DOC';

    $is_demo_defined = defined($demo_btn);
    $is_buy_pro_defined = defined($buy_pro);
    $is_free_doc_defined = defined($free_doc);

    $localize_arr = array(
        'admin_ajax' => admin_url('admin-ajax.php'),
        'search_icon' => OVA_ELEMS_URL . 'assets/images/search.png',
        'is_author' => $theme_author === 'pewilliams' ? true : false,
        'bundle_image' => OVA_ELEMS_URL . 'assets/images/bundle-images.png',
        'nonce' => wp_create_nonce('ova_elems_ajax_nonce')
    );

    if ($theme_author === 'pewilliams') {
        $localize_arr['screenshot_url'] = $screenshot_url;

        $localize_arr['demo_btn'] = $is_demo_defined ? constant($demo_btn) : 'https://www.ovationthemes.com/collections/professional-wordpress-themes';
        $localize_arr['buy_pro'] = $is_buy_pro_defined ? constant($buy_pro) : 'https://www.ovationthemes.com/products/wordpress-bundle';
        $localize_arr['free_doc'] = $is_free_doc_defined ? constant($free_doc) : 'https://www.ovationthemes.com/';
    }

    wp_localize_script(
        'ova-elems-modal-js',
        'ova_elems_modal_js',
        $localize_arr
    );
    wp_enqueue_script('ova-elems-modal-js');
}
add_action('enqueue_block_editor_assets', 'ova_elems_enqueue_block_editor_assets');

// Register block script.
function ova_elems_register_block()
{
    wp_register_script(
        'ova-elems-block',
        plugins_url('build/index.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components'),
        OVA_ELEMS_VER,
        true
    );
    register_block_type(
        'ova-elems/ovation-sliders',
        array(
            'editor_script' => 'ova-elems-block',
            'style' => 'ova-elems-style',
            'editor_style' => 'ova-elems-editor-style',
            'attributes' => array(
                'selectedPost' => array(
                    'type' => 'number',
                    'default' => null,
                ),
            ),
            'render_callback' => 'ova_elems_render_slider_block'
        )
    );
}
add_action('init', 'ova_elems_register_block');

function ova_elems_render_slider_block($attributes){

    $id = isset($attributes['selectedPost']) ? $attributes['selectedPost'] : null;

    if (!$id) {
        return '';
    }

    return do_shortcode('[ova-elems-slider-template id="' . intval($id) . '"]');
}

add_filter('block_categories_all', function ($categories, $post) {
    return array_merge(
        array(
            array(
                'slug' => 'Ovation Sliders',
                'title' => 'Ovation Sliders',
                'icon' => '<svg id="Layer_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.56 22.07"><defs><style>{`.cls-1 {fill: #cee1f2;}.cls-2 {fill: none;stroke: #0023c4;stroke-width: .5px;}.cls-2, .cls-3 {stroke-miterlimit: 10;}.cls-4 {fill: #0023c4;}.cls-5, .cls-3 {fill: #ff5cf4;}.cls-3 {stroke: #ff5cf4;stroke-width: .25px;}`}</style></defs><g id="Layer_1-2" data-name="Layer_1"><path class="cls-4" d="M19.76,0h-5.52c-1.33,0-2.41,1.08-2.41,2.42v8.62c0,1.33,1.08,2.41,2.41,2.41h5.52c1.33,0,2.41-1.08,2.41-2.41V3.11l-2.41-3.11ZM20.44,11.03c0,.38-.31.69-.69.69h-5.52c-.38,0-.69-.31-.69-.69V2.42c0-.38.31-.69.69-.69h5.03v.91c0,.26.19.48.43.48h.75v7.92Z"/><path class="cls-1" d="M3.45,19.65v-7.07c0-.86.7-1.55,1.55-1.55h-2.59c-.86,0-1.55.7-1.55,1.55v7.07c0,.86.7,1.55,1.55,1.55h2.59c-.86,0-1.55-.7-1.55-1.55Z"/><path class="cls-4" d="M2.41,7.28h5.34c1.33,0,2.41-.91,2.41-2.04v-3.2c0-1.12-1.08-2.04-2.41-2.04H2.41C1.08,0,0,.91,0,2.04v3.2c0,1.12,1.08,2.04,2.41,2.04ZM1.72,2.04c0-.32.31-.58.69-.58h5.34c.38,0,.69.26.69.58v3.2c0,.32-.31.58-.69.58H2.41c-.38,0-.69-.26-.69-.58v-3.2Z"/><path class="cls-4" d="M2.41,22.07h5.34c1.33,0,2.41-1.08,2.41-2.41v-7.07c0-1.33-1.08-2.41-2.41-2.41H2.41c-1.33,0-2.41,1.08-2.41,2.41v7.07c0,1.33,1.08,2.41,2.41,2.41ZM1.72,12.59c0-.38.31-.69.69-.69h5.34c.38,0,.69.31.69.69v7.07c0,.38-.31.69-.69.69H2.41c-.38,0-.69-.31-.69-.69v-7.07Z"/><circle class="cls-4" cx="5.21" cy="8.75" r=".69"/><circle class="cls-2" cx="2.85" cy="8.75" r=".56"/><circle class="cls-2" cx="7.57" cy="8.75" r=".56"/><path class="cls-5" d="M21.01,19.09c-.4,0-.72.28-.72.62v.32c0,.44-.3.79-.67.79h-5.98c-.37,0-.67-.36-.67-.79v-1.88c0-.44.3-.79.67-.79h1.61c.4,0,.72-.28.72-.62h0c0-.34-.32-.62-.72-.62h-2c-.98,0-1.78.94-1.78,2.11v1.72c0,1.17.8,2.11,1.78,2.11h6.78c.98,0,1.78-.94,1.78-2.11v-.24c0-.34-.32-.62-.72-.62h-.07Z"/><path class="cls-5" d="M22.49,16.25l-2.14-2.22c-.07-.07-.18-.1-.27-.06-.09.04-.15.13-.15.23v1.07h-.08c-1.77,0-3.21,1.44-3.21,3.21v.49c0,.11.08.21.19.24.02,0,.04,0,.05,0,.09,0,.18-.05.23-.14.46-.93,1.4-1.5,2.43-1.5h.39v1.07c0,.1.06.19.15.23.09.04.2.01.27-.06l2.14-2.22c.09-.1.09-.25,0-.34Z"/><path class="cls-3" d="M7.59,3.77l.28-.28-.28-.28s-.02-.05,0-.06c.02-.02.04-.02.06,0l.31.31s.02.05,0,.06l-.31.31s-.05.02-.06,0c-.02-.02-.02-.04,0-.06h0Z"/><path class="cls-3" d="M2.41,3.77s.02.04,0,.06c-.02.02-.05.02-.06,0l-.31-.31s-.02-.05,0-.06l.31-.31s.04-.02.06,0c.02.02.02.05,0,.06l-.28.28.28.28h0Z"/></g></svg>'
            ),
        ),
        $categories
    );
}, 99999, 2);

add_action('admin_notices', 'ova_elems_admin_notice_with_html');

function ova_elems_admin_notice_with_html(){
    ?>
    <div class="notice is-dismissible ova-elems">
        <div class="ova-elems-notice-banner-wrap">
            <div class="ova-elems-notice-left-img">
                <img src="<?php echo esc_url(OVA_ELEMS_URL . 'assets/images/notice-background.png'); ?>" alt="">
            </div>
            <div class="ova-elems-notice-heading">
                <h1 class="ova-elems-main-head"><?php echo esc_html('WORDPRESS THEME BUNDLE'); ?></h1>
                <h4 class="ova-elems-sub-head">
                    <?php echo esc_html('Access 125+ Gutenberg Block WordPress themes at Just $89'); ?></h4>
            </div>
            <div class="ova-elems-notice-btn">
                <a class="ova-elems-buy-btn" target="_blank"
                    href="<?php echo esc_url('https://www.ovationthemes.com/products/wordpress-bundle'); ?>"><?php echo esc_html('BUY NOW'); ?></a>
            </div>
            <div class="notice-right-img">
                <img src="<?php echo esc_url(OVA_ELEMS_URL . 'assets/images/bundle-package.png'); ?>" alt="">
            </div>
        </div>
    </div>
    <?php
}