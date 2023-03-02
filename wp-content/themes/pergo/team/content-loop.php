<div class="team-member white-color">                               
                            
    <!-- Team Member Photo -->
    <?php the_post_thumbnail( 'pergo-400x400-crop', array('class' => 'img-fluid') ) ?>  
    <div class="tm-overlay"></div>

    <!-- Team Member Meta -->       
    <div class="tm-meta">
        <?php $designation = get_post_meta( get_the_ID(), 'designation', true ); ?>
        <h5 class="h5-sm"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
        <span class="<?php echo pergo_default_color(); ?>-color"><?php echo esc_attr($designation) ?></span>

        <?php
        $social_links = get_post_meta( get_the_ID(), 'social_links', true );
        $social_links_display = get_post_meta( get_the_ID(), 'member_social_links_display', true );
        if( !empty($social_links) && ($social_links_display != 'off') ):
          ?>
          <div class="tm-social clearfix">
          <ul class=" text-center clearfix">
            <?php 
            foreach ($social_links as $key => $value) {      
              echo '<li><a class="ico-'.esc_attr(strtolower($value['title'])).' text-center" target="_blank" href="'.esc_url($value['icon_link']['input']).'" title="'.esc_attr($value['title']).'"><i class="fab '.esc_attr($value['icon_link']['icon']).'"></i></a></li>';
            }
            ?>
          </ul></div>
        <?php endif; ?>

    </div>  

</div> 