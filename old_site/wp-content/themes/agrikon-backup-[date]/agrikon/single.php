<?php

/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @subpackage Agrikon
* @since 1.0.0
*/

    if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
        $hide_header = $page_settings->get_settings( 'agrikon_elementor_hide_page_header' );
        $hide_footer = $page_settings->get_settings( 'agrikon_elementor_hide_page_footer' );
        if ( 'yes' == $hide_header ) {
            remove_action( 'agrikon_header_action', 'agrikon_main_header', 10 );
        }
        if ( 'yes' == $hide_footer ) {
            remove_action( 'agrikon_footer_action', 'agrikon_footer', 10 );
        }
    }

    get_header();

    // Elementor `single` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
        
        // you can use this action to add any content before single page
        do_action( 'agrikon_before_post_single' );

        if ( agrikon_check_is_elementor() ) {

            while ( have_posts() ) {

                the_post();

                the_content();

            }

        } else {

            agrikon_single_layout_sidebar();

        }

        // you can use this action to add any content after single page
        do_action( 'agrikon_after_post_single' );
    }

    get_footer();
?>
