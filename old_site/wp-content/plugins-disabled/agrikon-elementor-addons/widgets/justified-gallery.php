<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Justified_Gallery extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-justified-gallery';
    }
    public function get_title() {
        return 'Justified Gallery (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'agrikon' ];
    }
    public function get_style_depends() {
        return [ 'justified','magnific' ];
    }
    public function get_script_depends() {
        return [ 'justified','magnific' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_justified_gallery_images_settings',
            [
                'label' => esc_html__('Gallery Images', 'agrikon'),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'agrikon' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => '' ]
            ]
        );
        $this->add_control( 'justified_gallery',
            [
                'label' => esc_html__( 'Items', 'agrikon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '#Image',
                'default' => [
                    [
                        'image' => ['url' => '']
                    ],
                ]
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_justified_gallery_settings',
            [
                'label' => esc_html__( 'General', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'rows',
            [
                'label' => esc_html__( 'Rows Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'default' => 400,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'margins',
            [
                'label' => esc_html__( 'Space Between Images', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 5,
                'default' => 15,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'lastrow',
            [
                'label' => esc_html__( 'Last Row Justify', 'agrikon' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $rows      = $settings['rows'] ? $settings['rows'] : 400;
        $margins   = $settings['margins'] ? $settings['margins'] : 15;
        $lastrow   = 'yes' == $settings['lastrow'] ? 'justify' : 'nojustify';

        echo '<div class="projdtal">';
            echo '<div class="justified-gallery" id="justified-'.$elementid.'" data-agrikon-justified=\'{"rows":'.$rows.',"margins":'.$margins.',"lastrow":"'.$lastrow.'"}\' data-agrikon-lightbox=\'{"type":"gallery","selector":".gallery-photo"}\'>';
                foreach ($settings['justified_gallery'] as $item) {
                    $imagealt  = esc_attr(get_post_meta($item['image']['id'], '_wp_attachment_image_alt', true));
                    $imagealt  = $imagealt ? $imagealt : basename ( get_attached_file( $item['image']['id'] ) );
                    echo '<a  class="gallery-photo" href="'.$item['image']['url'].'">';
                        echo '<img alt="'.$imagealt.'" src="'.$item['image']['url'].'" />';
                    echo '</a>';
                }
            echo '</div>';
        echo '</div>';
        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
            <script>
            jQuery(document).ready(function ($) {
                function agrikonJustifiedGallery() {
                    var myJustified = $('#justified-<?php echo esc_attr($elementid);?>');
                    var myData= myJustified.data('agrikon-justified');
                    var myRows= myData.rows;
                    var myMargins = myData.margins;
                    var myLastRow = myData.lastrow;
                    if( myJustified ) {
                        myJustified.justifiedGallery(
                            {
                                rowHeight:myRows,
                                margins:myMargins,
                                lastRow:myLastRow
                            }
                        );
                    }
                }
                agrikonJustifiedGallery();
            });
            </script>
            <?php
        }
    }
}
