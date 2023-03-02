<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_more_question_button_shortcode_vc' );
function pergo_more_question_button_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'More Question button', 'pergo' ),
        'base' => 'pergo_more_question_button',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title & button', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Didn\'t find what you\'re looking for?',
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
                         'button_text' => 'Ask Your Question Here',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ) ,
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(false, '800'), 
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_more_question_button extends WPBakeryShortCode {
}