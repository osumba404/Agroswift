<?php
/**
* Mini-cart
*
* Contains the markup for the mini-cart, used by the cart widget.
*
* This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $woocommerce;

do_action( 'woocommerce_before_mini_cart' );
?>

<?php if ( $woocommerce->cart->cart_contents_count != 0  ) : ?>
    <div class="header_cart_detail">
        <div class="header_cart_products">
            <table>
                <tbody class="woocommerce-mini-cart<?php echo !empty($args['list_class']) ? ' '.esc_attr( $args['list_class'] ) : ''; ?>">
                    <?php do_action( 'woocommerce_before_mini_cart_contents' ); ?>
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
                        <?php
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
                            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                            $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <tr class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <td class="is-photo">
                                    <a class="product-media" href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ) ?>">
                                        <?php printf( '%s', $_product->get_image( array( 50, 50 ) ) ); ?>
                                    </a>
                                </td>
                                <td class="is-qty"><?php printf( esc_html__( 'x %1$s', 'naturally' ), $cart_item['quantity'] ); ?></td>
                                <td class="is-name"><?php echo esc_html( $product_name ); ?></td>
                                <td class="is-price"><?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="product-cost">' . sprintf( '%s', $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></td>
                                <td class="is-delete">
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><span class="icons is-close"></span></a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_attr__( 'Remove this item', 'naturally' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $cart_item_key ),
                                            esc_attr( $_product->get_sku() )
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php do_action( 'woocommerce_mini_cart_contents' ); ?>

                </tbody>
            </table>
        </div>

        <div class="header_cart_footer">
            <table>
                <tbody>
                    <tr class="is-totals">
                        <td class="is-total"><?php echo esc_html_e( 'Total: ', 'naturally' ); ?></td>
                        <td class="is-total-value"><?php printf( '%s', $woocommerce->cart->get_cart_subtotal() ); ?></td>
                    </tr>
                </tbody>
            </table>

            <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

            <div class="is-actions">
                <a class="button" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <?php echo esc_html_e( 'View Cart', 'naturally' ); ?>
                </a>
                <a class="button" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
                    <?php echo esc_html_e( 'Checkout', 'naturally' ); ?>
                </a>
            </div>

            <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

        </div>
    </div>
<?php else : ?>
    <div class="header_cart_detail shopcart-empty">
        <div class="header_cart_products">
            <h3 class="minicart-title"><?php echo esc_html__( 'Your Cart', 'naturally' ); ?></h3>
            <div class="empty-title"><?php esc_html_e( 'No products in the cart.', 'naturally' ); ?></div>
            <div class="header_cart_footer">

                <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

                <div class="is-actions">
                    <a class="button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                        <span class="button_text"><?php esc_html_e( 'Start Shopping', 'naturally' ); ?></span>
                    </a>
                    <a class="button" href="<?php echo esc_url( get_permalink( get_option( 'wp_page_for_privacy_policy' ) ) ); ?>">
                        <span class="button_text"><?php esc_html_e( 'Return Policy', 'naturally' ); ?></span>
                    </a>
                </div>

                <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

            </div>
        </div>
    </div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
