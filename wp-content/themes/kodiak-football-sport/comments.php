<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kodiak-football-sport
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<hr>
<div id="comments" class="comment-list">

	<?php
	$comments_args = array(
		'title_reply_before'    => '<h3>',
		'title_reply'           => esc_html__( 'Leave a Comment:', 'kodiak-football-sport' ),
		'title_reply_after'     => '</h3>',
		'comment_notes_after'   => ' ',
		'comment_field'         => '<div class="col-xs-12 comment-form-comment form-group"><textarea class="form-control" id="comment" name="comment" aria-required="true"></textarea></div>',
		'class_form'            => 'well',
		'class_submit'          => 'btn btn-default',
		'submit_field'          => '<div class="form-submit text-right">%1$s %2$s</div>',
	);
	comment_form( $comments_args );
	?>

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav class="nav navigation comment-navigation" role="navigation">
			<div class="nav-links">
				<?php
				$prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'kodiak-football-sport' ) );
				if ( $prev_link ) {
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				}

				$next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'kodiak-football-sport' ) );
				if ( $next_link ) {
					printf( '<div class="nav-next">%s</div>', $next_link );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<hr>
	<?php endif; // Check for comment navigation. ?>

	<ul class="col-xs-12 list-unstyled comments ">
		<?php
		wp_list_comments(
			array(
				'style'         => 'ul',
				'short_ping'    => true,
				'avatar_size'   => '70',
				'walker'        => new Kodiak_Football_Sport_Bootstrap_Comment_Walker(),
			)
		);
		?>
	</ul><!-- .comment-list -->
<?php endif; ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'kodiak-football-sport' ); ?></p>
<?php endif; ?>

</div><!-- #comments -->
