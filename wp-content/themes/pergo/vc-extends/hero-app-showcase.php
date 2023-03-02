<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_hero_app_showcase_shortcode_vc' );
function pergo_hero_app_showcase_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-hero-icon',
        'name' => __( 'Header - App Showcase', 'pergo' ),
        'base' => 'pergo_hero_app_showcase',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, subtitle, button & image', 'pergo' ),
        'params' => array(
        	array(
                'type' => 'image_upload',
                'heading' => __( 'Image', 'pergo' ),
                'param_name' => 'image',
                'description' => '',
                'value' => PERGO_URI . '/images/hero-8-img.png' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'Capture and share your {Best Memories}',
                'description' => __('Use {} for highlight text', 'pergo' ),
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea',
                'heading' => __( 'Lead text', 'pergo' ),
                'param_name' => 'lead_text',
                'description' => '',
                'value' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in congue laoreet augue luctus magna',
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
                        'image' => PERGO_URI. '/images/appstore.png',
                        'title' => 'Download on the app store',
                        'link' => '#'
                    ),
                    array(
                        'image' => PERGO_URI. '/images/googleplay.png',
                        'title' => 'Get it on Google play',
                        'link' => '#'
                    ),
                ) ) ),
                'params' => array(
                	array(
		              'type' => 'textfield',
		                'heading' => __( 'Icon Title', 'pergo' ),
		                'param_name' => 'title',
		                'value' => 'Get it on Amazon',
		                'admin_label' => true 
		            ),
                	array(
		                'type' => 'image_upload',
		                'heading' => __( 'Icon Image', 'pergo' ),
		                'param_name' => 'image',
		                'description' => '',
		                'value' => PERGO_URI . '/images/amazon.png',
		            ),
		            array(
		              'type' => 'textfield',
		                'heading' => __( 'Icon link', 'pergo' ),
		                'param_name' => 'link',
		                'value' => '#',
		            ),
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Icons requirements', 'pergo' ),
                'param_name' => 'require',
                'value' => '* Requires iOS 7.0 or higher',
                'admin_label' => true 
            ),
            
           
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
   $default = array( 
   	'title_font_container' => 'tag:h2|size:xl|extra_class:txt-500', 
   	'lead_text_font_container' => 'tag:p|extra_class:p-hero', 
   );
   $args = pergo_set_default_vc_values( $default, $args );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }

}
class WPBakeryShortCode_Pergo_hero_app_showcase extends WPBakeryShortCode {
}