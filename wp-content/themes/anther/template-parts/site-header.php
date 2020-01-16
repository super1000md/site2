<?php
/**
 * The template for displaying site header
 * @package Anther
 */
?>

<header id="masthead" class="site-header">
	<div class="container">
		<div class="row">
			<div class="col">

				<div class="site-header-inside-wrapper">
					<?php
					// Site Branding
					get_template_part( 'template-parts/site-branding' );

					// Site Navigation
					get_template_part( 'template-parts/site-navigation' );

					// Site Search Header
					get_template_part( 'template-parts/site-search-header' );
					?>
				</div><!-- .site-header-inside-wrapper -->

			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->

	<?php
	// Site Search Header Form
	get_template_part( 'template-parts/site-search-header-form' );
	?>
</header><!-- #masthead -->
