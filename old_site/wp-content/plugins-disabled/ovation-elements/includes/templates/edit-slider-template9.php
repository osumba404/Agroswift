<?php
if (!defined('ABSPATH'))
    exit;
// Edit Slider Page

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
$is_premium_user = get_option('ovation_slider_is_premium', false); // modify 
?>

<?php

$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-9.png';
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
                    <h3 class="plugin_title">Business Slider Template</h3>
                    <p class="plugin_description">
                        The Business Slider Template is a dynamic and professional design tool perfect for creating
                        visually stunning, interactive sliders for business websites. With customizable options for
                        images, text, and calls-to-action, it helps businesses showcase their services, portfolio, or
                        announcements effectively.
                    </p>
                    <div class="buttons" id="sticky_btns">
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
    <div class="modal fade modal-temp-1" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Display Template Image -->
                    <!-- live preview start -->
                    <section>
                        <div class="container-fluid p-5 preview-main">
                            <div class="row " style="position: relative;">
                                <div class="col-lg-5 col-md-5 col-sm-12 business-foremost-container" style="background-image: url(''); background-size: cover; background-position: center; background-repeat: no-repeat; z-index: 0;  position:relative;
">
                                    <div class="bg-img">
                                        <div style="
">
                                        </div>

                                        <div class="foremost">
                                            <h2 class="foremost-title1 text-end">The Foremost & Premier Source1</h2>

                                            <!-- Button Below H2 -->
                                            <div class="explore-more-div explore-more-div-1"><a href="#"
                                                    class="btn explore-more explore-more-btn-1">Explore
                                                    More</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7 p-0">
                                    <!-- Slider main container -->
                                    <div class="business-banner-slider ">
                                        <div id="scaefy-swiper" class="swiper-container swiper-container-1">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide swiper-slide-1 ">
                                                    <img src="" alt="Slide 1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-preview-btn">
                                            <div class="flex-numbers">
                                                <p class="btn-one">01</p>
                                                <p>02</p>
                                                <p>03</p>
                                                <p>04</p>
                                            </div>
                                        </div>

                                        <!-- Pagination and navigation container -->
                                        <div class="swiper-controls">
                                            <!-- Pagination -->
                                            <div class="swiper-pagination"></div>

                                            <!-- Custom Navigation arrows -->
                                            <div class="swiper-nav-buttons">
                                                <div class="custom-button-prev">‹</div>
                                                <div class="custom-button-next">›</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="col-12 business-follower-container">
                                <div class="business-follower-main">

                                    <p class="business-title business-title-1">Business Followers</p>
                                </div>

                                <div class="social-media-div social-media-div-1">

                                    <div class="icons"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></div>
                                    <div class="icons icons-1"><a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    </div>
                                    <div class="icons"><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
                                    <div class="icons"><a href="#"><i class="fa-solid fa-basketball"></i></a></div>
                                    <div class="icons"><a href="#"><i class="fa-brands fa-twitter"></i></a></div>

                                </div>
                            </div>
                    </section>
                    <!-- live preview end  -->
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->

    <!-- end -->

    <div class="wrap">
        <div class="container-custom plugin_edit_options">

            <!-- <h1 class="editor-heading">Edit Slider</h1> -->
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                enctype="multipart/form-data" id="slider-form">
                <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>
                <!-- <input type="hidden" name="action" value="save_ova_elems_data" /> -->
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

                <div class="static-container my-static-container mb-4 p-3 border rounded">
                    <!-- tab base settings  -->
                    <div class="settings-tabs">
                        <div class="tab-content" id="settingsTabContent">
                            <!-- Free Settings Tab -->
                            <div class="tab-pane fade show active" id="free-settings" role="tabpanel"
                                aria-labelledby="free-tab">
                                <!-- slider add -->
                                <div id="slider-slides">
                                    <?php if (empty($slides)): ?>
                                        <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                                            <div class="row">
                                                <h3 class="slider-form-heading fdsffsd">Slide 1</h3>
                                                <div class="col-md-12 form-group bg_img_color d-flex align-items-center">
                                                    <label for="slide_image_0">Upload Image:</label>
                                                    <input type="hidden" id="slide_image_0" name="slide_images[]" />
                                                    <img src=""
                                                        style="max-width: 100px; max-height: 100px; display: none;" />
                                                    <button type="button" class="upload_image_button button mt-2">Upload
                                                        Image:</button>
                                                    <!-- Add Remove Image Button (Initially hidden) -->
                                                    <button type="button"
                                                        class="remove_image_button button btn btn-danger mt-2"
                                                        style="margin-left: 10px; display: none;">Remove Background
                                                        Image</button>


                                                    <!-- For Background Color -->
                                                    <label for="slide_bg_color_0">Background Color:</label>
                                                    <input type="color" id="slide_bg_color_0" name="slide_bg_color[]" />
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="slide_title_0">Title:</label>
                                                    <input type="text" id="slide_title_0" name="slide_titles[]"
                                                        class="form-control" placeholder="Enter slide title" />
                                                </div>

                                                <div class="col-lg-12 col-md-6 form-group halfs">
                                                    <label for="slide_button_text_0">Button Text:</label>
                                                    <input type="text" id="slide_button_text_0" name="slide_button_texts[]"
                                                        class="form-control" placeholder="Enter button text" />
                                                </div>
                                                <div class="col-lg-12 col-md-6 form-group halfs">
                                                    <label for="slide_button_url_0">Button URL:</label>
                                                    <input type="url" id="slide_button_url_0" name="slide_button_urls[]"
                                                        class="form-control" placeholder="Enter button URL" />
                                                </div>

                                                <div class="col-lg-12 col-md-6 form-group halfs">
                                                    <button type="button" class="remove_slide_button btn btn-danger">Remove
                                                        Slide</button>

                                                    <button type="button" class="add_slide_button"
                                                        class="btn btn-success">Add Slide</button>
                                                </div>

                                            </div>

                                        </div>
                                    <?php endif; ?>

                                    <?php foreach ($slides as $index => $slide): ?>
                                        <div class="slide-container mb-4 p-3 border rounded"
                                            data-index="<?php echo esc_attr($index); ?>">
                                            <div class="row">
                                                <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                                <div class="col-md-12 form-group d-flex align-items-center">
                                                    <label for="slide_image_<?php echo esc_attr($index); ?>">Upload
                                                        Image:</label>
                                                    <input type="hidden" id="slide_image_<?php echo esc_attr($index); ?>"
                                                        name="slide_images[]"
                                                        value="<?php echo esc_attr($slide['image_id']); ?>" />
                                                    <img class="ml-2"
                                                        src="<?php echo esc_url(wp_get_attachment_url($slide['image_id'])); ?>"
                                                        style="max-width: 100px; max-height: 100px; display: block;" />
                                                    <button type="button"
                                                        class="upload_image_button button btn btn-primary mt-2">Upload
                                                        Image</button>
                                                    <button type="button"
                                                        class="remove_image_button button btn btn-danger mt-2"
                                                        style="margin-left: 10px; display: none;">Remove Background
                                                        Image</button>

                                                    <label for="slide_bg_color_<?php echo esc_attr($index); ?>">Background
                                                        Color:</label>
                                                    <input type="color" id="slide_bg_color_<?php echo esc_attr($index); ?>"
                                                        name="slide_bg_color[]"
                                                        value="<?php echo esc_attr($slide['slide_bg_color']); ?>" />
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="slide_title_<?php echo esc_attr($index); ?>">Title:</label>
                                                    <input type="text" id="slide_title_<?php echo esc_attr($index); ?>"
                                                        name="slide_titles[]"
                                                        value="<?php echo esc_attr($slide['title']); ?>"
                                                        class="form-control" placeholder="Enter slide title here" />
                                                </div>
                                                <div class="col-md-6 form-group halfs">
                                                    <label for="slide_button_text_<?php echo esc_attr($index); ?>">Button
                                                        Text:</label>
                                                    <input type="text"
                                                        id="slide_button_text_<?php echo esc_attr($index); ?>"
                                                        name="slide_button_texts[]"
                                                        value="<?php echo esc_attr($slide['button_text']); ?>"
                                                        class="form-control" placeholder="Enter button text" />
                                                </div>
                                                <div class="col-md-6 form-group halfs">
                                                    <label for="slide_button_url_<?php echo esc_attr($index); ?>">Button
                                                        URL:</label>
                                                    <input type="url" id="slide_button_url_<?php echo esc_attr($index); ?>"
                                                        name="slide_button_urls[]"
                                                        value="<?php echo esc_url($slide['button_url']); ?>"
                                                        class="form-control" placeholder="Enter button URL" />
                                                </div>

                                                <div class="col-md-6 form-group halfs">
                                                    <button type="button" class="remove_slide_button btn btn-danger">Remove
                                                        Slide</button>
                                                    <button type="button" class="add_slide_button btn btn-success">Add
                                                        Slide</button>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; ?>

                                </div>

                                <!-- slider end -->

                                <!-- new add  -->
                                <div class="tab_all_inputs">


                                    <div class="row">
                                        <div class="form-group col-md-6 halfs ">
                                            <label for="instagram_url">Instagram URL:</label>
                                            <input type="url" id="instagram_url" name="instagram_url"
                                                class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['instagram_url']) ? $static_settings['instagram_url'] : ''); ?>"
                                                placeholder="Enter Instagram URL" />
                                        </div>

                                        <div class="form-group col-md-6 halfs">
                                            <label for="youtube_url">YouTube URL:</label>
                                            <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['youtube_url']) ? $static_settings['youtube_url'] : ''); ?>"
                                                placeholder="Enter YouTube URL" />
                                        </div>

                                        <div class="form-group col-md-6 halfs">
                                            <label for="facebook_url">Facebook URL:</label>
                                            <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['facebook_url']) ? $static_settings['facebook_url'] : ''); ?>"
                                                placeholder="Enter Facebook URL" />
                                        </div>

                                        <div class="form-group col-md-6 halfs">
                                            <label for="basketball_url">Dribbble URL:</label>
                                            <input type="url" id="basketball_url" name="basketball_url"
                                                class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['basketball_url']) ? $static_settings['basketball_url'] : ''); ?>"
                                                placeholder="Enter Dribbble URL" />
                                        </div>

                                        <div class="form-group col-md-6 halfs">
                                            <label for="twitter_url">Twitter URL:</label>
                                            <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['twitter_url']) ? $static_settings['twitter_url'] : ''); ?>"
                                                placeholder="Enter Twitter URL" />
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="ov_template_review_text">Review Text</label>
                                            <small class="form-text text-muted">Ex :(xyz Followers[Educate Followers] ,
                                                Follow us , subscribe ).</small>
                                            <input type="text" id="ov_template_review_text"
                                                name="ov_template_review_text" class="form-control"
                                                value="<?php echo isset($static_settings['ov_template_review_text']) ? esc_attr($static_settings['ov_template_review_text']) : ''; ?>"
                                                placeholder="Enter review text" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="bg_slide_image">Slide left Background Image</label>
                                            <input type="text" id="bg_slide_image" name="bg_slide_image"
                                                class="form-control"
                                                value="<?php echo esc_url(isset($static_settings['bg_slide_image']) ? $static_settings['bg_slide_image'] : ''); ?>"
                                                placeholder="Enter or upload background image URL" />
                                            <button type="button"
                                                class="btn btn-primary upload-bg-slide-image">Upload</button>

                                            <?php if (!empty($static_settings['bg_slide_image'])): ?>
                                                <div class="preview-bg-slide-image" style="margin-top: 10px;">
                                                    <img src="<?php echo esc_url($static_settings['bg_slide_image']); ?>"
                                                        alt="Background Image"
                                                        style="max-width: 150px; height: auto; border: 1px solid #ddd; padding: 5px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- end  -->

                                    <!-- new settings -->

                                    <div class="row">
                                        <div class="form-group col-md-4 half">
                                            <label for="slide_font_size">Tittle Text Font Size</label>
                                            <input type="number" id="heading_font_size" name="heading_font_size"
                                                class="form-control"
                                                value="<?php echo esc_attr(isset($static_settings['heading_font_size']) ? $static_settings['heading_font_size'] : '42'); ?>" />
                                        </div>

                                        <div class="form-group col-md-4 mini">
                                            <label for="slide_font_size">Button Text Font Size</label>
                                            <input type="number" id="button_font_size" name="button_font_size"
                                                class="form-control"
                                                value="<?php echo esc_attr(isset($static_settings['button_font_size']) ? $static_settings['button_font_size'] : '18'); ?>" />
                                        </div>

                                        <div class="form-group col-md-4 mini">
                                            <label for="ov_social_text_font_size">OV Social Text Font Size</label>
                                            <input type="number" id="ov_social_text_font_size"
                                                name="ov_social_text_font_size" class="form-control"
                                                value="<?php echo esc_attr(isset($static_settings['ov_social_text_font_size']) ? $static_settings['ov_social_text_font_size'] : '22'); ?>" />
                                        </div>



                                    </div>
                                    <!-- Add more free settings here -->
                                </div>
                            </div>
                            <!-- Advanced Settings Tab -->
                            <div class="tab-pane fade" id="advanced-settings" role="tabpanel"
                                aria-labelledby="advanced-tab">

                                <div class="row">

                                    <div class="col-md-4 mb-4 form-group flex-row d-flex align-items-center">
                                        <label class="mr-2" for="autoplay_setting">Enable Autoplay:</label>
                                        <input type="checkbox" id="autoplay_setting" name="autoplay_setting" value="1"
                                            <?php checked(!empty($static_settings['autoplay']), true); ?>
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>

                                    </div>

                                    <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                        <label for="autoplay_delay">Autoplay Delay Time (ms):</label>
                                        <input type="number" id="autoplay_delay" name="autoplay_delay"
                                            value="<?php echo esc_attr($static_settings['autoplay_delay'] ?? 1000); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                        <label for="effect">Select Effect:</label>
                                        <select id="effect" name="effect"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?>>
                                            <option value="slide"
                                                <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>Slide
                                            </option>
                                            <option value="fade"
                                                <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>Fade
                                            </option>
                                            <option value="cube"
                                                <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>Cube
                                            </option>
                                            <option value="coverflow"
                                                <?php selected($static_settings['effect'] ?? '', 'coverflow'); ?>>
                                                Coverflow</option>
                                        </select>
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>


                                    <!-- Social Icon Active Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_active_color" class="social_icon_active_color">Social
                                            Icon Active Color</label>
                                        <input type="text" id="social_icon_active_color" name="social_icon_active_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_active_color']) ? $static_settings['social_icon_active_color'] : '#000000'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                    </div>

                                    <!-- Social Icon Hover Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_hover_color">Social Icon Hover Color</label>
                                        <input type="text" id="social_icon_hover_color" name="social_icon_hover_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_hover_color']) ? $static_settings['social_icon_hover_color'] : '#fff'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                    </div>

                                    <!-- Social Icon Size -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_size">Social Icon Size</label>
                                        <input type="number" id="social_icon_size" name="social_icon_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_size']) ? $static_settings['social_icon_size'] : '24'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Button Background Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_bg_color">Button Background Color</label>
                                        <input type="text" id="button_bg_color" name="button_bg_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_bg_color']) ? $static_settings['button_bg_color'] : '#468998'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>


                                    <!-- Button Hover Background Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_hover_bg_color">Button Hover Background Color</label>
                                        <input type="text" id="button_hover_bg_color" name="button_hover_bg_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_hover_bg_color']) ? $static_settings['button_hover_bg_color'] : '#FFFFFF'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- checking changes for color picker end  -->

                                    <!-- Button Text Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_text_color">Button Text Color</label>
                                        <input type="text" id="button_text_color" name="button_text_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_text_color']) ? $static_settings['button_text_color'] : '#fff'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Button Hover Text Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_hover_text_color">Button Hover Text Color</label>
                                        <input type="text" id="button_hover_text_color" name="button_hover_text_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_hover_text_color']) ? $static_settings['button_hover_text_color'] : '#000000'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                      <!-- Image Overlay Setting -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="image_overlay">Image Overlay Color</label>
                                        <input type="text" id="image_overlay" name="image_overlay" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['image_overlay']) ? $static_settings['image_overlay'] : '#468998'); ?>"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Custom CSS Field -->
                                    <div class="col-md-12 mb-4 form-group">
                                        <label for="custom_css">Custom CSS</label>
                                        <textarea id="custom_css" name="custom_css" class="form-control" rows="6"
                                            <?php if (!$is_premium_user) echo 'disabled'; ?>><?php echo esc_textarea(isset($static_settings['custom_css']) ? $static_settings['custom_css'] : ''); ?></textarea>
                                        <small class="form-text text-muted">You can add custom CSS rules here. Example:
                                            .my-class { color: red; }</small>
                                        <?php if (!$is_premium_user): ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!$is_premium_user): ?>
                                    <small class="form-text upgrade-message">
                                        Enhance your experience by <a
                                            href="https://www.ovationthemes.com/products/ovation-elements-pro"
                                            target="_blank" rel="noopener noreferrer">upgrading to the Pro version</a>
                                        to access advanced settings.
                                    </small>
                                    <?php endif; ?>
                                </div>

                                <!-- Add more advanced settings here -->
                            </div>

                        </div>
                    </div>

                    <!-- tab base END  -->
                </div>

                <button type="submit" class="btn btn-primary">Save Slider</button>
            </form>

        </div>
    </div>