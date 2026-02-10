<?php

/**
* default page template
*/

    if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
        $hide_header = $page_settings->get_settings( 'agrikon_elementor_hide_page_header' );
        $hide_footer = $page_settings->get_settings( 'agrikon_elementor_hide_page_footer' );
        if ( 'yes' == $hide_header ) {
            remove_action( 'agrikon_header_action', 'agrikon_main_header', 10 );
        }
        if ( 'yes' == $hide_footer ) {
            remove_action( 'agrikon_footer_action', 'agrikon_footer', 10 );
        }
    }

    get_header();

    if ( agrikon_check_is_elementor() ) {

        while ( have_posts() ) {

            the_post();

            the_content();

            /* theme page link pagination */
            agrikon_wp_link_pages();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }

    } else {

        $page_sidebar = agrikon_sidebar( 'agrikon-page-sidebar' );
        $page_layout = agrikon_settings( 'page_layout', 'full-width' );
        $page_column = $page_sidebar ? 'col-lg-8' : 'col-lg-10';
        $page_column = class_exists( 'WooCommerce' ) && ( is_checkout() || is_cart() ) ? 'col-lg-12' : $page_column;

        do_action( 'agrikon_before_page' );
        ?>

        <div id="nt-page-container" class="nt-page-layout">

            <!-- Hero section - this function using on all inner pages -->
            <?php agrikon_hero_section(); ?>

            <div id="nt-page" class="nt-theme-inner-container section-padding">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Right sidebar -->
                        <?php if ( $page_sidebar && 'left-sidebar' == $page_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $page_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Sidebar control column -->
                        <div class="<?php echo esc_attr( $page_column ); ?>">

                            <?php while ( have_posts() ) : the_post(); ?>

                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <div class="nt-theme-content nt-clearfix content-container">
                                        <?php

                                        /* translators: %s: Name of current post */
                                        the_content( sprintf(
                                            esc_html__( 'Continue reading %s', 'agrikon' ),
                                            the_title( '<span class="screen-reader-text">', '</span>', false )
                                        ) );

                                        /* theme page link pagination */
                                        agrikon_wp_link_pages();

                                        ?>
                                    </div><!-- End .nt-theme-content -->
                                </div><!--End article -->
                                <?php

                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                                }

                            // End the loop.
                            endwhile;
                            ?>
                        </div>

                        <!-- Right sidebar -->
                        <?php if ( $page_sidebar && 'right-sidebar' == $page_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $page_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div><!--End row -->
                </div><!--End container -->
            </div><!--End #nt-page -->
        </div><!--End page general div -->
        <?php
        // you can use this action for add any content after container element
        do_action( 'agrikon_after_page' );
    }

    get_footer();

?>
