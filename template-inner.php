<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Inner
 *
 * @package custom
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="inner">
			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'custom_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to custom_page_after action
				 *
				 * @hooked custom_display_comments - 10
				 */
				do_action( 'custom_page_after' );

			endwhile; // End of the loop.
			?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php

get_footer();
