<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_our_clients_shortcode_vc' );
function pergo_our_clients_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Our clients', 'pergo' ),
        'base' => 'pergo_our_clients',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display clients images', 'pergo' ),
        'params' => array( 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display style', 'pergo' ),
                'param_name' => 'style',
                'std' => 'style1',
                'value' => array(
                    '4 column' => 'style1',
                    'Title + 5 column' => 'style2',
                ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Over 2000+ companies are already using {PERGO} every day. ',   
                'dependency' => array(
                    'element' => 'style',
                    'value' => 'style2'
                )            
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Brands', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-11.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-17.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-13.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-18.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'image' => PERGO_URI. '/images/brand-19.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-16.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-14.png',
                    ),
                    array(
                        'title' => 'Brand image',
                        'url' => '',
                        'image' => PERGO_URI. '/images/brand-15.png',
                    ),
                ) ) ),
                'params' => array(
                     array(
                         'type' => 'textfield',
                        'heading' => __( 'Brand name', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => 'Brand name',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'image_upload',
                        'heading' => __( 'Brand Image', 'pergo' ),
                        'param_name' => 'image',
                        'description' => '', 
                    ),
                    array(
                         'type' => 'textfield',
                        'heading' => __( 'Brand url', 'pergo' ),
                        'param_name' => 'url',
                        'description' => __( 'Optional', 'pergo' ),
                        'value' => '',
                    ),
                ) 
            )  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_our_clients extends WPBakeryShortCode {
}