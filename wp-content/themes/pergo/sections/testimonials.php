<?php if( !empty($paramsArr) && ($style == '1column')): ?>
	<div class="row" id="reviews-2">
		<div class="col-lg-12 testimonials text-center">
			<div class="quote-icon"></div> <!-- TRANSPARENT QUOTE ICON -->
			<div class="flexslider purple-nav">	<!-- TESTIMONIALS CONTENT -->										
				<ul class="slides">
					<?php foreach ($paramsArr as $key => $value) : extract($value); ?>
						<li class="review-2"> <!-- TESTIMONIAL #1 -->
							<!-- Testimonial Text -->
							<div class="review-txt">
								<?php echo wpautop($desc); ?>
							</div>	
							<!-- Testimonial Author Avatar -->
							<img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($name) ?>">
							<!-- Testimonial Author -->
							<div class="review-author">
								<p class="testimonial-autor"><?php echo esc_attr($name) ?></p>	
								<span class="rose-color"><?php echo esc_attr($title) ?></span>									
							</div>
						</li>
					<?php endforeach; ?>

				</ul>
			</div><!-- .flexslider -->

		</div>
 	</div>	<!-- End row -->
<?php endif; ?>	


<?php if( !empty($paramsArr) && ($style == '3column')): ?> 
<div id="reviews-1" class="reviews-section">	
	<div class="reviews-carousel"> <!-- TESTIMONIALS CAROUSEL -->
		<div class="center slider"<?php echo $car_attr; ?>>
			<?php foreach ($paramsArr as $key => $value) : extract($value); ?>
			<div class="review-1"> <!-- TESTIMONIAL #1 -->
				<div class="review-txt"> <!-- Testimonial Text -->
					<?php echo wpautop($desc); ?>
				</div>
				<div class="testimonial-avatar text-center"> <!-- Testimonial Author Avatar -->
					<img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($name) ?>">
					<p class="testimonial-autor"><?php echo esc_attr($name) ?></p>
					<span><?php echo esc_attr($title) ?></span>
				</div>
																				
			</div>	<!-- END TESTIMONIAL #1 -->
			<?php endforeach; ?>

									
		</div>
	</div>	<!-- TESTIMONIALS CAROUSEL -->
</div>
<?php endif; ?>	