<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Udyama
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area udyama-sidebar col-md-4 <?php if( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'left' ) : echo 'ud-left-sidebar'; endif; ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
