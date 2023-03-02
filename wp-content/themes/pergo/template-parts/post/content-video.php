<?php $video_popup_enable = get_post_meta( get_the_ID(), 'video_popup_enable', true ); ?>
<?php $video_url = get_post_meta( get_the_ID(), 'video_url', true ); ?>
<!-- BLOG POST #3 --> 
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-animation="fadeInUp" data-animation-delay="700">

		<?php if( has_post_thumbnail() ): 
			$video = get_post_meta( get_the_ID(), '_format_video_embed', true );
			?>
		<!-- BLOG POST IMAGE -->
		<div class="blog-post-img m-bottom-25">
			<div class="video-preview text-center m-bottom-10">

				<!-- Change the link HERE!!! -->						
			<a class="video-popup2" href="<?php echo esc_url($video_url) ?>"> 
				<!-- Play Icon -->									
				<div class="video-btn-md animated" data-animation="fadeInUp" data-animation-delay="800">	
					<div class="video-block-wrapper">
						<div class="play-icon-<?php echo pergo_default_color(); ?>"><div class="ico-bkg"></div>
							<i class="fas fa-play-circle"></i>
						</div>
					</div>
				</div>
				<!-- Preview Image -->
				<?php the_post_thumbnail( 'pergo-800x400-crop', array('class' => 'img-fluid') ) ?>

			</a>								

		</div>
	</div>
	<?php endif; ?>

	<!-- BLOG POST TEXT -->
	<div class="blog-post-txt m-bottom-10">
		<!-- Post Data -->		
		<?php pergo_entry_meta(); ?>
				
		<!-- Post Title -->
		<h5 class="h5-lg"><?php pergo_sticky_post_text(); ?><a class="rose-hover" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>

		<!-- Post Text -->
		<div class="m-bottom-25">
			<?php the_excerpt(); ?>
		</div>

	</div>

	<?php
	wp_link_pages( array(					
		'nextpagelink'     => __( 'Next', 'pergo'),
		'previouspagelink' => __( 'Previous', 'pergo' ),
		'pagelink'         => '%',
		'echo'             => 1
	) );

	$read_more_text = ot_get_option( 'read_more_text', 'More Details' );
	$read_more_text = sprintf( _x('%s', 'Read more text', 'pergo'), $read_more_text );
	?>

	<!-- Post Link -->
	<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-arrow btn-<?php echo pergo_default_color(); ?>" >
		<span><?php echo esc_attr($read_more_text); ?> <i class="fas fa-angle-double-right"></i></span>
	</a>


</div>	<!-- END BLOG POST #1 -->
