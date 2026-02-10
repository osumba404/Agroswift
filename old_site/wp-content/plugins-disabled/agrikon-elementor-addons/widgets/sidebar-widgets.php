<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Sidebar_Widgets extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-sidebar-widgets';
    }
    public function get_title() {
        return 'Sidebar Widgets (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'agrikon-post' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_sidebar_widgets_settings',
            [
                'label' => esc_html__('Sidebar Widgets', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'data',
            [
                'label' => esc_html__( 'Data Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'search' => esc_html__( 'Search', 'agrikon' ),
                    'recent' => esc_html__( 'Recent Post', 'agrikon' ),
                    'cats' => esc_html__( 'Categories', 'agrikon' ),
                    'tags' => esc_html__( 'Tags', 'agrikon' ),
                    'archives' => esc_html__( 'Archives', 'agrikon' ),
                ],
                'default' => 'recent'
            ]
        );
        $this->add_control( 'limit',
            [
                'label' => esc_html__( 'Post Limit', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
            ]
        );
        $this->add_control( 'post_type',
            [
                'label' => esc_html__( 'Post Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'options' => $this->agrikon_get_post_types(),
                'condition' => ['data' => 'recent']
            ]
        );
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'featured' => esc_html__( 'Featured', 'agrikon' ),
                    'on-sale' => esc_html__( 'On Sale', 'agrikon' ),
                    'best' => esc_html__( 'Best Selling', 'agrikon' ),
                    'custom' => esc_html__( 'Specific Categories', 'agrikon' ),
                ],
                'default' => 'newest',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'post_type','operator' => '==','value' => 'product'],
                    ]
                ]
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'post_type','operator' => '==','value' => 'product'],
                        ['name' => 'scenario','operator' => '==','value' => 'custom'],
                    ]
                ]
            ]
        );
        $this->add_control( 'hideprice',
            [
                'label' => esc_html__( 'Hide Price', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'post_type','operator' => '==','value' => 'product'],
                    ]
                ]
            ]
        );
        $this->add_control( 'hidebtn',
            [
                'label' => esc_html__( 'Hide Buttons', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'post_type','operator' => '==','value' => 'product'],
                    ]
                ]
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'monthly',
                'options' => [
                    'daily' => esc_html__( 'daily', 'agrikon' ),
                    'weekly' => esc_html__( 'weekly', 'agrikon' ),
                    'monthly' => esc_html__( 'monthly', 'agrikon' ),
                    'yearly' => esc_html__( 'yearly', 'agrikon' ),
                ],
                'condition' => ['data' => 'archives']
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'agrikon' ),
                    'DESC' => esc_html__( 'Descending', 'agrikon' )
                ],
                'default' => 'DESC',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'archives'],
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                    ]
                ]
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'agrikon' ),
                    'menu_order' => esc_html__( 'Menu Order', 'agrikon' ),
                    'rand' => esc_html__( 'Random', 'agrikon' ),
                    'date' => esc_html__( 'Date', 'agrikon' ),
                    'title' => esc_html__( 'Title', 'agrikon' ),
                ],
                'default' => 'id',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'archives'],
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                    ]
                ]
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Title',
                'label_block' => true,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
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
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'widget_heading',
            [
                'label' => esc_html__( 'WIDGET STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_responsive_control( 'widget_padding',
            [
                'label' => esc_html__( 'Widget Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .sidebar--widgets' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'widget_bgcolor',
            [
                'label' => esc_html__( 'Widget Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar .sidebar--widgets' => 'background-color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'widget_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .blog-sidebar .sidebar--widgets',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_responsive_control( 'widget_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-sidebar .sidebar--widgets' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Title Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .blog-sidebar .title',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar .title' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data' => 'recent']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .blog-sidebar__posts ul li > img.post--img',
                'condition' => ['data' => 'recent']
            ]
        );
        $this->add_responsive_control( 'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-sidebar__posts ul li > img.post--img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'recent']
            ]
        );
        $this->add_control( 'link_heading',
            [
                'label' => esc_html__( 'LINK STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .blog-sidebar a',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'link_color',
            [
                'label' => esc_html__( 'Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar a,{{WRAPPER}} .blog-sidebar ul li a' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'link_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar a:hover,{{WRAPPER}} .blog-sidebar ul li a:hover' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'meta_heading',
            [
                'label' => esc_html__( 'META STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'meta_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar span,{{WRAPPER}} .blog-sidebar__posts ul li span' => 'color:{{VALUE}};' ],
                'condition' => ['data!' => 'search']
            ]
        );
        $this->add_control( 'search_heading',
            [
                'label' => esc_html__( 'SEARCH STYLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar__search form' => 'background-color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_color',
            [
                'label' => esc_html__( 'Text Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar__search form input' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_btncolor',
            [
                'label' => esc_html__( 'Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar__search form button[type="submit"]' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_hvrbtncolor',
            [
                'label' => esc_html__( 'Hover Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar__search form button[type="submit"]:hover' => 'color:{{VALUE}};' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_responsive_control( 'form_padding',
            [
                'label' => esc_html__( 'Input Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-sidebar__search form input[type="text"].sidebar_search_input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_control( 'form_height',
            [
                'label' => esc_html__( 'Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .blog-sidebar__search form' => 'height: {{SIZE}}px;' ],
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .blog-sidebar__search form',
                'condition' => ['data' => 'search']
            ]
        );
        $this->add_responsive_control( 'form_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .blog-sidebar__search form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'condition' => ['data' => 'search']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('buttons_style_section',
            [
                'label' => esc_html__( 'Button Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'data','operator' => '==','value' => 'recent'],
                        ['name' => 'post_type','operator' => '==','value' => 'product'],
                    ]
                ]
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
                'selectors' => [ '{{WRAPPER}} .sidebar--widgets .woocommerce a' => 'color: {{VALUE}}!important;']
            ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .sidebar--widgets .woocommerce a' => 'background-color: {{VALUE}}!important;']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selectors' => ['{{WRAPPER}} .sidebar--widgets .woocommerce a']
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .sidebar--widgets .woocommerce a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
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
                'selectors' => [
                    '{{WRAPPER}} .sidebar--widgets .woocommerce a:hover' => 'color: {{VALUE}}!important;',
                ]
            ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sidebar--widgets .woocommerce a:hover' => 'background-color: {{VALUE}}!important;',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selectors' => ['{{WRAPPER}} .sidebar--widgets .woocommerce a:hover']
            ]
        );
        $this->add_responsive_control( 'btn_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .sidebar--widgets .woocommerce a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['tag'];

        if ( 'search' == $settings['data'] ) {
            echo'<div class="sidebar--widgets blog-sidebar__search">';
                echo agrikon_sidebar_search_form();
            echo'</div>';
        }

        if ( 'cats' == $settings['data'] ) {
            $cats = get_the_category();
            echo '<div class="blog-sidebar">';
                echo '<div class="sidebar--widgets blog-sidebar__categories sidebar--widget_categories">';
                    if ( $settings['title'] ) {
                        echo '<'.$tag.' class="title">'.$settings['title'].'</'.$tag.'>';
                    }
                    echo '<ul>';
                        foreach ( $cats as $cat ) {
                            printf( '<li><a href="%s" title="%s"><i class="agrikon-icon-right-arrow"></i> %s</a></li>',
                                esc_url( get_category_link( $cat->term_id ) ),
                                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $cat->name ) ),
                                esc_html( $cat->name )
                            );
                        }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'tags' == $settings['data'] ) {
            echo '<div class="blog-sidebar">';
                echo '<div class="sidebar--widgets blog-sidebar__tags">';
                    if ( $settings['title'] ) {
                        echo '<'.$tag.' class="title">'.$settings['title'].'</'.$tag.'>';
                    }
                    echo '<div class="blog-sidebar__tags-links">';
                        $tags = get_the_tags();

                        if ( !empty( $tags ) ) {
                            $count = 0;
                            $counttags = count($tags);
                            foreach ( $tags as $tag ) {
                                $separator = $count != ( $counttags - 1 ) ? ', ' : '';
                                echo '<a href="'.get_tag_link( $tag->term_id ).'">'.$tag->name.$separator.'</a>';
                                $count++;
                            }
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'archives' == $settings['data'] ) {
            echo '<div class="blog-sidebar">';
                echo '<div class="sidebar--widgets blog-sidebar__categories sidebar--widget_archives">';
                    if ( $settings['title'] ) {
                        echo '<'.$tag.' class="title">'.$settings['title'].'</'.$tag.'>';
                    }
                    $args = array(
                        'type'            => $settings['type'],
                        'limit'           => $settings['limit'],
                        'format'          => 'html',
                        'before'          => '<i class="agrikon-icon-right-arrow"></i>',
                        'after'           => '',
                        'show_post_count' => true,
                        'echo'            => 1,
                        'order'           => $settings['order']
                    );
                    echo '<ul>';
                        wp_get_archives( $args );
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }

        if ( 'recent' == $settings['data'] ) {
            echo '<div class="blog-sidebar">';
                echo '<div class="sidebar--widgets blog-sidebar__posts">';
                    if ( $settings['title'] ) {
                        echo '<'.$tag.' class="title">'.$settings['title'].'</'.$tag.'>';
                    }
                    echo '<ul class="unstyled">';
                        $args = array(
                            'numberposts' => $settings['limit'],
                            'post_type'   => $settings['post_type'],
                            'post_status' => 'publish',
                            'order'       => $settings['order']
                        );
                        if ( 'product' == $settings['post_type'] ) {
                            if ( 'featured' == $settings['scenario'] ) {
                               $args['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'product_visibility',
                                        'field'    => 'name',
                                        'terms'    => 'featured',
                                    )
                                );
                            } elseif ('on-sale' == $settings['scenario']) {
                                $args['meta_query'] = array(
                                    'relation' => 'OR',
                                    array( // Simple products type
                                        'key'       => '_sale_price',
                                        'value'     => 0,
                                        'compare'   => '>',
                                        'type'      => 'numeric'
                                    ),
                                    array( // Variable products type
                                        'key'       => '_min_variation_sale_price',
                                        'value'     => 0,
                                        'compare'   => '>',
                                        'type'      => 'numeric'
                                    )
                                );
                            } elseif('best' == $settings['scenario']) {
                                $args['orderby'] = 'meta_value_num';
                                $args['meta_key'] = 'total_sales';
                            } else {
                                $args['orderby'] = $settings['orderby'];
                            }
                            if ( 'custom' == $settings['scenario'] && $settings['category_include'] ) {
                                $args['tax_query'] = array(
                                    array(
                                        'taxonomy'  => 'product_cat',
                                        'field'     => 'id',
                                        'terms'     => $settings['category_include'],
                                        'operator'  => 'IN'
                                    )
                                );
                            }
                        }
                        $recents = wp_get_recent_posts( $args );
                        foreach( $recents as $recent ) {
                            $comments = '';
                            if ( comments_open( $recent['ID'] ) && '0' != get_comments_number( $recent['ID'] ) ) {
                                $comments = '<span><i class="far fa-comments"></i> '._nx( '1 Comment', '%1$s Comments', get_comments_number( $recent['ID'] ), 'comments title', 'agrikon' ).'</span>';
                            }
                            if ( 'product' == $settings['post_type'] ) {
                                $product = wc_get_product( $recent['ID'] );
                                $title = apply_filters( 'the_title', $recent['post_title'], $recent['ID'] );
                                echo '<li class="post_type--'.$settings['post_type'].'">';
                                    echo get_the_post_thumbnail( $recent['ID'], 'thumbnail', ['class'=>'post--img'] );
                                    echo '<h4><a href="'.esc_url( get_permalink( $recent['ID'] ) ).'">'.$title.'</a></h4>';
                                    if ( 'yes' != $settings['hideprice'] ) {
                                        echo '<span class="product_price">'.$product->get_price_html().'</span>';
                                    }
                                    if ( 'yes' != $settings['hidebtn'] ) {
                                        echo do_shortcode('[add_to_cart id="'.$recent['ID'].'" show_price="false" style=""]');
                                    }
                                echo '</li>';
                            } else {
                                printf( '<li class="post_type--%s">%s %s<h4><a href="%s">%s</a></h4></li>',
                                    $settings['post_type'],
                                    get_the_post_thumbnail( $recent['ID'], 'thumbnail', ['class'=>'post--img'] ),
                                    $comments,
                                    esc_url( get_permalink( $recent['ID'] ) ),
                                    apply_filters( 'the_title', $recent['post_title'], $recent['ID'] )
                                );
                            }
                        }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }
    }
}
