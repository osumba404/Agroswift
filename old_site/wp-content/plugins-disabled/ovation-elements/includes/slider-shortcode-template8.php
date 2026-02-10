<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template8';

$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? 'fade',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];

wp_enqueue_style('ova-elems-style8', OVA_ELEMS_URL . 'assets/css/style8.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-8-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-8-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
// Localize the script
wp_localize_script('ova-elems-template-8-frontend-scripts', 'template8SliderConfig', $dynamic_settings);
?>


<!-- Slider Background Image Section -->
<div class="oe-education-slider-bg-image position-relative"
    style="background-image: url('<?php echo esc_url(isset($static_settings['bg_slide_image']) ? $static_settings['bg_slide_image'] : ''); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <!-- Container Start -->
    <div class="container">

        <!-- Slider Content Outer Box -->
        <div class="oe-education-slider-content-outer-box position-relative">

            <!-- Row Start -->
            <div class="row oe-education-main-row">
                <!-- Left Content Section -->
                <div
                    class="col-xl-5 col-lg-4 col-md-6 col-sm-12 col-12 oe-education-slider-content-inner-box align-self-center">
                    <div class="oe-education-slider-banner-content-box">
                        <div class="d-flex flex-column gap-2 oe-education-slider-banner-content-main">
                            <!-- Sub Heading -->
                            <div
                                class="d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                <span
                                    class="oe-education-slider-sub-head statichead-text-font"><?php echo esc_attr($static_settings['mini_title2'][0] ?? ''); ?></span>
                            </div>

                            <!-- Main Heading -->
                            <div class="oe-education-slider-banner-heading-box">
                                <h1 id="slide_splice"
                                    class="slide_splice oe-education-slider-banner-main-head slide-list text-md-start text-sm-center text-center">
                                    <?php echo esc_html($static_settings['list_title'] ?? ''); ?>
                                </h1>
                            </div>

                            <!-- Description -->
                            <p
                                class="oe-education-slider-banner-sec-para slide-desc text-md-start text-sm-center text-center">
                                <?php echo esc_html($static_settings['list_description'] ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?>
                            </p>

                            <!-- Banner Points -->
                            <?php
                            if (!empty($static_settings['enter_list'])) {
                                echo '<div class="row oe-education-slider-banner-points ">';
                                foreach ($static_settings['enter_list'] as $index => $item) {
                                    if ($index % 2 == 0) {
                                        echo '<div class="col-lg-6 oe-education-custom">';
                                    } else {
                                        echo '<div class="col-lg-6 oe-education-custom">';
                                    }
                                    echo '<i class="fa fa-check me-3"></i><span class="oe-education-slider-banner-point-text slide-list-content">' . esc_html($item) . '</span>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            }
                            ?>

                            <!-- Buttons -->
                            <div
                                class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-education-slider-banner-btn-box pt-3">
                                <a class="oe-education-slider-explore-btn staticbutton-text-font ov-btn-<?php echo esc_attr($post_id); ?>"
                                    href="<?php echo esc_url($static_settings['static_button_url'] ?? ''); ?>"><?php echo esc_attr($static_settings['static_button_text'] ?? ''); ?></a>
                                <a class="oe-education-slider-appointement-btn staticbutton-text-font ov-btn-<?php echo esc_attr($post_id); ?>"
                                    href="<?php echo esc_url($static_settings['static_button2_url'] ?? ''); ?>"><?php echo esc_attr($static_settings['static_button2_text'] ?? ''); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left Content Section -->



                <!-- Middle Banner Box -->
                <div class="col-xl-4 col-lg-5 col-md-6 oe-education-slider-banner-box">

                    <!-- sliding functionality start -->
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($slides as $index => $slide): ?>
                                <?php if (!empty($slide['course_id'])):
                                    // Same PHP logic as before
                                    $course_title = get_the_title($slide['course_id']);
                                    $price_type = get_post_meta($slide['course_id'], '_tutor_course_price_type', true);
                                    $price = get_post_meta($slide['course_id'], 'tutor_course_price', true);
                                    $sale_price = get_post_meta($slide['course_id'], 'tutor_course_sale_price', true);
                                    $course_level = get_post_meta($slide['course_id'], '_tutor_course_level', true);
                                    $duration_meta = get_post_meta($slide['course_id'], '_course_duration', true);
                                    $duration = !empty($duration_meta) ? maybe_unserialize($duration_meta) : [];
                                    $hours = $duration['hours'] ?? '0';
                                    $minutes = $duration['minutes'] ?? '0';
                                    $thumbnail_id = get_post_meta($slide['course_id'], '_thumbnail_id', true);
                                    $thumbnail_url = !empty($thumbnail_id) ? wp_get_attachment_url($thumbnail_id) : '';
                                    $author_id = get_post_field('post_author', $slide['course_id']);
                                    $author_name = get_the_author_meta('display_name', $author_id);
                                    $author_avatar = get_avatar($author_id);
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="oe-education-slider-post-box">
                                            <?php if (!empty($thumbnail_url)): ?>
                                                <img src="<?php echo esc_url($thumbnail_url); ?>"
                                                    alt="<?php echo esc_attr($course_title); ?>">
                                            <?php endif; ?>
                                            <div class="oe-education-slider-post-content-box">
                                                <div class="d-flex" style="gap: 1rem">
                                                    <div>
                                                        <span>
                                                            <?php echo esc_html("{$hours} Hours {$minutes} Minutes"); ?>
                                                        </span>
                                                    </div>
                                                    <div class="ps-4">
                                                        <span>
                                                            <?php echo esc_html(ucfirst($course_level)); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <h4 class="oe-education-slider-post-title">
                                                    <?php echo esc_html($course_title); ?>
                                                </h4>
                                                <div class="oe-education-slider-post-author-box d-flex"
                                                    style="justify-content:space-between;">
                                                    <div class="oe-education-admin">
                                                        <span class="author-avatar-box">
                                                            <?php echo esc_html($author_name); ?>
                                                            <?php if ($author_avatar): ?>
                                                                <div class="author-avatar">
                                                                    <?php echo wp_kses_post($author_avatar); ?></div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>

                                                    <div class="oe-education-slider-post-price"><?php echo esc_html($price); ?>
                                                        <?php if (!empty($sale_price)): ?> (Sale:
                                                            <?php echo esc_html($sale_price); ?>)<?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                        <!-- Navigation -->


                        <div class="swiper-pegination-buttons">
                            <div class="swiper-button">
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>
                            <!-- Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>
                </div>
                <!-- Right Banner Image -->
                <div class="col-lg-4 oe-education-slider-post-side-box">
                    <img src="<?php echo esc_url(isset($static_settings['corner_images'][0]) ? wp_get_attachment_url($static_settings['corner_images'][0]) : ''); ?>"
                        alt="">
                </div>
                <!-- End Right Banner Image -->
                <!-- sliding functionality end -->
            </div>


            <!-- End Middle Banner Box -->


        </div>
        <!-- End Row -->

        <!-- Video and Rating Section -->
        <div class="row oe-education-slider-video-row">

            <!-- Empty Column (Placeholder) -->
            <div
                class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12 oe-education-slider-content-inner-box align-self-center">
            </div>

            <!-- Video and Rating Content -->
            <div
                class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 oe-education-slider-video-rating-content-box align-self-center">
                <div class="row oe-education-video-rating">


                    <!-- Video Section -->
                    <div class="col-lg-2 col-md-3 oe-education-slider-video-content-box position-relative">
                        <div class="oe-education-slider-video-image-box"
                            style="background-image: url('<?php echo esc_url(isset($static_settings['video_bg_image']) ? $static_settings['video_bg_image'] : ''); ?>');">
                            <a class="oe-education-slider-video-icon-box myVideoBtns"
                                data-url="<?php echo esc_url(isset($static_settings['slide_video_url']) ? $static_settings['slide_video_url'] : '#'); ?>"
                                href="#myModal1" id="myBtn1">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                        <div id="myVideoNewModals" class="modal-new animated fadeInDownBig delay-1000">
                            <div class="modal-contents">
                                <button class="close-one">&times;<span class="screen-reader-text">
                                        <?php echo esc_html('Close button', 'pet-care-pro'); ?></span></button>
                                <embed id="videoEmbed" width="100%" height="345" src=""></embed>
                            </div>
                        </div>
                    </div>
                    <!-- End Video Section -->

                    <!-- Rating Section -->
                    <div class="col-lg-4 col-md-4 oe-education-slider-rating-content-box d-flex">
                        <div class="oe-education-slider-rating-img-box align-self-center">
                            <img src="<?php echo esc_url(isset($static_settings['mini_images_1'][0]) ? wp_get_attachment_url($static_settings['mini_images_1'][0]) : ''); ?>"
                                alt="">
                            <p class="oe-education-slider-rating-text ov_social-template8">
                                <?php echo esc_html($static_settings['mini_titles'][0] ?? ''); ?>
                            </p>
                        </div>


                        <div class="circular-progress"
                            data-percentage="<?php echo esc_attr($static_settings['static_loader_percentage'] ?? '90'); ?>"
                            data-progress-color="crimson" data-bg-color="rgba(0,0,0,0.7)">
                            <div class="inner-circle"></div>
                            <p class="percentage">0%</p>
                        </div>


                    </div>



                    <!-- loader end -->
                    <!-- End Rating Section -->

                    <!-- Followers Section -->
                    <div class="col-lg-5 col-md-5 oe-education-slider-followers-content-box d-flex">
                        <div class="oe-education-slider-progress-bar-box align-self-center">
                            <p class="oe-education-slider-followers-count">
                                <?php echo esc_html($static_settings['ov_template_review_no'] ?? '05k+'); ?>
                            </p>
                        </div>
                        <div class="oe-education-slider-followers-img-box align-self-center ps-4">
                            <p class="oe-education-slider-followers-text review-text-font">
                                <?php echo esc_html($static_settings['ov_template_review_text'] ?? ''); ?>
                            </p>
                            <div class="oe-education-slider-social-icon-box d-flex left_menu_col">
                                <span class="oe-education-slider-follow-icon-box">
                                    <div class="icons"><a
                                            href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"
                                            target="_blank"><i class="fa-brands fa-facebook-f ov-social-icon"></i></a>
                                    </div>
                                    <div class="icons"><a
                                            href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"
                                            target="_blank"><i class="fa-brands fa-instagram ov-social-icon"></i></a>
                                    </div>
                                    <div class="icons"><a
                                            href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"
                                            target="_blank"><i class="fa-brands fa-youtube ov-social-icon"></i></a>
                                    </div>
                                    <div class="icons"><a
                                            href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"
                                            target="_blank"><i class="fa-solid fa-basketball ov-social-icon"></i></a>
                                    </div>
                                    <div class="icons"><a
                                            href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"
                                            target="_blank"><i class="fa-brands fa-twitter ov-social-icon"></i></a>
                                    </div>

                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- End Followers Section -->

                </div>
            </div>
            <!-- End Video and Rating Content -->

        </div>
        <!-- End Video and Rating Section -->

    </div>
    <!-- End Slider Content Outer Box -->

</div>
<!-- End Container -->

</div>
<!-- End Slider Background Image Section -->