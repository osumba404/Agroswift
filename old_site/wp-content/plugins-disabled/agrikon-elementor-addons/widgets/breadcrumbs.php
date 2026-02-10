<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Breadcrumbs extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-breadcrumbs';
    }
    public function get_title() {
        return 'Breadcrumbs (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {

        $this->start_controls_section( 'bread_style',
            [
                'label' => esc_html__( 'Breadcrumbs', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .breadcrumbs' => 'text-align: {{VALUE}};'],
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
                'default' => 'left'
            ]
        );
        $this->agrikon_style_typo( 'bread_typo','{{WRAPPER}} .breadcrumbs, {{WRAPPER}} .breadcrumb_link_seperator' );
        $this->add_control( 'bread_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs,{{WRAPPER}} .breadcrumb_link_seperator, {{WRAPPER}} .breadcrumbs a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'bread_sepcolor',
            [
                'label' => esc_html__( 'Separator Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumb_link_seperator' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'bread_hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'bread_actcolor',
            [
                'label' => esc_html__( 'Current Page/Post Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .breadcrumbs .breadcrumb_active' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $elementid  = $this->get_id();

        echo '<div class="breadcrumbs-wrapper">';
        if ( function_exists( 'agrikon_breadcrumbs' ) ) {
            agrikon_breadcrumbs();
        }
        echo '</div>';
    }
}
