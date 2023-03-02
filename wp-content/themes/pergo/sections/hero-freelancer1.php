<?php $atts = $args ?>
<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-10"><!-- HERO-10 -->
	<div class="row">
		<div class="col-md-12"> <!-- HERO TEXT -->
			<div class="hero-txt text-center">
				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
			</div>
		</div>	<!-- END HERO TEXT -->

	</div>	  <!-- End row -->
</div>	<!-- END HERO-10 -->