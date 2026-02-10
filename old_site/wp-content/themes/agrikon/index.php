<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package WordPress
* @subpackage Agrikon
* @since 1.0.0
*/

    get_header();

    do_action( 'agrikon_before_index' );

    $index_type      = agrikon_settings( 'index_type', 'grid' );
    $index_container = 'fluid' == agrikon_settings( 'index_container_type', 'boxed' )? 'container-fluid' : 'container';
    $agrikon_layout  = agrikon_settings( 'index_layout', 'right-sidebar' );
    $agrikon_column  = !is_active_sidebar('sidebar-1') || 'full-width' == $agrikon_layout ? 'col-lg-10' : 'col-lg-8';

?>
    <!-- container -->
    <div id="nt-index" class="nt-index">

        <!-- Hero section - this function using on all inner pages -->
        <?php agrikon_hero_section(); ?>

        <div class="nt-theme-inner-container section-padding">
            <div class="<?php echo esc_attr( $index_container ); ?>">
                <div class="row justify-content-center">

                    <!-- left sidebar -->
                    <?php
                        if ( is_active_sidebar( 'sidebar-1' ) && 'left-sidebar' == $agrikon_layout ) {
                            get_sidebar();
                        }
                    ?>
                    <!-- End left sidebar -->

                    <!-- Sidebar column control -->
                    <div class="<?php echo esc_attr( $agrikon_column ); ?>">
                        <?php
                        if ( have_posts() ) {

                            echo '<div class="row">';

                                while ( have_posts() ) : the_post();

                                    // if there are posts, run agrikon_post_style_one function
                                    // contain supported post formats from theme
                                    agrikon_post_style_one();

                                endwhile;

                                // this function working with wp reading settins + posts
                                agrikon_index_loop_pagination();

                            echo '</div>';

                        } else {

                            // if there are no posts, read content none function
                            agrikon_content_none();

                        }
                        ?>
                    </div>
                    <!-- End content column -->

                    <!-- right sidebar -->
                    <?php
                        if( is_active_sidebar( 'sidebar-1' ) && 'right-sidebar' == $agrikon_layout ) {
                            get_sidebar();
                        }
                    ?>
                    <!-- End right sidebar -->

                </div><!--End row -->
            </div><!--End container -->
        </div><!--End #blog -->
    </div><!--End index general div -->

<?php

    // you can use this action to add any content after index page
    do_action( 'agrikon_after_index' );

    get_footer();

?>
