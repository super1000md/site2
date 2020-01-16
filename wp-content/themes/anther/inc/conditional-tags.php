<?php
/**
 * Conditional Tags
 *
 * @package Anther
 */

 /**
 * A helper conditional function.
 * Whether there is a post thumbnail and post is not password protected.
 *
 * @return bool
 */
function anther_has_post_thumbnail() {

	/**
	 * Post Thumbnail Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_post_thumbnail', (bool) ( ! post_password_required() && has_post_thumbnail() ) );

}

/**
 * A helper conditional function.
 * Post is Sticky or Not
 *
 * @return bool
 */
function anther_has_sticky_post() {

	/**
	 * Sticky Post Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_sticky_post', (bool) ( is_sticky() && is_home() && ! is_paged() ) );

}

/**
 * A helper conditional function.
 * Post has Edit link or Not
 *
 * @return bool
 */
function anther_has_post_edit_link() {

	/**
	 * Post Edit Link Filter
	 * @return bool
	 */
	$post_edit_link = get_edit_post_link();
	return apply_filters( 'anther_has_post_edit_link', (bool) ( ! empty( $post_edit_link ) ) );

}

/**
 * A helper conditional function.
 * Theme has Excerpt or Not
 *
 * @return bool
 */
function anther_has_excerpt() {

	// Post Excerpt
	$post_excerpt = get_the_excerpt();

	// Custom Excerpt Length
	$excerpt_length = anther_mod( 'anther_excerpt_length' );

	/**
	 * Excerpt Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_excerpt', (bool) $excerpt_length >= 1 && ! empty ( $post_excerpt ) );

}

/**
 * A helper conditional function.
 * Theme has Read More Label or Not
 *
 * @return bool
 */
function anther_has_read_more_label() {

	// Read More Label
	$read_more_label = anther_mod( 'anther_read_more_label' );

	/**
	 * Read More Label Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_read_more_label', (bool) ! empty ( $read_more_label ) );

}

/**
 * A helper conditional function.
 * Theme has Sidebar or Not
 *
 * @return bool
 */
function anther_has_sidebar() {

	/**
	 * Sidebar Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_sidebar', (bool) is_active_sidebar( 'sidebar-1' ) );

}

/**
 * A helper conditional function.
 * Theme has Front Page or Not
 *
 * @see https://developer.wordpress.org/reference/functions/is_home/
 * @return bool
 */
function anther_has_front_page() {

	/**
	 * Featured Content Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_front_page', (bool) ( is_front_page() || is_home() ) );

}

/**
 * A helper conditional function.
 * Theme has Site Hero slot or Not
 *
 * @return bool
 */
function anther_has_site_hero_slot() {

	/**
	 * Site Hero Slot Filter
	 * @return bool
	 */
	return apply_filters( 'anther_has_site_hero_slot', (bool) ( is_singular() && ! is_attachment() && ! anther_has_front_page() ) );

}
