<?php
/**
 * Adds Foo_Widget widget.
 */
class Contact_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'contact_widget', // Base ID
			__( 'Contact Card', 'text_domain' ), // Name
			array( 'description' => __( 'A contact card widget, displaying picture, name and email address', 'text_domain' ), ) // Args
		);
	}

	public function setDefaultArgs($args){
		if (!isset($args['before_name']) ){
			$args['before_name']="<span>";
		}
		if (!isset($args['after_name']) ){
			$args['after_name']="</span>";
		}
		if (!isset($args['before_email']) ){
			$args['before_email']="<span>";
		}
		if (!isset($args['after_email']) ){
			$args['after_email']="</span>";
		}
		return $args;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$args = $this->setDefaultArgs($args);

		echo $args['before_widget'];
		

		// output name
		if ( ! empty( $instance['name'] ) ) {
			echo $args['before_name'] . apply_filters( 'widget_name', $instance['name'] ). $args['after_name'];
		}

		// output email
		if ( ! empty( $instance['email'] ) ) {
			echo $args['before_email']; 
			$email = apply_filters( 'widget_email', $instance['email'] );
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			echo $args['after_email'];
		}
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$name = ! empty( $instance['name'] ) ? $instance['name'] : __( 'Name', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>">

		<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';

		return $instance;
	}

} // class Foo_Widget

?>