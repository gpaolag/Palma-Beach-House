<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_business_consultancy_shortcode_vc' );
function pergo_hero_business_consultancy_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Business Consultancy', 'pergo' ),
        'base' => 'pergo_hero_business_consultancy',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle, button & bottom image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Background Image', 'pergo' ),
                'param_name' => 'bg',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-6.jpg' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Responsive, convenient & multipurpose landing page',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Feugiat primis ligula risus auctor laoreet augue egestas mauris viverra tortor in iaculis suscipit begestas magna, mauris rhoncus ipsum placerat',
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
                         'button_text' => 'Discover Our Services',
                        'button_size' => 'btn-md',
                        'button_style' => 'btn-tra-white'
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-6-img.png' 
            ),
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:lg|extra_class:', 
    'lead_text_font_container' => 'tag:p|size:lg|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_business_consultancy extends WPBakeryShortCode {
}