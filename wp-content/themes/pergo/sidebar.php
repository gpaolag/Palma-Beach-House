<?php
$layout = pergo_get_layout();
if( $layout != 'full' ):
  $sidebar = pergo_get_sidebar();
  $id = ($layout == 'ls')? 'sidebar-left' : 'sidebar-right';
  if( is_rtl() ){
    $class = ($layout == 'ls')? 'p-left-60' : 'p-right-60';
  }else{
    $class = ($layout == 'ls')? 'p-right-60' : 'p-left-60';
  }
  
?> 
<!-- SIDEBAR RIGHT
============================================= -->
<aside id="<?php echo esc_attr($id) ?>" class="col-md-4 widget-area">
	<div class="<?php echo esc_attr($class) ?>">


		<?php do_action( 'pergo_sidebar_before' ); ?>
    <?php 
      if ( is_active_sidebar( $sidebar ) ) : ?> 
          <?php dynamic_sidebar( $sidebar ); ?>     
              <?php 
            else: 
        $args = 'before_widget=<div class="sidebar-div m-bottom-50 widget_categories">&after_widget=</div>&before_title=<h5 class="h5-sm widget-title">&after_title=</h5>'; 
        the_widget( 'WP_Widget_Archives', '', $args ); 
        the_widget( 'WP_Widget_Pages', '', $args ); 
      endif; ?>

      <?php do_action( 'pergo_sidebar_after' ); ?>

	
	</div>
</aside>	<!-- END SIDEBAR RIGHT -->
<?php endif; ?>