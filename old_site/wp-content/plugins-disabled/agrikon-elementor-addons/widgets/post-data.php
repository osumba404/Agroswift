<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Post_Data extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-post-data';
    }
    public function get_title() {
        return 'Post Data (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'agrikon-post' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_post_data_settings',
            [
                'label' => esc_html__('Post Data', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'data',
            [
                'label' => esc_html__( 'Data Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'title' => esc_html__( 'Title', 'agrikon' ),
                    'featured' => esc_html__( 'Featured Image', 'agrikon' ),
                    'author' => esc_html__( 'Author Name', 'agrikon' ),
                    'desc' => esc_html__( 'Author Description', 'agrikon' ),
                    'avatar' => esc_html__( 'Author Avatar', 'agrikon' ),
                    'authbox' => esc_html__( 'Author Box', 'agrikon' ),
                    'date' => esc_html__( 'Date', 'agrikon' ),
                    'cat' => esc_html__( 'Category', 'agrikon' ),
                    'tag' => esc_html__( 'Tags', 'agrikon' ),
                    'comment-number' => esc_html__( 'Comment Number', 'agrikon' ),
                    'comment-template' => esc_html__( 'Comment Template', 'agrikon' ),
                    'related' => esc_html__( 'Related Post', 'agrikon' ),
                    'nav' => esc_html__( 'Navigation', 'agrikon' ),
                    'prev' => esc_html__( 'Previous Post', 'agrikon' ),
                    'next' => esc_html__( 'Next Post', 'agrikon' ),
                ],
                'default' => 'title'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => esc_html__( 'h1', 'agrikon' ),
                    'h2' => esc_html__( 'h2', 'agrikon' ),
                    'h3' => esc_html__( 'h3', 'agrikon' ),
                    'h4' => esc_html__( 'h4', 'agrikon' ),
                    'h5' => esc_html__( 'h5', 'agrikon' ),
                    'h6' => esc_html__( 'h6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                    'span' => esc_html__( 'span', 'agrikon' )
                ],
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'date' ],
                        [ 'name' => 'data','operator' => '==','value' => 'cat' ],
                        [ 'name' => 'data','operator' => '==','value' => 'comment-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'tag' ],
                        [ 'name' => 'data','operator' => '==','value' => 'title' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                        [ 'name' => 'data','operator' => '==','value' => 'desc' ]
                    ]
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'featured' ],
                        [ 'name' => 'data','operator' => '==','value' => 'related' ],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'perpage',
            [
                'label' => esc_html__( 'Post Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 6,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Related Posts',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'subtitle',
            [
                'label' => esc_html__( 'Section Subtitle', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Awesome Works',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'related' ],
                        [ 'name' => 'hideexcerpt','operator' => '!=','value' => 'yes' ],
                    ]
                ]
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 4,
                'condition' => [ 'data' => 'related' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View Tablet', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View Phone', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'mousewheel',
            [
                'label' => esc_html__( 'Mousewheel', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'gap',
            [
                'label' => esc_html__( 'Gap', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 30,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('data_avatar_style_section',
            [
                'label'=> esc_html__( 'Avatar Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['data' => 'avatar']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'avatar_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .post--data.author--img img.avatar',
            ]
        );
        $this->add_responsive_control( 'widget_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .post--data.author--img img.avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'avatar_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 30,
                'max' => 500,
                'step' => 1,
                'default' => 167,
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('data_style_section',
            [
                'label'=> esc_html__( 'Data Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'date' ],
                        [ 'name' => 'data','operator' => '==','value' => 'cat' ],
                        [ 'name' => 'data','operator' => '==','value' => 'comment-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'tag' ],
                        [ 'name' => 'data','operator' => '==','value' => 'title' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                        [ 'name' => 'data','operator' => '==','value' => 'desc' ]
                    ]
                ]
            ]
        );
        $this->add_control( 'hide_icon',
            [
                'label' => esc_html__( 'Hide Icon', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'comment-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                    ]
                ]
            ]
        );
        $this->add_control( 'post_data_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--data a i' => 'color:{{VALUE}};' ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [ 'name' => 'data','operator' => '==','value' => 'comment-number' ],
                        [ 'name' => 'data','operator' => '==','value' => 'author' ],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'post_data_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .post--data' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'post_data_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .post--data' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'post_data_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--data, {{WRAPPER}} .post--data a' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_data_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--data a:hover' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_data_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .post--data'
            ]
        );
        $this->add_responsive_control( 'hero_horizontal',
            [
                'label' => esc_html__( 'Text Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .post--data' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function post_related() {
        $settings = $this->get_settings_for_display();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $sattr = array();
        $sattr[] = $settings['speed'] ? '"speed":'.$settings['speed'] : '"speed":1000';
        $sattr[] = $settings['perview'] ? '"perview":'.$settings['perview'] : '"perview":4';
        $sattr[] = $settings['mdperview'] ? '"mdperview":'.$settings['mdperview'] : '"speed":3';
        $sattr[] = $settings['smperview'] ? '"smperview":'.$settings['smperview'] : '"smperview":2';
        $sattr[] = $settings['gap'] ? '"gap":'.$settings['gap'] : '"gap":30';
        $sattr[] = 'yes' == $settings['loop'] ? '"loop":true' : '"loop":false';
        $sattr[] = 'yes' == $settings['autoplay'] ? '"autoplay":true' : '"autoplay":false';
        $sattr[] = 'yes' == $settings['mousewheel'] ? '"mousewheel":true' : '"mousewheel":false';

        global $post;
        $cats = get_the_category( $post->ID );
        $args = array(
            'post__not_in' => array( $post->ID ),
            'posts_per_page' => $settings['perpage']
        );

        $the_query = new \WP_Query( $args );

        if( $the_query->have_posts() ) {
            wp_enqueue_script( 'swiper' );
        ?>

            <div class="nt-related-posts post--data nt-blog blog-grid-two">
                <div class="swiper-container" data-slider-settings='{<?php echo implode(',',$sattr); ?>}'>
                    <div class="swiper-wrapper">
                        <?php
                            while( $the_query->have_posts() ) {

                                $the_query->the_post();
                                if ( has_post_thumbnail() ) {
                                    ?>
                                    <div class="swiper-slide item-column">
                                        <div class="swiper-slide">
                                            <?php agrikon_post_style_one(); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        }
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $tag = $settings['tag'];
        if ( 'title' == $settings['data'] ) {
            echo '<'.$tag.' class="post--data post--title post--id-'.$post->ID.'">'.get_the_title( $post->ID ).'</'.$tag.'>';
        }
        if ( 'featured' == $settings['data'] ) {
            echo '<div class="blog-details__image post--data post--img post--id-'.$post->ID.'">' . get_the_post_thumbnail( get_the_ID(), $settings['thumbnail_size'], array( 'class' => 'b-img' ) ) . '</div>';
        }
        if ( 'cat' == $settings['data'] && has_category() ) {
            echo '<'.$tag.' class="post--data post--cat post--id-'.$post->ID.'">';
                the_category(', ');
            echo '</'.$tag.'>';
        }
        if ( 'tag' == $settings['data'] && has_tag() ) {
            echo '<'.$tag.' class="post--data post--tags post--id-'.$post->ID.'">';
                the_tags('', ', ', '');
            echo '</'.$tag.'>';
        }
        if ( 'date' == $settings['data'] ) {
            echo '<'.$tag.' class="blog-card__date post--data post--date post--id-'.$post->ID.'">';
            $archive_year  = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day   = get_the_time( 'd' );
            printf( '<a href="%1$s" title="%1$s">%2$s %3$s</a>',
                esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                get_the_time( 'd' ),
                get_the_time( 'M' )
            );
            echo '</'.$tag.'>';
        }
        if ( 'comment-number' == $settings['data'] ) {
            $icon = 'yes' == $settings['hide_icon'] ? '<i class="far fa-comments"></i> ' : '';
            echo '<div class="blog-card__meta"><'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
                printf( '<a href="%s" title="%s">%s%s</a>',
                    esc_url( get_comments_link( $post->ID ) ),
                    get_the_title(),
                    $icon,
                    _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'agrikon' )
                );
            echo '</'.$tag.'></div>';
        }

        if ( 'comment-template' == $settings['data'] ) {
            echo '<div class="agrikon-comments-wrapper post--id-'.$post->ID.'" id="agrikon-comments-wrapper">';
                agrikon_single_post_comment_template();
            echo'</div>';
        }
        if ( 'nav' == $settings['data'] && function_exists( 'agrikon_single_navigation' ) ) {
            echo '<div class="post--data post--nav">';
                agrikon_single_navigation();
            echo '</div>';
        }
        if ( 'related' == $settings['data'] ) {
            $this->post_related();
        }
        if ( 'author' == $settings['data'] && function_exists( 'agrikon_post_meta_author' ) ) {
            $icon = 'yes' == $settings['hide_icon'] ? '<i class="far fa-user-circle"></i> ' : '';
            echo '<div class="blog-card__meta"><'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
            printf( '<a href="%s" title="%s">%s%s</a>',
                get_author_posts_url( $post->post_author ),
                get_the_author_meta( 'display_name', $post->post_author ),
                $icon,
                get_the_author_meta( 'display_name', $post->post_author )
            );
            echo '</'.$tag.'></div>';
        }
        if ( 'desc' == $settings['data'] && get_the_author_meta('user_description', $post->post_author) ) {
            $desc = get_the_author_meta( 'user_description', $post->post_author );
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">'.$desc.'</'.$tag.'>';
        }
        if ( 'avatar' == $settings['data'] ) {
            if ( function_exists( 'get_avatar' ) ) {
                $args = [ 'class' => 'a-img' ];
                $alt = get_the_author_meta( 'display_name', $post->post_author );
                echo '<div class="post--data author--img post--id-'.$post->ID.'">'.get_avatar( get_the_author_meta( 'email' ), $settings['avatar_size'],'',$alt, $args).'</div>';
            }
        }
        if ( 'authbox' == $settings['data'] ) {
            if ( function_exists( 'agrikon_single_post_author_box' ) ) {
                echo '<div class="post--data author--box post--id-'.$post->ID.'">';
                    echo agrikon_single_post_author_box();
                echo'</div>';
            }
        }

    }
}
