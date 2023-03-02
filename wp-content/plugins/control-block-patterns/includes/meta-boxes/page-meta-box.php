<?php
if( ctrlbp_get_option('page_metabox', 'off') != 'on' ) return [];

return [   
    'id'             => 'control_block_patterns',
    'title'          => esc_attr__('Control Block Patterns', 'control-block-patterns'),
    'post_types'      => ['page'],
    'context'        => 'normal', 
    'tab_style'       => 'left',
    'tabs'            => [ 
        'general' => esc_attr__( 'General', 'control-block-patterns' )
     ],
    'style'          => '',
    'fields'         => [
        [
            'desc' => 'If you do not want this settings, you can disable this in the <a href="'. admin_url('edit.php?post_type=ctrl_block_patterns&page=block-patterns-options#tab-control_post_types') .'">Block Patterns > Settings</a>',
            'type'    => 'custom_html',
            'tab'    => 'general',
        ],
        [
            'id'           => 'cbp_display_patterns',
            'name'        => esc_html__( 'Display Patterns?', 'control-block-patterns' ),
            'tab'         => 'general',				
            'std'          => 'off',
            'desc' 			=> '',
            'type'         => 'on-off',
                      
        ],
        [
            'id'           => 'cbp_patterns',
            'name'        => __( 'Patterns', 'control-block-patterns' ),
            'desc'         => __( 'You can re-order with drag & drop, the order will update after saving.', 'control-block-patterns' ),
            'tab'         => 'general',	
            'std'          => array(
                array(
                    'title' => 'Footer Template #1',
                    'pattern' => ''
                )
            ),
            'type'         => 'group',
            'class'        => '',	
            'visible'    => [ 'cbp_display_patterns', '=', 'on' ],
            'clone'      => true,
            'collapsible' => true,
            'default_state' => 'collapsed',
            'group_title' => '{title}',
            'fields'     => array(
                array(
                    'id'           => 'title',
                    'label'        => __( 'Title', 'control-block-patterns' ),
                    'type'         => 'text',
                ),
                array(
                    'id'           => 'pattern',
                    'label'        => __( 'Pattern', 'control-block-patterns' ),
                    'type'         => 'select',
                    'options'     => control_block_patterns_choices(),
                ),
            ),
        ],
        
    ]
];