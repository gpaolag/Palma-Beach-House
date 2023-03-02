<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_single_portfolio_info_shortcode_vc');
function pergo_single_portfolio_info_shortcode_vc($return = false) {
    $args = array(
            'icon' => 'pergo-icon',
            'name' => __('Single portfolio Info', 'pergo'),
            'base' => 'pergo_single_portfolio_info',
            'class' => 'pergo-vc',
            'category' => __('Pergo', 'pergo'),
            'description' => 'Display single project info, Only works in single portfolio page.',
            'params' => array(              
                array(
                    'type' => 'dropdown',
                    'heading' => __('Display', 'pergo'),
                    'param_name' => 'template',
                    'value' =>  array(
                            'Project featured image' => 'portfolio/project-image.php',
                            'Project title' => 'portfolio/project-title.php',
                            'Project information' => 'portfolio/project-info.php',
                            'Project category' => 'portfolio/project-category.php',
                            'Project share icons' => 'portfolio/project-share.php', 
                            'Project buttons' => 'portfolio/project-buttons.php',            
                        ),
                    'std' => 'portfolio/project-image.php',
                    'admin_label' => true
                ),
            )       
        );

    $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
    
}