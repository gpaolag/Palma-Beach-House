<div class="row">
	<?php foreach ($paramsArr as $key => $value) : extract($value) ?>		
		
		<div class="<?php echo esc_attr($column) ?> animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_delay) + 100 ?>">
			<div class="hbox-1">							
				<h5 class="h5-md deepblue-color"><?php echo esc_attr($title) ?></h5>
				<?php echo wpautop($subtitle) ?>
			</div>	
		</div><!-- STATISTIC BLOCK -->
	<?php endforeach; ?>
</div>