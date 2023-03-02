<?php $atts = $args ?>
<div class="questions-holder ind-30">	
	<div class="question animated"<?php echo pergo_animation_attr($css_animation, $animation_delay); ?>>		
		<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
		<?php echo pergo_get_vc_param_html( 'subtitle', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
	</div>
</div>