<?php
if (!defined('ABSPATH'))
    exit;
// Edit Slider Page5

if (!isset($_GET['post']) || !absint($_GET['post'])) {
    wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
}

$post_id = absint($_GET['post']);
$post = get_post($post_id);

if (!$post || $post->post_type != 'ova_elems') {
    wp_die(esc_html__('Invalid slider post.', 'ovation-elements'));
}

$slides = get_post_meta($post_id, '_ova_elems_slides', true);
$slides = $slides ? maybe_unserialize($slides) : array();
$static_settings = get_post_meta($post_id, '_ova_elems_static_settings', true);
$static_settings = $static_settings ? maybe_unserialize($static_settings) : array();
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-5.png';
$is_premium_user = get_option('ovation_slider_is_premium', false); // modify 
$ovation_logo = OVA_ELEMS_URL . 'assets/images/logo.png';
?>

<!-- Display Template Image -->
<div id="ovs-edit-page" class="plugin_output_content">

    <div class="logo_review_btn">
        <div class="logo">
            <a href="#"><img src="<?php echo esc_url($ovation_logo); ?>" alt="" class="template-preview-image " /></a>
        </div>
        <div class="review">
            <a href="<?php echo esc_url('https://wordpress.org/support/plugin/ovation-elements/'); ?>"
                class="ov-head-review" target="_blank" rel="noopener noreferrer">Review Now</a>
        </div>
    </div>
    <div class="container">
        <div class="row content-row">
            <div class="col-md-6">
                <div class="image">
                    <img src="<?php echo esc_url($template1_image_url); ?>" alt="" class="template-preview-image " />
                </div>
            </div>

            <div class="col-md-6">
                <div class="content text-center">
                    <h3 class="plugin_title">Food Slider Template</h3>
                    <p class="plugin_description">
                        The Food Slider Template is a dynamic and professional design tool perfect for creating visually
                        stunning, interactive sliders for business websites. With customizable options for images, text,
                        and calls-to-action, it helps businesses showcase their services, portfolio, or announcements
                        effectively.
                    </p>
                    <div class="buttons">
                        <button type="button" id="submit-slider" class="btn btn-primary">Save Slider</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- live preview -->
    <div class="modal fade modal-temp-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Content of the modal goes here -->
                    <section class="oe-circular-slider oe-circular-slider_food">
                        <div class="oe-circular-slider-after">
                            <div class="oe-inner-wrap">
                                <div class="nav-position-helper swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide slide-outer active" style="background-image: url('');">
                                            <div class="after-holder">
                                                <div class="content-wrapper">
                                                    <div class="offer-tag">
                                                        Head Tag
                                                    </div>
                                                    <h1 class="heading">
                                                        Slide Title
                                                    </h1>
                                                    <div class="theme-para">
                                                        Slide Description
                                                    </div>
                                                    <div class="slide-number">
                                                        01
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oe-slider-controls-prev swiper-button-prev">
                                        <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                                    </div>
                                    <div class="oe-slider-controls-next swiper-button-next">
                                        <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
                                    </div>
                                </div>

                                <div class="nav-wrapper">
                                    <div class="triangle left" style="--r:3px;"></div>
                                    <div class="slider-nav">
                                        <div class="nav-item" data-index="0">
                                            <div class="item-img">
                                                <img src="thumbnail-url" alt="Thumbnail Title">
                                            </div>
                                            <div class="item-name">
                                                Thumbnail Title
                                            </div>
                                        </div>
                                    </div>
                                    <div class="triangle right" style="--r:3px;"></div>
                                </div>

                                <div class="slider-counter">
                                    <span class="current-slide">
                                        01
                                    </span>
                                    <span class="total-slides">
                                        /02
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="wrap">
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data"
            id="slider-form">
            <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>
            <input type="hidden" name="action"
                value="<?php echo $is_premium_user ? 'save_ova_elems_pro_data' : 'save_ova_elems_data'; ?>" />
            <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />



            <div class="tabs_buttons_outer">
                <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="free-tab" data-toggle="tab" href="#free-settings" role="tab"
                            aria-controls="free-settings" aria-selected="true">Content</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="advanced-tab" data-toggle="tab" href="#advanced-settings" role="tab"
                            aria-controls="advanced-settings" aria-selected="false">
                            <i class="fa fa-crown"></i> Advanced
                        </a>
                    </li>
                </ul>
            </div>
            <div class="static-container mb-4 p-3 border rounded">
                <div class="settings-tabs">

                    <div class="tab-content" id="settingsTabContent">
                        <!-- Free Settings Tab -->
                        <div class="tab-pane fade show active" id="free-settings" role="tabpanel"
                            aria-labelledby="free-tab">

                            <!-- slider add -->
                            <div id="slider-slides">
                                <?php if (empty($slides)): ?>
                                    <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                                        <h3>Slide 1</h3>

                                        <div class="form-group">
                                            <label for="slide_image_0">Image</label>
                                            <input type="hidden" id="slide_image_0" name="slide_images[]" />
                                            <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                                            <button type="button"
                                                class="upload_image_button button btn btn-primary mt-2">Upload
                                                Image</button>

                                            <!-- For Background Color -->
                                            <label for="slide_bg_color_0">Background Color:</label>
                                            <input type="color" id="slide_bg_color_0" name="slide_bg_color[]" />
                                        </div>
                                        <div class="form-group">
                                            <label for="slide_title_0">Title</label>
                                            <input type="text" id="slide_title_0" name="slide_titles[]" class="form-control"
                                                placeholder="Enter slide title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="slide_description_0">Description</label>
                                            <textarea id="slide_description_0" name="slide_descriptions[]" rows="3"
                                                class="form-control" placeholder="Enter slide description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="slide_thumbnail_image_0">Thumbnail Image</label>
                                            <input type="hidden" id="slide_thumbnail_image_0"
                                                name="slide_thumbnail_images[]" />
                                            <img src="" style="max-width: 100px; max-height: 100px; display: none;" />
                                            <button type="button"
                                                class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail
                                                Image</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="slide_thumbnail_title_0">Thumbnail Title</label>
                                            <input type="text" id="slide_thumbnail_title_0" name="slide_thumbnail_titles[]"
                                                class="form-control" placeholder="Enter thumbnail title" />
                                        </div>
                                        <div class="form-group">
                                            <label for="slide_head_tag_0">Head Tag</label>
                                            <small class="form-text text-muted">Please enter a relevant head text for the
                                                slide. It will display above the title.</small>
                                            <input type="text" id="slide_head_tag_0" name="slide_head_tags[]"
                                                class="form-control" placeholder="Enter head tag" />
                                        </div>



                                        <button type="button" class="remove_slide_button btn btn-danger">Remove
                                            Slide</button>
                                        <button type="button" class="add_slide_button" class="btn btn-success">Add
                                            Slide</button>
                                    </div>
                                <?php endif; ?>

                                <?php foreach ($slides as $index => $slide): ?>
                                    <div class="slide-container mb-4 p-3 border rounded"
                                        data-index="<?php echo esc_attr($index); ?>">
                                        <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                        <div class="form-group">
                                            <label for="slide_image_<?php echo esc_attr($index); ?>">Upload Slider
                                                Image</label>
                                            <input type="hidden" id="slide_image_<?php echo esc_attr($index); ?>"
                                                name="slide_images[]" value="<?php echo esc_attr($slide['image_id']); ?>" />
                                            <img src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                                style="max-width: 100px; max-height: 100px; display: block;" />
                                            <button type="button"
                                                class="upload_image_button button btn btn-primary mt-2">Upload
                                                Image</button>

                                            <label for="slide_bg_color_<?php echo esc_attr($index); ?>">Background
                                                Color:</label>
                                            <input type="color" id="slide_bg_color_<?php echo esc_attr($index); ?>"
                                                name="slide_bg_color[]"
                                                value="<?php echo esc_attr($slide['slide_bg_color']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label for="slide_title_<?php echo esc_attr($index); ?>">Title</label>
                                            <input type="text" id="slide_title_<?php echo esc_attr($index); ?>"
                                                name="slide_titles[]" value="<?php echo esc_attr($slide['title']); ?>"
                                                class="form-control" placeholder="Enter slide title" />
                                        </div>

                                        <div class="form-group">
                                            <label
                                                for="slide_description_<?php echo esc_attr($index); ?>">Description</label>
                                            <textarea id="slide_description_<?php echo esc_attr($index); ?>"
                                                name="slide_descriptions[]" rows="3" class="form-control"
                                                placeholder="Enter slide description"><?php echo esc_textarea($slide['description']); ?></textarea>
                                        </div>


                                        <div class="form-group">
                                            <label for="slide_thumbnail_image_<?php echo esc_attr($index); ?>">Thumbnail
                                                Image</label>
                                            <input type="hidden" id="slide_thumbnail_image_<?php echo esc_attr($index); ?>"
                                                name="slide_thumbnail_images[]"
                                                value="<?php echo esc_attr($slide['thumbnail_image_id']); ?>" />
                                            <img src="<?php echo esc_url(wp_get_attachment_url($slide['thumbnail_image_id'])); ?>"
                                                style="max-width: 100px; max-height: 100px; display: block;" />
                                            <button type="button"
                                                class="upload_image_button button btn btn-primary mt-2">Upload Thumbnail
                                                Image</button>
                                        </div>

                                        <div class="form-group">
                                            <label for="slide_thumbnail_title_<?php echo esc_attr($index); ?>">Thumbnail
                                                Title</label>
                                            <input type="text" id="slide_thumbnail_title_<?php echo esc_attr($index); ?>"
                                                name="slide_thumbnail_titles[]"
                                                value="<?php echo esc_attr($slide['thumbnail_title']); ?>"
                                                class="form-control" placeholder="Enter thumbnail title" />
                                        </div>

                                        <div class="form-group">
                                            <label for="slide_head_tag_<?php echo esc_attr($index); ?>">Head Tag</label>
                                            <input type="text" id="slide_head_tag_<?php echo esc_attr($index); ?>"
                                                name="slide_head_tags[]" value="<?php echo esc_attr($slide['head_tag']); ?>"
                                                class="form-control" placeholder="Enter head tag" />
                                        </div>



                                        <button type="button" class="remove_slide_button btn btn-danger">Remove
                                            Slide</button>
                                        <button type="button" class="add_slide_button" class="btn btn-success">Add
                                            Slide</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- slider end -->

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="bg_slide_image">Slider Background Image</label>
                                    <input type="text" id="bg_slide_image" name="bg_slide_image" class="form-control"
                                        value="<?php echo esc_url(isset($static_settings['bg_slide_image']) ? $static_settings['bg_slide_image'] : ''); ?>"
                                        placeholder="Enter or upload background image URL" />
                                    <button type="button" class="btn btn-primary upload-bg-slide-image">Upload</button>

                                    <?php if (!empty($static_settings['bg_slide_image'])): ?>
                                        <div class="preview-bg-slide-image" style="margin-top: 10px;">
                                            <img src="<?php echo esc_url($static_settings['bg_slide_image']); ?>"
                                                alt="Background Image"
                                                style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    <?php endif; ?>
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="slide_font_size">Head Text Font Size</label>
                                    <input type="number" id="head_font_size" name="head_font_size" class="form-control"
                                        value="<?php echo esc_attr(isset($static_settings['head_font_size']) ? $static_settings['head_font_size'] : '16'); ?>"
                                        placeholder="Enter head text font size" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="slide_font_size">Title Text Font Size</label>
                                    <input type="number" id="heading_font_size" name="heading_font_size"
                                        class="form-control"
                                        value="<?php echo esc_attr(isset($static_settings['heading_font_size']) ? $static_settings['heading_font_size'] : '36'); ?>"
                                        placeholder="Enter title text font size" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="slide_font_size">Description Text Font Size</label>
                                    <input type="number" id="banner_font_size" name="banner_font_size"
                                        class="form-control"
                                        value="<?php echo esc_attr(isset($static_settings['banner_font_size']) ? $static_settings['banner_font_size'] : '18'); ?>"
                                        placeholder="Enter description text font size" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="ov_mini_title_font_size">Thumbnail Font Size</label>
                                    <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                        class="form-control"
                                        value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '22'); ?>"
                                        placeholder="Enter thumbnail font size" />
                                </div>

                            </div>
                            <!-- Add more free settings here -->
                        </div>

                        <!-- Advanced Settings Tab -->
                        <div class="tab-pane fade" id="advanced-settings" role="tabpanel"
                            aria-labelledby="advanced-tab">
                            <div class="row">

                                <div class="col-md-4 mb-4 form-group flex-row d-flex align-items-center">
                                    <label class="mr-2" for="autoplay_setting">Enable Autoplay:</label>
                                    <input type="checkbox" id="autoplay_setting" name="autoplay_setting" 
                          value="1" <?php checked(!empty($static_settings['autoplay']), true); ?> 

                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                    <?php if (!$is_premium_user): ?>
                                        <!-- <small class="form-text text-muted">Upgrade to the pro version to enable autoplay.</small> -->
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                    <label for="autoplay_delay">Autoplay Delay Time (ms):</label>
                                    <input type="number" id="autoplay_delay" name="autoplay_delay"
                                        value="<?php echo esc_attr($static_settings['autoplay_delay'] ?? 1000); ?>"
                                        <?php if (!$is_premium_user)
                                            echo 'disabled'; ?> />
                                    <?php if (!$is_premium_user): ?>
                                        <!-- <small class="form-text text-muted">Upgrade to the pro version to adjust autoplay delay.</small>  -->
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                    <label for="effect">Select Effect:</label>
                                    <select id="effect" name="effect" <?php if (!$is_premium_user)
                                        echo 'disabled'; ?>>
                                        <option value="slide" <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>Slide</option>
                                        <option value="fade" <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>Fade</option>
                                        <option value="cube" <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>Cube</option>
                                        <option value="coverflow" <?php selected($static_settings['effect'] ?? '', 'coverflow'); ?>>Coverflow</option>
                                    </select>
                                </div>

                                <!-- Custom CSS Field -->
                                <div class="col-md-12 mb-4 form-group">
                                    <label for="custom_css">Custom CSS</label>
                                    <textarea id="custom_css" name="custom_css" class="form-control" rows="6" 
                                <?php if (!$is_premium_user) echo 'disabled'; ?>><?php echo esc_textarea(isset($static_settings['custom_css']) ? $static_settings['custom_css'] : ''); ?></textarea>  
                                    <small class="form-text text-muted">You can add custom CSS rules here. Example:
                                        .my-class { color: red; }</small>
                                    <?php if (!$is_premium_user): ?>
                                        <!-- <small class="form-text text-muted">Upgrade to the pro version to add custom CSS.</small> -->
                                    <?php endif; ?>
                                </div>

                                <?php if (!$is_premium_user): ?>
                                    <small class="form-text upgrade-message">
                                        Enhance your experience by <a
                                            href="https://www.ovationthemes.com/products/ovation-elements-pro"
                                            target="_blank" rel="noopener noreferrer">upgrading to the Pro version</a> to
                                        access advanced settings.
                                    </small>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
            <button type="submit" class="btn btn-primary">Save Slider</button>
        </form>
    </div>