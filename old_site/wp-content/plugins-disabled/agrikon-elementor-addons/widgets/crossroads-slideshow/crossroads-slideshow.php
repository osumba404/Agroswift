<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Crossroads_Slideshow extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-crossroads-slideshow';
    }
    public function get_title() {
        return 'Crossroads-Slideshow (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_style( 'crossroads-slideshow', AGRIKON_PLUGIN_URL. 'widgets/crossroads-slideshow/style.css');
        wp_register_script( 'charming', AGRIKON_PLUGIN_URL. 'widgets/crossroads-slideshow/charming.min.js');
        wp_register_script( 'crossroads-slideshow', AGRIKON_PLUGIN_URL. 'widgets/crossroads-slideshow/script.js');
    }
    public function get_style_depends() {
        return [ 'crossroads-slideshow' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded','charming','gsap','crossroads-slideshow' ];
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'number',
            [
                'label' => esc_html__( 'Number', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '01',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Kanzu',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'meta',
            [
                'label' => esc_html__( 'Meta/Info', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'New York City, March 24',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'text',
            [
                'label' => esc_html__( 'Content', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'In the gloomy domed livingroom of the tower Buck Mulligan’s gowned form moved briskly to and fro about the hearth, hiding and revealing its yellow glow. Two shafts of soft daylight fell across the flagged floor from the high barbacans: and at the meeting of their rays a cloud of coalsmoke and fumes of fried grease floated, turning.',
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
        $repeater->add_control( 'link_title',
            [
                'label' => esc_html__( 'Link Title', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'more +',
                'label_block' => true
            ]
        );
        $this->add_control( 'slides',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'number' => '01',
                        'title' => 'Kanzu',
                        'image' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
                        'meta' => 'New York City, March 24',
                        'text' => 'In the gloomy domed livingroom of the tower Buck Mulligan’s gowned form moved briskly to and fro about the hearth, hiding and revealing its yellow glow. Two shafts of soft daylight fell across the flagged floor from the high barbacans: and at the meeting of their rays a cloud of coalsmoke and fumes of fried grease floated, turning.',
                        'link' => '#',
                        'link_title' => 'more +',
                    ],
                    [
                        'number' => '02',
                        'title' => 'Kanzu',
                        'image' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
                        'meta' => 'New York City, March 24',
                        'text' => 'In the gloomy domed livingroom of the tower Buck Mulligan’s gowned form moved briskly to and fro about the hearth, hiding and revealing its yellow glow. Two shafts of soft daylight fell across the flagged floor from the high barbacans: and at the meeting of their rays a cloud of coalsmoke and fumes of fried grease floated, turning.',
                        'link' => '#',
                        'link_title' => 'more +',
                    ],
                    [
                        'number' => '03',
                        'title' => 'Kanzu',
                        'image' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
                        'meta' => 'New York City, March 24',
                        'text' => 'In the gloomy domed livingroom of the tower Buck Mulligan’s gowned form moved briskly to and fro about the hearth, hiding and revealing its yellow glow. Two shafts of soft daylight fell across the flagged floor from the high barbacans: and at the meeting of their rays a cloud of coalsmoke and fumes of fried grease floated, turning.',
                        'link' => '#',
                        'link_title' => 'more +',
                    ],
                    [
                        'number' => '04',
                        'title' => 'Kanzu',
                        'image' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
                        'meta' => 'New York City, March 24',
                        'text' => 'In the gloomy domed livingroom of the tower Buck Mulligan’s gowned form moved briskly to and fro about the hearth, hiding and revealing its yellow glow. Two shafts of soft daylight fell across the flagged floor from the high barbacans: and at the meeting of their rays a cloud of coalsmoke and fumes of fried grease floated, turning.',
                        'link' => '#',
                        'link_title' => 'more +',
                    ],
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('front_back_settings',
            [
                'label' => esc_html__( 'Front && Back Additional', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'front_heading',
            [
                'label' => esc_html__( 'FRONT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'image_rotate',
            [
                'label' => esc_html__( 'Image Rotate', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -90,
                'max' => 90,
                'step' => 1,
                'selectors' => ['{{WRAPPER}} .grid--slideshow, {{WRAPPER}} .revealer' => 'transform: rotate({{VALUE}}deg);']
            ]
        );
        $this->add_responsive_control( 'revealer_rotate',
            [
                'label' => esc_html__( 'Revealer Rotate', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -90,
                'max' => 90,
                'step' => 1,
                'selectors' => ['{{WRAPPER}} .revealer' => 'transform: rotate({{VALUE}}deg);']
            ]
        );
        $this->add_responsive_control( 'title_rotate',
            [
                'label' => esc_html__( 'Titles Rotate', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -90,
                'max' => 90,
                'step' => 1,
                'selectors' => ['{{WRAPPER}} .titles-wrap' => 'transform: rotate({{VALUE}}deg);']
            ]
        );
        $this->add_control( 'back_heading',
            [
                'label' => esc_html__( 'BACK', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'image_content_height',
            [
                'label' => esc_html__( 'Image Content Height', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .img-wrap--content' => 'height: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_responsive_control( 'text_content_width',
            [
                'label' => esc_html__( 'Text Content Max Width', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .content__item-copy' => 'max-width: {{SIZE}}{{UNIT}};' ],
            ]
        );
        $this->add_control( 'back_layout',
            [
                'label' => esc_html__( 'Back Layout', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid-template-col-3',
                'options' => [
                    'grid-template-vertical' => esc_html__( '1 Column', 'agrikon' ),
                    'grid-template-col-2' => esc_html__( '2 Column', 'agrikon' ),
                    'grid-template-col-3' => esc_html__( '3 Column', 'agrikon' ),
                    'grid-template-col-custom' => esc_html__( 'Custom Column', 'agrikon' ),
                ]
            ]
        );
        $this->add_responsive_control( 'back_custom_column',
            [
                'label' => esc_html__( 'Change Column Structure', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '30% 60% 30%',
                'label_block' => true,
                'selectors' => ['{{WRAPPER}} .content__item' => 'grid-template-columns: {{VALUE}};' ],
                'condition' => ['back_column_type' => 'grid-template-col-custom']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('front_style_settings',
            [
                'label'=> esc_html__( 'Front Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_background( 'front_bg','{{WRAPPER}} .revealer__inner' );
        $this->add_control( 'number_heading',
            [
                'label' => esc_html__( 'NUMBER', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .number'
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Stroke Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .number' => '-webkit-text-stroke-color: {{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'number_stroke_width',
            [
                'label' => esc_html__( 'Stroke Width', 'agrikon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'selectors' => ['{{WRAPPER}} .number' => '-webkit-text-stroke-width: {{SIZE}}px;']
            ]
        );
        $this->add_control( 'image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_border( 'image_border','{{WRAPPER}} .img-wrap' );
        $this->agrikon_style_box_shadow( 'image_bxshadow','{{WRAPPER}} .img-wrap' );
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
                'selectors' => ['{{WRAPPER}} .grid__item--title' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'title_typo','{{WRAPPER}} .grid__item--title' );
        $this->agrikon_style_background( 'title_background','{{WRAPPER}} .grid__item--title' );
        $this->agrikon_style_padding( 'title_padding','{{WRAPPER}} .grid__item--title' );
        $this->agrikon_style_border( 'title_border','{{WRAPPER}} .grid__item--title' );
        $this->agrikon_style_box_shadow( 'title_bxshadow','{{WRAPPER}} .grid__item--title' );
        $this->agrikon_style_text_shadow( 'title_txthadow','{{WRAPPER}} .grid__item--title span' );
        $this->add_control( 'caption_heading',
            [
                'label' => esc_html__( 'CAPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'caption_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cross-slider .caption' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'caption_typo','{{WRAPPER}} .cross-slider .caption' );
        $this->agrikon_style_background( 'caption_background','{{WRAPPER}} .cross-slider .caption' );
        $this->agrikon_style_padding( 'caption_padding','{{WRAPPER}} .cross-slider .caption' );
        $this->agrikon_style_border( 'caption_border','{{WRAPPER}} .cross-slider .caption' );
        $this->agrikon_style_box_shadow( 'caption_bxshadow','{{WRAPPER}} .cross-slider .caption' );
        $this->agrikon_style_text_shadow( 'caption_txthadow','{{WRAPPER}} .cross-slider .caption' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('back_style_settings',
            [
                'label'=> esc_html__( 'Back Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_background( 'back_bg','{{WRAPPER}} .content__item' );

        $this->add_control( 'back_image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_border( 'back_image_border','{{WRAPPER}} .img-wrap--content' );
        $this->agrikon_style_box_shadow( 'back_image_bxshadow','{{WRAPPER}} .img-wrap--content' );
        $this->add_control( 'back_title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'back_title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .content__item-header-title' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'back_title_typo','{{WRAPPER}} .content__item-header-title' );
        $this->agrikon_style_background( 'back_title_background','{{WRAPPER}} .content__item-header-title' );
        $this->agrikon_style_padding( 'back_title_padding','{{WRAPPER}} .content__item-header-title' );
        $this->agrikon_style_border( 'back_title_border','{{WRAPPER}} .content__item-header-title' );
        $this->agrikon_style_box_shadow( 'back_title_bxshadow','{{WRAPPER}} .content__item-header-title' );
        $this->agrikon_style_text_shadow( 'back_title_txthadow','{{WRAPPER}} .content__item-header-title' );
        $this->add_control( 'back_caption_heading',
            [
                'label' => esc_html__( 'CAPTION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'back_caption_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .content__item-header-meta' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'back_caption_typo','{{WRAPPER}} .content__item-header-meta' );
        $this->agrikon_style_background( 'back_caption_background','{{WRAPPER}} .content__item-header-meta' );
        $this->agrikon_style_padding( 'back_caption_padding','{{WRAPPER}} .content__item-header-meta' );
        $this->agrikon_style_border( 'back_caption_border','{{WRAPPER}} .content__item-header-meta' );
        $this->agrikon_style_box_shadow( 'back_caption_bxshadow','{{WRAPPER}} .content__item-header-meta' );
        $this->agrikon_style_text_shadow( 'back_caption_txthadow','{{WRAPPER}} .content__item-header-meta' );
        $this->add_control( 'back_text_heading',
            [
                'label' => esc_html__( 'TEXT', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'back_text_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .content__item-copy' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'back_text_typo','{{WRAPPER}} .content__item-copy' );
        $this->agrikon_style_background( 'back_text_background','{{WRAPPER}} .content__item-copy' );
        $this->agrikon_style_padding( 'back_text_padding','{{WRAPPER}} .content__item-copy' );
        $this->agrikon_style_border( 'back_text_border','{{WRAPPER}} .content__item-copy' );
        $this->agrikon_style_box_shadow( 'back_text_bxshadow','{{WRAPPER}} .content__item-copy' );
        $this->agrikon_style_text_shadow( 'back_text_txthadow','{{WRAPPER}} .content__item-copy' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();

        echo '<div class="cross-slider">';
            echo '<div class="cross-content '.$settings['back_layout'].'">';
                foreach ( $settings['slides'] as $item ) {
                    $image = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $settings );
                    echo '<article class="content__item">';
                        echo '<div class="img-wrap img-wrap--content">';
                            echo '<div class="cross-img img--content" style="background-image: url('.$image.');"></div>';
                        echo '</div>';
                        echo '<header class="content__item-header">';
                            if ( $item['meta'] ) {
                                echo '<span class="content__item-header-meta">'.$item['meta'].'</span>';
                            }
                            if ( $item['title'] ) {
                                echo '<h2 class="content__item-header-title">'.$item['title'].'</h2>';
                            }
                        echo '</header>';

                        if ( $item['text'] || $item['link_title'] ) {
                            echo '<div class="content__item-copy">';
                                if ( $item['text'] ) {
                                    echo '<p class="content__item-copy-text">'.$item['text'].'</p>';
                                }
                                if ( $item['link_title'] ) {
                                    echo '<a href="'.$item['link']['url'].'" class="content__item-copy-more">'.$item['link_title'].'</a>';
                                }
                            echo '</div>';
                        }
                    echo '</article>';
                }
            echo '</div>';

            echo '<div class="revealer"><div class="revealer__inner"></div></div>';

            echo '<div class="grid grid--slideshow">';
                foreach ( $settings['slides'] as $item ) {
                    $image = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $settings );
                    echo '<figure class="grid__item grid__item--slide">';
                        if ( $item['number'] ) {
                            echo '<span class="number">'.$item['number'].'</span>';
                        }

                        echo '<div class="img-wrap">';
                            echo '<div class="cross-img" style="background-image: url('.$image.');"></div>';
                        echo '</div>';

                        if ( $item['meta'] ) {
                            echo '<figcaption class="caption">'.$item['meta'].'</figcaption>';
                        }
                    echo '</figure>';
                }
                echo '<div class="titles-wrap">';
                    echo '<div class="grid grid--titles">';
                        foreach ( $settings['slides'] as $item ) {
                            echo '<h3 class="grid__item grid__item--title">'.$item['title'].'</h3>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<div class="grid grid--interaction">';
                    echo '<div class="grid__item grid__item--cursor grid__item--left"></div>';
                    echo '<div class="grid__item grid__item--cursor grid__item--center"></div>';
                    echo '<div class="grid__item grid__item--cursor grid__item--right"></div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
