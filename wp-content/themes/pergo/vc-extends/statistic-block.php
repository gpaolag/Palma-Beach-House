<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_statistic_block_shortcode_vc' );
function pergo_statistic_block_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Statistic block', 'pergo' ),
        'base' => 'pergo_statistic_block',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display Statistic in 3 column', 'pergo' ),
        'params' => array(            
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Statistics', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'title' => '10.154',
                        'subtitle' => 'Happy Clients',
                    ),
                    array(
                        'title' => '5.069',
                        'subtitle' => 'Tickets Closed',
                    ),
                    array(
                        'title' => '28.189',
                        'subtitle' => 'Followers',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'value' => '',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Sub-Title', 'pergo' ),
                        'param_name' => 'subtitle',
                        'value' => '',
                        'admin_label' => true 
                    ),
                )
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
class WPBakeryShortCode_Pergo_statistic_block extends WPBakeryShortCode {
}