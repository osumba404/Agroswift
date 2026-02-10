<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Interactive_Link_Slider extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-interactive-link-slider';
    }
    public function get_title() {
        return 'Interactive Link Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'interactive-link-slider', AGRIKON_PLUGIN_URL. 'widgets/interactive-link/style.css');
        wp_register_script( 'interactive-link-slider', AGRIKON_PLUGIN_URL. 'widgets/interactive-link/script.js');
    }
    public function get_style_depends() {
        return [ 'swiper', 'interactive-link-slider' ];
    }
    public function get_script_depends() {
        return [ 'swiper', 'interactive-link-slider' ];
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slide_settings',
            [
                'label' => esc_html__( 'Slides', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'slider_height',
            [
                'label' => esc_html__( 'Image Content Height', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','vh'],
                'range' => [
                    'vh' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .interactive-link-slider-wrapper, {{WRAPPER}} .gallery-top .swiper-slide' => 'height: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'slide_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => ['classic','gradient','video'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}'
            ]
        );
        $repeater->add_control( 'number',
            [
                'label' => esc_html__( 'Number', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '01',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'First Image Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Short Description', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Affogato steamed single shot',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'slide_bgcolor',
            [
                'label' => esc_html__( 'Slide Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};']
            ]
        );
        $repeater->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'See Details',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $this->add_control( 'slides',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_tag',
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
                    'span' => esc_html__( 'span', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_settings_section',
            [
                'label' => esc_html__( 'Slider Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 4
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View Tablet', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View Phone', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1
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
        $this->add_control( 'parallax',
            [
                'label' => esc_html__( 'Parallax', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'mousewheel',
            [
                'label' => esc_html__( 'Mousewheel', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slide_style_settings',
            [
                'label'=> esc_html__( 'Slide Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'border_color',
            [
                'label' => esc_html__( 'Vertical Line Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .gallery-thumbs.interactive-thumbs .swiper-slide:not(:first-child)' => 'border-left-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'number_heading',
            [
                'label' => esc_html__( 'NUMBER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-number' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'number_typo','{{WRAPPER}} .slide-item-number' );
        $this->agrikon_style_background( 'number_background','{{WRAPPER}} .slide-item-number' );
        $this->agrikon_style_padding( 'number_padding','{{WRAPPER}} .slide-item-number' );
        $this->agrikon_style_margin( 'number_margin','{{WRAPPER}} .slide-item-number' );
        $this->agrikon_style_border( 'number_border','{{WRAPPER}} .slide-item-number' );
        $this->agrikon_style_text_shadow( 'number_txtshadow','{{WRAPPER}} .slide-item-number' );
        $this->add_control( 'number_line_color',
            [
                'label' => esc_html__( 'Line Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-number.stroke-text:before' => 'background-color: {{VALUE}};'],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'number_line_left',
            [
                'label' => esc_html__( 'Line Left Offset', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -300,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-number.stroke-text:before' => 'left: {{SIZE}}px;']
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
                'selectors' => ['{{WRAPPER}} .slide-item-title' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'title_typo','{{WRAPPER}} .slide-item-title' );
        $this->agrikon_style_background( 'title_background','{{WRAPPER}} .slide-item-title' );
        $this->agrikon_style_padding( 'title_padding','{{WRAPPER}} .slide-item-title' );
        $this->agrikon_style_margin( 'title_margin','{{WRAPPER}} .slide-item-title' );
        $this->agrikon_style_border( 'title_border','{{WRAPPER}} .slide-item-title' );
        $this->agrikon_style_text_shadow( 'title_txtshadow','{{WRAPPER}} .slide-item-title' );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-text' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'desc_typo','{{WRAPPER}} .slide-item-text' );
        $this->agrikon_style_background( 'desc_background','{{WRAPPER}} .slide-item-text' );
        $this->agrikon_style_padding( 'desc_padding','{{WRAPPER}} .slide-item-text' );
        $this->agrikon_style_margin( 'desc_margin','{{WRAPPER}} .slide-item-text' );
        $this->agrikon_style_border( 'desc_border','{{WRAPPER}} .slide-item-text' );
        $this->agrikon_style_text_shadow( 'desc_txtshadow','{{WRAPPER}} .slide-item-text' );
        $this->add_control( 'btn_heading',
            [
                'label' => esc_html__( 'BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'btn_hvroverlay',
            [
                'label' => esc_html__( 'Overlay Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-footer .slide-item-btn:after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'btn_typo','{{WRAPPER}} .slide-item-footer .slide-item-btn' );
        $this->agrikon_style_padding( 'btn_padding','{{WRAPPER}} .slide-item-footer .slide-item-btn' );
        $this->agrikon_style_margin( 'btn_margin','{{WRAPPER}} .slide-item-footer .slide-item-btn' );
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-footer .slide-item-btn' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-footer .slide-item-btn' => 'background-color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_border( 'btn_border','{{WRAPPER}} .slide-item-footer .slide-item-btn' );
        $this->end_controls_tab();
        $this->start_controls_tab('btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-footer .slide-item-btn:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide-item-footer .slide-item-btn:hover' => 'background-color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_border( 'btn_hvrborder','{{WRAPPER}} .slide-item-footer .slide-item-btn:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $sattr = array();
        $sattr[] = $settings['speed'] ? '"speed":'.$settings['speed'] : '"speed":1000';
        $sattr[] = $settings['perview'] ? '"perview":'.$settings['perview'] : '"perview":4';
        $sattr[] = $settings['mdperview'] ? '"mdperview":'.$settings['mdperview'] : '"speed":3';
        $sattr[] = $settings['smperview'] ? '"smperview":'.$settings['smperview'] : '"smperview":2';
        $sattr[] = 'yes' == $settings['autoplay'] ? '"autoplay":true' : '"autoplay":false';
        $sattr[] = 'yes' == $settings['mousewheel'] ? '"mousewheel":true' : '"mousewheel":false';
        $sattr[] = 'yes' == $settings['parallax'] ? '"parallax":true' : '"parallax":false';

        $html = '';
        $html .= '<div class="swiper-container gallery-top interactive-top">';
            $html .= '<div class="swiper-wrapper">';

                foreach ( $settings['slides'] as $item ) {
                    $html .= '<div class="swiper-slide">';
                        $html .= '<div class="bg-cover vert-align elementor-repeater-item-' . $item['_id'] . '"></div>';
                    $html .= '</div>';
                }

            $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="swiper-container gallery-thumbs interactive-thumbs">';
            $html .= '<div class="swiper-wrapper">';

                foreach ( $settings['slides'] as $item ) {
                    $html .= '<div class="swiper-slide">';
                        $html .= '<div class="slide-content-info">';
                            $html .= '<div class="slide-item-body">';
                                if ( !empty( $item['number'] ) ) {
                                    $html .= '<div class="slide-item-number stroke-text">'.$item['number'].'</div>';
                                }
                                if ( !empty( $item['title'] ) ) {
                                    $html .= '<'.$settings['title_tag'].' class="slide-item-title">'.$item['title'].'</'.$settings['title_tag'].'>';
                                }
                            $html .= '</div>';
                            $html .= '<div class="slide-item-footer">';
                                if ( !empty( $item['desc'] ) ) {
                                    $html .= '<p class="slide-item-text">'.$item['desc'].'</p>';
                                }
                                if ( !empty( $item['btn_title'] ) ) {
                                    $target   = !empty( $settings['link']['is_external'] ) ? ' target="_blank"' : '';
                                    $nofollow = !empty( $settings['link']['nofollow'] ) ? ' rel="nofollow"' : '';
                                    $html .= '<a class="slide-item-btn" href="'.$item['link']['url'].'"'.$target.$nofollow.'>'.$item['btn_title'].'</a>';
                                }

                            $html .= '</div>';
                        $html .= '</div>';
                    $html .= '</div>';
                }

            $html .= '</div>';
            $html .= '<div class="swiper-nav-wrapper">';
                $html .= '<div class="swiper-nav-ctrl prev-ctrl"><i class="fas fa-caret-left"></i></div>';
                $html .= '<div class="swiper-nav-ctrl next-ctrl"><i class="fas fa-caret-right"></i></div>';
            $html .= '</div>';
        $html .= '</div>';

        // print template
        echo '<div class="interactive-link-slider-wrapper" data-slider-settings=\'{'.implode(',',$sattr).'}\'>'.$html.'</div>';
    }

}
