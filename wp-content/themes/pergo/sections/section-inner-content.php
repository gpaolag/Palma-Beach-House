<div class="section-inner-block <?php echo esc_attr($extraclass) ?>">	
	<div class="row d-flex align-items-center bg-tinyblue">
 	
	<div class="col-md-6 col-lg-6 p-left-0 p-right-0 <?php echo esc_attr($order) ?>">
		<div class="section-inner-img video-preview">

			<?php if($enable_video): ?>						
			<a class="video-popup2" href="<?php echo esc_url($url) ?>">
				<div class="video-btn-md animated" data-animation="fadeInUp" data-animation-delay="600">	
					<div class="video-block-wrapper">
						<div class="play-icon-<?php echo pergo_default_color(); ?>"><div class="ico-bkg"></div>
							<i class="fas fa-play-circle"></i>
						</div>
					</div>
				</div> <!-- Play Icon -->
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($subtitle) ?>" /> <!-- Preview Image -->
			</a>
			<?php else: ?>
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($subtitle) ?>" /> <!-- Preview Image -->
			<?php endif; ?>	

 		</div>
	</div>
 	
 	<div class="col-md-6 col-lg-6"> <!-- HERO INNER TEXT -->
 		<div class="section-inner-txt abox-4 <?php echo esc_attr($text_align) ?>">

 			<?php echo do_shortcode($content); ?>						

 		</div>
 	</div>	  <!-- END HERO INNER TEXT -->


	</div>	
</div>