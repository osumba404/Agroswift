<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <!-- Meta UTF8 charset -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />
    <meta name="theme-color" content="#056EB9" />
    <meta name="msapplication-navbutton-color" content="#056EB9" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#056EB9" />
    <?php wp_head(); ?>

</head>

<!-- BODY START -->
<body <?php body_class(); ?>>

    <?php

    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }

    do_action( 'agrikon_after_body_open' );

    // theme preloader
    agrikon_preloader();

    // theme back-to-top button
    agrikon_backtop();

    // Elementor `header` location
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {

        /**
        * Hook: agrikon_before_page_wrapper_action.
        *
        * @hooked agrikon_header_mobile - 10
        * @hooked agrikon_header_popup_search - 20
        */
        do_action( 'agrikon_before_page_wrapper_action' );

        echo '<div class="page-wrapper">';
        // include logo, menu and more contents
        do_action( 'agrikon_header_action' );

    }

    ?>
