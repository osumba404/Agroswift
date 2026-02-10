<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Post_Types_List extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-post-types-list';
    }
    public function get_title() {
        return 'Post Types List (N)';
    }
    public function get_icon() {
        return 'eicon-post-list';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_types_list_query',
            [
                'label' => esc_html__( 'Query', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'post_type',
            [
                'label' => esc_html__( 'Show Post(s)', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_get_post_types()
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 50,
                'default' => 4
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'Post ID',
                    'title' => 'Title',
                    'name' => 'Slug',
                    'date' => 'Date',
                    'rand' => 'Random',
                ],
                'default' => 'rand'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
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
        $this->add_control( 'thumbnail',
            [
                'label' => esc_html__( 'Thumbnail', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'permalink',
            [
                'label' => esc_html__( 'Permalink', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'date',
            [
                'label' => esc_html__( 'Date', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'agrikon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'List Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'list_heading',
            [
                'label' => esc_html__( 'LIST', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'list_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-post-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'list_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-post-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-post-list li',
            ]
        );
        $this->add_control( 'img_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'img_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-post-list li img.b-img',
            ]
        );
        $this->add_responsive_control( 'img_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-post-list li img.b-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li span.date' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'date_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li:hover span.date' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '.nt-post-list li .title'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li .title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'link_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li .title a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_heading',
            [
                'label' => esc_html__( 'ICON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-post-list li:hover i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-post-list li i' => 'font-size: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'icon_space',
            [
                'label' => esc_html__( 'Icon Space', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-post-list li i' => 'margin-right: {{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $myposts = get_posts(
            array(
                'posts_per_page' => $settings['post_per_page'],
                'post_type'      => $settings['post_type'],
                'post_status'    => 'publish',
                'orderby'        => $settings['orderby']
            )
        );

        if ( $myposts ) {

            echo '<ul class="list-unstyled footer-widget__post nt-post-list nt-orderby-' . $settings['orderby'] . '">';
                foreach ( $myposts as $post ) {
                    setup_postdata( $post );
                    $title     = get_the_title( $post->ID );
                    $permalink = get_the_permalink( $post->ID );

                    $icon = !empty( $settings['icon']['value'] ) ? '<i class="'.$settings['icon']['value'].'" aria-hidden="true"></div>' : '';

                    echo '<li class="nt-post-list-item nt-post-id-' . $post->ID . ' nt-post-type-' . $post->post_type . '">'.$icon.' ';
                        if ( has_post_thumbnail( $post->ID ) && 'yes' == $settings['thumbnail'] ) {
                            echo get_the_post_thumbnail( $post->ID, 'thumbnail', ['class'=>'b-img'] );
                        }
                        echo '<div class="footer-widget__post-content">';
                            if ( 'yes' == $settings['date'] ) {
                                echo '<span class="date">'.get_the_time( 'M j, Y' ).'</span>';
                            }
                            if ( 'yes' == $settings['permalink'] ) {
                                echo '<'.$settings['tag'].' class="title"><a href="'.esc_url( $permalink ).'" title="'.$title.'">'.$title.'</a></'.$settings['tag'].'>';
                            } else {
                                echo '<'.$settings['tag'].' class="title">'.$title.'</'.$settings['tag'].'>';
                            }
                        echo '</div>';
                    echo '</li>';
                }
            echo '</ul>';
            wp_reset_postdata();
        }
    }
}
