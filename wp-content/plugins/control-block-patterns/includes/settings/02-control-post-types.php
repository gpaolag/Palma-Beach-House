<?php
$tab = 'control_post_types';

//control patterns tabs settings
return [   
    'id'             => 'control_post_types_settings',
    'title'          => __('Control Post Types', 'control-block-patterns'),
    'settings_pages' => 'block-patterns-options',
    'tab'            => $tab,
    'style'         => 'seamless',
    'fields'         => [
        [
            'name'    => __('Post Meta Box', 'control-block-patterns'),
            'desc'    => sprintf( esc_attr__( 'Use %1$s to disable default Meta Box in single post edit page', 'control-block-patterns' ), '<code>OFF</code>' ),
            'id'      => 'post_metabox',
            'type'    => 'on-off',
            'std'     => 'off',
        ],            
        [
            'name'    =>  __('Page meta box', 'control-block-patterns'),
            'desc'    => sprintf( esc_attr__( 'Use %1$s to disable default Meta Box in single page', 'control-block-patterns' ), '<code>OFF</code>' ),
            'id'      => 'page_metabox',
            'type'    => 'on-off',
            'std'     => 'off',               
        ],
        [
            'name'    =>  __('Edit post link', 'control-block-patterns'),
            'desc'    =>  sprintf( esc_attr__( 'Displays a link to edit the current Block Pattern, if a user is logged in and allowed to edit the Block Pattern. Can be used within The Loop or outside of it. Use %1$s to hide edit link for logged in and allowed user to edit.', 'control-block-patterns' ), '<code>OFF</code>' ),
            'id'      => 'edit_post_link',
            'type'    => 'on-off',
            'std'     => 'off',               
        ],
    ]
];
