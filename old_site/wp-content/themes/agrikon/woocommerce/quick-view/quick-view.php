<?php

if ( ! function_exists( 'agrikon_wc_quick_view' ) ) {
    add_action('woocommerce_after_shop_loop_item', 'agrikon_wc_quick_view');
    function agrikon_wc_quick_view()
    {
        global $product;
        /*
        wp_enqueue_script( 'wc-add-to-cart-variation' );
        if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
            if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
                wp_enqueue_script( 'zoom' );
            }
            if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
                wp_enqueue_script( 'photoswipe-ui-default' );
                wp_enqueue_style( 'photoswipe-default-skin' );
                if ( has_action( 'wp_footer', 'woocommerce_photoswipe' ) === false ) {
                    add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
                }
            }
            
        }
*/
        //wp_enqueue_script( 'wc-single-product' );
        
        printf( '<a href="#" data-product_id="%1$s" class="button agrikon-btn-quick-view"></a>',
        $product->get_id()
        );
    }
}

/*************************************************
## Quick View Output
*************************************************/
function agrikon_add_quick_view_html() {
    echo '<div class="single woocommerce quick_view_wrapper"><div class="quick_view_overlay"><span class="quick-close">×</span></div></div>';
}
add_action( 'agrikon_before_wp_footer', 'agrikon_add_quick_view_html' );

/*************************************************
## Quick View Scripts
*************************************************/

function agrikon_quick_view_scripts() {
    //wp_enqueue_style( 'magnific');
    //wp_enqueue_script( 'magnific');
    //wp_enqueue_script( 'flexslider');
    wp_enqueue_script( 'agrikon-quick-ajax', get_template_directory_uri() . '/woocommerce/quick-view/quick_ajax.js', array('jquery'), '1.0.0', true );
    wp_localize_script( 'agrikon-quick-ajax', 'myAjax', array(
        'ajaxurl' => esc_url(admin_url( 'admin-ajax.php' )),
        'security' => wp_create_nonce( 'agrikon-special-string' ),
    ));
}
add_action( 'wp_enqueue_scripts', 'agrikon_quick_view_scripts' );

/*************************************************
## Quick View CallBack
*************************************************/

add_action( 'wp_ajax_nopriv_quick_view', 'agrikon_quick_view_callback' );
add_action( 'wp_ajax_quick_view', 'agrikon_quick_view_callback' );

function agrikon_quick_view_callback() {
    
    if ( ! isset( $_REQUEST['product_id'] ) ) {
        die();
    }

    $product_id = intval( $_REQUEST['product_id'] );

    // Set the main wp query for the product.
    wp( 'p=' . $product_id . '&post_type=product' );

    ob_start();

    while ( have_posts() ) {
        the_post();
    ?>
    <div id="product-<?php the_ID(); ?>" <?php post_class('ajax_quick_view'); ?>>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>">
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="entry-summary">
                        <?php do_action( 'woocommerce_single_product_summary' ); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    }
    echo ob_get_clean();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    die();

}
