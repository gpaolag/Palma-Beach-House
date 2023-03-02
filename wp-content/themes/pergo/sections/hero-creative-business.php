<?php $atts = $args ?>
<div class="hero-class" data-class="hero-section" data-section_id="hero-13">
	<div id="hero-13-txt" class="bg-scroll division"<?php echo $style ?>> <!-- HERO TEXT -->
		<div class="container white-color">	
			<div class="row">
				<div class="col-md-7">
					<div class="hero-txt">
								
						<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
						<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

						<!-- Button -->
						<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
							<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
						</div>

					</div>	
				</div>	
			</div>
		</div>
	</div>	   <!-- END HERO TEXT -->
	
	<div class="container">	<!-- HERO DISCOUNT BANNER -->
		<div class="row">
			<div class="col-md-5 col-lg-4 offset-md-7 offset-lg-8">
				
				<div class="animated" data-animation="fadeInUp" data-animation-delay="700">
					<?php echo wpb_js_remove_wpautop( $__content ); ?> 
				</div>	
			</div>	
		</div>
	</div>	   <!-- END HERO DISCOUNT BANNER -->

</div>	<!-- END HERO-13 -->