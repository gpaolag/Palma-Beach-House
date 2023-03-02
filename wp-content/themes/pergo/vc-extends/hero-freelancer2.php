<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_freelancer2_shortcode_vc' );
function pergo_hero_freelancer2_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Freelancer 2', 'pergo' ),
        'base' => 'pergo_hero_freelancer2',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title & subtitle', 'pergo' ),
        'params' => array(  
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-16-img.png' 
            ),      	
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Matthew Anderson',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus undo magna an dolor vitae',
                'admin_label' => true 
            ),            
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:|extra_class:', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_freelancer2 extends WPBakeryShortCode {
}