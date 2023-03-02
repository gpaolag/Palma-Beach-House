<?php
$args = pergo_hero_slide_shortcode_vc(true);
$atts = shortcode_atts( $args, $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
?>

<li class="hero-slide">
			
	<!-- Slide Text -->
	<div class="hero-content white-color">
		<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
		<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->
		

		<!-- Buttons -->
		<div class="hero-btns animated" data-animation="fadeInUp" data-animation-delay="600">
			<?php echo pergo_get_button_groups($paramsArr, 'tra-hover m-left-15 m-right-15') ?>
		</div>	
																																					
	</div>
		
	<!-- Slide Background Image  -->
	<img src="<?php echo esc_url($image) ?>" alt="hero-slider">
									
</li>	<!-- END SLIDE #1 -->