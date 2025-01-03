<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<style>
    /* Feefo Stars */
        .product-details .feefo-stars {
            display: block;
            width: 100%;
            margin-top: -20px;
            margin-bottom: 30px;
        }
        .feefo-stars .feefo-review-badge-wrapper-product {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            cursor: pointer;
        }
        .feefo-stars .feefo-review-badge-wrapper-product:focus {
            outline: none !important;
        }
        .feefo-stars .feefo-review-badge-wrapper-product > feefowidget-logo-small,
        .feefo-stars .feefowidget-rating-container {
            pointer-events: none;
        }
        @media (max-width: 991px) {
            .product-details .feefo-stars {
                margin-top: 0;
            }
        }
    /* /Feefo Stars */
    /* Feefo Review Section */
        .feefo-reviews {
            margin-top: 50px;
        }
    /* /Feefo Review Section */
</style>

<section class="product-details">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 5
         * @hooked woocommerce_show_product_images - 20
         */

        add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 ); ?>

        <?php
            global $product;

            if ($product && $product->is_type('variable')) {
                $available_variations = $product->get_available_variations();
            
                if (!empty($available_variations)) {
                    $last_variation = end($available_variations);
                    $last_variation_id = $last_variation['variation_id'];
                    $last_variation_product = wc_get_product($last_variation_id);
            
                    if ($last_variation_product && is_a($last_variation_product, 'WC_Product')) {
                        echo '<div class="feefo-stars" style="display: none;">';
                        echo '<div class="feefo-review-badge-wrapper-product"></div>';
                        echo '</div>';
                    }
                }
            } 
        ?>

        <?php 
            do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <script>
            var $ = jQuery;
            
            $(window).on('load', function() {
                if ( $('.feefo-stars .feefo-review-badge-wrapper-product').length ) {
                    $('.feefo-stars').insertAfter('.page-underline');
                    $('.feefo-stars').show();

                    $(".feefo-stars .feefo-review-badge-wrapper-product").click(function(e) {
                        e.preventDefault();
                        $('html, body').animate({
                            scrollTop: $(".feefo-reviews").offset().top - 50
                        }, 1000);
                    });
                }
                else {
                    $('.feefo-stars').hide();
                }
            });
        </script>

        <div class="summary entry-summary product-details-main">
            <div class="favourites-main"><?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?></div>
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 35 );
            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 38 );

            do_action( 'woocommerce_single_product_summary' );
            ?>
        </div>
        
    </div>
</section>
<!-- Closes up to inner parent -->
</div>
</main>
</div>
</div>

<div class="product-more-info bg-grey p-60" style="display: none;">
    <div class="inner">
        <main>
            <div>
                <style>
                    .product-more-info .js-accordion {
                        margin-bottom: 0;
                    }
                </style>
                <section>
                    <div class="inner">
                        <div class="js-accordion" id="accordion-more">
                            <?php if(get_field('key_ingredients')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Key ingredients</h3>
                                <div class="accordion-content">
                                    <?php the_field('key_ingredients'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('nutrition_information')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Nutrition</h3>
                                <div class="accordion-content">
                                    <?php the_field('nutrition_information'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('product_features')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Product features</h3>
                                <div class="accordion-content">
                                    <?php the_field('product_features'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('feeding_guide')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Feeding guide</h3>
                                <div class="accordion-content">
                                    <?php the_field('feeding_guide'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('ingredients')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Ingredients</h3>
                                <div class="accordion-content">
                                    <?php the_field('ingredients'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('cleaning_instructions')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Cleaning Instructions</h3>
                                <div class="accordion-content">
                                    <?php the_field('cleaning_instructions'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('safety_details')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Safety Details</h3>
                                <div class="accordion-content">
                                    <?php the_field('safety_details'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('how_to_use')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">How To Use</h3>
                                <div class="accordion-content">
                                    <?php the_field('how_to_use'); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(get_field('storage')) { ?>
                            <div class="js-accordion__panel">
                                <h3 class="js-accordion__header">Storage</h3>
                                <div class="accordion-content">
                                    <?php the_field('storage'); ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                <?php
                    global $product;

                    if ($product && $product->is_type('variable')) {
                        $available_variations = $product->get_available_variations();
                    
                        if (!empty($available_variations)) {
                            $last_variation = end($available_variations);
                            $last_variation_id = $last_variation['variation_id'];
                            $last_variation_product = wc_get_product($last_variation_id);
                    
                            if ($last_variation_product && is_a($last_variation_product, 'WC_Product')) {
                                $last_variation_sku = $last_variation_product->get_sku();
                                echo '<section class="feefo-reviews">';
                                echo '<div id="feefo-product-review-widgetId" class="feefo-review-widget-product" data-product-sku="'.$last_variation_sku.'"></div>';
                                echo '</section>';
                            }
                        }
                    } 
                    // var_dump($product);
                ?>
                </section>
                <script>
                    var $ = jQuery;

                    $(window).on('load', function() {
                        if ( $('.product-more-info .accordion__panel').length < 1 ) {
                            $('.product-more-info').hide();
                        }
                        else {
                            $('.product-more-info').show();
                        }

                        // Feefo Review Section - change 'Pets Choice Ltd' to [product_name]
                        setTimeout(() => {
                            const productName = $('.product-details .product_title').text();
                            const shadowRoot = $('#feefo-product-review-widgetId')[0].shadowRoot;
                            const titleInsideShadowRoot = $(shadowRoot).find('.feefowidget-header-information-title h2');
                            titleInsideShadowRoot.text(productName);
                        }, 100);
                    });
                </script>

                <section class="related-products">
                    <?php 
                        global $product;
                        $id = $product->get_id();
                        if ($id) {
                            echo do_shortcode("[wt-related-products product_id='$id']");
                        }
                    ?>
                </section>
                <section>
                    <div class="after-single-summary">
                        <?php do_action( 'woocommerce_after_single_product' ); ?>
                    </div>

                    <div class="after-summary">
                    <?php
                    /**
                     * Hook: woocommerce_after_single_product_summary.
                     *
                     * @hooked woocommerce_output_product_data_tabs - 10
                     * @hooked woocommerce_upsell_display - 15
                     * @hooked woocommerce_output_related_products - 20
                     */
                    // do_action( 'woocommerce_after_single_product_summary' );
                    ?>
                    </div>
                </section>
