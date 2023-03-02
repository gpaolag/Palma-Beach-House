<?php
$classArr = array('col-md-10 col-lg-5 col-xl-4', 'col-md-4 col-lg-2 col-xl-2 footer-small-widget offset-lg-1 offset-xl-2', 'col-md-4 col-lg-2 footer-small-widget', 'col-md-4 col-lg-2 footer-small-widget');
$classArr = apply_filters( 'pergo_footer_widgets_column_class',  $classArr );
$total = ot_get_option( 'footer_widget_area_column', '4' );
for( $i=1; $i<=$total; $i++ ):
    $class = ($total == 4)? $classArr[$i-1] : 'col-md-'.(12/$total);
		?>
		<div class="<?php echo esc_attr($class) ?>">
            <?php 
            $sidebar = 'footer-'.$i;
            if ( is_active_sidebar( $sidebar ) ) :
            	dynamic_sidebar( $sidebar ); 
            else:
            	 //$args = 'before_widget=<div class="footer-links m-bottom-40">&after_widget=</div>&before_title=<h5 class="h5-sm">&after_title=</h5>'; 
				//the_widget( 'WP_Widget_Meta', '', $args ); 
            endif;
            ?>
        </div>
		<?php 
endfor;
?>