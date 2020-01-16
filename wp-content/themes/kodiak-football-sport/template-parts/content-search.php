<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

?>

<article class="item-page" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</div><!-- .entry-header -->
	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="article-inform">
			<div class="details">
				<?php kodiak_football_sport_posted_on(); ?>
			</div>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="articleBody">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<div class="entry-footer">
		<?php kodiak_football_sport_entry_footer(); ?>
	</div><!-- .entry-footer -->
	<hr>
</article><!-- #post-## -->
