<?php get_header(); ?>

	
		<?php get_template_part( 'template-parts/content', 'before' );	?>	

		<?php
		if ( have_posts() ) :

			 woocommerce_content(); 

		endif;
		?>

	<?php get_template_part( 'template-parts/content', 'after' );	?>
	 			

<?php get_footer(); ?>