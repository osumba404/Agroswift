<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Blog_Special extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-blog-special';
    }
    public function get_title() {
        return 'Blog Special (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query',
            [
                'label' => esc_html__( 'Query', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->agrikon_query_controls('post');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_options',
            [
                'label' => esc_html__( 'Post Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Column for Large Device', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3' => esc_html__( '4 Column', 'agrikon' ),
                    '4' => esc_html__( '3 Column', 'agrikon' ),
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                    '12' => esc_html__( '1 Column', 'agrikon' ),
                ],
                'default' => '4'
            ]
        );
        $this->add_control( 'colmd',
            [
                'label' => esc_html__( 'Column for Medium Device', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__( '3 Column', 'agrikon' ),
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                    '12' => esc_html__( '1 Column', 'agrikon' ),
                ],
                'default' => '6'
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column for Small Device', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                    '12' => esc_html__( '1 Column', 'agrikon' ),
                ],
                'default' => '12',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'agrikon-square',
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideauthor',
            [
                'label' => esc_html__( 'Hide Author', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidecomments',
            [
                'label' => esc_html__( 'Hide Comments', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'hidebtn',
            [
                'label' => esc_html__( 'Hide Button', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Read More Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'label_block' => true,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label'=> esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__image > a' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'plus_color',
            [
                'label' => esc_html__( 'Plus Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__image > a::before, {{WRAPPER}} .blog-card__image > a::after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'date_heading',
            [
                'label' => esc_html__( 'DATE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'date_color',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__date' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'date_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__date' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'date_brdcolor',
            [
                'label' => esc_html__( 'Border Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__date' => 'border-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'txtbox_heading',
            [
                'label' => esc_html__( 'TEXT CONTENT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'txtbox_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_responsive_control( 'txtbox_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-card__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'meta_heading',
            [
                'label' => esc_html__( 'POST META', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'meta_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__meta a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'meta_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__meta a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'meta_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__meta a i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .title a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .title a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{WRAPPER}} .blog-card__content .title'
            ]
        );
        $this->add_control( 'text_heading',
            [
                'label' => esc_html__( 'EXCERPT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'text_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} {{WRAPPER}} .blog-card__content p'
            ]
        );
        $this->add_control( 'btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( 'btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .blog-card__content .thm-btn',
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn:hover' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .blog-card__content .thm-btn:hover',
            ]
        );
        $this->add_responsive_control( 'btn_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-card__content .thm-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'pagination_style_section',
            [
                'label'=> esc_html__( 'Pagination Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->add_responsive_control( 'pag_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-pagination' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'pag_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'pag_heading',
            [
                'label' => esc_html__( 'BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'pag_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-numbers' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'pag_space',
            [
                'label' => esc_html__( 'Spacing', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-numbers:not(:last-child)' => 'margin-right: {{SIZE}}px;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->start_controls_tabs( 'pag_tabs');
        $this->start_controls_tab( 'pag_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'pag_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'pag_bgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pag_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .page-numbers',
            ]
        );
        $this->add_responsive_control( 'pag_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'pag_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'pag_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'pag_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pag_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current',
            ]
        );
        $this->add_responsive_control( 'pag_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .page-numbers:hover,{{WRAPPER}} .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ( is_home() || is_front_page() ) {
            $paged = get_query_var( 'page') ? get_query_var('page') : 1;
        } else {
            $paged = get_query_var( 'paged') ? get_query_var('paged') : 1;
        }

        $args['post_type']      = $settings['post_type'];
        $args['posts_per_page'] = $settings['posts_per_page'];
        $args['offset']         = $settings['offset'];
        $args['order']          = $settings['order'];
        $args['orderby']        = $settings['orderby'];
        $args['paged']          = $paged;
        $args[$settings['author_filter_type']] = $settings['author'];


        $post_type = $settings['post_type'];

        if ( ! empty( $settings[ $post_type . '_filter' ] ) ) {
            $args[ $settings[ $post_type . '_filter_type' ] ] = $settings[ $post_type . '_filter' ];
        }

        // Taxonomy Filter.
        $taxonomy = $this->get_post_taxonomies( $post_type );

        if ( ! empty( $taxonomy ) && ! is_wp_error( $taxonomy ) ) {

            foreach ( $taxonomy as $index => $tax ) {

                $tax_control_key = $index . '_' . $post_type;

                if ( $post_type == 'post' ) {
                    if ( $index == 'post_tag' ) {
                        $tax_control_key = 'tags';
                    } elseif ( $index == 'category' ) {
                        $tax_control_key = 'categories';
                    }
                }

                if ( ! empty( $settings[ $tax_control_key ] ) ) {

                    $operator = $settings[ $index . '_' . $post_type . '_filter_type' ];

                    $args['tax_query'][] = array(
                        'taxonomy' => $index,
                        'field'    => 'term_id',
                        'terms'    => $settings[ $tax_control_key ],
                        'operator' => $operator,
                    );
                }
            }
        }

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="blog-one">';
                echo '<div class="row">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        echo '<div class="col-sm-'.$settings['colsm'].' col-md-'.$settings['colmd'].' col-lg-'.$settings['collg'].'">';
                            echo '<div class="blog-card">';

                                echo '<div class="blog-card__image">';
                                    the_post_thumbnail( $size, ['class'=>'b-img'] );
                                    echo '<a href="'.get_permalink().'"></a>';
                                echo '</div>';

                                echo '<div class="blog-card__content">';
                                    if ( 'yes' != $settings['hidedate'] ) {
                                        $archive_year  = get_the_time( 'Y' );
                                        $archive_month = get_the_time( 'm' );
                                        $archive_day   = get_the_time( 'd' );
                                        printf( '<div class="blog-card__date"><a href="%1$s" title="%1$s">%2$s %3$s</a></div>',
                                            esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                                            get_the_time( 'd' ),
                                            get_the_time( 'M' )
                                        );
                                    }
                                    if ( 'yes' != $settings['hideauthor'] || 'yes' != $settings['hidecomments'] ) {
                                        echo '<div class="blog-card__meta">';
                                            if ( 'yes' != $settings['hideauthor'] ) {
                                                printf( '<a href="%1$s" title="%2$s"><i class="far fa-user-circle"></i> %2$s</a>',
                                                    get_author_posts_url( get_the_author_meta( 'ID' ) ),
                                                    get_the_author()
                                                );
                                            }
                                            if ( comments_open() && '0' != get_comments_number() && 'yes' != $settings['hidecomments'] ) {
                                                printf( '<a href="%s" title="%s"><i class="far fa-comments"></i> %s</a>',
                                                    get_comments_link( get_the_ID() ),
                                                    get_the_title(),
                                                    _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'agrikon' ), number_format_i18n( get_comments_number() )
                                                );
                                            }
                                        echo '</div>';
                                    }
                                    if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                        echo '<'.$settings['tag'].' class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></'.$settings['tag'].'>';
                                    }
                                    if ( 'yes' != $settings[ 'hideexcerpt' ] && has_excerpt() ) {
                                        echo '<p class="excerpt">'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p>';
                                    }
                                    if ( $settings[ 'btn_title' ] && 'yes' != $settings[ 'hidebtn' ] ) {
                                        echo '<a class="thm-btn" href="'.get_permalink().'">'.$settings[ 'btn_title' ].'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                echo '</div>';
                if ( $settings['pagination'] == 'yes' ) {
                    echo '<div class="nt-pagination d-flex justify-content-center align-items-center">';
                        if ( $the_query->max_num_pages > 1){
                            echo paginate_links(array(
                                'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                                'format'    => '?paged=%#%',
                                'current'   => max(1, $paged ),
                                'total'     => $the_query->max_num_pages,
                                'type'      => '',
                                'prev_text' => '<i class="fa fa-angle-left"></i>',
                                'next_text' => '<i class="fa fa-angle-right"></i>',
                                'before_page_number' => '<div class="nt-pagination-item">',
                                'after_page_number' => '</div>'
                            ));
                        }
                    echo '</div>';
                }
            echo '</div>';

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'agrikon' ) . '</p>';
        }
    }
}
