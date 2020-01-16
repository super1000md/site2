<?php
/**
 * Implementation of the Custom Widget - Contact Widget
 */



function udyama_load_address_widget() {
	register_widget( 'udyama_address_widget' );
}
add_action( 'widgets_init', 'udyama_load_address_widget' );



/**
* Class for widget
*/
class Udyama_Address_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'Udyama_Address_Widget',
			'description' => esc_html__( 'A widget to address info in header.', 'udyama' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width' => 250,
			'height' => 350,
			'id_base' => 'udyama_address_widget',
		);

		/* Create the widget. */
		parent::__construct( 'udyama_address_widget', esc_html__( '* Udyama - Address Info', 'udyama' ), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {

		$before_widget = $args['before_widget'];
		$after_widget  = $args['after_widget'];

		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );

		if( $instance ) {
			$addr_line_1 = $instance['addr_line_1'];
			$addr_line_2 = $instance['addr_line_2'];
			?>

			<div class="udyama-contact-widget text-left">
				<span class="dashicons dashicons-location"></span>
				<div>
					<span class="contact-number"><?php echo esc_html( $addr_line_1 ); ?></span>
					<span class="contact-email"><?php echo esc_html( $addr_line_2 ); ?></span>
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

		$instance['addr_line_1'] = strip_tags( $new_instance['addr_line_1'] );
		$instance['addr_line_2'] = strip_tags( $new_instance['addr_line_2'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'addr_line_1' => '',
			'addr_line_2' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'addr_line_1' ) ); ?>"><?php esc_html_e( 'Address Line 1', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'addr_line_1' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'addr_line_1' ) ); ?>" value="<?php echo esc_html( $instance['addr_line_1'] ); ?>" style="width:96%;" /><br />
			<small><?php esc_html_e( 'Enter text for line 1 of address.', 'udyama' ); ?></small>
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'addr_line_2' ) ); ?>"><?php esc_html_e( 'Address Line 2', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'addr_line_2' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'addr_line_2' ) ); ?>" value="<?php echo esc_html( $instance['addr_line_2'] ); ?>" style="width:96%;" /><br />
			<small><?php esc_html_e( 'Enter text for line 2 of address.', 'udyama' ); ?></small>
		</p>

	<?php
	}
}

?>
