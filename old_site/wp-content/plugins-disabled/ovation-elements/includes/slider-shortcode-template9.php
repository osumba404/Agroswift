<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $ova_elems_template;
$ova_elems_template = 'template9';

wp_enqueue_style('ova-elems-style9', OVA_ELEMS_URL . 'assets/css/style9.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-9-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-9-scripts.js', ['swiper-js'], OVA_ELEMS_VER, true);

$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? 'fade',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];
wp_localize_script('ova-elems-template-9-frontend-scripts', 'template9SliderConfig', $dynamic_settings);

?>


<div class="container-fluid-1">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-md-12 foremost-container"
            style="background-image: url('<?php echo esc_url(isset($static_settings['bg_slide_image']) ? $static_settings['bg_slide_image'] : ''); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="foremost">
                <h2 class="foremost-title title-<?php echo esc_attr($post_id); ?>"></h2>
                <h2 class="foremost-title-1 text-start title-<?php echo esc_attr($post_id); ?>"></h2>
                <!-- Button Below H2 -->
                <div class="explore-more-div"><a href="#"
                        class="btn explore-more ov-btn-<?php echo esc_attr($post_id); ?> slider-btn-<?php echo esc_attr($post_id); ?>">
                    </a></div>
            </div>
        </div>


        <div class="col-sm-12 col-md-7 col-lg-7 col-md-12 p-0 business-swiper-slider-container">
            <!-- Slider main container -->
            <div class="banner-slider">
                <div id="scaefy-swiper" class="swiper-container swiper-container-1">

                    <!-- change -->
                    <div class="swiper-wrapper">
                        <?php if (!empty($slides)): ?>
                            <?php foreach ($slides as $index => $slide): ?>
                                <div
                                    class="swiper-slide slider-main-image-<?php echo esc_attr($post->ID); ?>-<?php echo esc_attr($index); ?>">
                                    <?php if (!empty($slide['image_id'])): ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                            alt="<?php echo esc_attr($slide['title']); ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($slide['title'])): ?>
                                        <div class="slide-title"><?php echo esc_html($slide['title']); ?></div>
                                    <?php endif; ?>

                                    <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])): ?>
                                        <a href="<?php echo esc_url($slide['button_url']); ?>"
                                            class="slide-button"><?php echo esc_html($slide['button_text']); ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- changes end -->
                </div>

                <div class="swiper-controls">
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- Custom Navigation arrows -->
                    <div class="swiper-nav-buttons">
                        <div class="custom-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path
                                    d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                            </svg>
                        </div>
                        <div class="custom-button-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path
                                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="col-12 business-follower-container">
        <div class="business-follower-main">
            <p class="business-title ov_social_text_font_size">
                <?php echo esc_html($static_settings['ov_template_review_text'] ?? ''); ?>
            </p>
        </div>
        <div class="social-media-div">
            <div class="icons"><a href="<?php echo esc_url($static_settings['facebook_url'] ?? '#'); ?>"
                    target="_blank"><i class="fa-brands fa-facebook-f ov-social-icon"></i></a></div>
            <div class="icons"><a href="<?php echo esc_url($static_settings['instagram_url'] ?? '#'); ?>"
                    target="_blank"><i class="fa-brands fa-instagram ov-social-icon"></i></a></div>
            <div class="icons"><a href="<?php echo esc_url($static_settings['youtube_url'] ?? '#'); ?>"
                    target="_blank"><i class="fa-brands fa-youtube ov-social-icon"></i></a></div>
            <div class="icons"><a href="<?php echo esc_url($static_settings['basketball_url'] ?? '#'); ?>"
                    target="_blank"><i class="fa-solid fa-basketball ov-social-icon"></i></a></div>
            <div class="icons"><a href="<?php echo esc_url($static_settings['twitter_url'] ?? '#'); ?>"
                    target="_blank"><i class="fa-brands fa-twitter ov-social-icon"></i></a></div>
        </div>
    </div>