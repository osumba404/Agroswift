<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Agrikon_Contact_Form_7 extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-contact-form-7';
    }
    public function get_title() {
        return 'Contact Form 7 (N)';
    }
    public function get_icon() {
        return 'eicon-form-horizontal';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section( 'agrikon_cf7_global_controls',
            [
                'label'=> esc_html__( 'Form Data', 'agrikon' ),
                'tab'=> Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control('agrikon_cf7_form_id_control',
            [
                'label'=> esc_html__( 'Select Form', 'agrikon' ),
                'type'=> Controls_Manager::SELECT,
                'multiple'=> false,
                'options'=> $this->agrikon_get_cf7(),
                'description'=> esc_html__( 'Select Form to Embed', 'agrikon' ),
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_style_section',
            [
                'label'=> esc_html__( 'Form Content Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_slider_width( 'cf7_form_width',array('{{WRAPPER}} .nt-cf7-form-wrapper form' => 'width: {{SIZE}}px;max-width: {{SIZE}}px;'), $min=0, $max=2000 );
        $this->agrikon_style_flex_alignment( 'cf7_form_alignment','{{WRAPPER}} .nt-cf7-form-wrapper' );
        $this->agrikon_style_padding( 'cf7_form_padding','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->agrikon_style_margin( 'cf7_form_margin','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->agrikon_style_border( 'cf7_form_border','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->agrikon_style_box_shadow( 'cf7_form_boxshadow','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_label_style_section',
            [
                'label'=> esc_html__( 'Label Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_typo( 'cf7_label_typo','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->agrikon_style_color( 'cf7_label_color','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->agrikon_style_flex_alignment( 'alignment','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->agrikon_style_padding( 'cf7_label_padding','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->agrikon_style_margin( 'cf7_label_margin','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->agrikon_style_border( 'cf7_flabel_border','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_input_style_section',
            [
                'label'=> esc_html__( 'Input Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_typo( 'cf7_input_typo','{{WRAPPER}} input:not(.wpcf7-submit),{{WRAPPER}} textarea,{{WRAPPER}} form select' );
        $this->agrikon_style_color( 'cf7_input_color','{{WRAPPER}} input:not(.wpcf7-submit),{{WRAPPER}} textarea,{{WRAPPER}} form select' );
        $this->agrikon_style_slider_height( 'cf7_input_height',array('{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} input[type="file"], {{WRAPPER}} form select' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;','{{WRAPPER}} input[type="file"]' => 'padding-top: calc( ({{SIZE}}px / 2) - 18px )!important;padding-bottom: calc( ({{SIZE}}px / 2) - 18px )!important;height: inherit!important;line-height: inherit!important;' ), 30, 100 );
        $this->agrikon_style_slider_width( 'cf7_input_width',array('{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} .input-wrapper' => 'width: {{SIZE}}%;' ), 0, 100, '%' );
        $this->agrikon_style_padding( 'cf7_input_padding','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select' );
        $this->agrikon_style_margin( 'cf7_input_margin','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-checkbox,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-radio,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-acceptance' );
        $this->agrikon_style_box_shadow( 'cf7_input_boxshadow','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select' );

        $this->start_controls_tabs( 'cf7_form_input_tabs');
        $this->start_controls_tab( 'cf7_form_input_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_background( 'cf7_input_background','{{WRAPPER}} input:not(.wpcf7-submit)',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_input_border','{{WRAPPER}} input:not(.wpcf7-submit)' );
        $this->agrikon_style_opacity( 'cf7_input_opacity','{{WRAPPER}} input:not(.wpcf7-submit)' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_input_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_background( 'cf7_input_hvr_background','{{WRAPPER}} input:not(.wpcf7-submit):hover',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_input_hvr_border','{{WRAPPER}} input:not(.wpcf7-submit):hover' );
        $this->agrikon_style_opacity( 'cf7_input_hvr_opacity','{{WRAPPER}} input:not(.wpcf7-submit):hover' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_focus_tab',
            [ 'label'  => esc_html__( 'Focus', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_background( 'cf7_input_focus_background','{{WRAPPER}} input:not(.wpcf7-submit):focus',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_input_focus_border','{{WRAPPER}} input:not(.wpcf7-submit):focus' );
        $this->agrikon_style_opacity( 'cf7_input_focus_opacity','{{WRAPPER}} input:not(.wpcf7-submit):focus' );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_textarea_style_section',
            [
                'label'=> esc_html__( 'Textarea Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_typo( 'cf7_textarea_typo','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->agrikon_style_slider_width( 'cf7_textarea_width',array('{{WRAPPER}} .nt-cf7-form-wrapper form textarea' => 'width: {{SIZE}}%;max-width: {{SIZE}}%;'), $min=0, $max=2000, $unit='%' );
        $this->agrikon_style_slider_height( 'cf7_textarea_height',array('{{WRAPPER}} .nt-cf7-form-wrapper form textarea' => 'height: {{SIZE}}px;' ) );
        $this->agrikon_style_padding( 'cf7_textarea_padding','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->agrikon_style_margin( 'cf7_textarea_margin','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->agrikon_style_box_shadow( 'cf7_textarea_boxshadow','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );

        $this->start_controls_tabs( 'cf7_form_textarea_tabs');
        $this->start_controls_tab( 'cf7_form_textarea_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_color( 'cf7_textarea_color','{{WRAPPER}} textarea' );
        $this->agrikon_style_background( 'cf7_textarea_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_textarea_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->agrikon_style_opacity( 'cf7_textarea_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_textarea_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_color( 'cf7_textarea_hvr_color','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );
        $this->agrikon_style_background( 'cf7_textarea_hvr_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_textarea_hvr_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );
        $this->agrikon_style_opacity( 'cf7_textarea_hvr_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );

        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_textarea_focus_tab',
            [ 'label'  => esc_html__( 'Focus', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_color( 'cf7_textarea_focus_color','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );
        $this->agrikon_style_background( 'cf7_textarea_focus_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_textarea_focus_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );
        $this->agrikon_style_opacity( 'cf7_textarea_focus_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_formbtn_style_section',
            [
                'label' => esc_html__( 'Submit Button Style', 'agrikon' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->agrikon_style_text_alignment( 'cf7_submit_alignment','{{WRAPPER}} .wpcf7 form' );
        $this->agrikon_style_typo( 'cf7_submit_typo','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->agrikon_style_slider_width( 'cf7_submit_width',array('{{WRAPPER}} .wpcf7 form .wpcf7-submit' => 'text-align:center;width: {{SIZE}}%;min-width: {{SIZE}}%;'), $min=0, $max=2000, $unit='%' );
        $this->agrikon_style_slider_height( 'cf7_submit_height',array('{{WRAPPER}} .wpcf7 form .wpcf7-submit' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;', ) );
        $this->agrikon_style_padding( 'cf7_submit_padding','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->agrikon_style_margin( 'cf7_submit_margin','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );

        $this->start_controls_tabs( 'cf7_formbtn_tabs');
        $this->start_controls_tab( 'cf7_formbtn_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_color( 'cf7_submit_color','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->agrikon_style_background( 'cf7_submit_background','{{WRAPPER}} .wpcf7 form .wpcf7-submit',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_submit_border','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->agrikon_style_box_shadow( 'cf7_submit_boxshadow','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_formbtn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'agrikon' ) ]
        );
        // Style function
        $this->agrikon_style_color( 'cf7_submit_hvr_color','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->agrikon_style_background( 'cf7_submit_hvr_background','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover',array('classic','gradient') );
        $this->agrikon_style_border( 'cf7_submit_hvr_border','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->agrikon_style_box_shadow( 'cf7_submit_hvr_boxshadow','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $formid = $settings['agrikon_cf7_form_id_control'];

        if (!empty($settings['agrikon_cf7_form_id_control'])){
            echo '<div class="nt-cf7-form-wrapper form_'.$elementid.'">';
                echo do_shortcode( '[contact-form-7 id="'.$formid.'"]' );
            echo '</div>';
        } else {
            echo "Please Select a Form";
        }

    }
}
