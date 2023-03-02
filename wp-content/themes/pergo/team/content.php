<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    $vc_display = get_post_meta( get_the_ID(), 'member_vc_display', true );
    $vc_display = ( $vc_display == '' )? 'off' : $vc_display;
    if( $vc_display == 'off' ):
    ?>
    <div class="row">        
        <div class="col-md-6">
            <?php 
            $image_display = get_post_meta( get_the_ID(), 'member_image_display', true );
            $image_display = ( $image_display == '' )? 'on' : $image_display;
            if( $image_display != 'off' ):                
                get_template_part( 'team/image' ); 
            endif;             
            ?>
        </div>  <!-- END SINGLE PROJECT IMAGE -->
        
        <div class="col-md-6">
            <div class="p-left-30">
                <?php 
                $title_display = get_post_meta( get_the_ID(), 'member_title_display', true );
                $title_display = ( $title_display == '' )? 'on' : $title_display;
                if( $title_display != 'off' ){
                    get_template_part( 'team/title' );
                }                 
                ?><!-- Title -->
                <?php
                $info_display = get_post_meta( get_the_ID(), 'member_info_display', true );
                $info_display = ( $info_display == '' )? 'on' : $info_display;
                if( $info_display != 'off' ){
                    get_template_part( 'team/header-info' );
                }                 
                ?><!-- Info -->
                <?php the_content(); ?>
            </div>  
        </div>  <!-- END SINGLE PROJECT TEXT -->
    </div>
    <?php else: ?>
    <?php the_content(); ?>
    <?php endif; ?>
</div>