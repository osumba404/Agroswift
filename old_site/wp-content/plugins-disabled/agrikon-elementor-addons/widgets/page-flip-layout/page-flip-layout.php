<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Page_Flip_Layout extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-page-flip-layout';
    }
    public function get_title() {
        return 'Page Flip Layout (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        //wp_deregister_script( 'gsap' );
        wp_register_style( 'page-flip-layout', AGRIKON_PLUGIN_URL. 'widgets/page-flip-layout/style.css');
        wp_register_script( 'page-flip-layout', AGRIKON_PLUGIN_URL. 'widgets/page-flip-layout/script.js');
        
    }
    public function get_style_depends() {
        return [ 'page-flip-layout' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded','gsap','page-flip-layout' ];
    }

    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slide_settings',
            [
                'label' => esc_html__( 'Slides', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'layout',
            [
                'label' => esc_html__( 'Layout', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Layout Type 1', 'agrikon' ),
                    '2' => esc_html__( 'Layout Type 2', 'agrikon' ),
                    '3' => esc_html__( 'Layout Type 3', 'agrikon' ),
                    '4' => esc_html__( 'Layout Type 4', 'agrikon' ),
                    '5' => esc_html__( 'Layout Type 5', 'agrikon' ),
                ]
            ]
        );
        $repeater->add_control( 'layout_message1',
            [
                'label' => esc_html__( 'Important Note', 'agrikon' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => 'Max 4 Image',
                'condition' => ['layout!' => '5']
            ]
        );
        $repeater->add_control( 'layout_message2',
            [
                'label' => esc_html__( 'Important Note', 'agrikon' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => 'Max 2 Image',
                'condition' => ['layout' => '5']
            ]
        );
        $repeater->add_control( 'navtitle',
            [
                'label' => esc_html__( 'Navigation Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '01 Riding on a storm',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'gallery',
            [
                'label' => esc_html__( 'Gallery Images', 'agrikon' ),
                'type' => Controls_Manager::GALLERY,
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'title1',
            [
                'label' => esc_html__( 'First Image Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'desc1',
            [
                'label' => esc_html__( 'Short Description', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Affogato steamed single shot',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'link1',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $repeater->add_control( 'title2',
            [
                'label' => esc_html__( 'First Image Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'desc2',
            [
                'label' => esc_html__( 'Short Description', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Affogato steamed single shot',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'link2',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $repeater->add_control( 'title3',
            [
                'label' => esc_html__( 'First Image Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'desc3',
            [
                'label' => esc_html__( 'Short Description', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Affogato steamed single shot',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'link3',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $repeater->add_control( 'title4',
            [
                'label' => esc_html__( 'First Image Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'desc4',
            [
                'label' => esc_html__( 'Short Description', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Affogato steamed single shot',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'link4',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => ''
                ],
                'show_external' => true,
            ]
        );
        $repeater->add_control( 'slide_bgcolor',
            [
                'label' => esc_html__( 'Slide Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};']
            ]
        );
        $repeater->add_control( 'revealer_color1',
            [
                'label' => esc_html__( 'Revealer Left Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}.revealer__item--left' => 'background-color: {{VALUE}};']
            ]
        );
        $repeater->add_control( 'revealer_color2',
            [
                'label' => esc_html__( 'Revealer Right Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}.revealer__item--left' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'slides',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{navtitle}}',
                'default' => [
                    [
                        'navtitle' => '',
                    ],
                ]
            ]
        );
        $this->add_control( 'show_menu',
            [
                'label' => esc_html__( 'Show Menu', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'menu_title',
            [
                'label' => esc_html__( 'Menu Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Index',
                'label_block' => true,
                'condition' => ['show_menu' => 'yes']
            ]
        );
        $this->add_control( 'title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => [
                    'h1' => esc_html__( 'H1', 'agrikon' ),
                    'h2' => esc_html__( 'H2', 'agrikon' ),
                    'h3' => esc_html__( 'H3', 'agrikon' ),
                    'h4' => esc_html__( 'H4', 'agrikon' ),
                    'h5' => esc_html__( 'H5', 'agrikon' ),
                    'h6' => esc_html__( 'H6', 'agrikon' ),
                    'div' => esc_html__( 'div', 'agrikon' ),
                    'span' => esc_html__( 'span', 'agrikon' ),
                    'p' => esc_html__( 'p', 'agrikon' ),
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('slide_style_settings',
            [
                'label'=> esc_html__( 'Slide Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'border_center_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slideshow .revealer__item--left' => 'border-left-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_border( 'back_image_border','{{WRAPPER}} .slide__figure-inner' );
        $this->agrikon_style_box_shadow( 'back_image_bxshadow','{{WRAPPER}} .slide__figure-inner' );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide__figure-title' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'back_title_typo','{{WRAPPER}} .slide__figure-title' );
        $this->agrikon_style_background( 'back_title_background','{{WRAPPER}} .slide__figure-title' );
        $this->agrikon_style_padding( 'back_title_padding','{{WRAPPER}} .slide__figure-title' );
        $this->agrikon_style_border( 'back_title_border','{{WRAPPER}} .slide__figure-title' );
        $this->agrikon_style_box_shadow( 'back_title_bxshadow','{{WRAPPER}} .slide__figure-title' );
        $this->agrikon_style_text_shadow( 'back_title_txthadow','{{WRAPPER}} .slide__figure-title' );
        $this->add_control( 'desc_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'desc_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide__figure-description' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'desc_typo','{{WRAPPER}} .slide__figure-description' );
        $this->agrikon_style_background( 'desc_background','{{WRAPPER}} .slide__figure-description' );
        $this->agrikon_style_padding( 'desc_padding','{{WRAPPER}} .slide__figure-description' );
        $this->agrikon_style_border( 'desc_border','{{WRAPPER}} .slide__figure-description' );
        $this->agrikon_style_box_shadow( 'desc_bxshadow','{{WRAPPER}} .slide__figure-description' );
        $this->agrikon_style_text_shadow( 'desc_txthadow','{{WRAPPER}} .slide__figure-description' );
        $this->add_control( 'number_heading',
            [
                'label' => esc_html__( 'NUMBER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slide__number' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'number_typo','{{WRAPPER}} .slide__number' );
        $this->agrikon_style_background( 'number_background','{{WRAPPER}} .slide__number' );
        $this->agrikon_style_padding( 'number_padding','{{WRAPPER}} .slide__number' );
        $this->agrikon_style_border( 'number_border','{{WRAPPER}} .slide__number' );
        $this->agrikon_style_box_shadow( 'number_bxshadow','{{WRAPPER}} .slide__number' );
        $this->agrikon_style_text_shadow( 'number_txthadow','{{WRAPPER}} .slide__number' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('navmenu_style_settings',
            [
                'label'=> esc_html__( 'Menu Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'menu_content_heading',
            [
                'label' => esc_html__( 'MENU CONTAINER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->agrikon_style_background( 'menu_content_background','{{WRAPPER}} nav.nav.nav--open' );
        $this->agrikon_style_padding( 'menu_content_padding','{{WRAPPER}} nav.nav.nav--open' );
        $this->agrikon_style_border( 'menu_content_border','{{WRAPPER}} nav.nav.nav--open' );
        $this->add_control( 'menu_heading',
            [
                'label' => esc_html__( 'MENU ITEM', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'menu_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .toc a' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'menu_typo','{{WRAPPER}} .toc a' );
        $this->agrikon_style_background( 'menu_background','{{WRAPPER}} .toc a' );
        $this->agrikon_style_padding( 'menu_padding','{{WRAPPER}} .toc a' );
        $this->agrikon_style_border( 'menu_border','{{WRAPPER}} .toc a' );
        $this->agrikon_style_text_shadow( 'menu_txthadow','{{WRAPPER}} .toc a' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        echo '<svg class="hidden">
            <svg id="icon-nav" viewBox="0 0 152 63">
                <title>navarrow</title>
                <path d="M115.737 29L92.77 6.283c-.932-.92-1.21-2.84-.617-4.281.594-1.443 1.837-1.862 2.765-.953l28.429 28.116c.574.57.925 1.557.925 2.619 0 1.06-.351 2.046-.925 2.616l-28.43 28.114c-.336.327-.707.486-1.074.486-.659 0-1.307-.509-1.69-1.437-.593-1.442-.315-3.362.617-4.284L115.299 35H3.442C2.032 35 .89 33.656.89 32c0-1.658 1.143-3 2.552-3H115.737z"/>
            </svg>
        </svg>';
        echo '<main>';
            echo '<div class="slideshow">';
                $slide = 1;
                $page = 1;
                foreach ( $settings['slides'] as $item ) {
                    $current = $slide == 1 ? ' slide--current' : '';
                    echo '<div class="slide elementor-repeater-item-' . $item['_id'] . ' slide--layout-'.$item['layout'].$current.'">';
                        $count = 1;
                        foreach ( $item['gallery'] as $image ) {
                            $title = $item['title'.$count];
                            $desc = $item['desc'.$count];
                            
                            $target = !empty( $item['link'.$count]['url'] ) && !empty( $item['link'.$count]['is_external'] ) ? ' target="_blank"' : '';
                            $nofollow = !empty( $item['link'.$count]['url'] ) && !empty( $item['link'.$count]['nofollow'] ) ? ' rel="nofollow"' : '';
                            $linkstart = !empty( $item['link'.$count]['url'] ) ? '<a href="'.$item['link'.$count]['url'].'"'.$target.$nofollow.'>' : '';
                            $linkend = !empty( $item['link'.$count]['url'] ) ? '</a>' : '';

                            if ( '5' == $item['layout'] && $count < 3 ) {
                                
                                echo '<figure class="slide__figure">';
                                
                                    echo '<div class="slide__figure-inner">';
                                        echo '<div class="slide__figure-img" style="background-image: url(' . $image['url'] . ')"></div>';
                                        echo '<div class="slide__figure-reveal"></div>';
                                    echo '</div>';
                                    echo '<figcaption>';
                                        echo $linkstart;
                                        echo '<'.$settings['title_tag'].' class="slide__figure-title">'.$title.'</'.$settings['title_tag'].'>';
                                        echo $linkend;
                                        echo '<p class="slide__figure-description">'.$desc.'</p>';
                                    echo '</figcaption>';
                                    
                                echo '</figure>';
                                
                            }
                            if ( '2' == $item['layout'] && $count < 4 ) {
                                
                                echo '<figure class="slide__figure">';
                                
                                    echo '<div class="slide__figure-inner">';
                                        echo '<div class="slide__figure-img" style="background-image: url(' . $image['url'] . ')"></div>';
                                        echo '<div class="slide__figure-reveal"></div>';
                                    echo '</div>';
                                    echo '<figcaption>';
                                        echo $linkstart;
                                        echo '<'.$settings['title_tag'].' class="slide__figure-title">'.$title.'</'.$settings['title_tag'].'>';
                                        echo $linkend;
                                        echo '<p class="slide__figure-description">'.$desc.'</p>';
                                    echo '</figcaption>';
                                    
                                echo '</figure>';
                                
                            }
                            if ( ( '1' == $item['layout'] || '3' == $item['layout']  || '4' == $item['layout'] )  && $count < 5 ) {
                                
                                echo '<figure class="slide__figure">';
                                    
                                    echo '<div class="slide__figure-inner">';
                                        echo '<div class="slide__figure-img" style="background-image: url(' . $image['url'] . ')"></div>';
                                        echo '<div class="slide__figure-reveal"></div>';
                                    echo '</div>';
                                    echo '<figcaption>';
                                        echo $linkstart;
                                        echo '<'.$settings['title_tag'].' class="slide__figure-title">'.$title.'</'.$settings['title_tag'].'>';
                                        echo $linkend;
                                        echo '<p class="slide__figure-description">'.$desc.'</p>';
                                    echo '</figcaption>';
                                    
                                echo '</figure>';
                                
                            }
                            $count++;
                        }

                        echo '<span class="slide__number slide__number--left">'.$page.'</span>';
                        echo '<span class="slide__number slide__number--right">'.($page+1).'</span>';
                    echo '</div>';
                    $page = $page+2;
                    $slide++;
                }

                echo '<div class="flip-revealer">
                    <div class="revealer__item revealer__item--left elementor-repeater-item-' . $item['_id'] . '"></div>
                    <div class="revealer__item revealer__item--right elementor-repeater-item-' . $item['_id'] . '"></div>
                </div>

                <nav class="arrow-nav">
                    <button class="arrow-nav__item arrow-nav__item--prev">
                        <svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
                    </button>
                    <button class="arrow-nav__item arrow-nav__item--next">
                        <svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
                    </button>
                </nav>';
                if ( 'yes' == $settings['show_menu'] ) {
                    echo '<nav class="nav flip-nav">
                        <button class="nav__button">
                            <span class="nav__button-text">'.$settings['menu_title'].'</span>
                        </button>
                        <h2 class="nav__chapter">'.$settings['slides'][0]['navtitle'].'</h2>
                        <div class="toc">';
                            $nav = 1;
                            foreach ( $settings['slides'] as $item ) {
                                echo '<a class="toc__item" href="#entry-'.$nav.'">
                                    <span class="toc__item-title">' . $item['navtitle'] . '</span>
                                </a>';
                                $nav++;
                            }
    
                        echo '</div>
                    </nav>';
                }

                echo '<div class="slideshow__indicator"></div>
                <div class="slideshow__indicator"></div>
            </div>
        </main>';

    }
}
