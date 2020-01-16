<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Udyama
 */

get_header();
?>

	<header class="page-header archive-page-header">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'udyama' ); ?></h1>
				</div>
			</div>
		</div>
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main">

					<section class="error-404 not-found">

						<div class="page-content">

							<div class="text-center">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'udyama' ); ?></p>

								<?php
								get_search_form();
								?>
							</div>

							<div class="row mt-4">
								<div class="col-md-4">
									<?php
									the_widget( 'WP_Widget_Recent_Posts', array(), array(
										'before_title' => '<h5 class="widget-title mt-4">',
										'after_title'  => '</h5>',
									) );
									?>
								</div>

								<div class="col-md-4">
									<div class="widget widget_categories">
										<h5 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'udyama' ); ?></h5>
										<ul>
											<?php
											wp_list_categories( array(
												'orderby'    => 'count',
												'order'      => 'DESC',
												'show_count' => 1,
												'title_li'   => '',
												'number'     => 10,
											) );
											?>
										</ul>
									</div>
								</div>

								<div class="col-md-4">
									<?php
									the_widget( 'WP_Widget_Tag_Cloud', array(), array(
										'before_title' => '<h5 class="widget-title">',
										'after_title'  => '</h5>',
									) );
									?>
								</div>
							</div>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>

<?php
get_footer();
