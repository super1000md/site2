<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Udyama
 */

?>
<!doctype html>
<?php udyama_html_before(); ?>
<html <?php language_attributes(); ?>>
	<head>
		<?php udyama_head_top(); ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php udyama_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php udyama_body_top(); ?>

		<div id="page" class="site page-wrapper <?php if( get_theme_mod( 'udyama_boxed_site', true ) ) : echo "boxed-wrapper"; endif; ?>">

			<?php udyama_header_before(); ?>
			<?php udyama_header(); ?>
			<?php udyama_header_after(); ?>

			<div id="content" class="site-content">
