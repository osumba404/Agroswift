<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;  // If this file is called directly, abort.

class Agrikon_Woo_Category_Slider extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-woo-category-slider';
    }
    public function get_title() {
        return 'WC Category Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon-woo' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'products_slider_items_settings',
            [
                'label' => esc_html__('Products Items', 'agrikon'),
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Data Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'woo',
                'options' => [
                    'woo' => esc_html__( 'WooCommerce', 'agrikon' ),
                    'custom' => esc_html__( 'Custom', 'agrikon' ),
                ]
            ]
        );
        $this->add_control( 'number',
            [
                'label' => esc_html__( 'Limit', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'condition' => [ 'type' => 'woo' ]
            ]
        );
        $this->add_control( 'category_include',
            [
                'label' => esc_html__( 'Category', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->agrikon_cpt_taxonomies('product_cat'),
                'description' => 'Select Category(s)',
                'condition' => [ 'type' => 'woo' ]
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'thumbnail'
            ]
        );
        $this->add_control( 'cat_singular',
            [
                'label' => esc_html__( 'Category Text Singular', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Product',
            ]
        );
        $this->add_control( 'cat_plural',
            [
                'label' => esc_html__( 'Category Text Plural', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Products',
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ],
            ]
        );
        $this->add_control( 'hidecount',
            [
                'label' => esc_html__( 'Hide Count', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hidelabel',
            [
                'label' => esc_html__( 'Hide Label', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hidecat',
            [
                'label' => esc_html__( 'Hide Category', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'products',
            [
                'type' => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'default' => [
                    [
                        'cat' => 'Lemon',
                        'title' => '96',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Tomato',
                        'title' => '91',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Lettuce',
                        'title' => '86',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Patato',
                        'title' => '81',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Mushroom',
                        'title' => '76',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Banana',
                        'title' => '71',
                        'link' => '#0'
                    ],
                    [
                        'cat' => 'Apple',
                        'title' => '66',
                        'link' => '#0'
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Image', 'agrikon' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => ['url' => '']
                    ],
                    [
                        'name' => 'cat',
                        'label' => esc_html__( 'Category', 'agrikon' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => 'Lemon',
                        'pleaceholder' => esc_html__( 'Enter category here', 'agrikon' )
                    ],
                    [
                        'name' => 'count',
                        'label' => esc_html__( 'Count', 'agrikon' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => '56 Products',
                        'pleaceholder' => esc_html__( 'Enter count here', 'agrikon' )
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'agrikon' ),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '#0',
                            'is_external' => 'true'
                        ],
                        'placeholder' => esc_html__( 'Place URL here', 'agrikon' )
                    ]
                ],
                'title_field' => '{{title}}',
                'condition' => [ 'type' => 'custom' ]
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
                'max' => 10,
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
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'box_heading',
            [
                'label' => esc_html__( 'BOX', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card',
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'box_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'box_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'box_bscolor',
            [
                'label' => esc_html__( 'Boxshadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card' => '-webkit-box-shadow: 0 4px 0 0 {{VALUE}};box-shadow: 0 4px 0 0 {{VALUE}};']
            ]
        );
        $this->add_control( 'box_hvrbscolor',
            [
                'label' => esc_html__( 'Hover Boxshadow Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover' => '-webkit-box-shadow: 0 4px 0 0 {{VALUE}};box-shadow: 0 4px 0 0 {{VALUE}};']
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card-image > img',
            ]
        );
        $this->add_responsive_control( 'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'count_heading',
            [
                'label' => esc_html__( 'COUNT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .service-two__card-icon' => 'width: {{SIZE}}px;height: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'count_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card .service-two__card-icon' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .service-two__card-icon' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_color',
            [
                'label' => esc_html__( 'Number Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-icon .grid-cate--count' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'count_hvrcolor',
            [
                'label' => esc_html__( 'Hover Number Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .grid-cate--count' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typo',
                'label' => esc_html__( 'Number Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .service-two__card-icon .grid-cate--count'
            ]
        );
        $this->add_control( 'label_color',
            [
                'label' => esc_html__( 'Label Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .grid-cate--label' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'label_hvrcolor',
            [
                'label' => esc_html__( 'Hover Label Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .grid-cate--label' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => esc_html__( 'Label Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .wc-cats--slider .service-two__card-icon .grid-cate--count'
            ]
        );
        $this->add_control( 'cat_heading',
            [
                'label' => esc_html__( 'CATEGORY', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'cat_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content .title' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'cat_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card:hover .service-two__card-content .title' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .service-two__card-content .title'
            ]
        );
        $this->add_control( 'cat_bg',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cat_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .service-two__card-content',
            ]
        );
        $this->add_responsive_control( 'cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .service-two__card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
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
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next,
               {{WRAPPER}} .slide-controls .swiper-button-prev' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_clr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next,
               {{WRAPPER}} .slide-controls .swiper-button-prev' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next,
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
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next:hover,
               {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'background-color: {{VALUE}};']
           ]
        );
        $this->add_control( 'nav_hvrclr',
           [
               'label' => esc_html__( 'Color', 'agrikon' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => ['{{WRAPPER}} .slide-controls .swiper-button-next:hover,
               {{WRAPPER}} .slide-controls .swiper-button-prev:hover' => 'color: {{VALUE}};']
           ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_hvr_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .slide-controls .swiper-button-next:hover,
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

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = $this->get_id();

        if ( class_exists( 'WooCommerce' ) ) {
            $speed     = $settings['speed'] ? $settings['speed'] : 1000;
            $perview   = $settings['perview'] ? $settings['perview'] : 3;
            $mdperview = $settings['mdperview'] ? $settings['mdperview'] : 3;
            $smperview = $settings['smperview'] ? $settings['smperview'] : 2;
            $space     = $settings['space'] ? $settings['space'] : 15;
            $autoplay  = 'yes' == $settings['autoplay'] ? 'true' : 'false';
            $loop      = 'yes' == $settings['loop'] ? 'true' : 'false';

            $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
            if ( 'custom' == $size ) {
                $sizew = $settings['thumbnail_custom_dimension']['width'];
                $sizeh = $settings['thumbnail_custom_dimension']['height'];
                $size = [ $sizew, $sizeh ];
            }

            echo '<div class="thm-wc-slider__wrapper wc-cats--slider">';
                echo '<div class="thm-swiper__slider swiper-container"
                data-swiper-options=\'{
                    "slidesPerView": 1,
                    "spaceBetween": '.$space.',
                    "speed": '.$speed.',
                    "loop": '.$loop.',
                    "autoplay": '.$autoplay.',
                    "navigation": {
                        "nextEl": ".slide-prev-'.$id.'",
                        "prevEl": ".slide-next-'.$id.'"
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
                        if ('woo' == $settings['type']) {
                            $cats = get_terms(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'number' => $settings['number'],
                                    'order' => $settings['order'],
                                    'orderby' => $settings['orderby'],
                                    'include' => $settings['category_include'],
                                )
                            );
                            foreach ($cats as $cat) {
                                $imgid = get_term_meta($cat->term_id, 'thumbnail_id', true );
                                $imgsrc = wp_get_attachment_url( $imgid );
                                $thumbnone = $imgsrc ? '' : ' thumb-none';
                                echo '<div class="swiper-slide">';
                                    echo '<div class="service-two__card'.$thumbnone.'">';
                                        echo '<a class="grid-cat--item" href="'.esc_url( get_term_link( $cat ) ).'" title="'.$cat->name.'">';
                                            if ( $imgsrc && 'yes' != $settings['hidethumb'] ) {
                                                echo '<div class="service-two__card-image">';
                                                    echo wp_get_attachment_image( $imgid, $size, false, ['class'=>'grid-cate--img s-img'] );
                                                echo '</div>';
                                            }
                                            if ( 'yes' != $settings['hidecount'] || 'yes' != $settings['hidecat'] ) {
                                                echo '<div class="service-two__card-content">';
                                                    if ( 'yes' != $settings['hidecount'] ) {
                                                        echo '<div class="service-two__card-icon">';
                                                            if ( $cat->count > 1 ) {
                                                                echo '<span class="grid-cate--count">'.$cat->count.'</span>';
                                                            }
                                                        echo '</div>';
                                                        if ( 'yes' != $settings['hidelabel'] ) {
                                                            $label = $cat->count > 1 ? $settings['cat_plural'] : $settings['cat_singular'];
                                                            echo '<span class="grid-cate--label">'.$label.'</span>';
                                                        }
                                                    }
                                                    if ( 'yes' != $settings['hidecat'] ) {
                                                        echo '<'.$settings['tag'].' class="title">'.$cat->name.'</'.$settings['tag'].'>';
                                                    }
                                                echo '</div>';
                                            }
                                        echo '</a>';
                                    echo '</div>';
                                echo '</div>';
                            }

                        } else {

                            foreach ( $settings['products'] as $item ) {
                                $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                                echo '<div class="swiper-slide">';
                                    echo '<div class="service-two__card">';
                                        echo '<a class="grid-cat--item" href="'.$item['link']['url'].'" title="'.$item['cat'].'"'.$target.$nofollow.'>';
                                            if ( $item['image']['url'] && 'yes' != $settings['hidethumb'] ) {
                                                echo '<div class="service-two__card-image">';
                                                    echo wp_get_attachment_image( $item['image']['id'], $size, false, ['class'=>'grid-cate--img s-img'] );
                                                echo '</div>';
                                            }
                                            if ( 'yes' != $settings['hidecount'] || 'yes' != $settings['hidecat'] ) {
                                                echo '<div class="service-two__card-content">';
                                                    if ( 'yes' != $settings['hidecount'] ) {
                                                        echo '<div class="service-two__card-icon">';
                                                            if ( $item['count'] ) {
                                                                echo '<span class="grid-cate--count">'.$item['count'].'</span>';
                                                            }
                                                        echo '</div>';
                                                        if ( 'yes' != $settings['hidelabel'] ) {
                                                            $label = $item['count'] > 1 ? $settings['cat_plural'] : $settings['cat_singular'];
                                                            echo '<span class="grid-cate--label">'.$label.'</span>';
                                                        }
                                                    }
                                                    if ( 'yes' != $settings['hidecat'] ) {
                                                        echo '<'.$settings['tag'].' class="title">'.$item['cat'].'</'.$settings['tag'].'>';
                                                    }
                                                echo '</div>';
                                            }
                                        echo '</a>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    echo '</div>';
                    if ( 'yes' == $settings['navs'] ) {
                        echo '<div class="swiper-button-prev slide-prev-'.$id.'"><i class="agrikon-icon-left-arrow"></i></div>';
                        echo '<div class="swiper-button-next slide-next-'.$id.'"><i class="agrikon-icon-right-arrow"></i></div>';
                    }
                echo '</div>';
            echo '</div>';
        }
    }
}
