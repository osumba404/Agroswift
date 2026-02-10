<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Agrikon_Project_Meta extends Widget_Base {
    use Agrikon_Helper;
    public function get_name() {
        return 'agrikon-project-meta';
    }
    public function get_title() {
        return 'Project Meta (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'agrikon-cpt' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'agrikon_project_next_settings',
            [
                'label' => esc_html__('Projects Post Meta Data', 'agrikon'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'meta',
            [
                'label' => esc_html__( 'Select Meta', 'agrikon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'author' => esc_html__( 'Post Author', 'agrikon' ),
                    'date' => esc_html__( 'Post Date', 'agrikon' ),
                    'cat' => esc_html__( 'Post Category', 'agrikon' ),
                    'tag' => esc_html__( 'Post Tags', 'agrikon' ),
                ],
                'default' => 'author'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'agrikon_project_meta_style',
            [
                'label' => esc_html__( 'Post Meta ', 'agrikon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typo',
                'label' => esc_html__( 'Typography', 'agrikon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p a'
            ]
        );
        $this->add_control( 'color',
            [
                'label' => esc_html__( 'Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} p a' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_control( 'hvrcolor',
            [
                'label' => esc_html__( 'Hover Link Color', 'agrikon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} p a:hover' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $i = 1;

        if( 'author' == $settings['meta'] ) {
            printf( '<p class="author"><a href="%1$s" title="%2$s">%2$s</a></p>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                get_the_author()
            );
        }

        if ( 'date' == $settings['meta'] ) {
            $archive_year  = get_the_time( 'Y' );
            $archive_month = get_the_time( 'm' );
            $archive_day   = get_the_time( 'd' );
            printf( '<p class="author"><a href="%1$s" title="%1$s">%2$s</a></p>',
                esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                get_the_date()
            );
        }

        if ( 'cat' == $settings['meta'] ) {
            $terms = get_the_terms( get_the_ID() , 'projects_cat' );
            if( !is_wp_error( $terms ) && $terms ) {
                echo '<p class="cats">';
                foreach ( $terms as $term ) {
                    $term_link = get_term_link( $term, 'projects_cat' );
                    if( !is_wp_error( $term_link ) ) {
                        echo '<a href="' . $term_link . '" title="' . $term_link . '">' . $term->name . '</a>';
                        echo ( $i < count( $terms ) ) ? " , " : "";
                    }
                    $i++;
                }
                echo '</p>';
            } else {
                echo '<p class="cats">'. esc_html__( 'This post has no category yet!', 'agrikon' ) .'</p>';
            }
        }

        if( 'tag' == $settings['meta'] ) {
            $terms = get_the_term_list( get_the_ID(), 'projects_tag', '', ', ' );
            if( $terms ) {
                echo '<p class="tags">'.$terms.'</p>';
            } else {
                echo '<p class="tags">'. esc_html__( 'This post has no tags yet!', 'agrikon' ) .'</p>';
            }
        }

    }
}
