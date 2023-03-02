<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_counter_up_group_shortcode_vc' );
function pergo_counter_up_group_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Counter up Group', 'pergo' ),
        'base' => 'pergo_counter_up_group',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display number, title & subtitle ', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Column', 'pergo' ),
                'param_name' => 'column',
                'std' => 'col-sm-6 col-md-6',
                'value' => array(
                    '1/4 column' => 'col-sm-3 col-md-3',
                    '1/3 column' => 'col-sm-4 col-md-4',
                    '1/2 column' => 'col-sm-6 col-md-6',
                    'FUll width column' => 'col-md-12',                    
                ),
                'admin_label' => true,
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'std' => 'left',
                'value' => array(
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                ),
                'admin_label' => true,
            ),  
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Counter up', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'count_prefix' => '',
                        'count_postfix' => '',
                        'count' => '1154',
                        'title' => 'Happy Clients', 
                        'subtitle' => '',
                    ),
                    array(
                        'count_prefix' => '',
                        'count_postfix' => '',
                         'title' => 'Tickets Closed',
                        'count' => '409',
                        'subtitle' => '',
                    ),
                ) ) ),
                'params' => array(
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => '',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Count prefix', 'pergo' ),
                        'param_name' => 'count_prefix',
                        'description' => 'Display in just before countable number. e.g. $',
                        'value' => '' ,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Count', 'pergo' ),
                        'param_name' => 'count',
                        'description' => 'Number only',
                        'value' => '' ,
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Count postfix', 'pergo' ),
                        'param_name' => 'count_postfix',
                        'description' => 'Display in just after countable number. e.g. k',
                        'value' => '' ,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Sub-Title', 'pergo' ),
                        'param_name' => 'subtitle',
                        'description' => '',
                        'value' => '',
                    ),  
                ),
                
            ),
            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter prefix color', 'pergo' ),
                'param_name' => 'prefix_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'rose',
                'description' => __( 'Only worked for Counter prefix', 'pergo' ),                 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter color', 'pergo' ),
                'param_name' => 'counter_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'rose',
                'description' => __( 'Only worked for Counter up number', 'pergo' ),                 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter postfix color', 'pergo' ),
                'param_name' => 'postfix_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'rose',
                'description' => __( 'Only worked for Counter postfix', 'pergo' ),                 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Title color', 'pergo' ),
                'param_name' => 'title_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'default',
                'description' => __( 'Only worked for title', 'pergo' ),                 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Subtitle color', 'pergo' ),
                'param_name' => 'subtitle_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'lightgrey',
                'description' => __( 'Only worked for subtitle', 'pergo' ),                 
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
class WPBakeryShortCode_Pergo_counter_up_group extends WPBakeryShortCode {
}