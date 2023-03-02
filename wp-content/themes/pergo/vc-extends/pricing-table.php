<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_pricing_table_shortcode_vc');
function pergo_pricing_table_shortcode_vc( $return = false ) {	
	
	$args = array(
			'icon' => 'pergo-icon',
			'name' => __('Pricing table', 'pergo'),
			'base' => 'pergo_pricing_table',
			'class' => 'pergo-vc',
			'category' => __('Pergo', 'pergo'),
			'params' => array(
				array(
	                 'type' => 'dropdown',
	                'heading' => __( 'Style', 'pergo' ),
	                'param_name' => 'style',
	                'value' => array(
	                    'Style 1' => 'style1',
	                    'Style 2' => 'style2',
	                ),
	                'std' => 'style1',
	                'admin_label' => true 
	            ),	
				array(
					'type' => 'checkbox',
					'heading' => __( 'Featured?', 'pergo' ),
					'param_name' => 'featured',
					'value' => array( __( 'Yes', 'pergo' ) => 'yes' )					
				),							
            	array(
					'type' => 'textfield',
					'heading' => __('Title', 'pergo'),
					'param_name' => 'title',
					'value' => 'Personal Plan',
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => __('Price unit', 'pergo'),
					'param_name' => 'unit',
					'value' => '$',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Price', 'pergo'),
					'param_name' => 'price',
					'value' => '29',
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => __('Validity', 'pergo'),
					'param_name' => 'validity',
					'value' => 'monthly',
					'admin_label' => true,
				),       
				array(
					'type' => 'textfield',
					'heading' => __('Button link text', 'pergo'),
					'param_name' => 'link_title',
					'description' => 'Leave blank to avoid button',
					'value' => 'Get started now',
				),
				array(
					'type' => 'textfield',
					'heading' => __('Button url', 'pergo'),
					'param_name' => 'link',
					'value' => '#',
				),
				array(
					'type' => 'textarea_html',
					'heading' => __('Description', 'pergo'),
					'param_name' => 'content',
					'description' => '',
					'value' => '<ul class="features">
											<li><strong>10</strong> Users Tasks</li>
											<li><strong>5 GB</strong> of Storage</li>
											<li><strong>10 mySQL</strong> Database</li>
											<li><strong>9/5</strong> Support</li>									
										</ul>',
				), 
				pergo_vc_animation_type(), 
            	pergo_vc_animation_duration(),
				
			)
		);

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
	
}
class WPBakeryShortCode_Pergo_pricing_table extends WPBakeryShortCode {
}
