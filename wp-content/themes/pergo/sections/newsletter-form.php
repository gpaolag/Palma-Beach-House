<div class="row d-flex align-items-center" id="newsletter-1">
	<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0"> <!-- NEWSLETTER TEXT -->
		<div class="newsletter-txt">
			<h3 class="h3-xs"><?php echo pergo_parse_text($title) ?></h3>
		</div>
	</div>
	<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0"> <!-- NEWSLETTER FORM -->
		<div class="p-left-30">						
			<?php				

				if( class_exists('ES_Shortcode') ){
					echo do_shortcode($placeholder);
				}else{
					echo 'Please Install Theme Required & Recommended PLugins.';
				}
				?>		
		</div>
	</div>
</div>
