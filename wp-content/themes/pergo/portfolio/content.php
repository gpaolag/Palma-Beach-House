<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    $vc_display = get_post_meta( get_the_ID(), 'project_vc_display', true );
    $vc_display = ( $vc_display == '' )? 'off' : $vc_display;
    if( $vc_display == 'off' ):
    ?>
    <div class="row">       
        <div class="col-md-6">
            <div class="project-img">
                <?php 
                $image_display = get_post_meta( get_the_ID(), 'project_image_display', true );
                $image_display = ( $image_display == '' )? 'on' : $image_display;
                if( $image_display != 'off' ):
                
                get_template_part('portfolio/project-image');
                endif;

                $info_display = get_post_meta( get_the_ID(), 'project_info_display', true );
                $info_display = ( $info_display == '' )? 'on' : $info_display;
                if( $info_display != 'off' ){
                    get_template_part('portfolio/project-info'); 
                }
                ?>
                 
                <div class="row">
                    <?php
                    $cat_display = get_post_meta( get_the_ID(), 'project_cat_display', true );
                    $cat_display = ( $cat_display == '' )? 'on' : $cat_display;
                    if( $cat_display != 'off' ){
                        echo '<div class="col-md-6">';
                        get_template_part('portfolio/project-category');
                        echo '</div>';
                    } 
                 
                    $share_display = get_post_meta( get_the_ID(), 'project_share_display', true );
                    $share_display = ( $share_display == '' )? 'on' : $share_display;
                    if( $share_display != 'off' ){
                        echo '<div class="col-md-6">';
                        get_template_part('portfolio/project-share');
                        echo '</div>';
                    } 
                    ?>
                </div>  <!-- End row -->
            </div>  
        </div>  <!-- END SINGLE PROJECT IMAGE -->
        
        <div class="col-md-6">
            <div class="project-txt p-left-30">
                <?php
                $title_display = get_post_meta( get_the_ID(), 'project_title_display', true );
                $title_display = ( $title_display == '' )? 'on' : $title_display;
                if( $title_display != 'off' ){
                    get_template_part('portfolio/project-title');
                } 
               
                the_content(); 
                $button_display = get_post_meta( get_the_ID(), 'portfolio_button_display', true );
                $button_display = ( $button_display == '' )? 'on' : $button_display;
                if( $button_display == 'on' ){
                    get_template_part('portfolio/project-buttons');
                } 
                ?> 
            </div><!-- END SINGLE PROJECT TEXT -->  
        </div>  
    </div>
    <?php else: ?>
    <?php the_content(); ?>
    <?php endif; ?>
</div>