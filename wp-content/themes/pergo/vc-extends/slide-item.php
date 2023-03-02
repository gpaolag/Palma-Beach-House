<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_slide_item_shortcode_vc' );
function pergo_slide_item_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Slide item', 'pergo' ),
        'base' => 'pergo_slide_item',
        'class' => 'pergo-vc',
        'as_child'        => array('only' => 'pergo_hero_design_studio'),
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, description & button', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Hello We\'re Pergo.',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Donec vel sapien augue integer urna vel turpis cursus porta, mauris sed augue luctus magna dolor luctus ipsum neque primis libero tempor posuere in ligula',
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
                        'button_text' => 'Find Out More',
                        'button_size' => 'btn-md',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            )  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:animated|extra_class:', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_slide_item extends WPBakeryShortCode {
}