<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_single_team_shortcode_vc' );
function pergo_single_team_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Team', 'pergo' ),
        'base' => 'pergo_single_team',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display image, title & description', 'pergo' ),
        'params' => array(    
            array(
                'type' => 'dropdown',
                'heading' => __( 'Style', 'pergo' ),
                'param_name' => 'style',
                'std' => 'team-1',
                'value' => array(
                    'Team style 1' => 'team-1',
                    'Team style 2' => 'team-2',
                    'Team style 3' => 'team-3',
                ),
                'admin_label' => true,
            ),        
            array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',                
                'value' => PERGO_URI . '/images/team-5.jpg' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Name', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Jonathan Barnes',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Link', 'pergo' ),
                'param_name' => 'link',
                'value' => '', 
                'description' => __( 'Leave blank to avoid link', 'pergo' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Designation', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'CEO, Founder',
                'admin_label' => true 
            ), 
            array(
                'type' => 'textarea',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => '',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('team-2', 'team-3') 
                ), 
            ),   
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(),             
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
                'type' => 'dropdown',
                'heading' => __( 'Heading tag', 'pergo' ),
                'param_name' => 'tag',
                'std' => 'h5:h5-sm',
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
                'heading' => __( 'Content text color', 'pergo' ),
                'param_name' => 'content_text_color',
                'value' => pergo_vc_color_options(true),
                'std' => 'grey',
                'group' => __( 'Design option', 'pergo' ),
                'description' => __( 'Only worked for content', 'pergo' ),                 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Content text size', 'pergo' ),
                'param_name' => 'content_text_size',
                'value' => pergo_vc_text_size_options(),
                'std' => 'p-sm',
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
class WPBakeryShortCode_Pergo_single_team extends WPBakeryShortCode {
}