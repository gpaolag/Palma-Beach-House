<?php

if(class_exists('es_cls_widget')){
	class Pergo_es_cls_widget extends es_cls_widget{
		public static function load_subscription($arr){
			extract($arr);
			$url = "'" . home_url() . "'";
			$output = "";			

			global $es_includes;
			if (!isset($es_includes) || $es_includes !== true) { 
				$es_includes = true;
			}

			$btnclass = isset($widget)? 'btn ' : '';
			$msgclass = isset($widget)? 'm-bottom-10 text-left' : '';

			$output .= '<div class="input-group"><input class="form-control es_textbox_class" placeholder="'.esc_attr($placeholder).'" type="email" name="es_txt_email_pg" id="es_txt_email_pg" required>
				      <input type="hidden" name="es_txt_name_pg">
				      	<span class="input-group-btn"><button  type="submit" id="es_txt_button_pg" class="'.$btnclass.'es_textbox_button es_submit_button btn"><i class="'.esc_attr($button_text).'"></i></button></span></div>';
				      	$nonce = wp_create_nonce( 'es-subscribe' );
				   $output .=  '<input type="hidden" name="es-subscribe" id="es-subscribe" value="'.$nonce.'"/><input type="hidden" name="es_hp_'.wp_create_nonce('es_hp').'" class="es_required_field" tabindex="-1" autocomplete="off"/><input name="es_txt_group_pg" id="es_txt_group_pg" value="'.$group.'" type="hidden">';
			$output .=  '<input name="es_txt_group_pg" id="es_txt_group_pg" value="'.$group.'" type="hidden">';
			$output .=  '<label class="form-notification"></label><div class="es_msg"><span id="es_msg_pg" class="'.$msgclass.'form-notification"></span></div>';

			return $output;
		}
	}//end Pergo_es_cls_widget


	function pergo_es_subbox( $args= array()){
		echo Pergo_es_cls_widget::load_subscription($args);
	}//pergo_es_subbox
}
/**
 * Pergo class used to implement a Footer Instafeed Carouel widget. 
 */
class Pergo_Footer_Subscription_Form extends WP_Widget {	

	public function __construct() {
		$widget_ops = array(
			 'classname' => 'newsletter-widget footer-form m-bottom-20',
			'description' => '' 
		);
		parent::__construct( 'footer-subscription-form', __( 'Pergo Newsletter form', 'pergo' ), $widget_ops );
	}


	public function widget( $args, $instance ) {
		if ( !isset( $args[ 'widget_id' ] ) ) {
			$args[ 'widget_id' ] = $this->id;
		} //!isset( $args[ 'widget_id' ] )
		

		$title = ( !empty( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
		$desc     = isset( $instance[ 'desc' ] ) ? esc_attr( $instance[ 'desc' ] ) : '';
		$button_text     = isset( $instance[ 'button_text' ] ) ? esc_attr( $instance[ 'button_text' ] ) : 'far fa-envelope';
		$placeholder = ( !empty( $instance['placeholder'] ) ) ? $instance[ 'placeholder' ] : __('Email Address', 'pergo');
		$group = ( !empty( $instance[ 'group' ] ) ) ? $instance[ 'group' ] : '';		

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		echo pergo_context_args($args[ 'before_widget' ]);
		echo ( !empty( $title ) ) ? $args[ 'before_title' ] . esc_attr($title) . $args[ 'after_title' ] : '';

		if( $desc != '' ){
			echo '<p class="m-bottom-20">'.nl2br($desc).'</p>';
		}
		
		?>

			<form class="newsletter-form es_shortcode_form" data-es_form_id="es_shortcode_form">
				<?php 				
					if(function_exists('pergo_es_subbox')){
						$args = array();
						$args['placeholder'] = esc_attr($placeholder);
						$args['button_text'] = esc_attr($button_text);
						$args['group'] = esc_attr($group);
						$args['widget'] = true;
						pergo_es_subbox( $args );
					}else{
						echo 'Please Install Theme Required & Recommended PLugins.';
					}
				?>
				</form>		
		<?php	
	}	

	public function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'desc' ]    =  $new_instance[ 'desc' ];
		$instance[ 'button_text' ]    =  $new_instance[ 'button_text' ];
		$instance[ 'placeholder' ]     = $new_instance[ 'placeholder' ];
		$instance[ 'group' ]    =  $new_instance[ 'group' ];		
		return $instance;
	}



	public function form( $instance ) {
		$title     = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : 'Subscribe Us:';
		$button_text     = isset( $instance[ 'button_text' ] ) ? esc_attr( $instance[ 'button_text' ] ) : 'far fa-envelope';
		$desc     = isset( $instance[ 'desc' ] ) ? $instance[ 'desc' ] : 'We don’t share your personal information with anyone. Check out our Privacy Policy for more information ';
		$placeholder = ( !empty( $instance[ 'placeholder' ] ) ) ? $instance[ 'placeholder' ] : 'Email Address';
		$group = ( !empty( $instance[ 'group' ] ) ) ? $instance[ 'group' ] : '';
		?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
        	<?php _e( 'Title:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>">
        	<?php _e( 'Description:', 'pergo' ); ?></label>
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>"><?php echo sanitize_text_field($desc); ?></textarea></p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'placeholder' )); ?>">
        	<?php _e( 'Email Placeholder:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'placeholder' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'placeholder' )); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>" /></p>


     <p><label for="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>">
        	<?php _e( 'Button icon:', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_text' )); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" /></p>


        <p><label for="<?php echo esc_attr($this->get_field_id( 'group' )); ?>">
        	<?php _e( 'Group(optional):', 'pergo' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'group' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'group' )); ?>" type="text" value="<?php echo esc_attr($group); ?>" /></p>        

		<?php
	}
}