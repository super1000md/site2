<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Anther
 */
?>

<div class="post-wrapper-hentry">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-content-wrapper post-content-wrapper-single post-content-wrapper-single-page">

			<?php anther_post_thumbnail_single(); ?>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'anther' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->

			<?php if ( anther_has_post_edit_link() ) : ?>
			<footer class="entry-meta entry-meta-footer">
				<?php anther_entry_footer(); ?>
			</footer><!-- .entry-meta -->
			<?php endif; ?>

		</div><!-- .post-content-wrapper -->
	</article><!-- #post-## -->
</div><!-- .post-wrapper-hentry -->
