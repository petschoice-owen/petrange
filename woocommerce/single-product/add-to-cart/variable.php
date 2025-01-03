<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0" role="presentation">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
						<td class="value">
							<?php
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									)
								);
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<?php if ( is_product() ) { ?>
			<style>
				.product-details-main .product-option {
					display: none;
				}
				.variable-product table.variations {
					display: none;
				}
				.variation-options-wrapper {
					width: 100%;
					margin-bottom: 30px
				}
				.variation-options-wrapper .variation-options-label {
					margin-bottom: 15px;
					font-weight: 700;
					text-transform: uppercase;
				}
				.variation-options-wrapper .variation-options {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-ms-flex-wrap: wrap;
					flex-wrap: wrap;
					margin: 0 -5px;
				}
				.variation-options-wrapper a {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-webkit-box-pack: center;
					-ms-flex-pack: center;
					justify-content: center;
					-webkit-box-orient: vertical;
					-webkit-box-direction: normal;
					-ms-flex-direction: column;
					flex-direction: column;
					-webkit-box-align: center;
					-ms-flex-align: center;
					align-items: center;
					width: calc(50% - 10px);
					margin: 5px;
					padding: 15px;
					font-weight: normal;
					font-size: 20px;
					letter-spacing: -.5px;
					color: #292929;
					text-align: center;
					background-color: #ffab65;
					border: 2px solid #ffab65;
					border-radius: 4px;
					text-decoration: none;
					outline: none;
					-webkit-transition: .25s ease-in-out all;
					-o-transition: .25s ease-in-out all;
					transition: .25s ease-in-out all;
				}
				.variation-options-wrapper a.active {
					font-weight: 700;
					color: #fff;
					background-color: #f1601c;
                    border-color: #292929;
				}
				.variation-options-wrapper a:focus {
					outline: none !important;
				}
				.variation-options-wrapper a.active .variation-price {
					display: block;
				}
				.variation-options-wrapper .variation-price {
					display: none;
					margin-top: 5px;
					font-size: 28px;
					letter-spacing: 0;
				}
				.variation-options-wrapper .variation-price .custom-price {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-ms-flex-wrap: wrap;
					flex-wrap: wrap;
					-webkit-box-pack: center;
					-ms-flex-pack: center;
					justify-content: center;
					-webkit-box-align: baseline;
					-ms-flex-align: baseline;
					align-items: baseline;
				}
				.variation-options-wrapper .variation-price .variation-regular-price {
					margin: 0 3px;
					font-size: 70%;
					color: #292929;
					text-decoration: line-through;
				}
				.variation-options-wrapper .variation-price .variation-sale-price {
					margin: 0 4px;
				}
				form.variable-product .single_variation_wrap .woocommerce-variation-availability p.stock {
					margin-bottom: 15px;
				}
				form.variable-product .single_variation_wrap .woocommerce-variation-availability p.stock:last-child {
					margin-bottom: 0;
				}
				form.variable-product .single_variation_wrap .woocommerce-variation-availability p.in-stock {
					color: #27ae60;
				}
				form.variable-product .cwginstock-subscribe-form .panel {
					margin-top: 10px;
					margin-bottom: 0;
					-webkit-box-shadow: none;
					box-shadow: none;
				}
				form.variable-product .cwginstock-subscribe-form .panel .form-group {
					margin-bottom: 0;
				}
				@media (max-width:: 991px) {
					.variation-options-wrapper a {
						font-size: 18px;
					}
					.variation-options-wrapper .variation-price {
						font-size: 26px;
					}
				}
			</style>
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
			<script>
				var $ = jQuery;
				$(document).ready(function() {
					if ( $('table.variations').length ) {
						$('form.variations_form').addClass('variable-product');
						//$('.variation-options-wrapper .variation-options a:first-child').addClass('active');
						$('.variation-options-wrapper .variation-options a').click(function(e) {
							e.preventDefault();
							var selectedOption = $(this).find('.variation-label').text();
							$('.variation-options-wrapper .variation-options a').removeClass('active');
							$('table.variations .value select').val(selectedOption).change();
							$(this).addClass('active');
							$(".woocommerce-product-gallery__wrapper img").removeAttr("sizes");
						});

						// identify the selected option and make the corresponding custom button active
						$('form.variations_form select').each(function() {
							var selectedOption = $(this).find(":selected").text();
							$(this).closest('form.variations_form').find('.variation-options-wrapper .variation-label').each(function() {
								if ( $(this).text() == selectedOption ) {
									$(this).parent().addClass('active');
								}
							});
						});
					}
				});

				// select the first option if there is no selected 'enabled' product variation
				$(window).on('load', function() {
					$('.variation-options-wrapper .variation-options').each(function() {
						if ($(this).find('.active').length > 0) {
							// The class 'class' exists in the children of this element
						} else {
							$(this).closest('.variations_form').find('table.variations select :not(.enabled)').remove();
							$(this).closest('.variations_form').find('table.variations select option:eq(1)').prop('selected', true);
							$(this).closest('.variations_form').find('table.variations select').change();
							$(this).find('a:first-child').addClass('active');
							// The class 'class' does not exist in the children of this element
						}
					});
				});
			</script>
		<?php } ?>

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
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
