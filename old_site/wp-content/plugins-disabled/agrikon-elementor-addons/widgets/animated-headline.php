<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Animated_Headline extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-animated-headline';
    }
    public function get_title() {
        return 'Animated Headline (N)';
    }
    public function get_icon() {
        return 'eicon-animated-headline';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'animated-headline', AGRIKON_PLUGIN_URL. 'assets/front/js/animated-headline/style.css');
        wp_register_script( 'animated-headline', AGRIKON_PLUGIN_URL. 'assets/front/js/animated-headline/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'animated-headline' ];
    }
    public function get_script_depends() {
        return [ 'animated-headline' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('agrikon_animated_headline_settings',
            [
                'label' => esc_html__( 'Typed Title Settings', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'agrikon' ),
                    'h2' => esc_html__( 'h2', 'agrikon' ),
                    'h3' => esc_html__( 'h3', 'agrikon' ),
                    'h4' => esc_html__( 'h4', 'agrikon' ),
                    'h5' => esc_html__( 'h5', 'agrikon' ),
                    'h6' => esc_html__( 'h6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' )
                ]
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'rotate-1',
                'options' => [
                    'rotate-1' => esc_html__( 'rotate-1', 'agrikon' ),
                    'letters type' => esc_html__( 'letters type', 'agrikon' ),
                    'letters rotate-2' => esc_html__( 'letters rotate-2', 'agrikon' ),
                    'loading-bar' => esc_html__( 'loading-bar', 'agrikon' ),
                    'slide' => esc_html__( 'slide', 'agrikon' ),
                    'clip is-full-width' => esc_html__( 'clip is-full-width', 'agrikon' ),
                    'zoom' => esc_html__( 'zoom', 'agrikon' ),
                    'letters rotate-3' => esc_html__( 'letters rotate-3', 'agrikon' ),
                    'letters scale' => esc_html__( 'letters scale', 'agrikon' ),
                    'push' => esc_html__( 'push', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'animated_headline_before',
            [
                'label' => esc_html__( 'Text Before', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'We are',
                'label_block' => true,
            ]
        );
        $this->add_control( 'animated_headline_after',
            [
                'label' => esc_html__( 'Text After', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'animated_headline_text',
            [
                'label' => esc_html__( 'Text', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Best',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'animated_headline_custom_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'texts',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{animated_headline_text}}',
                'default' => [
                    [
                        'animated_headline_text' => 'Best',
                    ],
                    [
                        'animated_headline_text' => 'Awesome',
                    ],
                    [
                        'animated_headline_text' => 'Important',
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
        $this->start_controls_section( 'animated_headline_style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'typed_cursor_general_heading',
            [
                'label' => esc_html__( 'General', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->agrikon_style_color( 'animated_headline_color', '{{WRAPPER}} .animated_headline_wrapper,{{WRAPPER}} .animated_headline_wrapper b, {{WRAPPER}} .animated_headline_wrapper .typed-cursor,{{WRAPPER}} .animated_headline_wrapper .typed_before,{{WRAPPER}} .animated_headline_wrapper .typed_after' );
        $this->agrikon_style_typo( 'animated_headline_typo', '{{WRAPPER}} .animated_headline_wrapper,{{WRAPPER}} .animated_headline_wrapper b,{{WRAPPER}} .animated_headline_wrapper .typed-cursor,{{WRAPPER}} .animated_headline_wrapper .typed_before,{{WRAPPER}} .animated_headline_wrapper .typed_after' );
        $this->agrikon_style_flex_alignment( 'animated_headline_alignment', '{{WRAPPER}} .animated_headline_wrapper .headline' );
        $this->agrikon_style_padding( 'animated_headline_padding', '{{WRAPPER}} .animated_headline_wrapper' );
        $this->agrikon_style_margin( 'animated_headline_margin', '{{WRAPPER}} .animated_headline_wrapper' );
        $this->agrikon_style_border( 'animated_headline_border','{{WRAPPER}} .animated_headline_wrapper' );

        $this->add_control( 'typed_cursor_typed_heading',
            [
                'label' => esc_html__( 'Animated Text', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_typo( 'animated_headline_typed_typo','{{WRAPPER}} .animated_headline_wrapper b' );
        $this->agrikon_style_text_shadow( 'animated_headline_shadow','{{WRAPPER}} .animated_headline_wrapper b' );

        $this->add_control( 'typed_cursor_heading',
            [
                'label' => esc_html__( 'Cursor', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_color( 'animated_headline_cursor', ['{{WRAPPER}} .typed_wrapper .typed-cursor' => 'color: {{VALUE}}','{{WRAPPER}} .headline.loading-bar .words-wrapper::after' => 'background: {{VALUE}};','{{WRAPPER}} .headline.clip .words-wrapper::after' => 'background: {{VALUE}};'] );
        $this->agrikon_style_slider_size( 'animated_headline_cursor_size', ['{{WRAPPER}} .typed_wrapper .typed-cursor' => 'font-size:{{SIZE}}px'] );

        $this->add_control( 'animated_headline_before_heading',
            [
                'label' => esc_html__( 'Before Color', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_color( 'animated_headline_before_color', '{{WRAPPER}} .typed_wrapper .typed_before' );

        $this->add_control( 'animated_headline_after_heading',
            [
                'label' => esc_html__( 'After Color', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_color( 'animated_headline_after_color', '{{WRAPPER}} .typed_wrapper .typed_after' );

        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="animated_headline_wrapper">';
            echo '<'.$settings['tag'].' class="headline '.$settings['type'].'">';
            	echo $settings['animated_headline_before'] ? '<span class="typed_before">'.$settings['animated_headline_before'].'</span>&nbsp;' : '';
            	echo '<span class="words-wrapper">';
            	    $count = 0;
                    foreach ($settings['texts'] as $item) {
                        $style = $item['animated_headline_custom_color'] ? ' style="color:'.$item['animated_headline_custom_color'].'"' : '';
                        $visible = 0 == $count ? ' class="is-visible"' : '';
                        echo '<b'.$visible.$style.'>'.$item['animated_headline_text'].'</b>';
                        $count++;
                    }
            	echo '</span> ';
                echo $settings['animated_headline_after'] ? '&nbsp;<span class="typed_after">'.$settings['animated_headline_after'].'</span>' : '';
            echo '</'.$settings['tag'].'>';
        echo '</div>';
    }
}
