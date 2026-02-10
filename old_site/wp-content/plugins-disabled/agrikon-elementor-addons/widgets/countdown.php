<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Countdown extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-countdown';
    }
    public function get_title() {
        return 'Countdown (N)';
    }
    public function get_icon() {
        return 'eicon-countdown';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function get_script_depends() {
        return [ 'jquery-countdown' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('counterdown_settings_section',
            [
                'label' => esc_html__( 'Countdown Settings', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'time',
            [
                'label' => esc_html__( 'Time', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Usage : 01/01/2030 17:00:00', 'agrikon' ),
                'default' => '01/01/2030 17:00:00',
            ]
        );
        $this->add_control( 'showlabel',
            [
                'label' => esc_html__( 'Display Time Labels?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'day',
            [
                'label' => esc_html__( 'Day', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Day', 'agrikon' ),
                'default' => 'Day',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'days',
            [
                'label' => esc_html__( 'Days', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Days', 'agrikon' ),
                'default' => 'Days',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'hour',
            [
                'label' => esc_html__( 'Hour', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Hour', 'agrikon' ),
                'default' => 'Hour',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'hours',
            [
                'label' => esc_html__( 'Hours', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Hours', 'agrikon' ),
                'default' => 'Hours',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'minute',
            [
                'label' => esc_html__( 'Minute', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Minutes', 'agrikon' ),
                'default' => 'Minute',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'minutes',
            [
                'label' => esc_html__( 'Minutes', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Minutes', 'agrikon' ),
                'default' => 'Minutes',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'second',
            [
                'label' => esc_html__( 'Second', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Second', 'agrikon' ),
                'default' => 'Second',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'seconds',
            [
                'label' => esc_html__( 'Seconds', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Seconds', 'agrikon' ),
                'default' => 'Seconds',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('time_style_settings',
            [
                'label' => esc_html__( 'Time Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .box-time-list' => 'justify-content:{{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'left', 'agrikon' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'eicon-h-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'agrikon' ),
                        'icon' => 'eicon-h-align-right'
                    ]
                ],
                'default' => 'flex-start',
                'toggle' => true
            ]
        );
        $this->add_responsive_control( 'item_width',
            [
                'label' => esc_html__( 'Item Width', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => ['max' => 500 ],
                    '%' => ['max' => 100 ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => ['{{WRAPPER}} .box--timer li.box-time-date' => 'width: {{SIZE}}px;'],
            ]
        );
        $this->add_responsive_control( 'item_height',
            [
                'label' => esc_html__( 'Item Height ( px )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .box--timer li.box-time-date' => 'height: {{SIZE}}px;'],
            ]
        );
        $this->add_responsive_control( 'item_space',
            [
                'label' => esc_html__( 'Space Between', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .box--timer li.box-time-date' => 'margin: 0 calc( {{SIZE}}px / 2 );',
                    '{{WRAPPER}} .box-time-list' => 'margin: 0 -{{SIZE}}px;',
                ],
            ]
        );
        $this->add_control( 'time_background',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box--timer li' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .box--timer li.box-time-date'
            ]
        );
        $this->add_responsive_control( 'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .box--timer li.box-time-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_bxshdw',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .box--timer li.box-time-date'
            ]
        );
        $this->add_control( 'time_heading',
            [
                'label' => esc_html__( 'TIME', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .box-time-list li span',
            ]
        );
        $this->add_control( 'time_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box-time-list li span' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'time_bxshdw',
                'label' => esc_html__( 'Text Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .box-time-list li span.wf-first'
            ]
        );
        $this->add_control( 'time_label_heading',
            [
                'label' => esc_html__( 'TIME LABEL', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_label_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .box--timer .box-time-date span.wf-second',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'time_label_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box--timer .box-time-date span.wf-second' => 'color:{{VALUE}};' ],
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_responsive_control( 'time_label_margin',
            [
                'label' => esc_html__( 'Margin Top', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box--timer .box-time-date span.wf-second' => 'margin-top: {{SIZE}}px;' ],
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'time_label_bxshdw',
                'label' => esc_html__( 'Text Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .box-time-list li span.wf-second'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        $time = $settings['time'] ? $settings['time'] : '01/01/2030 17:00:00';

        $data[] = '"date":"'.$time.'"';
        $data[] = '"day":"'.$settings['day'].'"';
        $data[] = '"days":"'.$settings['days'].'"';
        $data[] = '"hour":"'.$settings['hour'].'"';
        $data[] = '"hours":"'.$settings['hours'].'"';
        $data[] = '"minute":"'.$settings['minute'].'"';
        $data[] = '"minutes":"'.$settings['minutes'].'"';
        $data[] = '"second":"'.$settings['second'].'"';
        $data[] = '"seconds":"'.$settings['seconds'].'"';

        echo '<div class="box--timer" data-countdown-options=\'{'. implode(', ', $data ) .'}\'>';
            echo '<ul class="box-time-list">';
                echo '<li class="box-time-date">';
                    echo '<span class="days wf-first">00</span>';
                    echo '<span class="days_text wf-second">'.esc_html__('days', 'agrikon').'</span>';
                echo '</li>';
                echo '<li class="box-time-date">';
                    echo '<span class="hours wf-first">00</span>';
                    echo '<span class="hours_text wf-second">'.esc_html__('hours', 'agrikon').'</span>';
                echo '</li>';
                echo '<li class="box-time-date">';
                    echo '<span class="minutes wf-first">00</span>';
                    echo '<span class="minutes_text wf-second">'.esc_html__('mins', 'agrikon').'</span>';
                echo '</li>';
                echo '<li class="box-time-date">';
                    echo '<span class="seconds wf-first">00</span>';
                    echo '<span class="seconds_text wf-second">'.esc_html__('secs', 'agrikon').'</span>';
                echo '</li>';
            echo '</ul>';
        echo '</div>';
    }
}
