<?php
/**
* Taxonomy: Agrikon Brands.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
if ( ! class_exists( 'Agrikon_Product_Brand' ) ) {
    class Agrikon_Product_Brand {
        private static $instance = null;
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }
        public function __construct() {
            add_action( 'init', array( $this, 'register_taxes' ) );
            // Set Brand taxonomy term when you duplicate the product
            add_action( 'woocommerce_product_duplicate', array( $this, 'woocommerce_product_duplicate' ), 10, 2 );
        }
        public function register_taxes() {
            $labels = [
                "name" => __( "Agrikon Brands", "agrikon" ),
                "singular_name" => __( "Agrikon Brand", "agrikon" ),
                "menu_name" => __( "Brands", "agrikon" ),
                "all_items" => __( "All Brands", "agrikon" ),
                "edit_item" => __( "Edit Brand", "agrikon" ),
                "view_item" => __( "View Brand", "agrikon" ),
                "update_item" => __( "Update Brand name", "agrikon" ),
                "add_new_item" => __( "Add new Brand", "agrikon" ),
                "new_item_name" => __( "New brand name", "agrikon" ),
                "parent_item" => __( "Parent Brand", "agrikon" ),
                "parent_item_colon" => __( "Parent Brand:", "agrikon" ),
                "search_items" => __( "Search Brands", "agrikon" ),
                "popular_items" => __( "Popular Brands", "agrikon" ),
                "separate_items_with_commas" => __( "Separate brand with commas", "agrikon" ),
                "add_or_remove_items" => __( "Add or remove brand", "agrikon" ),
                "choose_from_most_used" => __( "Choose from the most used brand", "agrikon" ),
                "not_found" => __( "No brand found", "agrikon" ),
                "no_terms" => __( "No brand", "agrikon" ),
                "items_list_navigation" => __( "Brands list navigation", "agrikon" ),
                "items_list" => __( "Brands list", "agrikon" )
            ];
            $args = [
                "label" => __( "Agrikon Brands", "agrikon" ),
                "labels" => $labels,
                "public" => true,
                "publicly_queryable" => true,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => array(
                    'slug' => 'product-brands',
                    'with_front' => true,
                    'hierarchical' => true
                ),
                "show_admin_column" => true,
                "show_in_quick_edit" => true,
                'capabilities' => array(
                    'manage_terms' => 'manage_product_terms',
                    'edit_terms'   => 'edit_product_terms',
                    'delete_terms' => 'delete_product_terms',
                    'assign_terms' => 'assign_product_terms',
                )
            ];
            register_taxonomy( "agrikon_product_brands", "product", $args );
            register_taxonomy_for_object_type( "agrikon_product_brands", "product" );
        }
        /**
        * Set brands for duplicated product
        *
        * @param $duplicate
        * @param $product
        */
        public function woocommerce_product_duplicate( $duplicate, $product ) {
            $brands     = wp_get_object_terms( $product->get_id(), "agrikon_product_brands" );
            $brands_ids = array();
            if ( count( $brands ) > 0 ) {
                foreach ( $brands as $brand ) {
                    $brands_ids[] = $brand->term_id;
                }
                wp_set_object_terms( $duplicate->get_id(), $brands_ids, "agrikon_product_brands" );
            }
        }
    }
    Agrikon_Product_Brand::get_instance();
}
