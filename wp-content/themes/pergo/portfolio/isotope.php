<?php if ( $posts->have_posts() ): extract($posts->info); 	
	$size = (!$img_size)? 'pergo-400x--nocrop' : $img_size;
	?>

		
	<!-- PORTFOLIO IMAGES HOLDER -->	
	<div class="row">	
		<div class="col-md-12">
			<div class="grid"  id="portfolio-grid">
	
			<?php 
			$count = 0;
			while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<!-- IMAGE #1 -->
				  	<div class="grid-item grid-item--width1 grid-sizer portfolio-item">
						<div class="hover-overlay"> 

							<?php if( $link_type == 'link' ): ?>
								<a class="portfolio-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php else: ?>	
							<!-- Image Zoom -->
							<a class="image-link" href="<?php the_post_thumbnail_url( 'full' ); ?>" title="<?php the_title_attribute(); ?>">
							<?php endif; ?>
								<?php if( has_post_thumbnail() ): ?>
									<!-- Project Preview Image -->
									<img class="img-fluid" src="<?php the_post_thumbnail_url( $size ); ?>" alt="<?php the_title_attribute(); ?>" />	
								<?php endif; ?>
								<div class="item-overlay"></div>
								<!-- Project Description -->
								<div class="project-description white-color">
									<!-- Project Meta -->
									<span class="<?php echo pergo_default_color() ?>-color"><?php echo pergo_get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '', true ) ?></span>	
									<!-- Project Link -->
									<h5 class="h5-sm"><?php the_title(); ?></h5>
								</div> 
							</a>
						</div>	
					</div>	<!-- END IMAGE #1 -->
			<?php endwhile; ?>	
			</div>	
		</div>							
	</div>		<!-- END PORTFOLIO IMAGES HOLDER -->
<?php

	// Posts not found
	else :
		echo '<h4>' . __( 'Portfolio not found', 'pergo' ) . '</h4>';
	endif;
?>