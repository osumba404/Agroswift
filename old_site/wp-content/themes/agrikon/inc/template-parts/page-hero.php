<?php

/*************************************************
## HERO FUNCTION
*************************************************/

if ( ! function_exists( 'agrikon_hero_section' ) ) {
    function agrikon_hero_section()
    {
        $h_s = get_bloginfo( 'description' );
        $h_t = get_bloginfo( 'name' ) . ' ' .esc_html__( 'Blog', 'agrikon' );
        $page_id = '';

        if ( is_404() ) { // error page

            $name = 'error';
            $h_t = esc_html__( '404 - Not Found', 'agrikon' );

        } elseif ( is_archive() ) { // blog and cpt archive page

            $name = 'archive';
            $h_t = get_the_archive_title();

        } elseif ( is_search() ) { // search page

            $name = 'search';
            $h_t = esc_html__( 'Search results for :', 'agrikon' );

        } elseif ( is_home() || is_front_page() ) { // blog post loop page index.php or your choise on settings

            $name = 'blog';
            $h_t = esc_html( agrikon_settings( 'blog_title', $h_t ) );

        } elseif ( is_single() && ! is_singular( 'portfolio' ) ) { // blog post single/singular page

            $name = 'single';
            $h_t = get_the_title();

        } elseif ( is_singular( 'portfolio' ) ) { // it is cpt and if you want use another clone this condition and add your cpt name as portfolio

            $name = 'single_portfolio';
            $h_t = get_the_title();

        } elseif ( is_page() ) {	// default or custom page

            $name = 'page';
            $h_t = get_the_title();
            $page_id = ' page-'.get_the_ID();

        }

        $h_v = agrikon_settings( $name.'_hero_visibility', '1' );
        // site title
        $h_s = agrikon_settings( $name.'_site_title', $h_s );
        // page title
        $h_t = agrikon_settings( $name.'_title', $h_t ) ? agrikon_settings( $name.'_title', $h_t ) : $h_t;
        // page breadcrumbs
        $h_b = agrikon_settings( 'breadcrumbs_visibility', '1' );

        do_action( 'agrikon_before_hero_action' );

        if ( '0' != $h_v ) {
            ?>
            <div class="page-header text-center<?php echo esc_attr( $page_id ); ?>">
                <div class="page-header__bg"></div>
                <div class="container">

                    <?php

                    if ( '1' == $h_b ) {
                        agrikon_breadcrumbs();
                    }

                    do_action( 'agrikon_before_page_title' );

                    if ( $h_t ) {

                        printf( '<h2 class="nt-hero-title page-title mb-10">%s %s</h2>',
                            wp_kses( $h_t, agrikon_allowed_html()),
                            strlen( get_search_query() ) > 16 ? substr( get_search_query(), 0, 16 ).'...' : get_search_query()
                        );

                    } else {

                        the_title('<h1 class="nt-hero-title page-title mb-10">', '</h1>');
                    }

                    do_action( 'agrikon_after_page_title' );

                    ?>

                </div>
            </div>
        <?php
        }
        do_action( 'agrikon_after_hero_action' );
    }
}
