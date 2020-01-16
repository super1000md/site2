<?php
/**
 * Implementation of the Custom Widget
 */



function udyama_load_button_widget() {
	register_widget( 'udyama_button_widget' );
}
add_action( 'widgets_init', 'udyama_load_button_widget' );



/**
* Class for widget
*/
class Udyama_Button_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'Udyama_Button_Widget',
			'description' => esc_html__( 'A widget for a CTA button.', 'udyama' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 250,
			'height'  => 350,
			'id_base' => 'udyama_button_widget',
		);

		/* Create the widget. */
		parent::__construct( 'udyama_button_widget', esc_html__( '* Udyama - Button', 'udyama' ), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {

		$before_widget = $args['before_widget'];
		$after_widget  = $args['after_widget'];

		$before_title  = $args['before_title'];
		$after_title   = $args['after_title'];

		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );

		if( $instance ) {
			$button_text = $instance['button_text'];
			$button_link = $instance['button_link'];
			?>

			<div class="udyama-button-widget d-flex ">
				<a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary"><?php echo esc_html( $button_text ); ?></a>
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

		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'button_text' => '',
			'button_link' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e( 'Button Text', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'button_text' ) ); ?>" value="<?php echo esc_html( $instance['button_text'] ); ?>" style="width:96%;" /><br />
		</p>

		<p>
			<label for="<?php echo esc_html( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_html_e( 'Button Link', 'udyama' ); ?>:</label>
			<input id="<?php echo esc_html( $this->get_field_id( 'button_link' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'button_link' ) ); ?>" value="<?php echo esc_html( $instance['button_link'] ); ?>" style="width:96%;" /><br />
		</p>

	<?php
	}
}

?>
