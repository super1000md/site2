<?php
/**
 * Custom functions to handle the theme fonts
 *
 * @package Anther
 */

/**
 * Register fonts for theme.
 *
 * @return string Fonts URL for the theme.
 */
function anther_fonts_url() {
    // Fonts and Other Variables
    $fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* Translators: If there are characters in your language that are not
    * supported by Roboto, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Roboto font: on or off', 'anther' ) ) {
		$fonts[] = 'Roboto:400,400i,700,700i';
	}

	/* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'anther' ) ) {
		$fonts[] = 'Open Sans:400,400i,700,700i';
	}

	/* Translators: If there are characters in your language that are not
    * supported by Playfair Display, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Playfair Display font: on or off', 'anther' ) ) {
		$fonts[] = 'Playfair Display:400,400i,700,700i';
	}

	/* Translators: If there are characters in your language that are not
    * supported by Oswald, translate this to 'off'. Do not translate
    * into your own language.
    */
    if ( 'off' !== esc_html_x( 'on', 'Oswald font: on or off', 'anther' ) ) {
		$fonts[] = 'Oswald:400,700';
	}

	/* Translators: To add an additional character subset specific to your language,
	* translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'.
	* Do not translate into your own language.
	*/
	$subset = esc_html_x( 'no-subset', 'Add new subset (cyrillic, greek, devanagari, vietnamese)', 'anther' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	/**
	 * Filters the Google Fonts URL.
	 *
	 * @param string $fonts_url Google Fonts URL.
	 */
	return apply_filters( 'anther_fonts_url', $fonts_url );
}
