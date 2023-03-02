<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_discount_banner_shortcode_vc' );
function pergo_discount_banner_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Discount banner', 'pergo' ),
        'base' => 'pergo_discount_banner',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display Discount, description & button', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Section Background', 'pergo' ),
                'param_name' => 'bg_class',
                'value' => pergo_vc_background_options(),
                'std' => 'bg-rose',
                'description' => '' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Discount', 'pergo' ),
                'param_name' => 'title',
                'value' => '20%',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Don\'t be afraid to click. Maybe we offer discount on your first project',
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
                        'button_size' => 'btn-sm',
                        'button_style' => 'btn-tra-white'
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:xl|extra_class:', 
    'lead_text_font_container' => 'tag:p|size:xl|extra_class:', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_discount_banner extends WPBakeryShortCode {
}