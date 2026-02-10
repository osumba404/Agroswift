<?php
/**
* The template for displaying archive pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package WordPress
* @subpackage Agrikon
* @since 1.0.0
*/

    get_header();


    // Elementor `archive` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'archive' ) ) {

        // you can use this action for add any content before container element
        do_action( 'agrikon_before_archive' );

        $archive_layout = agrikon_settings( 'archive_layout', 'full-width' );
        $archive_sidebar = agrikon_sidebar( 'agrikon-search-sidebar' );

        ?>

        <!-- archive page general div -->
        <div id="nt-archive" class="nt-archive" >

            <?php agrikon_hero_section(); ?>

            <div class="nt-theme-inner-container section-padding">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Left sidebar -->
                        <?php if ( $archive_sidebar && 'left-sidebar' == $archive_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $archive_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Content Column-->
                        <div class="col-12 col-xl-8">

                            <?php if ( have_posts() ) { ?>

                                <div class="posts">
                                    <?php
                                    while ( have_posts() ) : the_post();

                                        agrikon_post_style_one();

                                    endwhile;

                                    // this function working with wp reading settins + posts
                                    agrikon_index_loop_pagination();
                                    ?>
                                </div>

                            <?php } else {
                                // if there are no posts, read content none function
                                agrikon_content_none();
                            }
                            ?>
                        </div>
                        <!-- End content -->

                        <!-- Right sidebar -->
                        <?php if ( $archive_sidebar && 'right-sidebar' == $archive_layout ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                                <div class="blog-sidebar nt-sidebar-inner">
                                    <?php dynamic_sidebar( $archive_sidebar ); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div><!-- End row -->
                </div><!-- End container -->
            </div><!-- End #blog-post -->
        </div>
        <!-- End archive page general div-->

    <?php

        do_action( 'agrikon_after_archive' );

    }

    get_footer();
?>
