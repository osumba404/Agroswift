<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Mega_Menu extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-mega-menu';
    }
    public function get_title() {
        return 'Header Mega Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        //wp_register_style( 'agrikon-hamburgers', AGRIKON_PLUGIN_URL. 'widgets/mega-menu/hamburgers.css');
        wp_register_style( 'agrikon-mega-menu', AGRIKON_PLUGIN_URL. 'widgets/mega-menu/style.css');
        wp_register_script( 'agrikon-mega-menu', AGRIKON_PLUGIN_URL. 'widgets/mega-menu/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'agrikon-mega-menu' ];
    }

    public function get_script_depends() {
        return [ 'agrikon-mega-menu' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('megamenu_general_settings',
            [
                'label' => esc_html__( 'Mega Menu', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Home',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'mega_content_type',
            [
                'label' => esc_html__( 'Content Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'wp-menu' => esc_html__( 'Use Wp Menu', 'agrikon' ),
                    'custom' => esc_html__( 'Custom Content', 'agrikon' )
                ]
            ]
        );
        // Exclude Category
        $repeater->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
                'condition' => [ 'mega_content_type' => 'wp-menu' ]
            ]
        );
        $repeater->add_control( 'menu_layout_type',
            [
                'label' => esc_html__( 'Menu Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical-menu',
                'options' => [
                    'vertical-menu' => esc_html__( 'Vertical', 'agrikon' ),
                    'horizontal-menu' => esc_html__( 'Horizontal', 'agrikon' )
                ],
                'condition' => [ 'mega_content_type' => 'wp-menu' ],
                'separator' => 'before'
            ]
        );
        $repeater->add_control( 'mega_menu_column',
            [
                'label' => esc_html__( 'Column Width', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'column-4',
                'options' => [
                    'column-2' => esc_html__( '2 Column', 'agrikon' ),
                    'column-3' => esc_html__( '3 Column', 'agrikon' ),
                    'column-4' => esc_html__( '4 Column', 'agrikon' ),
                    'column-5' => esc_html__( '5 Column', 'agrikon' ),
                    'column-6' => esc_html__( '6 Column', 'agrikon' ),
                ],
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'mega_menu_column_height',
            [
                'label' => esc_html__( 'Column Height', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'column-auto',
                'options' => [
                    'column-auto' => esc_html__( 'Auto', 'agrikon' ),
                    'column-h-full' => esc_html__( '100%', 'agrikon' ),
                ],
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'mega_menu_column_gap',
            [
                'label' => esc_html__( 'Gap Between Column', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'column-gap-5',
                'options' => [
                    'column-gap-1' => esc_html__( '1px', 'agrikon' ),
                    'column-gap-2' => esc_html__( '2px', 'agrikon' ),
                    'column-gap-3' => esc_html__( '3px', 'agrikon' ),
                    'column-gap-4' => esc_html__( '4px', 'agrikon' ),
                    'column-gap-5' => esc_html__( '5px', 'agrikon' ),
                    'column-gap-6' => esc_html__( '6px', 'agrikon' ),
                    'column-gap-7' => esc_html__( '7px', 'agrikon' ),
                    'column-gap-8' => esc_html__( '8px', 'agrikon' ),
                    'column-gap-9' => esc_html__( '9px', 'agrikon' ),
                    'column-gap-10' => esc_html__( '10px', 'agrikon' ),
                    'column-gap-15' => esc_html__( '15px', 'agrikon' ),
                    'column-gap-20' => esc_html__( '20px', 'agrikon' ),
                    'column-gap-25' => esc_html__( '25px', 'agrikon' ),
                    'column-gap-30' => esc_html__( '30px', 'agrikon' ),
                ],
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'container_max_width',
            [
                'label' => esc_html__( 'Container Max Width ( % )', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 20,
                        'max' => 100
                    ]
                ],
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'opac_effect',
            [
                'label' => esc_html__( 'Opacity on Hover Column?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'mega_menu_column_action',
            [
                'label' => esc_html__( 'Column Open Action', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'column-auto',
                'options' => [
                    'column-action-hover' => esc_html__( 'On Hover', 'agrikon' ),
                    'column-action-click' => esc_html__( 'On Click', 'agrikon' ),
                ],
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ]
            ]
        );
        $repeater->add_control( 'header_horizontal_menu_alignment',
            [
                'label' => esc_html__( 'Menu Item Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'text-left',
                'condition' => [ 'menu_layout_type' => 'horizontal-menu' ],
            ]
        );
        $repeater->add_responsive_control( 'flyout',
            [
                'label' => esc_html__( 'Flyout Submenu', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flyout-left' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'flyout-right' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'flyout-left',
                'condition' => [ 'mega_content_type' => 'wp-menu' ]
            ]
        );
        $repeater->add_control( 'megamenu_content',
            [
                'label' => esc_html__( 'Mega Menu Content', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->agrikon_get_elementor_templates(),
                'condition' => [ 'mega_content_type' => 'custom' ]
            ]
        );
        $this->add_control( 'menus',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{name}}',
                'default' => [
                    [
                        'name' => 'Home',
                    ],
                    [
                        'name' => 'Home',
                    ],
                    [
                        'name' => 'Home',
                    ],
                ]
            ]
        );
        $this->add_control( 'sticky',
            [
                'label' => esc_html__( 'Sticky Header?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_style_controls_section',
            [
                'label' => esc_html__( 'Desktop Header Container', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'header_desktop_heading',
            [
                'label' => esc_html__( 'HEADER CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'header_desktop_bg',
            [
                'label' => esc_html__( 'Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} header.nt-header.nt-desktop' => 'background:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'header_desktop_height',
            [
                'label' => esc_html__( 'Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 50,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} header.nt-header' => 'height:{{VALUE}}px;',
                    '{{WRAPPER}} .nt-header .template-content' => 'height:calc( 100% - {{VALUE}}px )',
                    '.admin-bar {{WRAPPER}} .template-content' => 'height:calc( 100% - ( {{VALUE}}px + 32px ) )',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'header_desktop_bxshdw',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} header.nt-header.nt-desktop',
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_desktop_primary_a_controls',
            [
                'label' => esc_html__( 'Desktop Menu Primary Items', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'header_desktop_alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center',
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list' => 'justify-content:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'menu_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_item_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ul.nt-primary-list>li>a'
            ]
        );
        $this->add_control( 'menu_item_padding',
            [
                'label' => esc_html__( 'Width ( Inner Spacing )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a' => 'padding-left: {{VALUE}}px;padding-right:{{VALUE}}px;' ]
            ]
        );
        $this->add_control( 'menu_item_gap',
            [
                'label' => esc_html__( 'Gap between Items', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-desktop ul.nt-primary-list>li:not(:first-child)>a' => 'margin-left: {{VALUE}}px;']
            ]
        );
        $this->start_controls_tabs( 'menu_item_tabs');
        $this->start_controls_tab( 'menu_item_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'menu_a_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a' => 'color:{{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_a_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_a_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a'
            ]
        );
        $this->add_control( 'menu_a_brdrad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_a_bxshd',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover / Active', 'agrikon' ) ]
        );
        $this->add_control( 'menu_a_hcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a:hover' => 'color:{{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'menu_a_hbg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_a_hbrd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a:hover'
            ]
        );
        $this->add_control( 'menu_a_hbrdrad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'menu_a_hbxshd',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list>li>a:hover',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_desktop_vertical_submenu_controls',
            [
                'label' => esc_html__( 'Desktop Vertical Submenu', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'vertial_submenu_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu'
            ]
        );
        $this->add_control( 'vertial_submenu_brdrad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'vertial_submenu_bxshdw',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'vertial_submenu_a_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'vertial_submenu_a_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ul.nt-primary-list>li>a'
            ]
        );
        $this->add_control( 'vertial_submenu_a_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->start_controls_tabs( 'v_submenu_item_tabs');
        $this->start_controls_tab( 'v_submenu_item_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'v_submenu_a_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu li.menu-item-has-children > a:before' => 'border-color:{{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'v_submenu_a_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'v_submenu_a_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a'
            ]
        );
        $this->add_control( 'v_submenu_a_brdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'v_submenu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover / Active', 'agrikon' ) ]
        );
        $this->add_control( 'v_submenu_a_hcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a:hover' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu li.menu-item-has-children > a:hover:before' => 'border-color:{{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'v_submenu_a_hbg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'v_submenu_a_hbrd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a:hover'
            ]
        );
        $this->add_control( 'v_submenu_a_hbrdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu >li >a:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'v_submenu_top_offset',
            [
                'label' => esc_html__( 'Submenu > Submenu Top Offset ( Negatif )', 'agrikon' ),
                'description' => esc_html__( 'You can use this option for Submenu vertical position', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-desktop ul.nt-primary-list li.primary-item.vertical-menu .sub-menu .sub-menu' => 'top: calc( 100% - {{VALUE}}px );' ],
                'separator' => 'before',
                'condition' => [ 'v_submenu_a_brd_border!' => '' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_desktop_horizontal_submenu_controls',
            [
                'label' => esc_html__( 'Desktop Horizontal Submenu', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'horizontal_submenu_container_heading',
            [
                'label' => esc_html__( 'CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_submenu_bg',
                'label' => esc_html__( 'Container Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu> .container-wrapper > .container'
            ]
        );
        $this->add_control( 'horizontal_submenu_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu> .container-wrapper > .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'horizontal_submenu_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu> .container-wrapper > .container'
            ]
        );
        $this->add_control( 'horizontal_submenu_brdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu> .container-wrapper > .container' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'horizontal_submenu_bxshdw',
                'label' => esc_html__( 'Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu> .container-wrapper > .container',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'horizontal_submenu_column_heading',
            [
                'label' => esc_html__( 'COLUMN', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_submenu_column_bg',
                'label' => esc_html__( 'Container Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper .sub-menu.row > li'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'horizontal_submenu_column_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper .sub-menu.row > li'
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'horizontal_submenu_column_bxshdw',
                'label' => esc_html__( 'Hover Column Box Shadow', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper .sub-menu.row > li.menu-item-has-children.has-shadow',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'horizontal_submenu_column_padding',
            [
                'label' => esc_html__( 'Column Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu > .container-wrapper .container .row > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_control( 'horizontal_submenu_column_label_heading',
            [
                'label' => esc_html__( 'COLUMN LABEL ( First Item )', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'horizontal_submenu_column_label_typo',
                'label' => esc_html__( 'Column Label Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a'
            ]
        );
        $this->add_control( 'horizontal_submenu_column_label_color',
            [
                'label' => esc_html__( 'Column Label Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a:before' => 'border-color:{{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'horizontal_submenu_column_label_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a'
            ]
        );
        $this->add_control( 'horizontal_submenu_column_label_brdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_submenu_column_label_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row >li.menu-item-has-children> a'
            ]
        );
        $this->add_control( 'horizontal_submenu_a_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'horizontal_submenu_a_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a'
            ]
        );
        $this->add_control( 'horizontal_submenu_a_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->start_controls_tabs( 'horizontal_submenu_item_tabs');
        $this->start_controls_tab( 'horizontal_submenu_item_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'horizontal_submenu_a_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li.menu-item-has-children > a:before' => 'border-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_submenu_a_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'horizontal_submenu_a_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a'
            ]
        );
        $this->add_control( 'horizontal_submenu_a_brdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'horizontal_submenu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover / Active', 'agrikon' ) ]
        );
        $this->add_control( 'horizontal_submenu_a_hcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a:hover' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li.menu-item-has-children > a:hover:before' => 'border-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'horizontal_submenu_a_hbg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a:hover'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'horizontal_submenu_a_hbrd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a:hover'
            ]
        );
        $this->add_control( 'horizontal_submenu_a_hbrdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-desktop li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row .sub-menu li a:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_mobile_menu_controls',
            [
                'label' => esc_html__( 'Mobile Menu', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'mobile_breakpoint',
            [
                'label' => esc_html__( 'Mobile Menu Breakpoint', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 480,
                'max' => 1400,
                'step' => 50,
                'default' => 992
            ]
        );
        $this->add_control( 'header_mobile_height',
            [
                'label' => esc_html__( 'Mobile Header Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 50,
                'max' => 300,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} header.nt-header.nt-mobile' => 'height:{{VALUE}}px;',
                    '{{WRAPPER}} .nt-header.nt-mobile .template-content' => 'height:calc( 100% - {{VALUE}}px )',
                    '.admin-bar {{WRAPPER}} .nt-mobile .template-content' => 'height:calc( 100% - ( {{VALUE}}px + 32px ) )',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_mobile_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} header.nt-header.nt-mobile'
            ]
        );
        $this->add_control( 'header_mobile_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} header.nt-header.nt-mobile' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .nt-mobile .hamburger-wrapper' => 'padding: 0;',

                ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->add_control( 'header_mobile_toggle_btn_heading',
            [
                'label' => esc_html__( 'TOGGLE BUTTON', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_control( 'header_mobile_toggle_btn_alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'center',
                'selectors' => [ '{{WRAPPER}} .nt-header.nt-mobile .hamburger-wrapper' => 'justify-content:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'mobile_menu_toggle',
            [
                'label' => esc_html__( 'Toggle Button Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-mobile .hamburger-inner, {{WRAPPER}} .nt-mobile .hamburger-inner::after, {{WRAPPER}} .nt-mobile .hamburger-inner::before' => 'background-color:{{VALUE}};'
                ],
            ]
        );
        $this->add_control( 'mobile_menu_toggle_close',
            [
                'label' => esc_html__( 'Toggle Button Close Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-mobile .hamburger.is-active .hamburger-inner, {{WRAPPER}} .nt-mobile .hamburger.is-active .hamburger-inner::after, {{WRAPPER}} .nt-mobile .hamburger.is-active .hamburger-inner::before' => 'background-color:{{VALUE}};'
                ],
            ]
        );
        $this->add_control( 'header_mobile_a_heading',
            [
                'label' => esc_html__( 'MENU ITEMS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator'=> 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_mobile_a_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .nt-mobile li.primary-item > a'
            ]
        );
        $this->add_control( 'header_mobile_a_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-mobile li.primary-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->start_controls_tabs( 'header_mobile_item_tabs');
        $this->start_controls_tab( 'header_mobile_item_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'header_mobile_a_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item .sub-menu > li > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile .primary-item.template-wrapper > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile .primary-item.menu-item-has-children > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item > a:before,{{WRAPPER}} .nt-mobile li.primary-item .sub-menu > li > a:before' => 'border-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_mobile_a_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' =>'{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile li.primary-item > a,{{WRAPPER}} .nt-mobile li.primary-item .sub-menu > li > a',

            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_mobile_a_brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile li.primary-item > a,{{WRAPPER}} .nt-mobile li.primary-item .sub-menu > li > a',
            ]
        );
        $this->add_control( 'header_mobile_a_brdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children > a,{{WRAPPER}} .nt-mobile li.primary-item > a,{{WRAPPER}} .nt-mobile li.primary-item .sub-menu > li > a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'header_mobile_hover_tab',
            [ 'label' => esc_html__( 'Active', 'agrikon' ) ]
        );
        $this->add_control( 'header_mobile_a_hcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children.show > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children.show > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item.show > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item.show .sub-menu > li.show > a' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile .primary-item.template-wrapper.show > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile .primary-item.menu-item-has-children.show > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children.show > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children.show > a:before' => 'border-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-mobile li.primary-item.show > a:before,{{WRAPPER}} .nt-mobile li.primary-item.show .sub-menu > li.show > a:before' => 'border-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_mobile_a_hbg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' =>'{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show .sub-menu > li.show > a',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'header_mobile_a_hbrd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show .sub-menu > li.show > a',
            ]
        );
        $this->add_control( 'header_mobile_a_hbrdad',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [ '{{WRAPPER}} .nt-mobile li.primary-item.menu-item-has-children.horizontal-menu .sub-menu.row > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile ul.nt-primary-list li.primary-item.vertical-menu > .sub-menu > li.menu-item-has-children.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show > a,{{WRAPPER}} .nt-mobile li.primary-item.show .sub-menu > li.show > a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_template_content_controls',
            [
                'label' => esc_html__( 'Template Container', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'header_template_content_height',
            [
                'label' => esc_html__( 'Max Height ( % )', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-header.nt-desktop .template-content, {{WRAPPER}} .nt-header.nt-mobile .template-content' => 'height:{{VALUE}}%',
                    '.admin-bar {{WRAPPER}} .nt-header.nt-desktop .template-content, .admin-bar {{WRAPPER}} .nt-header.nt-mobile .template-content' => 'height:calc( {{VALUE}}% - 32px )',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'header_template_content_bg',
                'label' => esc_html__( 'Background', 'agrikon' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .nt-header.nt-desktop .template-content, {{WRAPPER}} .nt-header.nt-mobile .template-content'
            ]
        );
        $this->add_control( 'header_template_content_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .nt-header.nt-desktop .template-content, {{WRAPPER}} .nt-header.nt-mobile .template-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => ''
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    public function agrikon_megamenu_prefix_nav_description( $item_output, $item, $depth, $args ) {
        if ( !empty( $item->description ) ) {
            $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description" data-color="' . $item->description . '">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
        }

        return $item_output;
    }

    protected function render()
    {
        $settings  = $this->get_settings_for_display();
        $id        = $this->get_id();
        $count = 0;
        $countt = 0;

        $sticky = 'yes' == $settings['sticky'] ? ' is-sticky-header' : '';

        add_filter( 'walker_nav_menu_start_el', [$this, 'agrikon_megamenu_prefix_nav_description'], 10, 4 );

        echo '<header class="nt-header nt-desktop'.$sticky.'" data-breakpoint="'.$settings['mobile_breakpoint'].'">';

            echo '<div class="hamburger-wrapper"><div class="hamburger hamburger--elastic">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </div></div>';

            echo '<nav  id="navigation" class="nt-navbar-primary">';
                echo '<ul class="nt-primary-list">';
                    foreach ( $settings['menus'] as $item ) {
                        $args = array(
                            'menu' => $item['register_menus'],
                            'container' => '',
                            'container_class' => '',
                            'container_id' => '',
                            'menu_class' => 'sub-menu',
                            'menu_id' => '',
                        );
                        if ( !empty($item['megamenu_content'] ) || $item['register_menus'] ) {

                            if ( 'custom' == $item['mega_content_type'] && !empty( $item['megamenu_content'] ) ) {

                                echo '<li class="primary-item template-wrapper"><a href="#0">'.$item['name'].'</a>';
                                    echo '<div class="content-wrapper">';
                                        echo '<div class="template-content">';
                                            $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                                            $template_id = $item['megamenu_content'];
                                            $mega_content = new Frontend;
                                            echo $mega_content->get_builder_content_for_display($template_id, $style );
                                        echo '</div>';
                                    echo '</div>';
                                echo '</li>';
                            }

                            if ( 'wp-menu' == $item['mega_content_type'] && $item['register_menus'] ) {

                                if ( 'vertical-menu' == $item['menu_layout_type'] ) {
                                    echo '<li class="primary-item menu-item-has-children vertical-menu '.$item['flyout'].'"><a href="#0">'.$item['name'].'</a>';
                                    echo wp_nav_menu( $args );
                                    echo '</li>';
                                } else {
                                    $opac_effect = 'yes' != $item['opac_effect'] ? ' hide-opac' : ' has-opac';

                                    $max_width = !empty($item['container_max_width']['size']) ? ' style="max-width:'.$item['container_max_width']['size'].'%;"' : '';
                                    echo '<li class="primary-item menu-item-has-children horizontal-menu"><a href="#0">'.$item['name'].'</a>';
                                        echo '<div class="container-wrapper'.$opac_effect.'">';
                                            echo '<div class="container '.$item['header_horizontal_menu_alignment'].' '.$item['flyout'].' '.$item['mega_menu_column_height'].' '.$item['mega_menu_column_action'].' '.$item['mega_menu_column_gap'].' '.$item['mega_menu_column'].'"'.$max_width.'>';

                                            $args = array(
                                                'menu' => $item['register_menus'],
                                                'container' => '',
                                                'container_class' => '',
                                                'container_id' => '',
                                                'menu_class' => 'sub-menu row',
                                                'menu_id' => '',
                                            );
                                            echo wp_nav_menu( $args );
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</li>';
                                }
                            }
                        }
                    }
                echo '</ul>';
            echo '</nav>';
        echo '</header>';
        remove_filter( 'walker_nav_menu_start_el', [$this, 'agrikon_megamenu_prefix_nav_description'], 10, 4 );
    }
}
