<?php
/**
* Related Products
*
* This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see         https://docs.woocommerce.com/document/template-structure/
* @package     WooCommerce\Templates
* @version     3.9.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$heading = agrikon_settings('single_shop_related_title', '');
$heading = $heading ? esc_html( $heading ) : apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

$perview = agrikon_settings( 'shop_related_perview', 4 );
$mdperview = agrikon_settings( 'shop_related_mdperview', 3 );
$smperview = agrikon_settings( 'shop_related_smperview', 2 );
$sattr    = array();
$sattr[] .= '"speed":'.agrikon_settings( 'shop_related_speed', 1000 );
$sattr[] .= '"slidesPerView":1';
$sattr[] .= '"spaceBetween":'.agrikon_settings( 'shop_related_gap', 30 );
$sattr[] .= '1' == agrikon_settings( 'shop_related_centered', 1 ) ? '"center":true' : '"center":false';
$sattr[] .= '1' == agrikon_settings( 'shop_related_loop', 0 ) ? '"loop":true' : '"loop":false';
$sattr[] .= '1' == agrikon_settings( 'shop_related_autoplay', 1 ) ? '"autoplay":true' : '"autoplay":false';
$sattr[] .= '1' == agrikon_settings( 'shop_related_mousewheel', 0 ) ? '"mousewheel":true' : '"mousewheel":false';
$sattr[] .= '"navigation": {"nextEl": ".slide-prev-related","prevEl": ".slide-next-related"}';
$sattr[] .= '"breakpoints": {"0": {"spaceBetween": 0,"slidesPerView": '.$smperview.'},"768": {"slidesPerView": '.$mdperview.'},"1024": {"slidesPerView": '.$perview.'}}';

if ( $related_products ) {
    wp_enqueue_style( 'swiper' );
    wp_enqueue_script( 'swiper' );
    ?>
    <section class="related products section-padding pb-0">

        <?php if ( $heading ) : ?>
            <h2><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <div class="thm-wc-slider__wrapper woocommerce">
            <div class="thm-swiper__slider thm-swiper__slider2 swiper-container" data-swiper-options='{<?php echo implode( ',',$sattr ); ?>}'>
                <div class="swiper-wrapper">

                    <?php foreach ( $related_products as $related_product ) : ?>
                        <div class="swiper-slide">
                            <?php
                            $post_object = get_post( $related_product->get_id() );

                            setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                            wc_get_template_part( 'content', 'product' );
                            ?>
                        </div>

                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-prev slide-prev-related"><i class="agrikon-icon-left-arrow"></i></div>
                <div class="swiper-button-next slide-next-related"><i class="agrikon-icon-right-arrow"></i></div>
            </div>
        </div>
    </section>
    <?php
}

wp_reset_postdata();
