<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $ova_elems_template;
$ova_elems_template = 'template1';


wp_enqueue_style('ova-elems-style1', OVA_ELEMS_URL . 'assets/css/style1.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-1-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-1-scripts.js', ['swiper-js'], OVA_ELEMS_VER, true);

// Prepare dynamic settings for the slider
$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? 'fade',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];
wp_localize_script('ova-elems-template-1-frontend-scripts', 'template1SliderConfig', $dynamic_settings);

?>
<section class="oe-coperate-slider" id="oe_coperate_slider">
    <div class="inner-wrap">
        <div class="slide-counter-wrap">
            <div class="counter-wrap">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="count <?php echo $index === 0 ? 'active' : ''; ?>"><?php echo esc_html($index + 1); ?></div>
                <?php endforeach; ?>
            </div>
            <div class="social-media-wrap">
                <div class="follow-title ov_social_text_font_size">
                    <?php echo esc_html($static_settings['ov_template_review_text'] ?? ''); ?></div>
                <div class="oe-icons-container ">
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
        </div>
        <div class="swiper oe-slider-outer">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="swiper-slide">
                        <div
                            class="slider-main-image slider-main-image-<?php echo esc_attr($post->ID); ?>-<?php echo esc_attr($index); ?>">
                            <?php if (!empty($slide['image_id'])): ?>
                                <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                    alt="<?php echo esc_attr($slide['title']); ?>" class="swiper-lazy">
                            <?php endif; ?>
                        </div>
                        <div class="oe-slider-content">
                            <?php if (!empty($slide['title'])): ?>
                                <h1 class="title title-<?php echo esc_attr($post_id); ?>">
                                    <?php echo esc_html($slide['title']); ?></h1>
                            <?php endif; ?>
                            <?php if (!empty($slide['description'])): ?>
                                <p class="description description-<?php echo esc_attr($post_id); ?>">
                                    <?php echo esc_html($slide['description']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])): ?>
                                <a class="slider-btn ov-btn-<?php echo esc_attr($post_id); ?> slider-btn-<?php echo esc_attr($post_id); ?>"
                                    href="<?php echo esc_url($slide['button_url']); ?>"
                                    class="theme-btn"><?php echo esc_html($slide['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <div class="oe-slider-businessInfo">
                <div class="oe-slider-businessInfo-inner">
                    <?php if (!empty($static_settings['mini_titles']) && !empty($static_settings['mini_images_1'])): ?>
                        <?php foreach ($static_settings['mini_titles'] as $index => $title): ?>
                            <div class="information-card">
                                <div class="icon">
                                    <?php if (!empty($static_settings['mini_images_1'][$index])): ?>
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][$index])); ?>"
                                            alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="info-inner">
                                    <h3 class="heading ov-mini-title"><?php echo esc_html($title); ?></h3>
                                    <p class="description ov-mini-description">
                                        <?php echo esc_html($static_settings['mini_descriptions'][$index] ?? ''); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($static_settings['mini_title2']) || !empty($static_settings['mini_description2'])): ?>
                        <div class="information-card">
                            <div class="icon">
                                <?php if (!empty($static_settings['mini_images_2'][0])): ?>
                                    <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0])); ?>"
                                        alt="<?php echo esc_attr($static_settings['mini_title2'][0]); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="info-inner">
                                <h3 class="heading ov-mini-title">
                                    <?php echo esc_html($static_settings['mini_title2'][0]); ?></h3>
                                <p class="description ov-mini-description">
                                    <?php echo esc_html($static_settings['mini_description2'][0]); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-1 col-12 order-md-2 order-sm-1 order-1 position-relative nav-arrow">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

        </div>


        <div class="oe-slider-clients">
            <div class="client-images">
                <div class="oe-slider-add-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <?php if (!empty($corner_images)): ?>
                    <?php foreach ($corner_images as $image_id): ?>
                        <div class="img-holder">
                            <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" alt="Corner Image">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- Happy Clients -->
                <p class="ov_review_text_font_size">
                    <?php echo esc_html($static_settings['ov_template_social_review_text'] ?? ''); ?></p>
            </div>
        </div>
    </div>
    </div>
</section>