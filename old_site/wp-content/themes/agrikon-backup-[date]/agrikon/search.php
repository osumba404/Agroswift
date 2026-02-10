<?php
/**
* The template for displaying search results pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
*
* @package WordPress
* @subpackage Agrikon
* @since 1.0.0
*/

    get_header();

    // you can use this action for add any content before container element
    do_action( 'agrikon_before_search' );

    $search_layout = agrikon_settings( 'search_layout', 'full-width' );
    $search_sidebar = agrikon_sidebar( 'agrikon-search-sidebar' );

    ?>
    <!-- search page general div -->
    <div id="nt-search" class="nt-search">

        <?php agrikon_hero_section(); ?>

        <div class="nt-theme-inner-container section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- Left sidebar -->
                    <?php if ( $search_sidebar && 'left-sidebar' == $search_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( $search_sidebar ); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Content Column-->
                    <div class="col-12 col-xl-8">

                        <?php if ( have_posts() ) { ?>

                            <div class="row">

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
                    <?php if ( $search_sidebar && 'right-sidebar' == $search_layout ) { ?>
                        <div id="nt-sidebar" class="nt-sidebar col-12 col-xl-4">
                            <div class="blog-sidebar nt-sidebar-inner">
                                <?php dynamic_sidebar( $search_sidebar ); ?>
                            </div>
                        </div>
                    <?php } ?>

                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End #blog-post -->
    </div>
    <!--End search page general div -->

<?php
    // you can use this action to add any content after search page
    do_action( 'agrikon_after_search' );

    get_footer();
?>
