<?php $atts = $args ?>

<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-4"><!-- HERO-4 -->	
	<div class="row">
		
		<div class="col-sm-10 col-md-7"> <!-- HERO TEXT -->
			<div class="hero-txt">			

				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

				<!-- Button -->
				<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="700">
					<?php echo pergo_get_button_groups($paramsArr) ?>
				</div>	

			</div>
		</div>	<!-- END HERO TEXT -->

	</div>	  <!-- End row -->	
</div>	<!-- END HERO-4 -->