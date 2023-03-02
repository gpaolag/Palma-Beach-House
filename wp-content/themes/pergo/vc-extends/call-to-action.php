<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_call_to_action_shortcode_vc' );
function pergo_call_to_action_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Call to action', 'pergo' ),
        'base' => 'pergo_call_to_action',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, description & button', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Style', 'pergo' ),
                'param_name' => 'style',
                'value' => array(
                    '2 column' => 'style1',
                    'Single column + center align' => 'style2',
                    'Simple' => 'style3',
                ),
                'std' => 'style1',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Start growing with {PERGO} today',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'Want to {Learn More?}',
                'dependency' => array(
                    'element' => 'style',
                    'value' => 'style1'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display', 'pergo' ),
                'param_name' => 'display',
                'value' => array(
                    'Button' => 'buttons',
                    'Icons' => 'icons',
                ),
                'std' => 'buttons',
                'admin_label' => true 
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Buttons', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                         'button_text' => 'Get Started Now',
                        'button_size' => 'btn-md',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param(),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'buttons'
                )
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Icon Buttons', 'pergo' ),
                'param_name' => 'params2',
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'icons'
                ),
                'value' => urlencode( json_encode( array(
                    array(
                        'image' => PERGO_URI. '/images/appstore.png',
                        'title' => 'Download on the app store',
                        'link' => '#'
                    ),
                    array(
                        'image' => PERGO_URI. '/images/googleplay.png',
                        'title' => 'Get it on Google play',
                        'link' => '#'
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Icon Title', 'pergo' ),
                        'param_name' => 'title',
                        'value' => 'Get it on Amazon',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'image_upload',
                        'heading' => __( 'Icon Image', 'pergo' ),
                        'param_name' => 'image',
                        'description' => '',
                        'value' => PERGO_URI . '/images/amazon.png',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Icon link', 'pergo' ),
                        'param_name' => 'link',
                        'value' => '#',
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
class WPBakeryShortCode_Pergo_call_to_action extends WPBakeryShortCode {
}