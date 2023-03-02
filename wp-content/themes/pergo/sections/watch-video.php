<?php if( $style == 'style1' ): ?>
<!-- VIDEO PREVIEW -->	
<div class="video-preview text-center animated" data-animation="fadeInUp" data-animation-delay="500">
	<!-- Change the link HERE!!! -->						
	<a class="video-popup2" href="<?php echo esc_url($url) ?>" title="<?php echo esc_attr($title) ?>"> 

		<!-- Play Icon -->									
		<div class="video-btn-sm animated" data-animation="fadeInUp" data-animation-delay="700">	
			<div class="video-block-wrapper">
				<div class="play-icon-<?php echo pergo_default_color() ?>"><div class="ico-bkg"></div>
					<i class="fas fa-play-circle"></i>
				</div>
			</div>
		</div>

		<!-- Preview Image -->
		<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">
	</a>
</div>	<!-- END VIDEO TEXT -->
<?php endif; ?>	

<?php if( $style == 'style2' ): ?>
<div class="row">
	<!-- VIDEO TEXT -->	
	<div class="col-lg-10 offset-lg-1 text-center">			
		<!-- Title -->	
		<h2 class="h2-xs animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="300">
		   <?php echo esc_attr($title) ?>
		</h2>
		
		<!-- VIDEO PREVIEW -->
		<div class="video-btn m-top-25">
			<div class="video-block animated" data-animation="fadeInUp" data-animation-delay="500">	

				<!-- Change the link HERE!!! -->						
				<a class="video-popup2" href="<?php echo esc_url($url) ?>"> 

					<!-- Play Icon -->									
					<div class="video-btn-xs animated" data-animation="fadeInUp" data-animation-delay="700">	
						<div class="video-block-wrapper">
							<div class="play-icon-<?php echo pergo_default_color() ?>"><div class="ico-bkg"></div>
								<i class="fas fa-play-circle"></i>
							</div>
						</div>
					</div>
				</a>

			</div>	
		</div>	<!-- END VIDEO PREVIEW -->				 			

	</div>	<!-- END VIDEO TEXT -->
</div>
<?php endif; ?>	