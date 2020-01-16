<?php
/**
 * Implementation of the Custom Widget - Contact Widget
 */



function udyama_load_contact_widget() {
	register_widget( 'udyama_contact_widget' );
}
add_action( 'widgets_init', 'udyama_load_contact_widget' );



/**
* Class for widget
*/
class Udyama_Contact_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'Udyama_Contact_Widget',
			'description' => esc_html__( 'A widget to contact info in header.', 'udyama' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 250,
			'height'  => 350,
			'id_base' => 'udyama_contact_widget',
		);

		/* Create the widget. */
		parent::__construct( 'udyama_contact_widget', esc_html__( '* Udyama - Contact Info', 'udyama' ), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {

		$before_widget  = $args['before_widget'];
		$after_widget   = $args['after_widget'];

		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );

		if( $instance ) {
			$contact_number = $instance['contact_number'];
			$contact_email  = $instance['contact_email'];
			?>

			<div class="udyama-contact-widget text-left">
				<span class="dashicons dashicons-format-chat"></span>
				<div>
					<span class="contact-number"><?php echo esc_html( $contact_number ); ?></span>
					<span class="contact-email"><?php echo esc_html( $contact_email ); ?></span>
				</div>
			</div>
		<?php
		}

		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['contact_number'] = strip_tags( $new_instance['contact_number'] );
		$instance['contact_email']  = strip_tags( $new_instance['contact_email'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'contact_number' => '',
			'contact_email'  => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'contact_number' ) ); ?>"><?php esc_html_e( 'Contact Number', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'contact_number' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'contact_number' ) ); ?>" value="<?php echo esc_html( $instance['contact_number'] ); ?>" style="width:96%;" /><br />
			<small><?php esc_html_e( 'Enter text for your contact number.', 'udyama' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'contact_email' ) ); ?>"><?php esc_html_e( 'Contact Email', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'contact_email' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'contact_email' ) ); ?>" value="<?php echo esc_html( $instance['contact_email'] ); ?>" style="width:96%;" /><br />
			<small><?php esc_html_e( 'Enter text for your contact email.', 'udyama' ); ?></small>
		</p>

	<?php
	}
}

?>
