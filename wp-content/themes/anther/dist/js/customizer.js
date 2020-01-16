/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site Title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site Description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Background Color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
				$( '.site-description' ).css( {
					opacity: 0.7,
				} );
			}
		} );
	} );

	// Date Control
	wp.customize( 'anther_content_options_post_date', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.posted-on' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.posted-on' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		} );
	} );

	// Category Control
	wp.customize( 'anther_content_options_post_categories', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.cat-links' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.cat-links' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		} );
	} );

	// Tag Control
	wp.customize( 'anther_content_options_post_tags', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.tags-links' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.tags-links' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		} );
	} );

	// Author Control
	wp.customize( 'anther_content_options_post_author', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.byline' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.byline' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		} );
	} );

	// Copyright Control
	wp.customize( 'anther_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.credits-blog' ).html( to );
		} );
	} );

	// Credit Control
	wp.customize( 'anther_credit', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.credits-designer' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.credits-designer' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		} );
	} );
}( jQuery ) );
