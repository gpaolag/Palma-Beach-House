<!-- IMAGE #1 -->
<div class="hover-overlay">

    <!-- Project Link -->
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
        
        <!-- Project Preview Image -->
        <?php the_post_thumbnail( 'pergo-400x400-crop', array('class' => 'img-fluid') ) ?>    
        <div class="item-overlay"></div> 
        <!-- Project Description -->
        <div class="project-description white-color"> 
            <!-- Project Meta -->
            <?php echo pergo_get_the_term_list( get_the_ID(), 'portfolio_category', '<span class="'.pergo_default_color().'-color">', ', ', '</span>', true ) ?>                                                                                    
            <!-- Project Link -->
            <h5 class="h5-sm"><?php the_title(); ?></h5>
        </div>
    </a>

</div> 