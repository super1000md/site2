<?php
/**
 * Kodiak football sport Theme Customizer
 *
 * @package Kodiak-football-sport
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kodiak_football_sport_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'kodiak_football_sport_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kodiak_football_sport_customize_preview_js() {
	wp_enqueue_script( 'kodiak_football_sport_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20180109', true );
}
add_action( 'customize_preview_init', 'kodiak_football_sport_customize_preview_js' );
