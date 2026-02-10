<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Minicart extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-mini-cart';
    }
    public function get_title() {
        return 'WC Header Cart (N)';
    }
    public function get_icon() {
        return 'eicon-cart';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    // Registering Controls
    protected function register_controls() {

        /* HEADER MINICART SETTINGS */
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Icon', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'trigger',
            [
                'label' => esc_html__( 'Cart Trigger', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'cart' => esc_html__( 'Cart Page', 'agrikon' ),
                    'popup' => esc_html__( 'Popup Cart', 'agrikon' ),
                ],
                'default' => 'cart'
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agrikon-icon-shopping-cart' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control( 'icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Icon Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .main-header__cart-btn:hover .agrikon-icon-shopping-cart' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control( 'icon_text_bgcolor',
            [
                'label' => esc_html__( 'Count Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .header_cart_label_text' => 'background-color: {{VALUE}};'],
            ]
        );
        $this->add_control( 'icon_text_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Count Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .main-header__cart-btn:hover .header_cart_label_text' => 'background-color: {{VALUE}};'],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( class_exists( 'WooCommerce' ) ) {

            global $woocommerce;

            $cart_url = 'popup' == $settings[ 'trigger'] ? '#0' : wc_get_cart_url();
            $tigger_cart = 'popup' == $settings[ 'trigger'] ? ' trigger--popup' : '';

            echo'<div class="agrikon_mini_cart woocommerce">';
                echo'<a class="main-header__cart-btn'.esc_attr( $tigger_cart ).'" href="'.esc_url( $cart_url ).'">';
                    echo'<i class="agrikon-icon-shopping-cart"></i>';
                    echo'<span class="header_cart_label_text">'.esc_html( $woocommerce->cart->cart_contents_count ).'</span>';
                echo'</a>';
                if ( '0' == agrikon_settings( 'header_cart_visibility', '0' ) ) {
                    echo'<div class="agrikon_mini_cart_wrapper">';
                        echo'<div class="header_cart_close"><span class="icons is-close"></span></div>';
                        get_template_part('woocommerce/header', 'minicart');
                    echo'</div>';
                }
            echo'</div>';
        }
    }
}
