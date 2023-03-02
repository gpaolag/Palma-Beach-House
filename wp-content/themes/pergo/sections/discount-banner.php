<?php $atts = $args  ?>
<div class="discount-banner <?php echo esc_attr($bg_class) ?>">
						
	<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 900 ); ?><!-- Sub Title -->

	<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 1000 ); ?><!-- Title -->	

	
	<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="1200"><!-- Buttons -->
		<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
	</div>
</div>