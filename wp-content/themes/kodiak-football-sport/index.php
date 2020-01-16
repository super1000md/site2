<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

get_header(); ?>
<?php
$kodiak_football_sport_breadcrub = '';
$kodiak_football_sport_sqrcontent = '';

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
		<main id="main" class="site-main " role="main"><!-- #content -->

			<?php
			if ( have_posts() ) :
				if ( is_home() && ! is_front_page() ) :
					?>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				<?php
				endif;
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
						endwhile;
						the_posts_navigation();
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
