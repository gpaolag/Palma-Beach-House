<?php
$realted_post_display = ot_get_option( 'realted_post_display', 'on' ); 
if($realted_post_display == 'on'):
$orig_post = $post;
global $post;
$realted_post_base = ot_get_option( 'realted_post_base', 'tag' );
$terms = ( $realted_post_base == 'tag' )? wp_get_post_tags($post->ID) : wp_get_object_terms($post->ID, 'category');
$term_ids = array();	
foreach($terms as $individual_term) $term_ids[] = $individual_term->term_id;

if ( !empty($term_ids) ) :	
	$args = array(		
		'post__not_in' => array($post->ID),
		'posts_per_page' => 2, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand',
    	'order'    => 'ASC'
	);	
	if( $realted_post_base == 'tag' ) $args['tag__in'] = $term_ids; 
	else $args['category__in'] = $term_ids;
	//print_r($args);
	?>
	<div class="related-post">			
		<?php 		
		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) :
			$related_title = ot_get_option( 'related_title', 'Related Posts' ); 			
			?>
			<!-- Title -->	
			<h4 class="h4-xs m-bottom-50"><?php printf( _x( '%s','Related Posts title', 'pergo' ), esc_attr($related_title)) ?></h4>
			<div class="row">
			<?php
			while( $my_query->have_posts() ):
				$my_query->the_post(); 
				?>
				<div class="col-md-6">
					<div class="blog-post-txt m-bottom-10">
						<?php if( has_post_thumbnail() ): ?>
							<!-- BLOG POST IMAGE -->
							<div class="blog-post-img m-bottom-25">
								<?php the_post_thumbnail( 'pergo-800x400-crop', array('class' => 'img-fluid') ) ?>	
							</div>
						<?php endif; ?>
						
						<!-- Post Data -->
						<?php pergo_entry_meta('related_post_meta'); ?>
						<!-- Post Title -->
						<a href="<?php the_permalink(); ?>"><h5 class="h5-sm"><?php the_title(); ?></h5></a>
						<!-- Post Text -->
						<p class="m-bottom-25"><?php echo pergo_get_trim_words(get_the_excerpt(), 13, '...'); ?></p>
					</div>
				</div>
			<?php endwhile; ?>
		</div> <!-- End row -->	
		<?php endif; ?>	
	</div>
	<?php
	$post = $orig_post;
	wp_reset_postdata();  
endif; 
endif; 
 ?>