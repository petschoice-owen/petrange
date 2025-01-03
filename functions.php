<?php
/**
 * custom engine room
 *
 * @package custom
 */

/**
 * Assign the custom version to a var
 */
$theme              = wp_get_theme( 'custom' );
$custom_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$custom = (object) array(
	'version'    => $custom_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-custom.php',
	'customizer' => require 'inc/customizer/class-custom-customizer.php',
);

require 'inc/custom-functions.php';
require 'inc/custom-template-hooks.php';
require 'inc/custom-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$custom->jetpack = require 'inc/jetpack/class-custom-jetpack.php';
}

if ( custom_is_woocommerce_activated() ) {
	$custom->woocommerce            = require 'inc/woocommerce/class-custom-woocommerce.php';
	$custom->woocommerce_customizer = require 'inc/woocommerce/class-custom-woocommerce-customizer.php';

	require 'inc/woocommerce/class-custom-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/custom-woocommerce-template-hooks.php';
	require 'inc/woocommerce/custom-woocommerce-template-functions.php';
	require 'inc/woocommerce/custom-woocommerce-functions.php';
}

if ( is_admin() ) {
	$custom->admin = require 'inc/admin/class-custom-admin.php';

	require 'inc/admin/class-custom-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-custom-nux-admin.php';
	require 'inc/nux/class-custom-nux-guided-tour.php';
	require 'inc/nux/class-custom-nux-starter-content.php';
}

//  Custom

function custom_styles(){ 

    // Load all of the styles that need to appear on all pages
    wp_enqueue_style('owlcss', get_stylesheet_directory_uri() . '/base_html/www/css/owl.carousel.min.css' );
    wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/base_html/www/css/styles.css' );
	wp_enqueue_style('additionalstyles', get_stylesheet_directory_uri() . '/style.css' );
    // wp_enqueue_script('customjq', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js','','',true);
    wp_enqueue_script('customacc', get_stylesheet_directory_uri().'/base_html/www/js/acc.js','','',true);
    wp_enqueue_script('owljs', get_stylesheet_directory_uri().'/base_html/www/js/owl.carousel.min.js','','',true);
    wp_enqueue_script('customjs', get_stylesheet_directory_uri().'/base_html/www/js/all.js','','',true);
    wp_enqueue_script('wc-add-to-cart-variation');
}
add_action('wp_enqueue_scripts', 'custom_styles');

// Create post types


function custom_posttype_brands() {  
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Brands', 'Post Type General Name', 'storefront' ),
        'singular_name'       => _x( 'Brand', 'Post Type Singular Name', 'storefront' ),
        'menu_name'           => __( 'Brands', 'storefront' ),
        'parent_item_colon'   => __( 'Parent Brand', 'storefront' ),
        'all_items'           => __( 'All Brands', 'storefront' ),
        'view_item'           => __( 'View Brand', 'storefront' ),
        'add_new_item'        => __( 'Add New Brand', 'storefront' ),
        'add_new'             => __( 'Add New', 'storefront' ),
        'edit_item'           => __( 'Edit Brand', 'storefront' ),
        'update_item'         => __( 'Update Brand', 'storefront' ),
        'search_items'        => __( 'Search Brand', 'storefront' ),
        'not_found'           => __( 'Not Found', 'storefront' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'storefront' ),
    );
      
    // Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'brands', 'storefront' ),
        'description'         => __( 'Petrange brands', 'storefront' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'brands', $args );
  
}


// --------
//  Custom
// --------

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_posttype_brands', 0 );

// ACF Add options page

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page();
    
}

// Custom Menu regions

function custom_custom_new_menu() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top menu on red banner' ),
      'main-menu' => __( 'Primary menu on black bar' ),
      'mega-menu' => __( 'Main dropdown mega menu' ),
      'footer-menu-1' => __( 'Footer menu 1' ),
      'footer-menu-2' => __( 'Footer menu 2' ),
      'footer-menu-3' => __( 'Footer menu 3' ),
      'footer-menu-4' => __( 'Footer menu 4' )
    )
  );
}
add_action( 'init', 'custom_custom_new_menu' );

/**
 * Returns product price based on sales.
 * 
 * @return string
 */
function custom_price_show() {
    global $product;
    if( $product->is_on_sale() ) {
        return $product->get_sale_price();
    }
    return $product->get_regular_price();
}

add_action( 'wp_enqueue_scripts', 'custom_dequeue_stylesandscripts_select2', 100 );
 
function custom_dequeue_stylesandscripts_select2() {
    if ( class_exists( 'woocommerce' ) ) {
        wp_dequeue_style( 'selectWoo' );
        wp_deregister_style( 'selectWoo' );
 
        wp_dequeue_script( 'selectWoo');
        wp_deregister_script('selectWoo');
    } 
} 

add_filter( 'yith_wcwl_remove_hidden_products_via_query', '__return_false' );


//Remove product Zoom
function remove_image_zoom_support() {
remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

add_filter( 'woocommerce_single_product_image_thumbnail_html', 'custom_remove_product_link' );
function custom_remove_product_link( $html ) {
  return strip_tags( $html, '<div><img>' );
}

/**
 * @snippet       Remove Dashboard from My Account
 
 */
// remove menu link
add_filter( 'woocommerce_account_menu_items', 'custom_remove_my_account_dashboard' );
function custom_remove_my_account_dashboard( $menu_links ){
    
    unset( $menu_links[ 'dashboard' ] );
    return $menu_links;
    
}

// perform a redirect
add_action( 'template_redirect', 'custom_redirect_to_orders_from_dashboard' );
function custom_redirect_to_orders_from_dashboard(){
    
    if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
        wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
        exit;
    }
    
}

// Check weight
add_action('woocommerce_check_cart_items','check_cart_weight');

function check_cart_weight(){
    global $woocommerce;
    $weight = $woocommerce->cart->cart_contents_weight;
    if( $weight > 15 ){
        wc_add_notice( sprintf( __( 'You have %sKg weight and we allow only 15Kg of weight per order.', 'woocommerce' ), $weight ), 'error' );
    }
}

//Add Custom Page in My Account
add_filter( 'woocommerce_account_menu_items', function ( $items, $endpoints ) {
    $items['/favourites'] = 'Favourites';
    return $items;
}, 10, 2 );

add_filter( 'woocommerce_get_endpoint_url', function ( $url, $endpoint, $value, $permalink ) {
    if ( $endpoint === '/favourites' ) {
        $url = home_url( '/favourites' );
    }
    return $url;
}, 10, 4 );


// Reorder My Account Menu Links
add_filter( 'woocommerce_account_menu_items', 'custom_menu_links_reorder' );

function custom_menu_links_reorder( $menu_links ){
    
    return array(
        'orders' => __( 'Orders', 'woocommerce' ),
        'Favourites' => __( 'Favourites', 'woocommerce' ),
        'edit-address' => __( 'Addresses', 'woocommerce' ),
        'edit-payment-details' => __( 'Payment details', 'woocommerce' ),
        'edit-account' => __( 'Account details', 'woocommerce' ),
        'customer-logout' => __( 'Logout', 'woocommerce' )
    );

}


/*----------------------------------------------------------------------------------------*/
/* WooCommerce Cart Page - set minimum order amount to £15 and maximum order amount to £250
/*----------------------------------------------------------------------------------------*/
add_action( 'woocommerce_checkout_process', 'wc_min_max_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_min_max_order_amount' );

function wc_min_max_order_amount() {
    $minimum = 15; // set this variable to specify a minimum order value
    $maximum = 250; // set this variable to specify a maximum order value
    $cart_total = WC()->cart->total; // cart total including shipping
    $shipping_total = WC()->cart->get_shipping_total();  // cost of shipping
    $cart_subtotal = WC()->cart->subtotal;  // cart total excluding shipping

    if ( $cart_subtotal < $minimum ) {
        if( is_cart() ) {
            wc_print_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order.' , 
                    wc_price( $cart_subtotal ), 
                    wc_price( $minimum )
                ), 'error' 
            );
            // JavaScript to hide the element with class "wc-proceed-to-checkout"
            ?>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var proceedToCheckout = document.querySelector('.wc-proceed-to-checkout');
                    if (proceedToCheckout) {
                        proceedToCheckout.style.display = 'none';
                    }
                });
            </script>
            <?php
        } else {
            wc_add_notice( 
                sprintf( 'Your current order total is %s — you must have an order with a minimum of %s to place your order.' , 
                    wc_price( $cart_subtotal ), 
                    wc_price( $minimum )
                ), 'error' 
            );
            // JavaScript to hide the element with class "wc-proceed-to-checkout"
            ?>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var proceedToCheckout = document.querySelector('.wc-proceed-to-checkout');
                    if (proceedToCheckout) {
                        proceedToCheckout.style.display = 'none';
                    }
                });
            </script>
            <?php
        }
    }

    elseif ( $cart_subtotal > $maximum ) {
        if( is_cart() ) {
            wc_print_notice( 
                sprintf( 'Your order value is %s. We do not currently accept online order values of over %s.' , 
                    wc_price( $cart_subtotal ), 
                    wc_price( $maximum )
                ), 'error' 
            );
            // JavaScript to hide the element with class "wc-proceed-to-checkout"
            ?>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var proceedToCheckout = document.querySelector('.wc-proceed-to-checkout');
                    if (proceedToCheckout) {
                        proceedToCheckout.style.display = 'none';
                    }
                });
            </script>
            <?php
        } else {
            wc_add_notice( 
                sprintf( 'Your order value is %s. We do not currently accept online order values of over %s.' , 
                    wc_price( $cart_subtotal ), 
                    wc_price( $maximum )
                ), 'error' 
            );
            // JavaScript to hide the element with class "wc-proceed-to-checkout"
            ?>
            <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                    var proceedToCheckout = document.querySelector('.wc-proceed-to-checkout');
                    if (proceedToCheckout) {
                        proceedToCheckout.style.display = 'none';
                    }
                });
            </script>
            <?php
        }
    }
}

add_action( 'woocommerce_cart_item_removed' , 'wc_min_max_order_amount', 10, 2 );


// WooCommerce - remove other shipping options if Free Shipping is available
add_filter('woocommerce_package_rates', 'hide_shipping_when_free_is_available', 10, 2);
function hide_shipping_when_free_is_available($rates, $package) {
    // Check if free shipping is available in the rates
    $free_shipping_available = false;
    
    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id) {
            $free_shipping_available = true;
            break;
        }
    }
    
    if ($free_shipping_available) {
        // Unset other shipping methods
        foreach ($rates as $rate_id => $rate) {
            if ('free_shipping' !== $rate->method_id) {
                unset($rates[$rate_id]);
            }
        }
    }
    
    return $rates;
}


// WooCommerce - Product Variation - remove "Choose an option" completely
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html', 12, 2 );
function filter_dropdown_option_html( $html, $args ) {
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
    $show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';
    $html = str_replace($show_option_none_html, '', $html);
    return $html;
}


// Shop Page and Category Pages - custom product variation buttons for variable products
add_filter( 'woocommerce_loop_add_to_cart_link', 'woo_display_variation_dropdown_on_shop_page' );

function woo_display_variation_dropdown_on_shop_page() {
	global $product;
	if ( $product->is_type( 'variable' )) { ?>
		<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ) ?>">
			<?php do_action( 'woocommerce_before_variations_form' ); ?>
			<?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
				<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
			<?php else : ?>
				<table class="variations" cellspacing="0" style="display: none;">
					<tbody>
						<?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>
							<tr>
								<td class="value">
                                    <?php
                                        $selected = isset($_REQUEST["attribute_" . sanitize_title($attribute_name)])
                                            ? wc_clean(
                                                urldecode($_REQUEST["attribute_" . sanitize_title($attribute_name)])
                                            )
                                            : $product->get_variation_default_attribute($attribute_name);
                                        wc_dropdown_variation_attribute_options([
                                            "options" => $options,
                                            "attribute" => $attribute_name,
                                            "product" => $product,
                                            "selected" => $selected,
                                        ]);
                                    ?>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
                <?php 
                    $variations = $product->get_available_variations();
					usort( $variations, function( $a, $b ) {
                        return $a['display_price'] <=> $b['display_price'];
                    });
                    echo '<div class="variation-options-wrapper">';
                    echo '<div class="variation-options">';
                    foreach ( $variations as $variation ) {
                        $variation_id = $variation['variation_id'];
                        $variation_data = wc_get_product( $variation_id );
                        $regular_price = $variation_data->get_regular_price();
                        $sale_price = $variation_data->get_sale_price();
                        $price = $variation_data->get_price();
                        $attributes = implode( ' / ', $variation['attributes'] );

                        echo '<a href="#"><span class="variation-label">' . esc_html( $attributes ) . '</span>';
                        if ( $regular_price !== $price ) {
                            echo '<span class="variation-price"><span class="custom-price">';
                            echo '<span class="variation-regular-price">' . wc_price( $regular_price ) . '</span>';
                            echo '<span class="variation-sale-price">' . wc_price( $sale_price ) . '</span>';
                            echo '</span></span>';
                        }
                        else {
                            echo '<span class="variation-price">' . wc_price( $price ) . '</span></a>';
                        }
                    }
                    echo '</div></div>';
                ?>
				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
				<div class="single_variation_wrap">
                    <?php
                        /**
                         * Hook: woocommerce_before_single_variation.
                         */
                        do_action( 'woocommerce_before_single_variation' );

                        /**
                         * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
                         *
                         * @since 2.4.0
                         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
                         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
                         */
                        do_action( 'woocommerce_single_variation' );

                        /**
                         * Hook: woocommerce_after_single_variation.
                         */
                        do_action( 'woocommerce_after_single_variation' );
                    ?>
				</div>
				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			<?php endif; ?>
			<?php do_action( 'woocommerce_after_variations_form' ); ?>
		</form>
	<?php }
    else {
        $html = '<a href="' . esc_url( $product->add_to_cart_url() ) . '" 
            data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" 
            data-product_id="' . $product->get_id() . '" data-product_sku="' . $product->get_sku() .'">' . esc_html( $product->add_to_cart_text() ) . '</a>';
        return $html;
    }
}


// Shop Page and Category Pages - pre-select products in stock
// function filter_woocommerce_dropdown_variation_attribute_options_args( $args ) {
//     // Check the count of available options in dropdown
//     if ( count( $args['options'] ) > 0 ) {
//         // Initialize
//         $option_key = '';

//         // Get WC_Product_Variable Object
//         $product = $args['product'];

//         // Is a WC Product Variable
//         if ( is_a( $product, 'WC_Product_Variable' ) ) {
//             // Get an array of available variations for the current product
//             foreach ( $product->get_available_variations() as $key => $variation ) {
//                 // Is in stock
//                 $is_in_stock = $variation['is_in_stock'];

//                 // True
//                 if ( $is_in_stock ) {
//                     // Set key
//                     $option_key = $key;

//                     // Break
//                     break;
//                 }
//             }
//         }

//         // Finds whether a variable is a number
//         if ( is_numeric( $option_key ) ) {
//             // Selected
//             $args['selected'] = $args['options'][$option_key];
//         }
//     }

//     return $args;
// }

function filter_woocommerce_dropdown_variation_attribute_options_args( $args ) {
    // Ensure there are options and that the product is a variable product
    if ( ! empty( $args['options'] ) && is_a( $args['product'], 'WC_Product_Variable' ) ) {

        // Initialize variables
        $sorted_options = [];
        $product = $args['product'];
        
        // Get all variations for the current variable product
        $variations = $product->get_available_variations();

        // Create an array of prices, keys, and attribute options
        $variation_prices = [];
		$all_variation_prices = [];
        $is_all_out_of_stock = true;
        
        foreach ( $variations as $variation ) {
			$price = $variation['display_price'];
            // Get the variation's option (attribute value) for this attribute
            if ( isset( $variation['attributes']['attribute_' . strtolower($args['attribute'])] ) ) {
                $attribute_value = $variation['attributes']['attribute_' . strtolower($args['attribute'])];
                // Only add to the array if the attribute value exists and has a price
                if ( ! empty( $attribute_value ) && isset( $price ) ) {
                    $all_variation_prices[] = [
                        'price'   => $price,
                        'option'  => $attribute_value,
                    ];
                }
            }
			
            // Ensure the variation is in stock
            if ( isset( $variation['is_in_stock'] ) && $variation['is_in_stock'] ) {
                $is_all_out_of_stock = false;
                // Get the price for this variation
                $price = $variation['display_price'];
                // Get the variation's option (attribute value) for this attribute
                if ( isset( $variation['attributes']['attribute_' . strtolower($args['attribute'])] ) ) {
                    $attribute_value = $variation['attributes']['attribute_' . strtolower($args['attribute'])];
                    // Only add to the array if the attribute value exists and has a price
                    if ( ! empty( $attribute_value ) && isset( $price ) ) {
                        $variation_prices[] = [
                            'price'   => $price,
                            'option'  => $attribute_value,
                        ];
                    }
                }
            }
        }

        // Sort the array by price (lowest to highest)
        usort( $variation_prices, function( $a, $b ) {
            return $a['price'] - $b['price'];
        });
		
		usort( $all_variation_prices, function( $a, $b ) {
            return $a['price'] - $b['price'];
        });

        // Rebuild the sorted options array, preserving unique attribute values
        foreach ( $variation_prices as $variation ) {
            if ( ! in_array( $variation['option'], $sorted_options ) ) {
                $sorted_options[] = $variation['option'];
            }
        }

        // Update args['options'] to be sorted
        $args['options'] = $sorted_options;
		
		if($is_all_out_of_stock) {
            $args['selected'] = $all_variation_prices[0]['option'];
        }
    }

    return $args;
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'filter_woocommerce_dropdown_variation_attribute_options_args', 10, 1 );