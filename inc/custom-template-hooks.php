<?php
/**
 * custom hooks
 *
 * @package custom
 */

/**
 * General
 *
 * @see  custom_header_widget_region()
 * @see  custom_get_sidebar()
 */
add_action( 'custom_before_content', 'custom_header_widget_region', 10 );
add_action( 'custom_sidebar', 'custom_get_sidebar', 10 );

/**
 * Header
 *
 * @see  custom_skip_links()
 * @see  custom_secondary_navigation()
 * @see  custom_site_branding()
 * @see  custom_primary_navigation()
 */
add_action( 'custom_header', 'custom_header_container', 0 );
add_action( 'custom_header', 'custom_skip_links', 5 );
add_action( 'custom_header', 'custom_site_branding', 20 );
add_action( 'custom_header', 'custom_secondary_navigation', 30 );
add_action( 'custom_header', 'custom_header_container_close', 41 );
add_action( 'custom_header', 'custom_primary_navigation_wrapper', 42 );
add_action( 'custom_header', 'custom_primary_navigation', 50 );
add_action( 'custom_header', 'custom_primary_navigation_wrapper_close', 68 );

/**
 * Footer
 *
 * @see  custom_footer_widgets()
 * @see  custom_credit()
 */
add_action( 'custom_footer', 'custom_footer_widgets', 10 );
add_action( 'custom_footer', 'custom_credit', 20 );

/**
 * Homepage
 *
 * @see  custom_homepage_content()
 */
add_action( 'homepage', 'custom_homepage_content', 10 );

/**
 * Posts
 *
 * @see  custom_post_header()
 * @see  custom_post_meta()
 * @see  custom_post_content()
 * @see  custom_paging_nav()
 * @see  custom_single_post_header()
 * @see  custom_post_nav()
 * @see  custom_display_comments()
 */
add_action( 'custom_loop_post', 'custom_post_header', 10 );
add_action( 'custom_loop_post', 'custom_post_content', 30 );
// add_action( 'custom_loop_post', 'custom_post_taxonomy', 40 );
// add_action( 'custom_loop_after', 'custom_paging_nav', 10 );
add_action( 'custom_single_post', 'custom_post_header', 10 );
add_action( 'custom_single_post', 'custom_post_content', 30 );
// add_action( 'custom_single_post_bottom', 'custom_edit_post_link', 5 );
// add_action( 'custom_single_post_bottom', 'custom_post_taxonomy', 5 );
// add_action( 'custom_single_post_bottom', 'custom_post_nav', 10 );
// add_action( 'custom_single_post_bottom', 'custom_display_comments', 20 );
// add_action( 'custom_post_header_before', 'custom_post_meta', 10 );
// add_action( 'custom_post_content_before', 'custom_post_thumbnail', 10 );

/**
 * Pages
 *
 * @see  custom_page_header()
 * @see  custom_page_content()
 * @see  custom_display_comments()
 */
add_action( 'custom_page', 'custom_page_header', 10 );
add_action( 'custom_page', 'custom_page_content', 20 );
// add_action( 'custom_page', 'custom_edit_post_link', 30 );
// add_action( 'custom_page_after', 'custom_display_comments', 10 );

/**
 * Homepage Page Template
 *
 * @see  custom_homepage_header()
 * @see  custom_page_content()
 */
add_action( 'custom_homepage', 'custom_homepage_header', 10 );
add_action( 'custom_homepage', 'custom_page_content', 20 );
