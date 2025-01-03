<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Grey
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
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<section class="bg-grey">
					<div class="inner">
				<?php
				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to custom_page_after action
				 *
				 * @hooked custom_display_comments - 10
				 */
				do_action( 'custom_page_after' ); ?>
					</div>
				</section>
				<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
