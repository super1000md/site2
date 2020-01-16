<?php
/**
 * Udyama functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Udyama
 */

if ( ! function_exists( 'udyama_setup' ) ) :
	function udyama_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'udyama', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'udyama' ),
		) );

		//Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'udyama_custom_background_args', array(
			'default-color' => 'f9fbf9',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 200,
			'width'       => 200,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'udyama_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function udyama_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'udyama_content_width', 800 );
}
add_action( 'after_setup_theme', 'udyama_content_width', 0 );


/**
 * Register widget area.
 */
function udyama_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'udyama' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'udyama' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right', 'udyama' ),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Add widgets here to show in the header.', 'udyama' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'udyama_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function udyama_scripts() {
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), 'v4.2.1', 'all' );
	wp_enqueue_style( 'slicknavcss', get_template_directory_uri() . '/assets/css/slicknav.css', array(), 'v1.0.10', 'all' );
	wp_enqueue_style( 'udyama-style', get_stylesheet_uri(), array(), 'v1.0.1', 'all' );

	wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array('jquery'), 'v1.0.10', true );
	wp_enqueue_script( 'udyama-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'udyama_scripts' );


// Implement the Custom Header feature.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/theme-hook-functions.php';
require get_template_directory() . '/inc/template-functions.php';

// Add custom widgets
require get_template_directory() . '/inc/widgets/class-udyama-button-widget.php';
require get_template_directory() . '/inc/widgets/class-udyama-contact-widget.php';
require get_template_directory() . '/inc/widgets/class-udyama-address-widget.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Install plugins
require get_template_directory() . '/inc/lib/tgmpa/install-plugins.php';

// Editor Style
function udyama_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'udyama_add_editor_styles' );

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
