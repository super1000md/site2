<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
	<div class="col-xs-12 midCol_bcg <?php echo esc_attr( $kodiak_football_sport_sqrcontent ); ?> <?php echo esc_attr( $kodiak_football_sport_breadcrub );?>">
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
	<div class="midCol midCol-middle single">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_format() );

						// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
			endif;

						// Previous/next post navigation.
			the_post_navigation(
				array(
					'next_text' => '<span class="post-title">%title</span><span class="meta-nav" aria-hidden="true"><i class="fa fa-long-arrow-right fa-lg" aria-hidden="true"></i></span>',
					'prev_text' => '<span class="post-title">%title</span><span class="meta-nav" aria-hidden="true"><i class="fa fa-long-arrow-left fa-lg" aria-hidden="true"></i></span>',
					'screen_reader_text' => ' ',
				)
			);

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
