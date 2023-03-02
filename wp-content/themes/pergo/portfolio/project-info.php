<?php                 
$portfolio_infos = get_post_meta( get_the_ID(), 'portfolio_infos', true );
if( !empty($portfolio_infos) ):
?>

    <div class="row">                    
        <?php foreach ($portfolio_infos as $key => $value) : ?>    
            <div class="col-md-6">                    
                <div class="project-data">                                  
                    <h5 class="h5-xs"><?php echo esc_attr($value['title']) ?></h5>
                    <p><?php echo esc_attr($value['desc']) ?></p>
                </div>
            </div> 
        <?php endforeach; ?>                    
    </div>
<?php endif; ?> 