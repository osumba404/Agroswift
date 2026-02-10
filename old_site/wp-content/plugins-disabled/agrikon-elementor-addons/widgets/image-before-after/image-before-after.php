<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Image_Before_After extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-image-before-after';
    }
    public function get_title() {
        return 'Image Before After (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        
        wp_register_style( 'agrikon-image-before-after', AGRIKON_PLUGIN_URL. 'widgets/image-before-after/style.css');
        wp_register_script( 'hammer', AGRIKON_PLUGIN_URL. 'widgets/image-before-after/hammer.min.js', [  'jquery' ], '1.0.0', true);
        wp_register_script( 'jquery-images-compare', AGRIKON_PLUGIN_URL. 'widgets/image-before-after/jquery.images-compare.min.js', [  'jquery' ], '1.0.0', true);
        wp_register_script( 'agrikon-image-before-after', AGRIKON_PLUGIN_URL. 'widgets/image-before-after/script.js', [  'elementor-frontend' ], '1.0.0', true);
        
    }
    public function get_style_depends() {
        return [ 'agrikon-image-before-after' ];
    }
    public function get_script_depends() {
        return [ 'hammer','jquery-images-compare', 'agrikon-image-before-after' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_image_before_after_settings',
            [
                'label' => esc_html__( 'General', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'before',
            [
                'label' => esc_html__('Before Text', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Before', 'agrikon'),

            ]
        );
        $this->add_control( 'after',
            [
                'label' => esc_html__('After Text', 'agrikon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('After', 'agrikon'),

            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Before Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [ 'image[url]!' => '' ],
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'After Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'full',
                'condition' => [ 'image2[url]!' => '' ],
            ]
        );
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('agrikon_image_before_after_handle_style_section',
            [
                'label'=> esc_html__( 'Handle Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->agrikon_style_color( 'image_before_after_handle_color',array('{{WRAPPER}} .images-compare-left-arrow' => 'border-right-color: {{VALUE}};', '{{WRAPPER}} .images-compare-right-arrow' => 'border-left-color: {{VALUE}};'));
        $this->agrikon_style_border( 'image_before_after_handle_border','{{WRAPPER}} .images-compare-handle');
        $this->agrikon_style_background( 'image_before_after_handle_background','{{WRAPPER}} .images-compare-handle',array('classic','gradient') );
        $this->agrikon_style_slider_width( 'image_before_after_handle_width',array('{{WRAPPER}} .images-compare-handle' => 'width: {{SIZE}}px;height: {{SIZE}}px;margin-left: calc(-{{SIZE}}px / 2 );margin-top: calc(-{{SIZE}}px / 2 );'), $min=30, $max=100, $unit='px' );
        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('agrikon_image_before_after_text_style_section',
            [
                'label'=> esc_html__( 'Text Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->agrikon_style_typo( 'image_before_after_text_typo','{{WRAPPER}} .images-compare-label' );
        $this->agrikon_style_color( 'image_before_after_text_color','{{WRAPPER}} .images-compare-label' );
        $this->agrikon_style_border( 'image_before_after_text_border','{{WRAPPER}} .images-compare-label');
        $this->agrikon_style_background( 'image_before_after_text_background','{{WRAPPER}} .images-compare-label',array('classic','gradient') );        
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid  = $this->get_id();
        
        $image      = $this->get_settings( 'image' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );

        $image2      = $this->get_settings( 'image2' );
        $image_url2  = Group_Control_Image_Size::get_attachment_image_src( $image2['id'], 'thumbnail', $settings );
        $imageurl2   = empty( $image_url2 ) ? $image2['url'] : $image_url2;
        $imagealt2   = esc_attr(get_post_meta($image2['id'], '_wp_attachment_image_alt', true));
        $imagealt2   = $imagealt2 ? $imagealt2 : basename ( get_attached_file( $image2['id'] ) );
        
        $before = $settings[ 'before' ] ? '<span class="images-compare-label">'.$settings[ 'before' ].'</span>' : '';
        $after = $settings[ 'after' ] ? '<span class="images-compare-label">'.$settings[ 'after' ].'</span>' : '';
        
        echo '<div id="myImageCompare_'.$elementid.'" class="nt-images-compare">';
            echo '<div style="display: none;">' . $before . '<img src="' . $imageurl . '" alt="' . $imagealt . '"></div>';
            echo '<div>' . $after . '<img src="' . $imageurl2 . '" alt="' . $imagealt2 . '"></div>';
        echo '</div>';

    }
}
