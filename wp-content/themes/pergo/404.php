<?php get_header(); ?>

	
		<?php get_template_part( 'template-parts/content', 'before' );	?>

		<div class="404-page text-center">
			<?php
			$title = ot_get_option( '404_title', '404');
			?>
			<h2 class="h2-huge red-color"><?php echo esc_attr($title); ?></h2>

			<?php
			get_template_part( 'template-parts/post/content', 'none' );
			?>
		</div>

	<?php get_template_part( 'template-parts/content', 'after' );	?>
		 			

<?php get_footer(); ?>