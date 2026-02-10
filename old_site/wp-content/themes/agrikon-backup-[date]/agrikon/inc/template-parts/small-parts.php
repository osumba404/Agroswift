<?php


/**
 * Custom template parts for this theme.
 *
 * preloader, backtotop, conten-none
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package agrikon
*/


/*************************************************
## START PRELOADER
*************************************************/

if ( ! function_exists( 'agrikon_preloader' ) ) {
    function agrikon_preloader()
    {
        $type = agrikon_settings('pre_type', 'default');

        if ( '0' != agrikon_settings('preloader_visibility', '1') ) {

            if ( 'default' == $type && '' != agrikon_settings( 'pre_img', '' ) ) {
                ?>
                <div class="preloader">
                    <img class="preloader__image" width="55" src="<?php echo esc_url( agrikon_settings( 'pre_img' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                </div>
                <?php 
            } else { 
                ?>
                <div id="nt-preloader" class="preloader">
                    <div class="loader<?php echo esc_attr( $type );?>"></div>
                </div>
                <?php
            }
        }
    }
}
add_action( 'agrikon_preloader_action', 'agrikon_preloader', 10 );
add_action( 'elementor/page_templates/canvas/before_content', 'agrikon_preloader', 10 );

/*************************************************
##  BACKTOP
*************************************************/

if ( ! function_exists( 'agrikon_backtop' ) ) {
    function agrikon_backtop() {
        if ( '1' == agrikon_settings('backtotop_visibility', '1') ) { ?>
            <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>
            <?php
        }
    }
}

/*************************************************
##  CURSOR
*************************************************/

if ( ! function_exists( 'agrikon_cursor' ) ) {
    function agrikon_cursor() {

        if ( '1' == agrikon_settings( 'theme_cursor', '1' ) ) {
            echo '<div id="cursor1" class="cursor cursor1 cursor-type-1 agrikon-cursor"></div>';
        }

        if ( '2' == agrikon_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="cursor2 cursor-type-2 agrikon-cursor"></div>';
        }

        if ( '3' == agrikon_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="mouse-cursor cursor-outer cursor-type-3 agrikon-cursor"></div>';
            echo '<div class="mouse-cursor cursor-inner agrikon-cursor"></div>';
        }

    }
}


/*************************************************
##  CONTENT NONE
*************************************************/

if ( ! function_exists( 'agrikon_content_none' ) ) {
    function agrikon_content_none() {
        $agrikon_centered = is_search() && 'full-width' == agrikon_settings( 'search_layout') ? ' text-center' : '';
        ?>
        <div class="content-none-container text-center">
            <h3 class="__title mb-20 fw-900"><?php esc_html_e( 'Nothing Found', 'agrikon' ); ?></h3>
            <?php
            if ( is_home() && current_user_can( 'publish_posts' ) ) :

                printf( '<p>%s</p> <a class="agrikon-btn thm-btn" href="%s">%s</a>',
                esc_html__( 'Ready to publish your first post?' ),
                esc_url( admin_url( 'post-new.php' ) ),
                esc_html__( 'Get started here' )
            );
            elseif ( is_search() ) :
                ?>
                <p class="__nothing"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'agrikon' ); ?></p>
                <?php echo agrikon_content_custom_search_form(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'agrikon' ); ?></p>
                <?php agrikon_content_custom_search_form(); ?>
            <?php endif; ?>
        </div>
        <?php
    }
}
