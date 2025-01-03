<?php
/**
 * Template used to display post content on single pages.
 *
 * @package custom
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inner">
	<?php
	do_action( 'custom_single_post_top' );

	/**
	 * Functions hooked into custom_single_post add_action
	 *
	 * @hooked custom_post_header          - 10
	 * @hooked custom_post_content         - 30
	 */
	do_action( 'custom_single_post' );

	/**
	 * Functions hooked in to custom_single_post_bottom action
	 *
	 * @hooked custom_post_nav         - 10
	 * @hooked custom_display_comments - 20
	 */
	do_action( 'custom_single_post_bottom' );
	?>
	</div>
</article><!-- #post-## -->
