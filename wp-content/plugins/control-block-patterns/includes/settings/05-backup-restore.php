<?php
$tab = 'backup_restore';

return [   
    'id'             => 'control_backup_restore_settings',
    'title'          => __('Backup & Restore', 'control-block-patterns'),
    'settings_pages' => 'block-patterns-options',
    'tab'            => $tab,
    'style'         => 'seamless',
    'fields'         => [
        [
            'name'    => __('Backup', 'control-block-patterns'),
            'type'    => 'backup'
        ],  
        [
            'name'    => __('Import', 'control-block-patterns'),
            'type'    => 'import'
        ],           
        
    ]
];
