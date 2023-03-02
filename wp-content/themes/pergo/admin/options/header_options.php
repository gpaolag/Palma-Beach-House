<?php
function pergo_woo_cart_icon_option( ) {
    if ( function_exists( 'is_woocommerce' ) ) {
        return array(
             'id' => 'header_cart_icon',
            'label' => __( 'Header cart icon display', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'header_options',
            'condition' => '',
            'operator' => 'or' 
        );
    } //function_exists( 'is_woocommerce' )
}
function pergo_langs_dropdown_option( ) {
    return array(
         'id' => 'header_language_dropdown',
        'label' => __( 'Header topbar Language dropdown display', 'pergo' ),
        'desc' => 'This option only applicable when <strong>WPML</strong>, <strong>Polylang</strong> or <strong>Multilanguage by BestWebSoft</strong> plugins are installed',
        'std' => 'off',
        'type' => 'on-off',
        'section' => 'header_options',
        'condition' => '',
        'operator' => 'or' 
    );
}
function pergo_header_options( $options = array( ) ) {
    $options = array( 
        array(
             'id' => 'header_general_option_tab',
            'label' => __( 'Logo settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'header_options',
        ),       
         array(
             'id' => 'logo',
            'label' => __( 'Logo', 'pergo' ),
            'desc' =>  __( 'Display on light color background', 'pergo' ),
            'std' => apply_filters( 'pergo_header_logo_default', PERGO_URI . '/images/logo.png'),
            'type' => 'upload',           
            'section' => 'header_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'responsive_logo',
            'label' => __( 'Responsive logo', 'pergo' ),
            'desc' => '',
            'std' => array(),
            'type' => 'list-item',
            'section' => 'header_options',
            'condition' => '',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'image',
                    'label' => __( 'Upload logo image url', 'pergo' ),
                    'desc' => '',
                    'std' => '',
                    'type' => 'upload' 
                ),
                 array(
                    'id' => 'type',
                    'label' => __( 'Media type', 'pergo' ),
                    'desc' => '',
                    'std' => 'max-width',
                    'type' => 'select',
                    'section' => 'header_options',
                    'choices' => array(
                        array( 'label' => 'Maximum width',  'value' => 'max-width' ),
                        array( 'label' => 'Minimum width',  'value' => 'min-width' ),
                    )
                ),
                array(
                     'id' => 'size',
                    'label' => __( 'Enter screen size.', 'pergo' ),
                    'desc' => 'Example: 767px',
                    'std' => '',
                    'type' => 'text' 
                ) 
            ) 
        ),
        array(
             'id' => 'logo_white',
            'label' => __( 'Logo white', 'pergo' ),
            'desc' => __( 'Display on dark type background', 'pergo' ),
            'std' => apply_filters( 'pergo_header_logo_white_default', PERGO_URI . '/images/logo-white.png'),
            'type' => 'upload',
            'section' => 'header_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'logo_height',
            'label' => __( 'Logo height maximum', 'pergo' ),
            'std' => array(
                 '36',
                'px' 
            ),
            'type' => 'measurement',
            'section' => 'header_options',
            'operator' => 'and' 
        ),        
        array(
             'id' => 'header_navbar_option_tab',
            'label' => __( 'Navbar settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'header_options',
        ),
        array(
             'id' => 'navbar_style',
            'label' => __( 'Navbar style', 'pergo' ),
            'desc' => '',
            'std' => 'navbar-style1',
            'type' => 'select',
            'section' => 'header_options',
            'choices' => array(
                array( 'label' => 'Navbar style #1',  'value' => 'navbar-style1' ),
                array( 'label' => 'Navbar style #2',  'value' => 'navbar-style2' ),
            )
        ),
        array(
             'id' => 'nav_style',
            'label' => __( 'Navbar bg style', 'pergo' ),
            'desc' => '',
            'std' => 'navbar-dark bg-tra',
            'type' => 'select',
            'section' => 'header_options',
            'choices' => pergo_nav_bg_color_options(),
            //'class' => 'half-column-size',  
        ),
        array(
             'id' => 'header_sticky_nav',
            'label' => __( 'Sticky navbar', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'header_options',
            //'class' => 'half-column-size', 
        ), 
        array(
             'id' => 'nav_right_option_tab',
            'label' => __( 'Navbar right settings', 'pergo' ),
            'desc' => __( 'Display social Icon or Buttons', 'pergo' ),
            'type' => 'tab',
            'section' => 'header_options',
        ),
        array(
            'id' => 'right_wp_nav',
            'label' => __('Choose Right Nav menu', 'pergo'),
            'desc' => 'Optional. <a href="' . admin_url( 'nav-menus.php' ) . '" class="nav-link">' . __( 'Add a menu', 'pergo' ) . '</a>',
            'std' => '',
            'section' => 'header_options',
            'type' => 'select',
            'choices' => array_merge(array(array('label' => __( 'Add a menu', 'pergo' ), 'value'=> '')),pergo_get_terms_choices('nav_menu'))
        ),        
        array(
             'id' => 'header_search_display',
            'label' => __( 'Navbar Search icon display', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'header_options',
            //'class' => 'half-column-size', 
        ),
        array(
             'id' => 'nav_search_placeholder',
            'label' => __( 'Navbar Search placeholder text', 'pergo' ),
            'desc' => '',
            'std' => 'What are you looking for?',
            'type' => 'text',
            'section' => 'header_options',
            'condition' => 'header_search_display:is(on)',
            'operator' => 'and' 
        ),
        pergo_woo_cart_icon_option(),
        array(
             'id' => 'header_social_icons_display',
            'label' => __( 'Social Icons display', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'header_options' 
        ),
        array(
             'id' => 'header_social_icons',
            'label' => __( 'Social Icons', 'pergo' ),
            'desc' => '',
            'std' => pergo_header_default_social_icons(),
            'type' => 'list-item',
            'section' => 'header_options',
            'condition' => 'header_social_icons_display:is(on)',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'icon_link',
                    'label' => __( 'Top bar Title', 'pergo' ),
                    'desc' => '',
                    'std' => array(
                         'icon' => 'fa-heart',
                        'input' => '#' 
                    ),
                    'type' => 'iconpicker_input' 
                ) 
            ) 
        ),
        array(
             'id' => 'header_button_display',
            'label' => __( 'Header button display', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'header_options',
        ),
        array(
             'id' => 'header_button',
            'label' => __( 'header Button', 'pergo' ),
            'desc' => '',
            'std' => PergoHeader::get_default_nav_buttons(),
            'type' => 'list-item',
            'section' => 'header_options',
            'condition' => 'header_button_display:is(on)',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'link',
                    'label' => __( 'link', 'pergo' ),
                    'desc' => '',
                    'std' => '#',
                    'type' => 'text' 
                ),
                array(
                     'id' => 'style',
                    'label' => 'Button style',
                    'std' => 'btn-default',
                    'type' => 'select',
                    'choices' => pergo_btn_style_options()
                ),
                array(
                     'id' => 'target',
                    'label' => 'Link target',
                    'std' => '_self',
                    'type' => 'select',
                    'choices' => array(
                         array(
                             'value' => '_self',
                            'label' => __( 'Same window','pergo' ),
                        ),
                        array(
                             'value' => '_blank',
                            'label' => __( 'New window','pergo' ),
                        ),
                        
                    ) 
                ), 
                
            ) 
        ),
        array(
             'id' => 'header_info_display',
            'label' => __( 'Header Info display', 'pergo' ),
            'desc' => __( 'Display phone, email', 'pergo' ),
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'header_options',
        ),
        array(
             'id' => 'header_info',
            'label' => __( 'Header info', 'pergo' ),
            'desc' => '',
            'std' => array(
                array(
                    'title' => '+12-123-4568 ', 
                    'icon_link' => array('icon' => 'fa-phone', 'input' => '#')
                )),
            'type' => 'list-item',
            'section' => 'header_options',
            'condition' => 'header_info_display:is(on)',
            'operator' => 'and',
            'settings' => array(
                 array(
                     'id' => 'icon_link',
                    'label' => __( 'Icon & link', 'pergo' ),
                    'desc' => '',
                    'std' => array(
                         'icon' => '',
                        'input' => '#' 
                    ),
                    'type' => 'iconpicker_input' 
                ),
                array(
                     'id' => 'color',
                    'label' => 'Link color',
                    'std' => 'lightgreen',
                    'type' => 'select',
                    'choices' => array(
                        array(
                             'value' => 'default',
                            'label' => __( 'Default','pergo' ),
                        ),
                        array(
                             'value' => 'dark',
                            'label' => __( 'Dark','pergo' ),
                        ),
                         array(
                             'value' => 'lightgreen',
                            'label' => __( 'Light green','pergo' ),
                        ),
                        array(
                             'value' => 'yellow',
                            'label' => __( 'Yellow','pergo' ),
                        ),
                        array(
                             'value' => 'blue',
                            'label' => __( 'Blue','pergo' ),
                        ),
                        array(
                             'value' => 'purple',
                            'label' => __( 'Purple','pergo' ),
                        ),
                        array(
                             'value' => 'rose',
                            'label' => __( 'Rose','pergo' ),
                        ),
                        array(
                             'value' => 'red',
                            'label' => __( 'Red','pergo' ),
                        ),
                        
                    ) 
                ), 
                array(
                     'id' => 'target',
                    'label' => 'Link target',
                    'std' => '_self',
                    'type' => 'select',
                    'choices' => array(
                         array(
                             'value' => '_self',
                            'label' => __( 'Same window','pergo' ),
                        ),
                        array(
                             'value' => '_blank',
                            'label' => __( 'New window','pergo' ),
                        ),
                        
                    ) 
                ),
            ) 
        ),        

        /*array(        
        'id' => 'header_menu_breakpoint',        
        'label' => __( 'Header menu breakpoint', 'pergo' ),        
        'desc' => 'in pixel',        
        'std' => '800',        
        'type' => 'text',
        'section' => 'header_options'         
        ),*/
        //pergo_langs_dropdown_option(),
        //pergo_woo_cart_icon_option(),         
    );
    return apply_filters( 'pergo_header_options', $options );
}
?>