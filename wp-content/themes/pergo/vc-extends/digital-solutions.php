<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_digital_solutions_shortcode_vc' );
function pergo_digital_solutions_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Digital solutions', 'pergo' ),
        'base' => 'pergo_digital_solutions',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, desc, techs & image', 'pergo' ),
        'params' => array( 
            array(
                'type' => 'checkbox',
                'heading' => __( 'Image in left position?', 'pergo' ),
                'param_name' => 'position',
                'description' => __( 'Default image in right', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' )                   
            ), 
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/image-02.png' ,
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
                'heading' => __( 'Section name', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'Digital Solutions',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We use design and innovations',
                'description' =>  __( 'Use {} to highlight text. Example: Welcome to {Pergo}', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Justo integer odio velna vitae auctor integer congue magna at pretium purus ligula rutrum luctus',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => 'An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor eros erat magna morbi pretium neque',
                'admin_label' => true 
            ),            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display', 'pergo' ),
                'param_name' => 'display',
                'value' => pergo_vc_element_display_option(),
                'std' => 'techs',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Tech Title', 'pergo' ),
                'param_name' => 'tech_title',
                'value' => 'Technologies we use:',
                'admin_label' => true,
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'techs'
                )  
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'style',
                'value' => pergo_vc_color_options(true),
                'heading' => __( 'Counter color', 'pergo' ),
                'description' => __( 'Select tabs display style.', 'pergo' ),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'counter'
                ) 
            ),
            // params group
            pergo_vc_techs_group(),
            pergo_vc_counter_group(), 
            pergo_vc_strategy_list_group(),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Section name color', 'pergo' ),
                'param_name' => 'name_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'default',
                'description' => __( 'Only worked for Subtitle', 'pergo' ),                 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Heading tag', 'pergo' ),
                'param_name' => 'tag',
                'std' => 'h3:h3-sm',
                'value' => pergo_vc_heading_size_options(),
                'group' => __( 'Design option', 'pergo' ),
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Title text color', 'pergo' ),
                'param_name' => 'title_text_color',
                'value' => pergo_vc_color_options(true),
                'std' => 'default',
                'group' => __( 'Design option', 'pergo' ),
                'description' => __( 'Only worked for Subtitle', 'pergo' ),                 
            ),           
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable highlight text options?', 'pergo' ),
                'param_name' => 'underline',
                'description' => __( 'Checked to select custom underline color, text color', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),  
                'admin_label' => true,
                'std' => 'yes', 
                'group' => __( 'Design option', 'pergo' ),  
            ), 
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Underline color for highlight text for Title', 'pergo' ),
                'param_name' => 'underline_color',
                'value' => pergo_vc_underline_color_options(),
                'std' => 'underline-yellow',
                'description' => __( 'Only worked for {highlighted text}', 'pergo' ),
                'group' => __( 'Design option', 'pergo' ),
                'dependency' => array(
                     'element' => 'underline',
                    'value' => 'yes' 
                ), 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Highlight text color for Title', 'pergo' ),
                'param_name' => 'highlight_text_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'rose',
                'description' => __( 'Only worked for {highlighted text}', 'pergo' ),
                'dependency' => array(
                     'element' => 'underline',
                    'value' => 'yes' 
                ),  
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Subtitle text color', 'pergo' ),
                'param_name' => 'subtitle_text_color',
                'value' => pergo_vc_color_options(true),
                'std' => 'grey',
                'group' => __( 'Design option', 'pergo' ),
                'description' => __( 'Only worked for Subtitle', 'pergo' ),                 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Subtitle text size', 'pergo' ),
                'param_name' => 'subtitle_text_size',
                'value' => pergo_vc_text_size_options(),
                'std' => 'p-lg',
                'description' => __( 'Only worked for {highlighted text}', 'pergo' ),
                'group' => __( 'Design option', 'pergo' )                
            ),
              
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_digital_solutions extends WPBakeryShortCode {
}