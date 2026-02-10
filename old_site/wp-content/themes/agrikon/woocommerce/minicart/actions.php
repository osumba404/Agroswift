<?php

if ( ! function_exists( 'agrikon_header_mini_cart' ) ) {
    function agrikon_header_mini_cart()
    {
        global $woocommerce;
        $cart_url = 'popup' == agrikon_settings( 'header_cart_trigger', 'cart' ) ? '#0' : wc_get_cart_url();
        $tigger_cart = 'popup' == agrikon_settings( 'header_cart_trigger', 'cart' ) ? ' trigger--popup' : '';
        if ( '0' != agrikon_settings( 'header_cart_visibility', '0' ) ) {
            ?>
            <a class="main-header__cart-btn<?php echo esc_attr( $tigger_cart ); ?>" href="<?php echo esc_url( $cart_url ); ?>">
                <i class="agrikon-icon-shopping-cart"></i>
                <span class="header_cart_label_text"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
            </a>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_popup_mini_cart' ) ) {
    add_action('agrikon_after_body_open', 'agrikon_popup_mini_cart' );
    function agrikon_popup_mini_cart()
    {
        global $woocommerce;
        if ( '0' != agrikon_settings( 'header_cart_visibility', '0' ) ) {
            ?>
            <a class="main-header__cart-btn cart--fixed" href="#0">
                <i class="agrikon-icon-shopping-cart"></i>
                <span class="header_cart_label_text"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?></span>
            </a>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_mini_cart_content' ) ) {
    add_action('agrikon_after_body_open', 'agrikon_mini_cart_content' );
    function agrikon_mini_cart_content()
    {
        if ( '0' != agrikon_settings( 'header_cart_visibility', '0' ) ) {
            ?>
            <div class="agrikon_mini_cart_wrapper woocommerce">
                <div class="header_cart_close"><span class="icons is-close"></span></div>
                <?php get_template_part('woocommerce/minicart/header', 'minicart'); ?>
            </div>
            <?php
        }
    }
}

if ( ! function_exists( 'agrikon_header_add_to_cart_fragment' ) ) {
    add_filter('woocommerce_add_to_cart_fragments', 'agrikon_header_add_to_cart_fragment');
    function agrikon_header_add_to_cart_fragment( $fragments )
    {
        global $woocommerce;
        ob_start();
        echo'<span class="header_cart_label_text">';
        if ( $woocommerce->cart->cart_contents_count != 0  ) {
            printf( '%s', WC()->cart->cart_contents_count );
        }
        echo'</span>';
        $fragments['span.header_cart_label_text'] = ob_get_clean();
        return $fragments;
    }
}

if ( ! function_exists( 'agrikon_header_add_to_cart_content' ) ) {
    add_filter('woocommerce_add_to_cart_fragments', 'agrikon_header_add_to_cart_content');
    function agrikon_header_add_to_cart_content( $fragments )
    {
        ob_start();
        get_template_part('woocommerce/minicart/header', 'minicart');
        $fragments['div.header_cart_detail'] = ob_get_clean();
        return $fragments;
    }
}


/* wishlist content via ajax */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
    function yith_wcwl_ajax_update_count() {
        wp_send_json( array(
            'count' => yith_wcwl_count_all_products()
        ) );
    }
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action('agrikon_after_main_footer', 'agrikon_wishlist_label_count' );

    function agrikon_wishlist_label_count()
    {
        if ( '0' != agrikon_settings( 'header_cart_visibility', '0' ) ) {
            ?>
            <a class="wishlist--count" href="#0">
                <span class="agrikon-wishlist--icon is-heart"></span>
                <span class="wishlist_label_count"></span>
            </a>
            <div class="wishlist--content">
                <div class="header_cart_close"><span class="icons is-close"></span></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <?php echo do_shortcode( '[yith_wcwl_wishlist]' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script('jquery-yith-wcwl',
    "jQuery( function( $ ) {
        var wl = $('#yith-wcwl-form'),
        wl_data = $('#yith-wcwl-form').data('fragment-options'),
        wl_count;

        if ( wl && wl_data ) {
            wl_count = wl_data.count;
            if ( wl_count != 0 ) {

                $( '.wishlist_label_count' ).html( wl_count );
            }

            $('.wishlist--count').on( 'click', function (e) {
                e.preventDefault();
                $('.wishlist--content').addClass('open');
            });
            $('.wishlist--content .header_cart_close').on( 'click', function (e) {
                e.preventDefault();
                $('.wishlist--content').removeClass('open');
            });
        }
        $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
                action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
                console.log( data.count );
                if ( data.count == 0 ) {
                    $('.wishlist--count .wishlist_label_count').html();
                } else {
                    $('.wishlist--count .wishlist_label_count').html( data.count );
                }
            });
        });

    });"
    );
  }
  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}
