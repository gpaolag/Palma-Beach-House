<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_our_skills_shortcode_vc' );
function pergo_our_skills_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Our skills', 'pergo' ),
        'base' => 'pergo_our_skills',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, desc & tenchnical skills', 'pergo' ),
        'params' => array(           
            array(
                'type' => 'textfield',
                'heading' => __( 'Sub Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'Our Skills',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We\'re the stand out experts in business',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => 'An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor eros erat magna morbi ',
                'admin_label' => true 
            ),
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Skills', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'title' => 'Coding Knowledge',
                        'count' => ' 97',
                    ),
                    array(
                        'title' => 'Digital Marketing',
                        'count' => '92',
                    ),
                    array(
                        'title' => 'Front End Development',
                        'count' => '85',
                    ),
                    array(
                        'title' => 'WordPress',
                        'count' => '94',
                    ),
                ) ) ),
                'params' => array(
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => 'PHP',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Number in percent', 'pergo' ),
                        'param_name' => 'count',
                        'description' => __( 'Number only (1-100)', 'pergo' ),
                        'value' => '90' ,
                        'admin_label' => true 
                    ) 
                ) 
            )  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h3|size:sm|extra_class:', 
    'lead_text_font_container' => 'tag:span|extra_class:section-id', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_our_skills extends WPBakeryShortCode {
}