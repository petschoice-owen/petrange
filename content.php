<?php
/**
 * Template used to display post content.
 *
 * @package custom
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to custom_loop_post action.
	 *
	 * @hooked custom_post_header          - 10
	 * @hooked custom_post_content         - 30
	 * @hooked custom_post_taxonomy        - 40
	 */
	do_action( 'custom_loop_post' );
	?>

</article><!-- #post-## -->
