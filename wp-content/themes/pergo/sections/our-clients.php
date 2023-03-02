<div id="<?php echo esc_attr($style_id) ?>">
	<?php if( $style == 'style2' ): ?>
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="brands-title">
					<h5 class="h5-lg ">
						<?php echo pergo_parse_text($title, array('tagclass' => 'black-color')) ?>
					</h5>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if( !empty($paramsArr) ): $animation_duration = 300; ?>
		<?php $class = ( $style == 'style1' )? 'col-sm-4 col-md-3 brand-logo m-bottom-30 animated' : 'brand-logo m-bottom-20 animated'; ?>
		<div class="row">
			<?php foreach ($paramsArr as $key => $value): extract($value); ?>
				<!-- BRAND LOGO IMAGE -->
				<div class="<?php echo esc_attr($class) ?>" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">
						<?php if( isset($value['url']) && ($value['url'] != '') ): ?>	
						<a href="<?php echo esc_url($value['url']) ?>" target="_blank">
						<?php endif; ?>
						<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>" />
						<?php if( isset($value['url']) && ($value['url'] != '') ): ?>
						</a>
						<?php endif; ?>	
					</div>
				<?php $animation_duration = $animation_duration + 100; ?>
			<?php endforeach; ?>
		</div>	   <!-- End row -->	
	<?php endif; ?>	
	
</div>