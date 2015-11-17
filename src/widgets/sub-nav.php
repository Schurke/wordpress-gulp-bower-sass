<?php
/**
 * Adds Foo_Widget widget.
 */
class Sub_Nav_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sub_nav_widget', // Base ID
			__( 'Subnav Widget', 'text_domain' ), // Name
			array( 'description' => __( 'A widget displaying subnav for this section.', 'text_domain' ), ) // Args
		);
	}

	public function setDefaultArgs($args){
		
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

		// output
		wp_nav_menu( array(
			'menu_id'			=> 'header_sub_nav',
			'menu'              => 'header',
			'theme_location'    => 'header',
			'depth'             => 4,
			'container'         => 'div',
			'container_class'   => 'header_sub_nav',
			'container_id'      => '',
			'menu_class'        => '',
			'walker'            => new sub_nav_walker())
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
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
		
		return $new_instance;
	}

} // class Foo_Widget

?>