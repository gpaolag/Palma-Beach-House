<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_google_map_shortcode_vc' );
function pergo_google_map_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Google Map', 'pergo' ),
        'base' => 'pergo_google_map',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display map.', 'pergo' ),
        'params' => array(
            array(
                 'type' => 'dropdown',
                'heading' => esc_attr__( 'Display Type', 'pergo' ),
                'param_name' => 'style',
                'std' => '',
                'value' => array(
                   'Default' => 'default',              
                   'Iframe' => 'embaed',            
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Map title', 'pergo' ),
                'param_name' => 'title',
                'value' => '121 King Street, Melbourne, Victoria 3000 Australia',
                'admin_label' => true 
            ),            
            array(
                'type' => 'textfield',
                'heading' => __( 'Latitude', 'pergo' ),
                'param_name' => 'latitude',
                'value' => '-37.817214',
                'description' => __( 'Number only', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Longitude', 'pergo' ),
                'param_name' => 'longitude',
                'value' => '144.955925',
                'description' => __( 'Number only', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Zoom', 'pergo' ),
                'param_name' => 'zoom',
                'value' => '17',
                'description' => __( 'Number only', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Marker Icon', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/place-marker.png',
                'dependency' => array( 'element' => 'style', 'value' => 'default'),
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
class WPBakeryShortCode_Pergo_google_map extends WPBakeryShortCode {
}