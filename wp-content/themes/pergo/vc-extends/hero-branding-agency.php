<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_branding_agency_shortcode_vc' );
function pergo_hero_branding_agency_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Branding Agency', 'pergo' ),
        'base' => 'pergo_hero_branding_agency',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle & button', 'pergo' ),
        'as_parent'  => array('only' => 'pergo_statistic_block'),
        'content_element' => true,
        'show_settings_on_create' => true,
        'is_container' => true,
        'js_view' => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Background Image', 'pergo' ),
                'param_name' => 'bg',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-15.jpg' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We are building software to help people manage your business',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus magna an dolor auctor integer ullam tempor',
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
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:md|extra_class:txt-4001', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_Pergo_hero_branding_agency extends WPBakeryShortCodesContainer {
    }
}