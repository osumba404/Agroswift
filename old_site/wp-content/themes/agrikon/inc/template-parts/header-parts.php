<?php

/**
 * Custom template parts for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package agrikon
*/

add_action( 'agrikon_before_page_wrapper_action', 'agrikon_header_mobile', 10 );
add_action( 'agrikon_before_page_wrapper_action', 'agrikon_header_popup_search', 20 );

/*************************************************
##  LOGO
*************************************************/

if ( ! function_exists( 'agrikon_logo' ) ) {
    function agrikon_logo()
    {
        $logo = agrikon_settings( 'logo_type', 'sitename' );
        $moblogo = '' != agrikon_settings( 'mob_img_logo' ) ? agrikon_settings( 'mob_img_logo' )[ 'url' ] : '';
        $hasmoblogo = '' != $moblogo ? ' has-mobile-logo': '';

        if ( '0' != agrikon_settings( 'logo_visibility', '1' ) ) {
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"  aria-label="logo image" class="nt-logo header-logo logo-type-<?php echo esc_attr( $logo.$hasmoblogo ); ?>">

                <?php if ( 'img' == $logo && '' != agrikon_settings( 'img_logo' ) ) { ?>

                    <img class="main-logo" src="<?php echo esc_url( agrikon_settings( 'img_logo' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />

                    <?php if ( '' != $moblogo ) { ?>
                        <img class="main-logo mobile-logo" src="<?php echo esc_url( agrikon_settings( 'mob_img_logo' )[ 'url' ] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
                    <?php } ?>

                <?php } elseif ( 'sitename' == $logo ) { ?>

                    <span class="header-text-logo"><?php bloginfo( 'name' ); ?></span>

                <?php } elseif ( 'customtext' == $logo ) { ?>

                    <span class="header-text-logo"><?php echo agrikon_settings( 'text_logo' ); ?></span>

                <?php } else { ?>

                    <span class="header-text-logo"> <?php bloginfo( 'name' ); ?> </span>

                <?php } ?>
            </a>
            <?php
        }
    }
}


/*************************************************
##  HEADER NAVIGATION
*************************************************/

if ( ! function_exists( 'agrikon_main_header' ) ) {
    add_action( 'agrikon_header_action', 'agrikon_main_header', 10 );
    function agrikon_main_header()
    {
        $pageheader_id = false;

        if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

            $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
            $pageheader_id = $page_settings->get_settings( 'agrikon_page_header_template' );
            $pageheader_id = isset( $pageheader_id ) !== '' ? $page_settings->get_settings( 'agrikon_page_header_template' ) : $pageheader_id;
        }

        if ( '0' != agrikon_settings( 'header_visibility', '1' ) ) {

            if ( 'elementor' == agrikon_settings( 'header_template', 'default' ) ) {

                if ( class_exists( '\Elementor\Frontend' ) ) {

                    if ( $pageheader_id ) {
                        $frontend = new \Elementor\Frontend;
                        printf( '<header class="agrikon-elementor-header header-'.$pageheader_id.'">%1$s</header>', $frontend->get_builder_content( $pageheader_id, false ) );

                    } else {

                        if ( !empty( agrikon_settings( 'header_elementor_templates' ) ) ) {

                            $template_id = agrikon_settings( 'header_elementor_templates' );
                            $frontend = new \Elementor\Frontend;
                            printf( '<header class="agrikon-elementor-header">%1$s</header>', $frontend->get_builder_content( $template_id, false ) );

                        } else {

                            echo sprintf('<p class="copyright text-center ptb-40">%s <a class="thm-btn" href="%s">%s</a></p>',
                                esc_html__('No template exist for header.', 'agrikon'),
                                admin_url( 'edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section' ),
                                esc_html__('Add new section template.', 'agrikon')
                            );
                        }
                    }
                }

            } else {

                $colortype1 = '2' == agrikon_settings( 'header_color_type', '1' ) ? 'main-header__two' : 'main-header__one';
                $colortype2 = '2' == agrikon_settings( 'header_color_type', '1' ) ? 'main-menu__two' : '';
                $reverse = '2' == agrikon_settings( 'header_menu_reverse', '0' ) ? ' reverse' : '';
                $rippedimg  = get_template_directory().'/images/ripped.svg';
                $rippedimg  = file_exists( $rippedimg ) ? get_template_directory_uri().'/images/ripped.svg' : '';
                ?>
                <header class="agrikon-main-header main-header <?php echo esc_attr( $colortype1 ); ?>">

                    <?php agrikon_header_topbar(); ?>

                    <nav class="main-menu <?php echo esc_attr( $colortype2.$reverse ); ?>">
                        <div class="<?php echo agrikon_settings( 'header_container_type', 'container' ); ?>">

                            <div class="logo-box">
                                <?php agrikon_logo(); ?>
                                <span class="fa fa-bars mobile-nav__toggler"></span>
                            </div>

                            <ul class="main-menu__list">
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'menu' => '',
                                            'theme_location' => 'header_menu',
                                            'container' => '',
                                            'container_class' => '',
                                            'container_id' => '',
                                            'menu_class' => '',
                                            'menu_id' => '',
                                            'items_wrap' => '%3$s',
                                            'before' => '',
                                            'after' => '',
                                            'link_before' => '',
                                            'link_after' => '',
                                            'depth' => 5,
                                            'echo' => true,
                                            'fallback_cb' => 'Agrikon_Wp_Bootstrap_Navwalker::fallback',
                                            'walker' => new Agrikon_Wp_Bootstrap_Navwalker()
                                        )
                                    );
                                ?>
                            </ul>
                            <!-- /.main-menu__list -->

                            <div class="main-header__info">

                                <?php if ( '0' != agrikon_settings( 'header_search_visibility', '1' ) ) { ?>
                                    <a href="#" class="search-toggler main-header__search-btn"><i class="agrikon-icon-magnifying-glass"></i></a>
                                <?php } ?>

                                <?php
                                if ( class_exists( 'WooCommerce' ) ) {
                                    agrikon_header_mini_cart();
                                }
                                ?>

                                <?php
                                if ( '' != agrikon_settings( 'header_contact_button', '' ) ) {
                                    echo do_shortcode( agrikon_settings( 'header_contact_button' ) );
                                }
                                ?>

                            </div>
                        </div>
                    </nav>
                </header>

                <?php if ( '0' != agrikon_settings( 'header_sticky_visibility', '1' ) ) { ?>
                    <div class="stricky-header stricked-menu main-menu">
                        <div class="sticky-header__content"></div>
                    </div>
                    <?php
                }
            }
        }
    }
}

if ( !function_exists( 'agrikon_header_lang' ) ) {
    function agrikon_header_lang() {

        if ( function_exists( 'pll_the_languages' ) && '1' == agrikon_settings( 'nav_lang_visibility', '0' ) ) {
            ?>
            <ul class="lang-select">
                <li class="lang-item active">
                    <i class="fa fa-globe lang-icon"></i>
                    <?php echo pll_current_language( 'flag' ) ?>
                    <span class="uppercase"><?php echo pll_current_language( 'name' ) ?></span>
                    <i class="fa fa-angle-down lang-arrow"></i>
                </li>
                <li>
                    <ul class="sub-list">
                        <?php
                        pll_the_languages(
                            array(
                                'show_flags'=>1,
                                'show_names'=>1,
                                'dropdown'=>0,
                                'raw'=>0,
                                'hide_current'=>1,
                                'display_names_as'=>'name'
                            )
                        );
                        ?>
                    </ul>
                </li>
            </ul>
            <?php
        }
    }
}

if ( !function_exists( 'agrikon_header_mobile' ) ) {
    function agrikon_header_mobile() {

        if ( '' != agrikon_settings( 'header_visibility', '1' ) ) {
            ?>
            <div class="mobile-nav__wrapper mobile-nav__default">
                <div class="mobile-nav__overlay mobile-nav__toggler"></div>
                <div class="mobile-nav__content">
                    <span class="mobile-nav__close mobile-nav__toggler"><i class="far fa-times"></i></span>

                    <?php if ( '0' != agrikon_settings( 'logo_visibility', '1' ) ) { ?>
                        <div class="logo-box">
                            <?php agrikon_logo(); ?>
                        </div>
                    <?php } ?>

                    <div class="mobile-nav__container"></div>

                    <?php if ( '' != agrikon_settings( 'nav_contact', '' ) ) { ?>
                        <div class="mobile-nav__contact list-unstyled">
                            <?php echo do_shortcode( agrikon_settings( 'nav_contact', '1' ) ); ?>
                        </div>
                    <?php } ?>

                    <div class="mobile-nav__top">

                        <?php agrikon_header_lang(); ?>

                        <?php if ( '' != agrikon_settings( 'header_social', '' ) ) { ?>
                            <div class="mobile-nav__social">
                                <?php echo do_shortcode( agrikon_settings( 'header_social' ) ); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if ( !function_exists( 'agrikon_header_topbar' ) ) {
    function agrikon_header_topbar() {

        if ( '1' == agrikon_settings( 'header_topbar_visibility', '0' ) ) {

            if ( 'elementor' == agrikon_settings( 'header_topbar_template', 'default' ) ) {

                if ( class_exists( '\Elementor\Frontend' ) && !empty( agrikon_settings( 'header_topbar_elementor' ) ) ) {

                    $template_id = agrikon_settings( 'header_topbar_elementor' );
                    $frontend = new \Elementor\Frontend;
                    printf( '%1$s', $frontend->get_builder_content( $template_id, false ) );
                }

            } else {
                ?>
                <div class="topbar">
                    <div class="<?php echo agrikon_settings( 'header_topbar_container_type', 'container' ); ?>">
                        <div class="topbar__left">

                            <?php if ( '' != agrikon_settings( 'header_topbar_left', '' ) ) { ?>
                                <div class="topbar__social">
                                    <?php echo do_shortcode( agrikon_settings( 'header_topbar_left' ) ); ?>
                                </div>
                            <?php } ?>

                            <?php if ( '' != agrikon_settings( 'header_topbar_text', '' ) ) { ?>
                                <p><?php echo agrikon_settings( 'header_topbar_text' ); ?></p>
                            <?php } ?>

                        </div>

                        <?php if ( '' != agrikon_settings( 'header_topbar_right', '' ) ) { ?>
                            <div class="topbar__right">
                                <?php echo do_shortcode( agrikon_settings( 'header_topbar_right' ) ); ?>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <?php
            }
        }
    }
}

if ( !function_exists( 'agrikon_header_popup_search' ) ) {
    function agrikon_header_popup_search() {

        if ( '' != agrikon_settings( 'header_search_visibility', '1' ) ) {
            ?>
            <div class="search-popup search-popup__default">
                <div class="search-popup__overlay search-toggler"></div>
                <div class="search-popup__content">
                    <?php
                    if ( 'product' == agrikon_settings( 'header_search_type', '1' )) {
                        if ( function_exists( 'aws_get_search_form' ) ) {
                            aws_get_search_form();
                        } else {
                            echo do_shortcode('[agrikon_wc_ajax_search]');
                        }
                    } else {
                        echo agrikon_content_custom_search_form();
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}
