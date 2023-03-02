<?php
add_action( 'vc_after_init', 'pergo_vc_section_settings' );
function pergo_vc_section_settings( ) {
    $newParamData = array(       
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Section stretch', 'pergo' ),
            'param_name' => 'full_width',
            'value' => array(
                 __( 'Default', 'pergo' ) => 'container',
                __( 'Stretch section', 'pergo' ) => 'container-wide' 
            ),
            'description' => __( 'Select stretching options for section and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'pergo' ) 
        ),        
        array(
            'group' => 'Pergo Settings',
            'type' => 'el_id',
            'heading' => __( 'Section ID', 'pergo' ),
            'param_name' => 'el_id',
            'description' => sprintf( __( 'Enter section ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'pergo' ), 'http://www.w3schools.com/tags/att_global_id.asp' ) 
        ),
        array(
            'group' => 'Pergo Settings',
            'type' => 'checkbox',
            'heading' => __( 'Enable hero section?', 'pergo' ),
            'param_name' => 'enable_hero',
            'description' => __( 'Checked to use this section as a Hero Background', 'pergo' ),
            'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),      
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Choose a hero style', 'pergo' ),
            'param_name' => 'hero_id',
            'group' => 'Pergo Settings',
            'value' => pergo_vc_hero_options(),
            'description' => __( 'You need to add also hero element in this section, then it worked perfectly. Hero style select mean changes the default background, font size, spacing etc. of this section.', 'pergo' ),
            'std'  => '',
            'description' => '',
            'dependency' => array(
                 'element' => 'enable_hero',
                'not_empty' => true 
            ) 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Section top & bottom padding', 'pergo' ),
            'param_name' => 'padding_class',
            'group' => 'Pergo Settings',
            'value' => pergo_vc_padding_options(),
            'std'  => 'wide-60',
            'description' => '' 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Section Background', 'pergo' ),
            'param_name' => 'bg_class',
            'group' => 'Pergo Settings',
            'value' => pergo_vc_background_options(),
            'std' => 'bg-white',
            'description' => '' 
        ),  
         array(
            'group' => 'Pergo Settings',
             'type' => 'dropdown',
            'heading' => __( 'Parallax', 'pergo' ),
            'param_name' => 'video_bg_parallax',
            'value' => array(
                 __( 'None', 'pergo' ) => '',
                __( 'Simple', 'pergo' ) => 'content-moving',
                __( 'With fade', 'pergo' ) => 'content-moving-fade' 
            ),
            'description' => __( 'Add parallax type background for section.', 'pergo' ),
            'dependency' => array(
                 'element' => 'video_bg',
                'not_empty' => true 
            ) 
        ),          
        array(
             'type' => 'image_upload',
            'heading' => __( 'Image', 'pergo' ),
            'param_name' => 'parallax_image',
            'value' => PERGO_URI . '/images/banner-1.jpg',
            'description' => __( 'Select image from media library.', 'pergo' ),
            'group' => 'Pergo Settings',
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),        
        array(
             'type' => 'textfield',
            'heading' => __( 'Parallax speed', 'pergo' ),
            'param_name' => 'parallax_speed_bg',
            'value' => '1',
            'group' => 'Pergo Settings',
            'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'pergo' ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'textfield',
            'heading' => __( 'Parallax background image opacity', 'pergo' ),
            'param_name' => 'parallax_image_opacity',
            'value' => '1',
            'description' => __( 'Maximum value 1', 'pergo' ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax width', 'pergo' ),
            'param_name' => 'parallax_width',
            'std' => '100%',
            'value' => array(
                 '100%' => '100%',
                '75%' => '75%',
                '50%' => '50%',
                '25%' => '25%' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image size', 'pergo' ),
            'param_name' => 'parallax_image_size',
            'std' => 'cover',
            'value' => array(
                 'Cover' => 'cover',
                'Contain' => 'contain',
                'Auto' => 'auto',
                '25% auto' => '25% auto',
                '50% auto' => '50% auto',
                'auto 50%' => 'auto 50%',
                'auto 25%' => 'auto 25%' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image repeat', 'pergo' ),
            'param_name' => 'parallax_image_repeat',
            'std' => 'cover',
            'value' => array(
                 'Default' => '',
                'No Repeat' => 'no-repeat',
                'Repeat' => 'repeat' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image position', 'pergo' ),
            'param_name' => 'parallax_image_position',
            'std' => 'cover',
            'value' => array(
                 'Default' => '50% 0',
                'Center' => 'center',
                'Top center' => 'top center',
                'Bottom center' => 'bottom center',
                'Top left' => 'top left',
                'Bottom left' => 'bottom left',
                'Top right' => 'top right',
                'Bottom right' => 'bottom right' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
        array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Parallax background image attachment', 'pergo' ),
            'param_name' => 'parallax_image_attachment',
            'std' => 'cover',
            'value' => array(
                 'Default' => 'inherit',
                'Fixed' => 'fixed',
                'Scroll' => 'scroll',
                'Local' => 'local',
                'Unset' => 'inset' 
            ),
            'dependency' => array(
                 'element' => 'parallax',
                'not_empty' => true 
            ) 
        ),
         
    );
    foreach ( $newParamData as $key => $value ) {
        vc_update_shortcode_param( 'vc_section', $value );
    } //$newParamData as $key => $value
    $array = array(
             'group' => 'Pergo Settings',
            'type' => 'dropdown',
            'heading' => __( 'Column style', 'pergo' ),
            'param_name' => 'column_style',
            'std' => 'pergo-default',
            'value' => array(
                 'Default' => 'pergo-default',
                'Border separated' => 'border-separated-column',
                'No spacing in column' => 'no-spacing-column',
            ),
        );
    vc_update_shortcode_param( 'vc_row', $array );

    $array = array(
             'type' => 'dropdown',
            'heading' => __( 'Row Background', 'pergo' ),
            'param_name' => 'row_bg_class',
            'group' => 'Pergo Settings',
            'value' => pergo_vc_background_options(),
            'std' => 'bg-tra',
            'description' => '' 
        );
    vc_update_shortcode_param( 'vc_row', $array );
    vc_update_shortcode_param( 'vc_row_inner', $array );
    vc_update_shortcode_param( 'vc_column', $array );
    vc_update_shortcode_param( 'vc_column_inner', $array );
}

