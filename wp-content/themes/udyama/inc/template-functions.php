<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Udyama
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function udyama_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'udyama_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function udyama_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'udyama_pingback_header' );


/**
* Get header markup
*/
function udyama_get_header() {
	get_template_part( 'template-parts/others/header' );
}
add_action( 'udyama_header', 'udyama_get_header' );


/**
* Get footer markup
*/
function udyama_get_footer() {
	get_template_part( 'template-parts/others/footer' );
}
add_action( 'udyama_footer', 'udyama_get_footer' );


/**
* Add classes to navigation buttons
*/
add_filter( 'next_posts_link_attributes', 'udyama_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'udyama_posts_link_attributes' );
add_filter( 'next_comments_link_attributes', 'udyama_comments_link_attributes' );
add_filter( 'previous_comments_link_attributes', 'udyama_comments_link_attributes' );

function udyama_posts_link_attributes() {
	return 'class="btn btn-outline-primary btn-sm mt-4 mb-4"';
}

function udyama_comments_link_attributes() {
	return 'class="btn btn-outline-primary btn-sm mt-4 mb-4"';
}


/**
* Greet new users & guide them to help page
*/
function udyama_admin_notice(){
	if ( is_admin() ) {
		udyama_greet_user();
	}
}
$intro_notice_dismissed = get_option( 'udyama-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action('admin_notices', 'udyama_admin_notice');
}

function udyama_greet_user() {
	$help_url = esc_url( admin_url( 'themes.php?page=udyama-theme-help' ) );
	echo '<div class="notice udyama-intro-notice notice-success is-dismissible">';
	echo wp_kses_post( __( '<p style="margin-bottom: 5px;">Welcome! Thank you for choosing Udyama. You can always reach out to us on the support forum if you need any help. Please do take a look at the pro version of the theme. If you liked our work, please support us by providing us a review with 5-star ratings.', 'udyama' ) );
	echo "<p><a href='https://wp-points.com/udyama-how-to-import-demo-pages/' class='button' target='_blank'>";
	esc_html_e( 'Learn how to import the demo pages', 'udyama' );
	echo "</a><a href='http://wp-points.com/themes/udyama-pro' class='button button-primary' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'Check Udyama Pro', 'udyama' );
	echo "</a><a href='https://wordpress.org/support/theme/udyama/reviews/#new-post' class='' target='_blank' style='margin-left: 10px;'>";
	esc_html_e( 'Rate us 5 stars', 'udyama' );
	echo "</a><a href='#' class='be-notice-dismiss' target='_blank' style='margin-left: 10px;float: right;'>";
	esc_html_e( 'Don\'t display this again!', 'udyama' );
	echo '</a></p></div>';
}


// Enqueue dismiss script
function udyama_admin_scripts() {
	wp_enqueue_script( 'udyama-admin', get_template_directory_uri() . '/assets/js/udyama-admin.js' );
}
$intro_notice_dismissed = get_option( 'udyama-intro-dismissed' );
if( empty( $intro_notice_dismissed ) ) {
	add_action( 'admin_enqueue_scripts' , 'udyama_admin_scripts' );
}


// Update option if notice dismissed
add_action( 'wp_ajax_udyama-intro-dismissed', 'udyama_dismiss_intro_notice' );
function udyama_dismiss_intro_notice() {
	update_option( 'udyama-intro-dismissed', 1 );
}


// Import demo
function udyama_ocdi_import_files() {
  return array(
	array(
		'import_file_name'             => 'Default Demo',
		'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/udyama-content.xml',
		'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo/udyama-widgets.wie',
		'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/udyama-customizer.dat',
		'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'screenshot.jpg',
		'import_notice'                => esc_html__( 'Fresh WordPress installation is recommended for demo import. You might need to change some settings like Menu, Frontpage or customizer options if this is not fresh WordPress.', 'udyama' ),
		'preview_url'                  => 'https://udyama.wp-points.com',
	),
  );
}
add_filter( 'pt-ocdi/import_files', 'udyama_ocdi_import_files' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


// Set Front Page & Menu After Import
function udyama_ocdi_after_import_setup( $selected_import ) {

	update_option( 'udyama-demo-imported', 1 );

	$ud_menu_name       = 'Main Menu - Udyama';
	$ud_front_page_name = 'Home - Udyama';
	$ud_blog_page_name  = 'News - Udyama';

	if( 'Demo 1' === $selected_import['import_file_name'] ) {
		$ud_menu_name       = 'Main Menu - Udyama';
		$ud_front_page_name = 'Home - Udyama';
		$ud_blog_page_name  = 'News - Udyama';
	}

	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', $ud_menu_name, 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'menu-1' => $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( $ud_front_page_name );
	$blog_page_id  = get_page_by_title( $ud_blog_page_name );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	if( defined( 'ELEMENTOR_VERSION' ) ) {
		update_option( 'elementor_disable_color_schemes', 'yes' );
	    update_option( 'elementor_disable_typography_schemes', 'yes' );
	}

}
add_action( 'pt-ocdi/after_import', 'udyama_ocdi_after_import_setup' );

// Change One Click Demo Import Name
function udyama_ocdi_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Import Udyama Demo' , 'udyama' );
	$default_settings['menu_title']  = esc_html__( 'Import Udyama Demo' , 'udyama' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'pt-one-click-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'udyama_ocdi_plugin_page_setup' );
