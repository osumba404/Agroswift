<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Reveal_Menu extends Widget_Base {
    use Agrikon_Helper;

    public function get_name() {
        return 'agrikon-reveal-menu';
    }
    public function get_title() {
        return 'Reveal Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'agrikon-reveal-menu', AGRIKON_PLUGIN_URL. 'widgets/reveal-menu/style.css');
        wp_register_script( 'agrikon-reveal-menu', AGRIKON_PLUGIN_URL. 'widgets/reveal-menu/script.js', [ 'elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'agrikon-reveal-menu' ];
    }
    public function get_script_depends() {
        return [ 'imagesloaded', 'gsap','agrikon-reveal-menu' ];
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
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
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
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Name', 'agrikon' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Add Your Description Here',
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
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
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
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('reveal_style_settings',
            [
                'label'=> esc_html__( 'Reveal Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
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
                'selectors' => ['{{WRAPPER}} .menu__item::before' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'number_typo','{{WRAPPER}} .menu__item::before' );
        $this->add_control( 'title_heading',
            [
                'label' => esc_html__( 'TITLE', 'agrikon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->agrikon_style_typo( 'title_typo','{{WRAPPER}} .menu__item-textinner' );
        $this->agrikon_style_padding( 'title_padding','{{WRAPPER}} .menu__item' );
        $this->agrikon_style_margin( 'title_margin','{{WRAPPER}} .menu__item' );
        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab( 'title_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'agrikon' ) ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .menu__item-textinner' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'title_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .menu__item-textinner' => 'background-color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_border( 'title_border','{{WRAPPER}} .menu__item-textinner' );
        $this->end_controls_tab();
        $this->start_controls_tab('title_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        $this->add_control( 'title_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .menu__item:hover .menu__item-textinner' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'title_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .menu__item:hover .menu__item-textinner' => 'background-color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_border( 'title_hvrborder','{{WRAPPER}} .menu__item:hover .menu__item-textinner' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
                'selectors' => ['{{WRAPPER}} .menu__item-sub' => 'color: {{VALUE}};']
            ]
        );
        $this->agrikon_style_typo( 'desc_typo','{{WRAPPER}} .menu__item-sub' );
        $this->agrikon_style_padding( 'desc_padding','{{WRAPPER}} .menu__item-sub' );
        $this->agrikon_style_margin( 'desc_margin','{{WRAPPER}} .menu__item-sub' );
        $this->agrikon_style_border( 'desc_border','{{WRAPPER}} .menu__item-sub' );
        $this->agrikon_style_text_shadow( 'desc_txtshadow','{{WRAPPER}} .menu__item-sub' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $css = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? ' style="height:96px;"' : '';

		echo '<nav class="menu">';
            foreach ($settings['menus'] as $item) {
                if ( $item['name'] ) {
                    $image = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $settings );
        			echo '<a class="menu__item" href="'.$item['link']['url'].'" data-img="'.$image.'">';
        				echo '<span class="menu__item-text"><span class="menu__item-textinner">'.$item['name'].'</span></span>';
        				echo '<span class="menu__item-sub">'.$item['desc'].'</span>';
        			echo '</a>';
                }
            }
		echo '</nav>';

    	echo '<svg class="cursor-menu" width="80" height="80" viewBox="0 0 80 80">
		<circle class="cursor__inner" cx="40" cy="40" r="20" />
	</svg>';
    }
}
