<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_what_we_do_best_shortcode_vc' );
function pergo_what_we_do_best_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'What We Do Best', 'pergo' ),
        'base' => 'pergo_what_we_do_best',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle & description', 'pergo' ),
        'params' => array(     
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'What We Do Best',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We\'re an award-winning digital agency focused on hight-quality brands',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Lorem ipsum dolor sit amet, suscipit egestas luctus magna suscipit elit aenean magna. An integer congue magna at pretium purus pretium ligula rutrum luctus',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textarea_html',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => 'An enim nullam tempor sapien gravida enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor erat ',
                'admin_label' => true 
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
class WPBakeryShortCode_Pergo_what_we_do_best extends WPBakeryShortCode {
}