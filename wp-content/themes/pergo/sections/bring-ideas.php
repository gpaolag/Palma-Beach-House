<?php $atts = $args ?>
<div class="row d-flex align-items-center" id="banner-2">
	<div class="col-md-6 col-lg-6"> <!-- BANNER TEXT -->
		<div class="banner-txt content-txt ind-30 m-bottom-40">
			<<?php echo esc_attr($tagname) ?> class="<?php echo esc_attr($titleClass) ?>" data-animation="fadeInUp" data-animation-delay="300"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'title', $atts) ?>>
				<?php echo apply_filters('perch_modules_text_filter', $title, 'title', $atts) ?>
			</<?php echo esc_attr($tagname) ?>> <!-- Title -->
			
			<p class="<?php echo esc_attr($subtitleClass) ?>" data-animation="fadeInUp" data-animation-delay="400"<?php echo apply_filters('perch_vc_inline_css_filter', '', 'lead_text', $atts) ?>>
			   <?php echo apply_filters('perch_modules_text_filter', $lead_text, 'lead_text', $atts); ?>
			</p> <!-- Text -->

			<?php if( $display == 'buttons' ): ?>
			<!-- Button -->
			<div class="banner-btn animated" data-animation="fadeInUp" data-animation-delay="600">
				<?php echo pergo_get_button_groups($paramsArr) ?>
			</div>
			<?php endif; ?>

			<?php if( $display == 'icons' ): ?>
				<div class="app-devices clearfix animated" data-animation="fadeInUp" data-animation-delay="700">				<?php foreach ($paramsArr2 as $key => $value) {
						echo '<i class="'.esc_attr($value['icon']).'"></i>';
					}
					?>
					<div class="app-devices-desc"><!-- Text -->	
						<p class="p-small"><?php echo esc_attr($footer_desc) ?></p>
					</div>	

				</div>
			<?php endif; ?>

		</div>
	</div>	<!-- END BANNER TEXT -->

	<!-- BANNER IMAGE -->
	<div class="col-md-6 col-lg-5 offset-lg-1 animated" data-animation="fadeInUp" data-animation-delay="400">
		<div class="banner-img text-center">							
			<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($image_alt) ?>">
		</div>
	</div>
</div>