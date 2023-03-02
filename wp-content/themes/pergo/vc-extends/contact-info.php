<?php
/**

* The VC Functions

*/
add_action( 'vc_before_init', 'pergo_contact_info_shortcode_vc' );
function pergo_contact_info_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Contact info', 'pergo' ),
        'base' => 'pergo_contact_info',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title & contact info.', 'pergo' ),
        'params' => array(
             array(
                'type' => 'textfield',
                'value' => 'Our Location',
                'heading' => 'Title',
                'param_name' => 'title',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'value' => '121 King Street, Melbourne,Victoria 3000 Australia',
                'heading' => 'Subtitle',
                'param_name' => 'subtitle',
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
class WPBakeryShortCode_Pergo_contact_info extends WPBakeryShortCode {
}