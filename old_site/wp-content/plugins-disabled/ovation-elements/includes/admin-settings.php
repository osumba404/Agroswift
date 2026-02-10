<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Register Post Type
function ova_elems_post_type()
{
    $labels = array(
        'name' => 'Sliders',
        'singular_name' => 'Slider',
        'menu_name' => 'Sliders',
        'name_admin_bar' => 'Slider',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Slider',
        'new_item' => 'New Slider',
        'edit_item' => 'Edit Slider',
        'view_item' => 'View Slider',
        'all_items' => 'All Sliders',
        'search_items' => 'Search Sliders',
        'not_found' => 'No sliders found.',
        'not_found_in_trash' => 'No sliders found in Trash.',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_in_menu' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'ova_elems'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'supports' => array('title', 'editor'), // Only title and editor are used
    );
    register_post_type('ova_elems', $args);
}
add_action('init', 'ova_elems_post_type');

// Add Meta Box
function ova_elems_add_meta_boxes()
{
    add_meta_box(
        'ova_elems_settings',
        'Slider Settings',
        'ova_elems_meta_box_callback',
        'ova_elems',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ova_elems_add_meta_boxes');


// Add Edit Template Page
function ova_elems_add_edit_page()
{
    add_submenu_page(
        '',
        'Edit Slider Template',
        'Edit Slider Template',
        'manage_options',
        'edit_slider_template',
        'ova_elems_edit_slider_template_page'
    );
}
add_action('admin_menu', 'ova_elems_add_edit_page');


//i add 
// Redirect to Select Template Page for Add New

function ova_elems_redirect_add_new()
{
    global $pagenow;
    if ($pagenow == 'post-new.php' && isset($_GET['post_type']) && $_GET['post_type'] == 'ova_elems') {
        wp_redirect(admin_url('admin.php?page=select-template'));
        exit;
    }
}
add_action('admin_init', 'ova_elems_redirect_add_new');

// added new menue 

function ova_elems_slider_add_menu_pages()
{

    add_menu_page(
        'Ovation Elements',
        'OT Elements',
        'manage_options',
        'ovation_elements',
        'ova_elems_slider_dashboard_page', // Dashboard callback function
        'dashicons-admin-multisite',
        6 // Position in the menu
    );
    add_submenu_page(
        'ovation_elements',
        'Slider Templates',
        'Slider Templates',
        'manage_options',
        'select-template',
        'ova_elems_slider_select_template_page'
    );


    add_submenu_page(
        'ovation_elements',
        'All Sliders',
        'All Sliders',
        'manage_options',
        'edit.php?post_type=ova_elems',
        ''
    );


    // Check if the premium plugin is activated
    if (is_plugin_active('ovation-elements-pro/ovation-elements-pro.php')) {
        add_submenu_page(
            'ovation_elements',
            'License Key',
            'License Key',
            'manage_options',
            'license-key',
            'ova_elems_license_key_page'
        );
    } else {
        add_submenu_page(
            'ovation_elements',
            'Go Pro',
            'Go Pro',
            'manage_options',
            'ovation_elements',
            ''
        );
    }

    add_submenu_page(
        'edit.php?post_type=ova_elems',
        'Select Template',
        'Select Template',
        'manage_options',
        'select-template',
        'ova_elems_slider_select_template_page'
    );

    // Add different edit pages for each template
    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 1',
        'Edit Slider Template 1',
        'manage_options',
        'edit-slider-template-template1',
        'ova_elems_edit_page_template1'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 2',
        'Edit Slider Template 2',
        'manage_options',
        'edit-slider-template-template2',
        'ova_elems_edit_page_template2'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 3',
        'Edit Slider Template 3',
        'manage_options',
        'edit-slider-template-template3',
        'ova_elems_edit_page_template3'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 4',
        'Edit Slider Template 4',
        'manage_options',
        'edit-slider-template-template4',
        'ova_elems_edit_page_template4'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 5',
        'Edit Slider Template 5',
        'manage_options',
        'edit-slider-template-template5',
        'ova_elems_edit_page_template5'
    );



    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 6',
        'Edit Slider Template 6',
        'manage_options',
        'edit-slider-template-template6',
        'ova_elems_edit_page_template6'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 7',
        'Edit Slider Template 7',
        'manage_options',
        'edit-slider-template-template7',
        'ova_elems_edit_page_template7'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 8',
        'Edit Slider Template 8',
        'manage_options',
        'edit-slider-template-template8',
        'ova_elems_edit_page_template8'
    );

    add_submenu_page(
        'slider-templates',
        'Edit Slider Template 9',
        'Edit Slider Template 9',
        'manage_options',
        'edit-slider-template-template9',
        'ova_elems_edit_page_template9'
    );


}
add_action('admin_menu', 'ova_elems_slider_add_menu_pages');


// hide notice n ads
function ova_elems_hide_admin_notices()
{
    $screen = get_current_screen();
    $ova_plugin_pages = [
        'ovation_elements',
        'select-template',
        'edit-slider-template-template1',
        'edit-slider-template-template2',
        'edit-slider-template-template3',
        'edit-slider-template-template4',
        'edit-slider-template-template5',
        'edit-slider-template-template6',
        'edit-slider-template-template7',
        'edit-slider-template-template8',
        'edit-slider-template-template9',
    ];

    foreach ($ova_plugin_pages as $ova_page) {
        if (strpos($screen->id, $ova_page) !== false) {
            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');
            break;
        }
    }
}
add_action('admin_head', 'ova_elems_hide_admin_notices');


//add for dashboard page 
function ova_elems_slider_dashboard_page()
{
    ?>
    <div class="outer-container">
        <div class="ov-plugin-top" id="ov-top">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="227" height="72"
                viewBox="0 0 227 72">
                <defs>
                    <clipPath id="clip-path">
                        <rect id="Rectangle_191" data-name="Rectangle 191" width="61.162" height="59.822" fill="none" />
                    </clipPath>
                </defs>
                <g id="Group_28" data-name="Group 28" transform="translate(-199 -74)">
                    <g id="Group_14" data-name="Group 14" transform="translate(199 82.219)">
                        <g id="Group_13" data-name="Group 13" clip-path="url(#clip-path)">
                            <path id="Path_42" data-name="Path 42"
                                d="M120.213,0H105.239a6.554,6.554,0,0,0-6.545,6.548V29.911a6.553,6.553,0,0,0,6.545,6.545H120.19a6.553,6.553,0,0,0,6.545-6.545V8.441Zm1.851,29.911a1.873,1.873,0,0,1-1.873,1.87H105.239a1.871,1.871,0,0,1-1.87-1.87V6.548a1.873,1.873,0,0,1,1.87-1.873h13.626V7.143a1.243,1.243,0,0,0,1.172,1.3h2.026Z"
                                transform="translate(-66.652)" fill="#0023c4" />
                            <path id="Path_43" data-name="Path 43"
                                d="M14.208,115.5V96.339a4.208,4.208,0,0,1,4.208-4.208h-7.01A4.208,4.208,0,0,0,7.2,96.339V115.5a4.208,4.208,0,0,0,4.208,4.208h7.01a4.208,4.208,0,0,1-4.208-4.208"
                                transform="translate(-4.861 -62.22)" fill="#cee1f2" />
                            <path id="Path_44" data-name="Path 44"
                                d="M6.545,19.727H21.029c3.609,0,6.545-2.478,6.545-5.525V5.526C27.574,2.479,24.638,0,21.029,0H6.545C2.936,0,0,2.479,0,5.526V14.2c0,3.047,2.936,5.525,6.545,5.525M4.674,5.526a1.747,1.747,0,0,1,1.872-1.58H21.029A1.747,1.747,0,0,1,22.9,5.526V14.2a1.746,1.746,0,0,1-1.872,1.58H6.545A1.746,1.746,0,0,1,4.674,14.2Z"
                                transform="translate(0 -0.001)" fill="#0023c4" />
                            <path id="Path_45" data-name="Path 45"
                                d="M6.545,117.181H21.029a6.553,6.553,0,0,0,6.545-6.545V91.478a6.553,6.553,0,0,0-6.545-6.545H6.545A6.553,6.553,0,0,0,0,91.478v19.158a6.553,6.553,0,0,0,6.545,6.545m-1.872-25.7a1.874,1.874,0,0,1,1.872-1.872H21.029A1.874,1.874,0,0,1,22.9,91.478v19.158a1.874,1.874,0,0,1-1.872,1.872H6.545a1.874,1.874,0,0,1-1.872-1.872Z"
                                transform="translate(0 -57.359)" fill="#0023c4" />
                            <path id="Path_46" data-name="Path 46"
                                d="M41.509,69.206a1.868,1.868,0,1,1-1.868-1.868,1.868,1.868,0,0,1,1.868,1.868"
                                transform="translate(-25.51 -45.476)" fill="#0023c4" />
                            <circle id="Ellipse_1" data-name="Ellipse 1" cx="1.529" cy="1.529" r="1.529"
                                transform="translate(6.21 22.201)" fill="none" stroke="#0023c4" stroke-width="2" />
                            <circle id="Ellipse_2" data-name="Ellipse 2" cx="1.529" cy="1.529" r="1.529"
                                transform="translate(18.995 22.201)" fill="none" stroke="#0023c4" stroke-width="2" />
                            <path id="Path_47" data-name="Path 47"
                                d="M121.567,142.655a1.826,1.826,0,0,0-1.946,1.676v.876a2.01,2.01,0,0,1-1.825,2.152H101.579a2.01,2.01,0,0,1-1.825-2.152v-5.1a2.011,2.011,0,0,1,1.825-2.155h4.352a1.694,1.694,0,1,0,0-3.351H100.5c-2.669,0-4.834,2.56-4.834,5.719v4.676c0,3.158,2.165,5.718,4.834,5.718h18.373c2.669,0,4.834-2.56,4.834-5.718v-.661a1.826,1.826,0,0,0-1.946-1.676Z"
                                transform="translate(-64.608 -90.899)" fill="#ff5cf4" />
                            <path id="Path_48" data-name="Path 48"
                                d="M154.746,122.715l-5.808-6.031a.67.67,0,0,0-1.152.465v2.9h-.223a8.721,8.721,0,0,0-8.711,8.711v1.34a.661.661,0,0,0,.522.641.585.585,0,0,0,.147.018.693.693,0,0,0,.612-.381,7.328,7.328,0,0,1,6.592-4.074h1.062v2.9a.67.67,0,0,0,1.152.465l5.808-6.031a.671.671,0,0,0,0-.93"
                                transform="translate(-93.772 -78.663)" fill="#ff5cf4" />
                            <path id="Path_49" data-name="Path 49"
                                d="M63.3,27.955l.755-.755-.755-.755a.12.12,0,0,1,.17-.17l.84.84a.12.12,0,0,1,0,.17l-.84.84a.12.12,0,0,1-.17-.17"
                                transform="translate(-42.724 -17.721)" fill="#ff5cf4" />
                            <path id="Path_50" data-name="Path 50"
                                d="M63.3,27.955l.755-.755-.755-.755a.12.12,0,0,1,.17-.17l.84.84a.12.12,0,0,1,0,.17l-.84.84a.12.12,0,0,1-.17-.17Z"
                                transform="translate(-42.724 -17.721)" fill="none" stroke="#ff5cf4" stroke-width="1" />
                            <path id="Path_51" data-name="Path 51"
                                d="M17.964,27.955a.12.12,0,0,1-.17.17l-.84-.84a.12.12,0,0,1,0-.17l.84-.84a.12.12,0,0,1,.17.17l-.755.755Z"
                                transform="translate(-11.427 -17.721)" fill="#ff5cf4" />
                            <path id="Path_52" data-name="Path 52"
                                d="M17.964,27.955a.12.12,0,0,1-.17.17l-.84-.84a.12.12,0,0,1,0-.17l.84-.84a.12.12,0,0,1,.17.17l-.755.755Z"
                                transform="translate(-11.427 -17.721)" fill="none" stroke="#ff5cf4" stroke-width="1" />
                        </g>
                    </g>
                    <text id="OVATION_ELEMENTS" data-name="OVATION
                            ELEMENTS" transform="translate(275 74)" fill="#0023c4" font-size="30"
                        font-family="SegoeUI-Bold, Segoe UI" font-weight="700">
                        <tspan x="0" y="32">OVATION</tspan>
                        <tspan x="0" y="64">ELEMENTS</tspan>
                    </text>
                </g>
            </svg>
            <a href="<?php echo esc_url('https://www.ovationthemes.com/products/ovation-elements-pro'); ?>"
                class="ov-header-review-btn" target="_blank" rel="noopener noreferrer">Get Pro</a>
        </div>
        <!-- <div class="container mt-5"> -->
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="ova_elems_ovationSliderTabs" role="tablist"
            style="background-image:url('<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/images/nav-background.png'); ?>');">

            <li class="nav-item">
                <a class="nav-link" id="ova_elems_tab1-tab" data-toggle="tab" href="#ova_elems_tab1" role="tab"
                    aria-controls="ova_elems_tab1" aria-selected="true">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ova_elems_tab2-tab" data-toggle="tab" href="#ova_elems_tab2" role="tab"
                    aria-controls="ova_elems_tab2" aria-selected="false">Sliders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ova_elems_tab3-tab" data-toggle="tab" href="#ova_elems_tab3" role="tab"
                    aria-controls="ova_elems_tab3" aria-selected="false">Post Type</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ova_elems_tab4-tab" data-toggle="tab" href="#ova_elems_tab4" role="tab"
                    aria-controls="ova_elems_tab4" aria-selected="false">Page Builder</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="ova_elems_tab5-tab" data-toggle="tab" href="#ova_elems_tab5" role="tab"
                    aria-controls="ova_elems_tab5" aria-selected="false"> Block Themes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ova_elems_tab6-tab" data-toggle="tab" href="#ova_elems_tab6" role="tab"
                    aria-controls="ova_elems_tab6" aria-selected="false">Support</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="ova_elems_ovationSliderTabsContent">
            <div class="tab-pane fade" id="ova_elems_tab1" role="tabpanel" aria-labelledby="ova_elems_tab1-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab1.php'); ?>
            </div>

            <div class="tab-pane fade" id="ova_elems_tab2" role="tabpanel" aria-labelledby="ova_elems_tab2-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab2.php'); ?>
            </div>

            <div class="tab-pane fade" id="ova_elems_tab3" role="tabpanel" aria-labelledby="ova_elems_tab3-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab3.php'); ?>
            </div>

            <div class="tab-pane fade" id="ova_elems_tab4" role="tabpanel" aria-labelledby="ova_elems_tab4-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab4.php'); ?>
            </div>

            <div class="tab-pane fade show active" id="ova_elems_tab5" role="tabpanel" aria-labelledby="ova_elems_tab5-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab5.php'); ?>
            </div>

            <div class="tab-pane fade" id="ova_elems_tab6" role="tabpanel" aria-labelledby="ova_elems_tab6-tab">
                <?php include(plugin_dir_path(__FILE__) . 'ova-elems-tab6.php'); ?>
            </div>
        </div>
    </div>
    <?php
}


//end

//addded for tabs end 

function ova_elems_handle_template_selection()
{
    // Verify nonce
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'ova_elems_template_selection')) {
        wp_die(esc_html__('Security check failed.', 'ovation-elements'));
    }

    if (!current_user_can('edit_posts')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'ovation-elements'));
    }

    if (isset($_GET['template_id'])) {
        $template_id = absint($_GET['template_id']);

        // Create a new post of type 'ova_elems'
        $post_id = wp_insert_post(
            array(
                'post_title' => 'New Slider',
                'post_type' => 'ova_elems',
                'post_status' => 'publish',
            )
        );

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_ova_elems_template_id', $template_id);

            wp_redirect(admin_url('edit.php?post_type=ova_elems&page=edit_slider_template&post=' . $post_id));
            exit;
        }
    }

    wp_redirect(admin_url('admin.php?page=select-template'));
    exit;
}
add_action('admin_post_select_template', 'ova_elems_handle_template_selection');


//changes here by removing old for trash 
function ova_elems_custom_trash_action()
{
    if (
        is_admin() &&
        isset($_GET['action'], $_GET['post']) &&
        $_GET['action'] === 'trash' &&
        get_post_type($_GET['post']) === 'ova_elems'
    ) {
        if (!current_user_can('delete_posts')) {
            wp_die(esc_html__('You do not have sufficient permissions to perform this action.', 'ovation-elements'));
        }

        $post_id = absint($_GET['post']);
        if (current_user_can('delete_post', $post_id)) {
            wp_trash_post($post_id);
            wp_redirect(admin_url('edit.php?post_type=ova_elems'));
            exit;
        }
    }
}
add_action('admin_init', 'ova_elems_custom_trash_action');

// Add columns to the post list
function ova_elems_add_custom_columns($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key == 'title') {
            $new_columns['custom_template'] = 'Template';
            $new_columns['shortcode'] = 'Shortcode'; // Adding new column for shortcode
        }
    }
    return $new_columns;
}
add_filter('manage_ova_elems_posts_columns', 'ova_elems_add_custom_columns');

// Populate custom columns with data

function ova_elems_custom_column_data($column, $post_id)
{
    if ($column == 'custom_template') {
        $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
        echo $template_id ? 'Template ' . esc_html($template_id) : 'N/A';
    } elseif ($column == 'shortcode') {
        $is_premium_user = get_option('ovation_slider_is_premium', false);

        $args = array(
            'post_type' => 'ova_elems',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        );
        $existing_sliders = get_posts($args);
        $free_sliders = array_slice($existing_sliders, 0, 100);
        $is_locked = true;
        if ($is_premium_user) {
            $is_locked = false;
        } else {
            foreach ($free_sliders as $free_slider) {
                if ($free_slider->ID == $post_id) {
                    $is_locked = false;
                    break;
                }
            }
        }

        if ($is_locked) {
            echo '<span class="dashicons dashicons-lock"></span> ' . esc_html__('Locked', 'ovation-elements');
        } else {
            echo '[ova-elems-slider-template id="' . esc_attr($post_id) . '"]';
        }
    }
}
add_action('manage_ova_elems_posts_custom_column', 'ova_elems_custom_column_data', 10, 2);


//end 
add_action('admin_menu', 'ova_elems_register_edit_page');
function ova_elems_register_edit_page()
{
    add_menu_page(
        'Edit Slider Template',
        //'Edit Slider',
        'manage_options',
        'edit-slider-template',
        'ova_elems_edit_page_callback'
    );
}

function ova_elems_edit_page_callback()
{
    // Include the edit page file
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template.php');


}

//new one i add

function ova_elems_edit_page_template1()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template1.php');
}

function ova_elems_edit_page_template2()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template2.php');
}

function ova_elems_edit_page_template3()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template3.php');
}

function ova_elems_edit_page_template4()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template4.php');
}

function ova_elems_edit_page_template5()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template5.php');
}

function ova_elems_edit_page_template6()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template6.php');
}

function ova_elems_edit_page_template7()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template7.php');
}

function ova_elems_edit_page_template8()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template8.php');
}

function ova_elems_edit_page_template9()
{
    include(plugin_dir_path(__FILE__) . 'templates/edit-slider-template9.php');
}

//end 

//new redirect_to_edit_link
add_action('admin_init', 'ova_elems_redirect_to_edit_page');
function ova_elems_redirect_to_edit_page()
{
    global $pagenow;
    if ($pagenow == 'post.php' && isset($_GET['post']) && get_post_type(absint($_GET['post'])) == 'ova_elems') {
        $post_id = intval($_GET['post']);
        $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
        switch ($template_id) {
            case 1:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template1&post=' . $post_id));
                break;
            case 2:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template2&post=' . $post_id));
                break;
            case 3:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template3&post=' . $post_id));
                break;
            case 4:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template4&post=' . $post_id));
                break;
            case 5:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template5&post=' . $post_id));
                break;

            case 6:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template6&post=' . $post_id));
                break;
            case 7:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template7&post=' . $post_id));
                break;
            case 8:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template8&post=' . $post_id));
                break;
            case 9:
                wp_redirect(admin_url('admin.php?page=edit-slider-template-template9&post=' . $post_id));
                break;


            default:
                wp_redirect(admin_url('admin.php?page=edit-slider-template&post=' . $post_id));
                break;
        }
        exit;
    }
}

//edit 

add_filter('post_row_actions', 'ova_elems_edit_link', 10, 2);
function ova_elems_edit_link($actions, $post)
{
    if ($post->post_type == 'ova_elems') {
        $template_id = get_post_meta($post->ID, '_ova_elems_template_id', true);
        switch ($template_id) {
            case 1:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template1&post=' . $post->ID);
                break;
            case 2:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template2&post=' . $post->ID);
                break;
            case 3:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template3&post=' . $post->ID);
                break;
            case 4:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template4&post=' . $post->ID);
                break;
            case 5:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template5&post=' . $post->ID);
                break;

            case 6:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template6&post=' . $post->ID);
                break;
            case 7:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template7&post=' . $post->ID);
                break;

            case 8:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template8&post=' . $post->ID);
                break;
            case 9:
                $edit_link = admin_url('admin.php?page=edit-slider-template-template9&post=' . $post->ID);
                break;

            default:
                $edit_link = admin_url('admin.php?page=edit-slider-template&post=' . $post->ID);
                break;
        }
        $actions['edit'] = '<a href="' . esc_url($edit_link) . '">Edit</a>';
    }
    return $actions;
}
//end


// Template Selection Page
function ova_elems_slider_select_template_page()
{
    $is_premium_user = get_option('ovation_slider_is_premium', false);
    ?>
    <div class="wrap">
        <div class="heading-container">
            <div class="container-custom">
                <h1>Select a Template</h1>
            </div>
        </div>
        <div class="container-custom">
            <div class="row">
                <?php
                $templates = array(
                    array('id' => 1, 'title' => 'Business Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-1.png'),
                    array('id' => 2, 'title' => 'Travel Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-2.png'),
                    array('id' => 3, 'title' => 'Ecommerce Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-3.png'),
                    array('id' => 4, 'title' => 'News Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-4.png'),
                    array('id' => 5, 'title' => 'Food Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-5.png'),
                    array('id' => 6, 'title' => 'Restaurant Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-6.png'),
                    array('id' => 7, 'title' => 'Travel Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-7.png'),
                    array('id' => 8, 'title' => 'Education Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-8.png'),
                    array('id' => 9, 'title' => 'Business Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-9.png'),
                    array('id' => 10, 'title' => 'E-commerce Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-10.png'),
                    array('id' => 11, 'title' => 'Travel Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-11.png'),
                    array('id' => 12, 'title' => 'Restaurant Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-12.png'),
                    array('id' => 13, 'title' => 'Ecommerce Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-13.png'),
                    array('id' => 14, 'title' => 'Business Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-14.png'),
                    array('id' => 15, 'title' => 'Education Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-15.png'),

                );

                foreach ($templates as $template) {
                    $is_pro_template = in_array($template['id'], [6, 7, 8, 9]); // Mark templates 6, 7, 8 as Pro only
                    ?>
                    <div class="col-md-4 col-lg-4 col-12 mb-4">
                        <div class="slider-card" style="">
                            <div class="slider-image">
                                <img class="card-img-top" src="<?php echo esc_url($template['image']); ?>"
                                    alt="<?php echo esc_attr($template['title']); ?>">
                            </div>

                            <!-- i change -->
                            <div class="heading-wrapper mt-2">
                                <h5 class="card-title"><?php echo esc_html($template['title']); ?></h5>

                                <div class="template-actions">
                                    <?php
                                    $coming_soon_ids = [10, 11, 12, 13, 14, 15];

                                    if (in_array($template['id'], $coming_soon_ids)) {
                                        // echo '<div class="ot-elems-coming-soon">';
                                        if (!$is_premium_user) {
                                            echo '<a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" class="btn btn-primary">Upgrade to Pro</a>';
                                        } else {
                                            echo '<button class="btn btn-secondary" disabled>Select Template</button>';
                                        }
                                        echo '<img src="' . esc_url(OVA_ELEMS_URL . 'assets/images/coming-soon.png') . '" alt="" class="coming-soon-image" />';
                                        // echo '</div>';
                                    } elseif (!$is_premium_user && $is_pro_template) {
                                        echo '<a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" class="btn btn-primary">Upgrade to Pro</a>';
                                    } else {
                                        echo '<a href="' . esc_url(admin_url('admin-post.php?action=create_ova_elems&template_id=' . $template['id'])) . '" class="btn btn-primary">Select Template</a>';
                                    }

                                    // Badge section
                                    if (!in_array($template['id'], $coming_soon_ids)) {
                                        if ($is_pro_template) {
                                            echo '<span class="oe-crown"><i class="fa-solid fa-crown"></i> PRO</span>';
                                        } else {
                                            echo '<span class="badge oe-free">FREE</span>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- end -->
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

//new handle  slider 

function ova_elems_handle_create_slider()
{
    if (!current_user_can('edit_posts')) {
        wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'ovation-elements'));
    }

    if (isset($_GET['template_id'])) {
        $template_id = absint($_GET['template_id']);

        // Create a new post of type 'ova_elems'
        $post_id = wp_insert_post(
            array(
                'post_title' => 'New Slider', // Default title, can be updated later
                'post_type' => 'ova_elems',
                'post_status' => 'publish',
            )
        );

        // Save the template ID as post meta
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_ova_elems_template_id', $template_id);

            // Redirect to the specific edit page based on template ID
            switch ($template_id) {
                case 1:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template1&post=' . $post_id));
                    break;
                case 2:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template2&post=' . $post_id));
                    break;
                case 3:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template3&post=' . $post_id));
                    break;
                case 4:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template4&post=' . $post_id));
                    break;
                case 5:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template5&post=' . $post_id));
                    break;
                case 6:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template6&post=' . $post_id));
                    break;
                case 7:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template7&post=' . $post_id));
                    break;
                case 8:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template8&post=' . $post_id));
                    break;
                case 9:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template-template9&post=' . $post_id));
                    break;



                default:
                    wp_redirect(admin_url('admin.php?page=edit-slider-template&post=' . $post_id));
                    break;
            }
            exit;
        }
    }

    wp_redirect(admin_url('admin.php?page=select-template'));
    exit;
}
add_action('admin_post_create_ova_elems', 'ova_elems_handle_create_slider');

function ova_elems_save_data()
{
    // Verify nonce
    if (!isset($_POST['ova_elems_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ova_elems_nonce'])), 'ova_elems_save_meta_boxes_data')) {
        wp_die(esc_html__('Nonce verification failed.', 'ovation-elements'));
    }

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
    }

    if (!current_user_can('edit_post', $post_id)) {
        wp_die(esc_html__('You do not have sufficient permissions to edit this post.', 'ovation-elements'));
    }

    // Retrieve and sanitize slide data
    $slides = [];
    $slide_titles = isset($_POST['slide_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_titles'])) : [];
    $slide_descriptions = isset($_POST['slide_descriptions']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_descriptions'])) : [];
    $slide_images = isset($_POST['slide_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_images'])) : [];
    $slide_button_texts = isset($_POST['slide_button_texts']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_button_texts'])) : [];
    $slide_button_urls = isset($_POST['slide_button_urls']) ? array_map('esc_url_raw', wp_unslash($_POST['slide_button_urls'])) : [];

    $slide_button2_texts = isset($_POST['slide_button2_texts']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_button2_texts'])) : [];
    $slide_button2_urls = isset($_POST['slide_button2_urls']) ? array_map('esc_url_raw', wp_unslash($_POST['slide_button2_urls'])) : [];
    $slide_thumbnail_images = isset($_POST['slide_thumbnail_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_thumbnail_images'])) : [];
    $slide_thumbnail_titles = isset($_POST['slide_thumbnail_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_thumbnail_titles'])) : [];

    $slide_head_tags = isset($_POST['slide_head_tags']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_head_tags'])) : [];
    $slide_mini_head_images = isset($_POST['slide_mini_head_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_head_images'])) : [];

    $slide_courses = isset($_POST['slide_courses']) ? array_map('intval', wp_unslash($_POST['slide_courses'])) : []; // Added line
    $slide_bg_color = isset($_POST['slide_bg_color']) ? array_map('sanitize_hex_color', wp_unslash($_POST['slide_bg_color'])) : [];


    foreach ($slide_titles as $index => $title) {
        $slides[] = [
            'title' => $title,
            'description' => $slide_descriptions[$index] ?? '',
            'image_id' => $slide_images[$index] ?? '',
            'button_text' => $slide_button_texts[$index] ?? '',
            'button_url' => $slide_button_urls[$index] ?? '',
            'button2_text' => $slide_button2_texts[$index] ?? '',
            'button2_url' => $slide_button2_urls[$index] ?? '',
            'thumbnail_image_id' => $slide_thumbnail_images[$index] ?? '',
            'thumbnail_title' => $slide_thumbnail_titles[$index] ?? '',
            'head_tag' => $slide_head_tags[$index] ?? '',
            'mini_head_image' => $slide_mini_head_images[$index] ?? '', // New setting
            'course_id' => $slide_courses[$index] ?? '', // Added field
            'slide_bg_color' => $slide_bg_color[$index] ?? '',
        ];
    }

    // print_r($slides);
    // exit;

    update_post_meta($post_id, '_ova_elems_slides', maybe_serialize($slides));

    // Retrieve and sanitize static settings data
    $static_settings = [];
    $slide_corner_images = isset($_POST['slide_corner_images']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_corner_images'])) : [];
    $slide_mini_titles = isset($_POST['slide_mini_titles']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_titles'])) : [];
    $slide_mini_descriptions = isset($_POST['slide_mini_descriptions']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_mini_descriptions'])) : [];
    $slide_mini_title2 = isset($_POST['slide_mini_title2']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_title2'])) : [];
    $slide_mini_description2 = isset($_POST['slide_mini_description2']) ? array_map('sanitize_textarea_field', wp_unslash($_POST['slide_mini_description2'])) : [];
    $slide_email = isset($_POST['slide_email']) ? sanitize_email(wp_unslash($_POST['slide_email'])) : '';
    $slide_no = isset($_POST['slide_no']) ? sanitize_text_field(wp_unslash($_POST['slide_no'])) : '';
    $background_color = isset($_POST['background_color']) ? sanitize_hex_color(wp_unslash($_POST['background_color'])) : '';
    $slide_mini_images_1 = isset($_POST['slide_mini_images_1']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_images_1'])) : [];
    $slide_mini_images_2 = isset($_POST['slide_mini_images_2']) ? array_map('sanitize_text_field', wp_unslash($_POST['slide_mini_images_2'])) : [];
    $instagram_url = isset($_POST['instagram_url']) ? esc_url_raw(wp_unslash($_POST['instagram_url'])) : '';
    $facebook_url = isset($_POST['facebook_url']) ? esc_url_raw(wp_unslash($_POST['facebook_url'])) : '';
    $youtube_url = isset($_POST['youtube_url']) ? esc_url_raw(wp_unslash($_POST['youtube_url'])) : '';
    $basketball_url = isset($_POST['basketball_url']) ? esc_url_raw(wp_unslash($_POST['basketball_url'])) : '';
    $twitter_url = isset($_POST['twitter_url']) ? esc_url_raw(wp_unslash($_POST['twitter_url'])) : '';
    $list_title = isset($_POST['list_title']) ? sanitize_text_field(wp_unslash($_POST['list_title'])) : '';
    $list_description = isset($_POST['list_description']) ? sanitize_textarea_field(wp_unslash($_POST['list_description'])) : '';
    $enter_list = isset($_POST['enter_list']) ? array_map('sanitize_text_field', array_map('trim', explode(',', wp_unslash($_POST['enter_list'])))) : [];
    $ov_template_review_text = isset($_POST['ov_template_review_text']) ? sanitize_text_field(wp_unslash($_POST['ov_template_review_text'])) : '';
    $ov_template_social_review_text = isset($_POST['ov_template_social_review_text']) ? sanitize_text_field(wp_unslash($_POST['ov_template_social_review_text'])) : '';
    //$ov_template_review_no = isset($_POST['ov_template_review_no']) ? intval(wp_unslash($_POST['ov_template_review_no'])) : 0;
    $ov_template_review_no = isset($_POST['ov_template_review_no']) ? sanitize_text_field(wp_unslash($_POST['ov_template_review_no'])) : '';
    $slide_video_url = isset($_POST['slide_video_url']) ? esc_url_raw(wp_unslash($_POST['slide_video_url'])) : '';
    $static_button_text = isset($_POST['static_button_text']) ? sanitize_text_field(wp_unslash($_POST['static_button_text'])) : '';
    $static_button_url = isset($_POST['static_button_url']) ? esc_url_raw(wp_unslash($_POST['static_button_url'])) : '';
    $static_button2_text = isset($_POST['static_button2_text']) ? sanitize_text_field(wp_unslash($_POST['static_button2_text'])) : '';
    $static_button2_url = isset($_POST['static_button2_url']) ? esc_url_raw(wp_unslash($_POST['static_button2_url'])) : '';
    $banner_font_size = isset($_POST['banner_font_size']) ? intval($_POST['banner_font_size']) : 18;
    $heading_font_size = isset($_POST['heading_font_size']) ? intval($_POST['heading_font_size']) : 18;
    $head_font_size = isset($_POST['head_font_size']) ? intval($_POST['head_font_size']) : 18;
    $button_font_size = isset($_POST['button_font_size']) ? intval($_POST['button_font_size']) : 18;
    $button2_font_size = isset($_POST['button2_font_size']) ? intval($_POST['button2_font_size']) : 18;
    $ov_mini_title_font_size = isset($_POST['ov_mini_title_font_size']) ? intval($_POST['ov_mini_title_font_size']) : 18;
    $mini_description_font_size = isset($_POST['mini_description_font_size']) ? intval($_POST['mini_description_font_size']) : 18;
    $slide_email_font_size = isset($_POST['slide_email_font_size']) ? intval($_POST['slide_email_font_size']) : 18;
    $slide_no_font_size = isset($_POST['slide_no_font_size']) ? intval($_POST['slide_no_font_size']) : 18;
    $list_title_font_size = isset($_POST['list_title_font_size']) ? intval($_POST['list_title_font_size']) : 'initial';
    $list_description_font_size = isset($_POST['list_description_font_size']) ? intval($_POST['list_description_font_size']) : 'initial';
    $list_content_font_size = isset($_POST['list_content_font_size']) ? intval($_POST['list_content_font_size']) : 'initial';
    $review_text_font_size = isset($_POST['review_text_font_size']) ? intval($_POST['review_text_font_size']) : 18;  // New setting
    $review_no_font_size = isset($_POST['review_no_font_size']) ? intval($_POST['review_no_font_size']) : 18;  // New setting
    $static_button_text_font_size = isset($_POST['static_button_text_font_size']) ? intval($_POST['static_button_text_font_size']) : 18;
    $title_head_font_size = isset($_POST['title_head_font_size']) ? intval($_POST['title_head_font_size']) : 20;
    $static_loader_percentage = isset($_POST['static_loader_percentage']) ? intval($_POST['static_loader_percentage']) : 90;
    $ov_review_text_font_size = isset($_POST['ov_review_text_font_size']) ? intval($_POST['ov_review_text_font_size']) : 18;
    $ov_social_text_font_size = isset($_POST['ov_social_text_font_size']) ? intval($_POST['ov_social_text_font_size']) : 18;
    $video_bg_image = isset($_POST['video_bg_image']) ? esc_url($_POST['video_bg_image']) : '';
    $bg_slide_image = isset($_POST['bg_slide_image']) ? esc_url($_POST['bg_slide_image']) : '';


    $static_settings = [
        'corner_images' => $slide_corner_images,
        'mini_titles' => $slide_mini_titles,
        'mini_descriptions' => $slide_mini_descriptions,
        'mini_title2' => $slide_mini_title2,
        'mini_description2' => $slide_mini_description2,
        'slide_email' => $slide_email,
        'slide_no' => $slide_no,
        'background_color' => $background_color,
        'mini_images_1' => $slide_mini_images_1,
        'mini_images_2' => $slide_mini_images_2,
        'instagram_url' => $instagram_url,
        'facebook_url' => $facebook_url,
        'youtube_url' => $youtube_url,
        'basketball_url' => $basketball_url,
        'twitter_url' => $twitter_url,
        'slide_video_url' => $slide_video_url,
        'list_title' => $list_title,
        'list_description' => $list_description,
        'enter_list' => $enter_list,
        'ov_template_review_text' => $ov_template_review_text,
        'ov_template_social_review_text' => $ov_template_social_review_text,
        'ov_template_review_no' => $ov_template_review_no,
        'static_button_text' => $static_button_text,
        'static_button_url' => $static_button_url,
        'static_button2_text' => $static_button2_text,
        'static_button2_url' => $static_button2_url,
        'background_color' => $background_color,
        'banner_font_size' => $banner_font_size,
        'heading_font_size' => $heading_font_size,
        'head_font_size' => $head_font_size,
        'button_font_size' => $button_font_size,
        'button2_font_size' => $button2_font_size,
        'ov_mini_title_font_size' => $ov_mini_title_font_size,
        'mini_description_font_size' => $mini_description_font_size,
        'slide_email_font_size' => $slide_email_font_size,
        'slide_no_font_size' => $slide_no_font_size,
        'list_title_font_size' => $list_title_font_size,
        'list_description_font_size' => $list_description_font_size,
        'list_content_font_size' => $list_content_font_size,
        'review_text_font_size' => $review_text_font_size,
        'review_no_font_size' => $review_no_font_size,
        'static_button_text_font_size' => $static_button_text_font_size,
        'title_head_font_size' => $title_head_font_size,
        'static_loader_percentage' => $static_loader_percentage,
        'ov_review_text_font_size' => $ov_review_text_font_size,
        'ov_social_text_font_size' => $ov_social_text_font_size,
        'video_bg_image' => $video_bg_image,
        'bg_slide_image' => $bg_slide_image




    ];

    update_post_meta($post_id, '_ova_elems_static_settings', maybe_serialize($static_settings));

    // Redirect to the edit page after saving
    wp_redirect(admin_url('edit.php?post_type=ova_elems'));
    exit;
}
add_action('admin_post_save_ova_elems_data', 'ova_elems_save_data');



//templat4 save data 

function ova_elems_save_template4_data()
{
    // Verify nonce
    if (!isset($_POST['ova_elems_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ova_elems_nonce'])), 'ova_elems_save_meta_boxes_data')) {
        wp_die(esc_html__('Nonce verification failed.', 'ovation-elements'));
    }

    // Get post ID
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
    }

    // Sanitize and save selected posts
    $selected_posts = isset($_POST['selected_posts']) ? array_map('intval', (array) $_POST['selected_posts']) : array();
    update_post_meta($post_id, '_ova_elems_selected_posts_template4', maybe_serialize($selected_posts));

    //newly add
    $button_data = isset($_POST['button_data']) ? array_map(function ($data) {
        return [
            'text' => sanitize_text_field($data['text'] ?? ''),
            'url' => esc_url_raw($data['url'] ?? ''),
            'text2' => sanitize_text_field($data['text2'] ?? ''), // Button2 Text
            'url2' => esc_url_raw($data['url2'] ?? ''),          // Button2 URL
            'video' => esc_url_raw($data['video'] ?? ''),
        ];
    }, $_POST['button_data']) : [];



    update_post_meta($post_id, '_ova_elems_button_data_template4', maybe_serialize($button_data));

    $tour_info_data = isset($_POST['tour_info_data']) ? array_map('sanitize_textarea_field', (array) $_POST['tour_info_data']) : [];

    update_post_meta($post_id, '_ova_elems_tour_info_data_template4', maybe_serialize($tour_info_data));


    //new for vedio link
    $video_data = isset($_POST['video_data']) ? array_map(function ($data) {
        return [
            'live_link' => esc_url_raw($data['live_link'] ?? ''),
            'upload_video' => esc_url_raw($data['upload_video'] ?? ''), // Uploaded Video URL
        ];
    }, $_POST['video_data']) : [];

    // Save the live video link data
    update_post_meta($post_id, '_ova_elems_video_data_template4', maybe_serialize($video_data));


    //newly end

    // Sanitize and save static settings
    $static_settings = array(
        'instagram_url' => isset($_POST['instagram_url']) ? esc_url_raw(wp_unslash($_POST['instagram_url'])) : '',
        'facebook_url' => isset($_POST['facebook_url']) ? esc_url_raw(wp_unslash($_POST['facebook_url'])) : '',
        'youtube_url' => isset($_POST['youtube_url']) ? esc_url_raw(wp_unslash($_POST['youtube_url'])) : '',
        'basketball_url' => isset($_POST['basketball_url']) ? esc_url_raw(wp_unslash($_POST['basketball_url'])) : '',
        'twitter_url' => isset($_POST['twitter_url']) ? esc_url_raw(wp_unslash($_POST['twitter_url'])) : '',
        'ov_template_review_text' => isset($_POST['ov_template_review_text']) ? sanitize_textarea_field(wp_unslash($_POST['ov_template_review_text'])) : '',
        'mini_description' => isset($_POST['mini_description']) ? sanitize_textarea_field(wp_unslash($_POST['mini_description'])) : '',
        'live_video_link' => isset($_POST['live_video_link']) ? esc_url_raw(wp_unslash($_POST['live_video_link'])) : '',
        'live_mini_text' => isset($_POST['live_mini_text']) ? sanitize_text_field(wp_unslash($_POST['live_mini_text'])) : '',
        'live_title_text' => isset($_POST['live_title_text']) ? sanitize_text_field(wp_unslash($_POST['live_title_text'])) : '',
        'corner_posts_count' => isset($_POST['corner_posts_count']) ? absint(wp_unslash($_POST['corner_posts_count'])) : 1,
        'corner_posts_category' => isset($_POST['corner_posts_category']) ? absint(wp_unslash($_POST['corner_posts_category'])) : '',
        'corner_posts_order' => isset($_POST['corner_posts_order']) ? sanitize_text_field(wp_unslash($_POST['corner_posts_order'])) : 'asc',
        'upload_minheadimage' => isset($_POST['upload_minheadimage']) ? esc_url_raw(wp_unslash($_POST['upload_minheadimage'])) : '',
        'ov_travel_head_tag' => isset($_POST['ov_travel_head_tag']) ? sanitize_text_field(wp_unslash($_POST['ov_travel_head_tag'])) : '',
        'ov_static_title' => isset($_POST['ov_static_title']) ? sanitize_text_field(wp_unslash($_POST['ov_static_title'])) : '',
        'static_description' => isset($_POST['static_description']) ? sanitize_textarea_field(wp_unslash($_POST['static_description'])) : '',
        'ov_button_text' => isset($_POST['ov_button_text']) ? sanitize_text_field(wp_unslash($_POST['ov_button_text'])) : '',
        'ov_button_url' => isset($_POST['ov_button_url']) ? esc_url_raw(wp_unslash($_POST['ov_button_url'])) : '',
        'ov_client_image' => isset($_POST['ov_client_image']) ? esc_url_raw(wp_unslash($_POST['ov_client_image'])) : '',
        'ov_review_text' => isset($_POST['ov_review_text']) ? sanitize_text_field(wp_unslash($_POST['ov_review_text'])) : '',
        'ov_review_no' => isset($_POST['ov_review_no']) ? sanitize_text_field(wp_unslash($_POST['ov_review_no'])) : '',
        'banner_font_size' => isset($_POST['banner_font_size']) ? absint(wp_unslash($_POST['banner_font_size'])) : 50,
        'heading_font_size' => isset($_POST['heading_font_size']) ? absint(wp_unslash($_POST['heading_font_size'])) : 50,
        'button_font_size' => isset($_POST['button_font_size']) ? absint(wp_unslash($_POST['button_font_size'])) : 18,
        // New font size settings
        'ov_social_text_font_size' => isset($_POST['ov_social_text_font_size']) ? absint(wp_unslash($_POST['ov_social_text_font_size'])) : 18,
        'ov_review_text_font_size' => isset($_POST['ov_review_text_font_size']) ? absint(wp_unslash($_POST['ov_review_text_font_size'])) : 18,
        'title_head_font_size' => isset($_POST['title_head_font_size']) ? absint(wp_unslash($_POST['title_head_font_size'])) : 18,
        'list_title_font_size' => isset($_POST['list_title_font_size']) ? absint(wp_unslash($_POST['list_title_font_size'])) : 18,
        'list_description_font_size' => isset($_POST['list_description_font_size']) ? absint(wp_unslash($_POST['list_description_font_size'])) : 18,
        'list_content_font_size' => isset($_POST['list_content_font_size']) ? absint(wp_unslash($_POST['list_content_font_size'])) : 18,
        'static_button_text_font_size' => isset($_POST['static_button_text_font_size']) ? absint(wp_unslash($_POST['static_button_text_font_size'])) : 18,
        'review_text_font_size' => isset($_POST['review_text_font_size']) ? absint(wp_unslash($_POST['review_text_font_size'])) : 18,
        'review_no_font_size' => isset($_POST['review_no_font_size']) ? absint(wp_unslash($_POST['review_no_font_size'])) : 18,
        'ov_mini_title_font_size' => isset($_POST['ov_mini_title_font_size']) ? absint(wp_unslash($_POST['ov_mini_title_font_size'])) : 18,
        'oe_button_font_size' => isset($_POST['oe_button_font_size']) ? absint(wp_unslash($_POST['oe_button_font_size'])) : 18,
        'ov_mini_title_right_font_size' => isset($_POST['ov_mini_title_right_font_size']) ? absint(wp_unslash($_POST['ov_mini_title_right_font_size'])) : 14,
        'ov_mini_description_font_size' => isset($_POST['ov_mini_description_font_size']) ? absint(wp_unslash($_POST['ov_mini_description_font_size'])) : 18,
        'thmhead_font_size' => isset($_POST['thmhead_font_size']) ? absint(wp_unslash($_POST['thmhead_font_size'])) : 18,
        'thmbtitle_font_size' => isset($_POST['thmbtitle_font_size']) ? absint(wp_unslash($_POST['thmbtitle_font_size'])) : 18,
        'thmbdesc_font_size' => isset($_POST['thmbdesc_font_size']) ? absint(wp_unslash($_POST['thmbdesc_font_size'])) : 18,
        'live_mini_text_font_size' => isset($_POST['live_mini_text_font_size']) ? intval($_POST['live_mini_text_font_size']) : 18,
        'live_title_font_size' => isset($_POST['live_title_font_size']) ? intval($_POST['live_title_font_size']) : 18,
        'oe_left_side_title_font_size' => isset($_POST['oe_left_side_title_font_size']) ? intval($_POST['oe_left_side_title_font_size']) : 18,
    );

    update_post_meta($post_id, '_ova_elems_static_settings_template4', maybe_serialize($static_settings));


    wp_redirect(admin_url('edit.php?post_type=ova_elems'));
}
add_action('admin_post_save_ova_elems_template4_data', 'ova_elems_save_template4_data');
//end 


//for shortcode 
function ova_elems_template_shortcode($atts)
{
    return ova_elems_shortcode_handler($atts);
}

add_shortcode('ova-elems-slider-template', 'ova_elems_template_shortcode');

//for stylesheets according to different templates add
function ova_elems_maybe_enqueue_assets()
{
    if (is_admin()) {
        return;
    }
    global $post;
    if (!isset($post) || !is_a($post, 'WP_Post')) {
        return;
    }

    // Check if the post content has the shortcode
    if (has_shortcode($post->post_content, 'ova-elems-slider-template')) {
        add_action('wp_enqueue_scripts', 'ova_elems_enqueue_styles');
    }
}
add_action('wp', 'ova_elems_maybe_enqueue_assets');

function ova_elems_enqueue_styles()
{
    wp_enqueue_style(
        'swiper-css',
        OVA_ELEMS_URL . 'assets/css/swiper-bundle.min.css',
        [],
        OVA_ELEMS_VER
    );
    wp_enqueue_script(
        'swiper-js',
        OVA_ELEMS_URL . 'assets/js/swiper-bundle.min.js',
        [],
        OVA_ELEMS_VER,
        true
    );

    wp_enqueue_style(
        'oe-front-cs',
        OVA_ELEMS_URL . 'assets/css/bootstrap.min.css',
        [],
        OVA_ELEMS_VER
    );
    wp_enqueue_script(
        'oe-front-js',
        OVA_ELEMS_URL . 'assets/js/bootstrap.bundle.min.js',
        [],
        OVA_ELEMS_VER,
        true
    );

    wp_enqueue_style('ova-elems-google-fonts-montserrat-outfit', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap', array(), OVA_ELEMS_VER, '');
    wp_enqueue_style('ova-elems-font-awesome', OVA_ELEMS_URL . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
}
// end 

//for color picker
function enqueue_wp_color_picker_assets($hook)
{
    // Enqueue color picker CSS and JS
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'enqueue_wp_color_picker_assets');

//end


//for compressor and croping 
add_action('wp_ajax_upload_cropped_image', 'handle_cropped_image_upload');

function handle_cropped_image_upload()
{
    // Verify nonce
    if (!isset($_POST['_ajax_nonce']) || !wp_verify_nonce($_POST['_ajax_nonce'], 'upload_cropped_image_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
        wp_die();
    }

    // Check user capabilities
    if (!current_user_can('upload_files')) {
        wp_send_json_error(['message' => 'Insufficient permissions']);
        wp_die();
    }

    if (!isset($_FILES['cropped_image']) || empty($_FILES['cropped_image'])) {
        wp_send_json_error(['message' => 'No image file provided.']);
        wp_die();
    }

    $file = $_FILES['cropped_image'];

    // Validate the file
    if ($file['error'] !== UPLOAD_ERR_OK) {
        wp_send_json_error(['message' => 'Error uploading file.']);
        wp_die();
    }

    $upload = wp_handle_upload($file, ['test_form' => false]);

    if (!$upload || isset($upload['error'])) {
        wp_send_json_error(['message' => 'Failed to upload image.', 'error' => $upload['error']]);
        wp_die();
    }

    // Insert the uploaded image into the WordPress media library
    $attachment_id = wp_insert_attachment([
        'guid' => $upload['url'],
        'post_mime_type' => $upload['type'],
        'post_title' => sanitize_file_name($file['name']),
        'post_content' => '',
        'post_status' => 'inherit',
    ], $upload['file']);

    if (is_wp_error($attachment_id)) {
        wp_send_json_error(['message' => 'Failed to insert image into media library.']);
        wp_die();
    }

    // Generate attachment metadata and update
    require_once ABSPATH . 'wp-admin/includes/image.php';
    $metadata = wp_generate_attachment_metadata($attachment_id, $upload['file']);
    wp_update_attachment_metadata($attachment_id, $metadata);

    wp_send_json_success(['message' => 'Image uploaded successfully!', 'url' => $upload['url']]);
    wp_die();
}



//for tutor plugin installation 

add_action('wp_ajax_tutor_plugin_action', function () {
    check_ajax_referer('tutor-plugin-action', 'nonce');

    $action = $_POST['action_type'] ?? '';
    $response = ['success' => false, 'message' => '', 'is_active' => false];

    if ($action === 'install') {
        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $api = plugins_api('plugin_information', ['slug' => 'tutor', 'fields' => ['sections' => false]]);
        $upgrader = new Plugin_Upgrader();
        $result = $upgrader->install($api->download_link);

        if (is_wp_error($result)) {
            $response['message'] = $result->get_error_message();
        } else {
            // Automatically activate the plugin
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
            $plugin_slug = 'tutor/tutor.php';
            activate_plugin($plugin_slug);

            if (is_plugin_active($plugin_slug)) {
                $response['success'] = true;
                $response['message'] = __('Tutor LMS installed and activated successfully.', 'ovation-elements');
                $response['is_active'] = true;
            } else {
                $response['message'] = __('Tutor LMS installed but failed to activate.', 'ovation-elements');
            }
        }
    } elseif ($action === 'activate') {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        $plugin_slug = 'tutor/tutor.php';
        activate_plugin($plugin_slug);

        if (is_plugin_active($plugin_slug)) {
            $response['success'] = true;
            $response['message'] = __('Tutor LMS activated successfully.', 'ovation-elements');
            $response['is_active'] = true;
        } else {
            $response['message'] = __('Failed to activate Tutor LMS.', 'ovation-elements');
        }
    }

    // Handle HTML or JSON response
    if (isset($_POST['response_type']) && $_POST['response_type'] === 'html') {
        echo esc_html($response['message']);
    } else {
        wp_send_json($response);
    }

    wp_die();
});
//end 




