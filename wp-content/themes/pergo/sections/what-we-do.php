<!-- CONTENT-7 TITLE -->
<div class="row">	
	<div class="col-lg-10 col-xl-9 content-txt">	

		<!-- Section ID -->	
 		<span class="section-id animated" data-animation="fadeInUp" data-animation-delay="400">
 		   <?php echo esc_attr($subtitle) ?>
 		</span>	

		<!-- Title 	-->	
		<h3 class="h3-sm animated" data-animation="fadeInUp" data-animation-delay="400">
		   <?php echo esc_attr($title) ?>
		</h3>	

		<!-- Text -->
		<p class="p-lg animated" data-animation="fadeInUp" data-animation-delay="500">
		   <?php echo pergo_parse_text($lead_text); ?> 
		</p>

		<!-- Text -->
		<div class="animated" data-animation="fadeInUp" data-animation-delay="600">
		   <?php echo wpautop($content); ?>
		</div>
				
	</div> 	
</div><!-- .row -->