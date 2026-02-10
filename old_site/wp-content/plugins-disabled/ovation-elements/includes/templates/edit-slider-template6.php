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
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-6.png';
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-6.png';
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
                    <h3 class="plugin_title">Restaurant Slider Template</h3>
                    <p class="plugin_description">
                        The Restaurant Slider Template is a dynamic and professional design tool perfect for creating
                        visually stunning, interactive sliders for business websites. With customizable options for
                        images, text, and calls-to-action, it helps businesses showcase their services, portfolio, or
                        announcements effectively.
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
    <!-- end -->

    <!-- live preview -->
    <div class="modal fade modal-temp-6" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- live preview code start -->

                    <section id="oe-restaurant-slider-main-box" class="oe-restaurant-slider-main-box_restaurant"
                        style="background-image: url('');">
                        <div id="carouselExampleIndicators" class="carousel slides carousel-fade" data-bs-ride=""
                            data-bs-interval="1500">
                            <div class="carousel-inner" role="listbox">

                                <div>
                                    <div class="inner_carousel" id="slidemainbox">
                                        <div class="oe-restaurant-slider-bg-image position-relative">
                                            <div class="container">

                                                <div class="oe-restaurant-slider-content-outer-box position-relative">
                                                    <div class="row">
                                                        <div
                                                            class="col-xl-6 col-lg-7 col-md-12 col-sm-12 col-12 oe-restaurant-slider-content-inner-box align-self-center">
                                                            <div class="oe-restaurant-slider-banner-content-box">
                                                                <div
                                                                    class="d-flex flex-column gap-2 oe-restaurant-slider-banner-content-main">
                                                                    <div
                                                                        class="d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                                        <span
                                                                            class="oe-restaurant-slider-icon-img mr-2 me-2 ms-0 position-relative">
                                                                            <div class="oe-restaurant-slider-icon">
                                                                                <div class="icon">
                                                                                    <img src="path/to/image.jpg"
                                                                                        alt="Title">
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                        <span
                                                                            class="oe-restaurant-slider-sub-head">Welcome
                                                                            To My Restaurant</span>
                                                                    </div>
                                                                    <div
                                                                        class="oe-restaurant-slider-banner-heading-box">
                                                                        <h1
                                                                            class="oe-restaurant-slider-banner-main-head">
                                                                            The Restaurant Holds Spices</h1>
                                                                    </div>
                                                                    <p class="oe-restaurant-slider-banner-sec-para">
                                                                        Lorem Ipsum is simply dummy text of the printing
                                                                        and typesetting industry. Lorem Ipsum has been
                                                                        the industry's standard dummy text ever since
                                                                        the 1500s, when an unknown printer took a galley
                                                                        of type and scrambled it to make a type specimen
                                                                        book.</p>

                                                                    <div
                                                                        class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-restaurant-slider-banner-btn-box pt-3">
                                                                        <a class="oe-restaurant-slider-explore-btn"
                                                                            href="#">Explore More</a>
                                                                        <a class="oe-restaurant-slider-appointement-btn"
                                                                            href="#">Appointment</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 oe-restaurant-slider-banner-box">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 390 -->
                                                <div class="row restaurant_info">
                                                    <div class="slider-nav-arrow">
                                                        <a class="carousel-control-prev"
                                                            data-bs-target="#carouselExampleIndicators" role="button"
                                                            data-bs-slide-to="prev">
                                                            <i class="fa-solid fa-angle-left slider-icon"></i>

                                                        </a>
                                                        <a class="carousel-control-next"
                                                            data-bs-target="#carouselExampleIndicators" role="button"
                                                            data-bs-slide-to="next">
                                                            <i class="fa-solid fa-angle-right slider-icon"></i>

                                                        </a>

                                                    </div>
                                                    <div
                                                        class="col-xl-7 col-lg-6 col-md-6 oe-restaurant-slider-address-content-box">
                                                        <div class="row oe-restaurant-slider-address-outer-box">
                                                            <div
                                                                class="col-xl-6 col-lg-6 col-md-6 col-sm-8 col-12 oe-restaurant-slider-address d-flex">
                                                                <div
                                                                    class="oe-restaurant-slider-address-icon align-self-center">
                                                                    <i class="fa-solid fa-location-dot"></i>

                                                                </div>
                                                                <div class="oe-restaurant-slider-address-box ms-3">
                                                                    <p class="oe-restaurant-slider-address-title">
                                                                        Restaurant Address</p>
                                                                    <p class="oe-restaurant-slider-address-para">Lorem
                                                                        Ipsum is simply dummy text of the printing and
                                                                        typesetting industry.</p>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="col-xl-6 col-lg-6 col-md-6 col-sm-8 col-12 oe-restaurant-slider-call d-flex">
                                                                <div
                                                                    class="oe-restaurant-slider-call-icon align-self-center">
                                                                    <i class="fa-solid fa-phone"></i>
                                                                    <img src="">
                                                                </div>
                                                                <div
                                                                    class="oe-restaurant-slider-call-box ms-3 align-self-center">
                                                                    <p class="oe-restaurant-slider-call-title">Call For
                                                                        Us</p>
                                                                    <p class="oe-restaurant-slider-call-para">+12
                                                                        3456789123</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-1 col-lg-2 col-md-2 oe-restaurant-slider-video-content-box p-0"
                                                        style="position: relative; background-size: 100% 100%; background-image: url();">

                                                        <div class="oe-restaurant-slider-video-box">
                                                            <a class="oe-restaurant-slider-video-btn myVideoBtns"
                                                                data-url="#" href="#myModal1" id="myBtn1">
                                                                <i class="fa fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-4 col-md-4  oe-restaurant-slider-review-content-box p-0 position-relative">
                                                        <div class="oe-restaurant-slider-review-outer-box">
                                                            <div class="oe-restaurant-slider-review-box d-flex">
                                                                <div class="oe-restaurant-slider-review-image">

                                                                    <div class="icon">
                                                                        <img src="path/to/image.jpg" alt="Title">
                                                                    </div>
                                                                </div>
                                                                <div class="oe-restaurant-slider-review-text">
                                                                    <p class="oe-restaurant-slider-review-count">05k+
                                                                    </p>
                                                                    <p class="oe-restaurant-slider-review-count-text">
                                                                        Tourist Review</p>
                                                                </div>
                                                            </div>

                                                            <div class="oe-restaurant-slider-special-box">
                                                                <p class="oe-restaurant-slider-special-title">Daily
                                                                    Specials</p>
                                                                <p class="oe-restaurant-slider-special-text">Lorem Ipsum
                                                                    is simply dummy text of the printing and typesetting
                                                                    industry.</p>

                                                                <div class="oe-restaurant-slider-special-points-box">
                                                                    <ul style="padding-left: 18px;">
                                                                        <li>BBQ Ribs</li>
                                                                        <li>Grilled Salmon</li>
                                                                        <li>Cavatappi Pasta</li>
                                                                        <li>Summertime Pesto Pasta</li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="slider-nav-arrow">
                                <a class="carousel-control-prev" data-bs-target="#carouselExampleIndicators"
                                    role="button" data-bs-slide-to="prev">
                                    <i class="fa-solid fa-angle-left slider-icon"></i>
                                </a>
                                <a class="carousel-control-next" data-bs-target="#carouselExampleIndicators"
                                    role="button" data-bs-slide-to="next">
                                    <i class="fa-solid fa-angle-right slider-icon"></i>
                                </a>

                            </div>
                        </div>

                        <div class="oe-restaurant-slider-social-icon-box d-flex left_menu_col">
                            <span class="oe-restaurant-slider-follow-icon-box ">

                            </span>
                        </div>
                    </section>


                    <!-- live preview code end -->

                </div>
            </div>
        </div>
    </div>

    <!-- end  -->


    <!-- end -->

    <div class="wrap">
        <div class="container-custom">

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
                <div class="static-container mb-4 p-3 border rounded">

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
                                                <h3 class="slider-form-heading">Slide 1</h3>
                                                <div class="form-group col-md-12 d-flex align-items-center">
                                                    <label class="mr-2" for="slide_image_0">Image: </label>
                                                    <input type="hidden" id="slide_image_0" name="slide_images[]" />
                                                    <img src=""
                                                        style="max-width: 100px; max-height: 100px; display: none;" />
                                                    <button type="button" class="upload_image_button button mt-2">Upload
                                                        Image:</button>
                                                    <!-- For Background Color -->
                                                    <label for="slide_bg_color_0">Background Color:</label>
                                                    <input type="color" id="slide_bg_color_0" name="slide_bg_color[]" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="slide_title_0">Title:</label>
                                                    <input type="text" id="slide_title_0" name="slide_titles[]"
                                                        class="form-control" placeholder="Enter slide title" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="slide_description_0">Description:</label>
                                                    <textarea id="slide_description_0" name="slide_descriptions[]" rows="3"
                                                        class="form-control"
                                                        placeholder="Enter slide description"></textarea>
                                                </div>
                                                <!-- New Mini Head Tag Image Setting -->
                                                <div class="form-group col-md-6 d-flex align-items-center">
                                                    <label for="slide_mini_head_image_0">Mini Head Tag Image:</label>
                                                    <input type="hidden" id="slide_mini_head_image_0"
                                                        name="slide_mini_head_images[]" />
                                                    <img src="" id="mini_head_image_preview_0"
                                                        style="max-width: 100px; max-height: 100px; display: none;" />
                                                    <button type="button" class="upload_image_button button mt-2">Upload
                                                        Mini Head Tag Image</button>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="slide_head_tag_0">Head Tag</label>
                                                    <small class="form-text text-muted">Please enter a relevant head text
                                                        for the slide. It will display above the title.</small>
                                                    <input type="text" id="slide_head_tag_0" name="slide_head_tags[]"
                                                        class="form-control" placeholder="Enter head tag text" />
                                                </div>

                                                <div class="form-group  col-md-6 halfs">
                                                    <label for="slide_button_text_0">Button Text:</label>
                                                    <input type="text" id="slide_button_text_0" name="slide_button_texts[]"
                                                        class="form-control" placeholder="Enter button text" />
                                                </div>
                                                <div class="form-group col-md-6 halfs">
                                                    <label for="slide_button_url_0">Button URL:</label>
                                                    <input type="url" id="slide_button_url_0" name="slide_button_urls[]"
                                                        class="form-control" placeholder="Enter button URL" />
                                                </div>

                                                <div class="form-group col-md-6 halfs">
                                                    <label for="slide_button2_text_0">Button Text 2:</label>
                                                    <input type="text" id="slide_button2_text_0"
                                                        name="slide_button2_texts[]" class="form-control"
                                                        placeholder="Enter second button text" />
                                                </div>
                                                <div class="form-group col-md-6 halfs">
                                                    <label for="slide_button2_url_0">Button URL 2:</label>
                                                    <input type="url" id="slide_button2_url_0" name="slide_button2_urls[]"
                                                        class="form-control" placeholder="Enter second button URL" />
                                                </div>

                                                <div class="col-md-6">
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

                                            </div>
                                            <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                            <div class="form-group col-md-12">
                                                <label for="slide_image_<?php echo esc_attr($index); ?>">Upload
                                                    Image:</label>
                                                <input type="hidden" id="slide_image_<?php echo esc_attr($index); ?>"
                                                    name="slide_images[]"
                                                    value="<?php echo esc_attr($slide['image_id']); ?>" />
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
                                            <div class="form-group col-md-12">
                                                <label for="slide_title_<?php echo esc_attr($index); ?>">Title:</label>
                                                <input type="text" id="slide_title_<?php echo esc_attr($index); ?>"
                                                    name="slide_titles[]" value="<?php echo esc_attr($slide['title']); ?>"
                                                    class="form-control" placeholder="Enter slide title" />
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label
                                                    for="slide_description_<?php echo esc_attr($index); ?>">Description:</label>
                                                <textarea id="slide_description_<?php echo esc_attr($index); ?>"
                                                    name="slide_descriptions[]" rows="3" class="form-control"
                                                    placeholder="Enter slide description"><?php echo esc_textarea($slide['description']); ?></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="slide_head_tag_<?php echo esc_attr($index); ?>">Head Tag</label>
                                                <input type="text" id="slide_head_tag_<?php echo esc_attr($index); ?>"
                                                    name="slide_head_tags[]"
                                                    value="<?php echo esc_attr($slide['head_tag']); ?>" class="form-control"
                                                    placeholder="Enter head tag" />
                                            </div>

                                            <!-- New Mini Head Tag Image Setting -->
                                            <div class="form-group col-md-6 d-flex align-items-center">
                                                <label for="slide_mini_head_image_<?php echo esc_attr($index); ?>">Mini Head
                                                    Tag Image:</label>
                                                <input type="hidden"
                                                    id="slide_mini_head_image_<?php echo esc_attr($index); ?>"
                                                    name="slide_mini_head_images[]"
                                                    value="<?php echo esc_attr($slide['mini_head_image']); ?>" />
                                                <img src="<?php echo esc_url(wp_get_attachment_url($slide['mini_head_image'])); ?>"
                                                    style="max-width: 100px; max-height: 100px; display: <?php echo !empty($slide['mini_head_image']) ? 'block' : 'none'; ?>;" />
                                                <button type="button"
                                                    class="minihead_upload_image_button button btn btn-primary mt-2">Upload
                                                    Mini Head Tag Image</button>
                                            </div>

                                            <div class="form-group col-md-6 halfs">
                                                <label for="slide_button_text_<?php echo esc_attr($index); ?>">Button
                                                    Text:</label>
                                                <input type="text" id="slide_button_text_<?php echo esc_attr($index); ?>"
                                                    name="slide_button_texts[]"
                                                    value="<?php echo esc_attr($slide['button_text']); ?>"
                                                    class="form-control" placeholder="Enter button text" />
                                            </div>
                                            <div class="form-group col-md-6 halfs">
                                                <label for="slide_button_url_<?php echo esc_attr($index); ?>">Button
                                                    URL:</label>
                                                <input type="url" id="slide_button_url_<?php echo esc_attr($index); ?>"
                                                    name="slide_button_urls[]"
                                                    value="<?php echo esc_url($slide['button_url']); ?>"
                                                    class="form-control" placeholder="Enter button URL" />
                                            </div>
                                            <!-- add -->
                                            <div class="form-group col-md-6 halfs">
                                                <label for="slide_button2_text_<?php echo esc_attr($index); ?>">Button Text
                                                    2:</label>
                                                <input type="text" id="slide_button2_text_<?php echo esc_attr($index); ?>"
                                                    name="slide_button2_texts[]"
                                                    value="<?php echo esc_attr($slide['button2_text']); ?>"
                                                    class="form-control" placeholder="Enter button text 2" />
                                            </div>
                                            <div class="form-group col-md-6 halfs">
                                                <label for="slide_button2_url_<?php echo esc_attr($index); ?>">Button URL
                                                    2:</label>
                                                <input type="url" id="slide_button2_url_<?php echo esc_attr($index); ?>"
                                                    name="slide_button2_urls[]"
                                                    value="<?php echo esc_url($slide['button2_url']); ?>"
                                                    class="form-control" placeholder="Enter button URL 2" />
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
                                        <label for="instagram_url">Instagram URL:</label>
                                        <input type="url" id="instagram_url" name="instagram_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['instagram_url']) ? $static_settings['instagram_url'] : ''); ?>"
                                            placeholder="Enter Instagram URL" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="youtube_url">YouTube URL:</label>
                                        <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['youtube_url']) ? $static_settings['youtube_url'] : ''); ?>"
                                            placeholder="Enter YouTube URL" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="facebook_url">Facebook URL:</label>
                                        <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['facebook_url']) ? $static_settings['facebook_url'] : ''); ?>"
                                            placeholder="Enter Facebook URL" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="basketball_url">Dribbble URL:</label>
                                        <input type="url" id="basketball_url" name="basketball_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['basketball_url']) ? $static_settings['basketball_url'] : ''); ?>"
                                            placeholder="Enter Dribbble URL" />
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="twitter_url">Twitter URL:</label>
                                        <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['twitter_url']) ? $static_settings['twitter_url'] : ''); ?>"
                                            placeholder="Enter Twitter URL" />
                                    </div>

                                    <!-- end  -->
                                    <!-- loacation / contact -->
                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_title_0">Enter heading:</label>
                                        <small class="form-text text-muted">Ex :(location , address).</small>
                                        <input type="text" id="slide_mini_title_0" name="slide_mini_titles[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_titles'][0] ?? ''); ?>"
                                            placeholder="Enter heading (location, address)" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_description_0">Full Address:</label>
                                        <textarea id="slide_mini_description_0" name="slide_mini_descriptions[]"
                                            rows="2" class="form-control"
                                            placeholder="Enter full address"><?php echo esc_textarea($static_settings['mini_descriptions'][0] ?? ''); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_title2_0">Enter heading:</label>
                                        <small class="form-text text-muted">Ex :(Contact , Dial).</small>
                                        <input type="text" id="slide_mini_title2_0" name="slide_mini_title2[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_title2'][0] ?? ''); ?>"
                                            placeholder="Enter heading (Contact, Dial)" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_no">Contact:</label>
                                        <input type="text" id="slide_no" name="slide_no" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['slide_no']) ? $static_settings['slide_no'] : ''); ?>"
                                            pattern="\d+" title="Only numbers are allowed"
                                            placeholder="Enter contact number" />
                                    </div>
                                    <!-- details clsoe -->


                                    <div class="form-group col-md-4 mini d-flex align-items-center gap-3 mt-3">
                                        <label for="slide_mini_image_1_0">Image/Icon for location:</label>
                                        <input type="hidden" id="slide_mini_image_1_0" name="slide_mini_images_1[]"
                                            value="<?php echo esc_attr($static_settings['mini_images_1'][0] ?? ''); ?>" />
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][0] ?? '')); ?>"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_1'][0]) ? 'none' : 'block'; ?>;" />
                                        <button type="button"
                                            class="upload_mini_image_1_button button mt-2 upload_image_button">Upload
                                            Image</button>
                                    </div>
                                    <div class="form-group col-md-4 mini d-flex align-items-center gap-3 mt-3">
                                        <label for="slide_mini_image_2_0">Image/Icon for Contact:</label>
                                        <input type="hidden" id="slide_mini_image_2_0" name="slide_mini_images_2[]"
                                            value="<?php echo esc_attr($static_settings['mini_images_2'][0] ?? ''); ?>" />
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0] ?? '')); ?>"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_2'][0]) ? 'none' : 'block'; ?>;" />
                                        <button type="button mini"
                                            class="upload_mini_image_2_button button upload_image_button">Upload
                                            Image</button>
                                    </div>
                                    <div class="form-group  col-md-4 mini d-flex align-items-center gap-3 mt-3">
                                        <label for="slide_corner_images_0">Upload Client Image:</label>
                                        <input type="hidden" id="slide_corner_images_0" name="slide_corner_images[]"
                                            value="<?php echo esc_attr(implode(',', $static_settings['corner_images'] ?? [])); ?>" />
                                        <div class="corner-images-container">
                                            <?php
                                            if (!empty($static_settings['corner_images'])) {
                                                foreach ($static_settings['corner_images'] as $image_id) {
                                                    echo '<img src="' . esc_url(wp_get_attachment_url($image_id)) . '" style="max-width: 100px; max-height: 100px; display: inline-block; margin-right: 10px;" />';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <button type="button" id="ov-imp-client"
                                            class="upload_corner_images_button button upload_image_button">Upload
                                            Image</button>
                                    </div>
                                    <!-- New Settings Start -->

                                    <!-- new add for review -->
                                    <div class="form-group  col-md-6">
                                        <label for="ov_template_review_text">Review Text</label>
                                        <input type="text" id="ov_template_review_text" name="ov_template_review_text"
                                            class="form-control"
                                            value="<?php echo isset($static_settings['ov_template_review_text']) ? esc_attr($static_settings['ov_template_review_text']) : ''; ?>"
                                            placeholder="Enter review text" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="ov_template_review_no">Review No</label>
                                        <small class="form-text text-muted">Ex: (500+, 1.5K+, 4-5*, etc.)</small>
                                        <input type="text" id="ov_template_review_no" name="ov_template_review_no"
                                            class="form-control"
                                            value="<?php echo isset($static_settings['ov_template_review_no']) ? esc_attr($static_settings['ov_template_review_no']) : ''; ?>"
                                            placeholder="Enter review number (e.g., 500+, 1.5K+)"
                                            pattern="^[\d\+\-\*\.Kk]+$" />
                                    </div>

                                    <!-- end -->

                                    <div class="form-group col-md-6 mt-4">
                                        <label for="list_title">List Title:</label>
                                        <input type="text" id="list_title" name="list_title"
                                            value="<?php echo esc_attr($static_settings['list_title'] ?? ''); ?>"
                                            class="regular-text" placeholder="Enter list title" />
                                    </div>

                                    <div class="form-group col-md-6 mt-3">
                                        <label for="list_description">List Description:</label>
                                        <textarea id="list_description" name="list_description" rows="4"
                                            class="large-text"
                                            placeholder="Enter list description"><?php echo esc_textarea($static_settings['list_description'] ?? ''); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6 mt-3">
                                        <label for="enter_list">Enter List (Comma Separated):</label>
                                        <input type="text" id="enter_list" name="enter_list"
                                            value="<?php echo esc_attr(!empty($static_settings['enter_list']) ? implode(', ', $static_settings['enter_list']) : ''); ?>"
                                            class="regular-text"
                                            placeholder="e.g., BBQ Ribs, Grilled Salmon, Cavatappi Pasta" />
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label class="mr-2" for="slide_video_url">Upload Video:</label>
                                        <small>Maximum upload file size: 2 MB</small>
                                        <input type="hidden" id="slide_video_url" name="slide_video_url"
                                            value="<?php echo esc_attr(isset($static_settings['slide_video_url']) ? $static_settings['slide_video_url'] : ''); ?>" />
                                        <video id="uploaded_video_preview" controls
                                            style="max-width: 20%; margin-top: 10px; display: <?php echo empty($static_settings['slide_video_url']) ? 'none' : 'block'; ?>;">
                                            <source
                                                src="<?php echo esc_url($static_settings['slide_video_url'] ?? ''); ?>"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <button type="button" class="upload_video_button button">Upload Video</button>
                                    </div>


                                    <!-- Video Background Image Upload Field -->
                                    <div class="form-group col-md-6 mt-3">
                                        <label for="video_bg_image">Video Background Image:</label>
                                        <input type="text" id="video_bg_image" name="video_bg_image"
                                            value="<?php echo esc_url($static_settings['video_bg_image'] ?? ''); ?>"
                                            class="regular-text" placeholder="Upload or select an image" />
                                        <button type="button" class="button upload_video_bg_image">Upload Image</button>
                                        <div id="video_bg_preview" style="margin-top:10px;">
                                            <?php if (!empty($static_settings['video_bg_image'])): ?>
                                                <img src="<?php echo esc_url($static_settings['video_bg_image']); ?>"
                                                    width="100" height="auto">
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <!-- New Settings End -->

                                    <!-- new settings -->
                                    <div class="form-group col-md-6">
                                        <label for="slide_font_size">Head Text Font Size</label>
                                        <input type="number" id="head_font_size" name="head_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['head_font_size']) ? $static_settings['head_font_size'] : '22'); ?>" />
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="slide_font_size">Tittle Text Font Size</label>
                                        <input type="number" id="heading_font_size" name="heading_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['heading_font_size']) ? $static_settings['heading_font_size'] : '56'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_font_size">Description Text Font Size</label>
                                        <input type="number" id="banner_font_size" name="banner_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['banner_font_size']) ? $static_settings['banner_font_size'] : '20'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_font_size">Button Text Font Size</label>
                                        <input type="number" id="button_font_size" name="button_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_font_size']) ? $static_settings['button_font_size'] : '18'); ?>" />
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="ov_mini_title_font_size">(address / contact) head Font Size</label>
                                        <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="mini_description_font_size">(address / contact) content Font
                                            Size</label>
                                        <input type="number" id="mini_description_font_size"
                                            name="mini_description_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['mini_description_font_size']) ? $static_settings['mini_description_font_size'] : '14'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="list_title_font_size">List Title Font Size</label>
                                        <input type="number" id="list_title_font_size" name="list_title_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_title_font_size']) ? $static_settings['list_title_font_size'] : '30'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="list_description_font_size">List Description Font Size</label>
                                        <input type="number" id="list_description_font_size"
                                            name="list_description_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_description_font_size']) ? $static_settings['list_description_font_size'] : '15'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="list_content_font_size">List Content Font Size</label>
                                        <input type="number" id="list_content_font_size" name="list_content_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_content_font_size']) ? $static_settings['list_content_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="review_text_font_size">Review Text Font Size</label>
                                        <input type="number" id="review_text_font_size" name="review_text_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['review_text_font_size']) ? $static_settings['review_text_font_size'] : '15'); ?>" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="review_no_font_size">Review Number Font Size</label>
                                        <input type="number" id="review_no_font_size" name="review_no_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['review_no_font_size']) ? $static_settings['review_no_font_size'] : '24'); ?>" />
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
                                        <input type="checkbox" id="autoplay_setting" name="autoplay_setting" value="1"
                                            <?php checked(!empty($static_settings['autoplay']), true); ?> <?php if (!$is_premium_user)
                                                    echo 'disabled'; ?> />

                                    </div>

                                    <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                        <label for="autoplay_delay">Autoplay Delay Time (ms):</label>
                                        <input type="number" id="autoplay_delay" name="autoplay_delay"
                                            value="<?php echo esc_attr($static_settings['autoplay_delay'] ?? 1000); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                        <label for="effect">Select Effect:</label>
                                        <select id="effect" name="effect" <?php if (!$is_premium_user)
                                            echo 'disabled'; ?>>
                                            <option value="fade" <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>Fade</option>
                                            <option value="slide" <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>Slide</option>
                                            <option value="cube" <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>Cube</option>
                                            <option value="coverflow" <?php selected($static_settings['effect'] ?? '', 'coverflow'); ?>>Coverflow</option>
                                        </select>

                                    </div>




                                    <!-- Social Icon Active Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_active_color">Social Icon Active Color</label>
                                        <input type="text" id="social_icon_active_color" name="social_icon_active_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_active_color']) ? $static_settings['social_icon_active_color'] : '#FFFFFF'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Social Icon Hover Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_hover_color">Social Icon Hover Color</label>
                                        <input type="text" id="social_icon_hover_color" name="social_icon_hover_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_hover_color']) ? $static_settings['social_icon_hover_color'] : '#F20000'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Social Icon Size -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_size">Social Icon Size</label>
                                        <input type="number" id="social_icon_size" name="social_icon_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_size']) ? $static_settings['social_icon_size'] : '24'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Button Background Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_bg_color">Button Background Color</label>
                                        <input type="text" id="button_bg_color" name="button_bg_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_bg_color']) ? $static_settings['button_bg_color'] : '#F20000'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Button Hover Background Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_hover_bg_color">Button Hover Background Color</label>
                                        <input type="text" id="button_hover_bg_color" name="button_hover_bg_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_hover_bg_color']) ? $static_settings['button_hover_bg_color'] : '#333333'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Button Text Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_text_color">Button Text Color</label>
                                        <input type="text" id="button_text_color" name="button_text_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_text_color']) ? $static_settings['button_text_color'] : '#ffffff'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Button Hover Text Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="button_hover_text_color">Button Hover Text Color</label>
                                        <input type="text" id="button_hover_text_color" name="button_hover_text_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_hover_text_color']) ? $static_settings['button_hover_text_color'] : '#ffffff'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Custom CSS Field -->
                                    <div class="col-md-12 mb-4 form-group">
                                        <label for="custom_css">Custom CSS</label>
                                        <textarea id="custom_css" name="custom_css" class="form-control" rows="6" <?php if (!$is_premium_user)
                                            echo 'disabled'; ?>><?php echo esc_textarea(isset($static_settings['custom_css']) ? $static_settings['custom_css'] : ''); ?></textarea>
                                        <small class="form-text text-muted">You can add custom CSS rules here. Example:
                                            .my-class { color: red; }</small>

                                    </div>

                                </div>
                                <!-- Add more advanced settings here -->
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

                    <!-- tab base END  -->
                </div>
                <button type="submit" class="btn btn-primary">Save Slider</button>
            </form>


            <br>
            <br>
            <br>
        </div>
    </div>