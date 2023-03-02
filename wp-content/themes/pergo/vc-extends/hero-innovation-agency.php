<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_innovation_agency_shortcode_vc' );
function pergo_hero_innovation_agency_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Innovation Agency', 'pergo' ),
        'base' => 'pergo_hero_innovation_agency',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display slider with video background', 'pergo' ),
        'as_parent'  => array('only' => 'pergo_slide_item'), 
        'content_element' => true,
        'show_settings_on_create' => true,
        'is_container' => true,
        'js_view' => 'VcColumnView',
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
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_Pergo_hero_innovation_agency extends WPBakeryShortCodesContainer {
    }
}

