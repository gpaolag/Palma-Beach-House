<?php $atts = $args ?>
<div class="hero-class" data-class="hero-section" data-section_id="hero-19">	
	<div id="hero-19-txt" class="bg-scroll division"<?php echo $style ?>>
		<div class="container white-color">	
			<div class="row">
				<div class="col-md-8">
					<div class="hero-txt">								
						<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
						<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
						
						<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
							<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
						</div> <!-- Button -->

					</div>	
				</div>	
			</div>
		</div>
	</div><!-- END HERO TEXT -->


	<div class="container">	
		<div class="hero-19-boxes">
			<?php echo wpb_js_remove_wpautop( $__content ); ?>
		</div>	
	</div>	   <!-- END HERO BOXES -->


</div>	<!-- END HERO-13 -->	