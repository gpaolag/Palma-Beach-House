<?php
$tab = 'control_css';

//control patterns tabs settings
return [   
    'id'             => 'control_css_settings',
    'title'          => __('Control CSS', 'control-block-patterns'),
    'settings_pages' => 'block-patterns-options',
    'context'        => 'normal', 
    'tab'            => $tab,
    'style'         => 'seamless',
    'fields'         => [
        [
            'name'    =>  __('Defult Stylesheet?', 'control-block-patterns'),
            'desc'    => sprintf( esc_attr__( 'Use %1$s to disable default stylesheet of Control Block Patterns - %2$s', 'control-block-patterns' ), '<code>OFF</code>', '<code>control-block-patterns.css</code>' ),
            'id'      => 'default_stylesheet',
            'type'    => 'on-off',
            'std'     => 'on',               
        ],
        [
            'id'           => 'custom_css_loaded_in',
            'name'        => esc_html__( 'Add Inline Style in', 'control-block-patterns' ),			
            'std'          => '',
            'type'         => 'select',
            'options'	  => array(
                'deps' 		=> 'Load after specific stylesheet',
                'hide' 		=> 'Do not load',
            ),
            'visible'     => [ 'default_stylesheet', '=', 'off' ],
            'class' => 'cbp-no-border cbp-compact'			
        ],	
        [
            'id'           => 'deps_handle',
            'name'        => __( 'Handle', 'control-block-patterns' ),
            'type'         => 'text',
            'placeholder'  => 'twentytwenty-style',
            'desc'         => esc_attr__( '(string) (Required) Name of the stylesheet. Should be registered.', 'control-block-patterns' ),
            'operator'     => 'and',
            'visible'     => [
                'when' => [
                    ['default_stylesheet', '=', 'off'],
                    ['custom_css_loaded_in', '=', 'deps']
                ],
                'relation' => 'and'
            ],
    
        ],	
        [
            'name'    => __('CSS', 'control-block-patterns'),
            'desc'    => '',
            'id'    => 'custom_css',
            'type'    => 'editor',
            'editor_type' => 'css',
            'editor_theme' => 'chrome', // Available theme chrome, github, monokai, tomorrow, twilight
            'rows'    => 15,
            'std'    => '',
            'hidden'     => [
                'when' => [
                    ['default_stylesheet', '=', 'off'],
                    ['custom_css_loaded_in', '=', 'hide']
                ],
                'relation' => 'and'
            ],
        ],
        [
            'name'    => __('Responsive CSS', 'control-block-patterns'),
            'desc'    => '',
            'id'    => 'responsive_css',
            'type'    => 'group',            
            'clone'    => true,    
            'collapsible' => true,
            'save_state' => true,
            'default_state' => 'collapsed',        
            'max_clone'    => 2,            
            'group_title'    => '@media only screen and ({media}: {size}px)',            
            'std'    => [
                [
                    'media' => 'max-width',
                    'size' => '767',
                    'css' => '',
                ],
                [
                    'media' => 'max-width',
                    'size' => '525',
                    'css' => '',
                ],
            ],
            'fields' => [
                [
                    'name'    => __('Media type', 'control-block-patterns'),
                    'desc'    => '',
                    'id'    => 'media',
                    'type'    => 'select',                   
                    'std'    => 'max-width',
                    'options' => [
                        'max-width' => 'max-width',
                        'min-width' => 'min-width',
                    ]
                    
                ],
                [
                    'name'    => __('Media size', 'control-block-patterns'),
                    'desc'    => 'in pixel',
                    'id'    => 'size',
                    'type'    => 'number',                   
                    'std'    => '767',                   
                    'min'    => '300',                   
                    'max'    => '2000',                   
                    'step'    => '1', 
                ],
                [
                    'name'    => '',
                    'desc'    => '',
                    'id'    => 'css',
                    'type'    => 'editor',
                    'editor_type' => 'css',
                    'editor_theme' => 'chrome', // Available theme chrome, github, monokai, tomorrow, twilight
                    'rows'    => 5,
                    'std'    => '',
                    
                ],
            ],
            'hidden'     => [
                'when' => [
                    ['default_stylesheet', '=', 'off'],
                    ['custom_css_loaded_in', '=', 'hide']
                ],
                'relation' => 'and'
            ],
        ],

    ]
];