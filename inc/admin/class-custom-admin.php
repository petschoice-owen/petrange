<?php
/**
 * custom Admin Class
 *
 * @package  custom
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'custom_Admin' ) ) :
	/**
	 * The custom admin class
	 */
	class custom_Admin {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'welcome_style' ) );
		}

		/**
		 * Load welcome screen css
		 *
		 * @param string $hook_suffix the current page hook suffix.
		 * @return void
		 * @since  1.4.4
		 */
		public function welcome_style( $hook_suffix ) {
			global $custom_version;

			if ( 'appearance_page_custom-welcome' === $hook_suffix ) {
				wp_enqueue_style( 'custom-welcome-screen', get_template_directory_uri() . '/assets/css/admin/welcome-screen/welcome.css', array(), $custom_version );
				wp_style_add_data( 'custom-welcome-screen', 'rtl', 'replace' );
			}
		}

		/**
		 * Creates the dashboard page
		 *
		 * @see  add_theme_page()
		 * @since 1.0.0
		 */
		public function welcome_register_menu() {
			add_theme_page( 'custom', 'custom', 'activate_plugins', 'custom-welcome', array( $this, 'custom_welcome_screen' ) );
		}

		/**
		 * The welcome screen
		 *
		 * @since 1.0.0
		 */
		public function custom_welcome_screen() {
			require_once ABSPATH . 'wp-load.php';
			require_once ABSPATH . 'wp-admin/admin.php';
			require_once ABSPATH . 'wp-admin/admin-header.php';

			global $custom_version;

			$show_setup_screen = ( false === (bool) get_option( 'custom_nux_dismissed' ) ) && ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '4.8.0', '>=' ) );
			?>

			<div class="custom-wrap">
				<section class="custom-welcome-nav">
					<span class="custom-welcome-nav__version">custom <?php echo esc_attr( $custom_version ); ?></span>
					<ul>
						<li><a href="https://wordpress.org/support/theme/custom" target="_blank"><?php esc_html_e( 'Support', 'custom' ); ?></a></li>
						<li><a href="https://docs.woocommerce.com/documentation/themes/custom/" target="_blank"><?php esc_html_e( 'Documentation', 'custom' ); ?></a></li>
						<li><a href="https://developer.woocommerce.com/category/release-post/custom-theme-release-notes/" target="_blank"><?php esc_html_e( 'Development blog', 'custom' ); ?></a></li>
					</ul>
				</section>

				<div class="custom-logo">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/custom-icon.svg" alt="custom" />
				</div>

				<div class="custom-intro">
					<?php
					if ( $show_setup_screen ) {
						?>
						<div class="custom-intro-setup">
							<?php
							custom_NUX_Admin::admin_notices_content();
							?>
						</div>
						<?php
						echo '<div class="custom-intro-message" style="display:none">';
					}

					/**
					 * Display a different message when the user visits this page when returning from the guided tour
					 */
					$referrer = wp_get_referer();

					if ( strpos( $referrer, 'sf_starter_content' ) !== false ) {
						/* translators: 1: HTML, 2: HTML */
						echo '<h1>' . sprintf( esc_attr__( 'Setup complete %1$sYour custom adventure begins now 🚀%2$s ', 'custom' ), '<span>', '</span>' ) . '</h1>';
						echo '<p>' . esc_attr__( 'One more thing... You might be interested in the following custom extensions and designs.', 'custom' ) . '</p>';
					} else {
						echo '<p>' . esc_attr__( 'Hello! You might be interested in the following custom extensions and designs.', 'custom' ) . '</p>';
					}

					if ( $show_setup_screen ) {
						echo '</div>';
					}
					?>
				</div>

				<div class="custom-enhance">
					<div class="custom-enhance__column custom-bundle">
						<h3><?php esc_html_e( 'custom Extensions Bundle', 'custom' ); ?></h3>
						<span class="bundle-image">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/welcome-screen/custom-bundle-hero.png" alt="custom Extensions Hero" />
						</span>

						<p>
							<?php esc_html_e( 'All the tools you\'ll need to define your style and customize custom.', 'custom' ); ?>
						</p>

						<p>
							<?php esc_html_e( 'Make it yours without touching code with the custom Extensions bundle. Express yourself, optimize conversions, delight customers.', 'custom' ); ?>
						</p>


						<p>
							<a href="https://woocommerce.com/products/custom-extensions-bundle/?utm_source=custom&utm_medium=product&utm_campaign=customaddons" class="custom-button" target="_blank"><?php esc_html_e( 'Read more and purchase', 'custom' ); ?></a>
						</p>
					</div>
					<div class="custom-enhance__column custom-child-themes">
						<h3><?php esc_html_e( 'Alternate designs', 'custom' ); ?></h3>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/admin/welcome-screen/child-themes.jpg" alt="custom Powerpack" />

						<p>
							<?php esc_html_e( 'Quickly and easily transform your shops appearance with custom child themes.', 'custom' ); ?>
						</p>

						<p>
							<?php esc_html_e( 'Each has been designed to serve a different industry - from fashion to food.', 'custom' ); ?>
						</p>

						<p>
							<?php esc_html_e( 'Of course they are all fully compatible with each custom extension.', 'custom' ); ?>
						</p>

						<p>
							<a href="https://woocommerce.com/product-category/themes/custom-child-theme-themes/?utm_source=custom&utm_medium=product&utm_campaign=customaddons" class="custom-button" target="_blank"><?php esc_html_e( 'Check \'em out', 'custom' ); ?></a>
						</p>
					</div>
				</div>

				<div class="automattic">
					<p>
					<?php
						/* translators: %s: Automattic branding */
						printf( esc_html__( 'An %s project', 'custom' ), '<a href="https://automattic.com/"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/admin/welcome-screen/automattic.png" alt="Automattic" /></a>' );
					?>
					</p>
				</div>
			</div>
			<?php
		}

		/**
		 * Welcome screen intro
		 *
		 * @since 1.0.0
		 */
		public function welcome_intro() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-intro.php';
		}

		/**
		 * Output a button that will install or activate a plugin if it doesn't exist, or display a disabled button if the
		 * plugin is already activated.
		 *
		 * @param string $plugin_slug The plugin slug.
		 * @param string $plugin_file The plugin file.
		 */
		public function install_plugin_button( $plugin_slug, $plugin_file ) {
			if ( current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) {
				if ( is_plugin_active( $plugin_slug . '/' . $plugin_file ) ) {
					// The plugin is already active.
					$button = array(
						'message' => esc_attr__( 'Activated', 'custom' ),
						'url'     => '#',
						'classes' => 'disabled',
					);
				} elseif ( $this->is_plugin_installed( $plugin_slug ) ) {
					$url = $this->is_plugin_installed( $plugin_slug );

					// The plugin exists but isn't activated yet.
					$button = array(
						'message' => esc_attr__( 'Activate', 'custom' ),
						'url'     => $url,
						'classes' => 'activate-now',
					);
				} else {
					// The plugin doesn't exist.
					$url    = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $plugin_slug,
							),
							self_admin_url( 'update.php' )
						),
						'install-plugin_' . $plugin_slug
					);
					$button = array(
						'message' => esc_attr__( 'Install now', 'custom' ),
						'url'     => $url,
						'classes' => ' install-now install-' . $plugin_slug,
					);
				}
				?>
				<a href="<?php echo esc_url( $button['url'] ); ?>" class="custom-button <?php echo esc_attr( $button['classes'] ); ?>" data-originaltext="<?php echo esc_attr( $button['message'] ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?>" aria-label="<?php echo esc_attr( $button['message'] ); ?>"><?php echo esc_html( $button['message'] ); ?></a>
				<a href="https://wordpress.org/plugins/<?php echo esc_attr( $plugin_slug ); ?>" target="_blank"><?php esc_html_e( 'Learn more', 'custom' ); ?></a>
				<?php
			}
		}

		/**
		 * Check if a plugin is installed and return the url to activate it if so.
		 *
		 * @param string $plugin_slug The plugin slug.
		 */
		private function is_plugin_installed( $plugin_slug ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
				$plugins = get_plugins( '/' . $plugin_slug );
				if ( ! empty( $plugins ) ) {
					$keys        = array_keys( $plugins );
					$plugin_file = $plugin_slug . '/' . $keys[0];
					$url         = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'activate',
								'plugin' => $plugin_file,
							),
							admin_url( 'plugins.php' )
						),
						'activate-plugin_' . $plugin_file
					);
					return $url;
				}
			}
			return false;
		}
		/**
		 * Welcome screen enhance section
		 *
		 * @since 1.5.2
		 */
		public function welcome_enhance() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-enhance.php';
		}

		/**
		 * Welcome screen contribute section
		 *
		 * @since 1.5.2
		 */
		public function welcome_contribute() {
			require_once get_template_directory() . '/inc/admin/welcome-screen/component-contribute.php';
		}

		/**
		 * Get product data from json
		 *
		 * @param  string $url       URL to the json file.
		 * @param  string $transient Name the transient.
		 * @return [type]            [description]
		 */
		public function get_custom_product_data( $url, $transient ) {
			$raw_products = wp_safe_remote_get( $url );
			$products     = json_decode( wp_remote_retrieve_body( $raw_products ) );

			if ( ! empty( $products ) ) {
				set_transient( $transient, $products, DAY_IN_SECONDS );
			}

			return $products;
		}
	}

endif;

return new custom_Admin();
