<?php
/**
 * Adds Foo_Widget widget.
 */
class Page_Specific_Content_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'page_specific_content_widget', // Base ID
			__( 'Page Sidebar Content', 'text_domain' ), // Name
			array( 'description' => __( 'A widget displaying sidebar content specified in page content fields.', 'text_domain' ), ) // Args
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
		// get current post
		global $post;

		$sidebar_content = get_field('sidebar_content', $post->ID);
		if ($sidebar_content){
			the_field('sidebar_content');
		}
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