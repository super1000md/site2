<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kodiak-football-sport
 */

get_header( '404' ); ?>

<div id="primary" class="error">
	<div class="row">
		<div id="main" class="col-xs-12 middle" role="main">
			<section class="error-404">
				<h3 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'kodiak-football-sport' ); ?></h3>
				<br>
				<p>
					<?php esc_html_e( 'The page you are looking for either doesn&rsquo;t exist or is not here anymore.', 'kodiak-football-sport' ); ?>
					<br>
					<?php esc_html_e( 'Click', 'kodiak-football-sport' ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php esc_attr_e( 'Go to the Home Page', 'kodiak-football-sport' ); ?>">
						<?php esc_html_e( 'here', 'kodiak-football-sport' ); ?>
					</a>
					<?php esc_html_e( 'to go back to the home page.', 'kodiak-football-sport' ); ?>
				</p>
			</section><!-- .error-404 -->
		</div><!-- #main -->
	</div>
</div><!-- #primary -->

<?php
get_footer();
