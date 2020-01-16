<?php
/**
 * Kodiak-hockey-sport functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kodiak-hockey-sport
 */

/**
 * Deregister parent styles and scripts.Enqueue scripts and styles.
 */
function kodiak_hockey_sport_unhook_parent_scripts() {
	wp_dequeue_style( 'background' );
	wp_deregister_style( 'background' );
	wp_dequeue_style( 'backgrounds' );
	wp_deregister_style( 'backgrounds' );
	wp_dequeue_script( 'kodiak-js' );
	wp_deregister_script( 'kodiak-js' );
}
add_action( 'wp_enqueue_scripts', 'kodiak_hockey_sport_unhook_parent_scripts', 20 );

/**
 * Enqueue scripts and styles.
 */
function kodiak_hockey_sport_scripts() {
	wp_enqueue_script( 'hockey-js', get_stylesheet_directory_uri() . '/js/hockey.js', '', ' ', true );
	wp_enqueue_style( 'hockey-background', get_stylesheet_directory_uri() . '/css/background.css', '', ' ' );
	wp_enqueue_style( 'hockey-backgrounds', get_stylesheet_directory_uri() . '/css/backgrounds/ice.css', '', ' ' );
}
add_action( 'wp_enqueue_scripts', 'kodiak_hockey_sport_scripts', 100 );