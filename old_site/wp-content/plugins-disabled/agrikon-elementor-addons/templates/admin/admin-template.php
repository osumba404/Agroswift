<?php
/**
* Agrikon Admin Page Template
*/


?>

    <div class="agrikon-admin-wrapper">
        <div class="container">
            <div class="page-heading">
                <h1 class="page-title"><?php _e( 'Agrikon Addons', 'agrikon' ); ?></h1>
                <p class="page-description">
                    <?php _e( 'Premium & Advanced Essential Elements for Elementor', 'agrikon' ); ?>
                </p>
            </div>
            <form class="agrikon-form" method="post">

                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-widget-tab" data-toggle="tab" href="#nav-widget" role="tab" aria-controls="nav-widget" aria-selected="false"><?php _e( 'Widgets', 'agrikon' ); ?></a>
                        <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map" aria-selected="true"><?php _e( 'Map', 'agrikon' ); ?></a>
                        <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-short" role="tab" aria-controls="nav-short" aria-selected="true"><?php _e( 'Shortcodes', 'agrikon' ); ?></a>
                        <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-brands" role="tab" aria-controls="nav-brands" aria-selected="true"><?php _e( 'Brands', 'agrikon' ); ?></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-widget" role="tabpanel" aria-labelledby="nav-widget-tab">
                        <div class="row widget-row">
                            <?php

                            $list = array(
                                'posts-base',
                                'services-item',
                                'features-item',
                                'home-slider',
                                'about-two',
                                'bubble-image',
                                'cta-one',
                                'popup-video',
                                'blog-special',
                                'testimonials-slider',
                                'team-slider',
                                'odometer',
                                'post-types-list',
                                'funfact-item',
                                'sidebar-widgets',
                                'circle-progressbar',
                                'header-menu',
                                'mega-menu',
                                'shape-overlays-menu',
                                'page-hero',
                                'breadcrumbs',
                                'vegas-slider',
                                'vegas-template',
                                'projects-slider',
                                'projects-gallery',
                                'justified-gallery',
                                'testimonials-two',
                                'button',
                                'button2',
                                'animated-headline',
                                'brands-board',
                                'team-member',
                                'contact-form-7',
                                'google-map',
                                'onepage',
                                'advanced-pricing',
                                'svg-animation',
                                'flip-card',
                                'crossroads-slideshow',
                                'page-flip-layout',
                                'interactive-slider',
                                'block-revealers',
                                'two-block-slider',
                                'svg-pattern',
                                'caption-hover-effects',
                                'image-before-after',
                                'animated-text-background',
                                'blog-grid',
                                'blog-masonry',
                                'blog-slider',
                                'woo-category-grid',
                                'woo-category-slider',
                                'woo-product-item',
                                'woo-grid',
                                'woo-grid-two',
                                'woo-flash-deals',
                                'woo-slider',
                                'woo-gallery',
                                'woo-mini-cart'
                            );

                            foreach ( $list as $widget ) {

                                $option = 'disable_'.str_replace( '-', '_', $widget );
                                $name = mb_strtoupper( str_replace( '-', ' ', $widget ) );

                                add_option( $option, 0 );
                                if ( isset( $_POST[ $option ] ) ) {
                                    update_option( $option, $_POST[ $option ] );
                                }

                                 ?>

                                <div class="col-md-4">
                                    <div class="widget-toggle">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="<?php echo esc_attr( $option ); ?>" value="1">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo esc_attr( $option ); ?>" name="<?php echo esc_attr( $option ); ?>" value="0" <?php checked( 0, get_option( $option ), true ); ?>>
                                            <label class="custom-control-label" for="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $name ); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">

                        <div class="row widget-row">
                            <div class="col-lg-6">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'agrikon_map_api' );
                                    if ( isset( $_POST['agrikon_map_api'] ) ) {
                                        $api = sanitize_text_field( $_POST['agrikon_map_api'] );
                                        update_option( 'agrikon_map_api', $api );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="agrikon_map_api"><?php _e( 'Map Api Key', 'agrikon' ); ?></label>
                                        <input type="text" id="agrikon_map_lat" name="agrikon_map_api" value="<?php echo esc_attr( get_option( 'agrikon_map_api' )); ?>" placeholder="Api Key">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'agrikon_map_lat' );
                                    if ( isset( $_POST['agrikon_map_lat'] ) ) {
                                        $lat = sanitize_text_field( $_POST['agrikon_map_lat'] );
                                        update_option( 'agrikon_map_lat', $lat );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="agrikon_map_lat"><?php _e( 'Lat Cordinate', 'agrikon' ); ?></label>
                                        <input type="hidden" name="agrikon_map_lat" value="">
                                        <input type="text" id="agrikon_map_lat" name="agrikon_map_lat" value="<?php echo esc_attr( get_option( 'agrikon_map_lat' )); ?>" placeholder="<?php _e( 'Enter latitude', 'agrikon' ); ?>">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'agrikon_map_lng' );
                                    if ( isset( $_POST['agrikon_map_lng'] ) ) {
                                        $lng = sanitize_text_field( $_POST['agrikon_map_lng'] );
                                        update_option( 'agrikon_map_lng', $lng );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="agrikon_map_lng"><?php _e( 'Lng Cordinate', 'agrikon' ); ?></label>
                                        <input type="hidden" name="agrikon_map_lng" value="">
                                        <input type="text" id="agrikon_map_lng" name="agrikon_map_lng" value="<?php echo esc_attr( get_option( 'agrikon_map_lng' )); ?>" placeholder="<?php _e( 'Enter longitude', 'agrikon' ); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-short" role="tabpanel" aria-labelledby="nav-short-tab">
                        <div class="row widget-row">
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_agrikon_list_shortcodes', 0 );
                                    if ( isset( $_POST['disable_agrikon_list_shortcodes'] ) ) {
                                        update_option( 'disable_agrikon_list_shortcodes', $_POST['disable_agrikon_list_shortcodes'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_agrikon_list_shortcodes" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_agrikon_list_shortcodes" name="disable_agrikon_list_shortcodes" value="0" <?php checked( 0, get_option( 'disable_agrikon_list_shortcodes' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_agrikon_list_shortcodes"><?php _e( 'Shortcode Creator', 'agrikon' ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-brands" role="tabpanel" aria-labelledby="nav-brands-tab">
                        <div class="row widget-row">
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_agrikon_wc_brands', 0 );
                                    if ( isset( $_POST['disable_agrikon_wc_brands'] ) ) {
                                        update_option( 'disable_agrikon_wc_brands', $_POST['disable_agrikon_wc_brands'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_agrikon_wc_brands" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_agrikon_wc_brands" name="disable_agrikon_wc_brands" value="0" <?php checked( 0, get_option( 'disable_agrikon_wc_brands' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_agrikon_wc_brands"><?php _e( 'Agrikon Brands', 'agrikon' ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-actions">
                    <div class="row">
                        <div class="col-sm-12 submit-container">
                            <?php wp_nonce_field( 'agrikon_admin_nonce_field' ); ?>
                            <button type="submit" class="btn btn-primary"><?php _e( 'Save Settings', 'agrikon' ); ?></button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
