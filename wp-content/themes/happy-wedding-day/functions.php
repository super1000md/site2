<?php

require get_stylesheet_directory() . '/inc/customizer.php';

add_action( 'wp_enqueue_scripts', 'happy_wedding_day_chld_thm_parent_css' );
function happy_wedding_day_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'happy_wedding_day_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );
    
}

/**
* Changed the blog layout to 3 columns
*/
add_filter( 'bizberg_sidebar_settings', 'happy_wedding_day_sidebar_settings' );
function happy_wedding_day_sidebar_settings(){
	return '4';
}

/**
* Change the theme color
*/
add_filter( 'bizberg_theme_color', 'happy_wedding_day_change_theme_color' );
function happy_wedding_day_change_theme_color(){
    return '#f07677';
}

/**
* Change the header menu color hover
*/
add_filter( 'bizberg_header_menu_color_hover', 'happy_wedding_day_header_menu_color_hover' );
function happy_wedding_day_header_menu_color_hover(){
    return '#f07677';
}

/**
* Change the button color of header
*/
add_filter( 'bizberg_header_button_color', 'happy_wedding_day_header_button_color' );
function happy_wedding_day_header_button_color(){
    return '#f07677';
}

/**
* Change the button hover color of header
*/
add_filter( 'bizberg_header_button_color_hover', 'happy_wedding_day_header_button_color_hover' );
function happy_wedding_day_header_button_color_hover(){
    return '#f07677';
}