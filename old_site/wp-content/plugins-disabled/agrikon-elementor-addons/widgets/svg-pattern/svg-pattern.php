<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Svg_Pattern extends Widget_Base {

    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-svg-pattern';
    }
    public function get_title() {
        return 'Svg Pattern Text (N)';
    }
    public function get_icon() {
        return 'eicon-heading';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'agrikon-svg-pattern-css', AGRIKON_PLUGIN_URL. 'widgets/svg-pattern/style.css');
    }
    public function get_style_depends() {
        return [ 'agrikon-svg-pattern-css' ];
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('agrikon_svg_pattern_settings',
            [
                'label' => esc_html__( 'Text', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'style',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Style 1', 'agrikon' ),
                    '2' => esc_html__( 'Style 2', 'agrikon' ),
                    '3' => esc_html__( 'Style 3', 'agrikon' ),
                    '4' => esc_html__( 'Style 4', 'agrikon' ),
                    '5' => esc_html__( 'Style 5', 'agrikon' ),
                    '6' => esc_html__( 'Style 6', 'agrikon' ),
                    '7' => esc_html__( 'Style 7', 'agrikon' ),
                    '8' => esc_html__( 'Style 8', 'agrikon' ),
                    '9' => esc_html__( 'Style 9 - Fire', 'agrikon' ),
                    '10' => esc_html__( 'Style 10', 'agrikon' ),
                    '11' => esc_html__( 'Style 11', 'agrikon' ),
                    '12' => esc_html__( 'Style 12', 'agrikon' )
                ]
            ]
        );
        $this->add_control( 'img',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => '' ],
                'separator' => 'before',
                'conditions' => [
    				'relation' => 'or',
    				'terms' => [
    					[
    						'name' => 'style',
    						'operator' => '==',
    						'value' => '5'
    					],
    					[
    						'name' => 'style',
    						'operator' => '==',
    						'value' => '9'
    					]
    				]
    			]
            ]
        );

        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Input Text', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Pattern',
            ]
        );
        $this->agrikon_style_typo( 'svg_pattern_typo','{{WRAPPER}} .svg-pattern-wrapper' );
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('svg_pattern1_style_section',
            [
                'label' => esc_html__( 'Text Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '1' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'svg_pattern1_color',
                'label' => esc_html__( 'Stripe Color', 'agrikon' ),
                'types' => [ 'gradient'],
                'selector' => '{{WRAPPER}} .box-with-text',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern2_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '2' ]
            ]
        );
        $this->add_control( 'svg_pattern2_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 6,
				'selectors' => [ '{{WRAPPER}} .style-6 .text' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-6 .text' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_stroke_opacity',
            [
				'label' => esc_html__( 'Stroke Opacity', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.5,
				'selectors' => [ '{{WRAPPER}} .style-6 .text' => 'stroke-opacity:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-6 .g-spots circle:nth-child(5n + 1)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_color2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-6 .g-spots circle:nth-child(5n + 2)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-6 .g-spots circle:nth-child(5n + 3)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern2_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-6 .g-spots circle:nth-child(5n + 4)' => 'fill:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svg_pattern2_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-6 .g-spots circle:nth-child(5n + 5)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern3_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '3' ]
            ]
        );
        $this->add_control( 'svg_pattern3_duration',
            [
				'label' => esc_html__( 'Animation Duration', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 20,
				'step' => 1,
				'default' => 5,
            ]
        );
        $this->add_control( 'svg_pattern3_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'svg_pattern3_color2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'svg_pattern3_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'svg_pattern3_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'svg_pattern3_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern4_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '4' ]
            ]
        );
        $this->add_control( 'stroke_width4',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 3,
				'selectors' => [ '{{WRAPPER}} .style-8 .text' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern4_color0',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .text' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern4_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .g-stars polygon:nth-child(5n + 1)' => 'fill:{{VALUE}};stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern4_colo2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .g-stars polygon:nth-child(5n + 2)' => 'fill:{{VALUE}};stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern4_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .g-stars polygon:nth-child(5n + 3)' => 'fill:{{VALUE}};stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern4_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .g-stars polygon:nth-child(5n + 4)' => 'fill:{{VALUE}};stroke:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svg_pattern4_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-8 .g-stars polygon:nth-child(5n + 5)' => 'fill:{{VALUE}};stroke:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern5_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '5' ]
            ]
        );
        $this->add_control( 'svg_pattern5_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 8,
				'selectors' => [ '{{WRAPPER}} .style-9 .text' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern5_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-9 .text' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern5_stroke_opacity',
            [
				'label' => esc_html__( 'Stroke Opacity', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.5,
				'selectors' => [ '{{WRAPPER}} .style-9 .text' => 'stroke-opacity:{{SIZE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern6_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '6' ]
            ]
        );
        $this->add_control( 'svg_pattern6_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 6,
				'selectors' => [ '{{WRAPPER}} .style-10 .text' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern6_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#3F0B1B',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-10 .g-spots ellipse:nth-child(5n + 1)' => 'stroke:{{VALUE}};fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern6_colo2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#7A1631',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-10 .g-spots ellipse:nth-child(5n + 2)' => 'stroke:{{VALUE}};fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern6_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#CF423C',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-10 .g-spots ellipse:nth-child(5n + 3)' => 'stroke:{{VALUE}};fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern6_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FC7D49',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-10 .g-spots ellipse:nth-child(5n + 4)' => 'stroke:{{VALUE}};fill:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svg_pattern6_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffd462',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-10 .g-spots ellipse:nth-child(5n + 5)' => 'stroke:{{VALUE}};fill:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern7_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '7' ]
            ]
        );

        $this->add_control( 'svg_pattern7_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 6,
				'selectors' => [ '{{WRAPPER}} .style-11 .text' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern7_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-11 .text:nth-child(5n + 1)' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern7_colo2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-11 .text:nth-child(5n + 2)' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern7_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-11 .text:nth-child(5n + 3)' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern7_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-11 .text:nth-child(5n + 4)' => 'stroke:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svg_pattern7_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-11 .text:nth-child(5n + 5)' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern8_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '8' ]
            ]
        );
        $this->add_control( 'svg_pattern8_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 30,
				'step' => 1,
				'default' => 10,
				'selectors' => [ '{{WRAPPER}} .style-12 .text-copy-stroke' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern8_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-12 .text-copy-stroke' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern8_color1',
            [
                'label' => esc_html__( 'Shadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-12 .text-copy--shadow' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern8_color2',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-12 #p-lines rect' => 'fill:{{VALUE}}!important;' ],
            ]
        );
        $this->add_control( 'svg_pattern8_color3',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .style-12 #p-lines g' => 'stroke:{{VALUE}}!important;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern9_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '9' ]
            ]
        );
        $this->add_control( 'svg_pattern9_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 10,
				'selectors' => [ '{{WRAPPER}} .style-13 .text-mask' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern9_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-13 .text-mask' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern9_fill_color',
            [
                'label' => esc_html__( 'Fill Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-13 .text-mask' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern9_stroke_opacity',
            [
				'label' => esc_html__( 'Stroke Opacity', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.2,
				'selectors' => [ '{{WRAPPER}} .style-13 .text-mask' => 'stroke-opacity:{{SIZE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern10_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '10' ]
            ]
        );
        $this->add_control( 'svg_pattern10_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 10,
				'selectors' => [ '{{WRAPPER}} .style-14 .text-copy--stroke' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern10_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-14 .text-copy--stroke' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern10_fill_color',
            [
                'label' => esc_html__( 'Fill Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-14 .text-copy--stroke' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern10_shadow_color',
            [
                'label' => esc_html__( 'Shadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-14 .text-copy--shadow' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern10_stroke_width2',
            [
				'label' => esc_html__( 'Ring Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'selectors' => [ '{{WRAPPER}} .style-14 .c-ring' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern10_fill_color2',
            [
                'label' => esc_html__( 'Ring Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-14 .c-ring' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern11_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '11' ]
            ]
        );
        $this->add_control( 'svg_pattern11_stroke_width',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 4,
				'selectors' => [ '{{WRAPPER}} .style-15 .text-copy--stroke' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-15 .text-copy--stroke' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_fill_color',
            [
                'label' => esc_html__( 'Shadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-15 .text-copy--shadow' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_stroke_width2',
            [
				'label' => esc_html__( 'Ring Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'selectors' => [ '{{WRAPPER}} .style-15 .c-ring' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_stroke_color2',
            [
                'label' => esc_html__( 'Ring Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-15 .c-ring' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_stroke2_width2',
            [
				'label' => esc_html__( 'Ring Stroke Width 2', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 2,
				'selectors' => [ '{{WRAPPER}} .style-15 .c-ring--fill' => 'stroke-width:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern11_fill_color2',
            [
                'label' => esc_html__( 'Ring Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-15 .c-ring--fill' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'svg_pattern12_style_section',
            [
                'label' => esc_html__( 'Text Color Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                 'condition' => ['style' => '12' ]
            ]
        );
        $this->add_control( 'svg_pattern12_fill_color',
            [
                'label' => esc_html__( 'Shadow Fill Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .style-16 .anim-shape--shadow' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern12_fill_opacity',
            [
				'label' => esc_html__( 'Stroke Width', 'agrikon' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 4,
				'selectors' => [ '{{WRAPPER}} .style-16 .anim-shape--shadow' => 'fill-opacity:{{SIZE}};' ],
            ]
        );

        $this->add_control( 'svg_pattern12_stroke_color2',
            [
                'label' => esc_html__( 'Ring Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern12_color1',
            [
                'label' => esc_html__( 'Color 1', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape:nth-child(5n + 1)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern12_colo2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape:nth-child(5n + 2)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern12_color3',
            [
                'label' => esc_html__( 'Color 3', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape:nth-child(5n + 3)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'svg_pattern12_color4',
            [
                'label' => esc_html__( 'Color 4', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape:nth-child(5n + 4)' => 'fill:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'svg_pattern12_color5',
            [
                'label' => esc_html__( 'Color 5', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .colortext .anim-shape:nth-child(5n + 5)' => 'fill:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $height = $settings['svg_pattern_typo_font_size']['size'];
        $height = $height ? $height : 300;
        echo '<div class="svg-pattern-wrapper">';
        /* style 3 */
        if ( '1' == $settings['style'] ) {

		echo '<div class="text-type-1 box-with-text">'.$settings['title'].'</div>';
		
        } elseif ( '2' == $settings['style'] ) {
            
        /* style 6 */
		echo '<div class="style-6"><svg viewBox="0 0 1200 '.$height.'">
				<pattern id="p-spots_'.$id.'" viewBox="0 0 80 80" patternUnits="userSpaceOnUse" width="60" height="60" x="5" y="5">
				<g class="g-spots">
				  <circle r="5" cx="10" cy="10"/>
				  <circle r="7" cx="30" cy="30"/>
				  <circle r="5" cx="50" cy="10"/>
				  <circle r="9" cx="70" cy="30"/>
				  <circle r="11" cx="50" cy="50"/>
				  <circle r="5" cx="10" cy="50"/>
				  <circle r="7" cx="30" cy="70"/>
				  <circle r="9" cx="70" cy="70"/>
				</g>
				</pattern>
				<text style="fill: url(#p-spots_'.$id.');" text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
			</svg></div>';
				
        } elseif ( '3' == $settings['style'] ) {
            
            $color1 = $settings['svg_pattern3_color1'] ? $settings['svg_pattern3_color1'] : '#333';
            $color2 = $settings['svg_pattern3_color2'] ? $settings['svg_pattern3_color2'] : '#FFF';
            $color3 = $settings['svg_pattern3_color3'] ? $settings['svg_pattern3_color3'] : '#333';
            $color4 = $settings['svg_pattern3_color4'] ? $settings['svg_pattern3_color4'] : '#FFF';
            $color5 = $settings['svg_pattern3_color5'] ? $settings['svg_pattern3_color5'] : 'rgba(55,55,55,0)';
            $duration = $settings['svg_pattern3_duration'] ? $settings['svg_pattern3_duration'] : 5;
            
        /* style 7 */
		echo '<div class="style-7"><svg viewBox="0 0 1200 '.$height.'">

				  <radialGradient id="gr-radial_'.$id.'" cx="50%" cy="50%" r="70%">
				      <!-- Animation for radius of gradient -->
				      <animate attributeName="r"  values="0%;150%;100%;0%" dur="5s" repeatCount="indefinite" />

				      <stop stop-color="#FFF" offset="0">
				        <animate attributeName="stop-color" values="'.$color1.';'.$color2.';'.$color3.';'.$color4.'" dur="'.$duration.'s" repeatCount="indefinite" />
				      </stop>
				      <stop stop-color="'.$color5.'" offset="100%"/>
				  </radialGradient>
				  <text style="fill: url(#gr-radial_'.$id.');" text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
				</svg></div>';
				
        } elseif ( '4' == $settings['style'] ) {
        
        /* style 8 */
		echo '<div class="style-8">
				<svg viewBox="0 0 1200 '.$height.'">
					<pattern id="p-stars_'.$id.'" width="70" height="70" viewBox="0 0 120 120" patternUnits="userSpaceOnUse">
					<g class="g-stars">
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform=" scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(30,30) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(90,30) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(0,60) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(60,0) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(60,60) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(90,90) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(30,90) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(120,60) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(60,120) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(0,120) scale(.9,.9)"></polygon>
					<polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(-30,90) scale(.9,.9)"></polygon>
					 <!-- Hack to make shapes full  -->
					 <polygon></polygon>
					 <polygon></polygon>
					 <polygon></polygon>
					 <polygon points="15 22.5 6.18322122 27.1352549 7.86707613 17.3176275 0.734152256 10.3647451 10.5916106 8.93237254 15 0 19.4083894 8.93237254 29.2658477 10.3647451 22.1329239 17.3176275 23.8167788 27.1352549" transform="translate(120,0) scale(.9,.9)"></polygon>
					</g>
					</pattern>
					<!-- Text -->
					<text style="fill: url(#p-stars_'.$id.');" text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
				</svg>
			</div>';
			
        } elseif ( '5' == $settings['style'] ) {
            
		/* style 9 */
		echo '<div class="style-9"><svg viewBox="0 0 1200 '.$height.'">
                <pattern id="p-fire_'.$id.'" viewBox="30 100 186 200" patternUnits="userSpaceOnUse" width="216" height="200" x="-70" y="35">
                    <image xlink:href="'.$settings['img']['url'].'" width="256" height="300" />
                </pattern>
                <text style="fill: url(#p-fire_'.$id.');" text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
            </svg></div>';
            
        } elseif ( '6' == $settings['style'] ) {
            
		/* style 10 */
		echo '<div class="style-10"><svg viewBox="0 0 1200 '.$height.'">
				  <pattern id="p-spots_'.$id.'" width="50" height="50" viewBox="0 0 90 90" patternUnits="userSpaceOnUse">
				   <g class="g-spots">
				     <ellipse rx="25" ry="35" cx="50" cy="50"></ellipse>
				     <ellipse rx="25" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="10" cx="50" cy="50"></ellipse>
				     <ellipse rx="5" ry="10" cx="50" cy="50" ></ellipse>
				   </g>
				    <g class="g-spots" transform="translate(45,45)">
				     <ellipse rx="25" ry="35" cx="50" cy="50"></ellipse>
				     <ellipse rx="25" ry="20"cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="20"cx="50" cy="50" ></ellipse>
				     <ellipse rx="15" ry="10"cx="50" cy="50" ></ellipse>
				     <ellipse rx="5" ry="10"cx="50" cy="50" ></ellipse>
				   </g>
				   <g class="g-spots" transform="translate(-45,45)">
				     <ellipse rx="25" ry="35" cx="50" cy="50"></ellipse>
				     <ellipse rx="25" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="10" cx="50" cy="50"></ellipse>
				     <ellipse rx="5" ry="10" cx="50" cy="50"></ellipse>
				   </g>
				   <g class="g-spots" transform="translate(-45,45)">
				     <ellipse rx="25" ry="35" cx="50" cy="50"></ellipse>
				     <ellipse rx="25" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="10" cx="50" cy="50"></ellipse>
				     <ellipse rx="5" ry="10" cx="50" cy="50"></ellipse>
				   </g>
				   <g class="g-spots" transform="translate(-45,45)">
				     <ellipse rx="25" ry="35" cx="50" cy="50"></ellipse>
				     <ellipse rx="25" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="20" cx="50" cy="50"></ellipse>
				     <ellipse rx="15" ry="10" cx="50" cy="50"></ellipse>
				     <ellipse rx="5" ry="10" cx="50" cy="50"></ellipse>
				   </g>
				  </pattern>
				  <text style="stroke: url(#p-spots_'.$id.');" text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
				</svg></div>';
				
        } elseif ( '7' == $settings['style'] ) {
        
		/* style 11 */
		echo '<div class="style-11">
		<svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em">'.$settings['title'].'</text>
                </symbol>
                <use xlink:href="#s-text_'.$id.'" class="text"></use>
                <use xlink:href="#s-text_'.$id.'" class="text"></use>
                <use xlink:href="#s-text_'.$id.'" class="text"></use>
                <use xlink:href="#s-text_'.$id.'" class="text"></use>
                <use xlink:href="#s-text_'.$id.'" class="text"></use>

            </svg></div>';
		
        } elseif ( '8' == $settings['style'] ) {
        
		/* style 12 */
		echo '<div class="style-12"><svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'"><text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text></symbol>
                <clippath id="cp-text_'.$id.'"><text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text></clippath>
                <pattern id="p-lines_'.$id.'" width="40" height="50" viewBox="0 0 40 50" patternUnits="userSpaceOnUse">
                    <rect width="100%" height="100%" fill="hsl(210,100%,50%)"></rect>
                    <g stroke="rgba(255,255,255,.4)" stroke-width="20"><path d="M25,0 25,100"></path></g>
                </pattern>
                <use xlink:href="#s-text_'.$id.'" class="text-copy--shadow"></use>
                <use xlink:href="#s-text_'.$id.'" class="text-copy-stroke"></use>
                <g clip-path="url(#cp-text_'.$id.')">
                    <circle r="100%" cx="300" cy="150" class="c-fill--color"></circle>
                    <circle style="fill: url(#p-lines_'.$id.');" r="100%" cx="300" cy="150" class="c-fill"></circle>
                </g>
            </svg></div>';
		
        } elseif ( '9' == $settings['style'] ) {
        
		/* style 13 */
		echo '<div class="style-13"><svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">'.$settings['title'].'</text>
                </symbol>
                <mask id="m-text_'.$id.'" maskunits="userSpaceOnUse" maskcontentunits="userSpaceOnUse">
                    <use xlink:href="#s-text_'.$id.'" class="text-mask"></use>
                </mask>
                <g mask="url(#m-text_'.$id.')">
                    <image xlink:href="'.$settings['img']['url'].'" width="2000" x="0%" y="-80%"></image>
                </g>
            </svg></div>';

        } elseif ( '10' == $settings['style'] ) {
        
		/* style 14 */
		echo '<div class="style-14"><svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </symbol>
                <clippath id="cp-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </clippath>
                <pattern id="p-circles_'.$id.'" width="40" height="40" viewBox="0 0 40 40" patternUnits="userSpaceOnUse">
                    <circle r="12" cx="20" cy="20" class="c-ring"></circle>
                    <circle r="5" cx="20" cy="20" class="c-ring"></circle>
                    <circle r="12" cx="0" cy="0" class="c-ring"></circle>
                    <circle r="12" cx="40" cy="0" class="c-ring"></circle>
                    <circle r="12" cx="40" cy="40" class="c-ring"></circle>
                    <circle r="12" cx="0" cy="40" class="c-ring"></circle>
                    <circle r="5" cx="0" cy="0" class="c-ring"></circle>
                    <circle r="5" cx="40" cy="0" class="c-ring"></circle>
                    <circle r="5" cx="40" cy="40" class="c-ring"></circle>
                    <circle r="5" cx="0" cy="40" class="c-ring"></circle>
                </pattern>
                <use xlink:href="#s-text_'.$id.'" class="text-copy--shadow"></use>
                <g clip-path="url(#cp-text_'.$id.')">
                    <circle style="fill: url("#p-circles_'.$id.'");" r="70%" cx="300" cy="150" class="shape-fill"></circle>
                </g>
                <use xlink:href="#s-text_'.$id.'" class="text-copy--stroke"></use>
            </svg></div>';
            
        } elseif ( '11' == $settings['style'] ) {
        
		/* style 15 */
		echo '<div class="style-15"><svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </symbol>
                <clippath id="cp-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </clippath>
                <pattern id="p-circles_'.$id.'" width="40" height="40" viewBox="0 0 40 40" patternUnits="userSpaceOnUse">
                    <circle r="12" cx="20" cy="20" class="c-ring"></circle>
                    <circle r="5" cx="20" cy="20" class="c-ring c-ring--fill"></circle>
                    <circle r="12" cx="0" cy="0" class="c-ring"></circle>
                    <circle r="12" cx="40" cy="0" class="c-ring"></circle>
                    <circle r="12" cx="40" cy="40" class="c-ring"></circle>
                    <circle r="12" cx="0" cy="40" class="c-ring"></circle>
                    <circle r="5" cx="0" cy="0" class="c-ring"></circle>
                    <circle r="5" cx="40" cy="0" class="c-ring"></circle>
                    <circle r="5" cx="40" cy="40" class="c-ring"></circle>
                    <circle r="5" cx="0" cy="40" class="c-ring"></circle>
                </pattern>
                <use xlink:href="#s-text_'.$id.'" class="text-copy--shadow"></use>
                <g clip-path="url(#cp-text_'.$id.')">
                    <circle style="fill: url(#p-circles_'.$id.');" r="100%" cx="300" cy="150" class="r-fill"></circle>
                </g>
                <use xlink:href="#s-text_'.$id.'" class="text-copy--stroke"></use>
            </svg></div>';
		
        } elseif ( '12' == $settings['style'] ) {
        
		/* style 16 */
		echo '<div class="style-16"><svg viewBox="0 0 1200 '.$height.'">
                <symbol id="s-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </symbol>
                <clippath id="cp-text_'.$id.'">
                    <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text--line">'.$settings['title'].'</text>
                </clippath>
                <g clip-path="url(#cp-text_'.$id.')" class="shadow">
                    <rect width="100%" height="100%" class="anim-shape anim-shape--shadow"></rect>
                </g>
                <g clip-path="url(#cp-text_'.$id.')" class="colortext">
                    <rect width="100%" height="100%" class="anim-shape"></rect>
                    <rect width="80%" height="100%" class="anim-shape"></rect>
                    <rect width="60%" height="100%" class="anim-shape"></rect>
                    <rect width="40%" height="100%" class="anim-shape"></rect>
                    <rect width="20%" height="100%" class="anim-shape"></rect>
                </g>
                <use xlink:href="#s-text_'.$id.'" class="text--transparent"></use>
            </svg></div>';

        }
        echo '</div>';
    }
}