<?php
$tab = 'control_scripts';

//control scripts tab settings
return [   
    'id'             => 'control_scripts_settings',
    'title'          => __('Control Post Types', 'control-block-patterns'),
    'settings_pages' => 'block-patterns-options',
    'context'        => 'normal', 
    'tab'            => $tab,
    'style'         => 'seamless',
    'fields'         => [
        [
            'id'   => 'javascript_tab1',
            'type' => 'heading',
            'name' => __('Header, Footer & Body Scripts', 'control-block-patterns'),
            'desc' => '<p>'.sprintf( esc_attr__('Fire the %1$s action. Allowed tag %2$s, %3$s, %4$s, %5$s. Scripts are applicable in entire site. You can use Google anaylitic code, differentt social media\'s embeded code.', 'control-block-patterns'), '<code>wp_head</code>', '<code>meta</code>', '<code>script</code>', '<code>style</code>', '<code>link</code>' ).'</p>',                
        ],
        [
            'name'    =>  __('Enable?', 'control-block-patterns'),
            'desc'    =>  '',
            'id'      => 'scripts_in_header_display',
            'type'    => 'on-off',
            'std'     => 'on',               
        ],
        [
            'name'    =>  __('Scripts in Head', 'control-block-patterns'),
            'desc'    =>  '<p>'.sprintf( esc_attr__('Prints scripts or data in the %1$s tag on the front end.', 'control-block-patterns'), '<code>head</code>' ).'</p>',
            'id'      => 'scripts_in_header',
            'type'    => 'editor',
            'rows'    => 15,
            'std'     => '', 
            'visible' => [ 'scripts_in_header_display', '=', 'on' ]              
        ],            
        [
            'id'   => 'javascript_tab2',
            'type' => 'heading',
            'name' => __('Body Scripts', 'control-block-patterns'),
            'desc' => '<p>'.sprintf( esc_attr__('Fire the %1$s action.', 'control-block-patterns'), '<code>wp_body_open</code>' ).'</p>',                
        ],
        [
            'name'    =>  __('Enable?', 'control-block-patterns'),
            'desc'    =>  '',
            'id'      => 'scripts_in_body_display',
            'type'    => 'on-off',
            'std'     => 'on',               
        ],
        [
            'name'    =>  __('Scripts in Body Open', 'control-block-patterns'),
            'desc'    =>  '<p>'.sprintf( esc_attr__('Triggered after the opening %1$s tag.', 'control-block-patterns'), '<code>body</code>' ).'</p>',
            'id'      => 'scripts_in_body',
            'type'    => 'editor',
            'rows'    => 15,
            'std'     => '', 
            'visible' => [ 'scripts_in_body_display', '=', 'on' ]              
        ],
        [
            'id'   => 'javascript_tab3',
            'type' => 'heading',
            'name' => __('Footer Scripts', 'control-block-patterns'),
            'desc' => '<p>'.sprintf( esc_attr__('Fire the %1$s action', 'control-block-patterns'), '<code>wp_footer</code>' ).'</p>',               
        ],
        [
            'name'    =>  __('Enable?', 'control-block-patterns'),
            'desc'    =>  '',
            'id'      => 'scripts_in_footer_display',
            'type'    => 'on-off',
            'std'     => 'on',               
        ],
        [
            'name'    =>  __('Scripts in Footer', 'control-block-patterns'),
            'desc'    =>  sprintf( esc_attr__('Prints scripts or data before the closing %1$s tag on the front end.', 'control-block-patterns'), '<code>body</code>' ),
            'id'      => 'scripts_in_footer',
            'type'    => 'editor',
            'rows'    => 15,
            'std'     => '', 
            'visible' => [ 'scripts_in_footer_display', '=', 'on' ]              
        ],
    ]
];  