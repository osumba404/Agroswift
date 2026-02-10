<?php
function ova_elems_shortcode_handler($atts)
{
    $atts = shortcode_atts(array(
        'id' => '',
    ), $atts, 'ova_elems');

    // Validate the ID
    $post_id = intval($atts['id']);
    if (!$post_id) {
        return 'Invalid Slider ID.';
    }

    $post = get_post($post_id);
    if (!$post || $post->post_type != 'ova_elems') {
        return 'Slider not found.';
    }

    $is_premium_user = get_option('ovation_slider_is_premium', false);

    $is_free = false;
    if ($is_premium_user) {
        $is_free = true;
    } else {
        $args = array(
            'post_type' => 'ova_elems',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        );
        $existing_sliders = get_posts($args);
        $free_sliders = array_slice($existing_sliders, 0, 100000);

        foreach ($free_sliders as $free_slider) {
            if ($free_slider->ID == $post_id) {
                $is_free = true;
                break;
            }
        }
    }

    if (!$is_free) {
        return '<p>' . esc_html__('This slider is locked. Upgrade to Pro to use it.', 'ovation-elements') . '</p>';
    }


    //end 

    $slides = get_post_meta($post_id, '_ova_elems_slides', true);
    $slides = $slides ? maybe_unserialize($slides) : array();
    $template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
    $static_settings = get_post_meta($post_id, '_ova_elems_static_settings', true);
    $static_settings = $static_settings ? maybe_unserialize($static_settings) : array();
    $corner_images = isset($static_settings['corner_images']) ? $static_settings['corner_images'] : array();

    ob_start();
    $template_id = intval(get_post_meta($post_id, '_ova_elems_template_id', true));

    if ($template_id) {
        add_static_settings_template($template_id);
        include plugin_dir_path(__FILE__) . "slider-shortcode-template{$template_id}.php";
    } else {
        return 'Template not found.';
    }
    return ob_get_clean();
}


//for css
function add_static_settings_template($template_id)
{
    global $wpdb;

    $meta_key = '_ova_elems_static_settings';
    if ($template_id == 4 || $template_id == 7) {
        $meta_key = '_ova_elems_static_settings_template4';
    }
    $template_meta_key = '_ova_elems_template_id';
    //  $default_font_size = 18;
    $default_font_size = 'initial';
    $post_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value = %d",
            $template_meta_key,
            $template_id
        )
    );

    if ($post_id) {
        $static_settings = get_post_meta($post_id, $meta_key, true);
        $static_settings = $static_settings ? maybe_unserialize($static_settings) : [];

        $ov_mini_title_font_size = isset($static_settings['ov_mini_title_font_size']) ? intval($static_settings['ov_mini_title_font_size']) : $default_font_size;
        $mini_description_font_size = isset($static_settings['mini_description_font_size']) ? intval($static_settings['mini_description_font_size']) : $default_font_size;

        $social_icon_active_color = isset($static_settings['social_icon_active_color']) ? esc_attr($static_settings['social_icon_active_color']) : '';
        $social_icon_hover_color = isset($static_settings['social_icon_hover_color']) ? esc_attr($static_settings['social_icon_hover_color']) : '#fff';
        $social_icon_size = isset($static_settings['social_icon_size']) ? intval($static_settings['social_icon_size']) : '';
        $custom_css = isset($static_settings['custom_css']) ? sanitize_text_field($static_settings['custom_css']) : '';

        $slide_email_font_size = isset($static_settings['slide_email_font_size']) ? intval($static_settings['slide_email_font_size']) : $default_font_size;
        $slide_no_font_size = isset($static_settings['slide_no_font_size']) ? intval($static_settings['slide_no_font_size']) : $default_font_size;


        $list_title_font_size = isset($static_settings['list_title_font_size']) ? intval($static_settings['list_title_font_size']) : 'initial';
        $list_description_font_size = isset($static_settings['list_description_font_size']) ? intval($static_settings['list_description_font_size']) : '';
        $list_content_font_size = isset($static_settings['list_content_font_size']) ? intval($static_settings['list_content_font_size']) : 'initial';
        $review_text_font_size = isset($static_settings['review_text_font_size']) ? intval($static_settings['review_text_font_size']) : $default_font_size;
        $review_no_font_size = isset($static_settings['review_no_font_size']) ? intval($static_settings['review_no_font_size']) : $default_font_size;

        $static_button_text_font_size = isset($static_settings['static_button_text_font_size']) ? intval($static_settings['static_button_text_font_size']) : $default_font_size;
        $title_head_font_size = isset($static_settings['title_head_font_size']) ? intval($static_settings['title_head_font_size']) : $default_font_size;

        //7 slider 
        $ov_mini_title_right_font_size = isset($static_settings['ov_mini_title_right_font_size']) ? intval($static_settings['ov_mini_title_right_font_size']) : '14';
        $ov_mini_description_font_size = isset($static_settings['ov_mini_description_font_size']) ? intval($static_settings['ov_mini_description_font_size']) : $default_font_size;
        $thmhead_font_size = isset($static_settings['thmhead_font_size']) ? intval($static_settings['thmhead_font_size']) : $default_font_size;
        $thmbtitle_font_size = isset($static_settings['thmbtitle_font_size']) ? intval($static_settings['thmbtitle_font_size']) : $default_font_size;
        $thmbdesc_font_size = isset($static_settings['thmbdesc_font_size']) ? intval($static_settings['thmbdesc_font_size']) : $default_font_size;


        $oe_left_side_title_font_size = isset($static_settings['oe_left_side_title_font_size']) ? intval($static_settings['oe_left_side_title_font_size']) : $default_font_size;
        $oe_button_font_size = isset($static_settings['oe_button_font_size']) ? intval($static_settings['oe_button_font_size']) : $default_font_size;

        //new
        $ov_review_text_font_size = isset($static_settings['ov_review_text_font_size']) ? intval($static_settings['ov_review_text_font_size']) : $default_font_size;
        $ov_social_text_font_size = isset($static_settings['ov_social_text_font_size']) ? intval($static_settings['ov_social_text_font_size']) : 22;
        $live_mini_text_font_size = isset($static_settings['live_mini_text_font_size']) ? intval($static_settings['live_mini_text_font_size']) : $default_font_size;
        $live_title_font_size = isset($static_settings['live_title_font_size']) ? intval($static_settings['live_title_font_size']) : $default_font_size;

        //new add 

        $ov_template7_button_bg_color = isset($static_settings['button_bg_color']) ? esc_attr($static_settings['button_bg_color']) : '';
        $ov_template7_button_hover_bg_color = isset($static_settings['button_hover_bg_color']) ? esc_attr($static_settings['button_hover_bg_color']) : '';
        $ov_template7_button_text_color = isset($static_settings['button_text_color']) ? esc_attr($static_settings['button_text_color']) : '';
        $ov_template7_button_hover_text_color = isset($static_settings['button_hover_text_color']) ? esc_attr($static_settings['button_hover_text_color']) : '';
        //new add overlay
        $ov_template9_overlay_color = isset($static_settings['image_overlay']) ? esc_attr($static_settings['image_overlay']) : '';

        $inline_css = "
            .oe-template7-slide-buttons {
                font-size: {$oe_button_font_size}px !important;
            }

            .ov-btn-template7 {
                background-color: {$ov_template7_button_bg_color} !important;
                color: {$ov_template7_button_text_color} !important;
            }
            .ov-btn-template7:hover {
                background-color: {$ov_template7_button_hover_bg_color} !important;
                color: {$ov_template7_button_hover_text_color} !important;
            }

            .swiper-slide::before{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: {$ov_template9_overlay_color} !important;
                z-index: 99;
                pointer-events: none;
                opacity: 0.6;
            }

            .ov-template9-overlay {
                background-color: {$ov_template9_overlay_color};
            }

            .ov-mini-title {
                font-size: {$ov_mini_title_font_size}px !important;
            }

            .oe-stat-head {
                font-size: {$ov_mini_title_font_size}px !important;
            }
            .ov-mini-imp {
                font-size: {$ov_mini_title_font_size}px !important;
            }

            .ov-mini-thumb-titleimp {
                font-size: {$ov_mini_title_font_size}px !important;
            }
            .ov-mini-description { 
                font-size: {$mini_description_font_size}px !important;
            }
            .ov-social-icon {
                font-size: {$social_icon_size}px !important;
                color: {$social_icon_active_color} !important;
            }
            
            .ov-social-icon:hover {
               
                color: {$social_icon_hover_color} !important;
            }

            .icons:hover .ov-social-icon{
                color: {$social_icon_hover_color} !important;
            }

            .set-offer-font { 
                font-size: {$title_head_font_size}px !important;
            }

            .ov-right-news-tittle { 
                font-size: {$oe_left_side_title_font_size}px !important;
            }

            .ov-social-news { 
                font-size: {$ov_social_text_font_size}px !important;
            }

            .slide-list { 
                font-size: {$list_title_font_size}px !important;
            }
            .slide-tittle { 
                font-size: {$list_title_font_size}px !important;
            }
            .slide-desc { 
                font-size: {$list_description_font_size}px !important;
            }
            .slide-list-content { 
                font-size: {$list_content_font_size}px !important;
            }
            .slide-content { 
                font-size: {$list_content_font_size}px !important;
            }
            .review-text-font { 
                font-size: {$review_text_font_size}px !important;
            }
            .review-font { 
                font-size: {$review_no_font_size}px !important;
            }
            .statichead-text-font { 
                font-size: {$static_button_text_font_size}px !important;
            }



            .staticbutton-text-font { 
                font-size: {$title_head_font_size}px !important;
            }

            .ov-right-side-tittle { 
                font-size: {$ov_mini_title_right_font_size}px !important;
            }
            .ov-right-side-desc { 
                font-size: {$ov_mini_description_font_size}px !important;
            }

            .ov-thmb-head { 
                font-size: {$thmhead_font_size}px !important;
            }
            .ov-thmb-tittle { 
                font-size: {$thmbtitle_font_size}px !important;
            }
            .ov-thmb-desc { 
                font-size: {$thmbdesc_font_size}px !important;
            }

            .ov_review_text_font_size { 
                font-size: {$ov_review_text_font_size}px !important;
            }

            .ov_social-template8 { 
                font-size: {$review_text_font_size}px !important;
            }

            .ov_social_text_font_size { 
                font-size: {$ov_social_text_font_size}px !important;
            }

            .live_mini_text_font_size { 
                font-size: {$live_mini_text_font_size}px !important;
            }

            .live_title_font_size { 
                font-size: {$live_title_font_size}px !important;
            }

            .ecommerce-no-font { 
                font-size: {$slide_no_font_size}px !important;
            }

            .ecommerce-email-font { 
                font-size: {$slide_email_font_size}px !important;
            }
        ";

        if (!empty($custom_css)) {
            $inline_css .= "\n" . $custom_css;
        }

        // Add template-specific CSS
        wp_enqueue_style("ova-elems-style{$template_id}", OVA_ELEMS_URL . "assets/css/style{$template_id}.css", array(), OVA_ELEMS_VER);
        wp_add_inline_style("ova-elems-style{$template_id}", $inline_css);
    }

    // i change meta key for slides data _ova_elems_static_settings
    $meta_key_static = '_ova_elems_static_settings';
    $meta_key_slides = '_ova_elems_slides';

    $post_ids = $wpdb->get_col(
        $wpdb->prepare("SELECT DISTINCT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s", $meta_key_static)
    );

    foreach ($post_ids as $post_id) {
        $static_settings = get_post_meta($post_id, $meta_key_static, true);
        $static_settings = $static_settings ? maybe_unserialize($static_settings) : [];
        $slides = get_post_meta($post_id, $meta_key_slides, true);
        $slides = $slides ? maybe_unserialize($slides) : [];

        $inline_css = '';

        foreach ($slides as $index => $slide) {
            $bg_color = !empty($slide['slide_bg_color']) ? esc_attr($slide['slide_bg_color']) : '#2d4373';  // Default bg color

            // Add background color CSS rule
            $inline_css .= ".slider-main-image-{$post_id}-{$index} { background-color: {$bg_color}; }\n";

            // Add other slide settings like font size, button colors using static settings
            if (!empty($static_settings)) {
                $banner_font_size = isset($static_settings['banner_font_size']) ? intval($static_settings['banner_font_size']) : $default_font_size;
                $button_font_size = isset($static_settings['button_font_size']) ? intval($static_settings['button_font_size']) : $default_font_size;
                $heading_font_size = isset($static_settings['heading_font_size']) ? intval($static_settings['heading_font_size']) : $default_font_size;
                $head_font_size = isset($static_settings['head_font_size']) ? intval($static_settings['head_font_size']) : $default_font_size;
                $button_bg_color = isset($static_settings['button_bg_color']) ? esc_attr($static_settings['button_bg_color']) : '';
                $button_hover_bg_color = isset($static_settings['button_hover_bg_color']) ? esc_attr($static_settings['button_hover_bg_color']) : '';
                $button_text_color = isset($static_settings['button_text_color']) ? esc_attr($static_settings['button_text_color']) : '';
                $button_hover_text_color = isset($static_settings['button_hover_text_color']) ? esc_attr($static_settings['button_hover_text_color']) : '';

                // Add additional CSS rules
                $inline_css .= "
                   .description-{$post_id} {
                       font-size: {$banner_font_size}px !important;
                   }
                   .slider-btn-{$post_id} {
                       font-size: {$button_font_size}px !important;
                   }
                   .title-{$post_id} {
                       font-size: {$heading_font_size}px !important;
                   }
                   .ovheadtag-{$post_id} {
                       font-size: {$head_font_size}px !important;
                   }
   
                   .ov-btn-{$post_id} {
                       background-color: {$button_bg_color} !important;
                       color: {$button_text_color} !important;
                   }
                   .ov-btn-{$post_id}:hover {
                       background-color: {$button_hover_bg_color} !important;
                       color: {$button_hover_text_color} !important;
                   }
               ";
            }
        }

        // Enqueue the styles for the template
        wp_enqueue_style("ova-elems-style{$template_id}", OVA_ELEMS_URL . "assets/css/style{$template_id}.css", array(), OVA_ELEMS_VER);
        wp_add_inline_style("ova-elems-style{$template_id}", $inline_css);
    }
}

// add_action('wp_enqueue_scripts', function () use ($template_id) {
//     add_static_settings_template($template_id);
// });
// add_action('wp_head', function () use ($template_id) {
//     add_static_settings_template($template_id);
// }, 20);
