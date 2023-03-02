<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_newsletter_form_shortcode_vc' );
function pergo_newsletter_form_shortcode_vc( $return = false ) {
    $lists_id_name_map = (function_exists('ES'))? ES()->lists_db->get_list_id_name_map():'';
    $args = array(
         'icon' => 'pergo-icon',
        'name' => __( 'Newsletter form', 'pergo' ),
        'base' => 'pergo_newsletter_form',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title & subscription form ', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Stay up to date with our news, ideas and updates',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Email shortcode', 'pergo' ),
                'param_name' => 'placeholder',
                'value' => 'Your email address',
                'admin_label' => true 
            ),
            array(
                'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Selected lists', 'pergo' ),
                'param_name' => 'selected_lists',
                'value' => $lists_id_name_map,                   
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display list in checkbox', 'pergo' ),
                'param_name' => 'show_list',
                'std' => '0',
                'value' => array( __( 'Checked to enable.', 'pergo' ) => '1' ),  
                'admin_label' => true,               
            ),
            array(
                'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Display lists', 'pergo' ),
                'param_name' => 'list_ids',
                'value' => $lists_id_name_map, 
                'dependency' => array( 'element' => 'show_list', 'value' => '1', ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'List column', 'pergo' ),
                'param_name' => 'columns',
                'std' => '0',
                'value' => array(
                    esc_attr__('Initial', 'pergo') => '0',
                    esc_attr__('Single column', 'pergo') => '1',
                    esc_attr__('2 column', 'pergo') => '2',
                    esc_attr__('3 column', 'pergo') => '3',
                    esc_attr__('4 column', 'pergo') => '4',
                    esc_attr__('6 column', 'pergo') => '6',
                ),  
                'admin_label' => true,
                'dependency' => array( 'element' => 'show_list', 'value' => '1', ),  
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
class WPBakeryShortCode_Pergo_newsletter_form extends WPBakeryShortCode {
}