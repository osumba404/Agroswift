<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Set a global variable to indicate the current template
global $ova_elems_template;
$ova_elems_template = 'template5';

$total_slides = count($slides);
$activeSlideIndex = $static_settings['active_slide_index'] ?? 0;

wp_enqueue_style('ova-elems-style5', OVA_ELEMS_URL . 'assets/css/style5.css', array(), OVA_ELEMS_VER);
wp_enqueue_script('ova-elems-template-5-frontend-scripts', OVA_ELEMS_URL . 'assets/js/template-5-scripts.js', array('jquery'), OVA_ELEMS_VER, true);

// Prepare dynamic settings for the slider
$dynamic_settings = [
    'autoplay' => (!empty($static_settings['autoplay']) && $static_settings['autoplay'] == '1') ? ($static_settings['autoplay_delay'] ?? 1000) : false, // Autoplay delay
    'effect' => $static_settings['effect'] ?? '',
    'crossFade' => !empty($static_settings['fade_crossfade']),
    'lazyLoad' => !empty($static_settings['lazy_load']) && $static_settings['lazy_load'] == '1' ? true : false,
    'autoplay_delay' => isset($static_settings['autoplay_delay']) ? absint($static_settings['autoplay_delay']) : 1000,
];

// Localize the script
wp_localize_script('ova-elems-template-5-frontend-scripts', 'template5SliderConfig', $dynamic_settings);
?>

<body>
    <section class="oe-circular-slider"
        style="background-image: url('<?php echo esc_url(isset($static_settings['bg_slide_image']) ? $static_settings['bg_slide_image'] : ''); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="oe-circular-slider-after">
            <div class="oe-inner-wrap">


                <div class="nav-position-helper swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="swiper-slide slider-main-image-<?php echo esc_attr($post->ID); ?>-<?php echo esc_attr($index); ?> "
                                style="background-image: url('<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>');">
                                <div class="after-holder">
                                    <div class="content-wrapper">
                                        <div class="offer-tag ovheadtag-<?php echo esc_attr($post_id); ?>">
                                            <?php echo esc_html($slide['head_tag']); ?>
                                        </div>
                                        <h1 class="heading title-<?php echo esc_attr($post_id); ?>">
                                            <?php echo esc_html($slide['title']); ?>
                                        </h1>
                                        <div class="theme-para description-<?php echo esc_attr($post_id); ?>">
                                            <?php echo esc_html($slide['description']); ?>
                                        </div>
                                        <div class="slide-number">
                                            <?php echo esc_html(sprintf('%02d', $index + 1)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="slider-swiper-button-nav">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>



                <div class="nav-wrapper">
                    <div class="triangle left" style="--r:3px;"></div>
                    <!-- Thumbnails -->
                    <div class="slider-nav">
                        <?php foreach ($slides as $index => $slide): ?>
                            <div class="nav-item" data-index="<?php echo esc_attr($index); ?>">
                                <div class="item-img">
                                    <?php
                                    $thumbnail_url = wp_get_attachment_url($slide['thumbnail_image_id']);
                                    if ($thumbnail_url): ?>
                                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                                            alt="<?php echo esc_attr($slide['thumbnail_title']); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="item-name ov-mini-thumb-titleimp">
                                    <?php echo esc_html($slide['thumbnail_title']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="triangle right" style="--r:3px;"></div>
                </div>

                <div class="slider-counter">
                    <!-- Active slide count -->
                    <span class="current-slide">
                        <?php echo sprintf('%02d', 1); // Example for current slide ?>
                    </span>/
                    <!-- Total slide count -->
                    <span class="total-slides">
                        <?php echo esc_html(sprintf('%02d', count($slides))); ?>
                    </span>
                </div>
            </div>
        </div>
    </section>