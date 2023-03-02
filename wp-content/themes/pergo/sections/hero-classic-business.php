<?php $atts = $args ?>

<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-18"> <!-- HERO-18 -->	
	<div class="row"> <!-- HERO TEXT -->
		<div class="col-md-12">
			<div class="hero-txt text-center white-color">

				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
				
				<div class="video-preview hero-img m-top-60 animated" data-animation="fadeInUp" data-animation-delay="600">	<!-- VIDEO PREVIEW -->
											
					<a class="video-popup2" href="<?php echo esc_url($video_link) ?>" title="<?php echo esc_attr($video_title) ?>"> <!-- Change the link HERE!!! -->

						<!-- Play Icon -->
						<div class="video-btn-lg animated" data-animation="fadeInUp" data-animation-delay="800">	
							<div class="video-block-wrapper">
								<div class="play-icon-<?php echo pergo_default_color(); ?>"><div class="ico-bkg"></div>
									<i class="fas fa-play-circle"></i>
								</div>
							</div>
						</div>
						
						<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($video_title) ?>"> <!-- Preview Image -->

					</a>

 				</div>	<!-- END VIDEO PREVIEW -->

			</div>
		</div>
	</div>	<!-- END HERO TEXT -->
</div>	<!-- END HERO-18 -->