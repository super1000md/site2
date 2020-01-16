<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

get_header(); ?>
<?php
$kodiak_football_sport_breadcrub = '';
$kodiak_football_sport_sqrcontent = '';

if ( 'item_2' === get_theme_mod( 'square_content' ) ) {
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
		<?php if ( 'ON' === get_theme_mod( 'breadcrumb' ) ) { ?>
			<div id="crumbs">
				<ul class="breadcrumb">
					<?php kodiak_football_sport_breadcrumb(); ?>
				</ul>
			</div>
		<?php } ?>
	</div>
	<div class="midCol midCol-middle">
		<div id="main" class="blog" role="main">
			<div class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div><!-- .page-header -->
			<div class="items-row">
				<div>
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content-archive', get_post_format() );
						endwhile;
						the_posts_navigation();
					} else {
						get_template_part( 'template-parts/content', 'none' );
					}
					?>
				</div>
			</div>
		</div><!-- #main -->
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
