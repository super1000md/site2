<?php
/**
 * Anther Theme Customizer
 *
 * @package Anther
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function anther_customize_register ( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Theme Options Panel
	 */
	$wp_customize->add_panel( 'anther_theme_options', array(
	    'title'     => esc_html__( 'Theme Options', 'anther' ),
	    'priority'  => 1,
	) );

	/**
	 * General Options Section
	 */
	$wp_customize->add_section( 'anther_general_options', array (
		'title'     => esc_html__( 'General Options', 'anther' ),
		'panel'     => 'anther_theme_options',
		'priority'  => 10,
		'description' => esc_html__( 'Personalize the settings of your theme.', 'anther' ),
	) );

	// Featured Image Size
	$wp_customize->add_setting ( 'anther_featured_image_size', array (
		'default'           => anther_default( 'anther_featured_image_size' ),
		'sanitize_callback' => 'anther_sanitize_select',
	) );

	$wp_customize->add_control ( 'anther_featured_image_size', array (
		'label'    => esc_html__( 'Featured Image Size', 'anther' ),
		'section'  => 'anther_general_options',
		'priority' => 1,
		'type'     => 'select',
		'choices'  => array(
			'square'    => esc_html__( 'Square',    'anther'),
			'landscape' => esc_html__( 'Landscape', 'anther'),
			'portrait'  => esc_html__( 'Portrait',  'anther'),
		),
	) );

	// Read More Label
	$wp_customize->add_setting ( 'anther_read_more_label', array(
		'default'           => anther_default( 'anther_read_more_label' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control ( 'anther_read_more_label', array(
		'label'    => esc_html__( 'Read More Label', 'anther' ),
		'section'  => 'anther_general_options',
		'priority' => 2,
		'type'     => 'text',
	) );

	// Excerpt Length
	$wp_customize->add_setting ( 'anther_excerpt_length', array(
		'default'           => anther_default( 'anther_excerpt_length' ),
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control ( 'anther_excerpt_length', array(
		'label'    => esc_html__( 'Excerpt Length', 'anther' ),
		'description' => esc_html__( 'Zero (0) length will not show the excerpt.', 'anther' ),
		'section'  => 'anther_general_options',
		'priority' => 3,
		'type'     => 'number',
	) );

	/**
	 * Header Options Section
	 */
	$wp_customize->add_section( 'anther_header_options', array (
		'title'     => esc_html__( 'Header Options', 'anther' ),
		'panel'     => 'anther_theme_options',
		'priority'  => 20,
		'description' => esc_html__( 'Personalize the header settings of your theme.', 'anther' ),
	) );

	// Header Search Control
	$wp_customize->add_setting ( 'anther_header_search', array (
		'default'           => anther_default( 'anther_header_search' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_header_search', array (
		'label'    => esc_html__( 'Enable Header Search', 'anther' ),
		'section'  => 'anther_header_options',
		'priority' => 5,
		'type'     => 'checkbox',
	) );

	/**
	 * Layout Options Section
	 */
	$wp_customize->add_section( 'anther_layout_options', array (
		'title'     => esc_html__( 'Layout Options', 'anther' ),
		'panel'     => 'anther_theme_options',
		'priority'  => 30,
		'description' => esc_html__( 'Personalize the layout settings of your theme.', 'anther' ),
	) );

	// Theme Layout
	$wp_customize->add_setting ( 'anther_theme_layout', array(
		'default'           => anther_default( 'anther_theme_layout' ),
		'sanitize_callback' => 'anther_sanitize_select',
	) );

	$wp_customize->add_control ( 'anther_theme_layout', array(
		'label'    => esc_html__( 'Theme Layout', 'anther' ),
		'description' => esc_html__( 'Box layout will be visible at minimum 1200px display', 'anther' ),
		'section'  => 'anther_layout_options',
		'priority' => 1,
		'type'     => 'select',
		'choices'  => array(
			'wide' => esc_html__( 'Wide', 'anther' ),
			'box'  => esc_html__( 'Box',  'anther' ),
		),
	) );

	// Main Sidebar Position
	$wp_customize->add_setting ( 'anther_sidebar_position', array (
		'default'           => anther_default( 'anther_sidebar_position' ),
		'sanitize_callback' => 'anther_sanitize_select',
	) );

	$wp_customize->add_control ( 'anther_sidebar_position', array (
		'label'    => esc_html__( 'Main Sidebar Position', 'anther' ),
		'section'  => 'anther_layout_options',
		'priority' => 2,
		'type'     => 'select',
		'choices'  => array(
			'right' => esc_html__( 'Right', 'anther'),
			'left'  => esc_html__( 'Left',  'anther'),
		),
	) );

	/**
	 * Content Options Section
	 */
	$wp_customize->add_section( 'anther_content_options', array (
		'title'     => esc_html__( 'Content Options', 'anther' ),
		'panel'     => 'anther_theme_options',
		'priority'  => 40,
		'description' => esc_html__( 'Content settings of your theme.', 'anther' ),
	) );

	// Author Bio Title
	$wp_customize->add_setting ( 'anther_content_options_author_bio_title' );

	$wp_customize->add_control(
		new Anther_Heading_Control(
			$wp_customize,
			'anther_content_options_author_bio_title',
			array(
				'label'           => esc_html__( 'Author Bio', 'anther' ),
				'section'         => 'anther_content_options',
				'priority'        => 1,
				'type'            => 'anther-heading',
			)
		)
	);

	// Author Bio Control
	$wp_customize->add_setting ( 'anther_content_options_author_bio', array (
		'default'           => anther_default( 'anther_content_options_author_bio' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_author_bio', array (
		'label'           => esc_html__( 'Display on single posts', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 2,
		'type'            => 'checkbox',
	) );

	// Post Details Title
	$wp_customize->add_setting ( 'anther_content_options_post_details_title' );

	$wp_customize->add_control(
		new Anther_Heading_Control(
			$wp_customize,
			'anther_content_options_post_details_title',
			array(
				'label'           => esc_html__( 'Post Details', 'anther' ),
				'section'         => 'anther_content_options',
				'priority'        => 3,
				'type'            => 'anther-heading',
			)
		)
	);

	// Post Date Control
	$wp_customize->add_setting ( 'anther_content_options_post_date', array (
		'default'           => anther_default( 'anther_content_options_post_date' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_post_date', array (
		'label'           => esc_html__( 'Display Date', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 4,
		'type'            => 'checkbox',
	) );

	// Post Categories Control
	$wp_customize->add_setting ( 'anther_content_options_post_categories', array (
		'default'           => anther_default( 'anther_content_options_post_categories' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_post_categories', array (
		'label'           => esc_html__( 'Display Categories', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 5,
		'type'            => 'checkbox',
	) );

	// Post Tags Control
	$wp_customize->add_setting ( 'anther_content_options_post_tags', array (
		'default'           => anther_default( 'anther_content_options_post_tags' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_post_tags', array (
		'label'           => esc_html__( 'Display Tags', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 6,
		'type'            => 'checkbox',
	) );

	// Post Author Control
	$wp_customize->add_setting ( 'anther_content_options_post_author', array (
		'default'           => anther_default( 'anther_content_options_post_author' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_post_author', array (
		'label'           => esc_html__( 'Display Author', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 7,
		'type'            => 'checkbox',
	) );

	// Featured Images Title
	$wp_customize->add_setting ( 'anther_content_options_featured_images_title' );

	$wp_customize->add_control(
		new Anther_Heading_Control(
			$wp_customize,
			'anther_content_options_featured_images_title',
			array(
				'label'           => esc_html__( 'Featured Images', 'anther' ),
				'section'         => 'anther_content_options',
				'priority'        => 8,
				'type'            => 'anther-heading',
			)
		)
	);

	// Featured Image Archive Control
	$wp_customize->add_setting ( 'anther_content_options_featured_image_archive', array (
		'default'           => anther_default( 'anther_content_options_featured_image_archive' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_featured_image_archive', array (
		'label'           => esc_html__( 'Display on Blog and Archives', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 9,
		'type'            => 'checkbox',
	) );

	// Featured Image Post Control
	$wp_customize->add_setting ( 'anther_content_options_featured_image_post', array (
		'default'           => anther_default( 'anther_content_options_featured_image_post' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_featured_image_post', array (
		'label'           => esc_html__( 'Display on single Posts', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 10,
		'type'            => 'checkbox',
	) );

	// Featured Image Page Control
	$wp_customize->add_setting ( 'anther_content_options_featured_image_page', array (
		'default'           => anther_default( 'anther_content_options_featured_image_page' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_featured_image_page', array (
		'label'           => esc_html__( 'Display on single Pages', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 11,
		'type'            => 'checkbox',
	) );

	// Archive Details Title
	$wp_customize->add_setting ( 'anther_content_options_archive_details_title' );

	$wp_customize->add_control(
		new Anther_Heading_Control(
			$wp_customize,
			'anther_content_options_archive_details_title',
			array(
				'label'           => esc_html__( 'Archive Details', 'anther' ),
				'section'         => 'anther_content_options',
				'priority'        => 12,
				'type'            => 'anther-heading',
			)
		)
	);

	// Archive Title Label Control
	$wp_customize->add_setting ( 'anther_content_options_archive_title_label', array (
		'default'           => anther_default( 'anther_content_options_archive_title_label' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_archive_title_label', array (
		'label'           => esc_html__( 'Display Archive Title Label (Example: Category, Tag, Author etc)', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 13,
		'type'            => 'checkbox',
	) );

	// Post First Category Control
	$wp_customize->add_setting ( 'anther_content_options_post_first_category', array (
		'default'           => anther_default( 'anther_content_options_post_first_category' ),
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_content_options_post_first_category', array (
		'label'           => esc_html__( 'Display Post First Category On Archives', 'anther' ),
		'section'         => 'anther_content_options',
		'priority'        => 14,
		'type'            => 'checkbox',
	) );

	/**
	 * Footer Section
	 */
	$wp_customize->add_section( 'anther_footer_options', array (
		'title'       => esc_html__( 'Footer Options', 'anther' ),
		'panel'       => 'anther_theme_options',
		'priority'    => 50,
		'description' => esc_html__( 'Personalize the footer settings of your theme.', 'anther' ),
	) );

	// Copyright Control
	$wp_customize->add_setting ( 'anther_copyright', array (
		'default'           => anther_default( 'anther_copyright' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control ( 'anther_copyright', array (
		'label'    => esc_html__( 'Copyright', 'anther' ),
		'section'  => 'anther_footer_options',
		'priority' => 1,
		'type'     => 'textarea',
	) );

	// Credit Control
	$wp_customize->add_setting ( 'anther_credit', array (
		'default'           => anther_default( 'anther_credit' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'anther_sanitize_checkbox',
	) );

	$wp_customize->add_control ( 'anther_credit', array (
		'label'    => esc_html__( 'Display Designer Credit', 'anther' ),
		'section'  => 'anther_footer_options',
		'priority' => 2,
		'type'     => 'checkbox',
	) );

	/**
	 * Support Section
	 */
	$wp_customize->add_section( 'anther_support_options', array(
		'title'       => esc_html__( 'Support Options', 'anther' ),
		'description' => esc_html__( 'Please use the following link for your enquiries.', 'anther' ),
		'panel'       => 'anther_theme_options',
		'priority'    => 60,
	) );

	// Theme Support
	$wp_customize->add_setting ( 'anther_theme_support', array(
		'default' => '',
	) );

	$wp_customize->add_control(
		new Anther_Button_Control(
			$wp_customize,
			'anther_theme_support',
			array(
				'label'         => esc_html__( 'Anther Support', 'anther' ),
				'section'       => 'anther_support_options',
				'priority'      => 1,
				'type'          => 'anther-button',
				'button_tag'    => 'a',
				'button_class'  => 'button button-primary',
				'button_href'   => 'https://designorbital.com/contact/',
				'button_target' => '_blank',
			)
		)
	);
}
add_action( 'customize_register', 'anther_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function anther_customize_preview_js() {
	wp_enqueue_script( 'anther_customizer', get_template_directory_uri() . '/dist/js/customizer.js', array( 'customize-preview' ), '20140120', true );
}
add_action( 'customize_preview_init', 'anther_customize_preview_js' );
