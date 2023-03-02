<?php if(PergoHeader::header_banner_is_on()): 
	
	$bg_color = ot_get_option( 'breadcrumbs_overlay_type', 'bg-dark' );
	$bg_color = 'bg-'.$bg_color;
	$white_color = '';
	if( ($bg_color == 'bg-dark') || ($bg_color == 'bg-rose') ){
		$white_color = ' white-color';
	}
	?>
<!-- BLOG LISTING PAGE HERO
============================================= -->	
<section id="blog-listing-hero" class="bg-scroll breadcrumbs-area page-hero-section division <?php echo esc_attr($bg_color) ?>">
	<div class="container">	
		<div class="row">

			<!-- HERO TEXT -->
			<div class="col-md-10 offset-md-1">
				<div class="hero-txt text-center<?php echo esc_attr($white_color) ?>">

					<!-- Title -->
					<h2 class="h2-xl"><?php echo PergoHeader::get_title(); ?></h2>
					<?php if( PergoHeader::header_breadcrumb_is_on()) : ?>
						<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
							<ul class="list-inline">
								<?php 
									if(function_exists('bcn_display_list')){
									    bcn_display_list();
									}
								?>
							</ul>
						</div><!-- .breadcrumbs -->
					<?php endif; ?>
					<!-- Text -->
					<p class="p-hero subtitle">
						<?php echo PergoHeader::get_subtitle(); ?>						
					</p>				

				</div>
			</div>	<!-- END HERO TEXT -->

		</div>	  <!-- End row -->
	</div>	   <!-- End container --> 	
</section>	<!-- END BLOG LISTING HERO -->
<?php else: ?>
	<?php PergoHeader::get_shortcode() ?>
<?php endif; ?>