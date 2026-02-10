<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template7';

// Fetch selected posts
$selected_posts = maybe_unserialize(get_post_meta($post_id, '_ova_elems_selected_posts_template4', true));
$_ova_elems_static_settings_template4 = get_post_meta($post_id, '_ova_elems_static_settings_template4', true);
$_ova_elems_static_settings_template4 = $_ova_elems_static_settings_template4 ? maybe_unserialize($_ova_elems_static_settings_template4) : array();
$instagram_url = isset($_ova_elems_static_settings_template4['instagram_url']) ? esc_url($_ova_elems_static_settings_template4['instagram_url']) : '';
$youtube_url = isset($_ova_elems_static_settings_template4['youtube_url']) ? esc_url($_ova_elems_static_settings_template4['youtube_url']) : '';
$basketball_url = isset($_ova_elems_static_settings_template4['basketball_url']) ? esc_url($_ova_elems_static_settings_template4['basketball_url']) : '';
$twitter_url = isset($_ova_elems_static_settings_template4['twitter_url']) ? esc_url($_ova_elems_static_settings_template4['twitter_url']) : '';
$mini_description = isset($_ova_elems_static_settings_template4['mini_description']) ? esc_html($_ova_elems_static_settings_template4['mini_description']) : '';
$corner_posts_count = isset($_ova_elems_static_settings_template4['corner_posts_count']) ? intval($_ova_elems_static_settings_template4['corner_posts_count']) : 1;
$corner_posts_category = isset($_ova_elems_static_settings_template4['corner_posts_category']) ? intval($_ova_elems_static_settings_template4['corner_posts_category']) : '';
$corner_posts_order = isset($_ova_elems_static_settings_template4['corner_posts_order']) ? sanitize_text_field($_ova_elems_static_settings_template4['corner_posts_order']) : 'asc';
$upload_minheadimage = isset($_ova_elems_static_settings_template4['upload_minheadimage']) ? esc_url($_ova_elems_static_settings_template4['upload_minheadimage']) : '';
$ov_travel_head_tag = isset($_ova_elems_static_settings_template4['ov_travel_head_tag']) ? sanitize_text_field($_ova_elems_static_settings_template4['ov_travel_head_tag']) : '';
$ov_static_title = isset($_ova_elems_static_settings_template4['ov_static_title']) ? sanitize_text_field($_ova_elems_static_settings_template4['ov_static_title']) : '';
$static_description = isset($_ova_elems_static_settings_template4['static_description']) ? sanitize_textarea_field($_ova_elems_static_settings_template4['static_description']) : '';
$ov_button_text = isset($_ova_elems_static_settings_template4['ov_button_text']) ? sanitize_text_field($_ova_elems_static_settings_template4['ov_button_text']) : '';
$ov_button_url = isset($_ova_elems_static_settings_template4['ov_button_url']) ? esc_url($_ova_elems_static_settings_template4['ov_button_url']) : '#';
$ov_review_text = isset($_ova_elems_static_settings_template4['ov_review_text']) ? sanitize_text_field($_ova_elems_static_settings_template4['ov_review_text']) : '';
$ov_review_no = isset($_ova_elems_static_settings_template4['ov_review_no']) ? sanitize_text_field($_ova_elems_static_settings_template4['ov_review_no']) : '';
$ov_client_image = isset($_ova_elems_static_settings_template4['ov_client_image']) ? esc_url($_ova_elems_static_settings_template4['ov_client_image']) : '';
$button_data = maybe_unserialize(get_post_meta($post_id, '_ova_elems_button_data_template4', true)) ?: array();
$tour_info_data = maybe_unserialize(get_post_meta($post_id, '_ova_elems_tour_info_data_template4', true)) ?: array();
$video_data = maybe_unserialize(get_post_meta($post_id, '_ova_elems_video_data_template4', true)) ?: array();



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
// Start building the output

// Prepare dynamic settings for the slider
$dynamic_settings = [
    'effect' => $_ova_elems_static_settings_template4['effect'] ?? '',
    'crossFade' => !empty($_ova_elems_static_settings_template4['fade_crossfade']),
    'lazyLoad' => !empty($_ova_elems_static_settings_template4['lazy_load']) && $_ova_elems_static_settings_template4['lazy_load'] == '1' ? true : false,
    'autoplay' => isset($_ova_elems_static_settings_template4['autoplay_setting']) ? $_ova_elems_static_settings_template4['autoplay_setting'] == 1 : false,
    'autoplay_delay' => isset($_ova_elems_static_settings_template4['autoplay_delay']) ? absint($_ova_elems_static_settings_template4['autoplay_delay']) : 1000,
];


wp_enqueue_style('ova-elems-style7', OVA_ELEMS_URL . 'assets/css/style7.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-7-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-7-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
wp_dequeue_style('font-awesome');
wp_enqueue_style('ova-elems-font-awesome-template4', OVA_ELEMS_URL . 'assets/css/font.all.min.css', array(), OVA_ELEMS_VER);
wp_localize_script('ova-elems-template-7-frontend-scripts', 'template7SliderConfig', $dynamic_settings);

?>

<section id="oe-travel-slider-main-box">
    <!-- Main Slider Box -->
    <div class="oe-travel-slider-content-main-box">
        <!-- Content Row -->
        <div class="row position-relative">

            <div class="col-xl-5 col-lg-6 pe-0">

                <!-- Slider Functionality Starts Here -->
                <div class="swiper">
                    <!-- Swiper Wrapper -->
                    <div class="swiper-wrapper">
                        <?php
                        // Fetch and display selected posts
                        if (!empty($selected_posts)) {
                            foreach ($selected_posts as $index => $post_id) {
                                $post = get_post($post_id);
                                if ($post) {
                                    // $post_title = get_the_title();
                                    $post_content = apply_filters('the_content', $post->post_content);
                                    $post_author = get_the_author_meta('display_name', get_post_field('post_author', $post_id));
                                    $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
                                    $author_id = get_post_field('post_author', get_the_ID());
                                    $author_avatar = get_avatar($author_id, 66);

                                    // Get button data for the current slide
                                    $button_text = isset($button_data[$index]['text']) ? esc_html($button_data[$index]['text']) : '';
                                    $button_url = isset($button_data[$index]['url']) ? esc_url($button_data[$index]['url']) : '';
                                    $button2_text = isset($button_data[$index]['text2']) ? esc_html($button_data[$index]['text2']) : '';
                                    $button2_url = isset($button_data[$index]['url2']) ? esc_url($button_data[$index]['url2']) : '';

                                    $tour_info = isset($tour_info_data[$index]) ? esc_html($tour_info_data[$index]) : '';

                                    $video_link = isset($video_data[$index]['live_link']) ? esc_url($video_data[$index]['live_link']) : '';

                                    // Retrieve uploaded video URL
                                    $uploaded_video = isset($video_data[$index]['upload_video']) ? esc_url($video_data[$index]['upload_video']) : '';

                                    ?>
                                    <!-- Swiper Slide -->
                                    <div class="swiper-slide">
                                        <!-- Slide Background Image -->
                                        <div class="oe-travel-slider-post-bg-image"
                                            style="background-repeat: no-repeat; background-size: 100% auto; background-position: center; background-image: url(<?php echo esc_url($thumbnail ?: 'default-image-url'); ?>);">

                                            <!-- Author Info Box -->
                                            <div
                                                class="oe-travel-slider-post-bg-bg-box d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                <span class="oe-travel-slider-post-icon-img me-2 ms-0 position-relative">
                                                    <div class="oe-travel-slider-post-icon">
                                                        <?php echo wp_kses_post($author_avatar); ?>
                                                        <!-- Display avatar -->
                                                    </div>
                                                </span>
                                                <span
                                                    class="oe-travel-slider-post-sub-head"><?php echo esc_html($post_author); ?></span>
                                            </div>

                                            <!-- Banner Content -->
                                            <div class="oe-travel-slider-post-banner-outer-box">
                                                <div class="oe-travel-slider-post-banner-heading-box">
                                                    <h1 class="oe-travel-slider-post-banner-main-head slide-tittle">

                                                        <?php

                                                        // echo esc_html($post->post_title); 
                                            

                                                        $title = esc_html($post->post_title);
                                                        $title = wp_trim_words($title, 10, '...');
                                                        // echo $title; 
                                                        echo '<a href="' . esc_url(get_permalink($post->ID)) . '" class="post-title-link">' . esc_html($title) . '</a>'; ?>
                                                    </h1>



                                                </div>
                                                <p class="oe-travel-slider-post-banner-sec-para slide-desc">
                                                    <?php
                                                    //echo esc_html(wp_strip_all_tags($post_content)); 
                                        
                                                    $content = apply_filters('the_content', $post->post_content);
                                                    $content = wp_strip_all_tags($content); // Remove HTML tags
                                                    $content = mb_strimwidth($content, 0, 150, '...'); // Limit to 150 characters with ellipsis
                                                    echo esc_html($content);

                                                    ?>
                                                </p>

                                                <?php if ($tour_info): ?>
                                                    <p class="oe-travel-slider-post-banner-schedule-text slide-content">
                                                        <?php echo esc_html($tour_info); ?>
                                                    </p>
                                                <?php endif; ?>

                                                <!-- Buttons Section -->
                                                <div
                                                    class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-travel-slider-banner-btn-box pt-3">
                                                    <?php if ($button_text && $button_url): ?>
                                                        <a class="oe-travel-slider-explore-btn oe-template7-slide-buttons ov-btn-template7"
                                                            href="<?php echo esc_url($button_url); ?>"><?php echo esc_html($button_text); ?></a>
                                                    <?php endif; ?>

                                                    <!-- new one vedio link href="#myModal1" id="myBtn1"> -->

                                                    <div id="vedio-img-box" class="col-xl-1 col-lg-2 "
                                                        style="background-image: url();">
                                                        <div class="">
                                                            <a class=" myVideoBtns"
                                                                data-url="<?php echo esc_url($uploaded_video); ?>" href="#">
                                                                <i class="fa fa-play"></i>
                                                            </a>
                                                        </div>


                                                    </div>


                                                    <!-- ended -->


                                                    <?php if ($button2_text && $button2_url): ?>
                                                        <a class="oe-travel-slider-appointement-btn oe-template7-slide-buttons ov-btn-template7"
                                                            href="<?php echo esc_url($button2_url); ?>"><?php echo esc_html($button2_text); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- Banner Content End -->

                                        </div>
                                        <!-- Slide Background Image End -->
                                    </div>
                                    <!-- Swiper Slide End -->
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>


                </div>
                <!-- Slider Functionality Ends Here -->

            </div>
            <!-- Left Column End -->

            <!-- Right Section (Background Image & Description) -->
            <div class="col-xl-7 col-lg-6" style="background-image: url('');">
                <div class="oe-travel-slider-banner-custom-box">
                    <div class="oe-travel-slider-banner-content-box">
                        <div class="d-flex flex-column gap-2 oe-travel-slider-banner-content-main">

                            <!-- Header with Icon -->
                            <div
                                class="d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                <span class="oe-travel-slider-icon-img me-2 ms-0 position-relative">
                                    <div class="oe-travel-slider-icon">
                                        <?php echo '  <img src="' . esc_url($upload_minheadimage) . '" alt="Image"> '; ?>
                                    </div>
                                </span>
                                <span
                                    class="oe-travel-slider-sub-head oe-stat-head"><?php echo esc_html($ov_travel_head_tag); ?></span>
                            </div>

                            <div id="myVideoNewModals" class="modal-new animated fadeInDownBig delay-1000"
                                style="display: none; width : 500px ;">
                                <div class="modal-contents">
                                    <button class="close-one">&times;<span
                                            class="screen-reader-text"><?php echo esc_html('Close button'); ?></span></button>
                                    <iframe id="videoEmbed" width="100%" height="345" frameborder="0"
                                        allowfullscreen></iframe>
                                </div>
                            </div>

                            <!-- Main Heading and Description -->
                            <div class="oe-travel-slider-banner-heading-box">
                                <h1 class="oe-travel-slider-banner-main-head ov-right-side-tittle">
                                    <?php echo esc_html($ov_static_title); ?>
                                </h1>
                            </div>
                            <p class="oe-travel-slider-banner-sec-para ov-right-side-desc">
                                <?php echo esc_html($static_description); ?>
                            </p>

                            <!-- Book Now Button -->
                            <div
                                class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-travel-slider-banner-btn-box pt-3">
                                <a class="oe-travel-slider-explore-btn oe-template7-buttons"
                                    href="<?php echo esc_url($ov_button_url); ?>"><?php echo esc_html($ov_button_text); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Right Section -->

            <!-- Below Slider Content -->
            <div class="oe-travel-slider-post-content-box">
                <div class="row oe-travel-slider-post-content-inner-box">

                    <!-- Review Section -->
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6 col-12 align-self-end mb-sm-0 mb-3">
                        <div class="oe-travel-slider-review-box d-flex">
                            <div class="oe-travel-slider-review-image align-self-center">
                                <?php echo '  <img src="' . esc_url($ov_client_image) . '" alt="Client Image"> '; ?>
                            </div>
                            <div class="oe-travel-slider-review-text text-sm-start text-center align-self-center">
                                <p class="oe-travel-slider-review-count review-font">
                                    <?php echo esc_html($ov_review_no); ?>
                                </p>
                                <p class="oe-travel-slider-review-count-text review-text-font">
                                    <?php echo esc_html($ov_review_text); ?>
                                </p>
                            </div>
                        </div>
                    </div> <!-- End Review Section -->

                    <!-- Carousel Section (Tour Posts) -->
                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-12 col-12">
                        <div class="row position-relative">
                            <?php
                            // Loop through selected posts for below slider content
                            if (!empty($selected_posts)) {
                                foreach ($selected_posts as $index => $post_id) {
                                    $post = get_post($post_id);
                                    if ($post) {
                                        $post_title = get_the_title();
                                        //   $title = wp_trim_words($post_title, 10, '...'); 
                                        $post_content = apply_filters('the_content', $post->post_content);
                                        $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail');
                                        $post_author = get_the_author_meta('display_name', get_post_field('post_author', $post_id));
                                        $author_id = get_post_field('post_author', get_the_ID());
                                        $author_avatar = get_avatar($author_id, 66);
                                        ?>
                                        <!-- Remove display: none and ensure posts are always visible -->
                                        <div
                                            class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 oe-travel-slider-carousel-post-boxes post-box-<?php echo esc_attr($index); ?>">
                                            <div class="oe-travel-slider-carousel-post-bg-image"
                                                style="background-image: url(<?php echo esc_url($thumbnail ?: 'default-image-url'); ?>);">
                                                <div class="oe-travel-slider-carousel-post-box">
                                                    <div class="oe-travel-slider-carousel-post">

                                                        <!-- Icon and Text Box -->
                                                        <div
                                                            class="oe-travel-slider-carousel-post-bg-bg-box d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                            <span
                                                                class="oe-travel-slider-carousel-post-icon-img me-2 ms-0 position-relative">
                                                                <div class="oe-travel-slider-carousel-post-icon">
                                                                    <?php echo wp_kses_post($author_avatar); ?>
                                                                </div>
                                                            </span>
                                                            <span
                                                                class="oe-travel-slider-carousel-post-sub-head ov-thmb-head"><?php echo esc_html($post_author); ?></span>
                                                        </div>

                                                        <!-- Carousel Post Content -->
                                                        <div class="oe-travel-slider-carousel-post-banner-outer-box">
                                                            <div class="oe-travel-slider-carousel-post-banner-heading-box">
                                                                <h1
                                                                    class="oe-travel-slider-carousel-post-banner-main-head ov-thmb-tittle">

                                                                    <?php

                                                                    //  echo esc_html($post->post_title); 
                                                                    $title = esc_html($post->post_title);
                                                                    $title = wp_trim_words($title, 10, '...');
                                                                    // echo $title; 
                                                                    echo '<a href="' . esc_url(get_permalink($post->ID)) . '" class="post-title-link">' . esc_html($title) . '</a>'; ?>
                                                                </h1>


                                                                </h1>
                                                            </div>
                                                            <p class="oe-travel-slider-carousel-post-banner-sec-para ov-thmb-desc">

                                                                <?php
                                                                $content = apply_filters('the_content', $post_content);
                                                                $content = wp_strip_all_tags($content); // Remove HTML tags
                                                                $content = mb_strimwidth($content, 0, 130, '...'); // Limit to 150 characters with ellipsis
                                                                echo esc_html($content);

                                                                ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>

                            <!-- Swiper Navigation Buttons -->
                            <div class="swiper-button-pegination">
                                <div class="swiper-nav-buttons">
                                    <!-- Swiper Navigation Buttons -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <!-- Swiper Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div> <!-- End Carousel Section -->
                </div>
            </div> <!-- End Slider Content -->
            <div class="icon-list-box">
                <!-- social icon add -->
                <div class="follow-title">
                    <?php echo esc_html($_ova_elems_static_settings_template4['ov_template_review_text'] ?? ''); ?>
                </div>
                <div class="icons-list">

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
                <!-- social icon end -->
            </div>

        </div>
        <!-- Content Row End -->

    </div>
    <!-- Main Slider Box End -->

</section>
