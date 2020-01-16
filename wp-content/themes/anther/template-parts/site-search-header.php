<?php
/**
 * The template for displaying site search control
 * @package Anther
 */

if ( anther_mod( 'anther_header_search' ) ) :
?>
<div class="site-search-header-wrapper">
	<a href="#" title="<?php esc_attr_e( 'Search', 'anther' ); ?>" class="toggle-site-search-header-control">
		<span><?php esc_html_e( 'Search', 'anther' ); ?></span>
	</a>
</div><!-- .site-search-header-wrapper -->
<?php
endif;
