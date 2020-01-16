<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lotus
 */

?>

	</div><!-- #content -->


	<footer id="colophon" class="site-footer" role="contentinfo">

		<div id="instagram-footer" class="instagram-footer">

		<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebar-2') ) ?>
		
		</div>


		<div id="footer-widget-area" class="sp-container">
	
		<div class="sp-row">
			
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Position 1') ) ?>

			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Position 2') ) ?>
			
			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Position 3') ) ?>

			<?php	/* Widgetised Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Position 4') ) ?>
			
		</div>
		
		</div>

		<div class="site-info container">
			<p class="footer-text left"><?php printf(esc_html__('Copyright %1$s %2$s %3$s  - All Rights Reserved', 'pokama-lite'), '&copy;', esc_attr(date_i18n(__('Y', 'pokama-lite'))), esc_attr(get_bloginfo())); ?></p>
            <p class="footer-text right"><?php printf(esc_html__('%1$s Designed by %2$s', 'pokama-lite'), '', '<a href="' . esc_url('https://zthemes.net/', 'pokama-lite') . '">ZThemes Studio</a>'); ?></p>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
