<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

if( !defined( 'ABSPATH' ) ) exit;

class Agrikon_Customizing_Page_Settings {
    use Agrikon_Helper;
    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Agrikon_Customizing_Page_Settings();
        }
        return self::$instance;
    }

    public function __construct(){
        // custom option for elementor heading widget font size
        add_action( 'elementor/element/wp-page/document_settings/before_section_end',[ $this,'agrikon_add_theme_skin_to_page_settings'], 10);
        add_action( 'elementor/element/wp-post/document_settings/before_section_end',[ $this,'agrikon_add_theme_skin_to_page_settings'], 10);
    }

    public function agrikon_add_theme_skin_to_page_settings( $page )
    {

        if ( isset( $page ) && $page->get_id() > "" ){

            $template = basename( get_page_template() );
            $agrikon_post_type = false;
            $agrikon_post_type = get_post_type( $page->get_id() );

            if ( agrikon_check_is_post( $agrikon_post_type ) || $agrikon_post_type == 'revision' ) {

                $page->add_control( 'agrikon_elementor_page_header_settings_heading',
                    [
                        'label' => esc_html__( 'AGRIKON HEADER', 'agrikon' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $page->add_control( 'agrikon_elementor_hide_page_header',
                    [
                        'label' => esc_html__( 'Hide Page Header', 'agrikon' ),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
                );
                $page->add_control( 'agrikon_page_header_template',
                    [
                        'label' => esc_html__( 'Select Header Template', 'agrikon' ),
                        'type' => Controls_Manager::SELECT2,
                        'default' => '',
                        'multiple' => false,
                        'options' => $this->agrikon_get_elementor_templates(),
                        'condition' => [ 'agrikon_elementor_hide_page_header!' => 'yes' ]
                    ]
                );
                $page->add_control( 'agrikon_elementor_page_footer_settings_heading',
                    [
                        'label' => esc_html__( 'AGRIKON FOOTER', 'agrikon' ),
                        'type' => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $page->add_control( 'agrikon_elementor_hide_page_footer',
                    [
                        'label' => esc_html__( 'Hide Footer', 'agrikon' ),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                    ]
                );
                $page->add_control( 'agrikon_page_footer_template',
                    [
                        'label' => esc_html__( 'Select Footer Template', 'agrikon' ),
                        'type' => Controls_Manager::SELECT2,
                        'default' => '',
                        'multiple' => false,
                        'options' => $this->agrikon_get_elementor_templates(),
                        'condition' => [ 'agrikon_page_footer_template!' => 'yes' ]
                    ]
                );
            }
        }
    }

    public function agrikon_add_custom_css_to_page_settings( $page )
    {

        if( isset($page) && $page->get_id() > "" ){

            $nt_post_type = false;
            $nt_post_type = get_post_type($page->get_id());

            if ( $nt_post_type == 'page' || $nt_post_type == 'revision' ) {

                $page->start_controls_section( 'header_custom_css_controls_section',
                    [
                        'label' => esc_html__( 'AGRIKON Page Custom CSS', 'agrikon' ),
                        'tab' => Controls_Manager::TAB_SETTINGS,
                    ]
                );
                $page->add_control( 'agrikon_page_custom_css',
                    [
                        'label' => esc_html__( 'Custom CSS', 'agrikon' ),
                        'type' => Controls_Manager::CODE,
                        'language' => 'css',
                        'rows' => 20,
                    ]
                );
                $page->end_controls_section();
            }
        }
    }

    public function agrikon_page_registered_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }
}
Agrikon_Customizing_Page_Settings::get_instance();
