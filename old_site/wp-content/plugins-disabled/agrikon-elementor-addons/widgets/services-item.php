<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Services_Item extends Widget_Base {
    public function get_name() {
        return 'agrikon-services-item';
    }
    public function get_title() {
        return 'Services Item (N)';
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
        $this->start_controls_section( 'services_settings',
            [
                'label' => esc_html__('Services Item', 'agrikon')
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Teype', 'agrikon' ),
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
                'default' => 'full',
                'condition' => [ 'image[url]!' => '' ],
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'agrikon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Agriculture Products',
                'label_block' => true
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
                ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Lorem ium dolor sit ametad pisicing elit sed simply do ut.',
                'label_block' => true,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'agrikon' ),
                'condition' => ['title!' => '']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'box_heading',
            [
                'label' => esc_html__( 'BOX', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'box',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .service-one__box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'selector' => '{{WRAPPER}} .title'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .title' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-one__box-content .title a:hover' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'title_bg',
            [
                'label' => esc_html__( 'Title Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-one__box-content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-one__box-content',
            ]
        );
        $this->add_responsive_control( 'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-one__box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-one__box > img',
            ]
        );
        $this->add_responsive_control( 'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-one__box > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style2_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'box2_heading',
            [
                'label' => esc_html__( 'TEXT CONTENT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'box_bxshdw',
            [
                'label' => esc_html__( 'Hover Bottom Shadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover' => '-webkit-box-shadow:0 4px 0 0 {{VALUE}};box-shadow:0 4px 0 0 {{VALUE}};' ],
            ]
        );
        $this->add_control( 'textbox_heading',
            [
                'label' => esc_html__( 'TEXT CONTENT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control( 'text_bg',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_responsive_control( 'text_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_responsive_control( 'textbox_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [ '{{WRAPPER}} .service-two__card-content' => 'text-align: {{VALUE}};' ],
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
        $this->add_control( 'icon_heading',
            [
                'label' => esc_html__( 'ICON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .service-two__card-icon' => 'font-size: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'icon_bg',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-icon' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card-icon',
            ]
        );
        $this->add_responsive_control( 'icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'title2_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title2_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title'
            ]
        );
        $this->add_control( 'title2_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content .title' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'title2_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content .title a:hover' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_responsive_control( 'title2_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'title2_maxw',
            [
                'label' => esc_html__( 'Max Width', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .service-two__card-content .title' => 'max-width: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .service-two__card-content p'
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content p' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
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

        if ( '1' == $settings['type'] ) {

            echo '<div class="service-one__box">';
                if ( $settings['image']['url'] ) {
                    echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'s-img'] );
                }
                echo '<div class="service-one__box-content">';
                if ( $settings['title'] ) {
                    if ( $settings['link']['url'] ) {
                        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                        $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<'.$settings['tag'].' class="title"><a href="'.esc_url( $settings['link']['url'] ).'"'.$target.$rel.'>'.$settings['title'].'</a></'.$settings['tag'].'>';
                    } else {
                        echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                    }
                }
                echo '</div>';
            echo '</div>';

        } else {

            echo '<div class="service-two__card">';
                if ( $settings['image']['url'] ) {
                    echo '<div class="service-two__card-image">';
                        echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'s-img'] );
                    echo '</div>';
                }
                echo '<div class="service-two__card-content">';
                    if ( !empty( $settings['icon']['value'] ) ) {
                        echo '<div class="service-two__card-icon">';
                            Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</div>';
                    }
                    if ( $settings['link']['url'] ) {
                        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
                        $rel = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
                        echo '<'.$settings['tag'].' class="title"><a href="'.esc_url( $settings['link']['url'] ).'"'.$target.$rel.'>'.$settings['title'].'</a></'.$settings['tag'].'>';
                    } else {
                        echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                    }
                    if ( $settings['desc'] ) {
                        echo '<p>'.$settings['desc'].'</p>';
                    }
                echo '</div>';
            echo '</div>';
        }
    }
}
