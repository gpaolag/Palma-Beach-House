<?php
/**

* The VC Functions

*/
add_action( 'vc_before_init', 'pergo_work_experience_shortcode_vc' );
function pergo_work_experience_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Work experience', 'pergo' ),
        'base' => 'pergo_work_experience',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => '',
        'params' => array(
            // params group
             array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Work experiences', 'pergo' ),
                'param_name' => 'skills',
                'value' => urlencode( json_encode( array(
                     array(
                        'year' => '2012 - 2013',
                        'title' => 'WEB DESIGNER',
                        'name' => 'PulsTheme',
                        'desc' => 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative to strategy foster collaborative thinking to further the du lu overall value proposition.' 
                    ),
                    array(
                        'year' => '2013 - 2015',
                        'title' => 'UI/UX DESIGNER',
                        'name' => 'ThemePerch',
                        'desc' => 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative to strategy foster collaborative thinking to further the du lu overall value proposition.' 
                    ),
                    array(
                        'year' => '2015 - 2016',
                        'title' => 'UI ARCHITECT',
                        'name' => 'Themeonair',
                        'desc' => 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative to strategy foster collaborative thinking to further the du lu overall value proposition.' 
                    ) 
                ) ) ),
                'params' => array(
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Year', 'pergo' ),
                        'param_name' => 'year',
                        'description' => '',
                        'value' => '2012 - 2013',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => 'WEB DESIGNER',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Company name', 'pergo' ),
                        'param_name' => 'name',
                        'description' => '',
                        'value' => 'ThemePerch',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Description', 'pergo' ),
                        'param_name' => 'desc',
                        'description' => '',
                        'value' => 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative to strategy foster collaborative thinking to further the du lu overall value proposition.' 
                    ) 
                ) 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Button Title', 'pergo' ),
                'param_name' => 'button_title',
                'description' => '',
                'value' => 'Hire me',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Button link', 'pergo' ),
                'param_name' => 'button_link',
                'description' => __( 'Leave blank to avoid link', 'pergo' ),
                'value' => '#' 
            ) 
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_work_experience extends WPBakeryShortCode {
}