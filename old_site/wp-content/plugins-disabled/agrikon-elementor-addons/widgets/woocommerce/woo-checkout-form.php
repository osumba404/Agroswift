<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Naturally_Woo_Checkout_Form_Widget extends Widget_Base {
    use Naturally_Helper;
    public function get_name() {
        return 'naturally-woo-checkout-form';
    }
    public function get_title() {
        return 'WC Checkout Form (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'naturally-woo' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'naturally_woo_ma_account_settings',
            [
                'label' => esc_html__( 'Checkout Form', 'naturally' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        if ( class_exists('WooCommerce') ) {
            echo '<div class="shopping-checkout"><div class="checkout">'.do_shortcode('[woocommerce_checkout]').'</div></div>';
        }
    }
}
