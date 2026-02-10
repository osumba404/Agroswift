<?php
/**
 * Functions which enhance the theme by hooking into WordPress
*/


/*************************************************
## ADMIN NOTICES
*************************************************/

function agrikon_theme_activation_notice()
{
    global $current_user;

    $user_id = $current_user->ID;

    if (!get_user_meta($user_id, 'agrikon_theme_activation_notice')) {
        ?>
        <div class="updated notice">
            <p>
                <?php
                    echo sprintf(
                    esc_html__( 'If you need help about demodata installation, please read docs and %s', 'agrikon' ),
                    '<a target="_blank" href="' . esc_url( 'https://ninetheme.com/contact/' ) . '">' . esc_html__( 'Open a ticket', 'agrikon' ) . '</a>
                    ' . esc_html__('or', 'agrikon') . ' <a href="' . esc_url( wp_nonce_url( add_query_arg( 'agrikon-ignore-notice', 'dismiss_admin_notices' ), 'agrikon-dismiss-' . get_current_user_id() ) ) . '">' . esc_html__( 'Dismiss this notice', 'agrikon' ) . '</a>');
                ?>
            </p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'agrikon_theme_activation_notice' );

function agrikon_theme_activation_notice_ignore()
{
    global $current_user;

    $user_id = $current_user->ID;

    if ( isset($_GET[ 'agrikon-ignore-notice' ] ) ) {
        add_user_meta($user_id, 'agrikon_theme_activation_notice', 'true', true);
    }
}
add_action( 'admin_init', 'agrikon_theme_activation_notice_ignore' );


/*************************************************
## DATA CONTROL FROM THEME-OPTIONS PANEL
*************************************************/
if ( !function_exists( 'agrikon_settings' ) ) {
    function agrikon_settings( $opt_id, $def_value='' )
    {
        global $agrikon;

        $defval = '' != $def_value ? $def_value : false;
        $opt_id = trim( $opt_id );
        $opt    = isset( $agrikon[ $opt_id ] ) ? $agrikon[ $opt_id ] : $defval;

        if ( !class_exists( 'Redux' ) ) {
            return $defval;
        } else {
            return $opt;
        }
    }
}


/*************************************************
## Sidebar function
*************************************************/
if ( ! function_exists( 'agrikon_sidebar' ) ) {
    function agrikon_sidebar( $sidebar='', $default='' )
    {
        $sidebar = trim( $sidebar );
        $default = is_active_sidebar( $default ) ? $default : false;
        $sidebar = is_active_sidebar( $sidebar ) ? $sidebar : $default;
        if ( $sidebar ) {
            return $sidebar;
        }
        return false;
    }
}


/************************************************************
## DATA CONTROL FROM PAGE METABOX OR ELEMENTOR PAGE SETTINGS
*************************************************************/
if ( !function_exists( 'agrikon_page_settings' ) ) {
    function agrikon_page_settings( $opt_id, $def_value='' )
    {
        $defval = '' != $def_value ? $def_value : false;
        $page_settings = $defval;

        if( $opt_id ) {

            $template = get_post_meta( get_the_ID(), '_wp_page_template', true );

            switch ( $template ) {
                case 'agrikon-elementor-page.php':

                    if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {

                        // Get the page settings manager
                        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
                        $page_settings = $page_settings->get_settings( 'agrikon_elementor_'.trim( $opt_id ) );

                        if ( 'yes' == $page_settings || 'no' == $page_settings ) {

                            $page_settings = 'yes' == $page_settings ? '0' : '1';

                        } else {

                            $page_settings = $page_settings;

                        }
                    }

                break;

                case 'default':
                    if ( class_exists( 'ACF' ) && function_exists( 'get_field' ) ) {

                        $page_settings = get_field( 'agrikon_'.trim( $opt_id ) );

                        if ( is_bool( $page_settings ) ) {

                            $page_settings = true === get_field( 'agrikon_'.trim( $opt_id ) ) ? '0' : '1';

                        } else {

                            $page_settings = get_field( 'agrikon_'.trim( $opt_id ) );

                        }
                    }
                    break;

                default:
                    $page_settings = $defval;
                break;
            }
            return $page_settings;

        } else {

            return $defval;

        }
    }
}


/*************************************************
## GET ELEMENTOR PAGE CUSTOM CSS
*************************************************/
if ( !function_exists( 'agrikon_elementor_page_custom_css' ) ) {
    function agrikon_elementor_page_custom_css()
    {
        $theCSS = get_option( '_agrikon_elementor_page_custom_css' );
        if ($theCSS ) {
            wp_register_style( 'agrikon-custom-page-style', false );
            wp_enqueue_style( 'agrikon-custom-page-style' );
            wp_add_inline_style( 'agrikon-custom-page-style', $theCSS );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'agrikon_elementor_page_custom_css' );


/*************************************************
## GET ALL ELEMENTOR PAGE TEMPLATES
# @return array
*************************************************/
if ( !function_exists( 'agrikon_get_elementorTemplates' ) ) {
    function agrikon_get_elementorTemplates( $type = null )
    {
        if ( class_exists( '\Elementor\Frontend' ) ) {
            $args = [
                'post_type' => 'elementor_library',
                'posts_per_page' => -1,
            ];
            if ( $type ) {
                $args[ 'tax_query' ] = [
                    [
                        'taxonomy' => 'elementor_library_type',
                        'field' => 'slug',
                        'terms' => $type
                    ]
                ];
            }
            $page_templates = get_posts( $args );
            $options = array();
            if ( !empty( $page_templates ) && !is_wp_error( $page_templates ) ) {
                foreach ( $page_templates as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            } else {
                $options = array(
                    '' => esc_html__( 'No template exist.', 'agrikon' )
                );
            }
            return $options;
        }
    }
}
/*************************************************
## GET ELEMENTOR DEFAULT STYLE KIT ID
*************************************************/
if ( !function_exists( 'agrikon_get_elementor_activeKit' ) ) {
    function agrikon_get_elementor_activeKit()
    {
        if ( class_exists( '\Elementor\Frontend' ) ) {

            $activekit = get_option( 'elementor_active_kit' );
            return $activekit;
        }
    }
}


/*************************************************
## CHECK IS ELEMENTOR
*************************************************/
if ( !function_exists( 'agrikon_check_is_elementor' ) ) {
    function agrikon_check_is_elementor()
    {
        global $post;
        if ( class_exists( '\Elementor\Plugin' ) ) {
            return \Elementor\Plugin::$instance->db->is_built_with_elementor( $post->ID );
        }
        return false;
    }
}

/*************************************************
## CHECK IS POST
*************************************************/
if ( !function_exists( 'agrikon_check_is_post' ) ) {
    function agrikon_check_is_post( $type='post' )
    {
        if ( class_exists( '\Elementor\Plugin' ) ) {
            $selected_post = get_option( 'elementor_cpt_support' );
            $types = get_post_types();
            if ( is_array( $selected_post ) ) {
                if ( in_array( $type, $selected_post ) ) {
                    return true;
                }
            }
            return false;
        }
    }
}

/*************************************************
## CHECK ELEMENTOR STYLE KIT
*************************************************/
if ( !function_exists( 'agrikon_get_elementor_style_kit' ) ) {
    add_action ( 'wp_head', 'agrikon_get_elementor_style_kit' );
    function agrikon_get_elementor_style_kit()
    {
        if ( class_exists( '\Elementor\Core\Kits\Manager' ) ) {
            if ( '1' == agrikon_settings( 'use_elementor_style_kit', '0' ) ) {
                $kit = new \Elementor\Core\Kits\Manager;
                $kit->preview_enqueue_styles();
            }
        }
    }
}


/*************************************************
## SANITIZE MODIFIED VC-ELEMENTS OUTPUT
*************************************************/

if ( !function_exists( 'agrikon_sanitize_data' ) ) {
    function agrikon_sanitize_data( $html_data )
    {
        return $html_data;
    }
}

/*************************************************
## SANITIZE MODIFIED VC-ELEMENTS OUTPUT
*************************************************/

if ( !function_exists( 'agrikon_check_page_hero' ) ) {
    function agrikon_check_page_hero()
    {
        if ( is_404() ) {

            $name = 'error';

        } elseif ( is_archive() ) {

            $name = 'archive';

        } elseif ( is_search() ) {

            $name = 'search';

        } elseif ( is_home() || is_front_page() ) {

            $name = 'blog';

        } elseif ( is_single() ) {

            $name = 'single';

        } elseif ( is_page() ) {

            $name = 'page';

        }
        $h_v = agrikon_settings( $name.'_hero_visibility', '1' );
        $h_v = '0' == $h_v ? 'page-hero-off' : '';
        return $h_v;
    }
}

/*************************************************
## CUSTOM BODY CLASSES
*************************************************/
if ( !function_exists( 'agrikon_body_theme_classes' ) ) {
    function agrikon_body_theme_classes( $classes )
    {
        global $post,$is_IE, $is_safari, $is_chrome, $is_iphone;

        $classes[] = class_exists( 'WooCommerce' ) && ! is_cart() && ! is_account_page() ? 'nt-page-default' : '';
        $classes[] = wp_get_theme();
        $classes[] = wp_get_theme() . '-v' . wp_get_theme()->get( 'Version' );
        $classes[] = '0' == agrikon_settings( 'preloader_visibility', '1' ) ? 'preloader-off' : 'preloader-on';
        $classes[] = '0' == agrikon_settings( 'header_visibility', '1' ) ? 'header-off' : '';
        $classes[] = 'elementor' == agrikon_settings( 'footer_type', 'default' ) && '' != agrikon_settings( 'footer_elementor_templates', '' ) ? 'has-elementor-footer-template' : '';
        $classes[] = 'header-type-'.agrikon_settings( 'header_color_type', '1' );
        $classes[] = '1' == agrikon_settings( 'use_elementor_style_kit', '0' ) ? 'use-elementor-style-kit' : '';
        $classes[] = agrikon_check_page_hero();
        $classes[] = is_singular( 'post' ) && has_blocks() ? 'nt-single-has-block' : '';
        $classes[] = is_page() && comments_open() ? 'page-has-comment' : '';
        $classes[] = is_singular( 'post' ) && !has_post_thumbnail() ? 'nt-single-thumb-none' : '';
        $classes[] = $is_IE ? 'nt-msie' : '';
        $classes[] = $is_chrome ? 'nt-chrome' : '';
        $classes[] = $is_iphone ? 'nt-iphone' : '';
        $classes[] = function_exists('wp_is_mobile') && wp_is_mobile() ? 'nt-mobile' : 'nt-desktop';

        return $classes;

    }
    add_filter( 'body_class', 'agrikon_body_theme_classes' );
}


/*************************************************
## CUSTOM POST CLASS
*************************************************/
if ( !function_exists( 'agrikon_post_theme_class' ) ) {
    function agrikon_post_theme_class( $classes )
    {
        if ( ! is_single() AND ! is_page() ) {
            $classes[] = 'nt-post-class';
            $classes[] = is_sticky() ? '-has-sticky ' : '';
            $classes[] = !get_the_title() ? 'thumb-none' : '';
            $classes[] = !has_post_thumbnail() ? 'thumb-none' : '';
            $classes[] = !get_the_title() ? 'title-none' : '';
            $classes[] = !has_excerpt() ? 'excerpt-none' : '';
            $classes[] = agrikon_settings( 'format_box_type', '' );
            $classes[] = wp_link_pages('echo=0') ? 'nt-is-wp-link-pages' : '';
        }

        return $classes;
    }
    add_filter( 'post_class', 'agrikon_post_theme_class' );
}


/*************************************************
## THEME SEARCH FORM
*************************************************/
if ( !function_exists( 'agrikon_content_custom_search_form' ) ) {
    function agrikon_content_custom_search_form()
    {
        $pleace_holder = '' != agrikon_settings( 'searchform_placeholder1' ) ? agrikon_settings( 'searchform_placeholder1' ) : esc_html__( 'Search Here...', 'agrikon' );
        $form = '<form class="agrikon_search" role="search" method="get" id="content-widget-searchform" action="' . esc_url( home_url( '/' ) ) . '" >
        <label for="cws" class="sr-only">'. esc_html( $pleace_holder ) .'</label>
        <input class="search_input" type="text" value="' . get_search_query() . '" placeholder="'. esc_attr( $pleace_holder ) .'" name="s" id="cws">
        <button class="thm-btn" id="contentsearchsubmit" type="submit"><span class="fa fa-search"></span></button>
        </form>';
        return $form;
    }
    add_filter( 'get_search_form', 'agrikon_content_custom_search_form' );
}


/*************************************************
## THEME SIDEBARS SEARCH FORM
*************************************************/
if ( !function_exists( 'agrikon_sidebar_search_form' ) ) {
    function agrikon_sidebar_search_form()
    {
        $pleace_holder = '' != agrikon_settings( 'searchform_placeholder2' ) ? agrikon_settings( 'searchform_placeholder2' ) : esc_html__( 'Search for...', 'agrikon' );
        $form = '<form class="sidebar_search" role="search" method="get" id="widget-searchform" action="' . esc_url( home_url( '/' ) ) . '" >
        <input class="sidebar_search_input" type="text" value="' . get_search_query() . '" placeholder="'. esc_attr( $pleace_holder ) .'" name="s" id="ws">
        <button class="sidebar_search_button button-slide" id="searchsubmit" type="submit"><i class="agrikon-icon-magnifying-glass"></i></button>
        </form>';
        return $form;
    }
    add_filter( 'get_product_search_form', 'agrikon_sidebar_search_form' );
    add_filter( 'get_search_form', 'agrikon_sidebar_search_form' );
}


/*************************************************
## THEME PASSWORD FORM
*************************************************/
if ( !function_exists( 'agrikon_custom_password_form' ) ) {
    function agrikon_custom_password_form()
    {
        global $post;
        $pleace_holder = '' != agrikon_settings( 'searchform_placeholder3' ) ? agrikon_settings( 'searchform_placeholder3' ) : esc_html__( 'Enter Password', 'agrikon' );
        $form = '<form class="form_password" role="password" method="get" id="widget-searchform" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass"><input class="form_password_input" type="password" placeholder="'. esc_attr( $pleace_holder ) .'" name="post_password" id="ws"><button class="form_password_button button-slide" id="submit" type="submit"><span class="fa fa-arrow-right"></span></button></form>';

        return $form;
    }
    add_filter( 'the_password_form', 'agrikon_custom_password_form' );
}


/*************************************************
## EXCERPT FILTER
*************************************************/
if ( !function_exists( 'agrikon_custom_excerpt_more' ) ) {
    function agrikon_custom_excerpt_more( $more )
    {
        return '...';
    }
    add_filter( 'excerpt_more', 'agrikon_custom_excerpt_more' );
}

/*************************************************
## EXCERPT LIMIT
*************************************************/
if ( !function_exists( 'agrikon_excerpt_limit' ) ) {
    function agrikon_excerpt_limit( $limit )
    {
        $excerpt = explode( ' ', get_the_excerpt(), $limit );
        if ( count( $excerpt ) >= $limit ) {
            array_pop( $excerpt );
            $excerpt = implode( " ", $excerpt ) . '...';
        } else {
            $excerpt = implode( " ", $excerpt );
        }
        $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
        return $excerpt;
    }
}

/*************************************************
## DEFAULT CATEGORIES WIDGET
*************************************************/
if ( !function_exists( 'agrikon_add_span_cat_count' ) ) {
    function agrikon_add_span_cat_count( $links )
    {

        $links = str_replace( '</a> (', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( '</a> <span class="count">(', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;

    }
    add_filter( 'wp_list_categories', 'agrikon_add_span_cat_count' );
}

/*************************************************
## woocommerce_layered_nav_term_html WIDGET
*************************************************/
if ( !function_exists( 'agrikon_add_span_woocommerce_layered_nav_term_html' ) ) {
    function agrikon_add_span_woocommerce_layered_nav_term_html( $links )
    {

        $links = str_replace( '</a> (', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( '</a> <span class="count">(', '</a> <span class="widget-list-span">', $links );
        $links = str_replace( ')', '</span>', $links );

        return $links;

    }
    add_filter( 'woocommerce_layered_nav_term_html', 'agrikon_add_span_woocommerce_layered_nav_term_html' );
}


/*************************************************
## DEFAULT ARCHIVES WIDGET
*************************************************/
if ( !function_exists( 'agrikon_add_span_arc_count' ) ) {
    function agrikon_add_span_arc_count( $links )
    {
        $links = str_replace( '</a>&nbsp;(', '</a> <span class="widget-list-span">', $links );

        $links = str_replace( ')', '</span>', $links );

        // dropdown selectbox
        $links = str_replace( '&nbsp;(', ' - ', $links );

        return $links;

    }
    add_filter( 'get_archives_link', 'agrikon_add_span_arc_count' );
}

/*************************************************
## PAGINATION CUSTOMIZATION
*************************************************/
if ( !function_exists( 'agrikon_sanitize_pagination' ) ) {
    function agrikon_sanitize_pagination( $content )
    {
        // remove role attribute
        $content = str_replace( 'role="navigation"', '', $content );

        // remove h2 tag
        $content = preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $content );

        return $content;

    }
    add_action( 'navigation_markup_template', 'agrikon_sanitize_pagination' );
}

/*************************************************
## CUSTOM ARCHIVE TITLES
*************************************************/
if ( !function_exists( 'agrikon_archive_title' ) ) {
    function agrikon_archive_title()
    {
        $title = '';
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag()) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = get_the_author();
        } elseif ( is_year() ) {
            $title = get_the_date( _x( 'Y', 'yearly archives date format', 'agrikon' ) );
        } elseif ( is_month() ) {
            $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'agrikon' ) );
        } elseif ( is_day() ) {
            $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'agrikon' ) );
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        } else {
            $title = get_the_archive_title();
        }

        return $title;
    }
    add_filter( 'get_the_archive_title', 'agrikon_archive_title' );
}


/*************************************************
## CHECKS TO SEE IF CPT EXISTS.
*************************************************/
/*
* By setting '_builtin' to false,
* we exclude the WordPress built-in public post types
* (post, page, attachment, revision, and nav_menu_item)
* and retrieve only registered custom public post types.
* return boolean
*/
if ( !function_exists( 'agrikon_cpt_exists' ) ) {
    function agrikon_cpt_exists()
    {

        $args = array(
           'public'   => true,
           '_builtin' => false
        );

        $output = 'names'; // 'names' or 'objects' (default: 'names')
        $operator = 'and'; // 'and' or 'or' (default: 'and')

        $post_types = get_post_types( $args, $output, $operator ); // get simple cpt if exists
        $classes = get_body_class();
        $cpt_exsits = array();

        if ( $post_types ) {
            foreach ( $post_types as $cpt ) {
                if ( is_single() ) {
                    array_push( $cpt_exsits, 'single-'.$cpt );
                }
                if ( is_archive() ) {
                    array_push( $cpt_exsits, 'post-type-archive-'.$cpt );
                }
            }
        }

        $sameclass = array_intersect( $cpt_exsits, $classes );

        if ( $sameclass ) {
            return true;
        }
        return false;
    }
}


/*************************************************
## CONVERT HEX TO RGB
*************************************************/

 if ( !function_exists( 'agrikon_hex2rgb' ) ) {
     function agrikon_hex2rgb( $hex )
     {
         $hex = str_replace( "#", "", $hex );

         if ( strlen( $hex ) == 3 ) {
             $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
             $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
             $b = hexdec(substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
         } else {
             $r = hexdec( substr( $hex, 0, 2 ) );
             $g = hexdec( substr( $hex, 2, 2 ) );
             $b = hexdec( substr( $hex, 4, 2 ) );
         }
         $rgb = array( $r, $g, $b );
         return implode(", ", $rgb); // returns with the rgb values
     }
 }

/**********************************
## THEME ALLOWED HTML TAG
/**********************************/

if ( !function_exists( 'agrikon_allowed_html' ) ) {
    function agrikon_allowed_html()
    {
        $allowed_tags = array(
            'a' => array(
                'class' => array(),
                'href'  => array(),
                'rel'   => array(),
                'title' => array(),
                'target' => array()
            ),
            'abbr' => array(
                'title' => array()
            ),
            'address' => array(),
            'iframe' => array(
                'src' => array(),
                'frameborder' => array(),
                'allowfullscreen' => array(),
                'allow' => array(),
                'width' => array(),
                'height' => array(),
            ),
            'b' => array(),
            'br' => array(),
            'blockquote' => array(
                'cite'  => array()
            ),
            'cite' => array(
                'title' => array()
            ),
            'code' => array(),
            'del' => array(
                'datetime' => array(),
                'title' => array()
            ),
            'dd' => array(),
            'div' => array(
                'class' => array(),
                'id'    => array(),
                'title' => array(),
                'style' => array()
            ),
            'dl' => array(),
            'dt' => array(),
            'em' => array(),
            'h1' => array(
                'class' => array()
            ),
            'h2' => array(
                'class' => array()
            ),
            'h3' => array(
                'class' => array()
            ),
            'h4' => array(
                'class' => array()
            ),
            'h5' => array(
                'class' => array()
            ),
            'h6' => array(
                'class' => array()
            ),
            'i' => array(
                'class'  => array()
            ),
            'img' => array(
                'alt'    => array(),
                'class'  => array(),
                'width'  => array(),
                'height' => array(),
                'src'    => array(),
                'srcset' => array(),
                'sizes' => array()
            ),
            'li' => array(
                'class' => array()
            ),
            'ol' => array(
                'class' => array()
            ),
            'p' => array(
                'class' => array()
            ),
            'q' => array(
                'cite' => array(),
                'title' => array()
            ),
            'span' => array(
                'class' => array(),
                'title' => array(),
                'style' => array()
            ),
            'strike' => array(),
            'strong' => array(),
            'ul' => array(
                'class' => array()
            )
        );
        return $allowed_tags;
    }
}

if ( !function_exists( 'agrikon_navmenu_choices' ) ) {
    function agrikon_navmenu_choices()
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
add_action('admin_notices', 'agrikon_notice_for_activation');
if (!function_exists('agrikon_notice_for_activation')) {
    function agrikon_notice_for_activation() {
        global $pagenow;

        if ( !get_option('envato_purchase_code_29806632') ) {

            echo '<div class="notice notice-warning">
                <p>' . sprintf(
                esc_html__( 'Enter your Envato Purchase Code to receive agrikon Theme and plugin updates  %s', 'agrikon' ),
                '<a href="' . admin_url('admin.php?page=merlin&step=license') . '">' . esc_html__( 'Enter Purchase Code', 'agrikon' ) . '</a>') . '</p>
            </div>';
        }

    }
}


if ( !get_option('envato_purchase_code_29806632') ) {
    add_filter('auto_update_theme', '__return_false');
}

add_action('upgrader_process_complete', 'agrikon_upgrade_function', 10, 2);
if ( !function_exists('agrikon_upgrade_function') ) {
    function agrikon_upgrade_function($upgrader_object, $options) {
        $purchase_code =  get_option('envato_purchase_code_29806632');

        if (($options['action'] == 'update' && $options['type'] == 'theme') && !$purchase_code) {
            wp_redirect(admin_url('admin.php?page=merlin&step=license'));
        }
    }
}

if ( !function_exists( 'agrikon_is_theme_registered') ) {
    function agrikon_is_theme_registered() {
        $purchase_code =  get_option('envato_purchase_code_29806632');
        $registered_by_purchase_code =  !empty($purchase_code);

        // Purchase code entered correctly.
        if ($registered_by_purchase_code) {
            return true;
        }
    }
}

function agrikon_deactivate_envato_plugin() {
    if (  function_exists( 'envato_market' ) && !get_option('envato_purchase_code_29806632') ) {
        deactivate_plugins('envato-market/envato-market.php');
    }
}
add_action( 'admin_init', 'agrikon_deactivate_envato_plugin' );
