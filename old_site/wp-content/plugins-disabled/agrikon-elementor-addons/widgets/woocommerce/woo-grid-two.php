<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Grid_Two extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-grid-two';
    }
    public function get_title() {
        return 'WC Grid 2 (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'query_section',
            [
                'label' => esc_html__( 'Query', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'colxl',
            [
                'label' => esc_html__( 'Column XL Device', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'default' => 4
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Column Desktop', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'default' => 4
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column Tablet', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 3,
                'default' => 2
            ]
        );
        $this->add_control( 'per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20
            ]
        );
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'newest' => esc_html__( 'Newest', 'agrikon' ),
                    'featured' => esc_html__( 'Featured', 'agrikon' ),
                    'on-sale' => esc_html__( 'On Sale', 'agrikon' ),
                    'best' => esc_html__( 'Best Selling', 'agrikon' ),
                    'custom' => esc_html__( 'Specific Categories', 'agrikon' ),
                ],
                'default' => 'newest'
            ]
        );
        $this->add_control( 'category_heading',
            [
                'label' => esc_html__( 'CATEGORY FILTER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'condition' => [ 'scenario!' => 'custom' ]
            ]
        );
        $this->add_control( 'post_heading',
            [
                'label' => esc_html__( 'POST FILTER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_include',
            [
                'label' => esc_html__( 'Specific Post(s)', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'condition' => [ 'scenario' => 'custom' ]
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
                'condition' => [ 'scenario!' => 'custom' ]
            ]
        );
        $this->add_control( 'other_heading',
            [
                'label' => esc_html__( 'OTHER FILTER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'agrikon' ),
                    'DESC' => esc_html__( 'Descending', 'agrikon' )
                ],
                'default' => 'DESC'
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'agrikon' ),
                    'menu_order' => esc_html__( 'Menu Order', 'agrikon' ),
                    'rand' => esc_html__( 'Random', 'agrikon' ),
                    'date' => esc_html__( 'Date', 'agrikon' ),
                    'title' => esc_html__( 'Title', 'agrikon' ),
                ],
                'default' => 'id',
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
    public function set_column() {
        $settings = $this->get_settings_for_display();

        $col[] = 'row-cols-1';
        $col[] = $settings['colsm'] ? 'row-cols-sm-' . $settings['colsm'] : 'row-cols-sm-2';
        $col[] = $settings['collg'] ? 'row-cols-lg-' . $settings['collg'] : 'row-cols-lg-3';
        $col[] = $settings['collg'] ? 'row-cols-xl-' . $settings['colxl'] : 'row-cols-xl-4';

        return implode( ' ', $col );
    }
    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();

        if ( class_exists( 'WooCommerce' ) ) {

            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $settings['per_page'],
                'order'          => $settings['order']
            );

            if ( 'custom' == $settings['scenario'] && $settings['post_include'] ) {
                $args['post__in'] = $settings['post_include'];
            }
            if ( 'custom' != $settings['scenario'] && $settings['post_exclude'] ) {
                $args['post__not_in'] = $settings['post_exclude'];
            }

            if ( 'featured' == $settings['scenario'] ) {
               $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    )
                );

            } elseif ( 'on-sale' == $settings['scenario'] ) {

                $args['meta_query'] = array(
                    'relation' => 'OR',
                    array( // Simple products type
                        'key'       => '_sale_price',
                        'value'     => 0,
                        'compare'   => '>',
                        'type'      => 'numeric'
                    ),
                    array( // Variable products type
                        'key'       => '_min_variation_sale_price',
                        'value'     => 0,
                        'compare'   => '>',
                        'type'      => 'numeric'
                    )
                );

            } elseif ( 'best' == $settings['scenario'] ) {

                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'total_sales';

            } else {

                $args['orderby'] = $settings['orderby'];

            }

            if ( $settings['category_include'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'id',
                        'terms'     => $settings['category_include'],
                        'operator'  => 'IN'
                    )
                );
            }
            if ( 'custom' != $settings['scenario'] && $settings['category_exclude'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'id',
                        'terms'     => $settings['category_exclude'],
                        'operator'  => 'NOT IN'
                    )
                );
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

            $the_query = new \WP_Query( $args );
            if ( $the_query->have_posts() ) {
                echo '<div class="row '. $this->set_column() .' woocommerce">';
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        wc_get_template_part( 'content', 'product' );
                    }
                echo '</div>';
            }
            wp_reset_postdata();

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
        }
    }
}
