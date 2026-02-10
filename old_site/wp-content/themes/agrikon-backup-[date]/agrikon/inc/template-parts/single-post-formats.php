<?php

if ( ! function_exists( 'agrikon_single_layout_fullwidth' ) ) {

    function agrikon_single_layout_fullwidth()
    {
        ?>
        <div id="nt-single" class="nt-single">

            <?php agrikon_hero_section(); ?>

            <div class="blog-details section-padding">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-8">
                            <div class="nt-theme-content">

                                <?php

                                agrikon_post_format();


                                while ( have_posts() ) : the_post();

                                    agrikon_single_post_header_meta();

                                    agrikon_single_post_content();

                                    agrikon_wp_link_pages();

                                    agrikon_single_post_tags();

                                endwhile; // End of the loop.

                                agrikon_single_post_author_box();

                                agrikon_single_navigation();

                                ?>

                            </div>
                            <?php agrikon_single_post_comment_template(); ?>
                        </div>
                    </div>
                </div>

                <?php agrikon_single_post_related(); ?>

            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'agrikon_single_layout_sidebar' ) ) {

    function agrikon_single_layout_sidebar()
    {
        $agrikon_layout  = agrikon_settings( 'single_layout', 'full-width' );
        $agrikon_sidebar = agrikon_sidebar( 'agrikon-single-sidebar', 'sidebar-1' );
        $agrikon_column  = agrikon_sidebar( 'agrikon-single-sidebar', 'sidebar-1' ) ? 'col-lg-10 col-xl-8' : 'col-lg-10 col-xl-8';

        ?>
        <!-- Single page general div -->
        <div id="nt-single" class="nt-single">

            <?php agrikon_hero_section(); ?>

            <div class="blog-details section-padding">
                <div class="container">

                    <div class="row justify-content-lg-center">

                        <?php if ( 'left-sidebar' == $agrikon_layout && $agrikon_sidebar ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4 pl-lg-5">
                                <div class="blog-sidebar nt-sidebar-inner">

                                    <?php dynamic_sidebar( $agrikon_sidebar ); ?>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="<?php echo esc_attr( $agrikon_column ); ?>">
                            <div class="nt-theme-content">

                                <?php

                                agrikon_post_format();

                                while ( have_posts() ) : the_post();

                                    agrikon_single_post_header_meta();

                                    agrikon_single_post_content();

                                    agrikon_wp_link_pages();

                                    agrikon_single_post_tags();

                                endwhile; // End of the loop.

                                agrikon_single_post_author_box();

                                agrikon_single_navigation();

                                ?>
                            </div>
                            <?php agrikon_single_post_comment_template(); ?>
                        </div>

                        <?php if ( 'right-sidebar' == $agrikon_layout && $agrikon_sidebar ) { ?>
                            <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4 pl-lg-5">
                                <div class="blog-sidebar nt-sidebar-inner">

                                    <?php dynamic_sidebar( $agrikon_sidebar ); ?>

                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <?php agrikon_single_post_related(); ?>

            </div>
        </div>
        <!--End single page general div -->
        <?php
    }
}

if ( ! function_exists( 'agrikon_single_post_content' ) ) {

    function agrikon_single_post_content()
    {
        $content = get_the_content();
        if ( '' != $content ) {
            ?>
            <div class="blog-details__content">
                <?php the_content(); ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_single_post_header_meta' ) ) {

    function agrikon_single_post_header_meta()
    {
        ?>
        <div class="blog-card__content">
            <?php
            if ( '0' != agrikon_settings( 'single_postmeta_date_visibility', '0' ) ) {
                $archive_year  = get_the_time( 'Y' );
                $archive_month = get_the_time( 'm' );
                $archive_day   = get_the_time( 'd' );
                printf( '<div class="blog-card__date"><a href="%1$s" title="%1$s">%2$s %3$s</a></div>',
                    esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                    get_the_time( 'd' ),
                    get_the_time( 'M' )
                );
            }
            ?>
            <div class="blog-card__meta">
            <?php
                if ( '0' == agrikon_settings( 'single_hero_visibility', '1' ) ) {
                    the_title( '<h3 class="title">', '</h3>' );
                }
                agrikon_post_meta_author();
                agrikon_post_meta_comment_number();
            ?>
            </div>
        </div>
        <?php
    }
}

if ( ! function_exists( 'agrikon_single_post_comment_template' ) ) {

    function agrikon_single_post_comment_template()
    {
        if ( comments_open() || '0' != get_comments_number() ) {
            ?>
            <div class="blog-comment">
                <?php echo comments_template(); ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_single_post_tags' ) ) {

    function agrikon_single_post_tags()
    {
        if ( '0' != agrikon_settings('single_postmeta_tags_visibility', '1' ) && has_tag() ) {
            ?>
            <div class="blog-details__meta">
                <div class="blog-details__tags">
                    <span><?php esc_html_e( 'Tags:', 'agrikon' ); ?></span>
                    <?php the_tags( '', ', ', '' ); ?>
                </div>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_post_meta_categories' ) ) {

    function agrikon_post_meta_categories()
    {
        if ( '0' != agrikon_settings( 'post_category_visibility', '1' ) && has_category() && is_single() ) {
            echo '<div class="category-wrapper">';
                the_category(', ');
            echo '</div>';
        }
    }
    add_action( 'agrikon_after_page_title', 'agrikon_post_meta_categories' );
}

if ( ! function_exists( 'agrikon_post_meta_date' ) ) {

    function agrikon_post_meta_date()
    {
        if ( '0' != agrikon_settings( 'single_postmeta_date_visibility', '0' ) ) {
            $archive_year = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day = get_the_time( 'd' );
            ?>
            <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_post_meta_author' ) ) {

    function agrikon_post_meta_author()
    {
        global $post;
        $author_id = $post->post_author;
        $author_link = get_author_posts_url( $author_id );
        if ( '0' != agrikon_settings( 'single_postmeta_author_visibility', '1' ) ) {
        ?>
        <a href="<?php echo esc_url( $author_link ); ?>"><i class="far fa-user-circle"></i> <?php the_author_meta( 'display_name', $post->post_author ); ?></a>
        <?php
        }
    }
}

if ( ! function_exists( 'agrikon_post_meta_comment_number' ) ) {

    function agrikon_post_meta_comment_number()
    {
        if ( comments_open() && '0' != get_comments_number() && '0' != agrikon_settings( 'single_postmeta_comments_visibility', '1' ) ) {
            ?>
            <a href="<?php echo get_comments_link( get_the_ID() ); ?>"><i class="far fa-comments"></i>
                <?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'agrikon' ), number_format_i18n( get_comments_number() ) ); ?>
            </a>
            <?php
        }
    }
}

/*************************************************
##  POST FORMAT
*************************************************/

if ( ! function_exists( 'agrikon_post_format' ) ) {

    function agrikon_post_format()
    {
        // post format
        $format = get_post_format();
        $format = $format ? $format : 'standard';

        // post format: video or audio embed
        if ( 'video' == $format || 'audio' == $format ) {

            $post = get_post(get_the_ID());
            $content = apply_filters('the_content', $post->post_content);
            $embed = get_media_embedded_in_content($content, array( 'video', 'object', 'embed', 'iframe', 'audio'  ));

            if ( false === strpos( $content, 'wp-playlist-script' ) ) {
                // If not a single post, highlight the video file.
                if (! empty( $embed ) ) {
                    foreach ( $embed as $embed_html ) { ?>
                        <div class="blog-details__image">
                            <div class="blog-single_media_video">
                                <?php echo wp_kses( $embed_html, agrikon_allowed_html() ); ?>
                            </div>
                        </div>
                        <?php
                    }
                }
            }

        // post format: standart
        } else {

            if ( has_post_thumbnail() ) {
                ?>
                <div class="blog-details__image">
                    <?php the_post_thumbnail( 'agrikon-single', array( 'class'=>'img-fluid' ) ); ?>
                </div>
                <?php
            }
        } // end post format
    }
}

/*************************************************
## SINGLE POST AUTHOR BOX FUNCTION
*************************************************/

if (! function_exists('agrikon_single_post_author_box')) {

    function agrikon_single_post_author_box()
    {
        global $post;
        if ('0' != agrikon_settings('single_post_author_box_visibility', '1')) {
            // Get author's display name
            $display_name = get_the_author_meta('display_name', $post->post_author);
            // If display name is not available then use nickname as display name
            $display_name = empty($display_name) ? get_the_author_meta('nickname', $post->post_author) : $display_name ;
            // Get author's biographical information or description
            $user_description = get_the_author_meta('user_description', $post->post_author);
            // Get author's website URL
            $user_website = get_the_author_meta('url', $post->post_author);
            // Get link to the author archive page
            $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));
            // Get the rest of the author links. These are stored in the
            // wp_usermeta table by the key assigned in wpse_user_contactmethods()
            $author_facebook  = get_the_author_meta('facebook', $post->post_author);
            $author_twitter   = get_the_author_meta('twitter', $post->post_author);
            $author_instagram = get_the_author_meta('instagram', $post->post_author);
            $author_linkedin  = get_the_author_meta('linkedin', $post->post_author);
            $author_youtube   = get_the_author_meta('youtube', $post->post_author);

            if ('' != $user_description) {
                ?>
                <div class="blog-author">
                    <div class="blog-author__image">
                        <?php
                        if ( function_exists( 'get_avatar' ) ) {
                            echo get_avatar( get_the_author_meta( 'email' ), '167');
                        }
                        ?>
                    </div>
                    <div class="blog-author__content">
                        <h3><?php echo esc_html( $display_name ); ?></h3>
                        <p><?php echo esc_html($user_description); ?></p>
                        <div class="social">
                            <?php if ('' != $author_facebook) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_facebook); ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_twitter) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_twitter); ?>" target="_blank"><span class="fab fa-twitter"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_instagram) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_instagram); ?>" target="_blank"><span class="fab fa-instagram"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_linkedin) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_linkedin); ?>" target="_blank"><span class="fab fa-linkedin"></span></a>
                            <?php } ?>
                            <?php if ('' != $author_youtube) { ?>
                                <a class="social-icons_link" href="<?php echo esc_url($author_youtube); ?>" target="_blank"><span class="ifab fa-youtube"></span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}

/*************************************************
## SINGLE POST RELATED POSTS
*************************************************/

if ( ! function_exists( 'agrikon_single_post_related' ) ) {

    function agrikon_single_post_related()
    {
        global $post;
        $agrikon_post_type = get_post_type( $post->ID );

        if ( '0' != agrikon_settings( 'single_related_visibility', '0' ) && 'post' == $agrikon_post_type ) {
            $sattr = array();
            $sattr[] .= '"speed":'.agrikon_settings( 'related_speed', 1000 );
            $sattr[] .= '"perview":'.agrikon_settings( 'related_perview', 3 );
            $sattr[] .= '"mdperview":'.agrikon_settings( 'related_mdperview', 3 );
            $sattr[] .= '"smperview":'.agrikon_settings( 'related_smperview', 2 );
            $sattr[] .= '"xsperview":'.agrikon_settings( 'related_xsperview', 1 );
            $sattr[] .= '"gap":'.agrikon_settings( 'related_gap', 30 );
            $sattr[] .= '1' == agrikon_settings( 'related_centered', 1 ) ? '"center":true' : '"center":false';
            $sattr[] .= '1' == agrikon_settings( 'related_loop', 0 ) ? '"loop":true' : '"loop":false';
            $sattr[] .= '1' == agrikon_settings( 'related_autoplay', 1 ) ? '"autoplay":true' : '"autoplay":false';
            $sattr[] .= '1' == agrikon_settings( 'related_mousewheel', 0 ) ? '"mousewheel":true' : '"mousewheel":false';
            $imgsize = agrikon_settings( 'related_imgsize', 'agrikon-square' );
            $imgsize2 = agrikon_settings( 'related_custom_imgsize' );
            $imgsize = '' == $imgsize && !empty( $imgsize2 ) ? array($imgsize2['width'],$imgsize2['height'] ) : $imgsize;
            $ttag = agrikon_settings( 'related_title_tag', 'h3' );
            $subtag = agrikon_settings( 'related_subtitle_tag', 'p' );

            $cats = get_the_category( $post->ID );
            $args = array(
                'post__not_in' => array( $post->ID ),
                'posts_per_page' => agrikon_settings( 'related_perpage', 6 )
            );

            $related_query = new WP_Query( $args );

            if ( $related_query->have_posts() ) {
                wp_enqueue_style( 'swiper' );
                wp_enqueue_script( 'swiper' );
                ?>
                <div class="nt-related-post projects-one">
                    <?php if ( '' != agrikon_settings( 'related_subtitle' ) || '' != agrikon_settings( 'related_title' ) ) { ?>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="block-title text-center">
                                        <?php if ( '' != agrikon_settings( 'related_subtitle' ) ) { ?>
                                            <<?php echo esc_attr( $subtag ); ?> class="subtitle"><?php echo esc_html( agrikon_settings( 'related_subtitle' ) ); ?></<?php echo esc_attr( $subtag ); ?>>
                                        <?php } ?>
                                        <?php if ( '' != agrikon_settings( 'related_title' ) ) { ?>
                                            <<?php echo esc_attr( $ttag ); ?> class="title"><?php echo esc_html( agrikon_settings( 'related_title' ) ); ?></<?php echo esc_attr( $ttag ); ?>>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="related-slider ptb-0">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="swiper-container" data-slider-settings='{<?php echo implode( ',',$sattr ); ?>}'>
                                        <div class="swiper-wrapper">
                                            <?php
                                            while ( $related_query->have_posts() ) {
                                                $related_query->the_post();
                                                ?>
                                                <div class="swiper-slide">
                                                    <?php agrikon_post_style_one(); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_postdata();
            }
        }
    }
}
