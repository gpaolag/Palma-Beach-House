<?php $atts = $args ?>

<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-3"><!-- HERO-3 -->	
	<div class="row">
		<div class="col-lg-12"> <!-- HERO TEXT -->
			<div class="hero-txt text-center">

				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 500 ); ?><!-- Sub Title -->
				<!-- Play Button -->
				<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="700">
					<div class="video-btn-sm">
						<!-- Change the link HERE!!! -->
						<a class="video-popup1" href="<?php echo esc_url($video_link) ?>" title="<?php echo esc_attr($video_title) ?>"> 
							<div class="video-block-wrapper">
								<div class="play-icon-rose"><div class="ico-bkg"></div>
									<i class="fas fa-play-circle"></i>
								</div>
							</div>
						</a>

					</div>
				</div>	

				<!-- Play Button Text -->
				<span class="play-btn-txt animated" data-animation="fadeInUp" data-animation-delay="800">
				   <?php echo esc_attr($video_title) ?>
				</span>

			</div>
		</div>	<!--END  HERO TEXT -->


	</div>	 <!-- End row -->				
</div>	<!-- END HERO-3 -->	