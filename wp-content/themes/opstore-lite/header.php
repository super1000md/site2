<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package opstore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<?php 
do_action( 'opstore_before_body_output' );
?>
<body <?php body_class(); ?>>
    <a class="skip-link screen-reader-text" href="#primary"><?php _e( 'Skip to content', 'opstore-lite' ); ?></a>
    <?php 
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }

    $meta = get_post_meta(get_the_ID(),'ultra_page_header',true);
    $header_layout = get_post_meta(get_the_ID(),'ultra_page_header',true);
    $template_id = get_post_meta(get_the_ID(),'ultra_page_custom_header',true);
    
    if($header_layout == 'default' || $header_layout == ''){
        $header_layout = get_theme_mod( 'opstore_header_layouts','style1' );
        $template_id = get_theme_mod('opstore_custom_header');
    }
    ?>
    <div id="primary" class="outer-wrap header-<?php echo esc_attr( $header_layout ); ?>">
    <?php 
    if($header_layout != 'hide' ){
        echo '<div class="header-section">';
        if($header_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){
            echo '<div class="opstore-custom-header">';
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
            echo '</div>';
        }else{
            do_action( 'opstore_header' );
        }
        echo '</div>';
    }

