<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template6';
$slide_images = array();
$slide_background_colors = array();

if (!empty($slides)) {
    foreach ($slides as $slide) {
        if (!empty($slide['image_id'])) {
            $slide_images[] = wp_get_attachment_url($slide['image_id']);
        }
        if (!empty($slide['slide_bg_color'])) {
            $slide_background_colors[] = $slide['slide_bg_color'];
        } else {
            $slide_background_colors[] = '#2d4373';
        }
    }
}
$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? 'fade',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];

wp_enqueue_style('ova-elems-style6', OVA_ELEMS_URL . 'assets/css/style6.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-6-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-6-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
// Localize the script
wp_localize_script('ova-elems-template-6-frontend-scripts', 'template6SliderConfig', $dynamic_settings);

wp_localize_script('ova-elems-template-6-frontend-scripts', 'sliderData', array(
    'images' => $slide_images,
    'background_colors' => $slide_background_colors,
));
$index = 1;
?>

<section id="oe-restaurant-slider-main-box" class="oe-restaurant-slider-main-box_self">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="" data-bs-interval="1500">
        <div class="carousel-inner" role="listbox">

            <div>
                <div class="inner_carousel " id="slidemainbox">
                    <div id="slider-background"
                        class="oe-restaurant-slider-bg-image slider-main-image-<?php echo esc_attr($post->ID); ?>-<?php echo esc_attr($index); ?> position-relative"
                        style="background-image: url('<?php echo esc_url($first_slide_image_url); ?>');">


                        <div class="">
                            <div class="oe-restaurant-slider-content-outer-box position-relative">
                                <div class="row">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <!-- This will hold all the slides -->
                                            <?php if (!empty($slides)): ?>
                                                <?php foreach ($slides as $index => $slide): ?>
                                                    <!-- sliding functionality start -->
                                                    <div class="swiper-slide">
                                                        <div
                                                            class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-12 oe-restaurant-slider-content-inner-box align-self-center">
                                                            <div class="oe-restaurant-slider-banner-content-box">
                                                                <div
                                                                    class="d-flex flex-column gap-2 oe-restaurant-slider-banner-content-main">

                                                                    <div
                                                                        class="d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                                        <span
                                                                            class="oe-restaurant-slider-icon-img me-2 ms-0 position-relative">
                                                                            <div class="oe-restaurant-slider-icon">
                                                                                <img src="<?php echo esc_url(wp_get_attachment_url($slide['mini_head_image'])); ?>"
                                                                                    alt="">
                                                                            </div>
                                                                        </span>
                                                                        <span
                                                                            class="oe-restaurant-slider-sub-head ovheadtag-<?php echo esc_attr($post_id); ?>">
                                                                            <?php echo esc_html($slide['head_tag']); ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="oe-restaurant-slider-banner-heading-box">
                                                                        <h1
                                                                            class="oe-restaurant-slider-banner-main-head text-md-start text-sm-center text-center title-<?php echo esc_attr($post_id); ?>">
                                                                            <?php echo esc_html($slide['title']); ?>
                                                                        </h1>
                                                                    </div>
                                                                    <p
                                                                        class="oe-restaurant-slider-banner-sec-para text-lg-left text-md-start text-sm-center text-center description-<?php echo esc_attr($post_id); ?>">
                                                                        <?php echo esc_html($slide['description']); ?>
                                                                    </p>
                                                                    <div
                                                                        class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-restaurant-slider-banner-btn-box pt-3 ">
                                                                        <a class="oe-restaurant-slider-explore-btn slider-btn-<?php echo esc_attr($post_id); ?> ov-btn-<?php echo esc_attr($post_id); ?>"
                                                                            href="<?php echo esc_url($slide['button_url']); ?>">
                                                                            <?php echo esc_html($slide['button_text']); ?>
                                                                        </a>
                                                                        <a class="oe-restaurant-slider-appointement-btn slider-btn-<?php echo esc_attr($post_id); ?> ov-btn-<?php echo esc_attr($post_id); ?>"
                                                                            href="<?php echo esc_url($slide['button2_url']); ?>">
                                                                            <?php echo esc_html($slide['button2_text']); ?>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- sliding functionality end -->
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div> <!-- End of swiper-wrapper -->
                                    </div> <!-- End of swiper-container -->

                                </div>
                            </div>

                            <div class="row oe-restaurant-slider-details-content-box">


                                <!-- neww added for counter -->
                                <div class="slider-counter">
                                    <span id="current-slide">01</span> <span
                                        style="color: white ; font-size : 1.5rem">/</span><span
                                        id="total-slides"><?php echo count($slides); ?></span>
                                </div>
                                <!-- ended -->

                                <div class="col-xl-8 col-lg-8 oe-restaurant-slider-address-content-box">
                                    <div class="slider-nav-arrow">

                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                    <div class="row oe-restaurant-slider-address-outer-box">
                                        <div
                                            class="col-xl-6 col-lg-6 col-md-9 col-sm-8 col-12 mb-md-4 mb-lg-0 oe-restaurant-slider-address d-flex">
                                            <div class="oe-restaurant-slider-address-icon align-self-center">
                                                <img src="<?php echo esc_url(isset($static_settings['mini_images_1'][0]) ? wp_get_attachment_url($static_settings['mini_images_1'][0]) : ''); ?>"
                                                    alt="">
                                            </div>
                                            <div class="oe-restaurant-slider-address-box ms-3">
                                                <p class="oe-restaurant-slider-address-title ov-mini-imp">
                                                    <?php echo esc_html($static_settings['mini_titles'][0] ?? 'Restaurant Address'); ?>
                                                </p>
                                                <p class="oe-restaurant-slider-address-para ov-mini-description">
                                                    <?php echo esc_html($static_settings['mini_descriptions'][0] ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div
                                            class="col-xl-6 col-lg-6 col-md-9 col-sm-8 col-12 pt-md-0 pt-sm-3 oe-restaurant-slider-call d-flex">
                                            <div class="oe-restaurant-slider-call-icon ">
                                                <img src="<?php echo esc_url(isset($static_settings['mini_images_2'][0]) ? wp_get_attachment_url($static_settings['mini_images_2'][0]) : ''); ?>"
                                                    alt="">
                                            </div>
                                            <div class="oe-restaurant-slider-call-box ms-3">
                                                <p class="oe-restaurant-slider-call-title ov-mini-imp">
                                                    <?php echo esc_html($static_settings['mini_title2'][0] ?? 'Call For Us'); ?>
                                                </p>
                                                <p class="oe-restaurant-slider-call-para ov-mini-description">
                                                    <?php echo esc_html($static_settings['slide_no'] ?? '+12 3456789123'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- vedio content -->
                                    <div id="vedio-img-box"
                                        class="col-xl-1 col-lg-2 oe-restaurant-slider-video-content-box p-0"
                                        style="background-image: url('<?php echo esc_url(isset($static_settings['video_bg_image']) ? $static_settings['video_bg_image'] : ''); ?>');">
                                        <div class="oe-restaurant-slider-video-box">
                                            <a class="oe-restaurant-slider-video-btn myVideoBtns"
                                                data-url="<?php echo esc_url(isset($static_settings['slide_video_url']) ? $static_settings['slide_video_url'] : '#'); ?>"
                                                href="#">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>

                                        <!-- Video Modal -->
                                        <div id="myVideoNewModals" class="modal-new animated fadeInDownBig delay-1000"
                                            style="display: none;">
                                            <div class="modal-contents">
                                                <button class="close-one">&times;<span
                                                        class="screen-reader-text"><?php echo esc_html('Close button'); ?></span></button>
                                                <iframe id="videoEmbed" width="100%" height="345" frameborder="0"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- vedio content end -->
                                </div>


                                <div
                                    class="col-xl-4 col-lg-4 oe-restaurant-slider-review-content-box p-0 position-relative">
                                    <div class="oe-restaurant-slider-review-outer-box">
                                        <div class="oe-restaurant-slider-review-box d-flex">
                                            <div class="oe-restaurant-slider-review-image align-self-center">
                                                <img src="<?php echo esc_url(isset($static_settings['corner_images'][0]) ? wp_get_attachment_url($static_settings['corner_images'][0]) : ''); ?>"
                                                    alt="">

                                            </div>
                                            <div
                                                class="oe-restaurant-slider-review-text text-sm-start text-center align-self-center">
                                                <p class="oe-restaurant-slider-review-count review-font">
                                                    <?php echo esc_html($static_settings['ov_template_review_no'] ?? '05k+'); ?>
                                                </p>
                                                <p class="oe-restaurant-slider-review-count-text review-text-font">
                                                    <?php echo esc_html($static_settings['ov_template_review_text'] ?? 'Tourist Review'); ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="oe-restaurant-slider-special-box">
                                            <p class="oe-restaurant-slider-special-title slide-list">
                                                <?php echo esc_html($static_settings['list_title'] ?? 'Daily Specials'); ?>
                                            </p>
                                            <p class="oe-restaurant-slider-special-text slide-desc">
                                                <?php echo esc_html($static_settings['list_description'] ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'); ?>
                                            </p>

                                            <div class="oe-restaurant-slider-special-points-box ">
                                                <ul style="padding-left: 18px;">
                                                    <?php
                                                    if (!empty($static_settings['enter_list'])) {
                                                        foreach ($static_settings['enter_list'] as $item) {
                                                            echo '<li class="slide-list-content">' . esc_html($item) . '</li>';
                                                        }
                                                    } else {
                                                        echo '<li>BBQ Ribs</li><li>Grilled Salmon</li><li>Cavatappi Pasta</li><li>Summertime Pesto Pasta</li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>



                    </div>
                    <div class="icon-list-box">
                        <div class="icons-list">
                            <div class="icons"><a href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"
                                    target="_blank"><i class="fa-brands fa-facebook-f ov-social-icon"></i></a></div>
                            <div class="icons"><a
                                    href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"
                                    target="_blank"><i class="fa-brands fa-instagram ov-social-icon"></i></a></div>
                            <div class="icons"><a href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"
                                    target="_blank"><i class="fa-brands fa-youtube ov-social-icon"></i></a></div>
                            <div class="icons"><a
                                    href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"
                                    target="_blank"><i class="fa-solid fa-basketball ov-social-icon"></i></a></div>
                            <div class="icons"><a href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"
                                    target="_blank"><i class="fa-brands fa-twitter ov-social-icon"></i></a></div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</section>



<script>
    // left menu
    jQuery(".Show").on('click', function () {
        jQuery(".left_menu_col").toggleClass("open");
    });
</script>