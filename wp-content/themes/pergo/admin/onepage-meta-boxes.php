<?php
/**
 * Initialize the meta boxes. 
 */

add_action( 'admin_init', 'pergo_general_onepage_meta_boxes' );
if( !function_exists('pergo_general_onepage_meta_boxes') ):
function pergo_general_onepage_meta_boxes() {
    $screen = get_current_screen(); 
    $navarr = array(
            array(
                 'id' => 'nav_general_option_tab',
                'label' => __( 'General settings', 'pergo' ),
                'desc' => __( 'Display social Icon or Buttons', 'pergo' ),
                'type' => 'tab',
                'section' => 'header_options',
                //'class' => 'half-column-size', 
            ),
            array(
                'id' => 'one_page_wp_nav',
                'label' => __('Select Nav menu', 'pergo'),
                'desc' => '<a href="' . admin_url( 'nav-menus.php' ) . '" class="nav-link">' . __( 'Add a menu', 'pergo' ) . '</a>',
                'std' => '',
                'type' => 'select',
                'choices' => pergo_get_terms_choices('nav_menu')
            ),
        );  

      $my_meta_box = array(
        'id'        => 'pergo_onepage_sttings_boxes',
        'title'     => __('Landing Page Navbar Settings', 'pergo'),
        'desc'      => '',
        'pages'     => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'fields'    =>  array_merge($navarr, pergo_header_options())

      );
      ot_register_meta_box( $my_meta_box );

      $my_meta_box = array(
        'id'        => 'pergo_onepage_footer_sttings_boxes',
        'title'     => __('Landing Page footer Settings', 'pergo'),
        'desc'      => '',
        'pages'     => array( 'page' ),
        'context'   => 'normal',
        'priority'  => 'high',
        'fields'    => array(
            array(
                 'id' => 'onepage_footer_display',
                'label' => __( 'Footer display', 'pergo' ),
                'type' => 'on-off',
                'std' => 'on',
                //'class' => 'half-column-size', 
            ),
            array(
                 'id' => 'quickform_area',
                'label' => __( 'Quick contact form Display','pergo' ),
                'desc' => __( 'Display in bottom of page','pergo' ),
                'std' => 'off',
                'type' => 'on-off',
                'section' => 'footer_options' 
            ),
            array(
                'id' => 'footer_bg_style',
                'label' => __('Footer background style', 'pergo'),
                'desc' => '',
                'std' => '',
                'type' => 'select',
                'choices' => array(           
                    array( 'label' => 'Transparent', 'value' => '' ),
                    array( 'label' => 'Light', 'value' => 'bg-light' ),
                    array( 'label' => 'Grey', 'value' => 'bg-grey' ),
                    array( 'label' => 'Dark', 'value' => 'bg-dark white-color' ),                    
               
                )
            ),
        )

      );
      ot_register_meta_box( $my_meta_box );

}
endif;