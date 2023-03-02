<?php if ( $posts->have_posts() ): extract($posts->info); 
	$size = (!$img_size)? 'pergo-400x--nocrop' : $img_size;
	?>
<!--   PORTFOLIO  -->
<div id="portfolio-1" class="portfolio-section">
	<?php 
	$args = array(
	    'hide_empty' => false,
	);

	if($tax_term != '') $args['include'] = $tax_term;

	$terms = get_terms( 'portfolio_category', $args );
	if( !empty($terms) ):
	?>
	<!--   PORTFOLIO  -->
	<div class="row">
		<div class="col-lg-12 portfolio-filter <?php echo pergo_default_color() ?>-btngroup text-center" data-active="<?php echo esc_attr($active) ?>">
			<div class="btn-toolbar">
				<div class="btn-group">	
					<span class="filter btn active" data-filter="all"><?php printf(_x('%s', 'All text', 'pergo'), ot_get_option('portfolio_all_text', 'All')); ?></span>
					<?php 
					foreach ($terms as $key => $value) {
						echo '<span class="filter btn'.(($value->slug == $active)? ' active' : '').'" data-filter="'.esc_attr($value->slug).'">'.esc_attr($value->name).'</span>';
					} 
					?>
				</div>		
			</div>	
		</div>	
	</div>	
	<?php endif; ?>			

	<div class="row portfolio-items-list">
		<?php 
		$count = 0;
		while ( $posts->have_posts() ) : $posts->the_post(); ?>				

               <!-- IMAGE #1 -->
				<div class="col-md-6 col-lg-4 portfolio-item <?php echo pergo_get_the_term_list( get_the_ID(), 'portfolio_category', ' ', ' ', '', false ) ?>">
					<div class="hover-overlay">
							<!-- Image Zoom -->
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
	</div><!-- .portfolio-isotope-template -->
<?php

	// Posts not found
	else :
		echo '<h4>' . __( 'Portfolio not found', 'pergo' ) . '</h4>';
	endif;
?>