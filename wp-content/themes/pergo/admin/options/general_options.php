<?php
function pergo_general_options( $options = array( ) ) {
    $options = array(
        array(
            'id'          => 'preloader_display',
            'label'       => __( 'Preloader display', 'pergo' ),
            'desc'        => '',
            'std'         => 'default',
            'type'        => 'select',
            'section'     => 'general_options',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'   => array(
                array(
                    'label' => 'None',
                    'value' => 'none' 
                    ),
                array(
                    'label' => 'Prego default preloader',
                    'value' => 'default' 
                    ),
                array(
                    'label' => 'Custom preloader image',
                    'value' => 'custom' 
                    ),
                )
        ),
        array(
            'id' => 'preloader_bg',
            'label' => esc_attr__( 'Preloader background', 'pergo' ),
            'desc' => '',
            'type' => 'background',
            'section' => 'general_options',
            'condition' => 'preloader_display:not(none)',
        ),
        array(
             'id' => 'custom_preloader',
            'label' => __( 'Custom preloader image', 'pergo' ),
            'desc' => '',
            'std' => PERGO_URI . '/images/preloader.png',
            'type' => 'upload',
            'section' => 'general_options',
            'condition' => 'preloader_display:is(custom)',
            'operator' => 'and' 
        ),
        array(
            'id'          => 'pergo_layout_style',
            'label'       => __( 'Global layout design', 'pergo' ),
            'desc'        => __('Globally effect on theme buttons, form elements etc', 'pergo'),
            'std'         => 'rounded',
            'type'        => 'select',
            'section'     => 'general_options',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'   => array(
                array(
                    'label' => 'Rounded',
                    'value' => 'rounded' 
                    ),
                array(
                    'label' => 'Semi-rounded',
                    'value' => 'semirounded' 
                    ),
                array(
                    'label' => 'Flat',
                    'value' => 'flat' 
                    ),
                )
        ),
        array(
            'id'          => 'pergo_dropdown_type',
            'label'       => __( 'Deopdown navigation display action', 'pergo' ),
            'desc'        => __('Globally effect on theme navbar etc', 'pergo'),
            'std'         => 'click-menu',
            'type'        => 'select',
            'section'     => 'general_options',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'   => array(
                array(
                    'label' => 'On click',
                    'value' => 'click-menu' 
                    ),
                array(
                    'label' => 'On hover',
                    'value' => 'hover-menu' 
                    ),
                )
        ),
        array(
             'id' => 'pergo_animation',
            'label' => __( 'Animation', 'pergo' ),
            'desc' => __('OFF to force disable all animation', 'pergo'),
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'general_options',
        ),
        array(
             'id' => 'admin_logo',
            'label' => __( 'Admin logo', 'pergo' ),
            'desc' => '',
            'std' => PERGO_URI . '/images/logo.png',
            'type' => 'upload',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ),        
        array(
             'id' => 'google_map_api',
            'label' => __( 'Google map API', 'pergo' ),
            'desc' => 'Authentication for the standard API - API keys. <br><a class="button" href="//console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank"><strong>Get an API key</strong></a>',
            'std' => '',
            'type' => 'text',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'search_placeholder',
            'label' => __( 'Search Placeholder Text', 'pergo' ),
            'desc' => '',
            'std' => 'Search...',
            'type' => 'text',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'social_icons',
            'label' => __( 'Social Icons', 'pergo' ),
            'desc' => '',
            'std' => pergo_default_social_icons(),
            'type' => 'list-item',
            'section' => 'general_options',
            'condition' => '',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'icon_link',
                    'label' => __( 'Icon & link', 'pergo' ),
                    'desc' => '',
                    'std' => array(
                         'icon' => 'fa-heart',
                        'input' => '#' 
                    ),
                    'type' => 'iconpicker_input' 
                ) 
            ) 
        ),
        
    );
    return apply_filters( 'pergo_general_options', $options );
}
?>