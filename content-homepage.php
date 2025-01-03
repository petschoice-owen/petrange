<?php
/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package custom
 */

?>
<?php
$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php custom_homepage_content_styles(); ?>" data-featured-image="<?php echo esc_url( $featured_image ); ?>">
	<div class="col-full">
		<?php
		/**
		 * Functions hooked in to custom_page add_action
		 *
		 * @hooked custom_homepage_header      - 10
		 * @hooked custom_page_content         - 20
		 */
		do_action( 'custom_homepage' );
		?>
	</div>
</div><!-- #post-## -->
