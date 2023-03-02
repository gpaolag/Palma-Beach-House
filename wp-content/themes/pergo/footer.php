		<?php get_template_part( 'footer/newsletter' ); ?>
		<?php $footer_bg_style = ot_get_option( 'footer_bg_style', '' ); ?>
		<?php $footer_widget_display = ot_get_option( 'footer_widget_area', 'on' ); ?>
		
		<!-- FOOTER-1
		============================================= -->
		<footer id="footer-1" class="footer division footer-widget-<?php echo esc_attr($footer_widget_display) ?> <?php echo esc_attr($footer_bg_style) ?>">
			<div class="container">

				<?php if( $footer_widget_display == 'on' ): ?>
				<div class="row">
					<?php get_template_part( 'footer/widget-area' ); ?>
				</div>	  <!-- END FOOTER CONTENT -->
				<?php endif; ?>

				<?php get_template_part( 'footer/copyright' ); ?>

			</div>	   <!-- End container -->										
		</footer>	<!-- END FOOTER-1 -->
		<?php get_template_part( 'footer/quick-form' ); ?>
	</div>	<!-- END PAGE CONTENT -->

<?php wp_footer(); ?>

</body>
</html>
