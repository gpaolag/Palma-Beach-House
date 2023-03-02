<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_highlight_boxes_shortcode_vc' );
function pergo_highlight_boxes_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Highlight boxes', 'pergo' ),
        'base' => 'pergo_highlight_boxes',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display Highlight box in 3 column', 'pergo' ),
        'params' => array(  
            array(
                'type' => 'dropdown',
                'heading' => __( 'Column', 'pergo' ),
                'param_name' => 'column',
                'value' => array(
                    '2 column' => 'col-md-6',
                    '3 column' => 'col-md-4',
                    '4 column' => 'col-md-3',
                ),
                'std' => 'col-md-4',
                'admin_label' => true 
            ),          
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Boxes', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'title' => 'Get better health care for you and your family',
                        'subtitle' => 'An magnis nulla dolor sapien augue erat iaculis purus tempor magna ipsum and vitae purus primis ipsum magna ipsum odio mauris lectus laoreet ',
                    ),
                    array(
                        'title' => 'Our packages are budget friendly for everyone',
                        'subtitle' => 'An magnis nulla dolor sapien augue erat iaculis purus tempor magna ipsum and vitae purus primis ipsum magna ipsum odio mauris lectus laoreet ',
                    ),
                    array(
                        'title' => 'Group of certified and experienced doctors',
                        'subtitle' => 'An magnis nulla dolor sapien augue erat iaculis purus tempor magna ipsum and vitae purus primis ipsum magna ipsum odio mauris lectus laoreet ',
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
                        'type' => 'textarea',
                        'heading' => __( 'Sub-Title', 'pergo' ),
                        'param_name' => 'subtitle',
                        'value' => '',
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
class WPBakeryShortCode_Pergo_highlight_boxes extends WPBakeryShortCode {
}