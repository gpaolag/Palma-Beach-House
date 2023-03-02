<?php
function pergo_background_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'container_width',
            'label' => __( 'Container width', 'pergo' ),
            'desc' => '',
            'std' => array( '1140',  'px' ),
            'type' => 'measurement',
            'section' => 'background_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '320,2000,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and',
            'action' => array( ) 
        ),
        array(
             'id' => 'body_background',
            'label' => __( 'Body background', 'pergo' ),
            'desc' => '',
            'std' => '',
            'type' => 'background',
            'section' => 'background_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'operator' => 'and',
            'action' => array( ) 
        ),
        array(
             'id' => 'header_bg_img',
            'label' => __( 'Header Default background image', 'pergo' ),
            'desc' => '',
            'std' => PergoHeader::get_default_header_image(),
            'type' => 'upload',
            'section' => 'background_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
            'id'          => 'breadcrumbs_overlay_type',
            'label'       => __( 'Breadcrumbs overlay type', 'pergo' ),
            'std'         => apply_filters( 'pergo_breadcrumbs_overlay_type', 'light'),
            'type'        => 'radio',
            'section'     => 'background_options',
            'std' => 'dark',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'light',
                'label'       => __( 'Light', 'pergo' ),
              ),
              array(
                'value'       => 'dark',
                'label'       => __( 'Dark', 'pergo' ),
              ),
              array(
                'value'       => 'rose',
                'label'       => __( 'Preset color', 'pergo' ),
              ),
            )
        ),  
        array(
             'id' => 'overlay_opacity',
            'label' => __( 'Header image overlay opacity', 'pergo' ),
            'desc' => '',
            'std' => '0',
            'type' => 'numeric-slider',
            'section' => 'background_options',
            'min_max_step' => '0,100,1',
            'condition' => '',
            'operator' => 'and' 
        ),
    );
    return apply_filters( 'pergo_background_options', $options );
}
?>