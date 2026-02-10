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
$template1_image_url = OVA_ELEMS_URL . 'assets/images/template-4.png';
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
                    <h3 class="plugin_title">News Slider Template</h3>
                    <p class="plugin_description">
                        The Slider Template is a dynamic and professional design tool perfect for creating visually
                        stunning, interactive sliders for business websites. With customizable options for images, text,
                        and calls-to-action, it helps businesses showcase their services, portfolio, or announcements
                        effectively.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end -->

<div class="wrap">
    <!-- <h1>Edit Slider</h1> -->
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="slider-form">
        <!-- <input type="hidden" name="action" value="save_ova_elems_template4_data" /> -->
        <input type="hidden" name="action"
            value="<?php echo $is_premium_user ? 'save_ova_elems_pro_template4_data' : 'save_ova_elems_template4_data'; ?>" />
        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>" />
        <?php wp_nonce_field('ova_elems_save_meta_boxes_data', 'ova_elems_nonce'); ?>

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
                            <?php
                            // If there are selected posts, render them.
                            if (!empty($selected_posts)) {
                                foreach ($selected_posts as $index => $post_id) {
                                    ?>
                                    <div class="slide-container mb-4 p-3 border rounded"
                                        data-index="<?php echo esc_attr($index); ?>">
                                        <h3>Slide <?php echo esc_html($index + 1); ?></h3>
                                        <div class="form-group" style="margin-bottom: 15px;">
                                            <label for="select_post_<?php echo esc_attr($index); ?>">Select Post</label>
                                            <select id="select_post_<?php echo esc_attr($index); ?>" name="selected_posts[]"
                                                class="form-control" style="width: 100%;">
                                                <?php
                                                $args = array(
                                                    'post_type' => 'post',
                                                    'posts_per_page' => -1,
                                                );
                                                $posts = get_posts($args);
                                                foreach ($posts as $post) {
                                                    $selected = ($post->ID == $post_id) ? 'selected' : ''; ?>
                                                    <option value="<?php echo esc_attr($post->ID); ?>" <?php echo esc_attr($selected); ?>><?php echo esc_html($post->post_title); ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                                        <button type="button" class="add_slide_button btn btn-secondary">Add Slide</button><br>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="slide-container mb-4 p-3 border rounded" data-index="0">
                                    <h3>Slide 1</h3>
                                    <div class="form-group" style="margin-bottom: 15px;">
                                        <label for="select_post_0">Select Post</label>
                                        <select id="select_post_0" name="selected_posts[]" class="form-control"
                                            style="width: 100%;">
                                            <?php
                                            $args = array(
                                                'post_type' => 'post',
                                                'posts_per_page' => -1,
                                            );
                                            $posts = get_posts($args);
                                            foreach ($posts as $post) {
                                                ?>
                                                <option value="<?php echo esc_attr($post->ID); ?>">
                                                    <?php echo esc_html($post->post_title); ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="button" class="remove_slide_button btn btn-danger">Remove Slide</button>
                                    <button type="button" class="add_slide_button btn btn-secondary">Add Slide</button><br>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <!-- slider end -->


                        <div class="row">
                            <div class="col-md-6 form-group mt-4">
                                <label for="instagram_url">Instagram URL</label>
                                <input type="url" id="instagram_url" name="instagram_url" class="form-control"
                                    value="<?php echo isset($static_settings['instagram_url']) ? esc_url($static_settings['instagram_url']) : ''; ?>"
                                    placeholder="Enter Instagram URL" />
                            </div>
                            <div class="col-md-6 form-group mt-4">
                                <label for="facebook_url">Facebook URL</label>
                                <input type="url" id="facebook_url" name="facebook_url" class="form-control"
                                    value="<?php echo isset($static_settings['facebook_url']) ? esc_url($static_settings['facebook_url']) : ''; ?>"
                                    placeholder="Enter Facebook URL" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="youtube_url">YouTube URL</label>
                                <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                    value="<?php echo isset($static_settings['youtube_url']) ? esc_url($static_settings['youtube_url']) : ''; ?>"
                                    placeholder="Enter YouTube URL" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="basketball_url">Dribbble URL</label>
                                <input type="url" id="basketball_url" name="basketball_url" class="form-control"
                                    value="<?php echo isset($static_settings['basketball_url']) ? esc_url($static_settings['basketball_url']) : ''; ?>"
                                    placeholder="Enter Dribbble URL" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="twitter_url">Twitter URL</label>
                                <input type="url" id="twitter_url" name="twitter_url" class="form-control"
                                    value="<?php echo isset($static_settings['twitter_url']) ? esc_url($static_settings['twitter_url']) : ''; ?>"
                                    placeholder="Enter Twitter URL" />
                            </div>

                            <!-- review -->
                            <div class="col-md-6 form-group">
                                <label for="ov_template_review_text">Review Text</label>
                                <small class="form-text text-muted">Ex :(xyz Followers[Educate Followers] , Follow us ,
                                    subscribe ).</small>
                                <input type="text" id="ov_template_review_text" name="ov_template_review_text"
                                    class="form-control"
                                    value="<?php echo isset($static_settings['ov_template_review_text']) ? esc_attr($static_settings['ov_template_review_text']) : ''; ?>"
                                    placeholder="Enter review text" />
                            </div>

                            <!-- end -->


                            <!-- Mini Description -->
                            <div class="col-md-12 form-group">
                                <label for="mini_description">Mini Description</label>
                                <textarea id="mini_description" name="mini_description" class="form-control"
                                    placeholder="Enter a brief description"><?php echo isset($static_settings['mini_description']) ? esc_textarea($static_settings['mini_description']) : ''; ?></textarea>
                            </div>

                            <!-- Live Video Link -->
                            <div class="col-md-12 form-group">
                                <label for="live_video_link">Live Video Link</label>
                                <small class="form-text text-muted">Enter the URL of the live video (e.g., YouTube,
                                    Vimeo, etc.).</small>
                                <input type="url" id="live_video_link" name="live_video_link" class="form-control"
                                    value="<?php echo isset($static_settings['live_video_link']) ? esc_url($static_settings['live_video_link']) : ''; ?>"
                                    placeholder="Enter the live video URL" />
                            </div>


                            <!-- Live Mini Text -->
                            <div class="col-md-12 form-group">
                                <label for="live_mini_text">Live Mini Text</label>
                                <small class="form-text text-muted">Enter some mini text for live streaming
                                    information.</small>
                                <input type="text" id="live_mini_text" name="live_mini_text" class="form-control"
                                    value="<?php echo isset($static_settings['live_mini_text']) ? esc_attr($static_settings['live_mini_text']) : ''; ?>"
                                    placeholder="Enter live mini text" />
                            </div>

                            <!-- Live Title Text -->
                            <div class="col-md-12 form-group">
                                <label for="live_title_text">Live Title Text</label>
                                <small class="form-text text-muted">Enter a title for the live streaming event.</small>
                                <input type="text" id="live_title_text" name="live_title_text" class="form-control"
                                    value="<?php echo isset($static_settings['live_title_text']) ? esc_attr($static_settings['live_title_text']) : ''; ?>"
                                    placeholder="Enter live title text" />
                            </div>


                            <!-- Right Corner Posts -->
                            <!-- new add -->
                            <div class="col-md-4 form-group">
                                <label for="corner_posts_count">Number of Corner Posts</label>
                                <select id="corner_posts_count" name="corner_posts_count" class="form-control">
                                    <?php for ($i = 1; $i <= 7; $i++): ?>
                                        <option value="<?php echo esc_attr($i); ?>" <?php echo isset($static_settings['corner_posts_count']) ? selected($static_settings['corner_posts_count'], $i, false) : ''; ?>>
                                            <?php echo esc_html($i); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
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

                            <div class="col-md-4 form-group">
                                <label for="corner_posts_order">Order Posts by Date</label>
                                <select id="corner_posts_order" name="corner_posts_order" class="form-control">
                                    <option value="asc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'asc', false) : ''; ?>>
                                        <?php esc_html_e('Ascending', 'ovation-elements'); ?></option>
                                    <option value="desc" <?php echo isset($static_settings['corner_posts_order']) ? selected($static_settings['corner_posts_order'], 'desc', false) : ''; ?>>
                                        <?php esc_html_e('Descending', 'ovation-elements'); ?></option>
                                </select>
                            </div>

                            <!-- new settings || added font size of live links -->

                            <!-- Live Mini Text Font Size -->
                            <div class="col-md-6 form-group">
                                <label for="live_mini_text_font_size">Live Mini Text Font Size</label>
                                <input type="number" id="live_mini_text_font_size" name="live_mini_text_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['live_mini_text_font_size']) ? $static_settings['live_mini_text_font_size'] : '18'); ?>" />
                            </div>

                            <!-- Live Title Font Size -->
                            <div class="col-md-6 form-group">
                                <label for="live_title_font_size">Live Title Font Size</label>
                                <input type="number" id="live_title_font_size" name="live_title_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['live_title_font_size']) ? $static_settings['live_title_font_size'] : '24'); ?>" />
                            </div>


                            <div class="col-md-6 form-group">
                                <label for="title_head_font_size">Title Head Font Size</label>
                                <input type="number" id="title_head_font_size" name="title_head_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['title_head_font_size']) ? $static_settings['title_head_font_size'] : '20'); ?>" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="list_title_font_size">slide Title Font Size</label>
                                <input type="number" id="list_title_font_size" name="list_title_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_title_font_size']) ? $static_settings['list_title_font_size'] : '36'); ?>" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="list_description_font_size">slide Description Font Size</label>
                                <input type="number" id="list_description_font_size" name="list_description_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_description_font_size']) ? $static_settings['list_description_font_size'] : '18'); ?>" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="list_content_font_size">info Font Size(author , date)</label>
                                <input type="number" id="list_content_font_size" name="list_content_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['list_content_font_size']) ? $static_settings['list_content_font_size'] : '15'); ?>" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="ov_mini_title_font_size">(static description) text Font Size</label>
                                <input type="number" id="ov_mini_title_font_size" name="ov_mini_title_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_mini_title_font_size']) ? $static_settings['ov_mini_title_font_size'] : '18'); ?>" />
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="oe_left_side_title_font_size">Right Side Title Font Size</label>
                                <input type="number" id="oe_left_side_title_font_size"
                                    name="oe_left_side_title_font_size" class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['oe_left_side_title_font_size']) ? $static_settings['oe_left_side_title_font_size'] : '18'); ?>" />
                            </div>

                            <!-- New setting for OV Review Texts Font Size -->

                            <div class="form-group col-md-4 mini">
                                <label for="ov_social_text_font_size">OV Social Text Font Size</label>
                                <input type="number" id="ov_social_text_font_size" name="ov_social_text_font_size"
                                    class="form-control"
                                    value="<?php echo esc_attr(isset($static_settings['ov_social_text_font_size']) ? $static_settings['ov_social_text_font_size'] : '18'); ?>" />
                            </div>



                        </div>
                    </div>

                    <!-- Advanced Settings Tab -->
                    <div class="tab-pane fade" id="advanced-settings" role="tabpanel" aria-labelledby="advanced-tab">
               <div class="row">
                     

                <div class="col-md-4 mb-4 form-group flex-row d-flex align-items-center">
                    <label class="mr-2" for="autoplay_setting">Enable Autoplay:</label>
                    <input type="hidden" name="autoplay_setting" value="0" />
                    <input type="checkbox" id="autoplay_setting" name="autoplay_setting" value="1" 
                           <?php checked(!empty($static_settings['autoplay_setting']), true); ?> 
                           <?php if (!$is_premium_user) echo 'disabled'; ?> />
                  
                </div>
                
                <div class="col-md-4 mb-4 d-flex flex-column form-group">
                    <label for="autoplay_delay">Autoplay Delay Time (ms):</label>
                    <input type="number" id="autoplay_delay" name="autoplay_delay" 
                        value="<?php echo esc_attr($static_settings['autoplay_delay'] ?? 1000); ?>" 
                        <?php if (!$is_premium_user) echo 'disabled'; ?> />
                </div>
                
                <div class="col-md-4 mb-4 d-flex flex-column form-group">
                         <label for="effect">Select Effect:</label>
                         <select id="effect" name="effect" <?php if (!$is_premium_user) echo 'disabled'; ?>>
                            <option value="cube" <?php selected($static_settings['effect'] ?? '', 'cube'); ?>>Cube</option>
                            <option value="slide" <?php selected($static_settings['effect'] ?? '', 'slide'); ?>>Slide</option>
                            <option value="fade" <?php selected($static_settings['effect'] ?? '', 'fade'); ?>>Fade</option> 
                            <option value="coverflow" <?php selected($static_settings['effect'] ?? '', 'coverflow'); ?>>Coverflow</option>
                         </select>
                </div>

                
                <!-- Social Icon Active Color -->
                <div class="col-md-4 mb-4 form-group">
                    <label for="social_icon_active_color">Social Icon Active Color</label>
                    <input type="text" id="social_icon_active_color" name="social_icon_active_color" class="form-control" 
                            value="<?php echo esc_attr(isset($static_settings['social_icon_active_color']) ? $static_settings['social_icon_active_color'] : '#1B2227'); ?>" 
                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                </div>
                
                <!-- Social Icon Hover Color -->
                <div class="col-md-4 mb-4 form-group">
                    <label for="social_icon_hover_color">Social Icon Hover Color</label>
                    <input type="text" id="social_icon_hover_color" name="social_icon_hover_color" class="form-control" 
                            value="<?php echo esc_attr(isset($static_settings['social_icon_hover_color']) ? $static_settings['social_icon_hover_color'] : '#F61C1C'); ?>" 
                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
                </div>
                
                <!-- Social Icon Size -->
                <div class="col-md-4 mb-4 form-group">
                    <label for="social_icon_size">Social Icon Size</label>
                    <input type="number" id="social_icon_size" name="social_icon_size" class="form-control" 
                            value="<?php echo esc_attr(isset($static_settings['social_icon_size']) ? $static_settings['social_icon_size'] : '24'); ?>" 
                            <?php if (!$is_premium_user) echo 'disabled'; ?> />
            
                </div>

                
                <!-- Custom CSS Field -->
                <div class="col-md-12 mb-4 form-group">
                    <label for="custom_css">Custom CSS</label>
                    <textarea id="custom_css" name="custom_css" class="form-control" rows="6" 
                            <?php if (!$is_premium_user) echo 'disabled'; ?>><?php echo esc_textarea(isset($static_settings['custom_css']) ? $static_settings['custom_css'] : ''); ?></textarea>
                    <small class="form-text text-muted">You can add custom CSS rules here. Example: .my-class { color: red; }</small>
               
                </div>
                <?php if (!$is_premium_user): ?>
                <small class="form-text upgrade-message">
                    Enhance your experience by <a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" rel="noopener noreferrer">upgrading to the Pro version</a> to access advanced settings.
                </small>
                <?php endif; ?>

            </div>
        </div>
                </div>
            </div>
        </div>
        <!-- tab base END  -->
        <!-- end -->

        <button type="submit" class="btn btn-primary">Save Slider</button>
    </form>
</div>