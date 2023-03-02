<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_section_videobg_shortcode_vc' );
function pergo_section_videobg_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Section video background', 'pergo' ),
        'base' => 'pergo_section_videobg',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display video background in section', 'pergo' ),        
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Poster Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/video/video.jpg' 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( '.mp4 format video', 'pergo' ),
                'param_name' => 'mp4',
                'description' => '',
                'value' => '//jthemes.org/wp/pergo/files/images/video/video.mp4' 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( '.webm format video', 'pergo' ),
                'param_name' => 'webm',
                'description' => '',
                'value' => '//jthemes.org/wp/pergo/files/images/video/video.webm' 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( '.ogv format video', 'pergo' ),
                'param_name' => 'ogv',
                'description' => '',
                'value' => '//jthemes.org/wp/pergo/files/images/video/video.ogv' 
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
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container

class WPBakeryShortCode_Pergo_section_videobg extends WPBakeryShortCodesContainer {
}

