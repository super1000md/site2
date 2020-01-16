<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if ( !function_exists( 'opstore_lite_enqueue_scripts' ) ):
    function opstore_lite_enqueue_scripts() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'opstore-preloaders','linearicons','font-awesome','bootstrap','slick','slick-theme' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'opstore_lite_enqueue_scripts', 10 );

/* Include Files */
require get_stylesheet_directory().'/inc/opstore-lite-functions.php';
require get_stylesheet_directory().'/inc/opstore-lite-customizer.php';


