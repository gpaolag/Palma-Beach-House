<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
} //!defined( 'ABSPATH' )
add_action( 'vc_after_init', 'pergo_vc_button_param' );
function pergo_vc_button_param( ) {
    $newParamData = array(
         array(
             'type' => 'dropdown',
            'heading' => __( 'Style', 'pergo' ),
            'description' => __( 'Select button display style.', 'pergo' ),
            'param_name' => 'style',
            // partly compatible with btn2, need to be converted shape+style from btn2 and btn1
            'value' => array(
                 __( 'Pergo', 'pergo' ) => 'pergo',
                __( 'Modern', 'pergo' ) => 'modern',
                __( 'Classic', 'pergo' ) => 'classic',
                __( 'Flat', 'pergo' ) => 'flat',
                __( 'Outline', 'pergo' ) => 'outline',
                __( '3d', 'pergo' ) => '3d',
                __( 'Custom', 'pergo' ) => 'custom',
                __( 'Outline custom', 'pergo' ) => 'outline-custom',
                __( 'Gradient', 'pergo' ) => 'gradient',
                __( 'Gradient Custom', 'pergo' ) => 'gradient-custom' 
            ) 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Shape', 'pergo' ),
            'description' => __( 'Select button shape.', 'pergo' ),
            'param_name' => 'shape',
            // need to be converted
            'value' => array(
                 __( 'Square', 'pergo' ) => 'square',
                __( 'Rounded', 'pergo' ) => 'rounded',
                __( 'Round', 'pergo' ) => 'round' 
            ) 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Color', 'pergo' ),
            'param_name' => 'color',
            'description' => __( 'Select button color.', 'pergo' ),
            // compatible with btn2, need to be converted from btn1
            'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
            'value' => array(
                // Btn1 Colors
                 __( 'Pergo Primary', 'pergo' ) => 'btn-primary',
                __( 'Pergo Primary outline', 'pergo' ) => 'btn-primary-outline',
                __( 'Pergo Secondary', 'pergo' ) => 'btn-secondary',
                __( 'Classic Grey', 'pergo' ) => 'default',
                __( 'Classic Blue', 'pergo' ) => 'primary',
                __( 'Classic Turquoise', 'pergo' ) => 'info',
                __( 'Classic Green', 'pergo' ) => 'success',
                __( 'Classic Orange', 'pergo' ) => 'warning',
                __( 'Classic Red', 'pergo' ) => 'danger',
                __( 'Classic Black', 'pergo' ) => 'inverse' 
                // + Btn2 Colors (default color set)
            ) + vc_get_shared( 'colors-dashed' ),
            'std' => 'btn-primary',
            // must have default color grey
            'dependency' => array(
                 'element' => 'style',
                'value_not_equal_to' => array(
                     'custom',
                    'outline-custom',
                    'gradient',
                    'gradient-custom' 
                ) 
            ) 
        ) 
    );
    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_btn', $value );
    } //$newParamData as $key => $value
}

