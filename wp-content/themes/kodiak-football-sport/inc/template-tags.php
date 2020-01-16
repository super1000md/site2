<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Kodiak-football-sport
 */
function kodiak_football_sport_post_commets() {
	global $post;
	echo '<dd class="comments"><i class="fa fa-comment fa-lg" aria-hidden="true"></i>' . $post->comment_count . '</dd>';
}

function kodiak_football_sport_edit_post() {
	edit_post_link(
		sprintf(
			/* %s: Name of current post */
			wp_strip_all_tags( '%s' ),
			the_title( '<i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="screen-reader-text">"', '"</span>', false )
		),
		'<div class="print-email"><ul class="actions"><li>',
		'</li></ul></div>'
	);
}

if ( ! function_exists( 'kodiak_football_sport_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function kodiak_football_sport_posted_on() {

		$time_string = '<dd class="published"><i class="fa fa-calendar-check-o fa-lg" aria-hidden="true"></i><time class="entry-date published" datetime="%1$s">%2$s</time></dd>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<dd class="published"><i class="fa fa-calendar-check-o fa-lg" aria-hidden="true"></i><time class="entry-date published" datetime="%1$s">%2$s</time></dd><dd class="modified"><i class="fa fa-clock-o fa-lg" aria-hidden="true"></i><time class="updated" datetime="%3$s">%4$s</time></dd>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf('' . $time_string . '');

		$byline = sprintf(
			'<dd class="createdby"><i class="fa fa-user fa-lg" aria-hidden="true"></i><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></dd>'
		);

		echo '<div class="info info-1">' . $byline, kodiak_football_sport_post_commets() . '</div><div class="info info-2">' . $posted_on . '</div>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'kodiak_football_sport_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 */
	function kodiak_football_sport_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'kodiak-football-sport' ) );
			if ( $categories_list && kodiak_football_sport_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'kodiak-football-sport' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'kodiak-football-sport' ) );
			if ( $tags_list ) {
				printf( '<div class="clearfix"></div><div class="tags-block"><p class="tags">More about:</p><div class="tags">%1$s</div></div>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function kodiak_football_sport_categorized_blog() {
	$all_the_cool_cats = get_transient( 'kodiak_football_sport_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'kodiak_football_sport_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so kodiak_football_sport_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so kodiak_football_sport_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in kodiak_football_sport_categorized_blog.
 */
function kodiak_football_sport_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'kodiak_football_sport_categories' );
}
add_action( 'edit_category', 'kodiak_football_sport_category_transient_flusher' );
add_action( 'save_post', 'kodiak_football_sport_category_transient_flusher' );


if ( ! function_exists( 'kodiak_football_sport_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 */
	function kodiak_football_sport_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="pull-none item-image">
				<?php the_post_thumbnail(); ?>
			</div><!-- post-thumbnail -->

			<?php else : ?>

				<div class="pull-none item-image">
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
						<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
					</a>
				</div>

				<?php
	endif; // End is_singular().
	}
endif;
