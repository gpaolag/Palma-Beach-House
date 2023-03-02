<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_card_box_shortcode_vc' );
function pergo_card_box_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Card box', 'pergo' ),
        'base' => 'pergo_card_box',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display image, title & description', 'pergo' ),
        'params' => array(  
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'std' => 'left',
                'save_always' => true,
                'value' => array(
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                ),
                'admin_label' => true,
            ),         
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'value' => PERGO_URI . '/images/image-03.jpg',
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
                'value' => 'Instant Solutions',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-8' 
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
                'type' => 'textfield',
                'heading' => __( 'Sub Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => '',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => 'An magnis nulla dolor sapien augue erat iaculis purus tempor magna ipsum vitae purus primis ipsum congue magna odio augue pretium ligula rutrum nullam',
                'admin_label' => true 
            ), 
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable button?', 'pergo' ),
                'param_name' => 'enable_button',
                'description' => __( 'Checked to enable button', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'admin_label' => true,
            ), 
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Buttons', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'button_text' => 'Buy Now ($22.99)',
                        'button_size' => 'btn-md',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param(),
                'dependency' => array(
                     'element' => 'enable_button',
                    'value' => 'yes' 
                ),
            ),   
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(),         
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h5|size:lg|extra_class:', 
    'lead_text_font_container' => 'tag:span|extra_class:app-cat', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_card_box extends WPBakeryShortCode {
}