<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Two_Block_Slider extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-two-block-slider';
    }
    public function get_title() {
        return 'Two Block Slider (N)';
    }
    public function get_icon() {
        return 'eicon-tabs';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'agrikon-two-block-slider', AGRIKON_PLUGIN_URL. 'widgets/two-block-slider/style.css');
        wp_register_script( 'custom-modernizr', AGRIKON_PLUGIN_URL. 'widgets/two-block-slider/modernizr.js', [ 'jquery' ], '1.0.0', false);
        wp_register_script( 'agrikon-two-block-slider', AGRIKON_PLUGIN_URL. 'widgets/two-block-slider/script.js', [  'jquery','elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'agrikon-two-block-slider' ];
    }
    public function get_script_depends() {
        return [ 'custom-modernizr','velocity', 'agrikon-two-block-slider' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_two_block_slider_settings',
            [
                'label' => esc_html__( 'Content', 'agrikon'),
            ]
        );
        $this->add_control( 'prev',
            [
                'label' => esc_html__('Prev Text', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Prev', 'agrikon'),

            ]
        );
        $this->add_control( 'next',
            [
                'label' => esc_html__('Next Text', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Next', 'agrikon'),

            ]
        );
        $this->add_control( 'close',
            [
                'label' => esc_html__('Close Text', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Next', 'agrikon'),

            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'left_heading',
            [
                'label' => esc_html__( 'LEFT BLOCK', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_control('tab_title',
            [
                'label' => esc_html__('Tab Title', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab Title', 'agrikon'),
                'label_block' => true
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
                'condition' => ['tab_title!' => '']
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_img',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .nt-image-block > ul > {{CURRENT_ITEM}}',
            ]
        );
        $repeater->add_control( 'right_heading',
            [
                'label' => esc_html__( 'RIGHT BLOCK', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $repeater->add_control('tab_content_bgclr',
            [
                'label' => esc_html__('Content Background Color', 'agrikon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-content-block > ul > {{CURRENT_ITEM}}' => 'background-color:{{VALUE}};'],
                'condition' => [ 'content_type' => 'content' ]
            ]
        );
        $repeater->add_control('content_type',
            [
                'label' => esc_html__('Content Type', 'agrikon'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => esc_html__('Content', 'agrikon'),
                    'template' => esc_html__('Saved Templates', 'agrikon'),
                ],
                'default' => 'content'
            ]
        );
        $repeater->add_control('primary_templates',
            [
                'label' => esc_html__('Choose Template', 'agrikon'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->agrikon_get_elementor_templates(),
                'condition' => [ 'content_type' => 'template' ]
            ]
        );
        $repeater->add_control('tab_content',
            [
                'label' => esc_html__('Content', 'agrikon'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. Nunc tincidunt leo a mauris volutpat lobortis. Phasellus tristique libero et maximus imperdiet.', 'agrikon'),
                'dynamic' => ['active' => true],
                'condition' => [ 'content_type' => 'content' ]
            ]
        );
        $this->add_control( 'two_block_tabs',
            [
                'label' => esc_html__( 'Slide Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{tab_title}}',
                'separator' => 'before',
                'default' => [
                    [
                        'content_type' => 'content',
                        'tab_title' => 'Project #1',
                        'tab_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. </p>'
                    ],
                    [
                        'content_type' => 'content',
                        'tab_title' => 'Project #2',
                        'tab_content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et lacus libero. </p>'
                    ],
                ]
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('two_block_style_section',
            [
                'label'=> esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'container_heading',
            [
                'label' => esc_html__( 'CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'slider_height',
            [
                'label' => esc_html__( 'Height ( % )', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'vh' => ['min' => 0,'max' => 100 ] ],
                'selectors' => [ '{{WRAPPER}} .nt-image-block, {{WRAPPER}} .nt-content-block' => 'height: {{SIZE}}vh;' ]
            ]
        );
        $this->add_control( 'leftblock_heading',
            [
                'label' => esc_html__( 'LEFT BLOCK', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'left_width',
            [
                'label' => esc_html__( 'Width ( % )', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ '%' => ['min' => 0,'max' => 100 ] ],
                'selectors' => [
                    '{{WRAPPER}} .nt-image-block' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .block-navigation' => 'width: {{SIZE}}%;',
                    '{{WRAPPER}} .nt-content-block' => 'width: calc( 100% - {{SIZE}}% );'
                ]
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-images-list .title' => 'color:{{VALUE}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .nt-images-list .title'
            ]
        );
        $this->add_control( 'rightblock_heading',
            [
                'label' => esc_html__( 'RIGHT BLOCK', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'text_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-content-block, {{WRAPPER}} .nt-content-block p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .nt-content-block, {{WRAPPER}} .nt-content-block p'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'right_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .nt-content-block > ul > li',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $count = 1;
        $counttwo = 1;
        echo '<div class="nt-two-block-wrapper">';
            echo '<div class="nt-image-block">';
                echo '<ul class="nt-images-list">';
                    foreach ( $settings[ 'two_block_tabs' ] as $tab ) {
                        $is_active = 1 == $count ? ' is-selected' : '';
                       echo '<li class="elementor-repeater-item-'.$tab['_id'].$is_active.'">';
                           if ( $tab['tab_title'] ) {
                               echo '<a href="#0"><'.$tab['tag'].' class="title">'.$tab['tab_title'].'</'.$tab['tag'].'></a>';
                           }
                       echo '</li>';
                        $count++;
                    }
                echo '</ul>';
            echo '</div>';

            echo '<div class="nt-content-block">';
                echo '<ul>';
                    foreach ($settings['two_block_tabs'] as $tab) {
                        $is_active = 1 == $counttwo ? ' is-selected' : '';
                        echo '<li class="elementor-repeater-item-'.$tab['_id'].$is_active.'">';
                            if ( 'template' == $tab['content_type'] && !empty( $tab['primary_templates'] ) ) {
                                $template_id = $tab['primary_templates'];
                                $agrikon_frontend = new Frontend;
                                echo $agrikon_frontend->get_builder_content($template_id, true);
                            } else {
                                echo do_shortcode( $tab['tab_content'] );
                            }
                        echo '</li>';
                        $counttwo++;
                    }
                echo '</ul>';
                echo '<div class="nt-close">'.$settings[ 'close' ].'</div>';
            echo '</div>';

            echo '<ul class="block-navigation">';
                echo '<li><div class="buttons nt-prev inactive">&larr; '.$settings[ 'prev' ].'</div></li>';
                echo '<li><div class="buttons nt-next">'.$settings[ 'next' ].' &rarr;</div></li>';
            echo '</ul>';
        echo '</div>';

    }
}
