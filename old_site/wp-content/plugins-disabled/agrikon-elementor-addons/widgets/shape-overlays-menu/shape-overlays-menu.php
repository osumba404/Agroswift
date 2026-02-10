<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Shape_Overlays_Menu extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-shape-overlays-menu';
    }
    public function get_title() {
        return 'Shape Overlay Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'shape-overlays-menu', AGRIKON_PLUGIN_URL. 'widgets/shape-overlays-menu/style.css');
    }
    public function get_style_depends() {
        return [ 'shape-overlays-menu' ];
    }
    public function get_script_depends() {
        return [ 'easings' ];
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        /*****   Button Options   ******/
        $this->start_controls_section('menu_settings',
            [
                'label' => esc_html__( 'Menu', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'demo-1',
                'options' => [
                    'demo-1' => esc_html__( 'Type-1', 'agrikon' ),
                    'demo-2' => esc_html__( 'Type-2', 'agrikon' ),
                    'demo-3' => esc_html__( 'Type-3', 'agrikon' ),
                    'demo-4' => esc_html__( 'Type-4', 'agrikon' ),
                ]
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
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#sectionid',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'agrikon' )
            ]
        );
        $repeater->add_control( 'link_type',
            [
                'label' => esc_html__( 'Link Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'external',
                'options' => [
                    'external' => esc_html__( 'External', 'agrikon' ),
                    'internal' => esc_html__( 'Internal', 'agrikon' ),
                ]
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
                        'link' => '#',
                    ],
                    [
                        'name' => 'Home',
                        'link' => '#',
                    ],
                    [
                        'name' => 'Home',
                        'link' => '#',
                    ],
                ]
            ]
        );
        $this->add_responsive_control( 'max_width',
            [
                'label' => esc_html__( 'Max Width', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'vw',
                    'size' => 100,
                ],
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu.is-opened-navi .content,{{WRAPPER}} .shape-overlays,{{WRAPPER}} .global-menu' => 'width: {{SIZE}}{{UNIT}};']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   Button Options   ******/
        $this->start_controls_section('btn_style_settings',
            [
                'label' => esc_html__( 'Button && Shape Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'btn_anim',
            [
                'label' => esc_html__( 'Glow Animation', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'btn_animcolor',
            [
                'label' => esc_html__( 'Glow Animation Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agrikon-shape-overlay-menu .hamburger::after' => 'border-color: {{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ '%' ],
                'selectors' => ['{{WRAPPER}} .agrikon-shape-overlay-menu .hamburger, {{WRAPPER}} .agrikon-shape-overlay-menu .hamburger::after' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab( 'btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'btn_bgcolor',
            [
                'label' => esc_html__( 'Toggle Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agrikon-shape-overlay-menu .hamburger' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'bar_color',
            [
                'label' => esc_html__( 'Toggle Bar Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .hamburger__line-in::before, {{WRAPPER}} .hamburger__line-in::after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'btn_hvrbgcolor',
            [
                'label' => esc_html__( 'Toggle Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agrikon-shape-overlay-menu .hamburger:hover' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'bar_hvrcolor',
            [
                'label' => esc_html__( 'Toggle Bar Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .hamburger:hover .hamburger__line-in::before,{{WRAPPER}} .hamburger:hover .hamburger__line-in::after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'shape_heading',
            [
                'label' => esc_html__( 'SHAPE COLOR', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'bg_color',
            [
                'label' => esc_html__( 'Overlay Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .demo-1 .shape-overlays__path:nth-of-type(3)' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .demo-2 .shape-overlays__path:nth-of-type(4)' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .demo-3 .shape-overlays__path:nth-of-type(3)' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .demo-4 .shape-overlays__path:nth-of-type(2)' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control( 'shape1_color',
            [
                'label' => esc_html__( 'Shape 1 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .shape-overlays__path:nth-of-type(1)' => 'fill: {{VALUE}};']
            ]
        );
        $this->add_control( 'shape2_color',
            [
                'label' => esc_html__( 'Shape 2 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .shape-overlays__path:nth-of-type(2)' => 'fill: {{VALUE}};']
            ]
        );
        $this->add_control( 'shape3_color',
            [
                'label' => esc_html__( 'Shape 3 Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .shape-overlays__path:nth-of-type(3)' => 'fill: {{VALUE}};']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   Button Options   ******/
        $this->start_controls_section('menu_style_settings',
            [
                'label' => esc_html__( 'Menu Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} nav.agrikon-shape-overlay-menu a'
            ]
        );
        $this->add_responsive_control( 'menu_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a' => 'padding-top: {{TOP}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};padding-bottom: {{BOTTOM}}{{UNIT}};padding-left: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'menu_margin',
            [
                'label' => esc_html__( 'Margin', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a' => 'margin-top: {{TOP}}{{UNIT}};margin-right: {{RIGHT}}{{UNIT}};margin-bottom: {{BOTTOM}}{{UNIT}};margin-left: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs('menu_tabs');
        $this->start_controls_tab( 'menu_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'menu_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} nav.agrikon-shape-overlay-menu a',
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'menu_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('menu_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'menu_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'menu_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} nav.agrikon-shape-overlay-menu a:hover',
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'menu_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} nav.agrikon-shape-overlay-menu a:hover' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $btn_anim = 'yes' != $settings['btn_anim'] ? ' anim-off' : '';
        $demo4 = 'demo-4' != $settings['type'] ? ' hamburger__line-in--demo-4' : '';

        echo '<nav class="main agrikon-shape-overlay-menu '.$settings['type'].'">
            <div class="hamburger-wrapper">
                <div class="hamburger hamburger--'.$settings['type'].' js-hover'.$btn_anim.'">
                    <div class="hamburger__line hamburger__line--01">
                        <div class="hamburger__line-in hamburger__line-in--01'.$demo4.'"></div>
                    </div>
                    <div class="hamburger__line hamburger__line--02">
                        <div class="hamburger__line-in hamburger__line-in--02'.$demo4.'"></div>
                    </div>
                    <div class="hamburger__line hamburger__line--03">
                        <div class="hamburger__line-in hamburger__line-in--03'.$demo4.'"></div>
                    </div>
                    <div class="hamburger__line hamburger__line--cross01">
                        <div class="hamburger__line-in hamburger__line-in--cross01'.$demo4.'"></div>
                    </div>
                    <div class="hamburger__line hamburger__line--cross02">
                        <div class="hamburger__line-in hamburger__line-in--cross02'.$demo4.'"></div>
                    </div>
                </div>
            </div>
        <div class="content">

            <div class="global-menu">
                <div class="global-menu__wrap">';
                    foreach ( $settings['menus'] as $item ) {
                        if ( $item['name'] ) {
                            $link_type = 'internal' == $item['link_type'] ? ' data-scroll-to' : '';
                            echo '<a'.$link_type.' class="global-menu__item global-menu__item--'.$settings['type'].'" href="'.$item['link']['url'].'">'.$item['name'].'</a>';
                        }
                    }
                echo '</div>
            </div>';

            echo '<svg class="shape-overlays" viewBox="0 0 100 100" preserveAspectRatio="none">';
                echo '<path class="shape-overlays__path"></path>';
                echo '<path class="shape-overlays__path"></path>';
                if ( 'demo-4' != $settings['type'] ) {
                    echo '<path class="shape-overlays__path"></path>';
                }
                if ( 'demo-2' == $settings['type'] ) {
                    echo '<path class="shape-overlays__path"></path>';
                }
            echo '</svg>';

        echo '</div>';
        echo '</nav>';
    }
}
