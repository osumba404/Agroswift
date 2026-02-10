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
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-3.png';
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
                    <h3 class="plugin_title">Ecommerce Slider Template</h3>
                    <p class="plugin_description">
                        The Ecommerce Slider Template is a dynamic and professional design tool perfect for creating
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

    <!-- live preview -->
    <div class="modal fade modal-temp-3" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- for live preview -->

                    <section class="oe-circular-slider oe-circular-slider_ecommerce">
                        <div class="oe-circular-slider-after">
                            <div class="oe-inner-wrap">
                                <div class="social-media-wrap">
                                    <div class="oe-icons-container">
                                        <div class="icons"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></div>
                                        <div class="icons"><a href="#"><i class="fa-brands fa-instagram"></i></a></div>
                                        <div class="icons"><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
                                        <div class="icons"><a href="#"><i class="fa-solid fa-basketball"></i></a></div>
                                        <div class="icons"><a href="#"><i class="fa-brands fa-twitter"></i></a></div>
                                    </div>
                                    <div class="follow-title">Follow Us</div>
                                </div>
                                <div class="oe-circular-slider-inner">
                                    <div class="oe-travel-heading">
                                        <!-- <h2>Travel</h2> -->
                                    </div>
                                    <div class="oe-travel-banner-wrap">
                                        <div class="oe-slier-3-min-header-heading">
                                            <div class="oe-circular-slider-main">
                                                <div class="oe-banner-img active">
                                                    <span class="heading-tag">New Arrival</span>
                                                    <h1>Slide Title</h1>
                                                    <p class="banner-para">Slide description goes here.</p>
                                                    <div class="oe-circular-slider-custom-nav">
                                                        <a href="#" class="theme-btn">Button Text</a>
                                                        <div class="oe-slider-controls">
                                                            <a href="#" class="prev"><i
                                                                    class="fa-solid fa-chevron-left"></i></a>
                                                            <a href="#" class="next"><i
                                                                    class="fa-solid fa-chevron-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="oe-slider-businessInfo-inner">
                                                <div class="additional-info">
                                                    <div class="info-wrap">
                                                        <i class="fa-solid fa-envelope"></i>
                                                        <div class="info">email@example.com</div>
                                                    </div>
                                                    <div class="info-wrap">
                                                        <i class="fa-solid fa-phone"></i>
                                                        <div class="info">+1234567890</div>
                                                    </div>
                                                </div>

                                                <div class="information-card col-md-6">
                                                    <div class="icon">
                                                        <img src="path/to/image.jpg" alt="Title">
                                                    </div>
                                                    <div class="info-inner">
                                                        <h3 class="heading">Mini Title</h3>
                                                        <p class="description">Mini description goes here.</p>
                                                    </div>
                                                </div>

                                                <div class="information-card col-md-6">
                                                    <div class="icon">
                                                        <img src="path/to/image2.jpg" alt="Title 2">
                                                    </div>
                                                    <div class="info-inner">
                                                        <h3 class="heading">Mini Title 2</h3>
                                                        <p class="description">Mini description 2 goes here.</p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="banner-right">
                                            <div class="circle-holder">
                                                <div class="circular-slider">
                                                    <div class="item-wrapper active">
                                                        <div class="item-image">
                                                            <div class="item-number">01</div>
                                                            <img src="path/to/slide-image.jpg" alt="item image">
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

                    <!-- end -->
                </div>
            </div>
        </div>
    </div>

    <!-- end  -->



    <!-- end -->

    <div class="wrap">
        <div class="container-custom">

            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                enctype="multipart/form-data" id="slider-form">
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

                                            <div class="row">
                                                <h3 class="slider-form-heading">Slide 1</h3>

                                                <div class="col-md-12 form-group d-flex align-items-center">
                                                    <label class="mr-2" for="slide_image_0">Image:</label>
                                                    <input type="hidden" id="slide_image_0" name="slide_images[]" />
                                                    <img class="mr-2 ml-2" src=""
                                                        style="max-width: 100px; max-height: 100px; display: none;" />
                                                    <button type="button"
                                                        class="ml-2 upload_image_button button mt-2">Upload Image:</button>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="slide_title_0">Title:</label>
                                                    <input type="text" id="slide_title_0" name="slide_titles[]"
                                                        class="form-control" placeholder="Enter slide title" />
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="slide_description_0">Description:</label>
                                                    <textarea id="slide_description_0" name="slide_descriptions[]" rows="3"
                                                        class="form-control"
                                                        placeholder="Enter slide description"></textarea>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label for="slide_head_tag_0">Head Tag</label>
                                                    <small class="form-text text-muted">Please enter a relevant head text
                                                        for the slide. It will display above the title.</small>
                                                    <input type="text" id="slide_head_tag_0" name="slide_head_tags[]"
                                                        class="form-control" placeholder="Enter head tag" />
                                                </div>

                                                <div class="col-md-6 form-group halfs">
                                                    <label for="slide_button_text_0">Button Text:</label>
                                                    <input type="text" id="slide_button_text_0" name="slide_button_texts[]"
                                                        class="form-control" placeholder="Enter button text" />
                                                </div>
                                                <div class="col-md-6 form-group halfs">
                                                    <label for="slide_button_url_0">Button URL:</label>
                                                    <input type="url" id="slide_button_url_0" name="slide_button_urls[]"
                                                        class="form-control" placeholder="Enter button URL" />
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
                                            <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                            <div class="form-group">
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
                                            </div>
                                            <div class="form-group">
                                                <label for="slide_title_<?php echo esc_attr($index); ?>">Title:</label>
                                                <input type="text" id="slide_title_<?php echo esc_attr($index); ?>"
                                                    name="slide_titles[]" value="<?php echo esc_attr($slide['title']); ?>"
                                                    class="form-control" placeholder="Enter slide title" />
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="slide_description_<?php echo esc_attr($index); ?>">Description:</label>
                                                <textarea id="slide_description_<?php echo esc_attr($index); ?>"
                                                    name="slide_descriptions[]" rows="3" class="form-control"
                                                    placeholder="Enter slide description"><?php echo esc_textarea($slide['description']); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="slide_head_tag_<?php echo esc_attr($index); ?>">Head Tag</label>
                                                <input type="text" id="slide_head_tag_<?php echo esc_attr($index); ?>"
                                                    name="slide_head_tags[]"
                                                    value="<?php echo esc_attr($slide['head_tag']); ?>" class="form-control"
                                                    placeholder="Enter head tag" />
                                            </div>
                                            <div class="form-group half">
                                                <label for="slide_button_text_<?php echo esc_attr($index); ?>">Button
                                                    Text:</label>
                                                <input type="text" id="slide_button_text_<?php echo esc_attr($index); ?>"
                                                    name="slide_button_texts[]"
                                                    value="<?php echo esc_attr($slide['button_text']); ?>"
                                                    class="form-control" placeholder="Enter button text" />
                                            </div>
                                            <div class="form-group half">
                                                <label for="slide_button_url_<?php echo esc_attr($index); ?>">Button
                                                    URL:</label>
                                                <input type="url" id="slide_button_url_<?php echo esc_attr($index); ?>"
                                                    name="slide_button_urls[]"
                                                    value="<?php echo esc_url($slide['button_url']); ?>"
                                                    class="form-control" placeholder="Enter button URL" />
                                            </div>

                                            <button type="button" class="add_slide_button" class="btn btn-success">Add
                                                Slide</button>
                                            <button type="button" class="remove_slide_button btn btn-danger">Remove
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


                                    <div class="col-md-6 form-group">
                                        <label for="ov_template_review_text">Review Text</label>
                                        <small class="form-text text-muted">Ex :(xyz Followers[Educate Followers] ,
                                            Follow us , subscribe ).</small>
                                        <input type="text" id="ov_template_review_text" name="ov_template_review_text"
                                            class="form-control"
                                            value="<?php echo isset($static_settings['ov_template_review_text']) ? esc_attr($static_settings['ov_template_review_text']) : ''; ?>"
                                            placeholder="Enter review text" />
                                    </div>
                                    <!-- end  -->
                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_title_0">Mini Title:</label>
                                        <input type="text" id="slide_mini_title_0" name="slide_mini_titles[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_titles'][0] ?? ''); ?>"
                                            placeholder="Enter mini title" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_description_0">Mini Description:</label>
                                        <textarea id="slide_mini_description_0" name="slide_mini_descriptions[]"
                                            rows="2" class="form-control"
                                            placeholder="Enter mini description"><?php echo esc_textarea($static_settings['mini_descriptions'][0] ?? ''); ?></textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_title2_0">Mini Title 2:</label>
                                        <input type="text" id="slide_mini_title2_0" name="slide_mini_title2[]"
                                            class="form-control"
                                            value="<?php echo esc_attr($static_settings['mini_title2'][0] ?? ''); ?>"
                                            placeholder="Enter mini title 2" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_mini_description2_0">Mini Description 2:</label>
                                        <textarea id="slide_mini_description2_0" name="slide_mini_description2[]"
                                            rows="2" class="form-control"
                                            placeholder="Enter mini description 2"><?php echo esc_textarea($static_settings['mini_description2'][0] ?? ''); ?></textarea>
                                    </div>

                                    <!-- new add -->
                                    <div class="form-group col-md-6">
                                        <label for="slide_email">Email:</label>
                                        <input type="email" id="slide_email" name="slide_email" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['slide_email']) ? $static_settings['slide_email'] : ''); ?>"
                                            placeholder="Enter email" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="slide_no">Contact:</label>
                                        <input type="tel" id="slide_no" name="slide_no" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['slide_no']) ? $static_settings['slide_no'] : ''); ?>"
                                            placeholder="Enter contact number" />
                                    </div>


                                </div>
                                <!-- end -->
                                <div class="row mb-4 mt-4  d-flex align-items-center">
                                    <div class="form-group col-md-4 mini  d-flex align-items-center gap-3 ">
                                        <label for="slide_mini_image_1_0">Mini Title 1 Image:</label>
                                        <input type="hidden" id="slide_mini_image_1_0" name="slide_mini_images_1[]"
                                            value="<?php echo esc_attr($static_settings['mini_images_1'][0] ?? ''); ?>" />
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_1'][0] ?? '')); ?>"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_1'][0]) ? 'none' : 'block'; ?>;" />
                                        <button type="button"
                                            class="upload_mini_image_1_button button mt-2 upload_image_button">Upload
                                            Image</button>
                                    </div>
                                    <div class="form-group col-md-4 mini d-flex align-items-center gap-3">
                                        <label for="slide_mini_image_2_0">Mini Title 2 Image:</label>
                                        <input type="hidden" id="slide_mini_image_2_0" name="slide_mini_images_2[]"
                                            value="<?php echo esc_attr($static_settings['mini_images_2'][0] ?? ''); ?>" />
                                        <img src="<?php echo esc_url(wp_get_attachment_url($static_settings['mini_images_2'][0] ?? '')); ?>"
                                            style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; display: <?php echo empty($static_settings['mini_images_2'][0]) ? 'none' : 'block'; ?>;" />
                                        <button type="button mini"
                                            class="upload_mini_image_2_button button upload_image_button">Upload
                                            Image</button>
                                    </div>

                                    <div class="form-group col-md-4 mini d-flex align-items-center gap-3">
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
                                        <button type="button"
                                            class="upload_corner_images_button button upload_image_button">Upload
                                            Image</button>
                                    </div>
                                </div>

                                <!-- new settings -->
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="slide_font_size">Head Text Font Size</label>
                                        <input type="number" id="head_font_size" name="head_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['head_font_size']) ? $static_settings['head_font_size'] : '20'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="slide_font_size">Tittle Text Font Size</label>
                                        <input type="number" id="heading_font_size" name="heading_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['heading_font_size']) ? $static_settings['heading_font_size'] : '45'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="slide_font_size">Description Text Font Size</label>
                                        <input type="number" id="banner_font_size" name="banner_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['banner_font_size']) ? $static_settings['banner_font_size'] : '20'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="slide_font_size">Button Text Font Size</label>
                                        <input type="number" id="button_font_size" name="button_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['button_font_size']) ? $static_settings['button_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="ov_mini_title_font_size">Mini Titles Font Size</label>
                                        <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '22'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="mini_description_font_size">Mini Description Font Size</label>
                                        <input type="number" id="mini_description_font_size"
                                            name="mini_description_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['mini_description_font_size']) ? $static_settings['mini_description_font_size'] : '16'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="slide_email_font_size">Email Font Size</label>
                                        <input type="number" id="slide_email_font_size" name="slide_email_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['slide_email_font_size']) ? $static_settings['slide_email_font_size'] : '18'); ?>" />
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="slide_no_font_size">Number Font Size</label>
                                        <input type="number" id="slide_no_font_size" name="slide_no_font_size"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['slide_no_font_size']) ? $static_settings['slide_no_font_size'] : '18'); ?>" />
                                    </div>

                                    <!-- New setting for OV Review Texts Font Size -->

                                    <div class="form-group col-md-4 mini">
                                        <label for="ov_social_text_font_size">OV Social Text Font Size</label>
                                        <input type="number" id="ov_social_text_font_size"
                                            name="ov_social_text_font_size" class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['ov_social_text_font_size']) ? $static_settings['ov_social_text_font_size'] : '18'); ?>" />
                                    </div>
                                </div>
                                <!-- Add more free settings here -->
                            </div>

                            <!-- Advanced Settings Tab -->
                            <div class="tab-pane fade" id="advanced-settings" role="tabpanel"
                                aria-labelledby="advanced-tab">

                                <div class="row">

                                    <!-- Social Icon Active Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_active_color">Social Icon Active Color</label>
                                        <input type="text" id="social_icon_active_color" name="social_icon_active_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_active_color']) ? $static_settings['social_icon_active_color'] : '#3b5998'); ?>"
                                            <?php if (!$is_premium_user)
                                                echo 'disabled'; ?> />

                                    </div>

                                    <!-- Social Icon Hover Color -->
                                    <div class="col-md-4 mb-4 form-group">
                                        <label for="social_icon_hover_color">Social Icon Hover Color</label>
                                        <input type="text" id="social_icon_hover_color" name="social_icon_hover_color"
                                            class="form-control"
                                            value="<?php echo esc_attr(isset($static_settings['social_icon_hover_color']) ? $static_settings['social_icon_hover_color'] : '#2d4373'); ?>"
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
                                            value="<?php echo esc_attr(isset($static_settings['button_bg_color']) ? $static_settings['button_bg_color'] : '#000000'); ?>"
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