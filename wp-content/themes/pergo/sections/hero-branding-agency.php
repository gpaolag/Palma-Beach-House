<?php $atts = $args ?>
<div class="hero-class" data-class="hero-section" data-section_id="hero-15">
	
	<div id="hero-15-txt" class="bg-scroll division"<?php echo $style ?>> <!-- HERO-15 TEXT -->
		<div class="container">	
			<div class="row">
				<div class="col-md-12">
					<div class="hero-txt text-center white-color">

						<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
						<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

						
						<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
							<?php echo pergo_get_button_groups($paramsArr) ?>
						</div> <!-- Button -->

					</div>
				</div>
			</div>	 <!-- End row -->
		</div>	 <!-- End container --> 	
	</div>	 <!-- END HERO-15 TEXT -->
	
	<div class="container">	<!-- HERO-15 STATISTIC -->	
		<div class="hero-statistic animated" data-animation="fadeInUp" data-animation-delay="600">					
			<div class="row">							
				<div class="col-md-12">	
					<?php echo wpb_js_remove_wpautop( $__content ); ?>				
				</div>
			</div>	
		</div>
	</div> 	<!-- END HERO-15 STATISTIC -->

</div>	<!-- END HERO-15 -->