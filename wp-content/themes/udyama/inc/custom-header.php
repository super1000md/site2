<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Udyama
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses udyama_header_style()
 */
function udyama_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'udyama_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '292929',
		'width'                  => 1440,
		'height'                 => 155,
		'flex-height'            => true,
		'wp-head-callback'       => 'udyama_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'udyama_custom_header_setup' );

if ( ! function_exists( 'udyama_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see udyama_custom_header_setup().
	 */
	function udyama_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.site-header .site-title a,
			.site-header .site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
