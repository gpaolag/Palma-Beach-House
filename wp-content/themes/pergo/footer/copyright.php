<?php 
$footer_copyright_bar = ot_get_option( 'footer_copyright_bar', 'on' ); 
if( $footer_copyright_bar == 'on' ):
	$copyright_text = ot_get_option( 'copyright_text', '&copy; ' . date( 'Y' ).' <span>Pergo.</span> All Rights Reserved' );
	$copyright_text = sprintf( _x('%s', 'Copyright text', 'pergo'), $copyright_text );
	?>
	<!-- FOOTER COPYRIGHT -->
	<div class="row bottom-footer">						
		<div class="col-md-12">
			<div class="footer-copyright">
				<?php                               
	                
	            ?>
				<p class="m-bottom-0"><?php echo do_shortcode($copyright_text); ?></p>
			</div>
		</div>
	</div>	<!-- END FOOTER COPYRIGHT -->
<?php endif; ?>