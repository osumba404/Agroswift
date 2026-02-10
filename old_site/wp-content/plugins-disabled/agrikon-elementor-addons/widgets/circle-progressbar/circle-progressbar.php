<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Circle_Progressbar extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-circle-progresbar';
    }
    public function get_title() {
        return 'Circle Progressbar (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script( 'agrikon-circle-progresbar', AGRIKON_PLUGIN_URL. 'widgets/circle-progressbar/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_script_depends() {
        return [ 'circle-progress', 'agrikon-circle-progresbar' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('general_settings',
            [
                'label' => esc_html__( 'Circle Progressbar', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'agrikon' ),
                    'counter' => esc_html__( 'Counter', 'agrikon' ),
                    'counter2' => esc_html__( 'Counter 2', 'agrikon' ),
                    'counter3' => esc_html__( 'With Title', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'linecap',
            [
                'label' => esc_html__( 'Line Cap', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'round',
                'options' => [
                    'round' => esc_html__( 'Round', 'agrikon' ),
                    'butt' => esc_html__( 'Butt', 'agrikon' ),
                    'square' => esc_html__( 'Square', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'value',
            [
                'label' => esc_html__( 'Value', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
            ]
        );
        $this->add_control( 'size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 10,
                'default' => 50,
            ]
        );
        $this->add_control( 'thickness',
            [
                'label' => esc_html__( 'Thickness', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
            ]
        );
        $this->add_control( 'colortype',
            [
                'label' => esc_html__( 'Theme', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color' => esc_html__( 'Color', 'agrikon' ),
                    'grad' => esc_html__( 'Gradient', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'color1',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'color2',
            [
                'label' => esc_html__( 'Color 2', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['colortype' => 'grad']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typo',
                'label' => esc_html__( 'Number Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .progress--number',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['type!' => 'default'],
                'selectors' => [
                    '{{WRAPPER}} .progress--number:not(.stroked)' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .progress--number.stroked' => '-webkit-text-stroke-color:{{VALUE}};text-stroke-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_control( 'stroked',
            [
                'label' => esc_html__( 'Use Stroke', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Organic Solutions',
                'label_block' => true,
                'condition' => ['type' => 'counter3'],
                'separator' => 'before',
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
                'condition' => ['type' => 'counter3']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .about-two__progress-box .title',
                'condition' => ['type' => 'counter3']
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Title Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .about-two__progress-box .title' => 'color:{{VALUE}};' ],
                'condition' => ['type' => 'counter3']
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $stroked = 'yes' == $settings['stroked'] ? ' stroked' : '';
        $color = 'grad' == $settings['colortype'] ? '{ "gradient": ["'.$settings['color1'].'", "'.$settings['color2'].'"] }' : '{"color": "'.$settings['color1'].'"}';

        if ( 'counter3' == $settings['type'] ) {

            echo '<div class="about-two__progress">';
                echo '<div class="about-two__progress-box">';
                    echo '<div id="circle--'.$id.'" class="circle--progressbar" data-options=\'{
                        "value": '. ($settings['value'] / 100) .',
                        "thickness": '.$settings['thickness'].',
                        "emptyFill": "#f6f5f2",
                        "lineCap": "'.$settings['linecap'].'",
                        "size": '.$settings['size'].',
                        "fill": '.$color.' }\' data-type="'.$settings['type'].'">
                            <strong class="progress--number'.$stroked.'"></strong>
                        </div>';
                echo '</div>';
                if ( $settings['title'] ) {
                    echo '<div class="about-two__progress-content">';
                        echo '<'.$settings['tag'].' class="title">'.$settings['title'].'</'.$settings['tag'].'>';
                    echo '</div>';
                }
            echo '</div>';

        } else {

            echo '<div class="circle--progressbar-wrapper">';
            echo '<div id="circle--'.$id.'" class="circle--progressbar" data-options=\'{
                "value": '. ($settings['value'] / 100) .',
                "thickness": '.$settings['thickness'].',
                "emptyFill": "#f6f5f2",
                "lineCap": "'.$settings['linecap'].'",
                "size": '.$settings['size'].',
                "fill": '.$color.' }\' data-type="'.$settings['type'].'">
                        <strong class="progress--number'.$stroked.'"></strong>
                    </div>';
            echo '</div>';
        }
    }
}
