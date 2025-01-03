<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: FAQs
 *
 * @package custom
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="page-title">
			<div class="inner">
		    	<h1 class="underline red header-icon after star"><?php the_title(); ?></h1>
			</div>
		</section>
		<section>
			<div class="inner">
	            <div class="js-accordion" id="accordion-more">
			        <?php
						// Check rows existexists.
						if( have_rows('faqs') ):

						    // Loop through rows.
						    while( have_rows('faqs') ) : the_row();

						        // Load sub field value.
						        $question = get_sub_field('question');
						        $answer = get_sub_field('answer');
						        // Do something...
						        ?>
						        <div class="js-accordion__panel">
							        <h3 class="js-accordion__header">
							        	<?php echo $question; ?>
							        </h3>
							        <div class="accordion-content">
							        	<?php echo $answer; ?>
							        </div>
						        </div>
						        <?php
						    // End loop.
						    endwhile;

						// No value.
						else :
						    // Do something...
						endif;
					?>
	            </div>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
