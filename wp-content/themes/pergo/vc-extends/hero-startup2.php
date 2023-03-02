<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_startup2_shortcode_vc' );
function pergo_hero_startup2_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Startup 2', 'pergo' ),
        'base' => 'pergo_hero_startup2',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle, button & bottom image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'A simple idea can change the world',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis cubilia laoreet augue luctus magna dolor luctus undo magna an dolor vitae vitae auctor eros integer ullam tempor',
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
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-17-img.png' 
            ),
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:sm|extra_class:', 
    'lead_text_font_container' => 'tag:p|size:md|extra_class:', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_startup2 extends WPBakeryShortCode {
}