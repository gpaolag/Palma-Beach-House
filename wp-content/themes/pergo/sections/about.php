<div class="row d-flex align-items-center">	

 	<!-- ABOUT TEXT -->
 	<div class="<?php echo esc_attr($container_class) ?>">
 		<div class="about-txt<?php echo esc_attr($about_class) ?>">
 			
 			<?php if( $subtitle != '' ): ?> 				
 			<span class="section-id <?php echo esc_attr($name_color) ?>-color animated" data-animation="fadeInUp" data-animation-delay="400">
 			   <?php echo esc_attr($subtitle) ?>
 			</span><!-- Section name -->
 		 	<?php endif; ?>
 			
			<<?php echo esc_attr($titletag) ?> class="<?php echo esc_attr($title_class) ?> animated" data-animation="fadeInUp" data-animation-delay="400">
			    <?php echo pergo_parse_text($title, $parse_args) ?>
			</<?php echo esc_attr($titletag) ?>><!-- Title -->	
			
			<p class="<?php echo  esc_attr($subtitle_text_size) ?> <?php echo esc_attr($subtitle_text_color) ?>-color animated" data-animation="fadeInUp" data-animation-delay="500">
			   <?php echo pergo_parse_text($lead_text); ?> 
			</p><!-- Text --> 
			
			<div class="animated" data-animation="fadeInUp" data-animation-delay="600">
			   <?php echo wpautop($content); ?>
			</div><!-- Text --> 

			<?php if( $display == 'list' ): ?>
				<?php if( !empty($paramsArr) ): $delay = 600; ?>
					<!-- List -->
					<ul class="content-list">

						<?php foreach ($paramsArr as $key => $value): ?>					
							<li class="animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($delay) ?>"><?php echo esc_attr($value['title']) ?></li>
							<?php $delay = $delay + 100; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			<?php endif; ?>

			<?php if( $display == 'techs' ): ?>
			<!-- Technologies Icons -->
			<div class="technologies animated" data-animation="fadeInUp" data-animation-delay="800">
				<!-- Text -->	
				<p><?php echo esc_attr($tech_title); ?></p>
				<?php if( !empty($paramsArr) ): ?>
				<!-- Icons -->
					<?php foreach ($paramsArr as $key => $value): ?>
						<?php if( isset($value['icon']) ): ?>							
							<span class="html-ico">
								<?php if( isset($value['image']) && ($value['image'] != '') ): ?>
								<img class="img-fluid" src="<?php echo esc_url($value['image']) ?>" alt="<?php echo esc_attr($value['title']) ?>">
								<?php else: ?>
								<i class="<?php echo esc_attr($value['icon']) ?>"></i>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					<?php endforeach; ?>				
				
				<?php endif; ?>
				
			</div>
			<?php endif; ?>

			<?php if( $display == 'counter' ): ?>
				<?php if( !empty($paramsArr) ): $animation_duration = 700; ?>
				<!-- SMALL STATISTIC -->
				<div class="small-statistic m-top-40">
					<div class="row">	
						<?php foreach ($paramsArr as $key => $value): ?>
							<!-- STATISTIC BLOCK #1 -->
							<div class="col-sm-4 col-md-6 animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">							
								<div class="statistic-block">							
									<div class="statistic-number <?php echo esc_attr($style) ?>-color"><?php echo intval($value['count']) ?></div>
									<h5 class="h5-sm"><?php echo esc_attr($value['title']) ?></h5>							
								</div>								
							</div>
							<?php $animation_duration = $animation_duration + 100; ?>
						<?php endforeach; ?>					
					</div>	
				</div>	<!-- END SMALL STATISTIC -->	
				<?php endif; ?>
			<?php endif; ?>

 		</div>
 	</div>	  <!-- END ABOUT TEXT -->

 	<!-- ABOUT IMAGE -->
	<div class="<?php echo esc_attr($order); ?>">
		<div class="<?php echo esc_attr($video_class); ?> about-img animated" data-animation="<?php echo esc_attr($animation_class) ?>" data-animation-delay="500">
			<?php if( $video_popup == 'yes' ): ?>
			<!-- Change the link HERE!!! -->						
			<a class="video-popup2" href="<?php echo esc_url($url) ?>"> 
				<!-- Play Icon -->									
				<div class="video-btn-md animated" data-animation="fadeInUp" data-animation-delay="700">	
					<div class="video-block-wrapper">
						<div class="play-icon-<?php echo pergo_default_color(); ?>"><div class="ico-bkg"></div>
							<i class="fas fa-play-circle"></i>
						</div>
					</div>
				</div>
				<!-- Preview Image -->
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($image_alt) ?>">
			</a>
			<?php else: ?>
			<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($image_alt) ?>" />
			<?php endif; ?>
 		</div>
	</div>
</div>	   <!-- End row -->	