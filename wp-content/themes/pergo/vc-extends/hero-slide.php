<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_slide_shortcode_vc' );
function pergo_hero_slide_shortcode_vc( $return = false ) {
    $args = array(
         'icon' => 'pergo-icon',
        'name' => __( 'Slide item', 'pergo' ),
        'base' => 'pergo_hero_slide',
        'class' => 'pergo-vc',
        'as_child'  => array('only' => 'pergo_hero_creative_agency'),
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, description & button with background image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Background Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/slider/slide-1.jpg' 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Hi, we are PERGO.',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'We\'re a creative team with full of ideas',
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
                        'button_style' => 'btn-skyblue'
                    ),
                    array(
                         'button_text' => 'Find Out More',
                        'button_size' => 'btn-md',
                        'button_style' => 'btn-tra-white'
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:|extra_class:', 
    'lead_text_font_container' => 'tag:h4|size:lg|extra_class:txt-400', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_slide extends WPBakeryShortCode {
}