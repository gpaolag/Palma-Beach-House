<?php $atts = $args ?>
<!-- HERO-14 -->
<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-14">	
	<div class="row d-flex align-items-center">
		<div class="container">	
			<div class="row">
				
				<div class="col-md-7"> <!-- HERO TEXT -->
					<div class="hero-txt">

						<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
						<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

						<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
							<?php echo pergo_get_button_groups($paramsArr) ?>
						</div><!-- Button -->

					</div>
				</div>	<!-- END HERO TEXT -->


			</div>	  <!-- End row -->
		</div>	   <!-- End container -->
		
		<div class="hero-14-img"> <!-- HERO-14-IMAGE -->
			<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">	
		</div>	


	</div>     <!-- End row -->		
</div>	<!-- END HERO-14 -->