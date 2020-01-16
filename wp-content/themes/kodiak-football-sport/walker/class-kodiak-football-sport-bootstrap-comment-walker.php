<?php
/**
 * A custom WordPress comment walker class to implement the Bootstrap 3 Media object in WordPress comment list.
 *
 * @package     WP Bootstrap Comment Walker
 * @version     1.0.0
 * @author      Edi Amin <to.ediamin@gmail.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link        https://github.com/ediamin/wp-bootstrap-comment-walker
 */
class Kodiak_Football_Sport_Bootstrap_Comment_Walker extends Walker_Comment {
	/**
	 * Output a comment in the HTML5 format.
	 *
	 * @access protected
	 * @since 1.0.0
	 *
	 * @see wp_list_comments()
	 *
	 * @param object $comment Comment to display.
	 * @param int    $depth   Depth of comment.
	 * @param array  $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent post-comment' : 'post-comment' ); ?>>

		<?php if ( 0 != $args['avatar_size'] ) : ?>
			<div class="col-md-2 col-sm-2 hidden-xs">
				<figure class="thumbnail">
					<a href="<?php echo get_comment_author_url(); ?>" class="media-object">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
					</a>
					<?php printf( '<figcaption class="text-center">%s</figcaption>', get_comment_author_link() ); ?>
				</figure>
			</div>

		<?php endif; ?>

		<div class="col-md-10 col-sm-10 div-comment" id="div-comment-<?php comment_ID(); ?>">
			<div class="panel panel-default arrow left"><!-- example -->
				<div class="panel-body">
					<div class="comment-user"><i class="fa fa-user"></i> <?php printf( '<span>%s</span>', get_comment_author_link() ); ?></div>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time class="comment-date" datetime="<?php comment_time( 'c' ); ?>">
							<i class="fa fa-clock-o"></i>
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'kodiak-football-sport' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<div class="comment-post">
						<p>
							<?php comment_text(); ?>
						</p>
					</div>

					<p class="text-right">
						<?php edit_comment_link( __( 'Edit', 'kodiak-football-sport' ) ); ?>
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
						?>
					</p>
				</div>
			</div><!-- example -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation label label-info"><?php _e( 'Your comment is awaiting moderation.', 'kodiak-football-sport' ); ?></p>
			<?php endif; ?>
		</div>
		<?php
	}
}

/**
* Replace link classes
*/
add_filter( 'comment_reply_link', 'kodiak_football_sport_replace_reply_link_class' );
function kodiak_football_sport_replace_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='reply btn btn-default btn-sm", $class );
	return $class;
}

function kodiak_football_sport_add_edit_comment_link( $output ) {
	$class = 'edit btn btn-default btn-sm';
	return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $class, $output, 1 );
}
add_filter( 'edit_comment_link', 'kodiak_football_sport_add_edit_comment_link' );
