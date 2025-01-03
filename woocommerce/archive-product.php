<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<?php if( is_shop() && ! is_search() ){ ?>
<section class="page-title w-icons">
	<?php

	$intro_text = get_field('category_landing_page_intro_text', 7);
	// Check which icon set is selected (category page)
	$iconset = get_field('icon_set', 7);
	// Check if iconset is set to show (category page)
	$showsubcategory = get_field('show_sub_category_links', 7);

	$iconcombi = '';
	$iconcombi = 'icons-set icons-type-'. $iconset;
	
	?>
    <div class="inner <?php echo $iconcombi; ?>">

        <div class="page-title-content">
    		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            	<div class="page-underline"><h1 class="underline"><?php woocommerce_page_title(); ?></h1></div>
            <?php endif;

			echo $intro_text;

			/** List custom category links **/

				if( have_rows('page_header_links') ):
					?>
					<ul class="sub-category-links flex jc-center a-start">
					<?php
				    // Loop through rows.
				    while( have_rows('page_header_links') ) : the_row();

				        // Load sub field value.
				        $link = get_sub_field('page_header_link');
				        // Do something...
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    $classes = "";
								    if($link_target == "_blank"){
								    	$classes = "cs-button icon after black full slim external";
								    }else{
								    	$classes = "cs-button left black full slim";
								    }
								    ?>
								    <li>
								    <a class="<?php echo $classes; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								    </li>
								<?php endif;
						    // End loop.
						    endwhile;
					?>
					</aside>
					<?php
				// No value.
				else :
				 // Do something...
				endif;
			
			/** End custom category links **/

			?>
        </div>
    </div>
</section>
<?php } else { ?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php } ?>
<div class="products-full-listing flex col-1-3">
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
?>
</div>

<?php 
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
