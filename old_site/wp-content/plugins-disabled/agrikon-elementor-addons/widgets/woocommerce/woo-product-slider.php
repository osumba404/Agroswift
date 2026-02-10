<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Slider extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-slider';
    }
    public function get_title() {
        return 'WC Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function get_style_depends() {
        return [ 'slick' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
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
                'default' => 'newest'
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20
            ]
        );
        // Category Filter Heading
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'agrikon' ),
                'type' => Controls_Manager::HEADING
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
                'label' => esc_html__( 'Post Filter', 'agrikon' ),
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
                'options' => $this->agrikon_cpt_get_post_title('product'),
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
                'options' => $this->agrikon_cpt_get_post_title('product'),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after',
            ]
        );
        // Other Filter Heading
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'agrikon' ),
                'type' => Controls_Manager::HEADING
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
                'default' => 'ASC'
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
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_woo_product_slider_text_settings',
            [
                'label' => esc_html__('Section Text', 'agrikon'),
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Hot deals of the week',
                'label_block' => true,
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sollicitudin elit et lectus scelerisque aliquet. Aenean vitaemi. Mauris at augue vel tortor suscipit cursus.',
                'label_block' => true,
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Discover',
                'label_block' => true,
            ]
        );
        $this->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_img',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .section-custom-2',
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
                'selectors' => ['{{WRAPPER}} .woocommerce .shop-product_grid' => 'color: {{VALUE}};',
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
        if ( defined( 'YITH_WCBR' ) ) {
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
        }
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
                'selector' => '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .yith-wcbm-badge',
            ]
        );
        $this->add_control( 'flash_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .yith-wcbm-badge' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'flash_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce .shop-product_grid span.onsale, {{WRAPPER}} .woocommerce .yith-wcbm-badge' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .yith-wcbm-badge::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .shop-product_grid:hover .yith-wcbm-badge' => 'background-color: {{VALUE}};',
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
                    {{WRAPPER}} .woocommerce .shop-product_grid .yith-wcbm-badge::after,
                    {{WRAPPER}} .woocommerce .yith-wcbm-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    {{WRAPPER}} .woocommerce .shop-product_grid .compare.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        global $wp_query;
        $settings = $this->get_settings_for_display();

        if ( class_exists( 'WooCommerce' ) ) {

            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
            $target   = $settings['btn_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $settings['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

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

            } elseif('on-sale' == $settings['scenario']) {

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

            } elseif('best' == $settings['scenario']) {

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

            echo '<div class="section-custom-2">';
                echo '<div class="container">';
                    echo '<div class="slider-deals" data-ntr-slider-deals>';
                        if ( $settings['title'] || $settings['desc'] || $settings['btn_title']) {
                            echo '<div class="slider-deals_heading" data-ntr-animation=\'{"name":"fadein-up"}\'>';
                                if ($settings['title']) {
                                    echo '<h2 class="slider-deals_title">'.$settings['title'].'</h2>';
                                }
                                if ($settings['desc']) {
                                    echo '<p class="slider-deals_summary">'.$settings['desc'].'</p>';
                                }
                                if ($settings['btn_title']) {
                                    echo '<p>';
                                        echo '<a class="link is-color-secondary" href="'.$settings['btn_link']['url'].'"'.$target.$nofollow.'>';
                                            echo '<span class="link_text">'.$settings['btn_title'].'</span>';
                                            echo '<span class="link_icon icon is-next"></span>';
                                        echo '</a>';
                                    echo '</p>';
                                }
                            echo '</div>';
                        }

                        $the_query = new \WP_Query( $args );
                        if( $the_query->have_posts() ) {
                            echo '<div class="slider-deals_products woocommerce">';
                                echo '<div class="slick-slider">';
                                    while ($the_query->have_posts()) {
                                        $the_query->the_post();
                                        echo '<div class="slick-slide">';
                                            wc_get_template_part( 'content', 'product' );
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        wp_reset_postdata();
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        }
    }
}
