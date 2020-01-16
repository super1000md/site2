<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

?>
<?php
if ( 'post' === get_post_type() ) {
	$blginfo_class = ' info-details';
} else {
	$blginfo_class = '';
}
?>
<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
<div class="blog sticky">
	<?php else : ?>
		<div class="blog ">
		<?php endif; ?>
		<div class="items-leading">
			<div id="post-<?php the_ID(); ?>" class="item item-<?php the_ID(); ?>">
				<?php kodiak_football_sport_edit_post(); ?>
				<div class="blog-inform<?php echo esc_attr( $blginfo_class ); ?>">
					<?php kodiak_football_sport_post_thumbnail(); ?>
					<?php
					if ( 'post' === get_post_type() ) :
						?>
						<div class="details">
							<dl class="article-info muted">
								<?php kodiak_football_sport_posted_on(); ?>
							</dl>
						</div>
					<?php endif; ?>
				</div>

				<div class="page-header">
					<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
				</div>
				<div class="page-article">
					<?php
					the_content(
						sprintf(
							/* translators: %s: Name of current post. */
							wp_kses( __( 'Read more: %s', 'kodiak-football-sport' ), array( 'span' => array( 'class' => array() ) ) ),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						)
					);
					?>
				</div>
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kodiak-football-sport' ),
						'after'  => '</div>',
					)
				);
				?>

				<?php kodiak_football_sport_entry_footer(); ?>
				<hr>
			</div><!-- #post-## -->
		</div>
	</div>
