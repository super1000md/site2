<?php
/**
 * Customizer Controls
 *
 * @package Anther
 */

/**
 * Theme Mod Defaults
 *
 * @param string $theme_mod - Theme modification name.
 * @return mixed
 */
function anther_default( $theme_mod = '' ) {

	$default = array (
		'anther_featured_image_size'                    => 'landscape',
		'anther_read_more_label'                        => esc_html_x( 'Read More', 'Read More Label', 'anther' ),
		'anther_excerpt_length'                         => 25,
		'anther_header_search'                          => true,
		'anther_theme_layout'                           => 'wide',
		'anther_sidebar_position'                       => 'right',
		'anther_content_options_author_bio'             => true,
		'anther_content_options_post_date'              => true,
		'anther_content_options_post_categories'        => true,
		'anther_content_options_post_tags'              => true,
		'anther_content_options_post_author'            => true,
		'anther_content_options_featured_image_archive' => true,
		'anther_content_options_featured_image_post'    => true,
		'anther_content_options_featured_image_page'    => true,
		'anther_content_options_archive_title_label'    => false,
		'anther_content_options_post_first_category'    => true,
		'anther_copyright'                              => sprintf( '%1$s %2$s - <a href="%3$s">%4$s</a>', esc_html__( '&copy; Copyright', 'anther' ), esc_html( date_i18n( __( 'Y', 'anther' ) ) ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) ),
		'anther_credit'                                 => true,
	);

	return ( isset ( $default[$theme_mod] ) ? $default[$theme_mod] : '' );
}

/**
 * Theme Mod Wrapper
 *
 * @param string $theme_mod - Name of the theme mod to retrieve.
 * @return mixed
 */
function anther_mod( $theme_mod = '' ) {
	return get_theme_mod( $theme_mod, anther_default( $theme_mod ) );
}

/**
 * New Control Type: Heading
 * @see wp-includes/class-wp-customize-control.php
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Anther_Heading_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'anther-heading';

		/**
		 * Label for the control.
		 */
		public $label = '';

		/**
		 * Description for the control.
		 */
		public $description = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
		<?php
		}
	}
}

/**
 * New Control Type: Button
 * @see wp-includes/class-wp-customize-control.php
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Anther_Button_Control extends WP_Customize_Control {
		/**
		 * @access public
		 * @var string
		 */
		public $type = 'anther-button';

		/**
		 * HTML tag to render button object.
		 *
		 * @var  string
		 */
		protected $button_tag = 'button';

		/**
		 * Class to render button object.
		 *
		 * @var  string
		 */
		protected $button_class = 'button button-primary';

		/**
		 * Link for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_href = 'javascript:void(0)';

		/**
		 * Target for <a> based button.
		 *
		 * @var  string
		 */
		protected $button_target = '';

		/**
		 * Click event handler.
		 *
		 * @var  string
		 */
		protected $button_onclick = '';

		/**
		 * ID attribute for HTML tab.
		 *
		 * @var  string
		 */
		protected $button_tag_id = '';

		/**
		 * Render the control's content.
		 */
		public function render_content() {
		?>
			<span class="center">
				<?php
				// Print open tag
				echo '<' . $this->button_tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				// button class
				if ( ! empty( $this->button_class ) ) {
					echo ' class="' . esc_attr( $this->button_class ) . '"';
				}

				// button or href
				if ( 'button' == $this->button_tag ) {
					echo ' type="button"';
				} else {
					echo ' href="' . esc_url( $this->button_href ) . '"' . ( empty( $this->button_tag ) ? '' : ' target="' . esc_attr( $this->button_target ) . '"' );
				}

				// onClick Event
				if ( ! empty( $this->button_onclick ) ) {
					echo ' onclick="' . esc_js( $this->button_onclick ) . '"';
				}

				// ID
				if ( ! empty( $this->button_tag_id ) ) {
					echo ' id="' . esc_attr( $this->button_tag_id ) . '"';
				}

				echo '>';

				// Print text inside tag
				echo esc_html( $this->label );

				// Print close tag
				echo '</' . $this->button_tag . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</span>
		<?php
		}
	}
}

/**
 * Sanitize Select.
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function anther_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize the checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function anther_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize Unfiltered HTML.
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function anther_sanitize_unfiltered_html( $html ) {
	return ( current_user_can( 'unfiltered_html' ) ? $html : wp_kses_post( $html ) );
}
