<?php
/**
 * The template for displaying site hero
 *
 * @package Anther
 */
?>

<?php if ( anther_has_site_hero_slot() ) : ?>
<section class="site-hero-slot-wrapper">

	<div class="site-hero-wrapper site-hero-wrapper-single site-hero-wrapper-single-entry-title-content">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="site-hero-content">
						<div class="entry-content-site-hero-wrapper-entry-title-content">
							<div class="entry-content-site-hero-wrapper-inside-entry-title-content">

								<header class="entry-header-site-hero">
									<?php the_title( '<h1 class="entry-title-site-hero">', '</h1>' ); ?>
								</header><!-- .entry-header-site-hero -->

								<?php if ( 'post' === get_post_type() || anther_has_post_edit_link() ) : ?>
								<div class="entry-meta entry-meta-site-hero entry-meta-site-hero-header-after">
									<?php
									if ( 'post' === get_post_type() ) {
										anther_posted_by();
										anther_posted_on();
									}
									anther_post_edit_link();
									?>
								</div><!-- .entry-meta-site-hero -->
								<?php endif; ?>

							</div><!-- .entry-content-site-hero-wrapper-inside -->
						</div><!-- .entry-content-site-hero-wrapper -->
					</div><!-- .site-hero-content -->

				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .site-hero-wrapper -->

</section><!-- .site-hero-slot-wrapper -->
<?php
endif;
