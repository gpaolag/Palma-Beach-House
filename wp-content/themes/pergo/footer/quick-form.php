<?php 
$quickform_area = ot_get_option( 'quickform_area', 'off' );
if ( is_page_template( 'templates/onepage-template.php' ) ) {
	$quickform_area = get_post_meta( get_the_ID(), 'quickform_area', true );
	$quickform_area = ( $quickform_area != '' )? $quickform_area : 'off';
}
if( $quickform_area == 'on' ):
	$quickform_title = ot_get_option( 'quickform_title', 'Quick Contact Form' );
	$quickform_title = sprintf( _x('%s', 'Contact form title', 'pergo'), $quickform_title );
	$quickform_shortcode = ot_get_option( 'quickform_shortcode', '' );
	if( $quickform_shortcode != '' ):
?>
<div id="quick-form">
	<div class="bottom-form">


		<!-- QUICK FORM HEADER -->
		<div class="bottom-form-header bg-dark">
			<i class="far fa-envelope"></i>
			<p><?php echo esc_attr($quickform_title) ?></p>	            		
    	</div>


    	<!-- QUICK FORM -->
        <div class="bottom-form-holder">		
			<div name="contactform" class="quick-contact-form">
																			
					<?php echo do_shortcode($quickform_shortcode); ?>
																					
			</div>						
		</div>

	</div>
</div>	  <!-- END BOTTOM QUICK FORM -->
<?php endif; ?>
<?php endif; ?>