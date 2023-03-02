<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_inner_content2_shortcode_vc' );
function pergo_inner_content2_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Inner content block 2', 'pergo' ),
        'base' => 'pergo_inner_content2',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Display title, description & button + Image', 'pergo' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Background', 'pergo' ),
                'param_name' => 'bg',
                'std' => 'bg-lightgrey',
                'value' => array(
                    'Light grey' => 'bg-lightgrey',
                    'White' => 'bg-white',
                    'Dark' => 'bg-dark white-color',
                    'Deep dark' => 'bg-deepdark white-color',
                ),
            ),
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
                'value' => PERGO_URI . '/images/content-9-img.jpg' 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Sub-Title', 'pergo' ),
                'param_name' => 'subtitle',
                'value' => 'Digital Strategy',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'value' => 'We create successful digital products',
                'admin_label' => true 
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Content', 'pergo' ),
                'param_name' => 'content',
                'description' => '',
                'value' => '<p class="animated" data-animation="fadeInUp" data-animation-delay="500"> An enim nullam tempor sapien gravida donec enim blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula luctus risus</p><h5 class="h5-sm animated" data-animation="fadeInUp" data-animation-delay="600">Front-End Development</h5><ul class="content-list">                                                
                                        <li class=" animated" data-animation="fadeInUp" data-animation-delay="700">
                                           Vivamus tellus eget mattis rutrum
                                        </li>
                                        <li class="animated" data-animation="fadeInUp" data-animation-delay="800">
                                           Aenean quis purus auctor, rhoncus est non, dictum arcu maximus interdum sem eget justo maximus
                                        </li>
                                        <li class=" animated" data-animation="fadeInUp" data-animation-delay="900">
                                           Donec dolor in magna ultrices felis
                                        </li>
                                    </ul>',
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
class WPBakeryShortCode_Pergo_inner_content2 extends WPBakeryShortCode {
}