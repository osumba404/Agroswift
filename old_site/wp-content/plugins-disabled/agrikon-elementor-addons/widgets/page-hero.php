<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Page_Hero extends Widget_Base {
    public function get_name() {
        return 'agrikon-page-hero';
    }
    public function get_title() {
        return 'Post / Page Hero (N)';
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
        $this->start_controls_section( 'agrikon_page_hero_settings',
            [
                'label'=> esc_html__( 'Text', 'agrikon' ),
                'tab'=> Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'title_type',
            [
                'label' => esc_html__( 'Title Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'page',
                'options' => [
                    'page' => esc_html__( 'Page Title', 'agrikon' ),
                    'custom' => esc_html__( 'Custom Text', 'agrikon' )
                ]
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => get_the_title(),
                'label_block' => true,
                'condition' => [ 'title_type' => 'custom' ],
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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'custom_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'description' => esc_html__( 'You can use this option for different image sizes on different devices.', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .page-header__bg',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hide_bread',
            [
                'label' => esc_html__( 'Hide Breadcrumbs', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'bread_pos',
            [
                'label' => esc_html__( 'Breadcrumbs', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__( 'Before Title', 'agrikon' ),
                    'after' => esc_html__( 'After Title', 'agrikon' ),
                ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_control( 'ripped_img',
            [
                'label' => esc_html__( 'BOTTOM RIPPED IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hide_ripped',
            [
                'label' => esc_html__( 'Hide Bottom Ripped Image', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'rippedimage',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic' ],
                'selector' => '{{WRAPPER}} .page-header::after',
                'condition' => ['hide_ripped!' => 'yes']
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
        $this->add_control( 'hero_heading',
            [
                'label' => esc_html__( 'CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'hero_minh',
            [
                'label' => esc_html__( 'Min Height ( vh )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .page-header' => 'height:{{SIZE}}vh;',
                    '{{WRAPPER}} .page-header .container' => 'padding-top:0;padding-bottom:0;',
                ],
            ]
        );
        $this->add_responsive_control( 'hero_vertical',
            [
                'label' => esc_html__( 'Vertical Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .page-header' => 'display:flex;align-items:{{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'eicon-v-align-middle'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'hero_horizontal',
            [
                'label' => esc_html__( 'Text Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [
                    '{{WRAPPER}} .page-header .container' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .page-header .thm-breadcrumb' => 'display: inline-flex;',
                ],
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
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-header .page-title' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .page-header .page-title'
            ]
        );
        $this->add_responsive_control( 'title_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .page-header .page-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'bread_heading',
            [
                'label' => esc_html__( 'BREADCRUMBS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_control( 'bread_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-breadcrumb li' => 'color:{{VALUE}};' ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_control( 'bread_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-breadcrumb li a:hover' => 'color:{{VALUE}};' ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_control( 'bread_actcolor',
            [
                'label' => esc_html__( 'Current Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-breadcrumb .breadcrumb_active' => 'color:{{VALUE}};' ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_control( 'bread_sepcolor',
            [
                'label' => esc_html__( 'Separator Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .thm-breadcrumb li.breadcrumb_link_seperator' => 'color:{{VALUE}};' ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->add_responsive_control( 'bread_offset',
            [
                'label' => esc_html__( 'Offset', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .page-header.bread-before .thm-breadcrumb' => 'margin-bottom:{{SIZE}}px;' ],
                'selectors' => [ '{{WRAPPER}} .page-header.bread-after .thm-breadcrumb' => 'margin-top:{{SIZE}}px;' ],
                'condition' => ['hide_bread!' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = $this->get_id();

        $thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        $imageurl  = empty( $settings['custom_bg_background'] ) && has_post_thumbnail() ? ' style="background-image: url('.$thumbnail.');' : '';
        $rippedoff  = 'yes' == $settings['hide_ripped'] ? ' ripped-off' : '';
        $bredafter  = 'after' == $settings['bread_pos'] ? ' bread-after' : '';

        echo '<div class="page-header'.$rippedoff.$bredafter.'">';
            echo '<div class="page-header__bg"'.$imageurl.'></div>';
            echo '<div class="container">';
                if ( 'yes' != $settings['hide_bread'] && 'before' == $settings['bread_pos'] ) {
                        agrikon_breadcrumbs();
                }
                if ( $settings['title_type'] == 'custom' ) {
                    if ( $settings['title'] ) {
                        echo '<'.$settings['tag'].' class="page-title">'.$settings['title'].'</'.$settings['tag'].'>';
                    }
                } else {
                    echo '<'.$settings['tag'].' class="page-title">'.get_the_title().'</'.$settings['tag'].'>';
                }
                if ( 'yes' != $settings['hide_bread'] && 'after' == $settings['bread_pos'] ) {
                        agrikon_breadcrumbs();
                }
            echo '</div>';
        echo '</div>';
    }
}
