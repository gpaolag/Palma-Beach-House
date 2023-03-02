<div id="<?php echo ($style == 'style2')? 'pricing-3' : 'pricing-default' ?>">
<div class="pricing-table highlight animated"<?php echo pergo_animation_attr($css_animation, $animation_delay); ?>>		
	<?php if($style == 'style1'): ?>
	
	<div class="pricing-plan <?php echo esc_attr($borderclass) ?>"> <!-- Plan Price  -->
		<h5 class="h5-lg <?php echo esc_attr($titleclass) ?>"><?php echo esc_attr($title) ?></h5>									
		<sup><?php echo esc_attr($unit) ?></sup>								
		<span class="price"><?php echo esc_attr($price) ?></span>
		<p class="validity"><?php echo esc_attr($validity) ?></p>
	</div>	

	<?php echo wpb_js_remove_wpautop($content, true) ?> <!-- Pricing Plan Features  -->

	<?php
	echo pergo_get_button_groups($paramsArr); 
	?>
	<?php endif; ?>

	
	<?php if($style == 'style2'): ?>							
	<div class="price">
		<h5 class="h5-xl <?php echo esc_attr($pricing_color) ?>-color"><?php echo esc_attr($title) ?></h5>
		<sup class="<?php echo esc_attr($pricing_color) ?>-color"><?php echo esc_attr($unit) ?></sup>
		<span class="<?php echo esc_attr($pricing_color) ?>-color"><?php echo esc_attr($price) ?></span>
		<span class="price-vat"><?php echo esc_attr($validity) ?></span>
	</div>
	
	
	<div class="pricing-text"> <!-- Pricing Description  -->						
		<?php echo wpautop($content) ?>								
	</div>

	<?php
	echo pergo_get_button_groups($paramsArr); 
	?>
	<?php endif; ?>
	
</div>
</div>