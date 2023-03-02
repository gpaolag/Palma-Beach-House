<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_counter_up_shortcode_vc' );
function pergo_counter_up_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Counter up', 'pergo' ),
        'base' => 'pergo_counter_up',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display number, title & subtitle ', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Count prefix', 'pergo' ),
                'param_name' => 'count_prefix',
                'description' => 'Display in just before countable number. e.g. $',
                'value' => '' ,
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Count', 'pergo' ),
                'param_name' => 'count',
                'description' => 'Number only',
                'value' => '1154' ,
                'admin_label' => true 
            ), 
            array(
                'type' => 'textfield',
                'heading' => __( 'Count postfix', 'pergo' ),
                'param_name' => 'count_postfix',
                'description' => 'Display in just after countable number. e.g. k',
                'value' => '' ,
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'description' => '',
                'value' => 'Happy Clients',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub-Title', 'pergo' ),
                'param_name' => 'subtitle',
                'description' => '',
                'value' => 'Viverra sem magna egestas',
            ),   
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'std' => 'center',
                'value' => array(
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                ),
                'admin_label' => true,
                'group' => __( 'Design option', 'pergo' ),
            ),  
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter prefix color', 'pergo' ),
                'param_name' => 'prefix_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'default',
                'description' => __( 'Only worked for Counter prefix', 'pergo' ),                 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter color', 'pergo' ),
                'param_name' => 'counter_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'default',
                'description' => __( 'Only worked for Counter up number', 'pergo' ),                 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counter postfix color', 'pergo' ),
                'param_name' => 'postfix_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'default',
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
            
        ),        
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_counter_up extends WPBakeryShortCode {
}