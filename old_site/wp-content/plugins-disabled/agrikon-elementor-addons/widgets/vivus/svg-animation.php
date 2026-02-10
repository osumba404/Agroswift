<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Svg_Animation extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-svg-animation';
    }
    public function get_title() {
        return 'SVG ICON ANIMATION (N)';
    }
    public function get_icon() {
        return 'eicon-favorite';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'agrikon-vivus', AGRIKON_PLUGIN_URL. 'widgets/vivus/style.css');
        wp_register_script( 'agrikon-vivus', AGRIKON_PLUGIN_URL. 'widgets/vivus/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'agrikon-vivus' ];
    }
    public function get_script_depends() {
        return [ 'vivus','scrollmagic','agrikon-vivus' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('agrikon_flip_card_general_settings',
            [
                'label' => esc_html__( 'SVG Settings', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'container_w',
            [
                'label' => esc_html__( 'SVG Width', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 4000,
                'step' => 1,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .infographic-svg' => 'width:{{SIZE}}px;'],
            ]
        );
        $this->add_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center',
                'selectors' => [ '{{WRAPPER}} .infographic-icon' => 'justify-content:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svgimage',
            [
                'label' => esc_html__( 'Svg Icon URL', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [''],
            ]
        );
        $this->add_control( 'duration',
            [
                'label' => esc_html__( 'Duration', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 10000,
                'step' => 1,
                'default' => 100,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'playonce',
            [
                'label' => esc_html__( 'Play Once?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'reverse',
            [
                'label' => esc_html__( 'Replay on Scroll?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['playonce!' => 'yes']
            ]
        );
        $this->add_control( 'use_grad',
            [
                'label' => esc_html__( 'Use Gradient Color?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stroke_clr1',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#f84f77',
            ]
        );
        $this->add_control( 'stroke_clr2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#1BAAA0',
                'condition' => ['use_grad' => 'yes']
            ]
        );
        $this->add_control( 'grad_offset',
            [
                'label' => esc_html__( 'Gradient Offset', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ '%' => [ 'min' => 0,'max' => 100 ] ],
                'condition' => ['use_grad' => 'yes']
            ]
        );
        $this->add_control( 'stroke_w',
            [
                'label' => esc_html__( 'Stroke Width', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 1,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'use_fill',
            [
                'label' => esc_html__( 'Fill Color ( after animation finish )', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'use_fill_grad',
            [
                'label' => esc_html__( 'Use Gradient?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['use_fill' => 'yes']
            ]
        );
        $this->add_control( 'fill',
            [
                'label' => esc_html__( 'Fill Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'conditions' => [
                     'relation' => 'and',
                     'terms' => [
                         [
                             'name' => 'use_fill',
                             'operator' => '==',
                             'value' => 'yes'
                         ],
                         [
                             'name' => 'use_fill_grad',
                             'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                             'value' => 'yes'
                         ]
                     ]
                 ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $svg = esc_url( $settings['svgimage']['url'] );
        $stroke_clr = 'yes' == $settings['use_grad'] ? 'url( #nt-grad-svg-'.$id.' )' : $settings['stroke_clr1'];
        $fill = 'yes' == $settings['use_fill_grad'] ? ',"fill":"url(#nt-grad-svg-'.$id.')"' : ',"fill":"'.$settings['fill'].'"';
        $fill = 'yes' == $settings['use_fill'] ? $fill : '';
        $hasfill = 'yes' == $settings['use_fill'] ? ' has-fill-color' : '';
        $reverse = 'yes' == $settings['reverse'] ? 'true' : 'false';
        $playonce = 'yes' == $settings['playonce'] ? 'true' : 'false';
        $strk_w = $settings['stroke_w'];
        $grad_offset = !empty( $settings['grad_offset']['size'] ) ? $settings['grad_offset']['size'] : 100;
        $duration = $settings['duration'] ? $settings['duration'] : 100;
        if ( $settings['svgimage']['url'] ) {

            echo '<div id="nt-svg-'.$id.'" class="infographic-icon'.$hasfill.'" data-svg-settings=\'{"svg":"'.$svg.'","duration":'.$duration.',"playonce":'.$playonce.',"reverse":'.$reverse.',"stroke":"'.$stroke_clr.'", "stroke_width":"'.$strk_w.'"'.$fill.'}\'></div>';
            if ( 'yes' == $settings['use_grad'] ) {
                echo '<svg width="0" height="0">
                <defs>
                <linearGradient id="nt-grad-svg-'.$id.'" gradientUnits="objectBoundingBox" x1="0" y1="0" x2="1" y2="1">
                <stop stop-color="'.$settings['stroke_clr1'].'"/>
                <stop offset="'.$grad_offset.'%" stop-color="'.$settings['stroke_clr2'].'"/>
                </linearGradient>
                </defs>
                </svg>';
            }
        }
    }
}
