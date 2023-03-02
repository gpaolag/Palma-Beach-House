
<div class="row"> <!-- STATISTIC BLOCK #1 -->
	<?php foreach ($paramsArr as $key => $value) : extract($value) ?>
		<div class="col-sm-4 animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_delay) + 200 ?>">
			<div class="statistic-block">							
				<div class="hero-number"><?php echo esc_attr($title) ?></div>
				<p><?php echo esc_attr($subtitle) ?></p>
			</div>	
		</div>
	<?php endforeach; ?>
</div>