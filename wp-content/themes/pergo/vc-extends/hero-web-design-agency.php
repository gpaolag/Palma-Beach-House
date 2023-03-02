<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_web_design_agency_shortcode_vc' );
function pergo_hero_web_design_agency_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Web design Agency', 'pergo' ),
        'base' => 'pergo_hero_web_design_agency',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle & video', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Ready For Design Exploration?',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus undo magna an dolor vitae integer odio',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Video title', 'pergo' ),
                'param_name' => 'video_title',
                'value' => 'Watch The Overview',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Video link', 'pergo' ),
                'param_name' => 'video_link',
                'value' => '//www.youtube.com/watch?v=SZEflIVnhH8',
                'admin_label' => true 
            ),
             
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:lg|extra_class:', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_web_design_agency extends WPBakeryShortCode {
}