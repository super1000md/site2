<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

//Custom Button (docs + Upgrade To Pro)
require_once( trailingslashit( get_stylesheet_directory() ) . '/custom-edition-timelineblog/upgrade/class-customize.php');


// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'timelineblog_cfg_parent_css' ) ):
	function timelineblog_cfg_parent_css() {
		wp_enqueue_style( 'timelineblog-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap-min-css','cryptocurrency-exchange-animate-css','font-awesome-min-css','crypto-flexslider-css' ) );
		
		wp_enqueue_style('dashicons');
		// timelineblog style css
		wp_enqueue_style('timelineblog-child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

		// timelineblog custom color style css
		wp_enqueue_style('timelineblog-custom-color', get_stylesheet_directory_uri() . '/css/timelineblog-custom-color.css', array('crypto-custom-color'));
		
}
endif;
add_action( 'wp_enqueue_scripts', 'timelineblog_cfg_parent_css', 11 );

// END ENQUEUE PARENT ACTION



function timelineblog_customize_register() {
	global $wp_customize;
	$wp_customize->remove_section( 'upgrade_crypto_premium' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_slider_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_service_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_exchange_blog_option' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_portfolio_section' );  //Modify this line as needed
	$wp_customize->remove_section( 'cryptocurrency_exchange_testimonial_settings' ); //Modify this line as needed
	
	//timelineblog Customiser Section
	$wp_customize->add_section( 'timelineblog_section_option' , array(
			'title'      	=> __( 'Timeline View', 'timelineblog' ),
			'description'   => __('timelineblog has very Featured design of showing blog post', 'timelineblog'),
			'priority'      => 4,
			'panel'      	=> 'cryptocurrency_exchange_theme_options',
		) 
	);
	
	//timelineblog Default Setting
	$wp_customize->add_setting( 'timelineblog_activate_setting', array(
			'default'      		=> 'inactive',
			'sanitize_callback' => 'cryptocurrency_exchange_sanitize_radio'
		)
	);
	
	//timelineblog Customiser Section's Control
	$wp_customize->add_control('timelineblog_activate_setting', array(
			'type'      => 'radio',
			'label'     => __('Timeline Blog Design', 'timelineblog'),
			'section'   => 'timelineblog_section_option',
			'priority'  => 1,
			'choices'   => array(
				'active'       => __( 'Active', 'timelineblog' ),
				'inactive'     => __( 'Inactive', 'timelineblog' ),
			),
		)
	); 
	
	//Timeline post Title Name
	$wp_customize->add_setting('timelineblog_post_heading', array(
			'default' 			=> esc_html('Blog & News Timeline','timelineblog'),
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
	);
	$wp_customize->add_control('timelineblog_post_heading', array(
			'label' 	=> __( 'Posts SubHeading', 'timelineblog' ),
			'section' 	=> 'timelineblog_section_option',
			'type' 		=> 'text',
			'priority' 	=> 5,
		)
	);
	
}
add_action( 'customize_register', 'timelineblog_customize_register', 11 );

function timelineblog_register_home_section_partials( $wp_customize ){
	// customizer UI Partial Selector Pencil code  
	//Posts Section
	$wp_customize->selective_refresh->add_partial( 'timelineblog_post_heading', array(
		'selector'            => '.blog-timeline .blog-timeline-header',
		'settings'            => 'timelineblog_post_heading',
		'render_callback'  	  => 'timelineblog_post_heading_render_callback',
	) );
}
add_action( 'customize_register', 'timelineblog_register_home_section_partials' );

function timelineblog_post_heading_render_callback() {
	return get_theme_mod('timelineblog_post_heading');
}

