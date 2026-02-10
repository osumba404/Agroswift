<?php

/*
** WooCommerce shop/product listing page
*/

get_header();

do_action("agrikon_before_wc_shop_page");

$shop_layout = agrikon_settings( 'shop_layout', 'right-sidebar' );
$container_width = agrikon_settings( 'shop_container_width', '' );
$column = 'full-width' != $shop_layout && is_active_sidebar( 'shop-page-sidebar' ) ? 'col-lg-9 shop-has-sidebar' : 'col-lg-12';
?>

<!-- Woo shop page general div -->
<div id="nt-shop-page" class="nt-shop-page">

    <!-- Hero section - this function using on all inner pages -->
    <?php agrikon_wc_hero_section(); ?>

    <div class="nt-theme-inner-container section-padding">
        <div class="container<?php echo esc_attr( $container_width ); ?>">
            <div class="row">

                <!-- Left sidebar -->
                <?php
                if ( 'left-sidebar' == $shop_layout && is_active_sidebar( 'shop-page-sidebar' ) ) {
                    echo '<div id="nt-sidebar" class="col-lg-3">';
                        echo '<div class="blog-sidebar nt-sidebar-inner">';
                            dynamic_sidebar( 'shop-page-sidebar' );
                        echo '</div>';
                    echo '</div>';
                }
                ?>

                <!-- Content column -->
                <div class="<?php echo esc_attr( $column ); ?>">

                    <?php

                    if ( woocommerce_product_loop() ) {

                        woocommerce_product_loop_start();
                        
                        echo '<div class="col product_item notices--wrapper">';
                        /**
                        * Hook: woocommerce_before_shop_loop.
                        *
                        * @hooked woocommerce_output_all_notices - 10
                        * @hooked woocommerce_result_count - 20
                        * @hooked woocommerce_catalog_ordering - 30
                        */
                        do_action( 'woocommerce_before_shop_loop' );
                        echo '</div>';

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                /**
                                * Hook: woocommerce_shop_loop.
                                */
                                //do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        agrikon_index_loop_pagination();

                    } else {
                        /**
                        * Hook: woocommerce_no_products_found.
                        *
                        * @hooked wc_no_products_found - 10
                        */
                        do_action( 'woocommerce_no_products_found' );
                    }
                    ?>
                </div>
                <!-- End sidebar + content -->

                <!-- Right sidebar -->
                <?php
                if ( 'right-sidebar' == $shop_layout && is_active_sidebar( 'shop-page-sidebar' ) ) {
                    echo '<div id="nt-sidebar" class="col-lg-3">';
                        echo '<div class="blog-sidebar nt-sidebar-inner">';
                            dynamic_sidebar( 'shop-page-sidebar' );
                        echo '</div>';
                    echo '</div>';
                }
                ?>

            </div><!-- End row -->
        </div><!-- End container -->
    </div><!-- End #blog -->
</div><!-- End woo shop page general div -->
<?php

do_action("agrikon_after_wc_shop_page");

get_footer();

?>
