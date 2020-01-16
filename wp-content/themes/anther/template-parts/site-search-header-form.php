<?php
/**
 * The template for displaying site search form
 * @package Anther
 */

if ( anther_mod( 'anther_header_search' ) ) :
?>
<div class="site-search-header-form-wrapper">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="site-search-header-form-wrapper-inside">
					<?php get_search_form(); ?>
				</div>
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .site-search-header-form-wrapper -->
<?php
endif;
