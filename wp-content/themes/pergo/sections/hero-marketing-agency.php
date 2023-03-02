<?php $atts = $args ?>
<!-- HERO-11 -->	
<div class="hero-class white-color" data-class="hero-section division" data-section_id="hero-11">
	<div id="hero-11-txt" class="bg-scroll division"<?php echo $style ?>> <!-- HERO-11 TEXT -->
		<div class="container">	
			<div class="row ">
				
				<div class="col-md-10 offset-md-1"> <!-- HERO TEXT -->
					<div class="hero-txt text-center">

						<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
						<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

					</div>
				</div>	<!-- END HERO TEXT -->


			</div>	 <!-- End row -->
		</div>	 <!-- End container --> 	
	</div>	 <!-- END HERO-11 TEXT -->
	
	<div class="container">	<!-- HERO-11 INNER CONTENT -->	
		<div class="animated" data-animation="fadeInUp" data-animation-delay="600">		
			<?php echo wpb_js_remove_wpautop( $__content ); ?> 
	 	</div>
	</div> 	<!-- END HERO-11 INNER CONTENT -->


</div>	<!-- END HERO-11 -->