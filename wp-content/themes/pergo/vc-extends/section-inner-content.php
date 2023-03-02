<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_section_inner_content_shortcode_vc' );
function pergo_section_inner_content_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Section inner content', 'pergo' ),
        'base' => 'pergo_section_inner_content',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display Image, video popup & inner content in 2 column', 'pergo' ),
        'as_parent'  => array('only' => 'pergo_section_content, pergo_counter_up_group'),
        'show_settings_on_create' => true,
        'is_container' => true,
        'js_view' => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'checkbox',
                'heading' => __( 'Image in right position?', 'pergo' ),
                'param_name' => 'position',
                'description' => __( 'Default image in left', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'admin_label' => true,                   
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-11-img.jpg',
                'admin_label' => true, 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable video?', 'pergo' ),
                'param_name' => 'enable_video',
                'description' => __( 'Checked to display video on image', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'admin_label' => true,
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Video url', 'pergo' ),
                'param_name' => 'url',
                'description' => '',
                'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
                'dependency' => array(
                     'element' => 'enable_video',
                    'value' => 'yes' 
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
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_Pergo_section_inner_content extends WPBakeryShortCodesContainer {
    }
}