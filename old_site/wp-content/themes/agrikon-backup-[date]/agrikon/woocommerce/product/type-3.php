<?php

/*
** Product type 1
*/

defined( 'ABSPATH' ) || exit;

global $product;

?>

<div class="row">

    <div class="col-lg-4">
        <div class="product-thumb">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
            </a>
            <?php agrikon_product_save_price(); ?>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="product-body">

            <?php
            agrikon_product_title();
            agrikon_product_price();
            agrikon_product_rating();
            ?>

            <div class="product-actions">
                <div class="shop-cart_button">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
        </div>

    </div>
</div>
