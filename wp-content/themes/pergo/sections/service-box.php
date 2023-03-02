<?php $atts = $args; ?>
<!-- SERVICE BOX #1 -->
<div class="sbox <?php echo esc_attr($align) ?> animated"<?php echo pergo_animation_attr($css_animation, $animation_delay); ?>>
	<?php if( $style == 'sbox-1' ): ?>
	<div class="sbox-1 box-icon-md <?php echo esc_attr($icon_color) ?>-icon">
		<?php echo force_balance_tags($icon_html); ?>
		<div class="sbox-1-txt">
			
			<?php echo pergo_get_vc_param_html( 'title', $atts); ?><!-- Title -->
			<?php echo pergo_get_vc_param_html( 'subtitle', $atts); ?><!-- Sub Title -->
			
		</div><!-- Text -->
	</div>
	<?php endif; ?>	

	<?php if( $style == 'sbox-2' ): 
		$icon_html = apply_filters('pergo_add_link_filter', $icon_html, 'title', $atts);
		?>
	<div class="sbox-2 box-icon-md <?php echo esc_attr($icon_color) ?>-icon">
		<?php echo force_balance_tags($icon_html); ?>
		<?php echo pergo_get_vc_param_html( 'title', $atts); ?><!-- Title -->
		<?php echo pergo_get_vc_param_html( 'subtitle', $atts); ?><!-- Sub Title -->
	</div>	
	<?php endif; ?>

	<?php if( $style == 'sbox-4' ): ?>
	<div class="sbox-4 box-icon <?php echo esc_attr($icon_color) ?>-icon">	
		<?php echo force_balance_tags($icon_html); ?>
		<div class="sbox-4-txt">
			<?php echo pergo_get_vc_param_html( 'title', $atts); ?><!-- Title -->
			<?php if( $subtitle != '' ): ?>	
				<?php echo pergo_get_vc_param_html( 'subtitle', $atts); ?><!-- Sub Title -->
			<?php endif; ?>	
		</div>
	</div>	
	<?php endif; ?>	

	<?php if( $style == 'sbox-6' ):
		$titleClass = apply_filters('perch_vc_class_filter', 'h4-md', 'title', $atts); 
		$icon_html = apply_filters('pergo_add_link_filter', $icon_html, 'title', $atts);
		?>
	<div class="sbox-6 box-icon-lg <?php echo esc_attr($icon_color) ?>-icon">			
		<?php echo force_balance_tags($icon_html); ?>
		<?php echo pergo_get_vc_param_html( 'title', $atts); ?><!-- Title -->
		<?php if( $subtitle != '' ): ?>	
			<?php echo pergo_get_vc_param_html( 'subtitle', $atts); ?><!-- Sub Title -->
		<?php endif; ?>	
	</div>	
	<?php endif; ?>						
</div>