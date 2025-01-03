<?php
/**
 * custom WooCommerce hooks
 *
 * @package custom
 */

/**
 * Homepage
 *
 * @see  custom_product_categories()
 * @see  custom_recent_products()
 * @see  custom_featured_products()
 * @see  custom_popular_products()
 * @see  custom_on_sale_products()
 * @see  custom_best_selling_products()
 */
add_action( 'homepage', 'custom_product_categories', 20 );
add_action( 'homepage', 'custom_recent_products', 30 );
add_action( 'homepage', 'custom_featured_products', 40 );
add_action( 'homepage', 'custom_popular_products', 50 );
add_action( 'homepage', 'custom_on_sale_products', 60 );
add_action( 'homepage', 'custom_best_selling_products', 70 );

/**
 * Layout
 *
 * @see  custom_before_content()
 * @see  custom_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  custom_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// add_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 5 );
add_action( 'woocommerce_before_main_content', 'custom_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'custom_after_content', 10 );
add_action( 'woocommerce_before_main_content_grey', 'custom_before_content_grey', 10 );
add_action( 'woocommerce_after_main_content_grey', 'custom_after_content_grey', 10 );
add_action( 'custom_content_top', 'custom_shop_messages', 15 );
add_action( 'custom_before_content', 'woocommerce_breadcrumb', 10 );

// add_action( 'woocommerce_after_shop_loop', 'custom_sorting_wrapper', 9 );
// add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
// add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
// add_action( 'woocommerce_after_shop_loop', 'custom_sorting_wrapper_close', 31 );

add_action( 'woocommerce_before_shop_loop', 'custom_filters_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop', 'custom_sorting_wrapper', 9 );
// add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
// add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_pagination', 30 );
add_action( 'woocommerce_before_shop_loop', 'custom_sorting_wrapper_close', 31 );
add_action( 'woocommerce_before_shop_loop', 'custom_filters_wrapper_close', 31 );

add_action( 'custom_footer', 'custom_handheld_footer_bar', 999 );

/**
 * Products
 *
 * @see custom_edit_post_link()
 * @see custom_upsell_display()
 * @see custom_single_product_pagination()
 * @see custom_sticky_single_add_to_cart()
 */

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_show_product_loop_sale_flash', 1 );

add_action( 'woocommerce_single_product_summary', 'custom_edit_post_link', 60 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'custom_upsell_display', 15 );

// dx - remove single product pagination nav - add_action( 'woocommerce_after_single_product_summary', 'custom_single_product_pagination', 30 );
// dxmod remove sticky add to cart - add_action( 'custom_after_footer', 'custom_sticky_single_add_to_cart', 999 );

/**
 * Header
 *
 * @see custom_product_search()
 * @see custom_header_cart()
 */
add_action( 'custom_header', 'custom_product_search', 40 );
add_action( 'custom_header', 'custom_header_cart', 60 );

/**
 * Cart fragment
 *
 * @see custom_cart_link_fragment()
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'custom_cart_link_fragment' );

/**
 * Integrations
 *
 * @see custom_woocommerce_brands_archive()
 * @see custom_woocommerce_brands_single()
 * @see custom_woocommerce_brands_homepage_section()
 */
if ( class_exists( 'WC_Brands' ) ) {
	add_action( 'woocommerce_archive_description', 'custom_woocommerce_brands_archive', 5 );
	add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_brands_single', 4 );
	add_action( 'homepage', 'custom_woocommerce_brands_homepage_section', 80 );
}
