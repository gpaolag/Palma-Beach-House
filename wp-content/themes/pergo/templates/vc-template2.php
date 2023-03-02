<?php
/**
 * Template Name: Full width template 2
 *
 */
get_header(); ?>

   <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( have_posts() ) : ?>
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
           
           the_content();

            // End the loop.
        endwhile;

        // If no content, include the "No posts found" template.
        else :

        get_template_part( 'template-parts/post/content', 'none' );

    endif;
    ?>
    </div>
   

<?php get_footer(); ?>    