<?php if( !empty($paramsArr) ): $animation_duration = 300; ?>
<?php $count_prefix = $count_postfix = $subtitle = ''; ?>
<div class="small-statistic text-<?php echo esc_attr($align) ?>"><!-- SMALL STATISTIC -->
	<div class="row">	
		<?php foreach ($paramsArr as $key => $value): extract($value); ?>
			<!-- STATISTIC BLOCK #1 -->
			<div class="<?php echo esc_attr($column) ?> animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">							
				<div class="statistic-block">							
					<div>
						<span class="counter-prefix <?php echo esc_attr($prefix_color) ?>-color"><?php echo esc_attr($count_prefix) ?></span>
						<span class="statistic-number <?php echo esc_attr($counter_color) ?>-color"><?php echo intval($count) ?></span>
						<span class="counter-postfix <?php echo esc_attr($postfix_color) ?>-color"><?php echo esc_attr($count_postfix) ?></span>
					</div>
					<h5 class="h5-sm <?php echo esc_attr($title_color) ?>-color"><?php echo esc_attr($title); ?></h5>	
					<?php if($subtitle != ''): ?>
					<p class="p-sm <?php echo esc_attr($subtitle_color) ?>-color"><?php echo esc_attr($subtitle); ?></p>	
					<?php endif; ?>					
				</div>								
			</div>
			<?php $animation_duration = $animation_duration + 100; ?>
		<?php endforeach; ?>					
	</div>	
</div>	<!-- END SMALL STATISTIC -->	
<?php endif; ?>