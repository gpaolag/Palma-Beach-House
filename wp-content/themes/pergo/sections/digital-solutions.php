<div class="row d-flex align-items-center"> 	
 	<div class="<?php echo esc_attr($content_class) ?>">
 		<div class="content-txt ind-30">
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
								<img src="<?php echo esc_url($value['image']) ?>" alt="<?php echo esc_attr($value['title']) ?>">
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
 	</div>	  <!-- END CONTENT TEXT -->

 	<!-- CONTENT IMAGE -->
	<div class="<?php echo esc_attr($image_class) ?> animated" data-animation="fadeInLeft" data-animation-delay="500">
		<div class="content-img">
			<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($image_alt) ?>" />
 		</div>
	</div>
</div>	   <!-- End row -->	