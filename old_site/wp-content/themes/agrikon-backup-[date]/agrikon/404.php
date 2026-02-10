<?php

/**
* The template for displaying 404 pages (not found)
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package WordPress
* @subpackage Agrikon
* @since 1.0.0
*/

    if ( '0' == agrikon_settings( 'error_header_visibility', '1' ) ) {
        remove_action( 'agrikon_header_action', 'agrikon_main_header', 10 );
    }
    if ( '0' == agrikon_settings( 'error_header_visibility', '1' ) ) {
        remove_action( 'agrikon_footer_action', 'agrikon_footer', 10 );
    }

    get_header();

    // you can use this action for add any content before container element
    do_action( 'agrikon_before_404' );

    $agrikon_error_page_type = agrikon_settings( 'error_page_type', 'default' );

    if ( 'elementor' == $agrikon_error_page_type ) {

        if ( class_exists( '\Elementor\Frontend' ) ) {

            if ( !empty( agrikon_settings( 'error_page_elementor_templates' ) ) ) {

                $template_id = agrikon_settings( 'error_page_elementor_templates' );
                $frontend = new \Elementor\Frontend;
                printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );

            } else {

                echo sprintf('<div class="text-center no-template"><p class="ptb-40">%s</p><p class="pt-40"><a class="thm-btn" href="%s">%s</a></p></div>',
                    esc_html__('No template exist for Error Page.', 'agrikon'),
                    admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=page' ),
                    esc_html__('Add new page template.', 'agrikon')
                );
            }
        }

    } else {
?>
        <div id="nt-404" class="nt-404 error">
            <?php agrikon_hero_section(); ?>

            <div class="nt-theme-inner-container section-padding text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <?php
                            if ( '0' != agrikon_settings('error_content_desc_visibility', '1' ) ) {
                                if ( '' != agrikon_settings( 'error_content_desc' ) ) {
                                    printf( '<p class="content-text">%1$s</p>',
                                        wp_kses( agrikon_settings( 'error_content_desc' ), agrikon_allowed_html() )
                                    );
                                } else {
                                    printf( '<p class="content-text">%1$s</p>',
                                        esc_html__( 'Sorry, but the page you are looking for does not exist or has been removed', 'agrikon' )
                                    );
                                }
                            }

                            if ( '0' != agrikon_settings('error_content_btn_visibility', '1' ) ) {
                                if ( '' != agrikon_settings( 'error_content_btn_title' ) ) {
                                    printf( '<a href="%1$s" class="thm-btn mt-30"><span>%2$s</span></a>',
                                        esc_url( home_url('/') ),
                                        esc_html( agrikon_settings( 'error_content_btn_title' ) )
                                    );
                                } else {
                                    printf( '<a href="%1$s" class="thm-btn mt-30"><span>%2$s</span></a>',
                                        esc_url( home_url('/') ),
                                        esc_html__( 'Go to home page', 'agrikon' )
                                    );
                                }
                            }
                            if ( '0' != agrikon_settings( 'error_content_form_visibility', '1' ) ) {
                                echo agrikon_content_custom_search_form();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // use this action to add any content after 404 page container element
    do_action( 'agrikon_after_404' );

    get_footer();

?>
