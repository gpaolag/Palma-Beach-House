<?php $atts = $args ?>
<div class="row d-flex align-items-center">
 	<div class="col-md-6"> <!-- ABOUT TEXT -->
 		<div class="about-txt ind-30">
 			<?php echo pergo_get_vc_param_html( 'subtitle', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
 			<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 400 ); ?><!-- Title -->	
			<div class="animated" data-animation="fadeInUp" data-animation-delay="500"><!-- Text -->
			   <?php echo wpautop($content); ?>
			</div>			
 		</div>
 	</div>	  <!-- END ABOUT TEXT -->

 	<?php if( !empty($paramsArr) ): $animation_duration = 400; ?>
 	
	<div class="col-md-6"> <!-- ABOUT SKILLS -->
		<div class="about-skills ind-30">
			<div class="skills rose-progress m-top-30"> <!-- SKILLS -->	
				<?php foreach ($paramsArr as $key => $value): ?>
					<div class="barWrapper animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">	
						<p><?php echo esc_attr($value['title']) ?></p>
						<span class="skill-percent"><?php echo intval($value['count']) ?>%</span> 
						<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo intval($value['count']) ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<?php $animation_duration = $animation_duration + 200; ?>
				<?php endforeach; ?>
			</div>	<!-- END SKILLS -->	

 		</div>
	</div>
	<?php endif; ?>	
</div>	   <!-- End row -->	