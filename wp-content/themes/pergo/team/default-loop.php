<?php if ( $posts->have_posts() ):  
	$info = $posts->info;  //print_r($info);
	$animation_duration = 300;	
	?>
	<div class="row" id="team-1">               
		<?php
		$count = 1;
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post;
			?>					
				<div class="col-md-6 col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($animation_duration) ?>">
					<div class="team-member white-color">
					    <!-- Team Member Photo -->					    
					    <img src="<?php the_post_thumbnail_url( 'pergo-400x400-crop' ); ?>" class="img-fluid" alt="<?php the_title_attribute(); ?>">	
					    <div class="tm-overlay"></div>

					    <!-- Team Member Meta -->       
					    <div class="tm-meta">
					        <?php $designation = get_post_meta( $post->ID, 'designation', true ); ?>
					        <h5 class="h5-sm"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
					        <span class="<?php echo pergo_default_color(); ?>-color"><?php echo esc_attr($designation) ?></span>

					        <?php
					        $social_links = get_post_meta( $post->ID, 'social_links', true );
					        $social_links_display = get_post_meta( get_the_ID(), 'member_social_links_display', true );
					        if( !empty($social_links) && ($social_links_display != 'off') ):
					          ?>
					          <div class="tm-social clearfix">
					          <ul class=" text-center clearfix">
					            <?php 
					            foreach ($social_links as $key => $value) {      
					              echo '<li><a class="ico-'.esc_attr(strtolower($value['title'])).' text-center" target="_blank" href="'.esc_url($value['icon_link']['input']).'" title="'.esc_attr($value['title']).'"><i class="fab '.esc_attr($value['icon_link']['icon']).'"></i></a></li>';
					            }
					            ?>
					          </ul></div>
					        <?php endif; ?>
					    </div>
					</div>
				</div><!-- .single-team-member -->		
				<?php $animation_duration = $animation_duration + 100;	?>		
		<?php endwhile; ?>	
		<?php get_template_part( 'team/hiring' ); ?>		
	</div> <!-- .row -->
	<?php	
// Posts not found
else :
	echo '<h4>' . __( 'Posts not found', 'pergo' ) . '</h4>';
endif;
?>

