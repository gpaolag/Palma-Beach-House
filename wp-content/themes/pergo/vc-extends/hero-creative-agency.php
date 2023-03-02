<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_creative_agency_shortcode_vc' );
function pergo_hero_creative_agency_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Creative Agency', 'pergo' ),
        'base' => 'pergo_hero_creative_agency',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display slider', 'pergo' ),
        'as_parent'  => array('only' => 'pergo_hero_slide'), 
        'content_element' => true,
        'show_settings_on_create' => false,
        'is_container' => true,
        'js_view' => 'VcColumnView',
        'params' => array()       
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
    class WPBakeryShortCode_Pergo_hero_creative_agency extends WPBakeryShortCodesContainer {
    }
}

