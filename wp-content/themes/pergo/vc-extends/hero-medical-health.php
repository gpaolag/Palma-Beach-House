<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_medical_health_shortcode_vc' );
function pergo_hero_medical_health_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Medical & Health', 'pergo' ),
        'base' => 'pergo_hero_medical_health',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display title, subtitle & button + 3 column box', 'pergo' ),
        'as_parent'  => array('only' => 'pergo_highlight_boxes'),
        'content_element' => true,
        'show_settings_on_create' => false,
        'is_container' => true,
        'js_view' => 'VcColumnView',
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Background Image', 'pergo' ),
                'param_name' => 'bg',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-19.jpg' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Best Healthcare & Latest Medical Technologies',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus undo magna an dolor vitae ',
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
                         'button_text' => 'Clinic Services',
                        'button_size' => 'btn-md',
                        'button_style' => 'btn-tra-white',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
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
// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_Pergo_hero_medical_health extends WPBakeryShortCodesContainer {
    }
}