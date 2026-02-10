<?php


/**
* Custom template parts for this theme.
*
* Eventually, some of the functionality here could be replaced by core features.
*
* @package agrikon
*/


add_action( 'agrikon_footer_action', 'agrikon_footer', 10 );

if ( ! function_exists( 'agrikon_footer' ) ) {
    function agrikon_footer()
    {

        $footer_visibility = agrikon_settings( 'footer_visibility', '1' );
        $page_footer_visibility = agrikon_page_settings( 'hide_page_footer', '1' );
        $footer_visibility = '0' != $footer_visibility && is_page() ? $page_footer_visibility : $footer_visibility;

        $footer_id = false;

        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $footer_id = $page_settings->get_settings( 'agrikon_page_footer_template' );
            $footer_id = isset( $footer_id ) !== '' ? $page_settings->get_settings( 'agrikon_page_footer_template' ) : $footer_id;
        }

        if ( '0' != $footer_visibility ) {

            if ( class_exists( '\Elementor\Frontend' ) && 'elementor' == agrikon_settings( 'footer_type', 'default' ) ) {

                $frontend = new \Elementor\Frontend;

                if ( $footer_id ) {

                    printf( '<footer class="agrikon-elementor-footer footer-'.$footer_id.'">%1$s</footer>', $frontend->get_builder_content( $footer_id, false ) );

                } else {

                    if ( !empty( agrikon_settings( 'footer_elementor_templates' ) ) ) {

                        $template_id = agrikon_settings( 'footer_elementor_templates' );

                        printf( '<footer class="agrikon-elementor-footer footer-'.$template_id.'">%1$s</footer>', $frontend->get_builder_content( $template_id, false ) );

                    } else {

                        echo sprintf('<p class="copyright text-center ptb-40">%s <a class="button button-slide" href="%s"><span class="button_text">%s</span></a></p>',
                            esc_html__('No template exist for footer.', 'agrikon'),
                            admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ),
                            esc_html__('Add new section template.', 'agrikon')
                        );
                    }
                }

            } else {

                agrikon_copyright();

            }
        }
    }
}

/*************************************************
##  FOOTER COPYRIGHT
*************************************************/

if ( ! function_exists( 'agrikon_copyright' ) ) {
    function agrikon_copyright()
    {
        $left_visibility = agrikon_settings( 'footer_copyright_left_visibility', '1' );
        $right_visibility = agrikon_settings( 'footer_copyright_right_visibility', '0' );
        $left_align = '0' != $right_visibility ? agrikon_settings( 'footer_copyright_left_align', 'text-left' ) : 'text-center';
        $right_align = '0' == $left_visibility ? agrikon_settings( 'footer_copyright_right_align', 'text-right' ) : 'text-right';
        $left_attr = '0' != $right_visibility ? 'col-lg-6 col-md-4' : 'col-sm-12';
        $right_attr = '0' != $left_visibility ? 'col-lg-6 col-md-8' : 'col-sm-12';
        ?>
        <footer id="nt-footer" class="bottom-footer footer-sm">
            <div class="container">

                <?php if ( '0' != $left_visibility ) { ?>
                    <div class="<?php echo esc_attr( $left_attr ); ?>">
                        <div class="<?php echo esc_attr( $left_align ); ?>">
                            <?php
                            if ( '' != agrikon_settings( 'footer_copyright_left' ) ) {

                                echo wp_kses( agrikon_settings( 'footer_copyright_left' ), agrikon_allowed_html() );

                            } else {

                                echo sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Template. %4$s <a class="dev" href="https://ninetheme.com/contact/"> %5$s</a></p>',
                                    date_i18n( _x( 'Y', 'copyright date format', 'agrikon' ) ),
                                    esc_url( home_url( '/' ) ),
                                    get_bloginfo( 'name' ),
                                    esc_html__( 'Made with passion by', 'agrikon' ),
                                    esc_html__( 'Ninetheme.', 'agrikon' )
                                );
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ( '0' != $right_visibility ) { ?>
                    <div class="<?php echo esc_attr( $right_attr ); ?>">
                        <div class="<?php echo esc_attr( $right_align ); ?>">

                            <?php if ( '' != agrikon_settings( 'footer_copyright_right' ) ) { ?>

                                <?php echo wp_kses( agrikon_settings( 'footer_copyright_right' ), agrikon_allowed_html() ); ?>

                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </footer>
        <?php
    }
}
