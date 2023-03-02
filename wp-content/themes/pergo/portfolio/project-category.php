<?php
$category_title = get_post_meta( get_the_ID(), 'category_title', true );
?>                        
<div class="project-data">                                  
    <h5 class="h5-xs"><?php echo esc_attr($category_title) ?></h5>
    <p><?php echo pergo_get_the_term_list( get_the_ID(), 'portfolio_category', '<span class="'.pergo_default_color().'-color">', ', ', '</span>', true ) ?></p>
</div><!-- Client -->
