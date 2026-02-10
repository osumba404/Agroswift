<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_About_Two extends Widget_Base {
    public function get_name() {
        return 'agrikon-about-two';
    }
    public function get_title() {
        return 'About Two (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'about_two_settings',
            [
                'label' => esc_html__('About Images', 'agrikon')
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
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'agrikon-square',
                'condition' => [ 'image[url]!' => '' ],
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'Image 2', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'agrikon-square',
                'condition' => [ 'image2[url]!' => '' ],
            ]
        );
        $this->add_control( 'subtitle',
            [
                'label' => esc_html__( 'Subtitle', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Trusted by',
                'label_block' => true,
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Number', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '8900',
                'label_block' => true,
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Number Tag', 'agrikon' ),
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
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_shape',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .about-one__count',
                'separator' => 'before',
                'condition' => ['type' => '1']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'image1_heading',
            [
                'label' => esc_html__( 'IMAGE 1', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image1_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .about-two__images img.a-img:first-child',
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'image1_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .about-two__images img.a-img:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'image2_heading',
            [
                'label' => esc_html__( 'IMAGE 2', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image2_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .about-two__images img.a-img:nth-child(2)',
            ]
        );
        $this->add_responsive_control( 'image2_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .about-two__images img.a-img:nth-child(2)' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'HEADING', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .subtitle' => 'color:{{VALUE}};' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .title' => 'color:{{VALUE}};' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title',
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'bubble1_color',
            [
                'label' => esc_html__( 'Animated Bubble Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .about-two__images::before' => 'background-color:{{VALUE}};' ],
                'condition' => ['type' => '2'],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'bubble1_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .about-two__images::before' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
                'condition' => ['type' => '2']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size2 ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }

        if ( '2' == $settings['type'] ) {

            echo '<div class="about-two__images">';
                if ( $settings['image']['url'] ) {
                    echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'a-img'] );
                }
                if ( $settings['image2']['url'] ) {
                    echo wp_get_attachment_image( $settings['image2']['id'], $size2, false, ['class'=>'a-img'] );
                }
            echo '</div>';

        } else {

            echo '<div class="about-one__images">';
                if ( $settings['image']['url'] ) {
                    echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'a-img'] );
                }
                if ( $settings['image2']['url'] ) {
                    echo wp_get_attachment_image( $settings['image2']['id'], $size2, false, ['class'=>'a-img'] );
                }
                if ( $settings['subtitle'] || $settings['title'] ) {
                    echo '<div class="about-one__count wow fadeInLeft" data-wow-duration="1500ms">';
                        if ( $settings['subtitle'] ) {
                            echo '<span class="subtitle">'.$settings['subtitle'].'</span>';
                        }
                        if ( $settings['title'] ) {
                            echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                        }
                    echo '</div>';
                }
            echo '</div>';
        }


    }
}
