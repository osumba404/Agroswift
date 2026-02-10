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
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-8.png';
$bg_image = OVA_ELEMS_URL . 'assets/images/bg_image.png';

$courses = get_posts(['post_type' => 'courses', 'numberposts' => -1]);
$course_options = [];
foreach ($courses as $course) {
    $course_options[] = [
        'id' => $course->ID,
        'title' => $course->post_title,
    ];
}

wp_localize_script(
    'ova-elems-template-8-scripts',
    'localizedCourses',
    $course_options
);


wp_localize_script('ova-elems-template-8-scripts', 'ajax_object', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('tutor-plugin-action'),
]);

$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-8.png';
$ovation_logo = OVA_ELEMS_URL . 'assets/images/logo.png';
$is_premium_user = get_option('ovation_slider_is_premium', false); // modify 

?>

<?php
$tutor_plugin_slug = 'tutor/tutor.php';
$tutor_plugin_installed = file_exists(WP_PLUGIN_DIR . '/tutor/tutor.php');
$tutor_plugin_active = is_plugin_active($tutor_plugin_slug);

if ($tutor_plugin_active) {
    $button_text = __('Tutor LMS Activated', 'ovation-elements');
    $button_disabled = true;
} elseif ($tutor_plugin_installed) {
    $button_text = __('Activate Tutor LMS', 'ovation-elements');
    $button_action = 'activate';
} else {
    $button_text = __('Install Tutor LMS', 'ovation-elements');
    $button_action = 'install';
}
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
                    <h3 class="plugin_title">Education Slider Template</h3>
                    <p class="plugin_description">
                        The Education Slider Template is a dynamic and professional design tool perfect for creating
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

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade modal-temp-8" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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

                    <!-- Slider Background Image Section -->
                    <div class="oe-education-slider-bg-image e-education-slider-bg-image_edu position-relative"
                        style="background:url('<?php echo esc_url($bg_image); ?>')">


                        <!-- Container Start -->
                        <div class="container">

                            <!-- Slider Content Outer Box -->
                            <div class="oe-education-slider-content-outer-box position-relative">

                                <!-- Row Start -->
                                <div class="row">

                                    <!-- Left Content Section -->
                                    <div
                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-12 col-12 oe-education-slider-content-inner-box align-self-center">
                                        <div class="oe-education-slider-banner-content-box">
                                            <div
                                                class="d-flex flex-column gap-2 oe-education-slider-banner-content-main">
                                                <!-- Sub Heading -->
                                                <div
                                                    class="d-flex justify-content-md-start justify-content-sm-center justify-content-center align-items-center">
                                                    <span class="oe-education-slider-sub-head">Welcome Educate
                                                        Theme</span>
                                                </div>

                                                <!-- Main Heading -->
                                                <div class="oe-education-slider-banner-heading-box">
                                                    <h1 class="oe-education-slider-banner-main-head">
                                                        World Best Online Program <span>University</span>
                                                    </h1>
                                                </div>

                                                <!-- Description -->
                                                <p class="oe-education-slider-banner-sec-para">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s.
                                                </p>

                                                <!-- Banner Points -->
                                                <div class="row oe-education-slider-banner-points">

                                                    <div class="col-lg-6">
                                                        <i class="fa fa-check me-3"></i><span
                                                            class="oe-education-slider-banner-point-text">Expert
                                                            Adviser</span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <i class="fa fa-check me-3"></i><span
                                                            class="oe-education-slider-banner-point-text">Global
                                                            thinkers.</span>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <i class="fa fa-check me-3"></i><span
                                                            class="oe-education-slider-banner-point-text">Collaborative
                                                            Learning Environment</span>
                                                    </div>
                                                </div>

                                                <!-- Buttons -->
                                                <div
                                                    class="d-flex gap-md-4 gap-sm-2 gap-2 align-items-center oe-education-slider-banner-btn-box pt-3">
                                                    <a class="oe-education-slider-explore-btn" href="#">Explore More</a>
                                                    <a class="oe-education-slider-appointement-btn" href="#">Get
                                                        Quote</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Left Content Section -->

                                    <!-- Middle Banner Box -->
                                    <div class="col-xl-4 col-lg-7 col-md-6 oe-education-slider-banner-box">
                                        <div class="oe-education-slider-post-box">
                                            <img src="<?php echo esc_url(OVA_ELEMS_URL . 'assets/images/ov-slide8-post-img.png'); ?>"
                                                alt="">
                                            <div class="oe-education-slider-post-content-box">
                                                <div class="d-flex">
                                                    <div>
                                                        <span>
                                                            <img class="me-2" src="" alt="">
                                                            Lession 03
                                                        </span>
                                                    </div>
                                                    <div class="ps-4">
                                                        <span>
                                                            <img class="me-2" src="" alt="">
                                                            Student 45
                                                        </span>
                                                    </div>
                                                </div>
                                                <h4 class="oe-education-slider-post-title">
                                                    Become A Certified Web Development : HTML & CSS
                                                </h4>
                                                <div class="oe-education-slider-post-author-box d-flex"
                                                    style="justify-content:space-between;">
                                                    <div>
                                                        <span>
                                                            <img class="me-3" src="" alt="">
                                                            John Smith
                                                        </span>
                                                    </div>
                                                    <div class="oe-education-slider-post-price">$49.00</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Middle Banner Box -->

                                    <!-- Right Banner Image -->
                                    <div class="col-lg-4 oe-education-slider-post-side-box">
                                        <img class='ov-right-img' src="" alt="">
                                    </div>
                                    <!-- End Right Banner Image -->

                                </div>
                                <!-- End Row -->

                                <!-- Video and Rating Section -->
                                <div class="row slider_bottom_edu" style="margin-top: 0px;">
                                    <!-- Empty Column (Placeholder) -->
                                    <div
                                        class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12 oe-education-slider-content-inner-box align-self-center">
                                    </div>

                                    <!-- Video and Rating Content -->
                                    <div
                                        class="col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12 oe-education-slider-video-rating-content-box align-self-center">
                                        <div class="oe-slider-controls">
                                            <a href="#" class="prev"><i class="fa-solid fa-chevron-left"></i></a>
                                            <a href="#" class="next"><i class="fa-solid fa-chevron-right"></i></a>
                                        </div>

                                        <div class="row tab_row">

                                            <!-- Video Section -->
                                            <div
                                                class="col-lg-2 col-md-4    oe-education-slider-video-content-box position-relative">
                                                <div class="oe-education-slider-video-image-box"
                                                    style="background-image: url();">
                                                    <a class="oe-education-slider-video-icon-box myVideoBtns"
                                                        data-url="#" href="#myModal1" id="myBtn1">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- End Video Section -->

                                            <!-- Rating Section -->
                                            <div
                                                class="col-lg-4 col-md-4 oe-education-slider-rating-content-box d-flex">
                                                <div class="oe-education-slider-rating-img-box align-self-center">
                                                    <img class='ov_img' src="" alt="">
                                                    <p class="oe-education-slider-rating-text">Satisfaction</p>
                                                </div>
                                                <div class="oe-education-slider-progress-bar-box">
                                                    <div class="progress blue">
                                                        <span class="progress-left">
                                                            <span class="progress-bar"></span>
                                                        </span>
                                                        <span class="progress-right">
                                                            <span class="progress-bar"></span>
                                                        </span>
                                                        <div class="progress-value">90%</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="oe-education-slider-followers-content-box col-lg-5 col-md-4 d-flex">
                                                <div class="oe-education-slider-progress-bar-box align-self-center">
                                                    <p class="oe-education-slider-followers-count">1.5k+</p>
                                                </div>
                                                <div
                                                    class="oe-education-slider-followers-img-box align-self-center ps-4">
                                                    <p class="oe-education-slider-followers-text">Educate Followers</p>
                                                    <div
                                                        class="oe-education-slider-social-icon-box d-flex left_menu_col">

                                                        <div class="oe-inner-wrap">
                                                            <div class="social-media-wrap">

                                                                <div class="oe-icons-container">
                                                                    <div class="icons"><a href="#"><i
                                                                                class="fa-brands fa-facebook-f"></i></a>
                                                                    </div>
                                                                    <div class="icons"><a href="#"><i
                                                                                class="fa-brands fa-instagram"></i></a>
                                                                    </div>
                                                                    <div class="icons"><a href="#"><i
                                                                                class="fa-brands fa-youtube"></i></a>
                                                                    </div>
                                                                    <div class="icons"><a href="#"><i
                                                                                class="fa-solid fa-basketball"></i></a>
                                                                    </div>
                                                                    <div class="icons"><a href="#"><i
                                                                                class="fa-brands fa-twitter"></i></a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <span class="oe-education-slider-follow-icon-box"></span>
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
        </div>
    </div>

    <!-- live preview end  -->


    <!-- end -->

    <!-- install tutor div -->
    <div id="install-activate-tutor" class="plugin_output_content">
        <!-- Added informational text above the button -->
        <p id="plugin-activation-message" class="plugin-activation-message">
            Please activate the Tutor LMS plugin to Add Courses In Slides. After Activating the Tutor LMS plugin, you
            have to create courses.
        </p>

        <!-- The button for activating or installing the plugin -->
        <button id="tutor-action-button" class="button-primary"
            data-action="<?php echo esc_attr($button_action ?? ''); ?>" <?php echo isset($button_disabled) ? 'disabled' : ''; ?>>
            <?php echo esc_html($button_text); ?>
        </button>
    </div>

    <!-- end installation of tutor -->

    <div class="wrap">

        <div class="container-custom">

            <h1 class="editor-heading">Edit Slider</h1>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                enctype="multipart/form-data" id="slider-form">
                <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>
                <input type="hidden" name="action"
                    value="<?php echo $is_premium_user ? 'save_ova_elems_pro_data' : 'save_ova_elems_data'; ?>" />
                <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />




                <!-- New Settings End -->

                <!-- tab base settings  -->
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

                    <div class="settings-tabs">

                        <div class="tab-content" id="settingsTabContent">
                            <!-- Free Settings Tab -->
                            <div class="tab-pane fade show active" id="free-settings" role="tabpanel"
                                aria-labelledby="free-tab">

                                <!-- slider add -->
                                <div id="slider-slides">
                                    <?php if (empty($slides)): ?>
                                        <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                                            <h3 class="slider-form-heading">Slide 1</h3>

                                            <div class="form-group">
                                                <label for="slide_title_0">Title:</label>
                                                <input type="text" id="slide_title_0" name="slide_titles[]"
                                                    class="form-control" required placeholder="Enter the title " />
                                            </div>

                                            <div class="form-group">
                                                <label for="slide_course_0">Select Course:</label>
                                                <select id="slide_course_0" name="slide_courses[]" class="form-control">
                                                    <option value="">Select a course</option>
                                                    <?php
                                                    $courses = get_posts(['post_type' => 'courses', 'numberposts' => -1]);
                                                    foreach ($courses as $course): ?>
                                                        <option value="<?php echo esc_attr($course->ID); ?>">
                                                            <?php echo esc_html($course->post_title); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                <label for="slide_title_<?php echo esc_attr($index); ?>">Title:</label>
                                                <input type="text" id="slide_title_<?php echo esc_attr($index); ?>"
                                                    name="slide_titles[]" value="<?php echo esc_attr($slide['title']); ?>"
                                                    class="form-control" required placeholder="Enter the title " />
                                            </div>

                                            <div class="form-group">
                                                <label for="slide_course_<?php echo esc_attr($index); ?>">Select
                                                    Course:</label>
                                                <select id="slide_course_<?php echo esc_attr($index); ?>"
                                                    name="slide_courses[]" class="form-control">
                                                    <option value="">Select a course</option>
                                                    <?php
                                                    $courses = get_posts(['post_type' => 'courses', 'numberposts' => -1]);
                                                    foreach ($courses as $course): ?>
                                                        <option value="<?php echo esc_attr($course->ID); ?>" <?php selected($slide['course_id'] ?? '', $course->ID); ?>>
                                                            <?php echo esc_html($course->post_title); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
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

                                    <div class="col-md-4 form-group">
                                        <label for="instagram_url">Instagram URL:</label>
                                        <input type="url" id="instagram_url" name="instagram_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['instagram_url']) ? $static_settings['instagram_url'] : ''); ?>"
                                            placeholder="Enter Instagram URL" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="youtube_url">YouTube URL:</label>
                                        <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['youtube_url']) ? $static_settings['youtube_url'] : ''); ?>"
                                            placeholder="Enter YouTube URL" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="facebook_url">Facebook URL:</label>
                                        <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['facebook_url']) ? $static_settings['facebook_url'] : ''); ?>"
                                            placeholder="Enter Facebook URL" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="basketball_url">Dribbble URL:</label>
                                        <input type="url" id="basketball_url" name="basketball_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['basketball_url']) ? $static_settings['basketball_url'] : ''); ?>"
                                            placeholder="Enter Dribbble URL" />
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="twitter_url">Twitter URL:</label>
                                        <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                            value="<?php echo esc_url(isset($static_settings['twitter_url']) ? $static_settings['twitter_url'] : ''); ?>"
                                            placeholder="Enter Twitter URL" />
                                    </div>

                                    <!-- end  -->

                                    <!-- loder elements box settings -->

                                    <div class="form-group mini d-flex gap-3">
                                        <label for="slide_mini_image_1_0">Image/Icon :</label>
                                        <input type="hidden" id="slide_mini_image_1_0" name="slide_mini_images_1[]"
                                            value="<?php echo esc_attr($static_settings['mini_images_1'][0] ?? ''); ?>" />
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][0] ?? '')); ?>"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_1'][0]) ? 'none' : 'block'; ?>;" />
                                        <button type="button"
                                            class="upload_mini_image_1_button button mt-2 upload_image_button">Upload
                                            Image</button>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="slide_mini_title_0">Enter heading:</label>
                                        <small class="form-text text-muted">Ex :(Satisfaction , Belive).</small>
                                        <input type="text" id="slide_mini_title_0" name="slide_mini_titles[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_titles'][0] ?? ''); ?>"
                                            placeholder="Enter heading" />
                                    </div>
                                    <!-- new add for review -->

                                    <div class="col-md-6 form-group">
                                        <label for="slide_mini_title2_0">Enter mini head tittle:</label>
                                        <small class="form-text text-muted">Ex :(Welcome).</small>
                                        <input type="text" id="slide_mini_title2_0" name="slide_mini_title2[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_title2'][0] ?? ''); ?>"
                                            placeholder="Enter mini head tittle" />
                                    </div>

                                    <div class="col-md-6 form-group mt-4">
                                        <label for="list_title">List Title:</label><br>
                                        <input type="text" id="list_title" name="list_title"
                                            value="<?php echo esc_attr($static_settings['list_title'] ?? ''); ?>"
                                            class="regular-text" placeholder="Enter list title" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="enter_list">Enter List (Comma Separated):</label>
                                        <input type="text" id="enter_list" name="enter_list"
                                            value="<?php echo esc_attr(!empty($static_settings['enter_list']) ? implode(', ', $static_settings['enter_list']) : ''); ?>"
                                            class="regular-text" placeholder="e.g., courses , support" />
                                    </div>

                                    <div class="col-md-12 form-group mt-3">
                                        <label for="list_description">List Description:</label>
                                        <textarea id="list_description" name="list_description" rows="4"
                                            class="large-text"
                                            placeholder="Enter list description"><?php echo esc_textarea($static_settings['list_description'] ?? ''); ?></textarea>
                                    </div>



                                    <div class="col-md-6 form-group">
                                        <label for="ov_template_review_text">Review Text</label>
                                        <small class="form-text text-muted">Ex :(xyz Followers[Educate Followers] ,
                                            Follow us , subscribe ).</small>
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

                                    <div class="col-md-6 form-group mini d-flex align-items-center gap-3">
                                        <label for="slide_corner_images_0">Upload Right Corner Image:</label>
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
                                        <button type="button"
                                            class="upload_corner_images_button button upload_image_button">Upload
                                            Image</button>
                                    </div>

                                    <div class="col-md-6 form-group d-flex align-items-center">
                                        <label class="mr-2" for="slide_video_url">Upload Video:</label>
                                        <input type="hidden" id="slide_video_url" name="slide_video_url"
                                            value="<?php echo esc_attr(isset($static_settings['slide_video_url']) ? $static_settings['slide_video_url'] : ''); ?>" />
                                        <video id="uploaded_video_preview" controls
                                            style="max-width: 20%; margin-top: 10px; display: <?php echo empty($static_settings['slide_video_url']) ? 'none' : 'block'; ?>;">
                                            <source
                                                src="<?php echo esc_url($static_settings['slide_video_url'] ?? ''); ?>"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <button type="button"
                                            class="upload_video_button button upload_image_button">Upload Video</button>
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

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="static_button_text">Button Text:</label>
                                        <input type="text" id="static_button_text" name="static_button_text"
                                            value="<?php echo esc_attr($static_settings['static_button_text'] ?? ''); ?>"
                                            class="form-control" placeholder="Enter button text" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="static_button_url">Button URL:</label>
                                        <input type="url" id="static_button_url" name="static_button_url"
                                            value="<?php echo esc_url($static_settings['static_button_url'] ?? ''); ?>"
                                            class="form-control" placeholder="Enter button URL" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="static_button2_text">Button2 Text:</label>
                                        <input type="text" id="static_button2_text" name="static_button2_text"
                                            value="<?php echo esc_attr($static_settings['static_button2_text'] ?? ''); ?>"
                                            class="form-control" placeholder="Enter button text" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="static_button2_url">Button2 URL:</label>
                                        <input type="url" id="static_button2_url" name="static_button2_url"
                                            value="<?php echo esc_url($static_settings['static_button2_url'] ?? ''); ?>"
                                            class="form-control" placeholder="Enter button URL" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                        <label for="static_loader_percentage">Loader Percentage:</label>
                                        <input type="number" id="static_loader_percentage"
                                            name="static_loader_percentage"
                                            value="<?php echo esc_attr($static_settings['static_loader_percentage'] ?? '90'); ?>"
                                            min="0" max="100" step="1" class="form-control"
                                            placeholder="Enter loader percentage" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bg_slide_image">Slider Background Image</label>
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


                                    <!-- new settings -->
                                    <div class="col-md-6 form-group">
                                        <label for="title_head_font_size">Title Head Font Size</label>
                                        <input type="number" id="title_head_font_size" name="title_head_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['title_head_font_size']) ? $static_settings['title_head_font_size'] : '20'); ?>" />
                                    </div>


                                    <div class="col-md-6 form-group">
                                        <label for="list_title_font_size">List Title Font Size</label>
                                        <input type="number" id="list_title_font_size" name="list_title_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_title_font_size']) ? $static_settings['list_title_font_size'] : '50'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="list_description_font_size">List Description Font Size</label>
                                        <input type="number" id="list_description_font_size"
                                            name="list_description_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_description_font_size']) ? $static_settings['list_description_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="list_content_font_size">List Content Font Size</label>
                                        <input type="number" id="list_content_font_size" name="list_content_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['list_content_font_size']) ? $static_settings['list_content_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="static_button_text_font_size">Static Button Text Font Size</label>
                                        <input type="number" id="static_button_text_font_size"
                                            name="static_button_text_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['static_button_text_font_size']) ? $static_settings['static_button_text_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="review_text_font_size">Review Text Font Size</label>
                                        <input type="number" id="review_text_font_size" name="review_text_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['review_text_font_size']) ? $static_settings['review_text_font_size'] : '22'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="review_no_font_size">Review Number Font Size</label>
                                        <input type="number" id="review_no_font_size" name="review_no_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['review_no_font_size']) ? $static_settings['review_no_font_size'] : '43'); ?>" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="ov_mini_title_font_size">(loader box ) text Font Size</label>
                                        <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '18'); ?>" />
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
                                            <option value="fade" <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>Fade</option>
                                            <option value="slide" <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>Slide</option>
                                            <option value="cube" <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>Cube</option>
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
                                        <input type="number" id="social_icon_size" name="social_icon_size"
                                            class="form-control"
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
                                        <input type="text" id="button_bg_color" name="button_bg_color"
                                            class="form-control"
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
                                        <input type="text" id="button_text_color" name="button_text_color"
                                            class="form-control"
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
                                        <?php if (!$is_premium_user): ?>
                                            <!-- <small class="form-text text-muted">Upgrade to the pro version to customize the button hover text color.</small> -->
                                        <?php endif; ?>
                                    </div>

                                    <!-- Custom CSS Field -->
                                    <div class="col-md-12 mb-4 form-group">
                                        <label for="custom_css">Custom CSS</label>
                                        <textarea id="custom_css" name="custom_css" class="form-control" rows="6" <?php if (!$is_premium_user)
                                            echo 'disabled'; ?>><?php echo esc_textarea(isset($static_settings['custom_css']) ? $static_settings['custom_css'] : ''); ?></textarea>
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
                                                target="_blank" rel="noopener noreferrer">upgrading to the Pro version</a>
                                            to access advanced settings.
                                        </small>
                                    <?php endif; ?>
                                </div>



                                <!-- Add more advanced settings here -->

                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab base END  -->

        </div>
        <button type="submit" class="btn btn-primary">Save Slider</button>
        </form>
    </div>
</div>