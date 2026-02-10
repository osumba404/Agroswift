<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Product_Item extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-product-item';
    }
    public function get_title() {
        return 'WC Product (N)';
    }
    public function get_icon() {
        return 'eicon-image-box';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query_section',
            [
                'label' => esc_html__( 'Query', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Box Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Default', 'agrikon' ),
                    '2' => esc_html__( 'List', 'agrikon' ),
                ],
                'default' => '1'
            ]
        );
        $this->add_control( 'filter_by',
            [
                'label' => esc_html__( 'Show Product By', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'title',
                'options' => [
                    'title' => esc_html__( 'Title', 'agrikon' ),
                    'sku' => esc_html__( 'SKU', 'agrikon' )
                ]
            ]
        );
        // Post Filter Heading
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // Specific Post
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'condition' => [ 'filter_by' => 'title' ]
            ]
        );
        // Specific Post
        $this->add_control( 'post_skus',
            [
                'label' => esc_html__( 'Specific SKU', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'options' => $this->agrikon_woo_get_skus(),
                'description' => 'Select Specific SKU',
                'condition' => [ 'filter_by' => 'sku' ]
            ]
        );
        $this->add_control( 'hidesale',
            [
                'label' => esc_html__( 'Hide Sale Flash', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hideattr',
            [
                'label' => esc_html__( 'Hide Attribute', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hidesave',
            [
                'label' => esc_html__( 'Hide Save Price', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hiderating',
            [
                'label' => esc_html__( 'Hide Rating', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hidebrand',
            [
                'label' => esc_html__( 'Hide Brand', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'hidetimer',
            [
                'label' => esc_html__( 'Hide Timer', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('product_post_style_section',
            [
                'label' => esc_html__( 'Post Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'post_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid',
            ]
        );
        $this->add_responsive_control( 'post_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'post_hvrbordercolor',
            [
                'label' => esc_html__( 'Hover Border Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'brands_heading',
            [
                'label' => esc_html__( 'BRANDS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'brands_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands',
            ]
        );
        $this->add_control( 'brands_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'brands_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'brands_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'brands_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_title a:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'stars_heading',
            [
                'label' => esc_html__( 'STARS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'stars_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .star-rating' => 'font-size: {{SIZE}}px;height: {{SIZE}}px;',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .star-rating span' => 'padding-top: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control( 'price_heading',
            [
                'label' => esc_html__( 'PRICE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_price span.price',
            ]
        );
        $this->add_control( 'price_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_price span.price' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'sale_price_color',
            [
                'label' => esc_html__( 'Sale Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce div.product span.price ins' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'attr_heading',
            [
                'label' => esc_html__( 'ATTRIBUTE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'attr_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,{{WRAPPER}} .woocommerce .shop-product_grid .product-save_label',
            ]
        );
        $this->add_control( 'attr_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'attr_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'attr_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .product-attr_label,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product-save_label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_control( 'flash_heading',
            [
                'label' => esc_html__( 'FLASH SALE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flash_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .shop-product_badge',
            ]
        );
        $this->add_control( 'flash_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .shop-product_badge' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'flash_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge::after' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'flash_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .shop-product_badge::after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .shop-product_badge' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control( 'flash_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale,
                    {{WRAPPER}} .woocommerce .shop-product_grid .shop-product_badge::after,
                    {{WRAPPER}} .woocommerce .shop-product_badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('buttons_style_section',
            [
                'label' => esc_html__( 'Button Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button'
                ]
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button),
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'btn_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover'
                ]
            ]
        );
        $this->add_responsive_control( 'btn_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid .added_to_cart.wc-forward:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_cart_button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .product_type_simple:not(.add_to_cart_button):hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .button.yith-wcqv-button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .add_to_wishlist.button:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcwl-add-to-wishlist:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .agrikon-btn-quick-view:hover,
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function product_type() {
        $settings  = $this->get_settings_for_display();
        return $settings['type'];
    }

    public function excerpt_limit() {
        $settings  = $this->get_settings_for_display();
        return $settings['excerpt_limit'];
    }
    protected function render() {
        //global $wp_query;
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        if ( class_exists( 'WooCommerce' ) ) {
            
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 1,
            );

            if ( 'sku' == $settings['filter_by'] ) {

                if ( $settings['post_skus'] ) {

                    $args['meta_query'] = [
                        [
                            'key'     => '_sku',
                            'value'   => $settings['post_skus'],
                            'compare' => '='
                        ]
                    ];
                }

            } else {

                if ( $settings['post_filter'] ) {
                    $args['post__in'] = array($settings['post_filter']);
                }
            }

            if ( 'yes' == $settings['hideattr'] ) {
                remove_action( 'agrikon_loop_product_details', 'agrikon_product_attr_label' );
            }
            if ( 'yes' == $settings['hidesave'] ) {
                remove_action( 'agrikon_loop_product_details', 'agrikon_product_save_price' );
            }
            if ( 'yes' == $settings['hidebrand'] ) {
                remove_action( 'agrikon_loop_product_details', 'agrikon_wc_product_brand' );
            }
            if ( 'yes' == $settings['hidesale'] ) {
                remove_action( 'agrikon_loop_product_thumb', 'agrikon_product_badge' );
            }
            if ( 'yes' == $settings['hiderating'] ) {
                remove_action( 'agrikon_loop_product_thumb', 'agrikon_product_rating' );
            }
            if ( 'yes' == $settings['hidetimer'] ) {
                remove_action( 'agrikon_loop_product_thumb', 'agrikon_wc_product_countdown' );
            }
            if ( 'yes' != $settings['hideexcerpt'] && '2' == $settings['type'] ) {
                add_action( 'agrikon_loop_product_title', 'agrikon_product_excerpt', 20 );
            }

            add_filter( 'agrikon_product_type', [ $this, 'product_type' ] );
            add_filter( 'agrikon_hide_column', '__return_false' );
            add_filter( 'agrikon_excerpt_limit', [ $this, 'excerpt_limit' ] );

            $the_query = new \WP_Query( $args );
            if ( $the_query->have_posts() ) {

                echo '<div class="product-item woocommerce">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();

                        wc_get_template_part( 'content', 'product' );

                    }
                echo '</div>';
            }
            wp_reset_postdata();

            remove_filter( 'agrikon_product_type', [ $this, 'product_type' ] );
            remove_filter( 'agrikon_hide_column', '__return_false' );
            remove_filter( 'agrikon_excerpt_limit', [ $this, 'excerpt_limit' ] );

            if ( 'yes' == $settings['hideattr'] ) {
                add_action( 'agrikon_loop_product_details', 'agrikon_product_attr_label' );
            }
            if ( 'yes' == $settings['hidesave'] ) {
                add_action( 'agrikon_loop_product_details', 'agrikon_product_save_price' );
            }
            if ( 'yes' == $settings['hidebrand'] ) {
                add_action( 'agrikon_loop_product_details', 'agrikon_wc_product_brand' );
            }
            if ( 'yes' == $settings['hidesale'] ) {
                add_action( 'agrikon_loop_product_thumb', 'agrikon_product_badge' );
            }
            if ( 'yes' == $settings['hiderating'] ) {
                add_action( 'agrikon_loop_product_thumb', 'agrikon_product_rating' );
            }
            if ( 'yes' == $settings['hidetimer'] ) {
                add_action( 'agrikon_loop_product_thumb', 'agrikon_wc_product_countdown' );
            }
            if ( 'yes' != $settings['hideexcerpt'] && '2' == $settings['type'] ) {
                remove_action( 'agrikon_loop_product_title', 'agrikon_product_excerpt', 20 );
            }
        }
    }
}
