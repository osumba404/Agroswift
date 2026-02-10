<?php
if (!defined('ABSPATH'))
    exit;

// Ensure valid post ID
if (!isset($_GET['post']) || !absint($_GET['post'])) {
    wp_die(esc_html__('Invalid post ID.', 'ovation-elements'));
}

$post_id = absint($_GET['post']);
$post = get_post($post_id);

if (!$post || $post->post_type != 'ova_elems') {
    wp_die(esc_html__('Invalid slider post.', 'ovation-elements'));
}

$template_id = get_post_meta($post_id, '_ova_elems_template_id', true);
$selected_posts = get_post_meta($post_id, '_ova_elems_selected_posts_template4', true);
$selected_posts = $selected_posts ? maybe_unserialize($selected_posts) : array();
$static_settings = get_post_meta($post_id, '_ova_elems_static_settings_template4', true);
$static_settings = $static_settings ? maybe_unserialize($static_settings) : array();
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-7.png';
$button_data = get_post_meta($post_id, '_ova_elems_button_data_template4', true);
$button_data = $button_data ? maybe_unserialize($button_data) : array();
$tour_info_data = get_post_meta($post_id, '_ova_elems_tour_info_data_template4', true);
$tour_info_data = $tour_info_data ? maybe_unserialize($tour_info_data) : array();
$video_data = get_post_meta($post_id, '_ova_elems_video_data_template4', true);
$video_data = $video_data ? maybe_unserialize($video_data) : array();
//end

$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-7.png';
$right_bg_image = OVA_ELEMS_URL . 'assets/images/travel-bg.png';
$ovation_logo = OVA_ELEMS_URL . 'assets/images/logo.png';
$is_premium_user = get_option('ovation_slider_is_premium', false); // modify
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
                    <h3 class="plugin_title">Travel Slider Template</h3>
                    <p class="plugin_description">
                        The Travel Slider Template is a dynamic and professional design tool perfect for creating
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
    <div class="modal fade modal-temp-7" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <section id="oe-travel-slider-main-box">
                        <div class="oe-travel-slider-content-main-box oe-travel-slider-main-box_travel_tour"
                            style="background:url('<?php echo esc_url($right_bg_image) ?>')">

                            <div class="row position-relative content_outer_row">

                                <div class="col-xl-5 col-lg-6 col-md-6 pe-0">
                                    <div class="oe-travel-slider-post-bg-image"
                                        style="background-repeat: no-repeat; background-size: 100% auto; background-position: center; background-image: url(<?php echo esc_url(OVA_ELEMS_URL . 'assets/images/image1.png'); ?>);">

                                        <div
                                            class="oe-travel-slider-post-bg-bg-box d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                            <span class="oe-travel-slider-post-icon-img me-2 ms-0 position-relative">
                                                <div class="oe-travel-slider-post-icon">
                                                    <img src="" alt="">
                                                </div>
                                            </span>
                                            <span class="oe-travel-slider-post-sub-head">Jackson Lawrence</span>
                                        </div>
                                        <div class="oe-travel-slider-post-banner-outer-box">
                                            <div class="oe-travel-slider-post-banner-heading-box">
                                                <h1 class="oe-travel-slider-post-banner-main-head text-start">France
                                                    Tour</h1>
                                            </div>
                                            <p class="oe-travel-slider-post-banner-sec-para text-start">Lorem Ipsum is
                                                simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                                has been</p>

                                            <p class="oe-travel-slider-post-banner-schedule-text text-start">Next Tour :
                                                01-01-2025 To 08-01-2025 (08 Day & Night)</p>

                                            <div
                                                class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-travel-slider-banner-btn-box pt-3">
                                                <a class="oe-travel-slider-explore-btn" href="#">Explore More</a>
                                                <a class="oe-travel-slider-video-btn myVideoBtns" data-url=""
                                                    href="#myModal1" id="myBtn1">

                                                    <div class="oe-travel-slider-video-outer-btn">
                                                        <i class="fa fa-play"></i>
                                                    </div>
                                                </a>
                                                <a class="oe-travel-slider-appointement-btn" href="#">View Demo</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-6 col-md-6" style="background-image: url();">
                                    <div class="oe-travel-slider-banner-custom-box">
                                        <div class="oe-travel-slider-banner-content-box">

                                            <div class="d-flex flex-column gap-2 oe-travel-slider-banner-content-main">
                                                <div
                                                    class="ovtraveltittle d-flex justify-content-md-start justify-content-sm-start justify-content-start align-items-center">
                                                    <span class="oe-travel-slider-icon-img me-2 ms-0 position-relative">
                                                        <div class="ovation-head">

                                                            <div class="icon">
                                                                <img src="path/to/image.jpg" alt="">

                                                            </div>

                                                        </div>
                                                    </span>
                                                    <span class="oe-travel-slider-sub-head">Welcome My Travel
                                                        Agency</span>
                                                </div>
                                                <div class="oe-travel-slider-banner-heading-box">
                                                    <h1 class="oe-travel-slider-banner-main-head text-start">Find Next
                                                        Place To Visit</h1>
                                                </div>
                                                <p class="oe-travel-slider-banner-sec-para text-start">Lorem Ipsum is
                                                    simply dummy text of the printing and typesetting industry. Lorem
                                                    Ipsum has been the industry's standard dummy text ever since the
                                                    1500s</p>

                                                <div
                                                    class="oe-travel-slider-banner-btn-box d-flex gap-md-4 gap-sm-2 gap-2 align-items-center pt-3">
                                                    <a class="oe-travel-slider-explore-btn" href="#">Book Now</a>
                                                </div>
                                            </div>


                                            <div class="oe-inner-wrap">
                                                <div class="social-media-wrap">
                                                    <div class="follow-title">Follow Us</div>
                                                    <div class="oe-icons-container">
                                                        <div class="icons"><a href="#"><i
                                                                    class="fa-brands fa-facebook-f"></i></a></div>
                                                        <div class="icons"><a href="#"><i
                                                                    class="fa-brands fa-instagram"></i></a></div>
                                                        <div class="icons"><a href="#"><i
                                                                    class="fa-brands fa-youtube"></i></a></div>
                                                        <div class="icons"><a href="#"><i
                                                                    class="fa-solid fa-basketball"></i></a></div>
                                                        <div class="icons"><a href="#"><i
                                                                    class="fa-brands fa-twitter"></i></a></div>

                                                    </div>


                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                </div>


                                <div class="oe-travel-slider-post-content-box">

                                    <div
                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6 col-12 align-self-end mb-sm-0 mb-3">
                                        <div class="row oe-travel-slider-post-content-inner-box">

                                            <!-- </div> -->
                                            <div
                                                class="oe-travel-slider-review-text text-sm-start text-center align-self-center">
                                                <div class="icon">
                                                    <img src="<?php echo isset($static_settings['ov_client_image']) ? esc_url($static_settings['ov_client_image']) : ''; ?>"
                                                        alt="">
                                                </div>
                                                <div class="content">
                                                    <p class="oe-travel-slider-review-count">05k+</p>
                                                    <p class="oe-travel-slider-review-count-text">Tourist Review</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-6 col-12">
                                        <div class="row">

                                            <div
                                                class="col-xxl-3 col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 oe-travel-slider-carousel-post-boxes">

                                                <div class="oe-slider-controls">
                                                    <a href="#" class="prev"><i
                                                            class="fa-solid fa-chevron-left"></i></a>
                                                    <a href="#" class="next"><i
                                                            class="fa-solid fa-chevron-right"></i></a>
                                                </div>

                                                <div class="oe-travel-slider-carousel-post-bg-image"
                                                    style="border-radius:12px;background-size: 100% auto;background-position: center;background-image: url(<?php echo esc_url(OVA_ELEMS_URL . 'assets/images/image1.png'); ?>);">
                                                    <div class="oe-travel-slider-carousel-post-box">
                                                        <div class="oe-travel-slider-carousel-post">
                                                            <div
                                                                class="oe-travel-slider-carousel-post-bg-bg-box d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                                <span
                                                                    class="oe-travel-slider-carousel-post-icon-img me-2 ms-0 position-relative">
                                                                    <div class="oe-travel-slider-carousel-post-icon">
                                                                        <img src="" alt="">
                                                                    </div>
                                                                </span>
                                                                <span
                                                                    class="oe-travel-slider-carousel-post-sub-head">Jackson
                                                                    Lawrence</span>
                                                            </div>

                                                            <div
                                                                class="oe-travel-slider-carousel-post-banner-outer-box oe-travel-slider-carousel-post-banner-outer-box_hover">
                                                                <div
                                                                    class="oe-travel-slider-carousel-post-banner-heading-box">
                                                                    <h1
                                                                        class="oe-travel-slider-carousel-post-banner-main-head">
                                                                        France Tour</h1>
                                                                </div>
                                                                <p
                                                                    class="oe-travel-slider-carousel-post-banner-sec-para">
                                                                    Lorem Ipsum is simply dummy text of the printing and
                                                                    typesetting industry. Lorem Ipsum has been the
                                                                    industry's standard dummy text ever since the 1500s,
                                                                    when an unknown printer took a galley of type and
                                                                    scrambled it to make a type specimen book.</p>
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
                </div>
                </section><br>
                <!-- live preview end  -->
            </div>
        </div>
    </div>
</div>

<!-- end  -->


<!-- end -->

<div class="wrap">

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="slider-form">
        <input type="hidden" name="action"
            value="<?php echo $is_premium_user ? 'save_ova_elems_pro_template4_data' : 'save_ova_elems_template4_data'; ?>" />
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />
        <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>



        <div class="tabs_buttons_outer mt-5">
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
                            <?php if (!empty($selected_posts)): ?>
                                <?php foreach ($selected_posts as $index => $post_id): ?>
                                    <div class="slide-container mb-4 p-3 border rounded"
                                        data-index="<?php echo esc_attr($index); ?>">
                                        <div class="row">
                                            <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                            <div class="col-md-12 form-group">
                                                <label for="select_post_<?php echo esc_attr($index); ?>">Select Post</label>
                                                <select id="select_post_<?php echo esc_attr($index); ?>" name="selected_posts[]"
                                                    class="form-control">
                                                    <?php
                                                    $args = array('post_type' => 'post', 'posts_per_page' => -1);
                                                    $posts = get_posts($args);
                                                    foreach ($posts as $post) {
                                                        $selected = ($post->ID == $post_id) ? 'selected' : ''; ?>
                                                        <option value="<?php echo esc_attr($post->ID); ?>" <?php echo esc_attr($selected); ?>>
                                                            <?php echo esc_html($post->post_title); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <!-- Button fields -->
                                            <div class="col-md-6 form-group">
                                                <label for="button_text_<?php echo esc_attr($index); ?>">Button Text</label>
                                                <input type="text" id="button_text_<?php echo esc_attr($index); ?>"
                                                    name="button_data[<?php echo esc_attr($index); ?>][text]"
                                                    class="form-control"
                                                    value="<?php echo esc_attr($button_data[$index]['text'] ?? ''); ?>" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="button_url_<?php echo esc_attr($index); ?>">Button URL</label>
                                                <input type="url" id="button_url_<?php echo esc_attr($index); ?>"
                                                    name="button_data[<?php echo esc_attr($index); ?>][url]"
                                                    class="form-control"
                                                    value="<?php echo esc_url($button_data[$index]['url'] ?? ''); ?>" />
                                            </div>

                                            <!-- Additional fields (Button2, Tour Info) -->
                                            <div class="col-md-6 form-group">
                                                <label for="button2_text_<?php echo esc_attr($index); ?>">Button2 Text</label>
                                                <input type="text" id="button2_text_<?php echo esc_attr($index); ?>"
                                                    name="button_data[<?php echo esc_attr($index); ?>][text2]"
                                                    class="form-control"
                                                    value="<?php echo esc_attr($button_data[$index]['text2'] ?? ''); ?>" />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="button2_url_<?php echo esc_attr($index); ?>">Button2 URL</label>
                                                <input type="url" id="button2_url_<?php echo esc_attr($index); ?>"
                                                    name="button_data[<?php echo esc_attr($index); ?>][url2]"
                                                    class="form-control"
                                                    value="<?php echo esc_url($button_data[$index]['url2'] ?? ''); ?>" />
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="tour_info_<?php echo esc_attr($index); ?>">Tour Info</label>
                                                <textarea id="tour_info_<?php echo esc_attr($index); ?>"
                                                    name="tour_info_data[<?php echo esc_attr($index); ?>]"
                                                    class="form-control"><?php echo esc_html($tour_info_data[$index] ?? ''); ?></textarea>
                                            </div>

                                            <!-- Video Upload Field -->
                                            <div class="col-md-12 form-group">
                                                <label for="uploaded_video_<?php echo esc_attr($index); ?>">Upload Video</label>
                                                <input type="text" id="uploaded_video_<?php echo esc_attr($index); ?>"
                                                    name="video_data[<?php echo esc_attr($index); ?>][upload_video]"
                                                    class="form-control video-upload-url"
                                                    value="<?php echo esc_url($video_data[$index]['upload_video'] ?? ''); ?>" />
                                                <button type="button" class="button video-upload-btn"
                                                    data-target="uploaded_video_<?php echo esc_attr($index); ?>">Upload</button>
                                            </div>


                                            <!-- New field for Live Video Link -->

                                        </div>
                                        <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                                        <button type="button" class="add_slide_button btn btn-success">Add Slide</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Default Slide 1 -->
                                <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                                    <div class="row">
                                        <h3>Slide 1</h3>
                                        <div class="col-md-12 form-group">
                                            <label for="select_post_0">Select Post</label>
                                            <select id="select_post_0" name="selected_posts[]" class="form-control">
                                                <?php
                                                $args = array('post_type' => 'post', 'posts_per_page' => -1);
                                                $posts = get_posts($args);
                                                foreach ($posts as $post) { ?>
                                                    <option value="<?php echo esc_attr($post->ID); ?>">
                                                        <?php echo esc_html($post->post_title); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <!-- Button fields -->
                                        <div class="col-md-6 form-group">
                                            <label for="button_text_0">Button Text</label>
                                            <input type="text" id="button_text_0" name="button_data[0][text]"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="button_url_0">Button URL</label>
                                            <input type="url" id="button_url_0" name="button_data[0][url]"
                                                class="form-control" />
                                        </div>

                                        <!-- Additional fields (Button2, Tour Info) -->
                                        <div class="col-md-6 form-group">
                                            <label for="button2_text_0">Button2 Text</label>
                                            <input type="text" id="button2_text_0" name="button_data[0][text2]"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="button2_url_0">Button2 URL</label>
                                            <input type="url" id="button2_url_0" name="button_data[0][url2]"
                                                class="form-control" />
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label for="tour_info_0">Tour Info</label>
                                            <textarea id="tour_info_0" name="tour_info_data[0]"
                                                class="form-control"></textarea>
                                        </div>
                                        <!-- for upload vedio -->
                                        <!-- Upload Video Field with Upload Button -->
                                        <div class="col-md-12 form-group">
                                            <label for="uploaded_video_0">Upload Video</label>
                                            <input type="text" id="uploaded_video_0" name="video_data[0][upload_video]"
                                                class="form-control video-upload-url" />
                                            <button type="button" class="button video-upload-btn"
                                                data-target="uploaded_video_0">Upload</button>
                                        </div>

                                        <!-- end -->
                                        <!-- New Live Video Link Field -->

                                    </div>
                                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                                    <button type="button" class="add_slide_button btn btn-success">Add Slide</button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- slider end -->

                        <div class="row">

                            <div class="col-md-4 form-group ">
                                <label for="instagram_url">Instagram URL</label>
                                <input type="url" id="instagram_url" name="instagram_url" class="form-control"
                                    value="<?php echo isset($static_settings['instagram_url']) ? esc_url($static_settings['instagram_url']) : ''; ?>"
                                    placeholder="Enter Instagram URL" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="facebook_url">Facebook URL</label>
                                <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                    value="<?php echo isset($static_settings['facebook_url']) ? esc_url($static_settings['facebook_url']) : ''; ?>"
                                    placeholder="Enter Facebook URL" />
                            </div>
                            <div class="col-md-4 form-group ">
                                <label for="youtube_url">YouTube URL</label>
                                <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                    value="<?php echo isset($static_settings['youtube_url']) ? esc_url($static_settings['youtube_url']) : ''; ?>"
                                    placeholder="Enter YouTube URL" />
                            </div>
                            <div class="col-md-4 form-group ">
                                <label for="basketball_url">Dribbble URL</label>
                                <input type="url" id="basketball_url" name="basketball_url" class="form-control"
                                    value="<?php echo isset($static_settings['basketball_url']) ? esc_url($static_settings['basketball_url']) : ''; ?>"
                                    placeholder="Enter Dribbble URL" />
                            </div>
                            <div class="col-md-4 form-group ">
                                <label for="twitter_url">Twitter URL</label>
                                <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                    value="<?php echo isset($static_settings['twitter_url']) ? esc_url($static_settings['twitter_url']) : ''; ?>"
                                    placeholder="Enter Twitter URL" />
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="ov_template_review_text">Review Text</label>
                                <small class="form-text text-muted">Ex :(xyz Followers[Educate Followers] , Follow us ,
                                    subscribe ).</small>
                                <input type="text" id="ov_template_review_text" name="ov_template_review_text"
                                    class="form-control"
                                    value="<?php echo isset($static_settings['ov_template_review_text']) ? esc_attr($static_settings['ov_template_review_text']) : ''; ?>"
                                    placeholder="Enter review text" />
                            </div>



                            <!-- Mini Description -->
                            <div class="col-md-12 form-group ">
                                <label for="mini_description">Mini Description</label>
                                <textarea id="mini_description" name="mini_description"
                                    class="form-control"><?php echo isset($static_settings['mini_description']) ? esc_textarea($static_settings['mini_description']) : ''; ?></textarea>
                            </div>

                            <!-- Live Video Link -->

                            <!-- Right Corner Posts -->
                            <!-- new add -->


                            <div class="col-md-4 form-group ">
                                <label for="corner_posts_category">Display Posts by Category</label>
                                <select id="corner_posts_category" name="corner_posts_category" class="form-control">
                                    <option value=""><?php esc_html_e('Select Category', 'ovation-elements'); ?>
                                    </option>
                                    <?php
                                    $categories = get_categories();
                                    foreach ($categories as $category) {
                                        echo '<option value="' . esc_attr($category->term_id) . '" ' . (isset($static_settings['corner_posts_category']) ? selected($static_settings['corner_posts_category'], $category->term_id, false) : '') . '>' . esc_html($category->name) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-4 form-group ">
                                <label for="corner_posts_order">Order Posts by Date</label>
                                <select id="corner_posts_order" name="corner_posts_order" class="form-control">
                                    <option value="asc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'asc', false) : ''; ?>>
                                        <?php esc_html_e('Ascending', 'ovation-elements'); ?></option>
                                    <option value="desc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'desc', false) : ''; ?>>
                                        <?php esc_html_e('Descending', 'ovation-elements'); ?></option>
                                </select>
                            </div>

                            <!-- New Static Settings -->
                            <div class="col-md-4 form-group d-flex align-items-center">
                                <label class="mr-2" for="upload_minheadimage ">Min Head Image : </label>
                                <button type="button" class="upload_image_button button button-secondary"
                                    id="upload_minheadimage_button">Upload Image</button>
                                <div class="upload-wrapper">
                                    <input type="hidden" id="upload_minheadimage" name="upload_minheadimage"
                                        value="<?php echo isset($static_settings['upload_minheadimage']) ? esc_attr($static_settings['upload_minheadimage']) : ''; ?>" />
                                    <img id="upload_minheadimage_preview"
                                        src="<?php echo isset($static_settings['upload_minheadimage']) ? esc_url($static_settings['upload_minheadimage']) : ''; ?>"
                                        style="max-width: 80px; display: <?php echo isset($static_settings['upload_minheadimage']) && !empty($static_settings['upload_minheadimage']) ? 'block' : 'none'; ?>;" />
                                    <br />

                                    <!-- <button type="button" class="button button-link-delete" id="remove_minheadimage_button" style="display: <?php echo isset($static_settings['upload_minheadimage']) && !empty($static_settings['upload_minheadimage']) ? 'inline-block' : 'none'; ?>;">Remove Image</button> -->
                                </div>
                            </div>

                            <div class="col-md-4 form-group ">
                                <label for="ov_travel_head_tag">Travel Head Tag</label>
                                <input type="text" id="ov_travel_head_tag" name="ov_travel_head_tag"
                                    class="form-control"
                                    value="<?php echo isset($static_settings['ov_travel_head_tag']) ? esc_attr($static_settings['ov_travel_head_tag']) : ''; ?>"
                                    placeholder="Enter travel head tag" />
                            </div>

                            <div class="col-md-12 form-group ">
                                <label for="ov_static_title">Title</label>
                                <input type="text" id="ov_static_title" name="ov_static_title" class="form-control"
                                    value="<?php echo isset($static_settings['ov_static_title']) ? esc_attr($static_settings['ov_static_title']) : ''; ?>"
                                    placeholder="Enter title" />
                            </div>

                            <div class="col-md-12 form-group ">
                                <label for="static_description">Description</label>
                                <textarea id="static_description" name="static_description" class="form-control"
                                    placeholder="Enter description"><?php echo isset($static_settings['static_description']) ? esc_textarea($static_settings['static_description']) : ''; ?></textarea>
                            </div>

                            <div class="col-md-6 form-group ">
                                <label for="ov_button_text">Button Text</label>
                                <input type="text" id="ov_button_text" name="ov_button_text" class="form-control"
                                    value="<?php echo isset($static_settings['ov_button_text']) ? esc_attr($static_settings['ov_button_text']) : ''; ?>"
                                    placeholder="Enter button text" />
                            </div>

                            <div class="col-md-6 form-group ">
                                <label for="ov_button_url">Button URL</label>
                                <input type="url" id="ov_button_url" name="ov_button_url" class="form-control"
                                    value="<?php echo isset($static_settings['ov_button_url']) ? esc_url($static_settings['ov_button_url']) : ''; ?>"
                                    placeholder="Enter button URL" />
                            </div>


                            <!-- new add for review -->
                            <div class="col-md-4 form-group d-flex align-items-center">
                                <label class="mr-2" for="ov_client_image">Client Image : </label>
                                <input type="text" id="ov_client_image" name="ov_client_image" class="form-control"
                                    value="<?php echo isset($static_settings['ov_client_image']) ? esc_url($static_settings['ov_client_image']) : ''; ?>" />
                                <button type="button" class="upload_image_button button upload-image-button ml-2">Upload
                                    Image</button>
                                <div id="ov_client_image_preview" style="margin-top: 10px;">
                                    <?php if (!empty($static_settings['ov_client_image'])): ?>
                                        <img src="<?php echo esc_url($static_settings['ov_client_image']); ?>"
                                            alt="Client Image" id="ov_client_image_preview_img"
                                            style="max-width: 100px; max-height: 100px;">
                                    <?php else: ?>
                                        <img src="" alt="Client Image" id="ov_client_image_preview_img"
                                            style="display:none; max-width: 100px; max-height: 100px;">
                                    <?php endif; ?>
                                </div>
                            </div>



                            <div class="col-md-4  form-group">
                                <label for="ov_review_text">Review Text</label>
                                <input type="text" id="ov_review_text" name="ov_review_text" class="form-control"
                                    value="<?php echo isset($static_settings['ov_review_text']) ? esc_attr($static_settings['ov_review_text']) : ''; ?>"
                                    placeholder="Enter review text" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="ov_review_no">Review No</label>
                                <input type="text" id="ov_review_no" name="ov_review_no" class="form-control"
                                    value="<?php echo isset($static_settings['ov_review_no']) ? esc_attr($static_settings['ov_review_no']) : ''; ?>"
                                    placeholder="Enter review number (e.g., 500+, 1.5K+)" pattern="^[\d\+\-\*\.Kk]+$" />
                            </div>
                            <!-- new settings -->

                            <div class="col-md-4 form-group">
                                <label for="title_head_font_size">Title Head Font Size</label>
                                <input type="number" id="title_head_font_size" name="title_head_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['title_head_font_size']) ? $static_settings['title_head_font_size'] : '20'); ?>" />
                            </div>


                            <div class="col-md-4 form-group">
                                <label for="list_title_font_size">slide Title Font Size</label>
                                <input type="number" id="list_title_font_size" name="list_title_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_title_font_size']) ? $static_settings['list_title_font_size'] : '40'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="list_description_font_size">slide Description Font Size</label>
                                <input type="number" id="list_description_font_size" name="list_description_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_description_font_size']) ? $static_settings['list_description_font_size'] : '20'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="list_content_font_size">info Font Size(tour info)</label>
                                <input type="number" id="list_content_font_size" name="list_content_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_content_font_size']) ? $static_settings['list_content_font_size'] : '20'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="oe_button_font_size">Button Font Size</label>
                                <input type="number" id="oe_button_font_size" name="oe_button_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['oe_button_font_size']) ? $static_settings['oe_button_font_size'] : '18'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="ov_mini_title_font_size">(static head) text Font Size</label>
                                <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '20'); ?>" />
                            </div>

                            <!-- ov_mini_title_right Font Size -->
                            <div class="col-md-4 form-group">
                                <label for="ov_mini_title_right_font_size">Mini Title Right Font Size</label>
                                <input type="number" id="ov_mini_title_right_font_size"
                                    name="ov_mini_title_right_font_size" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_mini_title_right_font_size']) ? $static_settings['ov_mini_title_right_font_size'] : '45'); ?>" />
                            </div>

                            <!-- ov_mini_description Font Size -->
                            <div class="col-md-4 form-group">
                                <label for="ov_mini_description_font_size">Mini Description Font Size</label>
                                <input type="number" id="ov_mini_description_font_size"
                                    name="ov_mini_description_font_size" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_mini_description_font_size']) ? $static_settings['ov_mini_description_font_size'] : '18'); ?>" />
                            </div>


                            <div class="col-md-4 form-group">
                                <label for="review_text_font_size">Review Text Font Size</label>
                                <input type="number" id="review_text_font_size" name="review_text_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['review_text_font_size']) ? $static_settings['review_text_font_size'] : '20'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="review_no_font_size">Review Number Font Size</label>
                                <input type="number" id="review_no_font_size" name="review_no_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['review_no_font_size']) ? $static_settings['review_no_font_size'] : '15'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="thmhead_font_size">Thumb Author Font Size</label>
                                <input type="number" id="thmhead_font_size" name="thmhead_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['thmhead_font_size']) ? $static_settings['thmhead_font_size'] : '18'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="thmbtitle_font_size">Thumb Title Font Size</label>
                                <input type="number" id="thmbtitle_font_size" name="thmbtitle_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['thmbtitle_font_size']) ? $static_settings['thmbtitle_font_size'] : '20'); ?>" />
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="thmbdesc_font_size">Thumb Description Font Size</label>
                                <input type="number" id="thmbdesc_font_size" name="thmbdesc_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['thmbdesc_font_size']) ? $static_settings['thmbdesc_font_size'] : '12'); ?>" />
                            </div>

                            <!-- New setting for OV Review Texts Font Size -->
                            <div class="form-group col-md-4 mini">
                                <label for="ov_review_text_font_size">Review Text Font Size</label>
                                <input type="number" id="ov_review_text_font_size" name="ov_review_text_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_review_text_font_size']) ? $static_settings['ov_review_text_font_size'] : '18'); ?>" />
                            </div>

                        </div>
                        <!-- Add more free settings here -->
                    </div>

                    <!-- Advanced Settings Tab -->
                    <div class="tab-pane fade" id="advanced-settings" role="tabpanel" aria-labelledby="advanced-tab">

                        <div class="row">

                            <div class="col-md-4 mb-4 form-group flex-row d-flex align-items-center">
                                <label class="mr-2" for="autoplay_setting">Enable Autoplay:</label>
                                <input type="hidden" name="autoplay_setting" value="0" />
                                <input type="checkbox" id="autoplay_setting" name="autoplay_setting" value="1" <?php checked(!empty($static_settings['autoplay_setting']), true); ?> <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                <label for="autoplay_delay">Autoplay Delay Time (ms):</label>
                                <input type="number" id="autoplay_delay" name="autoplay_delay"
                                    value="<?php echo esc_attr($static_settings['autoplay_delay'] ?? 1000); ?>" <?php if (!$is_premium_user)
                                             echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to adjust autoplay delay.</small>  -->
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-4 d-flex flex-column form-group">
                                <label for="effect">Select Effect:</label>
                                <select id="effect" name="effect" <?php if (!$is_premium_user)
                                    echo 'disabled'; ?>>
                                    <option value="fade" <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>
                                        Fade</option>
                                    <option value="slide" <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>
                                        Slide</option>
                                    <option value="cube" <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>
                                        Cube</option>
                                    <option value="coverflow" <?php selected($static_settings['effect'] ?? '', 'coverflow'); ?>>Coverflow</option>
                                </select>
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to use additional effects.</small>  -->
                                <?php endif; ?>
                            </div>

                            <!-- Social Icon Active Color -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="social_icon_active_color">Social Icon Active Color</label>
                                <input type="text" id="social_icon_active_color" name="social_icon_active_color"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['social_icon_active_color']) ? $static_settings['social_icon_active_color'] : '#3b5998'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize social icon active color.</small>  -->
                                <?php endif; ?>
                            </div>

                            <!-- Social Icon Hover Color -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="social_icon_hover_color">Social Icon Hover Color</label>
                                <input type="text" id="social_icon_hover_color" name="social_icon_hover_color"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['social_icon_hover_color']) ? $static_settings['social_icon_hover_color'] : '#2d4373'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize social icon hover color.</small>  -->
                                <?php endif; ?>
                            </div>

                            <!-- Social Icon Size -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="social_icon_size">Social Icon Size</label>
                                <input type="number" id="social_icon_size" name="social_icon_size" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['social_icon_size']) ? $static_settings['social_icon_size'] : '24'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize social icon size.</small> -->
                                <?php endif; ?>
                            </div>

                            <!-- Button Background Color -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="button_bg_color">Button Background Color</label>
                                <input type="text" id="button_bg_color" name="button_bg_color" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['button_bg_color']) ? $static_settings['button_bg_color'] : '#000000'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize the button background color.</small>  -->
                                <?php endif; ?>
                            </div>

                            <!-- Button Hover Background Color -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="button_hover_bg_color">Button Hover Background Color</label>
                                <input type="text" id="button_hover_bg_color" name="button_hover_bg_color"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['button_hover_bg_color']) ? $static_settings['button_hover_bg_color'] : '#333333'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize the button hover background color.</small> -->
                                <?php endif; ?>
                            </div>

                            <!-- Button Text Color -->
                            <div class="col-md-4 mb-4 form-group">
                                <label for="button_text_color">Button Text Color</label>
                                <input type="text" id="button_text_color" name="button_text_color" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['button_text_color']) ? $static_settings['button_text_color'] : '#ffffff'); ?>"
                                    <?php if (!$is_premium_user)
                                        echo 'disabled'; ?> />
                                <?php if (!$is_premium_user): ?>
                                    <!-- <small class="form-text text-muted">Upgrade to the pro version to customize the button text color.</small> -->
                                <?php endif; ?>
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
                                    href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank"
                                    rel="noopener noreferrer">upgrading to the Pro version</a> to access advanced settings.
                            </small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- tab base END  -->
        <button type="submit" class="btn btn-primary">Save Slider</button>
    </form>
</div>