<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_freelancer1_shortcode_vc' );
function pergo_hero_freelancer1_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Freelancer 1', 'pergo' ),
        'base' => 'pergo_hero_freelancer1',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title & subtitle', 'pergo' ),
        'params' => array(        	
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Jonathan Barnes',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Web App & UI Designer based in Los Angeles',
                'admin_label' => true 
            ),            
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:lg|extra_class:txt-300', 
    'lead_text_font_container' => 'tag:h4|size:lg|extra_class:txt-300', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_freelancer1 extends WPBakeryShortCode {
}