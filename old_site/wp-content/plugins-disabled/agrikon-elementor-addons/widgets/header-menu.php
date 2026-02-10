<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Header_Menu extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-menu';
    }
    public function get_title() {
        return 'Header Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('menu_general_settings',
            [
                'label' => esc_html__( 'General', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Exclude Category
        $this->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'agrikon' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->registered_nav_menus(),
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Color Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'main-header__one',
                'options' => [
                    'main-header__one' => esc_html__( 'Solid', 'agrikon' ),
                    'main-header__two' => esc_html__( 'Transparent', 'agrikon' )
                ]
            ]
        );
        $this->add_control( 'position',
            [
                'label' => esc_html__( 'Position', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'pos-absolute',
                'options' => [
                    'pos-absolute' => esc_html__( 'Absolute', 'agrikon' ),
                    'pos-relative' => esc_html__( 'Relative', 'agrikon' )
                ],
                'condition' => ['type' => 'main-header__two']
            ]
        );
        $this->add_control( 'reverse',
            [
                'label' => esc_html__( 'Reverse Header?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'bottom_brd',
            [
                'label' => esc_html__( 'Bottom Line?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['type' => 'main-header__two']
            ]
        );
        $this->add_control( 'sticky',
            [
                'label' => esc_html__( 'Sticky?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hideripped',
            [
                'label' => esc_html__( 'Hide Bottom Ripped Image?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'logo',
            [
                'label' => esc_html__( 'Logo?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'uselogo',
            [
                'label' => esc_html__( 'Use Custom Logo?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'mainlogo',
            [
                'label' => esc_html__( 'Main Logo', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_control( 'stickylogo',
            [
                'label' => esc_html__( 'Sticky Logo', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'full',
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_control( 'moblogo',
            [
                'label' => esc_html__( 'Mobile Logo', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail3',
                'default' => 'full',
                'condition' => ['uselogo' => 'yes']
            ]
        );
        $this->add_control( 'search',
            [
                'label' => esc_html__( 'Search?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'search_type',
            [
                'label' => esc_html__( 'Search Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'def',
                'options' => [
                    'def' => esc_html__( 'Post', 'agrikon' ),
                    'product' => esc_html__( 'Product', 'agrikon' )
                ],
                'condition' => ['search' => 'yes']
            ]
        );
        $this->add_control( 'carticon',
            [
                'label' => esc_html__( 'Cart Icon?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'contactbtn',
            [
                'label' => esc_html__( 'Contact Button?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'contactbtnhtml',
            [
                'label' => esc_html__( 'Contact Button', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<a href="tel:92-666-888-0000" class="main-header__info-phone">
<i class="agrikon-icon-phone-call"></i>
<span class="main-header__info-phone-content">
<span class="main-header__info-phone-text">Call Anytime</span>
<span class="main-header__info-phone-title">92 666 888 0000</span>
</span>
</a>',
                'label_block' => true,
                'condition' => ['contactbtn' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'style_section',
            [
                'label' => esc_html__( 'Menu Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'container_heading',
            [
                'label' => esc_html__( 'HEADER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'container_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .main-menu .container, {{WRAPPER}} .main-menu .container-fluid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'header_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu,{{WRAPPER}} .main-menu__two' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'sticky_bgcolor',
            [
                'label' => esc_html__( 'Sticky Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .stricky-header,{{WRAPPER}} .main-menu__two.stricky-header' => 'background-color:{{VALUE}};' ],
                'condition' => ['sticky' => 'yes']
            ]
        );
        $this->add_control( 'typetrans_brdcolor',
            [
                'label' => esc_html__( 'Border Bottom Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu__two' => 'border-bottom-color:{{VALUE}};' ],
                'condition' => ['type' => 'main-header__two']
            ]
        );
        $this->add_control( 'menu_heading',
            [
                'label' => esc_html__( 'MAIN MENU', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'agrikon' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .main-menu .main-menu__list, {{WRAPPER}} .stricky-header .main-menu__list' => '{{VALUE}};'],
                'options' => [
                    'margin-left:0' => [
                        'title' => esc_html__( 'Left', 'agrikon' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'margin:auto' => [
                        'title' => esc_html__( 'Center', 'agrikon' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'margin-right:0' => [
                        'title' => esc_html__( 'Right', 'agrikon' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'left'
            ]
        );
        $this->add_responsive_control( 'menu_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .main-menu .main-menu__list > li,{{WRAPPER}} .stricky-header .main-menu__list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'menu_line',
            [
                'label' => esc_html__( 'Bottom Line?', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .main-menu .main-menu__list > li > a, {{WRAPPER}} .stricky-header .main-menu__list > li > a'
            ]
        );
        $this->add_control( 'menu_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list > li > a, {{WRAPPER}} .stricky-header .main-menu__list > li > a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'menu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list > li.current > a, {{WRAPPER}} .main-menu .main-menu__list > li:hover > a, {{WRAPPER}} .stricky-header .main-menu__list > li.current > a, {{WRAPPER}} .stricky-header .main-menu__list > li:hover > a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_heading',
            [
                'label' => esc_html__( 'SUBMENU', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'submenu_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list li ul li:hover > a, .stricky-header .main-menu__list li ul li:hover > a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list li ul li:hover > a, {{WRAPPER}} .stricky-header .main-menu__list li ul li:hover > a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list li ul li > a, {{WRAPPER}} .stricky-header .main-menu__list li ul li > a' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'submenu_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list li ul li:hover > a, {{WRAPPER}} .stricky-header .main-menu__list li ul li:hover > a' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_heading',
            [
                'label' => esc_html__( 'MOBILE MENU', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mobmenu_togglecolor',
            [
                'label' => esc_html__( 'Toggle Button Bar Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-header__two .main-menu .mobile-nav__toggler' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_hvrtogglecolor',
            [
                'label' => esc_html__( 'Hover Button Bar Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-header__two .main-menu .mobile-nav__toggler:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-nav__content' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_overlay',
            [
                'label' => esc_html__( 'Overlay Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-nav__overlay' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mobmenu_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .mobile-nav__content .main-menu__list li a'
            ]
        );
        $this->start_controls_tabs( 'mobmenu_tabs');
        $this->start_controls_tab( 'mobmenu_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'mobmenu_color',
            [
                'label' => esc_html__( 'Menu Item', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-nav__content .main-menu__list li a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_down_bgcolor',
            [
                'label' => esc_html__( 'Dropdown Button Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-nav__content .main-menu__list li a button' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobmenu__brd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .mobile-nav__content .main-menu__list li:not(:last-child)'
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'mobmenu_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'mobmenu_hvrcolor',
            [
                'label' => esc_html__( 'Menu Item', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .mobile-nav__content .main-menu__list li a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'mobmenu_down_hvrbgcolor',
            [
                'label' => esc_html__( 'Dropdown Button Background', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .main-menu .main-menu__list li ul li:hover > a, {{WRAPPER}} .stricky-header .main-menu__list li ul li:hover > a' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'mobmenu_hvrbrd',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .mobile-nav__content .main-menu__list li:not(:last-child):hover'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    public function agrikon_content_custom_search_form2()
    {
        $pleace_holder = '' != agrikon_settings( 'searchform_placeholder1' ) ? agrikon_settings( 'searchform_placeholder1' ) : esc_html__( 'Search Here...', 'agrikon' );
        $form = '<form class="agrikon_search" role="search" method="get" id="content-widget-searchform2" action="' . esc_url( home_url( '/' ) ) . '" >
        <label for="cws" class="sr-only">'. esc_html( $pleace_holder ) .'</label>
        <input class="search_input" type="text" value="' . get_search_query() . '" placeholder="'. esc_attr( $pleace_holder ) .'" name="s" id="cws2">
        <button class="thm-btn" id="contentsearchsubmit2" type="submit"><span class="fa fa-search"></span></button>
        </form>';
        return $form;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $css = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? ' style="height:96px;"' : '';
        $type = 'main-header__two' == $settings['type'] ? ' main-menu__two' : '';
        $pos = 'main-header__two' == $settings['type'] ? ' '.$settings['position'] : '';
        $bot_line = 'main-header__two' == $settings['type'] && 'yes' != $settings['bottom_brd'] ? ' hide-line' : '';
        $hideripped = 'yes' == $settings['hideripped'] ? ' ripped-off' : '';
        $reverse = 'yes' == $settings['reverse'] ? ' reverse' : '';
        $hasmoblogo = !empty( $settings['moblogo']['url'] ) ? ' has-mobile-logo' : '';
        $hasstickylogo = !empty( $settings['stickylogo']['url'] ) ? ' has-sticky-logo' : '';

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }
        $size2 = $settings['thumbnail2_size'] ? $settings['thumbnail2_size'] : 'full';
        if ( 'custom' == $size2 ) {
            $sizew2 = $settings['thumbnail2_custom_dimension']['width'];
            $sizeh2 = $settings['thumbnail2_custom_dimension']['height'];
            $size2 = [ $sizew2, $sizeh2 ];
        }
        $size3 = $settings['thumbnail3_size'] ? $settings['thumbnail3_size'] : 'full';
        if ( 'custom' == $size3 ) {
            $sizew3 = $settings['thumbnail3_custom_dimension']['width'];
            $sizeh3 = $settings['thumbnail3_custom_dimension']['height'];
            $size3 = [ $sizew3, $sizeh3 ];
        }
        echo '<header class="agrikon-main-header widget-header main-header '.$settings['type'].$pos.'">';
            echo '<nav class="main-menu'.$type.$hideripped.$bot_line.$reverse.'">';
                echo '<div class="container">';

                    echo '<div class="logo-box">';
                        if ( 'yes' == $settings['logo'] ) {
                            if ( 'yes' == $settings['uselogo'] ) {
                                echo '<a href="'.esc_url( home_url( '/' ) ).'"  aria-label="logo image" id="nt-logo" class="header-logo'.$hasmoblogo.$hasstickylogo.'">';
                                    if ( $settings['mainlogo']['url'] ) {
                                        echo wp_get_attachment_image( $settings['mainlogo']['id'], $size, false, ['class'=>'main-logo'] );
                                    }
                                    if ( $settings['stickylogo']['url'] ) {
                                        echo wp_get_attachment_image( $settings['stickylogo']['id'], $size2, false, ['class'=>'main-logo sticky-logo'] );
                                    }
                                    if ( $settings['moblogo']['url'] ) {
                                        echo wp_get_attachment_image( $settings['moblogo']['id'], $size3, false, ['class'=>'main-logo mobile-logo'] );
                                    }
                                echo '</a>';
                            } else {
                                agrikon_logo();
                            }
                        }
                        echo '<span class="fa fa-bars mobile-nav__toggler"></span>';
                    echo '</div>';

                    echo '<ul class="main-menu__list item-line-'.$settings['menu_line'].'">';
                        echo wp_nav_menu(
                            array(
                                'menu' => $settings['register_menus'],
                                'theme_location' => 'header_menu',
                                'container' => '', // menu wrapper element
                                'container_class' => '',
                                'container_id' => '', // default: none
                                'menu_class' => '', // ul class
                                'menu_id' => '', // ul id
                                'items_wrap' => '%3$s',
                                'before' => '', // before <a>
                                'after' => '', // after <a>
                                'link_before' => '', // inside <a>, before text
                                'link_after' => '', // inside <a>, after text
                                'depth' => 4, // '0' to display all depths
                                'echo' => true,
                                'fallback_cb' => 'Agrikon_Wp_Bootstrap_Navwalker::fallback',
                                'walker' => new \Agrikon_Wp_Bootstrap_Navwalker()
                            )
                        );
                    echo '</ul>';

                    if ( 'yes' == $settings['search'] || 'yes' == $settings['carticon'] || $settings['contactbtn'] ) {
                        echo '<div class="main-header__info">';

                            if ( 'yes' == $settings['search'] ) {
                                echo '<a href="#" class="search-toggler main-header__search-btn"><i class="agrikon-icon-magnifying-glass"></i></a>';
                            }

                            if ( class_exists( 'woocommerce' ) && 'yes' == $settings['carticon'] ) {
                                echo '<a class="main-header__cart-btn" href="'.wc_get_cart_url().'"><i class="agrikon-icon-shopping-cart"></i></a>';
                            }

                            if ( 'yes' == $settings['contactbtn'] ) {
                                echo $settings['contactbtnhtml'];
                            }

                        echo '</div>';
                    }
                echo '</div>';
            echo '</nav>';
        echo '</header>';

        if ( 'yes' == $settings['sticky'] ) {
            echo '<div class="stricky-header stricked-menu main-menu'.$type.$hideripped.'">';
                echo '<div class="sticky-header__content"></div>';
            echo '</div>';
        }

        echo '<div class="mobile-nav__wrapper mobile-nav__widget">';
            echo '<div class="mobile-nav__overlay mobile-nav__toggler"></div>';
            echo '<div class="mobile-nav__content">';
                echo '<span class="mobile-nav__close mobile-nav__toggler"><i class="far fa-times"></i></span>';

                if ( 'yes' == $settings['logo'] ) {
                    echo '<div class="logo-box">';
                        if ( 'yes' == $settings['uselogo'] ) {
                            echo '<a href="'.esc_url( home_url( '/' ) ).'"  aria-label="logo image" class="header-logo'.$hasmoblogo.$hasstickylogo.'">';
                                if ( $settings['mainlogo']['url'] ) {
                                    echo wp_get_attachment_image( $settings['mainlogo']['id'], $size, false, ['class'=>'main-logo'] );
                                }
                                if ( $settings['stickylogo']['url'] ) {
                                    echo wp_get_attachment_image( $settings['stickylogo']['id'], $size2, false, ['class'=>'main-logo sticky-logo'] );
                                }
                                if ( $settings['moblogo']['url'] ) {
                                    echo wp_get_attachment_image( $settings['moblogo']['id'], $size3, false, ['class'=>'main-logo mobile-logo'] );
                                }
                            echo '</a>';
                        } else {
                            agrikon_logo();
                        }
                    echo '</div>';
                }

                echo '<div class="mobile-nav__container"></div>';

            echo '</div>';
        echo '</div>';

        if ( 'yes' == $settings['search'] ) {

            add_filter( 'get_search_form', [$this, 'agrikon_content_custom_search_form2'] );
            echo '<div class="search-popup search-popup__widget">';
                echo '<div class="search-popup__overlay search-toggler"></div>';
                echo '<div class="search-popup__content">';
                    if ( 'product' == $settings['search_type'] ) {
                        if ( function_exists( 'aws_get_search_form' ) ) {
                            aws_get_search_form();
                        } else {
                            echo do_shortcode('[agrikon_wc_ajax_search]');
                        }
                    } else {
                        echo $this->agrikon_content_custom_search_form2();
                    }
                echo '</div>';
            echo '</div>';
        }

    }
}
