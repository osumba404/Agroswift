<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Team_Slider extends Widget_Base {

    public function get_name() {
        return 'agrikon-team-slider';
    }
    public function get_title() {
        return 'Team Slider (N)';
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
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'team_slider_settings',
            [
                'label' => esc_html__('General', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'toptitleimage',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .block-title__image',
            ]
        );
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Section Subtitle', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'meet the team',
                'label_block' => true,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Expert Farmers',
                'label_block' => true,
            ]
        );
        $this->add_control( 'tag',
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
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Section Description', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum is simply free text available. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum.',
                'label_block' => true,
            ]
        );
        $this->add_control( 'bgimage',
            [
                'label' => esc_html__( 'Bottom Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail2',
            'default' => 'agrikon-square'
            ]
        );
        $this->add_control( 'rippedimg_heading',
            [
                'label' => esc_html__( 'BOTTOM RIPPED IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'rippedimage',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .team-one::after',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'items_settings',
            [
                'label' => esc_html__('Team Items', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sam Peters',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'pos',
            [
                'label' => esc_html__( 'Position', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'CEO Solar Systems LLC',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_control( 'items',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{name}}',
                'default' => [
                    [
                        'name' => 'Jessica Brown',
                        'pos' => 'Customer',
                        'text' => 'This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur.'
                    ],
                    [
                        'name' => 'Caleb Hoffman',
                        'pos' => 'Customer',
                        'text' => 'This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur.'
                    ],
                    [
                        'name' => 'Bradley Kim',
                        'pos' => 'Customer',
                        'text' => 'This is due to their excellent service, competitive pricing and customer support. It’s throughly refresing to get such a personal touch. Duis aute lorem ipsum is simply free text irure dolor in reprehenderit in esse nulla pariatur.'
                    ]
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail3',
            ]
        );
        $this->add_control( 'ntag',
            [
                'label' => esc_html__( 'Name Tag', 'agrikon' ),
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
                ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View ( Desktop )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View ( Tablet )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View  ( Mobile )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'delay',
            [
                'label' => esc_html__( 'Autoplay Delay', 'agrikon' ),
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
                'default' => 'yes',
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'nav',
            [
                'label' => esc_html__( 'Dots', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Space Between Items', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('style_section',
            [
                'label'=> esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'section_heading',
            [
                'label' => esc_html__( 'SECTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'secbg_color',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-one' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'sec_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .team-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'subtitle_heading',
            [
                'label' => esc_html__( 'SECTION SUBTITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'subtitle_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .block-title p' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .block-title p'
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'SECTION TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team_slider-one__title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team_slider-one__title'
            ]
        );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'SECTION DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-one__summery p' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team-one__summery p'
            ]
        );
        $this->add_control( 'socials_heading',
            [
                'label' => esc_html__( 'SOCIALS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a:hover' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'icon_bgcolor',
            [
                'label' => esc_html__( 'Overlay Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__image::before' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'name_heading',
            [
                'label' => esc_html__( 'NAME', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'name_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team_slider-one__metas .name' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team_slider-one__metas .name'
            ]
        );
        $this->add_control( 'pos_heading',
            [
                'label' => esc_html__( 'POSITION / JOB', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'pos_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team_slider-one__meta span' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pos_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team_slider-one__meta span'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('navs_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'navs_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next,
                    {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'navs_space',
            [
                'label' => esc_html__( 'Space', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev' => 'margin-right:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'navs_nav_tabs');
        $this->start_controls_tab( 'navs_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'navs_bgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next,
                    {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navs_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next, {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev',
            ]
        );
        $this->add_responsive_control( 'navs_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next,
                    {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'navs_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'navs_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next:hover,
                    {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev:hover' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navs_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next:hover, {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev:hover',
            ]
        );
        $this->add_responsive_control( 'navs_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .team-one__content .team-one__nav .swiper-button-next:hover,
                    {{WRAPPER}} .team-one__content .team-one__nav .swiper-button-prev:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = $this->get_id();

        $delay     = $settings['delay'] ? $settings['delay'] : 5000;
        $perview   = $settings['perview'] ? $settings['perview'] : 3;
        $mdperview = $settings['mdperview'] ? $settings['mdperview'] : 2;
        $smperview = $settings['smperview'] ? $settings['smperview'] : 1;
        $space     = $settings['space'] ? $settings['space'] : 30;
        $autoplay  = 'yes' == $settings['autoplay'] ? '{ "delay": '.$delay.' }' : 'false';
        $loop      = 'yes' == $settings['loop'] ? 'true' : 'false';

        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size2 ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }
        $size3 = $settings['thumbnail3_size'] ? $settings['thumbnail3_size'] : 'full';
        if ( 'custom' == $size3 ) {
            $sizew3 = $settings['thumbnail3_custom_dimension']['width'];
            $sizeh3 = $settings['thumbnail3_custom_dimension']['height'];
            $size3 = [ $sizew3, $sizeh3 ];
        }
        echo '<div class="team-one">';
            if ( $settings['bgimage']['url'] ) {
                echo wp_get_attachment_image( $settings['bgimage']['id'], $size2, false, ['class'=>'team-one__bg'] );
            }
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-md-12 col-lg-12 col-xl-5">';
                        echo '<div class="team-one__content">';
                            echo '<div class="block-title">';
                                echo '<div class="block-title__image"></div>';
                                if ( $settings['subtitle'] ) {
                                    echo '<p class="title">'.$settings['subtitle'].'</p>';
                                }
                                if ( $settings['title'] ) {
                                    echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                                }
                            echo '</div>';
                            if ( $settings['desc'] ) {
                                echo '<div class="team-one__summery">';
                                    echo '<p>'.$settings['desc'].'</p>';
                                echo '</div>';
                            }
                            echo '<div class="team-one__nav">';
                                echo '<div class="swiper-button-prev" id="team-one__swiper-button-next"><i class="agrikon-icon-left-arrow"></i></div>';
                                echo '<div class="swiper-button-next" id="team-one__swiper-button-prev"><i class="agrikon-icon-right-arrow"></i></div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            echo '<div class="team-one__carousel-wrap">';
                echo '<div class="thm-swiper__slider swiper-container" data-swiper-options=\'{"loop": '.$loop.',"spaceBetween": 0, "slidesPerView": 1, "slidesPerGroup": 1, "autoplay": '.$autoplay.', "navigation": {"nextEl": "#team-one__swiper-button-next","prevEl": "#team-one__swiper-button-prev"},"breakpoints": {"0": {"spaceBetween": 0,"slidesPerView": '.$smperview.',"slidesPerGroup": '.$smperview.'},"768": {"spaceBetween": '.$space.',"slidesPerView": '.$mdperview.',"slidesPerGroup": '.$mdperview.'},"1024": {"spaceBetween": '.$space.',"slidesPerView": '.$perview.',"slidesPerGroup": '.$perview.'}}}\'>';
                    echo '<div class="swiper-wrapper">';
                        foreach ( $settings['items'] as $item ) {
                            echo '<div class="swiper-slide">';
                                echo '<div class="team-card">';
                                    echo '<div class="team-card__image">';
                                        echo wp_get_attachment_image( $item['image']['id'], $size3, false, ['class'=>'t-img'] );
                                        if ( !empty( $item['socials'] ) ) {
                                            echo '<div class="team-card__social">'.$item['socials'].'</div>';
                                        }
                                    echo '</div>';
                                    if ( !empty( $item['name'] ) ) {
                                        echo '<'.$settings['ntag'].' class="name">'.$item['name'].'</'.$settings['ntag'].'>';
                                    }
                                    if ( !empty( $item['pos'] ) ) {
                                        echo '<p>'.$item['pos'].'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
