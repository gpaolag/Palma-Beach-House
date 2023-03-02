<?php
function ctrlbp_settings_pages(){
    $settings_pages = array();
    $settings_pages[] = [
        'id'            => 'block-patterns-options',
        'menu_title'    => 'Settings',
        'page_title'    => 'Control Block Patterns',
        'option_name'   => 'control_block_patterns',
        'icon_url'      => 'dashicons-book',
        'parent'        => 'edit.php?post_type=ctrl_block_patterns',
        'submenu_title' => 'Settings', 
        'tab_style'       => '',
        'columns'       => 1,
        'help_tabs' => [
            [
                'title'   => 'Control Patterns',
                'content' => '<ul>
                    <li><strong>Control Reusable Blocks:</strong> Now you can easily manage your Reusable Blocks, you can import all of them by single click.</li>
                    <li><strong>Register Block Patterns:</strong>  The editor comes with <strong>1400+ Predefined Patterns.</strong> Theme and plugin authors can <strong>register</strong> additional custom block pattern using this plugin</li>
                    <li><strong>Unregister Block Patterns:</strong> The plugin settings page allows for a previously registered block pattern to be unregistered from a theme or plugin </li>
                    <li><strong>Register Block Pattern Categories:</strong> The block editor comes with bundled categories you can use on your custom block patterns. You can also register your own block pattern categories using the plugin.</li>
                    <li><strong>Unregister Block Pattern Categories:</strong> This Plugin settings page allows you to unregister a pattern category comes from a theme or plugin</li>
                </ul>',
            ],
            [
                'title'   => 'Control Post Types',
                'content' => '<p>By using this plugin you can also control <strong>Patterns</strong>, custom <strong>CSS</strong>, <strong>Script</strong>,<strong>HTML</strong> and many more in your WordPress site header, content and footer.</p>',
            ],
            [
                'title'   => 'Control CSS',
                'content' => '<p><strong>Custom Style Add:</strong> There is an option <strong><em>Control CSS</em></strong>, by using this feature you can control you theme CSS.</p>',
            ],
            [
                'title'   => 'Control Scripts',
                'content' => '<p><strong>Easily Insert Header and Footer Code:</strong> You can insert code like Google Analytics, custom CSS, Facebook Pixel, any code or script, including HTML and JavaScript and more to your WordPress site header and footer. No need to edit your theme files! This plugin gives you one place where you can insert scripts, rather than dealing with dozens of different plugins.</p>',
            ]
        ],
        'tabs'        => [
            'control_patterns' => [
                'label' => __('Control Patterns', 'control-block-patterns'),
            ],
            'control_post_types'  => [
                'label' => __('Control Post Types', 'control-block-patterns'),
            ],
            'control_css'    => [
                'label' => __('Control CSS', 'control-block-patterns'),
            ],
            'control_scripts'    => [
                'label' => __('Control Scripts', 'control-block-patterns'),
            ],
            'backup_restore'    => [
                'label' => __('Backup & Restore', 'control-block-patterns'),
            ],
        ],
        
        
    ];
    
    return $settings_pages;
}