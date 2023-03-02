<?php $atts = $args ?>
<div class="hero-class" data-class="hero-section division" data-section_id="hero-6">
	
	<div class="bg-scroll hero-6-text division"<?php echo $style ?>>
		<div class="container">		
			<div id="hero-6-content" class="row white-color">
				<div class="col-md-10 offset-md-1 hero-txt text-center">

					<!-- Title -->
					<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
					<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

					<!-- Button -->
					<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
						<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
					</div>									

				</div>							
			</div>													
		</div>	 <!-- End container -->		
	</div> 	  <!-- END HERO TEXT -->	
	

</div>	<!-- END HERO-6 -->
<!-- HERO IMAGE -->
<div class="hero-6-image division animated" data-animation="fadeInUp" data-animation-delay="600">
	<div class="container">		
		<div id="hero-6-img" class="row">								
			<div class="col-md-12 text-center">																		
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">
			</div>							
		</div>												
	</div>
</div> 