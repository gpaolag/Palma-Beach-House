<?php
$newsletter_area = ot_get_option( 'newsletter_area', 'on' );
if( ($newsletter_area == 'on') && !is_page() ):
	$bg = ot_get_option( 'newsletter_bg' );
	$newsletter_title = ot_get_option( 'newsletter_title', 'Stay up to date with our news, ideas and updates' );
	$newsletter_title = sprintf( _x('%s', 'Copyright text', 'pergo'), $newsletter_title );
	$newsletter_placeholder = ot_get_option( 'newsletter_placeholder', 'Your email address' );
	$placeholder = sprintf( _x('%s', 'Copyright text', 'pergo'), $newsletter_placeholder );
	?>
	<!-- NEWSLETTER-1 -->
	<section id="newsletter-1" class="bg-scroll bg-image wide-100 newsletter-section division"<?php echo pergo_inline_bg_image($bg) ?>>
		<div class="container white-color">
			<div class="row d-flex align-items-center">
				
				<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0">
					<div class="newsletter-txt"><h3 class="h3-xs"><?php echo pergo_parse_text($newsletter_title); ?></h3></div>
				</div><!-- NEWSLETTER TEXT -->


				<!-- NEWSLETTER FORM -->
				<div class="col-md-8 col-lg-6 offset-md-2 offset-lg-0">
					<div class="p-left-30">						
						<?php 
							if( class_exists('ES_Shortcode') ){ 
								$atts['es_desc'] = '';
				       			$atts['es_group'] = 'Public';
								$atts['es_desc']  = trim($atts['es_desc']);
						        $atts['es_group'] = trim($atts['es_group']);
						        $atts['es_pre'] = 'shortcode';

								
								
								$atts['email'] = esc_attr($placeholder);
								$atts['button_text'] = 'fas fa-arrow-right';
								$atts['button_style'] = 'btn-rose';
								$atts['enable_name'] = false;
								$atts['name'] = false;
								$atts['el_class'] = false;
								echo PergoNewsletter::es_get_form_simple( $atts );
							}else{
								echo 'Please Install Theme Required & Recommended PLugins.';
							}
							?>		
					</div>
				</div>
			</div>	  <!-- End row -->
		</div>	   <!-- End container -->	
	</section>	<!-- END NEWSLETTER-1 -->
	<?php 
endif; ?>