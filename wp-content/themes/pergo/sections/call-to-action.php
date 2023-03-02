<?php if( $style == 'style2' ): ?>
<div class="row" id="cta-2">
	<div class="col-md-12"> <!-- CALL TO ACTION TEXT -->
		<div class="cta-txt text-center">
			<h2 class="h2-md animated" data-animation="fadeInUp" data-animation-delay="300"> <!-- Title  -->
			   <?php echo pergo_parse_text($title) ?>
			</h2>
			<p class="p-lg animated" data-animation="fadeInUp" data-animation-delay="400"> <!-- Text -->
			   <?php echo pergo_parse_text($lead_text); ?>
			</p>
			<!-- HERO STORE BADGES -->													
			<div class="stores-badge m-top-30 animated" data-animation="fadeInUp" data-animation-delay="500">
				<?php if( $display == 'buttons' ): ?>
					<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
				<?php endif; ?>
				<?php if( $display == 'icons' ): ?>	
					<?php foreach ($paramsArr2 as $key => $value) : ?>
						<a href="<?php echo esc_url($value['link']) ?>" class="store">
							<img class="appstore" src="<?php echo esc_url($value['image']) ?>" width="160" height="50" alt="<?php echo esc_attr($value['title']) ?>" />
						</a>
					<?php endforeach; ?>				
				<?php endif; ?>

			</div>	<!-- End Store Badges -->

		</div>
	</div>	<!-- END CALL TO ACTION TEXT -->
</div>	 <!-- End row -->
<?php endif; ?>

<?php if( $style == 'style1' ): ?>
<div class="row d-flex align-items-center" id="cta-3">	
	<div class="col-md-7 col-lg-6"> <!-- CALL TO ACTION TEXT -->
		<div class="cta-txt m-bottom-40">
			
			<h2 class="h2-xs txt-500 animated" data-animation="fadeInUp" data-animation-delay="300">
			   <?php echo pergo_parse_text($title) ?>
			</h2>
			
			<p class="p-lg animated" data-animation="fadeInUp" data-animation-delay="400">
			   <?php echo pergo_parse_text($lead_text); ?>
			</p><!-- Text -->
		</div>
	</div>	<!-- END CALL TO ACTION TEXT -->
	<!-- CALL TO ACTION BUTTON -->
	<div class="col-md-5 col-lg-6 text-right">
		<div class="cta-btn text-center m-bottom-40 animated" data-animation="fadeInUp" data-animation-delay="400">
			<p class="p-lg"><?php echo pergo_parse_text($subtitle) ?></p> <!-- Text -->

			<?php if( $display == 'buttons' ): ?>
				<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
			<?php endif; ?>

			<?php if( $display == 'icons' ): ?>	
				<?php foreach ($paramsArr2 as $key => $value) : ?>
					<a href="<?php echo esc_url($value['link']) ?>" class="store">
						<img class="appstore" src="<?php echo esc_url($value['image']) ?>" width="160" height="50" alt="<?php echo esc_attr($value['title']) ?>" />
					</a>
				<?php endforeach; ?>				
			<?php endif; ?>

		</div>
	</div>	<!-- END CALL TO ACTION TEXT -->

</div>	 <!-- End row -->
<?php endif; ?>

<?php if( $style == 'style3' ): ?>
<div class="row d-flex align-items-center">						
	<div class="col-md-8 col-lg-8">
		<div class="cta-txt animated" data-animation="fadeInUp" data-animation-delay="400">
			
			<h4 class="h4-lg txt-500"><?php echo pergo_parse_text($title) ?></h4><!-- Title  -->
			<?php if( $lead_text != '' ): ?>
			<p class="p-lg"><?php echo pergo_parse_text($lead_text); ?></p>
			<?php endif; ?>

		</div>
	</div>	<!-- END CALL TO ACTION TEXT -->
	
	<div class="col-md-4 col-lg-4 text-center"> <!-- CALL TO ACTION BUTTON -->
		<div class="cta-btn text-center animated" data-animation="fadeInUp" data-animation-delay="500">
			
			<?php if( $display == 'buttons' ): ?>
				<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
			<?php endif; ?>

			<?php if( $display == 'icons' ): ?>	
				<?php foreach ($paramsArr2 as $key => $value) : ?>
					<a href="<?php echo esc_url($value['link']) ?>" class="store">
						<img class="appstore" src="<?php echo esc_url($value['image']) ?>" width="160" height="50" alt="<?php echo esc_attr($value['title']) ?>" />
					</a>
				<?php endforeach; ?>				
			<?php endif; ?>

		</div>
	</div>	<!-- END CALL TO ACTION TEXT -->


</div>
<?php endif; ?>