<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_digital_agency_shortcode_vc' );
function pergo_hero_digital_agency_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Digital Agency', 'pergo' ),
        'base' => 'pergo_hero_digital_agency',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle, button & aside image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We design and develop innovative digital solutions ',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus undo donec diam ociis nullam tempor sapien, eget orci gravida porta ',
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
                         'button_text' => 'Start Exploring',
                        'button_size' => 'btn-md',
                        'button_style' => 'btn-lightgreen'
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-14-img.png' 
            ),
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:lg|extra_class:txt-500', 
    'lead_text_font_container' => 'tag:p|size:lg|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_digital_agency extends WPBakeryShortCode {
}