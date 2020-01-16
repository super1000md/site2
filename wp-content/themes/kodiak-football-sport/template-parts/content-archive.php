<?php
/**
 * Template part for displaying results in archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

?>
<div id="post-<?php the_ID(); ?>" class="archive-item item item-<?php the_ID(); ?>">
	<?php kodiak_football_sport_edit_post(); ?>

	<div class="blog-inform">
		<?php kodiak_football_sport_post_thumbnail(); ?>
	</div>

	<div>
		<?php
		if ( 'post' === get_post_type() ) : 
			?>
			<div class="details">
				<dl class="article-info muted">
					<?php kodiak_football_sport_posted_on(); ?>
				</dl>
			</div>
		<?php endif; ?>
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

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kodiak-football-sport' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
		<?php kodiak_football_sport_entry_footer(); ?>
	</div>
	<hr>
</div><!-- #post-## -->
