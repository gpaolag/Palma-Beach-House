<?php $video_popup_enable = get_post_meta( get_the_ID(), 'video_popup_enable', true ); ?>
<?php $video_url = get_post_meta( get_the_ID(), 'video_url', true ); ?>

	<!-- BLOG POST #1 --> 
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-animation="fadeInUp" data-animation-delay="300">

		<?php if( has_post_thumbnail() ): ?>
			<!-- BLOG POST IMAGE -->
			<div class="blog-post-img m-bottom-25">
				<?php if($video_popup_enable == 'on'): ?>					
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
				<?php endif; ?>
				<?php the_post_thumbnail( 'pergo-800x400-crop', array('class' => 'img-fluid') ) ?>
				<?php if($video_popup_enable == 'on'): ?>
								</a>					

					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	<!-- BLOG POST TEXT -->
	<div class="sblog-post-txt m-bottom-10">

		<!-- Post Data -->		
		<?php pergo_entry_meta( 'single_post_meta' ); ?>
		
		<!-- Post Title -->
		
		<?php the_title(pergo_post_title_before(), pergo_post_title_after());?>

		<!-- Post Text -->
		<div class="m-bottom-25 entry-content">
			<?php the_content(); ?>
		</div>

	</div>

	<?php pergo_social_share(); ?>

</div>	<!-- END BLOG POST #1 -->

<hr>
