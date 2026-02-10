<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Brands_Board extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-brands-board';
    }
    public function get_title() {
        return 'Brands Board (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function get_style_depends() {
        return [ 'splitting','splitting-cells' ];
    }
    public function get_script_depends() {
        return [ 'wow', 'splitting' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_brands_board_settings',
            [
                'label' => esc_html__( 'Brands Board', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'column',
            [
                'label' => esc_html__( 'Column', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'default' => 4,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'add_line',
            [
                'label' => esc_html__( 'Add Line', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hide_split',
            [
                'label' => esc_html__( 'Hide Splitting', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'split_type',
            [
                'label' => esc_html__( 'Split Type', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'chars',
                'options' => [
                    'chars' => esc_html__( 'Chars', 'agrikon' ),
                    'words' => esc_html__( 'Words', 'agrikon' ),
                ],
                'condition' => ['hide_split!' => 'yes'],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'separator' => 'none',
            'default' => 'agrikon-square',
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__('Brand Title', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => 'www.agrikon.com',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => ''
                ],
                'show_external' => true
            ]
        );
        $this->add_control( 'brands',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'default' => [
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ],
                    [
                        'image' => ['url' => ''],
                        'title' => 'www.agrikon.com',
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        $column = $settings['column'] ? 12 / $settings['column'] : 3;
        $line   = 'yes' == $settings['add_line'] ? ' bord' : '';

        echo '<div class="clients">';
            echo '<div class="container-off">';
                echo '<div class="row'.$line.'">';
                    $count = 1;
                    foreach ( $settings['brands'] as $item ) {

                        $delay = mt_rand( 3, 9 );
                        $imagealt = esc_attr( get_post_meta( $item['image']['id'], '_wp_attachment_image_alt', true ) );
                        $imagealt = $imagealt ? $imagealt : basename ( get_attached_file( $item['image']['id'] ) );
                        $img_url  = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $settings );
                        $image_url = empty( $img_url ) ? $item['image']['url'] : $img_url;

                        echo '<div class="col-md-' . $column . ' col-6 brands">';
                            echo '<div class="item wow fadeIn" data-wow-delay=".'.$delay.'s">';
                                echo '<div class="img"><img src="'.esc_url( $image_url ).'" alt="'.$imagealt.'"></div>';
                                $split = 'yes' != $settings['hide_split'] ? ' data-splitting="'.$settings['split_type'].'"' : '';
                                echo '<a href="' . $item['link']['url'] .'" class="link"'.$split.'>' . $item['title'] .'</a>';
                            echo '</div>';
                        echo '<span class="color-aware"></span>';
                        echo '</div>';
                        $count++;

                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
}
