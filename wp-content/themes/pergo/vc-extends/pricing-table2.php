<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_pricing_table2_shortcode_vc');
function pergo_pricing_table2_shortcode_vc( $return = false ) {	
	
	vc_map( 
		array(
			'icon' => 'pergo-icon',
			'name' => __('Pricing table2', 'pergo'),
			'base' => 'pergo_pricing_table2',
			'class' => 'pergo-vc',
			'category' => __( 'Pergo new', 'pergo' ),
			'params' => array(
				array(
                 	'type' => 'dropdown',
	                'heading' => __( 'Pricing table color', 'pergo' ),
	                'param_name' => 'pricing_color',               
	                'value' => pergo_vc_global_color_options(),
	                'std' => 'rose',
	                'description' => '',
	            ),	
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
				// params group
	            array(
	                'type' => 'param_group',
	                'save_always' => true,
	                'heading' => __( 'Buttons', 'pergo' ),
	                'param_name' => 'params',
	                'value' => urlencode( json_encode( array(
	                    array(
	                         'button_text' => 'Get Started Now',
	                        'button_size' => 'btn-md',
	                    ),
	                ) ) ),
	                'params' => pergo_button_groups_param(),
	            ),
				pergo_vc_animation_type(), 
            	pergo_vc_animation_duration(),
				
			)
		) 
	);
	
}
class WPBakeryShortCode_Pergo_pricing_table2 extends WPBakeryShortCode {
}
