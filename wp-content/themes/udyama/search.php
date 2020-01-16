<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Udyama
 */

get_header();
?>

	<header class="page-header archive-page-header">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'udyama' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</div>
			</div>
		</div>
	</header><!-- .page-header -->

	<div class="container">
		<div class="row justify-content-center">

			<?php
				if ( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'left' ) {
					get_sidebar();
				}
			?>

			<section id="primary" class="content-area col-md-8 <?php if( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'left' ) : echo 'order-first order-md-last'; endif; ?>">
				<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
			</section><!-- #primary -->

			<?php
				if ( get_theme_mod( 'udyama_sidebar_position', 'right' ) === 'right' ) {
					get_sidebar();
				}
			?>

		</div>
	</div>

<?php
get_footer();
