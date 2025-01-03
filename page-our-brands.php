<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Petrange
 * @since Petrange
 */

get_header();
?>
<section class="page-title">
	<div class="inner">
    	<h1 class="underline red header-icon after star"><?php the_title(); ?></h1>
	</div>
</section>
<section class="our-brands-main bg-grey p-60">
    <div class="inner">
        <div class="flex col-3">
        	<?php 
			$args = array(
				'post_type' => 'brands',
				'posts_per_page' => '-1',
				'order' => 'DESC',
				'post_status' => 'publish'

			);
			$the_query = new WP_Query( $args );
			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
						<div class="brand p-40 radius">
                            <div class="brand-logo">			                    
	                            <?php 
								$image = get_field('brand_logo');
								if( !empty( $image ) ): ?>
								    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								<?php endif; ?>
                            </div>
                            <div class="brand-content">
                                <!-- <h5><?php the_title(); ?></h5> -->
                                <?php the_content(); ?>
                                <?php 
									$term = get_field('product_category_page_link');
									if( $term ): ?>
                                		<div class="button-wrapper">
											<a href="<?php echo esc_url( get_term_link( $term )); ?>" class="cs-button black full">Shop now</a>
										</div>
								<?php endif; ?>
                            </div>
                        </div>
					<?php } 
				wp_reset_postdata();
			} ?>
        </div>
    </div>
</section>
<?php 
get_footer();
