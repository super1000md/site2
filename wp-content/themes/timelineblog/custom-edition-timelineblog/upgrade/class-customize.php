<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class TimeLineBlog_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->TimeLineBlog_setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function TimeLineBlog_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_stylesheet_directory() ) . 'custom-edition-timelineblog/upgrade/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'TimeLineBlog_Customize_Section_Pro' );

		// doc sections.
		$manager->add_section(
			new TimeLineBlog_Customize_Section_Pro(
				$manager,
				'timelineblog-upgrade',
				array(
					'title'    => esc_html__( 'Get Premium Design', 'timelineblog' ),
					'pro_text' => esc_html__( 'Check Demo', 'timelineblog' ),
					'pro_url'  => 'https://awplife.com/demo/crypto-premium/blog-timeline/',
					'priority'  => 1
				)
			)
		);
	 
		// upgrade sections.
		$manager->add_section(
			new TimeLineBlog_Customize_Section_Pro(
				$manager,
				'upgrade-pro',
				array(
					'title'    => esc_html__( 'Upgrade To Pro', 'timelineblog'),
					'pro_text' => esc_html__( 'View Pro', 'timelineblog'),
					'pro_url'  => 'https://awplife.com/wordpress-themes/crypto-premium/',
					'priority'  => 500
				)
			)
		);
		
		/* // upgrade sections.
		$manager->add_section(
			new TimeLineBlog_Customize_Section_Pro(
				$manager,
				'upgrade-pross',
				array(
					'title'    => esc_html__( 'Other Features', 'timelineblog'),
					'pro_text' => esc_html__( 'View', 'timelineblog'),
					'pro_url'  => '',
					'priority'  => 30
				)
			)
		); */
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'timelineblog-customize-controls-js', trailingslashit( get_stylesheet_directory_uri() ) . '/custom-edition-timelineblog/upgrade/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'timelineblog-customize-controls-css', trailingslashit( get_stylesheet_directory_uri() ) . '/custom-edition-timelineblog/upgrade/customize-controls.css' );
	}
}

// Doing this customizer
TimeLineBlog_Customize::get_instance();