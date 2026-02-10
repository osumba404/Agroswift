<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Team_Member extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-team-member';
    }
    public function get_title() {
        return 'Team Member (N)';
    }
    public function get_icon() {
        return 'eicon-person';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'team_section',
            [
                'label' => esc_html__( 'Team Content', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'pleaceholder' => esc_html__( 'Enter name here', 'agrikon' ),
                'default' => 'Alex Smith',
                'label_block' => true,
            ]
        );
        $this->add_control( 'pos',
            [
                'label' => esc_html__( 'Position', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter position here', 'agrikon' ),
                'default' => 'Founder',
                'label_block' => true,
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Avatar Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'agrikon-square'
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'social',
            [
                'name' => 'social',
                'label' => esc_html__( 'Icon', 'agrikon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands'
                ]
            ]
        );
        $repeater->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'agrikon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'agrikon' )
            ]
        );
        $this->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<i class="{{social.value}}"></i>',
                'default' => [
                    [
                        'social' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands'
                        ]
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('style_section',
            [
                'label'=> esc_html__( 'Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'overlay_color',
            [
                'label' => esc_html__( 'Hover Overlay Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__image::before' => 'background-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'team_name_heading',
            [
                'label' => esc_html__( 'NAME', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'name_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card .name' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team-card .name'
            ]
        );
        $this->add_control( 'job_heading',
            [
                'label' => esc_html__( 'POSITION', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'job_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .team-card p'
            ]
        );

        $this->add_control( 'team_socials_heading',
            [
                'label' => esc_html__( 'SOCIALS', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'icon_fsize',
            [
                'label' => esc_html__( 'Icon Font Size', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'font-size:{{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'socials_tabs');
        $this->start_controls_tab( 'social_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'social_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'social_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'social_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'social_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'social_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team-card__social a:hover' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id = $this->get_id();
        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        if ( $settings['image']['url'] ) {
            echo '<div class="team-card">';
                echo '<div class="team-card__image">';
                    echo wp_get_attachment_image( $settings['image']['id'], $size, false, ['class'=>'t-img'] );
                    echo '<div class="team-card__social">';
                        foreach ( $settings['socials'] as $item ) {
                            $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                            echo '<a class="social-link" href="'.esc_attr( $item['link']['url'] ).'"'.$target.'>';
                                if ( ! empty($item['social']['value']) ) {
                                    Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                                }
                            echo '</a>';
                        }
                    echo '</div>';
                echo '</div>';
                if ( !empty( $item['name'] ) ) {
                    echo '<'.$settings['ntag'].' class="name">'.$item['name'].'</'.$settings['ntag'].'>';
                }
                if ( !empty( $item['pos'] ) ) {
                    echo '<p>'.$item['pos'].'</p>';
                }
            echo '</div>';

        }
    }
}
