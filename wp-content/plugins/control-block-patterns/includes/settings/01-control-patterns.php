<?php
$tab = 'control_patterns';
$fields = array(
    array(
        'id'           => 'core_pattern_label',
        'name'        => __( 'Category Name', 'control-block-patterns' ),
        'desc'         => __( 'If you do not choose any Pattern Category when you create new Block Pattern, all patterns will be populated under this Category.', 'control-block-patterns' ),
        'placeholder'  => __( 'Default Pattern Category Name', 'control-block-patterns' ),
        'std'          => __( 'Control Block Patterns', 'control-block-patterns' ),
        'type'         => 'text',
        'size' => 50
    ),
    
);
$control_patterns = array_merge( $fields, ControlPatterns\Patterns\Helper::registered_categories() );

//control patterns tabs settings
return [   
    'id'             => 'control_patterns_settings',
    'title'          => __('Control Patterns', 'control-block-patterns'),
    'settings_pages' => 'block-patterns-options',
    'context'        => 'normal', 
    'tab'            => $tab,
    'style'          => 'seamless',
    'fields'         => $control_patterns
];
