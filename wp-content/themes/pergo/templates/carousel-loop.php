<?php 
if ( $posts->have_posts() ):  
$info = $posts->info;
extract($info);
?>
<div class="post-slider owl-carousel owl-theme" data-autoplay="<?php echo ($autoplay == 'yes')? 1 : 0 ?>" data-column_lg="<?php echo $column; ?>" data-loop="0" data-dots="<?php echo ($dots == 'yes')? 1 : 0 ?>">
    <?php 
    // Posts are found
    $count = 300;
    while ( $posts->have_posts() ) :
        $posts->the_post();
        global $post;
        ?>
        <div class="item">
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
    endwhile; 
   ?>   
</div>
<?php 
// Posts not found
else :
    echo '<h4>' . __( 'Posts not found', 'pergo' ) . '</h4>';
endif; 