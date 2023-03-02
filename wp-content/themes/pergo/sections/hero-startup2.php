<?php $atts = $args ?>
<!-- HERO-17 -->
<div class="hero-class" data-class="hero-section division" data-section_id="hero-17">
	<div class="row d-flex align-items-center">
		
		<div class="col-md-6"> <!-- HERO TEXT -->
			<div class="hero-txt p-right-30">
						
				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

				<!-- Buttons -->
				<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
					<?php echo pergo_get_button_groups($paramsArr) ?>
				</div>

			</div>	
		</div>	<!-- END HERO TEXT -->
		
		<div class="col-md-6"> <!-- HERO IMAGE -->
			<div class="hero-img p-left-30 animated" data-animation="fadeInLeft" data-animation-delay="400">
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">
			</div>
		</div>	


	</div>	   <!-- End row -->	
</div>	<!-- END HERO-17 -->