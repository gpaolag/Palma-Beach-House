<?php $atts = $args ?>

<li class="hero-slide"> <!-- HERO SLIDE #1 -->

	<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
	<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 500 ); ?><!-- Sub Title -->			
	
	<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="700"><!-- Button -->
		<?php echo pergo_get_button_groups($paramsArr, 'tra-hover') ?>
	</div>													
						
</li>	 <!-- END HERO SLIDE #1 -->	