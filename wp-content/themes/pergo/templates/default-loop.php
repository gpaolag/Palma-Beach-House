<?php 
if ( $posts->have_posts() ):  
$info = $posts->info;
?>
<div class="row">
    <?php 
    // Posts are found
    $count = 300;
    while ( $posts->have_posts() ) :
        $posts->the_post();
        global $post;
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="blog-post animated" data-animation="fadeInUp" data-animation-delay="<?php echo intval($count) ?>">        
                <?php if( has_post_thumbnail() ): ?>
                    <!-- BLOG POST IMAGE -->
                    <div class="blog-post-img m-bottom-30">
                        <img class="img-fluid" src="<?php the_post_thumbnail_url( esc_attr($info['img_size']) ); ?>" alt="<?php the_title_attribute(); ?>" /> 
                    </div>
                <?php endif; ?>

                <!-- BLOG POST TEXT -->
                <div class="blog-post-txt">
                    <!-- Post Data -->
                    <?php pergo_entry_meta(); ?>
                    <!-- Post Title -->
                    <h5 class="h5-md">
                        <a class="rose-hover" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h5>
                    <!-- Post Text -->
                    <p><?php echo pergo_get_trim_words(get_the_excerpt(), intval($info['excerpt_length']), '...'); ?>
                    </p>

                </div>
            </div>
        </div>

        <?php  
        $count = $count + 100;
    endwhile; 
   ?>   
</div>
<?php 
// Posts not found
else :
    echo '<h4>' . __( 'Posts not found', 'pergo' ) . '</h4>';
endif; 





