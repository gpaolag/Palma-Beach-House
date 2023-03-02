<?php $atts = $args ?>
<!-- HERO-16 -->
<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-16">	
		<div class="row d-flex align-items-center">
			
			<div class="col-md-6"> <!-- HERO TEXT -->
				<div class="hero-txt">

					<?php echo pergo_get_vc_param_html( 'title', $atts); ?><!-- Title -->	
					<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

				</div>	
			</div>	<!-- END HERO TEXT -->
			
			<div class="col-md-6"> <!-- HERO IMAGE -->
				<div class="hero-img animated" data-animation="fadeInLeft" data-animation-delay="400">
					<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>" />
				</div>
			</div>

		</div>	<!-- End row -->
</div>	<!-- END HERO-16 -->