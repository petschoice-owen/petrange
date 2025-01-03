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
                    <h2 class="underline yellow header-icon after paw-2">News & Blog</h2>
                    <?php the_content(); ?>
                </div>
            </section>
            <section class="filter-top">
                <div class="inner flex jc-center">
				 	<select name='m-menu' onfocus="this.selectedIndex = 0" onchange='location = this.options[this.selectedIndex].value;'>
					  	<option>Select category</option>
					  	<option value="/blog">All categories</option>
						<option value="/blog/category/cats">Cats</option>
						<option value="/blog/category/dogs">Dogs</option>
						<option value="/blog/category/wildlife">Wildlife</option>
					</select>
                </div>
            </section>
            <section class="news-blog all-icons full">
                <div class="inner">
                    <div class="news-main flex col-3">
			            <?php 
							$args = array(
								'post_type' => 'post',
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
						                <div class="news-teaser">
						                    <div class="teaser-image">
						                        <?php
													if(has_post_thumbnail()){
			          									the_post_thumbnail();
			     									}
			     								?>
						                    </div>
						                    <div class="teaser-content">
						                        <p class="category">News category</p>
						                        <h4><?php the_title(); ?></h4>
												<p><?php echo get_the_date( 'd F Y' ); ?></p>
												<?php the_excerpt(); ?>
						                        <a href="<?php the_permalink(); ?>" class="cs-button white">Read article</a>
						                    </div>
						                </div>	
									<?php } 
								wp_reset_postdata();
							}
						?>
                    </div>
                </div>
            </section>
<?php 
get_footer();
