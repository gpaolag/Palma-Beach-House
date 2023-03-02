<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_watch_video_shortcode_vc' );
function pergo_watch_video_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Watch video', 'pergo' ),
        'base' => 'pergo_watch_video',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display image & video popup', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display type', 'pergo' ),
                'param_name' => 'style',
                'value' => array(
                    'Default' => 'style1',
                    'Style 2 (Title & icon)' => 'style2',
                ),
                'admin_label' => true 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Video Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/video-3-img.png' ,
                'dependency' => array(
                     'element' => 'style',
                    'value' => 'style1' 
                ) 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Watch video',
                'admin_label' => true 
            ), 
            array(
                'type' => 'textfield',
                'heading' => __( 'Video url', 'pergo' ),
                'param_name' => 'url',
                'description' => 'Example: https://www.youtube.com/embed/YOUR_VIDEO_ID',
                'value' => 'https://www.youtube.com/embed/7e90gBu4pas',
                'admin_label' => true 
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
class WPBakeryShortCode_Pergo_watch_video extends WPBakeryShortCode {
}