<?php

// Add Section
$wp_customize->add_section( 'udyama_theme_general_settings', array(
	'title'             => __( 'Theme Options', 'udyama' ),
	'priority'          => 30,
) );


$wp_customize->add_setting( 'udyama_boxed_site', array(
	'default'           => true,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'udyama_boxed_site', array(
	'label'             => __( 'Display Boxed Site', 'udyama' ),
	'type'              => 'checkbox',
	'section'           => 'udyama_theme_general_settings',
	'setting'           => 'udyama_boxed_site',
	'description'       => esc_html__( 'Depending on your screen size, you might need to click "Hide Control" button in the bottom left corner so the effect of this setting.', 'udyama' ),
) );


$wp_customize->add_setting( 'udyama_display_full_blog', array(
	'default'           => false,
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'udyama_display_full_blog', array(
	'label'             => __( 'Display full post on home page', 'udyama' ),
	'type'              => 'checkbox',
	'section'           => 'udyama_theme_general_settings',
	'setting'           => 'udyama_display_full_blog',
	'active_callback'   => 'is_home',
	'description'       => esc_html__( 'By default, excerpt is displayed on the blog home page.', 'udyama' ),
) );


$wp_customize->add_setting( 'udyama_sidebar_position', array(
	'default'           => 'right',
	'sanitize_callback' => 'esc_html',
) );

$wp_customize->add_control( 'udyama_sidebar_position', array(
	'label'             => __( 'Sidebar Position', 'udyama' ),
	'type'              => 'radio',
	'section'           => 'udyama_theme_general_settings',
	'setting'           => 'udyama_sidebar_position',
	'choices'           => array(
		'right'         => __( 'Right', 'udyama' ),
		'left'          => __( 'Left', 'udyama' ),
		'hide'          => __( 'Hide Sidebar', 'udyama' ),
	  )
) );


$wp_customize->add_setting( 'udyama_logo_height', array(
	'default'           => 60,
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'udyama_logo_height', array(
	'label'             => __( 'Enter logo height (in px)', 'udyama' ),
	'type'              => 'number',
	'section'           => 'title_tagline',
	'setting'           => 'udyama_logo_height',
	'priority'          => '9',
) );


$wp_customize->add_setting( 'udyama_content_bg_color', array(
	'default'           => '#ffffff',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_content_bg_color', array(
	'label'             => __( 'Content Background Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_content_bg_color'
) ) );


$wp_customize->add_setting( 'udyama_primary_color', array(
	'default'           => '#007bff',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_primary_color', array(
	'label'             => __( 'Primary Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_primary_color'
) ) );


$wp_customize->add_setting( 'udyama_primary_hover_color', array(
	'default'           => '#0056b3',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_primary_hover_color', array(
	'label'             => __( 'Link Hover Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_primary_hover_color'
) ) );


$wp_customize->add_setting( 'udyama_sec_color', array(
	'default'           => '#595959',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_sec_color', array(
	'label'             => __( 'Secondary Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_sec_color'
) ) );


$wp_customize->add_setting( 'udyama_nav_bg_color', array(
	'default'           => '#f9fbf9',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_nav_bg_color', array(
	'label'             => __( 'Navbar Background Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_nav_bg_color'
) ) );


$wp_customize->add_setting( 'udyama_nav_link_color', array(
	'default'           => '#696969',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_nav_link_color', array(
	'label'             => __( 'Navbar Link Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_nav_link_color'
) ) );


$wp_customize->add_setting( 'udyama_nav_active_link_color', array(
	'default'           => '#292929',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'udyama_nav_active_link_color', array(
	'label'             => __( 'Navbar Active Link Color', 'udyama' ),
	'section'           => 'colors',
	'setting'           => 'udyama_nav_active_link_color'
) ) );


// Add Section
$wp_customize->add_section( 'udyama_upgrade', array(
	'title'             => __( 'Upgrade to Pro', 'udyama' ),
	'priority'          => 999,
) );

$wp_customize->add_setting( 'udyama_upgrade_msg', array(
	'default'           => '',
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'udyama_upgrade_msg', array(
	'label'             => __( 'Take your website to the next level!', 'udyama' ),
	'type'              => 'hidden',
	'section'           => 'udyama_upgrade',
	'setting'           => 'udyama_upgrade_msg',
	'description'       => wp_kses_post( __( '<p>With the premium version, you get more features with a quicker & deeper professional technical support.</p><p>You can improve your website’s speed and performance. Your business website can be further optimized for better search engine ranking.</p> <a href="https://wp-points.com/themes/udyama-pro/" target="_blank" class="button button-primary button-hero">Learn More</a>', 'udyama' ) ),
) );
