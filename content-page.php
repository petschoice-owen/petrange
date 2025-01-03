<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package custom
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to custom_page add_action
	 *
	 * @hooked custom_page_header          - 10
	 * @hooked custom_page_content         - 20
	 */
	do_action( 'custom_page' );
	?>
</article><!-- #post-## -->
