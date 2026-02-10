<?php

/*
* Admin Assets
*/
function agrikon_enqueue_admin_assets( $hook ) {
    global $agrikon_admin_menu_page;
    if( $hook != $agrikon_admin_menu_page ) {
        return;
    }
    wp_enqueue_style( 'agrikon-admin-bootstrap-css',  plugins_url( 'assets/admin/css/bootstrap.min.css', dirname(__DIR__) )  );
    wp_enqueue_style( 'agrikon-admin-styles', plugins_url( 'assets/admin/css/plugin-admin-styles.css', dirname(__DIR__) ) );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'agrikon-admin-popper-js', plugins_url( 'assets/admin/js/popper.min.js', dirname(__DIR__) ) );
    wp_enqueue_script( 'agrikon-admin-bootstrap-js', plugins_url( 'assets/admin/js/bootstrap.min.js', dirname(__DIR__) ) );
    wp_enqueue_script( 'agrikon-admin-script-js',  plugins_url( 'assets/admin/js/plugin-admin-scripts.js', dirname(__DIR__) ) );
}
add_action( 'admin_enqueue_scripts', 'agrikon_enqueue_admin_assets' );

add_action( 'admin_menu', 'agrikon_admin_menu_page', 200 );
function agrikon_admin_menu_page() {
    $parent_slug = apply_filters( 'ninetheme_parent_slug', 'elementor' );
    $page_title = esc_html__( 'Agrikon Addons', 'agrikon' );
    $menu_title = '<span class="dashicons dashicons-tagcloud"></span> ' .esc_html__( 'Agrikon Addons', 'agrikon' );
    $capability = 'manage_options';
    $menu_slug = 'agrikon';
    $function = 'agrikon_admin_menu_page_display';
    global $agrikon_admin_menu_page;
    $agrikon_admin_menu_page = add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
}

/*
* Admin Menu Page Output
*/
function agrikon_admin_menu_page_display() {
    if ( !current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized user' );
    }
    require_once( __DIR__ . '/admin-template.php' );
}
