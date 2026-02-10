<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Home_Slider extends Widget_Base {

    public function get_name() {
        return 'agrikon-home-slider';
    }
    public function get_title() {
        return 'Home Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_content_section',
            [
                'label' => esc_html__( 'Content', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'agrikon' ),
                    '2' => esc_html__( 'Type 2', 'agrikon' ),
                ],
            ]
        );
        $this->add_control( 'bg_line',
            [
                'label' => esc_html__( 'Background Lines', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'bg1_heading',
            [
                'label' => esc_html__( 'BACKGROUND', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide {{CURRENT_ITEM}}.image-layer',
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'subtitle1_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter subtitle here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'subtitle_hideanim',
            [
                'label' => esc_html__( 'Hide Subtitle Animation', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'subtitle_anim',
            [
                'label' => esc_html__( 'Entrance Animation', 'agrikon' ),
                'type' => Controls_Manager::ANIMATION,
                'condition' => ['subtitle_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'subtitle_delay',
            [
                'label' => esc_html__( 'Animation Delay (ms)', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'condition' => ['subtitle_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'title1_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ],
                'condition' => ['title!' => '']
            ]
        );
        $repeater->add_control( 'title_hideanim',
            [
                'label' => esc_html__( 'Hide Title Animation', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'title_anim',
            [
                'label' => esc_html__( 'Entrance Animation', 'agrikon' ),
                'type' => Controls_Manager::ANIMATION,
                'condition' => ['title_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'title_delay',
            [
                'label' => esc_html__( 'Animation Delay (ms)', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'condition' => ['title_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'title_shape_heading',
            [
                'label' => esc_html__( 'TITLE SHAPE IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .main-slider.main-slider__one .swiper-slide {{CURRENT_ITEM}}.title span::before, {{WRAPPER}} .main-slider__two .swiper-slide {{CURRENT_ITEM}}.title::before',
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape2',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .main-slider.main-slider__one .swiper-slide {{CURRENT_ITEM}}.title span::after, {{WRAPPER}} .main-slider__two .swiper-slide {{CURRENT_ITEM}}.title::after',
            ]
        );
        $repeater->add_control( 'desc1_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'desc_hideanim',
            [
                'label' => esc_html__( 'Hide Description Animation', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'desc_anim',
            [
                'label' => esc_html__( 'Entrance Animation', 'agrikon' ),
                'type' => Controls_Manager::ANIMATION,
                'condition' => ['desc_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'desc_delay',
            [
                'label' => esc_html__( 'Animation Delay (ms)', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'condition' => ['desc_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'btn1_heading',
            [
                'label' => esc_html__( 'BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'use_icon',
            [
                'label' => esc_html__( 'Use Icon', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'icon',
            [
                'label' => esc_html__( 'Button Icon', 'agrikon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_control( 'icon_pos',
            [
                'label' => esc_html__( 'Icon Position', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-icon-right',
                'options' => [
                    'left' => esc_html__( 'Before', 'agrikon' ),
                    'right' => esc_html__( 'After', 'agrikon' )
                ],
                'condition' => ['use_icon' => 'yes']
            ]
        );
        $repeater->add_control( 'btn_hideanim',
            [
                'label' => esc_html__( 'Hide Button Animation', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'btn_anim',
            [
                'label' => esc_html__( 'Entrance Animation', 'agrikon' ),
                'type' => Controls_Manager::ANIMATION,
                'condition' => ['btn_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'btn_delay',
            [
                'label' => esc_html__( 'Animation Delay (ms)', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'condition' => ['btn_hideanim!' => 'yes']
            ]
        );
        $repeater->add_control( 'delay',
            [
                'label' => esc_html__( 'Slide Item Autoplay Delay', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 20000,
                'step' => 100,
                'default' => 5000,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'subtitle' => 'Welcome to Agriculture Farm',
                        'title' => '<span>Agriculture</span> <br>& Eco Farming',
                        'desc' => 'There are many of passages of lorem Ipsum, but the majori have <br> suffered alteration in some form.',
                        'btn_title' => 'Discover More',
                        'link' => '#0'
                    ],
                    [
                        'subtitle' => 'Welcome to Agriculture Farm',
                        'title' => '<span>Agriculture</span> <br>& Eco Farming',
                        'desc' => 'There are many of passages of lorem Ipsum, but the majori have <br> suffered alteration in some form.',
                        'btn_title' => 'Discover More',
                        'link' => '#0'
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
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
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'text_style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'container_heading',
            [
                'label' => esc_html__( 'CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'container_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .main-slider .swiper-slide .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SUBTITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-slider .swiper-slide .tagline' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .tagline'
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-slider .swiper-slide .title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .title'
            ]
        );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-slider .swiper-slide .desc' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .desc'
            ]
        );
        $this->add_control( 'btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .thm-btn'
            ]
        );
        $this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .main-slider .swiper-slide .thm-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .main-slider .swiper-slide .thm-btn' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .thm-btn',
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .main-slider .swiper-slide .thm-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .thm-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
         $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .main-slider .swiper-slide .thm-btn:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .thm-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hvrbackground',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .main-slider .swiper-slide .thm-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->start_controls_tabs( 'slider_nav_tabs');
        $this->start_controls_tab( 'slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' => 'color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .slide-controls .swiper-button-next:hover,
                   {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'color: {{VALUE}};'
               ]
           ]
        );
        $this->add_control( 'nav_hvrbgclr',
           [
               'label' => esc_html__( 'Background Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .slide-controls .swiper-button-next:hover,
                   {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'background-color: {{VALUE}};'
               ]
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        $speed    = $settings['speed'] ? $settings['speed'] : 1000;
        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop     = 'yes' == $settings['loop'] ? 'true' : 'false';

        $type2 = '2' == $settings['type'] ? ' main-slider__two' : ' main-slider__one';
        $column = '2' == $settings['type'] ? 'col-xl-12 text-center' : 'col-xl-7 col-lg-7';
        $line = 'yes' == $settings['bg_line'] && '2' == $settings['type'] ? '<div class="main-slider__line-1"></div><div class="main-slider__line-2"></div><div class="main-slider__line-3"></div><div class="main-slider__line-4"></div><div class="main-slider__line-5"></div><div class="main-slider__line-6"></div>' : '';

        $html = '';
        $html .= '<div class="swiper-container thm-swiper__slider" data-swiper-options=\'{"init": false,"slidesPerView": 1,"loop": '.$loop.',"effect": "fade","autoplay": '.$autoplay.',"navigation": {"nextEl": "#main-slider__swiper-button-next-'.$id.'","prevEl": "#main-slider__swiper-button-prev-'.$id.'"}}\'>';
            $html .= '<div class="swiper-wrapper">';
                foreach ( $settings['slider_items'] as $item ) {

                    $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                    $rel = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                    $href = $item['link']['url'];
                    $delay = 'yes' == $settings['autoplay'] && $item['delay'] ? ' data-swiper-autoplay="'.$item['delay'].'"' : '';
                    $strans = 'yes' == $item['subtitle_hideanim'] ? ' trans-none' : '';
                    $stanim = $item['subtitle_anim'] ? ' has-anim '.$item['subtitle_anim'] : '';
                    $ttrans = 'yes' == $item['title_hideanim'] ? ' trans-none' : '';
                    $tanim = $item['title_anim'] ? ' has-anim '.$item['title_anim'] : '';
                    $dtrans = 'yes' == $item['desc_hideanim'] ? ' trans-none' : '';
                    $danim = $item['desc_anim'] ? ' has-anim '.$item['desc_anim'] : '';
                    $btntrans = 'yes' == $item['btn_hideanim'] ? ' trans-none' : '';
                    $btnanim = $item['btn_anim'] ? ' has-anim '.$item['btn_anim'] : '';
                    $html .= '<div class="swiper-slide"'.$delay.'>';
                        $html .= '<div class="image-layer elementor-repeater-item-' . $item['_id'] . '"></div>';
                        $html .= '<div class="container">';
                            $html .= '<div class="row">';
                                $html .= '<div class="'.$column.'">';
                                    if ( $item['subtitle'] ) {
                                        $html .= '<span class="tagline'.$strans.$stanim.'" data-anim=\'{"animation":"'.$item['subtitle_anim'].'","delay":"'.$item['subtitle_delay'].'"}\'>'.$item['subtitle'].'</span>';
                                    }
                                    if ( $item['title'] ) {
                                        $html .= '<'.$item['tag'].' class="elementor-repeater-item-' . $item['_id'].$ttrans.$tanim.' title" data-anim=\'{"animation":"'.$item['title_anim'].'","delay":"'.$item['title_delay'].'"}\'>'.$item['title'].'</'.$item['tag'].'>';
                                    }
                                    if ( $item['desc'] ) {
                                        $html .= '<p class="desc'.$dtrans.$danim.'" data-anim=\'{"animation":"'.$item['title_anim'].'","delay":"'.$item['desc_delay'].'"}\'>'.$item['desc'].'</p>';
                                    }
                                    if ( $item['btn_title'] ) {
                                        if ( $item['icon_pos'] == 'left' ) {
                                            $html .= '<a href="'.$href.'" '.$target.$rel.' class="thm-btn btn-icon-left'.$btntrans.$btnanim.'" data-anim=\'{"animation":"'.$item['btn_anim'].'","delay":"'.$item['btn_delay'].'"}\'>';
                                            if ( !empty( $settings['icon']['value'] ) ) {
                                                ob_start();
                                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                                                $html .= ob_get_clean();
                                            }
                                            $html .= ' '.$item['btn_title'].'</a>';
                                        } else {
                                            $html .= '<a href="'.$href.'" '.$target.$rel.' class="thm-btn btn-icon-right'.$btntrans.$btnanim.'" data-anim=\'{"animation":"'.$item['btn_anim'].'","delay":"'.$item['btn_delay'].'"}\'>'.$item['btn_title'].' ';
                                            if ( !empty( $settings['icon']['value'] ) ) {
                                                ob_start();
                                                Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
                                                $html .= ob_get_clean();
                                            }
                                            $html .= '</a>';
                                        }
                                    }
                                $html .= '</div>';
                            $html .= '</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                }
            $html .= '</div>';

            $html .= '<div class="main-slider__nav slide-controls">';
                $html .= '<div class="swiper-button-prev" id="main-slider__swiper-button-next-'.$id.'"><i class="agrikon-icon-left-arrow"></i></div>';
                $html .= '<div class="swiper-button-next" id="main-slider__swiper-button-prev-'.$id.'"><i class="agrikon-icon-right-arrow"></i></div>';
            $html .= '</div>';

        $html .= '</div>';

        // print
        echo '<div class="main-slider'.$type2.'">'.$line.$html.'</div>';
    }
}
