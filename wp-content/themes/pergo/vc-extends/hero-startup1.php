<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_startup1_shortcode_vc' );
function pergo_hero_startup1_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Startup1', 'pergo' ),
        'base' => 'pergo_hero_startup1',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle, button & form', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We provide the solutions to grow your business',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Maecenas laoreet augue egestas suscipit ut egestas congue and gestas posuere cubilia congue ipsum mauris lectus laoreet gestas neque volutpat posuere. Lorem ipsum dolor ligula',
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
                         'button_text' => 'Our Latest Projects',
                        'button_size' => 'btn-md',
                        'button_style' => 'btn-tra-white'
                    ),
                ) ) ),
                'params' => pergo_button_groups_param()
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Form Title', 'pergo' ),
                'param_name' => 'form_title',
                'value' => 'Get Started',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Form description', 'pergo' ),
                'param_name' => 'form_desc',
                'value' => 'Please fill all fields so we can get some info about you. We will never send you spam',
                'admin_label' => true 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Select contact form', 'pergo' ),
                'param_name' => 'id',
                'value' => pergo_contact_form_options(),
                'save_always' => true,
                'description' => __( 'Choose previously created contact form from the drop down list.', 'pergo' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Form background color', 'pergo' ),
                'param_name' => 'form_bg',               
                'value' => pergo_vc_background_options(),
                'std' => 'bg-white',
                'description' => '',
            ),  
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:lg|extra_class:txt-600', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_startup1 extends WPBakeryShortCode {
}