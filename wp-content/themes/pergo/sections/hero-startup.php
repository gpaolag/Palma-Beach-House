<?php $atts = $args; ?>
<!-- HERO-1
============================================= -->
<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-1">	
	<div class="row">

		<!-- HERO TEXT -->
		<div class="col-md-10 offset-md-1">
			<div class="hero-txt text-center">
				
				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

				<?php if( $enable_form == 'yes' ): ?>
				<!-- HERO NEWSLETTER FORM -->
				<div class="hero-form animated" data-animation="fadeInUp" data-animation-delay="500">
						
					<?php 
					if( class_exists('ES_Shortcode')){
						echo do_shortcode($placeholder);										
					}else{
						echo 'Please Install Theme Required & Recommended PLugins.';
					}
					?>									
				</div>	
				<?php endif; ?>							

				<?php if( !empty($paramsArr) ): ?>
				<!-- HERO LINKS -->
				<div class="hero-links animated" data-animation="fadeInUp" data-animation-delay="600">
					<?php foreach ($paramsArr as $key => $value): ?>						
						<span>
							<?php echo isset( $value['link_before'] )? esc_attr($value['link_before']) : ''; ?>
							<?php if( isset($value['add_link']) && ($value['link_title'] != '') ):  ?>
								<a href="<?php echo isset($value['link_url'])? esc_url($value['link_url']) : '#'; ?>"><?php echo esc_attr($value['link_title']) ?></a> 
							<?php endif; ?>
							<?php echo isset( $value['title'] )? esc_attr( $value['title'] ) : ''; ?>
						</span>	
					<?php endforeach; ?>
				</div>

				<?php endif; ?>

			</div>
		</div>	<!-- END HERO TEXT -->


	</div>	  <!-- End row -->
</div>	<!-- END HERO-1 -->