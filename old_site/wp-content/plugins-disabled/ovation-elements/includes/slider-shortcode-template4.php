<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template4';
$selected_posts = maybe_unserialize(get_post_meta($post_id, '_ova_elems_selected_posts_template4', true));
$_ova_elems_static_settings_template4 = get_post_meta($post_id, '_ova_elems_static_settings_template4', true);
$_ova_elems_static_settings_template4 = $_ova_elems_static_settings_template4 ? maybe_unserialize($_ova_elems_static_settings_template4) : array();

$instagram_url = isset($_ova_elems_static_settings_template4['instagram_url']) ? esc_url($_ova_elems_static_settings_template4['instagram_url']) : '';
$youtube_url = isset($_ova_elems_static_settings_template4['youtube_url']) ? esc_url($_ova_elems_static_settings_template4['youtube_url']) : '';
$basketball_url = isset($_ova_elems_static_settings_template4['basketball_url']) ? esc_url($_ova_elems_static_settings_template4['basketball_url']) : '';
$twitter_url = isset($_ova_elems_static_settings_template4['twitter_url']) ? esc_url($_ova_elems_static_settings_template4['twitter_url']) : '';
$mini_description = isset($_ova_elems_static_settings_template4['mini_description']) ? esc_html($_ova_elems_static_settings_template4['mini_description']) : '';
$corner_posts_count = isset($_ova_elems_static_settings_template4['corner_posts_count']) ? intval($_ova_elems_static_settings_template4['corner_posts_count']) : 1;
$autoplay_setting = isset($_ova_elems_static_settings_template4['autoplay_setting']) ? (int) $_ova_elems_static_settings_template4['autoplay_setting'] : 0;
$autoplay_delay = isset($_ova_elems_static_settings_template4['autoplay_delay']) ? absint($_ova_elems_static_settings_template4['autoplay_delay']) : 1000;
$effect = isset($_ova_elems_static_settings_template4['effect']) ? sanitize_text_field($_ova_elems_static_settings_template4['effect']) : 'fade';
$button_bg_color = isset($_ova_elems_static_settings_template4['button_bg_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['button_bg_color']) : '#000000';
$button_hover_bg_color = isset($_ova_elems_static_settings_template4['button_hover_bg_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['button_hover_bg_color']) : '#333333';
$button_text_color = isset($_ova_elems_static_settings_template4['button_text_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['button_text_color']) : '#ffffff';
$button_hover_text_color = isset($_ova_elems_static_settings_template4['button_hover_text_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['button_hover_text_color']) : '#ffffff';
$social_icon_active_color = isset($_ova_elems_static_settings_template4['social_icon_active_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['social_icon_active_color']) : '#3b5998';
$social_icon_hover_color = isset($_ova_elems_static_settings_template4['social_icon_hover_color']) ? sanitize_hex_color($_ova_elems_static_settings_template4['social_icon_hover_color']) : '#2d4373';
$social_icon_size = isset($_ova_elems_static_settings_template4['social_icon_size']) ? absint($_ova_elems_static_settings_template4['social_icon_size']) : 24;
$custom_css = isset($_ova_elems_static_settings_template4['custom_css']) ? sanitize_textarea_field($_ova_elems_static_settings_template4['custom_css']) : '';
$corner_posts_category = isset($_ova_elems_static_settings_template4['corner_posts_category']) ? intval($_ova_elems_static_settings_template4['corner_posts_category']) : '';
$corner_posts_order = isset($_ova_elems_static_settings_template4['corner_posts_order']) ? sanitize_text_field($_ova_elems_static_settings_template4['corner_posts_order']) : 'asc';

// Fetch corner posts
$corner_posts = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => $corner_posts_count,
        'cat' => $corner_posts_category,
        'order' => $corner_posts_order,
        'orderby' => 'date'
    )


);
$dynamic_settings = [
    'effect' => $_ova_elems_static_settings_template4['effect'] ?? 'fade',
    'crossFade' => !empty($_ova_elems_static_settings_template4['fade_crossfade']),
    'lazyLoad' => !empty($_ova_elems_static_settings_template4['lazy_load']) && $_ova_elems_static_settings_template4['lazy_load'] == '1' ? true : false,
    'autoplay' => isset($_ova_elems_static_settings_template4['autoplay_setting']) ? $_ova_elems_static_settings_template4['autoplay_setting'] == 1 : false,
    'autoplay_delay' => isset($_ova_elems_static_settings_template4['autoplay_delay']) ? absint($_ova_elems_static_settings_template4['autoplay_delay']) : 1000,
];



wp_enqueue_style('ova-elems-style4', OVA_ELEMS_URL . 'assets/css/style4.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-4-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-4-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
// Override the default Font Awesome version for template 4
wp_dequeue_style('font-awesome');
wp_enqueue_style('ova-elems-font-awesome-template4', OVA_ELEMS_URL . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
// Localize the script
wp_localize_script('ova-elems-template-4-frontend-scripts', 'template4SliderConfig', $dynamic_settings);
?>

<section class="oe-news-slider">
    <div class="oe-inner-wrap">
        <div class="social-media-wrap">
            <div class="oe-icons-container">
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['facebook_url'] ?? '#'); ?>"
                        target="_blank"><i class="fa-brands fa-facebook-f ov-social-icon"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['instagram_url'] ?? '#'); ?>"
                        target="_blank"><i class="fa-brands fa-instagram ov-social-icon"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['youtube_url'] ?? '#'); ?>"
                        target="_blank"><i class="fa-brands fa-youtube ov-social-icon"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['basketball_url'] ?? '#'); ?>"
                        target="_blank"><i class="fa-solid fa-basketball ov-social-icon"></i></a></div>
                <div class="icons"><a
                        href="<?php echo esc_url($_ova_elems_static_settings_template4['twitter_url'] ?? '#'); ?>"
                        target="_blank"><i class="fa-brands fa-twitter ov-social-icon"></i></a></div>
            </div>
            <div class="follow-title ov-social-news">
                <?php echo esc_html($_ova_elems_static_settings_template4['ov_template_review_text'] ?? ''); ?>
            </div>
        </div>

        <div class="slide-outer">
            <!-- Slider content -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    // Generate slides dynamically
                    if (!empty($selected_posts)) {
                        foreach ($selected_posts as $post_id) {
                            $post = get_post($post_id);
                            if ($post) {

                                $thumbnail = get_the_post_thumbnail_url($post_id, 'large');

                                $post_author = get_the_author_meta('display_name', $post->post_author);
                                $post_date = get_the_date('d-M-Y', $post_id);
                                $post_time = get_the_time('H:i', $post_id);
                                $post_content = apply_filters('the_content', $post->post_content);

                                ?>

                                <div class="swiper-slide" style="background-image: url('<?php echo esc_url($thumbnail); ?>');">
                                    <div class="content-wrapper">
                                        <!-- new add for title description characters limit  -->

                                        <div class="offer-tag set-offer-font">
                                            <?php
                                            $title = esc_html($post->post_title);
                                            $title = wp_trim_words($title, 10, '...');
                                            echo $title;
                                            ?>
                                        </div>

                                        <h1 class="heading slide-tittle">
                                            <?php
                                            $title = esc_html($post->post_title);
                                            $title = wp_trim_words($title, 10, '...');
                                            // echo $title; 
                                            echo '<a href="' . esc_url(get_permalink($post->ID)) . '" class="post-title-link">' . $title . '</a>';
                                            ?>
                                        </h1>

                                        <div class="theme-para slide-desc">
                                            <?php
                                            // Limit post description to 150 characters, or set your own limit
                                            $content = apply_filters('the_content', $post->post_content);
                                            $content = wp_strip_all_tags($content); // Remove HTML tags
                                            $content = mb_strimwidth($content, 0, 150, '...'); // Limit to 150 characters with ellipsis
                                            echo esc_html($content);
                                            ?>
                                        </div>


                                        <!-- end -->


                                        <div class="slider-meta">
                                            <div class="meta-item">
                                                <span class="item">
                                                    <i class="fa-solid fa-user"></i>
                                                </span>
                                                <p class="text slide-content"><?php echo esc_html($post_author); ?></p>
                                            </div>
                                            <div class="meta-item">
                                                <span class="item">
                                                    <i class="fa-solid fa-calendar"></i>
                                                </span>
                                                <p class="text slide-content"><?php echo esc_html($post_date); ?></p>
                                            </div>
                                            <div class="meta-item">
                                                <span class="item">
                                                    <i class="fa-solid fa-clock"></i>
                                                </span>
                                                <p class="text slide-content"><?php echo esc_html($post_time); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Navigation -->

                <div class="swiper-pagination"></div>
            </div>



            <div class="slider-nav">
                <div class="slider-swipper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <?php
                // Example navigation items (use real URLs or image sources)
                ?>
                <div class="oe-slider-controls">
                    <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                    <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
                </div>
                <?php foreach ($selected_posts as $post_id): ?>
                    <div class="nav-item">
                        <div class="nav-item-img">
                            <?php
                            // Fetch post thumbnail or a default image
                            $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
                            ?>
                            <img src="<?php echo esc_url($thumbnail ?: 'default-image-url'); ?>" alt="">
                            <i class="fa-solid fa-expand"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="banner-below">
                <div class="text">
                    <p class="description ov-mini-title">
                        <?php echo esc_html($_ova_elems_static_settings_template4['mini_description']); ?>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="recent-news-sidebar">
        <div class="sidebar-heading">
            <h3>Recent News</h3>
        </div>
        <div class="news-outer">
            <?php
            // Display corner posts
            if ($corner_posts->have_posts()) {
                while ($corner_posts->have_posts()) {
                    $corner_posts->the_post();
                    ?>
                    <div class="news-item">
                        <div class="news-item-img">
                            <?php
                            $news_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                            ?>
                            <img src="<?php echo esc_url($news_thumbnail ?: 'default-news-image-url'); ?>"
                                alt="news feature image">
                        </div>
                        <div class="news-intem-inner">

                            <h4 class="title ov-right-news-tittle">
                                <a href="<?php the_permalink(); ?>" class="post-title-link">
                                    <?php
                                    $title = get_the_title();
                                    $title = wp_trim_words($title, 9, '...');
                                    echo esc_html($title);
                                    ?>
                                </a>
                            </h4>
                            <div class="news-meta">
                                <div class="news-meta-item">
                                    <span class="news-item-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <p class="news-text slide-content"><?php the_author(); ?></p>
                                </div>
                                <div class="news-meta-item">
                                    <span class="news-item-icon">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                    <p class="news-text slide-content"><?php echo get_the_date('d-M-Y'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_postdata();
            }
            ?>
        </div>
        <div class="live-reporting">
            <div class="live-reporting-inner">
                <a href="<?php echo esc_url($_ova_elems_static_settings_template4['live_video_link'] ?? '#'); ?>"
                    class="play-btn"><i class="fa-solid fa-play"></i></a>
                <div class="live-inner">
                    <small
                        class="live_mini_text_font_size"><?php echo esc_html($_ova_elems_static_settings_template4['live_mini_text']); ?></small>
                    <p class="live_title_font_size">
                        <?php echo esc_html($_ova_elems_static_settings_template4['live_title_text']); ?>
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>