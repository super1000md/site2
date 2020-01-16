<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Anther
 */

if ( ! function_exists( 'anther_the_posts_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function anther_the_posts_pagination() {
	// Previous/next posts navigation @since 4.1.0
	the_posts_pagination( array(
		'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Previous Page', 'anther' ) . '</span>',
		'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next Page', 'anther' ) . '</span>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'anther' ) . ' </span>',
	) );
}
endif;

if ( ! function_exists( 'anther_the_post_pagination' ) ) :
/**
 * Previous/next post navigation.
 *
 * @return void
 */
function anther_the_post_pagination() {
	// Previous/next post navigation @since 4.1.0.
	the_post_navigation( array(
		'next_text' => '<span class="meta-nav">' . esc_html__( 'Next', 'anther' ) . '</span> ' . '<span class="post-title">%title</span>',
		'prev_text' => '<span class="meta-nav">' . esc_html__( 'Prev', 'anther' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );
}
endif;

if ( ! function_exists( 'anther_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function anther_posted_on() {
	// No need to display date for sticky posts
	if ( anther_has_sticky_post() ) {
		return;
	}

	// Time String
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// Posted On
	printf( '<span class="posted-on entry-meta-icon"><span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html_x( 'Posted on', 'post date', 'anther' ),
		esc_url( get_permalink() ),
		wp_kses( $time_string, array( 'time' => array( 'class' => array(), 'datetime' => array() ) ) )
	);
}
endif;

if ( ! function_exists( 'anther_posted_by' ) ) :
/**
 * Prints author.
 */
function anther_posted_by() {
	// Global Post
	global $post;

	// We need to get author meta data from both inside/outside the loop.
	$post_author_id = get_post_field( 'post_author', $post->ID );

	// Post Author
	printf( '<span class="byline entry-meta-icon">%1$s <span class="author vcard"><a class="entry-author-link url fn n" href="%2$s" rel="author"><span class="entry-author-name">%3$s</span></a></span></span>',
		/* translators: %s: post author */
		esc_html_x( 'by', 'post author', 'anther' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post_author_id ) ) ),
		esc_html( get_the_author_meta( 'display_name', $post_author_id ) )
	);
}
endif;

if ( ! function_exists( 'anther_sticky_post' ) ) :
/**
 * Prints HTML label for the sticky post.
 */
function anther_sticky_post() {
	// Sticky Post Validation
	if ( ! anther_has_sticky_post() ) {
		return;
	}

	// Sticky Post HTML
	printf( '<span class="post-label post-label-sticky entry-meta-icon">%1$s</span>',
		/* translators: %s: sticky post label */
		esc_html_x( 'Featured', 'sticky post label', 'anther' )
	);
}
endif;

if ( ! function_exists( 'anther_post_edit_link' ) ) :
/**
 * Prints post edit link.
 *
 * @return void
*/
function anther_post_edit_link() {
	// Post edit link Validation
	if ( anther_has_post_edit_link() ) {
		// Post Edit Link
		printf( '<span class="post-edit-link-meta entry-meta-icon"><span class="screen-reader-text">%1$s</span><a class="post-edit-link" href="%2$s">%3$s</a></span>',
			esc_html( get_the_title() ),
			esc_url( get_edit_post_link() ),
			/* translators: %s: post edit link label */
			esc_html_x( 'Edit', 'post edit link label', 'anther' )
		);
	}
}
endif;

if ( ! function_exists( 'anther_post_category' ) ) :
/**
 * Prints category for the current post.
 *
 * @return void
*/
function anther_post_category() {
	// An array of categories to return for the post.
	$categories = get_the_category();

	// Validation
	if ( ! empty( $categories ) && $categories[0] ) {
		// Post Category List
		$category_list = '';
		foreach ( $categories as $category ) {
			$category_list .= sprintf(
				'<a href="%1$s" title="%2$s">%3$s</a>, ',
				esc_url( get_category_link( $category->term_id ) ),
				esc_attr( $category->cat_name ),
				esc_html( $category->cat_name )
			);

			// Bail if display Post First Category Only
			if ( anther_mod( 'anther_content_options_post_first_category' ) ) {
				break;
			}
		}

		// Post Category HTML
		$html = printf(
			'<span class="post-category cat-links entry-meta-icon">%1$s</span>',
			wp_kses_post( rtrim( $category_list, ', ' ) )
		);
	}
}
endif;

if ( ! function_exists( 'anther_read_more_link' ) ) :
	/**
	 * Prints Read More Link.
	 */
	function anther_read_more_link() {
		// Bail Early
		if ( ! anther_has_read_more_label() ) {
			return;
		}

		// Read More Label
		$read_more_label = anther_mod( 'anther_read_more_label' );

		// Read More Link
		printf( '<div class="more-link-wrapper"><a href="%1$s" class="more-link">%2$s</a></div>',
			esc_url( get_permalink() ),
			esc_html( $read_more_label )
		);
	}
endif;

if ( ! function_exists( 'anther_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function anther_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( _x(', ', 'Used between category, there is a space after the comma.', 'anther' ) );
		if ( $categories_list && anther_categorized_blog() ) {
			/* translators: %s: posted in categories */
			printf( '<span class="cat-links cat-links-single">' . esc_html__( 'Posted in %1$s', 'anther' ) . '</span>', wp_kses_post( $categories_list ) );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', _x(', ', 'Used between tag, there is a space after the comma.', 'anther' ) );
		if ( $tags_list ) {
			/* translators: %s: posted in tags */
			printf( '<span class="tags-links tags-links-single">' . esc_html__( 'Tagged %1$s', 'anther' ) . '</span>', wp_kses_post( $tags_list ) );
		}
	}

	/* translators: %s: post title */
	edit_post_link( sprintf( esc_html__( 'Edit %1$s', 'anther' ), '<span class="screen-reader-text">' . the_title_attribute( 'echo=0' ) . '</span>' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function anther_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'anther_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array (
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'anther_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so anther_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so anther_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in anther_categorized_blog.
 */
function anther_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'anther_categories' );
}
add_action( 'edit_category', 'anther_category_transient_flusher' );
add_action( 'save_post',     'anther_category_transient_flusher' );

if ( ! function_exists( 'anther_post_thumbnail_single' ) ) :
	/**
	 * Display an optional post thumbnail for single posts or pages.
	 *
	 * @return void
	*/
	function anther_post_thumbnail_single() {
		// Context Bail
		if (
			is_singular( 'post' ) && ! anther_mod( 'anther_content_options_featured_image_post' ) ||
			is_singular( 'page' ) && ! anther_mod( 'anther_content_options_featured_image_page' )
		) {
			return;
		}

		// Post Thumbnail Validation
		if ( anther_has_post_thumbnail() ) {
			// Post Thumbnail HTML
			printf(
				'<div class="entry-image-wrapper-single"><figure class="post-thumbnail">%1$s</figure></div>',
				get_the_post_thumbnail( null, 'anther-featured-single', array( 'class' => 'img-featured img-responsive' ) )
			);
		}
	}
endif;

if ( ! function_exists( 'anther_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail for archives.
 *
 * @param array $args
 * @return void
*/
function anther_post_thumbnail( $args = array() ) {
	// Let bail
	if ( ! anther_mod( 'anther_content_options_featured_image_archive' ) ) {
		return;
	}

	// Defaults
	$defaults = array (
 		'size'  => 'anther-featured-' . anther_mod( 'anther_featured_image_size' ),
 		'class' => 'entry-image-wrapper',
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Post Thumbnail Validation
	if ( anther_has_post_thumbnail() ) {
		// Post Thumbnail HTML
		printf( '<div class="%1$s"><figure class="post-thumbnail"><a href="%2$s">%3$s</a></figure></div>',
			esc_attr( $args['class'] ),
			esc_url( get_the_permalink() ),
			get_the_post_thumbnail( null, $args['size'], array( 'class' => 'img-featured img-responsive' ) )
		);
	}
}
endif;

/**
 * Display the layout classes.
 *
 * @param string $section - Name of the section to retrieve the classes
 * @return void
 */
function anther_layout_class( $section = 'content' ) {
	// Sidebar Position
	$sidebar_position = anther_mod( 'anther_sidebar_position' );
	if ( ! anther_has_sidebar() ) {
		$sidebar_position = 'no';
	}

	// Layout Skeleton
	$layout_skeleton = array(
		'content' => array(
			'content' => 'col',
		),

		'content-sidebar' => array(
			'content' => 'col-16 col-sm-16 col-md-16 col-lg-11 col-xl-11 col-xxl-11',
			'sidebar' => 'col-16 col-sm-16 col-md-16 col-lg-5 col-xl-5 col-xxl-5',
		),

		'sidebar-content' => array(
			'content' => 'col-16 col-sm-16 col-md-16 col-lg-11 col-xl-11 col-xxl-11 order-lg-2 order-xl-2 order-xxl-2',
			'sidebar' => 'col-16 col-sm-16 col-md-16 col-lg-5 col-xl-5 col-xxl-5 order-lg-1 order-xl-1 order-xxl-1',
		),
	);

	// Layout Classes
	switch( $sidebar_position ) {

		case 'no':
		$layout_classes = $layout_skeleton['content']['content'];
		break;

		case 'left':
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['sidebar-content']['sidebar'] : $layout_skeleton['sidebar-content']['content'];
		break;

		case 'right':
		default:
		$layout_classes = ( 'sidebar' === $section )? $layout_skeleton['content-sidebar']['sidebar'] : $layout_skeleton['content-sidebar']['content'];

	}

	echo esc_attr( $layout_classes );
}
