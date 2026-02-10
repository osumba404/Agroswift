<?php

/*
** Product type 1
*/

defined( 'ABSPATH' ) || exit;

?>
<div class="shop-product_photo">

    <?php do_action( 'agrikon_loop_product_thumb' ); ?>
    <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

    <div class="product-label_wrapper">
        <?php do_action( 'agrikon_loop_product_details' ); ?>
    </div>

</div>

<div class="shop-product_content">

    <div class="shop-product_body">
        <?php do_action( 'agrikon_loop_product_title' ); ?>
    </div>

    <div class="shop-product_footer">
        <div class="shop-cart_button">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
    </div>

</div>
