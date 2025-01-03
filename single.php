<?php
/**
 * The template for displaying all single posts.
 *
 * @package custom
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="inner single-content">
		<?php
		while ( have_posts() ) :
			the_post();

			do_action( 'custom_single_post_before' );

			get_template_part( 'content', 'single' );

			do_action( 'custom_single_post_after' );

		endwhile; // End of the loop.
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
