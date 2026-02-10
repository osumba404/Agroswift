<?php

if( !defined( 'ABSPATH' ) ) exit;

use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Element_Base;
use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

class Agrikon_Section_Parallax {

    private static $instance = null;

    public function __construct(){
        // section register settings
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'register_change_section_structure'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'section_locomotive_controls'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'section_parallax_controls'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'agrikon_add_particle_effect_to_section'), 10 );
        add_action('elementor/element/section/section_structure/after_section_end',array($this,'agrikon_add_vegas_slider_to_section'), 10 );
        add_action('elementor/element/section/section_layout/before_section_end',array($this,'register_change_section_indent_structure'), 10 );
        add_action('elementor/element/section/section_background/before_section_end',array($this,'register_add_section_background_ripped'), 10 );
        add_action('elementor/element/section/section_background_overlay/before_section_end',array($this,'register_add_section_overlay_width'), 10 );
        add_action('elementor/frontend/section/before_render',array($this,'agrikon_custom_attr_to_section'), 10);
        add_action('elementor/frontend/column/before_render',array($this,'agrikon_custom_attr_to_column'), 10);

        // column register settings and before render column functions
        add_action('elementor/element/column/layout/after_section_end',array($this,'register_change_column_width'), 10 );
    }
    /*****   START PARALLAX CONTROLS   ******/
    public function section_locomotive_controls( $element ) {
        $template = basename( get_page_template() );

        if ( $template == 'locomotive-page.php' ) {
            $element->start_controls_section( 'agrikon_locomotive_section',
                [
                    'label' => esc_html__( 'Agrikon Locomotive', 'agrikon' ),
                    'tab' => Controls_Manager::TAB_LAYOUT
                ]
            );
            $element->add_control( 'agrikon_locomotive_switcher',
                [
                    'label' => esc_html__( 'Inner Section Locomotive Effect', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $element->add_control( 'agrikon_locomotive_speed',
                [
                    'label' => esc_html__( 'Speed', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -10,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => '',
                    'description' => esc_html__( 'Element parallax speed. A negative value will reverse the direction.', 'agrikon' ),
                    'condition' => ['agrikon_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_locomotive_delay',
                [
                    'label' => esc_html__( 'Lerp Delay', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => '',
                    'description' => esc_html__( 'Element parallax lerp delay.', 'agrikon' ),
                    'condition' => ['agrikon_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_locomotive_direction',
                [
                    'label' => esc_html__( 'Direction', 'agrikon' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'vertical',
                    'options' => [
                        'vertical' => esc_html__( 'Vertical', 'agrikon' ),
                        'horizontal' => esc_html__( 'Horizontal', 'agrikon' ),
                    ],
                    'condition' => [ 'agrikon_locomotive_switcher' => 'yes' ],
                ]
            );
            $element->add_control( 'agrikon_locomotive_entrance_animation',
                [
                    'label' => esc_html__( 'Entrance Animation', 'agrikon' ),
                    'type' => Controls_Manager::ANIMATION,
                    'separator' => 'before',
                    'condition' => ['agrikon_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_locomotive_entrance_animation_repeat',
                [
                    'label' => esc_html__( 'Entrance Animation Repeat', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['agrikon_locomotive_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_locomotive_fixedbg',
                [
                    'label' => esc_html__( 'Fullscreen Fixed BG', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            $element->end_controls_section();
        }
    }

    /*****   START PARALLAX CONTROLS   ******/
    public function section_parallax_controls( $element ) {

        $template = basename( get_page_template() );
        if ( $template != 'locomotive-page.php' ) {

            $element->start_controls_section( 'agrikon_parallax_section',
                [
                    'label'        => esc_html__( 'Agrikon Parallax', 'agrikon' ),
                    'tab'          => Controls_Manager::TAB_LAYOUT
                ]
            );
            $element->add_control( 'agrikon_parallax_switcher',
                [
                    'label'        => esc_html__( 'Enable Parallax', 'agrikon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'prefix_class' => 'agrikon-parallax jarallax parallax-',
                ]
            );
            $element->add_control( 'agrikon_parallax_update',
                [
                    'label'       => '<div class="elementor-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div><div class="elementor-update-preview-title" style="display:block;text-align:center;margin-top: 10px;">Update changes to pages</div></div>',
                    'type'        => Controls_Manager::RAW_HTML,
                    'condition'   => ['agrikon_parallax_switcher' => 'yes'],
                ]
            );
            $element->add_control( 'agrikon_parallax_type',
                [
                    'label'       => esc_html__( 'Type', 'agrikon' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'condition'   => ['agrikon_parallax_switcher' => 'yes'],
                    'default'     => 'scroll',
                    'options'     => [
                        'scroll'         => esc_html__( 'Scroll', 'agrikon' ),
                        'scroll-opacity' => esc_html__( 'Scroll with Opacity', 'agrikon' ),
                        'opacity'        => esc_html__( 'Fade', 'agrikon' ),
                        'scale'          => esc_html__( 'Zoom', 'agrikon' ),
                        'scale-opacity'  => esc_html__( 'Zoom with Fade', 'agrikon' )
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_bg_size',
                [
                    'label'       => esc_html__( 'Image Size', 'agrikon' ),
                    'type'        => Controls_Manager::SELECT,
                    'default'     => 'auto',
                    'condition'   => ['agrikon_parallax_switcher' => 'yes'],
                    'options'     => [
                        'auto'        => esc_html__( 'Auto', 'agrikon' ),
                        'cover'       => esc_html__( 'Cover', 'agrikon' ),
                        'contain'     => esc_html__( 'Contain', 'agrikon' )
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_speed',
                [
                    'label'      => esc_html__( 'Parallax Speed', 'agrikon' ),
                    'type'       => Controls_Manager::NUMBER,
                    'min'        => -1,
                    'max'        => 2,
                    'step'       => 0.1,
                    'default'    => 0.2,
                    'condition'  => ['agrikon_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_parallax_mobile_support',
                [
                    'label'      => esc_html__( 'Parallax on Mobile Devices', 'agrikon' ),
                    'type'       => Controls_Manager::SWITCHER,
                    'prefix_class' => 'agrikon-mobile-parallax-',
                    'condition'  => ['agrikon_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_add_parallax_video',
                [
                    'label' => esc_html__( 'Use Background Video', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'agrikon-parallax-video-',
                    'condition'  => ['agrikon_parallax_switcher' => 'yes']
                ]
            );
            $element->add_control( 'agrikon_local_video_format',
                [
                    'label' => esc_html__( 'Video Format', 'agrikon' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => 'true',
                    'default' => 'external',
                    'options' => [
                        'external' => esc_html__( 'External (Youtube,Vimeo)', 'agrikon' ),
                        'mp4' => esc_html__( 'Local MP4', 'agrikon' ),
                        'webm' => esc_html__( 'Local Webm', 'agrikon' ),
                        'ogv' => esc_html__( 'Local Ogv', 'agrikon' ),
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_video_url',
                [
                    'label' => esc_html__( 'Video URL', 'agrikon' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => 'https://www.youtube.com/watch?v=AeeE6PyU-dQ',
                    'description' => esc_html__( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'agrikon' ),
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_video_start_time',
                [
                    'label' => esc_html__( 'Start Time', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '10',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_video_end_time',
                [
                    'label' => esc_html__( 'End Time', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'placeholder' => '70',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_video_volume',
                [
                    'label' => esc_html__( 'Video Volume', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                    'default' => '',
                    'placeholder' => '0',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->add_control( 'agrikon_parallax_video_play_once',
                [
                    'label' => esc_html__( 'Play Once', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', 'agrikon' ),
                    'label_off' => esc_html__( 'No', 'agrikon' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'agrikon_parallax_switcher',
                                'operator' => '==',
                                'value' => 'yes'
                            ],
                            [
                                'name' => 'agrikon_add_parallax_video',
                                'operator' => '==', // it accepts:  =,==, !=,!==,  in, !in etc.
                                'value' => 'yes'
                            ]
                        ]
                    ]
                ]
            );
            $element->end_controls_section();
        }
    }

    /*****   START COLUMN CONTROLS   ******/
    public function register_change_column_width( $element ) {
        $element->start_controls_section('agrikon_section_column_width_settings',
            [
                'label' => esc_html__( 'Agrikon Custom Column', 'agrikon' ),
                'tab' => Controls_Manager::TAB_LAYOUT
            ]
        );
        $element->add_responsive_control( 'agrikon_column_width',
            [
                'label' => esc_html__( 'Change Column Width', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'selectors' => ['{{WRAPPER}}' => 'width: {{VALUE}}%!important;'],
            ]
        );
        $element->end_controls_section();
        $element->start_controls_section( 'agrikon_tilt_effect_section',
            [
                'label' => esc_html__( 'Agrikon Tilt Effect', 'agrikon' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_switcher',
            [
                'label' => esc_html__( 'Enable Tilt Effect', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'You can use this option if you want to use tilt effect for the elementor heading and image in the column when the mouse is over the column.', 'agrikon' ),
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_maxtilt',
            [
                'label' => esc_html__( 'Max Tilt', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 20,
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_perspective',
            [
                'label' => esc_html__( 'Perspective', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
                'description' => esc_html__( 'Transform perspective, the lower the more extreme the tilt gets.', 'agrikon' ),
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_easing',
            [
                'label' => esc_html__( 'Custom Easing', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'cubic-bezier(.03,.98,.52,.99)',
                'label_block' => true,
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_scale',
            [
                'label' => esc_html__( 'Scale', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc..', 'agrikon' ),
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_speed',
            [
                'label' => esc_html__( 'Speed', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 10,
                'default' => 300,
                'description' => esc_html__( 'Speed of the enter/exit transition.', 'agrikon' ),
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_transition',
            [
                'label' => esc_html__( 'Transition', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set a transition on enter/exit.', 'agrikon' ),
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_disableaxis',
            [
                'label' => esc_html__( 'Disable Axis', 'agrikon' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'agrikon' ),
                    'vertical' => esc_html__( 'X Axis', 'agrikon' ),
                    'horizontal' => esc_html__( 'Y Axis', 'agrikon' ),
                ],
                'condition' => [ 'agrikon_tilt_effect_switcher' => 'yes' ],
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_reset',
            [
                'label' => esc_html__( 'Reset', 'agrikon' ),
                'description' => esc_html__( 'If the tilt effect has to be reset on exit.', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_glare',
            [
                'label' => esc_html__( 'Glare Effect', 'agrikon' ),
                'description' => esc_html__( 'Enables glare effect', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['agrikon_tilt_effect_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_tilt_effect_maxglare',
            [
                'label' => esc_html__( 'Max Glare', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 1,
                'description' => esc_html__( 'From 0 - 1.', 'agrikon' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'agrikon_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'agrikon_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'agrikon_tilt_effect_glareclr',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .js-tilt-glare-inner',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'agrikon_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'agrikon_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_change_section_structure( $element ) {
        $element->start_controls_section('agrikon_section_structure_settings',
            [
                'label' => esc_html__( 'Agrikon Structure', 'agrikon' ),
                'tab' => Controls_Manager::TAB_LAYOUT
            ]
        );
        $element->add_control('agrikon_section_structure_switcher',
            [
                'label' => esc_html__( 'Enable Agrikon Structure', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'nt-structure nt-structure-',
            ]
        );
        $element->end_controls_section();
    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_change_section_indent_structure( $element ) {
        $element->add_control( 'agrikon_make_fixed_section_switcher',
            [
                'label' => esc_html__( 'Make Fixed On Scroll', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'prefix_class' => 'agrikon-section-fixed-',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_fixed_section_bgcolor',
            [
                'label' => esc_html__( 'On Scroll BG Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}}' => 'background-color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_fixed_section_heading_color',
            [
                'label' => esc_html__( 'On Scroll Text Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-heading-title' => 'color:{{VALUE}};',
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container .elementor-icon' => 'color:{{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_fixed_section_link_color',
            [
                'label' => esc_html__( 'On Scroll Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_fixed_section_link_hvrcolor',
            [
                'label' => esc_html__( 'On Scroll Link Hover', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    'body .section-fixed-active{{WRAPPER}} .elementor-widget-wrap .elementor-element .elementor-widget-container a:hover' => 'color: {{VALUE}} !important;',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'html_tag',
                            'operator' => '==',
                            'value' => 'nav'
                        ],
                        [
                            'name' => 'html_tag',
                            'operator' => '=',
                            'value' => 'header'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_section_indent',
            [
                'label' => esc_html__( 'Section Indent', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block'  => 'true',
                'default' => '',
                'prefix_class' => 'nt-section ',
                'separator' => 'before',
                'options' => [
                    '' => esc_html__( 'Default', 'agrikon' ),
                    'section-padding' => esc_html__( 'Indent Top and Bottom', 'agrikon' ),
                    'section-padding pt-0' => esc_html__( 'Indent Bottom No Top', 'agrikon' ),
                    'section-padding pb-0' => esc_html__( 'Indent Top No Bottom', 'agrikon' ),
                ]
            ]
        );
    }

    /*****   START CONTROLS SECTION   ******/
    public function register_add_section_background_ripped( $element ) {
        if ( '0' != agrikon_settings( 'theme_all_ripped_visibility', '1' ) ) {
            $element->add_control( 'agrikon_section_ripped_top_heading',
                [
                    'label' => esc_html__( 'TOP RIPPED IMAGE', 'agrikon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );
            $element->add_control( 'agrikon_section_ripped_top_switcher',
                [
                    'label' => esc_html__( 'Open Ripped Top Image', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'prefix_class' => 'nt-section-ripped-top ripped-top-',
                ]
            );
            $element->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'agrikon_section_ripped_top_image',
                    'label' => esc_html__( 'Background', 'agrikon' ),
                    'types' => [ 'classic' ],
                    'selector' => '{{WRAPPER}}.nt-section-ripped-top::before',
                    'condition' => [ 'agrikon_section_ripped_top_switcher' => 'yes' ]
                ]
            );
            $element->add_control( 'agrikon_section_ripped_top_rotate',
                [
                    'label' => esc_html__( 'Rotate', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 360,
                    'step' => 1,
                    'default' => '',
                    'selectors' => [ '{{WRAPPER}}.nt-section-ripped-top::before' => '-webkit-transform: rotate({{VALUE}}deg);transform: rotate({{VALUE}}deg);'],
                    'condition' => [ 'agrikon_section_ripped_top_switcher' => 'yes' ]
                ]
            );
            $element->add_control( 'agrikon_section_ripped_top_offset',
                [
                    'label' => esc_html__( 'Top Offset', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                    'default' => '',
                    'selectors' => [ '{{WRAPPER}}.nt-section-ripped-top::before' => 'top: {{VALUE}}px;'],
                    'condition' => [ 'agrikon_section_ripped_top_switcher' => 'yes' ]
                ]
            );
            $element->add_control( 'agrikon_section_ripped_bottom_heading',
                [
                    'label' => esc_html__( 'BOTTOM RIPPED IMAGE', 'agrikon' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before'
                ]
            );
            $element->add_control( 'agrikon_section_ripped_bottom_switcher',
                [
                    'label' => esc_html__( 'Open Ripped Top Image', 'agrikon' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'prefix_class' => 'nt-section-ripped-bottom ripped-bottom-',
                ]
            );
            $element->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'agrikon_section_ripped_bottom_image',
                    'label' => esc_html__( 'Background', 'agrikon' ),
                    'types' => [ 'classic' ],
                    'prefix_class' => 'nt-section-ripped-bottom ',
                    'selector' => '{{WRAPPER}}.nt-section-ripped-bottom::after',
                    'condition' => [ 'agrikon_section_ripped_bottom_switcher' => 'yes' ]
                ]
            );
            $element->add_control( 'agrikon_section_ripped_bottom_rotate',
                [
                    'label' => esc_html__( 'Rotate', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 360,
                    'step' => 1,
                    'default' => '',
                    'selectors' => [ '{{WRAPPER}}.nt-section-ripped-bottom::after' => '-webkit-transform: rotate({{VALUE}}deg);transform: rotate({{VALUE}}deg);'],
                    'condition' => [ 'agrikon_section_ripped_bottom_switcher' => 'yes' ]
                ]
            );
            $element->add_control( 'agrikon_section_ripped_bottom_offset',
                [
                    'label' => esc_html__( 'Bottom Offset', 'agrikon' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                    'default' => '',
                    'selectors' => [ '{{WRAPPER}}.nt-section-ripped-top::after' => 'bottom: {{VALUE}}px;'],
                    'condition' => [ 'agrikon_section_ripped_bottom_switcher' => 'yes' ]
                ]
            );
        }

    }
    /*****   END COLUMN CONTROLS   ******/

    /*****   START CONTROLS SECTION   ******/
    public function register_add_section_overlay_width( $element )
    {
        $element->add_responsive_control( 'agrikon_section_overlay_width',
            [
                'label' => esc_html__( 'Agrikon Overlay Width', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator'     => 'before'
            ]
        );

        $element->add_responsive_control( 'agrikon_section_overlay_height',
            [
                'label' => esc_html__( 'Agrikon Overlay Height', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 4000,
                        'step' => 5
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator'     => 'before'
            ]
        );
    }

    // Registering Controls
    public function agrikon_add_particle_effect_to_section( $element ) {
        $element->start_controls_section('agrikon_particles_settings',
            [
                'label' => esc_html__( 'Agrikon Particles Effect', 'agrikon' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'agrikon_particles_type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'agrikon' ),
                    'default' => esc_html__( 'default', 'agrikon' ),
                    'nasa' => esc_html__( 'nasa', 'agrikon' ),
                    'bubble' => esc_html__( 'bubble', 'agrikon' ),
                    'snow' => esc_html__( 'snow', 'agrikon' ),
                ]
            ]
        );
        $element->add_control( 'agrikon_particles_options_heading',
            [
                'label' => esc_html__( 'Particles Options', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );

        $element->add_control( 'agrikon_particles_shape',
            [
                'label' => esc_html__( 'Shape Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle' => esc_html__( 'circle', 'agrikon' ),
                    'edge' => esc_html__( 'edge', 'agrikon' ),
                    'triangle' => esc_html__( 'triangle', 'agrikon' ),
                    'polygon' => esc_html__( 'polygon', 'agrikon' ),
                    'star' => esc_html__( 'star', 'agrikon' ),
                ],
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'agrikon_particles_number',
            [
                'label' => esc_html__( 'Number', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 60,
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'agrikon_particles_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'agrikon_particles_opacity',
            [
                'label' => esc_html__( 'Opacity', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0.1,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.4,
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );
        $element->add_control( 'agrikon_particles_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 6,
                'condition'  => ['agrikon_particles_type!' => 'none']
            ]
        );
        $element->end_controls_section();
    }

    // Registering Controls
    public function agrikon_add_vegas_slider_to_section( $element ) {
        $element->start_controls_section('agrikon_vegas_settings',
            [
                'label' => esc_html__( 'Agrikon Vegas Slider', 'agrikon' ),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control( 'agrikon_vegas_switcher',
            [
                'label'        => esc_html__( 'Enable Background Slider', 'agrikon' ),
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        $element->add_control( 'agrikon_vegas_images',
            [
                'label' => __( 'Add Images', 'agrikon' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_options_heading',
            [
                'label' => esc_html__( 'Slider Options', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition'  => ['agrikon_vegas_images!' => '']
            ]
        );
        $element->add_control( 'agrikon_vegas_animation_type',
            [
                'label' => esc_html__( 'Animation Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['kenburns'],
                'options' => [
                    'kenburns' => esc_html__( 'kenburns', 'agrikon' ),
                    'kenburnsUp' => esc_html__( 'kenburnsUp', 'agrikon' ),
                    'kenburnsDown' => esc_html__( 'kenburnsDown', 'agrikon' ),
                    'kenburnsLeft' => esc_html__( 'kenburnsLeft', 'agrikon' ),
                    'kenburnsRight' => esc_html__( 'kenburnsRight', 'agrikon' ),
                    'kenburnsUpLeft' => esc_html__( 'kenburnsUpLeft', 'agrikon' ),
                    'kenburnsUpRight' => esc_html__( 'kenburnsUpRight', 'agrikon' ),
                    'kenburnsDownLeft' => esc_html__( 'kenburnsDownLeft', 'agrikon' ),
                    'kenburnsDownRight' => esc_html__( 'kenburnsDownRight', 'agrikon' ),
                ],
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_transition_type',
            [
                'label' => esc_html__( 'Transition Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['zoomIn','slideLeft','slideRight'],
                'options' => [
                    'fade' => esc_html__( 'fade', 'agrikon' ),
                    'fade2' => esc_html__( 'fade2', 'agrikon' ),
                    'slideLeft' => esc_html__( 'slideLeft', 'agrikon' ),
                    'slideLeft2' => esc_html__( 'slideLeft2', 'agrikon' ),
                    'slideRight' => esc_html__( 'slideRight', 'agrikon' ),
                    'slideRight2' => esc_html__( 'slideRight2', 'agrikon' ),
                    'slideUp' => esc_html__( 'slideUp', 'agrikon' ),
                    'slideUp2' => esc_html__( 'slideUp2', 'agrikon' ),
                    'slideDown' => esc_html__( 'slideDown', 'agrikon' ),
                    'slideDown2' => esc_html__( 'slideDown2', 'agrikon' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'agrikon' ),
                    'zoomIn2' => esc_html__( 'zoomIn2', 'agrikon' ),
                    'zoomOut' => esc_html__( 'zoomOut', 'agrikon' ),
                    'zoomOut2' => esc_html__( 'zoomOut2', 'agrikon' ),
                    'swirlLeft' => esc_html__( 'swirlLeft', 'agrikon' ),
                    'swirlLeft2' => esc_html__( 'swirlLeft2', 'agrikon' ),
                    'swirlRight' => esc_html__( 'swirlRight', 'agrikon' ),
                    'swirlRight2' => esc_html__( 'swirlRight2', 'agrikon' ),
                    'burn' => esc_html__( 'burn', 'agrikon' ),
                    'burn2' => esc_html__( 'burn2', 'agrikon' ),
                    'blur' => esc_html__( 'blur', 'agrikon' ),
                    'blur2' => esc_html__( 'blur2', 'agrikon' ),
                    'flash' => esc_html__( 'flash', 'agrikon' ),
                    'flash2' => esc_html__( 'flash2', 'agrikon' ),
                ],
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_overlay_type',
            [
                'label' => esc_html__( 'Overlay Image Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'prefix_class' => 'agrikon-vegas-overlay vegas-overlay-',
                'options' => [
                    'none' => esc_html__( 'None', 'agrikon' ),
                    '01' => esc_html__( 'Overlay 1', 'agrikon' ),
                    '02' => esc_html__( 'Overlay 2', 'agrikon' ),
                    '03' => esc_html__( 'Overlay 3', 'agrikon' ),
                    '04' => esc_html__( 'Overlay 4', 'agrikon' ),
                    '05' => esc_html__( 'Overlay 5', 'agrikon' ),
                    '06' => esc_html__( 'Overlay 6', 'agrikon' ),
                    '07' => esc_html__( 'Overlay 7', 'agrikon' ),
                    '08' => esc_html__( 'Overlay 8', 'agrikon' ),
                    '09' => esc_html__( 'Overlay 9', 'agrikon' ),
                ],
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_delay',
            [
                'label' => esc_html__( 'Delay', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_duration',
            [
                'label' => esc_html__( 'Transition Duration', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_shuffle',
            [
                'label' => esc_html__( 'Enable Shuffle', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition'  => ['agrikon_vegas_switcher' => 'yes']
            ]
        );
        $element->add_control( 'agrikon_vegas_timer',
            [
                'label' => esc_html__( 'Enable Timer', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'condition'  => ['agrikon_vegas_switcher' => 'yes'],
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $element->add_control( 'agrikon_vegas_timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'agrikon_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'agrikon_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->add_control( 'agrikon_vegas_timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'agrikon_vegas_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'agrikon_vegas_timer',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $element->end_controls_section();
    }

    public function agrikon_custom_attr_to_column( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        if ( 'column' === $element->get_name() && 'yes' === $element->get_settings('agrikon_tilt_effect_switcher') ) {
            $transition = 'yes' === $element->get_settings('agrikon_tilt_effect_transition') ? 'true' : 'false';
            $reset = 'yes' === $element->get_settings('agrikon_tilt_effect_reset') ? 'true' : 'false';
            $glare = 'yes' === $element->get_settings('agrikon_tilt_effect_glare') ? 'true' : 'false';
            $element->add_render_attribute( '_wrapper', 'data-tilt', '' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-max', $element->get_settings('agrikon_tilt_effect_maxtilt') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-perspective', $element->get_settings('agrikon_tilt_effect_perspective') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-easing', $element->get_settings('agrikon_tilt_effect_easing') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-scale', $element->get_settings('agrikon_tilt_effect_scale') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-speed', $element->get_settings('agrikon_tilt_effect_speed') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-disableaxis', $element->get_settings('agrikon_tilt_effect_disableaxis') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-maxglare', $element->get_settings('agrikon_tilt_effect_maxglare') );
            $element->add_render_attribute( '_wrapper', 'data-tilt-transition', $transition );
            $element->add_render_attribute( '_wrapper', 'data-tilt-reset', 'true' );
            $element->add_render_attribute( '_wrapper', 'data-tilt-glare', $glare );
            wp_enqueue_script( 'tilt' );
        }
    }

    public function agrikon_custom_attr_to_section( $element ) {
        $data     = $element->get_data();
        $type     = $data['elType'];
        $settings = $data['settings'];
        $isInner  = $data['isInner'];// inner section

        $template = basename( get_page_template() );

        if ( 'section' === $element->get_name() ) {

            $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('agrikon_section_indent') );
            $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('agrikon_section_outdent') );

            if ( '0' !== $element->get_settings('agrikon_section_column_structure_switcher') ) {
                $element->add_render_attribute( 'wrapper', 'class', $element->get_settings('agrikon_section_change_column_structure') );
            }

            // Particles Effect Options
            if ( 'none' !== $element->get_settings('agrikon_particles_type') ) {

                $color = $element->get_settings('agrikon_particles_color');
                $type = $element->get_settings('agrikon_particles_type');
                $shape = $element->get_settings('agrikon_particles_shape');
                $number = $element->get_settings('agrikon_particles_number');
                $opacity = $element->get_settings('agrikon_particles_opacity');
                $size = $element->get_settings('agrikon_particles_size');
                $size = $size ? $size : 100;

                $element->add_render_attribute( '_wrapper', 'class', 'agrikon-particles' );
                $element->add_render_attribute( '_wrapper', 'data-particles-settings', '{"type":"'.$type.'","color":"'.$color.'","shape":"'.$shape.'","number":'.$number.',"opacity":'.$opacity.',"size":'.$size.'}' );
                $element->add_render_attribute( '_wrapper', 'data-particles-id', $data['id'] );
            }

            // Vegas Slider Options
            if ( 'yes' === $element->get_settings('agrikon_vegas_switcher') ) {
                $delay = $element->get_settings('agrikon_vegas_delay');
                $duration = $element->get_settings('agrikon_vegas_duration');
                $timer = $element->get_settings('agrikon_vegas_timer');
                $shuffle = $element->get_settings('agrikon_vegas_shuffle');
                $overlay = $element->get_settings('agrikon_vegas_overlay_type');
                $images = $element->get_settings('agrikon_vegas_images');

                $transitions = $element->get_settings('agrikon_vegas_transition_type');
                $transition = array();
                foreach ( $transitions as $trans ) {
                    $transition[] =  '"'.$trans.'"';
                }
                $transition = implode(',', $transition);

                $animations = $element->get_settings('agrikon_vegas_animation_type');
                $animation = array();
                foreach ( $animations as $anim ) {
                    $animation[] =  '"'.$anim.'"';
                }
                $animation = implode(',', $animation);

                $slides = array();
                foreach ( $images as $image ) {
                    $slides[] =  '{"src":"'.$image['url'].'"}';
                }

                $element->add_render_attribute( '_wrapper', 'data-vegas-settings',  '{"slides":['.implode(',', $slides).'],"animation":['.$animation.'],"transition":['.$transition.'],"delay":'.$delay.',"duration":'.$duration.',"timer":"'.$timer.'","shuffle":"'.$shuffle.'","overlay":"'.$overlay.'"}' );

                $element->add_render_attribute( '_wrapper', 'data-vegas-id', $data['id'] );

            }

            // Parallax Effect Options
            if ( 'yes' === $element->get_settings('agrikon_parallax_switcher') && $template != 'locomotive-page.php' ) {

                // Parallax attr
                $type = $element->get_settings('agrikon_parallax_type');
                $speed = $element->get_settings('agrikon_parallax_speed');
                $bgsize = $element->get_settings('agrikon_parallax_bg_size');
                $mobile = $element->get_settings('agrikon_parallax_mobile_support');
                $bgimg = $element->get_settings('background_image');
                $bgimg = $bgimg['url'];

                if ( 'yes' === $element->get_settings('agrikon_add_parallax_video') && $element->get_settings('agrikon_parallax_video_url') ) {

                    if ( 'mp4' === $element->get_settings('agrikon_local_video_format')) {
                        $videosrc = 'mp4:'.$element->get_settings('agrikon_parallax_video_url');
                    } elseif ( 'webm' === $element->get_settings('agrikon_local_video_format')) {
                        $videosrc = 'webm:'.$element->get_settings('agrikon_parallax_video_url');
                    } elseif ( 'ogv' === $element->get_settings('agrikon_local_video_format')) {
                        $videosrc = 'ogv:'.$element->get_settings('agrikon_parallax_video_url');
                    } else {
                        //$settings['background_video_link'] // elementor background video link
                        $videosrc = $element->get_settings('agrikon_parallax_video_url');
                    }

                    $element->add_render_attribute( '_wrapper', 'data-jarallax data-video-src', $videosrc);

                    if ( $element->get_settings('agrikon_parallax_video_start_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-start-time', $element->get_settings('agrikon_parallax_video_start_time'));
                    }
                    if ( $element->get_settings('agrikon_parallax_video_end_time') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-end-time', $element->get_settings('agrikon_parallax_video_end_time'));
                    }
                    if ( 'yes' === $element->get_settings('agrikon_parallax_video_play_once') ) {
                        $element->add_render_attribute( '_wrapper', 'data-jarallax-video-loop', 'false' );
                    }
                    if ( $element->get_settings('agrikon_parallax_video_volume') ) {
                        $element->add_render_attribute( '_wrapper', 'data-video-volume', $element->get_settings('agrikon_parallax_video_volume') );
                    }

                } else {
                    $parallaxattr = '{"type":"'.$type.'","speed":"'.$speed.'","imgsize":"'.$bgsize.'","imgsrc":"'.$bgimg.'","mobile":"'.$mobile.'"}';
                    $element->add_render_attribute( '_wrapper', 'data-agrikon-parallax', $parallaxattr);
                }
            }

            if ( $template == 'locomotive-page.php' ) {
                if ( true == $isInner ) {
                    $lrepeat = 'yes' === $element->get_settings('agrikon_locomotive_entrance_animation_repeat') ? 'true' : 'false';
                    $element->add_render_attribute( '_wrapper', 'data-scroll', '' );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-speed', $element->get_settings('agrikon_locomotive_speed') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-delay', $element->get_settings('agrikon_locomotive_delay') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-direction', $element->get_settings('agrikon_locomotive_direction') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-class', $element->get_settings('agrikon_locomotive_entrance_animation') );
                    //$element->add_render_attribute( '_wrapper', 'data-scroll-sticky', $element->get_settings('agrikon_locomotive_sticky') );
                    $element->add_render_attribute( '_wrapper', 'data-scroll-repeat', $lrepeat );
                } else {
                    $element->add_render_attribute( '_wrapper', 'data-scroll-section', '' );
                    if ( 'yes' === $element->get_settings('agrikon_locomotive_fixedbg') ) {
                        $element->add_render_attribute( '_wrapper', 'data-agrikon-locomotive-fixedbg', 'yes' );
                    }
                }
            }
        } // end if section
    }

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Agrikon_Section_Parallax::get_instance();
