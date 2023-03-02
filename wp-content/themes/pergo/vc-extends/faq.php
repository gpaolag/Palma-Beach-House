<?php
/**

* The VC Functions

*/
add_action( 'vc_before_init', 'pergo_faq_shortcode_vc' );
function pergo_faq_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'FAQ', 'pergo' ),
        'base' => 'pergo_faq',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display question & answer', 'pergo' ),
        'params' => array(
             array(
                'type' => 'textfield',
                'value' => 'Lobortis sit magna ornare magna egestas?',
                'heading' => 'Question',
                'param_name' => 'title',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'value' => 'Etiam sit amet mauris suscipit sit amet in odio. Integer congue leo metus. Vitae arcu mollis blandit ultrice ligula egestas magna suscipit lectus magna suscipit luctus undo blandit',
                'heading' => 'Answer',
                'param_name' => 'subtitle',
                'admin_label' => true 
            ),
            vc_map_add_css_animation(), 
            pergo_vc_animation_duration(),
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
    'title_font_container' => 'tag:h5|size:sm|extra_class:', 
    'subtitle_font_container' => 'tag:p|extra_class:', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_faq extends WPBakeryShortCode {
}