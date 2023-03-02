<div class="row">
	<div class="col-md-12 text-center">
		<div class="more-questions-btn">
			<!-- Text -->
			<h4 class="h4-xs txt-600 animated"<?php echo pergo_animation_attr($css_animation, $animation_delay); ?>>
			   <?php echo esc_attr($title); ?>
			</h4>

			<!-- Button -->
			<div class="faqs-btn animated"<?php echo pergo_animation_attr($css_animation, ($animation_delay+200)) ?>>
				<?php echo pergo_get_button_groups($paramsArr) ?>
			</div>

		</div>
	</div>
</div>