<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Udyama
 */

get_header();
?>

	<div class="container">
		<div class="row justify-content-center">

			<?php
				if ( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'left' ) {
					get_sidebar();
				}
			?>

			<div id="primary" class="content-area col-md-8 <?php if( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'left' ) : echo 'order-first order-md-last'; endif; ?>">
				<main id="main" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation( array(
						'next_text' => '<span class="be-post-nav-label btn btn-sm btn-outline-primary">' . esc_html__( 'Next', 'udyama' ) . '<span class="dashicons dashicons-arrow-right"></span></span>',
						'prev_text' => '<span class="be-post-nav-label btn btn-sm btn-outline-primary"><span class="dashicons dashicons-arrow-left"></span>' . esc_html__( 'Previous', 'udyama' ) . '</span>',
					) );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php
				if ( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'right' ) {
					get_sidebar();
				}
			?>

		</div>
	</div>

<?php
get_footer();
