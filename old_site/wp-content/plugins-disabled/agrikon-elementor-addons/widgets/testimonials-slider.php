<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Testimonials extends Widget_Base {
    public function get_name() {
        return 'agrikon-testimonials';
    }
    public function get_title() {
        return 'Testimonials Carousel (N)';
    }
    public function get_icon() {
        return 'eicon-testimonial';
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
        $this->start_controls_section( 'testimonials_settings',
            [
                'label' => esc_html__('General', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Testimonials',
                'label_block' => true,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'agrikon' ),
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
        $this->add_control( 'bgimage',
            [
                'label' => esc_html__( 'Background Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            ]
        );
        $this->add_control( 'rippedimg_heading',
            [
                'label' => esc_html__( 'TOP / BOTTOM IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'topimage',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .testimonials-one::before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'botimage',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .testimonials-one::after',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'items_settings',
            [
                'label' => esc_html__('Testimonials Items', 'agrikon'),
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
        $repeater->add_control( 'text',
            [
                'label' => esc_html__( 'Quote', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Avatar', 'agrikon' ),
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
            'name' => 'thumbnail2',
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
        $this->add_control( 'stars',
            [
                'label' => esc_html__( 'Stars', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
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
        $this->add_control( 'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials-one' => 'background-color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'text_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .testimonials-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'selectors' => [ '{{WRAPPER}} .testimonials-one__title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonials-one__title'
            ]
        );
        $this->add_control( 'text_heading',
            [
                'label' => esc_html__( 'NAME', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stars_color',
            [
                'label' => esc_html__( 'Stars Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials-one__carousel .testimonials-one__icons i' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'text_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials-one__carousel p' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonials-one__carousel p'
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
                'selectors' => [ '{{WRAPPER}} .testimonials-one__metas .name' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonials-one__metas .name'
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
                'selectors' => [ '{{WRAPPER}} .testimonials-one__meta span' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pos_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .testimonials-one__meta span'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('dots_style_section',
            [
                'label'=> esc_html__( 'Dots Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'dots_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'dots_space',
            [
                'label' => esc_html__( 'Space', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet' => 'margin-left:{{SIZE}}px;margin-right:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'dots_nav_tabs');
        $this->start_controls_tab( 'dots_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'dots_bgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dots_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet',
            ]
        );
        $this->add_responsive_control( 'dots_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'dots_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'dots_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet:hover,
                    {{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet-active' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dots_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet:hover, {{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet-active',
            ]
        );
        $this->add_responsive_control( 'dots_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet:hover,
                    {{WRAPPER}} .testimonials-one__swiper-pagination .swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }
        echo '<div class="testimonials-one">';
            if ( $settings['bgimage']['url'] ) {
                echo wp_get_attachment_image( $settings['bgimage']['id'], $size, false, ['class'=>'testimonials-one__bg'] );
            }
            echo '<div class="container">';
                if ( $settings['title'] ) {
                    echo '<'.$settings['tag'].' class="testimonials-one__title">'.$settings['title'].'</'.$settings['tag'].'>';
                }
                echo '<div class="testimonials-one__quote testimonials-one__carousel swiper-container">';
                    echo '<div class="swiper-wrapper">';
                        foreach ( $settings['items'] as $item ) {
                            echo '<div class="swiper-slide">';
                                if ( 'yes' == $settings['stars'] ) {
                                    echo '<div class="testimonials-one__icons">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star">
                                    </i><i class="fas fa-star">
                                    </i><i class="fas fa-star">
                                    </i><i class="fas fa-star"></i>
                                    </div>';
                                }
                                if ( $item['text'] ) {
                                    echo '<p class="text">'.$item['text'].'</p>';
                                }
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';

                if ( !empty( $settings['items'] ) ) {
                    echo '<div class="swiper-container testimonials-one__thumb">';
                        echo '<div class="swiper-wrapper">';
                            foreach ( $settings['items'] as $item ) {
                                echo '<div class="swiper-slide">';
                                    echo '<div class="testimonials-one__image">';
                                        echo wp_get_attachment_image( $item['image']['id'], $size, false, ['class'=>'t-img'] );
                                    echo '</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                }

                echo '<div class="testimonials-one__metas testimonials-one__carousel swiper-container">';
                    echo '<div class="swiper-wrapper">';
                        foreach ( $settings['items'] as $item ) {
                            echo '<div class="swiper-slide">';
                                echo '<div class="testimonials-one__meta">';
                                    if ( $item['name'] ) {
                                        echo '<'.$settings['ntag'].' class="name">'.$item['name'].'</'.$settings['ntag'].'>';
                                    }
                                    if ( $item['pos'] ) {
                                        echo '<span>'.$item['pos'].'</span>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<div class="swiper-pagination testimonials-one__swiper-pagination"></div>';
            echo '</div>';
        echo '</div>';
    }
}
