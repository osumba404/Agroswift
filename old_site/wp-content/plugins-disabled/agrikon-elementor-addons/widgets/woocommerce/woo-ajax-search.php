<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Ajax_Search extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-ajax-search';
    }
    public function get_title() {
        return 'WC Ajax Search (N)';
    }
    public function get_icon() {
        return 'eicon-site-search';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    // Registering Controls
    protected function register_controls() {

        /* HEADER MINICART SETTINGS */
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'form_maxwidth',
            [
                'label' => esc_html__( 'Max Width ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} #agrikon-asform' => 'max-width: {{SIZE}}%;'],
            ]
        );
        $this->add_responsive_control( 'form_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} #agrikon-asform' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->add_responsive_control( 'form_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} #agrikon-asform' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};']
            ]
        );
        $this->start_controls_tabs( 'slider_nav_tabs');
        $this->start_controls_tab( 'slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} #agrikon-asform',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'form_bgclr',
           [
               'label' => esc_html__( 'Background Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} #agrikon-asform input#agrikon-as' => 'background-color: {{VALUE}};']
           ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'form_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} #agrikon-asform:hover,{{WRAPPER}} #agrikon-asform:focus',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'form_hvrbgclr',
           [
               'label' => esc_html__( 'Background Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} #agrikon-asform:hover input#agrikon-as,
                   {{WRAPPER}} #agrikon-asform:focus input#agrikon-as' => 'background-color: {{VALUE}};'
               ]
           ]
        );
        $this->add_control( 'form_hvrclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} #agrikon-asform:hover input#agrikon-as,
                   {{WRAPPER}} #agrikon-asform:focus input#agrikon-as' => 'color: {{VALUE}};'
               ]
           ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( class_exists( 'WooCommerce' ) ) {
            echo'<div class="agrikon_as_form_wrapper">';
                echo do_shortcode('[agrikon_wc_ajax_search]');
            echo'</div>';
        }
    }
}
