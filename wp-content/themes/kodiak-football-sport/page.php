<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		$kodiak_football_sport_breadcrub = 'o_crumb';
		?>
		<div class="col-xs-12 col-md-9 middle mright">
			<?php else : ?>
				<div class="col-lg-12 middle">
					<?php
				endif;

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
				<?php } ?>
			</div>
			<div class="midCol midCol-middle">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
					endif;

			endwhile; // End of the loop.
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
