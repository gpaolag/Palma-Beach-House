<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_domain_names_shortcode_vc' );
function pergo_domain_names_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Domain name type', 'pergo' ),
        'base' => 'pergo_domain_names',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display number, title & subtitle ', 'pergo' ),
        'params' => array(
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
            ),  
            array(
                'type' => 'textfield',
                'heading' => __( 'Shortcode', 'pergo' ),
                'param_name' => 'shortcode',
                'description' => 'Please make sure "Wp domain checker" plugin is activated',
                'value' => '[wpdomainchecker button="Search Domain"]',
                'admin_label' => true 
            ),
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Counter up', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(                    
                        'color' => 'blue',
                        'title' => '.com', 
                        'subtitle' => '$13.99',
                    ),
                    array(                    
                        'color' => 'red',
                        'title' => '.org', 
                        'subtitle' => '$9.99',
                    ),
                    array(                    
                        'color' => 'yellow',
                        'title' => '.net', 
                        'subtitle' => '$11.99',
                    ),
                    array(                    
                        'color' => 'lightgreen',
                        'title' => '.biz', 
                        'subtitle' => '$5.99',
                    ),
                ) ) ),
                'params' => array(
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Domain type', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => '',
                        'admin_label' => true 
                    ),                    
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Price', 'pergo' ),
                        'param_name' => 'subtitle',
                        'description' => '',
                        'value' => '',
                    ), 
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Title Color', 'pergo' ),
                        'param_name' => 'color',
                        'value' => pergo_vc_color_options(true),
                    ), 
                ),
                
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
class WPBakeryShortCode_Pergo_domain_names extends WPBakeryShortCode {
}