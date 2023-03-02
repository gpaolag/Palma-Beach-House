<?php if ( $posts->have_posts() ): 
	extract($posts->info); 
	$size = (!$img_size)? 'pergo-400x-400-nocrop' : $img_size; 	
	?>
	<div class="woocommerce">
	<div class="product-slider owl-carousel owl-theme">

		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>            
			<?php

				global $post;
			 	$post_object = get_post( $post->ID );

				setup_postdata( $GLOBALS['post'] =& $post_object );
				
				$link = ($link_type == 'link')? get_permalink($post->ID) :  get_the_post_thumbnail_url($post->ID, 'full' );
			?>
				<!-- IMAGE #1 -->
				<div class="portfolio-item product">
					<div class="loop-item-inner hover-overlay">							
							<!-- Image Zoom -->
							<a class="<?php echo ($link_type == 'link')? 'product-link' : 'image-link'; ?>" href="<?php echo esc_url($link); ?>" title="<?php the_title_attribute(); ?>">
								<?php if( has_post_thumbnail() ): ?>
									<!-- Project Preview Image -->
									<img class="img-fluid" src="<?php the_post_thumbnail_url( $size ); ?>" alt="<?php the_title_attribute(); ?>" />	
								<?php endif; ?>
								<div class="item-overlay"></div>
								<!-- Project Description -->
								<div class="project-description white-color">

									<!-- Project Meta -->
									<span class="<?php echo pergo_default_color() ?>-color"><?php echo pergo_get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '', true ) ?></span>
									<?php 
									do_action( 'woocommerce_shop_loop_item_title' ); 
									do_action( 'woocommerce_after_shop_loop_item_title' );
									?>
								</div> 
							</a>

						</div>									
				</div>	<!-- END IMAGE #1 -->	
					
		<?php endwhile; ?>		

		</div>
	</div>
</div><!-- .product-isotope-template -->
<?php
	// Posts not found
	else :
		echo '<h4>' . __( 'Product not found', 'pergo' ) . '</h4>';
	endif;
?>