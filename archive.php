<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package custom
 */

get_header(); ?>
            <section class="page-title">
                <div class="inner">
                    <h2 class="underline yellow header-icon after paw-2">News & Blog</h2>
                </div>
            </section>
            <section class="filter-top">
                <div class="inner">
				 	<?php echo do_shortcode('[searchandfilter fields="search,category,post_tag"]'); ?>
                </div>
            </section>
            <section class="news-blog all-icons full">
                <div class="inner">
                    <div class="news-main flex col-3">

		<?php if ( have_posts() ) : ?>

			<?php
			get_template_part( 'loop' );

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>
        </div>
    </div>
</section>
<?php

?>
</div>
<?php
get_footer();
