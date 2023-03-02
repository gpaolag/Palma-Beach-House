<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_bring_ideas_shortcode_vc' );
function pergo_bring_ideas_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Bring ideas', 'pergo' ),
        'base' => 'pergo_bring_ideas',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, description, button & image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/banner-2-img.png',
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image alt', 'pergo' ),
                'param_name' => 'image_alt',
                'value' => '', 
                'description' => __( 'Section name is default alt text.', 'pergo' ),
                'edit_field_class' => 'vc_col-sm-3',    
            ), 
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Bring your ideas to life with {PERGO.}',
                'admin_label' => true 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Heading tag', 'pergo' ),
                'param_name' => 'tag',
                'std' => 'h2:h2-sm txt-600',
                'value' => array(
                    'H2' => 'h2:h2-sm txt-600',
                    'H3' => 'h3:h3-xl',
                    'H4' => 'h4:h4-sm',
                    'H5' => 'h4:h5-sm',
                ),
            ), 
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Semper lacus cursus porta, feugiat primis ultrice ligula risus auctor rhoncus purus ipsum primis in cubilia augue vitae laoreet augue in cubilia laoreet an augue egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas magna suscipit',
                'admin_label' => true 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display', 'pergo' ),
                'param_name' => 'display',
                'std' => 'buttons',
                'value' => array(
                    'Button' => 'buttons',
                    'Icons' => 'icons',
                ),
                'std' => 'buttons',
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
                'params' => pergo_button_groups_param(),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'buttons'
                )
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Icons', 'pergo' ),
                'param_name' => 'params2',
                'value' => urlencode( json_encode( array(
                    array(
                         'icon' => 'fa fa-tablet',
                        'title' => 'Tablet',
                    ),
                    array(
                         'icon' => 'fa fa-mobile',
                        'title' => 'Mobile',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => '',
                        'admin_label' => true 
                    ),
                     pergo_vc_icon_set( 'fontawesome', 'icon' )
                ),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'icons'
                )
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Footer desc', 'pergo' ),
                'param_name' => 'footer_desc',
                'value' => 'Available on iPhone, iPad and all Android devices from 5.5',
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'icons'
                )
            ),
            
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h2|size:xl|extra_class:txt-500', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_bring_ideas extends WPBakeryShortCode {
}