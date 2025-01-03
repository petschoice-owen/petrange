<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package custom
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<!-- Start of before -->
					<div class="inner flex">
					<?php
					do_action( 'custom_page_before' );
					?>
					</div>
					<!-- Start of content -->
					<div class="inner flex">
					<?php
					get_template_part( 'content', 'page' );
					?>
					</div>
					<!-- Start of after -->
					<?php
					/**
					 * Functions hooked in to custom_page_after action
					 *
					 * @hooked custom_display_comments - 10
					 */
					do_action( 'custom_page_after' );

				endwhile; // End of the loop.
				?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php

get_footer();
