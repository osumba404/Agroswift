<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Agrikon
 * @since Agrikon 1.0
 */

 if ( is_active_sidebar( 'sidebar-1' ) ) {
?>
    <div id="nt-sidebar" class="nt-sidebar col-12 col-lg-4">
        <div class="blog-sidebar nt-sidebar-inner">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </div>
    </div>
<?php } ?>
