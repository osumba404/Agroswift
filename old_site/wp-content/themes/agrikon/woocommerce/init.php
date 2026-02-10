<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( class_exists( 'Redux' ) && class_exists( 'WooCommerce' ) ) {

    if ( ! function_exists( 'agrikon_dynamic_section' ) ) {
        function agrikon_dynamic_section($sections)
        {

            global $agrikon_pre;

            /*************************************************
            ## SINGLE PAGE SECTION
            *************************************************/
            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Page', 'agrikon'),
                'id' => 'shopsection',
                'icon' => 'el el-shopping-cart-sign',
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__( 'Shop Page Layout', 'agrikon' ),
                'id' => 'shoplayoutsection',
                'subsection'=> true,
                'icon' => 'el el-website',
                'fields'	=> array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'agrikon' ),
                        'subtitle' => esc_html__( 'Choose the shop page layout.', 'agrikon' ),
                        'id' => 'shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                        ),
                        'default' => 'right-sidebar'
                    )
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Hero', 'agrikon'),
                'desc' => esc_html__('These are shop page hero section settings', 'agrikon'),
                'id' => 'shopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'agrikon'),
                        'subtitle' => esc_html__('You can enable or disable the site shop page hero section with switch option.', 'agrikon'),
                        'id' => 'shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                    ),
                    array(
                        'title' => esc_html__( 'Hero Template', 'agrikon' ),
                        'subtitle' => esc_html__( 'Select your header template.', 'agrikon' ),
                        'id' => 'shop_hero_template',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            'default' => esc_html__( 'Deafult Site Hero', 'agrikon' ),
                            'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                        ),
                        'default' => 'default',
                        'required' => array( 'shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                        'id' => 'shop_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => agrikon_get_elementorTemplates(),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'elementor' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'agrikon'),
                        'id' => 'shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-shop-page .page-header__bg' ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Hero Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page Hero Section', 'agrikon'),
                        'id' =>'shop_hero_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .page-header .container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px',
                        ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Custom Page Title', 'agrikon'),
                        'subtitle' => esc_html__('Add your shop page custom title here.', 'agrikon'),
                        'id' => 'shop_title',
                        'type' => 'text',
                        'default' => 'Shop',
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Title Typography', 'agrikon'),
                        'id' => 'shop_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '#nt-shop-page .nt-hero-title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        ),
                        'required' => array(
                            array( 'shop_hero_visibility', '=', '1' ),
                            array( 'shop_hero_template', '=', 'default' )
                        )
                    ),
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page Content', 'agrikon'),
                'id' => 'shopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Container Width', 'agrikon' ),
                        'subtitle' => esc_html__( 'Choose the shop page container width.', 'agrikon' ),
                        'id' => 'shop_container_width',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            '' => esc_html__('Default ( Container )', 'agrikon'),
                            '-fluid' => esc_html__('Container Fluid', 'agrikon'),
                            '-off' => esc_html__('Full Width', 'agrikon'),
                        ),
                        'default' => '',
                    ),
                    array(
                        'title' => esc_html__('Page Content Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page content.', 'agrikon'),
                        'id' =>'shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-shop-page .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Post Type', 'agrikon'),
                        'subtitle' => esc_html__('Select your type.', 'agrikon'),
                        'id' => 'shop_product_type',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            '1' => esc_html__('Type 1', 'agrikon'),
                            '2' => esc_html__('Type 2', 'agrikon'),
                        ),
                        'default' => '1',
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'agrikon'),
                        'subtitle' => esc_html__('You can control post column with this option.', 'agrikon'),
                        'id' => 'shop_colxl',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 4,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post 992px Column ( Responsive: Desktop, Tablet )', 'agrikon'),
                        'subtitle' => esc_html__('You can control post column on max-device width 992px with this option.', 'agrikon'),
                        'id' => 'shop_collg',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post 768px Column ( Responsive: Tablet, Phone )', 'agrikon'),
                        'subtitle' => esc_html__('You can control post column on max-device-width 768px with this option.', 'agrikon'),
                        'id' => 'shop_colsm',
                        'type' => 'slider',
                        'default' =>2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text',
                    ),
                    array(
                        'title' => esc_html__('Post Count', 'agrikon'),
                        'subtitle' => esc_html__('You can control show post count with this option.', 'agrikon'),
                        'id' => 'shop_perpage',
                        'type' => 'slider',
                        'default' => 6,
                        'min' => 1,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text'
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Shop Page After Content', 'agrikon'),
                'id' => 'shopaftercontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates, If you want to show any content after products.', 'agrikon' ),
                        'id' => 'shop_after_page_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => agrikon_get_elementorTemplates()
                    )
                )
            );
            $sections[] = array(
                'title' => esc_html__('Shop Page Post Style', 'agrikon'),
                'id' => 'shoppoststylesubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Custom Color', 'agrikon'),
                        'subtitle' => esc_html__('Change post color.', 'agrikon'),
                        'id' => 'shop_custom_color',
                        'type' => 'color',
                        'default' => '#30aafc',
                        'required' => array( 'shop_theme_color', '=', 'custom' )
                    ),
                    // post button ( view cart )
                    array(
                        'title' => esc_html__('Background Color', 'agrikon'),
                        'subtitle' => esc_html__('Change post background color.', 'agrikon'),
                        'id' => 'shop_post_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap')
                    ),
                    array(
                        'title' => esc_html__('Border', 'agrikon'),
                        'subtitle' => esc_html__('Set your custom border styles for the posts.', 'agrikon'),
                        'id' => 'shop_post_brd',
                        'type' => 'border',
                        'all' => false,
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap')
                    ),
                    array(
                        'title' => esc_html__('Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post.', 'agrikon'),
                        'id' =>'shop_post_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Margin', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post.', 'agrikon'),
                        'id' =>'shop_post_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .product-content-wrap, .woocommerce-page ul.products li.product .product-content-wrap'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    // post itle
                    array(
                        'title' => esc_html__('Title Typography', 'agrikon'),
                        'id' => 'shop_post_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '.woocommerce ul.products li.product .woocommerce-loop-product__title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'agrikon'),
                        'id' =>'shop_post_title_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .woocommerce-loop-product__title'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Margin', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'agrikon'),
                        'id' =>'shop_post_title_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .woocommerce-loop-product__title'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Typography', 'agrikon'),
                        'id' => 'shop_post_price_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '.woocommerce ul.products li.product .price' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'agrikon'),
                        'id' =>'shop_post_price_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .price'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Price Margin', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post title.', 'agrikon'),
                        'id' =>'shop_post_price_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .price'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    // post button ( Add to cart )
                    array(
                        'title' => esc_html__('Button Background ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    array(
                        'title' => esc_html__('Button Border ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce ul.products li.product .button, .woocommerce.single-product .entry-summary button.button.alt')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Border ( Add to cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change theme main color.', 'agrikon'),
                        'id' => 'shop_addtocartbtn_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce ul.products li.product .button:hover, .woocommerce.single-product .entry-summary button.button.alt:hover')
                    ),
                    // post button ( view cart )
                    array(
                        'title' => esc_html__('Button Background ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change button background color.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_bgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Background ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change button hover background color.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background-color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Button Title ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change button title color.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Title ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change button hover title color.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Button Border ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change hover button border style.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Hover Button Border ( View cart )', 'agrikon'),
                        'subtitle' => esc_html__('Change hover button border style.', 'agrikon'),
                        'id' => 'shop_viewcartbtn_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce a.added_to_cart')
                    ),
                    array(
                        'title' => esc_html__('Buttons Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post buttons.', 'agrikon'),
                        'id' =>'shop_postbtn_pad',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Buttons Margin', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site shop page post buttons.', 'agrikon'),
                        'id' =>'shop_postbtn_margin',
                        'type' => 'spacing',
                        'output' => array('.woocommerce ul.products li.product .button,.woocommerce a.added_to_cart'),
                        'mode' => 'margin',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'units' => 'px'
                        )
                    ),
                    array(
                        'title' => esc_html__('Sale Label Background Color', 'agrikon'),
                        'subtitle' => esc_html__('Change sale label background color.', 'agrikon'),
                        'id' => 'shop_sale_bgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce span.onsale,.woocommerce ul.products li.product .onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle')
                    ),
                    array(
                        'title' => esc_html__('Sale Label Text Color', 'agrikon'),
                        'subtitle' => esc_html__('Change sale label text color.', 'agrikon'),
                        'id' => 'shop_sale_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce span.onsale,.woocommerce ul.products li.product .onsale')
                    ),
                    array(
                        'title' => esc_html__('Pagination Background Color', 'agrikon'),
                        'subtitle' => esc_html__('Change shop page pagination background color.', 'agrikon'),
                        'id' => 'shop_pagination_bgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Background Color', 'agrikon'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item background color.', 'agrikon'),
                        'id' => 'shop_pagination_hvrbgcolor',
                        'type' => 'color',
                        'mode' => 'background',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Pagination Text Color', 'agrikon'),
                        'subtitle' => esc_html__('Change shop page pagination text color.', 'agrikon'),
                        'id' => 'shop_pagination_color',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Text Color', 'agrikon'),
                        'subtitle' => esc_html__('Change shop page pagination hover and active item text color.', 'agrikon'),
                        'id' => 'shop_pagination_hvrcolor',
                        'type' => 'color',
                        'default' => '',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Pagination Border', 'agrikon'),
                        'subtitle' => esc_html__('Change pagination item border style.', 'agrikon'),
                        'id' => 'shop_pagination_brd',
                        'type' => 'border',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item .nt-pagination-link')
                    ),
                    array(
                        'title' => esc_html__('Active Pagination Border', 'agrikon'),
                        'subtitle' => esc_html__('Change pagination active item border style.', 'agrikon'),
                        'id' => 'shop_pagination_hvrbrd',
                        'type' => 'border',
                        'output' => array('.woocommerce .nt-pagination .nt-pagination-inner .nt-pagination-item.active .nt-pagination-link')
                    ),
                )
            );


            /*************************************************
            ## SINGLE PAGE SECTION
            *************************************************/
            // create sections in the theme options
            $sections[] = array(
                'title' => esc_html__('Shop Single Page', 'agrikon'),
                'id' => 'singleshopsection',
                'icon' => 'el el-shopping-cart-sign',
            );
            // SHOP PAGE SECTION
            $sections[] = array(
                'title' => esc_html__('General', 'agrikon'),
                'id' => 'singleshopgeneral',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__( 'Page Layout', 'agrikon' ),
                        'subtitle' => esc_html__( 'Choose the single page layout.', 'agrikon' ),
                        'id' => 'single_shop_layout',
                        'type' => 'image_select',
                        'options' => array(
                            'left-sidebar' => array(
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'full-width' => array(
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                            ),
                            'right-sidebar' => array(
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                        ),
                        'default' => 'full-width'
                    ),
                    array(
                        'id' => 'shop_related_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Post Options', 'agrikon'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Related Title', 'agrikon'),
                        'subtitle' => esc_html__('Add your single shop page related section title here.', 'agrikon'),
                        'id' => 'single_shop_related_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Count ( Per Page )', 'agrikon'),
                        'subtitle' => esc_html__('You can control show related post count with this option.', 'agrikon'),
                        'id' => 'single_shop_related_count',
                        'type' => 'slider',
                        'default' => 10,
                        'min' => 1,
                        'step' => 1,
                        'max' => 24,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_related_section_slider_start',
                        'type' => 'section',
                        'title' => esc_html__('Related Slider Options', 'agrikon'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 1024px )', 'agrikon' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                        'id' => 'shop_related_perview',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 768px )', 'agrikon' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                        'id' => 'shop_related_mdperview',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Perview ( Min 480px )', 'agrikon' ),
                        'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'agrikon' ),
                        'id' => 'shop_related_smperview',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 10,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Speed', 'agrikon' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'agrikon' ),
                        'id' => 'shop_related_speed',
                        'type' => 'slider',
                        'default' => 1000,
                        'min' => 100,
                        'step' => 1,
                        'max' => 10000,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Gap', 'agrikon' ),
                        'subtitle' => esc_html__( 'You can control related post slider item gap.', 'agrikon' ),
                        'id' => 'shop_related_gap',
                        'type' => 'slider',
                        'default' => 30,
                        'min' => 0,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Centered', 'agrikon' ),
                        'id' => 'shop_related_centered',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Autoplay', 'agrikon' ),
                        'id' => 'shop_related_autoplay',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Loop', 'agrikon' ),
                        'id' => 'shop_related_loop',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Mousewheel', 'agrikon' ),
                        'id' => 'shop_related_mousewheel',
                        'type' => 'switch',
                        'default' => 0,
                        'on' => 'On',
                        'off' => 'Off',
                        'required' => array( 'single_related_visibility', '=', '1' )
                    ),
                    array(
                        'id' => 'shop_related_section_slider_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_related_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_upsells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Upsells Post Options', 'agrikon'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Upsells Title', 'agrikon'),
                        'subtitle' => esc_html__('Add your single shop page upsells section title here.', 'agrikon'),
                        'id' => 'single_shop_upsells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'agrikon'),
                        'subtitle' => esc_html__('You can control upsells post column with this option.', 'agrikon'),
                        'id' => 'single_shop_upsells_colxl',
                        'type' => 'slider',
                        'default' => 4,
                        'min' => 1,
                        'step' => 1,
                        'max' => 6,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'agrikon'),
                        'subtitle' => esc_html__('You can control upsells post column for tablet device with this option.', 'agrikon'),
                        'id' => 'single_shop_upsells_collg',
                        'type' => 'slider',
                        'default' => 3,
                        'min' => 1,
                        'step' => 1,
                        'max' => 4,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'agrikon'),
                        'subtitle' => esc_html__('You can control upsells post column for phone device with this option.', 'agrikon'),
                        'id' => 'single_shop_upsells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_upsells_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'shop_crosssells_section_start',
                        'type' => 'section',
                        'title' => esc_html__('Cross-Sells Post Options', 'agrikon'),
                        'indent' => true
                    ),
                    array(
                        'title' => esc_html__('Cross-Sells Title', 'agrikon'),
                        'subtitle' => esc_html__('Add your cart page cross-sells section title here.', 'agrikon'),
                        'id' => 'single_shop_crosssells_title',
                        'type' => 'text',
                        'default' => ''
                    ),
                    array(
                        'title' => esc_html__('Post Column', 'agrikon'),
                        'subtitle' => esc_html__('You can control cross-sells post column with this option.', 'agrikon'),
                        'id' => 'single_shop_crosssells_colxl',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 3,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Desktop/Tablet )', 'agrikon'),
                        'subtitle' => esc_html__('You can control cross-sells post column for tablet device with this option.', 'agrikon'),
                        'id' => 'single_shop_crosssells_collg',
                        'type' => 'slider',
                        'default' => 2,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'title' => esc_html__('Post Column ( Phone )', 'agrikon'),
                        'subtitle' => esc_html__('You can control cross-sells post column for phone device with this option.', 'agrikon'),
                        'id' => 'single_shop_crosssells_colsm',
                        'type' => 'slider',
                        'default' => 1,
                        'min' => 1,
                        'step' => 1,
                        'max' => 2,
                        'display_value' => 'text'
                    ),
                    array(
                        'id' => 'shop_crosssells_section_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                )
            );
            // SINGLE HERO SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Hero', 'agrikon'),
                'desc' => esc_html__('These are single page hero section settings!', 'agrikon'),
                'id' => 'singleshopherosubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Hero display', 'agrikon'),
                        'subtitle' => esc_html__('You can enable or disable the site single page hero section with switch option.', 'agrikon'),
                        'id' => 'single_shop_hero_visibility',
                        'type' => 'switch',
                        'default' => 1,
                        'on' => 'On',
                        'off' => 'Off',
                    ),
                    array(
                        'title' => esc_html__( 'Hero Template', 'agrikon' ),
                        'subtitle' => esc_html__( 'Select your header template.', 'agrikon' ),
                        'id' => 'single_shop_hero_template',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => array(
                            'default' => esc_html__( 'Deafult Site Hero', 'agrikon' ),
                            'elementor' => esc_html__( 'Elementor Templates', 'agrikon' ),
                        ),
                        'default' => 'default',
                        'required' => array( 'single_shop_hero_visibility', '=', '1' )
                    ),
                    array(
                        'title' => esc_html__( 'Elementor Templates', 'agrikon' ),
                        'subtitle' => esc_html__( 'Select a template from elementor templates.', 'agrikon' ),
                        'id' => 'single_shop_hero_elementor_templates',
                        'type' => 'select',
                        'customizer' => true,
                        'options' => agrikon_get_elementorTemplates(),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'elementor' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Hero Background', 'agrikon'),
                        'id' => 'single_shop_hero_bg',
                        'type' => 'background',
                        'output' => array( '#nt-woo-single .page-header__bg' ),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Page Title', 'agrikon'),
                        'subtitle' => esc_html__('Add your single shop page title here.', 'agrikon'),
                        'id' => 'single_shop_title',
                        'type' => 'text',
                        'default' => '',
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    ),
                    array(
                        'title' => esc_html__('Title Typography', 'agrikon'),
                        'id' => 'single_shop_title_typo',
                        'type' => 'typography',
                        'font-backup' => false,
                        'letter-spacing' => true,
                        'text-transform' => true,
                        'all_styles' => true,
                        'output' => array( '#nt-woo-single .nt-hero-title' ),
                        'units' => 'px',
                        'default' => array(
                            'color' => '',
                            'font-style' => '',
                            'font-family' => '',
                            'google' => true,
                            'font-size' => '',
                            'line-height' => ''
                        ),
                        'required' => array(
                            array( 'single_shop_hero_visibility', '=', '1' ),
                            array( 'single_shop_hero_template', '=', 'default' )
                        )
                    )
                )
            );
            // SINGLE CONTENT SUBSECTION
            $sections[] = array(
                'title' => esc_html__('Single Content', 'agrikon'),
                'id' => 'singleshopcontentsubsection',
                'subsection' => true,
                'icon' => 'el el-brush',
                'fields' => array(
                    array(
                        'title' => esc_html__('Single Content Padding', 'agrikon'),
                        'subtitle' => esc_html__('You can set the top spacing of the site single page content.', 'agrikon'),
                        'id' =>'single_shop_content_pad',
                        'type' => 'spacing',
                        'output' => array('#nt-woo-single .nt-theme-inner-container'),
                        'mode' => 'padding',
                        'units' => array('em', 'px'),
                        'units_extended' => 'false',
                        'default' => array(
                            'padding-top' => '',
                            'padding-right' => '',
                            'padding-bottom' => '',
                            'padding-left' => '',
                            'units' => 'px'
                        )
                    )
                )
            );
            return $sections;
        }
        add_filter('redux/options/'.$agrikon_pre.'/sections', 'agrikon_dynamic_section');
    }
}

/*************************************************
## REGISTER SIDEBAR FOR WOOCOMMERCE
*************************************************/

if ( !function_exists( 'agrikon_wc_widgets_init' ) ) {
    function agrikon_wc_widgets_init() {
        //Shop page sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Page Sidebar', 'agrikon' ),
            'id' => 'shop-page-sidebar',
            'description' => esc_html__( 'These widgets for the Shop page.','agrikon' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="nt-sidebar-inner-widget-title">',
            'after_title' => '</h3>'
        ) );
        //Single product sidebar
        register_sidebar( array(
            'name' => esc_html__( 'Shop Single Page Sidebar', 'agrikon' ),
            'id' => 'shop-single-sidebar',
            'description' => esc_html__( 'These widgets for the Shop Single page.','agrikon' ),
            'before_widget' => '<div class="nt-sidebar-inner-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="nt-sidebar-inner-widget-title">',
            'after_title' => '</h3>'
        ) );
    }
    add_action( 'widgets_init', 'agrikon_wc_widgets_init' );
}


/*************************************************
## WOOCOMMERCE HERO FUNCTION
*************************************************/

if(! function_exists('agrikon_wc_hero_section')) {
    function agrikon_wc_hero_section()
    {

        if ( class_exists( 'WooCommerce' ) ) {

            if ( is_archive() || is_shop() ) {
                $name = 'shop';
                $h_t  = '' != agrikon_settings('shop_title') ? agrikon_settings('shop_title') : '';
            } elseif ( is_product() ) { // blog and cpt archive page
                $name = 'single_shop';
                $h_t  = '' != agrikon_settings('single_shop_title') ? agrikon_settings('single_shop_title') : '';
            } else {
                $name = 'shop';
                $h_t  = esc_html__('Shop', 'agrikon' );
            }

            if ( '0' != agrikon_settings('shop_hero', '1') ) {

                if ( 'elementor' == agrikon_settings($name.'_hero_template', 'default') ) {

                    if ( class_exists( '\Elementor\Frontend' ) ) {
                        $template_id = agrikon_settings( $name.'_hero_elementor_templates' );
                        if ( !empty( $template_id ) ) {

                            $frontend = new \Elementor\Frontend;
                            printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

                        }
                    }

                } else {

                    echo '<div id="nt-hero" class="page-header text-center page-id-'.get_the_ID().'">
                    <div class="page-header__bg"></div>
                    <div class="container">';

                    // page breadcrumbs
                    if ( '1' == agrikon_settings('breadcrumbs_visibility', '0') ) {
                        agrikon_breadcrumbs();
                    }

                    // page hero title
                    if ( $h_t ) {
                        echo '<h2 class="nt-hero-title page-title mb-10">'.wp_kses($h_t, agrikon_allowed_html()).'</h2>';
                    } else {
                        echo '<h2 class="nt-hero-title page-title mb-10">';
                            woocommerce_page_title();
                        echo '</h2>';
                    }

                    echo '</div>
                    </div>';
                }
            } // hide hero area
        }
    }
}

if ( !function_exists( 'agrikon_after_shop_page' ) ) {
    function agrikon_after_shop_page() {
        if ( class_exists( '\Elementor\Frontend' ) ) {
            $template_id = agrikon_settings( 'shop_after_page_elementor_templates' );
            if ( !empty( $template_id ) ) {

                $frontend = new \Elementor\Frontend;
                printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

            }
        }
    }
    add_action('agrikon_after_wc_shop_page', 'agrikon_after_shop_page', 10);
}

/*************************************************
## ADD CUSTOM CSS FOR WOOCOMMERCE
*************************************************/

if ( !function_exists( 'agrikon_wc_scripts' ) ) {
    function agrikon_wc_scripts()
    {
        $rtl = is_rtl() ? '-rtl' : '';
        wp_enqueue_style( 'agrikon-wc', get_template_directory_uri() . '/woocommerce/woocommerce-custom'.$rtl.'.css',false, '1.0');
        wp_enqueue_script('agrikon-wc', get_template_directory_uri() . '/woocommerce/woocommerce-custom.js', array('jquery'), '1.0', true);
    }
    add_action( 'wp_enqueue_scripts', 'agrikon_wc_scripts' );
}

/*************************************************
## ADD THEME SUPPORT FOR WOOCOMMERCE
*************************************************/

function agrikon_wc_theme_setup() {

    add_theme_support( 'woocommerce' );
	add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 450,
        'single_image_width' => 980,
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'agrikon_wc_theme_setup' );


/*************************************************
## MINICART AND QUICK-VIEW
*************************************************/

include get_template_directory() . '/woocommerce/minicart/actions.php';
include get_template_directory() . '/woocommerce/quick-view/quick-view.php';


/**
* Change number of products that are displayed per page (shop page)
*/
if (!function_exists('agrikon_wc_shop_per_page')) {
    add_filter( 'loop_shop_per_page', 'agrikon_wc_shop_per_page', 20 );
    function agrikon_wc_shop_per_page( $cols ) {

        $cols = agrikon_settings( 'shop_perpage', '6' );

        return $cols;
    }
}

/**
* Change custom product type column
*/
if ( !function_exists('agrikon_wc_product_column') ) {

    function agrikon_wc_product_column() {

        $col[] = 'row-cols-1';
        $col[] = 'row-cols-sm-' . agrikon_settings('shop_colsm', '2');
        $col[] = 'row-cols-lg-' . agrikon_settings('shop_collg', '3');
        $col[] = 'row-cols-xl-' . agrikon_settings('shop_colxl', '4');
        $col = implode( ' ', $col );

        return apply_filters( 'agrikon_product_column', $col );
    }
}

/**
* Change number of upsells products column
*/
if ( !function_exists('agrikon_wc_sells_product_column') ) {

    function agrikon_wc_sells_product_column() {
        $sells = is_cart() ? 'crosssells' : 'upsells';
        $col[] = 'row-cols-1 cart';
        $col[] = 'row-cols-sm-' . agrikon_settings('single_shop_'.$sells.'_colsm', '2');
        $col[] = 'row-cols-lg-' . agrikon_settings('single_shop_'.$sells.'_collg', '3');
        $col[] = 'row-cols-xl-' . agrikon_settings('single_shop_'.$sells.'_colxl', '4');
        $col   = implode( ' ', $col );
        return apply_filters( 'agrikon_wc_sells_column', $col );
    }
}

/**
* Change number of related products output
*/
if ( !function_exists('agrikon_wc_related_products_limit') ) {

    add_filter( 'woocommerce_output_related_products_args', 'agrikon_wc_related_products_limit', 20 );
    function agrikon_wc_related_products_limit( $args ) {
        $args['posts_per_page'] = agrikon_settings('single_shop_related_count', '4'); // 4 related products
        return $args;
    }
}


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'agrikon_product_badge', 10 );
add_action( 'woocommerce_single_product_summary', 'agrikon_wc_single_brand', 45 );

//add_action( 'agrikon_loop_product_details', 'agrikon_product_attr_label', 10 );
add_action( 'agrikon_loop_product_details', 'agrikon_product_save_price', 10 );
add_action( 'agrikon_loop_product_details', 'agrikon_wc_product_brand', 10 );

add_action( 'agrikon_loop_product_title', 'agrikon_product_title', 10 );
add_action( 'agrikon_loop_product_title', 'agrikon_product_price', 10 );

add_action( 'agrikon_loop_product_thumb', 'agrikon_product_badge', 10 );
add_action( 'agrikon_loop_product_thumb', 'agrikon_product_rating', 10 );
add_action( 'agrikon_loop_product_thumb', 'agrikon_product_thumb', 10 );
add_action( 'agrikon_loop_product_thumb', 'agrikon_wc_product_countdown', 10 );
add_action( 'woocommerce_single_product_summary', 'agrikon_wc_product_countdown', 15 );

/**
* Add product save price label
*/
if ( !function_exists('agrikon_product_thumb') ) {
    function agrikon_product_thumb() {
        global $product;
        $size = apply_filters('agrikon_product_thumb_size', '' );
        ?>
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php
            if ( $size ) {
                echo get_the_post_thumbnail( $product->get_id(), $size );
            } else {
                woocommerce_template_loop_product_thumbnail();
            }
            ?>
        </a>
        <?php
    }
}

/**
* Add product save price label
*/
if ( !function_exists('agrikon_product_save_price') ) {
    function agrikon_product_save_price() {
        global $product;
        $discount = get_post_meta( $product->get_id(), 'agrikon_product_discount', true );
        if ( 'yes' != $discount && $product->is_on_sale() && ! $product->is_type('variable') ) {
            $regular = (float) $product->get_regular_price();
            $sale = (float) $product->get_price();
            $precision = 1; // Max number of decimals
            $saving = $sale && $regular ? round( 100 - ( $sale / $regular * 100 ), 1 ) . '%' : '';
            echo $saving ? '<span class="product-save_label">'.$saving.'</span>' : '';
        }
    }
}

/**
* Add product attribute name
*/
if ( !function_exists('agrikon_product_attr_label') ) {
    function agrikon_product_attr_label() {
        global $product;

        $attributes = $product->get_attributes();
        foreach ( $attributes as $attribute ) {
            $values = array();
            $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
                'label' => wc_attribute_label( $attribute->get_name() ),
                'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
            );
            $label = $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ]['label'];
            $value = $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ]['value'];
            echo !empty( $label ) ? '<span class="product-attr_label">'.$label.'</span>' : '';
        }
    }
}

/**
* Add stock progressbar
*/
if ( !function_exists('agrikon_product_stock_progress_bar') ) {
    function agrikon_product_stock_progress_bar() {
        global $product;
        if ( ! $product->get_manage_stock() || 0 == $product->get_stock_quantity() ) {
            return;
        }

        $total_sales = $product->get_total_sales();
        $stock_left  = $product->get_stock_quantity();
        $percent = ( ( $stock_left / ( $total_sales + $stock_left ) ) * 100 ) . '%';

        return '<span class="product-stock_bar" style="width:'.$percent.'">'.$stock_left.'</span>';
    }
}

/**
* Add product rating
*/
if ( !function_exists('agrikon_product_rating') ) {
    function agrikon_product_rating() {
        global $product;
        if ( wc_review_ratings_enabled() && $product->get_average_rating() ) {
            woocommerce_template_loop_rating();
        }
    }
}

/**
* Add product price
*/
if ( !function_exists('agrikon_product_price') ) {
    function agrikon_product_price() {
        global $product;
        if ( $product->get_price_html() ) {
            ?>
            <div class="shop-product_price">
                <?php woocommerce_template_loop_price(); ?>
            </div>
            <?php
        }
    }
}

/**
* Add product excerpt
*/
if ( !function_exists('agrikon_product_excerpt') ) {
    function agrikon_product_excerpt() {
        global $product;
        if ( $product->get_short_description() ) {
            ?>
            <p class="shop-product_excerpt"><?php echo wp_trim_words( $product->get_short_description(), apply_filters( 'agrikon_excerpt_limit', 20 ) ); ?></p>
            <?php
        }
    }
}

/**
* Add product excerpt
*/
if ( !function_exists('agrikon_product_title') ) {
    function agrikon_product_title() {
        ?>
        <div class="shop-product_title">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title(); ?></a>
        </div>
        <?php
    }
}

/**
* Add YITH Brand to product
*/
if ( !function_exists('agrikon_wc_product_brand') ) {
    function agrikon_wc_product_brand() {
        global $product;
        $brands = '';
        $metaid = defined( 'YITH_WCBR' ) ? 'yith_product_brand' : 'agrikon_product_brands';
        $terms = get_the_terms( $product->get_id(), $metaid );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $brands = array();
            foreach ( $terms as $term ) {
                if ( $term->parent == 0 ) {
                    $brands[] = sprintf( '<span class="brands"><a class="agrikon-brands" href="%s" itemprop="brand" title="%s">%s</a></span>',
                        get_term_link( $term ),
                        $term->slug,
                        $term->name
                    );
                }
            }
        }
        echo !empty( $brands ) ? implode( '', $brands ) : '';
    }
}

if ( !function_exists('agrikon_wc_single_brand') ) {
    function agrikon_wc_single_brand() {
        global $product;
        $brands = '';
        $metaid = defined( 'YITH_WCBR' ) ? 'yith_product_brand' : 'agrikon_product_brands';
        $terms = get_the_terms( $product->get_id(), $metaid );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $brands = array();
            foreach ( $terms as $term ) {
                if ( $term->parent == 0 ) {
                    $brands[] = sprintf( '<a class="agrikon-brands" href="%s" itemprop="brand" title="%s">%s</a>',
                        get_term_link( $term ),
                        $term->slug,
                        $term->name
                    );
                }
            }
        }
        echo !empty( $brands ) ? '<span class="brands">'.esc_html__('Brands: ', 'agrikon' ) . implode( ', ', $brands ) .'</span>': '';
    }
}



/*********************************************************
## 1. CUSTOM BADGE LABEL
**********************************************************/

if ( ! function_exists( 'agrikon_product_badge' ) ) {

    function agrikon_product_badge()
    {
        global $product;
        $badge = get_post_meta( $product->get_id(), 'agrikon_badge', true );
        $badge_color = get_post_meta( $product->get_id(), 'agrikon_badge_color', true );
        $badge_custom = get_post_meta( $product->get_id(), 'agrikon_custom_badge', true );
        $badge_color = $badge_color ? $badge_color : 'is-primary';
        $title = '';
        switch ( $badge ) {
            case 'new':
            $title = esc_html__('New','agrikon');
            break;
            case 'hot':
            $title = esc_html__('Hot','agrikon');
            break;
            case 'best':
            $title = esc_html__('Best','agrikon');
            break;
            case 'featured':
            $title = esc_html__('Featured','agrikon');
            break;
            case 'free':
            $title = esc_html__('Free','agrikon');
            break;
            case 'custom':
            $title = $badge_custom;
            break;
            default:
            $title = '';
            break;
        }
        if ( '' != $title ) {
            echo '<div class="shop-product_badge badge--'.esc_attr( $title ).' '.esc_attr( $badge_color ).'">'.esc_html( $title ).'</div>';
        } else {
            if ( $product->is_on_sale() ) {
                echo '<div class="shop-product_badge badge--def '.esc_attr( $badge_color ).'">'.esc_html__( 'Sale!', 'agrikon' ).'</div>';
            }
        }
    }
}

if ( ! function_exists( 'agrikon_wc_product_countdown' ) ) {

    function agrikon_wc_product_countdown()
    {
        global $product;
        $time = get_post_meta( $product->get_id(), 'agrikon_countdown_date', true);

        if ( $time ) {
            wp_enqueue_script( 'jquery-countdown' );
            wp_enqueue_script( 'agrikon-countdown' );
            $data[] = '"date":"'.$time.'"';
            $data[] = '"day":"'.esc_html__('day', 'agrikon').'"';
            $data[] = '"days":"'.esc_html__('days', 'agrikon').'"';
            $data[] = '"hour":"'.esc_html__('hour', 'agrikon').'"';
            $data[] = '"hours":"'.esc_html__('hours', 'agrikon').'"';
            $data[] = '"minute":"'.esc_html__('min', 'agrikon').'"';
            $data[] = '"minutes":"'.esc_html__('mins', 'agrikon').'"';
            $data[] = '"second":"'.esc_html__('sec', 'agrikon').'"';
            $data[] = '"seconds":"'.esc_html__('secs', 'agrikon').'"';
            ?>
            <div class="product-timer" data-countdown-options='{<?php echo implode(', ', $data ); ?>}'>
                <ul class="box-time-list">
                    <li class="box-time-date">
                        <span class="days wf-first">00</span>
                        <span class="days_text wf-second"><?php echo esc_html__('days', 'agrikon'); ?></span>
                    </li>
                    <li class="box-time-date">
                        <span class="hours wf-first">00</span>
                        <span class="hours_text wf-second"><?php echo esc_html__('hours', 'agrikon'); ?></span>
                    </li>
                    <li class="box-time-date">
                        <span class="minutes wf-first">00</span>
                        <span class="minutes_text wf-second"><?php echo esc_html__('mins', 'agrikon'); ?></span>
                    </li>
                    <li class="box-time-date">
                        <span class="seconds wf-first">00</span>
                        <span class="seconds_text wf-second"><?php echo esc_html__('secs', 'agrikon'); ?></span>
                    </li>
                </ul>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_add_field_to_products' ) ) {

    add_action( 'woocommerce_product_options_general_product_data', 'agrikon_add_field_to_products' );
    function agrikon_add_field_to_products()
    {
        woocommerce_wp_select(
            array(
                'id' => 'agrikon_badge',
                'label' => esc_html__( 'Agrikon Badge?', 'agrikon' ),
                'options' => array(
                    '' => 'Select a badge',
                    'new' => esc_html__( 'New', 'agrikon' ),
                    'hot' => esc_html__( 'Hot', 'agrikon' ),
                    'best' => esc_html__( 'Best', 'agrikon' ),
                    'featured' => esc_html__( 'Featured', 'agrikon' ),
                    'free' => esc_html__( 'Free', 'agrikon' ),
                    'custom' => esc_html__( 'Custom', 'agrikon' ),
                ),
                'desc_tip' => false,
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'agrikon_custom_badge',
                'label' => esc_html__( 'Custom Badge Label', 'agrikon' ),
                'description' => esc_html__( 'Add your custom badge label here', 'agrikon' ),
            )
        );
        woocommerce_wp_select(
            array(
                'id' => 'agrikon_badge_color',
                'label' => esc_html__( 'Agrikon Badge Color?', 'agrikon' ),
                'options' => array(
                    '' => 'Select a color',
                    'is-primary' => esc_html__( 'primary', 'agrikon' ),
                    'is-base' => esc_html__( 'base', 'agrikon' ),
                    'is-black' => esc_html__( 'black', 'agrikon' ),
                ),
                'desc_tip'    => false,
            )
        );
        woocommerce_wp_checkbox(
            array(
                'id' => 'agrikon_product_discount',
                'label' => esc_html__( 'Hide Product Discount?', 'agrikon' ),
                'wrapper_class' => 'hide_if_variable',
                'desc_tip' => false,
            )
        );
        woocommerce_wp_text_input(
            array(
                'id' => 'agrikon_countdown_date',
                'label' => esc_html__( 'Date for Countdown', 'agrikon' ),
                'description' => esc_html__( 'Usage : 01/01/2030 17:00:00', 'agrikon' ),
            )
        );
    }
}
/*********************************************************
## 2. SAVE CHECKBOX VIA CUSTOM FIELD
**********************************************************/

if ( ! function_exists( 'agrikon_save_product_custom_field' ) ) {

    add_action( 'save_post', 'agrikon_save_product_custom_field' );
    function agrikon_save_product_custom_field( $product_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return;
        }
        $options = array(
            'agrikon_badge',
            'agrikon_badge_color',
            'agrikon_custom_badge',
            'agrikon_product_discount',
            'agrikon_countdown_date'
        );
        foreach ( $options as $option ) {
            if ( isset( $_POST[$option] ) ) {
                update_post_meta( $product_id, $option, $_POST[$option] );
            } else {
                delete_post_meta( $product_id, $option );
            }
        }
    }
}

/*************************************************
## CUSTOM POST CLASS
*************************************************/

if (! function_exists('nt_agrikon_post_theme_class')) {
    function nt_agrikon_post_theme_class($classes)
    {

        $classes[] = is_single() && has_blocks() ? 'nt-single-has-block' : '';

        return $classes;
    }
    add_filter('post_class', 'nt_agrikon_post_theme_class');
}
