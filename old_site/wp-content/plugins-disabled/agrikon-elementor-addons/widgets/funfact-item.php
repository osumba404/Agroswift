<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Funfact_Item extends Widget_Base {
    public function get_name() {
        return 'agrikon-funfact-item';
    }
    public function get_title() {
        return 'Funfact Item (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function get_style_depends() {
        return [ 'odometer' ];
    }
    public function get_script_depends() {
        return [ 'appear', 'odometer' ];
    }
    //
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'funfact_settings',
            [
                'label' => esc_html__('Fact Item', 'agrikon')
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Icon', 'agrikon' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
            ]
        );
        $this->add_control( 'number',
            [
                'label' => esc_html__( 'Number', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => '',
                'step' => 1,
                'default' => 123,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Number Tag', 'agrikon' ),
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
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'agrikon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Agriculture Products',
                'label_block' => true
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
        $this->add_control( 'box_color',
            [
                'label' => esc_html__( 'Box Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single' => 'background-color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'box_hvrcolor',
            [
                'label' => esc_html__( 'Hover Box Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hover' => 'background-color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_responsive_control( 'box_padding',
            [
                'label' => esc_html__( 'Padding', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => ['{{WRAPPER}} .funfact-one__single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .funfact-one__single',
            ]
        );
        $this->add_responsive_control( 'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .funfact-one__single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_hvrborder',
                'label' => esc_html__( 'Border', 'agrikon' ),
                'selector' => '{{WRAPPER}} .funfact-one__single:hover',
            ]
        );
        $this->add_responsive_control( 'box_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'agrikon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'icon_heading',
            [
                'label' => esc_html__( 'ICON', 'agrikon' ),
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
                'selectors' => [ '{{WRAPPER}} .funfact-one__single i' => 'font-size: {{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hover i' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single i' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'icon_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hover i' => 'background-color:{{VALUE}};' ],
            ]
        );
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
                'selector' => '{{WRAPPER}} .funfact-one__single .number'
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single .number' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
            ]
        );
        $this->add_control( 'number_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hover .number' => 'color:{{VALUE}};' ],
                'condition' => ['title!' => '']
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
                'selector' => '{{WRAPPER}} .funfact-one__single p'
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .funfact-one__single:hoverp' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $id  = $this->get_id();
        echo '<div class="funfact-one__single">';
            if ( !empty( $settings['icon']['value'] ) ) {
                Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
            }
            if ( $settings['number'] ) {
                echo '<'.$settings['tag'].' class="number theme-default"><span id="odometer-'.$id.'" class="odometer" data-count="'.$settings['number'].'">00</span></'.$settings['tag'].'>';
            }
            if ( $settings['title'] ) {
                echo '<p>'.$settings['title'].'</p>';
            }
        echo '</div>';
    }
}
