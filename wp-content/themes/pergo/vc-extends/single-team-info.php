<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_single_team_info_shortcode_vc');
function pergo_single_team_info_shortcode_vc($return = false) {
    $args = array(
            'icon' => 'pergo-icon',
            'name' => __('Single team Info', 'pergo'),
            'base' => 'pergo_single_team_info',
            'class' => 'pergo-vc',
            'category' => __('Pergo', 'pergo'),
            'description' => 'Display single member info, Only works in single team page.',
            'params' => array(              
                array(
                    'type' => 'dropdown',
                    'heading' => __('Display', 'pergo'),
                    'param_name' => 'template',
                    'value' =>  array(
                            'Team featured image' => 'team/image.php',
                            'Team Designation & Name' => 'team/title.php',
                            'Member information' => 'team/header-info.php',        
                        ),
                    'std' => 'team/header-info.php',
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