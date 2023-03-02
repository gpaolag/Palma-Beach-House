<?php
/**

* The VC Functions

*/
add_action( 'vc_before_init', 'pergo_section_content_shortcode_vc' );
function pergo_section_content_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Section content', 'pergo' ),
        'base' => 'pergo_section_content',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' =>  __( 'Display title & subtitle, button etc.', 'pergo' ),
        'params' => array(        	 
        	array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Section name',
                'param_name' => 'name',
                'description' =>  __( 'Leave blank to avoid this field', 'pergo' ),
                'admin_label' => true 
            ),
             array(
                'type' => 'textfield',
                'value' => 'We\'re making {better design} for everyone',
                'heading' => 'Title',
                'param_name' => 'title',
                'description' =>  __( 'Use {} to highlight text. Example: Welcome to {Pergo}', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'value' => 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius augue luctus donec sapien',
                'heading' => 'Subtitle',
                'param_name' => 'subtitle',
                'admin_label' => true 
            ), 
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable content?', 'pergo' ),
                'param_name' => 'enable_content',
                'description' => __( 'Checked to Content area', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => '',
                'dependency' => array(
                     'element' => 'enable_content',
                    'value' => 'yes' 
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable animated content list?', 'pergo' ),
                'param_name' => 'enable_list',
                'description' => __( 'Checked to Content area', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),   
                'std' => 'yes',                
                'admin_label' => true,
            ),
            pergo_vc_content_list_group(),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable button?', 'pergo' ),
                'param_name' => 'enable_button',
                'description' => __( 'Checked to enable button', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
                'std' => 'yes',
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
                        'button_text' => 'Start Exploring',
                        'button_size' => 'btn-md',
                    ),
                ) ) ),
                'params' => pergo_button_groups_param(),
                'dependency' => array(
                     'element' => 'enable_button',
                    'value' => 'yes' 
                ),
            ), 
            array(
                'type' => 'textarea',
                'value' => '',
                'heading' => 'Footer text',
                'param_name' => 'footer_text',
                'admin_label' => true 
            ),           
            array(
                'type' => 'dropdown',
                'heading' => __( 'Align', 'pergo' ),
                'param_name' => 'align',
                'std' => 'left',
                'value' => array(
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                ),
                'admin_label' => true,
                'group' => __( 'Design option', 'pergo' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Full width title area?', 'pergo' ),
                'param_name' => 'fullwidth',
                'description' => __( 'Default show compressed area section title', 'pergo' ),
                'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),  
                'std' => 'yes',
                'admin_label' => true,
                'group' => __( 'Design option', 'pergo' ),  
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Section name color', 'pergo' ),
                'param_name' => 'name_color',
                'value' => pergo_vc_color_options(true),
                'group' => __( 'Design option', 'pergo' ),
                'std' => 'rose',
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
                'std' => 'yes',                 
                'admin_label' => true,
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
            pergo_vc_spacing_options_param('margin', 'left'),
            pergo_vc_spacing_options_param('margin', 'top'),
            pergo_vc_spacing_options_param('margin', 'right'),
            pergo_vc_spacing_options_param('margin', 'bottom'),
            pergo_vc_spacing_options_param('padding', 'left'),
            pergo_vc_spacing_options_param('padding', 'top'),
            pergo_vc_spacing_options_param('padding', 'right'),
            pergo_vc_spacing_options_param('padding', 'bottom'),
            
        ) 
    );
    $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    vc_map( $args );
}
class WPBakeryShortCode_Pergo_section_content extends WPBakeryShortCode {
}