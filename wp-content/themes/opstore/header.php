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
    <?php 
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }
    $header_layout = get_theme_mod( 'opstore_header_layouts','style1' );
    ?>
    <a class="skip-link screen-reader-text" href="#primary"><?php _e( 'Skip to content', 'opstore' ); ?></a>
    <div id="primary" class="outer-wrap header-<?php echo esc_attr( $header_layout ); ?>">
        <?php 
        do_action( 'opstore_header' );
        ?>

