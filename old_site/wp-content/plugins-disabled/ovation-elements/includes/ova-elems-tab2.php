<?php
$is_premium_user = get_option('ovation_slider_is_premium', false);
?>
<div class="mian-slider-sec">
    <!--------- Second Slider Header START ----------->
    <div class="serch-header row align-items-center mb-4">

        <div class="left-div col-xl-10 col-lg-9 col-md-8">
            <ul class="nav nav-tabs-slider-sec" id="Sliderheader" role="tablist">
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true">All</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="business-tab" data-bs-toggle="tab" href="#business"
                        role="tab" aria-controls="business" aria-selected="false" tabindex="-1"
                        aria-disabled="true">Business</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="education-tab" data-bs-toggle="tab" href="#education"
                        role="tab" aria-controls="education" aria-selected="false" tabindex="-1"
                        aria-disabled="true">Education</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="travel-tab" data-bs-toggle="tab" href="#travel" role="tab"
                        aria-controls="travel" aria-selected="false" tabindex="-1" aria-disabled="true">Travel</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="ecommerce-tab" data-bs-toggle="tab" href="#ecommerce"
                        role="tab" aria-controls="ecommerce" aria-selected="false" tabindex="-1"
                        aria-disabled="true">Ecommerce</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="restaurant-tab" data-bs-toggle="tab" href="#restaurant"
                        role="tab" aria-controls="restaurant" aria-selected="false" tabindex="-1"
                        aria-disabled="true">Restaurant</a>
                </li>
                <li class="nav-item-slider" role="presentation">
                    <a class="nav-link-slider disabled" id="blogs-tab" data-bs-toggle="tab" href="#blogs" role="tab"
                        aria-controls="blogs" aria-selected="false" tabindex="-1" aria-disabled="true">Blogs</a>
                </li>
            </ul>
        </div>


        <div class="right-div col-xl-2 col-lg-3 col-md-4 mt-3 mt-md-0">
            <div class="slider-search-container">
                <input type="search" id="ov-template-search-input" placeholder="Search for Template |">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
    </div>
    <!-- for content -->

    <!--------- Second Slider Header END ----------->
    <div class="container-custom-one ">
        <div class="row">
            <?php
            $templates = array(
                array('id' => 1, 'title' => 'Business Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-1.png'),
                array('id' => 2, 'title' => 'Travel Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-2.png'),
                array('id' => 3, 'title' => 'Ecommerce Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-3.png'),
                array('id' => 4, 'title' => 'News Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-4.png'),
                array('id' => 5, 'title' => 'Food Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-5.png'),
                array('id' => 6, 'title' => 'Restaurant Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-6.png'),
                array('id' => 7, 'title' => 'Travel Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-7.png'),
                array('id' => 8, 'title' => 'Education Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-8.png'),
                array('id' => 9, 'title' => 'Business Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-9.png'),
                array('id' => 10, 'title' => 'E-commerce Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-10.png'),
                array('id' => 11, 'title' => 'Travel Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-11.png'),
                array('id' => 12, 'title' => 'Restaurant Slider Template', 'image' => OVA_ELEMS_URL . 'assets/images/template-12.png'),
                array('id' => 13, 'title' => 'Ecommerce Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-13.png'),
                array('id' => 14, 'title' => 'Business Slider Template3', 'image' => OVA_ELEMS_URL . 'assets/images/template-14.png'),
                array('id' => 15, 'title' => 'Education Slider Template2', 'image' => OVA_ELEMS_URL . 'assets/images/template-15.png'),

            );

            foreach ($templates as $template) {
                $is_pro_template = in_array($template['id'], [6, 7, 8, 9]); // Mark templates 6, 7, 8 as Pro only
                ?>

            <div class="col-md-4 col-lg-2 col-12 mb-4 inner-cards"
                data-title="<?php echo esc_attr(strtolower($template['title'])); ?>">
                <div class="slider-card" style="">
                    <div class="slider-image">
                        <img class="card-img-top" src="<?php echo esc_url($template['image']); ?>"
                            alt="<?php echo esc_attr($template['title']); ?>">
                    </div>

                    <!-- i change -->
                        <div class="heading-wrapper mt-2">
                            <h5 class="card-title"><?php echo esc_html($template['title']); ?></h5>

                            <div class="template-actions">
                                <?php
                                $coming_soon_ids = [10, 11, 12, 13, 14, 15];

                                if (in_array($template['id'], $coming_soon_ids)) {
                                    // echo '<div class="ot-elems-coming-soon">';
                                    if (!$is_premium_user) {
                                        echo '<a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" class="btn btn-primary">Upgrade to Pro</a>';
                                    } else {
                                        echo '<button class="btn btn-secondary" disabled>Select Template</button>';
                                    }
                                    echo '<img src="' . esc_url(OVA_ELEMS_URL . 'assets/images/coming-soon.png') . '" alt="" class="coming-soon-image" />';
                                    // echo '</div>';
                                } elseif (!$is_premium_user && $is_pro_template) {
                                    echo '<a href="https://www.ovationthemes.com/products/ovation-elements-pro" target="_blank" class="btn btn-primary">Upgrade to Pro</a>';
                                } else {
                                    echo '<a href="' . esc_url(admin_url('admin-post.php?action=create_ova_elems&template_id=' . $template['id'])) . '" class="btn btn-primary">Select Template</a>';
                                }

                                // Badge section
                                if (!in_array($template['id'], $coming_soon_ids)) {
                                    if ($is_pro_template) {
                                        echo '<span class="oe-crown"><i class="fa-solid fa-crown"></i> PRO</span>';
                                    } else {
                                        echo '<span class="badge oe-free">FREE</span>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <!-- end -->
                    </div>
                </div>
                
                <?php
            }
            ?>
            <p id="no-templates-found" style="display:none; text-align:center; font-weight:bold; margin-top:20px;">No templates found.</p>
        </div>
    </div>

</div>