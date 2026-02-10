<?php

/*
Template name: Locomotive Template
*/

if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
    $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
    $header = $page_settings->get_settings( 'agrikon_elementor_hide_page_header' );
    if ( 'yes' == $header ) {
        remove_action( 'agrikon_header_action', 'agrikon_main_header', 10 );
    }
}

get_header();

wp_enqueue_style( 'locomotive-scroll' );
wp_enqueue_script( 'polyfill' );
wp_enqueue_script( 'locomotive-main');

?>

<div class="nt-locomotive-wrapper">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>

</div>

<?php remove_action( 'agrikon_footer_action', 'agrikon_footer', 10 ); ?>
<?php get_footer(); ?>
