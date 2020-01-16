<?php
/**
 * Udyama Theme Customizer
 *
 * @package Udyama
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function udyama_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport    = 'postMessage';

	$wp_customize->get_control( 'background_color' )->label       = esc_html__( 'Body Background Color', 'udyama' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'                                            => '.site-title a',
			'render_callback'                                     => 'udyama_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'                                            => '.site-description',
			'render_callback'                                     => 'udyama_customize_partial_blogdescription',
		) );
	}

	include get_template_directory() . '/inc/customizer/theme-options.php';
}
add_action( 'customize_register', 'udyama_customize_register' );



// Render the site title for the selective refresh partial.
function udyama_customize_partial_blogname() {
	bloginfo( 'name' );
}



// Render the site tagline for the selective refresh partial.
function udyama_customize_partial_blogdescription() {
	bloginfo( 'description' );
}



// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function udyama_customize_preview_js() {
	wp_enqueue_script( 'udyama-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'udyama_customize_preview_js' );



// Add Styles to the Customizer
function udyama_customizer_css()
{
	wp_enqueue_style( 'udyama-customizer-css', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'udyama_customizer_css' );



// Custom CSS output for theme options
function udyama_custom_css_output() { ?>
	<style type="text/css" id="custom-theme-css">
		.custom-logo { height: <?php echo esc_html( get_theme_mod( 'udyama_logo_height', '60' ) ); ?>px; width: auto; }
		.page-wrapper { background-color: <?php echo esc_html( get_theme_mod( 'udyama_content_bg_color', '#ffffff' ) ); ?>; }

		/* Primary COlor */
		a { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		.widget a { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		input[type="submit"] { border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; background-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		.site-footer a { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		.btn-primary { background-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }
		.btn-outline-primary { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_color', '#007bff' ) ); ?>; }

		/* Primary Hover Color */
		a:hover, a:focus, a:active { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; }
		.widget a:hover { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; }
		.site-footer a:hover { color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; }
		.btn-primary:hover { background-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; }
		.btn-outline-primary:hover { background-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_primary_hover_color', '#0056b3' ) ); ?>; }

		/* Secondary Color */
		.header-right-widget-area .widget .btn.btn-primary { background-color: <?php echo esc_html( get_theme_mod( 'udyama_sec_color', '#595959' ) ); ?>; border-color: <?php echo esc_html( get_theme_mod( 'udyama_sec_color', '#595959' ) ); ?>; }
		.udyama-contact-widget .dashicons { color: <?php echo esc_html( get_theme_mod( 'udyama_sec_color', '#595959' ) ); ?>; }

		/* Nav Bg Color */
		.site-header .udyama-navbar { background: <?php echo esc_html( get_theme_mod( 'udyama_nav_bg_color', '#f9fbf9' ) ); ?>; }
		.slicknav_nav { background: <?php echo esc_html( get_theme_mod( 'udyama_nav_bg_color', '#f9fbf9' ) ); ?>; }
		.main-navigation ul ul { background: <?php echo esc_html( get_theme_mod( 'udyama_nav_bg_color', '#f9fbf9' ) ); ?>; }

		/* Nav Link Color */
		.main-navigation li a { color: <?php echo esc_html( get_theme_mod( 'udyama_nav_link_color', '#696969' ) ); ?>; }
		.main-navigation li.current_page_item > a { color: <?php echo esc_html( get_theme_mod( 'udyama_nav_active_link_color', '#292929' ) ); ?>; }
		.main-navigation li a:hover { color: <?php echo esc_html( get_theme_mod( 'udyama_nav_active_link_color', '#292929' ) ); ?>; }
		.slicknav_nav a { color: <?php echo esc_html( get_theme_mod( 'udyama_nav_link_color', '#696969' ) ); ?>; }

		<?php if ( get_header_image() ) : ?>
		/* Header Image */
		.site-header { background-image: url(<?php echo esc_url( get_header_image() ); ?>); background-size: cover; background-position: center; }
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'udyama_custom_css_output');
