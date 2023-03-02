<?php 
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_team_template_shortcode_vc');
function pergo_team_template_shortcode_vc( $return = false ) {
	
	vc_map( 
		array(
			'icon' => 'pergo-icon',
			'name' => __('Team template', 'pergo'),
			'base' => 'pergo_team_template',
			'class' => 'pergo-vc',
			'category' => __( 'Pergo', 'pergo'),
			'description' => __('Show Team members', 'pergo'),
			'params' => array(				
				array(
					'type' => 'dropdown',
					'heading' => __('Display type', 'pergo'),
					'param_name' => 'template',
					'value' =>  array(
							'Default' => 'team/default-loop.php',							
							'Carousel' => 'team/carousel-loop.php',						
						),
					'admin_label' => true
				),
				array(
					'type' => 'number',
					'heading' => __('Posts per page', 'pergo'),
					'param_name' => 'posts_per_page',
					'value' => '-1',
					'min' => '-1',
					'max' => '100',
					'step' => '1',
					'description' => 'Specify number of posts that you want to show. Enter -1 to get all posts',
					'admin_label' => true
				),/*
				array(
	                'type' => 'perch_select',
	                'value' => array('all' => 'All', 'specific' => 'Specific team'),
	                'heading' => 'Team display from',
	                'param_name' => 'display',
	            ),
	            // params group
	            array(
	                'type' => 'param_group',
	                'value' => '',
	                'heading' => __( 'Teams', 'pergo' ),
	                'param_name' => 'teams',
	                'value' => '',
	                'params' => array(
	                    array(
	                        'type' => 'perch_select',
	                        'value' => pergo_get_posts_dropdown(array('post_type' => 'team', 'posts_per_page' => -1)),
	                        'heading' => 'Team',
	                        'param_name' => 'team',
	                        'admin_label' => true,
	                    ),
	                   
	                ),
                'dependency' => array(
                    'element' => 'display',
                    'value' => 'specific'
                )
            ),*/            
				array(
					'type' => 'perch_select',
					'heading' => __('Order', 'pergo'),
					'param_name' => 'order',
					'description' => 'Posts order',
					'value' =>  array(
								'desc' => __( 'Descending', 'pergo' ),
								'asc' => __( 'Ascending', 'pergo' )
							),
				),				
				array(
					'type' => 'perch_select',
					'heading' => __('Order by', 'pergo'),
					'param_name' => 'orderby',
					'description' => 'Order posts by',
					'selected' => 'date',
					'value' =>  array(
								'none' => __( 'None', 'pergo' ),
								'id' => __( 'Post ID', 'pergo' ),
								'author' => __( 'Post author', 'pergo' ),
								'title' => __( 'Post title', 'pergo' ),
								'name' => __( 'Post slug', 'pergo' ),
								'date' => __( 'Date', 'pergo' ), 
								'modified' => __( 'Last modified date', 'pergo' ),
								'parent' => __( 'Post parent', 'pergo' ),
								'rand' => __( 'Random', 'pergo' ), 
								'comment_count' => __( 'Comments number', 'pergo' ),
								'menu_order' => __( 'Menu order', 'pergo' ), 'meta_value' => __( 'Meta key values', 'pergo' ),
							),
				),
				array(
                'type' => 'number',
                'heading' => __( 'Column', 'pergo' ),
                'param_name' => 'column',
                'value' => '3',
                'min' => '2',
                'max' => '4',
                'step' => '1',
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'team/carousel-loop.php',
                        
                    ) 
                ) 
            ),
				array(
                'type' => 'dropdown',
                'heading' => __( 'Autoplay', 'pergo' ),
                'param_name' => 'autoplay',
                'std' => 'no',
                'value' => array(
                     'Yes' => 'yes',
                    'No' => 'no' 
                ),
                'dependency' => array(
                    'element' => 'template',
                    'value' => array(
                         'team/carousel-loop.php' 
                    ) 
                ) 
            ),
			array(
                'type' => 'dropdown',
                'heading' => __( 'Dots', 'pergo' ),
                'param_name' => 'dots',
                'std' => 'no',
                'value' => array(
                     'Yes' => 'yes',
                    'No' => 'no' 
                ),
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'team/carousel-loop.php' 
                    ) 
                ) 
            ),            

				),
			)
		 
	);
	
}
