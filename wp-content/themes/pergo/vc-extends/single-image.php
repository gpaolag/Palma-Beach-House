<?php
add_action( 'vc_after_init', 'pergo_hero_image_shortcode_vc' );
function pergo_hero_image_shortcode_vc( $return = false ) {

	$args = array(
		'name' => __( 'Single Image', 'pergo' ),
		'base' => 'pergo_single_image',
		'icon' => 'pergo-icon',
		'category' => __( 'Pergo new', 'pergo' ),
		'description' => __( 'Simple image with CSS animation', 'pergo' ),
		'params' => array(			
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image source', 'pergo' ),
				'param_name' => 'source',
				'std' => 'external_link',
				'value' => array(
					__( 'Media library', 'pergo' ) => 'media_library',
					__( 'External link', 'pergo' ) => 'external_link',
					__( 'Featured Image', 'pergo' ) => 'featured_image',
				),
				'description' => __( 'Select image source.', 'pergo' ),
				'weight' => 16
			),
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'pergo' ),
				'param_name' => 'image',
				'value' => '',
				'description' => __( 'Select image from media library.', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'media_library',
				),
				'admin_label' => true,
				'weight' => 15
			),
			array(
				'type' => 'image_upload',
				'heading' => __( 'External link', 'pergo' ),
				'param_name' => 'custom_src',
				'description' => __( 'Select external link.', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),				
				'admin_label' => true,
				'weight' => 14
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image size', 'pergo' ),
				'param_name' => 'img_size',
				'std' => 'full',
				'value' => array_flip( pergo_get_image_sizes_Arr() ),
				'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
				'weight' => 13
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'pergo' ),
				'param_name' => 'external_img_size',
				'value' => '',
				'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 12
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image alt', 'pergo' ),
				'param_name' => 'external_img_alt',
				'value' => '',				
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
				'edit_field_class' => 'vc_col-sm-6',
				'weight' => 12
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Caption', 'pergo' ),
				'param_name' => 'caption',
				'description' => __( 'Enter text for image caption.', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add caption?', 'pergo' ),
				'param_name' => 'add_caption',
				'description' => __( 'Add image caption.', 'pergo' ),
				'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image alignment', 'pergo' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Left', 'pergo' ) => 'left',
					__( 'Right', 'pergo' ) => 'right',
					__( 'Center', 'pergo' ) => 'center',
				),
				'description' => __( 'Select image alignment.', 'pergo' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image style', 'pergo' ),
				'param_name' => 'style',
				'value' => vc_get_shared( 'single image styles' ),
				'description' => __( 'Select image display style.', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => array(
						'media_library',
						'featured_image',
					),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Image style', 'pergo' ),
				'param_name' => 'external_style',
				'value' => vc_get_shared( 'single image external styles' ),
				'description' => __( 'Select image display style.', 'pergo' ),
				'dependency' => array(
					'element' => 'source',
					'value' => 'external_link',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Border color', 'pergo' ),
				'param_name' => 'border_color',
				'value' => vc_get_shared( 'colors' ),
				'std' => 'grey',
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'vc_box_border',
						'vc_box_border_circle',
						'vc_box_outline',
						'vc_box_outline_circle',
						'vc_box_border_circle_2',
						'vc_box_outline_circle_2',
					),
				),
				'description' => __( 'Border color.', 'pergo' ),
				'param_holder_class' => 'vc_colored-dropdown',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Border color', 'pergo' ),
				'param_name' => 'external_border_color',
				'value' => vc_get_shared( 'colors' ),
				'std' => 'grey',
				'dependency' => array(
					'element' => 'external_style',
					'value' => array(
						'vc_box_border',
						'vc_box_border_circle',
						'vc_box_outline',
						'vc_box_outline_circle',
					),
				),
				'description' => __( 'Border color.', 'pergo' ),
				'param_holder_class' => 'vc_colored-dropdown',
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'On click action', 'pergo' ),
				'param_name' => 'onclick',
				'value' => array(
					__( 'None', 'pergo' ) => '',
					__( 'Link to large image', 'pergo' ) => 'img_link_large',
					__( 'Open prettyPhoto', 'pergo' ) => 'link_image',
					__( 'Open custom link', 'pergo' ) => 'custom_link',
					__( 'Zoom', 'pergo' ) => 'zoom',
					__( 'Video', 'pergo' ) => 'video',
				),
				'description' => __( 'Select action for click action.', 'pergo' ),
				'std' => '',
			),
			array(
				'type' => 'href',
				'heading' => __( 'Video link', 'pergo' ),
				'param_name' => 'video_link',
				'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
				'description' => __( 'Enter URL if you want this image to have a popup video link', 'pergo' ),
				'dependency' => array(
					'element' => 'onclick',
					'value' => 'video',
				),
			),
			array(
	             'type' => 'dropdown',
	            'heading' => __( 'Video icon color', 'pergo' ),
	            'param_name' => 'icon_class',	            
	            'value' => pergo_vc_global_color_options(),
	            'std' => 'rose',
	            'description' => '',
	            'dependency' => array(
					'element' => 'onclick',
					'value' => 'video',
				), 
	        ),
			array(
				'type' => 'href',
				'heading' => __( 'Image link', 'pergo' ),
				'param_name' => 'link',
				'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'pergo' ),
				'dependency' => array(
					'element' => 'onclick',
					'value' => 'custom_link',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Link Target', 'pergo' ),
				'param_name' => 'img_link_target',
				'value' => pergo_target_param_list(),
				'dependency' => array(
					'element' => 'onclick',
					'value' => array(
						'custom_link',
						'img_link_large',
					),
				),
			),
			vc_map_add_css_animation(),
			array(
				'type' => 'el_id',
				'heading' => __( 'Element ID', 'pergo' ),
				'param_name' => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'pergo' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'pergo' ),
				'param_name' => 'el_class',
				'value' => '',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'pergo' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'CSS box', 'pergo' ),
				'param_name' => 'css',
				'group' => __( 'Design Options', 'pergo' ),
			),
			// backward compatibility. since 4.6
			array(
				'type' => 'hidden',
				'param_name' => 'img_link_large',
			),
		),
	);
	
	$newParamData = $args['params'];

 	foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_single_image', $value );
    } //$newParamData as $key => $value
}