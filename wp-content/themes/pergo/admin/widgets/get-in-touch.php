<?php
/**
 * Pergo class used to implement a Footer Social icons widget. 
 */
class Pergo_Get_In_Touch extends WP_Widget {	

	public function __construct() {
		$widget_ops = array(
			 'classname' => 'get-in-touch footer-box',
			'description' => __('Display company contact info', 'pergo' )
		);
		parent::__construct( 'get-in-touch', __( 'Pergo Get in Toch', 'pergo' ), $widget_ops );
	}


	public function widget( $args, $instance ) {
		if ( !isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		} //!isset( $args[ 'widget_id' ] )		

		$title = ( !empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$address = ( !empty( $instance[ 'address' ] ) ) ? $instance[ 'address' ] : '';
		$phone = ( !empty( $instance[ 'phone' ] ) ) ? $instance[ 'phone' ] : '';
		$email = ( !empty( $instance[ 'email' ] ) ) ? $instance[ 'email' ] : '';
		

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		

		echo pergo_context_args($args[ 'before_widget' ]);
		echo ( !empty( $title ) ) ? $args[ 'before_title' ] . esc_attr($title) . $args[ 'after_title' ] : '';


		if ( $address != '' ) echo '<p class="p-normal">'.nl2br($address).'</p>';
		
		if( $email != '' ){
			$emailArr = explode(',', $email);
			echo '<p class="foo-email email m-bottom-5">';
			foreach ($emailArr as $key => $value) {
				echo '<a href="mailto:'.$value.'">'.$value.'</a><br>';
			}
			echo '</p>';
		}

		if( $phone != '' ){
			$phoneArr = explode(',', $phone);
			echo '<p>';
			foreach ($phoneArr as $key => $value) {
				echo esc_attr($value).'<br>';
			}
			echo '</p>';
		}
				

		

		echo pergo_context_args($args[ 'after_widget' ]);
	}	

	public function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'address' ]     = sanitize_text_field( $new_instance[ 'address' ] );
		$instance[ 'phone' ]     = sanitize_text_field( $new_instance[ 'phone' ] );
		$instance[ 'email' ]     = sanitize_text_field( $new_instance[ 'email' ] );		

		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : 'Get in Touch';
		$address     = isset( $instance[ 'address' ] ) ? esc_attr( $instance[ 'address' ] ) : '70 W. Madison Street, Ste. 1400 Chicago, IL 60602';
		$phone     = isset( $instance[ 'phone' ] ) ? esc_attr( $instance[ 'phone' ] ) : '(214) 550-0405, (214) 550-5405';
		$email     = isset( $instance[ 'email' ] ) ? esc_attr( $instance[ 'email' ] ) : 'support@pergotheme.net';
		?>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
        	<?php _e( 'Title:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>">
        	<?php _e( 'Address:', 'pergo' ); ?></label>
        	<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>"><?php echo esc_attr($address); ?></textarea>
       </p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>">
        	<?php _e( 'Phone:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /><br><small><?php _e('Multiple phone number is separated bt comma(,)', 'pergo') ?></small></p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'email' )); ?>">
        	<?php _e( 'Email:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" type="text" value="<?php echo esc_attr($email); ?>" /><br><small><?php _e('Multiple email is separated bt comma(,)', 'pergo') ?></small></p>
		<?php
	}
}