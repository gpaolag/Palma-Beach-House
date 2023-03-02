<!-- HERO-9 -->
<div class="hero-class video-play" 
	data-section_id="hero-9" 
	data-class="hero-section bg-video" 
	data-poster="<?php echo esc_url($image) ?>" 
	data-webm="<?php echo esc_url($webm) ?>" 
	data-ogv="<?php echo esc_url($ogv) ?>" 
	data-mp4="<?php echo esc_url($mp4) ?>"> 
	<div class="row">
		<div class="col-lg-12 hero-txt"> <!-- HERO SLIDER HOLDER -->
			<div class="hero-slider text-center">											
				<ul class="slides">
					<?php echo wpb_js_remove_wpautop( $content ); ?>										
				</ul>									
			</div>
		</div>	 <!-- END HERO SLIDER HOLDER -->					
		

	</div>	  <!-- End row -->
</div>	<!-- END HERO-2 -->