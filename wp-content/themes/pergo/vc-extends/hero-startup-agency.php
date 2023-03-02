<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_startup_shortcode_vc' );
function pergo_hero_startup_shortcode_vc( $return = false ) {
    $lists_id_name_map = (function_exists('ES'))? ES()->lists_db->get_list_id_name_map():'';
    $args = array(
         'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - Startup Agency', 'pergo' ),
        'base' => 'pergo_hero_startup',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle & subscription form ', 'pergo' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We convert your ideas into {workable solutions}',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                 'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna dolor luctus undo magna an dolor vitae',
                'admin_label' => true 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable subscription form?', 'pergo' ),
                'param_name' => 'enable_form',
                'value' => array( __( 'Checked to enable.', 'perch' ) => 'yes' ),  
                'admin_label' => true,
                'std' => 'yes'
            ),

            array(
                'type' => 'textfield',
                'heading' => __( 'Email Shortcode', 'pergo' ),
                'param_name' => 'placeholder',
                'value' => 'Your email address',
                'admin_label' => true ,
                'dependency' => array( 'element' => 'enable_form', 'value' => 'yes', ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable Inline button text?', 'pergo' ),
                'param_name' => 'enable_inline_btn_text',
                'value' => array( __( 'Checked to enable.', 'perch' ) => 'yes' ),  
                'admin_label' => true,
                'std' => ''
            ),
             array(
                'type' => 'textfield',
                'heading' => __( 'Inline button text', 'pergo' ),
                'param_name' => 'inline_btn_text',
                'value' => '',
                'dependency' => array( 'element' => 'enable_inline_btn_text', 'value' => 'yes', )
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Form footer', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                    	'add_link' => '',
                         'title' => 'No credit card required',
                        'link_title' => '',
                        'link_url' => '#',
                        'link_before' => ''
                    ),
                    array(
                    	'add_link' => 'yes',
                         'title' => 'for more details',
                        'link_title' => 'See FAQ',
                        'link_url' => '#',
                        'link_before' => '*'
                    ),
                    array(
                    	'add_link' => 'yes',
                         'title' => '',
                        'link_title' => 'Privacy Policy',
                        'link_url' => '#',
                        'link_before' => ''
                    ),
                ) ) ),
                'params' => array(
                	array(
		                'type' => 'checkbox',
		                'heading' => __( 'Add link?', 'pergo' ),
		                'param_name' => 'add_link',
		                'value' => array( __( 'Yes', 'pergo' ) => 'yes' )  ,
		                'admin_label' => true                  
		            ),
                	array(
                        'type' => 'textfield',
                        'heading' => __( 'Link before', 'pergo' ),
                        'param_name' => 'link_before',
                        'description' => __( 'Leave blank to avoid link', 'pergo' ),
                        'value' => '*' ,
                        'dependency' => array(
                        	'element' => 'add_link',
                        	'value' => 'yes'
                        )
                    ),
                	array(
                        'type' => 'textfield',
                        'heading' => __( 'Link title', 'pergo' ),
                        'param_name' => 'link_title',
                        'description' => __( 'Leave blank to avoid link', 'pergo' ),
                        'value' => '' ,
                        'dependency' => array(
                        	'element' => 'add_link',
                        	'value' => 'yes'
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Link title', 'pergo' ),
                        'param_name' => 'link_url',
                        'value' => '#',
                        'dependency' => array(
                        	'element' => 'add_link',
                        	'value' => 'yes'
                        )
                    ), 
                    array(
                         'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => __( 'Leave blank to avoid link', 'pergo' ),
                        'value' => '',
                        'admin_label' => true 
                    ),
                    
                ),
            ),
            array(
                'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => esc_attr__( 'Selected lists', 'pergo' ),
                'param_name' => 'selected_lists',
                'value' => $lists_id_name_map,
                'dependency' => array( 'element' => 'enable_form', 'value' => 'yes', ),                   
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display list in checkbox', 'pergo' ),
                'param_name' => 'show_list',
                'std' => '0',
                'value' => array( __( 'Checked to enable.', 'pergo' ) => '1' ),  
                'admin_label' => true, 
                'dependency' => array( 'element' => 'enable_form', 'value' => 'yes', ),              
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
   $default = array( 
    'title_font_container' => 'tag:h2|size:|extra_class:txt-500', 
    'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_hero_startup extends WPBakeryShortCode {
}