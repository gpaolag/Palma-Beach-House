<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_inner_content_shortcode_vc' );
function pergo_inner_content_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Inner content block', 'pergo' ),
        'base' => 'pergo_inner_content',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display Video + title, description & button', 'pergo' ),
        'params' => array(
        	array(
                'type' => 'dropdown',
                'heading' => __( 'Background', 'pergo' ),
                'param_name' => 'bg',
                'std' => 'bg-deepdark white-color',
                'value' => array(
                    'Light grey' => 'bg-lightgrey',
                    'White' => 'bg-white',
                    'Dark' => 'bg-dark white-color',
                    'Deep dark' => 'bg-deepdark white-color',
                ),
            ),
        	array(
                'type' => 'checkbox',
                'heading' => __( 'Image in right position?', 'pergo' ),
                'param_name' => 'position',
                'description' => __( 'Default image in left', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' )                   
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Video Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-11-img.jpg' 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable video?', 'pergo' ),
                'param_name' => 'enable_video',
                'description' => __( 'Checked to display video on image', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'admin_label' => true,
                'std' => 'yes'
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Video url', 'pergo' ),
                'param_name' => 'url',
                'description' => '',
                'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
                'dependency' => array(
                     'element' => 'enable_video',
                    'value' => 'yes' 
                ), 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub-Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'About Us',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We craft marketing & digital products that grow business',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'An enim nullam tempor sapien gravida donec enim blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus',
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
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h3|size:xs|extra_class:txt-500', 
    'lead_text_font_container' => 'tag:psize:md|extra_class:', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_inner_content extends WPBakeryShortCode {
}