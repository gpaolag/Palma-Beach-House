<?php 
namespace ControlPatterns\Patterns;

class Widget  extends \WP_Widget{
	public function __construct() { 
		parent::__construct(
            'control-block-patterns-widget',  // Base ID
            'Control Block Patterns',   // Name
			array(
				'classname' => 'control-block-patterns-widget'
			)
        ); 
		
        
    }

	public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
		
		
         if( !empty($instance['pattern']) ){
			$pattern = Helper::get_post_by_name( $instance['pattern'] );
			if( !empty( $pattern->post_content ) ){
				echo \do_blocks($pattern->post_content);
			}
		 }
		 
        
 
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $pattern = ! empty( $instance['pattern'] ) ? $instance['pattern'] : '';
        $iframe = ! empty( $instance['iframe'] ) ? true : false;
		$pattern_options = control_block_patterns_choices();
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'control-block-patterns' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pattern' ) ); ?>"><?php echo esc_html__( 'Choose Pattern:', 'control-block-patterns' ); ?></label>
			<?php if( !empty($pattern_options) ): ?>
            	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pattern' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pattern' ) ); ?>">
					<?php 					
						foreach ($pattern_options as $_pattern) {
							extract($_pattern);
							echo '<option value="'.$value.'" '.selected( $pattern, $value, false ).'>'.$label.'</option>';
						}					
					?>
				</select>
			<?php else: ?>
				<a href="<?php echo esc_url(admin_url('edit.php?post_type=ctrl_block_patterns&page=directory')) ?>">Browse Directory</a> to add new block pattern
			<?php endif; ?>
        </p>
		<p style="display: none;">
        <label for="<?php echo esc_attr( $this->get_field_id( 'iframe' ) ); ?>"><?php echo esc_html__( 'Iframe:', 'control-block-patterns' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'iframe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'iframe' ) ); ?>" type="checkbox" <?php checked( true, $iframe ) ?>> <span>Enable</span>
        </p>
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['pattern'] = ( !empty( $new_instance['pattern'] ) ) ? $new_instance['pattern'] : '';
        $instance['iframe'] = ( !empty( $new_instance['iframe'] ) ) ? $new_instance['iframe'] : false;
 
        return $instance;
    }	
   
}