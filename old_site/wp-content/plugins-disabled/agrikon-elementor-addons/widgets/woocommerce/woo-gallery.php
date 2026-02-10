<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Gallery extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-gallery';
    }
    public function get_title() {
        return 'WC Gallery (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded','isotope' ];
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
        // Order
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'featured' => esc_html__( 'Featured', 'agrikon' ),
                    'on-sale' => esc_html__( 'On Sale', 'agrikon' ),
                    'best' => esc_html__( 'Best Selling', 'agrikon' ),
                    'custom' => esc_html__( 'Specific Categories', 'agrikon' ),
                ],
                'default' => 'custom'
            ]
        );
        // Posts Per Page
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20
            ]
        );
        $this->add_control( 'hide_filters',
            [
                'label' => esc_html__( 'Hide Filters', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes'
            ]
        );
        $this->add_control( 'all_text',
            [
                'label' => esc_html__( 'All Text', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All Products',
                'label_block' => true,
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        // Category Filter Heading
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'CATEGORY', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // Category Filter
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
        // Exclude Category
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
            ]
        );
        // Post Filter Heading
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'POST', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // Specific Post
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
        // Exclude Post
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
            ]
        );
        // Other Filter Heading
        $this->add_control( 'post_other_heading',
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
        // Other Filter Heading
        $this->add_control( 'post_column_heading',
            [
                'label' => esc_html__( 'COLUMN', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'colxl',
            [
                'label' => esc_html__( 'Column Width', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '6',
                'options' => [
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                    '4' => esc_html__( '3 Column', 'agrikon' ),
                    '3' => esc_html__( '4 Column', 'agrikon' )
                ],
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Tablet Column Width', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '3',
                'options' => [
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                    '4' => esc_html__( '3 Column', 'agrikon' ),
                    '3' => esc_html__( '4 Column', 'agrikon' )
                ]
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Phone Column Width', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '3',
                'options' => [
                    '12' => esc_html__( '1 Column', 'agrikon' ),
                    '6' => esc_html__( '2 Column', 'agrikon' ),
                ]
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
        $this->add_control( 'brands_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid a.agrikon-brands' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'brands_bgcolor',
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
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('filters_style_section',
            [
                'label' => esc_html__( 'Filters Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        $this->add_responsive_control( 'filter_spacing',
            [
                'label' => esc_html__( 'Filters Bottom Spacing', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 200
                    ]
                ],
                'selectors' => ['{{WRAPPER}} ul.nav_menu__items.list-unstyled' => 'margin-bottom: {{SIZE}}px;'],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filters_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} li.nav_menu__item',
            ]
        );
        $this->add_control( 'filters_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} li.nav_menu__item' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'filters_hvrcolor',
            [
                'label' => esc_html__( 'Hover / Active Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} li.nav_menu__item:hover,{{WRAPPER}} li.nav_menu__item.is-active' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'filters_brdcolor',
            [
                'label' => esc_html__( 'Border Bottom Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} li.nav_menu__item:after' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        //global $wp_query;
        $settings = $this->get_settings_for_display();
        $elementid = $this->get_id();
        
        if ( class_exists( 'WooCommerce' ) ) {

            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => $settings['post_per_page'],
                'post__in'       => $settings['post_include'],
                'post__not_in'   => $settings['post_exclude'],
                'order'          => $settings['order']
            );

            if ( 'featured' == $settings['scenario'] ) {
               $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    )
                );

            } elseif( 'on-sale' == $settings['scenario'] ) {

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

            } elseif( 'best' == $settings['scenario'] ) {

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
            if ( $settings['category_exclude'] ) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'id',
                        'terms'     => $settings['category_exclude'],
                        'operator'  => 'NOT IN'
                    )
                );
            }

            $product_cat_args = array (
                'taxonomy' => 'product_cat',
                'order' => $settings['order'],
                'orderby' => $settings['orderby'],
                'hide_empty' => true,
                'parent' => 0,
                'exclude' => $settings['category_exclude'],
            );
            $isedit = \Elementor\Plugin::$instance->editor->is_edit_mode() ? ' gallery_editor' : ' gallery_front';
            echo '<div class="gallery-products__wrapper'.$isedit.'">';

                $cats = get_terms( $product_cat_args );
                if ( 'yes' != $settings['hide_filters'] && 'custom' == $settings['scenario'] && $cats > 1 ) {
                    echo '<div class="wc_gallery__filter">';
                        echo '<nav class="nav_menu">';
                            echo '<ul class="nav_menu__items list-unstyled">';
                                $count_posts = wp_count_posts( 'product' )->publish;
                                $tooltipone = '';
                                //$tooltipone = 'yes' != $settings['hide_tooltip'] ? ' data-agrikon-ui-tooltip=\'{"position":"top","content":"'.$count_posts.'"}\'' : '';
                                echo '<li class="nav_menu__item is-active"><a class="nav_menu__link" href="#" data-agrikon-isotope-filter=\'{"name":"gallery_'.$elementid.'", "selector":"*"}\'>'.$settings['all_text'].'</a></li>';
                                foreach ($cats as $cat) {
                                    $filter_item = mb_strtolower(str_replace(' ', '-', $cat->name));
                                    echo '<li class="nav_menu__item"><a class="nav_menu__link" href="#" data-agrikon-isotope-filter=\'{"name":"gallery_'.$elementid.'", "selector":".'.$filter_item.'"}\'>'.$cat->name.'</a></li>';
                                }
                            echo '</ul>';
                        echo '</nav>';
                    echo '</div>';
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
                if( $the_query->have_posts() ) {
                    echo '<div class="wc_gallery__grid woocommerce">';
                        echo '<div data-agrikon-isotope=\'{"name":"gallery_'.$elementid.'","itemSelector":".grid_col","layoutMode":"fitRows"}\'>';
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                global $product;
                                $terms = $product->get_category_ids();
                                $termname = array();
                                foreach ( $terms as $term ) {
                                    $term = get_term_by( 'id', $term, 'product_cat' );
                                    array_push($termname, mb_strtolower(str_replace(' ', '-', $term->name)));
                                }

                                $col  = $settings['colsm'] ? ' col-sm-'.$settings['colsm'] : ' col-sm-6';
                                $col .= $settings['collg'] ? ' col-lg-'.$settings['collg'] : ' col-lg-3';
                                $col .= $settings['colxl'] ? ' col-xl-'.$settings['colxl'] : ' col-xl-4';
                                $col .= ' '.implode(' ', $termname);

                                echo '<div class="grid_col col-12'.$col.'">';
                                    wc_get_template_part( 'content', 'product' );
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
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
            // Not in edit mode
            if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
                <script>
                jQuery(document).ready(function ($) {
                    function agrikonIsotopee() {
                        $('.gallery_editor').each(function () {
                            var myEl = $(this);
                            var myIsotopes = myEl.find('[data-agrikon-isotope]');
                            if (myIsotopes.length) {
                                myIsotopes.each(function (i, el) {
                                    var myIsotope = $(el);
                                    var myData    = myIsotope.data('agrikonIsotope');
                                    if (!myData.itemSelector) {
                                        return true; // next iteration
                                    }
                                    myIsotope.imagesLoaded(function() {
                                        // Isotope Options
                                        var myIsotopeOptions = {
                                            percentPosition: true,
                                            layoutMode: myData.layoutMode || 'masonry',
                                            itemSelector: myData.itemSelector,
                                            masonry: {
                                                columnWidth: '.grid_sizer'
                                            }
                                        };
                                        // Isotope Init
                                        myIsotope.isotope(myIsotopeOptions);
                                        // Isotope Filter
                                        var myFilters = myEl.find('[data-agrikon-isotope-filter]');
                                        if ( myFilters.length ) {
                                            var myFilters    = myFilters.filter(function (i, el) {
                                                var myFilter = $(el);
                                                var myFilterData = myFilter.data('agrikonIsotopeFilter');
                                                return myFilterData.name === myData.name && myFilterData.selector;
                                            });
                                            if (myFilters.length) {
                                                myFilters.on('click', function (e) {
                                                    e.preventDefault();
                                                    var myFilter = $(this);
                                                    var myFilterData = myFilter.data('agrikonIsotopeFilter');
                                                    var myFilterSelector = myFilterData.selector;
                                                    var myFilterParent = myFilter.parent();
                                                    myFilterParent.siblings().removeClass('is-active');
                                                    myFilterParent.addClass('is-active');
                                                    myIsotope.isotope({filter: myFilterSelector});
                                                });
                                            }
                                        }
                                    });
                                });
                            }
                        });
                    }
                    agrikonIsotopee();
                });
                </script>
                <?php
            }
        }
    }
}
