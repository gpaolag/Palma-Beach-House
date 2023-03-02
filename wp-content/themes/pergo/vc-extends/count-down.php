<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_count_down_shortcode_vc' );
function pergo_count_down_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Countdown', 'pergo' ),
        'base' => 'pergo_count_down',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display countdown by date-time', 'pergo' ),
        'params' => array(            
            array(
                'type' => 'textfield',
                'heading' => __( 'Date & time', 'pergo' ),
                'param_name' => 'date',
                'description' => 'Format: Year/Month/Date Hours:Minutes:Second e.g: 2019/11/23 09:00:00',
                'value' => '2019/11/23 09:00:00' ,
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Countdown text', 'pergo' ),
                'param_name' => 'datetxt',
                'description' => 'Format: Days:HRS:MIN:SEC',
                'value' => 'Days:HRS:MIN:SEC' ,
                'admin_label' => true 
            ), 
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(), 
        )
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_count_down extends WPBakeryShortCode {
}