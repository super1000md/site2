<?php
/**
 * Kodiak-football-sport functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kodiak-football-sport
 */

if ( ! function_exists( 'kodiak_football_sport_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kodiak_football_sport_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Kodiak-football-sport, use a find and replace
		 * to change 'kodiak-football-sport' to the name of your theme in all the template files.
		 */

		load_theme_textdomain( 'kodiak-football-sport', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-logo' );

		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(
			array(
				'top'    => __( 'Top Menu', 'kodiak-football-sport' ),
				'footer' => __( 'Footer menu', 'kodiak-football-sport' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for theme styles the visual editor.
		add_theme_support( 'editor-styles' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;

add_action( 'after_setup_theme', 'kodiak_football_sport_setup' );

/*
* This theme styles the visual editor to resemble the theme style,
* specifically font, colors, icons, and column width.
*/
function kodiak_football_sport_add_editor_styles() {
	add_editor_style( 'editor-styles.css' );
}
add_action( 'after_setup_theme', 'kodiak_football_sport_add_editor_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kodiak_football_sport_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kodiak_football_sport_content_width', 640 );
}
add_action( 'after_setup_theme', 'kodiak_football_sport_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kodiak_football_sport_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Content Top', 'kodiak-football-sport' ),
			'id'            => 'top',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div class="header-part"><div class="slider-box widget %2$s">',
			'after_widget'  => '</div></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before main content', 'kodiak-football-sport' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div class="col-xs-12 midCol"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="text-center">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'After main content', 'kodiak-football-sport' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div class="col-xs-12 midCol"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="text-center">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kodiak-football-sport' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="heading"><h3 class="text-left">',
			'after_title'   => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Content Bottom', 'kodiak-football-sport' ),
			'id'            => 'bottom',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div class="col-xs-12"><div id="%1$s" class="spons-box widget %2$s">',
			'after_widget'  => '</div></div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'kodiak-football-sport' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div id="%1$s" class="footerMenu widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="kfooter">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'kodiak-football-sport' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div id="%1$s" class="footerMenu widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="kfooter">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'kodiak-football-sport' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div id="%1$s" class="footerMenu widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="kfooter">',
			'after_title'   => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 4', 'kodiak-football-sport' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'kodiak-football-sport' ),
			'before_widget' => '<div id="%1$s" class="footerMenu widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="kfooter">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'kodiak_football_sport_widgets_init' );

add_filter( 'get_custom_logo', 'kodiak_football_sport_custom_logo' );

/**
 * Custom logo and image class
 */
function kodiak_football_sport_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$html = sprintf(
		'<a href="%1$s" class="navbar-brand" rel="home" itemprop="url">%2$s</a>',
		esc_url( home_url( '/' ) ),
		wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			array(
				'class' => 'img-responsive',
			)
		)
	);
	return $html;
}

add_filter( 'wp_nav_menu_args', 'kodiak_football_sport_nav_menu_args' );

/**
 * All menu params
 *
 * @see wp_nav_menu()
 *
 * @param array $args Array of wp_nav_menu() arguments.
 */
function kodiak_football_sport_nav_menu_args( $args ) {
	$args['container'] = false;
	$args['menu_class'] = 'nav menu';
	return $args;
}


add_filter( 'wp_nav_menu_args', 'kodiak_football_sport_top_menu_args' );

/**
 * Top menu params
 *
 * @see wp_nav_menu()
 *
 * @param array $args Array of wp_nav_menu() arguments.
 */
function kodiak_football_sport_top_menu_args( $args ) {
	if ( 'top' === $args['theme_location'] ) {
		$args['menu_class'] = 'nav navbar-right';
	}
	return $args;
}

/**
 * Breadcrumbs
 */
function kodiak_football_sport_breadcrumb() {
	echo ' <li class="active yah"><span> ';
	esc_html_e( 'You are here:', 'kodiak-football-sport' );
	echo ' </span></li> ';
	if ( ! is_front_page() ) {
		echo ' <li class="active"><a href=" ' . esc_url( home_url( '/' ) ) . ' "> ';
		esc_html_e( 'Home', 'kodiak-football-sport' );
		echo ' </a></li> ';
		if ( is_category() || is_single() ) {
			echo ' <li class="active"> ';
			echo the_category( ' ' );
			echo ' </li> ';
			if ( is_single() ) {
				echo ' <li class="active"><span> ';
				echo the_title();
				echo ' </span></li> ';
			}
		} elseif ( is_page() ) {
			echo ' <li class="active"><span> ';
			echo the_title();
			echo ' </span></li> ';
		}
	} else {
		echo ' <li class="active"><span> ';
		esc_html_e( 'Home', 'kodiak-football-sport' );
		echo ' </span></li> ';
	}
}

/**
 * Enqueue scripts and styles.
 */
function kodiak_football_sport_scripts() {
	// FontAwesome.
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', '', ' ' );

	// Bootstrap.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', '', ' ' );

	if ( ! wp_script_is( 'jsbootstrap-js', 'enqueued' ) ) {
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), ' ', true );
	}

	// Information about theme (style.css - important).
	wp_enqueue_style( 'style', get_stylesheet_uri(), '', ' ' );

	// Main style for theme.
	wp_enqueue_style( 'kodiak-style', get_template_directory_uri() . '/css/templateStyle.css', array( 'bootstrap' ), ' ' );

	// Background.
	wp_enqueue_style( 'background', get_template_directory_uri() . '/css/background.css', '', ' ' );

	// Backgrounds.
	wp_enqueue_style( 'backgrounds', get_template_directory_uri() . '/css/backgrounds/original.css', '', ' ' );
	wp_enqueue_script( 'kodiak-js', get_template_directory_uri() . '/js/kodiak.js', array( 'jquery, bootstrap' ), ' ', true );
	wp_enqueue_script( 'kodiak-navigation', get_template_directory_uri() . '/js/navigation.js', array(), ' ', true );
	wp_enqueue_script( 'kodiak-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), ' ', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kodiak_football_sport_scripts' );

/**
 * Custom register
 *
 * @param array $wp_customize - WP_Customize_Manager instance.
 */
function kodiak_football_sport_customizer_register( $wp_customize ) {
	$wp_customize->add_section(
		'kodiak_football_sport_custom',
		array(
			'title'         => esc_html__( 'Theme customization', 'kodiak-football-sport' ),
			'description'   => esc_html__( 'Kodiak football sport - responsive WordPress sport template', 'kodiak-football-sport' ),
		)
	);

	/**
	 * Sanitize Radio
	 *
	 * @param object $input - input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only.
	 *
	 * @param array  $setting - the list of possible radio box options.
	 */
	function kodiak_football_sport_sanitize_radio( $input, $setting ) {
		$input = sanitize_key( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Square content.
	$wp_customize->add_setting(
		'square_content',
		array(
			'default'           => 'item_1',
			'sanitize_callback' => 'kodiak_football_sport_sanitize_radio',
		)
	);
	$wp_customize->add_control(
		'square_content',
		array(
			'label'     => esc_html__( 'Square content', 'kodiak-football-sport' ),
			'section'   => 'kodiak_football_sport_custom',
			'settings'  => 'square_content',
			'type'      => 'radio',
			'choices'   => array(
				'item_1'    => esc_html__( 'Yes', 'kodiak-football-sport' ),
				'item_2'    => esc_html__( 'No', 'kodiak-football-sport' ),
			),
		)
	);

	// Breadcrumbs option.
	$wp_customize->add_setting(
		'breadcrumb',
		array(
			'default'           => 'OFF',
			'sanitize_callback' => 'kodiak_football_sport_sanitize_radio',
		)
	);
	$wp_customize->add_control(
		'breadcrumb',
		array(
			'label'     => esc_html__( 'Breadcrumbs', 'kodiak-football-sport' ),
			'section'   => 'kodiak_football_sport_custom',
			'settings'  => 'breadcrumb',
			'type'      => 'radio',
			'choices'   => array(
				'ON'    => esc_html__( 'On', 'kodiak-football-sport' ),
				'OFF'   => esc_html__( 'Off', 'kodiak-football-sport' ),
			),
		)
	);

	// "Theme by" option.
	$wp_customize->add_setting(
		'themeby',
		array(
			'default'           => 'ON',
			'sanitize_callback' => 'kodiak_football_sport_sanitize_radio',
		)
	);
	$wp_customize->add_control(
		'themeby',
		array(
			'label'     => esc_html__( 'Info about development team', 'kodiak-football-sport' ),
			'section'   => 'kodiak_football_sport_custom',
			'settings'  => 'themeby',
			'type'      => 'radio',
			'choices'   => array(
				'ON'    => esc_html__( 'Turn on', 'kodiak-football-sport' ),
				'OFF'   => esc_html__( 'Turn off', 'kodiak-football-sport' ),
			),
		)
	);
}
add_action( 'customize_register', 'kodiak_football_sport_customizer_register' );

/**
 * Add featured image as background image to post navigation elements.
 */
function kodiak_football_sport_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous && has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= ' .post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); } ';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= ' .post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; } ';
	}

	wp_add_inline_style( 'kodiak-style', $css );
}
add_action( 'wp_enqueue_scripts', 'kodiak_football_sport_post_nav_background' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Register Custom Navigation Walker.
 */
require get_template_directory() . '/walker/class-kodiak-football-sport-bootstrap-navwalker.php';

/**
 * Register Custom Comment Walker.
 */
require get_template_directory() . '/walker/class-kodiak-football-sport-bootstrap-comment-walker.php';

/**
 * Plugin Required.
 */
require get_template_directory() . '/inc/plugins/required.php';
