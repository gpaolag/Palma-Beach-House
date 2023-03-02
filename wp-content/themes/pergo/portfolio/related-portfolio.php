<?php
$realted_post_display = ot_get_option( 'display_single_related_portfolio', 'on' ); 
if($realted_post_display == 'on'):
$orig_post = $post;
global $post;
$tags = wp_get_post_terms($post->ID, 'portfolio_category');
if ($tags) :	
?>
	<div class="related-portfolio m-top-80">			
		<?php 
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args = array(
			'post_type' => 'portfolio',
			'tax_query' => array(						
						array(
							'taxonomy' => 'portfolio_category',
							'field'    => 'term_id',
							'terms'    => $tag_ids
						),
					),
			'post__not_in' => array($post->ID),
			'posts_per_page'=> ot_get_option('related_portfolio', 3), // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1
		);
		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) :
			$related_title = ot_get_option( 'related_portfolio_title', 'Related portfolio' ); 			
			?>
			<!-- Title -->	
			<h4 class="h4-xs m-bottom-20"><?php printf( _x( '%s','Related portfolio title', 'pergo' ), esc_attr($related_title)) ?></h4>
			<div class="row">
			<?php
			$animation_duration = 300;
			while( $my_query->have_posts() ): $my_query->the_post(); ?>
				<div <?php post_class('portfolio-item col-md-6 col-lg-4 m-top-30 animated'); ?>  data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">				
					<?php get_template_part( 'portfolio/content', 'loop' ); ?>
                </div>
                <?php            
				$animation_duration = $animation_duration + 100;
			endwhile; 
			?>
		</div> <!-- End row -->	
		<?php endif; ?>	
	</div>
	<?php
	$post = $orig_post;
	wp_reset_postdata(); 
endif; 
endif; 
 ?>