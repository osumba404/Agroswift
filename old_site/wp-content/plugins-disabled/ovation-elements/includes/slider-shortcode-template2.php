<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Set a global variable to indicate the current template
global $ova_elems_template;
$ova_elems_template = 'template2';

// Prepare dynamic settings for the slider
$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? 'fade',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];

wp_localize_script('ova-elems-template-2-frontend-scripts', 'template2SliderConfig', $dynamic_settings);

wp_enqueue_style('ova-elems-style2', OVA_ELEMS_URL . 'assets/css/style2.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-2-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-2-scripts.js', array('jquery'), OVA_ELEMS_VER, true);
//end
?>

<section class="oe-travel-slider" id="oe_travel_slider">
    <div class="oe-travel-slider-after">
        <div class="oe-inner-wrap">
            <div class="social-media-wrap">
                <div class="oe-icons-container">
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
                <div class="follow-title ov_social_text_font_size">
                    <?php echo esc_html($static_settings['ov_template_review_text'] ?? ''); ?></div>
            </div>

            <div class="oe-travel-slider-inner">
                <div class="oe-travel-heading">
                    <h2>Travel</h2>
                </div>
                <div class="oe-travel-banner-wrap">

                    <!-- newly add -->

                    <div class="swiper-container oe-travel-slider-main">
                        <div class="swiper-wrapper">
                            <?php foreach ($slides as $index => $slide): ?>
                                <div class="swiper-slide slider-main-image-<?php echo esc_attr($post->ID); ?>-<?php echo esc_attr($index); ?>"
                                    style="background-image: url('<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>');">
                                    <div class="oe-travel-slider-content oe-travel-slider-content-main">
                                        <span
                                            class="heading-tag ovheadtag-<?php echo esc_attr($post_id); ?>"><?php echo esc_html($slide['head_tag']); ?></span>
                                        <h1 class="title-<?php echo esc_attr($post_id); ?>">
                                            <?php echo esc_html($slide['title']); ?>    <?php echo esc_html($slide['title']); ?>
                                        </h1>
                                        <p class="banner-para description-<?php echo esc_attr($post_id); ?>">
                                            <?php echo esc_html($slide['description']); ?></p>
                                        <a class="theme-btn ov-btn-<?php echo esc_attr($post_id); ?> slider-btn-<?php echo esc_attr($post_id); ?>"
                                            href="<?php echo esc_url($slide['button_url']); ?>"
                                            class="theme-btn"><?php echo esc_html($slide['button_text']); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Swiper navigation -->
                        <div class="swiper-sliders-buttons">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                    </div>

                    <!-- newly end -->
                    <div class="oe-travel-slider-custom-nav">
                        <div class="banner-nav-top">
                            <div class="oe-travel-slider-inner-wrap">
                                <?php foreach ($slides as $index => $slide): ?>
                                    <div class="oe-travel-nav-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="nav-dot"><img
                                                src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                                alt="Banner Image"></div>
                                        <div class="slide-count"><?php echo esc_html(sprintf('%02d.', $index + 1)); ?></div>
                                        <div class="slide-title ov-mini-title"><?php echo esc_html($slide['head_tag']); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div class="oe-travel-slider-content">


                                    <p class="banner-para ov-mini-description">
                                        <?php echo esc_html($static_settings['mini_description2'][0]); ?></p>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="oe-slider-controls">
                            <a href="#" class="prev"><i class="fa-solid fa-chevron-left"></i></a>
                            <a href="#" class="next"><i class="fa-solid fa-chevron-right"></i></a>
                        </div> -->

                    </div>
                    <div class="oe-slider-clients">
                        <div class="client-images">
                            <!-- <div class="oe-slider-add-icon"><i class="fa-solid fa-plus"></i></div> -->
                            <?php if (!empty($corner_images)): ?>
                                <?php foreach ($corner_images as $image_id): ?>
                                    <div class="img-holder"><img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>"
                                            alt="Client Image"></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!-- Happy Clients -->
                            <h6><?php echo esc_html($static_settings['ov_template_social_review_text'] ?? ''); ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>