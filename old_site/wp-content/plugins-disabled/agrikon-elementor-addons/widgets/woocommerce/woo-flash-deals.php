<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Woo_Flash_Deals extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-flash-deals';
    }
    public function get_title() {
        return 'WC Flash Deals (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'flash-deals', AGRIKON_PLUGIN_URL. 'widgets/woocommerce/css/style.css');
        wp_register_script( 'flash-deals', AGRIKON_PLUGIN_URL. 'widgets/woocommerce/js/script.js', [ 'elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'swiper', 'flash-deals' ];
    }
    public function get_script_depends() {
        return [ 'jquery-countdown', 'swiper', 'flash-deals' ];
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
                'label' => esc_html__( 'Select Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slider' => esc_html__( 'Slider', 'agrikon' ),
                    'tabs' => esc_html__( 'Slider Tabbed', 'agrikon' ),
                ],
                'default' => 'slider'
            ]
        );
        $this->add_control( 'scenario',
            [
                'label' => esc_html__( 'Select Scenario', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Select a scenario', 'agrikon' ),
                    'featured' => esc_html__( 'Featured', 'agrikon' ),
                    'on-sale' => esc_html__( 'On Sale', 'agrikon' ),
                    'best' => esc_html__( 'Best Selling', 'agrikon' ),
                    'custom' => esc_html__( 'Specific Categories', 'agrikon' ),
                ],
                'default' => '',
                'separator' => 'before',
                'condition' => [ 'type' => 'slider' ]
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 10
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'tabs'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'slider'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s) to Exclude',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'tabs'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'slider'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'post_include',
            [
                'label' => esc_html__( 'Specific Post(s)', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Specific Post(s)',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'slider'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_all_posts_by_type('product'),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'scenario',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'type',
                            'operator' => '==',
                            'value' => 'slider'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'agrikon' ),
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
                'separator' => 'before',
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
        $this->start_controls_section('counterdown_settings_section',
            [
                'label' => esc_html__( 'Countdown Settings', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'type' => 'slider' ]
            ]
        );
        $this->add_control( 'ctitle',
            [
                'label' => esc_html__( 'Time Title Before', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Ends On:',
            ]
        );
        $this->add_control( 'time',
            [
                'label' => esc_html__( 'Time', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Usage : 01/01/2030 17:00:00', 'agrikon' ),
                'default' => '01/01/2030 17:00:00',
            ]
        );
        $this->add_control( 'showlabel',
            [
                'label' => esc_html__( 'Display Time Labels?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'day',
            [
                'label' => esc_html__( 'Day', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Day', 'agrikon' ),
                'default' => 'Day',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'days',
            [
                'label' => esc_html__( 'Days', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Days', 'agrikon' ),
                'default' => 'Days',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'hour',
            [
                'label' => esc_html__( 'Hour', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Hour', 'agrikon' ),
                'default' => 'Hour',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'hours',
            [
                'label' => esc_html__( 'Hours', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Hours', 'agrikon' ),
                'default' => 'Hours',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'minute',
            [
                'label' => esc_html__( 'Minute', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Minutes', 'agrikon' ),
                'default' => 'Minute',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'minutes',
            [
                'label' => esc_html__( 'Minutes', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Minutes', 'agrikon' ),
                'default' => 'Minutes',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'second',
            [
                'label' => esc_html__( 'Second', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Second', 'agrikon' ),
                'default' => 'Second',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->add_control( 'seconds',
            [
                'label' => esc_html__( 'Seconds', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Label Seconds', 'agrikon' ),
                'default' => 'Seconds',
                'condition' => [ 'showlabel' => 'yes' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_settings_section',
            [
                'label' => esc_html__( 'Slider Options', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View ( Desktop )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 6,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View ( Tablet )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View  ( Mobile )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => [ 'type' => 'slider' ]
            ]
        );
        $this->add_control( 'mousewheel',
            [
                'label' => esc_html__( 'Mouse wheel', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [ 'type' => 'slider' ]
            ]
        );
        $this->add_control( 'navs',
            [
                'label' => esc_html__( 'Nav', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Space Between Items', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('time_style_settings',
            [
                'label' => esc_html__( 'Time Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'time_title_heading',
            [
                'label' => esc_html__( 'TIME TITLE BEFORE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_title_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .box-timer h5',
            ]
        );
        $this->add_control( 'time_title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box-timer h5' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'time_heading',
            [
                'label' => esc_html__( 'TIME', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .box-time-list li span',
            ]
        );
        $this->add_control( 'time_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box-time-list li span' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'time_background',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .box-time-list li' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'time_label_heading',
            [
                'label' => esc_html__( 'TIME LABEL', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_label_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .timer-grid .box-time-date span.wf-second',
            ]
        );
        $this->add_control( 'time_label_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .timer-grid .box-time-date span.wf-second' => 'color:{{VALUE}};' ],
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
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'navs' => 'yes' ]
            ]
        );
        $this->add_control( 'slider_nav_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,
                    {{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
                ],
            ]
        );
        $this->add_control( 'slider_nav_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-next,
                    {{WRAPPER}} .thm-wc-slider__wrapper .swiper-button-prev' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );
        $this->start_controls_tabs( 'slider_nav_tabs');
        $this->start_controls_tab( 'slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'nav_bgclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['
               {{WRAPPER}} .slide-controls .swiper-button-next,
               {{WRAPPER}} .slide-controls .swiper-button-prev' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['
               {{WRAPPER}} .slide-controls .swiper-button-next,
               {{WRAPPER}} .slide-controls .swiper-button-prev' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '
                {{WRAPPER}} .slide-controls .swiper-button-next,
                {{WRAPPER}} .slide-controls .swiper-button-prev',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'nav_hvrbgclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['
               {{WRAPPER}} .slide-controls .swiper-button-next:hover,
               {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['
               {{WRAPPER}} .slide-controls .swiper-button-next:hover,
               {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '
                {{WRAPPER}} .slide-controls .swiper-button-next:hover,
                {{WRAPPER}} .slide-controls .swiper-button-prev:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'position: absolute;top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    public function agrikon_tab_product_content($args=null) {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        if ( class_exists( 'WooCommerce' ) ) {
            
            if ( 'tabs' != $settings['type'] ) {

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
                    $args['orderby'] = $settings['orderby'];

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
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $product = new \WC_Product(get_the_ID());

                    echo '<div class="swiper-slide product_item">';

                        wc_get_template_part( 'content', 'product' );

                    echo '</div>';
                }
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

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        if ( class_exists( 'WooCommerce' ) ) {

            $time = $settings['time'] ? $settings['time'] : '';
            $day  = $settings['day'];
            $days = $settings['days'];
            $hr   = $settings['hour'];
            $hrs  = $settings['hours'];
            $min  = $settings['minute'];
            $mins = $settings['minutes'];
            $sec  = $settings['second'];
            $secs = $settings['seconds'];

            if ( $settings['showlabel'] == 'yes' ) {

                $tdays    = '<span class="days_text wf-second">'.$days.'</span>';
                $thours   = '<span class="hours_text wf-second">'.$hrs.'</span>';
                $tminutes = '<span class="minutes_text wf-second">'.$mins.'</span>';
                $tseconds = '<span class="seconds_text wf-second">'.$secs.'</span>';

            }

            $countdowndata = 'data-countdown-options=\'{"date":"'.$time.'","day":"'.$day.'","days":"'.$days.'","hour":"'.$hr.'","hours":"'.$hrs.'","minute":"'.$min.'","minutes":"'.$mins.'","second":"'.$sec.'","seconds":"'.$secs.'"}\'';

            $speed     = $settings['speed'] ? $settings['speed'] : 1000;
            $perview   = $settings['perview'] ? $settings['perview'] : 3;
            $mdperview = $settings['mdperview'] ? $settings['mdperview'] : 3;
            $smperview = $settings['smperview'] ? $settings['smperview'] : 2;
            $space     = $settings['space'] ? $settings['space'] : 15;
            $autoplay  = 'yes' == $settings['autoplay'] ? 'true' : 'false';
            $mousewheel= 'yes' == $settings['mousewheel'] ? 'true' : 'false';
            $loop      = 'slider' == $settings['type'] && 'yes' == $settings['loop'] ? 'true' : 'false';

            $sliderdata = 'data-swiper-options=\'{"slidesPerView": 1,"spaceBetween": '.$space.',"speed": '.$speed.',"loop": '.$loop.',"autoplay": '.$autoplay.',"mousewheel": '.$mousewheel.',"navigation": {"nextEl": ".slide-prev-'.$elementid.'","prevEl": ".slide-next-'.$elementid.'"},"breakpoints": {"0": {"spaceBetween": 0,"slidesPerView": '.$smperview.'},"768": {"slidesPerView": '.$mdperview.'},"1024": {"slidesPerView": '.$perview.'}}}\'';

            $tabbed = 'tabs' == $settings['type'] ? '-tabbed' : '';

            echo '<div class="wc-flash-deals--slider'.$tabbed.' woocommerce show-items-'.$perview.'">';

                if ( 'tabs' == $settings['type'] ) {

                    $tabs = get_terms(
                        array(
                            'taxonomy' => 'product_cat',
                            'order' => $settings['order'],
                            'orderby' => $settings['orderby'],
                            'exclude' => $settings['category_exclude']
                        )
                    );

                    echo '<div class="tab">';
                        if ( $tabs ) {
                            $count = 1;
                            echo '<div class="tab_nav">';
                                foreach ( $tabs as $tab ) {
                                    $is_active = 1 == $count ? ' is-active' : '';
                                    if ( $tab->name ) {
                                    	echo '<a class="tab_nav_item'.$is_active.'" href="#" data-id="'.$tab->slug.'_'.$elementid.'">'.$tab->name.'</a>';
                                    }
                                    $count++;
                                }
                            echo '</div>';
                        }

                        $counttwo = 1;

                        foreach ( $tabs as $tab ) {

                            $is_active = 1 == $counttwo ? ' is-active' : '';
                            echo '<div class="tab_slider tab_page'.$is_active.'" id="tab_category_'.$elementid.'" data-id="'.$tab->slug.'_'.$elementid.'">';
                                echo '<div class="thm-wc-slider__wrapper new-arriavls">';
                                    echo '<div class="thm-swiper__slider swiper-container" id="'.$tab->slug.'_'.$elementid.'" data-swiper-options=\'{
                                        "slidesPerView": 1,
                                        "spaceBetween": '.$space.',
                                        "speed": '.$speed.',
                                        "loop": false,
                                        "autoplay": '.$autoplay.',
                                        "observer": true,
                                        "observeParents": true,
                                        "navigation": {
                                            "nextEl": ".slide-prev-'.$elementid.$counttwo.'",
                                            "prevEl": ".slide-next-'.$elementid.$counttwo.'"
                                        },
                                        "breakpoints": {
                                            "0": {
                                                "spaceBetween": 0,
                                                "slidesPerView": '.$smperview.'
                                            },
                                            "768": {
                                                "slidesPerView": '.$mdperview.'
                                            },
                                            "1024": {
                                                "slidesPerView": '.$perview.'
                                            }
                                        }
                                    }\'>';
                                        echo '<div class="swiper-wrapper">';
                                            $args = array(
                                                'post_type' => 'product',
                                                'posts_per_page' => $settings['post_per_page'],
                                                'order' => $settings['order'],
                                                'orderby' => $settings['orderby'],
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'product_cat',
                                                        'field' => 'slug',
                                                        'terms' => $tab->slug,
                                                        //'operator' => 'NOT IN',
                                                    )
                                                )
                                            );
                                            $this->agrikon_tab_product_content($args);
                                        echo '</div>';
                                        if ( 'yes' == $settings['navs'] ) {
                                            echo '<div class="swiper-button-prev slide-prev-'.$elementid.$counttwo.'"><i class="agrikon-icon-left-arrow"></i></div>';
                                            echo '<div class="swiper-button-next slide-next-'.$elementid.$counttwo.'"><i class="agrikon-icon-right-arrow"></i></div>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            $counttwo++;
                        }

                    echo '</div>';

                } else {

                    echo '<div class="thm-wc-slider__wrapper">';
                        if ( $settings['time'] ) {
                            echo '<div class="new-arriavls-title-wrapper type_slider">';
                                if ( $settings['time'] ) {
                                    echo '<div class="box-timer">';
                                        if ( $settings['ctitle'] ) {
                                            echo '<h5>'.$settings['ctitle'].'</h5>';
                                        }

                                        echo '<div class="countbox_1 timer-grid" '.$countdowndata.'>';
                                            $has_label = 'yes' == $settings['showlabel'] ? 'has-time-label' : 'time-label-none';
                                            echo '<ul class="box-time-list '.$has_label.'">';
                                                echo '<li class="box-time-date"><span class="days wf-first">00</span>'.$tdays.'</li>';
                                                echo '<li class="box-time-date"><span class="hours wf-first">00</span>'.$thours.'</li>';
                                                echo '<li class="box-time-date"><span class="minutes wf-first">00</span>'.$tminutes.'</li>';
                                                echo '<li class="box-time-date"><span class="seconds wf-first">00</span>'.$tseconds.'</li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        }

                        echo '<div class="thm-swiper__slider swiper-container" '.$sliderdata.'>';
                            echo '<div class="swiper-wrapper">';
                                $this->agrikon_tab_product_content($args=null);
                            echo '</div>';
                            if ( 'yes' == $settings['navs'] ) {
                                echo '<div class="swiper-button-prev slide-prev-'.$elementid.'"><i class="agrikon-icon-left-arrow"></i></div>';
                                echo '<div class="swiper-button-next slide-next-'.$elementid.'"><i class="agrikon-icon-right-arrow"></i></div>';
                            }
                        echo '</div>';

                    echo '</div>';
                }
            echo '</div>';
        }

    }
}
