<?php $atts = $args ?>
<div class="inner-block <?php echo esc_attr($extraclass) ?>" id="content-9">
	<div class="row d-flex align-items-center">
	 	
	 	<div class="col-md-6 col-lg-6<?php echo esc_attr($order) ?>"> <!-- CONTENT TEXT -->
	 		<div class="content-txt">
	 			
	 			<span class="section-id animated" data-animation="fadeInUp" data-animation-delay="400">
	 			   <?php echo esc_attr($subtitle) ?>
	 			</span> <!-- Section ID -->
	 			
				<h3 class="h3-xs animated" data-animation="fadeInUp" data-animation-delay="400"> <!-- Title -->
				   <?php echo pergo_parse_text($title, array('tagclass' => pergo_default_color().'-color')) ?>
				</h3>

				<?php echo wpb_js_remove_wpautop( $content ) ?>

	 		</div>
	 	</div>	  <!-- END CONTENT TEXT -->
	 	
		<div class="col-md-6 col-lg-6"> <!-- CONTENT IMAGE -->
			<div class="content-img">
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($subtitle) ?>" />
	 		</div>
		</div>


	</div>	   <!-- End row -->		
</div>