<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class wp_poll_widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
			'wp_poll_widget', 
			__('WP Poll', 'wp_poll'),
			array( 'description' => __( 'Show the poll of Today', 'wp_poll' ), ) 
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		//echo $args['before_widget'];
		//if ( ! empty( $title ) ) echo $args['before_title'] . $title . $args['after_title'];

		echo '[wp_poll_short_code]';
		//echo $args['after_widget'];
		
	}
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];
		else $title = __( 'New title', 'wp_poll' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

	function wpb_load_widget() {
		register_widget( 'wp_poll_widget' );
	}
	add_action( 'widgets_init', 'wpb_load_widget' );