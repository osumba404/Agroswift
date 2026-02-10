<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Bubble_Image extends Widget_Base {
    public function get_name() {
        return 'agrikon-bubble-image';
    }
    public function get_title() {
        return 'Bubble Image (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'bubble_image_settings',
            [
                'label' => esc_html__('Bubble Image', 'agrikon')
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
        $this->add_control( 'hidebubble1',
            [
                'label' => esc_html__( 'Hide Bubble 1', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidebubble2',
            [
                'label' => esc_html__( 'Hide Bubble 2', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidebubble3',
            [
                'label' => esc_html__( 'Hide Bubble 3', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'bubble1_color',
            [
                'label' => esc_html__( 'Bubble 1 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .contact-two__image-bubble-1' => 'background-color:{{VALUE}};' ],
                'condition' => ['hidebubble1!' => 'yes']
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
                'selectors' => [ '{{WRAPPER}} .contact-two__image-bubble-1' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
                'condition' => ['hidebubble1!' => 'yes']
            ]
        );
        $this->add_control( 'bubble2_color',
            [
                'label' => esc_html__( 'Bubble 2 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .contact-two__image-bubble-2' => 'background-color:{{VALUE}};' ],
                'condition' => ['hidebubble2!' => 'yes']
            ]
        );
        $this->add_control( 'bubble2_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .contact-two__image-bubble-2' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
                'condition' => ['hidebubble2!' => 'yes']
            ]
        );
        $this->add_control( 'bubble3_color',
            [
                'label' => esc_html__( 'Bubble 3 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .contact-two__image-bubble-3' => 'background-color:{{VALUE}};' ],
                'condition' => ['hidebubble3!' => 'yes']
            ]
        );
        $this->add_control( 'bubble3_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .contact-two__image-bubble-3' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
                'condition' => ['hidebubble3!' => 'yes']
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
        echo '<div class="contact-two__image">';
            if ( 'yes' != $settings['hidebubble1'] ) {
                echo '<div class="contact-two__image-bubble-1"></div>';
            }
            if ( 'yes' != $settings['hidebubble2'] ) {
                echo '<div class="contact-two__image-bubble-2"></div>';
            }
            if ( 'yes' != $settings['hidebubble3'] ) {
                echo '<div class="contact-two__image-bubble-3"></div>';
            }
            if ( $settings['image']['url'] ) {
                echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'img-fluid c-img'] );
            }
        echo '</div>';
    }
}
