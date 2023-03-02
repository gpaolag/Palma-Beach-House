<div class="<?php echo implode(' ', $divclass) ?>" data-animation="fadeInUp" data-animation-delay="500">
	<?php if( $display == 'buttons' ): ?>
		<?php echo pergo_get_button_groups($paramsArr) ?>
	<?php endif; ?>
	<?php if( $display == 'icons' ): ?>	
		<?php foreach ($paramsArr2 as $key => $value) : ?>
			<a href="<?php echo esc_url($value['link']) ?>" class="store">
				<img class="appstore" src="<?php echo esc_url($value['image']) ?>" width="160" height="50" alt="<?php echo esc_attr($value['title']) ?>" />
			</a>
		<?php endforeach; ?>				
	<?php endif; ?>
	<?php if($footer_text != ''): ?>
		<div class="m-top-15"><span class="os-version"><?php echo esc_attr($footer_text) ?></span></div>
	<?php endif; ?>
</div>	<!-- End Store Badges -->