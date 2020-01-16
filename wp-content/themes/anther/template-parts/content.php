<?php
/**
 * The default template for displaying content
 *
 * @package Anther
 */
?>

<div class="post-wrapper-hentry">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-content-wrapper post-content-wrapper-archive">

			<?php anther_post_thumbnail(); ?>

			<div class="entry-header-wrapper">
				<?php if ( 'post' === get_post_type() ) : // For Posts ?>
				<div class="entry-meta entry-meta-header-before">
					<?php
					anther_posted_on();
					anther_post_category();
					anther_sticky_post();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>

				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%1$s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				</header><!-- .entry-header -->
			</div><!-- .entry-header-wrapper -->

			<?php if ( anther_has_excerpt() || anther_has_read_more_label() ) : ?>
			<div class="entry-data-wrapper">
				<?php if ( anther_has_excerpt() ) : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
				<?php endif; ?>

				<?php
				if ( anther_has_read_more_label() ) {
					anther_read_more_link();
				}
				?>
			</div><!-- .entry-data-wrapper -->
			<?php endif; ?>

		</div><!-- .post-content-wrapper -->
	</article><!-- #post-## -->
</div><!-- .post-wrapper-hentry -->
