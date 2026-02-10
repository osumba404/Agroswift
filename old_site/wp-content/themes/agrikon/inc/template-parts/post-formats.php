<?php

add_action( 'agrikon_blog_post_action', 'agrikon_blog_post_thumbnail', 10 );
add_action( 'agrikon_blog_post_action', 'agrikon_blog_post_title', 20 );
add_action( 'agrikon_blog_post_action', 'agrikon_blog_post_meta', 30 );
add_action( 'agrikon_blog_post_action', 'agrikon_blog_post_content', 40 );
add_action( 'agrikon_blog_post_action', 'agrikon_blog_post_button', 50 );


if ( ! function_exists( 'agrikon_post_style_one' ) ) {

    function agrikon_post_style_one()
    {
        $column = is_search() || is_archive() ? 'col-lg-12' : agrikon_settings( 'index_post_column', 'col-lg-12' );
        $column = is_single() ? '' : $column;
        $imgsize = 'agrikon-grid';
        if ( is_single() && '0' != agrikon_settings( 'single_related_visibility', '0' ) ) {
            $imgsize = agrikon_settings( 'related_imgsize', 'agrikon-square' );
            $imgsize2 = agrikon_settings( 'related_custom_imgsize' );
            $imgsize = '' == $imgsize && !empty( $imgsize2 ) ? array($imgsize2['width'],$imgsize2['height'] ) : $imgsize;
            $imgsize = is_single() ? $imgsize : 'agrikon-grid';
        }
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( $column ); ?>>
            <div class="blog-card">

                <?php if ( !is_search() && !is_archive() && has_post_thumbnail() ) { ?>
                    <div class="blog-card__image">
                        <?php agrikon_sticky_post(); ?>
                        <?php the_post_thumbnail( $imgsize ); ?>
                        <a href="<?php the_permalink(); ?>"></a>
                    </div>
                <?php } ?>

                <div class="blog-card__content">
                    <?php
                    if ( !is_search() && !is_archive() && has_post_thumbnail() && '0' != agrikon_settings( 'post_date_visibility', '0' ) ) {
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
                        if ( '0' != agrikon_settings( 'post_author_visibility', '1' ) ) {
                            printf( '<a href="%1$s" title="%2$s"><i class="far fa-user-circle"></i> %2$s</a>',
                                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                get_the_author()
                            );
                        }

                        if ( comments_open() && '0' != get_comments_number() && '0' != agrikon_settings( 'post_comments_visibility', '1' ) ) {
                            printf( '<a href="%s" title="%s"><i class="far fa-comments"></i> %s</a>',
                                get_comments_link( get_the_ID() ),
                                get_the_title(),
                                _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'agrikon' ),
                                number_format_i18n( get_comments_number() )
                            );
                        }
                        ?>
                    </div>
                    <?php
                    if ( get_the_title() && '0' != agrikon_settings( 'post_title_visibility', '1' ) ) {
                        printf( '<h3 class="title"><a href="%s" title="%s">%s</a></h3>',
                            get_permalink(),
                            the_title_attribute( 'echo=0' ),
                            get_the_title()
                        );
                    }

                    agrikon_blog_post_content();

                    agrikon_blog_post_button();
                    ?>

                </div>
            </div>
        </div>

        <?php
    }
}

if ( ! function_exists( 'agrikon_post_style_two' ) ) {

    function agrikon_post_style_two()
    {
        ?>
        <div id="post-<?php echo get_the_ID(); ?>" <?php echo post_class( 'item mb-80' ); ?>>

            <?php agrikon_sticky_post(); ?>

            <?php agrikon_blog_post_thumbnail(); ?>

            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <?php
                            agrikon_blog_post_tags();
                            agrikon_blog_post_date();
                            agrikon_blog_post_title();
                            agrikon_blog_post_content();
                            agrikon_blog_post_button();
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }
}


if ( ! function_exists('agrikon_sticky_post')) {

    function agrikon_sticky_post()
    {
        if ( is_sticky() ) { ?>
            <div class="nt-sticky-label"><span class="label is-green-light"><?php echo esc_html__( 'Sticky', 'agrikon' ); ?></span></div>
        <?php }
    }
}

if ( ! function_exists('agrikon_blog_post_thumbnail')) {

    function agrikon_blog_post_thumbnail()
    {
        if ( has_post_thumbnail() ) {

             if ( 'grid' == agrikon_settings( 'index_type', 'default' ) ) {

                the_post_thumbnail( 'agrikon-grid' );

            } else {

                printf( '<div class="img"><a href="%s" title="%s"><div class="post-bg-image" data-agrikon-bg-src="%s">%s</div></a></div>',
                    esc_url( get_permalink() ),
                    the_title_attribute( 'echo=0' ),
                    get_the_post_thumbnail_url( get_the_ID(), 'agrikon-grid'),
                    get_the_post_thumbnail( get_the_ID(), 'agrikon-grid')
                );

            }
        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_title' ) ) {

    function agrikon_blog_post_title()
    {
        if ( '0' != agrikon_settings( 'post_title_visibility', '1' ) ) {

            the_title( sprintf( '<h4 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_date' ) ) {

    function agrikon_blog_post_date()
    {
        if ( '0' != agrikon_settings( 'post_date_visibility', '1' ) ) {

            $archive_year  = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day   = get_the_time( 'd' );

            ?>
            <div class="date">
                <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                    <span class="num"><?php the_time('d'); ?></span>
                    <span class="month"><?php the_time('F'); ?></span>
                </a>
            </div>
            <?php
        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_meta' ) ) {

    function agrikon_blog_post_meta()
    {
        if ( '0' != agrikon_settings('post_meta_visibility', '1' ) ) {

            if( get_the_author_meta( 'url' ) ) {

                echo sprintf( '<p class="blog-post_meta">%1$s %2$s %3$s</p>',
                    apply_filters( 'agrikon_post_date', get_the_date(), true ),
                    esc_html__( 'By', 'agrikon' ),
                    get_the_author_link()
                );

            } else {

                echo sprintf( '<p class="blog-post_meta">%1$s %2$s <a href="%3$s" title="%4$s">%4$s</a></p>',
                    apply_filters( 'agrikon_post_date', get_the_date(), true ),
                    esc_html__( 'By', 'agrikon' ),
                    esc_url( get_permalink() ),
                    get_the_author()
                );

            }
        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_category' ) ) {

    function agrikon_blog_post_category()
    {
        if ( has_category() && '0' != agrikon_settings( 'post_category_visibility', '1' ) ) {
            ?>
            <div class="blog-post_category"><?php the_category( ', ' ); ?></div>
            <?php
        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_tags' ) ) {

    function agrikon_blog_post_tags()
    {
        if ( has_tag() && '0' != agrikon_settings( 'post_tags_visibility', '1' ) ) {

            the_tags('<div class="tags">','','</div>');

        }
    }
}


if ( ! function_exists( 'agrikon_blog_post_content' ) ) {

    function agrikon_blog_post_content()
    {
        $limit = is_single() ? agrikon_settings( 'related_excerpt_limit', '9' ) : agrikon_settings( 'excerptsz', '30' );
        $excerpt = is_single() ? agrikon_settings( 'related_excerpt_visibility', '0' ) : agrikon_settings( 'post_excerpt_visibility', '1' );
        
        if ( '0' != $excerpt ) {
            
            if ( has_excerpt() ) {
    
                echo wpautop( wp_trim_words( strip_tags( trim( get_the_excerpt() ) ), $limit ) );
    
            } else {
    
                echo wpautop( wp_trim_words( strip_tags( trim( get_the_content() ) ), $limit ) );
    
            }
        }

        agrikon_wp_link_pages();
    }
}

if ( ! function_exists( 'agrikon_blog_post_button' ) ) {

    function agrikon_blog_post_button()
    {
        if ( '0' != agrikon_settings( 'post_button_visibility', '1' ) ) {

            $button_title = agrikon_settings( 'post_button_title' ) ? esc_html( agrikon_settings( 'post_button_title' ) ) : esc_html__( 'Read More', 'agrikon' );

            printf( '<a class="thm-btn" href="%s" title="%s">%s</a>',
                get_permalink(),
                the_title_attribute( 'echo=0' ),
                $button_title
            );

        }
    }
}
