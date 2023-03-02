<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_button_group_shortcode_vc' );
function pergo_button_group_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Button group', 'pergo' ),
        'base' => 'pergo_button_group',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display button group', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'std' => 'left',
                'save_always' => true,
                'value' => array(
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                ),
                'admin_label' => true,
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
            array(
                'type' => 'textarea',
                'heading' => __( 'Footer text', 'pergo' ),
                'param_name' => 'footer_text',
                'description' => 'Optional',
                'value' => '',
            ), 
            pergo_vc_spacing_options_param('margin', 'left'),
            pergo_vc_spacing_options_param('margin', 'top'),
            pergo_vc_spacing_options_param('margin', 'right'),
            pergo_vc_spacing_options_param('margin', 'bottom'),  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_button_group extends WPBakeryShortCode {
}