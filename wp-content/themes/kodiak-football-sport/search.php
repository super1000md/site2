<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Kodiak-football-sport
 */

get_header();

$kodiak_football_sport_breadcrub = '';
$kodiak_football_sport_sqrcontent = '';
?>


<?php
if ( get_theme_mod( 'square_content' ) == 'item_2' ) {
	$kodiak_football_sport_sqrcontent = 'square';
}
?>
<div class="row">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$kodiak_football_sport_breadcrub = 'o_crumb';
		echo '<div class="col-xs-12 col-md-9 middle mright">';
	} else {
		echo '<div class="col-lg-12 middle">';
	}

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		dynamic_sidebar( 'sidebar-2' );
	}
	?>
	<div class="col-xs-12 midCol_bcg <?php echo esc_attr( $kodiak_football_sport_sqrcontent ); ?> <?php echo esc_attr( $kodiak_football_sport_breadcrub ); ?>">
		<?php if ( get_theme_mod( 'breadcrumb' ) == 'ON' ) { ?>
			<div id="crumbs">
				<ul class="breadcrumb">
					<?php kodiak_football_sport_breadcrumb(); ?>
				</ul>
			</div>
			<?php
		}
		?>
	</div>
	<div class="midCol midCol-middle">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'kodiak-football-sport' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</div><!-- .page-header -->

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
						?>

						<?php if ( get_the_posts_navigation() ) : ?>
							<nav class="nav navigation posts-navigation" role="navigation">
								<div class="nav-links">
									<?php
									$prev_link = get_previous_posts_link( esc_html__( 'Older posts', 'kodiak-football-sport' ) );
									if ( $prev_link ) :
										printf( '<div class="nav-previous">%s</div>', $prev_link );
									endif;

									$next_link = get_next_posts_link( esc_html__( 'Newer posts', 'kodiak-football-sport' ) );
									if ( $next_link ) :
										printf( '<div class="nav-next">%s</div>', $next_link );
									endif;
									?>
								</div>
							</nav>
						<?php endif; ?>

						<?php 
					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</main><!-- #main -->
			</div>
			<?php
			if ( is_active_sidebar( 'sidebar-3' ) ) {
				dynamic_sidebar( 'sidebar-3' );
			}
			?>
		</div>
		<?php get_sidebar(); ?>
		<?php
		get_footer();
