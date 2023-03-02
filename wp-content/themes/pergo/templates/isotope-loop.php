<?php 
if ( $posts->have_posts() ): 
$info = $posts->info;
extract($info);
$size = (!$img_size)? 'pergo-400x--nocrop' : $img_size;
?>
<!--   PORTFOLIO  -->
<div id="portfolio-1" class="portfolio-section">
	<?php 
	$args = array(
	    'hide_empty' => true,
	    'taxonomy' => $taxonomy
	);

	if($tax_term != '') $args['include'] = $tax_term;

	$terms = get_terms( $args );
	if( !empty($terms) && ($filter == 'yes') ):
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
		$count = 300;
		while ( $posts->have_posts() ) : $posts->the_post(); ?>				

               <!-- IMAGE #1 -->
				<div class="col-md-6 col-lg-4 portfolio-item <?php echo pergo_get_the_term_list( get_the_ID(), 'category', ' ', ' ', '', false ) ?>">
					<div class="blog-post fadeInUp">        
                <?php if( has_post_thumbnail() ): ?>
                    <!-- BLOG POST IMAGE -->
                    <div class="blog-post-img m-bottom-30">
                        <img class="img-fluid" src="<?php the_post_thumbnail_url( esc_attr($info['img_size']) ); ?>" alt="<?php the_title_attribute(); ?>" /> 
                    </div>
                <?php endif; ?>

                <!-- BLOG POST TEXT -->
                <div class="blog-post-txt">
                    <!-- Post Data -->
                    <?php pergo_entry_meta(); ?>
                    <!-- Post Title -->
                    <h5 class="h5-md">
                        <a class="rose-hover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h5>
                    <!-- Post Text -->
                    <p><?php echo pergo_get_trim_words(get_the_excerpt(), intval($info['excerpt_length']), '...'); ?>
                    </p>

                </div>
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