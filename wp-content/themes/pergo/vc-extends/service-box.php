<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_service_box_shortcode_vc' );
function pergo_service_box_shortcode_vc( $return = false ) {
    $args = array(
         'icon' => 'pergo-icon',
        'name' => __( 'Service box', 'pergo' ),
        'base' => 'pergo_service_box',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display icon, title & subtitle', 'pergo' ),
        'params' => array(
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Display type', 'pergo' ),
                'param_name' => 'style',
                'std' => 'sbox-1',
                'value' => array(
                    'Default' => 'sbox-1',                    
                    'Style 2 (Icon on top)' => 'sbox-2',
                    'Style 3 (Icon left with extra spacing)' => 'sbox-4',
                    'Style 4 (Border boxed)' => 'sbox-6',
                ),              
                'admin_label' => true 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'value' => array(
                    'Default' => 'default-align',
                    'Center' => 'text-center',
                ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'sbox-2' )
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon type', 'pergo' ),
                'param_name' => 'icon_type',
                'std' => 'flaticon',
                'value' => array(
                    __( 'Flaticon', 'pergo' ) => 'flaticon',
                    __( 'Fontawesome', 'pergo' ) => 'fontawesome',
                    __( 'Image', 'pergo' ) => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-8',
                'admin_label' => true,
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Icon color', 'pergo' ),
                'param_name' => 'icon_color',
                'value' => pergo_vc_color_options(true),
                'std' => 'grey',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array( 'element' => 'icon_type', 'value' => array('flaticon', 'fontawesome') )
            ),
            pergo_vc_icon_set( 'flaticon', 'icon', 'flaticon-settings-6', 'icon_type' ),            
            pergo_vc_icon_set( 'fontawesome', 'icon_2', 'fa fa-heart', 'icon_type' ),            
            array(
                'type' => 'image_upload',
                'heading' => __( 'Icon image', 'pergo' ),
                'param_name' => 'icon_image',
                'value' => '',
                'edit_field_class' => 'vc_col-sm-8',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'image',
                ), 
            ),
            array(
                 'type' => 'textfield',
                'value' => '',
                'heading' => 'Icon width',
                'param_name' => 'image_width', 
                'description' => 'Number only', 
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array( 'element' => 'icon_type', 'value' => array('image') ) 
            ),          
            array(
                 'type' => 'textfield',
                'value' => 'Web Development',
                'heading' => 'Title',
                'param_name' => 'title',
                'edit_field_class' => 'vc_col-sm-8',
                'admin_label' => true 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Add link on title?', 'pergo' ),
                'param_name' => 'title_link',
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'std' => '',
                'edit_field_class' => 'vc_col-sm-4'                   
            ),
            array(
                'type' => 'vc_link',
                'heading' => __( 'Create a link for title', 'pergo' ),
                'param_name' => 'title_url',
                'std' => '',
                'dependency' => array( 'element' => 'title_link', 'value' => 'yes' )
            ),
            array(
                 'type' => 'textarea',
                'value' => 'Maecenas laoreet augue egestas laoreet augue egestas, congue gestas volutpat posuere cubilia congue ipsum mauris lectus laoreet gestas neque volutpat and gestas posuere congue ipsum',
                'heading' => 'Subtitle',
                'param_name' => 'subtitle',
                'admin_label' => true 
            ),
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(),
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h5|size:md|extra_class:', 
    'subtitle_font_container' => 'tag:p|text_color:grey-color', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_service_box extends WPBakeryShortCode {
}