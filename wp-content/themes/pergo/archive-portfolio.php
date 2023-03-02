<?php get_header(); ?> 


    <?php get_template_part( 'template-parts/content', 'before' );  ?>

        
        <?php 
            if ( have_posts() ) : 
                echo '<div id="portfolio-1" class="portfolio-section">';

                pergo_portfolio_archive_content();
                $filter_display = ot_get_option( 'portfolio_archive_filter_display', 'off' );
                if(  $filter_display == 'on' ){
                    get_template_part('portfolio/filter');
                    $animation = "none";
                }else{
                    $animation = "fadeInUp";
                }
                

                echo '<div class="row portfolio-items-list">';

                // Start the loop.
                $animation_duration = 100;
                while ( have_posts() ) : the_post();
                    /*
                    * Include the Post-Format-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    */
                    ?>
                    <div <?php post_class('portfolio-item col-md-6 col-lg-4 m-top-30 animated '.pergo_get_the_term_list( get_the_ID(), 'portfolio_category', ' ', ' ', '', false )); ?>  data-animation="<?php echo esc_attr($animation); ?>" data-animation-delay="<?php echo intval($animation_duration) ?>">
                    <?php get_template_part( 'portfolio/content', 'loop' ); ?>
                    </div>
                    <?php             

                    $animation_duration = $animation_duration + 100;
                    // End the loop.
                endwhile;

                echo '</div></div>';

                pergo_numeric_posts_nav();

                // If no content, include the "No posts found" template.
                else :

                get_template_part( 'template-parts/post/content', 'none' );           

            endif;
        ?>
        

        <?php get_template_part( 'template-parts/content', 'after' );   ?>


<?php get_footer(); ?>