<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Animated_Text_Background extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-animated-text-background';
    }
    public function get_title() {
        return 'Animated Text Background (N)';
    }
    public function get_icon() {
        return 'eicon-t-letter';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('general_settings',
            [
                'label' => esc_html__( 'Animated Text Background', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Text', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'agrikon'
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
        $this->add_control('offset',
            [
                'label' => esc_html__( 'Animation Duration ( s )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'selectors' => [ '{{WRAPPER}} .blog .controls' => '-webkit-animation-duration:{{VALUE}}s;animation-duration:{{VALUE}}s;' ],
            ]
        );
        $this->agrikon_style_background( 'text_background', '{{WRAPPER}} .animated--text-bg', array( 'classic','gradient' ) );
        $this->agrikon_style_typo( 'text_typo', '{{WRAPPER}} .animated--text-bg' );
        $this->agrikon_style_text_alignment( 'text_alignment', '{{WRAPPER}} .animated--text-bg-wrapper' );
        $this->agrikon_style_padding( 'text_padding', '{{WRAPPER}} .animated--text-bg-wrapper' );
        $this->agrikon_style_margin( 'text_margin', '{{WRAPPER}} .animated--text-bg-wrapper' );
        $this->agrikon_style_border( 'text_border','{{WRAPPER}} .animated--text-bg-wrapper' );
        $this->agrikon_style_text_shadow( 'text_shadow','{{WRAPPER}} .animated--text-bg' );
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( $settings['title'] ) {
            echo '<div class="animated--text-bg-wrapper">';
                echo '<'.$settings['tag'].' class="animated--text-bg">'.$settings['title'].'</'.$settings['tag'].'>';
            echo '</div>';
        }
    }
}
